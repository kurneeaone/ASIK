<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('setting');
        Schema::create('setting', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kop')->nullable();
            $table->string('ttd')->nullable();
            $table->datetime('countdown')->nullable();
            $table->longText('pengumuman')->nullable();
            $table->longText('catatan')->nullable();
            $table->longText('print_html')->nullable();
            $table->longText('panduan')->nullable();
            $table->string('no_s')->nullable();
            $table->string('th_ajr')->nullable();
            $table->string('nm_kpl')->nullable();
            $table->string('no_kpl')->nullable();
            $table->string('nm_skl')->nullable();
            $table->string('perihal')->nullable();
            $table->string('lokasi')->nullable();
            $table->timestamps();
        });
        DB::table('setting')->insert([
            'kop'=>'kop.jpg',
            'ttd'=>'ttd.jpg',
            'countdown'=>date('d-m-y H:i:s'),
            'no_s'=>'193.1/SMKM.1/E.2/V/2019',
            'th_ajr'=>'2018/2019',
            'nm_kpl'=>'Budiyata',
            'no_kpl'=>'NIP : -',
            'panduan'=>'Masukan nomer ujian anda, lalu tekan tombol cari.',
            'catatan'=>'<ul>
                <li>Kurniawan</li>
                <li>Developed By : Kurneea.one</li>
                </ul>',
            'print_html'=>"<ol>
            <li>Peraturan Menteri Pendidikan dan Kebudayaan Nomor 3 Tahun 2017 Tentang Penilaian Hasil Belajar oleh
                Pemerintah dan Penilaian Hasil Belajar oleh Satuan Pendidikan.</li>
            <li>Peraturan Badan Standar Nasional PendidikanNomor : 0048/BSNP/XI/2018 tanggal 29 November 2018 Tentang
                Prosedur Operasi Standar Penyelenggaraan Ujian Sekolah Berstandar Nasional (USBN) Tahun Pelajaran
                2018/2019.</li>
            <li>Peraturan Badan Standar Nasional Pendidikan Nomor : 0047/P/BSNP/XI/2018 tanggal 28 November 2018 Tentang
                Prosedur Operasi Standar Penyelenggaraan Ujian Nasional Tahun Pelajaran 2018/2019.</li>
            <li>Rapat Verifikasi dalam penelitian hasil penilaian Ujian Sekolah (US) tanggal 11 Mei 2019, dan Sidang
                Pleno pada tanggal 13 Mei 2019 di SMK Muhammadiyah 1 Klaten Utara.</li>
            </ol>",
            'nm_skl'=>'SMK Muhammadiyah 1 Klaten Utara',
            'perihal'=>'Pengumuman Hasil Ujian Tahun',
            'lokasi'=>'Klaten',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setting');
    }
}
