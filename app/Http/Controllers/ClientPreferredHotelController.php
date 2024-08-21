<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ClientPreferredHotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ClientPreferredHotelController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'hotel' => 'required|string|max:255',
            'snapcode' => 'nullable|string|max:255',
            'contactPerson' => 'nullable|string|max:255',
            'contactNumber' => 'nullable|string|max:255',
            'contactEmail' => 'nullable|email|max:255',
        ]);

        try {
            // Map the form inputs to the model's fillable attributes
            $clientPreferredHotel = ClientPreferredHotel::create([
                'client_id' => $validatedData['client_id'],
                'hotel_code' => $validatedData['hotel'],
                'snap_code' => $validatedData['snapcode'],
                'contact_person' => $validatedData['contactPerson'] ?? '',
                'contact_number' => $validatedData['contactNumber'] ?? '',
                'contact_email' => $validatedData['contactEmail'] ?? '',
            ]);

            // Log successful creation
            Log::info('clientPreferredHotel created successfully.', [
                'client_id' => $validatedData['client_id'],
                'hotel_code' => $validatedData['hotel'],
            ]);

            // Return a success response
            return redirect()->back()->with('success', 'Preferred hotel added successfully.');

        } catch (\Exception $e) {
            // Log the error
            Log::error('Failed to create clientPreferredHotel.', [
                'error' => $e->getMessage(),
                'client_id' => $validatedData['client_id'] ?? null,
                'hotel_code' => $validatedData['hotel'] ?? null,
            ]);

            // Return an error response
            return redirect()->back()->with('error', 'An error occurred while adding the preferred hotel. Please try again.');
        }
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'client_id' => 'required|integer|exists:clients,id',
            'edit_hotel' => 'required|string|max:255',
            'edit_snapcode' => 'nullable|string|max:255',
            'edit_contact_person' => 'nullable|string|max:255',
            'edit_contact_number' => 'nullable|string|max:20',
            'edit_contact_email' => 'nullable|email|max:255',
        ]);

        try {
            // Find the preferred airline record by ID
            $preferredHotel = ClientPreferredHotel::findOrFail($id);

            // Update the record with the validated data
            $preferredHotel->update([
                'client_id' => $validatedData['client_id'],
                'hotel_code' => $validatedData['edit_hotel'],
                'snap_code' => $validatedData['edit_snapcode'],
                'contact_person' => $validatedData['edit_contact_person'] ?? '',
                'contact_number' => $validatedData['edit_contact_number'] ?? '',
                'contact_email' => $validatedData['edit_contact_email'] ?? '',
            ]);

            // Log the successful update
            Log::info('Client Preferred Hotel updated successfully', ['preferred_hotel_id' => $id]);

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Client Preferred Hotel updated successfully.');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Failed to update Client Preferred Hotel', ['error' => $e->getMessage()]);

            // Redirect back with an error message
            return redirect()->back()->with('error', 'Failed to update Client Preferred Hotel.');
        }
    }

    public function destroy($id)
    {
        try {
            // Find and delete the ClientPreferredAirline entry by ID
            $ClientPreferredHotel = ClientPreferredHotel::findOrFail($id);
            $ClientPreferredHotel->delete();

            // Log successful deletion
            Log::info('ClientPreferredHotel deleted successfully.', [
                'id' => $id,
                'client_id' => $ClientPreferredHotel->client_id,
                'hotel_code' => $ClientPreferredHotel->hotel_code,
            ]);

            // Return a success response
            return redirect()->back()->with('success', 'Preferred hotel deleted successfully.');

        } catch (\Exception $e) {
            // Log the error
            Log::error('Failed to delete ClientPreferredHotel.', [
                'error' => $e->getMessage(),
                'id' => $id,
            ]);

            // Return an error response
            return redirect()->back()->with('error', 'An error occurred while deleting the preferred hotel. Please try again.');
        }
    }
}
