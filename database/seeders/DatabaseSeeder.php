<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(RollbackSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(RouteSeeder::class);
        $this->call(SourcesSeeder::class);
        $this->call(PricingmodelTypeSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ClientSeeder::class);
        //$this->call(UserClientSeeder::class);
        $this->call(ClientTypeSeeder::class);
        //$this->call(ClientContactSeeder::class);
        //$this->call(ClientVipSeeder::class);
        //$this->call(ClientInfoSeeder::class);

    }
}
