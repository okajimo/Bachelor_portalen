@extends('layouts.app')
@section('content')    
<div class="jumbotron">
    <div class="container">
        <h3>Prosjektarbeide</h3>

            Prosjektarbeidet skjer i samarbeid med oppdragsgiver og intern veileder. Du har også anledning til å spørre
            de andre datalærerne hvis du har problemer som går inn på områder der andre datalærere har spesialkunnskap.
            Prosjektgruppen har selv ansvaret for prosjektets fremdrift og resultater og for at prosjektrapporten leveres
            innen fristen.

        <h3>Prosjektdokumentasjonen</h3>

            På Institutt for Informasjonsteknologi er det fastsatt en dokumentasjonsstandard for bachelorprosjekter.
            Denne standarden skal normalt følges. Prosjektgruppen avtaler med sin veileder eventuelle endringer til denne.                 
        
        <h3>Oppdragsgiver</h3>

            Prosjektgruppen bestemmer selv utformingen av den dokumentasjonen som oppdragsgiver skal ha.
            Hva den skal inneholde og hvilket format den skal ha, blir en sak mellom prosjektgruppen og oppdragsgiver.
            Men det normale er at oppdragsgiver får minimum produktdokumentasjonen.
            Overlevering av hele rapporten, eller deler av denne til oppdragsgiver må prosjektgruppen ordne med selv.

        <h3>Elektronisk format</h3>

            Alle prosjektgruppene får tildelt et eget område på skolens web-tjener og der
            skal all dokumentasjon som hører til prosjektet ligge. På dette området skal alle ha en indeksside
            (f.eks. index.html eller tilsvarende) som "forside" eller "portal" til prosjektet.
            Dere bestemmer selv hvordan denne "forsiden" eller "portalen" skal utformes.
            Men den skal inneholde linker til de "dokumentene" som inngår
            - f.eks. prosess- og produktdokumentasjon, brukerveiledninger m.m.
            I tilegg bør siden kanskje inneholde en kort beskrivele av prosjektet.
            "Forsiden" bør lages litt apetittvekkende - med grafikk, farger, logoer m.m.
            Husk at sensor vil kunne se denne siden når han/hun skal sette seg inn i prosjektet.
            Det er også meningen at disse prosjektsidene skal ligge der noen år fremover slik at de neste kullene
            av studenter kan bruke det dere har gjort som eksempler og forbilder. <br/><br/>

        <h3>Tilgjengelighet</h3>

            Noen oppdragsivere har bestemt at deler (eller eventuelt alt) av prosjektets resultater ikke skal
            være offentlig tilgjengelig. Dette kan løses ved at de delene av dokumentasjonen som skal være
            untatt offentligheten, sperres med passord. Selve "forsiden" eller "portalen" til prosjektet
            skal ikke være sperret. Men de linkene som fører videre til "hemmelige ting" kan sperres med passord.
            Hvis dette ikke skulle være god nok løsning, kan det vurderes at "det hemmelige" overhodet
            ikke er tilgjengelig på nett. Men alt som ønskes vurdert ved karaktersettingen, må være tilgjengelig
            for sensorene via det som er levert inn i eksamenssystemet.

        <h3>Hva skal leveres?</h3>
            <ol>
                <li>
                    Det skal leveres en prosjektrapport. Dette blir også omtalt som en sluttrapport.
                    Den består av alle delrapportene, dvs. minimum en prosjektrapport og en prosessrapport og vedlegg. Dette skal samles i ett hefte og ha felles forside
                    (se punkt 2. nedenfor), tittelside (se punkt. 3. nedenfor),
                    forord og overordnet innholdsfortegnelse.
                </li>
                <li>
                    Prosjektrapporten (se punkt 1.) må ha en forside (omslagside) etter eget valg.
                    Der kan dere bruke farger, ha bilder, tegninger, logoer, m.m. Oppløsningen på forsiden må være minst 300 dots-per-inch
                    slik at den kan skrives ut i plakatformat for skolens bruk.

                </li>
                <li>
                    Prosjektrapporten (se punkt 1.) skal ha en tittelside laget etter skolens mal.
                    Tittelsiden er første side i prosjektrapporten etter forsiden. Malen finnes som word-dokument.
                    Flg. eksempel, som er en bearbeidet versjon av en tittelside fra et tidligere år,
                    viser hvordan en slik tittelside kan lages.
                </li>
                <li>
                    Prosjektrapporten vil som nevnt i punkt 1, kunne inneholde flere delrapporter samlet in PDF fil.
                    Det er ikke nødvendig å ha en gjennomgående sidenummerering. Det er helt ok
                    at hver av delrapportene har sin egen sidenummerering. La det imidlertid være en "header"
                    eller "footer" som forteller hvilken rapport en side hører til. Det er også gunstig at hver
                    delrapport har en egen forside. Tittelsiden nevnt i punkt 3 skal det imidlertid være kun ett
                    eksemplar av og den skal ligge som første side i prosjektrapporten.
                    Bruk et "normalt" word format, 1 i linjeavstand og en 12 punkter font.
                </li>
                <li>
                    I rapporten holder det normalt å ta med utvalgte eksempeler på kildekode. Kildekoden må vedlegges PDF-rapporten i en ZIP fil.
                </li>
            </ol>

        <h3>Digital innlevering</h3>

            Bacheloroppgaven skal leveres digitalt og dette innebærer:
                <ul>
                    <li>
                        Rapporten skal leveres som EN PDF-fil. Det er ikke nødvendig å lage fysiske kopier av rapporten
                        med mindre gruppen ønsker dette selv.
                    </li>
                    <li>
                        Kildekoden skal ved digital innlevering leveres som vedlegg og da som en zip´et fil.
                    </li>
                    <li>
                        Detaljer om hvordan den elektroniske innleveringen vil foregå kommer fra eksamenskontoret noen dager før innlevering.
                    </li>
                    </ul>
                        <h3>Øvrige krav</h3>
                    <ul>
                    <li>
                        Prosjektets hjemmeside på internett skal også gjøres tilgjengelig. Minimum må det legges ut en fil av prosjektrapporten i PDF.
                    </li>
                </ul>

        <h3>Frister</h3>
            <ul>
                <li>
                Elektronisk innlevering skal skje innen 23.5.2018 kl. 12.00. <!-- Dato må hentes fra db -->
                </li>
                <li>
                    Prosjektets hjemmeside skal være oppdatert innen 23.5.2018 kl. 12.00.. Det vil være anledning <!-- Dato må hentes fra db -->
                    til å gjøre endringer på hjemmesiden helt frem til presentasjonsdagen, men eventuelle endringer
                    i den elektroniske versjonen av prosjektrapporten vil ikke bli tatt hensyn til under sensureringen.
                    Dokumentasjonen må være flyttet til det faste området (http://student.cs.hioa.no/hovedprosjekter/data/20yy/xx/)
                    innen dere skal holde presentasjonen. Se dette <a href="Guide-for-innlevering.pdf">dokumentet</a> for å legge data inn på dette området.
                </li>
                <li>
                    Hvis dere f.eks. bruker PowerPoint under presentasjonen, vil det være fint om dere la ut eventuelle
                    ppt-filer på hjemmesiden (med lett synlig lenke). Det vil være til stor nytte for neste års studenter.
                </li>
            </ul>
    </div>
</div>
@endsection