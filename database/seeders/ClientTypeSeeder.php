<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientTypeSeeder extends Seeder
{
    public function run()
    {
        $clientTypes = [
            ['name' => 'Corporate'],
            ['name' => 'Leisure'],
            ['name' => 'Walk-In'],
        ];

        DB::table('client_types')->insert($clientTypes);
    }
}
