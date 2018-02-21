@extends('layouts.app')
@section('content')
    <div class="jumbotron">
        <div class="container">
            <h3>Lag gruppe</h3>
            {!! Form::open(['action' => 'GruppeController@lag_gruppe', 'method' => 'POST'])!!}
                <!-- <div class="form-group">
                    {{Form::label('leader','Leader')}}
                    {{Form::text('leader', '', ['class' => 'form-control', 'placeholder' => 'Leader'])}}
                </div>
                <div class="form-group">
                    {{Form::label('year','Year')}}
                    {{Form::text('year', '', ['class' => 'form-control', 'placeholder' => 'Year'])}}
                </div> -->
                {{Form::submit('Registrer gruppe', ['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
            </br>
            <table class="table">
                    <tr>
                        <th>Gruppe</th>
                        <th>Prosjektside</th>
                        <th>Studenter</th>
                        <th>E-postadresse</th>
                        <th>Veileder</th>
                    </tr>
                        @foreach ($groups as $group)
                        <tr>
                            <td>{{ $group->group_number }}</td>
                            <td><a href="http://{{ $group->url }}" >{{ $group->title }}</a></td>
                            <td>{{ $student }}</td>
                            <td></td>
                            <td>{{ $group->supervisor }}</td>
                        </tr> 
                        @endforeach    
                </table>

        </div>
    </div>
@endsection