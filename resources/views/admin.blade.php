@extends('layout.index')
@section('title','Admin')
@section('body')
<div class="container py-3">
    <h5>Welcome, {{strtoupper(auth()->user()->name)}}</h5>
    <hr>
    <p>Admin Dashboard</p>
</div>
@endsection