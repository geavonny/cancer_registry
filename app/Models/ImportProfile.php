<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportProfile extends Model
{
    /**
     * @var string
     */
    protected $table = 'profile_pasien';
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = [
        'nama_lengkap','no_registrasi','no_rekam_medis','nik','tempat_lahir','tanggal_lahir','jenis_kelamin','usia_terdiagnosis','alamat','propinsi','kabupaten','kecamatan','desa','np_hp','no_hp2','no_bpjs','bb','tb','kesimpulan'
    ];
}