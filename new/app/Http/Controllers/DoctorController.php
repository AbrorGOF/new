<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Polyclinic;
use App\Models\TrainingCenter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DoctorController extends Controller
{
    public function index(){
        $polyclinics = Polyclinic::get();
        $regions = DB::table('regions')->get();
        return view('doctor.list', compact('regions', 'polyclinics'));
    }
    public function DoctorList(Request $request){
        if ($request->ajax()) {
            $data = Doctor::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
    }
    public function DoctorAdd(Request $request){
        $options = [
            'name' => 'required|max:255',
            'surname' => 'required',
            'patronymic' => 'required',
            'passport' => 'required|unique:doctors',
            'pinfl' => 'required|unique:doctors',
            'birth_date' => 'required',
            'region_id' => 'required',
            'polyclinic_id' => 'required',
            'position' => 'required',
            'phone' => 'required|unique:users|max:12',
            'password' => 'required|min:8'
        ];
        $validator = webValidator($request, $options);
        if ($validator !== true){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = new User();
        $user->parent_id = Auth::id();
        $user->name = $request->name.' '.$request->surname;
        $user->phone = $request->phone;
        $user->type = 'doctor';
        $user->role = 1;
        $user->password = bcrypt($request->password);
        $user->save();
        $doctor = new Doctor();
        $doctor->user_id = $user->id;
        $doctor->name = $request->name;
        $doctor->surname = $request->surname;
        $doctor->patronymic = $request->patronymic;
        $doctor->position = $request->position;
        $doctor->passport = $request->passport;
        $doctor->pinfl = $request->pinfl;
        $doctor->region_id = $request->region_id;
        $doctor->polyclinic_id = $request->polyclinic_id;
        $doctor->save();
        return redirect()->back()->with(['message'=>'success']);
    }
}
