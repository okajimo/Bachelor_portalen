<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Date;

class DateController extends Controller
{
    public function showDateMaintenance()
    {
        if(session('levell') >= 2)
        {
            $title = "Datoer";

            $data = DB::select('SELECT * FROM dates');
            if (empty($data))
            {
                $dates = 'mangler';
            }
            else
            {
                $dates = $data;   
            }
            return view('pages.admin.dato')->with(['title' => $title, 'dates' => $dates]);
        }
        else
        {
            return redirect('/')->with('error', 'Du er ikke admin og har ikke tilgang');
        }
    }

    public function createDate(request $request)
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

        $create = \DateHelper::instance()->create();
        return redirect('/dato')->with('success', $create);
    }

    public function editDate(request $request)
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
        return redirect('/dato')->with('success', $update);
    }
}
