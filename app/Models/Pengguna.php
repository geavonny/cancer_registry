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
        'username','password','email','nik','level',

    ];
}