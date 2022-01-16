<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\DeskLogs;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function username()
    {
        return 'phone';
    }
    function logout()
    {
        Auth::logoutCurrentDevice();
        return redirect("login");
    }
    public function ConnectPinfl(Request $request)
    {
        $pinfl = $request->pinfl;
        if (is_numeric($pinfl) && strlen($pinfl) == 14) {
            //configda oy korsatilgan bo'ladi, agarda zapis bo'lsa va ko'rsatilgan
            //oydan oldingi ma'lumot bo'lsa actual bo'midi oyda status ozgaradi
            //keyin yangi malumot keladi
            $is_in_db = DB::table('desk_logs')
                ->where('pinfl', '=', $pinfl)
                ->where('status', '=', '1')
                ->first();
            if ($is_in_db) {
                return ['result' => json_decode($is_in_db->response)];
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
                    $info['status'] = '2';
                    $info['http_code'] = 403;
                    $info['response'] = $err;
                    $send = ['error' => $err];
                }

                $response = json_decode($response, true);
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
                    $send = ['result' => $info['response']];
                } else {
                    $info['status'] = '2';
                    $info['http_code'] = 101;
                    $info['response'] = $response;
                    $send = ['error' => 'Unexpected error'];
                }
                $Partner_log = DeskLogs::find($log_id);
                $Partner_log->update($info);
                return $send;
            }
        } else {
            return ['error' => 'Pinfl is incorrect!'];
        }

    }
    public function SelectOptions()
    {
        $data = array();
        $regions = DB::table('regions')->get();
        $cats = DB::table('categories')->get();
        $data['regions'] = $regions;
        $data['cats'] = $cats;
        return response()->json(['data'=>$data]);
    }

    protected function AuthReg(Request $request)
    {
        $check = checkNurse($request->region_id, $request->category_id, $request->passport);
        if (!empty($check['error'])){
            session(['check_cert'=> $check['error']['messages']]);
            return redirect()->back()->withErrors($check['error'])->withInput();
        }
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
            'diplom_file' => 'required|mimes:jpg,jpeg,png',
            'certificate_institution' => 'required|max:255',
            'certificate_number' => 'required|max:255',
            'certificate_date' => 'required',
            'certificate_file' => 'required|mimes:jpg,jpeg,png',
            'central_polyclinic' => 'required|max:255',
            'family_polyclinic' => 'required|max:255',
            'doctor_station' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return redirect()->back()->withErrors($messages)->withInput();
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

        $user->save();
        $user_id = $user->id;

        DB::table('user_diplomas')->insert([
            'user_id' => $user_id,
            'institution' => $request->institution,
            'number' => $request->diplom_number,
            'date' => date('Y-m-d', strtotime($request->diplom_date)),
            'file' => uploadFile($request->file('diplom_file')),
            'degree' => $request->degree,
        ]);
        DB::table('user_certificates')->insert([
            'user_id' => $user_id,
            'institution' => $request->certificate_institution,
            'number' => $request->certificate_number,
            'date' => date('Y-m-d', strtotime($request->certificate_date)),
            'file' => uploadFile($request->file('certificate_file')),
        ]);
        return redirect("login")->withSuccess('Telefon raqam va parol orqali kabinetga kirishingiz mumkin!');
    }
}
