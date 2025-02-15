<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imports extends Model
{
    /**
     * @var string
     */
    protected $table = 'import_test';
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = [
        'nama','nik','status',
    ];
}