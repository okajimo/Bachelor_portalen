<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PresentasjonController extends Controller
{
    public function index()
    {
        $title = "Presentasjonsplan";
        return view('admin.Presentasjonsplan')->with('title', $title);
    }

    //create a random created plan
    public function create()
    {
        DB::delete('DELETE FROM presentation');

        return redirect('/presentasjonsplan')->with('error', 'Prestasjonsplaner er slettet');
    }

    public function store(Request $request)
    {
        //Hvor mange presentasjoner som blir registrert perr dag
        $antall_perr_dag = 2;
        $groups = DB::select('SELECT group_number FROM groups');

        foreach($request["dato"] as $dato){
            $antall = 0;

            $tid= 10;
            $tid2= 30;
            
            $exists = DB::select('SELECT groups.group_number 
            FROM groups 
            WHERE group_number 
            NOT IN (SELECT presentation.presentation_group_number FROM presentation)');

            foreach($exists as $exist){
                if ($antall < $antall_perr_dag){
        
                    $time=mktime($tid, $tid2);
                    $start = date("h:i", $time);
                    $start = $dato." ".$start;

                    DB::insert("INSERT INTO presentation (presentation.presentation_group_number, presentation.presentation_year, presentation.start, presentation.end, presentation.presentation_room)
                    VALUES (:gnum, 2018, :starts, '2018/03/14 10:30', 'PH330')", ['gnum' => $exist->group_number, 'starts' => $start]);
                    
                    $tid +=2;
                    $tid2 +=30;
                    
                }
                $antall++;
            }      
        }
        return redirect('/presentasjonsplan')->with('success', "Presentasjonsplan oppdatert");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
