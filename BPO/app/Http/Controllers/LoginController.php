<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class LoginController extends Controller
{
    public function visLoggInn(){
        if(session('levell') > 0)
        {
            return redirect('/');
        }
        else
        {
            $title = "Logg inn her";
            return view('login.login')->with('title', $title);
        }
    }

    public function loggInn(request $innData){
        $this->validate($innData, [
            'username' => 'required|max:15|alpha_num',
            'password' => 'required|max:15|alpha_num',
        ]);

        if(DB::table('users')->where('username' , $innData->username)->value('password') == $innData->password)
        {
            Session(['navn' => $innData->username]);
            $level = DB::table('users')->where('username' , $innData->username)->value('level');

            Session(['level' => $level]);
            if($level == "1")
            {
                $lvl=1;
                Session(['levell' => $lvl]);
                return redirect('/dashboard/group');
            }
            /*elseif($level == "2")
            {
                $lvl=2;
                Session(['levell' => $lvl]);
                return redirect('/');
            }
            elseif($level == "3")
            {
                $lvl=3;
                Session(['levell' => $lvl]);
                return redirect('/');
            }
            elseif($level == "4")
            {
                $lvl=4;
                Session(['levell' => $lvl]);
                return redirect('/');
            }*/
            elseif($level >= 2)
            {
                $lvl=$level;
                Session(['levell' => $lvl]);
                return redirect('/dashboard/admin');

                $bruker = session('navn');
                $log = new Logger($bruker);
                $log->pushHandler(new StreamHandler('/public/filer/logger/your.log', Logger::INFO));

                // add records to the log
                $log->info('Bruker: '.$bruker." logget inn.");
            }
            elseif($level == "0")
            {
                return redirect('/login')->with('error', 'Du har ikke tilgang til innlogging');
            }
        }
        else
        {
            return redirect('/login')->with('error', 'Brukernavn eller passord er feil');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();

        return redirect('/login');
    }
}
