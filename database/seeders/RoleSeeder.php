<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        Role::create(['name' => 'Account Manager']);
        Role::create(['name' => 'Travel Consultant']);
        Role::create(['name' => 'Administrator']);
    }
}
