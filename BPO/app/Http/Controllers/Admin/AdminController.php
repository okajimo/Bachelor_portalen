<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Order;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;
use App\Models\Date;

class AdminController extends Controller
{
    public function __construct()
    {
        DB::connection()->enableQueryLog();
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
        $query = DB::getQueryLog();
        $log = \LogHelper::logSql(end($query), 'AdminController');
        return redirect('/vedlikeholdAvSensorOgVeileder')->with('success','Sletting av sensor/veileder var vellykket.');
    }

    public function regSensorVeileder(request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'firstname' => 'required|alpha',
            'lastname' => 'required|alpha',
            'status' => 'required',
        ]);
        DB::insert('INSERT INTO sensors_supervisors (email, firstname, lastname, status) VALUES 
        (:email, :firstname, :lastname, :status)',
        ['email'=>$request->email,'firstname'=>$request->firstname,'lastname'=>$request->lastname,'status'=>$request->status]);
        $query = DB::getQueryLog();
        $log = \LogHelper::logSql(end($query), 'AdminController');
        return redirect('/vedlikeholdAvSensorOgVeileder')->with('success','Registrering av sensor/veileder er vellykket.');

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
                    /*if($row[2] >= 100)
                    {
                        $passord = str_random(8);
                        /*$data = array(
                            'til' => $row[4],
                            'fra' => $sender[0]->email,
                            'passord' => $passord
                        );
                        mail::send('emails.contact', $data, function($melding) use ($data)
                        {
                            $melding->from($data['fra']);
                            $melding->to($data['til']);
                            $melding->subject('Passord');
                        });*/

                        /*
                        $fra = $sender[0]->email;
                        $til = $row[4];

                        $headers[] = 'MIME-Version: 1.0';
                        $headers[] = 'Content-type: text/html; charset=UTF-8';
                        $headers[] = 'From: OsloMET Admin <'.$fra.'>';

                        $emne = 'OsloMET bachelor portal';

                        $melding = '
                        <html>
                            <body>
                                <p>Passord til OsloMET bachelor portal er opprettet</p>
                                <b>Passordet er: '.$passord.'</b>
                                <p>Sent fra: '.$fra.'</p>
                            </body>
                        </html>
                        ';

                        mail($til, $emne, $melding, implode("\r\n", $headers));
                        
                    }
                    else
                    {
                        $passord = "";
                    }
                    //Laster inn studenter fra filen som lastes opp
                    DB::update('UPDATE users SET level = :to, password = :seks 
                    WHERE username = :en',['en'=>$row[0],'to' => $row[1], 'seks' => $passord]);

                    DB::insert('INSERT INTO student (username, student_points, program) VALUES 
                    (:en, :atte, :ni)',['en'=>$row[0],'atte'=>$row[2],'ni'=>$row[3]]);*/
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
                        $query = DB::getQueryLog();
                        $log = \LogHelper::logSql(end($query), 'AdminController');

                        DB::insert('INSERT INTO student (username, student_points, program) VALUES 
                        (:en, :atte, :ni)',['en'=>$row[0],'atte'=>$row[2],'ni'=>$row[3]]);
                        $log = \LogHelper::logSql(end($query), 'AdminController');
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
                        $query = DB::getQueryLog();
                        $log = \LogHelper::logSql(end($query), 'AdminController');

                        DB::update('UPDATE student SET student_points = :atte, program = :ni 
                        WHERE username = :en',['en' => $row[0],'atte'=>$row[2],'ni' => $row[3]]);
                        $log = \LogHelper::logSql(end($query), 'AdminController');
                    }
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
                $query = DB::getQueryLog();
                $log = \LogHelper::logSql(end($query), 'AdminController');
                DB::update('UPDATE users SET password = :pass WHERE username = :stud',['pass'=>$passord,'stud'=>$request->student]);
                $log = \LogHelper::logSql(end($query), 'AdminController');
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
                });*/
                return redirect('/studentVedlikehold')->with('success','Student er oppdatert.');
            }
            else
            {
                DB::update('UPDATE student SET student_points = :poeng WHERE student.username = :stud',['poeng'=>$request->poeng,'stud'=>$request->student]);
                $query = DB::getQueryLog();
                $log = \LogHelper::logSql(end($query), 'AdminController');
                DB::update('UPDATE users SET password = "" WHERE username = :stud',['stud'=>$request->student]);
                $log = \LogHelper::logSql(end($query), 'AdminController');
                return redirect('/studentVedlikehold')->with('success','Student er oppdatert.');
            }
        }
        else
        {
            return redirect('/')->with('error', 'Du er ikke admin og har ikke tilgang');
        }
    }
}
