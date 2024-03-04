<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientTravelSecurity;

class ClientTravelSecurityController extends Controller
{
    public function store(Request $request)
    {
        try {
            $clientTravelSecurity = new ClientTravelSecurity();
            $clientTravelSecurity->client_id = $request->input('client_id');
            $clientTravelSecurity->description = $request->input('description');
            $clientTravelSecurity->save();

            // Log activity
            logUserActivity(auth()->user()->id,
                'create-client-travel-security',
                'Created TRAVEL SECURITY for client \''. $clientTravelSecurity->client->name.'\''
            );

            return redirect()->back()->with('success', 'Record created successfully.');
        } catch (\Exception $e) {
            // Handle exceptions and show the error message
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request)
    {
        try {
            $clientId = $request->input('client_id');
            $clientTravelSecurity = ClientTravelSecurity::find($clientId);
            $clientTravelSecurity->description = $request->input('description');
            $clientTravelSecurity->save();

            // Log activity
            logUserActivity(auth()->user()->id,
                'update-client-travel-security',
                'Updated TRAVEL SECURITY for client \''. $clientTravelSecurity->client->name.'\''
            );

            return redirect()->back()->with('success', 'Record updated successfully.');
        } catch (\Exception $e) {
            // Handle exceptions and show the error message
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
