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
                    <h2>En samarbeidsavtale</h2>
                    <h3>Avtale</h3>
                    Oppdragsgiver og Høgskolen i Oslo og Akershus inngår en formell avtale om prosjektet.
                    Den beskriver partenes plikter og rettigheter. Vi har laget en standardavtale (og en engelsk versjon),
                    men det er fullt mulig å lage en tilleggsavtale hvis det ønskes andre formuleringer.
                    Prosjektavtalen inngås normalt i desember/januar. 
                </div>
            </div>
        </div>
    </div>
@endsection