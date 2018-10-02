<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class danh_muc_san_pham extends Model
{
    protected $table = 'danh_muc_san_pham';
    protected $primaryKey = 'danh_muc_id';
    public function san_pham () {
        return $this->hasMany('App\san_pham','danh_muc_id');
    }
}
