<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Histori extends Model
{
    /**
     * @var string
     */
    protected $table = 'histori_pasien';
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = [
        'nama_lengkap','no_registrasi','no_rekam_medis','dasar_diagnosis','bb_lahir','imunisasi','asi_eksklusif','riwayat_keganasan_keluarga','ket_keganasan_keluarga',
        'tata_laksana','staging_stadium','tgl_keluhan_pertama','tgl_diagnosis','tgl_pertama_terapi','status_validasi','nama_unit',
    ];
}