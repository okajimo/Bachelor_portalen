@extends('layouts.app')
@section('content')

<div class="container container-no-padding"> 
    <button style="font-family: Helvetica, Arial, sans-serif; font-size: 1.3em; font-weight: bold" type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Legg til Veileder/Sensor</button><br><br>
    <h4>Sensorer:</h4>
    <table class="table table-responsive">
        <thead class="thead-light">
            <tr>
                <th>Email</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Slett</th>
            </tr>
        </thead>
            @foreach ($senvei as $u)
            @if($u->status == "sensor")
                    <tbody class="bg-light">
                        <tr>
                            <td>{{$u->email}}</td>
                            <td>{{$u->firstname}}</td>
                            <td>{{$u->lastname}}</td>
                            <td>
                                {!! Form::open(['action' => 'Admin\AdminController@slettSenvei', 'method' => 'POST','onsubmit' => 'return ConfirmDelete()'])!!}
                                    {{form::hidden('email',$u->email)}}
                                    {{form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Slett', ['class'=>'btn btn-danger'])}}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    </tbody>
                @endif
            @endforeach
    </table>
    <h4>Veileder:</h4>
    <table class="table table-responsive">
        <thead class="thead-light">
            <tr>
                <th>Email</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Slett</th>
            </tr>
        </thead>
            @foreach ($senvei as $u)
                @if($u->status == "veileder")
                    <tbody class="bg-light">
                        <tr>
                            <td>{{$u->email}}</td>
                            <td>{{$u->firstname}}</td>
                            <td>{{$u->lastname}}</td>
                            <td>
                                {!! Form::open(['action' => 'Admin\AdminController@slettSenvei', 'method' => 'POST','onsubmit' => 'return ConfirmDelete()'])!!}
                                    {{form::hidden('email',$u->email)}}
                                    {{form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Slett', ['class'=>'btn btn-danger'])}}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    </tbody>
                @endif
            @endforeach
    </table>
</div>


<!-- Modal -->
<div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Registrer Sensor/veileder</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group form-inline">  
                {!! Form::open(['action' => 'Admin\AdminController@regSensorVeileder', 'method' => 'POST'])!!}
            </div>
            <h6>Mottaker:</h6>
            <div class="form-group form-inline">  
                <select name="status" class='form-control'>
                    <option value="sensor">Sensor</option>
                    <option value="veileder">Veileder</option>
                </select>
            </div>
            <h6>Epost:</h6>
            <div class="form-group form-inline">
                {{form::text('email','',['placeholder'=>'hans@gmail.com','class'=>'form-control', 'required', 'maxlength' => '45','pattern' => '((?!;).)*', 'title' => 'Eposten må fylles ut riktig'])}}
            </div>
            <h6>Fornavn: </h6>
            <div class="form-group form-inline">  
                {{form::text('firstname','',['placeholder'=>'Ola','class'=>'form-control', 'required', 'maxlength' => '45', 'pattern' => '[a-zA-z øæåØÆÅ]*', 'title' => 'Navn kan kun bestå av bokstaver'])}}
            </div>
            <h6>Etternavn:</h6>
            <div class="form-group form-inline">  
                {{form::text('lastname','',['placeholder'=>'Nordman','class'=>'form-control', 'required', 'maxlength' => '45','pattern' => '[a-zA-z øæåØÆÅ]*', 'title' => 'Navn kan kun bestå av bokstaver'])}}
            </div>
            <div class="modal-footer">
                {{Form::submit('Registrer', ['class'=>'btn btn-success'])}}
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
                {!! Form::close() !!}
        </div>
        </div>
    </div>
</div>
@endsection
