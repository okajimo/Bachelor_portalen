@extends('layouts.app')
@section('content')
    <div class="table-responsive">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Gruppe</th>
                    <th>År</th>
                    <th>Tid</th>
                    <th>Rom</th>
                    <th>Sensor</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($presentasjoner as $presentasjon)
                    <tr>
                        <th scope="row">{{$presentasjon->presentation_group_number}}</th>
                        <td>{{$presentasjon->presentation_year}}</td>
                        <td>{{$presentasjon->start." - ".$presentasjon->end}}</td>
                        <td>{{$presentasjon->presentation_room}}</td>
                        <td>{{$presentasjon->firstname." ".$presentasjon->lastname}}</td>
                        <td><button>Slett</button><button>Endre</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
            <div class="col-3">
                <div class="input-group date" data-provide="datepicker">
                    <input type="text" class="form-control margin-fix">
                    <div class="btn btn-dark input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extra')
    <script>
        $(function(){
            $('.datepicker').datepicker();

        });
    </script>
@endsection