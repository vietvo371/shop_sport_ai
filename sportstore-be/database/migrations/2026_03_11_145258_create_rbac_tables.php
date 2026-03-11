<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // 1. Bảng Vai Trò (Roles)
        Schema::create('vai_tro', function (Blueprint $table) {
            $table->id();
            $table->string('ten', 100);
            $table->string('ma_slug', 100)->unique();
            $table->timestamps();
        });

        // 2. Bảng Quyền (Permissions)
        Schema::create('quyen', function (Blueprint $table) {
            $table->id();
            $table->string('ten', 100);
            $table->string('ma_slug', 100)->unique();
            $table->string('nhom', 100);
            $table->timestamps();
        });

        // 3. Bảng Pivot Vai Trò - Quyền
        Schema::create('vai_tro_quyen', function (Blueprint $table) {
            $table->foreignId('vai_tro_id')->constrained('vai_tro')->onDelete('cascade');
            $table->foreignId('quyen_id')->constrained('quyen')->onDelete('cascade');
            $table->primary(['vai_tro_id', 'quyen_id']);
        });

        // 4. Bảng Pivot Người Dùng - Vai Trò
        Schema::create('nguoi_dung_vai_tro', function (Blueprint $table) {
            $table->foreignId('nguoi_dung_id')->constrained('nguoi_dung')->onDelete('cascade');
            $table->foreignId('vai_tro_id')->constrained('vai_tro')->onDelete('cascade');
            $table->primary(['nguoi_dung_id', 'vai_tro_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nguoi_dung_vai_tro');
        Schema::dropIfExists('vai_tro_quyen');
        Schema::dropIfExists('quyen');
        Schema::dropIfExists('vai_tro');
    }
};
