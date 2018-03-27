@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            {!! Form::open(['action' => ['PresentasjonController@create'], 'method' => 'POST', 'class' => 'col-2', 'style' => ' padding-left:0']) !!}
                {{Form::submit('Slett Prestasjonsplan', ['class'=>'btn btn-danger margin-fix'])}}
            {!! Form::close() !!}
        </div>
        <br> 
        <form class="row form-group">
            <div style="padding:0;" class="col-3 margin-fix">
                <input placeholder="Antall rom" name="num" type="number" min="1" max="10" class="form-control" required>
            </div>
            <div style="padding:0;" class="col-3 margin-fix" >
                <input type="submit" value="Antall dager" class="btn btn-success">
            </div>
        </form>
        @if(isset($_REQUEST["num"]))
            <div class="row" style="margin-top:2em">
                <h4>Antall dager:</h4>
            </div>
            {!! Form::open(['action' => 'PresentasjonController@store', 'method' => 'POST', 'style' => 'margin-top:0.5em;']) !!}
                <div class="row form-group">
                    <div class="col-3 margin-fix" style="padding:0;">
                        <?php $num= $_REQUEST["num"]; ?>
                        @for($i=0; $i<$num; $i++)
                            <input style="margin-bottom:0.6em"type="date" name={{"dato[".$i."]"}} class="form-control" required>
                        @endfor
                    </div>
                </div>
                <div class="row">
                    <div style="padding:0;" class="col-3" >
                        {{Form::submit('send inn datoer', ['class'=>'btn btn-success float-left', 'style' => 'width:100%'])}}
                    </div>
                </div>
            {!! Form::close() !!}
        @endif
    </div>
@endsection