@extends('layouts.app')
@section('content')
    <div class="container container-no-padding">
        @if ($documents->count() != 0)
            <table class="table table-responsive">
                <thead class="thead-light">
                    <tr>
                        <th>Dato lagt til</th>
                        <th>Dokument</th>
                    </tr>
                </thead>
                <thead class="bg-light">
                    @foreach ($documents as $doc)
                        <tr>
                            <td>{{ $doc->date_added }}</td>
                            <td><a target='_blank' href="{{ asset('storage/filer/prosjektforslag/'.$doc->file_name)}}">{{ $doc->file_name }}</a></td>
                        </tr>
                    @endforeach
                </thead>
            </table>
        @else
            <h4>Ingen prosjektforslag er publisert ennå</h4>    
        @endif
    </div>
@endsection