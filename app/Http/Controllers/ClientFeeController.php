<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException; 
use App\Models\ClientFee;
use App\Models\Client;

class ClientFeeController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Get client
            $client = Client::find($request->input('client_id'));

            // Validate the request data
            $validatedData = $request->validate([
                'category_id' => 'required|integer',
                'route_id' => 'required|integer',
                'description' => 'required|string',
                'source_id' => 'required|integer',
                'amount' => 'required|numeric',
            ]);

            // Create a new ClientFee instance with the validated data
            $clientFee = ClientFee::create([
                'client_id' => $request->input('client_id'),
                'category_id' => $validatedData['category_id'],
                'route_id' => $validatedData['route_id'],
                'description' => $validatedData['description'],
                'source_id' => $validatedData['source_id'],
                'amount' => $validatedData['amount'],
            ]);

            //log activity
            logUserActivity(auth()->user()->id, 
                'create-client-table-of-fees', 
                'Added Table of Fee \''.$validatedData['description'].'\' on client: '.$client->name
            );

            // Redirect to the previous page with success message
            return redirect()->back()->with('success', 'Client Fee created successfully');

        } catch (\Exception $e) {
            // Handle any other exceptions
            return redirect()->back()->with('error', 'An unexpected error occurred. '.$e->getMessage());
        }
    }

    public function update(Request $request)
    {
        try {
            
            // Validate the request data
            $validatedData = $request->validate([
                'category_id' => 'required|integer',
                'route_id' => 'required|integer',
                'description' => 'required|string',
                'source_id' => 'required|integer',
                'amount' => 'required|numeric',
            ]);

            // Get record of selected fee
            $clientFee = ClientFee::find($request->input('fee_id'));

            // Update record
            $clientFee->update([
                'category_id' => $validatedData['category_id'],
                'route_id' => $validatedData['route_id'],
                'description' => $validatedData['description'],
                'source_id' => $validatedData['source_id'],
                'amount' => $validatedData['amount'],
            ]);

            //log activity
            logUserActivity(auth()->user()->id, 
                'update-client-table-of-fees', 
                'Updated Table of Fee \''.$validatedData['description'].'\' on client: '.$clientFee->client->name
            );

            return redirect()->back()->with('success', 'Updated successful');
        } catch(\Exception $e) {
            return redirect()->back()->with('error', 'Update failed. '. $e->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        try {
            
            // Get record of selected fee
            $clientFee = ClientFee::find($request->input('fee_id'));

            // Update record
            $clientFee->delete();

            //log activity
            logUserActivity(auth()->user()->id, 
                'delete-client-table-of-fees', 
                'Deleted Table of Fee \''.$clientFee->description.'\' on client: '.$clientFee->client->name
            );

            return redirect()->back()->with('success', 'Delete successful');
        } catch(\Exception $e) {
            return redirect()->back()->with('error', 'Delete failed. '. $e->getMessage());
        }
    }
}
