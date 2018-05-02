<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Group;
use App\document;
use Illuminate\Support\Facades\Input;

class LesDokumenterController extends Controller
{
    public function les_dokumenter(){

        if(session('levell') > 1)
        {
            $groups = DB::table('groups')->get();
            $title = null;
            return view('pages.lesDokumenter.les_dokumenter')->with(['title' => $title, 'groups' =>$groups]);
        }
        else
        {
            return redirect('/login');
        }
    }
}
