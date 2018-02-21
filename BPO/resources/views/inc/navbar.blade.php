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
            <ul class="nav navbar-nav navbar-right">
                @if(session('levell') > 1)
                <div class="dropdown open">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu4" 
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" 
                        style="color: black; background-color: #F1F1F2; border-color: #6c757d;"> <!-- Lagt til av Stian, Ivo fiks css -->
                            {{ session('navn') }}
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="{{ route('logout') }}">Vedlikehold brukere</a>
                          <a class="dropdown-item" href="{{ route('logout') }}">Simuler student</a>
                          <a class="dropdown-item" href="{{ route('logout') }}">Les dokumenter</a>
                          <a class="dropdown-item" href="{{ route('logout') }}">Send E-post</a>
                          <a class="dropdown-item" href="{{ route('logout') }}">Vedlikehold prosjektforslag</a>
                          <a class="dropdown-item" href="{{ route('logout') }}">Datoer</a>
                          <a class="dropdown-item" href="{{ route('logout') }}">Vedlikehold grupper</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                        </div>
                </div>
                @elseif(session('levell') == 1)
                <div class="dropdown open">
                        <button class="btn btn-secondary dropdown-toggle"
                                type="button" id="dropdownMenu4" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" style="color: black; background-color: #F1F1F2; border-color: #6c757d;">
                            {{ session('navn') }}
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="{{ route('group') }}">Vedlikehold gruppe</a>
                          <a class="dropdown-item" href="{{ route('logout') }}">Statusrapport</a>
                          <a class="dropdown-item" href="{{ route('logout') }}">Prosjektskisse</a>
                          <a class="dropdown-item" href="{{ route('logout') }}">Bachelorprosjekttittel</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                        </div>
                      </div>
                @else
                    <li><a class="btn btn-secondary" href="{{ route('login') }}" style="color: black; background-color: #F1F1F2; border-color: #6c757d;">Login</a></li>
                @endif
                
            <ul>
        </div>
    </div>
</nav>
