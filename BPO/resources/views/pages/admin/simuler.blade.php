@extends('layouts.app')
@section('content')
    <div class="jumbotron">
        <div class="container">
            {!! Form::open(['action' => 'SimulerController@simuler', 'method' => 'POST']) !!}  
            <div class="form-group">  
                <select required class="custom-select" name="student">
                    <option hidden disabled selected>Simuler Student</option>
                    @foreach($student as $students)
                        <option value={{$students->username}}>{{$students->username}}</option>
                    @endforeach
                </select>
            </div>
            {{Form::hidden('inn_navn',session('navn'))}}
            {{Form::hidden('inn_level',session('level'))}}
            {{Form::submit('Start Simulering', ['class'=>'btn btn-primary'])}}   
            {!! Form::close() !!}
            
            lagret: <br>
            {{session('orginal_navn')}} <br>
            {{session('orginal_level')}}
            
            <br><br>

            Nåværende: <br>
            Navn: {{session('navn')}} <br>
            Level: {{session('level')}}
        </div>
    </div>
@endsection