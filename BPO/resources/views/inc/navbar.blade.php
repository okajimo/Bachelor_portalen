<nav class="navbar navbar-expand-lg navbar-light bg-light" style="padding:0; border-bottom:1px solid #bbbdbf;"><!-- Lagt til av Stian, fiks css Ivo!  -->
    <div class="container" style="padding: 0 1em">
        <a class="navbar-brand" href="/"><img src="https://student.hioa.no/hioa-theme/images/hioa-logo-no.svg" alt="Student" height="75" width="80"></a>
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
    <div class=" d-lg-none navbar-light">
        <div class="container hover-fix">
            @include('inc/navbar_innhold')
        </div>
    </div>
</div>
