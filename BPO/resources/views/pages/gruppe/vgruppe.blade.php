@extends('layouts.app')
@section('content')
    <div class="jumbotron">
        <div class="container">
            <?php
                $studentIGruppe = session('navn');
                $bruker = session('navn');
                $iGruppe = DB::select('SELECT student_groups.student FROM student_groups WHERE student_groups.student = :iGruppe', ['iGruppe' => $studentIGruppe]);
            ?>
            @if($iGruppe == null)
                {!! Form::open(['action' => 'GruppeController@lag_gruppe', 'method' => 'POST'])!!}
                    {{Form::submit('Registrer gruppe', ['class'=>'btn btn-primary'])}}
                {!! Form::close() !!}
            </br>
            @endif
            <?php 
                $brukerS = DB::select('SELECT student_groups.student FROM student_groups WHERE student_groups.student LIKE :bruker',['bruker' => $bruker]);
            ?>
            @foreach($brukerS as $brukerF)
                @if($brukerF->student == $bruker)
                <?php $break = 0; ?>
                @foreach($groups as $group2)

                    @if($bruker == $group2->leader)
                        Du er allerede leder!
                        <?php $break = 1; ?>
                    @endif

                @endforeach

                @if($break == 0)
                    {!! Form::open(['action' => 'GruppeController@sett_leder', 'method' => 'POST'])!!}
                        {{form::hidden('_method', 'PUT')}}
                        {{Form::submit('Sett leder', ['class'=>'btn btn-primary'])}}
                    {!! Form::close() !!}
                    </br>
                @endif

            @endif
            @endforeach
            @if($iGruppe ==! null)
                {!! Form::open(['action' => 'GruppeController@fjern_student', 'method' => 'POST'])!!}
                {{form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Forlat gruppe', ['class'=>'btn btn-danger'])}}
                {!! Form::close() !!}
                </br>
                @endif
            <table class="table">
                    <tr style="border: solid;">
                        <th>Gruppe</th>
                        <th>Prosjektside</th>
                        <th>Studenter</th>
                        <th>E-postadresse</th>
                        <th>Veileder</th>
                    </tr>
                        @foreach ($groups as $group)
                        @if($group->leader ==! "")
                            <?php $date = date('Y'); ?>
                            @if($group->year >= date('Y'))
                                <tr>
    <!-- Lagt til av stian, Ivo fiks css -->   <td style="border-bottom: thin #cc3300 solid; border-right: thin #cc3300 solid; border-left: thin #cc3300 solid;">{{ $group->group_number }}</td>
    <!-- Lagt til av stian, Ivo fiks css -->   <td style="border-bottom: thin #cc3300 solid; border-right: thin #cc3300 solid;"><a href="http://{{ $group->url }}" >{{ $group->title }}</a></td>
    <!-- Lagt til av stian, Ivo fiks css -->   <td style="border-bottom: thin #cc3300 solid; border-right: thin #cc3300 solid;">

                                        <?php $student = DB::select('select student_groups.student from student_groups, groups 
                                        where groups.group_number = student_groups.student_groups_number and groups.year = student_groups_year 
                                        and student_groups.student_groups_number LIKE :number and student_groups.student_groups_year LIKE :year', 
                                        ['number' => $group->group_number, 'year' => $group->year]);
                                        
                                        $leader = DB::SELECT('SELECT groups.leader FROM student, student_groups, groups WHERE student.username = student_groups.student 
                                        AND student_groups.student_groups_number = groups.group_number 
                                        AND student_groups.student_groups_year = groups.year AND student.username = groups.leader');
                                        ?>
                                        @foreach($student as $students)
                                            @if($students->student == $group->leader)
                                                <u>{{$students->student}}</u></br>
                                            @else
                                                {{$students->student}}</br>
                                            @endif
                                        @endforeach
                                    </td>
    <!-- Lagt til av stian, Ivo fiks css -->   <td style="border-bottom: thin #cc3300 solid; border-right: thin #cc3300 solid;">
                                        <?php $email = DB::select('select users.email from users, student, student_groups, groups where users.username = student.username 
                                        and student.username = student_groups.student and student_groups.student_groups_number = groups.group_number 
                                        AND student_groups.student_groups_year = groups.year AND student_groups.student_groups_number LIKE :number 
                                        and student_groups.student_groups_year LIKE :year',['number' => $group->group_number, 'year' => $group->year]); ?>
                                        @foreach($email as $emails)
                                            
                                            {{$emails->email}} </br>

                                        @endforeach
                                    </td>
    <!-- Lagt til av stian, Ivo fiks css -->   <td style="border-bottom: thin #cc3300 solid; border-right: thin #cc3300 solid;">{{ $group->supervisor }}</td>
                                </tr> 
                            @endif
                        
                        @endif
                        @endforeach    
                </table>
        </div>
    </div>
@endsection