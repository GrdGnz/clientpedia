<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ClientPreferredCar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ClientPreferredCarController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'car' => 'required|string|max:255',
            'contactPerson' => 'nullable|string|max:255',
            'contactNumber' => 'nullable|string|max:255',
            'contactEmail' => 'nullable|email|max:255',
        ]);

        try {
            // Map the form inputs to the model's fillable attributes
            $ClientPreferredCar = ClientPreferredCar::create([
                'client_id' => $validatedData['client_id'],
                'car_code' => $validatedData['car'],
                'contact_person' => $validatedData['contactPerson'] ?? '',
                'contact_number' => $validatedData['contactNumber'] ?? '',
                'contact_email' => $validatedData['contactEmail'] ?? '',
            ]);

            // Log successful creation
            Log::info('ClientPreferredCar created successfully.', [
                'client_id' => $validatedData['client_id'],
                'car_code' => $validatedData['car'],
            ]);

            // Return a success response
            return redirect()->back()->with('success', 'Preferred car added successfully.');

        } catch (\Exception $e) {
            // Log the error
            Log::error('Failed to create ClientPreferredCar.', [
                'error' => $e->getMessage(),
                'client_id' => $validatedData['client_id'] ?? null,
                'car_code' => $validatedData['car'] ?? null,
            ]);

            // Return an error response
            return redirect()->back()->with('error', 'An error occurred while adding the preferred car. Please try again.');
        }
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'client_id' => 'required|integer|exists:clients,id',
            'edit_car' => 'required|string|max:255',
            'edit_contact_person' => 'nullable|string|max:255',
            'edit_contact_number' => 'nullable|string|max:20',
            'edit_contact_email' => 'nullable|email|max:255',
        ]);

        try {
            // Find the preferred airline record by ID
            $preferredHotel = ClientPreferredCar::findOrFail($id);

            // Update the record with the validated data
            $preferredHotel->update([
                'client_id' => $validatedData['client_id'],
                'car_code' => $validatedData['edit_car'],
                'contact_person' => $validatedData['edit_contact_person'] ?? '',
                'contact_number' => $validatedData['edit_contact_number'] ?? '',
                'contact_email' => $validatedData['edit_contact_email'] ?? '',
            ]);

            // Log the successful update
            Log::info('Client Preferred Car updated successfully', ['preferred_car_id' => $id]);

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Client Preferred Car updated successfully.');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Failed to update Client Preferred Car', ['error' => $e->getMessage()]);

            // Redirect back with an error message
            return redirect()->back()->with('error', 'Failed to update Client Preferred Car.');
        }
    }

    public function destroy($id)
    {
        try {
            // Find and delete the ClientPreferredAirline entry by ID
            $ClientPreferredCar = ClientPreferredCar::findOrFail($id);
            $ClientPreferredCar->delete();

            // Log successful deletion
            Log::info('ClientPreferredCar deleted successfully.', [
                'id' => $id,
                'client_id' => $ClientPreferredCar->client_id,
                'car_code' => $ClientPreferredCar->hotel_code,
            ]);

            // Return a success response
            return redirect()->back()->with('success', 'Preferred car deleted successfully.');

        } catch (\Exception $e) {
            // Log the error
            Log::error('Failed to delete ClientPreferredCar.', [
                'error' => $e->getMessage(),
                'id' => $id,
            ]);

            // Return an error response
            return redirect()->back()->with('error', 'An error occurred while deleting the preferred car. Please try again.');
        }
    }
}
