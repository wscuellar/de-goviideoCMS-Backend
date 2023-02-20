<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $location = Location::create([
            'store_id' => '2c4c5a3b-5289-4b26-9cea-43b955bb1881',
            'name' => 'SEPIIA CONCESIONARIO',
            'email' => 'test@test.com',
            'phone' => '34 456 555 9456',
            'address' => 'test2',
            'country_id' => 205,
            'state_id' => 3265,
            'city_id' => 38271,
            'description' => 'SEPIIA'
        ]);
    }
}
