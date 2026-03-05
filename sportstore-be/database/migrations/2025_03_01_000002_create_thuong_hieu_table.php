<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('thuong_hieu', function (Blueprint $table) {
            $table->id();
            $table->string('ten', 100)->unique();
            $table->string('duong_dan', 120)->unique();
            $table->string('logo')->nullable();
            $table->text('mo_ta')->nullable();
            $table->boolean('trang_thai')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('thuong_hieu');
    }
};
