<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nhom_nguoi_dung extends Model
{
    protected $table = 'nhom_nguoi_dung';

    public function user(){
        return $this->hasMany('users','id');
    }
}
