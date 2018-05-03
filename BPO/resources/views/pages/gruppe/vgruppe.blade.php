@extends('layouts.app')
@section('content')
    <div class="container">
        <?php
            $studentIGruppe = session('navn');
            $bruker = session('navn');
            $iGruppe = DB::select('SELECT student_groups.student FROM student_groups WHERE student_groups.student = :iGruppe', ['iGruppe' => $studentIGruppe]);
        ?>
        @if($iGruppe == null)
        <div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
            {!! Form::open(['action' => 'GruppeController@lag_gruppe', 'method' => 'POST'])!!}
                {{Form::submit('Registrer gruppe', ['class'=>'btn btn-success'])}}
            {!! Form::close() !!}
        </div>
        
        @endif
        <?php 
            $brukerS = DB::select('SELECT student_groups.student FROM student_groups WHERE student_groups.student LIKE :bruker',['bruker' => $bruker]);
        ?>
        @foreach($brukerS as $brukerF)
            @if($brukerF->student == $bruker)
            <?php $break = 0; ?>
            @foreach($groups as $group2)

                @if($bruker == $group2->leader)
                    <?php $break = 1; ?>
                @endif

            @endforeach

            @if($break == 0)
            <div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
                {!! Form::open(['action' => 'GruppeController@sett_leder', 'method' => 'POST'])!!}
                    {{form::hidden('_method', 'PUT')}}
                    {{Form::submit('Sett leder', ['class'=>'btn btn-primary'])}}
                {!! Form::close() !!}
            </div>
            @endif

            @endif
        @endforeach

        @if($iGruppe ==! null)
            <div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
                {!! Form::open(['action' => 'GruppeController@fjern_student', 'method' => 'POST'])!!}
                {{form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Forlat gruppe', ['class'=>'btn btn-danger'])}}
                {!! Form::close() !!}
            </div>

            <?php $leder = DB::select('SELECT * FROM groups WHERE groups.leader = :stud',['stud'=>$studentIGruppe]); ?>
            @foreach($leder as $tt)
                @if($tt->leader == $studentIGruppe && $tt->searching == "no")
                    <div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
                        {!! Form::open(['action' => 'GruppeController@sokMedlemmer', 'method' => 'POST'])!!}
                        {{form::hidden('_method', 'POST')}}
                            {{Form::submit('Søk medlemmer', ['class'=>'btn btn-primary'])}}
                        {!! Form::close() !!}
                    </div>
                @else
                    <div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
                        {!! Form::open(['action' => 'GruppeController@stoppSokMedlemmer', 'method' => 'POST'])!!}
                        {{form::hidden('_method', 'POST')}}
                            {{Form::submit('Slutt medlem søk', ['class'=>'btn btn-danger'])}}
                        {!! Form::close() !!}
                    </div>
                @endif
            @endforeach
        @endif
        
        <table class="table">
            <div class="table-responsive">
                <thead class="thead-light">
                    <tr>
                        <th>Gruppe</th>
                        <th>Prosjektside</th>
                        <th>Studenter</th>
                        <th>Veileder</th>
                        @if($iGruppe == null)
                        <th>Meld deg inn</th>
                        @endif
                    </tr>
                </thead>
                    @foreach ($groups as $group)
                        @if($group->leader ==! "")
                            <?php $date = date('Y'); ?>
                            @if($group->year >= date('Y'))
                            <tbody class="bg-light">
                            <tr>
                                <td>
                                    {{ $group->group_number }}
                                    </br>
                                    </br>
                                    @if($group->searching == "yes")
                                        <a style="color:green">Søker medlemmer</a>
                                    @endif
                                </td>
                                <td><a href="{{ $group->url }}" target='_blank'>{{ $group->title }}</a></td>
                                <td>
                                    <?php /*$student = DB::select('select student_groups.student from student_groups, groups 
                                    where groups.group_number = student_groups.student_groups_number and groups.year = student_groups_year 
                                    and student_groups.student_groups_number LIKE :number and student_groups.student_groups_year LIKE :year', 
                                    ['number' => $group->group_number, 'year' => $group->year]);*/
                                    
                                    /*$leader = DB::SELECT('SELECT groups.leader FROM student, student_groups, groups WHERE student.username = student_groups.student 
                                    AND student_groups.student_groups_number = groups.group_number 
                                    AND student_groups.student_groups_year = groups.year AND student.username = groups.leader');*/

                                    $leader = \DBHelper::lederGruppe();
                                    $student = \DBHelper::studIGruppe($group->group_number, $group->year);
                                    ?>
                                    @foreach($student as $students)
                                        @if($students->student == $group->leader)
                                            <u>{{$students->student}}</u></br>
                                        @else
                                            {{$students->student}}</br>
                                        @endif
                                    @endforeach
                                </td>
                                <td >
                                    <?php 
                                        $veileder = DB::select('select firstname, lastname from sensors_supervisors where email = :email',['email'=>$group->supervisor]);
                                    ?>
                                    @foreach($veileder as $vei)
                                        {{$vei->firstname." ".$vei->lastname}}
                                    @endforeach
                                </td>
                                    @if($iGruppe == null)
                                        <td style=" text-align: center;">
                                            {!! Form::open(['action' => 'GruppeController@meld_inn', 'method' => 'POST'])!!}
                                                {{Form::hidden('number', $group->group_number)}}
                                                {{Form::hidden('year', $group->year)}}
                                                {{form::hidden('_method', 'post')}}
                                                {{Form::submit('Bli med',['class'=>'btn btn-success btn-nice', 'name' => 'meld'])}}
                                            {!! Form::close() !!}
                                        </td>
                                    @endif
                                </tr> 
                            </tbody>
                        @endif
                    @endif
                @endforeach  
            </div>
        </table>
    </div>
@endsection