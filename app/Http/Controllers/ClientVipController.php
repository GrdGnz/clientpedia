<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientVip;

class ClientVipController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'client_id' => 'required',
            'name' => 'required|string|max:255',
            'designation' => 'required|required|string|max:255',
            'contact_number' => 'required|nullable|string|max:20',
            'email' => 'required|nullable|email|max:255',
            'birthday' => 'required|nullable|date',
            'remarks' => 'nullable|string',
            'status_id' => 'required', // Ensure the status_id is either 0 (Inactive) or 1 (Active)
        ]);

        // Create a new ClientVip instance with the validated data
        $clientVip = new ClientVip($validatedData);

        // Save the new ClientVip record to the database
        $clientVip->save();

        // Redirect back to the form with a success message
        return redirect()->back()->with('success', 'Client VIP created successfully!');
    }

    public function destroy($clientId, $vipId)
    {
        try {
            $clientVip = ClientVip::findOrFail($vipId);
    
            // Ensure that the ClientVip record belongs to the specified client
            if ($clientVip->client_id == $clientId) {
                $clientVip->delete();
                return redirect()->back()->with('success', 'Client VIP deleted successfully!');
            } else {
                // The ClientVip record does not belong to the specified client
                return redirect()->back()->with('error', 'Client VIP does not exist or does not belong to the client.');
            }
        } catch (\Exception $e) {
            // Handle exceptions (e.g., record not found)
            return redirect()->back()->with('error', 'Error deleting client VIP.');
        }
    }

    public function updateStatus(Request $request, $clientId, $vipId)
    {
        try {
            $status = $request->input('status_radio_'.$vipId);
            // Validate the status value (optional)
            // ...
    
            $clientVip = ClientVip::findOrFail($vipId);
    
            // Ensure that the ClientVip record belongs to the specified client
            if ($clientVip->client_id == $clientId) {
                $clientVip->status_id = $status;
                $clientVip->save();
    
                return redirect()->back()->with('success', 'Status updated successfully');
            } else {
                // The ClientVip record does not belong to the specified client
                return redirect()->back()->with('error', 'Client VIP does not exist or does not belong to the client.');
            }
        } catch (\Exception $e) {
            // Handle exceptions (e.g., record not found)
            return redirect()->back()->with('error', 'Error updating client VIP status');
        }
    }
}
