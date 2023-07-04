<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =
            [
                ['title' => 'boss'],
                ['title' => 'solider'],
                ['title' => 'king'],
                ['title' => 'knight'],
                ['title' => 'god'],
            ];
        DB::table('roles')->insert($data);
    }
}
