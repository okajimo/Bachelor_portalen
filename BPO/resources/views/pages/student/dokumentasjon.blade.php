@extends('layouts.student')
@section('content')
    <div class="jumbotron">
        <div class="container">
            <h2>Nødvendige dokumenter for bacheloroppgave</h2>
                </br>
            <i class="far fa-dot-circle" ></i><a target='_blank' href="{{ asset('files/dokumentasjonsstandard-2.pdf')}}"> Dokumentasjonsforslag for bachelorprosjekter (kun veiledende) <i class="fas fa-file-pdf" style="color: red"aria-hidden="true"></i></a>
                </br>
            <i class="far fa-dot-circle" ></i><a href="/lastNed/Avtalemal.docx"> Avtalemal mellom HiOA, studenter og oppdragsgiver <i class="fa fa-download" aria-hidden="true"></i></a>
                </br>
            <i class="far fa-dot-circle" ></i><a href="/lastNed/Tittelside.docx"> Tittelside for bachelorprosjekter <i class="fa fa-download" aria-hidden="true"></i></a>
        </div>
    </div>
@endsection