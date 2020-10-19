<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class QuestionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questioncategories')->insert([
            'name'=>'Networking',
            'slug'=>'networking',
        ]);

        DB::table('questioncategories')->insert([
            'name'=>'Database',
            'slug'=>'database',
        ]);

        DB::table('questioncategories')->insert([
            'name'=>'Algorithm',
            'slug'=>'algorithm',
        ]);

        DB::table('questioncategories')->insert([
            'name'=>'General',
            'slug'=>'general',
        ]);
    }
}