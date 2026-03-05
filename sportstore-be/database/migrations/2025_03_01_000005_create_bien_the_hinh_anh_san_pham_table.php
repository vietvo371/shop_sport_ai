<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bien_the_san_pham', function (Blueprint $table) {
            $table->id();
            $table->foreignId('san_pham_id')->constrained('san_pham')->cascadeOnDelete();
            $table->string('ma_sku', 100)->unique()->nullable();
            $table->string('kich_co', 20)->nullable();
            $table->string('mau_sac', 50)->nullable();
            $table->string('ma_mau_hex', 7)->nullable();
            $table->string('hinh_anh')->nullable();
            $table->decimal('gia_rieng', 12, 2)->nullable();
            $table->unsignedInteger('ton_kho')->default(0);
            $table->boolean('trang_thai')->default(true);
            $table->timestamps();

            $table->index('san_pham_id');
        });

        Schema::create('hinh_anh_san_pham', function (Blueprint $table) {
            $table->id();
            $table->foreignId('san_pham_id')->constrained('san_pham')->cascadeOnDelete();
            $table->string('duong_dan_anh');
            $table->string('chu_thich', 200)->nullable();
            $table->unsignedInteger('thu_tu')->default(0);
            $table->boolean('la_anh_chinh')->default(false);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hinh_anh_san_pham');
        Schema::dropIfExists('bien_the_san_pham');
    }
};
