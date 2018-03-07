<!--
    Må definere i filen denne blir lagt inn i
    $side_nav = "annet";
-->

<nav style="padding:0; background:#FFFFFF !important;" class="nav-adjust navbar navbar-expand-lg navbar-light">
    <span class="nav-header-info navbar-toggler navbar-toggler-right" style="width:100%; " data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        Innhold
        <span class="glyphicon glyphicon-alert"></span>
    </span>  
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <div class="container">
            <ul class="navbar-nav mr-auto mt-2 mt-md-0">
                <li class="nav-item">
                    <a class="nav-link" href="/studenter"> Studenter</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/sensorer">Sensorer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/oppdragsgivere">Oppdragsgivere</a>
                </li>
                @if($side_nav == "student")
                    @include('inc.student_innhold_side_nav')
                @elseif($side_nav == "oppdrag")
                    @include('inc.oppdrag_innhold_side_nav')
                @endif
            </ul>
        </div>
    </div>
</nav>
<p></p>