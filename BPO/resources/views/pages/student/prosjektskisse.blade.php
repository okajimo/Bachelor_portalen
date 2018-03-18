@extends('layouts.student')
@section('content')
    <div class="jumbotron">
        <div class="container">
            <h3>Presisering av problemet</h3>
            <p>
                Når du har fått tak i et prosjekt i form av et problem, en idé, en skisse eller lignende, må du starte arbeidet med å
                presisere prosjektet. Problemet må defineres mest mulig presist, og dermed må det også bestemmes hva som
                ikke skal være en del av problemet. Det bør, hvis det er mulig, fastsettes rammebetingelser, krav til
                utviklingsplattform (maskinvare og programvare) og andre relevante krav. Det kan hende at konklusjonen blir at
                det gitte problemet ikke egner seg som et hovedprosjekt. Det vil være uheldig å måtte trekke en slik konklusjon,
                men det er enda verre å måtte gjøre det på et mye senere tidspunkt. I denne fasen er det fortsatt tid til å
                omdefinere hele prosjektet eller eventuelt velge et helt annet prosjekt. Hvis imidlertid alt går bra skal det hele
                oppsummeres i en <strong>prosjektskisse</strong>.
            </p>
            <h3>Prosjektskissen</h3>
            <p>
                <ul>
                    <li>Overskrift som forteller at dette er et hovedprosjekt i data/informasjonsteknologi ved Høgskolen i Oslo og Akershus.</li>
                    <li>Sted og dato</li>
                    <li>Foreløpig tittel på prosjektet</li>
                    <li>Navn på medlemmene av prosjektgruppen</li>
                    <li>Navn og øvrige data (adresse, tlf, m.m.) på oppdragsgiver</li>
                    <li>Navn og øvrige data (tlf, stilling, m.m.) på kontaktperson/er hos oppdragsgiver</li>
                    <li>
                        Beskrivelse/skisse av prosjektet. Denne skissen skal inneholde en kort presentasjon av oppdragsgiver,
                        av prosjektets plass i oppdragsgivers virksomhet og videre en mest mulig omfattende beskrivelse av
                        selve prosjektet. Videre mulige krav til maskinplattform, dataverktøy og andre rammebetingelser som
                        måtte være gitt allerede i denne fasen. Generelt skal dere her ha med all den relevante informasjonen
                        dere måtte ha om prosjektet.
                    </li>
                </ul>
            </p>
            <h3>Krav til prosjektskissen</h3>
            <p>
                Prosjektskissen skal lages som en side i et eller annet format og skal være <strong>tilgjengelig via prosjektets
                hjemmeside</strong>. Se nedenfor. Velg helst et åpent format på prosjektskissen, f.eks. html eller pfd. I omfang (ved
                papirutskrift) skal den være på maks en A4-side.</br></br>

                Det er ikke satt opp noen spesielle krav til prosjektskissens utseende - dvs. layout, skrifttyper, farger, grafikk
                m.m. Det blir opp til hver enkelt gruppe å velge ut fra hva gruppen selv synes er passende.</br></br>

                Hensikten med prosjektskissen er todelt. Det er viktig for prosjektgruppen å få så mange detaljer om prosjektet
                på plass så tidlig som mulig. I tillegg vil høgskolen bruke prosjektskissen til å ta den endelige avgjørelsen om
                prosjektet egner seg til hovedprosjekt og deretter til å bestemme hvem som skal være intern veileder for
                prosjektet. Videre vil prosjektskissen være et vedlegg til den samarbeidsavtalen som skal inngås mellom
                oppdragsgiver og høgskolen.
            </p>
            <h3>Hjemmeside for ditt hovedprosjekt</h3>
            <p>
                Prosjektgruppene må opprette hjemmesider for hovedprosjektene. Inntil videre legges hjemmesidene der hvor
                det passer beste for gruppene. Dere oppgir tittel på hovedprosjektet og url for hjemmesiden etter at
                prosjektgruppen er registrert i <a href="{{ route('login') }}">registreringssystemet</a>. Senere vil hver prosjektgruppe få tildelt et eget område på
                skolens web-tjener, dvs. på http://student.cs.hioa.no/hovedprosjekter/20yy/data/xx/ der prosjektnummer skal inn
                istedenfor xx. Hit må dere da flytte sluttdokumentasjonen. Hensikten med å ha et fast og felles område er at dette
                vil være tilgjengelig også etter at dere har sluttet som studenter.
            </p>
        </div>
    </div>
@endsection