<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use App\Models\Date;

Class DateHelper
{
    public function date($data)
    {
        $date = DB::table('dates')->get();
        if ($date == NULL)
        {
            return "dato mangler"; 
        }
        $date = \Carbon\Carbon::parse($date[0]->$data)->format('d/m/Y');
        return $date;
    }

    public function year()
    {
        $getYear = DB::table('dates')->get();
        if ($getYear == NULL)
        {
            return "årstall mangler"; 
        }
        $getYear = \Carbon\Carbon::parse($getYear[0]->start)->format('Y');
        $year = array('year' => $getYear, 'year1' => $getYear + 1); 
        return $year; 
    }

    public static function update($request)
    {
        DB::update('UPDATE dates set start = :start, status_report = :status_report, project_sketch = :project_sketch, 
        preproject = :preproject, project_report = :project_report, pres_start = :pres_start, pres_end = :pres_end', 
        ['start' => $request->input('start'), 'status_report' => $request->input('status_report'), 'project_sketch' => $request->input('project_sketch'),
        'preproject' => $request->input('preproject'), 'project_report' => $request->input('project_report'), 'pres_start' => $request->input('pres_start'),
        'pres_end' => $request->input('pres_end')]);

        return 'Datoer er oppdatert';
    }

    public static function instance()
    {
        return new DateHelper();
    }
}