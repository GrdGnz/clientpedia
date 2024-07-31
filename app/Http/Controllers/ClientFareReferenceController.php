<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientFareReference;
use Exception;
use Illuminate\Support\Facades\Log;

class ClientFareReferenceController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'published_fares' => 'required|in:yes,no',
            'private_fares' => 'required|in:yes,no',
            'corporate_fares' => 'required|in:yes,no',
        ]);

        try {
            // Check if the client_id already exists in the client_fare_reference table
            $clientFareReference = ClientFareReference::where('client_id', $validatedData['client_id'])->first();

            if ($clientFareReference) {
                // If the client_id exists, update the existing record
                $clientFareReference->update($validatedData);
            } else {
                // If the client_id does not exist, create a new record
                ClientFareReference::create($validatedData);
            }

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Client fare reference updated successfully.');

        } catch (\Exception $e) {
            // Log the exception
            Log::error('Error updating or creating ClientFareReference: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->with('error', 'There was an issue updating the client fare reference. Please try again.');
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
