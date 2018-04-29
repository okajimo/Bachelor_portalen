<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function Admin()
    {
        if(session('levell') >= 2)
        {
            $title = null;
            return view('dashboard.admin_dashboard')->with('title', $title);
        }
        else
        {
            return redirect('/login')->with('error', 'Du er ikke admin og har ikke tilgang');
        }
    }

    public function Admin2()
    {
        if(session('levell') >= 2)
        {
            $title = null;
            return view('dashboard.admin_dashboard2')->with('title', $title);
        }
        else
        {
            return redirect('/login')->with('error', 'Du er ikke admin og har ikke tilgang');
        }
    }

    public function Group()
    {
        if(session('levell') == 1)
        {
            $title = null;
            $student= session('navn');
            $nummer = DB::select('select student_groups_number from student_groups where student = :stud',['stud'=>$student]);
            return view('dashboard.group_dashboard')->with(['title'=> $title,'nummer'=> $nummer]);
        }
        else
        {
            return redirect('/login')->with('error', 'Du er ikke medlem av en gruppe');
        }
    }
}
