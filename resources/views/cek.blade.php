@extends('layout.index')
@section('title','Cek Data')
@section('head')
<style>
    div.data {
        overflow:auto;
    }
</style>
@endsection
@section('body')
<div class="container my-3">
    <h5 class="text-dark">Data Siswa Yang Sudah Melihat Nilai</h5>
    <hr>
    <div class="data">
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Nama Siswa</th>
                <th>No. Ujian</th>
                <th>Tanggal Lahir</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $d)
                <tr>
                    <td>{{$loop->iteration}}</td> 
                    <td>{{$d->nama_siswa}}</td>
                    <td>{{$d->no_ujian}}</td>
                    <td>{{date('d / F / Y',strtotime($d->tgl_lahir))}}</td>
                    <td>{{$d->ket}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
@endsection