<?php


namespace App\Http\Controllers\Report;


use App\Http\Controllers\Controller;
use App\Models\ReportCategories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuarterlyController extends Controller
{
    public function index()
    {
        return view('report.quarterly');
    }

    public function viewPdf()
    {
        $year = date('Y');
        $user_id = Auth::id();
        $categories = ReportCategories::with(['quarterlies'=>function($q) use ($user_id,$year){
            $q->where('user_id', '=',$user_id);
            $q->where('year','=',$year);
        }])->orderBy('type', 'asc')->get();
        return view('report.pdf', compact('categories'));
    }

    public function createPdf($id)
    {
        $client = Client::findOrFail($id);
        if ($client) {
            view()->share('client', $client);
            $pdf = PDF::loadView('client_pdf', $client);

            // download PDF file with download method
            return $pdf->download($client->id . '.pdf');
        } else {
            abort(404, 'Client not found!');
        }
    }
}
