<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    public function __construct()
    {
        DB::connection()->enableQueryLog();
    }

    //vis View
    public function index()
    {
        if(session('levell') >= 2)
        {
            $Room = Room::all();
            $title = "Administrer rom";
            return view('rooms.administrate')->with(['title' => $title, 'Room' => $Room]);
        }
        else
        {
            return redirect('/')->with('error', 'Du er ikke admin og har ikke tilgang');
        } 
    }


    //lagre rom
    public function store(Request $request)
    {
        $this->validate($request, [
            'Rom' => 'required|alpha_num|max:45'
        ]);
        
        //legg til rom
        $rom_finnes = DB::select('SELECT * FROM room WHERE room = :request', ['request' => $request->Rom]);
        if(!$rom_finnes){
            DB::insert('INSERT INTO ROOM (room) VALUES (:request)',['request' => $request->Rom]);
            $query = DB::getQueryLog();
            $log = \LogHelper::logSql(end($query), 'RoomController');
            return redirect('/room')->with('success', 'Rom registrert');
        }   
        else
            return redirect('/room')->with('error', 'Rom finnes alt');
    }

    //slett rom
    public function destroy($id)
    {
        $ibruk = DB::select('SELECT presentation_room FROM presentation, room 
        WHERE presentation.presentation_room = room.room 
        AND presentation.presentation_room = :id', ['id' => $id]);

        if ($ibruk){
            return redirect('/room')->with('error', 'Rommet er allerede i bruk og må fjernes fra presentasjonsplanen, før det kan slettes');
        }
        else{
            DB::delete('DELETE FROM room WHERE room = :id', ['id' => $id]);
            $query = DB::getQueryLog();
            $log = \LogHelper::logSql(end($query), 'RoomController');
            return redirect('/room')->with('success', 'Rom Fjernet');
        }
        
    }
}
