<?php

namespace App\Http\Controllers;

use App\Models\ClientHotelCorporateCode;
use App\Models\Hotel;
use Illuminate\Http\Request;

class ClientHotelCorporateCodeController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validate the incoming request data for the Hotel model
            $validatedHotelData = $request->validate([
                'code' => 'required',
                'name' => 'required',
                'address' => 'required',
                'city' => 'required',
                'state' => 'required',
                'country' => 'required',
            ]);

            // Create a new instance of the Hotel model and fill it with the validated data
            $hotel = Hotel::create($validatedHotelData);

            // Validate the incoming request data for the ClientHotelCorporateCode model
            $validatedCodeData = $request->validate([
                'client_id' => 'required|exists:clients,id',
                'route_id' => 'required|exists:routes,id',
            ]);

            // Add the newly inserted hotel_id to the ClientHotelCorporateCode data
            $validatedCodeData['hotel_id'] = $hotel->id;

            // Create a new instance of the ClientHotelCorporateCode model and fill it with the validated data
            $clientHotelCorporateCode = ClientHotelCorporateCode::create($validatedCodeData);

            // Log activity
            logUserActivity(auth()->user()->id,
                'create-client-hotel-corporate-code',
                'Created Hotel Code \''.$clientHotelCorporateCode->name.'\' for client: ' . $clientHotelCorporateCode->client->name
            );

            // You can customize the success message as needed
            return redirect()->back()->with('success', 'Hotel added successfully');
        } catch (\Exception $e) {
            // You can customize the error message and log the exception if needed
            return redirect()->back()->with('error', 'Error adding hotel. '. $e->getMessage());
        }
    }

    public function update(Request $request)
    {
        try {
            // Validate the incoming request data for Hotel model
            $request->validate([
                'code' => 'required|string',
                'name' => 'required|string',
                'address' => 'required|string',
                'city' => 'required|string',
                'state' => 'required|string',
                'country' => 'required|string',
            ]);

            // Validate the incoming request data for ClientHotelCorporateCode model
            $request->validate([
                'route_id' => 'required|numeric',
            ]);

            // Find the hotel record by ID
            $hotel = Hotel::findOrFail($request->input('hotel_id'));

            // Update the hotel record with the validated data
            $hotel->update([
                'code' => $request->input('code'),
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'country' => $request->input('country'),
            ]);

            // Find the associated ClientHotelCorporateCode record
            $clientHotelCorporateCode = ClientHotelCorporateCode::where([
                'client_id' => $request->input('client_id'),
                'hotel_id' => $request->input('hotel_id'),
            ])->first();

            // Update the ClientHotelCorporateCode record with the validated route_id
            $clientHotelCorporateCode->update([
                'route_id' => $request->input('route_id'),
            ]);

            // Optionally, you can redirect back with a success message
            return redirect()->back()->with('success', 'Records updated successfully');

        } catch (\Exception $e) {
            // Handle other exceptions
            return redirect()->back()->with('error', 'Error updating records: ' . $e->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        try {
            $hotelId = $request->input('hotel_id');
            
            // Find the hotel by ID
            $hotel = Hotel::findOrFail($hotelId);

            // Delete associated clientHotelCorporateCode entry
            ClientHotelCorporateCode::where('hotel_id', $hotelId)->delete();

            // Delete the hotel entry
            $hotel->delete();

            return redirect()->back()->with('success', 'Hotel and related entries deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting entries: ' . $e->getMessage());
        }
    }
}
