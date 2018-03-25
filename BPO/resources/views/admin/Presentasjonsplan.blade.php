@extends('layouts.app')
@section('content')
{!! Form::open(['action' => ['PresentasjonController@create'], 'method' => 'POST']) !!}
    {{Form::submit('Generer plan', ['class'=>'btn btn-success margin-fix'])}}
{!! Form::close() !!}


<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.3/combined/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.3/combined/css/gijgo.min.css" rel="stylesheet" type="text/css" />


    <input id="datepicker" width="276" />
    <input id="timepicker" width="276" />
    <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4'
        });
        $('#timepicker').timepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>

@endsection