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
        Schema::create('property_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->string('image_path'); // path/to/image.jpg
            $table->string('image_name'); // Tên gốc file
            $table->string('image_mime')->nullable(); // image/jpeg
            $table->integer('image_size')->nullable(); // bytes
            $table->boolean('is_primary')->default(false); // Ảnh đại diện
            $table->integer('sort_order')->default(0);
            $table->text('caption')->nullable();
            $table->timestamps();

            $table->index(['property_id', 'is_primary']);
            $table->index('sort_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_images');
    }
};
