<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent;
use App\Models\Date;

Class DateHelper
{
    public function date($data)
    {
        // Henter datoer fra DB
        $date = DB::table('dates')->get();
        // Sjekker om $date er tom og returnerer feilmelding
        if ($date)
        {
            return "dato mangler";
        }
        else
        {
            // Formaterer datoen til dd.mm.yyyy fra yyyy-mm-dd
            $date = \Carbon\Carbon::parse($date[0]->$data)->format('d.m.Y');
            return $date;
        }

    }

    public function year()
    {
        // Henter datoer fra DB
        $getYear = DB::table('dates')->get();
        // Sjekker om $getYear er tom og returnerer feilmelding
        if ($getYear)
        {
            return "årstall mangler"; 
        }
        else
        {
            // Formaterer datoen til å kun vise år og legger året/neste år inn i et array
            $getYear = \Carbon\Carbon::parse($getYear[0]->start)->format('Y');
            $year = array('year' => $getYear, 'year1' => $getYear + 1); 
            return $year;
        }
    }

    public function update($request)
    {
        // Oppdaterer dato raden i DB
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