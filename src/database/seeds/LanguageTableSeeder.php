<?php

namespace Flobbos\Pagebuilder\database\seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Headline + Text
        DB::table('languages')->insert([
            'name' => 'Deutsch',
            'locale' => 'de',
        ]);
    }
}
