<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Exception\BadResponseException;


class PassportController extends Controller
{
    public function login(Request $request)
    {
        $errors = array();
        $validator = Validator::make($request->all(), [
            'phone' => 'required|min:12|max:12',
            'password' => 'required|min:8',
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

        $credentials = [
            'phone' => $request->phone,
            'password' => $request->password
        ];
        if (Auth()->attempt($credentials,$request->remember)) {
            $client = new Client();
            $phone = $request->phone;
            $password = $request->password;

            try {
                $response = $client->post(config('services.passport.login_endpoint'), [
                    'form_params' => [
                        'grant_type' => 'password',
                        'client_id' => config('services.passport.client_id'),
                        'client_secret' => config('services.passport.client_secret'),
                        'username' => $phone,
                        'password' => $password,
                        'scope'=>'*'
                    ]
                ]);
                return $response->getBody();

            } catch (BadResponseException $exception) {

                if ($exception->getCode() == 400) {
                    return response()->json('Invalid request. Please enter a username and a password', $exception->getCode());
                } else if ($exception->getCode() == 400) {
                    return response()->json('Your credentials are incorrect. Please try again', $exception->getCode());
                }
                return response()->json('Something went wrong on the server'.$exception, $exception->getCode());
            } catch (GuzzleException $e) {
                return $e;
            }
        }else{
            return response()->json(['error'=>['message'=>'Invalid phone or password']], 400);
        }
    }
    public function logout(Request $request): \Illuminate\Http\JsonResponse
    {
        auth()->user()->tokens()->each(function ($token,$key){
            $token->delete();
        });
        return response()->json(['success'=>'User logged out successfully!'], 200);
    }
    public function detail(): \Illuminate\Http\JsonResponse
    {
        return response()->json(['user'=>auth()->user()], 200);
    }
    public function refreshToken(Request $request) {
        $http =new Client();
        try {
            $response = $http->post(config('services.passport.login_endpoint'), [
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $request->refresh_token,
                    'client_id' => config('services.passport.client_id'),
                    'client_secret' => config('services.passport.client_secret'),
                    'scope' => '',
                ],
            ]);
            return $response->getBody();
        } catch (BadResponseException $exception) {

            if ($exception->getCode() == 400) {
                return response()->json('Invalid request. Please enter a username and a password', $exception->getCode());
            } else if ($exception->getCode() == 401) {
                return response()->json('Your credentials are incorrect. Please try again', $exception->getCode());
            }
            return response()->json('Something went wrong on the server'.$exception, $exception->getCode());
        } catch (GuzzleException $e) {
            return $e;
        }
    }
    public function checkUserTokens(): \Illuminate\Http\JsonResponse
    {
        $access = DB::table('oauth_access_tokens')
            ->where('user_id','=', Auth::id())
            ->first();
        $exp = strtotime($access->expires_at);
        $cur = strtotime(date('d.m.Y H:i:s'));
        if ($exp == $cur){
            $access_token['access_expired'] = 1;
            $access_token['expires_at'] = $exp;
        }else{
            $access_token['access_expired'] = 0;
            $access_token['expires_at'] = $exp;
        }
        $refresh = DB::table('oauth_refresh_tokens')
            ->where('access_token_id','=', $access->id)
            ->first();
        $exp_ref = strtotime($refresh->expires_at);
        if ($exp_ref == $cur){
            $refresh_token['refresh_expired'] = 1;
            $refresh_token['expires_at'] = $exp_ref;
        }else{
            $refresh_token['refresh_expired'] = 0;
            $refresh_token['expires_at'] = $exp_ref;
        }
        return response()->json([
            'access_token' => $access_token,
            'refresh_token' =>$refresh_token,
            'status' => 200,
        ], 200);
    }
}
