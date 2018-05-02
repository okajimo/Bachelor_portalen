@extends('layouts.app')
@section('extra-head')
    <style>
        table {border-collapse: collapse;}
        td, th {position: relative !important; padding: 5px 10px;}
        tr.strikeout td:before {content: " "; position: absolute; top: 45%; left: 0; border-bottom: 3px solid red; width: 100%;}
        .none{border-bottom: none;}
        .fa-times{color: red;}
        .fa-undo{color: #00dc00;}
        .fjern{cursor: pointer;}
    </style>
@endsection
@section('content')
    @include('inc.press_nav')
    <div class="table-responsive jumbotron jumbo-none table-flow">
        {!! Form::open(['action' => 'PresentasjonController@edit', 'method' => 'POST', 'id' => 'form1']) !!}
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>Gruppe</th>
                    <th>Dato</th>
                    <th>Fra</th>
                    <th>Til</th>
                    <th>Rom</th>
                    <th>Sensor</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($presentasjoner as $presentasjon)
                    <tr class="seksjon">
                        <td class="th" scope="row"><strong style="position: absolute; top:31%" class="gruppe">{{$presentasjon->presentation_group_number}}</strong><input type="text" name="group[]" value={{$presentasjon->presentation_group_number}} hidden></td>
                        <td><input type="date" required value="{{date("Y-m-d", strtotime($presentasjon->start))}}" class="form-control" name="start_date[]"></td>
                        <td><input type="time" required value="{{date('H:i', strtotime($presentasjon->start))}}" class="form-control" name="start_time[]"></td>
                        <td><p style="position: absolute; top:31%">{{date('H:i', strtotime($presentasjon->end))}}</p></td>
                        <td>
                            <select required class="form-control" name="room[]">
                                <option selected value={{$presentasjon->presentation_room}}>{{$presentasjon->presentation_room}}</option>
                                @foreach($rooms as $room)
                                    @if($presentasjon->presentation_room != $room->room)
                                        <option value={{$room->room}}>{{$room->room}}</option>
                                    @endif
                                @endforeach
                            </select>
                        <td>
                            <select required class="custom-select form-control" name="sensor[]">
                                <option selected value={{$presentasjon->sensor}}>{{$presentasjon->firstname." ".$presentasjon->lastname}}</option>
                                @foreach($supervisors as $supervisor)
                                    @if($presentasjon->sensor != $supervisor->email)
                                        <option value={{$supervisor->email}}>{{$supervisor->firstname." ".$supervisor->lastname}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </td>
                        <th>
                            <i style="position: absolute; top:24%; left: 20%; font-size: 1.7em;"class="fa fa-times fjern" aria-hidden="true"></i>
                            <p hidden>{{$presentasjon->presentation_group_number}}</p>
                            <div style="width:1em;"></div>
                        </th>
                    </tr>
                @endforeach
                @if(!$presentasjoner)
                    <tr>
                        <td colspan="7"><p style="min-height: 8em;">Grupper må legges inn i presentasjonsplanen før man kan endre dem, venligst gå tilbake til forrige side</p></td>
                    </tr>
                @endif
            </tbody>
        </table>
        {!! Form::close() !!}
    </div>
    <button id="regform" class="btn btn-warning btn-big "style="color:#FFF">Registrer endring</button>
    <a href="/presentasjonsplan" class="btn btn-info btn-big">Presentasjonsplan</a>
    <div class="data"></div>
@endsection
@section('extra')
    <script>
        $(function(){
            $(".fjern").on('click', function(){
                var gruppe = $(this).siblings("p").html();
                $(this).closest("tr").toggleClass("strikeout none", 150);
                $(this).toggleClass("fa-times fa-undo", 100);

                if ( $(this).hasClass( "fa-times" )){
                    $('.data').append('<input type="hidden"name="remove[]" id="g'+gruppe+'" value='+gruppe+' />');
                }
                if ( $(this).hasClass( "fa-undo" )){
                    $('.data #g'+gruppe).remove();
                }
            });

            $("#regform").on('click', function(){
                var grupper = $(".data").html();
                $("#form1").append(grupper).submit();
            });
        });
    </script>
@endsection