@extends('layouts.app')
@section('content')
    <div class="jumbotron" style="padding:0 !important; margin:0;">
        <div class="container" style="padding:0; margin:0;">
            <div class="table-responsive">
                <table class="table ">
                    <thead class="thead-light">
                        <tr>
                            <th>Gruppe</th><th>Medlemmer</th><th>Navn</th><th>Sett Veileder og Slett gruppe</th>
                        </tr>
                    </thead>      
                    @foreach($group as $groups)
                        @if($groups->leader != "")
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
                                        {!! Form::open(['action' => 'VeilederController@store', 'method' => 'POST', 'class' => 'float-left']) !!}  
                                            
                                            <select name="supervisor" style="width: 8.5em; border: 1px solid black;" class="btn">
                                                    @foreach($supervisors as $supervisor)
                                                        @if($groups->supervisor == $supervisor->email)
                                                            <option value={{$groups->supervisor}}  selected="">{{$supervisor->firstname.''.$supervisor->lastname}}</option>
                                                        @else
                                                            <option value={{$supervisor->email}}>{{$supervisor->firstname.' '.$supervisor->lastname}}</option>
                                                        @endif
                                                    @endforeach
                                            </select>
                                            {{Form::hidden('group', $groups->group_number)}}
                                            {{Form::submit('Sett Veileder', ['class'=>'btn btn-success margin-fix'])}}   
                                        {!! Form::close() !!}

                                        {!! Form::open(['action' => ['VeilederController@destroy', $groups->group_number], 'method' => 'POST', 'class' => 'float-left', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                            {{Form::hidden('_method', 'DELETE')}} 
                                            {{Form::submit('Slett Gruppe', ['class'=>'btn btn-danger'])}}   
                                        {!! Form::close() !!} 
                                    </td>
                                </tr>
                            </tbody>
                        @endif
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection