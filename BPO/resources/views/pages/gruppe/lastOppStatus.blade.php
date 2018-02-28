@extends('layouts.app')
@section('content')
    <div class="jumbotron">
        <div class="container">
                @include('inc.feilmld')
            {!! Form::open(['action' => 'GruppeController@lastOppDok', 'method' => 'POST', 'files' => true]) !!}   
                <div class="form-group">   
                    {{Form::hidden('type', 'statusrapport')}}
                    {{Form::label('dok', 'Velg fil for opplastning')}}
                    </br>
                    {{Form::file('dok')}}
                </div>
                {{Form::submit('Last opp dokument', ['class'=>'btn btn-primary'])}}    
            {!! Form::close() !!}
        </div>
    </div>
@endsection