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
        <div id="hei">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum ea itaque quo. Officia aspernatur delectus perferendis alias nisi saepe optio magnam assumenda similique porro et voluptas, veniam mollitia, beatae adipisci?
        </div>
    </div>
@endsection
@section('extra')
    <script>
        $(function(){
            $("#hei").hide(200);
        });
    </script>
@endsection