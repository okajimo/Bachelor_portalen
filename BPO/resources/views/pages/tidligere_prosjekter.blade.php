@extends('layouts.app')
@section('content')
    <div class="jumbotron">
        <div class="container">
        <h3>Velg året du vil se tidligere prosjekter fra.</h3>
            <table>
                <tr>
                    <td>
                        <?php
                        $rapport = Storage::exists('/public/filer/tidligere_prosjekter_sluttrapport');
                        if($rapport)
                        {
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
                        }
                        ?>
                    </td>
                    <td>
                        <?php echo Session::get('hvis') ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href='http://www.cs.hioa.no/data/bachelorprosjekt/2017/' class='blaaLink'><b>2017</b></a><br/>
                        <a href='http://www.cs.hioa.no/data/bachelorprosjekt/2016/' class='blaaLink'><b>2016</b></a><br/>
                        <a href='http://www.cs.hioa.no/data/bachelorprosjekt/2015/' class='blaaLink'><b>2015</b></a><br/>
                        <a href='http://www.cs.hioa.no/data/bachelorprosjekt/2014/' class='blaaLink'><b>2014</b></a><br/>
                        <a href='http://www.cs.hioa.no/data/bachelorprosjekt/2013/' class='blaaLink'><b>2013</b></a><br/>
                        <a href="http://www.cs.hioa.no/data/bachelorprosjekt/2012/" class='blaaLink'><b>2012</b></a><br/>
                        <a href="http://www.cs.hioa.no/data/bachelorprosjekt/2011/" class='blaaLink'><b>2011</b></a><br/>
                        <a href="http://www.cs.hioa.no/data/bachelorprosjekt/2010/" class='blaaLink'><b>2010</b></a><br/>
                        <a href="http://www.cs.hioa.no/data/bachelorprosjekt/2009/" class='blaaLink'><b>2009</b></a><br/>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection