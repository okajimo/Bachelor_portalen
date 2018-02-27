@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('inc.nav_header')
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 order-lg-4 order-xl-4">
            @include('inc.nav_side') 
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <div class="jumbotron">
                <div class="container">
                    <a href="{{ asset('files/dokumentasjonsstandard-2.pdf')}}"><h4>Dokumentasjonsforslag for bachelorprosjekter (kun veiledende)</h4></a>
                    <a href="/lastNed/Avtalemal.docx"><h4>Avtalemal mellom HiOA, studenter og oppdragsgiver</h4></a>
                    <a href="/lastNed/Tittelside.docx"><h4>Tittelside for bachelorprosjekter</h4></a>
                </div>
            </div>
        </div>
    </div>
@endsection