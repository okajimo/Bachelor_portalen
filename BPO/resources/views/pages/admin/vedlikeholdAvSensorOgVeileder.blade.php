@extends('layouts.app')
@section('content')
    <div class="jumbotron">
        <div class="container">
            {{Form::label('dok', 'Registrer veileder eller sensor her.')}}
        </br>
        <div class="form-group form-inline">  
            {!! Form::open(['action' => 'Admin\AdminController@regSensorVeileder', 'method' => 'POST'])!!}
        </div>
        <div class="form-group form-inline">  
                {{form::text('email','',['placeholder'=>'Skriv inn epost her','class'=>'form-control'])}}
            </br>
        </br>
        </div>
        <div class="form-group form-inline">  
                {{form::text('firstname','',['placeholder'=>'Skriv inn fornavn her','class'=>'form-control'])}}
            </br>
        </br>
        </div>
        <div class="form-group form-inline">  
                {{form::text('lastname','',['placeholder'=>'Skriv inn etternavn her','class'=>'form-control'])}}
            </br>
        </br>
        </div>
        <div class="form-group form-inline">  
            <select name="status" class='form-control'>
                <option value="veileder">Veileder</option>
                <option value="sensor">Sensor</option>
            </select>
        </div>
            {{Form::submit('Registrer', ['class'=>'btn btn-success'])}}
            {!! Form::close() !!}
        </br>
            <table class="table table-responsive">
                <thead class="thead-light">
                    <tr>
                        <th>Email</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Status</th>
                        <th>Slett</th>
                    </tr>
                </thead>
                    @foreach ($senvei as $u)
                    <tbody>
                        <tr>
                            <td>{{$u->email}}</td>
                            <td>{{$u->firstname}}</td>
                            <td>{{$u->lastname}}</td>
                            <td>{{$u->status}}</td>
                            <td>
                                {!! Form::open(['action' => 'Admin\AdminController@slettSenvei', 'method' => 'POST','onsubmit' => 'return ConfirmDelete()'])!!}
                                    {{form::hidden('email',$u->email)}}
                                    {{form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Slett', ['class'=>'btn btn-danger'])}}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
            </table>
        </div>
    </div>
@endsection
