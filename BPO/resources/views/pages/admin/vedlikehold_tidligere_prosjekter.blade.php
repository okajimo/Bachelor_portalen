@extends('layouts.app')
@section('content')
    <div class="jumbotron">
        <div class="container">
            {!! Form::open(['action' => 'Tidligere_prosjekterController@opprett_html_sider', 'method' => 'POST']) !!}  
                <div class="form-group">  
                    {{Form::label('dok', 'Opprett html sider for tidligere prosjekter her.')}}
                </div>
                {{Form::submit('Opprett', ['class'=>'btn btn-primary'])}}    
            {!! Form::close() !!}
            </br>
        </div>
    </div>
@endsection
