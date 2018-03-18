@extends('layouts.app')
@section('content')
    <div class="jumbotron">
        <div class="container">
            {!! Form::open(['action' => 'SimulerController@simuler', 'method' => 'POST']) !!}  
                <div class="form-group">  
                    <select required class="custom-select" name="student">
                        <option hidden disabled selected>Simuler Student</option>
                        @foreach($student as $students)
                            <option value={{$students->username}}>{{$students->username.' ------- '.$students->firstname.' '.$students->lastname}}</option>
                        @endforeach
                    </select>
                </div>
                {{Form::hidden('inn_navn',session('navn'))}}
                {{Form::hidden('inn_level',session('level'))}}
                {{Form::submit('Start Simulering', ['class'=>'btn btn-primary'])}}   
            {!! Form::close() !!}
        </div>
    </div>
@endsection