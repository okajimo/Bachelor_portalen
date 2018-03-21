@if(session('levell') > 1)
    <div class="dropdown open">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu4" 
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" 
            style="color: black; background-color: #F1F1F2; border-color: #6c757d;"> <!-- Lagt til av Stian, Ivo fiks css -->
                Meny
            </button>
            <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('admin') }}">Dashboard</a>
                    <a class="dropdown-item" href="{{ route('student') }}">Vedlikehold studenter</a>
                    <a class="dropdown-item" href="{{ route('simuler') }}">Simuler student</a>
                    <a class="dropdown-item" href="{{ route('dokumenter') }}">Les dokumenter</a>
                    <a class="dropdown-item" href="{{ route('epost') }}">Send E-post</a>  
                    <a class="dropdown-item" href="{{ route('Pforslag') }}">Vedlikehold prosjektforslag</a>  
                    <a class="dropdown-item" href="{{ route('dato') }}">Datoer</a>  
                    <a class="dropdown-item" href="{{ route('Agruppe') }}">Administrer grupper</a>
                    <a class="dropdown-item" href="/room">Administrer grupperom</a>
                    <a class="dropdown-item" href="{{ route('senvei') }}">Vedlikehold sensorer/veildere</a>  
                    <a class="dropdown-item" href="{{ route('tidligere') }}">Generer presentasjonsplan</a> 
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
                <a class="dropdown-item" href="{{ route('gruppe') }}">Dashboard Gruppe</a>
                <a class="dropdown-item" href="{{ route('group') }}">Gruppe innstillinger</a>
                <a class="dropdown-item" href="{{ route('lastOppS') }}">Last opp statusrapport</a>
                <a class="dropdown-item" href="{{ route('lastOppP') }}">Last opp prosjektskisse</a>
                <a class="dropdown-item" href="{{ route('Last') }}">Last opp link til hjemmeside</a>
                <div class="dropdown-divider"></div>
                @if(session('orginal_navn'))
                    {!! Form::open(['action' => 'SimulerController@avsimuler', 'method' => 'POST', 'class' => 'dropdown-item']) !!}
                        {{Form::hidden('inn_navn',session('orginal_navn'))}}
                        {{Form::hidden('inn_level',session('orginal_level'))}} 
                        {{Form::submit('Stop simulering', ['class'=>'btn btn-danger'])}}    
                    {!! Form::close() !!}
                @else
                    <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                @endif
            </div>
        </div>
    @else
        <li><a class="btn btn-secondary" href="{{ route('login') }}" style="color: black; background-color: #F1F1F2; border-color: #6c757d;">Login</a></li>
@endif