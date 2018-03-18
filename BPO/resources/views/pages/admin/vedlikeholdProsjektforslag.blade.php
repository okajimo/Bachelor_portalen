@extends('layouts.app')
@section('content')
    <div class="jumbotron">
        <div class="container">
            {!! Form::open(['action' => 'ProsjektforslagController@uploadFile', 'method' => 'POST', 'files' => true]) !!}  
                {{Form::hidden('type', 'prosjektforslag')}}    
                {{Form::label('file_name', 'Skriv inn filnavn (ikke .pdf)')}}
                <div class="form-group form-inline">
                    {{Form::text('file_name', '', ['class'=>'form-control'])}}
                </div>
                {{Form::label('dok', 'Velg fil, kun PDF godkjent')}} 
                <div class="form-group form-inline">
                    {{Form::file('dok')}}
                </div>
                {{Form::submit('Publiser', ['class'=>'btn btn-primary'])}}    
            {!! Form::close() !!}
        </div></br></br>
        <div>
            @if ($documents->count() != 0)
                <h4>Oversikt over publiserte prosjektforslag</h4>
                <table class="table table-responsive">
                    <tr>
                        <th>Dato lagt til</th>
                        <th>Dokument</th>
                        <th>Slett</th>
                    </tr>
                    @foreach ($documents as $doc)
                        <tr>
                            <td>{{ $doc->date_added }}</td>
                            <td><a href="{{ asset('storage/filer/prosjektforslag/'.$doc->file_name)}}">{{ $doc->file_name }}</a></td>
                            <td>
                                {!! Form::open(['action' => 'ProsjektforslagController@destroy', 'method' => 'POST'])!!}
                                    {{form::hidden('file', $doc->file_name)}}
                                    {{form::hidden('id', $doc->id)}}
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