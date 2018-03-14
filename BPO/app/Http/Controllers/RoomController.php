<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    //vis View
    public function index()
    {
        $Room = Room::all();
        $title = "Administrer rom";
        return view('rooms.administrate')->with(['title' => $title, 'Room' => $Room]);
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
            return redirect('/room')->with('success', 'Rom registrert');
        }   
        else
            return redirect('/room')->with('error', 'Rom finnes alt');
    }

    //slett rom
    public function destroy($id)
    {
        DB::delete('DELETE FROM room WHERE room = :id', ['id' => $id]);
        return redirect('/room')->with('success', 'Rom Fjernet');
    }
}
