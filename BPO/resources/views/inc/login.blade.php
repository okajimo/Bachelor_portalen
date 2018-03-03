@if(session('levell') > 1)
    <div class="dropdown open">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu4" 
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" 
            style="color: black; background-color: #F1F1F2; border-color: #6c757d;"> <!-- Lagt til av Stian, Ivo fiks css -->
                Meny
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('logout') }}">Vedlikehold brukere</a>
                <a class="dropdown-item" href="{{ route('logout') }}">Simuler student</a>
                <a class="dropdown-item" href="{{ route('dokumenter') }}">Les dokumenter</a>
                <a class="dropdown-item" href="{{ route('logout') }}">Send E-post</a>
                <a class="dropdown-item" href="{{ route('logout') }}">Vedlikehold prosjektforslag</a>
                <a class="dropdown-item" href="{{ route('logout') }}">Datoer</a>
                <a class="dropdown-item" href="{{ route('logout') }}">Gruppe innstillinger</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
            </div>
    </div>
    @elseif(session('levell') == 1)
        <div class="dropdown open">
            <button class="btn btn-secondary dropdown-toggle"
                    type="button" id="dropdownMenu4" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false" style="color: black; background-color: #F1F1F2; border-color: #6c757d;">
                Meny
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('group') }}">Gruppe innstillinger</a>
                <a class="dropdown-item" href="{{ route('lastOppS') }}">Last opp statusrapport</a>
                <a class="dropdown-item" href="{{ route('lastOppP') }}">Last opp prosjektskisse</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
            </div>
        </div>
    @else
        <li><a class="btn btn-secondary" href="{{ route('login') }}" style="color: black; background-color: #F1F1F2; border-color: #6c757d;">Login</a></li>
@endif