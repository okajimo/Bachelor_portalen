@extends('layouts.app')
@section('content')
    {!! Form::open(['action' => 'RoomController@store', 'method' => 'POST']) !!}
        <div class="form-group form-inline">
            {{Form::text('Rom', '', ['class' => 'form-control', 'placeholder' => 'Rom navn'])}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection