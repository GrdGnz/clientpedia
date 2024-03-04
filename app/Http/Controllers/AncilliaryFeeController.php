<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ClientAncilliaryFee;

class AncilliaryFeeController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'client_id' => 'required|integer',
            'description' => 'required|string',
            'currency_code' => 'required|string|max:3',
            'amount' => 'required|numeric',
        ]);

        // Create a new record in the 'client_ancilliary_fees' table
        $ancilliaryFee = ClientAncilliaryFee::create($validatedData);

        //log activity
        logUserActivity(auth()->user()->id, 
            'create-client-ancilliary-fee', 
            'Added Ancilliary Fee \''.$validatedData['description'].'\' on client: '.$ancilliaryFee->client->name
        );

        if ($ancilliaryFee) {
            return redirect()->back()->with('success', 'Ancilliary fee created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to create ancilliary fee.');
        }
    }

    
}
