@extends('layouts.app')
@section('content')
    <div class="jumbotron">
        <div class="container">
            {!! Form::open(['action' => 'GruppeController@lastOppDok', 'method' => 'POST', 'files' => true]) !!}
                <div class="form-group">    
                    {{Form::label('type', 'Velg type dokument som skal lastes opp')}}
                    </br>
                    {{Form::select('type', ['statusrapport' => 'Statusrapport', 'prosjektskisse' => 'Prosjektskisse'], null, ['placeholder' => 'Velg type dokument'])}}
                </div>    
                <div class="form-group">    
                    {{Form::label('dok', 'Velg fil for opplastning')}}
                    </br>
                    {{Form::file('dok')}}
                </div>
                {{Form::submit('Last opp dokument', ['class'=>'btn btn-primary'])}}    
            {!! Form::close() !!}
        </div>
    </div>
@endsection