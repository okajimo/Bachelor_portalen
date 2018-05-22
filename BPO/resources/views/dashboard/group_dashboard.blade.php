@extends('layouts.app')
<style>.card{margin-bottom: 1.5em}</style>
@section('crumb')
<div class="crumb tittel_tekst" aria-label="breadcrumb">
    <ol class="breadcrumb">
        @if($nummer)
            <li class="breadcrumb-item active" aria-current="page">Gruppe nummer: {{$nummer[0]->student_groups_number}}</li>
        @else
            <li class="breadcrumb-item active" aria-current="page">du er ikke medlem av gruppe</li>
        @endif
    </ol>
</div>
@endsection
@section('content')
   <div class="row">
    <?php $finnesNyheter = DB::select('select * from news'); ?>
    @if($finnesNyheter)
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
        <div class="card">
            <a class="nav-link" href="{{ route('news') }}">
                <h4 class="card-header">Nyheter </h4>
                <div class="card-body">
                    <?php $nyheter = DB::select('select tittel from news order by id DESC'); ?>
                    <p class="card-text">Nyheter publisert av administrator:</br>
                        @foreach($nyheter as $ny)
                            <b>{{$ny->tittel }}</br></b>
                        @endforeach
                    </p>
                </div>
            </a>
        </div>
    </div>
    @endif
     <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
       <div class="card">
         <a class="nav-link" href="{{ route('group') }}">
            <h4 class="card-header">Gruppeinnstillinger</h4>
            <div class="card-body">
                <p class="card-text">Her kan du registere en gruppe, melde deg inn i en gruppe, sette deg selv som leder i gruppen eller forlate gruppen.</p>
            </div>
         </a>
       </div>
     </div>
     <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
        <div class="card">
            <a class="nav-link" href="{{ route('lastOppS') }}">
                <h4 class="card-header">Last opp statusrapport</h4>
                <div class="card-body">
                    <p class="card-text">Her kan du laste opp statusrapport for bachelor prosjektet.</p>
                </div>
            </a>
        </div>
     </div>
     <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
        <div class="card">
            <a class="nav-link"  href="{{ route('lastOppP') }}">
                <h4 class="card-header">Last opp prosjektskisse</h4>
                <div class="card-body">
                    <p class="card-text">Her kan du laste opp prosjektskisse for bachelor prosjektet.</p>
                </div>
            </a>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
        <div class="card">
            <a class="nav-link" href="{{ route('Last') }}">
                <h4 class="card-header">Last opp link til hjemmeside</h4>
                <div class="card-body">
                    <p class="card-text">Her kan du laste opp link til hjemmeside for bachelor prosjektet.</p>
                </div>
            </a>
        </div>
    </div>
    <?php $finnes3 = Storage::exists('/public/filer/presentasjonsplan/true.txt'); ?>
        @if($finnes3 == true)
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                <div class="card">
                    <a class="nav-link"  href="{{ route('presentasjonsplan') }}">
                        <h4 class="card-header">Presentasjonsplan</h4>
                        <div class="card-body">
                            <p class="card-text">Her kan du se presentasjonsplanen til gruppen din.</p>
                        </div>
                    </a>
                </div>
            </div>
        @endif
   </div>
@endsection