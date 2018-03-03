@extends('layouts.app')
@section('content')
    <div class="jumbotron">
        <div class="container">
            <table class="table">
                <thead class="thead-light">
                        <tr>
                            <th>Gruppe nummer</th>
                            <th>År</th>
                            <th>Fil navn</th>
                            <th>Tittel</th>
                        </tr>

                        @foreach($groups as $group)
                            @if($group->year >= date('Y'))
                                @if($group->leader ==! "")
                                    <?php  
                                        $student = DB::select('select student_groups.student from student_groups, groups 
                                        where groups.group_number = student_groups.student_groups_number and groups.year = student_groups_year 
                                        and student_groups.student_groups_number LIKE :number and student_groups.student_groups_year LIKE :year', 
                                        ['number' => $group->group_number, 'year' => $group->year]);

                                        $dokumenter = DB::select('SELECT documents.file_name FROM documents WHERE documents.documents_groups_number = :nummer 
                                        AND documents.documents_year = :year',['nummer' => $group->group_number, 'year' => $group->year]);

                                        $titler = DB::select('SELECT documents.title FROM documents WHERE documents.documents_groups_number = :nummer 
                                        AND documents.documents_year = :year',['nummer' => $group->group_number, 'year' => $group->year]);
                                    ?>  

                                    @if($dokumenter ==! "")
                                        <tbody>
                                        <tr>
                                            <td>{{$group->group_number}}</td>
                                            <td>{{$group->year}}</td>
                                            <td>
                                                @foreach($dokumenter as $dok)
                                                    <a href="{{ asset('storage/filer/prosjektskisser/'.$dok->file_name)}}">{{$dok->file_name}}</a></br>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($titler as $titt)
                                                    {{$titt->title}}</br>
                                                @endforeach
                                            </td>
                                        </tr>
                                        </tbody>
                                    @endif
                                @endif
                            @endif
                        @endforeach
                        
                </thead>
            </table>
        </div>
    </div>
@endsection