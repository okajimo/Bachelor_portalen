<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use App\Models\Log;

class LogHelper
{
    /**
     * Funksjon for å logge SQL kommandoer til DB
     * 
     * $request object
     */
    public static function logUpload ($command, $path)
    {
        $commandToSql = $command["query"];
        foreach ($command["bindings"] as $value)
        {
            $from = '?';
            $from = '/'.preg_quote($from, '/').'/';
            $commandToSql = preg_replace($from, $value, $commandToSql, 1);
        }

        $log = new Log;
        $log->time = date('Y-m-d H:i:s');
        $log->user = session('navn');
        $log->file = $path;
        $log->command = $commandToSql;
        $log->save();
    }

    /**
     * Må kalles for å kunne aksessere funksjonene
     * 
     * Kalles på denne måten: \LogHelper::instance()->funksjon();
     */
    public static function instanceLog()
    {
        return new UploadHelper();
    }
}
?>