<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('don_hang', function (Blueprint $table) {
            $table->bigIncrements('id_dh');  // BIGINT UNSIGNED (Khóa chính)
            $table->string('ten_khach_hang');
            $table->string('email');
            $table->string('so_dien_thoai');
            $table->text('dia_chi');
            $table->decimal('tong_tien', 10, 2);
            $table->string('trang_thai')->default('Chờ xử lý');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('don_hang');
    }
};
