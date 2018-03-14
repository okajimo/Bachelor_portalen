@extends('layouts.app')
@section('content')
    <div class="jumbotron">
        <div class="container">
            {!! Form::open(['action' => 'ProsjektforslagController@uploadFile', 'method' => 'POST', 'files' => true]) !!}  
                {{Form::label('dok', 'Velg fil for opplastning. Kun PDF godkjent.')}} 
                {{Form::hidden('type', 'prosjektforslag')}}
                <div class="form-group form-inline">
                    {{Form::file('dok')}}
                </div>
                {{Form::submit('Last opp', ['class'=>'btn btn-primary'])}}    
            {!! Form::close() !!}
        </div></br>
        <div>
            @if ($documents)
                <table class="table table-responsive">
                    <tr>
                        <td>Dokument</td>
                        <td>Type</td>
                        <td>Slett</td>
                    </tr>
                    @foreach ($documents as $doc)
                        <tr>
                            <td><a href="{{ asset('storage/filer/prosjektforslag/'.$doc)}}">{{ $doc}}</a></td>
                            <td>prosjektforslag</td>
                            <td>
                                {!! Form::open(['action' => 'ProsjektforslagController@destroy', 'method' => 'POST'])!!}
                                    {{form::hidden('file', $doc)}}
                                    {{form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Slett', ['class'=>'btn btn-danger'])}}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
    </div>
@endsection