<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Group;

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
        

        if (date('m') >= '01') 
        {
            $year = date('Y') + 1;
            $gruppe->year = $year;
        }
        else
        {
            $year = date('Y');
            $gruppe->year = $year;
        }
        $asd = DB::table('groups')->where('year', '=', $year)->get();

        if ( $asd == "") 
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
}
