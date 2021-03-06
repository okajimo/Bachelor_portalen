<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Order;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;
use App\Models\Date;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function vedlikeholdSensorVeileder()
    {
        if(session('levell') >= 2)
        {
            $senvei = DB::table('sensors_supervisors')->get();
            $title = "Sensorer og veiledere";
            return view('pages.admin.vedlikeholdAvSensorOgVeileder')->with(['title' => $title,'senvei' => $senvei]);
        }
        else
        {
            return redirect('/')->with('error', 'Du har ikke tilgang til denne siden.');
        }
    }

    public function slettSenvei(request $request)
    {
        $sjekk = DB::SELECT('(SELECT groups.supervisor as senvei FROM groups ) UNION (SELECT presentation.sensor as senvei FROM presentation)');
        foreach($sjekk as $sj)
        {
            if($sj->senvei == $request->email)
            {
                return redirect('/vedlikeholdAvSensorOgVeileder')->with('error','Kan ikke slette sensor/veileder når dem er i bruk.');
            }
        }
        DB::DELETE('DELETE FROM sensors_supervisors WHERE email = :email',['email'=>$request->email]);
        \LogHelper::Log("Slettet sensor/veileder: ".$request->email, "1"); 
        return redirect('/vedlikeholdAvSensorOgVeileder')->with('success','Sletting av sensor/veileder var vellykket.');
    }

    public function regSensorVeileder(request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:45',
            'firstname' => 'required|alpha|max:45',
            'lastname' => 'required|alpha|max:45',
            'status' => 'required',
        ]);
        DB::insert('INSERT INTO sensors_supervisors (email, firstname, lastname, status) VALUES 
        (:email, :firstname, :lastname, :status)',
        ['email'=>$request->email,'firstname'=>$request->firstname,'lastname'=>$request->lastname,'status'=>$request->status]);
        \LogHelper::Log("Opprettet ny ".$request->status.": ".$request->firstname." ".$request->lastname, "1");
        return redirect('/vedlikeholdAvSensorOgVeileder')->with('success','Registrering av sensor/veileder er vellykket.');

    }

    public function studentVedlikehold()
    {
        if(session('levell') >= 2)
        {
            $title = "Administrer studenter";
            return view('pages.admin.studentVedlikehold', compact('troll'))->with(['title' => $title]);
        }
        else
        {
            return redirect('/')->with('error', 'Du har ikke tilgang til denne siden.');
        }
    }

    public function importerStud(request $request)
    {
        if(session('levell') >= 2)
        {  
            $admin = session('navn');
            $sender = DB::select('select email from users where username = :admin',['admin'=>$admin]);

            $this->validate($request, [
                'fil' => 'required'
            ]);

            $fileHandle = fopen($request->fil, "r");
            while ( ($row = fgetcsv($fileHandle, ",")) ) 
            {
                $finnes = DB::select('SELECT username FROM users WHERE users.username = :stud',['stud'=>$row[0]]);
                if(!$finnes)
                {
                    return redirect('/studentVedlikehold')->with('error',$row[0].' eksisterer ikke i user tabellen. Opprett user i tabellen eller fjern fra opplastningsfilen.');
                }
                else
                {
                    $finnesstud = DB::select('SELECT username FROM student WHERE student.username = :stud',['stud'=>$row[0]]);
                    if(!$finnesstud)
                    {
                        if($row[2] >= 100)
                        {
                            $passord = str_random(8);
                        }
                        else
                        {
                            $passord = "";
                        }

                        DB::update('UPDATE users SET level = :to, password = :seks 
                        WHERE username = :en',['en'=>$row[0],'to' => $row[1], 'seks' => $passord]);

                        \LogHelper::Log("Oppdaterte level og passord til bruker ".$row[0], "1");

                        DB::insert('INSERT INTO student (username, student_points, program) VALUES 
                        (:en, :atte, :ni)',['en'=>$row[0],'atte'=>$row[2],'ni'=>$row[3]]);

                        \LogHelper::Log("Opprettet student ".$row[0]." med ".$row[2]." student poeng og program ".$row[3], "1");
                    }
                    else
                    {
                        if($row[2] >= 100)
                        {
                            $passord = str_random(8);
                        }
                        else
                        {
                            $passord = "";
                        }

                        DB::update('UPDATE users SET level = :to, password = :seks 
                        WHERE username = :en',['en'=>$row[0],'to' => $row[1], 'seks' => $passord]);

                        \LogHelper::Log("Oppdaterte level og passord til bruker ".$row[0], "1");

                        DB::update('UPDATE student SET student_points = :atte, program = :ni 
                        WHERE username = :en',['en' => $row[0],'atte'=>$row[2],'ni' => $row[3]]);

                        \LogHelper::Log("Oppdaterte student ".$row[0]." med ".$row[2]." student poeng og program ".$row[3], "1");
                    }
                }
            }
            fclose($fileHandle);
            return redirect('/studentVedlikehold')->with('success','Importering av studenter vellykket');
        }
        else
        {
            return redirect('/')->with('error', 'Du har ikke tilgang til denne siden.');
        }
    }

    public function endreStudPoeng(request $request)
    {
        if(session('levell') >= 2)
        {
            $this->validate($request, [
                'poeng' => 'required|numeric|max:10000'
            ]);

            if($request->poeng >= 100)
            {
                $stud = session('navn');
                $passord = str_random(8);
                DB::update('UPDATE student SET student_points = :poeng WHERE student.username = :stud',['poeng'=>$request->poeng,'stud'=>$request->student]);

                \LogHelper::Log("Oppdaterte ".$request->student." med ".$request->poeng." student poeng", "1");

                DB::update('UPDATE users SET password = :pass WHERE username = :stud',['pass'=>$passord,'stud'=>$request->student]);
                $email = DB::select('select email from users where username = :stud',['stud'=>$request->student]);
                $sender = DB::select('select email from users where username = :stud',['stud'=>$stud]);

                /*$data = array(
                    'til' => $email[0]->email,
                    'fra' => $sender[0]->email,
                    'passord' => $passord
                );
                mail::send('emails.contact', $data, function($melding) use ($data)
                {
                    $melding->from($data['fra']);
                    $melding->to($data['til']);
                    $melding->subject('Passord');
                });
                \LogHelper::Log("Oppdaterte ".$request->student." med nytt passord. Mail med passord sendt til student", "1");
                */
                return redirect('/studentVedlikehold')->with('success','Student er oppdatert.');
            }
            else
            {
                $student = $request->student;
                $sjekk_IGruppe = DB::SELECT('SELECT student FROM student_groups WHERE student = :stud',['stud'=>$student]);
                $sjekk_leder = DB::SELECT('SELECT groups.leader FROM groups WHERE groups.leader = :student', ['student' => $student]);
                if($sjekk_IGruppe)
                {
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
                    return redirect('/studentVedlikehold')->with('success','Student er oppdatert.');
                }
                else
                {
                    DB::update('UPDATE student SET student_points = :poeng WHERE student.username = :stud',['poeng'=>$request->poeng,'stud'=>$request->student]);
                    DB::update('UPDATE users SET password = "" WHERE username = :stud',['stud'=>$request->student]);
                    return redirect('/studentVedlikehold')->with('success','Student er oppdatert.');
                }
            }
        }
        else
        {
            return redirect('/')->with('error', 'Du har ikke tilgang til denne siden.');
        }
    }

    public function resetPassword(request $request)
    {
        $stud = session('navn');
        $passord = str_random(8);
        DB::update('UPDATE users SET password = :pass WHERE username = :stud',['pass'=>$passord,'stud'=>$request->student]);
        \LogHelper::Log("Oppdaterte ".$request->student." med nytt passord og sendte mail", "1");

        $email = DB::select('select email from users where username = :stud',['stud'=>$request->student]);
        $sender = DB::select('select email from users where username = :stud',['stud'=>$stud]);
        /*$data = array(
            'til' => $email[0]->email,
            'fra' => $sender[0]->email,
            'passord' => $passord
        );
        mail::send('emails.contact', $data, function($melding) use ($data)
        {
            $melding->from($data['fra']);
            $melding->to($data['til']);
            $melding->subject('Passord');
        });
        \LogHelper::Log("Oppdaterte ".$request->student." med nytt passord. Mail med passord sendt til student", "1");
        */        
        return redirect('/studentVedlikehold')->with('success','Student har fått nytt passord.');
    }

    public function vnews()
    {
        if(session('levell') >= 2)
        {
            $nyheter = DB::select('select * from news ORDER BY id DESC');
            $title = "Nyheter";
            return view('Admin.vnews')->with(['title' => $title, 'nyheter' => $nyheter]);
        }
        else
        {
            return redirect('/')->with('error', 'Du er ikke logget inn');
        }
    }

    public function lagNyhet(request $request)
    {
        $this->validate($request, [
            'tittel' => 'required|max:45|regex:/(^[A-Za-z0-9 ÅØÆåøæ!?.:]+$)/',
            'melding' => 'required',
        ]);
        DB::insert('INSERT INTO news (id, user, tittel, melding) 
        VALUES (NULL, :user, :tittel, :melding)',['user'=>session('navn'),'tittel'=>$request->tittel,'melding'=>$request->melding]);
        
        \LogHelper::Log("Opprettet nyhet med tittel ".$request->tittel, "1");
        
        return redirect('/vnews')->with('success', 'Nyhet har blitt opprettet, og ligger nå i vis Nyheter for studentene');
    }

    public function slettNyhet(request $request)
    {
        DB::delete('delete from news where id = :id',['id'=> $request->id]);

        \LogHelper::Log("Slettet nyhet med id ".$request->id, "1");

        return redirect('/vnews')->with('success', 'Nyhet har blitt slettet');
    }

    public function leggTilStudent(request $request)
    {
        $this->validate($request, [
            'poeng' => 'required|numeric|max:10000',
            'student' => 'required|max:15|alpha_num',
            'linje' => 'required|max:30|alpha_num',
        ]);

        $student = $request->student;
        $poeng = $request->poeng;
        $linje = $request->linje;

        $finnesIDb = DB::select('SELECT username FROM users WHERE username = :stud',['stud'=>$request->student]);
        $finnesSomStud = DB::select('SELECT username FROM student WHERE username = :stud',['stud'=>$request->student]);
        
        if($finnesIDb)
        {
            if(!$finnesSomStud)
            {
                DB::insert('INSERT INTO student (username, student_points, program) VALUES 
                (:stud, :poeng, :program)',['stud'=>$student,'poeng'=>$poeng,'program'=>$linje]);

                return redirect('/studentVedlikehold')->with('success','Student er registrert.');
            }
            else
            {
                return redirect('/studentVedlikehold')->with('error','Student '.$student.' er allerede registrert som student.');
            }
        }
        else
        {
            return redirect('/studentVedlikehold')->with('error','Student '.$student.' finnes ikke i users tabellen.');
        }
    }
}
