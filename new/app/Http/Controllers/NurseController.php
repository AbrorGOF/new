<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Diplom;
use App\Models\Doctor;
use App\Models\Nurse;
use App\Models\NurseActionLog;
use App\Models\NurseCancel;
use App\Models\NurseReferences;
use App\Models\Polyclinic;
use App\Models\TrainingCenter;
use App\Models\User;
use App\Models\Worker;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use stdClass;
use Yajra\DataTables\Facades\DataTables;

class NurseController extends Controller
{
    public function index(){
      $polyclinics = Polyclinic::get();
      $centers = TrainingCenter::get();
      $regions = DB::table('regions')->get();
      $colleges = DB::table('colleges')->get();
      $categories = DB::table('categories')->get();
        return view('nurse.list',
          compact(
            'regions',
            'polyclinics',
            'centers',
            'categories',
            'colleges'
          )
        );
    }
    public function NurseList(Request $request){
      $user_id = Auth::id();
      $user_type = Auth::user()->type;
      if ($user_type == 'doctor'){
        $doctor = Doctor::where('user_id', $user_id)->first();
        $data = Nurse::with('phone')->where('polyclinic_id', $doctor->polyclinic_id)->get();
      }elseif ($user_type == 'worker'){
        $worker = Worker::where('user_id', $user_id)->first();
        $data = Nurse::with('phone')->where('region_id', $worker->region_id)->get();
      }elseif ($user_type == 'admin'){
          $data = Nurse::with('phone')->get();
      }
      return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('full_name', function ($row) {
          return $row->surname . ' ' . $row->name . ' ' . $row->patronymic;
        })
        ->make(true);
    }
    public function NurseAdd(Request $request){
      $options = [
          'name' => 'required|max:255',
          'surname' => 'required',
          'patronymic' => 'required',
          'passport' => 'required|unique:nurses',
          'pinfl' => 'required|unique:nurses',
          'birth_date' => 'required',
          'degree' => 'required',
          'diploma_institution' => 'required',
          'diploma_number' => 'required',
          'diploma_date' => 'required',
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
        $user->parent_id = Auth::id();
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
        $certificate->file = 'storage/certificates/'.$certificate_filename;
        $certificate->save();

        $action_log = new NurseActionLog();
        $action_log->user_id  = Auth::id();
        $action_log->nurse_id = $nurse->id;
        $action_log->action = 'create';
        $action_log->save();

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
        return redirect()->back()->with(['message'=>$e->getMessage()]);
      }
      return redirect()->back()->with(['message'=>'success']);
    }
    public function view($id)
    {
      $user_id = Auth::id();
      $user_type = Auth::user()->type;
      $nurse = new stdClass();
      $diploma = new stdClass();
      $certificate = new stdClass();
      if ($user_type == 'doctor'){
        $doctor = Doctor::where('user_id', $user_id)->first();
        $nurse = Nurse::leftJoin('categories', 'nurses.category_id', '=', 'categories.id')
          ->leftJoin('regions', 'nurses.region_id', '=', 'regions.id')
          ->leftJoin('polyclinics', 'nurses.polyclinic_id', '=', 'polyclinics.id')
          ->leftJoin('users', 'nurses.user_id', '=', 'users.id')
          ->select('nurses.*', 'categories.title as category_title', 'regions.title as region_title', 'polyclinics.title as polyclinic_title', 'users.status as user_status')
          ->where('nurses.id', $id)
          ->where('nurses.polyclinic_id', $doctor->polyclinic_id)
          ->first();
        $diploma = Diplom::where('nurse_id', $id)->first();
        $certificate = Certificate::where('nurse_id', $id)->first();
      }elseif ($user_type == 'worker'){
        $worker = Worker::where('user_id', $user_id)->first();
        $nurse = Nurse::leftJoin('categories', 'nurses.category_id', '=', 'categories.id')
          ->leftJoin('regions', 'nurses.region_id', '=', 'regions.id')
          ->leftJoin('polyclinics', 'nurses.polyclinic_id', '=', 'polyclinics.id')
          ->leftJoin('users', 'nurses.user_id', '=', 'users.id')
          ->select('nurses.*', 'categories.title as category_title', 'regions.title as region_title', 'polyclinics.title as polyclinic_title', 'users.status as user_status')
          ->where('nurses.id', $id)
          ->where('nurses.region_id', $worker->region_id)
          ->first();
      }elseif ($user_type == 'admin'){
        $nurse = Nurse::leftJoin('categories', 'nurses.category_id', '=', 'categories.id')
          ->leftJoin('regions', 'nurses.region_id', '=', 'regions.id')
          ->leftJoin('polyclinics', 'nurses.polyclinic_id', '=', 'polyclinics.id')
          ->leftJoin('users', 'nurses.user_id', '=', 'users.id')
          ->select('nurses.*', 'categories.title as category_title', 'regions.title as region_title', 'polyclinics.title as polyclinic_title', 'users.status as user_status')
          ->where('nurses.id', $id)
          ->first();
        $diploma = Diplom::where('nurse_id', $id)->first();
        $certificate = Certificate::where('nurse_id', $id)->first();
      }else{
        return redirect()->back();
      }

      return view('nurse.view', compact('nurse', 'diploma', 'certificate'));
    }
    public function cancel(Request $request, $id): \Illuminate\Http\JsonResponse
    {
      DB::beginTransaction();
      try {

        $log = new NurseActionLog();
        $log->nurse_id = $id;
        $log->user_id = Auth::id();
        $log->action = 'cancel';
        $log->reason = $request->reason;
        $log->save();

        $nurse = Nurse::findOrFail($id);
        $nurse->status = 'canceled';
        $nurse->save();

        $user = User::findOrFail($nurse->user_id);
        $user->status = 'canceled';
        $user->save();
        DB::commit();
      }catch (\Exception $exception){
        return response()->json(
          [
            'message'=>$exception->getMessage(),
            'status'=>'error',
            'code'=>$exception->getCode()
          ]
        );
      }
      return response()->json(
        [
          'message'=>"Hamshira ma'lumotlari bekor qilindi!",
          'status'=>'canceled'
        ]
      );
    }
    public function accept($id): \Illuminate\Http\JsonResponse
    {
      DB::beginTransaction();
      try {

        $log = new NurseActionLog();
        $log->nurse_id = $id;
        $log->user_id = Auth::id();
        $log->action = 'accept';
        $log->save();

        $nurse = Nurse::findOrFail($id);

        $user = User::findOrFail($nurse->user_id);
        $user->status = 'active';
        $user->save();
        DB::commit();
      }catch (\Exception $exception){
        return response()->json(
          [
            'message'=>$exception->getMessage(),
            'status'=>'error',
            'code'=>$exception->getCode()
          ]
        );
      }
      return response()->json(
        [
          'message'=>"Hamshira ma'lumotlari qabul qilindi!",
          'status'=>'canceled'
        ]
      );
    }
    public function nurseCertificate(): \Illuminate\Http\JsonResponse
    {
        $id = Auth::id();
        $nurse = Nurse::where('user_id', $id)->first();
        $nurse_id = $nurse->id;
        $certificate = NurseReferences::where('nurse_id', $nurse_id)->first();
        $data['link'] = $certificate->file;
        $data['status'] = $certificate->status;
        return response()->json($data);
    }
}
