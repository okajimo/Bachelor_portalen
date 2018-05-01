@extends('layouts.app')
@section('content')
    <div class="jumbotron">
        <div class="container">
                {!! Form::open(['action' => 'RoomController@store', 'class' => 'form-inline', 'method' => 'POST']) !!}
                    <div class="form-group">
                        {{Form::text('Rom', '', ['class' => 'form-control', 'placeholder' => 'Rom navn', 'required', 'maxlength' => '45', 'pattern' => '[a-zA-z0-9 øæåØÆÅ]*', 'title' => 'Rom kan kun bestå av tall og bokstaver'])}}
                    </div>
                    {{Form::submit('Registrer Rom', ['class' => 'btn btn-primary'])}}
                {!! Form::close() !!}
            <br><br>
        
            @if(count($Room) > 0)
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th>Grupperom:</th>
                            <th></th>
                        </tr>
                    </thead>
                    @foreach($Room as $Rooms)
                        <tbody>
                        <tr>
                            <td>{{$Rooms->room}}</td>
                            <td>
                                {!! Form::open(['action' => ['RoomController@destroy', $Rooms->room], 'method' => 'POST', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Fjern Rom', ['class' => 'btn btn-danger float-right'])}}
                                {!!Form::close()!!}
                            </td>
                        </tr>
                        </tbody>
                    @endforeach
                </table>
            @else
                <p>Ingen rom er registrert</p>
            @endif
        </div>
    </div>
@endsection