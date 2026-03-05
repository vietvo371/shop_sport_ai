<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('danh_muc', function (Blueprint $table) {
            $table->id();
            $table->foreignId('danh_muc_cha_id')->nullable()->constrained('danh_muc')->nullOnDelete();
            $table->string('ten', 100);
            $table->string('duong_dan', 120)->unique();
            $table->string('hinh_anh')->nullable();
            $table->text('mo_ta')->nullable();
            $table->unsignedInteger('thu_tu')->default(0);
            $table->boolean('trang_thai')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('danh_muc');
    }
};
