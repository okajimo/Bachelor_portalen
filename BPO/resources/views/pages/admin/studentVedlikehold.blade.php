@extends('layouts.app')
@section('content')
    <div class="container container-no-padding">
        <table class="table">
            <div class="tale-responsive">
                <tbody class="bg-light" >
                    <tr>
                        <td style="border-top: 0">
                            {!! Form::open(['action' => 'Admin\AdminController@importerStud', 'method' => 'POST', 'files' => true]) !!}  
                                <div class="form-group">  
                                    <h5>Velg fil for opplastning av studenter.</h5>
                                    </br>
                                    {{Form::file('fil')}}
                                </div>
                                {{Form::submit('Importer studenter', ['class'=>'btn btn-success'])}}    
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {!! Form::open(['action' => 'Admin\AdminController@leggTilStudent', 'method' => 'POST']) !!}  
                                <div class="form-group">  
                                    <h5>{{Form::label('fil', 'Registrer student her.')}}</h5>
                                </br>
                                    <div class="form-group form-inline">
                                        {{Form::text('student','',['placeholder'=>'Student id her','class'=>'form-control', 'required', 'maxlength' => '15', 'pattern' => '[a-zA-z0-9 øæåØÆÅ]*', 'title' => 'Poeng må bestå av kun tall'])}}
                                    </div>
                                    <div class="form-group form-inline">
                                        {{Form::text('poeng','',['placeholder'=>'Skriv inn poeng her','class'=>'form-control', 'required', 'maxlength' => '15', 'pattern' => '[0-9]*', 'title' => 'Poeng må bestå av kun tall'])}}
                                    </div>
                                    <div class="form-group form-inline">
                                        {{Form::text('linje','',['placeholder'=>'Skriv inn linje til her','class'=>'form-control', 'required', 'maxlength' => '30', 'pattern' => '[a-zA-z øæåØÆÅ]*', 'title' => 'Poeng må bestå av kun tall'])}}
                                    </div>
                                </div>
                                {{Form::submit('Registrer student', ['class'=>'btn btn-success', 'style' => 'color:white'])}}    
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {!! Form::open(['action' => 'Admin\AdminController@endreStudPoeng', 'method' => 'POST']) !!}  
                                <div class="form-group">  
                                    <h5>{{Form::label('fil', 'Velg student for endring av poeng.')}}</h5>
                                </br>
                                    <?php $studenter = DB::select('SELECT * FROM users WHERE level ="1"');?>
                                    <div class="form-group form-inline">
                                        <input pattern="[s]{1}[0-9]{6}" title="må skrives på dette formatet s000000" class="form-control"placeholder="Student" type="search" name="student" list="students" required>
                                        <datalist id="students">
                                            @foreach($studenter as $students)
                                                <option required value={{$students->username}}>{{$students->firstname.' '.$students->lastname}}</option>
                                            @endforeach
                                        </datalist>
                                    </div>
                                    <div class="form-group form-inline">
                                    {{Form::text('poeng','',['placeholder'=>'Skriv inn poeng her','class'=>'form-control', 'required', 'maxlength' => '15', 'pattern' => '[0-9]*', 'title' => 'Poeng må bestå av kun tall'])}}
                                    </div>
                                </div>
                                {{Form::submit('Endre poeng', ['class'=>'btn btn-warning', 'style' => 'color:white'])}}    
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {!! Form::open(['action' => 'Admin\AdminController@resetPassword', 'method' => 'POST', 'onsubmit' => 'return ConfirmEdit()']) !!}  
                                <div class="form-group">  
                                    <h5>{{Form::label('fil', 'Velg student for nytt passord og send mail.')}}</h5>
                                </br>
                                    <?php $studenter = DB::select('SELECT * FROM users WHERE level ="1"');?>
                                    <div class="form-group form-inline">
                                        <input pattern="[s]{1}[0-9]{6}" title="må skrives på dette formatet s000000" class="form-control"placeholder="Student" type="search" name="student" list="students" required>
                                        <datalist id="students">
                                            @foreach($studenter as $students)
                                                <option required value={{$students->username}}>{{$students->firstname.' '.$students->lastname}}</option>
                                            @endforeach
                                        </datalist>
                                    </div>
                                    <div class="form-group form-inline">
                                    </div>
                                </div>
                                {{Form::submit('Nytt passord', ['class'=>'btn btn-warning'])}}    
                            {!! Form::close() !!}
                        </td>
                    </tr>
                </tbody>
            </div>
        </table>
    </div>
@endsection
