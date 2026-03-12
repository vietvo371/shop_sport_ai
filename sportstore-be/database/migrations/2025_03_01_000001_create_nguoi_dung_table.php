<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('nguoi_dung', function (Blueprint $table) {
            $table->id();
            $table->string('ho_va_ten', 100);
            $table->string('email', 150)->unique();
            $table->string('mat_khau')->nullable(); // nullable: Google OAuth users không có password
            $table->string('so_dien_thoai', 20)->nullable();
            $table->string('anh_dai_dien')->nullable();
            $table->string('google_id')->nullable()->unique(); // Google OAuth
            $table->boolean('is_master')->default(false);
            $table->enum('vai_tro', ['quan_tri', 'khach_hang'])->default('khach_hang');
            $table->boolean('trang_thai')->default(true);
            $table->timestamp('xac_thuc_email_luc')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nguoi_dung');
    }
};
