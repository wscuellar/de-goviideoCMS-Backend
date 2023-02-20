<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('assets')
            ->where('type', 'voice')
            ->delete();

        DB::table('assets')->insert($this->voices);


        DB::table('assets')
        ->where('type', 'avatar')
        ->delete();

        DB::table('assets')->insert($this->avatars);

        DB::table('assets')
        ->where('type', 'background')
        ->delete();

        DB::table('assets')->insert($this->background);

        DB::table('assets')
        ->where('type', 'other')
        ->delete();

        DB::table('assets')->insert($this->soundtrack);
    }

    private $voices = [
        ['icon' => 'image/synthesia/icon/spain.svg', 'type' => 'voice', 'name' => 'Spanish (ES) - Natural',	        'attribute' => 'male',	    'uuid' => '09a6e312-4635-4e54-876b-ba993e59aa7b', 'url' => 'media/voz/male_natural_09a6e312-4635-4e54-876b-ba993e59aa7b.mp3'],
        ['icon' => 'image/synthesia/icon/spain.svg', 'type' => 'voice', 'name' => 'Spanish (ES) - Natural Deep',	'attribute' => 'male',	    'uuid' => '410faf5b-50ff-485f-80cc-a748a8f4f83a', 'url' => 'media/voz/male_natural_09a6e312-4635-4e54-876b-ba993e59aa7b.mp3'],
        ['icon' => 'image/synthesia/icon/spain.svg', 'type' => 'voice', 'name' => 'Spanish (ES) - Original',	    'attribute' => 'male',	    'uuid' => '88f50816-481b-47d2-bd73-81858db57f5e', 'url' => 'media/voz/male_natural_original_88f50816-481b-47d2-bd73-81858db57f5e.mp3'],
        ['icon' => 'image/synthesia/icon/spain.svg', 'type' => 'voice', 'name' => 'Spanish (ES) - Natural 2',	    'attribute' => 'female',	'uuid' => '7172ad84-d429-446a-881d-e0be31de66ce', 'url' => 'media/voz/natural2_female_7172ad84-d429-446a-881d-e0be31de66ce.mp3'],
        ['icon' => 'image/synthesia/icon/spain.svg', 'type' => 'voice', 'name' => 'Spanish (ES) - Natural',	        'attribute' => 'female',	'uuid' => '86356921-e78b-4552-ae83-fc51960968de', 'url' => 'media/voz/natural_female_86356921-e78b-4552-ae83-fc51960968de.mp3'],
        ['icon' => 'image/synthesia/icon/spain.svg', 'type' => 'voice', 'name' => 'Spanish (ES) - Original',	    'attribute' => 'female',	'uuid' => 'ced2bcf3-acd2-41a2-9815-6b61ae8b61e9', 'url' => 'media/voz/original_female_ced2bcf3-acd2-41a2-9815-6b61ae8b61e9.mp3'],
        ['icon' => 'image/synthesia/icon/catalan.svg', 'type' => 'voice', 'name' => 'Catalan - Natural',	    'attribute' => 'female',	'uuid' => 'fc1e78a7-806c-4c92-8418-5f90a169c618', 'url' => 'media/voz/famele_natural_catalan_fc1e78a7-806c-4c92-8418-5f90a169c618.mp3'],
        ['icon' => 'image/synthesia/icon/catalan.svg', 'type' => 'voice', 'name' => 'Catalan - Natural',	    'attribute' => 'male',	'uuid' => 'f1a27f14-c5cf-4f97-a329-0096ee94a356', 'url' => 'media/voz/famele_natural_catalan_fc1e78a7-806c-4c92-8418-5f90a169c618.mp3'],
        ['icon' => 'image/synthesia/icon/spain.svg', 'type' => 'voice', 'name' => 'Spanish (ES) - Natural Young',   'attribute' => 'male',      'uuid' => 'b1880919-ca15-499f-ae3f-92d31cd1b496', 'url' => 'media/voz/male_natural_young_b1880919-ca15-499f-ae3f-92d31cd1b496.mp3'],
    ];

    private $soundtrack = [
        ['type' => 'other', 'name' => 'Corporate',	        'uuid' => 'corporate'],
        ['type' => 'other', 'name' => 'Inspirational',	    'uuid' => 'inspirational'],
        ['type' => 'other', 'name' => 'Modern',	            'uuid' => 'modern'],
        ['type' => 'other', 'name' => 'Urban',	            'uuid' => 'urban'],
    ];

    private $avatars = [
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/andy.png', 'name' => 'Andy',    	'attribute' => 'male', 'uuid' => 'c75d4980-06a6-4710-ab2b-0311e225d399'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/anna.png', 'name' => 'Anna',    	'attribute' => 'female', 'uuid' => 'anna_costume1_cameraA'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/bridget1.png', 'name' => 'Bridget', 	'attribute' => 'female', 'uuid' => 'bridget_costume1_cameraA'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/bridget2.png', 'name' => 'Bridget', 	'attribute' => 'female', 'uuid' => 'bridget_costume2_cameraA'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/christina.jpg', 'name' => 'Christina', 'attribute' => 'female', 'uuid' => '	11b26380-ed22-490b-8ccb-afb34559bc99'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/dave1.jpg', 'name' => 'Dave',    	'attribute' => 'male', 'uuid' => 'dave_costume1_cameraA'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/dave2.jpg', 'name' => 'Dave',    	'attribute' => 'male', 'uuid' => 'dave_costume2_cameraA'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/isabella1.jpg', 'name' => 'Isabella',	'attribute' => 'female', 'uuid' => 'isabella_costume1_cameraA'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/isabella2.jpg', 'name' => 'Isabella',	'attribute' => 'female', 'uuid' => 'isabella_costume2_cameraA'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/jack1.jpg', 'name' => 'Jack',    	'attribute' => 'male', 'uuid' => 'jack_costume1_cameraA'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/jack2.jpg', 'name' => 'Jack',    	'attribute' => 'male', 'uuid' => 'jack_costume2_cameraA'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/james.jpg', 'name' => 'James',   	'attribute' => 'male', 'uuid' => 'james_costume1_cameraA'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/jenny.jpg', 'name' => 'Jenny',   	'attribute' => 'female', 'uuid' => '22a9959b-6bd5-4200-9dc2-bb2dffffdf48'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/jonathan.jpg', 'name' => 'Jonathan',	'attribute' => 'male', 'uuid' => 'jonathan_costume1_cameraA'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/kennet.jpg', 'name' => 'Kenneth', 	'attribute' => 'male', 'uuid' => 'kenneth_costume1_cameraA'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/laura.jpg', 'name' => 'Laura',   	'attribute' => 'female', 'uuid' => 'laura_costume1_cameraA'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/mallory1.jpg', 'name' => 'Mallory', 	'attribute' => 'female', 'uuid' => 'mallory_costume1_cameraA'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/mallory2.jpg', 'name' => 'Mallory', 	'attribute' => 'female', 'uuid' => 'mallory_costume2_cameraA'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/marcus.jpg', 'name' => 'Marcus',  	'attribute' => 'male', 'uuid' => 'marcus_costume1_cameraA'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/mary1.jpg', 'name' => 'Mary',    	'attribute' => 'female', 'uuid' => 'mary_costume1_cameraA'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/mary2.jpg', 'name' => 'Mary',    	'attribute' => 'female', 'uuid' => 'mary_costume2_cameraA'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/matthew1.jpg', 'name' => 'Matthew', 	'attribute' => 'male', 'uuid' => 'matthew_costume1_cameraA'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/matthew2.jpg', 'name' => 'Matthew', 	'attribute' => 'male', 'uuid' => 'matthew_costume2_cameraA'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/mia1.jpg', 'name' => 'Mia',     	'attribute' => 'female', 'uuid' => 'mia_costume1_cameraA'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/mia2.jpg', 'name' => 'Mia',     	'attribute' => 'female', 'uuid' => 'mia_costume2_cameraA'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/mike1.jpg', 'name' => 'Mike',    	'attribute' => 'male', 'uuid' => 'mike_costume1_cameraA'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/mike2.jpg', 'name' => 'Mike',    	'attribute' => 'male', 'uuid' => 'mike_costume2_cameraA'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/nina.jpg', 'name' => 'Nina',    	'attribute' => 'female', 'uuid' => 'nina_costume1_cameraA'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/paul.jpg', 'name' => 'Paul',    	'attribute' => 'male', 'uuid' => 'ea86aeb9-13d3-4ae8-8d09-f0f5f4a4ac11'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/quharrison.jpg', 'name' => 'QuHarrison','attribute' => 'male', 'uuid' => 'quharrison'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/richard.jpg', 'name' => 'Richard', 	'attribute' => 'male', 'uuid' => 'richard_costume1_cameraA'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/ruby.jpg', 'name' => 'Ruby',    	'attribute' => 'female', 'uuid' => 'ruby_costume1_cameraA'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/santa1.jpg', 'name' => 'Santa',   	'attribute' => 'male', 'uuid' => 'santa_costume1_cameraA'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/santa2.jpg', 'name' => 'Santa',   	'attribute' => 'male', 'uuid' => 'santa_costume2_cameraA'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/sofia1.jpg', 'name' => 'Sofia',   	'attribute' => 'female', 'uuid' => 'sofia_costume1_cameraA'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/sofia2.jpg', 'name' => 'Sofia',   	'attribute' => 'female', 'uuid' => 'sofia_costume2_cameraA'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/sonia1.jpg', 'name' => 'Sonia',   	'attribute' => 'female', 'uuid' => 'sonia_costume1_cameraA'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/sonia2.jpg', 'name' => 'Sonia',   	'attribute' => 'female', 'uuid' => 'sonia_costume2_cameraA'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/veronika.jpg', 'name' => 'Veronika',	'attribute' => 'female', 'uuid' => 'veronika_costume1_cameraA'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/vincent1.jpg', 'name' => 'Vincent', 	'attribute' => 'male', 'uuid' => 'vincent_costume1_cameraA'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/vincent2.jpg', 'name' => 'Vincent', 	'attribute' => 'male', 'uuid' => 'vincent_costume2_cameraA'],
        ['type' => 'avatar', 'url' => 'image/synthesia/avatar/yasmin.jpg', 'name' => 'Yasmin',  	'attribute' => 'female', 'uuid' => '1c5584a3-cb65-4b8a-ab32-a91cea54c7a0']
    ];

    private $background = [
        ['type' => 'background', 'uuid'=> 'synthesia.baa5545d-d9b2-4082-b561-35f0e158dba5', 'name' => 'Luxury lobby',   'attribute' => 'background',    'url' => 'image/synthesia/background/baa5545d-d9b2-4082-b561-35f0e158dba5-preview.png'],
        ['type' => 'background', 'uuid'=> 'pexels-videos.2759477',                          'name' => 'Tunel Motion',   'attribute' => 'video',         'url' => 'image/synthesia/background/free-video-2759477.jpeg'],
        ['type' => 'background', 'uuid'=> 'synthesia.8ba65bf6-55cb-4592-bd37-c16d04ec8b40', 'name' => 'Green screen',   'attribute' => 'color',         'url' => 'image/synthesia/background/8ba65bf6-55cb-4592-bd37-c16d04ec8b40-preview.png'],
        ['type' => 'background', 'uuid'=> 'synthesia.88bb3d32-912f-440e-b745-1a6cc44f11b9', 'name' => 'Mi pelicula 15', 'attribute' => 'video',         'url' => 'image/synthesia/background/42511196-02b4-4453-8d05-5d390e62d4da-thumb.jpeg'],
        ['type' => 'background', 'uuid'=> 'synthesia.ed331272-7e11-4d8a-b8f6-7b1d2fbe7829', 'name' => 'Off-white',      'attribute' => 'color',         'url' => 'image/synthesia/background/ed331272-7e11-4d8a-b8f6-7b1d2fbe7829-preview.png'],
        ['type' => 'background', 'uuid'=> 'white_studio', 'name' => 'White studio',      'attribute' => 'background',         'url' => 'image/synthesia/background/white_studio.png'],
        ['type' => 'background', 'uuid'=> 'white_cafe', 'name' => 'White cafe',      'attribute' => 'background',         'url' => 'image/synthesia/background/white_cafe.png'],
        ['type' => 'background', 'uuid'=> 'large_window', 'name' => 'Large window',      'attribute' => 'background',         'url' => 'image/synthesia/background/large_window.png'],
        ['type' => 'background', 'uuid'=> 'white_meeting_room', 'name' => 'White meeting room',      'attribute' => 'background',         'url' => 'image/synthesia/background/white_meeting_room.png'],
        ['type' => 'background', 'uuid'=> 'open_office', 'name' => 'Open office',      'attribute' => 'background',         'url' => 'image/synthesia/background/open_office.png']
    ];

}
