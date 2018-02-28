<!DOCTYPE html>
<html lang="nb">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://student.hioa.no/hioa-theme/images/favicon.ico" rel="Shortcut Icon">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>{{config('app.name', 'BPO')}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    @include('inc.navbar')
    <div class="container">
        @if ($title != null)
            <h3>{{$title}}</h3>
        @else
            <h3 style="visibility:hidden">hidden</h3>
        @endif
        <div class="spacing_header"></div>
            <div class="row">
                <div class="col-12">
                    @include('inc.nav_header')
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 order-lg-4 order-xl-4">
                    @include('inc.nav_side') 
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
                    <div class="jumbotron">
                        <ul class="nav navbar-nav">
                            <li><a href="/oppdragProsjekt"><h4>Hva er et bachelorprosjekt?</h4></a></li>
                            <li><a href="/oppdragStudent"><h4>Hva kan en datastudent?</h4></a></li>
                            <li><a href="/oppdragSammarbeid"><h4>Samarbeid med bedrifter</h4></a></li>
                            <li><a href="/oppdragBedrift"><h4>Har din bedrift et prosjekt?</h4></a></li>
                            <li><a href="/oppdragKontakt"><h4>Ta kontakt</h4></a></li>
                        </ul>
                    </div>
                    
                    @yield('content')
                </div>
            </div>
        </div>      
    </div>
    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>