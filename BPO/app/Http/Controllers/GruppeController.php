<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Group;
use App\document;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Validation\ValidatesRequests;

class GruppeController extends Controller
{
    public function vedlikehold_gruppe(){

        if(session('levell') == 1)
        {
            $title = "Gruppeinnstillinger";
            $groups = DB::table('groups')->orderBy('group_number','ASC')->get();
            return view('pages.gruppe.vgruppe')->with(['title' => $title, 'groups' => $groups]);
        }
        else
        {
            return redirect('/login')->with('error', 'Du er ikke admin og har ikke tilgang');
        }
    }

    public function fjern_student(Request $request)
    {
        $student = session('navn');
        $sjekk_leder = DB::SELECT('SELECT groups.leader FROM groups WHERE groups.leader = :student', ['student' => $student]);
        if(!$sjekk_leder)
        {
            $studGrupp = DB::SELECT('SELECT student_groups.student_groups_number FROM student_groups WHERE student_groups.student = :student', ['student' => $student]);
            DB::DELETE('DELETE FROM student_groups WHERE student_groups.student = :student',['student' => $student]);

            \LogHelper::Log("Fjernet student ".$student." fra gruppe ".$studGrupp[0]->student_groups_number, "1");
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
                    }
                    else
                    {
                        $endre_student = $med->student;
                        $counter++;
                    }
                }
                if($counter > 0)
                {
                    DB::UPDATE('UPDATE groups SET leader = :leader 
                    WHERE groups.group_number = :gruppe AND groups.year = :year',['leader' =>$endre_student,'gruppe' =>$groups->group_number,'year' => $groups->year]);

                    \LogHelper::Log("Student ".$student." har forlatt gruppen og ny leder er satt", "1");
                }
                else
                {
                    DB::UPDATE('UPDATE groups SET leader = "", title = "", url = "", supervisor = NULL, searching = ""
                    WHERE groups.group_number = :gruppe AND groups.year = :year',['gruppe' => $groups->group_number,'year' => $groups->year]);

                    \LogHelper::Log("Gruppe ".$groups->group_number." har blitt tømt", "1");
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
            $gruppe->searching = "no";
            $gruppe->save();
            DB::insert('INSERT INTO student_groups (student, student_groups_number, student_groups_year) VALUES (:Snavn, :Sgruppe, :Syear)',['Snavn' => $leder,'Sgruppe' => $gruppe->group_number,'Syear' => $gruppe->year]);
            \LogHelper::Log("Student ".$leder." har opprettet gruppe med nummer ".$gruppe->group_number, "1");
        }
        else 
        {
            $tommeGrupper = DB::select('SELECT * FROM groups WHERE groups.leader = ""');
            foreach($tommeGrupper as $tomme)
            {
                DB::update('UPDATE groups SET leader = :leder, searching = "no" WHERE groups.group_number = :nummer AND groups.year = :ar',['leder' => $leder, 'nummer' => $tomme->group_number,'ar' => $tomme->year]);
                DB::insert('INSERT INTO student_groups (student, student_groups_number, student_groups_year) VALUES (:Snavn, :Sgruppe, :Syear)',['Snavn' => $leder,'Sgruppe' => $tomme->group_number,'Syear' => $tomme->year]);
                
                \LogHelper::Log("Student ".$leder." har blitt lagt inn i gruppe med nummer ".$tomme->group_number, "1");
                break;
            }

            if($tommeGrupper == NULL)
            {
                $antallGrupper = DB::table('groups')->where('year', '=', $year)->count();
                $test = $antallGrupper + 1;
                $gruppe->group_number = $test;
                $gruppe->searching = "no";
                $gruppe->save();
                DB::insert('INSERT INTO student_groups (student, student_groups_number, student_groups_year) VALUES (:Snavn, :Sgruppe, :Syear)',['Snavn' => $leder,'Sgruppe' => $gruppe->group_number,'Syear' => $gruppe->year]);

                \LogHelper::Log("Student ".$leder." har laget gruppe med nummer ".$gruppe->group_number, "1");
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
            
            \LogHelper::Log("Student ".$stud." meldte seg inn i gruppe ".$request->number, "1");

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

        \LogHelper::Log("Student ".$set_leader." satt seg selv som leder i gruppen sin", "1");

        return redirect('/vgruppe');
    }  

    public function lastOppUrlView()
    {
        if(session('levell') == 1)
        {
            $student = session('navn');
            $gruppe = DB::select('SELECT student_groups_number FROM student_groups WHERE student LIKE :student', ['student' => $student]);
            // Sjekker om studenten har gruppe eller ikke, skal ikke få lov til å laste opp uten gruppe
            if($gruppe)
            {
                $student = session('navn');
                $iGruppe = DB::select('SELECT student_groups.student FROM student_groups WHERE student_groups.student = :iGruppe', ['iGruppe' => $student]);
                if($iGruppe == null)
                {
                    return redirect('/');
                }
                else
                {
                    $title = "Last opp hjemmeside link";
                    return view('pages.gruppe.lastOppUrl')->with('title' , $title);
                }
            }
            else
            {
                return redirect('/dashboard/group')->with('error', 'Du er ikke medlem av en gruppe');
            }
        }
        else
        {
            return redirect('/login')->with('error', 'Du er ikke logget inn');
        }
    }

    public function lastOppUrl(request $request)
    {
        if(Input::get('lastOpp'))
        {
            $this->validate($request, [
                'url' => 'required|url|max:127',
                'tittel' => 'required|max:45|regex:/(^[A-Za-z æøåÆØÅ]+$)/'
            ]);
            
            $student = session('navn');
            //$finnesUrl = DB::select('SELECT groups.url FROM groups, student_groups WHERE groups.group_number = student_groups.student_groups_number AND groups.year = student_groups.student_groups_year AND student_groups.student = :stud',['stud' => $student]);

            DB::update('UPDATE groups, student_groups SET groups.url = :link, groups.title = :tittel WHERE groups.group_number = student_groups.student_groups_number AND groups.year = student_groups.student_groups_year AND student_groups.student = :stud',['stud'=>$student,'link'=>$request->url,'tittel'=>$request->tittel]);
            
            \LogHelper::Log("Student ".$student." lastet up link til gruppens hjemmeside".$request->url, "1");
            
            return redirect('/lastOppUrl')->with('success', 'Du har lastet opp hjemmeside link');
        }
    }

    public function news()
    {
        if(session('levell') >= 1)
        {
            $nyheter = DB::select('select * from news ORDER BY id DESC');
            $title = "Nyheter";
            return view('group.news')->with(['title' => $title, 'nyheter' => $nyheter]);
        }
        else
        {
            return redirect('/')->with('error', 'Du er ikke logget inn');
        }
    }

    public function sokMedlemmer(request $request)
    {
        $student = session('navn');
        DB::update('UPDATE groups SET searching = "yes" WHERE leader = :stud',['stud'=>$student]);
        return redirect('/vgruppe');
    }

    public function stoppSokMedlemmer(request $request)
    {
        $student = session('navn');
        DB::update('UPDATE groups SET searching = "no" WHERE leader = :stud',['stud'=>$student]);
        return redirect('/vgruppe');
    }
}