<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class phuong_xa extends Model
{
    protected $table = 'phuong_xa';
    protected $primaryKey = 'phuongxa_id';

    public function quan_huyen () {
        return $this->belongsTo('App\quan_huyen','quanhuyen_id');
    }
}
