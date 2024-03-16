<?php

namespace Database\Seeders;

use App\Models\role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyRolesSeeder extends Seeder
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
                'level' => 'Administrator',
                'no_wa' => null,
                'api_key' => null,
                'api_key_number' => null,
                'api_endpoin_url' => null
            ],
            [
                'id' => '2',
                'level' => 'Billing',
                'no_wa' => '081211803116',
                'api_key' => '9UFY6ANHMZO3RU8U',
                'api_key_number' => 'nfCPEI3Xdz3YLU74',
                'api_endpoin_url' => 'https://api.watzap.id/v1/'
            ],
            [
                'id' => '3',
                'level' => 'Collection',
                'no_wa' => '081211803116',
                'api_key' => '9UFY6ANHMZO3RU8U',
                'api_key_number' => 'nfCPEI3Xdz3YLU74',
                'api_endpoin_url' => 'https://api.watzap.id/v1/'
            ],
            [
                'id' => '4',
                'level' => 'Rere',
                'no_wa' => '081211803116',
                'api_key' => '9UFY6ANHMZO3RU8U',
                'api_key_number' => 'nfCPEI3Xdz3YLU74',
                'api_endpoin_url' => 'https://api.watzap.id/v1/'
            ],
            [
                'id' => '5',
                'level' => 'Rere 2',
                'no_wa' => '081211803116',
                'api_key' => '9UFY6ANHMZO3RU8U',
                'api_key_number' => 'nfCPEI3Xdz3YLU74',
                'api_endpoin_url' => 'https://api.watzap.id/v1/'
            ],

        ];
        foreach ($userData as $key => $val) {
            role::create($val);
        }
    }
}
