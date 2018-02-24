<!DOCTYPE html>
<html lang="nb">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://student.hioa.no/hioa-theme/images/favicon.ico" rel="Shortcut Icon">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>{{config('app.name', 'BPO')}}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    @include('inc.navbar')
    @include('inc.feilmld') <!-- Legger ut feilmeldinger på siden, eks: prøver å laste opp dokument, men manger fil -->
    <div class="container">
        @if ($title != null)
            <h3>{{$title}}</h3>
        @endif

        @yield('content')
    </div>
    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>