<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

Class UploadHelper
{
    public function upload($request)
    {
        // Validerer filen slik at kun tillatte filtyper kan lastes opp
        $this->validate($request, [
            'type' => 'required|max:127',
            'dok' => 'required|mimes:pdf|max:1999'
        ]);
        
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
            // Henter kun filnavn
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Henter kun filtype
            $extension = $request->file('dok')->getClientOriginalExtension();
            // Filnavnet som skal lagres
            $filenameToStore = $year.'_gr'.$groupNumber.'_'.$filename.'.'.$extension;
            
            if($request->input('type') == 'statusrapport') {
                // Hvor filen skal lagres
                $path = $request->file('dok')->storeAs('public/filer/statusrapporter', $filenameToStore);
            }
            elseif($request->input('type') == 'prosjektskisse') {
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
        return redirect('/')->with('success', 'Dokument opplastet');
    }

    public static function instance()
    {
        return new UploadHelper();
    }
}