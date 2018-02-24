<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function Admin(){
        $title = null;
        return view('dashboard.admin_dashboard')->with('title', $title);;
    }

    public function Group(){
        $title = null;
        return view('dashboard.group_dashboard')->with('title', $title);;
    }

    public function Student(){
        $title = null;
        return view('dashboard.student_dashboard')->with('title', $title);;
    }
}
