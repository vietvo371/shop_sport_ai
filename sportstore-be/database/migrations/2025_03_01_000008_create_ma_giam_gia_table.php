<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ma_giam_gia', function (Blueprint $table) {
            $table->id();
            $table->string('ma_code', 50)->unique();
            $table->enum('loai_giam', ['phan_tram', 'so_tien_co_dinh']);
            $table->decimal('gia_tri', 12, 2);
            $table->decimal('gia_tri_don_hang_min', 12, 2)->default(0);
            $table->decimal('giam_toi_da', 12, 2)->nullable();
            $table->unsignedInteger('gioi_han_su_dung')->nullable();
            $table->unsignedInteger('da_su_dung')->default(0);
            $table->timestamp('bat_dau_luc')->nullable();
            $table->timestamp('het_han_luc')->nullable();
            $table->boolean('trang_thai')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ma_giam_gia');
    }
};
