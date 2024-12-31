<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rekam extends Model
{
    /**
     * @var string
     */
    protected $table = 'rekam_medis';
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = [
        'no_rekam_medis','tgl_kunjungan','keluhan_utama','siklus_ke','komplikasi_penyakit_dasar','komplikasi_kemoterapi','infeksi_kemo',
        'non_infeksi_kemo','evaluasi_pengobatan','tgl_evaluasi','evaluasi_pengobatan_lain','keluhan_tujuan_lain','pemeriksaan_fisik',
        'ukuran_tumor','lokasi_limfadenompati','besar_hepar','besar_lien','schuffner','pemeriksaan_fisik_lainnya','tgl_periksa_lab',
        'hemoglobin','leukosit','trombosit','blast','tumor_marker','limfoblas','tambahan_infeksi','tambahan_non_infeksi','plan','plan_lainnya',

    ];
}