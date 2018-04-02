@extends('layouts.student')
@section('content')
    <div class="jumbotron">
        <div class="container">
            <h2>Nødvendige dokumenter for bacheloroppgave</h2>
                </br>
            <i class="fa fa-dot-circle-o" aria-hidden="true" style="color:black;"></i><a target='_blank' href="{{ asset('files/dokumentasjonsstandard-2.pdf')}}"> Dokumentasjonsforslag for bachelorprosjekter (kun veiledende) <i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                </br>
            <i class="fa fa-dot-circle-o" aria-hidden="true" style="color:black;"></i><a href="/lastNed/Avtalemal.docx"> Avtalemal mellom HiOA, studenter og oppdragsgiver <i class="fa fa-download" aria-hidden="true"></i></a>
                </br>
            <i class="fa fa-dot-circle-o" aria-hidden="true" style="color:black;"></i><a href="/lastNed/Tittelside.docx"> Tittelside for bachelorprosjekter <i class="fa fa-download" aria-hidden="true"></i></a>
        </div>
    </div>
@endsection