<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Order;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;
use App\Models\Date;
use Illuminate\Support\Facades\Input;


class EpostController extends Controller
{
    public function epostView()
    {
        if(session('levell') >= 2)
        {
            $ver = "s";
            return view('pages.admin.epostView')->with(['verdi' => $ver]);
        }
        else
        {
            return redirect('/epostView')->with('error', 'Du har ikke tilgang til denne siden.');
        }
    }

    public function sendEpostAlleStud(request $request)
    {
        $this->validate($request, [
            'melding' => 'required|regex:/(^[A-Za-z0-9 øæåØÆÅ.!:-]+$)/',
            'tema' => 'required|regex:/(^[A-Za-z0-9 øæåØÆÅ.!:-]+$)/'
        ]);

        $bruker = session('navn');
        $brukerEpost = DB::select('SELECT email FROM users WHERE username = :bruker',['bruker'=>$bruker]);
        $studenter = DB::select('SELECT * FROM users WHERE users.level = "1"');
        foreach($studenter as $stud)
        {
            /*$data = array(
                'til' => $stud->email,
                'fra' => $brukerEpost[0]->email,
                'subject' => $request->tema,
                'bodymessage' => $request->melding
            );
            mail::send('emails.contact', $data, function($melding) use ($data)
            {
                $melding->from($data['fra']);
                $melding->to($data['til']);
                $melding->subject($data['subject']);
            });*/

            
            /*$fra = $brukerEpost[0]->email;
            $til = $stud->email;

            $headers[] = 'MIME-Version: 1.0';
            $headers[] = 'Content-type: text/html; charset=UTF-8';
            $headers[] = 'From: OsloMET Admin <'.$fra.'>';

            $emne = $request->tema;

            $melding = '
            <html>
                <body>
                    <p>'.$request->melding.'</p>
                </body>
            </html>
            ';

            mail($til, $emne, $melding, implode("\r\n", $headers));*/
            
        }
        
        \LogHelper::Log("Sendte mail til alle studenter", "1");

        return redirect('/dashboard/admin')->with('success', 'Mail er sendt, til studenter');
    }

    /*public function sendEpostSensorVeileder(request $request)
    {
        $this->validate($request, [
            'melding' => 'required',
            'tema' => 'required'
        ]);

        $bruker = session('navn');
        $brukerEpost = DB::select('SELECT email FROM users WHERE username = :bruker',['bruker'=>$bruker]);

        $data = array(
            'til' => $request->senvei,
            'fra' => $brukerEpost[0]->email,
            'subject' => $request->tema,
            'bodymessage' => $request->melding
        );
        mail::send('emails.contact', $data, function($melding) use ($data)
        {
            $melding->from($data['fra']);
            $melding->to($data['til']);
            $melding->subject($data['subject']);
        });*/

        
        /*$fra = $brukerEpost[0]->email;
        $til = $stud->email;

        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=UTF-8';
        $headers[] = 'From: OsloMET Admin <'.$fra.'>';

        $emne = $request->tema;

        $melding = '
        <html>
            <body>
                <p>'.$request->melding.'</p>
            </body>
        </html>
        ';

        mail($til, $emne, $melding, implode("\r\n", $headers));
        
        \LogHelper::Log("Sendte epost til ".$request->senvei, "1");

        return redirect('/dashboard/admin')->with('success', 'Mail er sendt til veileder');
    }*/

    public function sendEpostSensor(request $request)
    {
        $this->validate($request, [
            'melding' => 'required',
            'tema' => 'required'
        ]);
        
        /*$bruker = session('navn');
        $sensors = DB::SELECT('SELECT email FROM sensors_supervisors WHERE status = "sensor');
        $brukerEpost = DB::select('SELECT email FROM users WHERE username = :bruker',['bruker'=>$bruker]);
    
        foreach($sensors as $sen)
        {
            $fra = $brukerEpost[0]->email;
            $til = $sen->email;

            $headers[] = 'MIME-Version: 1.0';
            $headers[] = 'Content-type: text/html; charset=UTF-8';
            $headers[] = 'From: OsloMET Admin <'.$fra.'>';

            $emne = $request->tema;

            $melding = '
            <html>
                <body>
                    <p>'.$request->melding.'</p>
                </body>
            </html>
            ';

            mail($til, $emne, $melding, implode("\r\n", $headers));
        }*/
        
        \LogHelper::Log("Sendte epost til alle sensorene", "1");

        return redirect('/dashboard/admin')->with('success', 'Mail er sendt til sensorene');
    }

    public function sendEpostVeileder(request $request)
    {
        $this->validate($request, [
            'melding' => 'required',
            'tema' => 'required'
        ]);
        
        /*$bruker = session('navn');
        $veiledere = DB::SELECT('SELECT email FROM sensors_supervisors WHERE status = "veileder');
        $brukerEpost = DB::select('SELECT email FROM users WHERE username = :bruker',['bruker'=>$bruker]);
    
        foreach($veiledere as $vei)
        {
            $fra = $brukerEpost[0]->email;
            $til = $vei->email;

            $headers[] = 'MIME-Version: 1.0';
            $headers[] = 'Content-type: text/html; charset=UTF-8';
            $headers[] = 'From: OsloMET Admin <'.$fra.'>';

            $emne = $request->tema;

            $melding = '
            <html>
                <body>
                    <p>'.$request->melding.'</p>
                </body>
            </html>
            ';

            mail($til, $emne, $melding, implode("\r\n", $headers));
        }*/
        
        \LogHelper::Log("Sendte epost til alle veiledere", "1");

        return redirect('/dashboard/admin')->with('success', 'Mail er sendt til veiledere');
    }
}