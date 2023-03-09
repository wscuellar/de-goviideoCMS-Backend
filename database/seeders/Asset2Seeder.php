<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Asset2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('assets')->insert($this->background);
    }

    private $background = [
        ['type' => 'background', 'uuid'=> 'user.205f41e1-ab9a-4142-8f92-4b49ead8258d', 'name' => 'Oficina 1',   'attribute' => 'background',    'url' => 'image/synthesia/background/Fondo-1.jpg'],
        ['type' => 'background', 'uuid'=> 'user.fafdabed-3648-431e-831f-f78395a1a291', 'name' => 'Oficina 2',   'attribute' => 'background',    'url' => 'image/synthesia/background/Fondo-2.jpg'],
        ['type' => 'background', 'uuid'=> 'user.63c5cf30-a72a-483a-b9bb-bb2488912aba', 'name' => 'Oficina 3',   'attribute' => 'background',    'url' => 'image/synthesia/background/Fondo-3.jpg'],
        ['type' => 'background', 'uuid'=> 'user.91820bab-a4f7-4a72-87bc-e53f7b48eee5', 'name' => 'Oficina 4',   'attribute' => 'background',    'url' => 'image/synthesia/background/Fondo-4.jpg'],
        ['type' => 'background', 'uuid'=> 'user.4be13b27-abb7-4ea6-90c9-48b813547487', 'name' => 'Oficina 5',   'attribute' => 'background',    'url' => 'image/synthesia/background/Fondo-5.jpg'],
    ];
}
