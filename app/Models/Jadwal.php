<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    /**
     * @var string
     */
    protected $table = 'jadwal';
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = [
        'no_rekam_medis','id_dokter','tanggal','status',

    ];
    /**
    *
    *
    *
    * @var array
    */
    protected $cast = [
        'tanggal' => 'datetime:Y-m-d',
    ];
}