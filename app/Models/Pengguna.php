<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    /**
     * @var string
     */
    protected $table = 'user';
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = [
        'nama_lengkap','username','password','email','nik','nip','level',

    ];
}