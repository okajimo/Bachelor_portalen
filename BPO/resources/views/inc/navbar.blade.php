<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!--<a class="navbar-brand" href="/">{{config('app.name', 'BPO')}}</a>-->
            <a class="navbar-brand" href="/"><img src="https://student.hioa.no/hioa-theme/images/hioa-logo-no.svg" alt="Student" height="75" width="80"></a>
        </div>
        <div>
            <section class="info">Bachelorprosjekt i informasjonsteknologi</section>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <!-- Venstre side av navbar -->
            <ul class="nav navbar-nav navbar-left">
                <li><a href="/informasjon">Informasjon</a></li>
                <li><a href="/prosjektforslag">Prosjektforslag</a></li>
                <li><a href="/tidligere_prosjekter">Tidligere Prosjekter</a></li>
                <li><a href="/grupper">Grupper</a></li>
                <li><a href="/kontakt_info">Kontakt oss</a></li>
            </ul>

            <!-- Høyre side av navbar -->
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Logg inn</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            <ul>
        </div>
    </div>
</nav>