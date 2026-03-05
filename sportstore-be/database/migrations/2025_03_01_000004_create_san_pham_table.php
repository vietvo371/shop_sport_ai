<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('san_pham', function (Blueprint $table) {
            $table->id();
            $table->foreignId('danh_muc_id')->constrained('danh_muc')->cascadeOnDelete();
            $table->foreignId('thuong_hieu_id')->nullable()->constrained('thuong_hieu')->nullOnDelete();
            $table->string('ten_san_pham', 200);
            $table->string('duong_dan', 220)->unique();
            $table->string('ma_sku', 100)->unique()->nullable();
            $table->string('mo_ta_ngan', 500)->nullable();
            $table->longText('mo_ta_day_du')->nullable();
            $table->decimal('gia_goc', 12, 2);
            $table->decimal('gia_khuyen_mai', 12, 2)->nullable();
            $table->unsignedInteger('so_luong_ton_kho')->default(0);
            $table->decimal('can_nang_kg', 8, 2)->nullable();
            $table->boolean('noi_bat')->default(false);
            $table->boolean('trang_thai')->default(true);
            $table->unsignedInteger('da_ban')->default(0);
            $table->unsignedInteger('luot_xem')->default(0);
            $table->decimal('diem_danh_gia', 3, 2)->default(0);
            $table->unsignedInteger('so_luot_danh_gia')->default(0);
            $table->timestamps();

            $table->index('danh_muc_id');
            $table->index('thuong_hieu_id');
            $table->index('trang_thai');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('san_pham');
    }
};
