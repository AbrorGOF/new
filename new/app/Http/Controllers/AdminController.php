<?php

namespace App\Http\Controllers;

use App\Models\DeskLogs;
use App\Models\Polyclinic;
use App\Models\TrainingCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        foreach ($request->all() as $item)
        {
            $clinic = new Polyclinic();
            $clinic->okpo = $item['g1'];
            $clinic->tin = $item['g2'];
            $clinic->full_title = $item['g3'];
            $clinic->short_title = $item['g4'];
            $clinic->csdp = $item['g5'];
            $clinic->soato = $item['g6'];
            $clinic->address = $item['g7'];
            $clinic->street = $item['g8'];
            $clinic->phone = $item['g9'];
            $clinic->email = $item['g11'];
            $clinic->oked = $item['g12'];
            $clinic->soogu = $item['g13'];
            $clinic->ptp = $item['g14'];
            $clinic->prize = $item['g15'];
            $clinic->save();
        }
        return view('admin.index');
    }
    public function PolyclinicIndex()
    {
        $centers = TrainingCenter::get();
        $regions = DB::table('regions')->get();
        return view('admin.polyclinic', compact('centers', 'regions'));
    }
    public function PolyclinicList(Request $request)
    {
        if ($request->ajax()) {
            $data = Polyclinic::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
    }
    public function PolyclinicAdd(Request $request)
    {
        $options = [
            'title' => 'required',
            'address' => 'required',
            'phone'  => 'required',
            'training_center_id'  => 'required',
            'region_id'  => 'required'
        ];
        $validator = webValidator($request, $options);
        if ($validator !== true){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $polyclinic = new Polyclinic();
        $polyclinic->title = $request->title;
        $polyclinic->address = $request->address;
        $polyclinic->phone = $request->phone;
        $polyclinic->training_center_id = $request->training_center_id;
        $polyclinic->region_id = $request->region_id;
        $polyclinic->user_id = Auth::id();
        $polyclinic->save();
        return redirect()->back()->with(['message'=>'success']);
    }
    public function TrainingCenterIndex(){
        return view('admin.training_center');
    }
    public function TrainingCenterList(Request $request){
        if ($request->ajax()) {
            $data = TrainingCenter::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
    }
    public function TrainingCenterAdd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'address' => 'required',
            'phone'  => 'required',
            'director'  => 'required'
        ]);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return redirect()->back()->withErrors($messages)->withInput();
        }
        $center = new TrainingCenter();
        $center->title = $request->title;
        $center->address = $request->address;
        $center->phone = $request->phone;
        $center->director = $request->director;
        $center->save();
        return redirect()->back()->with(['message'=>'success']);
    }
    public function getInfo(Request $request)
    {
        $pinfl = $request->pinfl;
        if (is_numeric($pinfl) && strlen($pinfl) == 14) {
            $is_in_db = DeskLogs::
                where('pinfl', '=', $pinfl)
                ->where('status', '=', '1')
                ->first();
            if ($is_in_db) {
                return array('success' => json_decode($is_in_db->response, true));
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
                    $send['success'] = $response['result'];
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
