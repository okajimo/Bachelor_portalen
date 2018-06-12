<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SimulerController extends Controller
{
    //simulerer en student
    public function simuler(request $request)
    {
        if(session('levell') >= 2)
        {
            $this->validate($request, [
                'student' => 'required|regex:/(^[s]{1}[0-9]{6}$)/'
            ]);
    
            $db_studenter = DB::select('SELECT username FROM student');
            $ok = null;
    
            //return dd($db_studenter);
    
            foreach($db_studenter as $student){
                if ($student->username == $request->student)
                    $ok = "ok";
            }
    
            if($ok == "ok"){
                Session(['orginal_navn' => $request->inn_navn]);
                Session(['orginal_level' => $request->inn_level]);
    
                \LogHelper::Log(session('navn')." begynte å simulere student ".$request->student, "1");
    
                Session(['navn' => $request->student]);
                Session(['levell' => "1"]);
                return redirect('/dashboard/group')->with('success', 'Du simulerer nå: '.$request->student);
            }
            else{
                return redirect('/dashboard/admin2')->with('error', 'Dette er ikke en student');
            }
        }
        else
        {
            return redirect('/login')->with('error', 'Du har ikke tilgang til denne siden.');
        }
    }

    //avslutter simulering av student og sender deg tilbake til admin dashboard
    public function avsimuler(request $request)
    {
        if(session('level') >= 2)
        {
            Session(['navn' => $request->inn_navn]);
            Session(['levell' => $request->inn_level]);

            \LogHelper::Log(session('navn')." avsluttet simulering av student", "1");

            return redirect('/dashboard/admin')->with('error', 'Simulering stoppet');
        }
        else
        {
            return redirect('/login')->with('error', 'Du har ikke tilgang til denne siden.');
        }
    }
}
