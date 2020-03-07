<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'setting';
    protected $fillable = [
        'countdown','no_s','th_ajr','nm_kpl','no_kpl','perihal','nm_skl','lokasi'
    ];
}
