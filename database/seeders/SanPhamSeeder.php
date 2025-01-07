<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SanPham;

class SanPhamSeeder extends Seeder
{
    public function run()
    {
        SanPham::create([
            'ten_sp' => 'iPhone 15 Pro Max',
            'mo_ta_sp' => 'Điện thoại cao cấp từ Apple.',
            'gia_sp' => 35000000,
            'so_luong_ton_sp' => 10,
            'hinh_anh_sp' => 'iphone15.jpg',
            'ngay_tao_sp' => now(),
            'ngay_cap_nhat_sp' => now()
        ]);

        SanPham::create([
            'ten_sp' => 'Samsung Galaxy S23',
            'mo_ta_sp' => 'Điện thoại flagship từ Samsung.',
            'gia_sp' => 28000000,
            'so_luong_ton_sp' => 15,
            'hinh_anh_sp' => 'galaxy_s23.jpg',
            'ngay_tao_sp' => now(),
            'ngay_cap_nhat_sp' => now()
        ]);
    }
}
