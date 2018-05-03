@extends('layouts.app')
@section('content')
    <div class="jumbotron">
        <div class="container">
            <p>Fyll inn feltene under for å lagre datoer i databsen</p>
            {!! Form::open(['action' => 'Admin\DateController@createDate', 'method' => 'POST']) !!}  
                <h3 class="dato">Start dato</h3>
                <div class="form-group form-inline">
                    {{Form::text('start', '', ['placeholder' => 'DD.MM.ÅÅÅÅ', 'class'=>'form-control'])}}
                </div>
                <h3 class="dato">Dato for statusrapport innlevering:</h3>
                <div class="form-group form-inline">   
                    {{Form::text('status_report', '', ['placeholder' => 'DD.MM.ÅÅÅÅ', 'class'=>'form-control'])}}
                </div>
                <h3 class="dato">Dato for prosjektskisse innlevering::</h3>
                <div class="form-group form-inline">   
                    {{Form::text('project_sketch', '', ['placeholder' => 'DD.MM.ÅÅÅÅ', 'class'=>'form-control'])}}
                </div>
                <h3 class="dato">Dato for førprosjekt opplasting:</h3>
                <div class="form-group form-inline">   
                    {{Form::text('preproject', '', ['placeholder' => 'DD.MM.ÅÅÅÅ', 'class'=>'form-control'])}}
                </div>
                <h3 class="dato">Dato for innlevering av sluttrapporten:</h3>
                <div class="form-group form-inline">   
                    {{Form::text('project_report', '', ['placeholder' => 'DD.MM.ÅÅÅÅ', 'class'=>'form-control'])}}
                </div>
                <h3 class="dato">Start dato for presentasjoner:</h3>
                <div class="form-group form-inline">   
                    {{Form::text('pres_start', '', ['placeholder' => 'DD.MM.ÅÅÅÅ', 'class'=>'form-control'])}}
                </div>
                <h3 class="dato">Slutt dato for presentasjoner:</h3>
                <div class="form-group form-inline">   
                    {{Form::text('pres_end', '', ['placeholder' => 'DD.MM.ÅÅÅÅ', 'class'=>'form-control'])}}
                </div>
                {{Form::submit('Lagre datoer', ['class'=>'btn btn-primary'])}}    
            {!! Form::close() !!}
        </div>
    </div>
@endsection
