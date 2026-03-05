<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('danh_gia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('san_pham_id')->constrained('san_pham')->cascadeOnDelete();
            $table->foreignId('nguoi_dung_id')->constrained('nguoi_dung')->cascadeOnDelete();
            $table->foreignId('don_hang_id')->nullable()->constrained('don_hang')->nullOnDelete();
            $table->tinyInteger('so_sao')->unsigned(); // 1-5
            $table->string('tieu_de', 200)->nullable();
            $table->text('noi_dung')->nullable();
            $table->boolean('da_duyet')->default(false);
            $table->timestamps();

            $table->unique(['san_pham_id', 'nguoi_dung_id', 'don_hang_id']);
            $table->index(['san_pham_id', 'da_duyet']);
        });

        Schema::create('hinh_anh_danh_gia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('danh_gia_id')->constrained('danh_gia')->cascadeOnDelete();
            $table->string('duong_dan_anh');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hinh_anh_danh_gia');
        Schema::dropIfExists('danh_gia');
    }
};
