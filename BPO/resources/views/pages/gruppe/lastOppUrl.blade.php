@extends('layouts.app')
@section('content')
    <div class="jumbotron">
        <div class="container">
            {!! Form::open(['action' => 'GruppeController@lastOppUrl', 'method' => 'POST'])!!}
            <div class="form-group"> 
            {{Form::label('url', 'Lim in link til hjemmeside.')}}
            </br>
            {{Form::text('url', '')}}
            {{form::hidden('_method', 'post')}}
            </div>
            {{Form::submit('Last opp',['class'=>'btn btn-primary', 'name' => 'lastOpp'])}}
            {!! Form::close() !!}
        </br>
        <?php 
        $student = session('navn');
        $url = DB::select('SELECT groups.group_number, groups.url FROM groups, student_groups WHERE groups.group_number = student_groups.student_groups_number AND groups.year = student_groups.student_groups_year AND student_groups.student = :stud',['stud'=>$student]);
         ?>
        @if ($url)
                <table class="table table-responsive">
                    <tr>
                        <td>Gruppe nummer</td>
                        <td>Url</td>
                    </tr>
                    @foreach ($url as $u)
                        <tr>
                            <td>{{$u->group_number}}</td>
                            <td><a href="{{$u->url}}">{{$u->url}}</a></td>
                        </tr>
                    @endforeach
                </table>
            @endif      
        </div>
    </div>
@endsection