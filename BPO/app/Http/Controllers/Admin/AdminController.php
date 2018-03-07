<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Order;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function showDateMaintenance()
    {
        if(session('levell') >= 2)
        {
            $title = "Dato vedlikehold";
            $date = DB::select('SELECT * FROM dates');
            return view('pages.admin.datoVedlikehold')->with(['title' => $title, 'date' => $date]);
        }
        else
        {
            return redirect('/')->with('error', 'Du er ikke admin og har ikke tilgang');
        }
    }

    public function vedlikeholdSensorVeileder()
    {
        if(session('levell') >= 2)
        {
            $senvei = DB::table('sensors_supervisors')->get();
            $title = "Vedlikehold av sensorer og veiledere";
            return view('pages.admin.vedlikeholdAvSensorOgVeileder')->with(['title' => $title,'senvei' => $senvei]);
        }
        else
        {
            return redirect('/')->with('error', 'Du er ikke admin og har ikke tilgang');
        }
    }

    public function slettSenvei(request $request)
    {
        DB::DELETE('DELETE FROM sensors_supervisors WHERE email = :email',['email'=>$request->email]);
        return redirect('/vedlikeholdAvSensorOgVeileder')->with('success','Sletting av sensor/veileder var vellykket.');
    }

    public function regSensorVeileder(request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'firstname' => 'required|alpha',
            'lastname' => 'required|alpha',
            'status' => 'required|alpha',
        ]);

        DB::insert('INSERT INTO sensors_supervisors (email, firstname, lastname, status) VALUES 
        (:email, :firstname, :lastname, :status)',
        ['email'=>$request->email,'firstname'=>$request->firstname,'lastname'=>$request->lastname,'status'=>$request->status]);

        return redirect('/vedlikeholdAvSensorOgVeileder')->with('success','Registrering av sensor/veileder er vellykket.');

    }

    public function dateUpdater()
    {
        
    }

    public function studentVedlikehold()
    {
        if(session('levell') >= 2)
        {
            $title = "Student vedlikehold";
            return view('pages.admin.studentVedlikehold', compact('troll'))->with(['title' => $title]);
        }
        else
        {
            return redirect('/')->with('error', 'Du er ikke admin og har ikke tilgang');
        }
    }

    public function importerStud(request $request)
    {
        if(session('levell') >= 2)
        {  
            $stud = session('navn');
            $sender = DB::select('select email from users where username = :stud',['stud'=>$stud]);

            $fileHandle = fopen($request->dok, "r");
            while ( ($row = fgetcsv($fileHandle, ",")) ) 
            {
                $finnes = DB::select('SELECT username FROM users WHERE users.username = :stud',['stud'=>$row[0]]);
                if(!$finnes)
                {
                    if($row[7] >= 100)
                    {
                        $passord = str_random(8);
                        $data = array(
                            'til' => $row[4],
                            'fra' => $sender[0]->email,
                            'passord' => $passord
                        );
                        mail::send('emails.contact', $data, function($melding) use ($data)
                        {
                            $melding->from($data['fra']);
                            $melding->to($data['til']);
                            $melding->subject('Passord');
                        });
                    }
                    else
                    {
                        $passord = "";
                    }
                    //Laster inn studenter fra filen som lastes opp
                    DB::insert('INSERT INTO users (username, level, firstname, lastname, email, password, sex) VALUES 
                    (:en, :to, :tre, :fire, :fem, :seks, :syv)',['en'=>$row[0],'to' =>$row[1],'tre'=>$row[2],'fire'=>$row[3],'fem'=>$row[4],'seks'=>$passord,'syv'=>$row[6]]);

                    DB::insert('INSERT INTO student (username, student_points, program) VALUES 
                    (:en, :atte, :ni)',['en'=>$row[0],'atte'=>$row[7],'ni'=>$row[8]]);
                }
            }
            fclose($fileHandle);
            return redirect('/studentVedlikehold')->with('success','Importering av studenter vellykket');
        }
        else
        {
            return redirect('/')->with('error', 'Du er ikke admin og har ikke tilgang');
        }
    }

    public function endreStudPoeng(request $request)
    {
        if(session('levell') >= 2)
        {  
            $this->validate($request, [
                'poeng' => 'required|numeric'
            ]);

            if($request->poeng >= 100)
            {
                $stud = session('navn');
                $passord = str_random(8);
                DB::update('UPDATE student SET student_points = :poeng WHERE student.username = :stud',['poeng'=>$request->poeng,'stud'=>$request->student]);
                DB::update('UPDATE users SET password = :pass WHERE username = :stud',['pass'=>$passord,'stud'=>$request->student]);
                $email = DB::select('select email from users where username = :stud',['stud'=>$request->student]);
                $sender = DB::select('select email from users where username = :stud',['stud'=>$stud]);

                $data = array(
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
                return redirect('/studentVedlikehold')->with('success','Student er oppdatert.');
            }
            else
            {
                DB::update('UPDATE student SET student_points = :poeng WHERE student.username = :stud',['poeng'=>$request->poeng,'stud'=>$request->student]);
                DB::update('UPDATE users SET password = "" WHERE username = :stud',['stud'=>$request->student]);
                return redirect('/studentVedlikehold')->with('success','Student er oppdatert.');
            }
        }
        else
        {
            return redirect('/')->with('error', 'Du er ikke admin og har ikke tilgang');
        }
    }
}
