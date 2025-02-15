<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    /**
     * @var string
     */
    protected $table = 'tokens';
    /**
     * @var array
     */
    protected $fillable = [
        'id','user_id','token','expired_at','created_at','updated_at',

    ];
    public function user(){
        return $this->belongsTo(Pengguna::class);
    }
}