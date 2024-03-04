<?php

namespace App\Http\Controllers;

use App\Models\Airlines;
use App\Models\Category;
use App\Models\Client;
use App\Models\ClientAncilliaryFee;
use App\Models\ClientBooker;
use App\Models\ClientBookingProcess;
use App\Models\ClientContact;
use App\Models\ClientFareReference;
use App\Models\ClientFee;
use App\Models\ClientHotelCorporateCode;
use App\Models\ClientInvoiceAttachment;
use App\Models\ClientPreferredAirline;
use App\Models\ClientPricingModel;
use App\Models\ClientReportingElement;
use App\Models\ClientTravelPolicy;
use App\Models\ClientTravelSecurity;
use App\Models\ClientVip;
use App\Models\Hotel;
use App\Models\PricingmodelType;
use App\Models\Route;
use App\Models\Source;
use App\Models\User;
use App\Models\UserActivity;
use App\Models\UserClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {   
        $user = Auth::user();

        // Get user last login date
        $userActivity = new UserActivity;
        $lastLoginDate = $userActivity->getLastLoginDate($user->id);
        
        // Your Account Manager dashboard logic here
        return view('accountmanager.client.index', compact('lastLoginDate'));
    }

    public function assignClient() 
    {   
        $user = Auth::user();

        // Get user last login date
        $userActivity = new UserActivity;
        $lastLoginDate = $userActivity->getLastLoginDate($user->id);
        
        // Retrieve the selected user ID from the request
        $selectedUserId = request()->input('user_id');

        // Fetch owned clients for the selected user
        $ownedClients = UserClient::where('user_id', $selectedUserId)->pluck('client_id')->toArray();

        // Fetch all UserClient client IDs
        $userClientIds = UserClient::distinct()->pluck('client_id')->toArray();

        // Fetch available clients (clients not owned by the selected user)
        $availableClients = Client::join('user_clients', 'clients.id', '=', 'user_clients.client_id')
            ->whereColumn('user_clients.client_id', '<>', 'clients.id')
            ->distinct()
            ->get(['clients.*']);

        // Fetch the selected user (you may want to pass this to preselect the dropdown)
        $selectedUser = User::find($selectedUserId);

        // Retrieve users with role_id of 2
        $travelConsultants = User::where('role_id', 2)->get();

        return view('accountmanager.client.assign', 
            compact('user', 
                'lastLoginDate', 
                'travelConsultants', 
                'selectedUser', 
                'ownedClients', 
                'availableClients',
            )
        );
    }

    public function updateUserClients(Request $request)
    {
        $user = Auth::user();
        // Form inputs
        $travelConsultants = $request->input('user_id');
        $selectedClients = $request->input('owned_clients', []);

        // Get the current user's owned clients
        $currentUserClients = UserClient::join('clients', 'clients.id', 'user_clients.client_id')
            ->where('user_clients.user_id', $travelConsultants)
            ->where('clients.accountmanager_user_id', $user['id'])
            ->pluck('user_clients.client_id')->toArray();

        // Identify clients to be added and removed
        $clientsToAdd = array_diff($selectedClients, $currentUserClients);
        $clientsToRemove = array_diff($currentUserClients, $selectedClients);

        // Add new clients
        foreach ($clientsToAdd as $clientId) {
            UserClient::create([
                'user_id' => $travelConsultants,
                'client_id' => $clientId,
            ]);

            //log activity
            logUserActivity(auth()->user()->id, 'assign-client', 'Assigned client ID - '. $clientId .' to User ID - '. $travelConsultants);
        }

        // Remove clients that are no longer selected
        UserClient::where('user_id', $travelConsultants)
            ->whereIn('client_id', $clientsToRemove)
            ->delete();

        foreach($clientsToRemove as $removedClient) {
            //log activity
            logUserActivity(auth()->user()->id, 'unassign-client', 'Unassigned client ID/s - '. $removedClient .' from User ID - '. $travelConsultants);
        }

        return redirect()->back()->with('success', 'Assigned clients successfully');
    }

    public function createVip($clientId)
    {
        try {
            // Get last login date of user
            $user = Auth::user();

            // Get user last login date
            $userActivity = new UserActivity;
            $lastLoginDate = $userActivity->getLastLoginDate($user->id);
    
            // Retrieve the client data based on the ID from the URL
            $client = Client::findOrFail($clientId);
    
            // Retrieve VIP list
            $vips = ClientVip::where('client_id', $clientId)->get();
    
            return view('accountmanager.client.vip.createvip', 
                compact('user', 
                    'lastLoginDate', 
                    'client', 
                    'vips', 
                    'clientId',
                )
            );
        } catch (\Exception $e) {
            // Handle exceptions here (e.g., client not found, database error)
            return redirect()->route('error.404'); // Redirect to a 404 error page or show an error message.
        }
    }

    public function createContact($clientId)
    {
        try {
            $user = Auth::user();

            // Get user last login date
            $userActivity = new UserActivity;
            $lastLoginDate = $userActivity->getLastLoginDate($user->id);
    
            // Retrieve the client data based on the ID from the URL
            $client = Client::findOrFail($clientId);
    
            // Retrieve VIP list
            $contacts = ClientContact::where('client_id', $clientId)->get();

            return view('accountmanager.client.contact.createcontact', 
                compact('user', 
                    'lastLoginDate', 
                    'client', 
                    'contacts', 
                    'clientId',
                )
            );
        } catch (\Exception $e) {
            // Handle exceptions here (e.g., client not found, database error)
            return redirect()->route('error.404'); // Redirect to a 404 error page or show an error message.
        }
    }

    public function createBooker($clientId) 
    {
        try {
            // Get last login date of user
            $user = Auth::user();

            // Get user last login date
            $userActivity = new UserActivity;
            $lastLoginDate = $userActivity->getLastLoginDate($user->id);
    
            // Retrieve the client data based on the ID from the URL
            $client = Client::findOrFail($clientId);

            // Retrive client booker steps
            $existingSteps = ClientBooker::where('client_id', $clientId)
                ->orderBy('order_number', 'asc')
                ->get();
    
    
            return view('accountmanager.client.booker.createbooker', 
                compact('user', 
                    'lastLoginDate', 
                    'client', 
                    'clientId', 
                    'existingSteps',
                )
            );
        } catch (\Exception $e) {
            // Handle exceptions here (e.g., client not found, database error)
            return view('errors.404'); // Redirect to a 404 error page or show an error message.
        }
    }

    public function pricingModel($clientId) 
    {
        try {
            // Get last login date of user
            $user = Auth::user();
            $routes = Route::all();
            $pricingModelTypes = PricingmodelType::all();

            // Get user last login date
            $userActivity = new UserActivity;
            $lastLoginDate = $userActivity->getLastLoginDate($user->id);
    
            // Retrieve the client data based on the ID from the URL
            $client = Client::findOrFail($clientId);

            // Fetch client pricing model data and replace IDs with names
            $clientPricingModels = ClientPricingModel::where('client_id', $clientId)
            ->with('route', 'pricingModelType')
            ->get();
    
            return view('accountmanager.client.pricingandfinancial.pricingmodel', 
                compact('user', 
                    'lastLoginDate', 
                    'client', 
                    'clientId', 
                    'routes', 
                    'pricingModelTypes', 
                    'clientPricingModels'
                )
            );
        } catch (\Exception $e) {
            // Handle exceptions here (e.g., client not found, database error)
            return view('errors.404'); // Redirect to a 404 error page or show an error message.
        }
    }

    public function fareReference($clientId) 
    {
        try {
            // Get last login date of user
            $user = Auth::user();

            // Get user last login date
            $userActivity = new UserActivity;
            $lastLoginDate = $userActivity->getLastLoginDate($user->id);
    
            // Retrieve the client data based on the ID from the URL
            $client = Client::findOrFail($clientId);

            // Get Fare Reference
            $clientFareReferences = ClientFareReference::where('client_id', $clientId)->get();

            return view('accountmanager.client.pricingandfinancial.farereference', 
                compact('user', 
                    'lastLoginDate', 
                    'client', 
                    'clientId', 
                    'clientFareReferences',
                )
            );
        } catch (\Exception $e) {
            // Handle exceptions here (e.g., client not found, database error)
            return view('errors.404'); // Redirect to a 404 error page or show an error message.
        }
    }

    public function ancilliaryFees($clientId) 
    {
        try {
            // Get last login date of user
            $user = Auth::user();

            // Get user last login date
            $userActivity = new UserActivity;
            $lastLoginDate = $userActivity->getLastLoginDate($user->id);
    
            // Retrieve the client data based on the ID from the URL
            $client = Client::findOrFail($clientId);

            // Get Fare Reference
            $clientAncilliaryFees = ClientAncilliaryFee::where('client_id', $clientId)->get();

            return view('accountmanager.client.pricingandfinancial.ancilliaryfees', 
                compact(
                    'user', 
                    'lastLoginDate', 
                    'client', 
                    'clientId', 
                    'clientAncilliaryFees',
                )
            );
        } catch (\Exception $e) {
            // Handle exceptions here (e.g., client not found, database error)
            return view('errors.404'); // Redirect to a 404 error page or show an error message.
        }
    }

    public function tableOfFees($clientId) 
    {
        try {
            // Get last login date of user
            $user = Auth::user();

            // Get user last login date
            $userActivity = new UserActivity;
            $lastLoginDate = $userActivity->getLastLoginDate($user->id);
    
            // Retrieve the client data based on the ID from the URL
            $client = Client::findOrFail($clientId);

            // Get client fees
            $clientFees = ClientFee::where('client_id', $clientId)->get();

            // Get Source reference
            $sources = Source::all();

            // Get routes
            $routes = Route::where('status_id', 1)->get();

            // Get categories
            $categories = Category::all();

            // Loop through $clientFees and add "route" and "source" properties
            $clientFeesWithRouteAndSource = [];
            foreach ($clientFees as $fee) {
                $categoryId = $fee->category_id;
                $routeId = $fee->route_id;
                $sourceId = $fee->source_id;

                // Find the associated "route" and "source" by their IDs
                $category = $categories->firstWhere('id', $categoryId);
                $route = $routes->firstWhere('id', $routeId);
                $source = $sources->firstWhere('id', $sourceId);

                // Add "route" and "source" properties to the fee object
                $fee->category = $category->name ?? null;
                $fee->route = $route->name ?? null;
                $fee->source = $source->name ?? null;

                $clientFeesWithRouteAndSource[] = $fee;
            }

            return view('accountmanager.client.pricingandfinancial.tableoffees', 
                compact(
                    'user', 
                    'lastLoginDate', 
                    'client', 
                    'clientId', 
                    'clientFeesWithRouteAndSource', 
                    'sources', 
                    'routes',
                    'categories',
                )
            );
        } catch (\Exception $e) {
            // Handle exceptions here (e.g., client not found, database error)
            return view('errors.404'); // Redirect to a 404 error page or show an error message.
        }
    }

    public function invoiceAttachment($clientId) 
    {
        try {
            // Get last login date of user
            $user = Auth::user();

            // Get user last login date
            $userActivity = new UserActivity;
            $lastLoginDate = $userActivity->getLastLoginDate($user->id);
    
            // Retrieve the client data based on the ID from the URL
            $client = Client::findOrFail($clientId);

            // Get Client Attachments
            $clientInvoiceAttachments = ClientInvoiceAttachment::where('client_id', $clientId)->get();

            return view('accountmanager.client.pricingandfinancial.invoiceattachment', 
                compact('user', 
                    'lastLoginDate', 
                    'client', 
                    'clientId', 
                    'clientInvoiceAttachments'
                )
            );
        } catch (\Exception $e) {
            // Handle exceptions here (e.g., client not found, database error)
            return view('errors.404'); // Redirect to a 404 error page or show an error message.
        }
    }

    public function bookingProcess($clientId, $categoryId) 
    {
        try {
            // Get last login date of user
            $user = Auth::user();

            // Get user last login date
            $userActivity = new UserActivity;
            $lastLoginDate = $userActivity->getLastLoginDate($user->id);
    
            // Retrieve the client data based on the ID from the URL
            $client = Client::findOrFail($clientId);

            // Get routes
            $routes = Route::all();

            // Retrieve international booking process
            $existingStepsInternational = ClientBookingProcess::where('client_id', $clientId)
                ->where('route_id', 1)
                ->where('category_id', $categoryId)
                ->orderBy('order_number', 'asc')
                ->get();

            // Retrieve international booking process
            $existingStepsDomestic = ClientBookingProcess::where('client_id', $clientId)
                ->where('route_id', 2)
                ->where('category_id', $categoryId)
                ->orderBy('order_number', 'asc')
                ->get();
    
    
            return view('accountmanager.client.bookingprocess', 
                compact('user', 
                    'lastLoginDate', 
                    'client', 
                    'routes',
                    'clientId', 
                    'categoryId',
                    'existingStepsInternational',
                    'existingStepsDomestic',
                )
            );
        } catch (\Exception $e) {
            // Handle exceptions here (e.g., client not found, database error)
            return view('errors.404'); // Redirect to a 404 error page or show an error message.
        }
    }

    public function travelPolicy($clientId) 
    {
        try {
            // Get last login date of user
            $user = Auth::user();

            // Get user last login date
            $userActivity = new UserActivity;
            $lastLoginDate = $userActivity->getLastLoginDate($user->id);
    
            // Retrieve the client data based on the ID from the URL
            $client = Client::findOrFail($clientId);

            // Get client's travel policy
            $travelPolicy = ClientTravelPolicy::where('client_id', $clientId)->get();

            return view('accountmanager.client.air.travelpolicy', 
                compact('user', 
                    'lastLoginDate', 
                    'client', 
                    'clientId', 
                    'travelPolicy',
                )
            );
        } catch (\Exception $e) {
            // Handle exceptions here (e.g., client not found, database error)
            return view('errors.404'); // Redirect to a 404 error page or show an error message.
        }
    }

    public function preferredAirlines($clientId) 
    {
        try {
            // Get last login date of user
            $user = Auth::user();

            // Get user last login date
            $userActivity = new UserActivity;
            $lastLoginDate = $userActivity->getLastLoginDate($user->id);
    
            // Retrieve the client data based on the ID from the URL
            $client = Client::findOrFail($clientId);

            // Get airlines
            $airlines = Airlines::orderBy('name', 'asc')->get();

            // Get client's existing international airlines
            $internationalAirlines = ClientPreferredAirline::where('client_id', $clientId)
                ->where('route_id', 1)
                ->get();

            // Get client's existing domestic airlines
            $domesticAirlines = ClientPreferredAirline::where('client_id', $clientId)
                ->where('route_id', 2)
                ->get();

            return view('accountmanager.client.air.airlines', 
                compact('user', 
                    'lastLoginDate', 
                    'client', 
                    'clientId', 
                    'airlines',
                    'internationalAirlines',
                    'domesticAirlines',
                )
            );
        } catch (\Exception $e) {
            // Handle exceptions here (e.g., client not found, database error)
            return view('errors.404'); // Redirect to a 404 error page or show an error message.
        }
    }

    public function travelSecurity($clientId) 
    {
        try {
            // Get last login date of user
            $user = Auth::user();

            // Get user last login date
            $userActivity = new UserActivity;
            $lastLoginDate = $userActivity->getLastLoginDate($user->id);
    
            // Retrieve the client data based on the ID from the URL
            $client = Client::findOrFail($clientId);

            // Get client's travel policy
            $travelSecurity = ClientTravelSecurity::where('client_id', $clientId)->get();

            return view('accountmanager.client.air.travelsecurity', 
                compact('user', 
                    'lastLoginDate', 
                    'client', 
                    'clientId', 
                    'travelSecurity',
                )
            );
        } catch (\Exception $e) {
            // Handle exceptions here (e.g., client not found, database error)
            return view('errors.404'); // Redirect to a 404 error page or show an error message.
        }
    }

    public function hotelCorporateCode($clientId) 
    {
        try {
            // Get last login date of user
            $user = Auth::user();

            // Get user last login date
            $userActivity = new UserActivity;
            $lastLoginDate = $userActivity->getLastLoginDate($user->id);
    
            // Retrieve the client data based on the ID from the URL
            $client = Client::findOrFail($clientId);

            // Get routes
            $routes = Route::all();

            // Get hotels
            $hotels = Hotel::all();

            // Get client's hotels
            $hotelCorporateCode = ClientHotelCorporateCode::where('client_id', $clientId)
                ->get();

            return view('accountmanager.client.hotel.hotelcorporatecode', 
                compact('user', 
                    'lastLoginDate', 
                    'client', 
                    'clientId', 
                    'routes',
                    'hotels',
                    'hotelCorporateCode',
                )
            );
        } catch (\Exception $e) {
            // Handle exceptions here (e.g., client not found, database error)
            return view('errors.404'); // Redirect to a 404 error page or show an error message.
        }
    }

    public function reportingElements($clientId) 
    {
        try {
            // Get last login date of user
            $user = Auth::user();

            // Get user last login date
            $userActivity = new UserActivity;
            $lastLoginDate = $userActivity->getLastLoginDate($user->id);
    
            // Retrieve the client data based on the ID from the URL
            $client = Client::findOrFail($clientId);

            // Retrieve Reporting Elements
            $elements = ClientReportingElement::where('client_id', $clientId)->get();

            return view('accountmanager.client.reportingelements', 
                compact('user', 
                    'lastLoginDate', 
                    'client', 
                    'clientId', 
                    'elements',
                )
            );
        } catch (\Exception $e) {
            // Handle exceptions here (e.g., client not found, database error)
            return view('errors.404'); // Redirect to a 404 error page or show an error message.
        }
    }

}

