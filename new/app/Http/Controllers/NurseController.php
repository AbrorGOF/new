<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Diplom;
use App\Models\Nurse;
use App\Models\NurseActionLog;
use App\Models\Polyclinic;
use App\Models\TrainingCenter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class NurseController extends Controller
{
    public function index(){
        $polyclinics = Polyclinic::get();
        $centers = TrainingCenter::get();
        $regions = DB::table('regions')->get();
        $categories = DB::table('categories')->get();
        return view('nurse.list', compact('regions', 'polyclinics', 'centers', 'categories'));
    }
    public function NurseList(Request $request){
        if ($request->ajax()) {
            $data = Nurse::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $button = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function NurseAdd(Request $request){
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
                dd($new_validator);
                return redirect()->back()->withErrors($new_validator)->withInput();
            }
        }

        $user = new User();
        $user->parent_id = Auth::id();
        $user->name = $request->name.' '.$request->surname;
        $user->phone = $request->phone;
        $user->type = 'nurse';
        $user->status = 'new';
        $user->role = 1;
        $user->password = bcrypt($request->password);
        $user->save();

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
        $diploma->college_id = $request->diploma_institution;
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

        $action_log = new NurseActionLog();
        $action_log->user_id  = Auth::id();
        $action_log->nurse_id = $nurse->id;
        $action_log->action = 'create';
        $action_log->save();
        return redirect()->back()->with(['message'=>'success']);
    }
}
