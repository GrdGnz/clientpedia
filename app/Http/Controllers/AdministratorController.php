<?php

namespace App\Http\Controllers;

use App\Models\Airlines;
use App\Models\Category;
use App\Models\Client;
use App\Models\ClientType;
use App\Models\Route;
use App\Models\Source;
use App\Models\User;
use App\Models\UserActivity;
use App\Models\UserClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdministratorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $userActivity = new UserActivity;
        $lastLoginDate = $userActivity->getLastLoginDate($user->id);

        // Get the total count of Users
        $users = User::all();

        return view('administrator.dashboard',
            compact(
                'lastLoginDate',
                'users',
            )
        );
    }

    public function showClients()
    {
        $user = Auth::user();
        $userActivity = new UserActivity;
        $lastLoginDate = $userActivity->getLastLoginDate($user->id);

        // Get the total count of Users
        $clients = Client::all();

        return view('administrator.clients',
            compact(
                'lastLoginDate',
                'clients',
            )
        );
    }

    public function createUser()
    {
        $user = Auth::user();

        // Get user's last login date
        $userActivity = new UserActivity;
        $lastLoginDate = $userActivity->getLastLoginDate($user->id);

        return view('administrator.createuser', compact('lastLoginDate', 'user'));
    }

    public function createClient()
    {
        $user = Auth::user();

        // Get client types
        $clientTypes = ClientType::all();

        // Get all account managers
        $accountManagers = User::where('role_id', 1)->get();

        // Get user's last login date
        $userActivity = new UserActivity;
        $lastLoginDate = $userActivity->getLastLoginDate($user->id);

        return view('administrator.createclient',
            compact(
                'lastLoginDate',
                'user',
                'clientTypes',
                'accountManagers',
            )
        );
    }

    public function showUserActivities()
    {
        try {
            $user = Auth::user();

            // Get user's last login date
            $userActivity = new UserActivity;
            $lastLoginDate = $userActivity->getLastLoginDate($user->id);

            // Retrieve user activities for users with user_role 1 and 2
            $userActivities = UserActivity::with('user')
                ->whereHas('user', function ($query) {
                    $query->whereIn('role_id', [1, 2]);
                })
                ->orderBy('created_at', 'desc')
                ->get();

            return view('administrator.activities', compact('userActivities', 'lastLoginDate'));

        } catch(\Exception $e) {
            return view('errors.403');
        }
    }

    public function assignClients()
    {
        try {
            $user = Auth::user();

            // Get user's last login date
            $userActivity = new UserActivity;
            $lastLoginDate = $userActivity->getLastLoginDate($user->id);

            $accountManagers = User::whereIn('role_id', [1, 3])->get();
            $travelConsultants = User::where('role_id', 2)->get();

            // Get unassigned clients (clients where accountmanager_user_id is not in user_clients table)
            $unassignedClients = Client::all();

            return view('administrator.assignclients',
                compact(
                    'lastLoginDate',
                    'accountManagers',
                    'travelConsultants',
                    'unassignedClients',
                )
            );

        } catch(\Exception $e) {
            return view('errors.403');
        }
    }

    public function assignClientsToAccountManager()
    {
        try {
            $user = Auth::user();

            // Get user's last login date
            $userActivity = new UserActivity;
            $lastLoginDate = $userActivity->getLastLoginDate($user->id);

            $accountManagers = User::whereIn('role_id', [1, 3])->get();
            $travelConsultants = User::where('role_id', 2)->get();

            // Get unassigned clients (clients where accountmanager_user_id is not in user_clients table)
            $unassignedClients = Client::whereNotIn('accountmanager_user_id', UserClient::pluck('user_id'))->get();

            return view('administrator.assignclientstoaccountmanager',
                compact(
                    'lastLoginDate',
                    'accountManagers',
                    'travelConsultants',
                    'unassignedClients',
                )
            );

        } catch(\Exception $e) {
            return view('errors.403');
        }
    }

    public function addCategories()
    {
        try {
            $user = Auth::user();

            // Get user's last login date
            $userActivity = new UserActivity;
            $lastLoginDate = $userActivity->getLastLoginDate($user->id);

            $categories = Category::all();

            return view('administrator.addcategories',
                compact(
                    'lastLoginDate',
                    'categories',
                )
            );

        } catch(\Exception $e) {
            return view('errors.403');
        }
    }

    public function addRoutes()
    {
        try {
            $user = Auth::user();

            // Get user's last login date
            $userActivity = new UserActivity;
            $lastLoginDate = $userActivity->getLastLoginDate($user->id);

            $routes = Route::all();

            return view('administrator.addroutes',
                compact(
                    'lastLoginDate',
                    'routes',
                )
            );

        } catch(\Exception $e) {
            return view('errors.403');
        }
    }

    public function addSources()
    {
        try {
            $user = Auth::user();

            // Get user's last login date
            $userActivity = new UserActivity;
            $lastLoginDate = $userActivity->getLastLoginDate($user->id);

            $sources = Source::all();

            return view('administrator.addsources',
                compact(
                    'lastLoginDate',
                    'sources',
                )
            );

        } catch(\Exception $e) {
            return view('errors.403');
        }
    }

    public function addAirlines()
    {
        try {
            $user = Auth::user();

            // Get user's last login date
            $userActivity = new UserActivity;
            $lastLoginDate = $userActivity->getLastLoginDate($user->id);

            $airlines = Airlines::all();

            return view('administrator.addairlines',
                compact(
                    'lastLoginDate',
                    'airlines',
                )
            );

        } catch(\Exception $e) {
            return view('errors.403');
        }
    }

}
