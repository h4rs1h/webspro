<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userData = [
            [
                'id' => '1',
                'name' => 'Mas administrator',
                'email' => 'admin@gmail.com',
                'role_id' => '1',
                'password' => bcrypt('123456')
            ],
            [
                'id' => '2',
                'name' => 'Mas Billing',
                'email' => 'billing@gmail.com',
                'role_id' => '2',
                'password' => bcrypt('123456')
            ],
            [
                'id' => '3',
                'name' => 'Mas Collection',
                'email' => 'Collection@gmail.com',
                'role_id' => '3',
                'password' => bcrypt('123456')
            ],
            [
                'id' => '4',
                'name' => 'Mas Tenant Relation 1',
                'email' => 'rere1@gmail.com',
                'role_id' => '4',
                'password' => bcrypt('123456')
            ],
            [
                'id' => '5',
                'name' => 'Mas Tenant Relation 2',
                'email' => 'rere2@gmail.com',
                'role_id' => '5',
                'password' => bcrypt('123456')
            ]
        ];
        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}
