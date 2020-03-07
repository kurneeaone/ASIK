<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $fillable = [
        'no_ujian','nama_siswa','kelas','jurusan','tgl_lahir','ket'
    ];
}
