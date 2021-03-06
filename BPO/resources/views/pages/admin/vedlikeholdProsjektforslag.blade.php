@extends('layouts.app')
@section('content')
    <div class="jumbotron">
        <div class="container container-no-padding">
            {!! Form::open(['action' => 'Admin\ProsjektforslagController@uploadFile', 'method' => 'POST', 'files' => true]) !!}  
                {{Form::hidden('type', 'prosjektforslag')}}    
                <h5>{{Form::label('file_name', 'Skriv inn filnavn (ikke .pdf)')}}</h5>
                <div class="form-group form-inline">
                    {{Form::text('file_name', '', ['class'=>'form-control', 'required',
                     'maxlength' => '45','pattern' => '[A-Za-z0-9 øæåØÆÅ.-]*', 'title' => 'Navnet må kun bestå av bokstaver, tall, punktum og bindestrek'])}}
                </div>
                <h5>{{Form::label('dok', 'Velg fil, kun PDF godkjent')}}</h5> 
                <div class="form-group form-inline">
                    {{Form::file('dok')}}
                </div>
                {{Form::submit('Publiser', ['class'=>'btn btn-success'])}}    
            {!! Form::close() !!}
        </div>
    </div>
    <div class="container container-no-padding">
        @if ($documents->count() != 0)
            <h4>Oversikt over publiserte prosjektforslag</h4>
            <table class="table table-responsive">
                <thead class="thead-light">
                    <tr>
                        <th>Dato lagt til</th>
                        <th>Dokument</th>
                        <th>Slett</th>
                    </tr>
                </thead>
                <tbody class="bg-light">
                    @foreach ($documents as $doc)
                        <tr>
                            <td>{{ $doc->date_added }}</td>
                            <td><a target='_blank' href="{{ asset('storage/filer/prosjektforslag/'.$doc->file_name)}}">{{ $doc->file_name }}</a></td>
                            <td>
                                {!! Form::open(['action' => 'Admin\ProsjektforslagController@destroy', 'method' => 'POST','onsubmit' => 'return ConfirmDelete()'])!!}
                                    {{form::hidden('file', $doc->file_name)}}
                                    {{form::hidden('id', $doc->id)}}
                                    {{form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Slett', ['class'=>'btn btn-danger'])}}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection