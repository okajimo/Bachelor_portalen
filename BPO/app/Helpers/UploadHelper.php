<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use App\document;

Class UploadHelper
{
    public function upload($request)
    {
        //Finner gruppenummer til opplaster
        $name = session('navn');
        $groupNumber = DB::table('student_groups')->where('student', '=', $name)->value('student_groups_number');
        // Definerer årskullet til opplaster
        $year = DB::table('groups')->where('group_number', '=', $groupNumber)->value('year');
        $year = (int)$year;

        // Håndterer fil opplasting
        if($request->hasFile('dok')){
            // Henter original filnavnet til opplaster med filtype
            $filenameWithExt = $request->file('dok')->getClientOriginalName();
            // Henter kun filtype
            $extension = $request->file('dok')->getClientOriginalExtension();
            // Sjekker hvilket dokument som er lastet opp og velger plassering ut ifra det
            if($request->input('type') == 'statusrapport') {
                // Filnavnet som skal lagres
                $filenameToStore = $year.'_gr'.$groupNumber.'_Statusrapport.'.$extension;
                // Hvor filen skal lagres
                $path = $request->file('dok')->storeAs('public/filer/statusrapporter', $filenameToStore);
            }
            elseif($request->input('type') == 'prosjektskisse') {
                // Filnavnet som skal lagres
                $filenameToStore = $year.'_gr'.$groupNumber.'_Prosjektskisse.'.$extension;
                // Hvor filen skal lagres
                $path = $request->file('dok')->storeAs('public/filer/prosjektskisser', $filenameToStore);
            }
        }

        //lagre data til databasen
        $dok = new Document;
        $dok->documents_groups_number = $groupNumber;
        $dok->documents_year = $year;
        $dok->file_name = $filenameToStore;
        $dok->title = $request->input('type');
        
        $dok->save();
        return 'Dokument opplastet';
    }

    public function updateDocument($request)
    {
        //Finner gruppenummer til opplaster
        $name = session('navn');
        $groupNumber = DB::table('student_groups')->where('student', '=', $name)->value('student_groups_number');
        // Definerer årskullet til opplaster
        $year = DB::table('groups')->where('group_number', '=', $groupNumber)->value('year');
        $year = (int)$year;

        // Håndterer fil opplasting
        if($request->hasFile('dok')){
            // Sjekker hvilket dokument som er lastet opp og velger plassering ut ifra det
            if($request->input('type') == 'statusrapport') {
                // Filnavnet som skal lagres
                $filenameToStore = DB::select('SELECT documents.file_name FROM documents WHERE documents.documents_groups_number LIKE :grNumber 
                AND documents.documents_year LIKE :year', ['grNumber' => $groupNumber, 'year' => $year]);
                // Hvor filen skal lagres
                $path = $request->file('dok')->storeAs('public/filer/statusrapporter', $filenameToStore[0]->file_name);
            }
            elseif($request->input('type') == 'prosjektskisse') {
                // Filnavnet som skal lagres
                $filenameToStore = DB::select('SELECT documents.file_name FROM documents WHERE documents.documents_groups_number LIKE :grNumber 
                AND documents.documents_year LIKE :year', ['grNumber' => $groupNumber, 'year' => $year]);
                // Hvor filen skal lagres
                $path = $request->file('dok')->storeAs('public/filer/prosjektskisser', $filenameToStore[0]->file_name);
            }
        }
        return 'Dokument oppdatert';
    }

    public static function instance()
    {
        return new UploadHelper();
    }
}