<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('san_pham', function (Blueprint $table) {
            $table->id('id_sp');
            $table->string('ten_sp', 150);
            $table->text('mo_ta_sp')->nullable();
            $table->decimal('gia_sp', 10, 2);
            $table->integer('so_luong_ton_sp')->default(0);
            $table->string('hinh_anh_sp')->nullable();
            $table->date('ngay_tao_sp')->default(now());
            $table->date('ngay_cap_nhat_sp')->default(now());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('san_pham');
    }
};
