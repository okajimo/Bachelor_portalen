@extends('layouts.app')
@section('content')
    <?php $finnes3 = Storage::exists('/public/filer/presentasjonsplan/true.txt'); ?>
    @if($finnes3 == true)
        <div class="jumbotron">
            <div class="container">
                Presentasjonsplanen har blitt lagt ut og kan finnes her: </br>
                <a href="{{ route('presentasjonsplan') }}"> Presentasjonsplan </a>
            </div>
        </div>
    @endif
    <div class="jumbotron">
        <div class="container">
            Bachelorprosjektene blir utført i siste semester i 3 klasse. Tildligere ble dette kalt hovedprosjekt.</br>
            Anskaffelse av oppgave og forberedelser til prosjektet skjer i løpet av høsten.
        </div>
    </div>
@endsection