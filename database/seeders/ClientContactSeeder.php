<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ClientContactSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Define an array of travel agency positions and departments
        $positions = [
            ['designation' => 'Manager', 'department' => 'Management'],
            ['designation' => 'Sales Agent', 'department' => 'Sales'],
            ['designation' => 'Travel Consultant', 'department' => 'Consulting'],
            ['designation' => 'Customer Service Representative', 'department' => 'Customer Service'],
        ];

        // Create unique contacts
        $contacts = [];

        for ($i = 0; $i < 50; $i++) { // Adjust the number of contacts as needed
            $name = $faker->unique()->name;
            $email = $faker->unique()->safeEmail;
            $contactNumber = $faker->unique()->phoneNumber;
            $position = $faker->randomElement($positions);

            $contacts[] = [
                'name' => $name,
                'client_id' => rand(1, 20), // Replace with the appropriate client IDs
                'designation' => $position['designation'],
                'department' => $position['department'], // Added department field
                'contact_landline' => $contactNumber,
                'contact_mobile' => $contactNumber,
                'email' => $email,
                'birthday' => $faker->date,
                'remarks' => $faker->text,
                'status_id' => 1, // Replace with the appropriate status IDs
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert the generated contacts into the database
        DB::table('client_contacts')->insert($contacts);
    }
}
