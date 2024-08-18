<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientPreferredAirline;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ClientPreferredAirlinesController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'airline' => 'required|exists:airlines,code',
            'snapCode' => 'nullable|string|max:255',
            'contactPerson' => 'nullable|string|max:255',
            'contactNumber' => 'nullable|string|max:255',
            'contactEmail' => 'nullable|email|max:255',
        ]);

        try {
            // Map the form inputs to the model's fillable attributes
            $clientPreferredAirline = ClientPreferredAirline::create([
                'client_id' => $validatedData['client_id'],
                'airline_code' => $validatedData['airline'],
                'snap_code' => $validatedData['snapCode'] ?? '',
                'contact_person' => $validatedData['contactPerson'] ?? '',
                'contact_number' => $validatedData['contactNumber'] ?? '',
                'contact_email' => $validatedData['contactEmail'] ?? '',
            ]);

            // Log successful creation
            Log::info('ClientPreferredAirline created successfully.', [
                'client_id' => $validatedData['client_id'],
                'airline_code' => $validatedData['airline'],
            ]);

            // Return a success response
            return redirect()->back()->with('success', 'Preferred airline added successfully.');

        } catch (\Exception $e) {
            // Log the error
            Log::error('Failed to create ClientPreferredAirline.', [
                'error' => $e->getMessage(),
                'client_id' => $validatedData['client_id'] ?? null,
                'airline_code' => $validatedData['airline'] ?? null,
            ]);

            // Return an error response
            return redirect()->back()->with('error', 'An error occurred while adding the preferred airline. Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            // Find and delete the ClientPreferredAirline entry by ID
            $clientPreferredAirline = ClientPreferredAirline::findOrFail($id);
            $clientPreferredAirline->delete();

            // Log successful deletion
            Log::info('ClientPreferredAirline deleted successfully.', [
                'id' => $id,
                'client_id' => $clientPreferredAirline->client_id,
                'airline_code' => $clientPreferredAirline->airline_code,
            ]);

            // Return a success response
            return redirect()->back()->with('success', 'Preferred airline deleted successfully.');

        } catch (\Exception $e) {
            // Log the error
            Log::error('Failed to delete ClientPreferredAirline.', [
                'error' => $e->getMessage(),
                'id' => $id,
            ]);

            // Return an error response
            return redirect()->back()->with('error', 'An error occurred while deleting the preferred airline. Please try again.');
        }
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'client_id' => 'required|integer|exists:clients,id',
            'edit_airline' => 'required|string|exists:airlines,code',
            'edit_snapcode' => 'nullable|string|max:255',
            'edit_contact_person' => 'nullable|string|max:255',
            'edit_contact_number' => 'nullable|string|max:20',
            'edit_contact_email' => 'nullable|email|max:255',
        ]);

        try {
            // Find the preferred airline record by ID
            $preferredAirline = ClientPreferredAirline::findOrFail($id);

            // Update the record with the validated data
            $preferredAirline->update([
                'client_id' => $validatedData['client_id'],
                'airline_code' => $validatedData['edit_airline'],
                'snap_code' => $validatedData['edit_snapcode'] ?? '',
                'contact_person' => $validatedData['edit_contact_person'] ?? '',
                'contact_number' => $validatedData['edit_contact_number'] ?? '',
                'contact_email' => $validatedData['edit_contact_email'] ?? '',
            ]);

            // Log the successful update
            Log::info('Client Preferred Airline updated successfully', ['preferred_airline_id' => $id]);

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Client Preferred Airline updated successfully.');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Failed to update Client Preferred Airline', ['error' => $e->getMessage()]);

            // Redirect back with an error message
            return redirect()->back()->with('error', 'Failed to update Client Preferred Airline.');
        }
    }
}
