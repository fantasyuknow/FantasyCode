<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('topics')->truncate();

        $categories = DB::table('categories')->pluck('id')->toArray();

        $data = [];

        for($i=1;$i<=100;$i++){

            $data[] = [
                 'category_id'=>array_rand($categories,1),
                'title'=>'测试文章'.rand(1,100),
                'user_id'=>random_int(1,100),
                'w_type'=>random_int(0,2),
                'body'=>'',
                'created_at'=>now()
            ];
        }

        DB::table('topics')->insert($data);
    }
}
