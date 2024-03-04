<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientBookingProcess;

class ClientBookingProcessController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'client_id' => 'required', // Add validation rules for other fields as needed
        ]);
    
        $clientId = $request->input('client_id');
        $steps = $request->input('steps');
        $routeId = $request->input('route_id');
        $categoryId = $request->input('category_id');
    
        // Delete existing data for the same client_id
        ClientBookingProcess::where('client_id', $clientId)
            ->where('route_id', $routeId)
            ->where('category_id', $categoryId)
            ->delete();
    
        $orderNumber = 1; // Initialize order_number to 1
    
        // Iterate through the steps and insert new rows with order_number in ascending order
        foreach ($steps as $description) {
            if ($description != '') {
                $clientBooker = new ClientBookingProcess([
                    'accountmanager_user_id' => $request->input('accountmanager_user_id'),
                    'client_id' => $clientId,
                    'route_id' => $routeId,
                    'category_id' => $categoryId,
                    'order_number' => $orderNumber,
                    'description' => $description,
                ]);
        
                $clientBooker->save();
        
                $orderNumber++; // Increment order_number for the next step
                
            }
        }

        // Log activity
        logUserActivity(auth()->user()->id,
            'create-client-booking-processs',
            'Created '.strtoupper($clientBooker->category->name)    .' '.strtoupper($clientBooker->route->name).' booking process for client: ' . $clientBooker->client->name
        );
    
        // Optionally, you can return a response or redirect to a specific route.
        return redirect()->back()->with('success', 'Steps saved successfully');
    }

    public function update(Request $request)
    {
        try {
            $stepId = $request->input('id');
            $clientId = $request->input('clientId');
            $routeId = $request->input('routeId');
            $orderNumber = $request->input('orderNumber');
            $categoryId = $request->input('categoryId');

            // Validate incoming requests
            $request->validate([
                'description' => 'required|string',
            ]);

            // Find specific step
            $step = ClientBookingProcess::findOrFail($stepId);

            // Update step
            $step->update([
                'description' => $request->input('description'),
            ]);

            // Log activity
            logUserActivity(auth()->user()->id,
                'update-client-booking-processs',
                'Updated '.strtoupper($step->category->name).' '.strtoupper($step->route->name).' Booking Process for client: ' . $step->client->name
            );

            return redirect()->back()->with('success', 'Record updated successfully');

        } catch(\Exception $e) {
            // Handle other exceptions
            return redirect()->back()->with('error', 'Error updating records: ' . $e->getMessage());
        }
    }

    public function destroy(Request $request) 
    {
        try {

            $clientId = $request->input('clientId');
            $routeId = $request->input('routeId');
            $orderNumber = $request->input('orderNumber');
            $categoryId = $request->input('categoryId');

            // Find specific step
            $step = ClientBookingProcess::where('client_id', $clientId)
                ->where('order_number', $orderNumber)
                ->where('route_id', $routeId)
                ->where('category_id', $categoryId);

            // Update step
            $step->delete();

            return redirect()->back()->with('success', 'Step deleted successfully');

        } catch(\Exception $e) {
            // Handle other exceptions
            return redirect()->back()->with('error', 'Error deleting step: ' . $e->getMessage());
        }
    }
}
