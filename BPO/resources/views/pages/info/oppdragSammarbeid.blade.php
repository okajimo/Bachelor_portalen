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
                    <h2>Samarbeid med bedrifter</h2>

                    <h3>Samarbeid med næringslivet</h3>
                    Datastudiene ved Høgskolen i Oslo har gjennom mange år samarbeidet med næringslivet når det gjelder
                    studentprosjekter. Oversikten over tidligere prosjekter (se toppmeny) viser at vi samarbeider med både små og store
                    bedrifter. Denne oversikten gir et godt innblikk i hva som kan være aktuelle problemstillinger for et
                    prosjekt, og viser også hvilke bedrifter som tidligere har vært oppdragsgivere for våre studentprosjekter.
                    
                    <h3>Rekruttering av arbeidskraft</h3>
                    Enkelte bedrifter bruker et prosjekt for å knytte til seg nye medarbeidere. Bedriften engasjerer en eller
                    flere prosjektgrupper og gjennom prosjektarbeidet vil de få god anledning til å vurdere de enkelte
                    studentene med tanke på ansettelse etter avsluttet eksamen.
                </div>
            </div>
        </div>
    </div>
@endsection