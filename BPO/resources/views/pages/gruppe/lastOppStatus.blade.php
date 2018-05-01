@extends('layouts.app')
@section('content')
    <div class="jumbotron">
        <div class="container">
            {!! Form::open(['action' => 'OpplastningController@lastOppDok', 'method' => 'POST', 'files' => true]) !!}   
                {{Form::hidden('type', 'statusrapporter')}}
                {{Form::label('dok', 'Velg fil for opplastning. Kun PDF godkjent.')}}    
                <div class="form-group form-inline">   
                    {{Form::file('dok')}}
                </div>
                {{Form::submit('Last opp', ['class'=>'btn btn-primary'])}}    
            {!! Form::close() !!}
        </div>
        <div>
        </br>
            <?php 
                $student = session('navn');
                $group = DB::select('SELECT groups.group_number, groups.year FROM student_groups, groups WHERE groups.group_number = student_groups.student_groups_number AND 
                groups.year = student_groups.student_groups_year AND student_groups.student LIKE :student', ['student' => $student]);
                $documents = DB::select('SELECT * FROM documents WHERE documents_groups_number LIKE :groupNumber AND documents_year LIKE :year AND title LIKE :type', 
                ['groupNumber' => $group[0]->group_number, 'year' => $group[0]->year, 'type' => 'statusrapporter']);
            ?>
            @if ($documents)
                <table class="table table-responsive">
                    <tr>
                        <td>Dokument</td>
                        <td>Type</td>
                    </tr>
                    @foreach ($documents as $doc)
                        <tr>
                            <td><a href="{{ asset('storage/filer/statusrapporter/'.$doc->file_name)}}"target='_blank'>{{ $doc->file_name}}</a></td>
                            <td>Statusrapport</td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
    </div>
@endsection