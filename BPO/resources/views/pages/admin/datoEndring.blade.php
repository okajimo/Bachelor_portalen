@extends('layouts.app')
@section('content')
    <div class="jumbotron">
        <div class="container">
            {!! Form::open(['action' => 'Admin\DateController@editDate', 'method' => 'POST']) !!}   
                {{Form::label('start', 'Start dato')}}    
                    <div class="form-group form-inline">   
                        {{Form::text('start', \DateHelper::instance()->date('start'), ['class'=>'form-control', 'required', 'pattern' => '(0[1-9]|[12][0-9]|3[01])\.(0[1-9]|1[012])\.(2[0-9])[0-9]{2}', 'title' => 'Dato må være på et norskt format'])}}
                    </div>
                {{Form::label('status_report', 'Dato for statusrapport innlevering:')}}
                    <div class="form-group form-inline">   
                        {{Form::text('status_report', \DateHelper::instance()->date('status_report'), ['class'=>'form-control', 'pattern' => '(0[1-9]|[12][0-9]|3[01])\.(0[1-9]|1[012])\.(2[0-9])[0-9]{2}', 'title' => 'Dato må være på et norskt format'])}}
                    </div>
                {{Form::label('project_sketch', 'Dato for prosjektskisse innlevering:')}}
                    <div class="form-group form-inline">   
                        {{Form::text('project_sketch', \DateHelper::instance()->date('project_sketch'), ['class'=>'form-control', 'pattern' => '(0[1-9]|[12][0-9]|3[01])\.(0[1-9]|1[012])\.(2[0-9])[0-9]{2}', 'title' => 'Dato må være på et norskt format'])}}
                    </div>
                {{Form::label('preproject', 'Dato for førprosjekt opplasting:')}}
                    <div class="form-group form-inline">   
                        {{Form::text('preproject', \DateHelper::instance()->date('preproject'), ['class'=>'form-control', 'pattern' => '(0[1-9]|[12][0-9]|3[01])\.(0[1-9]|1[012])\.(2[0-9])[0-9]{2}', 'title' => 'Dato må være på et norskt format'])}}
                    </div>
                {{Form::label('project_report', 'Dato for innlevering av sluttrapporten:')}}
                    <div class="form-group form-inline">   
                        {{Form::text('project_report', \DateHelper::instance()->date('project_report'), ['class'=>'form-control', 'pattern' => '(0[1-9]|[12][0-9]|3[01])\.(0[1-9]|1[012])\.(2[0-9])[0-9]{2}', 'title' => 'Dato må være på et norskt format'])}}
                    </div>
                {{Form::label('pres_start', 'Start dato for presentasjoner:')}}
                    <div class="form-group form-inline">   
                        {{Form::text('pres_start', \DateHelper::instance()->date('pres_start'), ['class'=>'form-control', 'pattern' => '(0[1-9]|[12][0-9]|3[01])\.(0[1-9]|1[012])\.(2[0-9])[0-9]{2}', 'title' => 'Dato må være på et norskt format'])}}
                    </div>
                {{Form::label('pres_end', 'Slutt dato for presentasjoner:')}}
                    <div class="form-group form-inline">   
                        {{Form::text('pres_end', \DateHelper::instance()->date('pres_end'), ['class'=>'form-control', 'pattern' => '(0[1-9]|[12][0-9]|3[01])\.(0[1-9]|1[012])\.(2[0-9])[0-9]{2}', 'title' => 'Dato må være på et norskt format'])}}
                    </div>
                {{Form::submit('Oppdater datoer', ['class'=>'btn btn-primary'])}}    
            {!! Form::close() !!}
        </div>
    </div>
@endsection
