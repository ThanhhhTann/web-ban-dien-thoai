<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    use HasFactory;

    protected $table = 'san_pham';
    protected $primaryKey = 'id_sp';
    protected $fillable = ['ten_sp', 'mo_ta_sp', 'gia_sp', 'so_luong_ton_sp', 'hinh_anh_sp'];
}
