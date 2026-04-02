<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        // Thành phố Hồ Chí Minh
        $hcm = Location::create([
            'name' => 'TP. Hồ Chí Minh',
            'slug' => 'tp-ho-chi-minh',
            'type' => 'city',
            'is_active' => true,
        ]);

        // Hà Nội
        $hn = Location::create([
            'name' => 'Hà Nội',
            'slug' => 'ha-noi',
            'type' => 'city',
            'is_active' => true,
        ]);

        // Đà Nẵng
        $dn = Location::create([
            'name' => 'Đà Nẵng',
            'slug' => 'da-nang',
            'type' => 'city',
            'is_active' => true,
        ]);

        // Các quận TPHCM (optional - để test sau)
        $q1 = Location::create([
            'name' => 'Quận 1',
            'slug' => 'quan-1',
            'type' => 'district',
            'parent_id' => $hcm->id,
            'is_active' => true,
        ]);

        $q7 = Location::create([
            'name' => 'Quận 7',
            'slug' => 'quan-7',
            'type' => 'district',
            'parent_id' => $hcm->id,
            'is_active' => true,
        ]);
    }
}
