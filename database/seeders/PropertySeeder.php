<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        // BĐS 1: Nhà mặt tiền Quận 1
        $p1 = Property::create([
            'user_id' => 1,
            'property_type_id' => 1, // Nhà đất
            'location_id' => 1, // TPHCM
            'title' => 'Nhà mặt tiền Quận 1, TP.HCM',
            'slug' => 'nha-mat-tien-quan-1',
            'description' => 'Nhà mặt tiền vị trí đẹp, kinh doanh đa ngành',
            'address' => '123 Nguyễn Huệ, Quận 1',
            'price' => 8500000000,
            'price_type' => 'sale',
            'currency' => 'VND',
            'price_negotiable' => true,
            'area' => 85,
            'bedrooms' => 4,
            'bathrooms' => 3,
            'floors' => 4,
            'status' => 'published',
            'is_featured' => true,
            'is_hot' => true,
        ]);

        // BĐS 2: Căn hộ Vinhomes
        $p2 = Property::create([
            'user_id' => 1,
            'property_type_id' => 2, // Căn hộ
            'location_id' => 2, // Quận 7
            'title' => 'Căn hộ cao cấp Vinhomes Central Park',
            'slug' => 'can-ho-vinhomes-central-park',
            'description' => 'Căn hộ view sông, nội thất cao cấp',
            'address' => 'Vinhomes Central Park, Quận 7',
            'price' => 4200000000,
            'price_type' => 'sale',
            'currency' => 'VND',
            'price_negotiable' => false,
            'area' => 70,
            'bedrooms' => 2,
            'bathrooms' => 2,
            'floors' => 1,
            'status' => 'published',
            'is_featured' => true,
        ]);

        // BĐS 3: Đất nền Bình Chánh
        $p3 = Property::create([
            'user_id' => 1,
            'property_type_id' => 4, // Đất nền
            'location_id' => 3, // Bình Chánh
            'title' => 'Đất nền Bình Chánh giá rẻ',
            'slug' => 'dat-nen-binh-chanh',
            'description' => 'Đất nền sổ hồng riêng, xây dựng tự do',
            'address' => 'Bình Chánh, TP.HCM',
            'price' => 2100000000,
            'price_type' => 'sale',
            'currency' => 'VND',
            'price_negotiable' => true,
            'area' => 100,
            'bedrooms' => 0,
            'bathrooms' => 0,
            'status' => 'published',
        ]);

        // BĐS 4: Nhà phố Hà Nội
        $p4 = Property::create([
            'user_id' => 1,
            'property_type_id' => 6, // Nhà phố
            'location_id' => 4, // Hà Nội
            'title' => 'Nhà phố Ba Đình, Hà Nội',
            'slug' => 'nha-pho-ba-dinh',
            'description' => 'Nhà phố trung tâm, gần Hồ Gươm',
            'address' => 'Ba Đình, Hà Nội',
            'price' => 12000000000,
            'price_type' => 'sale',
            'currency' => 'VND',
            'area' => 60,
            'bedrooms' => 3,
            'bathrooms' => 2,
            'floors' => 3,
            'status' => 'published',
            'is_featured' => true,
        ]);
    }
}
