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
            $title = "Les dokumenter";
            $dokumenter = DB::table('documents')->orderBy('documents_groups_number','asc')->get();
            return view('pages.lesDokumenter.les_dokumenter')->with(['title' => $title, 'dokumenter' => $dokumenter]);
        }
        else
        {
            return redirect('/login');
        }
    }
}
