<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilai';
    protected $fillable = [
        'no_ujian','nama_mapel','nilai_sekolah','nilai_un','nilai_akhir'
    ];
}
