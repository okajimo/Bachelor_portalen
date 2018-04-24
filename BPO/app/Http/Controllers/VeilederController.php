<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class VeilederController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(session('levell') >= 2)
        {
            $group = DB::select("SELECT * FROM groups");
            $student = DB::select("SELECT * FROM student_groups");
            $user = DB::select("SELECT * FROM users");
            $supervisors = DB::select("SELECT * FROM sensors_supervisors
            WHERE status = 'veileder'");
            
            $title = "Administrer gruppe";
            return view('admin.administrer_gruppe')->with(['title' => $title, 'group' => $group, 'student' => $student, 'user' => $user, 'supervisors' => $supervisors]);
        }
        else
        {
            return redirect('/')->with('error', 'Du er ikke admin og har ikke tilgang');
        }
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'supervisor' => 'required',
        ]);
        
        $sensor = DB::select("SELECT sensors_supervisors.firstname, sensors_supervisors.lastname 
        FROM sensors_supervisors, groups 
        WHERE groups.supervisor = sensors_supervisors.email 
        AND group_number = :id", 
        ['id' => $request->group]); // skulle gjerne brukt denne for tilbakemelding uten error

        DB::update("UPDATE groups
        SET supervisor = :veileder
        WHERE group_number = :gruppe_number", 
        ['veileder' => $request->supervisor, 'gruppe_number' => $request->group]);

        $bruker = session('navn');
        \LogHelper::Log($bruker." har oppdatert gruppe ".$request->group." med veileder ".$request->supervisor, "1");

        return redirect('/administrer_gruppe')->with('success', 'Gruppe '.$request->group.' har blitt blitt tildelt ny veileder');
    }

    public function destroy($id)
    {
        DB::delete("DELETE FROM student_groups
        WHERE student_groups_number = :id", ['id' => $id]);

        DB::update("UPDATE groups
        SET groups.leader='', groups.title='', groups.url='', groups.supervisor = NULL
        WHERE group_number = :id", ['id' => $id]);

        $bruker = session('navn');
        \LogHelper::Log($bruker." har slettet gruppe ".$id, "1");

        return redirect('/administrer_gruppe')->with('error', 'Gruppe fjernet');
    }
}
