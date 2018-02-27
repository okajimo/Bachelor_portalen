<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

Class DateHelper
{
    public function date($data)
    {

        return "dato mangler";
    }

    public function year()
    {

        $year = array('year' => '2017', 'year1' => '2018');
        return $year; 
    }

    public static function instance()
    {
        return new DateHelper();
    }
}