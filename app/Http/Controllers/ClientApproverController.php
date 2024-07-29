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
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'client_id' => 'required|exists:clients,id',
                'approverName' => 'required|string|max:255',
                'approverDesignation' => 'nullable|string|max:255',
                'approverDepartment' => 'nullable|string|max:255',
                'approverLandline' => 'nullable|string|max:20',
                'approverMobile' => 'nullable|string|max:20',
                'approverEmail' => 'nullable|email|max:255',
                'approverLevel' => 'required|integer|min:1',
                'approverStatus' => 'required|integer|exists:statuses,id', // assuming status_id refers to a valid status
            ]);

            // Create a new ClientApprover instance with the validated data
            $clientApprover = new ClientApprover([
                'client_id' => $validatedData['client_id'],
                'name' => $validatedData['approverName'],
                'designation' => $validatedData['approverDesignation'],
                'department' => $validatedData['approverDepartment'],
                'contact_landline' => $validatedData['approverLandline'],
                'contact_mobile' => $validatedData['approverMobile'],
                'email' => $validatedData['approverEmail'],
                'approver_level' => $validatedData['approverLevel'],
                'status_id' => $validatedData['approverStatus'],
            ]);

            // Save the new client approver record to the database
            $clientApprover->save();

            // Log success
            Log::info('Client Approver created successfully.', ['client_approver' => $clientApprover]);

            // Return a success response
            return redirect()->back()->with('success', 'Client Approver created successfully!');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error creating Client Approver: ' . $e->getMessage(), ['request' => $request->all()]);

            // Return an error response
            return redirect()->back()->with('error', 'Failed to create Client Approver.');
        }
    }

    // Update an existing client approver
    public function update(Request $request, $id)
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'approverName' => 'required|string|max:255',
                'approverDesignation' => 'nullable|string|max:255',
                'approverDepartment' => 'nullable|string|max:255',
                'approverLandline' => 'nullable|string|max:20',
                'approverMobile' => 'nullable|string|max:20',
                'approverEmail' => 'nullable|email|max:255',
                'approverLevel' => 'required|integer|min:1',
                'approverStatus' => 'required|integer|exists:statuses,id',
            ]);

            // Find the client approver by ID and update its details
            $clientApprover = ClientApprover::findOrFail($id);
            $clientApprover->update([
                'name' => $validatedData['approverName'],
                'designation' => $validatedData['approverDesignation'],
                'department' => $validatedData['approverDepartment'],
                'contact_landline' => $validatedData['approverLandline'],
                'contact_mobile' => $validatedData['approverMobile'],
                'email' => $validatedData['approverEmail'],
                'approver_level' => $validatedData['approverLevel'],
                'status_id' => $validatedData['approverStatus'],
            ]);

            // Log success
            Log::info('Client Approver updated successfully.', ['client_approver' => $clientApprover]);

            // Return a success response
            return redirect()->back()->with('success', 'Client Approver updated successfully!');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error updating Client Approver: ' . $e->getMessage(), ['request' => $request->all(), 'id' => $id]);

            // Return an error response
            return redirect()->back()->with('error', 'Failed to update Client Approver.');
        }
    }
}
