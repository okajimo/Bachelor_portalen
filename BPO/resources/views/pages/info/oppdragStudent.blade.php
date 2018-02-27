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
                    <h2>Hva kan en datastudent utrette?</h2>

                    <h3>Studiets siktemål</h3>
                    Studiet har som siktemål både å utdanne for et yrke og å kvalifisere for videreutdanning ved NTNU,
                    universitetene og utenlandske læresteder. Når det gjelder datafagene vil en ferdig bachelor i høy grad
                    ha yrkesrelevante kunnskaper slik at han eller hun kan løse datafaglige oppgaver i en bedrift med et
                    minimum av intern opplæring. I tillegg er det lagt stor vekt på at en også skal ha de nødvendige
                    basiskunnskapene slik at søking etter ny kunnskap og ny innlæring kan skje på en effektiv måte.

                    <h3>Prosjektferdigheter</h3>
                    I alle datafagene i studiet trenes studentene opp til å løse problemer. Flere av fagene er
                    prosjektorientert i den forstand at eksamen er i seg selv et prosjekt, og eksamenskarakteren er den
                    karakteren som prosjektet oppnår.<br/><br/>
                    Studentene vil derfor, når de er i siste semester, være istand til å løse ganske krevende prosjekter.
                </div>
            </div>
        </div>
    </div>
@endsection