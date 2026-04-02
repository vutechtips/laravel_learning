<?php

namespace Database\Seeders;

use App\Models\PropertyType;
use Illuminate\Database\Seeder;

class PropertyTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['name' => 'Nhà đất', 'slug' => 'nha-dat', 'icon' => 'fa-home', 'sort_order' => 1],
            ['name' => 'Căn hộ', 'slug' => 'can-ho', 'icon' => 'fa-building', 'sort_order' => 2],
            ['name' => 'Mặt bằng', 'slug' => 'mat-bang', 'icon' => 'fa-store', 'sort_order' => 3],
            ['name' => 'Đất nền', 'slug' => 'dat-nen', 'icon' => 'fa-map-marked-alt', 'sort_order' => 4],
            ['name' => 'Biệt thự', 'slug' => 'biet-thu', 'icon' => 'fa-home-lg', 'sort_order' => 5],
            ['name' => 'Nhà phố', 'slug' => 'nha-pho', 'icon' => 'fa-city', 'sort_order' => 6],
        ];

        foreach ($types as $type) {
            PropertyType::create([
                'name' => $type['name'],
                'slug' => $type['slug'],
                'icon' => $type['icon'],
                'sort_order' => $type['sort_order'],
                'is_active' => true,
            ]);
        }
    }
}
