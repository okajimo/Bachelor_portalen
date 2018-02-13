@extends('layouts.app')
@section('content')
<nav class="navbar navbar-inverse">       
    <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <li><a href="/studenter"><h4>Studenter</h4></a></li>
            <li><a href="/sensorer"><h4>Sensorer</h4></a></li>
            <li><a href="/oppdragsgivere"><h4>Oppdragsgivere</h4></a></li>
        </ul>
    </div>
</nav>    
    <div class="jumbotron">
        <div class="container">
            <p>Her finner du nødvendig informasjon til studenter, sensorer og oppdragsgivere.</p>
        </div>
    </div>
@endsection