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
            $title = "Vedlikehold av gruppe";
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
                        //$endre_tom = "";
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
                }
                else
                {
                    DB::UPDATE('UPDATE groups SET leader = "", title = "", url = "", supervisor = NULL
                    WHERE groups.group_number = :gruppe AND groups.year = :year',['gruppe' => $groups->group_number,'year' => $groups->year]);
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
                'url' => 'required|url',
                'tittel' => 'required|alpha'
            ]);
            
            $student = session('navn');
            //$finnesUrl = DB::select('SELECT groups.url FROM groups, student_groups WHERE groups.group_number = student_groups.student_groups_number AND groups.year = student_groups.student_groups_year AND student_groups.student = :stud',['stud' => $student]);

            DB::update('UPDATE groups, student_groups SET groups.url = :link, groups.title = :tittel WHERE groups.group_number = student_groups.student_groups_number AND groups.year = student_groups.student_groups_year AND student_groups.student = :stud',['stud'=>$student,'link'=>$request->url,'tittel'=>$request->tittel]);
            return redirect('/lastOppUrl')->with('success', 'Du har lastet opp hjemmeside link');
        }
    }

    public function news()
    {
        if(session('levell') >= 1)
        {
            $nyheter = DB::select('select * from news');
            $title = "Nyheter";
            return view('group.news')->with(['title' => $title, 'nyheter' => $nyheter]);
        }
        else
        {
            return redirect('/')->with('error', 'Du er ikke logget inn');
        }
    }
}