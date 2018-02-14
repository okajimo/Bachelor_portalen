@extends('layouts.app')
@section('content')
    <div class="jumbotron">
        <div class="container">
            <div class="row">
                <div class="col-lg-offset-3 col-lg-6">

                    @if (count($errors) > 0)
                        @foreach($errors->all() as $error)
                            <p class="alert alert-danger">{{$error}}</p>
                        @endforeach
                    @endif

                    <form class="form-horizontal" action="{{route('login')}}" method="post">
                    {{csrf_field()}}
                    <fieldset>
                        <legend>Logg inn her!</legend>

                            <div class="form-group">
                                <label for="inputBruker" class="col-lg-4 control-label">Brukernavn</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" id="inputBruker" value="{{old('username')}}" name="username" placeholder="brukernavn">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputPassord" class="col-lg-4 control-label">Passord</label>
                                <div class="col-lg-8">
                                    <input type="password" class="form-control" id="inputPassord" value="{{old('password')}}" name="password" placeholder="passord">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                                </div>
                            </div>
                    </fieldset>
                </div>
            </div>
        </div> 
    </div>
@endsection