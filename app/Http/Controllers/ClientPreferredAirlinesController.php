<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientPreferredAirline;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientPreferredAirlinesController extends Controller
{
    public function store(Request $request)
    {
        try {
            $client_id = $request->input('client_id');

            // Get client
            $client = Client::find($client_id);

            // Get the selected international and domestic airlines
            $internationalAirlines = $request->input('preferred_international', []);
            $domesticAirlines = $request->input('preferred_domestic', []);

            // Start a database transaction
            DB::beginTransaction();

            // Delete existing records with the same client_id
            ClientPreferredAirline::where('client_id', $client_id)->delete();

            // Insert international airlines with route_id 1
            foreach ($internationalAirlines as $airlineCode) {
                // Check if the record already exists for this client and route
                $existingRecord = ClientPreferredAirline::where('client_id', $client_id)
                    ->where('airline_code', $airlineCode)
                    ->where('route_id', 1)
                    ->first();

                if (!$existingRecord) {
                    ClientPreferredAirline::create([
                        'client_id' => $client_id,
                        'airline_code' => $airlineCode,
                        'route_id' => 1,
                    ]);
                }
            }

            // Insert domestic airlines with route_id 2
            foreach ($domesticAirlines as $airlineCode) {
                // Check if the record already exists for this client and route
                $existingRecord = ClientPreferredAirline::where('client_id', $client_id)
                    ->where('airline_code', $airlineCode)
                    ->where('route_id', 2)
                    ->first();

                if (!$existingRecord) {
                    ClientPreferredAirline::create([
                        'client_id' => $client_id,
                        'airline_code' => $airlineCode,
                        'route_id' => 2,
                    ]);
                }
            }

            // Commit the transaction
            DB::commit();

            // Log activity
            logUserActivity(auth()->user()->id,
                'update-client-preferred-airlines',
                'Updated PREFERRED AIRLINES for client \''. $client->name.'\''
            );

            return redirect()->back()->with('success', 'Preferred airlines saved successfully.');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error saving preferred airlines: ' . $e->getMessage());
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
