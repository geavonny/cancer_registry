<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    /**
     * @var string
     */
    protected $table = 'faq';
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = [
        'pertanyaan','jawaban',

    ];
}