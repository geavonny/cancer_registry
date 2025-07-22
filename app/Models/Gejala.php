<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gejala extends Model
{
    /**
     * @var string
     */
    protected $table = 'gejala';
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = [
        'nama_lengkap','no_registrasi','no_rekam_medis','gejala','tanggal_gejala', 'catatan_pasien', 'catatan_dokter'

    ];
}