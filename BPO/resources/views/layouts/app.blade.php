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
    <div class="container">
        <h3 style="border-bottom: 2px solid #ffe01d; float: left; padding-bottom: 5px">{{$title}}</h3>
        @yield('content')
    </div>
    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>