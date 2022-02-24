<?php

namespace App\Http\Controllers;

use App\Models\ReportJournal;
use App\Models\ReportQuarterly;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
/**
 * @group Report
 *
 * APIs for managing nurse actions
 */
class ReportController extends Controller
{
    public function getReference(): \Illuminate\Http\JsonResponse
    {
      return response()->json();
    }
  public function getPatients(): \Illuminate\Http\JsonResponse
  {
    $patients = ReportJournal::where('user_id', Auth::id())->get();
    return response()->json($patients);
  }
  public function createPatient(Request $request): \Illuminate\Http\JsonResponse
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
      foreach ($validator->errors()->toArray() as $key => $value) {
        $error['field_name'] = $key;
        $error['message'] = $value['0'];
        $errors[] = $error;
      }
      return response()->json([
        'errors' => $errors,
        'status' => Response::HTTP_BAD_REQUEST,
      ], Response::HTTP_BAD_REQUEST);
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
        DB::table('report_quarterlies')
          ->where('id', '=', $check['id'])
          ->update([$qr => $count]);
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
    return response()->json(['success' => ['message' => 'patient created successfully!']]);
  }
}
