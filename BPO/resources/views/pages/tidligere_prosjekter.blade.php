@extends('layouts.app')
@section('content')
    <div class="jumbotron">
        <div class="container">
                Velg året du vil se tidligere prosjekter fra.
                <table class='table'>
                    <tr>
                        <td>
                            <?php
                                $ffs = scandir('storage/filer/tidligere_prosjekter_sluttrapport/'); 
                                foreach($ffs as $f)
                                {
                                   if($f !== '.' && $f !== '..')
                                   {
                                       ?>  {!! Form::open(['action' => 'Tidligere_prosjekterController@showTidligereProsjekter', 'method' => 'POST']) !!}  
                                               {{Form::hidden('year', $f)}}
                                               <div class="form-group">
                                                </div>
                                               {{Form::submit($f,['class'=>'btn btn-primary', 'name' => 'sub'])}}   
                                           {!! Form::close() !!}
                                       <?php
                                   }
                                }
                           ?>
                        </td>
                        <td>
                            <?php echo Session::get('hvis') ?>
                        </td>
                    </tr>
                </table>
        </div>
    </div>
@endsection