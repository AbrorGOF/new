<?php

namespace App\Http\Controllers;

use App\Models\TrainingCenter;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class WorkerController extends Controller
{
    public function index(){
        $centers = TrainingCenter::get();
        $regions = DB::table('regions')->get();
        return view('worker.list', compact('centers', 'regions'));
    }
    public function WorkerList(Request $request){
        if ($request->ajax()) {
            $data = Worker::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
    }
    public function WorkerAdd(Request $request){
        $options = [
            'name' => 'required|max:255',
            'surname' => 'required',
            'patronymic' => 'required',
            'passport' => 'required|unique:workers',
            'pinfl' => 'required|unique:workers',
            'birth_date' => 'required',
            'region_id' => 'required',
            'training_center_id' => 'required',
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
        $user->type = 'worker';
        $user->role = 1;
        $user->password = bcrypt($request->password);
        $user->save();
        $worker = new Worker();
        $worker->user_id = $user->id;
        $worker->name = $request->name;
        $worker->surname = $request->surname;
        $worker->patronymic = $request->patronymic;
        $worker->position = $request->position;
        $worker->passport = $request->passport;
        $worker->pinfl = $request->pinfl;
        $worker->region_id = $request->region_id;
        $worker->training_center_id = $request->training_center_id;
        $worker->save();
        return redirect()->back()->with(['message'=>'success']);
    }
}
