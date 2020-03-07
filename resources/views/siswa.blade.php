@extends('layout.index')
@section('title','Siswa')
@section('head')
<style>
    div.data {
        overflow:auto;
    }
</style>
@endsection
@section('body')
<div class="container text-dark py-3">
    <h3>Data Siswa</h3>
    <div class="form-row">
        <a href="{{url('/siswa/delete-all')}}" class="ml-auto btn btn-danger" onclick="return confirm('Apakah Anda Yakin?')">Delete All</a>
        <button type="button" class="ml-2 btn btn-primary" data-target="#addModal" data-toggle="modal">Add</button>
        <button type="button" class="mx-2 btn btn-primary" data-target="#importModal" data-toggle="modal">Import</button>
    </div>
    <div class="data py-2">
        <table class="table table-hover table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" class="align-middle">#</th>
                    <th scope="col" class="align-middle">Nama</th>
                    <th scope="col" class="align-middle">No. Ujian</th>
                    <th scope="col" class="align-middle">Kelas & Jurusan</th>
                    <th scope="col" class="align-middle">Tanggal Lahir</th>
                    <th scope="col" class="align-middle">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $d)
                <tr data-toggle="modal" data-target="#dataS{{$d->id_siswa}}">
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$d->nama_siswa}}</td>
                    <td>{{$d->no_ujian}}</td>
                    <td>{{$d->kelas}} - {{$d->jurusan}}</td>
                    <td>{{date('d / F / Y',strtotime($d->tgl_lahir))}}</td>
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
          <form action="{{url('/siswa/add')}}" method="post">
          @csrf
          <div class="form-group">
              <label for="">No. Ujian</label>
              <input type="text" name="no_ujian" class="form-control" placeholder="K3180700xx">
          </div>
          <div class="form-group">
              <label for="">Nama</label>
              <input type="text" name="nama" class="form-control">
          </div>
          <div class="form-group">
              <label for="">Kelas</label>
              <select name="kelas" class="custom-select">
                  <option value="X">X</option>
                  <option value="XI">XI</option>
                  <option value="XII">XII</option>
              </select>
          </div>
          <div class="form-group">
              <label for="">Jurusan</label>
              <input type="text" name="jurusan" class="form-control">
          </div>
          <div class="form-group">
              <label for="">Tanggal Lahir</label>
              <input type="date" name="tgl_lahir" class="form-control">
          </div>
          <div class="form-group">
              <label for="">Keterangan</label>
              <input type="text" name="ket" class="form-control">
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
          <form action="{{url('/siswa/import')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="">Excel</label><br>
                <input type="file" name="file" class="">
            </div>
        </div>
        <div class="modal-footer">
            <a href="{{asset('data-file/excel/format_siswa.csv')}}" class="btn btn-warning mr-auto">Format FIle</a>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Import</button>
        </form>
      </div>
    </div>
  </div>
</div>
@foreach($data as $d)
<div class="modal fade" id="dataS{{$d->id_siswa}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{$d->nama_siswa}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <a href="{{url('/siswa/delete/'.$d->id_siswa)}}" class="btn btn-danger">Delete</a>
        <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#editDataS{{$d->id_siswa}}">Edit</a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endforeach
@foreach($data as $d)
<div class="modal fade" id="editDataS{{$d->id_siswa}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit {{$d->nama_siswa}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="{{url('/siswa/edit')}}" method="post">
          @csrf
          <div class="form-group">
              <label for="">No. Ujian</label>
              <input type="text" name="no_ujian" class="form-control" value="{{$d->no_ujian}}" placeholder="{{$d->no_ujian}}">
          </div>
          <div class="form-group">
              <label for="">Nama</label>
              <input type="text" name="nama" class="form-control" value="{{$d->nama_siswa}}" placeholder="{{$d->nama_siswa}}">
          </div>
          <div class="form-row">
              <div class="col">
                  <label for="">Kelas</label>
                  <select name="kelas" class="custom-select">
                      <option value="X"
                      @if($d->kelas == 'X')
                      selected
                      @elseif($d->kelas == 'XI')
                      selected
                      @elseif($d->kelas == 'XII')
                      selected
                      @endif>X</option>
                      <option value="XI"
                      @if($d->kelas == 'X')
                      selected
                      @elseif($d->kelas == 'XI')
                      selected
                      @elseif($d->kelas == 'XII')
                      selected
                      @endif>XI</option>
                      <option value="XII"
                      @if($d->kelas == 'X')
                      selected
                      @elseif($d->kelas == 'XI')
                      selected
                      @elseif($d->kelas == 'XII')
                      selected
                      @endif>XII</option>
                  </select>
              </div>
              <div class="col">
                  <label for="">Jurusan</label>
                  <input type="text" name="jurusan" class="form-control" value="{{$d->jurusan}}" placeholder="{{$d->jurusan}}">
              </div>
          </div>
          <div class="form-group">
              <label for="">Tanggal Lahir</label>
              <input type="date" name="tgl_lahir" class="form-control" value="{{$d->tgl_lahir}}">
          </div>
          <div class="form-group">
              <label for="">Keterangan</label>
              <input type="text" name="ket" class="form-control" value="{{$d->ket}}">
          </div>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="id" value="{{$d->id_siswa}}">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach
@endsection
@section('js')
<!-- <script>
    $(document).ready(function(){
        $('#addSubmit').on('click',function(){
            $('button[data-target="#addModal"]').addClass('invisible');
            $('#addSpinner').removeClass('d-none');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('/siswa/add') }}",
                method: 'post',
                data: {
                    no_ujian: $('#no_ujian').val().split('-')[1],
                    nama: $('#nama').val(),
                    kelas: $('#kelas').val(),
                    jurusan: $('#jurusan').val(),
                    tgl_lahir: $('#tgl_lahir').val(),
                    keterangan: "",
                },
                success: function(result){
                    $('#toast-success').html('Siswa berhasil dibuat');
                    $('.toast').toast('show');
                    $('button[data-target="#addModal"]').removeClass('invisible');
                    $('#addSpinner').addClass('d-none');
                },
            });
        })
    })
</script> -->
@endsection
