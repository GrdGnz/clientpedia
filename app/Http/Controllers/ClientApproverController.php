<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientApprover;
use Illuminate\Support\Facades\Log;

class ClientApproverController extends Controller
{
    // Store a new client approver
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
            'approver_level' => 'nullable|string',
            'status_id' => 'nullable|boolean',
        ]);

        try {
            // Create a new instance of ClientContact with the validated data
            $clientApprover = ClientApprover::create($validatedData);

            // Log the creation of a new client contact
            Log::info('New client contact created:', [
                'contact_id' => $clientApprover->id,
                'client_id' => $clientApprover->client_id,
                'name' => $clientApprover->name,
            ]);

            // Log user activity
            logUserActivity(auth()->user()->id, 'create-client-approver', "Added approver '{$validatedData['name']}' to client ID {$validatedData['client_id']}.");

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Client Approver created successfully!');

        } catch (\Exception $e) {
            // Log the exception
            Log::error('Error creating client approver:', [
                'error_message' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);

            // Redirect back with an error message
            return redirect()->back()->with('error', 'There was an issue creating the client approver. Please try again.');
        }
    }

    public function update(Request $request, $approverId)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'designation' => 'nullable|max:255',
                'department' => 'nullable|max:255',
                'contact_mobile' => 'nullable|max:20',
                'email' => 'nullable|email|max:255',
                'approver_level' => 'nullable|integer',
                'status_id' => 'nullable|boolean',
            ]);

            $approverId = $request->input('approverId');
            $clientApprover = ClientApprover::findOrFail($approverId);

            // If status_id is not present in the request, set it to 0
            $validatedData['status_id'] = $request->input('status_id', 0);

            $clientApprover->update($validatedData);

            // Log activity
            logUserActivity(auth()->user()->id, 'update-client-approver', 'Updated approver \'' . $validatedData['name'] . '\' of ' . $clientApprover->client->name);

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
