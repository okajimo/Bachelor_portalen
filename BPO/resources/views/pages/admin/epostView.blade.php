@extends('layouts.app')
@section('content')
    <div class="jumbotron">
        <div class="container">
                @if(!Session::get('i') && !Session::get('l'))
                    {{Form::label('dok', 'Velg mottaker')}}
                @endif
            <div class="row">
                @if(!Session::get('i'))
                    {!! Form::open(['action' => 'Admin\EpostController@velgEpost', 'method' => 'POST', 'class' => 'col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 no-padding-left no-padding-right margin-fix-bottom']) !!}  
                        {{Form::hidden('verdi', "stud")}} 
                        {{Form::submit('Alle studenter', ['class'=>'btn btn-lg width-fill btn-info','name' => 'sub'])}}   
                    {!! Form::close() !!}
                @endif
                @if(!Session::get('l'))
                    {!! Form::open(['action' => 'Admin\EpostController@velgEpost', 'method' => 'POST', 'class' => 'col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 no-padding-left no-padding-right margin-fix-bottom']) !!}  
                        {{Form::hidden('verdi', "senvei")}}
                        {{Form::submit('Sensor/veileder', ['class'=>'btn btn-lg width-fill btn-info','name' => 'sub'])}} 
                    {!! Form::close() !!}
                @endif
            </div>
                @if(Session::get('valgte') == "stud")
                    {!! Form::open(['action' => 'Admin\EpostController@sendEpostAlleStud', 'method' => 'POST']) !!}  
                    <div class="form-group">  
                        {{Form::label('dok', 'Send epost til studentene')}}
                    </div>
                    <div class="form-group form-inline">  
                        {{Form::text('tema', '',['placeholder'=>'Skriv in emne her...','class'=>'form-control'])}}
                    </div>
                    <div class="form-group form-inline">  
                        {{Form::textarea('melding', '',['placeholder'=>'Skriv in melding her...','class'=>'form-control'])}}
                    </div>
                    {{Form::submit('Send epost', ['class'=>'btn btn-info'])}}    
                {!! Form::close() !!} 
                @endif
               
                @if(Session::get('valgte2') == "senvei")  
                    {!! Form::open(['action' => 'Admin\EpostController@sendEpostSensorVeileder', 'method' => 'POST']) !!}  
                        <div class="form-group">  
                            {{Form::label('dok', 'Send epost til sensor/veileder')}}
                        </div>
                        <div class="form-group form-inline">  
                            <?php $senvei= DB::select('SELECT * FROM sensors_supervisors');?>
                            <select name="senvei" class='form-control'>
                                @foreach($senvei as $sen)
                                    <?php $navn = $sen->firstname." ".$sen->lastname; ?>
                                    <option hidden disabled selected>Navn</option>
                                    <option value={{$sen->email}}>{{$navn}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group form-inline">  
                            {{Form::text('tema', '',['placeholder'=>'Skriv in emne her...','class'=>'form-control'])}}
                        </div>
                        <div class="form-group form-inline">  
                            {{Form::textarea('melding', '',['placeholder'=>'Skriv in melding her...','class'=>'form-control'])}}
                        </div>
                        {{Form::submit('Send epost', ['class'=>'btn btn-info'])}}    
                    {!! Form::close() !!}  
                @endif
        </div>
    </div>
@endsection
