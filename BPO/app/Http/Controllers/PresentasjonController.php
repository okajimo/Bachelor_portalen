<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DateTime;
use DateTimezone;

class PresentasjonController extends Controller
{
    public function index()
    {
        if(session('levell') >= 2)
        {
            $rooms = DB::select('SELECT * FROM room');
            $supervisors = DB::select("SELECT * FROM sensors_supervisors WHERE status = 'sensor'");
            $groups = DB::select('SELECT * 
            FROM groups 
            WHERE group_number NOT IN (SELECT presentation.presentation_group_number FROM presentation)
            AND supervisor IS NOT NULL');

            $title = "Presentasjonsplan";
            return view('admin.Presentasjonsplan')->with(['title' => $title, 'rooms' => $rooms, 'supervisors' => $supervisors, 'groups' => $groups]);
        }
        else
        {
            return redirect('/login')->with('error', 'Du er ikke admin og har ikke tilgang');
        }

        
    }

    //sletter presentasjonsplan
    public function delete()
    {
        if(session('levell') >= 2)
        {
            DB::delete('DELETE FROM presentation');

            $bruker = session('navn');
            \LogHelper::Log($bruker." slettet presentasjonsplan", "1");

            return redirect('/presentasjonsplan')->with('error', 'Prestasjonsplaner er slettet');
        }
        else
        {
            return redirect('/login')->with('error', 'Du er ikke admin og har ikke tilgang');
        }
    }

    //oppretter presentasjonsplanen
    public function store(Request $request)
    {
        if(session('levell') >= 2)
        {
            if ($request->gruppe != "") {
                $antall_perr_dag = count($request->gruppe);
                $groups = $request->gruppe;
    
                $aar = date("Y");
                $dato = $request->dates;
                $antall = 0;
    
                $time_start = $request->time;
                $sensor = $request->sensor;
                $room = $request->room;
    
                $dtCheck = new DateTime("11:00:00", new DateTimezone('Europe/Oslo'));
                $dt2Check = new DateTime("12:00:00", new DateTimezone('Europe/Oslo'));
    
                $dt = new DateTime($time_start, new DateTimezone('Europe/Oslo'));
                $dt2 = new DateTime($time_start, new DateTimezone('Europe/Oslo'));
                $dt2->modify('+30 minutes');
                
                foreach($groups as $exist){
                    if ($antall < $antall_perr_dag ){
                        if($dt>= $dtCheck && $dt< $dt2Check){
                            $dt->setTime(12, 00);
                            $dt2->setTime(12, 30);
                        }
    
                        if($dt2>= $dtCheck && $dt2< $dt2Check){
                            $dt->setTime(12, 00);
                            $dt2->setTime(12, 30);
                        }
    
                        $start = $dato." ".$dt->format('H:i');
                        $slutt = $dato." ".$dt2->format('H:i');
                        $dt->modify('+5 minutes');
                        $dt2->modify('+5 minutes');
    
    
                        DB::insert("INSERT INTO presentation (presentation.presentation_group_number, presentation.presentation_year, presentation.start, presentation.end, presentation.presentation_room, presentation.sensor)
                        VALUES (:gnum, :aar, :starts, :slutts, :room, :sensor)", ['gnum' => $exist, 'starts' => $start, 'slutts' => $slutt, 'room' => $room, 'aar' =>$aar, 'sensor' => $sensor]);
                        
                        $dt->modify('+30 minutes');
                        $dt2->modify('+30 minutes');
    
                        $antall++;
                        $grupperLaget[] = $exist;
                    }          
                }  
                
                $grupper = "";
                foreach($grupperLaget as $grupp)
                {
                    $grupper .= $grupp." ";
                }
                $bruker = session('navn');
                \LogHelper::Log($bruker." har opprettet presentasjonsplan for gruppene: ".$grupper, "1"); 
    
                return redirect('/presentasjonsplan')->with('success', "Presentasjonsplan oppdatert");
            }
            else
                return redirect('/presentasjonsplan')->with('error', "du må hvertfall velge en gruppe");
        }
        else
        {
            return redirect('/login')->with('error', 'Du er ikke admin og har ikke tilgang');
        }
        
    }

    //Viser viewet for endre presentasjonsplan
    public function show()
    {
        if(session('levell') >= 2)
        {
            $presentasjoner = DB::select('SELECT presentation.presentation_group_number, presentation.presentation_year, presentation.start, presentation.end, presentation.presentation_room, presentation.sensor, sensors_supervisors.firstname, sensors_supervisors.lastname 
            FROM presentation, sensors_supervisors 
            WHERE presentation.sensor = sensors_supervisors.email
            ORDER BY presentation.start');

            $rooms = DB::select('SELECT * FROM room');
            $supervisors = DB::select("SELECT * FROM sensors_supervisors WHERE status = 'sensor'");

            $title = "Endre Presentasjonsplan";
            return view('admin.EndrePresentasjonsplan')->with(['title' => $title, 'presentasjoner' => $presentasjoner, 'rooms' => $rooms, 'supervisors' => $supervisors]);
        }
        else
        {
            return redirect('/login')->with('error', 'Du er ikke admin og har ikke tilgang');
        }
    }

    //Endrer og sletter presentasjoner som er lagt inn i databasen
    public function edit(Request $request)
    {
        if(session('levell') >= 2)
        {
            if ($request->group == "")
            return redirect('/presentasjonsplan/endre')->with('error', "Du kan ikke endre grupper før de har blitt lagtt inn i presentasjonsplanen");

            $i = 0;
            foreach($request->group as $group){
                $time_start = $request->start_time[$i];
                $date_start = $request->start_date[$i];

                $dt = new DateTime($time_start, new DateTimezone('Europe/Oslo'));

                $start = $date_start." ".$dt->format('H:i');
                $dt->modify('+30 minutes');

                DB::update("UPDATE presentation
                SET presentation.start = :starts, presentation.end = :ends, presentation.presentation_room = :room, presentation.sensor = :sensor
                WHERE presentation.presentation_group_number = :group", ['group' => $group, 'starts' => $start, 'ends' => $dt, 'room' => $request->room[$i], 'sensor' => $request->sensor[$i]]);
                $i++;
            }

            if($request->remove){
                foreach($request->remove as $remove){
                    DB::delete('DELETE FROM presentation
                    WHERE presentation.presentation_group_number = :group', ['group' => $remove]);
                }
            }

            return redirect('/presentasjonsplan')->with('success', "Presentasjonsplan endret husk å generere og publisere den nye planen");
        }
        else
        {
            return redirect('/login')->with('error', 'Du er ikke admin og har ikke tilgang');
        }
    }
}
