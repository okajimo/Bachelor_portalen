@extends('layouts.app')
@section('content')
    <div class="jumbotron">
        <div class="container">
                Velg året du vil se tidligere prosjekter fra.
                <table class='table'>
                    <tr>
                        <td>
                            <?php
                                $file = scandir('storage/filer/tidligere_prosjekter_sluttrapport/'); 
                                foreach($file as $f)
                                {
                                   if($f !== '.' && $f !== '..')
                                   {
                                        $mounth = date('m');
                                        $dato1 = date('Y');
                                        if($f < $dato1)
                                        {
                                            ?>  {!! Form::open(['action' => 'Tidligere_prosjekterController@showTidligereProsjekter', 'method' => 'POST']) !!}  
                                                    {{Form::hidden('year', $f)}}
                                                    <div class="form-group">
                                                    </div>
                                                    {{Form::submit($f,['class'=>'btn btn-primary', 'name' => 'sub'])}}   
                                                {!! Form::close() !!}
                                            <?php
                                        }
                                        elseif($f == $dato1)
                                        {
                                            if($mounth > 07)
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