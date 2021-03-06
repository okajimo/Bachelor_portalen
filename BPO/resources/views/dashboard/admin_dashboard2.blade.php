@extends('layouts.app')
<style>.card{margin-bottom: 1.5em}</style>
@section('logout')
    <a class="float-right btn btn-danger margin-fix-top" href="{{ route('logout') }}">Logout</a>
    <div class="clearfix"></div>
@endsection
@section('content')
    <h4>Simuler</h4>
    @include('inc.simuler')

    <h4>Informasjon</h4>
    <section class="text-center">
      <div class="container">
          <div class="row app-row">
            <div class="col-1">
              <span class="a_hover" data-toggle="modal" data-target="#exampleModal4"><i style="color:purple" class="app-ico far fa-envelope"></i><p>Epost</p></span>
            </div>
            <div class="col-1">
              <a href="{{ route('vnews') }}" class="a_hover"><i style="color:#3d79db" class="app-ico far fa-newspaper"></i><p>Nyheter</p></a>
            </div>
            
            <div class="col-1">
              <a href="{{ route('dokumenter') }}" class="a_hover"><i style="color:#3d79db" class="app-ico fas fa-book"></i><p>Dokumenter</p></a>
            </div>
            <div class="col-1">
              <span class="a_hover" data-toggle="modal" data-target="#exampleModal"><i style="color:#3d79db" class="app-ico far fa-question-circle"></i><p>Help</p></span>
            </div>
          </div>
      </div>
    </section>

    <h4>Funksjonalitet</h4>
    <section class="text-center">
      <div class="container">
          <div class="row app-row">
            <div class="col-1">
              <a href="{{ route('Agruppe') }}" class="a_hover"><i style="color:green"class="app-ico fas fa-users"></i><p>Administrer Grupper</p></a>
            </div>
            <div class="col-1" style="min-width: 9em;">
              <a href="{{ route('presentasjon2') }}" class="a_hover"><i style="color:green"class="app-ico fas fa-clipboard-list"></i><p>Presentasjonsplan</p></a>
            </div>
            <div class="col-1">
              <a href="{{ route('Pforslag') }}" class="a_hover"><i style="color:green" class="app-ico fas fa-file-alt"></i><p>prosjektforslag</p></a>
            </div>
          </div>
      </div>
    </section>

    <h4>Vedlikehold</h4>
    <section class="text-center">
      <div class="container">
          <div class="row app-row">
            <div class="col-1">
              <a href="{{ route('senvei') }}" class="a_hover"><span <i class="app-ico text-warning glyphicon glyphicon-user"></span><p>Sensorer og Veildere</p></a>
            </div>
            <div class="col-1">
              <a href="{{ route('student') }}" class="a_hover"><i style="color:green" class="app-ico fas fa-user-plus"></i><p>Administrer studenter</p></a>
            </div>
            <div class="col-1">
              <a href="/room" class="a_hover"><i class="app-ico text-warning far fa-building"></i><p>Grupperom</p></a>
            </div>
            <div class="col-1">
              <a href="{{ route('dato') }}" class="a_hover"><i  class="text-warning app-ico far fa-calendar-alt"></i><p>Datoer</p></a>
            </div>
          </div>
      </div>
    </section>
  <!--lightbox for epost-->
  <div id="div1"></div>
  <!--lightbox for help-->
  @include('inc.admin_help')
@endsection
@section('extra')
  <script src="{{asset('js/admin_help.js')}}"></script>
@endsection