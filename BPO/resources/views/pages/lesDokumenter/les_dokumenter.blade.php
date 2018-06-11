@extends('layouts.app')
@section('crumb')
    <div class="crumb" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin2') }} ">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dokumenter</li>
        </ol>
    </div>
@endsection
@section('content')
    <div class="container container-no-padding">
        @if($documents != "[]")
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th>Gruppe nummer</th>
                        <th>År</th>
                        <th>Fil navn</th>
                        <th>Tittel</th>
                    </tr>
                </thead>
                <tbody class="bg-light">
                    @foreach($groups as $group)
                        @if($group->year >= date('Y'))
                            @if($group->leader ==! "")
                                <?php  
                                    $student = DB::select('select student_groups.student from student_groups, groups 
                                    where groups.group_number = student_groups.student_groups_number and groups.year = student_groups_year 
                                    and student_groups.student_groups_number LIKE :number and student_groups.student_groups_year LIKE :year', 
                                    ['number' => $group->group_number, 'year' => $group->year]);

                                    $dokumenter = DB::select('SELECT * FROM documents WHERE documents.documents_groups_number = :nummer 
                                    AND documents.documents_year = :year',['nummer' => $group->group_number, 'year' => $group->year]);

                                    $titler = DB::select('SELECT documents.title FROM documents WHERE documents.documents_groups_number = :nummer 
                                    AND documents.documents_year = :year',['nummer' => $group->group_number, 'year' => $group->year]);
                                ?>  

                                @if($dokumenter ==! "")
                                    <tr>
                                        <td>{{$group->group_number}}</td>
                                        <td>{{$group->year}}</td>
                                        <td>
                                            @foreach($dokumenter as $dok)
                                                <a target='_blank' href="{{ asset('storage/filer/'.$dok->title.'/'.$dok->file_name)}}">{{$dok->file_name}}</a></br>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($titler as $titt)
                                                {{$titt->title}}</br>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endif
                            @endif
                        @endif
                    @endforeach
                </tbody>
            </table>
        @else
            {{"Ingen dokumenter er lastet opp."}}
        @endif
    </div>
@endsection