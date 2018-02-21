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

        if (date('m') >= '04') 
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

    public function sett_leder(Request $request)
    {   
        $set_leader2 = session('navn');
        $set_leader = session('navn');
        DB::update('UPDATE groups SET leader = :set_leader WHERE leader = (SELECT groups.leader FROM student, student_groups WHERE student.username = student_groups.student AND student_groups.student_groups_number = groups.group_number AND student_groups.student_groups_year = groups.year AND student.username = :set_leader2)', [ 'set_leader' => $set_leader, 'set_leader2' => $set_leader2]);
        return redirect('/');
    }
}
