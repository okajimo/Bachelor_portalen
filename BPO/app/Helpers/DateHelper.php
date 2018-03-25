<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent;
use App\Models\Date;
use Illuminate\Support\Facades\input;

Class DateHelper
{
    /**
     * Funksjon for å hente og formatere dato for bruk på statiske sider
     * Formaterer datoen til dd.mm.yyyy fra yyyy-mm-dd
     * 
     * $data string (valg av felt i DB)
     */
    
    public function date($data)
    {
        $date = DB::table('dates')->get();
        if ($date->count() == 0)
        {
            return "dato mangler";
        }
        else
        {
            $date = \Carbon\Carbon::parse($date[0]->$data)->format('d.m.Y');
            return $date;
        }

    }

    /**
     * Funksjon for å hente og formatere år for bruk på statiske sider
     * 
     */
    public function year()
    {
        $getYear = DB::table('dates')->get();
        if ($getYear->count() == 0)
        {
            return "årstall mangler"; 
        }
        else
        {
            $getYear = \Carbon\Carbon::parse($getYear[0]->start)->format('Y');
            $year = array('year' => $getYear, 'year1' => $getYear + 1); 
            return $year;
        }
    }

    /**
     * Funksjon for å opprette datoene i DB
     * 
     * $request object
     */
    public function create()
    {
        DB::connection()->enableQueryLog();
        $array = array();
        $data = Input::except('_token');
        foreach ($data as $key => $value)
        {
            $format = \Carbon\Carbon::createFromFormat('d.m.Y', $value);
            $value = $format->format('Y-m-d');
            $array[$key] = $value;
        }
        
        $date = new Date;
        $date->start = $array['start'];
        $date->status_report = $array['status_report'];
        $date->project_sketch = $array['project_sketch'];
        $date->preproject = $array['preproject'];
        $date->project_report = $array['project_report'];
        $date->pres_start = $array['pres_start'];
        $date->pres_end = $array['pres_end'];
        $date->save();
        return 'Datoer er lagret';
    }

    /**
     * Funksjon for å oppdatere 'dates' tabellen i DB
     * 
     * $request object
     */
    public function update($request)
    {
        DB::connection()->enableQueryLog();
        $array = array();
        $data = Input::except('_token');
        foreach ($data as $key => $value)
        {
            $format = \Carbon\Carbon::createFromFormat('d.m.Y', $value);
            $value = $format->format('Y-m-d');
            $array[$key] = $value;
        }
        DB::update('UPDATE dates SET start = :start, status_report = :statusreport, project_sketch = :project_sketch, 
        preproject = :preproject, project_report = :project_report, pres_start = :pres_start, pres_end = :pres_end', 
        ['start' => $array['start'], 'statusreport' => $array['status_report'], 'project_sketch' => $array['project_sketch'],
        'preproject' => $array['preproject'], 'project_report' => $array['project_report'], 'pres_start' => $array['pres_start'],
        'pres_end' => $array['pres_end']]);

        return 'Datoer er oppdatert';
    }

    /**
     * Må kalles for å kunne aksessere funksjonene 
     * 
     * Kalles på denne måten: \DateHelper::instance()->funksjon();
     */
    public static function instance()
    {
        return new DateHelper();
    }
}