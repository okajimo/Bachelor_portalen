<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SimulerController extends Controller
{
    //viser Viewet for simuler student
    public function index()
    {
        if(session('levell') >= 2)
        {
            //NB endre setningen til å i tillegg sjekke access level
            $student = DB::select('SELECT users.username, users.lastname, users.firstname, student.student_points 
            FROM users, student 
            WHERE users.username = student.username 
            AND student.student_points >= 100
            AND users.level = 1 
            ORDER BY users.username ASC');

            $title = "Simuler Student";
            return view('pages.admin.simuler')->with(['title' => $title, 'student' =>$student]);
        }
        else
        {
            return redirect('/')->with('error', 'Du er ikke admin og har ikke tilgang');
        }
    }

    //simulerer en student
    public function simuler(request $request)
    {
        
        Session(['orginal_navn' => $request->inn_navn]);
        Session(['orginal_level' => $request->inn_level]);

        Session(['navn' => $request->student]);
        Session(['levell' => "1"]);
        $title = "Simuler Student";
        return redirect('/dashboard/group')->with('success', 'Du simulerer nå: '.$request->student);
    }

    //avslutter simulering av student og sender deg tilbake til admin dashboard
    public function avsimuler(request $request)
    {
        Session(['navn' => $request->inn_navn]);
        Session(['levell' => $request->inn_level]);
        $title = "Simuler Student";
        return redirect('/dashboard/admin')->with('error', 'Simulering stoppet');
    }
}
