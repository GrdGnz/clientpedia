<?php

namespace Database\Factories;

use App\Models\ClientContacts;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class ClientContactsFactory extends Factory
{
    protected $model = ClientContacts::class;

    public function definition(Faker $faker)
    {
        return [
            'client_id' => rand(1, 10), // Adjust as needed
            'name' => $faker->name,
            'designation' => $faker->jobTitle,
            'contact_number' => $faker->phoneNumber,
            'email' => $faker->unique()->safeEmail,
            'birthday' => $faker->date,
            'remarks' => $faker->text,
            'status_id' => rand(1, 5), // Adjust as needed
        ];
    }
}
