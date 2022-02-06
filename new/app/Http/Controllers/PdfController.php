<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{
    public function new(){
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML('<h1>Test</h1>');
        return $pdf->stream();
    }
    public function downloadReference(): \Illuminate\Http\Response
    {
        $date = getDateInLatin(Auth::user()->created_at);
        view()->share('date', $date);
        $address = getAddress(Auth::user()->pinfl);
        view()->share('address', $address);
        $qrcode = 'Hamshira: '.Auth::user()->name.' '.Auth::user()->surname.' Pasport: '.Auth::user()->passport.' Berilgan sana: '.date('d.m.Y', strtotime(Auth::user()->created_at));
        view()->share('qrcode', $qrcode);
        $pdf = PDF::loadView('reference');
        return $pdf->download('reference.pdf');
    }
    public function viewReference(){
        $user =User::findOrFail(Auth::id());
        if (Storage::exists('public/references/'.$user->passport.'.pdf')){
            if (isset($user->reference)){
                $user->reference = 'storage/references/'.$user->passport.'.pdf';
                $user->save();
            }
        }else{
            $date = getDateInLatin($user->created_at);
            view()->share('date', $date);
            $address = getAddress(Auth::user()->pinfl);
            view()->share('address', $address);
            $qrcode = 'Hamshira: '.Auth::user()->name.' '.Auth::user()->surname.' Pasport: '.Auth::user()->passport.' Berilgan sana: '.date('d.m.Y', strtotime(Auth::user()->created_at));
            view()->share('qrcode', $qrcode);
            $pdf = PDF::loadView('reference');
            $path ='public/references/'.$user->passport.'.pdf';
            Storage::put($path, $pdf->output());
            $user->reference = 'storage/references/'.$user->passport.'.pdf';
            $user->save();
        }
        return view('pdf.reference');
    }
}
