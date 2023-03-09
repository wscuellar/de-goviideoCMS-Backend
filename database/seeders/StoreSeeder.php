<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Store;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $store = Store::create([
            'id' => '2c4c5a3b-5289-4b26-9cea-43b955bb1881',
            'name' => 'SEPIIA',
            'url' => 'https://sepiia.com/',
            'key' => '594f02d3b382bcc05878a10453e5dd82',
            'country_id' => 205,
            'state_id' => 3265,
            'city_id' => 38271,
            'timezone' => 'Europe/Madrid',
            'email' => 'test@test.com',
            'has_locations' => 1
        ]);
    }
}
