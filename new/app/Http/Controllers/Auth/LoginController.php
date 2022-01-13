<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\DeskLogs;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
}
