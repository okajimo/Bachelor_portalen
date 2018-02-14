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

        /*$pw = DB::table('users')->where('username' , $innData->username)->value('password');

        if( \Hash::needsRehash($pw) ) {
            $pw = \Hash::make($pw);
        }

        /*if($innData->password == $pw)
        {
            return 'ok';
        }
        else
        {
            return $pw;
        }*/

        if (Auth::attempt(['username'=>$innData->username, 'password'=>$innData->password])){
            return 'OK';
        }
        else{
            return 'Feil';
        }
    }
}
