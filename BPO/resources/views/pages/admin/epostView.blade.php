@extends('layouts.app')
@section('content')
    <div class="jumbotron">
        <div class="container">
            <div class="row">
            <div class="col-6">
                {!! Form::open(['action' => 'Admin\EpostController@sendEpostSensorVeileder', 'method' => 'POST']) !!}  
                    <div class="form-group">  
                        {{Form::label('dok', 'Send epost til sensor/veileder her.')}}
                    </div>
                    <div class="form-group">  
                        <?php $senvei= DB::select('SELECT * FROM sensors_supervisors');?>
                        <select name="senvei">
                            @foreach($senvei as $sen)
                                <?php $navn = $sen->firstname." ".$sen->lastname; ?>
                                <option value={{$sen->email}}>{{$navn}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">  
                        {{Form::text('tema', '',['placeholder'=>'Skriv in emne her...'])}}
                    </div>
                    <div class="form-group">  
                        {{Form::textarea('melding', '',['placeholder'=>'Skriv in melding her...'])}}
                    </div>
                    {{Form::submit('Send epost', ['class'=>'btn btn-primary'])}}    
                {!! Form::close() !!}  
                </div>
                <div class="col-6">
            {!! Form::open(['action' => 'Admin\EpostController@sendEpostAlleStud', 'method' => 'POST']) !!}  
                <div class="form-group">  
                    {{Form::label('dok', 'Send epost til studentene her.')}}
                </div>
                <div class="form-group">  
                    {{Form::text('tema', '',['placeholder'=>'Skriv in emne her...'])}}
                </div>
                <div class="form-group">  
                    {{Form::textarea('melding', '',['placeholder'=>'Skriv in melding her...'])}}
                </div>
                {{Form::submit('Send epost', ['class'=>'btn btn-primary'])}}    
            {!! Form::close() !!}
            </div>
            </div>           
        </div>
    </div>
@endsection
