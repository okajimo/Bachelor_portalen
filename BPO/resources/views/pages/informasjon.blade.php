@extends('layouts.app')
@section('content')
<?php $side_nav = "annet"; ?>
@include('inc.nav_header')
    <div class="card" style="border: 0; background-color: transparent !important;">
        <img class="card-img" src="https://student.hioa.no/hioasearch-portlet/images/Min_side-startside_public-plain.png" alt="Card image" height="348.766" width="1070">
        <div class="card-img-overlay">
            <p class="card-text text-black">Institutt for informasjonsteknologi</p>
            <p class="card-text text-black">Bachelorprosjekt</p> 
            <p class="card-text text-black">{{ $year['year'] }}/{{ $year['year1'] }}</p>
        </div>
    </div>
    <p></p>
    <div class="jumbotron">
        <div class="container">
            <p>Her finner du nødvendig informasjon til studenter, sensorer og oppdragsgivere.</p>
        </div>
    </div>
@endsection

