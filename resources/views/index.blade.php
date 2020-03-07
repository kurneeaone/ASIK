@extends('layout.index')
@section('title','Aplikasi Sistem Informasi Kelulusan')
@section('head')
<style>
    #nilai tr {
        background-color: #abdde5 !important;
    }

    #nilai tr:nth-child(even) {
        background-color: #bee5eb !important;
    }

    table.table thead tr th {
        vertical-align: middle;
    }

    .load {
        position:fixed;
        top:0;left:0;bottom:0;right:0;
        background:white;
        z-index:999;
        padding-top:245px
    }

    .spinner-khusus {
        position:fixed;
        text-align:center;
        left:0;right:0;
        top:185px;
    }
    .spinner-khusus * {
        width:10rem;
        height:10rem;
    }

    @media (max-width:800px) {
        table.table {
            width: 32rem;
            text-align: center;
        }
    }

</style>
@endsection
@section('body')
<div class="load">
    <div class="spinner-khusus">
        <div class="spinner-border text-info" role="status"></div>
    </div>
    <div class="d-flex justify-content-center">
        <div class="spinner-grow text-danger" role="status"></div>
        <div class="spinner-grow text-warning" role="status"></div>
        <div class="spinner-grow text-success" role="status"></div>
    </div>
</div>
<div class="container py-3">
    <div class="alert d-none" id="access">
        <div class="card bg-light">
            <div class="card-body">
                <div class="card-title">
                    <h5 class="text-danger">Website Belum Boleh Diakses!</h5>
                </div>
                <p class="text-success" id="time">Waktu Saat Ini <b><span></span></b> Tanggal <b><date></date></b></p>
                <p class="text-warning">Silahkan Tunggu Hingga Jam <span><b>{{date('H:i:s',strtotime($set->countdown))}}</b></span> Tanggal <span><b>{{$date}}</b></span></p>
                <input type="hidden" id="psDate" value="{{$set->countdown}}">
            </div>
        </div>
    </div>
    <div class="input d-none" id="can">
        <div class="form-group text-left">
            <label for=""><b>No. Ujian</b></label>
            <input type="text" id="no_ujian" class="form-control" placeholder="K3180700xx" data-toggle="tooltip" data-placement="top" title="Masukan No Ujian">
            <div class="invalid-feedback">
                Periksa kembali No Ujian Anda.
            </div>
        </div>
        <div class="form-group text-right">
            <button type="button" class="btn btn-primary btn-block" id="search">
                Cari
            </button>
        </div>
    </div>
    @if($set->pengumuman != null)
    <div class="pengumuman my-3">
        <div class="card text-danger">
            <div class="card-body">
                <div class="card-title">
                    <h4>Pengumuman</h4>
                </div>
                {{$set->pengumuman}}
            </div>
        </div>
    </div>
    @endif
    <div class="null d-none">
        <div class="card">
            <div class="card-body">
                <h5 class="text-danger">Data Tidak Ditemukan</h5>
            </div>
        </div>
    </div>
    <div class="data d-none">
        <h5 class="text-success">Hasil Pencarian</h5>
        <hr>
        <div class="data-query overflow-auto card">
            <div class="card-body">

                <table class="table table-light table-borderless align-middle text-dark">
                    <thead>
                        <tr class="table-secondary">
                            <th colspan="2">No. Ujian</th>
                            <th colspan="2" class="text-primary" id="dNo_ujian">K03180214xx</th>
                        </tr>
                        <tr>
                            <th colspan="2">Nama Peserta</th>
                            <th colspan="2" class="text-primary" id="dNama">Kurniawan Ronaldi Purnama</th>
                        </tr>
                        <tr class="table-secondary">
                            <th>Mata Pelajaran</th>
                            <th>Nilai UN</th>
                            <th>Nilai Sekolah</th>
                            <th>Nilai Akhir</th>
                        </tr>
                    </thead>
                    <tbody id="nilai">
                    </tbody>
                    <tfoot id="rataRata" class="table-danger">
                    </tfoot>
                </table>
                <div class="form-group" id="lulus">
                    <h5>Keterangan : <span class="text-primary"><b><u>LULUS</u></b></span></h5>
                    <a href="#" id="print" class="btn btn-success my-2">Cetak</a>
                </div>
                <div class="catatan text-dark">
                    <h6><u><b>Catatan</b></u> :</h6>
                    <div>
                        {!!$set->catatan!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('js/main-index.js')}}"></script>
