@extends('layouts.app')
@section('content')
    <div class="jumbotron">
        <div class="container">
            <table class="table">
                <thead class="thead-light">
                        <tr>
                            <th>Gruppe nummer</th>
                            <th>År</th>
                            <th>Fil navn</th>
                            <th>Tittel</th>
                        </tr>
                        @foreach($dokumenter as $dokument)
                            @if($dokument->documents_year >= date('Y'))
                                <tbody>
                                    <tr>
                                        <td>{{$dokument->documents_groups_number}}</td>
                                        <td>{{$dokument->documents_year}}</td>
                                        <td><a href="{{ asset('storage/filer/prosjektskisser/'.$dokument->file_name)}}">{{$dokument->file_name}}</a></td>
                                        <td>{{$dokument->title}}</td>
                                    </tr>
                                </tbody>
                            @endif
                        @endforeach
                </thead>
            </table>
        </div>
    </div>
@endsection