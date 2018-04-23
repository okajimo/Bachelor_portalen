<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use App\document;
use App\Models\Prosjektforslag;

Class UploadHelper
{
    /**
     * Funksjon for å laste opp dokumenter for en gruppe
     * Brukes for både statusrapport, prosjektskisse og prosjektforslag
     * 
     * $request object
     */
    public function upload($request)
    {
        DB::connection()->enableQueryLog();
        $name = session('navn');
        $groupNumber = DB::table('student_groups')->where('student', '=', $name)->value('student_groups_number');
        $year = DB::table('groups')->where('group_number', '=', $groupNumber)->value('year');
        $year = (int)$year;

        if($request->hasFile('dok'))
        {
            if ($request->input('type') == 'prosjektforslag')
            {
                $extension = $request->file('dok')->getClientOriginalExtension();
                $filenameToStore = $request->input('file_name').'.'.$extension;
                $path = $request->file('dok')->storeAs('public/filer/'.$request->input('type'), $filenameToStore);

                $dok = new Prosjektforslag;
                $dok->date_added = \Carbon\Carbon::now('Europe/Oslo')->format('d.m');;
                $dok->file_name = $filenameToStore;
                $dok->save();

                return 'Dokument opplastet';
            }
            else
            {
                $extension = $request->file('dok')->getClientOriginalExtension();
                $filenameToStore = $year.'_gr'.$groupNumber.'_'.$request->input('type').'.'.$extension;
                $path = $request->file('dok')->storeAs('public/filer/'.$request->input('type'), $filenameToStore);
            }
        }
        $dok = new Document;
        $dok->documents_groups_number = $groupNumber;
        $dok->documents_year = $year;
        $dok->file_name = $filenameToStore;
        $dok->title = $request->input('type');
        $dok->save();
        return 'Dokument opplastet';
    }

    /**
     * Funksjon for å oppdatere en gruppes opplastede dokument
     * Brukes for både statusrapport og prosjektskisse
     * 
     * $request object
     */
    public function updateDocument($request)
    {
        $name = session('navn');
        $groupNumber = DB::table('student_groups')->where('student', '=', $name)->value('student_groups_number');
        $year = DB::table('groups')->where('group_number', '=', $groupNumber)->value('year');
        $year = (int)$year;

        if($request->hasFile('dok'))
        {
            $filenameToStore = DB::select('SELECT documents.file_name FROM documents WHERE documents.documents_groups_number LIKE :grNumber 
            AND documents.documents_year LIKE :year AND documents.title LIKE :title', ['grNumber' => $groupNumber, 'year' => $year, 'title' => $request->input('type')]);
            $path = $request->file('dok')->storeAs('public/filer/'.$request->input('type'), $filenameToStore[0]->file_name);
        }
        return 'Dokument oppdatert';
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