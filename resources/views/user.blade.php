@extends('layout.index')
@section('title','User')
@section('head')
<style>
    div.data {
        overflow:auto;
    }
</style>
@endsection
@section('body')
<div class="container text-dark py-3">
    <h3>Data User</h3>
    <div class="form-row">
        <button type="button" class="ml-auto btn btn-primary" data-target="#addModal" data-toggle="modal">Add</button>
    </div>
    <div class="data py-2">
        <table class="table table-hover table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" class="align-middle">#</th>
                    <th scope="col" class="align-middle">Nama</th>
                    <th scope="col" class="align-middle">Email</th>
                    <th scope="col" class="align-middle">Password</th>
                    <th scope="col" class="align-middle">Token</th>
                    <th scope="col" class="align-middle">Created At</th>
                    <th scope="col" class="align-middle">Updated At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $d)
                <tr data-toggle="modal" data-target="#dataS{{$d->id}}">
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$d->name}}</td>
                    <td>{{$d->email}}</td>
                    <td>********</td>
                    <td>{{$d->remember_token}}</td>
                    <td>{{$d->created_at}}</td>
                    <td>{{$d->updated_at}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if(count($data) <= 0) <div class="text-center text-muted"><i>Tidak ada Data</i>
    </div>
    @endif
</div>
</div>
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('/user/add')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" name="nama" class="form-control" placeholder="Kurniawan">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="kurniawan@mail.com">
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="password">
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
@foreach($data as $d)
<div class="modal fade" id="dataS{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{$d->name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <a href="{{url('/user/delete/'.$d->id)}}" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin?')">Delete</a>
                <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#editDataS{{$d->id}}">Edit</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@foreach($data as $d)
<div class="modal fade" id="editDataS{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit {{$d->name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('/user/edit')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{$d->name}}">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control" value="{{$d->email}}">
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control" value="null1234">
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" value="{{$d->id}}">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endforeach
@endsection
