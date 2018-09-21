<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class quan_huyen extends Model
{
    protected $table = 'quan_huyen';
    protected $primaryKey = 'ma_quan_huyen';

    public function tinh_thanh () {
        return $this->belongsTo('App\tinh_thanh','ma_tinh');
    }

    public function phuong_xa () {
        return $this->hasMany('App\phuong_xa','quanhuyen_id');
    }
}
