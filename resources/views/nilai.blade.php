@extends('layout.index')
@section('title','Nilai')
@section('head')
<style>
    div.data {
        overflow:auto;
    }
</style>
@endsection
@section('body')
<div class="container text-dark py-3">
    <h3>Data Nilai</h3>
    <div class="form-row">
        <a href="{{url('/nilai/delete-all')}}" class="ml-auto btn btn-danger" onclick="return confirm('Apakah Anda Yakin?')">Delete All</a>
        <button type="button" class="ml-2 btn btn-primary" data-target="#addModal" data-toggle="modal">Add</button>
        <button type="button" class="mx-2 btn btn-primary" data-target="#importModal" data-toggle="modal">Import</button>
    </div>
    <div class="data py-2">
        <table class="table table-hover table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" class="align-middle">#</th>
                    <th scope="col" class="align-middle">Nama</th>
                    <th scope="col" class="align-middle">No. Ujian</th>
                    <th scope="col" class="align-middle">Kelas & Jurusan</th>
                    <th scope="col" class="align-middle">Mapel</th>
                    <th scope="col" class="align-middle">Nilai Sekolah</th>
                    <th scope="col" class="align-middle">Nilai UN</th>
                    <th scope="col" class="align-middle">Nilai Akhir</th>
                    <th scope="col" class="align-middle">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $d)
                <tr data-toggle="modal" data-target="#dataS{{$d->id_nilai}}">
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$d->nama_siswa}}</td>
                    <td>{{$d->no_ujian}}</td>
                    <td>{{$d->kelas}} - {{$d->jurusan}}</td>
                    <td>{{$d->nama_mapel}}</td>
                    <td>{{$d->nilai_sekolah}}</td>
                    <td>{{$d->nilai_un}}</td>
                    <td>{{$d->nilai_akhir}}</td>
                    <td>{{$d->ket}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if(count($data) <= 0)
        <div class="text-center text-muted"><i>Tidak ada Data</i></div>
        @endif
    </div>
</div>
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="{{url('/nilai/add')}}" method="post">
          @csrf
          <div class="form-group">
              <label for="">Siswa</label>
              <select name="no_ujian" id="" class="custom-select">
                  @foreach($siswa as $s)
                    <option value="{{$s->no_ujian}}">{{$s->nama_siswa}}</option>
                  @endforeach
              </select>
          </div>
          <div class="form-group">
              <label for="">Mapel</label>
              <input type="text" name="mapel" class="form-control">
          </div>
          <div class="form-group">
              <label for="">Nilai Sekolah</label>
              <input type="number" name="ns" class="form-control" max="100">
          </div>
          <div class="form-group">
              <label for="">Nilai UN</label>
              <input type="number" name="nun" class="form-control" max="100">
          </div>
          <div class="form-group">
              <label for="">Nilai Akhir</label>
              <input type="number" name="na" class="form-control" max="100">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="{{url('/nilai/import')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="">Excel</label><br>
                <input type="file" name="file" class="">
            </div>
        </div>
        <div class="modal-footer">
            <a href="{{asset('data-file/excel/format_nilai.csv')}}" class="btn btn-warning mr-auto">Format FIle</a>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Import</button>
        </form>
      </div>
    </div>
  </div>
</div>
@foreach($data as $d)
<div class="modal fade" id="dataS{{$d->id_nilai}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{$d->nama_mapel.' - '.$d->nama_siswa}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <a href="{{url('/nilai/delete/'.$d->id_nilai)}}" class="btn btn-danger">Delete</a>
        <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#editDataS{{$d->id_nilai}}">Edit</a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endforeach
@foreach($data as $d)
<div class="modal fade" id="editDataS{{$d->id_nilai}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit {{$d->nama_siswa}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="{{url('/nilai/edit')}}" method="post">
          @csrf
          <div class="form-group">
              <label for="">No. Ujian</label>
              <input type="text" name="no_ujian" class="form-control" value="{{$d->no_ujian}}" placeholder="{{$d->no_ujian}}" disabled>
          </div>
          <div class="form-group">
              <label for="">Mapel</label>
              <input type="text" name="mapel" class="form-control" value="{{$d->nama_mapel}}" placeholder="{{$d->nama_mapel}}">
          </div>
          <div class="form-row">
              <div class="col">
                <label for="">Nilai Sekolah</label>
                <input type="number" name="ns" max="100" class="form-control" value="{{$d->nilai_sekolah}}">
              </div>
              <div class="col">
                <label for="">Nilai UN</label>
                <input type="number" name="nun" max="100" class="form-control" value="{{$d->nilai_un}}">
              </div>
              <div class="col">
                <label for="">Nilai Akhir</label>
                <input type="number" name="na" max="100" class="form-control" value="{{$d->nilai_akhir}}">
              </div>
          </div>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="id" value="{{$d->id_nilai}}">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach
@endsection