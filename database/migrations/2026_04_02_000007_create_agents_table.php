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
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('full_name');
            $table->string('phone');
            $table->string('email');
            $table->string('avatar')->nullable();
            $table->text('bio')->nullable();
            $table->string('position')->nullable(); // Chức vụ
            $table->string('company')->nullable(); // Công ty
            $table->string('facebook')->nullable();
            $table->string('zalo')->nullable();
            $table->integer('properties_count')->default(0);
            $table->integer('reviews_count')->default(0);
            $table->decimal('rating', 3, 2)->default(0.00);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agents');
    }
};
