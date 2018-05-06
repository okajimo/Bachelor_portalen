@extends('layouts.student')
@section('content')
    <div class="jumbotron">
        <div class="container">
            <h3>{{$title}} </h3>
            <p>
                Prosjektarbeidet deles opp i de fire delene produkt/resultat, prosess, dokumentasjon
                og presentasjon. Sluttkarakteren blir gitt på grunnlag av en totalvurdering der de fire delene inngår.
            </p></br>    
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th>Vurdering av</th>
                        <th>Underpunkter</th>
                        <th>Prosent</th>
                    </tr>
                </thead>
                <tbody>
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
                </tbody>
            </table>
        </div>
    </div>
@endsection