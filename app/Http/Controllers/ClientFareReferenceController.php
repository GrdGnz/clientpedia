<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientFareReference;
use Exception;

class ClientFareReferenceController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validate the form data
            $validatedData = $request->validate([
                'code' => 'required|string',
                'description' => 'required|string',
                'definition' => 'required|string',
            ]);
    
            // Check if a record with the same 'code' already exists, excluding the current record being updated
            $existingRecord = ClientFareReference::where('code', $validatedData['code'])
                ->where('id', '!=', $request['fare_reference_id'])
                ->where('client_id', $request['client_id'])
                ->first();
    
            if ($existingRecord) {
                // A record with the same 'code' already exists
                return redirect()->back()->with('error', 'Code already exists.');
            }
    
            if ($request->has('fare_reference_id') && $request['fare_reference_id'] != '') {
                // Updating an existing record
                $clientFareReference = ClientFareReference::findOrFail($request['fare_reference_id']);
            } else {
                // Creating a new record
                $clientFareReference = new ClientFareReference;
                $clientFareReference->client_id = $request['client_id'];
            }
    
            $clientFareReference->code = $validatedData['code'];
            $clientFareReference->description = $validatedData['description'];
            $clientFareReference->definition = $validatedData['definition'];
    
            $clientFareReference->save();

            //log activity
            logUserActivity(auth()->user()->id, 'create-client-fare-reference', 
                'Added Fare Reference to client \''.$clientFareReference->client->name.'\' with code '.$validatedData['code']
            );

    
            // Redirect to a success page or show a success message
            $message = $request->has('fare_reference_id') ? 'Client Fare Reference updated successfully' : 'Client Fare Reference created successfully';
            return redirect()->back()->with('success', $message);
        } catch (Exception $e) {
            // Handle the exception, you can log it or redirect to an error page
            return redirect()->back()->with('error', 'An error occurred while saving the Client Fare Reference. '. $e->getMessage());
        }
    }
    
    public function destroy($id)
    {
        try {
            $clientFareReference = ClientFareReference::findOrFail($id);
            $clientFareReference->delete();

            //log activity
            logUserActivity(auth()->user()->id, 'delete-client-fare-reference', 
                'Deleted Fare Reference of client \''.$clientFareReference->client->name.'\' with code '.$clientFareReference->code
            );
            
            return redirect()->back()->with('success', 'Client Fare Reference deleted successfully');
        } catch (Exception $e) {
            // Handle the exception, you can log it or redirect to an error page
            return redirect()->back()->with('error', 'An error occurred while deleting the Client Fare Reference.');
        }
    }

}
