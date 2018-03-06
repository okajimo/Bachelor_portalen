<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Date;

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

    public function datoEndring(request $request)
    {
        $this->validate($request, [
            'start' => 'required|date',
            'status_report' => 'required|date',
            'project_sketch' => 'required|date',
            'preproject' => 'required|date',
            'project_report' => 'required|date',
            'pres_start' => 'required|date',
            'pres_end' => 'required|date',
        ]);
        
        $update = \DateHelper::instance()->update($request);
        return redirect('/datoVedlikehold')->with('success', $update);
    }
}
