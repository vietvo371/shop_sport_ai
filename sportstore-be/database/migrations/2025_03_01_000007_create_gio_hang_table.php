<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('gio_hang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nguoi_dung_id')->nullable()->constrained('nguoi_dung')->nullOnDelete();
            $table->string('ma_phien', 100)->nullable()->index();
            $table->timestamps();
        });

        Schema::create('gio_hang_san_pham', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gio_hang_id')->constrained('gio_hang')->cascadeOnDelete();
            $table->foreignId('san_pham_id')->constrained('san_pham')->cascadeOnDelete();
            $table->foreignId('bien_the_id')->nullable()->constrained('bien_the_san_pham')->nullOnDelete();
            $table->unsignedInteger('so_luong')->default(1);
            $table->decimal('don_gia', 12, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gio_hang_san_pham');
        Schema::dropIfExists('gio_hang');
    }
};
