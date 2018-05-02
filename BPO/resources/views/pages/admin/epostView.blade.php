<style>
    #student{display: none;}
    #stud{display: none;}
    #sensor{display: block;}
    #sens{display: block;}
</style>
<div class="modal" id="exampleModal4" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!--Sensorer-->
                <h5 class="modal-title" id="sens"> Send epost til sensor/veileder</h5>
                <!--Studenter-->
                <h5 class="modal-title" id="stud"> Send epost til studentene</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>  
            </div>
            <div class="modal-body">
                <div class="form-group form-inline">
                    <select class="form-control" name="" id="epost">
                        <option value="" required hidden>Velg mottaker</option>
                        <!--Studenter-->
                        <option value="student">Studenter</option>
                        <!--Sensorer-->
                        <option value="sensor" >Sensor</option>
                        <!--Veildere-->
                        <option value="veileder" >Veileder</option>
                    </select>
                </div>

                <!--Sensorer-->
                {!! Form::open(['action' => 'Admin\EpostController@sendEpostSensor', 'method' => 'POST', 'id' => 'sensor']) !!} 
                    <div class="form-group form-inline">  
                        {{Form::text('tema', '',['placeholder'=>'Skriv in emne her...','class'=>'form-control', 'required', 'pattern' => '[A-Za-z0-9 øæåØÆÅ.!:-]*', 'title' => 'Emne må være av bokser, tall, punktum, utropstegn, kolonn eller bindestrek'])}}
                    </div>
                    <div class="form-group form-inline">  
                        {{Form::textarea('melding', '',['placeholder'=>'Skriv in melding her...','class'=>'form-control', 'required', 'pattern' => '[A-Za-z0-9 øæåØÆÅ.!:-]*', 'title' => 'Emne må være av bokser, tall, punktum, utropstegn, kolonn eller bindestrek'])}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        {{Form::submit('Send epost', ['class'=>'btn btn-info'])}}
                    </div>
                {!! Form::close() !!}

                <!--Veildere-->
                {!! Form::open(['action' => 'Admin\EpostController@sendEpostVeileder', 'method' => 'POST', 'id' => 'veileder']) !!} 
                    <div class="form-group form-inline">  
                        {{Form::text('tema', '',['placeholder'=>'Skriv in emne her...','class'=>'form-control', 'required', 'pattern' => '[A-Za-z0-9 øæåØÆÅ.!:-]*', 'title' => 'Emne må være av bokser, tall, punktum, utropstegn, kolonn eller bindestrek'])}}
                    </div>
                    <div class="form-group form-inline">  
                        {{Form::textarea('melding', '',['placeholder'=>'Skriv in melding her...','class'=>'form-control', 'required', 'pattern' => '[A-Za-z0-9 øæåØÆÅ.!:-]*', 'title' => 'Emne må være av bokser, tall, punktum, utropstegn, kolonn eller bindestrek'])}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        {{Form::submit('Send epost', ['class'=>'btn btn-info'])}}
                    </div>
                {!! Form::close() !!}

                <!--studenter-->
                {!! Form::open(['action' => 'Admin\EpostController@sendEpostAlleStud', 'method' => 'POST', 'id' => 'student']) !!}  
                    <div class="form-group form-inline">  
                        {{Form::text('tema', '',['placeholder'=>'Skriv in emne her...','class'=>'form-control'])}}
                    </div>
                    <div class="form-group form-inline">  
                        {{Form::textarea('melding', '',['placeholder'=>'Skriv in melding her...','class'=>'form-control'])}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        {{Form::submit('Send epost', ['class'=>'btn btn-info'])}}  
                    </div>  
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        $('#epost').on('change', function() {
            var value = $(this).val();
            if (value == 'student'){
                $('#sensor').fadeOut(0);
                $('#student').fadeIn(0);
                $('#sens').fadeOut(0);
                $('#stud').fadeIn(0);
            }
            if (value == 'sensor'){
                $('#student').fadeOut(0);
                $('#sensor').fadeIn(0);
                $('#stud').fadeOut(0);
                $('#sens').fadeIn(0);
            }
        });   
    });
</script>