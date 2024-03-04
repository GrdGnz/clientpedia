<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientInfo;
use App\Models\Client;

class ClientInfoController extends Controller
{
    public function update(Request $request)
    {
        try {
            // Validate data with optional rules
            $validatedData = $request->validate([
                'clientId'  =>  'required|integer',
                'clientType' => 'nullable|integer',
                'globalCustomerNumber' => 'nullable|string',
                'contractStartDate' => 'nullable|date',
                'contractEndDate' => 'nullable|date|after:contractStartDate',
            ]);

            // Assign input fields
            $data = [
                'client_id' =>  $request->input('clientId'),
                'client_type_id' => $request->input('clientType'),
                'global_customer_number' => $request->input('globalCustomerNumber'),
                'contract_start_date' => $request->input('contractStartDate'),
                'contract_end_date' => $request->input('contractEndDate'),
            ];

            // Find or create record
            $clientInfo = ClientInfo::find($request->input('clientInfoId'));

            if (!$clientInfo) {
                // If the record does not exist, create a new one
                $clientInfo = ClientInfo::create($data);
            } else {
                // If the record exists, update it
                $clientInfo->update($data);
            }

            // Get client
            $client = Client::find($clientInfo->client->id);

            // Log activity
            logUserActivity(auth()->user()->id, 'update-client-info', 'Updated client - ' . $client->name . '\'s information');

            return redirect()->back()->with('success', 'Update Success');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Update failed. ' . $e->getMessage());
        }
    }
}



