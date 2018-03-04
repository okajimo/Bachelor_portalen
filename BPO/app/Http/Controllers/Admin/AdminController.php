<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function showDateMaintenance()
    {
        if(session('levell') >= 2)
        {
            $title = "Dato vedlikehold";
            $date = DB::select('SELECT * FROM dates');
            return view('pages.admin.datoVedlikehold')->with(['title' => $title, 'date' => $date]);
        }
        else
        {
            return redirect('/')->with('error', 'Du er ikke admin og har ikke tilgang');
        }
    }

    public function dateUpdater()
    {
        
    }
}
