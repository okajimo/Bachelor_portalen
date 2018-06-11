@extends('layouts.app')
@section('content')
    <div class="jumbotron">
        <div class="container">
                Velg året du vil se tidligere prosjekter fra.
                <table class='table'>
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
                            else 
                            {
                                echo "Ingen tidligere prosjekter tilgjengelig.";    
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
    <div class="jumbotron">
        <div class="container">
            Tidligere prosjekter fra den gamle nettsiden. </br>

            <a href='http://www.cs.hioa.no/data/bachelorprosjekt/2017/' class='blaaLink'>2017</a><br/>
            <a href='http://www.cs.hioa.no/data/bachelorprosjekt/2016/' class='blaaLink'>2016</a><br/>
            <a href='http://www.cs.hioa.no/data/bachelorprosjekt/2015/' class='blaaLink'>2015</a><br/>
            <a href='http://www.cs.hioa.no/data/bachelorprosjekt/2014/' class='blaaLink'>2014</a><br/>
            <a href='http://www.cs.hioa.no/data/bachelorprosjekt/2013/' class='blaaLink'>2013</a><br/>
            <a href="http://www.cs.hioa.no/data/bachelorprosjekt/2012/" class="blaaLink">2012</a><br/>
            <a href="http://www.cs.hioa.no/data/bachelorprosjekt/2011/" class="blaaLink">2011</a><br/>
            <a href="http://www.cs.hioa.no/data/bachelorprosjekt/2010/" class="blaaLink">2010</a><br/>
            <a href="http://www.cs.hioa.no/data/bachelorprosjekt/2009/" class="blaaLink">2009</a><br/>
        </div>
    </div>
@endsection