@extends('layouts.app')
@section('content')
    <div class="jumbotron">
        <div class="container">
            {!! Form::open(['action' => 'Admin\AdminController@lagNyhet', 'method' => 'POST']) !!}  
                <div class="form-group">  
                    {{Form::label('post', 'Nyheter vil automatisk bli visst på nyhetsiden.')}}
                </div>
                <div class="form-group form-inline">  
                    {{Form::text('tittel', '',['placeholder'=>'Skriv in tittel her...','class'=>'form-control', 'pattern' => '[A-Za-z0-9 ÅØÆåøæ!?.:]{1,45}'])}}
                </div>
                <div class="form-group form-inline">  
                    {{Form::textarea('melding', '',['id' => 'article-ckeditor', 'class'=>'form-control', 'required'])}}
                </div>
                {{Form::submit('Lag nyhet', ['class'=>'btn btn-success'])}}    
            {!! Form::close() !!} 
            </br>
        <table class="table table-responsive">
                <thead class="thead-light">
                    <tr>
                        <th>Bruker</th>
                        <th>Tittel</th>
                        <th>Slett</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($nyheter as $nyh)
                    <tr>
                        <td>{{$nyh->user}}</td>
                        <td>{{$nyh->tittel}}</td>
                        <td>
                            {!! Form::open(['action' => 'Admin\AdminController@slettNyhet', 'method' => 'POST','onsubmit' => 'return ConfirmDelete()']) !!}  
                                    {{Form::hidden('id',$nyh->id)}}
                                {{Form::submit('Slett post', ['class'=>'btn btn-danger'])}}    
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('extra')
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
@endsection
