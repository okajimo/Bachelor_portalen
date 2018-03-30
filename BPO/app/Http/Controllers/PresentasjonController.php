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
        $title = "Presentasjonsplan";
        return view('admin.Presentasjonsplan')->with(['title' => $title, 'rooms' => $rooms]);
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

        $aar = date("Y");
        $groups = DB::select('SELECT group_number FROM groups');
        foreach($request["dato"] as $dato){ 
            $antall = 0;

            foreach($request["room"] as $room){  
                $dt = new DateTime('09:00', new DateTimezone('Europe/Oslo'));
                $dt2 = new DateTime('09:30', new DateTimezone('Europe/Oslo'));

                $exists = DB::select('SELECT * 
                FROM groups 
                WHERE group_number NOT IN (SELECT presentation.presentation_group_number FROM presentation)
                AND supervisor IS NOT NULL');

                foreach($exists as $exist){
                    if ($antall < $antall_perr_dag ){
                                
                        $start = $dato." ".$dt->format('H:i');
                        $slutt = $dato." ".$dt2->format('H:i');

                        DB::insert("INSERT INTO presentation (presentation.presentation_group_number, presentation.presentation_year, presentation.start, presentation.end, presentation.presentation_room)
                        VALUES (:gnum, :aar, :starts, :slutts, :room)", ['gnum' => $exist->group_number, 'starts' => $start, 'slutts' => $slutt, 'room' => $room, 'aar' =>$aar]);
                        
                        $dt->modify('+30 minutes');
                        $dt2->modify('+30 minutes');

                        $antall++;
                    }           
                }      
            }
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
