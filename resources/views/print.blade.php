<!DOCTYPE html>
<html>

<head>
    <title>{{$p->nama_siswa}}</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <style>
        body {
            font-size: 9pt;
        }

        table {
            margin: auto;
        }

        .ttd {
            position: absolute;
            right: 0;
        }

    </style>
</head>

<body>
    <center>
        <img src="{{asset('/data-file/'.$s->kop)}}" alt="">
    </center>
    <table style="margin:0;">
        <tr>
            <td>Nomor</td>
            <td>: {{$s->no_s}}</td>
        </tr>
        <tr>
            <td>Hal</td>
            <td>: {{$s->perihal}} {{$s->th_ajr}}</td>
        </tr>
        <tr>
            <td class="align-top">Kepada</td>
            <td>: Yth.Bapak/Ibu Orang Tua/Wali Murid <br>
                &nbsp;&nbsp;Kelas {{$p->kelas}} {{$s->nm_skl}} <br>
                &nbsp;&nbsp;di. TEMPAT</td>
        </tr>
    </table>
    <br>
    <p class="px-4"><b>Assalamualaikum Wr.Wb</b></p>
    <p> Dengan ini diberitahukan dengan hormat bahwa berdasarkan :
        {!!$s->print_html!!}
    </p>
    <p>Maka peserta didik yang tersebut di bawah ini :</p>
    <table>
        <tr>
            <td>Nama</td>
            <td class="ml-2">: {{$p->nama_siswa}}</td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td class="text-capitalize ml-2">: {{$date}}</td>
        </tr>
        <tr>
            <td>Kelas / Jurusan</td>
            <td class="ml-2">: {{$p->kelas}} / {{$p->jurusan}}</td>
        </tr>
        <tr>
            <td>No. Ujian</td>
            <td class="ml-2">: {{$p->no_ujian}}</td>
        </tr>
    </table>
    <center>
        <img src="{{asset('data-file/lulus.jpg')}}" class="my-3" width="200px">
    </center>
    <p class="text-center">Dari Satuan Pendidikan Tahun {{$s->th_ajr}}</p>
    <p>Demikian pengumuman ini kami sampaikan, agar dipergunakan sebagaimana mestinya, dan harap menjadikan perhatian.
    </p>
    <p><b>Wassalamualaikum Wr.Wb</b></p>
    <div class="ttd">
        <table class="m-0 text-center">
            <tr>
                <td>{{$s->lokasi}}, {{date('j F Y')}}</td>
            </tr>
            <tr>
                <td><img src="{{asset('data-file/'.$s->ttd)}}" width="200px"><br></td>
            </tr>
            <tr>
                <td>{{$s->nm_kpl}}</td>
            </tr>
            <tr>
                <td>{{$s->no_kpl}}</td>
            </tr>
        </table>
    </div>
</body>

</html>
