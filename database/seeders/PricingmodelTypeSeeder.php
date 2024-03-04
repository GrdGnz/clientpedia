<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PricingmodelTypeSeeder extends Seeder
{
    public function run()
    {
        // Insert 'bundled' pricing model type with status 1
        DB::table('pricingmodel_types')->insert([
            'name' => 'bundled',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert 'unbundled' pricing model type with status 1
        DB::table('pricingmodel_types')->insert([
            'name' => 'unbundled',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
