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
                <input type="submit" value="Antall Rom" class="btn btn-success">
            </div>
        </form>
        @if(isset($_REQUEST["num"]))
            {!! Form::open(['action' => 'PresentasjonController@store', 'method' => 'POST', 'class' => 'row', 'style' => 'margin-top:0.5em;']) !!}
                <div class="col form-group" style="padding:0;">
                    <div class="col-3 margin-fix" style="padding:0;">
                        <?php $num= $_REQUEST["num"]; ?>
                        @for($i=0; $i<$num; $i++)
                            <h4 style="margin-top:1em">Rom {{$i+1}}:</h4>
                            <input type="date" name={{"dato[".$i."]"}} class="form-control" required> <br>
                            <select required class="custom-select" name={{"room[".$i."]"}}>
                                @foreach($rooms as $room)
                                    <option value={{$room->room}}>{{$room->room}}</option>
                                @endforeach
                            </select>
                        @endfor
                    </div>
                </div>
                <div class="col-12" style="padding:0; margin-top:0.6em">
                    <div style="padding:0;" class="col-3" >
                        {{Form::submit('Oppdater', ['class'=>'btn btn-success float-left', 'style' => 'width:100%'])}}
                    </div>
                </div>
            {!! Form::close() !!}
        @endif
    </div>
@endsection