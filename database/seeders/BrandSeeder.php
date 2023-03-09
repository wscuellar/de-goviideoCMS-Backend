<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brand = Brand::create([
            'store_id' => '2c4c5a3b-5289-4b26-9cea-43b955bb1881',
            'name' => 'SEPIIA MARCA',
            'status' => 1
            ]);
    }
}
