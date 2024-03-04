<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientInfoSeeder extends Seeder
{
    public function run()
    {
        // Retrieve existing clients from the 'clients' table
        $clients = DB::table('clients')->get();

        // Loop through each client and insert data into the 'client_info' table
        foreach ($clients as $client) {
            DB::table('client_info')->insert([
                'client_id' => $client->id,
                'client_type_id' => 1, // Set the default value to 1 (Corporate)
                'global_customer_number' => 'GCN-' . $client->id, // You can customize this value
                'contract_start_date' => now(), // You can customize the start date
                'contract_end_date' => now()->addYear(), // You can customize the end date
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
