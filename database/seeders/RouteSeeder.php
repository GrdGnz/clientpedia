<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RouteSeeder extends Seeder
{
    public function run()
    {
        // Insert 'international' route with status 1
        DB::table('routes')->insert([
            'name' => 'international',
            'status_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert 'domestic' route with status 1
        DB::table('routes')->insert([
            'name' => 'domestic',
            'status_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
