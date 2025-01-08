<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SanPham;

class SanPhamSeeder extends Seeder
{
    public function run()
    {
        SanPham::create([
            'ten_sp' => 'iPhone 15',
            'mo_ta_sp' => 'Điện thoại cao cấp của Apple',
            'gia_sp' => 25000000,
            'so_luong_ton_sp' => 10,
            'hinh_anh_sp' => 'iphone15.jpg'
        ]);

        SanPham::create([
            'ten_sp' => 'Samsung Galaxy S23',
            'mo_ta_sp' => 'Điện thoại cao cấp của Samsung',
            'gia_sp' => 20000000,
            'so_luong_ton_sp' => 20,
            'hinh_anh_sp' => 'samsung_s23.jpg'
        ]);
    }
}
