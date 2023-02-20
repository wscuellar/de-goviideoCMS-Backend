<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BrandLocation;

class BrandLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brandlocation = BrandLocation::create([
            'brand_id' => 1,
            'location_id' => 1
        ]);
    }
}
