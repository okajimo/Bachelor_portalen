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
                    Hver gruppe blir tildelt en intern veileder. Det vil fremgå av prosjektoversikten hvem det er.
                    Det er anledning til på forhånd å be om en bestemt veileder,
                    og skolen vil forsøke å oppfylle ønskene så langt som mulig.
                    Men noen veiledere får flere forespørsler enn andre,
                    og det vil derfor ikke alltid være mulig å oppfylle alle ønsker.
                    Det er liten sannsynlighet for at den interne veilederen har kunnskap om problemområdet
                    for bachelorprosjektet. Det er heller ikke sannsynlig at veilederen har detaljkunnskap om den
                    teknologien som skal benyttes. Veilderne velges først og fremst utfra hvem som tidsmessig
                    har kapasitet til å være veileder.
                    Veilderens oppgave er å følge opp prosjektgruppen og sørge for at gruppen har fremdrift.
                    Dette vil normalt skje ved at det holdes ukentlige møter mellom veileder og prosjektgruppe.
                    Høgskolen har laget en egen veiledning for veiledere.
                    Det kan være nyttig at prosjektgruppen har sett på denne.
                    Da vil de vite hva de kan forvente av sin veileder.
                </div>
            </div>
        </div>
    </div>    
@endsection