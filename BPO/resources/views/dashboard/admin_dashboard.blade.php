@extends('layouts.app')
<style>.card{margin-bottom: 1.5em}</style>
@section('content')
    <div class="row text-center">
        <div class="col-12">
        <h2>Admin: {{session('navn')}}</h2>
            <div class="py-3 d-inline-block"></div>
        </div>
    </div>
   <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
            <div class="card">
                <a class="nav-link" href="/room">
                    <h4 class="card-header">Administrer grupperom</h4>
                    <div class="card-body">
                        <p class="card-text">Her kan man legge til, fjerne og editere grupperom som blir tatt i bruk</p>
                    </div>
                </a>
            </div>
        </div>
     <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
       <div class="card">
         <a class="nav-link" href="{{ route('student') }}">
            <h4 class="card-header">Vedlikeholde studenter</h4>
            <div class="card-body">
            <p class="card-text">Her kan du importere studenter eller endre studie poeng for studenter.</p>
            </div>
         </a>
       </div>
     </div>
     <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
        <div class="card">
            <a class="nav-link" href="{{ route('simuler') }}">
                <h4 class="card-header">Simuler student</h4>
                <div class="card-body">
                    <p class="card-text">Her kan du simulere student bruker.</p>
                </div>
            </a>
        </div>
     </div>
     <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
        <div class="card">
            <a class="nav-link" href="{{ route('dokumenter') }}">
                <h4 class="card-header">Les dokumenter</h4>
                <div class="card-body">
                    <p class="card-text">Her kan du lese opplastede dokumenter av student gruppene..</p>
                </div>
            </a>
        </div>
     </div>
     <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
        <div class="card">
            <a class="nav-link" href="{{ route('epost') }}">
                <h4 class="card-header">Send E-post</h4>
                <div class="card-body">
                    <p class="card-text">Her kan du sende e-post til alle studentene.</p>
                </div>
            </a>
        </div>
     </div>
     <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
        <div class="card">
            <a class="nav-link" href="{{ route('logout') }}">
                <h4 class="card-header">Vedlikehold prosjektforslag</h4>
                <div class="card-body">
                    <p class="card-text">Her kan du laste opp prosjektforslag eller slette dem.</p>
                </div>
            </a>
        </div>
     </div>
     <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
        <div class="card">
            <a class="nav-link" href="{{ route('dato') }}">
                <h4 class="card-header">Datoer</h4>
                <div class="card-body">
                    <p class="card-text">Her håndterer du vedlikehold av statiske datoer på bachelor siden.</p>
                </div>
            </a>
        </div>
     </div>
     <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
        <div class="card">
            <a class="nav-link"  href="{{ route('logout') }}">
                <h4 class="card-header">Gruppe innstillinger</h4>
                <div class="card-body"> 
                    <p class="card-text">Her kan du se grupper og slette dem.</p>
                </div>
            </a>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
        <div class="card">
            <a class="nav-link" href="{{ route('logout') }}">
                <h4 class="card-header">Vedlikehold sensorer/veildere</h4>
                <div class="card-body">  
                    <p class="card-text">Her kan du registrere sensor eller veileder, samt slette dem.</p>
                </div>
            </a>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
            <div class="card">
                <a class="nav-link" href="{{ route('tidligere') }}">
                    <h4 class="card-header">Vedlikehold tidligere prosjekter</h4>
                    <div class="card-body"> 
                        <p class="card-text">Her kan du generere html sider for tidligere prosjekter</p>
                    </div>
                </a>
            </div>
        </div>
   </div>
@endsection