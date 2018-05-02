<!DOCTYPE html>
<html lang="nb">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{asset('img/oslometlogo.png')}} " rel="Shortcut Icon">
    <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('bower_components/glyphicons/styles/glyphicons.css')}}">
    <link rel="stylesheet" href="{{asset('bower_components/Font-Awesome/web-fonts-with-css/css/fontawesome-all.min.css')}}">
    @yield('extra-head')
    <title>{{config('app.name', 'BPO')}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <?php $side_nav = "oppdrag"; ?>
    @include('inc.navbar')
    <div class="container">
        @if ($title != null)
            <div class="crumb tittel_tekst" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('info') }} ">Informasjon</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('oppdrag') }} ">Oppdragsgivere</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
                </ol>
            </div>
        @endif
        <div class="spacing_header"></div>
            <div class="row">
                <div class="col-12">
                    @include('inc.nav_header')
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 order-lg-4 order-xl-4 d-none d-lg-block d-xl-block">
                    <div class="jumbotron">
                        <div class="container">
                            <div>
                                <a class="nav-link link-overwrite" href="/oppdragProsjekt"><h5 class="underline_link">Hva er et bachelorprosjekt?</h5></a>
                                <a class="nav-link link-overwrite" href="/oppdragStudent"><h5 class="underline_link">Hva kan en datastudent?</h5></a>
                                <a class="nav-link link-overwrite" href="/oppdragSammarbeid"><h5 class="underline_link">Samarbeid med bedrifter</h5></a>
                                <a class="nav-link link-overwrite" href="/oppdragBedrift"><h5 class="underline_link">Har din bedrift et prosjekt?</h5></a>
                                <a class="nav-link link-overwrite" href="/oppdragKontakt"><h5 class="underline_link">Ta kontakt</h4></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
                    @yield('content')
                </div>
            </div>
        </div>      
    </div>
    <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('bower_components/jquery-ui/jquery-ui.js')}}"></script>
    <script src="{{asset('bower_components/popper.js/dist/umd/popper.js')}}"></script>
    <script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>
    @yield('extra')
</body>
</html>