@extends('layouts.app')
@section('content')
    <div class="jumbotron">
        <div class="container">
            {!! Form::open(['action' => 'GruppeController@lastOppUrl', 'method' => 'POST'])!!}
                <div class="form-group"> 
                <h5>{{Form::label('url', 'Last opp link til hjemmeside her.')}}</h5>
                <div class="form-group form-inline"> 
                    {{Form::text('tittel', '',['placeholder' => 'Navn på link...','class'=>'form-control', 'required', 'maxlength' => '45','pattern'=>'[A-Za-z æøåÆØÅ]*','title'=>'Tittel må være boksaver og kun fra 1 til 45 tegn'])}} </br>
                </div>
                <div class="form-group form-inline"> 
                    {{Form::text('url', '',['placeholder' => 'Lim in link her...','class'=>'form-control', 'maxlength' => '127','required', 'pattern'=>'((https?|http):\/\/)(www.)?[a-z0-9]+\.[a-z]+([/a-zA-Z0-9#]+\/?)*', 'title'=>'Full url (http(s)://www.server.com/path/)'])}}
                </div>
                    {{form::hidden('_method', 'post')}}
                </div>
                {{Form::submit('Last opp',['class'=>'btn btn-success', 'name' => 'lastOpp'])}}
            {!! Form::close() !!}      
        </div>
    </div>
    <div class="container container-no-padding">
        <?php 
            $student = session('navn');
            $url = DB::select('SELECT groups.group_number, groups.url FROM groups, student_groups WHERE groups.group_number = student_groups.student_groups_number AND groups.year = student_groups.student_groups_year AND student_groups.student = :stud',['stud'=>$student]);
        ?>
        @if ($url)
            <table class="table table-responsive">
                <thead class="thead-light">
                    <tr>
                        <th>Gruppe nummer</th>
                        <th>Url</th>
                    </tr>
                </thead>
                <tbody class="bg-light">
                    @foreach ($url as $u)
                        <tr>
                            <td>{{$u->group_number}}</td>
                            <td><a href="{{$u->url}}" target='_blank'>{{$u->url}}</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection