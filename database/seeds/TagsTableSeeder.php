<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            [
                'name'        => 'PHP',
            ],
            [
                'name'        => 'MySql',
            ],
            [
                'name'        => 'Linux',
            ],
            [
                'name'        => '诗文',
            ],
            [
                'name'        => '远方',
            ],
        ];

        DB::table('tags')->insert($data);
    }
}
