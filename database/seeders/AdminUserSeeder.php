<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::create(['name' => 'admin']);
        $storeRole = Role::create(['name' => 'store']);
        $permission = Permission::create(['name' => 'sys-admin']);
        $permission->assignRole($adminRole);
        $permissionStore= Permission::create(['name' => 'store-admin']);
        $permissionStore->assignRole($storeRole);

        $adminUser = User::create([
            'name' => 'Oscar Lobo',
            'type' => 'admin',
            'status' => 1,
            'email' => 'oscar.lobo@dckstudios.com',
            'password' => bcrypt('123456'),
            'profile_photo_path' =>fake()->imageUrl($width = 640, $height = 480)

        ])->assignRole('admin');

        $adminUser = User::create([
            'name' => 'Admin',
            'type' => 'admin',
            'status' => 1,
            'email' => 'admin@dckstudios.com',
            'password' => bcrypt('123456'),
            'profile_photo_path' =>fake()->imageUrl($width = 640, $height = 480)

        ])->assignRole('admin');

        $storeUser = User::create([
            'name' => 'Ronald Alfonzo',
            'type' => 'store',
            'status' => 1,
            'email' => 'ronald.alfonzo@dckstudios.com',
            'store_id' => '2c4c5a3b-5289-4b26-9cea-43b955bb1881',
            'password' => bcrypt('123456'),
            'profile_photo_path' =>fake()->imageUrl($width = 640, $height = 480)
        ])->assignRole('store');

        $clientUser = User::create([
            'name' => 'Manuel Torres',
            'type' => 'store',
            'status' => 1,
            'email' => 'manuel.torres@dckstudios.com',
            'store_id' => '2c4c5a3b-5289-4b26-9cea-43b955bb1881',
            'password' => bcrypt('123456'),
            'profile_photo_path' =>fake()->imageUrl($width = 640, $height = 480)

        ])->assignRole('store');

        $clientUser = User::create([
            'name' => 'Javier Molina',
            'type' => 'store',
            'status' => 1,
            'email' => 'javier.molina@dckstudios.com',
            'store_id' => '2c4c5a3b-5289-4b26-9cea-43b955bb1881',
            'password' => bcrypt('123456'),
            'profile_photo_path' =>fake()->imageUrl($width = 640, $height = 480)

        ])->assignRole('store');


        $clientUser = User::create([
            'name' => 'Demo',
            'type' => 'store',
            'status' => 1,
            'store_id' => '2c4c5a3b-5289-4b26-9cea-43b955bb1881',
            'email' => 'demo@dckstudios.com',
            'password' => bcrypt('123456'),
            'profile_photo_path' =>fake()->imageUrl($width = 640, $height = 480)

        ])->assignRole('store');

        //User::factory(20)->create()->each(function(User $user) {
        //    $user->assignRole('client');
        //});

    }

    //https://laravel-news.com/jetstream-spatie-permission
}
