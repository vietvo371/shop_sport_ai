<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dia_chi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nguoi_dung_id')->constrained('nguoi_dung')->cascadeOnDelete();
            $table->string('ho_va_ten', 100);
            $table->string('so_dien_thoai', 20);
            $table->string('tinh_thanh', 100);
            $table->string('quan_huyen', 100);
            $table->string('phuong_xa', 100);
            $table->string('dia_chi_cu_the', 255);
            $table->boolean('la_mac_dinh')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dia_chi');
    }
};
