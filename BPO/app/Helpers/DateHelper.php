<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

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

    public static function instance()
    {
        return new DateHelper();
    }
}