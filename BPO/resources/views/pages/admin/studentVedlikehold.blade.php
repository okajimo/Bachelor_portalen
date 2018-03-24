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
                {{Form::submit('Importer studenter', ['class'=>'btn btn-primary'])}}    
            {!! Form::close() !!}
            <hr>
            {!! Form::open(['action' => 'Admin\AdminController@endreStudPoeng', 'method' => 'POST']) !!}  
                <div class="form-group">  
                    {{Form::label('fil', 'Velg student for endring av poeng.')}}
                </br>
                    <?php $studenter = DB::select('SELECT username FROM users WHERE level ="1"');?>
                        <select name="student">
                            @foreach($studenter as $stud)
                                <option value={{$stud->username}}>{{$stud->username}}</option>
                            @endforeach
                        </select>
                    {{Form::text('poeng','',['placeholder'=>'Skriv inn poeng her'])}}
                </div>
                {{Form::submit('Endre poeng', ['class'=>'btn btn-primary'])}}    
            {!! Form::close() !!}
        </div>
    </div>
@endsection
