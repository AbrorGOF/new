<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\DeskLogs;
use App\Models\Diplom;
use App\Models\Nurse;
use App\Models\NurseReferences;
use App\Models\Polyclinic;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
        $category_id = $request->cat_id;
        $region_id = $request->reg_id;
        if (is_numeric($pinfl) && strlen($pinfl) == 14) {
            //configda oy korsatilgan bo'ladi, agarda zapis bo'lsa va ko'rsatilgan
            //oydan oldingi ma'lumot bo'lsa actual bo'midi oyda status ozgaradi
            //keyin yangi malumot keladi
            $is_in_db = DB::table('desk_logs')
                ->where('pinfl', '=', $pinfl)
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
                    $send['error'] = $nurse['error']['messages'];
                }
                return $send;
            } else {
                $response = passportInfo($pinfl);
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
    public function AuthLog(Request $request){
        $validator=Validator::make($request->all(), [
            'phone' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return redirect()->back()->withErrors($messages)->withInput();
        }
        $credentials = $request->only('phone', 'password');
        $credentials['phone']=str_replace(array('+','(',')',' ','-'),'',$credentials['phone']);

        if (Auth::attempt($credentials,$request->get('remember'))) {
            return redirect()->route('home');
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }
    protected function AuthReg(Request $request)
    {
        $request->phone = str_replace(array('+','(',')',' ','-'),'',$request->phone);
        $request->pinfl = str_replace(array('+','(',')',' ','-'),'',$request->pinfl);
        $request->passport = str_replace(array('+','(',')',' ','-'),'',$request->passport);
        $options = [
            'name' => 'required|max:255',
            'surname' => 'required',
            'patronymic' => 'required',
            'passport' => 'required|unique:doctors',
            'pinfl' => 'required|unique:doctors',
            'birth_date' => 'required',
            'degree' => 'required',
            'diploma_institution' => 'required',
            'diploma_number' => 'required',
            'diploma_date' => 'required',
            'diploma_file' => 'required',
            'partner_polyclinic' => 'required',
            'category_id' => 'required',
            'area' => 'required',
            'licence_file' => 'required',
            'phone' => 'required|unique:users|max:12',
            'password' => 'required|min:8'
        ];
        $validator = webValidator($request, $options);
        if ($validator !== true){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $start = Carbon::parse($request->diploma_date);
        $end =  Carbon::parse(date('d.m.Y'));
        $days = $end->diffInDays($start);
        if ($days>1095){
            $new_options = [
                'certificate_number' => 'required|max:255',
                'certificate_institution' => 'required',
                'certificate_date' => 'required',
                'certificate_file' => 'required',
            ];
            $new_validator = webValidator($request, $new_options);
            if ($new_validator !== true){
                return redirect()->back()->withErrors($new_validator)->withInput();
            }
        }
        DB::beginTransaction();
        try {

          $user = new User();
          $user->name = $request->name.' '.$request->surname;
          $user->phone = $request->phone;
          $user->type = 'nurse';
          $user->status = 'new';
          $user->role = 1;
          $user->password = bcrypt($request->password);
          $user->save();

          $college_id = DB::table('colleges')->insertGetId([
            'title' => $request->diploma_institution,
            'region_id' => 1,
            'user_id' => $user->id
          ]);

          $licence_file = $request->file('licence_file');
          $licence_filename = 'nurse_licence_' . time() . '.' . $licence_file->getClientOriginalExtension();
          $licence_path = $licence_file->storeAs('public/licences', $licence_filename);
          $nurse = new Nurse();
          $nurse->user_id = $user->id;
          $nurse->name = $request->name;
          $nurse->surname = $request->surname;
          $nurse->patronymic = $request->patronymic;
          $nurse->area = $request->area;
          $nurse->passport = $request->passport;
          $nurse->pinfl = $request->pinfl;
          $nurse->category_id = $request->category_id;
          $nurse->licence = $licence_path;
          $nurse->region_id = '1';
          $nurse->polyclinic_id = $request->partner_polyclinic;
          $nurse->save();

          $diploma_file = $request->file('diploma_file');
          $diploma_filename = 'nurse_diploma_' . time() . '.' . $diploma_file->getClientOriginalExtension();
          $diploma_path = $diploma_file->storeAs('public/diplomas', $diploma_filename);

          $diploma = new Diplom();
          $diploma->nurse_id = $nurse->id;
          $diploma->college_id = $college_id;
          $diploma->number = $request->diploma_number;
          $diploma->date = date('Y-m-d', strtotime($request->diploma_date));
          $diploma->file =  $diploma_path;
          $diploma->degree = $request->degree;
          $diploma->save();

          $certificate_file = $request->file('certificate_file');
          $certificate_filename = 'nurse_certificate_' . time() . '.' . $certificate_file->getClientOriginalExtension();
          $certificate_path = $certificate_file->storeAs('public/certificates', $certificate_filename);

          $certificate = new Certificate();
          $certificate->nurse_id = $nurse->id;
          $certificate->training_center_id = $request->certificate_institution;
          $certificate->number = $request->certificate_number;
          $certificate->date = date('Y-m-d', strtotime($request->certificate_date));
          $certificate->end_date = date("Y-m-d", strtotime(date("Y-m-d", strtotime($request->certificate_date)) . " + 3 year"));
          $certificate->file = $certificate_path;
          $certificate->save();

          $name = 'nurse_reference_' . time() . '.pdf';
          $link = 'storage/references/'.$name;
          $date = getDateInLatin($nurse->created_at);
          $address = getAddress($nurse->pinfl);
          $polyclinic = Polyclinic::findOrFail($nurse->polyclinic_id);
          $qrcode = 'Hamshira: '.$nurse->name.' '.$nurse->surname.' Pasport: '.$nurse->passport.' Berilgan sana: '.date('d.m.Y', strtotime($nurse->created_at));
          view()->share('date', $date);
          view()->share('nurse', $nurse);
          view()->share('address', $address);
          view()->share('qrcode', $qrcode);
          view()->share('polyclinic', $polyclinic);
          $pdf = PDF::loadView('reference');
          $path ='public/references/'.$name;
          Storage::put($path, $pdf->output());
          $nurse->reference = $link;
          $nurse->save();

          $reference = new NurseReferences();
          $reference->user_id = $nurse->user_id;
          $reference->nurse_id = $nurse->id;
          $reference->file = $link;
          $reference->status = 'active';
          $reference->save();
          DB::commit();
        }catch (\Exception $e){
          return redirect()->back()->withErrors($e->getMessage());
        }
        return redirect("login")->withSuccess('Telefon raqam va parol orqali kabinetga kirishingiz mumkin!');
    }
}
