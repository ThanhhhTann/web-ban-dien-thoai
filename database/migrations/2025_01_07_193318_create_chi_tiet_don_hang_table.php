<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('chi_tiet_don_hang', function (Blueprint $table) {
            $table->bigIncrements('id_ctdh'); // Khóa chính BIGINT UNSIGNED
            $table->unsignedBigInteger('id_dh'); // Khóa ngoại BIGINT UNSIGNED
            $table->foreign('id_dh')->references('id_dh')->on('don_hang')->onDelete('cascade');

            $table->unsignedBigInteger('id_sp');
            $table->foreign('id_sp')->references('id_sp')->on('san_pham')->onDelete('cascade');

            $table->integer('so_luong');
            $table->decimal('gia_ban', 10, 2);
            $table->decimal('tong_tien_sp', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('chi_tiet_don_hang');
    }
};
