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
                    else 
                    {
                        echo " du er ikke medlem av gruppe";
                    }
                ?>
            </h2>
            <div class="py-3 d-inline-block"></div>
        </div>
    </div>
   <div class="row">
    <?php $finnesNyheter = DB::select('select * from news'); ?>
    @if($finnesNyheter)
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
        <div class="card">
            <a class="nav-link" href="{{ route('news') }}">
                <h4 class="card-header">Nyheter <i class="fa fa-info-circle" aria-hidden="true" style="color: #fa3e3e;"></i></h4>
                <div class="card-body">
                    <p class="card-text">Her kan du lese nyheter publisert av administrator.</p>
                </div>
            </a>
        </div>
    </div>
    @endif
     <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
       <div class="card">
         <a class="nav-link" href="{{ route('group') }}">
            <h4 class="card-header">Gruppe innstillinger</h4>
            <div class="card-body">
                <p class="card-text">Her kan du registere en gruppe, melde deg inn i en gruppe, sette deg selv som leder i gruppen eller forlate gruppen.</p>
            </div>
         </a>
       </div>
     </div>
     <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
        <div class="card">
            <a class="nav-link" href="{{ route('lastOppS') }}">
                <h4 class="card-header">Last opp statusrapport</h4>
                <div class="card-body">
                    <p class="card-text">Her kan du laste opp statusrapport for bachelor prosjektet.</p>
                </div>
            </a>
        </div>
     </div>
     <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
        <div class="card">
            <a class="nav-link"  href="{{ route('lastOppP') }}">
                <h4 class="card-header">Last opp prosjektskisse</h4>
                <div class="card-body">
                    <p class="card-text">Her kan du laste opp prosjektskisse for bachelor prosjektet.</p>
                </div>
            </a>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
        <div class="card">
            <a class="nav-link" href="{{ route('Last') }}">
                <h4 class="card-header">Last opp link til hjemmeside</h4>
                <div class="card-body">
                    <p class="card-text">Her kan du laste opp link til hjemmeside for bachelor prosjektet.</p>
                </div>
            </a>
        </div>
    </div>
    <?php $finnes3 = Storage::exists('/public/filer/presentasjonsplan/true.txt'); ?>
        @if($finnes3 == true)
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                <div class="card">
                    <a class="nav-link"  href="{{ route('presentasjonsplan') }}">
                        <h4 class="card-header">Presentasjonsplan</h4>
                        <div class="card-body">
                            <p class="card-text">Her kan du se presentasjonsplanen til gruppen din.</p>
                        </div>
                    </a>
                </div>
            </div>
        @endif
   </div>
@endsection