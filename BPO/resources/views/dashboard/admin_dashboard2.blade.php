@extends('layouts.app')
<style>.card{margin-bottom: 1.5em}</style>
@section('content')

    <h2>Admin</h2>

    <h4>Informasjon</h4>
    <a href="{{ route('news') }}">news</a>
        <a href="{{ route('vnews') }}">Vedlikehold nyheter</a>
    <a href="{{ route('dato') }}">Datoer</a>
    <a href="{{ route('epost') }}">Send E-post</a>
    <a href="{{ route('dokumenter') }}">Les dokumenter</a>

    <h4>Funksjonalitet</h4>
    <a href="{{ route('simuler') }}">Simuler student</a>
    <a href="/administrer_gruppe">Administrer Gruppe</a>
    <a href="{{ route('presentasjon2') }}">Generer Presentasjonsplan</a>
    <a  href="{{ route('presentasjonsplan') }}">Presentasjonsplan</a>

    <h4>Vedlikehold</h4>
    <a href="{{ route('senvei') }}">Vedlikehold sensorer/veildere</a>
    <a href="{{ route('student') }}">Vedlikeholde studenter</a>
    <a href="/room">Administrer grupperom</a>
    <a href="{{ route('Pforslag') }}">Vedlikehold prosjektforslag</a>
    
    
    
    
@endsection