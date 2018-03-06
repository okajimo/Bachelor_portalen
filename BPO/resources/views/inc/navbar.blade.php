<nav class="navbar navbar-expand-lg navbar-light bg-light" style="border-bottom:1px solid #bbbdbf;"><!-- Lagt til av Stian, fiks css Ivo!  -->
    <div class="container">
        <a class="navbar-brand" href="/"><img src="https://student.hioa.no/hioa-theme/images/hioa-logo-no.svg" alt="Student" height="75" width="80"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/informasjon">Informasjon <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/prosjektforslag">Prosjektforslag</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/tidligere_prosjekter">Tidligere Prosjekter</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/grupper">Grupper</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/kontakt_info">Kontakt oss</a>
                </li>
            </ul>
        </div>
        <div class="nav">
            @include('inc/login')
        </div>
    </div>
</nav>

