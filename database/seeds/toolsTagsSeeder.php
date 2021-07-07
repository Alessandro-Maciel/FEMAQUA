<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class toolsTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tools_tags')->insert([
            'tool_id' => 1,
            'tag_id' => 1,
        ]);

        DB::table('tools_tags')->insert([
            'tool_id' => 1,
            'tag_id' => 2,
        ]);

        DB::table('tools_tags')->insert([
            'tool_id' => 1,
            'tag_id' => 3,
        ]);

        DB::table('tools_tags')->insert([
            'tool_id' => 1,
            'tag_id' => 4,
        ]);

        DB::table('tools_tags')->insert([
            'tool_id' => 1,
            'tag_id' => 5,
        ]);





        DB::table('tools_tags')->insert([
            'tool_id' => 2,
            'tag_id' => 6,
        ]);

        DB::table('tools_tags')->insert([
            'tool_id' => 2,
            'tag_id' => 7,
        ]);

        DB::table('tools_tags')->insert([
            'tool_id' => 2,
            'tag_id' => 8,
        ]);

        DB::table('tools_tags')->insert([
            'tool_id' => 2,
            'tag_id' => 9,
        ]);

        DB::table('tools_tags')->insert([
            'tool_id' => 2,
            'tag_id' => 10,
        ]);

        DB::table('tools_tags')->insert([
            'tool_id' => 2,
            'tag_id' => 11,
        ]);






        DB::table('tools_tags')->insert([
            'tool_id' => 3,
            'tag_id' => 12,
        ]);

        DB::table('tools_tags')->insert([
            'tool_id' => 3,
            'tag_id' => 13,
        ]);

        DB::table('tools_tags')->insert([
            'tool_id' => 3,
            'tag_id' => 9,
        ]);

        DB::table('tools_tags')->insert([
            'tool_id' => 3,
            'tag_id' => 15,
        ]);

        DB::table('tools_tags')->insert([
            'tool_id' => 3,
            'tag_id' => 16,
        ]);

        DB::table('tools_tags')->insert([
            'tool_id' => 3,
            'tag_id' => 17,
        ]);
    }
}
