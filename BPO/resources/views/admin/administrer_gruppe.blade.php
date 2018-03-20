<?php use App\Http\Controllers\VeilederController; ?>
@extends('layouts.app')
@section('content')
    <table class="table table-responsive">
        <thead class="thead-light">
            <tr>
                <th>Gruppe</th>
                <th>Medlemmer</th>
                <th>Navn</th>
                <th>Veileder</th>
                <th>Slett Gruppe</th>
            </tr>
        </thead>      
        @foreach($group as $groups)
            <tbody>
                <tr>
                    <th scope="row">{{$groups->group_number}} </th>
                    <td>
                        @foreach($student as $students)
                            @if($groups->group_number == $students->student_groups_number)
                                {{$students->student}}<br>
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach($user as $users)
                            @foreach($student as $students)
                                @if($users->username == $students->student && $groups->group_number == $students->student_groups_number)
                                    {{$users->firstname.' '.$users->lastname}}<br>
                                @endif
                            @endforeach
                        @endforeach
                    </td>
                    <td>
                        {!! Form::open(['action' => 'VeilederController@store', 'method' => 'POST']) !!}  
                            <select name="supervisor" style="width: 10em;" class="btn">
                                <option value={{$groups->supervisor}}  selected="">{{$groups->supervisor}}</option>
                                @foreach($supervisors as $supervisor)
                                    @if($supervisor->firstname != $groups->supervisor)
                                        <option value={{$supervisor->firstname}}>{{$supervisor->firstname.' '.$supervisor->lastname}}</option>
                                    @endif
                                @endforeach
                            </select>
                            {{Form::hidden('group', $groups->group_number)}} 
                            {{Form::submit('Sett Veileder', ['class'=>'btn btn-primary '])}}   
                        {!! Form::close() !!}
                        
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
            </tbody>
        @endforeach
    </table>
@endsection