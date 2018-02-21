<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function visLoggInn(){
        $title = "Logg inn her";
        return view('login.login')->with('title', $title);
    }

    public function loggInn(request $innData){
        $this->validate($innData, [
            'username' => 'required|max:15',
            'password' => 'required|max:45',
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
                return redirect('/');
            }
            elseif($level == "2")
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
            }
            elseif($level >= 2)
            {
                $lvl=$level;
                Session(['levell' => $lvl]);
                return redirect('/');
            }
        }
        else
        {
            return redirect('/login');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();

        return redirect('/login');
    }
}
