@extends('layouts.app')
@section('content')
    <a class="btn btn-primary" href="/room/create">Legg til rom</a>
    <br><br><br>
    @if(count($Room) > 0)
        @foreach($Room as $Rooms)
            <div "card card-body">
                <h3><a href="/room/{{$Rooms->room}}">{{$Rooms->room}}</a></h3>
            </div>
        @endforeach
    @else
        <p>Ingen rom er registrert</p>
    @endif
@endsection