<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('yeu_thich', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nguoi_dung_id')->constrained('nguoi_dung')->cascadeOnDelete();
            $table->foreignId('san_pham_id')->constrained('san_pham')->cascadeOnDelete();
            $table->timestamp('created_at')->useCurrent();

            $table->unique(['nguoi_dung_id', 'san_pham_id']);
        });

        Schema::create('phien_chatbot', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nguoi_dung_id')->nullable()->constrained('nguoi_dung')->nullOnDelete();
            $table->string('ma_phien', 100)->unique();
            $table->timestamp('bat_dau_luc')->useCurrent();
            $table->timestamp('ket_thuc_luc')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('tin_nhan_chatbot', function (Blueprint $table) {
            $table->id();
            $table->foreignId('phien_id')->constrained('phien_chatbot')->cascadeOnDelete();
            $table->enum('vai_tro', ['nguoi_dung', 'tro_ly']);
            $table->text('noi_dung');
            $table->unsignedInteger('so_token')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->index('phien_id');
        });

        Schema::create('hanh_vi_nguoi_dung', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nguoi_dung_id')->nullable()->constrained('nguoi_dung')->nullOnDelete();
            $table->string('ma_phien', 100)->nullable();
            $table->foreignId('san_pham_id')->constrained('san_pham')->cascadeOnDelete();
            $table->enum('hanh_vi', ['xem', 'click', 'them_gio_hang', 'mua_hang', 'yeu_thich']);
            $table->unsignedInteger('thoi_gian_xem_s')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->index(['nguoi_dung_id', 'san_pham_id']);
            $table->index('hanh_vi');
        });

        Schema::create('thong_bao', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nguoi_dung_id')->constrained('nguoi_dung')->cascadeOnDelete();
            $table->string('loai', 100);
            $table->string('tieu_de', 200);
            $table->text('noi_dung')->nullable();
            $table->json('du_lieu_them')->nullable();
            $table->timestamp('da_doc_luc')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->index(['nguoi_dung_id', 'da_doc_luc']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('thong_bao');
        Schema::dropIfExists('hanh_vi_nguoi_dung');
        Schema::dropIfExists('tin_nhan_chatbot');
        Schema::dropIfExists('phien_chatbot');
        Schema::dropIfExists('yeu_thich');
    }
};
