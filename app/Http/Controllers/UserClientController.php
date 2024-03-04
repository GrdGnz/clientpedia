<?php

namespace App\Http\Controllers;

use App\Models\UserClient;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getClientData(Request $request)
    {
        $user = Auth::user();
        // Get the selected user ID from the request
        $selectedUserId = $request->input('user_id');

        // Fetch owned clients for the selected user, including client names
        $ownedClients = UserClient::where('user_id', $selectedUserId)
            ->join('clients', 'user_clients.client_id', '=', 'clients.id')
            ->where('clients.accountmanager_user_id', $user['id'])
            ->select('clients.id', 'clients.name')
            ->get();

        // Fetch available clients (clients not owned by the selected user)
        $availableClients = Client::where('accountmanager_user_id', $user['id'])
            ->whereNotIn('id', function ($query) {
                $query->select('client_id')
                    ->distinct()
                    ->from('user_clients');
            })
            ->select('id', 'name')
            ->distinct()
            ->get();

        // Prepare the response data
        $responseData = [
            'ownedClients' => $ownedClients,
            'availableClients' => $availableClients,
        ];

        return response()->json($responseData);
    }

    public function store(Request $request)
    {
        try {
            // Get Travel Counsultant Id
            $travelConsultantId = $request->input('travel_consultant');

            // Get selected unassigned clients
            $unassignedClients = $request->input('unassigned_clients_select', []);

            // Save client to travel consultant, checking for existing records
            foreach ($unassignedClients as $clientId) {
                // Check if the record combination already exists
                $existingRecord = UserClient::where('user_id', $travelConsultantId)
                    ->where('client_id', $clientId)
                    ->first();

                // If the combination doesn't exist, create a new UserClient record
                if (!$existingRecord) {
                    UserClient::create([
                        'user_id' => $travelConsultantId,
                        'client_id' => $clientId,
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Successfully assigned client.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed assigning client. ');
        }
    }
}
