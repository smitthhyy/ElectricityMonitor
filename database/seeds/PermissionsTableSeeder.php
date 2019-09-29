<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'         => '1',
                'title'      => 'user_management_access',
                'created_at' => '2019-09-29 06:54:56',
                'updated_at' => '2019-09-29 06:54:56',
            ],
            [
                'id'         => '2',
                'title'      => 'permission_create',
                'created_at' => '2019-09-29 06:54:56',
                'updated_at' => '2019-09-29 06:54:56',
            ],
            [
                'id'         => '3',
                'title'      => 'permission_edit',
                'created_at' => '2019-09-29 06:54:56',
                'updated_at' => '2019-09-29 06:54:56',
            ],
            [
                'id'         => '4',
                'title'      => 'permission_show',
                'created_at' => '2019-09-29 06:54:56',
                'updated_at' => '2019-09-29 06:54:56',
            ],
            [
                'id'         => '5',
                'title'      => 'permission_delete',
                'created_at' => '2019-09-29 06:54:56',
                'updated_at' => '2019-09-29 06:54:56',
            ],
            [
                'id'         => '6',
                'title'      => 'permission_access',
                'created_at' => '2019-09-29 06:54:56',
                'updated_at' => '2019-09-29 06:54:56',
            ],
            [
                'id'         => '7',
                'title'      => 'role_create',
                'created_at' => '2019-09-29 06:54:56',
                'updated_at' => '2019-09-29 06:54:56',
            ],
            [
                'id'         => '8',
                'title'      => 'role_edit',
                'created_at' => '2019-09-29 06:54:56',
                'updated_at' => '2019-09-29 06:54:56',
            ],
            [
                'id'         => '9',
                'title'      => 'role_show',
                'created_at' => '2019-09-29 06:54:56',
                'updated_at' => '2019-09-29 06:54:56',
            ],
            [
                'id'         => '10',
                'title'      => 'role_delete',
                'created_at' => '2019-09-29 06:54:56',
                'updated_at' => '2019-09-29 06:54:56',
            ],
            [
                'id'         => '11',
                'title'      => 'role_access',
                'created_at' => '2019-09-29 06:54:56',
                'updated_at' => '2019-09-29 06:54:56',
            ],
            [
                'id'         => '12',
                'title'      => 'user_create',
                'created_at' => '2019-09-29 06:54:56',
                'updated_at' => '2019-09-29 06:54:56',
            ],
            [
                'id'         => '13',
                'title'      => 'user_edit',
                'created_at' => '2019-09-29 06:54:56',
                'updated_at' => '2019-09-29 06:54:56',
            ],
            [
                'id'         => '14',
                'title'      => 'user_show',
                'created_at' => '2019-09-29 06:54:56',
                'updated_at' => '2019-09-29 06:54:56',
            ],
            [
                'id'         => '15',
                'title'      => 'user_delete',
                'created_at' => '2019-09-29 06:54:56',
                'updated_at' => '2019-09-29 06:54:56',
            ],
            [
                'id'         => '16',
                'title'      => 'user_access',
                'created_at' => '2019-09-29 06:54:56',
                'updated_at' => '2019-09-29 06:54:56',
            ],
            [
                'id'         => '17',
                'title'      => 'infeed_create',
                'created_at' => '2019-09-29 06:54:56',
                'updated_at' => '2019-09-29 06:54:56',
            ],
            [
                'id'         => '18',
                'title'      => 'infeed_edit',
                'created_at' => '2019-09-29 06:54:56',
                'updated_at' => '2019-09-29 06:54:56',
            ],
            [
                'id'         => '19',
                'title'      => 'infeed_show',
                'created_at' => '2019-09-29 06:54:56',
                'updated_at' => '2019-09-29 06:54:56',
            ],
            [
                'id'         => '20',
                'title'      => 'infeed_delete',
                'created_at' => '2019-09-29 06:54:56',
                'updated_at' => '2019-09-29 06:54:56',
            ],
            [
                'id'         => '21',
                'title'      => 'infeed_access',
                'created_at' => '2019-09-29 06:54:56',
                'updated_at' => '2019-09-29 06:54:56',
            ],
            [
                'id'         => '22',
                'title'      => 'tplink_create',
                'created_at' => '2019-09-29 06:54:56',
                'updated_at' => '2019-09-29 06:54:56',
            ],
            [
                'id'         => '23',
                'title'      => 'tplink_edit',
                'created_at' => '2019-09-29 06:54:56',
                'updated_at' => '2019-09-29 06:54:56',
            ],
            [
                'id'         => '24',
                'title'      => 'tplink_show',
                'created_at' => '2019-09-29 06:54:56',
                'updated_at' => '2019-09-29 06:54:56',
            ],
            [
                'id'         => '25',
                'title'      => 'tplink_delete',
                'created_at' => '2019-09-29 06:54:56',
                'updated_at' => '2019-09-29 06:54:56',
            ],
            [
                'id'         => '26',
                'title'      => 'tplink_access',
                'created_at' => '2019-09-29 06:54:56',
                'updated_at' => '2019-09-29 06:54:56',
            ],
            [
                'id'         => '27',
                'title'      => 'tplink_device_create',
                'created_at' => '2019-09-29 06:54:56',
                'updated_at' => '2019-09-29 06:54:56',
            ],
            [
                'id'         => '28',
                'title'      => 'tplink_device_edit',
                'created_at' => '2019-09-29 06:54:56',
                'updated_at' => '2019-09-29 06:54:56',
            ],
            [
                'id'         => '29',
                'title'      => 'tplink_device_show',
                'created_at' => '2019-09-29 06:54:56',
                'updated_at' => '2019-09-29 06:54:56',
            ],
            [
                'id'         => '30',
                'title'      => 'tplink_device_delete',
                'created_at' => '2019-09-29 06:54:56',
                'updated_at' => '2019-09-29 06:54:56',
            ],
            [
                'id'         => '31',
                'title'      => 'tplink_device_access',
                'created_at' => '2019-09-29 06:54:56',
                'updated_at' => '2019-09-29 06:54:56',
            ],
        ];

        Permission::insert($permissions);
    }
}
