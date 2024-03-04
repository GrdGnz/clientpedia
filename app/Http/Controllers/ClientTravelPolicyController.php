<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientTravelPolicy;
use Illuminate\Http\Request;

class ClientTravelPolicyController extends Controller
{
    public function store(Request $request)
    {
        try {

            // Validate the request data
            $validatedData = $request->validate([
                'client_id' => 'required',
                'category_id' => 'required',
                'lla' => 'required',
                'service_class' => 'required',
                'flight_window' => 'required',
                'advance_purchase' => 'required',
                'lcc_condition' => 'required',
                'seat_selection' => 'required',
                'baggage_allowance' => 'required',
                'group_booking_policy' => 'required',
                'companion_hcp_personaltravel' => 'required',
            ]);
    
            // Create a new ClientTravelPolicy record
            $travelPolicy = ClientTravelPolicy::create($validatedData);

            // Log activity
            logUserActivity(auth()->user()->id,
                'create-client-travel-policy',
                'Created '.strtoupper($travelPolicy->category->name).' TRAVEL POLICY for client \''. $travelPolicy->client->name.'\''
            );
    
            // Redirect to a success page or return a response
            return redirect()->back()->with('success', 'Client Travel Policy added successfully');
        } catch (\Exception $e) {
            // Handle the exception, e.g., log it or show an error message
            return back()->with('error', 'An error occurred while adding the Client Travel Policy. ' . $e->getMessage());
        }
    }

    public function update(Request $request)
    {
        try {
            // Validate the request data, making all fields required
            $this->validate($request, [
                'lla' => 'required',
                'service_class' => 'required',
                'flight_window' => 'required',
                'advance_purchase' => 'required',
                'lcc_condition' => 'required',
                'seat_selection' => 'required',
                'baggage_allowance' => 'required',
                'group_booking_policy' => 'required',
                'companion_hcp_personaltravel' => 'required',
            ]);

            // Retrieve the client ID from the request
            $clientId = $request->input('client_id');

            // Find the client travel policy record based on the client ID
            $travelPolicy = ClientTravelPolicy::where('client_id', $clientId)->first();

            if (!$travelPolicy) {
                // Handle the case where the travel policy record is not found
                throw new \Exception('Travel policy not found for the specified client.');
            }

            // Update the travel policy record with the request data
            $travelPolicy->update($request->all());

            // Log activity
            logUserActivity(auth()->user()->id,
                'update-client-travel-policy',
                'Updated '.strtoupper($travelPolicy->category->name).' TRAVEL POLICY for client \''. $travelPolicy->client->name.'\''
            );

            // Redirect with success message
            return redirect()->back()->with('success', 'Travel policy updated successfully.');
        } catch (\Exception $e) {
            // Handle exceptions, you can log the error or redirect with an error message
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
