<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    /**
     * @var string
     */
    protected $table = 'diagnosis';
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = [
        'nama_lengkap','no_registrasi','no_rekam_medis','kode_subgroup','subgroup','kode_morfologi','morfologi','kode_topografi','topografi','literalitas',
        'tgl_pertama_konsultasi',
    ];
}