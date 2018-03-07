<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function Admin()
    {
        if(session('levell') == 1)
        {
            $title = null;
            return view('dashboard.admin_dashboard')->with('title', $title);
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
            return view('dashboard.group_dashboard')->with('title', $title);
        }
        else
        {
            return redirect('/login')->with('error', 'Du er ikke admin og har ikke tilgang');
        }
    }
}
