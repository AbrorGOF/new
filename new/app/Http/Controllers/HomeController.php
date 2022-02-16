<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ReportJournal;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = array();
        $patients = ReportJournal::where('user_id', Auth::id())->count();
        $sertificate = Certificate::where('nurse_id', '=', Auth::id())->first();
        $data['patient_count'] = $patients;
        if (isset($sertificate->date)) {
            $data['start_date'] = $sertificate->date;
            $data['end_date'] = $sertificate->end_date;
        }else{
            $data['start_date'] = '';
            $data['end_date'] = '';
        }

        return view('home', compact('data'));
    }
    public function welcome()
    {
        return view('welcome');
    }
}
