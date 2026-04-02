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
        // database/migrations/2024_01_01_000003_create_properties_table.php

        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('property_type_id')->constrained()->onDelete('restrict');
            $table->foreignId('location_id')->constrained()->onDelete('restrict');

            // Thông tin cơ bản
            $table->string('title'); // Tiêu đề
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('address'); // Địa chỉ chi tiết

            // Giá cả
            $table->decimal('price', 15, 2); // Giá
            $table->enum('price_type', ['sale', 'rent']); // Bán/Cho thuê
            $table->string('currency', 3)->default('VND');
            $table->boolean('price_negotiable')->default(false); // Có thương lượng

            // Diện tích & Kích thước
            $table->decimal('area', 8, 2); // m²
            $table->decimal('width', 6, 2)->nullable(); // Chiều rộng
            $table->decimal('length', 6, 2)->nullable(); // Chiều dài

            // Thông số chi tiết
            $table->integer('bedrooms')->nullable(); // Số phòng ngủ
            $table->integer('bathrooms')->nullable(); // Số phòng tắm
            $table->integer('floors')->nullable(); // Số tầng
            $table->integer('parking_spaces')->nullable(); // Chỗ đỗ xe

            // Hướng & Phong thủy
            $table->string('direction')->nullable(); // Hướng nhà
            $table->string('feng_shui')->nullable(); // Hướng phong thủy

            // Trạng thái
            $table->enum('status', ['draft', 'pending', 'approved', 'published', 'sold', 'rented', 'cancelled'])
                ->default('pending');
            $table->boolean('is_featured')->default(false); // Nổi bật
            $table->boolean('is_hot')->default(false); // Hot listing
            $table->date('publish_date')->nullable();
            $table->date('expire_date')->nullable();

            // Vị trí GPS
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();

            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();

            // Thống kê
            $table->integer('views_count')->default(0);
            $table->integer('favorites_count')->default(0);

            $table->timestamps();
            $table->softDeletes();

            // Indexes cho search nhanh
            $table->index(['status', 'price_type', 'property_type_id', 'location_id']);
            $table->index(['price', 'area']);
            $table->index(['is_featured', 'is_hot']);
            $table->index('slug');

            // Full-text search
            $table->fullText(['title', 'description', 'address']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
