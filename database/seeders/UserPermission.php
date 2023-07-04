<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserPermission extends Seeder
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
                'role_id' => 1,
                'permission' => 'editPage',
                'dependency' => ''
            ],
            [
                'role_id' => 1,
                'permission' => 'watchPage',
                'dependency' => ''
            ],
            [
                'role_id' => 1,
                'permission' => 'deletePage',
                'dependency' => ''
            ],
            [
                'role_id' => 2,
                'permission' => 'watchPage',
                'dependency' => ''
            ],
            [
                'role_id' => 3,
                'permission' => 'deletePage',
                'dependency' => ''
            ],
            [
                'role_id' => 4,
                'permission' => 'editPage',
                'dependency' => ''
            ],
        ];
        DB::table('permissions')->insert($data);
    }
}
