<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$QePHJHLW1u0LcDJ/THkfJOBBYzdJmho5/Z31e3X1YGGkx/suaDGGu',
                'remember_token' => null,
                'created_at'     => '2019-09-29 06:35:27',
                'updated_at'     => '2019-09-29 06:35:27',
                'first_name'     => '',
                'last_name'      => '',
            ],
        ];

        User::insert($users);
    }
}
