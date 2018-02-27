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
            <nav class="navbar navbar-inverse"><!-- Må oppdateres! -->       
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="/oppdragProsjekt"><h4>Hva er et bachelorprosjekt?</h4></a></li>
                        <li><a href="/oppdragStudent"><h4>Hva kan en datastudent?</h4></a></li>
                        <li><a href="/oppdragSammarbeid"><h4>Samarbeid med bedrifter</h4></a></li>
                        <li><a href="/oppdragBedrift"><h4>Har din bedrift et prosjekt?</h4></a></li>
                        <li><a href="/oppdragKontakt"><h4>Ta kontakt</h4></a></li>
                    </ul>
                </div>
            </nav> 
            <div class="jumbotron">
                <div class="container">
                    <h2>Informasjon for oppdragsgivere</h2>
                    <h2>Studieåret {{ $year['year'] }}/{{ $year['year1'] }}</h2>
                    <h3>Prosjektet</h3>
                        Datastudiene (dataingeniør, informasjonsteknologi og anvendt datateknologi) ved
                        Høgskolen i Oslo og Akershus er 3-årige og avsluttes i siste semester
                        (vårsemesteret) med et større praktisk dataprosjekt.
                        Der skal studentene demonstrere at de kan bruke sine datakunnskaper til å lage gode løsninger
                        på praktiske dataproblemer.

                    <h3>Samarbeid med næringslivet</h3>
                        Prosjektet gjennomføres normalt i samarbeid med en bedrift eller en annen ekstern institusjon.
                        Vi ønsker derfor å komme i kontakt med bedrifter eller andre som har datatekniske problemer,
                        oppgaver eller prosjekter som vil passe som et studentprosjekt. Prosjektarbeidets resultater
                        blir vederlagsfritt oppdragsgiverens eiendom.

                    <h3>Prosjektbeskrivelse</h3>
                        Studentene utfører selve prosjektarbeidet i vårsemesteret. Beskrivelsen av prosjektet og en del
                        rammebetingelser må derfor være på plass i god tid før jul.

                    <h3>Tidsplan</h3>
                        Studentene velger et prosjekt - frist {{ \DateHelper::instance()->date('project_sketch') }}.<br/>
                        Prosjektarbeidet starter for fullt - begynnelsen av januar.<br/>
                        Oppdragsgiver og høgskolen lager en avtale - desember/januar <br/>
                        Studentene leverer sitt prosjektresultat - frist {{ \DateHelper::instance()->date('project_report') }}.<br/><br/>
                        Ta kontakt med oss. Mer detaljert informasjon finner du under de ulike menyvalgene i venstre spalte.
                </div>
            </div>
        </div>
    </div>
@endsection