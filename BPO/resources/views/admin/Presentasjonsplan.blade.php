@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            {!! Form::open(['action' => 'Tidligere_prosjekterController@opprett_html_sider', 'method' => 'POST', 'class' => 'col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 no-padding-left no-padding-right margin-fix-bottom']) !!}  
                {{Form::submit('Generer plan', ['class'=>'btn btn-lg width-fill btn-success'])}}    
            {!! Form::close() !!}
            </br>

            <?php $finnes2 = Storage::exists('/public/filer/presentasjonsplan/false.txt');
            $finnes3 = Storage::exists('/public/filer/presentasjonsplan/true.txt'); ?>
            @if($finnes2 == true)
                {!! Form::open(['action' => 'Tidligere_prosjekterController@publiserPresentasjonsplan', 'method' => 'POST', 'class' => 'col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 no-padding-left no-padding-right margin-fix-bottom']) !!}  
                    {{Form::submit('Publiser plan', ['class'=>'btn btn-lg width-fill btn-success'])}}    
                {!! Form::close() !!}
            @endif
            @if($finnes3 == true)
                {!! Form::open(['action' => 'Tidligere_prosjekterController@publiserPresentasjonsplan', 'method' => 'POST', 'class' => 'col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 no-padding-left no-padding-right margin-fix-bottom']) !!}  
                    {{Form::submit('Fjern Publisering', ['class'=>'btn btn-lg width-fill btn-danger'])}}    
                {!! Form::close() !!}
            @endif
            {!! Form::open(['action' => ['PresentasjonController@delete'], 'method' => 'POST', 'class' => 'col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 no-padding-left no-padding-right margin-fix-bottom']) !!}
                {{Form::submit('Slett Prestasjonsplan', ['class'=>'btn btn-lg width-fill btn-danger margin-fix'])}}
            {!! Form::close() !!}
            {!! Form::open(['action' => 'PresentasjonController@show', 'method' => 'POST', 'class' => 'col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 no-padding-left no-padding-right margin-fix-bottom']) !!}
                {{Form::submit('Endre Prestasjonsplan', ['class'=>'btn btn-lg width-fill btn-warning margin-fix', 'style' => 'color:#FFF'])}}
            {!! Form::close() !!}
            </br>
        </div>
        <br>
        <div style="max-width:17em;"class="no-padding-left col">
            {!! Form::open(['action' => 'PresentasjonController@store', 'method' => 'POST', 'class' => 'row form-group']) !!}
                <h4 class="no-padding-left col-12">Dag:</h4>
                <input type="date" class="col-8 form-control" name="dates" required>
                <input type="time" class="col-4 form-control" name="time" required>
                <select required class="custom-select form-control margin-fix-top" name="room">
                    <option disabled value="" selected >Velg Rom</option>
                    @foreach($rooms as $room)
                        <option value={{$room->room}}>{{$room->room}}</option>
                    @endforeach
                </select>
                <select required class="custom-select form-control margin-fix-top" name={{"sensor"}}>
                    <option disabled value="" selected >Sensor</option>
                    @foreach($supervisors as $supervisor)
                        <option value={{$supervisor->email}}>{{$supervisor->firstname." ".$supervisor->lastname}}</option>
                    @endforeach
                </select>
                <input class="col-12 form-control margin-fix-top" type="number" name="perr_dag" min="1" placeholder="Antall presentasjoner perr dag" class="form-control margin-fix-bottom" value="11" required>
                {{Form::submit('Oppdater', ['class'=>'btn btn-success col-12 margin-fix-top'])}}
            {!! Form::close() !!}
        </div>
    </div>
@endsection