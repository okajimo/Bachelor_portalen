@extends('layouts.app')
@section('content')
    <div class="jumbotron">
        <div class="container">
            <p>Fyll inn feltene under for å lagre datoer i databsen</p>
            @if ($dates == 'mangler')    
                {!! Form::open(['action' => 'Admin\DateController@createDate', 'method' => 'POST']) !!}  
                    <h3 class="dato">Start dato</h3>
                    <div class="form-group form-inline">
                        {{Form::date('start', '', ['placeholder' => 'DD.MM.ÅÅÅÅ', 'class'=>'form-control'])}}
                    </div>
                    <h3 class="dato">Dato for statusrapport innlevering:</h3>
                    <div class="form-group form-inline">   
                        {{Form::date('status_report', '', ['placeholder' => 'DD.MM.ÅÅÅÅ', 'class'=>'form-control'])}}
                    </div>
                    <h3 class="dato">Dato for prosjektskisse innlevering:</h3>
                    <div class="form-group form-inline">   
                        {{Form::date('project_sketch', '', ['placeholder' => 'DD.MM.ÅÅÅÅ', 'class'=>'form-control'])}}
                    </div>
                    <h3 class="dato">Dato for førprosjekt opplasting:</h3>
                    <div class="form-group form-inline">   
                        {{Form::date('preproject', '', ['placeholder' => 'DD.MM.ÅÅÅÅ', 'class'=>'form-control'])}}
                    </div>
                    <h3 class="dato">Dato for innlevering av sluttrapporten:</h3>
                    <div class="form-group form-inline">   
                        {{Form::date('project_report', '', ['placeholder' => 'DD.MM.ÅÅÅÅ', 'class'=>'form-control'])}}
                    </div>
                    <h3 class="dato">Start dato for presentasjoner:</h3>
                    <div class="form-group form-inline">   
                        {{Form::date('pres_start', '', ['placeholder' => 'DD.MM.ÅÅÅÅ', 'class'=>'form-control'])}}
                    </div>
                    <h3 class="dato">Slutt dato for presentasjoner:</h3>
                    <div class="form-group form-inline">   
                        {{Form::date('pres_end', '', ['placeholder' => 'DD.MM.ÅÅÅÅ', 'class'=>'form-control'])}}
                    </div>
                    {{Form::submit('Lagre datoer', ['class'=>'btn btn-primary'])}}    
                {!! Form::close() !!}
            @else
                {!! Form::open(['action' => 'Admin\DateController@editDate', 'method' => 'POST']) !!}  
                    <h3 class="dato">Start dato</h3>
                    <div class="form-group form-inline">
                        {{Form::date('start', $dates[0]->date, ['placeholder' => 'DD.MM.ÅÅÅÅ', 'class'=>'form-control'])}}
                    </div>
                    <h3 class="dato">Dato for statusrapport innlevering:</h3>
                    <div class="form-group form-inline">   
                        {{Form::date('status_report', $dates[1]->date, ['placeholder' => 'DD.MM.ÅÅÅÅ', 'class'=>'form-control'])}}
                    </div>
                    <h3 class="dato">Dato for prosjektskisse innlevering:</h3>
                    <div class="form-group form-inline">   
                        {{Form::date('project_sketch', $dates[2]->date, ['placeholder' => 'DD.MM.ÅÅÅÅ', 'class'=>'form-control'])}}
                    </div>
                    <h3 class="dato">Dato for førprosjekt opplasting:</h3>
                    <div class="form-group form-inline">   
                        {{Form::date('preproject', $dates[3]->date, ['placeholder' => 'DD.MM.ÅÅÅÅ', 'class'=>'form-control'])}}
                    </div>
                    <h3 class="dato">Dato for innlevering av sluttrapporten:</h3>
                    <div class="form-group form-inline">   
                        {{Form::date('project_report', $dates[4]->date, ['placeholder' => 'DD.MM.ÅÅÅÅ', 'class'=>'form-control'])}}
                    </div>
                    <h3 class="dato">Start dato for presentasjoner:</h3>
                    <div class="form-group form-inline">   
                        {{Form::date('pres_start', $dates[5]->date, ['placeholder' => 'DD.MM.ÅÅÅÅ', 'class'=>'form-control'])}}
                    </div>
                    <h3 class="dato">Slutt dato for presentasjoner:</h3>
                    <div class="form-group form-inline">   
                        {{Form::date('pres_end', $dates[6]->date, ['placeholder' => 'DD.MM.ÅÅÅÅ', 'class'=>'form-control'])}}
                    </div>
                    {{Form::submit('Lagre datoer', ['class'=>'btn btn-primary'])}}    
                {!! Form::close() !!}
            @endif
        </div>
    </div>
@endsection