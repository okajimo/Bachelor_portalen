<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use App\Models\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use DateTime;
use DateTimezone;

class LogHelper
{
    public static function Log($melding, $type)
    {
        switch($type)
        {
            case "1";
                $typ = "<span style='color: blue;'> Info </span>";
                break;
            case "2";
                $typ= "<div style='color: orange;'> Warning </div>";
                break;
            case "3";
                $typ= "<div style='color: red;'> Error </div>";
                break;
        }
        $dato = date('d.m.Y H:i');
        $level = session('levell');
        $username = session('navn');
        $html = "<b>User</b>: ".$username." <b>Level</b>: ".$level." <b>Loglevel</b>: ".$typ." <b>Handling</b>: ".$melding." <b>Dato</b> ".$dato."</br> \r\n";

        $finnes = Storage::exists('/public/filer/logger/1.txt');
        if($finnes == false)
        {
            Storage::put('/public/filer/logger/1.txt', "");
        }
        $file = "storage/filer/logger/1.txt";
        $current = file_get_contents($file);
        $current .= $html;
        file_put_contents($file, $current);
    }
}
?>