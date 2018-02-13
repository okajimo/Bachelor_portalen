@extends('layouts.app')
@section('content')
<nav class="navbar navbar-inverse">       
    <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <li><a href="{{ asset('files/Statusrapport.pdf')}}"><h4>Statusrapport</h4></a></li>
            <li><a href="/dokumentasjon"><h4>Dokumetasjon</h4></a></li>
            <li><a href="{{ asset('files/Prosjektskisse.pdf')}}"><h4>Prosjektskisse</h4></a></li>
            <li><a href="/veiledning"><h4>Veiledning</h4></a></li>
            <li><a href="/forprosjekt"><h4>Forprosjekt</h4></a></li>
            <li><a href="/prosjektrapport"><h4>Prosjektrapport</h4></a></li>
            <li><a href="/evaluering"><h4>Evaluering</h4></a></li>
        </ul>
    </div>
</nav>    
    <div class="jumbotron">
        <div class="container">
            <!-- Alle datoer og årstall skal hentes fra db -->
            <h2><b>Huskeliste for 2017/2018</b></h2>
            <h3><b>Gangen i arbeidet</b></h3>

            <p>
                Første oppgave er å finne et prosjekt, og dere skal avlegge en statusrapport om det senest <b>20.10.2017</b></br>
                Når oppgaven er funnet lages en prosjektskisse som beskriver detaljene i prosjektet - frist <b>1.12.2017</b></br>
                Så starter forprosjektet og forprosjektrapporten skal være ferdig senest <b>19.1.2018</b></br>
                Selve prosjektarbeidet pågår frem til innleveringsfristen <b>23.5.2018</b></br>
                Til slutt må dere forberede presentasjonen som vil foregå <b>11.6 - 14.6.2018</b></br>
            </p></br> 
            <table class="table">
                <tr>
                    <th>Nr</th><th>Oppgave</th><th>Hvor</th><th>Frist</th>
                </tr>
                <tr>
                    <td>1</td><td>Statusrapport</td><td>På nettet</td><td>20.10.2017</td>
                </tr>
                <tr>
                    <td>2</td><td>Prosjektskisse</td><td>På nettet</td><td>1.12.2017</td>
                </tr>
                <tr>
                    <td>3</td><td>Forprosjekt</td><td>På prosjektets nettside</td><td>19.1.2018</td>
                </tr>
                <tr>
                    <td>4</td><td>Prosjektrapport</td><td>Digital eksamensinnlevering</td><td>23.5.2018</td>
                </tr>
                <tr>
                    <td>5</td><td>Presentasjon</td><td>Auditorium</td><td>11.6 - 14.6.2018</td>
                </tr>
            </table>
        </div>
    </div>
@endsection