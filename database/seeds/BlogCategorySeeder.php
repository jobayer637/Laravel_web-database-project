<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blogcategories')->insert([
            'name'=>'Networking',
            'slug'=>'networking',
        ]);

        DB::table('blogcategories')->insert([
            'name'=>'Database',
            'slug'=>'database',
        ]);

        DB::table('blogcategories')->insert([
            'name'=>'Algorithm',
            'slug'=>'algorithm',
        ]);

        DB::table('blogcategories')->insert([
            'name'=>'General',
            'slug'=>'general',
        ]);
    }
}
