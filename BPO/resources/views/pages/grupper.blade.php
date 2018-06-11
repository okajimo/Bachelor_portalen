@extends('layouts.app')
@section('content')
    <div class="container container-no-padding">
            <table class="table">
                <div class="table-responsive">
                    <thead class="thead-light">
                        <tr>
                            <th>Gruppe</th>
                            <th>Prosjektside</th>
                            <th>Studenter</th>
                            <th>Veileder</th>
                        </tr>
                    </thead>
                    <tbody class="bg-light">
                        @foreach ($groups as $group)
                            @if($group->leader != "")
                                <tr>
                                    <td>{{ $group->group_number }}</td>
                                    <td><a target='_blank' href="{{ $group->url }}">{{ $group->title }}</a></td>
                                    <td>
                                        <?php
                                            $members = DB::select('SELECT users.firstname, users.lastname, users.username, student.program 
                                            FROM users, groups, student_groups, student
                                            WHERE groups.group_number = student_groups.student_groups_number AND groups.year = student_groups.student_groups_year AND 
                                            student_groups.student = users.username AND student_groups.student = student.username AND groups.group_number 
                                            LIKE :group_number', ['group_number' => $group->group_number]);
                                        ?>
                                        @foreach ($members as $member)
                                            @if ($member->username == $group->leader)
                                                <u>{{ $member->firstname.' '.$member->lastname.' ('.$member->program.')'}}</br></u>
                                            @else
                                                {{ $member->firstname.' '.$member->lastname.' ('.$member->program.')'}}</br>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <?php 
                                            $veileder = DB::select('select firstname, lastname from sensors_supervisors where email = :email',['email'=>$group->supervisor]);
                                        ?>
                                        @foreach($veileder as $vei)
                                            {{$vei->firstname." ".$vei->lastname}}
                                        @endforeach
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </div>
                <tbody>
            </table> 
    </div>
@endsection