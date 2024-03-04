<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RollbackSeeder extends Seeder
{
    public function run()
    {
        // Remove foreign key constraints
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('roles')->truncate(); // This will delete all records in the 'roles' table
        DB::table('sources')->truncate(); // This will delete all records in the 'sources' table
        DB::table('routes')->truncate(); // This will delete all records in the 'routes' table
        DB::table('client_fees')->truncate(); // This will delete all records in the 'client_fees' table
        DB::table('client_fare_reference')->truncate(); // This will delete all records in the 'client_fare_reference' table
        DB::table('client_pricingmodel')->truncate(); // This will delete all records in the 'client_pricingmodel' table
        DB::table('client_contacts')->truncate(); // This will delete all records in the 'client_contacts' table
        DB::table('client_types')->truncate(); // This will delete all records in the 'client_types' table
        DB::table('client_vips')->truncate(); // This will delete all records in the 'client_vips' table
        DB::table('user_clients')->truncate(); // This will delete all records in the 'user_clients' table
        DB::table('users')->truncate(); // This will delete all records in the 'users' table
        DB::table('clients')->truncate(); // This will delete all records in the 'clients' table

        // Restore foreign key constraints
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
