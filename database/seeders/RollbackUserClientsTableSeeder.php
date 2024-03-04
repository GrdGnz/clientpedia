<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserClient;

class RollbackUserClientsTableSeeder extends Seeder
{
    public function run()
    {
        // Remove the records created by the UserClientsTableSeeder
        UserClient::truncate();
    }
}
