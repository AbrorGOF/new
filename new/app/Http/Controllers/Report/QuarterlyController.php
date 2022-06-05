<?php


namespace App\Http\Controllers\Report;


use App\Http\Controllers\Controller;
use App\Models\ReportCategories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuarterlyController extends Controller
{
    public function index($id = false)
    {
        return view('report.quarterly');
    }

    public function viewPdf($id = false)
    {
        $year = date('Y');
        $user_id = ($id !== false) ? $id : Auth::id();
        $categories = ReportCategories::with(['quarterlies'=>function($q) use ($user_id,$year){
            $q->where('user_id', '=',$user_id);
            $q->where('year','=',$year);
        }])->orderBy('type', 'asc')->get();
        return view('report.pdf', compact('categories', 'id'));
    }

    public function createPdf($id)
    {
      $year = date('Y');
      $user_id = Auth::id();
      $categories = ReportCategories::with(['quarterlies'=>function($q) use ($user_id,$year){
        $q->where('user_id', '=',$user_id);
        $q->where('year','=',$year);
      }])->orderBy('type', 'asc')->get();
        if ($categories) {
            view()->share('client', $categories);
            $pdf = PDF::loadView('client_pdf', $categories);

            // download PDF file with download method
            return $pdf->download(Auth::id() . '.pdf');
        } else {
            abort(404, 'Client not found!');
        }
    }

  public function getInfo(): \Illuminate\Http\JsonResponse
  {
    $year = date('Y');
    $user_id = Auth::id();
    $categories = ReportCategories::with(['quarterlies'=>function($q) use ($user_id,$year){
      $q->where('user_id', '=',$user_id);
      $q->where('year','=',$year);
    }])->orderBy('type', 'asc')->get();
    return response()->json($categories);
  }
}
