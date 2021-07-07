<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tagsSeeder extends Seeder
{

    public function run()
    {
        DB::table('tags')->insert([
            'id' => 1,
            'tag' => "organization",
        ]);

        DB::table('tags')->insert([
            'id' => 2,
            'tag' => "planning",
        ]);

        DB::table('tags')->insert([
            'id' => 3,
            'tag' => "collaboration",
        ]);

        DB::table('tags')->insert([
            'id' => 4,
            'tag' => "writing",
        ]);

        DB::table('tags')->insert([
            'id' => 5,
            'tag' => "calendar",
        ]);




        DB::table('tags')->insert([
            'id' => 6,
            'tag' => "api",
        ]);

        DB::table('tags')->insert([
            'id' => 7,
            'tag' => "json",
        ]);

        DB::table('tags')->insert([
            'id' => 8,
            'tag' => "schema",
        ]);

        DB::table('tags')->insert([
            'id' => 9,
            'tag' => "node",
        ]);

        DB::table('tags')->insert([
            'id' => 10,
            'tag' => "github",
        ]);

        DB::table('tags')->insert([
            'id' => 11,
            'tag' => "rest",
        ]);




        DB::table('tags')->insert([
            'id' => 12,
            'tag' => "web",
        ]);

        DB::table('tags')->insert([
            'id' => 13,
            'tag' => "framework",
        ]);

        DB::table('tags')->insert([
            'id' => 14,
            'tag' => "http2",
        ]);

        DB::table('tags')->insert([
            'id' => 15,
            'tag' => "https",
        ]);

        DB::table('tags')->insert([
            'id' => 16,
            'tag' => "localhost",
        ]);
    }
}
