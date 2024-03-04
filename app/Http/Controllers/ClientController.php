<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientContact;
use App\Models\ClientInfo;
use App\Models\ClientType;
use App\Models\UserActivity;
use App\Models\UserClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //Get last login date of user
        $user = Auth::user();
        $userActivity = new UserActivity;
        $lastLoginDate = $userActivity->getLastLoginDate($user['id']);

        $clients = Client::where('accountmanager_user_id',$user['id'])->get();

        return view('accountmanager.client.index',
            compact(
                'clients',
                'user',
                'lastLoginDate',
            )
        );
    }

    public function create()
    {
        //Get last login date of user
        $user = Auth::user();
        $userActivity = new UserActivity;
        $lastLoginDate = $userActivity->getLastLoginDate($user['id']);

        return view('accountmanager.client.create',
            compact('lastLoginDate')
        );
    }

    public function store(Request $request)
    {
        try {
            // Account Manager ID
            $user = Auth::user();

            // Get account mamanger ID
            $accountManagerId = $request->input('accountmanager_user_id') ?? $user->id;

            // Validate the form data using Validator facade
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'code' => 'required|string|unique:clients,code',
                'client_type_id' => 'required|integer',
                'global_customer_number' => 'required|string|unique:client_info,global_customer_number',
                'contract_start_date' => 'required|date',
                'contract_end_date' => 'required|date',
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            // If validation passes, create a new client in the 'clients' table
            $client = Client::create([
                'accountmanager_user_id' => $accountManagerId,
                'name' => $request->input('name'),
                'code' => $request->input('code'),
            ]);

            //log activity
            logUserActivity(auth()->user()->id, 'create-client', 'Created client - '.$request->input('name'));

            // Create a new client_info record in the 'client_info' table
            ClientInfo::create([
                'client_id' => $client->id,
                'client_type_id' => $request->input('client_type_id'),
                'global_customer_number' => $request->input('global_customer_number'),
                'contract_start_date' => $request->input('contract_start_date'),
                'contract_end_date' => $request->input('contract_end_date'),
            ]);

            return redirect()
                ->back()
                ->with('success', 'Client created successfully');

        } catch(\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error creating client - '.$e->getMessage());
        }
    }

    public function edit($clientId)
    {
        //Get last login date of user
        $user = Auth::user();
        $userActivity = new UserActivity;
        $lastLoginDate = $userActivity->getLastLoginDate($user['id']);

        $client = Client::find($clientId);

        return view('accountmanager.client.edit',
            compact(
                'lastLoginDate',
                'client',
            )
        );
    }

    public function update(Request $request, $clientId)
    {
        try {
            // Fetch the existing client
            $existingClient = Client::find($clientId);

            $validatedData = $request->validate([
                'name' => 'required|string',
                'code' => 'required|string|unique:clients,code,' . $clientId,
            ]);

            // Check if the 'code' field is unchanged
            if ($existingClient->code === $validatedData['code']) {
                // If unchanged, remove the 'unique' rule
                unset($validatedData['code']);
            }

            $client = Client::where('id', $clientId);

            $existingClient->update($validatedData);

            //log activity
            logUserActivity(auth()->user()->id, 'update-client', 'Updated client ID '.$clientId.' - '.$validatedData['name']);

            return redirect()
                ->back()
                ->with('success', 'Client updated successfully');
        } catch(\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Failed updating client. '.$e->getMessage());
        }
    }


    public function confirmDelete($clientId)
    {
        //Get last login date of user
        $user = Auth::user();
        $userActivity = new UserActivity;
        $lastLoginDate = $userActivity->getLastLoginDate($user['id']);

        $client = Client::findOrFail($clientId);

        return view('accountmanager.client.confirmdelete',
            compact(
                'client',
                'clientId',
                'user',
                'lastLoginDate'
            )
        );
    }

    public function destroy($clientId)
    {
        Client::where('id', $clientId)->delete();

        return redirect()
            ->route('accountmanager.clients.index')
            ->with('success', 'Client deleted successfully');
    }

    public function show($clientId)
    {
        //Get last login date of user
        $user = Auth::user();
        $userActivity = new UserActivity;
        $lastLoginDate = $userActivity->getLastLoginDate($user['id']);

        // Retrieve the client data based on the ID from the URL
        $client = Client::find($clientId);

        // Retrieve client types
        $clientTypes = ClientType::all();

        // Retrieve client contacts for the specified client_id
        $clientContacts = ClientContact::where('client_id', $clientId)->get();

        // Retrieve client info for the specified client_id
        $clientInfo = ClientInfo::where('client_id', $clientId)->first();

        return view('accountmanager.client.show',
            compact(
                'client',
                'clientTypes',
                'lastLoginDate',
                'clientContacts',
                'clientInfo',
            )
        );
    }

    public function toggleStatus(Request $request, $clientId)
    {
        try {
            $status = $request->input('status_id');

            $client = Client::findOrFail($clientId);

            // Ensure that the clientContact record belongs to the specified client
            if ($client->id == $clientId) {
                $client->status_id = $status;
                $client->save();

                //log activity
                logUserActivity(auth()->user()->id, 'update-client-status', 'Changed client - '.$client->name.'\'s status to '.$status);

                return redirect()
                    ->back()
                    ->with('success', 'Status updated successfully');
            } else {
                // The clientContact record does not belong to the specified client
                return redirect()->
                    back()->
                    with('error', 'Client Contact does not exist or does not belong to the client.');
            }
        } catch (\Exception $e) {
            // Handle exceptions (e.g., record not found)
            return redirect()
                ->back()
                ->with('error', 'Error updating client VIP status');
        }
    }

    public function getUnassignedClients($accountManagerId)
    {
        // Fetch unassigned clients based on the specified conditions
        $unassignedClients = Client::with('users')
            ->select('id', 'name') // Add the necessary columns
            ->whereDoesntHave('users')
            ->where('accountmanager_user_id', $accountManagerId)
            ->orderBy('name', 'asc')
            ->get();

        // Transform client names to all caps
        $unassignedClients->transform(function ($client) {
            $client->name = strtoupper($client->name);
            return $client;
        });

        return response()->json($unassignedClients);
    }

    public function updateAccountManager(Request $request)
    {
        try {
            // Get the selected client IDs from the form
            $clientIds = $request->input('unassigned_clients_select');

            // Get the selected account manager ID from the form
            $accountManagerId = $request->input('assign_account_manager');

            // Check if any clients are selected
            if (!empty($clientIds)) {
                // Perform the update only if clients are selected
                Client::updateAccountManager($clientIds, $accountManagerId);

                // Redirect or return a success response
                return redirect()
                    ->back()
                    ->with('success', 'Account manager updated successfully');
            } else {
                // Redirect or return a response indicating that no clients were selected
                return redirect()
                ->back()
            ->with('error', 'No client/s selected');
            }

        } catch(\Exception $e) {
            // Handle exceptions (e.g., record not found)
            return redirect()
                ->back()
                ->with('error', 'Error updating Account manager');
        }
    }

}
