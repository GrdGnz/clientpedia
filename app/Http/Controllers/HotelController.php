<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class HotelController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'code' => 'required',
                'name' => 'required',
                'address' => 'required',
                'city' => 'required',
                'state' => 'required',
                'country' => 'required',
                'route_id' => 'required|exists:routes,id',
                // You can add additional validation rules for other fields if needed
            ]);

            // Create a new instance of the model and fill it with the validated data
            $hotel = Hotel::create($validatedData);

            // You can customize the success message as needed
            return redirect()->back()->with('success', 'Hotel created successfully');
        } catch (\Exception $e) {
            // You can customize the error message and log the exception if needed
            return redirect()->back()->with('error', 'Error creating Hotel. '.$e->getMessage());
        }
    }
}
