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
                'email'          => 'system@iotsd.io',
                'password'       => 'not_set',
                'remember_token' => null,
                'created_at'     => '2019-09-29 06:35:27',
                'updated_at'     => '2019-09-29 06:35:27',
                'first_name'     => 'System',
                'last_name'      => 'Account',
            ],
            [
                'id'             => 2,
                'email'          => 'trevor@iotsystemsdesign.com.au',
                'password'       => '$2y$10$cFIpf69GuAwALkK965sPOOE4056hnbEXro0Ptc8VMcykVBIWPzqiy',
                'remember_token' => null,
                'created_at'     => '2019-09-29 06:35:27',
                'updated_at'     => '2019-09-29 06:35:27',
                'first_name'     => 'Trevor',
                'last_name'      => 'van der Linden',
            ],
        ];


        User::insert($users);
    }
}
