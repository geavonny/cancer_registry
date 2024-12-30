<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rujukan extends Model
{
    /**
     * @var string
     */
    protected $table = 'rujukan';
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = [
        'no_rekam_medis','ppk','tgl_ppk',
    ];
}