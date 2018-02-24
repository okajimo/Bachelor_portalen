<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Group;
use App\document;

class GruppeController extends Controller
{
    public function vedlikehold_gruppe(){

        if(session('levell') >= 1)
        {
            $title = "Vedlikehold av gruppe";
            $groups = DB::table('groups')->get();
            return view('pages.gruppe.vgruppe')->with(['title' => $title, 'groups' => $groups]);
        }
        else
        {
            return redirect('/login');
        }
    }

    public function lag_gruppe(Request $request)
    {   
        $gruppe = new Group;
        $gruppe->leader = session('navn');
        $leder = session('navn');

        if (date('m') >= '06') 
        {
            $year = date('Y') + 1;
            $gruppe->year = $year;
        }
        else
        {
            $year = date('Y');
            $gruppe->year = $year;
        }
        //Sjekker om det finnes noen registrerte grupper med det årstallet
        $grupper = DB::table('groups')->where('year', '=', $year)->get();

        if ( $grupper == "") 
        {
            $gruppe->group_number = 1;
        }
        else 
        {
            $tommeGrupper = DB::select('SELECT * FROM groups WHERE groups.leader = ""');
            foreach($tommeGrupper as $tomme)
            {
                if($tomme->group_number == "")
                {
                    $antallGrupper = DB::table('groups')->where('year', '=', $year)->count();
                    $test = $antallGrupper + 1;
                    $gruppe->group_number = $test;
                    $gruppe->save();
                    break;
                }
                else
                {
                    DB::update('UPDATE groups SET leader = :leder WHERE groups.group_number = :nummer AND groups.year = :ar',['leder' => $leder, 'nummer' => $tomme->group_number,'ar' => $tomme->year]);
                }
                break;
            }
        }
        return redirect('/')->with('success', 'gruppe lagret');
    }

    public function sett_leder(Request $request)
    {   
        $set_leader2 = session('navn');
        $set_leader = session('navn');
        DB::update('UPDATE groups SET leader = :set_leader WHERE leader = (SELECT groups.leader FROM student, student_groups WHERE student.username = student_groups.student AND student_groups.student_groups_number = groups.group_number AND student_groups.student_groups_year = groups.year AND student.username = :set_leader2)', [ 'set_leader' => $set_leader, 'set_leader2' => $set_leader2]);
        return redirect('/vgruppe');
    }  

    public function showUploadForm()
    {
        $title = "Last opp";
        return view('pages.gruppe.lastOppDok')->with('title', $title);
    }

    public function lastOppDok(request $request)
    {
        $this->validate($request, [
            'type' => 'required|max:127',
            'dok' => 'required|mimes:pdf|max:1999'
        ]);
        
        // Håndterer fil opplasting
        if($request->hasFile('dok')){
            $filnavn = $request->file('dok')->getClientOriginalName();

            $path = $request->file('dok')->storeAs('public/filer', $filnavn);
        }

        //lagre data
        $dok = new Document;
        $dok->title = $request->input('type');
        $dok->file_name = $filnavn;
        
        $name = session('navn');
        $nummer = DB::table('student_groups')->where('student', '=', $name)->value('student_groups_number');
        $dok->documents_groups_number = $name;
        $year = DB::table('groups')->where('group_number', '=', $nummer)->value('year');
        $dok->documents_year = $year;

        $dok->save();
        return redirect('/')->with('success', 'Dokument opplastet');
    }
}