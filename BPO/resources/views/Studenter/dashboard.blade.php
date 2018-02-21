@extends('layouts.app')
@section('content')
    <div class="jumbotron">
        <div class="container">
            <table class="table">
                <tr>
                    <th>Gruppe</th>
                    <th>Prosjektside</th>
                    <th>Studenter</th>
                    <th>E-postadresse</th>
                    <th>Veileder</th>
                </tr>
                <tr>
                    @foreach ($groups as $group)
                        <td>{{ $group->group_number }}</td>
                        <td><a href="http://{{ $group->url }}" >{{ $group->title }}</a></td>
                        <td></td>
                        <td>{{ date('Y') }}</td>
                        <td>{{ $group->supervisor }}</td>
                    @endforeach
                </tr>    
            </table>
            

            @if (date('m') >= '02')
                <p>test</p>
            @else
                <p>nei</p>
            @endif

        </div>
    </div>
@endsection