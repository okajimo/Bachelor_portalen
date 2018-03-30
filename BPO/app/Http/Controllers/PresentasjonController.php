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
        $rooms = DB::select('SELECT * FROM room');
        $supervisors = DB::select("SELECT * FROM sensors_supervisors WHERE status = 'sensor'");
        $title = "Presentasjonsplan";
        return view('admin.Presentasjonsplan')->with(['title' => $title, 'rooms' => $rooms, 'supervisors' => $supervisors]);
    }

    //sletter presentasjonsplan
    public function delete()
    {
        DB::delete('DELETE FROM presentation');
        return redirect('/presentasjonsplan')->with('error', 'Prestasjonsplaner er slettet');
    }

    //oppretter presentasjonsplanen
    public function store(Request $request)
    {
        //Hvor mange presentasjoner som blir registrert perr dag
        $antall_perr_dag = $request->perr_dag;
        $tt= 0;
        $aar = date("Y");
        foreach($request["dato"] as $dato){ 
            $antall = 0;

            $time_start = $request["time"][$tt];
            $sensor = $request["sensor"][$tt];
            $room = $request["room"][$tt];

            $dt = new DateTime($time_start, new DateTimezone('Europe/Oslo'));
            $dt2 = new DateTime($time_start, new DateTimezone('Europe/Oslo'));
            $dt2->modify('+30 minutes');

            $exists = DB::select('SELECT * 
            FROM groups 
            WHERE group_number NOT IN (SELECT presentation.presentation_group_number FROM presentation)
            AND supervisor IS NOT NULL');
            
            foreach($exists as $exist){
                if ($antall < $antall_perr_dag ){
                            
                    $start = $dato." ".$dt->format('H:i');
                    $slutt = $dato." ".$dt2->format('H:i');

                    DB::insert("INSERT INTO presentation (presentation.presentation_group_number, presentation.presentation_year, presentation.start, presentation.end, presentation.presentation_room, presentation.sensor)
                    VALUES (:gnum, :aar, :starts, :slutts, :room, :sensor)", ['gnum' => $exist->group_number, 'starts' => $start, 'slutts' => $slutt, 'room' => $room, 'aar' =>$aar, 'sensor' => $sensor]);
                    
                    $dt->modify('+30 minutes');
                    $dt2->modify('+30 minutes');

                    $antall++;
                }          
            }     
            $tt++;
        }
        return redirect('/presentasjonsplan')->with('success', "Presentasjonsplan oppdatert");
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
