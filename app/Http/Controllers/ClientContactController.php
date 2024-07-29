<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\ClientContact;
use Illuminate\Support\Facades\Log;

class ClientContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
            'birthday' => 'nullable|date',
            'remarks' => 'nullable|string',
        ]);

        // If 'remarks' is empty, set it to null
        $validatedData['remarks'] = $validatedData['remarks'] ?? null;

        try {
            // Create a new instance of ClientContact with the validated data
            $clientContact = ClientContact::create($validatedData);

            // Log the creation of a new client contact
            Log::info('New client contact created:', [
                'contact_id' => $clientContact->id,
                'client_id' => $clientContact->client_id,
                'name' => $clientContact->name,
            ]);

            // Log user activity
            logUserActivity(auth()->user()->id, 'create-client-contact', "Added contact person '{$validatedData['name']}' to client ID {$validatedData['client_id']}.");

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Client Contact created successfully!');

        } catch (\Exception $e) {
            // Log the exception
            Log::error('Error creating client contact:', [
                'error_message' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);

            // Redirect back with an error message
            return redirect()->back()->with('error', 'There was an issue creating the client contact. Please try again.');
        }
    }

    public function update(Request $request, $contactId)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'designation' => 'nullable|max:255',
                'department' => 'nullable|max:255',
                'contact_mobile' => 'nullable|max:20',
                'email' => 'nullable|email|max:255',
                'birthday' => 'nullable|date',
                'remarks' => 'nullable|string|max:1000',
                'status_id' => 'nullable|boolean',
            ]);

            $contactId = $request->input('contactId');
            $clientContact = ClientContact::findOrFail($contactId);

            // If status_id is not present in the request, set it to 0
            $validatedData['status_id'] = $request->input('status_id', 0);

            $clientContact->update($validatedData);

            // Log activity
            logUserActivity(auth()->user()->id, 'update-client-contact', 'Updated contact person \'' . $validatedData['name'] . '\' of ' . $clientContact->client->name);

            return redirect()
                ->back()
                ->with('success', 'Record Updated Successfully');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Update failed - ' . $e->getMessage());
        }
    }

    public function destroy($clientId, $contactId)
    {
        try {
            $clientContact = ClientContact::findOrFail($contactId);

            // Ensure that the clientContact record belongs to the specified client
            if ($clientContact->client_id == $clientId) {
                $clientContact->delete();

                //log activity
                logUserActivity(auth()->user()->id, 'delete-client-contact', 'Deleted contact person \''.$clientContact->name.'\' of '. $clientContact->client->name);


                return redirect()->back()->with('success', 'Client contact deleted successfully!');
            } else {
                // The clientContact record does not belong to the specified client
                return redirect()->back()->with('error', 'Client contact does not exist or does not belong to the client.');
            }
        } catch (\Exception $e) {
            // Handle exceptions (e.g., record not found)
            return redirect()->back()->with('error', 'Error deleting client Contact.');
        }
    }

    public function updateStatus(Request $request, $clientId, $contactId)
    {
        try {
            $status = $request->input('status_radio_'.$contactId);
            // Validate the status value (optional)
            // ...

            $clientContact = ClientContact::findOrFail($contactId);

            // Ensure that the clientContact record belongs to the specified client
            if ($clientContact->client_id == $clientId) {
                $clientContact->status_id = $status;
                $clientContact->save();

                //log activity
                logUserActivity(auth()->user()->id, 'change-client-contact-status', 'Changed contact person \''.$clientContact->name.'\' of '. $clientContact->client->name.' status to '.$status);


                return redirect()->back()->with('success', 'Status updated successfully');
            } else {
                // The clientContact record does not belong to the specified client
                return redirect()->back()->with('error', 'Client Contact does not exist or does not belong to the client.');
            }
        } catch (\Exception $e) {
            // Handle exceptions (e.g., record not found)
            return redirect()->back()->with('error', 'Error updating client contact status');
        }
    }
}
