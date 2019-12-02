<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        $data = [];

        for ($i = 2; $i <= 100; $i++) {

            $data[] = [
                'id'         => $i,
                'name'       => Str::random(5),
                'email'      => Str::random(10) . '@qq.com',
                'created_at' => \Carbon\Carbon::now(),
                'password'   => bcrypt('123456789'),
            ];
        }


        $data[] = [
            'id'         => 1,
            'name'       => 'test',
            'email'      => 'test@qq.com',
            'created_at' => \Carbon\Carbon::now(),
            'password'   => bcrypt('123456789'),
        ];

        DB::table('users')->insert($data);

        // 初始化用户角色，将 1 号用户指派为『站长』
        DB::table('user')->where('id', 1)->assignRole('Founder');

        // 将 2 号用户指派为『管理员』
        $user = DB::table('user')->where('id', 2)->first();
        $user->assignRole('Maintainer');
    }
}
