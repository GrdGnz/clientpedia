<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientAncilliaryFee;
use App\Models\ClientBooker;
use App\Models\ClientBookingProcess;
use App\Models\ClientContact;
use App\Models\ClientFareReference;
use App\Models\ClientFee;
use App\Models\ClientHotelCorporateCode;
use App\Models\ClientInfo;
use App\Models\ClientInvoiceAttachment;
use App\Models\ClientPreferredAirline;
use App\Models\ClientPricingModel;
use App\Models\ClientReportingElement;
use App\Models\ClientTravelPolicy;
use App\Models\ClientTravelSecurity;
use App\Models\ClientVip;
use App\Models\Route;
use App\Models\Source;
use App\Models\User;
use App\Models\UserActivity;
use App\Models\UserClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TravelConsultantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    { 
        $user = Auth::user();
        $clients = $user->clients->where('status_id', 1);

        // Get user's last login date
        $userActivity = new UserActivity;
        $lastLoginDate = $user ? $userActivity->getLastLoginDate($user->id) : null;

        return view('travelconsultant.dashboard', compact('clients','user','lastLoginDate'));
    }

    //pricing
    public function pricing($clientId)
    {
        $user = Auth::user();

        // Get user's last login date
        $userActivity = new UserActivity;
        $lastLoginDate = $user ? $userActivity->getLastLoginDate($user->id) : null;

        // Get client details
        $client = Client::find($clientId);

        // Get client pricing model
        // Fetch client pricing model data and replace IDs with names
        $clientPricingModels = ClientPricingModel::where('client_id', $clientId)
            ->with('route', 'pricingModelType')
            ->get();

        // Get client fare reference
        $clientFareReferences = ClientFareReference::where('client_id', $clientId)->get();

        // Get Ancilliary Fees
        $clientAncilliaryFees = ClientAncilliaryFee::where('client_id', $clientId)->get();

        // Get client fees
        $clientFees = ClientFee::where('client_id', $clientId)->get();

        // Get Source reference
        $sources = Source::all();

        // Get routes
        $routes = Route::where('status_id', 1)->get();

        // Loop through $clientFees and add "route" and "source" properties
        $clientFeesWithRouteAndSource = [];
        foreach ($clientFees as $fee) {
            $routeId = $fee->route_id;
            $sourceId = $fee->source_id;

            // Find the associated "route" and "source" by their IDs
            $route = $routes->firstWhere('id', $routeId);
            $source = $sources->firstWhere('id', $sourceId);

            // Add "route" and "source" properties to the fee object
            $fee->route = $route->name ?? null;
            $fee->source = $source->name ?? null;

            $clientFeesWithRouteAndSource[] = $fee;
        }

        // Get client invoice attachment
        $clientInvoiceAttachments = ClientInvoiceAttachment::where('client_id', $clientId)
            ->where('status_id', 1)
            ->get();

        $clientInvoiceAttachments = $clientInvoiceAttachments ?? [];

        return view('travelconsultant.pricing', 
            compact('client', 
                'lastLoginDate', 
                'clientPricingModels', 
                'clientFareReferences', 
                'clientAncilliaryFees', 
                'clientFeesWithRouteAndSource', 
                'clientInvoiceAttachments',
            )
        );
    }

    //profile management
    public function profileManagement($clientId)
    {
        $user = Auth::user();

        // Get user's last login date
        $userActivity = new UserActivity;
        $lastLoginDate = $user ? $userActivity->getLastLoginDate($user->id) : null;

        $client = Client::find($clientId);

        return view('travelconsultant.profilemanagement', compact('client','lastLoginDate'));
    }

    //vip
    public function vip($clientId)
    {
        $user = Auth::user();

        // Get user's last login date
        $userActivity = new UserActivity;
        $lastLoginDate = $user ? $userActivity->getLastLoginDate($user->id) : null;

        $client = Client::find($clientId);

        // Retrieve client vips for the specified client_id
        $clientVips = ClientVip::where('client_id', $clientId)
            ->where('status_id', 1)
            ->get();

        // Authorize the user to view the client
        $this->authorize('view', $client);

        return view('travelconsultant.vip', compact('client','lastLoginDate','clientVips'));
    }

    //client booker approver
    public function clientBookerApprover($clientId)
    {
        $user = Auth::user();

        // Get user's last login date
        $userActivity = new UserActivity;
        $lastLoginDate = $user ? $userActivity->getLastLoginDate($user->id) : null;
        $client = Client::find($clientId);

        // Retrieve steps
        $clientBooker = ClientBooker::where('client_id', $clientId)->get();

        // Retrieve modifier account manager
        $accountManager = User::where('id', $client->accountmanager_user_id)->get();

        // Authorize the user to view the client
        $this->authorize('view', $client);

        return view('travelconsultant.clientbookerapprover', compact('client','lastLoginDate', 'clientBooker', 'accountManager'));
    }

    //booking process
    public function bookingProcess($clientId)
    {
        $user = Auth::user();

        // Get user's last login date
        $userActivity = new UserActivity;
        $lastLoginDate = $user ? $userActivity->getLastLoginDate($user->id) : null;
        $client = Client::find($clientId);

        // Authorize the user to view the client
        $this->authorize('view', $client);

        return view('travelconsultant.bookingprocess', compact('client','lastLoginDate'));
    }

    //basic info
    public function basicInfo($clientId)
    {
        $user = Auth::user();

        // Get user's last login date
        $userActivity = new UserActivity;
        $lastLoginDate = $user ? $userActivity->getLastLoginDate($user->id) : null;

        // Retrieve the client data based on the ID from the URL
        $client = Client::find($clientId);

        // Retrieve the client's basic info
        $clientInfo = ClientInfo::where('client_id', $clientId)->get();

        // Retrieve client contacts for the specified client_id
        $clientContacts = ClientContact::where('client_id', $clientId)
            ->where('status_id', 1)
            ->get();

        // Authorize the user to view the client
        $this->authorize('view', $client);

        if (!$client) {
            // Handle the case where the client with the given ID is not found, e.g., show an error message or redirect
            return redirect()->route('travelconsultant.dashboard')->with('error', 'Client not found');
        }

        // Pass the client data to the view
        return view('travelconsultant.basicinfo', compact('client', 'lastLoginDate', 'clientContacts', 'clientInfo'));
    }

    //air
    public function air($clientId)
    {
        $user = Auth::user();

        // Get user's last login date
        $userActivity = new UserActivity;
        $lastLoginDate = $user ? $userActivity->getLastLoginDate($user->id) : null;

        $client = Client::find($clientId);

        // Get Air Booking Process
        // International
        $bookingprocessInternational = ClientBookingProcess::where('client_id', $clientId)
            ->where('route_id', 1)
            ->where('category_id', 1)
            ->get();
        
        // Domestic
        $bookingprocessDomestic = ClientBookingProcess::where('client_id', $clientId)
            ->where('route_id', 2)
            ->where('category_id', 1)
            ->get();

        // Get Air Travel Policy
        $travelPolicy = ClientTravelPolicy::where('client_id', $clientId)
            ->where('category_id', 1)
            ->get();

        // Get client's existing international airlines
        $internationalAirlines = ClientPreferredAirline::where('client_id', $clientId)
            ->where('route_id', 1)
            ->get();

        // Get client's existing domestic airlines
        $domesticAirlines = ClientPreferredAirline::where('client_id', $clientId)
            ->where('route_id', 2)
            ->get();

        // Get client's travel security
        $travelSecurity = ClientTravelSecurity::where('client_id', $clientId)->get();

        // Authorize the user to view the client
        $this->authorize('view', $client);

        return view('travelconsultant.air', 
            compact('client',
                'lastLoginDate', 
                'bookingprocessInternational',
                'bookingprocessDomestic',
                'travelPolicy',
                'internationalAirlines',
                'domesticAirlines',
                'travelSecurity',
            )
        );
    }

    //hotel
    public function hotel($clientId)
    {
        $user = Auth::user();

        // Get user's last login date
        $userActivity = new UserActivity;
        $lastLoginDate = $user ? $userActivity->getLastLoginDate($user->id) : null;

        $client = Client::find($clientId);

        // Authorize the user to view the client
        $this->authorize('view', $client);

        // Get Hotel Booking Process
        // International
        $bookingprocessInternational = ClientBookingProcess::where('client_id', $clientId)
            ->where('route_id', 1)
            ->where('category_id', 2)
            ->get();
        
        // Domestic
        $bookingprocessDomestic = ClientBookingProcess::where('client_id', $clientId)
            ->where('route_id', 2)
            ->where('category_id', 2)
            ->get();

        $hotelCorporateCode = ClientHotelCorporateCode::where('client_id', $clientId)->get();

        return view('travelconsultant.hotel', 
            compact(
                'client',
                'lastLoginDate',
                'bookingprocessInternational',
                'bookingprocessDomestic',
                'hotelCorporateCode',
            )
        );
    }

    //car
    public function car($clientId)
    {
        $user = Auth::user();

        // Get user's last login date
        $userActivity = new UserActivity;
        $lastLoginDate = $user ? $userActivity->getLastLoginDate($user->id) : null;

        $client = Client::find($clientId);

        // Authorize the user to view the client
        $this->authorize('view', $client);

        // Get Hotel Booking Process
        // International
        $bookingprocessInternational = ClientBookingProcess::where('client_id', $clientId)
            ->where('route_id', 1)
            ->where('category_id', 3)
            ->get();
        
        // Domestic
        $bookingprocessDomestic = ClientBookingProcess::where('client_id', $clientId)
            ->where('route_id', 2)
            ->where('category_id', 3)
            ->get();

        return view('travelconsultant.car', 
            compact(
                'client',
                'lastLoginDate',
                'bookingprocessInternational',
                'bookingprocessDomestic',
            )
        );
    }

    //car transfer
    public function carTransfer($clientId)
    {
        $user = Auth::user();

        // Get user's last login date
        $userActivity = new UserActivity;
        $lastLoginDate = $user ? $userActivity->getLastLoginDate($user->id) : null;

        $client = Client::find($clientId);

        // Authorize the user to view the client
        $this->authorize('view', $client);

        // Get Hotel Booking Process
        // International
        $bookingprocessInternational = ClientBookingProcess::where('client_id', $clientId)
            ->where('route_id', 1)
            ->where('category_id', 4)
            ->get();
        
        // Domestic
        $bookingprocessDomestic = ClientBookingProcess::where('client_id', $clientId)
            ->where('route_id', 2)
            ->where('category_id', 4)
            ->get();

        return view('travelconsultant.cartransfer', 
            compact(
                'client',
                'lastLoginDate',
                'bookingprocessInternational',
                'bookingprocessDomestic',
            )
        );
    }

    //documentation
    public function documentation($clientId)
    {
        $user = Auth::user();

        // Get user's last login date
        $userActivity = new UserActivity;
        $lastLoginDate = $user ? $userActivity->getLastLoginDate($user->id) : null;

        $client = Client::find($clientId);

        // Authorize the user to view the client
        $this->authorize('view', $client);

        // Get Hotel Booking Process
        // International
        $bookingprocessInternational = ClientBookingProcess::where('client_id', $clientId)
            ->where('route_id', 1)
            ->where('category_id', 5)
            ->get();
        
        // Domestic
        $bookingprocessDomestic = ClientBookingProcess::where('client_id', $clientId)
            ->where('route_id', 2)
            ->where('category_id', 5)
            ->get();

        return view('travelconsultant.documentation', 
            compact(
                'client',
                'lastLoginDate',
                'bookingprocessInternational',
                'bookingprocessDomestic',
            )
        );
    }

    //reporting elements
    public function reportingElements($clientId)
    {
        $user = Auth::user();

        // Get user's last login date
        $userActivity = new UserActivity;
        $lastLoginDate = $user ? $userActivity->getLastLoginDate($user->id) : null;
        
        $client = Client::find($clientId);

        $reportingElements = ClientReportingElement::where('client_id', $clientId)->get();

        // Authorize the user to view the client
        $this->authorize('view', $client);

        return view('travelconsultant.reportingelements', 
            compact(
                'client',
                'lastLoginDate',
                'reportingElements',
            )
        );
    }

    public function showClient($id)
    {
        // Retrieve the client by ID from your database
        $client = Client::find($id);
    
        if (!$client) {
            // Handle the case where the client with the given ID doesn't exist
            abort(404);
        }
    
        // Authorize the user to view the client
        $this->authorize('view', $client);
    
        // Get the currently authenticated user (travel consultant)
        $user = Auth::user();
    
        // Get user's last login date
        $userActivity = new UserActivity;
        $lastLoginDate = $user ? $userActivity->getLastLoginDate($user->id) : null;
    
        // Load the client detail view and pass the client data to it
        return view('travelconsultant.dashboard', compact('client', 'user', 'lastLoginDate'));
    }
}
    