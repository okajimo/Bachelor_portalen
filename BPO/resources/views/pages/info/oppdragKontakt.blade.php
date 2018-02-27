@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('inc.nav_header')
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 order-lg-4 order-xl-4">
            @include('inc.nav_side') 
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <div class="jumbotron">
                <div class="container">
                    <h2>Ta kontakt med oss!</h2>

                    <h3>Først til mølla får først male!</h3>
                    Mange studenter er allerede igang med å finne frem til prosjekter. De oppdragsgiverne som er tidlig ute
                    vil derfor kunne verve de beste studentene. Uansett må eventuelle prosjekter være presentert for
                    studentene i god tid før fristen for studentenes innlevering av prosjektskisser den {{ \DateHelper::instance()->date('project_sketch') }}.
                    <br/><br/>
                    Du kan ringe, sende brev, E-post eller komme på besøk. Her er våre adresser:
                    <br/><br/>

                    <h3>Besøksadresse</h3>
                    Pilestredet 35 - inngang fra Holbergs plass - rett ovenfor trikkeholdeplassen Holbergs plass

                    <h3>Brev</h3>
                    Høgskolen i Oslo og Akershus <br/>
                    Fakultet for Teknologi, Kunst og Design <br/>
                    Institutt for Informasjonsteknologi <br/>
                    Postboks 4, St. Olavs plass, 0130 Oslo

                    <h3>Telefon</h3>
                    22 45 32 00 (sentralbord)

                    <h3>E-post</h3>
                    Prosjektkontakt: Tor Krattebøl : tor.krattebol(a)hioa.no
                </div>
            </div>
        </div>
    </div>
@endsection