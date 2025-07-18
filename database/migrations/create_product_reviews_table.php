<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('product_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->text('comment')->nullable();
            $table->tinyInteger('rating')->default(0); // 1–5
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('product_reviews');
    }
};
