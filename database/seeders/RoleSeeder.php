<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name' => 'admin',
                'permissions' => json_encode([
                    'create-product' => true,
                    'update-product' => true,
                    'delete-product' => true,
                    'update-user' => true,
                    'delete-user' => true,
                ], true),
            ],
            [
                'name' => 'user',
                'permissions' => json_encode([
                    'create-product' => true,
                    'update-product' => true,
                    'delete-product' => true,
                    'update-user' => true,
                    'delete-user' => true,
                ], true)
            ]
        ]);
    }
}
