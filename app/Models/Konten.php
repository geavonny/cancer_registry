<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Konten extends Model
{
    /**
     * @var string
     */
    protected $table = 'content';
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = [
        'judul','sumber','embed',

    ];
}