@extends('layout.index')
@section('title','Setting')
@section('head')
<style>
    .modal-lgx,.modal-xl {
        overflow:hidden;
    }
    .modal-lgx .modal-body,.modal-xl .modal-body {
        overflow:auto;
    }
    .modal-lgx img {
        max-width:300px;
    }
</style>
@endsection
@section('body')
<div class="container py-3">
    <h5>Setting</h5>
    <hr>
    <div class="container">
        <form action="{{url('/setting/update')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="col-sm-6 py-2">
                    <label for=""><b>Kop Surat</b> | <a href="#" data-toggle="modal" data-target="#kpP"><b>Preview</b></a></label><br>
                    <input type="file" name="kop">
                </div>
                <div class="col-sm-6 py-2">
                    <label for=""><b>Tanda Tangan</b> | <a href="#" data-toggle="modal" data-target="#ttP"><b>Preview</b></a></label><br>
                    <input type="file" name="ttd">
                </div>
                <div class="col-sm-6 py-2">
                    <label for=""><b>Tanggal web boleh diakses</b></label>
                    <input type="datetime" name="cd" class="form-control" value="{{$data->countdown}}">
                </div>
                <div class="col-sm-6 py-2">
                    <label for=""><b>Setting Lainya</b></label><br>
                    <button type="button" class="btn btn-warning" data-toggle="modal"
                        data-target="#modalSetting">Setting</button>
                </div>
            </div>
            <div class="form-group py-2 text-right">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="kpP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" style="width:auto;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="{{asset('/data-file/'.$data->kop)}}" alt="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ttP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lgx" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-body text-center">
                    <img src="{{asset('/data-file/'.$data->ttd)}}" alt="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalSetting" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Setting Lainya</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="col">
                        <label for=""><b>Pengumuman</b></label><br>
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#pengumuman">Setting</button>
                    </div>
                    <div class="col">
                        <label for=""><b>Panduan</b></label><br>
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#panduanS">Setting</button>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label for=""><b>Catatan</b></label><br>
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#catatanS">Setting</button>
                    </div>
                    <div class="col">
                        <label for=""><b>Print</b></label><br>
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#printS">Setting</button>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label for=""><b>Print HTML</b></label><br>
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#printH">Setting</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="catatanS" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Catatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label for=""><b>Catatan</b></label>
                <textarea id="catatanD" cols="30" rows="10" class="form-control">{{$data->catatan}}</textarea>
                <small><i>bisa menggunakan code html</i></small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="simpanC" data-dismiss="modal">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="pengumuman" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Pengumuman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label for=""><b>Pengumuman</b></label>
                <textarea id="pengumuman-d" cols="30" rows="10" class="form-control">{{$data->pengumuman}}</textarea>
            </div>
            <div class="modal-footer">
                <button id="h-pengumuman" class="btn btn-danger mr-auto" data-dismiss="modal">Hapus Pengumuman</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="simpan" data-dismiss="modal">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="panduanS" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Panduan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label for=""><b>Panduan</b></label>
                <textarea id="panduanD" cols="30" rows="10" class="form-control">{{$data->panduan}}</textarea>
                <small><i>bisa menggunakan code html</i></small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="simpanP" data-dismiss="modal">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="printH" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Print HTML</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label for=""><b>Print HTML setting</b></label>
                <textarea id="printHD" cols="30" rows="10" class="form-control">{{$data->print_html}}</textarea>
                <small><i>bisa menggunakan code html</i></small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="simpanPH" data-dismiss="modal">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="printS" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Pengaturan Print</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for=""><b>Nomor Surat</b></label>
                    <input type="text" id="no_s" class="form-control" value="{{$data->no_s}}">
                </div>
                <div class="form-group">
                    <label for=""><b>Perihal</b></label>
                    <input type="text" id="perihal" class="form-control" value="{{$data->perihal}}">
                </div>
                <div class="form-group">
                    <label for=""><b>Tahun Ajaran</b></label>
                    <input type="text" id="th_ajr" class="form-control" value="{{$data->th_ajr}}">
                </div>
                <div class="form-group">
                    <label for=""><b>Nama Sekolah</b></label>
                    <input type="text" id="nm_skl" class="form-control" value="{{$data->nm_skl}}">
                </div>
                <div class="form-group">
                    <label for=""><b>Lokasi</b></label>
                    <input type="text" id="lokasi" class="form-control" value="{{$data->lokasi}}">
                </div>
                <div class="form-group">
                    <label for=""><b>Nama Kepala Sekolah</b></label>
                    <input type="text" id="nm_kpl" class="form-control" value="{{$data->nm_kpl}}">
                </div>
                <div class="form-group">
                    <label for=""><b>No Kepala Sekolah</b></label>
                    <input type="text" id="no_kpl" class="form-control" value="{{$data->no_kpl}}">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="print_submit" data-dismiss="modal">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function () {
        $('#h-pengumuman').on('click', function () {
            $('#toast-success').html('');
            $('#pengumuman').val('');
            $('button[data-target="#pengumuman"]').attr('disabled', 'disabled');
            $('button[data-target="#pengumuman"]').html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
            );
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                error: function (x, e) {
                    if (x.status == 500) {
                        alert('Internal Server Error. Please Try Again');
                        $('button[data-target="#pengumuman"]').removeAttr(
                            'disabled');
                        $('button[data-target="#pengumuman"]').html(
                            'Setting');
                    }
                },
            });
            $.ajax({
                url: "{{ url('/setting/delete') }}",
                method: 'get',
                success: function (result) {
                    setTimeout(function () {
                        $('button[data-target="#pengumuman"]').removeAttr(
                            'disabled');
                        $('button[data-target="#pengumuman"]').html(
                            'Setting');
                        $('#toast-success').html('Pengumuman Berhasil Dihapus');
                        $('.toast').toast('show');
                    }, 1500);
                },
            });
        });

        $('#simpan').on('click', function () {
            $('#toast-success').html('');
            $('button[data-target="#pengumuman"]').attr('disabled', 'disabled');
            $('button[data-target="#pengumuman"]').html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
            );
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                error: function (x, e) {
                    if (x.status == 500) {
                        alert('Internal Server Error. Please Try Again');
                        $('button[data-target="#pengumuman"]').removeAttr(
                            'disabled');
                        $('button[data-target="#pengumuman"]').html(
                            'Edit Pengumuman');
                    }
                },
            });
            $.ajax({
                url: "{{ url('/setting/update') }}",
                method: 'post',
                data: {
                    pengumuman: $('#pengumuman-d').val(),
                },
                success: function (result) {
                    setTimeout(function () {
                        $('button[data-target="#pengumuman"]').removeAttr(
                            'disabled');
                        $('button[data-target="#pengumuman"]').html(
                            'Edit Pengumuman');
                        $('#toast-success').html('Pengumuman Berhasil Diupdate');
                        $('.toast').toast('show');
                    }, 1500);
                },
            });
        });

        $('#print_submit').on('click', function () {
            $('#toast-success').html('');
            $('button[data-target="#printS"]').attr('disabled', 'disabled');
            $('button[data-target="#printS"]').html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
            );
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                error: function (x, e) {
                    if (x.status == 500) {
                        alert('Internal Server Error. Please Try Again');
                        $('button[data-target="#printS"]').removeAttr('disabled');
                        $('button[data-target="#printS"]').html('Setting');
                    }
                },
            });
            $.ajax({
                url: "{{ url('/setting/update') }}",
                method: 'post',
                data: {
                    print: 'print',
                    no_s: $('#no_s').val(),
                    th_ajr: $('#th_ajr').val(),
                    nm_kpl: $('#nm_kpl').val(),
                    no_kpl: $('#no_kpl').val(),
                    lokasi: $('#lokasi').val(),
                    nm_skl: $('#nm_skl').val(),
                    perihal: $('#perihal').val(),
                },
                success: function (result) {
                    setTimeout(function () {
                        $('button[data-target="#printS"]').removeAttr('disabled');
                        $('button[data-target="#printS"]').html('Setting');
                        $('#toast-success').html('Print Berhasil Diupdate');
                        $('.toast').toast('show');
                    }, 1500);
                },
            });
        });

        $('#simpanP').on('click', function () {
            $('#toast-success').html('');
            $('button[data-target="#panduanS"]').attr('disabled', 'disabled');
            $('button[data-target="#panduanS"]').html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
            );
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                error: function (x, e) {
                    if (x.status == 500) {
                        alert('Internal Server Error. Please Try Again');
                        $('button[data-target="#panduanS"]').removeAttr('disabled');
                        $('button[data-target="#panduanS"]').html('Setting');
                    }
                },
            });
            $.ajax({
                url: "{{ url('/setting/update') }}",
                method: 'post',
                data: {
                    panduan: $('#panduanD').val(),
                },
                success: function (result) {
                    setTimeout(function () {
                        $('button[data-target="#panduanS"]').removeAttr('disabled');
                        $('button[data-target="#panduanS"]').html('Setting');
                        $('#toast-success').html('Panduan Berhasil Disimpan');
                        $('.toast').toast('show');
                    }, 1500);
                },
            });
        });

        $('#simpanC').on('click', function () {
            $('#toast-success').html('');
            $('button[data-target="#catatanS"]').attr('disabled', 'disabled');
            $('button[data-target="#catatanS"]').html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
            );
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                error: function (x, e) {
                    if (x.status == 500) {
                        alert('Internal Server Error. Please Try Again');
                        $('button[data-target="#catatanS"]').removeAttr('disabled');
                        $('button[data-target="#catatanS"]').html('Setting');
                    }
                },
            });
            $.ajax({
                url: "{{ url('/setting/update') }}",
                method: 'post',
                data: {
                    catatan: $('#catatanD').val(),
                },
                success: function (result) {
                    setTimeout(function () {
                        $('button[data-target="#catatanS"]').removeAttr('disabled');
                        $('button[data-target="#catatanS"]').html('Setting');
                        $('#toast-success').html('Catatan Berhasil Disimpan');
                        $('.toast').toast('show');
                    }, 1500);
                },
            });
        });

        $('#simpanPH').on('click', function () {
            $('#toast-success').html('');
            $('button[data-target="#printH"]').attr('disabled', 'disabled');
            $('button[data-target="#printH"]').html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
            );
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                error: function (x, e) {
                    if (x.status == 500) {
                        alert('Internal Server Error. Please Try Again');
                        $('button[data-target="#printH"]').removeAttr('disabled');
                        $('button[data-target="#printH"]').html('Setting');
                    }
                },
            });
            $.ajax({
                url: "{{ url('/setting/update') }}",
                method: 'post',
                data: {
                    print_html: $('#printHD').val(),
                },
                success: function (result) {
                    setTimeout(function () {
                        $('button[data-target="#printH"]').removeAttr('disabled');
                        $('button[data-target="#printH"]').html('Setting');
                        $('#toast-success').html('Print HTML Berhasil Disimpan');
                        $('.toast').toast('show');
                    }, 1500);
                },
            });
        });

    });

</script>
@endsection
