<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Client;
use App\Models\UserClient;

class UserClientSeeder extends Seeder
{
    public function run()
    {
        // Get users with role_id = 2
        $usersWithRole2 = User::where('role_id', 2)->get();

        // Get all clients
        $clients = Client::all()->pluck('id')->toArray();

        // Ensure there are at least 20 clients available
        if (count($clients) < 20) {
            throw new \Exception("There are not enough clients available for seeding.");
        }

        // Shuffle the clients to randomize selection
        shuffle($clients);

        // Initialize a counter for inserted combinations
        $insertedCombinationsCount = 0;

        foreach ($usersWithRole2 as $user) {
            // Randomly select a number of clients for this user
            $numClientsForUser = mt_rand(1, min(20 - $insertedCombinationsCount, count($clients)));

            // Randomly select $numClientsForUser unique client IDs
            $selectedClients = array_slice($clients, 0, $numClientsForUser);
            
            foreach ($selectedClients as $clientId) {
                // Check if this client_id is already assigned to any user
                $existingUserClient = UserClient::where('client_id', $clientId)->first();

                if (!$existingUserClient) {
                    // Insert the record
                    UserClient::create([
                        'user_id' => $user->id,
                        'client_id' => $clientId,
                    ]);

                    // Increment the counter
                    $insertedCombinationsCount++;
                }

                // Remove the selected client from the list to ensure uniqueness
                $clients = array_diff($clients, [$clientId]);
            }

            // If 20 unique combinations have been inserted, break out of the loop
            if ($insertedCombinationsCount >= 20) {
                break;
            }
        }
    }
}
