<?php

use App\Models\DeskLogs;
use App\Models\Nurse;
use App\Models\NurseReferences;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

function getQuarterOfYear()
{
    $month = date('n');
    $yearQuarter = ceil($month / 3);
    $quarter = '';
    switch ($yearQuarter) {
        case 1:
            $quarter = "first";
            break;
        case 2:
            $quarter = "second";
            break;
        case 3:
            $quarter = "third";
            break;
        case 4:
            $quarter = "fourth";
            break;
    }
    return $quarter;
}
function checkNurse($region_id, $category_id, $passport)
{
    $check_id = '';
    $region = DB::table('regions')->where('id', '=', $region_id)->first();
    $auth_token = "l522839c1f146a9dxf0dcda78b07669a";
    $data_json = array();
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $region->link.'?api_key='.$auth_token.'&passport='.$passport.'&category_id='.$category_id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30000,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data_json,
        CURLOPT_HTTPHEADER => array(
            "Authorization: $auth_token",
            "content-type: multipart/form-data",
        ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    $check_id = DB::table('check_certificate')->insertGetId([
        'category_id' => $category_id,
        'passport' => $passport,
        'region_id' => $region_id,
        'receive' => $response,
        'error' => $err,
        'created_at' => date('Y-m-d H:i:s')
     ]);
    if (empty($err)){
        $result = json_decode($response, true);
        if (!empty($result['response']['success'])){
            $nurse = $result['response']['success'][0];
            $end_date = strtotime($nurse['certificate']['end_date']);
            $today = strtotime(date('Y-m-d'));
            if ($today < $end_date){
                $messages['messages'] = 'Sertifikat hali tasdiqlanmagan!';
            }else{
                $date1 = date_create_from_format('Y-m-d', date('Y-m-d', $end_date));
                $date2 = date_create_from_format('Y-m-d', date('Y-m-d'));
                $diff = (array) date_diff($date1, $date2);
                if ($diff['y']>3){
                    $messages['messages'] = 'Sertifikat muddati otgan!';
                }else{
                    $success = $result['response'];
                }
            }
        }elseif($result['response']['error']){
            $messages['messages'] = 'Sertifikat topilmadi!';
        }else{
            $messages['messages'] = 'Serer bilan aloqa yoq keyinroq urinib koring!';
        }
    }else{
        $messages['messages'] = 'Serer bilan aloqa yoq keyinroq urinib koring!';
    }
    if (!empty($success)){
        return $success;
    }else{
        DB::table('check_certificate')
            ->where('id', $check_id)
            ->update(['error' =>json_encode($messages), 'updated_at' => date('Y-m-d H:i:s')]);
        return array('error'=>$messages);
    }

}
function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function uploadFile($files)
{
    $random = generateRandomString(3);
    $filenameWithExt = $files->getClientOriginalName();
    $fileSize = $files->getSize();
    $extension = $files->getClientOriginalExtension();
    $token = uniqid($random . time() . generateRandomString());
    $fileNameToStore = $token . '.' . $extension;
    $storePath = 'temp/' . $random;
    $path = $files->storeAs($storePath, $fileNameToStore);
    return $path;
}
function getDateInLatin($date = false): string
{
    if (!isset($date)){
        $date = date('Y.m.d');
    }
    $date = date('Y j F', strtotime($date));
    $months = array(
        'January'=>'yanvar',
        'February'=>'fevral',
        'March'=>'mart',
        'April'=>'aprel',
        'May'=>'may',
        'June'=>'iyun',
        'July'=>'iyul',
        'August'=>'avgust',
        'September'=>'sentyabr', 'October'=>'oktyabr', 'November'=>'noyabr', 'December'=>'dekabr' );
    $d = explode(' ', $date);
    return  $d[0].' yil '.$d[1].' '.$months[$d[2]];
}
function getAddress($pin)
{
    $address = array();
    $info = DeskLogs::where('pinfl', $pin)->first();
    if (!empty($info)){
      $response = json_decode($info->response, true);
      $token = 'blabla';
      $auth_token = "test";
      $data = [
        "method" => "connect.region",
        "params" => array(
          "token" => $token,
          "districtId" => $response['DistrictId'],
        )
      ];
    }else{
      $response = passportInfo($pin);
      $log_id = $response['log_id'];
      unset($response['jsonrpc']);
      unset($response['method']);
      if (!empty($response['error'])) {
        $info['status'] = '2';
        $info['http_code'] = $response['error']['code'];
        $info['response'] = $response['error']['message'];
        $send = ['error' => $info['response']];
      } elseif (!empty($response['result'])) {
        $info['status'] = '1';
        $info['http_code'] = 200;
        $info['response'] = $response['result'];
        $send['success'] = $response['result'];
      } else {
        $info['status'] = '2';
        $info['http_code'] = 101;
        $info['response'] = $response;
        $send = ['error' => 'Unexpected error'];
      }
      $Partner_log = DeskLogs::find($log_id);
      $Partner_log->update($info);
      if (isset($send['error'])){
        return $send;
      }else{
        $response = json_decode($response['result'], true);
        $token = 'blabla';
        $auth_token = "test";
        $data = [
          "method" => "connect.region",
          "params" => array(
            "token" => $token,
            "districtId" => $response['DistrictId'],
          )
        ];
      }
    }

    $data_json = json_encode($data);
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://desk.e-invoice.uz/app",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30000,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data_json,
        CURLOPT_HTTPHEADER => array(
            "Authorization: $auth_token",
            "content-type: application/json",
        ),
    ));
    $result = curl_exec($curl);
    $result = json_decode($result, true);
    $err = curl_error($curl);
    curl_close($curl);
    if (!empty($result['result'])){
        $reg = $result['result']['region'];
        $dis = $result['result']['district'];
        $address['region'] = krillLatin($reg);
        $address['district'] = krillLatin($dis);
        return $address;
    }else{
      return ['error' => 'Unexpected error'];
    }
}
function krillLatin($string){
    $string    = strip_tags(trim($string));
    $string    = str_replace(' ', '-', $string);

    $slug = preg_replace ('/[^A-ZА-Яa-zа-яёқўғҳЁЎҚҒҲ\'0-9\-\/]/u', '-', $string);
    $slug = preg_replace('/([-]+)/i', ' ', $slug);
    $slug = trim($slug, '-');
    $ru_en = array(
        'А'=>'A', 'Б'=>'B', 'В'=>'V', 'Г'=>'G', 'Д'=>'D', 'Е'=>'E',
        'Ё'=>'YO', 'Ж'=>'J', 'З'=>'Z', 'И'=>'I', 'Й'=>'Y', 'К'=>'K', 'Л'=>'L', 'М'=>'M',
        'Н'=>'N', 'О'=>'O', 'П'=>'P', 'Р'=>'R', 'С'=>'S', 'Т'=>'T', 'У'=>'U', 'Ф'=>'F',
        'Х'=>'X', 'Ц'=>'S', 'Ч'=>'CH', 'Ш'=>'SH',
        'Щ'=>'SH','Ю'=>'YU','Ҳ'=>'H','Э'=>'E','Қ'=>'Q','('=>'(',')'=>')', 'Я'=>'YA',
        'а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d',
        'е'=>'e','ё'=>'yo','ж'=>'j','з'=>'z',
        'и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m',
        'н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s',
        'т'=>'t','у'=>'u','ф'=>'f','х'=>'x','ц'=>'ts',
        'ч'=>'ch','ш'=>'sh','щ'=>'sh','ъ'=>'','ы'=>'y',
        'ь'=>'','э'=>'e','ю'=>'yu','я'=>'ya','қ'=>'q','ў'=>'o`','ҳ'=>'h','ғ'=>'g`','ъ'=>"`"
    );
    foreach($ru_en as $ru=>$en){
        $slug = str_replace($ru, $en, $slug);
    }
    if (!$slug){ $slug = 'untitled'; }
    if (is_numeric($slug)){ $slug .= strtolower(date('F')); }
    return $slug;
}
function passportInfo($pinfl){
    //config ga token va auth_token yoziladi
    $token = 'blabla';
    $auth_token = "test";
    $data = [
        "method" => "connect.pinfl",
        "params" => array(
            "token" => $token,
            "pinfl" => $pinfl,
        )
    ];
    $data_json = json_encode($data);
    $log_id = DB::table('desk_logs')
        ->insertGetId([
            'pinfl' => $pinfl,
            'request' => $data_json,
            'status' => '0'
        ]);
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://desk.e-invoice.uz/app",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30000,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data_json,
        CURLOPT_HTTPHEADER => array(
            "Authorization: $auth_token",
            "content-type: application/json",
        ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if (isset($err)) {
        $info['status'] = '2';
        $info['http_code'] = 403;
        $info['response'] = $err;
        $send = ['error' => $err];
    }
    $result = json_decode($response, true);
    $result['log_id'] = $log_id;
    return $result;
}
function webValidator($request, $options){
    $validator = Validator::make($request->all(), $options);
    if ($validator->fails()) {
        return $validator->messages();
    }else{
        return true;
    }
}

