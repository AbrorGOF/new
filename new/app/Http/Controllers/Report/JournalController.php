<?php


namespace App\Http\Controllers\Report;


use App\Http\Controllers\Controller;
use App\Models\ReportJournal;
use App\Models\ReportQuarterly;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use stdClass;
use Yajra\DataTables\Facades\DataTables;

class JournalController extends Controller
{
    public function index($id = false)
    {
      $link = ($id === false) ? '/report/list' : '/report/journal/list/'.$id;
      $categories = DB::table('report_categories')->where('type', '!=', null)->get();
      return view('report.journal', compact('categories', 'link'));
    }
    public function list($id = false){
      $patients = new stdClass();
      if (Auth::user()->type == 'nurse'){
        $patients = ReportJournal::where('user_id', Auth::id())->get();
      }elseif (Auth::user()->type != 'nurse'){
          $patients = ReportJournal::where('user_id', $id)->get();
      }
      return Datatables::of($patients)
        ->addIndexColumn()
        ->make(true);
    }
    public function create(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'patient_full_name' => 'required|max:255',
            'patient_age' => 'required|integer',
            'patient_visit_time' => 'required',
            "patient_address" => "required|max:255",
            "doctor_full_name" => "required|max:255",
            "doctor_diagnosis" => "required|max:255",
            "treatment_name" => "required|max:255",
            "category_id" => "required|max:255",
            "others" => "max:255",
        ]);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return redirect()->back()->withErrors($messages)->withInput();
        }
        $journal = new ReportJournal();
        $journal->user_id = Auth::id();
        $journal->patient_full_name = $request->patient_full_name;
        $journal->patient_age = $request->patient_age;
        $journal->patient_visit_time = $request->patient_visit_time;
        $journal->patient_address = $request->patient_address;
        $journal->doctor_full_name = $request->doctor_full_name;
        $journal->doctor_diagnosis = $request->doctor_diagnosis;
        $journal->treatment_name = $request->treatment_name;
        $journal->category_id = $request->category_id;
        $journal->others = $request->others;
        if ($journal->save()) {
            $qr = getQuarterOfYear();
            $check = ReportQuarterly::where('user_id', Auth::id())
                ->where('category_id',$request->category_id)
                ->first();
            if (!empty($check)){
                $check = $check->toArray();
                $count = $check[$qr]+1;
                DB::table('report_quarterlies')->where('id', '=', $check['id'])->update(
                    [
                        $qr => $count,
                    ]
                );
            }else{
                DB::table('report_quarterlies')->insert([
                    [
                        'user_id' => Auth::id(),
                        'year' => date('Y'),
                        'category_id' => $request->category_id,
                        $qr => 1,
                    ]
                ]);
            }

        }
        return redirect()->route('report-journal');
    }
}
