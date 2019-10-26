<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            [
                'id'    => '2',
                'title' => 'permission_create',
            ],
            [
                'id'    => '3',
                'title' => 'permission_edit',
            ],
            [
                'id'    => '4',
                'title' => 'permission_show',
            ],
            [
                'id'    => '5',
                'title' => 'permission_delete',
            ],
            [
                'id'    => '6',
                'title' => 'permission_access',
            ],
            [
                'id'    => '7',
                'title' => 'role_create',
            ],
            [
                'id'    => '8',
                'title' => 'role_edit',
            ],
            [
                'id'    => '9',
                'title' => 'role_show',
            ],
            [
                'id'    => '10',
                'title' => 'role_delete',
            ],
            [
                'id'    => '11',
                'title' => 'role_access',
            ],
            [
                'id'    => '12',
                'title' => 'user_create',
            ],
            [
                'id'    => '13',
                'title' => 'user_edit',
            ],
            [
                'id'    => '14',
                'title' => 'user_show',
            ],
            [
                'id'    => '15',
                'title' => 'user_delete',
            ],
            [
                'id'    => '16',
                'title' => 'user_access',
            ],
            [
                'id'    => '17',
                'title' => 'infeed_create',
            ],
            [
                'id'    => '18',
                'title' => 'infeed_edit',
            ],
            [
                'id'    => '19',
                'title' => 'infeed_show',
            ],
            [
                'id'    => '20',
                'title' => 'infeed_delete',
            ],
            [
                'id'    => '21',
                'title' => 'infeed_access',
            ],
            [
                'id'    => '22',
                'title' => 'tplink_create',
            ],
            [
                'id'    => '23',
                'title' => 'tplink_edit',
            ],
            [
                'id'    => '24',
                'title' => 'tplink_show',
            ],
            [
                'id'    => '25',
                'title' => 'tplink_delete',
            ],
            [
                'id'    => '26',
                'title' => 'tplink_access',
            ],
            [
                'id'    => '27',
                'title' => 'tplink_device_create',
            ],
            [
                'id'    => '28',
                'title' => 'tplink_device_edit',
            ],
            [
                'id'    => '29',
                'title' => 'tplink_device_show',
            ],
            [
                'id'    => '30',
                'title' => 'tplink_device_delete',
            ],
            [
                'id'    => '31',
                'title' => 'tplink_device_access',
            ],
            [
                'id'    => '32',
                'title' => 'config_create',
            ],
            [
                'id'    => '33',
                'title' => 'config_edit',
            ],
            [
                'id'    => '34',
                'title' => 'config_show',
            ],
            [
                'id'    => '35',
                'title' => 'config_delete',
            ],
            [
                'id'    => '36',
                'title' => 'config_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
