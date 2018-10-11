<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nhom_phan_quyen extends Model
{
    protected $table = 'nhom_phan_quyen';
    protected $fillable = ['id_nhom_nguoi_dung','id_chuc_nang','allaction','xem','them','sua','xoa'];
}
