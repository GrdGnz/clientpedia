<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ClientVipSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Define VIP designations
        $positions = ['General Manager', 'Chairman', 'CEO', 'President', 'Vice President'];
        // Create unique contacts
        $vips = [];

        for ($i = 0; $i < 50; $i++) { // Adjust the number of contacts as needed
            $name = $faker->unique()->name;
            $email = $faker->unique()->safeEmail;
            $contactNumber = $faker->unique()->phoneNumber;
            $designation = $faker->randomElement($positions);

            $vips[] = [
                'name' => $name,
                'client_id' => rand(1, 20), // Replace with the appropriate client IDs
                'designation' => $designation,
                'contact_number' => $contactNumber,
                'email' => $email,
                'birthday' => $faker->date,
                'remarks' => $faker->text,
                'status_id' => 1, // Replace with the appropriate status IDs
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert the generated contacts into the database
        DB::table('client_vips')->insert($vips);
    }
}
