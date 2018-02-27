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
                    <p>
                        Prosjektarbeidet deles opp i de fire delene produkt/resultat, prosess, dokumentasjon
                        og presentasjon. Sluttkarakteren blir gitt på grunnlag av en totalvurdering der de fire delene inngår.
                    </p></br>    
                    <table class="table">
                        <tr>
                            <th>Vurdering av</th><th>Underpunkter</th><th>Prosent</th>
                        </tr>
                        <tr>
                            <td>Generelt inntrykk</td>
                            <td>Helhetsinntrykk, selvstendighet, nivå og tid.</td>
                            <td>10%</td>
                        </tr>
                        <tr>
                            <td>Faglig innsikt</td>
                            <td>
                            </td>
                            <td>25%</td>
                        </tr>
                        <tr>
                            <td>Teoretisk innsikt</td>
                            <td>
                            </td>
                            <td>15%</td>
                        </tr>
                        <tr>
                            <td>Gjennomføring</td>
                            <td>Målbeskrivelse, ferdighetsnivå</td>
                            <td>20%</td>
                        </tr>
                        <tr>
                            <td>Resultat</td>
                            <td>Analyse og diskusjon, refleksjon, eget bidrag, måloppnåelse</td>
                            <td>20%</td>
                        </tr>
                        <tr>
                            <td>Fremstilling</td>
                            <td>Struktur, form og formindling, arbeisinnsats</td>
                            <td>10%</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection