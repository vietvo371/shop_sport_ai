<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('don_hang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nguoi_dung_id')->nullable()->constrained('nguoi_dung')->nullOnDelete();
            $table->foreignId('dia_chi_id')->nullable()->constrained('dia_chi')->nullOnDelete();
            $table->foreignId('ma_giam_gia_id')->nullable()->constrained('ma_giam_gia')->nullOnDelete();
            $table->string('ma_don_hang', 50)->unique();
            $table->enum('trang_thai', [
                'cho_xac_nhan', 'da_xac_nhan', 'dang_xu_ly',
                'dang_giao', 'da_giao', 'da_huy', 'hoan_tra',
            ])->default('cho_xac_nhan');
            $table->enum('phuong_thuc_tt', ['cod', 'chuyen_khoan', 'vnpay', 'momo']);
            $table->enum('trang_thai_tt', [
                'chua_thanh_toan', 'da_thanh_toan', 'da_hoan_tien',
            ])->default('chua_thanh_toan');
            $table->decimal('tam_tinh', 12, 2);
            $table->decimal('so_tien_giam', 12, 2)->default(0);
            $table->decimal('phi_van_chuyen', 12, 2)->default(0);
            $table->decimal('tong_tien', 12, 2);
            $table->text('ghi_chu')->nullable();
            // Snapshot địa chỉ lúc đặt hàng
            $table->string('ten_nguoi_nhan', 100)->nullable();
            $table->string('sdt_nguoi_nhan', 20)->nullable();
            $table->text('dia_chi_giao_hang')->nullable();
            $table->timestamps();

            $table->index('nguoi_dung_id');
            $table->index('trang_thai');
        });

        Schema::create('chi_tiet_don_hang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('don_hang_id')->constrained('don_hang')->cascadeOnDelete();
            $table->foreignId('san_pham_id')->constrained('san_pham');
            $table->foreignId('bien_the_id')->nullable()->constrained('bien_the_san_pham')->nullOnDelete();
            $table->string('ten_san_pham', 200);       // snapshot
            $table->string('thong_tin_bien_the', 100)->nullable(); // snapshot
            $table->unsignedInteger('so_luong');
            $table->decimal('don_gia', 12, 2);
            $table->decimal('thanh_tien', 12, 2);
        });

        Schema::create('lich_su_trang_thai_don', function (Blueprint $table) {
            $table->id();
            $table->foreignId('don_hang_id')->constrained('don_hang')->cascadeOnDelete();
            $table->string('trang_thai', 50);
            $table->text('ghi_chu')->nullable();
            $table->foreignId('cap_nhat_boi')->nullable()->constrained('nguoi_dung')->nullOnDelete();
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('lich_su_dung_ma', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ma_giam_gia_id')->constrained('ma_giam_gia')->cascadeOnDelete();
            $table->foreignId('nguoi_dung_id')->constrained('nguoi_dung')->cascadeOnDelete();
            $table->foreignId('don_hang_id')->constrained('don_hang')->cascadeOnDelete();
            $table->timestamp('su_dung_luc')->useCurrent();

            $table->unique(['ma_giam_gia_id', 'nguoi_dung_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lich_su_dung_ma');
        Schema::dropIfExists('lich_su_trang_thai_don');
        Schema::dropIfExists('chi_tiet_don_hang');
        Schema::dropIfExists('don_hang');
    }
};
