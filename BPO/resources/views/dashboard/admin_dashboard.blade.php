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
                <div class="card-body">
                    <h4 class="card-title"><a  href="/room">Administrer gruppe rom</a></h4>
                    <p class="card-text">Her kan man legge til, fjerne og editere grupperom som blir tatt i bruk</p>
                </div>
            </div>
        </div>
     <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
       <div class="card">
         <div class="card-body">
            <a class="nav-link" href="{{ route('student') }}"><h4 class="card-title">Vedlikeholde studenter</h4></a>
           <p class="card-text">Her kan du importere studenter eller endre studie poeng for studenter.</p>
         </div>
       </div>
     </div>
     <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
        <div class="card">
            <div class="card-body">
                <a class="nav-link" href="{{ route('logout') }}"><h4 class="card-title">Simuler student</h4></a>
                <p class="card-text">Her kan du simulere student bruker.</p>
            </div>
        </div>
     </div>
     <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
        <div class="card">
            <div class="card-body">
                <a class="nav-link" href="{{ route('dokumenter') }}"><h4 class="card-title">Les dokumenter</h4></a>
                <p class="card-text">Her kan du lese opplastede dokumenter av student gruppene..</p>
            </div>
        </div>
     </div>
     <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
        <div class="card">
            <div class="card-body">
                <a class="nav-link" href="{{ route('epost') }}"><h4 class="card-title">Send E-post</h4></a>
                <p class="card-text">Her kan du sende e-post til alle studentene.</p>
            </div>
        </div>
     </div>
     <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
        <div class="card">
            <div class="card-body">
                <a class="nav-link" href="{{ route('logout') }}"><h4 class="card-title">Vedlikehold prosjektforslag</h4></a>
                <p class="card-text">Her kan du laste opp prosjektforslag eller slette dem.</p>
            </div>
        </div>
     </div>
     <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
        <div class="card">
            <div class="card-body">
                <a class="nav-link" href="{{ route('dato') }}"><h4 class="card-title">Datoer</h4></a>
                <p class="card-text">Her håndterer du vedlikehold av statiske datoer på bachelor siden.</p>
            </div>
        </div>
     </div>
     <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
        <div class="card">
            <div class="card-body">
                <a class="nav-link"  href="{{ route('logout') }}"><h4 class="card-title">Gruppe innstillinger</h4></a>
                <p class="card-text">Her kan du se grupper og slette dem.</p>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
        <div class="card">
            <div class="card-body">
                <a class="nav-link" href="{{ route('logout') }}"><h4 class="card-title">Vedlikehold sensorer/veildere</h4></a>
                <p class="card-text">Her kan du registrere sensor eller veileder, samt slette dem.</p>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <a class="nav-link" href="{{ route('tidligere') }}"><h4 class="card-title">Vedlikehold tidligere prosjekter</h4></a>
                    <p class="card-text">Her kan du generere html sider for tidligere prosjekter</p>
                </div>
            </div>
        </div>
   </div>
@endsection