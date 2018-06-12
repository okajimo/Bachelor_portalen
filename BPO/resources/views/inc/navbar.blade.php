<nav class="navbar navbar-expand-lg navbar-light bg-light" style="padding:0; border-bottom:1px solid #bbbdbf;">
    <div class="container" style="padding: 0 1em">
        <a class="navbar-brand" href="{{ route('home') }}"><img src="{{asset('img/oslometlogo.png')}}" alt="Student" height="75" width="80"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse">
            @include('inc/navbar_innhold')
        </div>
        <div class="nav">
            @include('inc/login')
        </div>
    </div>
</nav>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <div class=" d-lg-none">
        <div class="jumbotron shadow-bottom">
            <div class="container collaps-custom">
                @include('inc/navbar_innhold')
            </div>
        </div>
    </div>
</div>