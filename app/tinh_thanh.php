<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tinh_thanh extends Model
{
    protected $table = 'tinh_thanh';
    protected $primaryKey = 'ma_tinh';

    public function quan_huyen() {
        return $this->hasMany('App\quan_huyen', 'ma_tinh');
    }

}
