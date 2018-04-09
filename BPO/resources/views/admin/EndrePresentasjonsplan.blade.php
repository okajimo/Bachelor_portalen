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
    <a href="#" data-toggle="lightbox">
        <img src="https://unsplash.it/600.jpg?image=251" class="img-fluid">
    </a>
    
    <script>
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox();
            });
    </script>
@endsection