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
        'no_rekam_medis','gejala',

    ];
}