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

            //$student = DB::table('student_groups')->where('student' ,'student_groups_number')->value('student');
            $student = DB::table('groups')->join('student_groups', 'student_groups_year', '=', 'groups.year')
            ->join('student_groups', 'student_groups_number', '=', 'groups.group_number')
            ->select('groups.student')->get();

            return view('pages.gruppe.vgruppe')->with(['title' => $title, 'groups' => $groups, 'student' => $student]);
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
        //$gruppe->year = $request->input('year');
        
        //$number1 = DB::table('groups')->value('group_number')->first();

        //$gruppe->group_number = 5;
        

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
            $antallGrupper = DB::table('groups')->where('year', '=', $year)->count();
            $test = $antallGrupper + 1;
            $gruppe->group_number = $test;
        }

        $gruppe->save();
        return redirect('/')->with('success', 'gruppe lagret');
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
