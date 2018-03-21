@extends('layouts.app')
@section('content')
<?php $side_nav = "annet"; ?>
@include('inc.nav_header')
    <div class="card" style="border: 0; background-color: transparent !important;">
        <img class="card-img" src="https://www.cs.hioa.no/data/bachelorprosjekt/studbilde.png" alt="Card image">
        <div class="card-img-overlay">
            <p class="card-text text-light">Bachelorprosjekt</p>
            <p class="card-text text-light">Institutt for informasjonsteknologi</p> 
            <p class="card-text text-light">{{ $year['year'] }}/{{ $year['year1'] }}</p>
        </div>
    </div>
    <p></p>
    <div class="jumbotron">
        <div class="container">
            <p>Her finner du nødvendig informasjon til studenter, sensorer og oppdragsgivere.</p>
            <span class="glyphicon glyphicon-arrow-down"></span>
        </div>
    </div>
@endsection
