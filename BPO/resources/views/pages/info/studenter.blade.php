@extends('layouts.student')
@section('content')
    <div class="jumbotron">
        <div class="container">
            <!-- Alle datoer og årstall hentes fra db -->
            <h3><b>Gangen i arbeidet</b></h3>
            <p>
                Første oppgave er å finne et prosjekt, og dere skal avlegge en statusrapport om det senest <b>{{ \DateHelper::instance()->date('status_report') }}</b></br>
                Når oppgaven er funnet lages en prosjektskisse som beskriver detaljene i prosjektet - frist <b>{{ \DateHelper::instance()->date('project_sketch') }}</b></br>
                Så starter forprosjektet og forprosjektrapporten skal være ferdig senest <b>{{ \DateHelper::instance()->date('preproject') }}</b></br>
                Selve prosjektarbeidet pågår frem til innleveringsfristen <b>{{ \DateHelper::instance()->date('project_report') }}</b></br>
                Til slutt må dere forberede presentasjonen som vil foregå <b>{{ \DateHelper::instance()->date('pres_start') }} - {{ \DateHelper::instance()->date('pres_end') }}</b></br>
            </p></br> 
            <table class="table table-responsive">
                <tr>
                    <th>Nr</th><th>Oppgave</th><th>Hvor</th><th>Frist</th>
                </tr>
                <tr>
                    <td>1</td><td>Statusrapport</td><td>På nettet</td><td>{{ \DateHelper::instance()->date('status_report') }}</td>
                </tr>
                <tr>
                    <td>2</td><td>Prosjektskisse</td><td>På nettet</td><td>{{ \DateHelper::instance()->date('project_sketch') }}</td>
                </tr>
                <tr>
                    <td>3</td><td>Forprosjekt</td><td>På prosjektets nettside</td><td>{{ \DateHelper::instance()->date('preproject') }}</td>
                </tr>
                <tr>
                    <td>4</td><td>Prosjektrapport</td><td>Digital eksamensinnlevering</td><td>{{ \DateHelper::instance()->date('project_report') }}</td>
                </tr>
                <tr>
                    <td>5</td><td>Presentasjon</td><td>Auditorium</td><td>{{ \DateHelper::instance()->date('pres_start') }} - {{ \DateHelper::instance()->date('pres_end') }}</td>
                </tr>
            </table>                    
        </div>
    </div>   
@endsection