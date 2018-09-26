<?php

namespace Flobbos\Pagebuilder\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ElementTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        //Headline + Text
        DB::table('element_types')->insert([
            'name' => 'Headline + Text',
            'component' => 'v-headline-text',
            'icon' => 'text-icon',
            'sorting' => 1
        ]);
        //Text component
        DB::table('element_types')->insert([
            'name' => 'Text',
            'component' => 'v-text',
            'icon' => 'text-icon',
            'sorting' => 2
        ]);
        //Photo + Description
        DB::table('element_types')->insert([
            'name' => 'Photo + Description',
            'component' => 'v-photo-description',
            'icon' => 'text-icon',
            'sorting' => 3
        ]);
    }
}
