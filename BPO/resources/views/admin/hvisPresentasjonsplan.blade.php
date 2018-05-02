@extends('layouts.app')
@section('content')
    <div class="container container-no-padding">
        <?php $finnes3 = Storage::exists('/public/filer/presentasjonsplan/true.txt'); ?>
        @if($finnes3 == true)
            <?php 
                $fileHandle = fopen('storage/filer/presentasjonsplan/true.txt' , "r");
                $hvis =  fread($fileHandle,filesize("storage/filer/presentasjonsplan/true.txt"));
                fclose($fileHandle);
                echo $hvis;
            ?>
        @endif
    </div>
@endsection

