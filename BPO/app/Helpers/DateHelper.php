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
        $date = DB::select('SELECT date FROM dates WHERE name = :name', ['name' => $data]);
        if (empty($date))
        {
            return "dato mangler";
        }
        else
        {
            $date = \Carbon\Carbon::parse($date[0]->date)->format('d.m.Y');
            return $date;
        }
    }

    /**
     * Funksjon for å hente og formatere år for bruk på statiske sider
     * 
     */
    public function year()
    {
        $getYear = DB::select('SELECT date FROM dates WHERE name = :name', ['name' => 'start']);
        if (empty($getYear))
        {
            return "årstall mangler"; 
        }
        else
        {
            $getYear = \Carbon\Carbon::parse($getYear[0]->date)->format('Y');
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
        $data = Input::except('_token');
        foreach ($data as $key => $value)
        {
            DB::insert('INSERT INTO dates (name, date) VALUES (:name, :date)', ['name' => $key, 'date' => $value]);
        }
        \LogHelper::Log("Opprettet datoen for dates tabellen", "1");
        return 'Datoer er lagret';
    }

    /**
     * Funksjon for å oppdatere 'dates' tabellen i DB
     * 
     * $request object
     */
    public function update($request)
    {
        $data = Input::except('_token');
        foreach ($data as $key => $value)
        {
            DB::update('UPDATE dates SET date = :date1 WHERE name = :name1', ['date1' => $value, 'name1' => $key]);
        }
        \LogHelper::Log("Oppdaterte datoene for dates tabellen", "1");
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