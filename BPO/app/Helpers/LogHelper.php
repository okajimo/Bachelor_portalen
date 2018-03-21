<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use App\Models\Log;

Class UploadHelper
{
    /**
     * Funksjon for å logge SQL kommandoer som kjøres
     * 
     * $request object
     */
    public function log ()
    {
        $log = new Log;
        $log->time = date('Y-m-d H:i:s');
        $log->user = ;
        $log->file = $php_self;
        $log->pos = ;
        $log->command = ;
    }

    /**
     * Må kalles for å kunne aksessere funksjonene
     * 
     * Kalles på denne måten: \UploadHelper::instance()->funksjon();
     */
    public static function instance()
    {
        return new UploadHelper();
    }
}