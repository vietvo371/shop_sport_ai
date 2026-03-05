<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('thanh_toan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('don_hang_id')->constrained('don_hang')->cascadeOnDelete();
            $table->string('phuong_thuc', 50);
            $table->string('ma_giao_dich', 200)->nullable();
            $table->decimal('so_tien', 12, 2);
            $table->enum('trang_thai', ['cho_xu_ly', 'thanh_cong', 'that_bai', 'da_hoan_tien'])
                  ->default('cho_xu_ly');
            $table->text('phan_hoi_cong_tt')->nullable(); // Raw JSON từ cổng
            $table->timestamp('thanh_toan_luc')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('thanh_toan');
    }
};
