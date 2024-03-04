<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientBooker;
use App\Models\User; // Import the User model if not already imported
use App\Models\Client; // Import the Client model if not already imported

class ClientBookerController extends Controller
{
    // ... other controller methods ...

    public function saveSteps(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'client_id' => 'required', // Add validation rules for other fields as needed
        ]);
    
        $clientId = $request->input('client_id');
        $route_id = $request->input('route_id');
        $category_id = $request->input('category_id');
        $steps = $request->input('steps');
    
        // Delete existing data for the same client_id
        ClientBooker::where('client_id', $clientId)->delete();
    
        $orderNumber = 1; // Initialize order_number to 1
    
        // Iterate through the steps and insert new rows with order_number in ascending order
        foreach ($steps as $description) {
            if ($description != '') {
                $clientBooker = new ClientBooker([
                    'accountmanager_user_id' => $request->input('accountmanager_user_id'),
                    'client_id' => $clientId,
                    'route_id' => $route_id,
                    'category_id' => $category_id,
                    'order_number' => $orderNumber,
                    'description' => $description,
                ]);
        
                $clientBooker->save();
        
                $orderNumber++; // Increment order_number for the next step
            }
        }
    
        // Optionally, you can return a response or redirect to a specific route.
        return redirect()->back()->with('success', 'Steps saved successfully');
    }    

}
