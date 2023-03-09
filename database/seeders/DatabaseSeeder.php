<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model as Eloquent;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        Schema::disableForeignKeyConstraints();

        $this->call(AdminUserSeeder::class);
        $this->call(CitiesSeeder::class);
        $this->call(StoreSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(LocationSeeder::class);
        $this->call(BrandLocationSeeder::class);
    }
}
