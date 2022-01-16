<?php

use Illuminate\Support\Facades\DB;

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
