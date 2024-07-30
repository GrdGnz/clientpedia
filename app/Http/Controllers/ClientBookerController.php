<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientBooker;
use App\Models\User; // Import the User model if not already imported
use App\Models\Client; // Import the Client model if not already imported
use Illuminate\Support\Facades\Log;

class ClientBookerController extends Controller
{
    // ... other controller methods ...

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id',  // Ensure client_id exists in the clients table
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'contact_mobile' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'status_id' => 'nullable|boolean',
        ]);

        try {
            // Create a new instance of ClientContact with the validated data
            $clientBooker = ClientBooker::create($validatedData);

            // Log the creation of a new client contact
            Log::info('New client booker created:', [
                'contact_id' => $clientBooker->id,
                'client_id' => $clientBooker->client_id,
                'name' => $clientBooker->name,
            ]);

            // Log user activity
            logUserActivity(auth()->user()->id, 'create-client-booker', "Added booker '{$validatedData['name']}' to client ID {$validatedData['client_id']}.");

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Client Booker created successfully!');

        } catch (\Exception $e) {
            // Log the exception
            Log::error('Error creating client booker:', [
                'error_message' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);

            // Redirect back with an error message
            return redirect()->back()->with('error', 'There was an issue creating the client booker. Please try again.');
        }
    }

    public function update(Request $request, $bookerId)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'designation' => 'nullable|max:255',
                'department' => 'nullable|max:255',
                'contact_mobile' => 'nullable|max:20',
                'email' => 'nullable|email|max:255',
                'status_id' => 'nullable|boolean',
            ]);

            $bookerId = $request->input('bookerId');
            $clientBooker = ClientBooker::findOrFail($bookerId);

            // If status_id is not present in the request, set it to 0
            $validatedData['status_id'] = $request->input('status_id', 0);

            $clientBooker->update($validatedData);

            // Log activity
            logUserActivity(auth()->user()->id, 'update-client-booker', 'Updated booker \'' . $validatedData['name'] . '\' of ' . $clientBooker->client->name);

            return redirect()
                ->back()
                ->with('success', 'Record Updated Successfully');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Update failed - ' . $e->getMessage());
        }
    }
}
