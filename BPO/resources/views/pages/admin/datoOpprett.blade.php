@extends('layouts.app')
@section('content')
    <div class="jumbotron">
        <div class="container">
            @include('inc.feilmld')
            <p>Fyll inn feltene under for å lagre datoer i databsen</p>
            {!! Form::open(['action' => 'Admin\DateController@createDate', 'method' => 'POST']) !!}  
                {{Form::label('start', 'Start dato')}} 
                    <div class="form-group form-inline">
                        {{Form::text('start', '', ['placeholder' => 'DD.MM.ÅÅÅÅ', 'class'=>'form-control'])}}
                    </div>
                {{Form::label('status_report', 'Dato for statusrapport innlevering:')}}
                    <div class="form-group form-inline">   
                        {{Form::text('status_report', '', ['placeholder' => 'DD.MM.ÅÅÅÅ', 'class'=>'form-control'])}}
                    </div>
                {{Form::label('project_sketch', 'Dato for prosjektskisse innlevering:')}}
                    <div class="form-group form-inline">   
                        {{Form::text('project_sketch', '', ['placeholder' => 'DD.MM.ÅÅÅÅ', 'class'=>'form-control'])}}
                    </div>
                {{Form::label('preproject', 'Dato for førprosjekt opplasting:')}}
                    <div class="form-group form-inline">   
                        {{Form::text('preproject', '', ['placeholder' => 'DD.MM.ÅÅÅÅ', 'class'=>'form-control'])}}
                    </div>
                {{Form::label('project_report', 'Dato for innlevering av sluttrapporten:')}}
                    <div class="form-group form-inline">   
                        {{Form::text('project_report', '', ['placeholder' => 'DD.MM.ÅÅÅÅ', 'class'=>'form-control'])}}
                    </div>
                {{Form::label('pres_start', 'Start dato for presentasjoner:')}}
                    <div class="form-group form-inline">   
                        {{Form::text('pres_start', '', ['placeholder' => 'DD.MM.ÅÅÅÅ', 'class'=>'form-control'])}}
                    </div>
                {{Form::label('pres_end', 'Slutt dato for presentasjoner:')}}
                    <div class="form-group form-inline">   
                        {{Form::text('pres_end', '', ['placeholder' => 'DD.MM.ÅÅÅÅ', 'class'=>'form-control'])}}
                    </div>
                {{Form::submit('Lagre datoer', ['placeholder' => 'DD.MM.ÅÅÅÅ', 'class'=>'btn btn-primary'])}}    
            {!! Form::close() !!}
        </div>
    </div>
@endsection
