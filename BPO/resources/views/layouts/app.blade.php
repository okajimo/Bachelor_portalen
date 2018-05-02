<!DOCTYPE html>
<html lang="nb">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{asset('img/oslometlogo.png')}} " rel="Shortcut Icon">
    <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('bower_components/glyphicons/styles/glyphicons.css')}}">
    <link rel="stylesheet" href="{{asset('bower_components/Font-Awesome/web-fonts-with-css/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    @yield('extra-head')
    <title>{{config('app.name', 'BPO')}}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    @include('inc.navbar')
    <div class="container">
        <div>
             @if ($title != null)
                <h3 class="tittel_tekst">{{$title}}</h3>
             @else
                @yield("crumb")
             @endif
             
             @yield('logout')
        </div>

        <div class="spacing_header">
            @include('inc.feilmld')
        </div>
        
        @yield('content')
    </div>
    <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('bower_components/jquery-ui/jquery-ui.js')}}"></script>
    <script src="{{asset('bower_components/popper.js/dist/umd/popper.js')}}"></script>
    <script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <!--Confirm delete-->
    <script>function ConfirmDelete(){ var x = confirm("Bekreft sletting"); if (x) return true; else return false;}</script>
    @yield('extra')
</body>
</html>