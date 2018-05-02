{!! Form::open(['action' => 'SimulerController@simuler', 'method' => 'POST']) !!}
    <div class="row">
        <div class="col-8 col-sm-7 col-md-6 col-lg-5 col-xl-4 margin-fix no-padding-right">
            <input pattern="[s]{1}[0-9]{6}" title="må skrives på dette formatet s000000" class="form-control"placeholder="Simuler student" type="search" name="student" list="students" required>
            <datalist id="students">
                @foreach($student as $students)
                    <option required value={{$students->username}}>{{$students->firstname.' '.$students->lastname}}</option>
                @endforeach
            </datalist>
        </div>
        {{Form::hidden('inn_navn',session('navn'))}}
        {{Form::hidden('inn_level',session('level'))}}
        <div >
            <button class="btn btn-success"><i style="font-size:1.4em;"class="fas fa-power-off"></i></button>
        </div>
    </div>
{!! Form::close() !!}