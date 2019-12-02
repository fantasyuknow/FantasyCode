<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();

        $data = [
            [
                'id'          => 1,
                'name'        => 'PHP',
                'description' => 'PHP是世界上最好的语言',
                'user_id'     => 1,
            ],
            [
                'id'          => 2,
                'name'        => 'MySql',
                'description' => '',
                'user_id'     => 1,
            ],
            [
                'id'          => 3,
                'name'        => 'Linux',
                'description' => '',
                'user_id'     => 1,
            ],
            [
                'id'          => 4,
                'name'        => 'Html/Css/Js',
                'description' => '',
                'user_id'     => 1,
            ],
            [
                'id'          => 5,
                'name'        => 'GO',
                'description' => '',
                'user_id'     => 1,
            ],
            [
                'id'          => 6,
                'name'        => 'Nginx/Apache',
                'description' => '',
                'user_id'     => 1,
            ],
        ];

        DB::table('categories')->insert($data);
    }
}
