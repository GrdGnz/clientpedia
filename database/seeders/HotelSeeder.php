<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            DB::table('hotels')->insert([
                'code' => $faker->unique()->word,
                'name' => $faker->company.' Hotel',
                'address' => $faker->address,
                'city' => $faker->city,
                'state' => $faker->state,
                'country' => $faker->country,
                'route_id' => $faker->numberBetween(1, 2),
                'status_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}