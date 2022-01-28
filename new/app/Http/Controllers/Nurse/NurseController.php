<?php
namespace App\Http\Controllers\Nurse;

use App\Http\Controllers\Controller;
use App\Models\User;

class NurseController extends Controller
{
    public function list()
    {
        $nurses = User::where('type', '=', null)->paginate(10);
        return view('nurse.list', compact('nurses'));
    }
}
