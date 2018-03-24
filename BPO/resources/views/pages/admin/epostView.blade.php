@extends('layouts.app')
@section('content')
    <div class="jumbotron">
        <div class="container">
                {!! Form::open(['action' => 'Admin\EpostController@sendEpostAlleStud', 'method' => 'POST']) !!}  
                    <div class="form-group">  
                        {{Form::label('dok', 'Send epost til studentene her.')}}
                    </div>
                    <div class="form-group form-inline">  
                        {{Form::text('tema', '',['placeholder'=>'Skriv in emne her...','class'=>'form-control'])}}
                    </div>
                    <div class="form-group form-inline">  
                        {{Form::textarea('melding', '',['placeholder'=>'Skriv in melding her...','class'=>'form-control'])}}
                    </div>
                    {{Form::submit('Send epost', ['class'=>'btn btn-primary'])}}    
                {!! Form::close() !!}  
                <hr>
                {!! Form::open(['action' => 'Admin\EpostController@sendEpostSensorVeileder', 'method' => 'POST']) !!}  
                    <div class="form-group">  
                        {{Form::label('dok', 'Send epost til sensor/veileder her.')}}
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
                    {{Form::submit('Send epost', ['class'=>'btn btn-primary'])}}    
                {!! Form::close() !!}      
        </div>
    </div>
@endsection
