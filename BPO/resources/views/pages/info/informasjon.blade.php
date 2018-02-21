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

  <div class="dropdown open">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Dropdown
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="#!">Separated link</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="#!">Action</a>
    <a class="dropdown-item" href="#!">Another action</a>
  </div>
</div>


    <div class="jumbotron">
        <div class="container">
            <p>Her finner du nødvendig informasjon til studenter, sensorer og oppdragsgivere.</p>
        </div>
    </div>
    <div class="bd-example">
  
  <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
      <div class="carousel-item active">
        <img class="d-block w-100" src="http://www.smartstudynj.com/s/img/emotionheader.jpg" alt="First slide">
        <div class="carousel-caption d-none d-md-block">
          <h3>First slide label</h3>
          <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="https://st2.depositphotos.com/1954927/8880/v/950/depositphotos_88808266-stock-illustration-vector-illustration-university-flat-header.jpg" alt="Second slide">
        <div class="carousel-caption d-none d-md-block">
          <h3>Second slide label</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
@endsection