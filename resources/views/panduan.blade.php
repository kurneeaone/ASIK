@extends('layout.index')
@section('title','Panduan')
@section('body')
    <div class="container py-5">
        <h5><b>Panduan</b></h5> 
        <hr>
        <p>{!!$data->panduan!!}</p>
    </div>
@endsection