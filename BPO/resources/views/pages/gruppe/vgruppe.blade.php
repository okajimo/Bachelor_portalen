@extends('layouts.app')
@section('content')
    <div class="jumbotron">
        <div class="container">
            {!! Form::open(['action' => 'GruppeController@lag_gruppe', 'method' => 'POST'])!!}
                {{Form::submit('Registrer gruppe', ['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        </br>
            {!! Form::open(['action' => 'GruppeController@sett_leder', 'method' => 'POST'])!!}
                {{form::hidden('_method', 'PUT')}}
                {{Form::submit('Sett leder', ['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
            </br>
            <table class="table">
                    <tr style="border: solid;">
                        <th>Gruppe</th>
                        <th>Prosjektside</th>
                        <th>Studenter</th>
                        <th>E-postadresse</th>
                        <th>Veileder</th>
                    </tr>
                        @foreach ($groups as $group)
                        <?php $date = date('Y'); ?>
                        @if($group->year >= date('Y'))
                            <tr>
<!-- Lagt til av stian, Ivo fiks css -->   <td style="border-bottom: thin #cc3300 solid; border-right: thin #cc3300 solid; border-left: thin #cc3300 solid;">{{ $group->group_number }}</td>
<!-- Lagt til av stian, Ivo fiks css -->   <td style="border-bottom: thin #cc3300 solid; border-right: thin #cc3300 solid;"><a href="http://{{ $group->url }}" >{{ $group->title }}</a></td>
<!-- Lagt til av stian, Ivo fiks css -->   <td style="border-bottom: thin #cc3300 solid; border-right: thin #cc3300 solid;">

                                    <?php $student = DB::select('select student_groups.student from student_groups, groups 
                                    where groups.group_number = student_groups.student_groups_number and groups.year = student_groups_year 
                                    and student_groups.student_groups_number LIKE :number and student_groups.student_groups_year LIKE :year', 
                                    ['number' => $group->group_number, 'year' => $group->year]); ?>
                                    @foreach($student as $students)
                                        
                                        {{$students->student}} </br>

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
                        @endforeach    
                </table>

        </div>
    </div>
@endsection