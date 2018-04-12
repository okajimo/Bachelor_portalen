<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Group;
use App\document;

class OpplastningController extends Controller
{
    public function showUploadFormS()
    {
        if(session('levell') == 1)
        {
            $student = session('navn');
            $gruppe = DB::select('SELECT student_groups_number FROM student_groups WHERE student LIKE :student', ['student' => $student]);
        
            if($gruppe)
            {
                $title = "Last opp statusrapport";
                return view('pages.gruppe.lastOppStatus')->with('title', $title);
            }
            else
            {
                return redirect('/dashboard/group')->with('error', 'Du er ikke medlem av en gruppe');
            }
        }
        else
        {
            return redirect('/login')->with('error', 'Du er ikke admin og har ikke tilgang');
        }
    }

    public function showUploadFormP()
    {
        if(session('levell') == 1)
        {
            $student = session('navn');
            $gruppe = DB::select('SELECT student_groups_number FROM student_groups WHERE student LIKE :student', ['student' => $student]);
            // Sjekker om studenten har gruppe eller ikke, skal ikke få lov til å laste opp uten gruppe
            if($gruppe)
            {
                $title = "Last opp prosjektskisse";
                return view('pages.gruppe.lastOppSkisse')->with('title', $title);
            }
            else
            {
            return redirect('/dashboard/group')->with('error', 'Du er ikke medlem av en gruppe');
            }
        }
        else
        {
            return redirect('/login')->with('error', 'Du er ikke admin og har ikke tilgang');
        }
    }

    public function lastOppDok(request $request)
    {
        // Validerer filen slik at kun tillatte filtyper kan lastes opp
        $this->validate($request, [
            'dok' => 'required|mimes:pdf|max:1999'
        ]);

        
        $student = session('navn');
        $gruppe = DB::select('SELECT student_groups_number FROM student_groups WHERE student LIKE :student', ['student' => $student]);
        $gruppeHarLastetOpp = DB::select('SELECT documents.documents_groups_number, documents.title FROM documents, groups 
        WHERE documents.documents_groups_number = groups.group_number AND documents.documents_year = groups.year 
        AND documents.title LIKE :title AND documents.documents_groups_number LIKE :grNumber', ['title' => $request->input('type'), 'grNumber' => $gruppe[0]->student_groups_number]);
        //Sjekker om gruppen har lastet opp et dokument tidligere og kun skal gjøre en oppdatering av innhold
        if ($gruppeHarLastetOpp)
        {
            if ($gruppeHarLastetOpp[0]->title == 'statusrapporter')
            {
                $upload = \UploadHelper::instance()->updateDocument($request);
                return redirect('/lastOppStatus')->with('success', $upload);
            }
            elseif ($gruppeHarLastetOpp[0]->title == 'prosjektskisser')
            {
                $upload = \UploadHelper::instance()->updateDocument($request);
                return redirect('/lastOppSkisse')->with('success', $upload);                
            }
        }
        else
        {
            if ($request->input('type') == 'statusrapporter')
            {
                $upload = \UploadHelper::instance()->upload($request);
                return redirect('/lastOppStatus')->with('success', $upload);
            }
            elseif ($request->input('type') == 'prosjektskisser')
            {
                $upload = \UploadHelper::instance()->upload($request);
                return redirect('/lastOppSkisse')->with('success', $upload);
            }
        }
    }
}
