@extends('layouts.app')
@section('content')        
    <div class="table-responsive jumbotron jumbo-none table-flow">
        {!! Form::open(['action' => 'PresentasjonController@edit', 'method' => 'POST', 'id' => 'form1']) !!}
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Gruppe</th>
                    <th>Fra</th>
                    <th>Til</th>
                    <th>Rom</th>
                    <th>Sensor</th>
                </tr>
            </thead>
            <tbody>
                @foreach($presentasjoner as $presentasjon)
                    <tr>
                        <th scope="row">{{$presentasjon->presentation_group_number}}</th>
                        <td><input type="datetime-local" value="{{date("Y-m-d", strtotime($presentasjon->start))}}T{{date('H:i', strtotime($presentasjon->start))}}" class="form-control" name="start"></td>    
                        <td><input type="datetime-local" value="{{date("Y-m-d", strtotime($presentasjon->end))}}T{{date('H:i', strtotime($presentasjon->end))}}" class="form-control" name="stop"></td>
                        <td>
                            <select required class="form-control" name="room">
                                <option selected value={{$presentasjon->presentation_room}}>{{$presentasjon->presentation_room}}</option>
                                @foreach($rooms as $room)
                                    @if($presentasjon->presentation_room != $room->room)
                                        <option value={{$room->room}}>{{$room->room}}</option>
                                    @endif
                                @endforeach
                            </select>
                        <td>
                            <select required class="custom-select form-control" name="sensor">
                                <option selected value={{$presentasjon->sensor}}>{{$presentasjon->firstname." ".$presentasjon->lastname}}</option>
                                @foreach($supervisors as $supervisor)
                                    @if($presentasjon->sensor != $supervisor->email)
                                        <option value={{$supervisor->email}}>{{$supervisor->firstname." ".$supervisor->lastname}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! Form::close() !!}
    </div>
    <button id="regform"class="btn btn-success btn-big ">Registrer endring</button>
    <a href="/presentasjonsplan" class="btn btn-info btn-big">Presentasjonsplan</a>
@endsection
@section('extra')
    <script>
        $(function(){
            $("#regform").on('click', function(){
                $("#form1").submit();
            });
        });
    </script>
@endsection