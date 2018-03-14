<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Order;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;
use App\Models\Date;


class EpostController extends Controller
{
    public function epostView()
    {
        if(session('levell') >= 2)
        {
            $title = "Send e-post";
            return view('pages.admin.epostView')->with('title' , $title);
        }
        else
        {
            return redirect('/')->with('error', 'Du er ikke admin og har ikke tilgang');
        }
    }

    public function sendEpostAlleStud(request $request)
    {
        $this->validate($request, [
            'melding' => 'required',
            'tema' => 'required'
        ]);

        $bruker = session('navn');
        $brukerEpost = DB::select('SELECT email FROM users WHERE username = :bruker',['bruker'=>$bruker]);
        $studenter = DB::select('SELECT * FROM users WHERE users.level = "1"');
        foreach($studenter as $stud)
        {
            $data = array(
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
            });

            
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
        return redirect('/epostView')->with('success', 'Mail er sendt');
    }

    public function sendEpostSensorVeileder(request $request)
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
        });

        
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
        
        return redirect('/epostView')->with('success', 'Mail er sendt');
    }
}