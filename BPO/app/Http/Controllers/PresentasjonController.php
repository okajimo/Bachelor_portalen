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
            return redirect('/login')->with('error', 'Du har ikke tilgang til denne siden.');
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

            return redirect('/presentasjonsplan')->with('success', 'Prestasjonsplaner er slettet');
        }
        else
        {
            return redirect('/login')->with('error', 'Du har ikke tilgang til denne siden.');
        }
    }

    //oppretter presentasjonsplanen
    public function store(Request $request)
    {
        if(session('levell') >= 2)
        {
            if($request->lunsj)
            {
                $this->validate($request, [
                    'lunsj' => 'date_format:H:i',
                    'dates' => 'required|date',
                    'time' => 'required|date_format:H:i',
                ]);
            }
            
            if ($request->gruppe) {
                
                $aar = date("Y");
                $dato = $request->dates;
                $groups = $request->gruppe;
                $time_start = $request->time;
                $lunsj = $request->lunsj;
                $sensor = $request->sensor;
                $room = $request->room;
                
                /*Eks: si at $lunsj er klokken 10, da må det sjekkes i det 35 minutter lange tidsrommet etter klokken 10*/
                $lunsj_check_start = new DateTime($lunsj, new DateTimezone('Europe/Oslo'));
                $lunsj_check_start->modify('+30 minutes');
                $lunsj_check_slutt = new DateTime($lunsj, new DateTimezone('Europe/Oslo'));
                $lunsj_check_slutt->modify('+65 minutes');

                /*Hvor lenge en presentasjon varer*/
                $p_start = new DateTime($time_start, new DateTimezone('Europe/Oslo'));
                $p_slutt = new DateTime($time_start, new DateTimezone('Europe/Oslo'));
                $p_slutt->modify('+30 minutes');
                
                foreach($groups as $group){
                    /*lunsj*/
                    if(($p_start>= $lunsj_check_start && $p_start <= $lunsj_check_slutt) || 
                    ($p_slutt>= $lunsj_check_start && $p_slutt<= $lunsj_check_slutt)){
                        $p_start->modify('+30 minutes');
                        $p_slutt->modify('+30 minutes');
                    }

                    $start = $dato." ".$p_start->format('H:i');
                    $slutt = $dato." ".$p_slutt->format('H:i');

                    /*Genererer presentasjonsplan*/
                    DB::insert("INSERT INTO presentation (presentation.presentation_group_number, presentation.presentation_year, presentation.start, presentation.end, presentation.presentation_room, presentation.sensor)
                    VALUES (:gnum, :aar, :starts, :slutts, :room, :sensor)", ['gnum' => $group, 'starts' => $start, 'slutts' => $slutt, 'room' => $room, 'aar' =>$aar, 'sensor' => $sensor]);
                    
                    $p_start->modify('+35 minutes');
                    $p_slutt->modify('+35 minutes');

                    $grupperLaget[] = $group;
                }  
                
                $grupper = "";
                foreach($grupperLaget as $grupp)
                {
                    $grupper .= $grupp." ";
                }
                $bruker = session('navn');
                \LogHelper::Log($bruker." har opprettet presentasjonsplan for gruppene: ".$grupper, "1"); 
    
                return redirect('/presentasjonsplan')->with('success', "Presentasjonsplan oppdatert, husk å generere og publisere planen for studentene");
            }
            else
                return redirect('/presentasjonsplan')->with('error', "du må hvertfall velge en gruppe");
        }
        else
        {
            return redirect('/login')->with('error', 'Du har ikke tilgang til denne siden.');
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
            return redirect('/login')->with('error', 'Du har ikke tilgang til denne siden.');
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

                $p_start = new DateTime($time_start, new DateTimezone('Europe/Oslo'));

                $start = $date_start." ".$p_start->format('H:i');
                $p_start->modify('+30 minutes');

                DB::update("UPDATE presentation
                SET presentation.start = :starts, presentation.end = :ends, presentation.presentation_room = :room, presentation.sensor = :sensor
                WHERE presentation.presentation_group_number = :group", ['group' => $group, 'starts' => $start, 'ends' => $p_start, 'room' => $request->room[$i], 'sensor' => $request->sensor[$i]]);
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
            return redirect('/login')->with('error', 'Du har ikke tilgang til denne siden.');
        }
    }
}
