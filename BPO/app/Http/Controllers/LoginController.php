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
            $stud = session('navn');
            $level = DB::table('users')->where('username' , $innData->username)->value('level');

            Session(['level' => $level]);
            if($level == "1")
            {
                $lvl=1;
                Session(['levell' => $lvl]);

                \LogHelper::Log("Student ".$stud." logget inn", "1");

                return redirect('/dashboard/group');
            }
            elseif($level >= 2)
            {
                $lvl=$level;
                Session(['levell' => $lvl]);

                \LogHelper::Log("Admin ".$stud." logget inn", "1");

                return redirect('/dashboard/admin');
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
        $bruker = session('navn');
        \LogHelper::Log($bruker." logget seg ut", "1");
        $request->session()->flush();

        return redirect('/login');
    }
}
