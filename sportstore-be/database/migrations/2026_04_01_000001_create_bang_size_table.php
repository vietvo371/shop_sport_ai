<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bang_size', function (Blueprint $table) {
            $table->id();
            $table->foreignId('thuong_hieu_id')->nullable()->constrained('thuong_hieu')->nullOnDelete();
            $table->enum('loai', ['ao', 'quan', 'giay']);
            $table->string('ten_size', 50); // S, M, L, XL, 38, 39...
            
            // Dành cho Áo/Quần
            $table->decimal('chieu_cao_min', 5, 2)->nullable(); // cm
            $table->decimal('chieu_cao_max', 5, 2)->nullable(); // cm
            $table->decimal('can_nang_min', 5, 2)->nullable();  // kg
            $table->decimal('can_nang_max', 5, 2)->nullable();  // kg
            
            // Dành cho Giày
            $table->decimal('chieu_dai_chan_min', 6, 2)->nullable(); // mm
            $table->decimal('chieu_dai_chan_max', 6, 2)->nullable(); // mm
            
            $table->text('mo_ta')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bang_size');
    }
};
