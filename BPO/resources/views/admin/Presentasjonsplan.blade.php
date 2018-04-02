@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            {!! Form::open(['action' => 'Tidligere_prosjekterController@opprett_html_sider', 'method' => 'POST', 'class' => 'd-inline-block margin-fix']) !!}  
                {{Form::submit('Generer plan', ['class'=>'btn btn-success'])}}    
            {!! Form::close() !!}
            </br>

            <?php $finnes2 = Storage::exists('/public/filer/presentasjonsplan/false.txt');
            $finnes3 = Storage::exists('/public/filer/presentasjonsplan/true.txt'); ?>
            @if($finnes2 == true)
                {!! Form::open(['action' => 'Tidligere_prosjekterController@publiserPresentasjonsplan', 'method' => 'POST', 'class' => 'd-inline-block margin-fix']) !!}  
                    {{Form::submit('Publiser plan', ['class'=>'btn btn-success'])}}    
                {!! Form::close() !!}
            @endif
            @if($finnes3 == true)
                {!! Form::open(['action' => 'Tidligere_prosjekterController@publiserPresentasjonsplan', 'method' => 'POST', 'class' => 'd-inline-block margin-fix']) !!}  
                    {{Form::submit('Fjern Publisering', ['class'=>'btn btn-danger'])}}    
                {!! Form::close() !!}
            @endif
            {!! Form::open(['action' => ['PresentasjonController@delete'], 'method' => 'POST', 'class' => 'd-inline-block margin-fix', 'style' => ' padding-left:0']) !!}
                {{Form::submit('Slett Prestasjonsplan', ['class'=>'btn btn-danger margin-fix'])}}
            {!! Form::close() !!}
            </br>
        </div>
        <br>
        {!! Form::open(['action' => 'PresentasjonController@store', 'method' => 'POST', 'class' => 'row', 'style' => 'margin-top:0.5em;']) !!}
            <div class="col form-group" style="padding:0;">
                <div class="col-3 margin-fix" style="padding:0;">
                    <h4 style="margin-top:1em">Dag:</h4>
                    <input style="width:60%"type="date" name="dates" class="form-control d-inline-block" required>
                    <input style="width:38.3%"type="time" name="time" class="form-control d-inline-block" required> <br>
                    <select required class="custom-select" name="room">
                        <option disabled value="" selected >Velg Rom</option>
                        @foreach($rooms as $room)
                            <option value={{$room->room}}>{{$room->room}}</option>
                        @endforeach
                    </select>
                    <select required class="custom-select" name={{"sensor"}}>
                        <option disabled value="" selected >Sensor</option>
                        @foreach($supervisors as $supervisor)
                            <option value={{$supervisor->email}}>{{$supervisor->firstname." ".$supervisor->lastname}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12" style="padding:0; margin-top:0.6em">
                <div style="padding:0;" class="col-3" >
                    <input type="number" name="perr_dag" min="1" placeholder="Antall presentasjoner perr dag" class="form-control margin-fix-bottom" value="11" required>
                    {{Form::submit('Oppdater', ['class'=>'btn btn-success float-left', 'style' => 'width:100%'])}}
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection