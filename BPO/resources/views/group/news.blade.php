@extends('layouts.app')
@section('content')
    <div class="jumbotron">
        <div class="container">
            @foreach($nyheter as $ny)
                <h4><?php echo $ny->tittel ?></h4>
                <?php echo $ny->melding ?></br></br>
            @endforeach
        </div>
    </div>
@endsection
