<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Group;
use App\document;
use Illuminate\Support\Facades\Input;

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

    public function fjern_student(Request $request)
    {
        $student = session('navn');

        $sjekk_leder = DB::SELECT('SELECT groups.leader FROM groups WHERE groups.leader = :student', ['student' => $student]);
        if(!$sjekk_leder)
        {
            DB::DELETE('DELETE FROM student_groups WHERE student_groups.student = :student',['student' => $student]);
        }
        else
        {
            $group = DB::SELECT('SELECT * FROM groups WHERE groups.leader = :leader',['leader' => $student]);
            $counter = 0;
            foreach($group as $groups)
            {
                $medlemmer = DB::SELECT('SELECT student_groups.student FROM student_groups WHERE  student_groups.student_groups_number = :gruppe AND student_groups.student_groups_year = :year',['gruppe' => $groups->group_number,'year' => $groups->year]);
                foreach($medlemmer as $med)
                {
                    if($med->student == $student)
                    {
                        DB::DELETE('DELETE FROM student_groups WHERE student_groups.student = :student',['student' => $student]);
                        $endre_tom = "";
                    }
                    else
                    {
                        $endre_student = $med->student;
                        $counter++;
                    }
                }
                if($counter > 0)
                {
                    DB::UPDATE('UPDATE groups SET leader = :leader WHERE groups.group_number = :gruppe AND groups.year = :year',['leader' =>$endre_student,'gruppe' =>$groups->group_number,'year' => $groups->year]);
                }
                else
                {
                    DB::UPDATE('UPDATE groups SET leader = :leader, title = "", url = "", supervisor = "" WHERE groups.group_number = :gruppe AND groups.year = :year',['leader' =>$endre_tom,'gruppe' =>$groups->group_number,'year' => $groups->year]);
                }
            }

        }
        return redirect('/vgruppe');
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
        $grupper = DB::select('SELECT * FROM groups WHERE groups.year = :ar',['ar' => $year]);

        if (!$grupper) 
        {
            $gruppe->group_number = 1;
            $gruppe->save();
            DB::insert('INSERT INTO student_groups (student, student_groups_number, student_groups_year) VALUES (:Snavn, :Sgruppe, :Syear)',['Snavn' => $leder,'Sgruppe' => $gruppe->group_number,'Syear' => $gruppe->year]);
        }
        else 
        {
            $tommeGrupper = DB::select('SELECT * FROM groups WHERE groups.leader = ""');
            foreach($tommeGrupper as $tomme)
            {
                DB::update('UPDATE groups SET leader = :leder WHERE groups.group_number = :nummer AND groups.year = :ar',['leder' => $leder, 'nummer' => $tomme->group_number,'ar' => $tomme->year]);

                DB::insert('INSERT INTO student_groups (student, student_groups_number, student_groups_year) VALUES (:Snavn, :Sgruppe, :Syear)',['Snavn' => $leder,'Sgruppe' => $tomme->group_number,'Syear' => $tomme->year]);
                break;
            }

            if($tommeGrupper == NULL)
            {
                $antallGrupper = DB::table('groups')->where('year', '=', $year)->count();
                $test = $antallGrupper + 1;
                $gruppe->group_number = $test;
                $gruppe->save();
                DB::insert('INSERT INTO student_groups (student, student_groups_number, student_groups_year) VALUES (:Snavn, :Sgruppe, :Syear)',['Snavn' => $leder,'Sgruppe' => $gruppe->group_number,'Syear' => $gruppe->year]);
            }
        }
        return redirect('/vgruppe');
    }

    public function meld_inn(Request $request)
    {
        if(Input::get('meld'))
        {
            $stud = session('navn');
            DB::insert('INSERT INTO student_groups (student, student_groups_number, student_groups_year) VALUES (:student, :group, :year)',['student' => $stud,'group'=> $request->number,'year' => $request->year]);
            return redirect('/vgruppe');
        }
    }

    public function sett_leder(Request $request)
    {   
        $set_leader2 = session('navn');
        $set_leader = session('navn');
        DB::update('UPDATE groups SET leader = :set_leader WHERE leader = 
        (SELECT groups.leader FROM student, student_groups WHERE student.username = student_groups.student 
        AND student_groups.student_groups_number = groups.group_number AND student_groups.student_groups_year = groups.year AND student.username = :set_leader2)'
        , [ 'set_leader' => $set_leader, 'set_leader2' => $set_leader2]);
        return redirect('/vgruppe');
    }  

    public function showUploadForm()
    {
        $title = "Last opp";
        return view('pages.gruppe.lastOppDok')->with('title', $title);
    }

    public function lastOppDok(request $request)
    {
        $upload = \UploadHelper::instance()->upload($request);
    }
}
