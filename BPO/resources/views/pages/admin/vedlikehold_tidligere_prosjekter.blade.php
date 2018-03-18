@extends('layouts.app')
@section('content')
    <div class="jumbotron">
        <div class="container">
            {!! Form::open(['action' => 'Tidligere_prosjekterController@opprett_html_sider', 'method' => 'POST']) !!}  
                <div class="form-group">  
                    {{Form::label('dok', 'Opprett html sider for tidligere prosjekter her.')}}
                </div>
                {{Form::submit('Opprett', ['class'=>'btn btn-primary'])}}    
            {!! Form::close() !!}
            </br>

            <?php $finnes2 = Storage::exists('/public/filer/presentasjonsplan/false.txt');
            $finnes3 = Storage::exists('/public/filer/presentasjonsplan/true.txt'); ?>
            @if($finnes2 == true)
                {!! Form::open(['action' => 'Tidligere_prosjekterController@publiserPresentasjonsplan', 'method' => 'POST']) !!}  
                    <div class="form-group">  
                        {{Form::label('dok', 'Publiser presentasjonsplan.')}}
                    </div>
                    {{Form::submit('Publiser', ['class'=>'btn btn-primary'])}}    
                {!! Form::close() !!}
            @endif
            @if($finnes3 == true)
                {!! Form::open(['action' => 'Tidligere_prosjekterController@publiserPresentasjonsplan', 'method' => 'POST']) !!}  
                    <div class="form-group">  
                        {{Form::label('dok', 'Publiser presentasjonsplan.')}}
                    </div>
                    {{Form::submit('u-publiser', ['class'=>'btn btn-primary'])}}    
                {!! Form::close() !!}
            @endif
            </br>
        </div>
    </div>
@endsection
