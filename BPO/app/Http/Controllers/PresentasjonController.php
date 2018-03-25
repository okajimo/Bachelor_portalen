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

        $groups = DB::select('SELECT group_number FROM groups');
        foreach ($groups as $group){
            DB::insert("INSERT INTO presentation (presentation.presentation_group_number, presentation.presentation_year, presentation.start, presentation.end, presentation.presentation_room)
            VALUES (:gnum, 2018, '2018-03-14 08:30:00', '2018-03-14 09:30:00', 'PH330')", ['gnum' => $group->group_number]);
        }

        return redirect('/presentasjonsplan')->with('success', 'En presentasjonsplan har blitt generert');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
