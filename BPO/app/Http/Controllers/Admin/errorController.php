<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class errorController extends Controller
{
    public function error()
    {
        if(session('error'))
        {
            return view('errorLayout.error');
        }
        else
        {
            return redirect()->back();
        }
    }
}
