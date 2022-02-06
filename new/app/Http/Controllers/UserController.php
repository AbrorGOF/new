<?php

namespace App\Http\Controllers;

use App\Models\DeskLogs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function AuthReg(Request $request)
    {
        $errors = array();
        $request->phone = str_replace(array('+','(',')',' ','-'),'',$request->phone);
        $request->pinfl = str_replace(array('+','(',')',' ','-'),'',$request->pinfl);
        $request->passport = str_replace(array('+','(',')',' ','-'),'',$request->passport);
        $validator=Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'patronym' => 'string|max:255',
            'phone' => 'required|unique:users',
            'user_type' => [Rule::in('worker', 'nurse')],
            'role' => 'string',
            'password' => 'required|confirmed:min:8',
            'pinfl' => 'unique:users|unique:users',
            'passport' => 'unique:users|unique:users',
            'region_id' => 'required|integer',
            'category_id' => 'required|integer',
            'institution' => 'required|max:255',
            'diplom_number' => 'required|max:255',
            'diplom_date' => 'required',
            'degree' => [Rule::in('1', '2')],
            'diplom_file' => 'mimes:jpg,jpeg,png',
            'certificate_institution' => 'required|max:255',
            'certificate_number' => 'required|max:255',
            'certificate_date' => 'required',
            'certificate_file' => 'mimes:jpg,jpeg,png',
            'central_polyclinic' => 'required|max:255',
            'family_polyclinic' => 'required|max:255',
            'doctor_station' => 'required|max:255',
            'reference' => 'mimes:pdf',
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->toArray() as $key => $value) {
                $error['field_name'] = $key;
                $error['message'] = $value['0'];
                $errors[] = $error;
            }
            return response()->json([
                'errors' => $errors,
                'status' => Response::HTTP_BAD_REQUEST,
            ], Response::HTTP_BAD_REQUEST);
        }

        $user = new User();
        $user->phone = $request->phone;
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->patronym = $request->patronym;
        $user->type = $request->user_type;
        $user->category_id = $request->category_id;
        $user->region_id = $request->region_id;
        $user->role = $request->role;
        $user->password = bcrypt($request->password);
        $user->pinfl = $request->pinfl;
        $user->passport = $request->passport;
        $user->central_polyclinic = $request->central_polyclinic;
        $user->family_polyclinic = $request->family_polyclinic;
        $user->doctor_station = $request->doctor_station;
        $path = $request->file('reference')->storeAs('storage/references', $user->passport.'.pdf');
        $user->reference = $path;
        if ($user->save()){
            $user_id = $user->id;
            DB::table('user_diplomas')->insert([
                'user_id' => $user_id,
                'institution' => $request->institution,
                'number' => $request->diplom_number,
                'date' => date('Y-m-d', strtotime($request->diplom_date)),
                'file' => '/sasass',
                'degree' => $request->degree,
            ]);
            DB::table('user_certificates')->insert([
                'user_id' => $user_id,
                'institution' => $request->certificate_institution,
                'number' => $request->certificate_number,
                'date' => date('Y-m-d', strtotime($request->certificate_date)),
                'end_date' => date("Y-m-d", strtotime(date("Y-m-d", strtotime($request->certificate_date)) . " + 3 year")),
                'file' => '/sasass',
            ]);
            return response()->json(
                [
                    'message' => 'User created successfully! Phone number for login.',
                    'phone' => $user->phone
                ], 200
            );
        }else{
            return response()->json([
                'errors' => array(0 =>array('message' => 'Error creating new user!')),
                'status' => Response::HTTP_BAD_REQUEST,
            ], Response::HTTP_BAD_REQUEST);
        }

    }
    public function ConnectPinfl(Request $request)
    {
        $pinfl = $request->pinfl;
        $category_id = $request->category_id;
        $region_id = $request->region_id;
        if (is_numeric($pinfl) && strlen($pinfl) == 14) {
            $is_in_db = DeskLogs::where('pinfl', '=', $pinfl)
                ->where('status', '=', '1')
                ->first();
            if ($is_in_db) {
                $desk = json_decode($is_in_db->response, true);
                $passport = $desk['passSeries'].$desk['passNumber'];
                $nurse = checkNurse($region_id, $category_id, $passport);
                if (isset($nurse['success'])){
                    $send = [
                        'desk' => $desk,
                        'imedic' => $nurse['success'][0]
                    ];
                }else{
                    $send = $nurse['error']['messages'];
                }
            } else {
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
                    $send['error'] = $err;
                }

                $response = json_decode($response, true);
                unset($response['jsonrpc']);
                unset($response['method']);
                if (!empty($response['error'])) {
                    $send['error'] = $response['error']['message'];
                }elseif (!empty($response['result'])) {
                    $info['status'] = '1';
                    $info['http_code'] = 200;
                    $info['response'] = $response['result'];
                    $result = $info['response'];
                    $passport = $result['passSeries'].$result['passNumber'];
                    $nurse = checkNurse($region_id, $category_id, $passport);
                    if (isset($nurse['success'])){
                        $send = [
                            'desk' => $info['response'],
                            'imedic' => $nurse['success']
                        ];
                    }else{
                        $send['error'] = $nurse['error']['messages'];
                    }
                } else {
                    $send['error'] = 'Unexpected error!';
                }
                $Partner_log = DeskLogs::find($log_id);
                $Partner_log->update($info);
            }
        } else {
            $send['error'] = 'Pinfl is incorrect!';
        }
        if (!empty($send['error'])){
            return response()->json([
                'errors' => array(0 =>array('message' => $send['error'])),
                'status' => Response::HTTP_BAD_REQUEST,
            ], Response::HTTP_BAD_REQUEST);
        }else{
            return  response()->json($send, 200);
        }
    }
    public function getRegions()
    {
        $regions = DB::table('regions')->get();
        return response()->json($regions);
    }
    public function getCategories()
    {
        $cats = DB::table('categories')->get();
        return response()->json($cats);
    }

}
