<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('san_pham', function (Blueprint $table) {
            $table->string('hinh_anh_sp')->nullable()->after('so_luong_ton_sp');
        });
    }

    public function down()
    {
        Schema::table('san_pham', function (Blueprint $table) {
            $table->dropColumn('hinh_anh_sp');
        });
    }
};
