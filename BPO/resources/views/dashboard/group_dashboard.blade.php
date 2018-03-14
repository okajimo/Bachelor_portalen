@extends('layouts.app')
<style>.card{margin-bottom: 1.5em}</style>
@section('content')
    <div class="row text-center">
        <div class="col-12">
            <h2>Gruppe nummer:<?php 
                    if($nummer)
                    {
                        echo " ".$nummer[0]->student_groups_number;
                    }
                ?>
            </h2>
            <div class="py-3 d-inline-block"></div>
        </div>
    </div>
   <div class="row">
     <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
       <div class="card">
         <div class="card-body">
            <a class="nav-link" href="{{ route('group') }}"><h4 class="card-title">Gruppe innstillinger</h4></a>
           <p class="card-text">Her kan du registere en gruppe, melde deg inn i en gruppe, sette deg selv som leder i gruppen eller forlate gruppen.</p>
         </div>
       </div>
     </div>
     <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
        <div class="card">
            <div class="card-body">
                <a class="nav-link" href="{{ route('lastOppS') }}"><h4 class="card-title">Last opp statusrapport</h4></a>
                <p class="card-text">Her kan du laste opp statusrapport for bachelor prosjektet.</p>
            </div>
        </div>
     </div>
     <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
        <div class="card">
            <div class="card-body">
                <a class="nav-link"  href="{{ route('lastOppP') }}"><h4 class="card-title">Last opp prosjektskisse</h4></a>
                <p class="card-text">Her kan du laste opp prosjektskisse for bachelor prosjektet.</p>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
        <div class="card">
            <div class="card-body">
                <a class="nav-link" href="{{ route('Last') }}"><h4 class="card-title">Last opp link til hjemmeside</h4></a>
                <p class="card-text">Her kan du laste opp link til hjemmeside for bachelor prosjektet.</p>
            </div>
        </div>
    </div>
   </div>
@endsection