<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use App\document;

Class UploadHelper
{
    /**
     * Funksjon for å laste opp dokumenter for en gruppe
     * Brukes for både statusrapport og prosjektskisse
     * 
     * $request object
     */
    public function upload($request)
    {
        $name = session('navn');
        $groupNumber = DB::table('student_groups')->where('student', '=', $name)->value('student_groups_number');
        $year = DB::table('groups')->where('group_number', '=', $groupNumber)->value('year');
        $year = (int)$year;

        if($request->hasFile('dok'))
        {
            $filenameWithExt = $request->file('dok')->getClientOriginalName();
            $extension = $request->file('dok')->getClientOriginalExtension();

            if($request->input('type') == 'statusrapport') 
            {
                $filenameToStore = $year.'_gr'.$groupNumber.'_Statusrapport.'.$extension;
                $path = $request->file('dok')->storeAs('public/filer/statusrapporter', $filenameToStore);
            }
            elseif($request->input('type') == 'prosjektskisse') 
            {
                $filenameToStore = $year.'_gr'.$groupNumber.'_Prosjektskisse.'.$extension;
                $path = $request->file('dok')->storeAs('public/filer/prosjektskisser', $filenameToStore);
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

        if($request->hasFile('dok')){
            if($request->input('type') == 'statusrapport') {
                $filenameToStore = DB::select('SELECT documents.file_name FROM documents WHERE documents.documents_groups_number LIKE :grNumber 
                AND documents.documents_year LIKE :year', ['grNumber' => $groupNumber, 'year' => $year]);
                $path = $request->file('dok')->storeAs('public/filer/statusrapporter', $filenameToStore[0]->file_name);
            }
            elseif($request->input('type') == 'prosjektskisse') {

                $filenameToStore = DB::select('SELECT documents.file_name FROM documents WHERE documents.documents_groups_number LIKE :grNumber 
                AND documents.documents_year LIKE :year', ['grNumber' => $groupNumber, 'year' => $year]);
                $path = $request->file('dok')->storeAs('public/filer/prosjektskisser', $filenameToStore[0]->file_name);
            }
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