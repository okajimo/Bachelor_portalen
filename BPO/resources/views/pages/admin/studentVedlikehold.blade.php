@extends('layouts.app')
@section('content')
    <div class="jumbotron">
        <div class="container">
            {!! Form::open(['action' => 'Admin\AdminController@importerStud', 'method' => 'POST', 'files' => true]) !!}  
                <div class="form-group">  
                    {{Form::label('fil', 'Velg fil for opplastning av studenter.')}}
                    </br>
                    {{Form::file('fil')}}
                </div>
                {{Form::submit('Importer studenter', ['class'=>'btn btn-info'])}}    
            {!! Form::close() !!}
            <hr>
            {!! Form::open(['action' => 'Admin\AdminController@endreStudPoeng', 'method' => 'POST']) !!}  
                <div class="form-group">  
                    {{Form::label('fil', 'Velg student for endring av poeng.')}}
                </br>
                    <?php $studenter = DB::select('SELECT username FROM users WHERE level ="1"');?>
                    <div class="form-group form-inline">
                        <select name="student" class='form-control'>
                            @foreach($studenter as $stud)
                                <option value={{$stud->username}}>{{$stud->username}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group form-inline">
                    {{Form::text('poeng','',['placeholder'=>'Skriv inn poeng her','class'=>'form-control', 'required', 'maxlength' => '15', 'pattern' => '[0-9]*', 'title' => 'Poeng må bestå av kun tall'])}}
                    </div>
                </div>
                {{Form::submit('Endre poeng', ['class'=>'btn btn-info'])}}    
            {!! Form::close() !!}

            <hr>
            {!! Form::open(['action' => 'Admin\AdminController@resetPassword', 'method' => 'POST']) !!}  
                <div class="form-group">  
                    {{Form::label('fil', 'Velg student for nytt passord og send mail.')}}
                </br>
                    <?php $studenter = DB::select('SELECT username FROM users WHERE level ="1"');?>
                    <div class="form-group form-inline">
                        <select name="student" class='form-control'>
                            @foreach($studenter as $stud)
                                <option value={{$stud->username}}>{{$stud->username}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group form-inline">
                    </div>
                </div>
                {{Form::submit('Nytt passord', ['class'=>'btn btn-info'])}}    
            {!! Form::close() !!}
        </div>
    </div>
@endsection
