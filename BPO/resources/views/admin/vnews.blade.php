@extends('layouts.app')
@section('content')
    <div class="container container-no-padding">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success margin-fix-bottom" data-toggle="modal" data-target="#exampleModal">
            <i style="font-size: 1.3em" class="fas fa-plus-circle"></i> 
            <span style="padding-left:0.3em; font-size: 1.3em; font-weight: bold; font-family: Helvetica, Arial, sans-serif">Lag nyhet</span>
        </button>

        <a href="{{asset('news')}} " class="btn btn-info margin-fix-bottom">
            <span style="padding-left:0.3em; font-size: 1.3em; font-weight: bold; font-family: Helvetica, Arial, sans-serif">Vis Nyheter</span>
        </a>

        <br><br><h4>Nyheter vil automatisk bli visst på nyhetsiden</h4><br>
        <table class="table">
            <div class="table-responsive">
                <thead class="thead-light">
                    <tr>
                        <th>Bruker</th>
                        <th>Tittel</th>
                        <th>Melding</th>
                        <th><div class="float-right" style="margin-right: 3.6em">Slett</div></th>
                    </tr>
                </thead>
                <tbody class="bg-light">
                    @foreach($nyheter as $nyh)
                    <tr>
                        <td>{{$nyh->user}}</td>
                        <td>{{$nyh->tittel}}</td>
                        <td><?php echo $nyh->melding ?></td>
                        <td>
                            {!! Form::open(['action' => 'Admin\AdminController@slettNyhet', 'method' => 'POST','onsubmit' => 'return ConfirmDelete()']) !!}  
                                    {{Form::hidden('id',$nyh->id)}}
                                {{Form::submit('Slett post', ['class'=>'btn btn-danger float-right'])}}    
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </div>
        </table>
    </div>
      
      <!-- Modal -->
      <div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Skriv Nyhet</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['action' => 'Admin\AdminController@lagNyhet', 'method' => 'POST']) !!}  
                    <div class="form-group form-inline">  
                        {{Form::text('tittel', '',['placeholder'=>'Skriv in tittel her...','class'=>'form-control', 'maxlength' => '45','pattern' => '[A-Za-z0-9 ÅØÆåøæ!?.:]*', 'required'])}}
                    </div>
                    <div class="form-group form-inline">  
                        {{Form::textarea('melding', '',['id' => 'article-ckeditor', 'class'=>'form-control', 'required'])}}
                    </div>
                    <div class="modal-footer">
                        {{Form::submit('Lag nyhet', ['class'=>'btn btn-success'])}} 
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>  
                {!! Form::close() !!} 
            </div>
          </div>
        </div>
      </div>

@endsection
@section('extra')
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
@endsection
