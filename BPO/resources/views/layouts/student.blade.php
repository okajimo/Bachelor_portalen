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
    <?php $side_nav = "student"; ?>
    @include('inc.navbar')
    <div class="container">
        @if ($title != null)
            <div class="crumb tittel_tekst" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('info') }} ">Informasjon</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('huske') }} ">Studenter</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
                </ol>
            </div>
            <!--<h3 class="tittel_tekst">{{$title}}</h3>-->
        @endif
        <div class="spacing_header"></div>
            <div class="row">
                <div class="col-12">
                    @include('inc.nav_header')
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8"> 
                    @yield('content')
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 d-none d-lg-block d-xl-block">
                    @include('inc.nav_side') 
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