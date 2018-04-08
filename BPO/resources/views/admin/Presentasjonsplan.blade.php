@extends('layouts.app')
@section('content')
    <div class="jumbotron">
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
            <div style="margin-top: 5em;"></div>
            <div class="row">
                {!! Form::open(['action' => 'PresentasjonController@store', 'method' => 'POST', 'class' => 'col-4 form-group']) !!}
                    <div class="row">
                        <h4 class="no-padding-left col-12">Registrer dag og rom her:</h4>
                        <input type="date" class="col-8 form-control form-control-lg" name="dates" required>
                        <input type="time" class="col-4 form-control form-control-lg" name="time" required>
                        <select required class="custom-select form-control form-control-lg margin-fix-top" name="room">
                            <option disabled value="" selected >Velg Rom</option>
                            @foreach($rooms as $room)
                                <option value={{$room->room}}>{{$room->room}}</option>
                            @endforeach
                        </select>
                        <select required class="custom-select form-control form-control-lg margin-fix-top" name={{"sensor"}}>
                            <option disabled value="" selected >Sensor</option>
                            @foreach($supervisors as $supervisor)
                                <option value={{$supervisor->email}}>{{$supervisor->firstname." ".$supervisor->lastname}}</option>
                            @endforeach
                        </select>
                        <input class="col-12 form-control form-control-lg margin-fix-top" type="number" name="perr_dag" min="1" placeholder="Antall presentasjoner perr dag" class="form-control margin-fix-bottom" value="11" required>
                        {{Form::submit('Oppdater', ['class'=>'btn btn-success col-12 margin-fix-top'])}}
                    </div>
                {!! Form::close() !!}
                <div class="col-4 offset-4 no-padding-right">
                    <h4>Grupper som ikke er registrerte:</h4>
                    <div class="jumbotron width-fill" style="padding:0 !important">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Gruppe</th>
                                        <th>År</th>
                                        <th>Leder</th>
                                    </tr>
                                </thead>
                                <tbody style="background: #F5F5F5">
                                    @foreach($groups as $group)
                                    <tr>
                                        <th scope="row">{{$group->group_number}}</th>
                                        <td>{{$group->year}}</td>
                                        <td>{{$group->leader}}</td>
                                    </tr>
                                    @endforeach
                                    @if(!$groups)
                                        <tr>
                                            <td>alle gruppene ligger i presentasjonsplanen</td><td></td><td></td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection