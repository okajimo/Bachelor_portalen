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
                $typ = " Info";
                break;
            case "2";
                $typ= " Warning";
                break;
            case "3";
                $typ= " Error";
                break;
        }
        $dato = date('d.m.Y H:i');
        $level = session('levell');
        $username = session('navn');
        $html = "User: ".$username." Level: ".$level." Loglevel: ".$typ." Handling: ".$melding." Dato ".$dato." \r\n";

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