<script>
    if($(document).ready){
        setTimeout(function(){
            $('.load').fadeOut();
            setTimeout(function(){
                $('.load').remove();
            },300)
        }, 1200);
    }
    function dtnw() {
        psDC = Date.parse($('#psDate').val());
        psDN = Date.parse(new Date());
        if (psDN > psDC) {
            setTimeout(function () {
                $('#access').fadeOut();
                setTimeout(function () {
                    $('#can').fadeIn();
                    $('#no_ujian').tooltip('enable');
                }, 1500);
            }, 2000);
            return true;
        }
        setTimeout(dtnw, 500);
    }
    $('.data,.null,#can').hide();
    $(document).ready(function () {
        startTime();
        $('.data,.null,#can,#access').removeClass('d-none');
        dtnw();
            $('#print').on('click',function(){
                if($('#print').attr('href') == '#'){
                    $('#toast-fail').html('Anda Tidak dapat Mencetak Surat');
                    $('.toast').toast('show');
                    setTimeout(function(){
                        $('#toast-fail').html('');
                    }, 5500);
                }
            });
        $('#search').on('click', function(){$('.data').fadeOut('slow');
            $('#no_ujian').removeClass('is-invalid');
            $('.null').fadeOut('slow');
            $('#nilai').html('');
            $('#rataRata').html('');
            $('#search').attr('disabled', 'disabled');
            $('#search').html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
            );
            $('#print').attr('href','');
            $('#print').removeAttr('target');
            no = $('#no_ujian').val();
            $.ajaxSetup({
                error: function (x, e) {
                    if (x.status == 500) {
                        alert('Internal Server Error. Please Try Again');
                    }
                },
            });
            $.ajax({
                type: 'GET',
                url: "{{url('/search')}}" + '/' + no,
                success: function (data) {
                    d = data.success;
                    if (d[1] == null) {
                        setTimeout(function () {
                            $('#search').removeAttr('disabled');
                            $('#search').html('Cari');
                            $('#no_ujian').addClass('is-invalid');
                            $('.null').fadeIn('slow');
                        }, 1500);
                        return true;
                    }
                    no   = d[1]['no_ujian'];
                    nama = d[1]['nama_siswa'];
                    ket  = d[1]['ket'];
                    $('#lulus h5 span b u').html(ket);
                    rt_ns = 0;
                    rt_nun = 0;
                    rt_na = 0;

                    if(ket.toUpperCase() === 'LULUS'){
                        $('#print').attr('href', "{{url('/print')}}" + '/' + no);
                        $('#print').attr('target',"_blank");
                    }else{
                        $('#print').attr('href','#');
                        $('#print').removeAttr('target');
                    }

                    $('#dNo_ujian').html(no);
                    $('#dNama').html(nama);
                    for (i = 0; i < d[0].length; i++) {
                        mapel = d[0][i]['nama_mapel'];
                        ns = d[0][i]['nilai_sekolah'];
                        nun = d[0][i]['nilai_un'];
                        na = d[0][i]['nilai_akhir'];
                        nilai = '<tr>';
                        nilai += '<td>' + mapel + '</td>';
                        nilai += '<td>' + ns + '</td>';
                        nilai += '<td>' + nun + '</td>';
                        nilai += '<td>' + na + '</td>';
                        nilai += '</tr>';
                        $('#nilai').append(nilai);
                        rt_ns += ns / d[0].length;
                        rt_nun += nun / d[0].length;
                        rt_na += na / d[0].length;
                    }
                    rt = '<tr>';
                    rt += '<th>Rata - rata</th>';
                    rt += '<th>' + rt_ns + '</th>';
                    rt += '<th>' + rt_nun + '</th>';
                    rt += '<th>' + rt_na + '</th>';
                    rt += '</tr>';
                    $('#rataRata').append(rt);
                    setTimeout(function () {
                        $('#search').removeAttr('disabled');
                        $('#search').html('Cari');
                        $('.data').fadeIn('slow');
                    }, 1500);
                },
            });
        });
    });

</script>
@endsection
