<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SourcesSeeder extends Seeder
{
    public function run()
    {
        // Define the source names to be inserted
        $sourceNames = ['GDS', 'Non-GDS', 'OBT'];

        // Insert the source names into the 'sources' table
        foreach ($sourceNames as $name) {
            DB::table('sources')->insert([
                'name' => $name,
            ]);
        }
    }
}
