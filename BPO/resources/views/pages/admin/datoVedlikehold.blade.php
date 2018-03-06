@extends('layouts.app')
@section('content')
    <div class="jumbotron">
        <div class="container">
            @include('inc.feilmld')
            <p>Dato står i format yyyy-mm-dd</p>
            {!! Form::open(['action' => 'Admin\AdminController@datoEndring', 'method' => 'POST']) !!}   
                <div class="form-group">   
                    {{Form::label('start', 'Start dato')}}
                    </br>
                    {{Form::text('start', $date[0]->start, ['class'=>'.form-control'])}}
                </div>
                <div class="form-group">   
                    {{Form::label('status_report', 'Dato for statusrapport innlevering:')}}
                    </br>
                    {{Form::text('status_report', $date[0]->status_report, ['class'=>'.form-control'])}}
                </div>
                <div class="form-group">   
                    {{Form::label('project_sketch', 'Dato for prosjektskisse innlevering:')}}
                    </br>
                    {{Form::text('project_sketch', $date[0]->project_sketch, ['class'=>'.form-control'])}}
                </div>
                <div class="form-group">   
                    {{Form::label('preproject', 'Dato for førprosjekt opplasting:')}}
                    </br>
                    {{Form::text('preproject', $date[0]->preproject, ['class'=>'.form-control'])}}
                </div>
                <div class="form-group">   
                    {{Form::label('project_report', 'Dato for innlevering av sluttrapporten:')}}
                    </br>
                    {{Form::text('project_report', $date[0]->project_report, ['class'=>'.form-control'])}}
                </div>
                <div class="form-group">   
                    {{Form::label('pres_start', 'Start dato for presentasjoner:')}}
                    </br>
                    {{Form::text('pres_start', $date[0]->pres_start, ['class'=>'.form-control'])}}
                </div>
                <div class="form-group">   
                    {{Form::label('pres_end', 'Slutt dato for presentasjoner:')}}
                    </br>
                    {{Form::text('pres_end', $date[0]->pres_start, ['class'=>'.form-control'])}}
                </div>
                {{Form::submit('Oppdater datoer', ['class'=>'btn btn-primary'])}}    
            {!! Form::close() !!}
        </div>
    </div>
@endsection
