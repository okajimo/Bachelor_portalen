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
            $student = DB::select('SELECT * FROM student WHERE student_points >= 100 ORDER BY username ASC');
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
        return redirect('/')->with('success', 'Du simulerer nå: '.$request->student);
    }

    //ender simuleringen og setter deg til den gammle
    public function avsimuler(request $request)
    {
        Session(['navn' => $request->inn_navn]);
        Session(['levell' => $request->inn_level]);
        $title = "Simuler Student";
        return redirect('/simuler')->with('error', 'Simulering stoppet');
    }
}
