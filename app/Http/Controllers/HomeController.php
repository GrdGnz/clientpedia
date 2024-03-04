<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        
        $userActivity = new UserActivity;
        $lastLoginDate = $user ? $userActivity->getLastLoginDate($user->id) : null;

        if($user->role_id == 1) {
            $clients = Client::where('accountmanager_user_id', $user['id'])->get();
            
            return view('accountmanager.client.index', 
                compact(
                    'clients',
                    'user',
                    'lastLoginDate',
                )
            );
        } elseif ($user->role_id == 2) { 
            
            $clients = $user->clients->where('status_id', 1);

            return view('travelconsultant.dashboard', 
                compact(
                    'user', 
                    'clients', 
                    'lastLoginDate',
                )
            );
        } else {
            $users = User::all();

            return view('administrator.dashboard', 
                compact(
                    'user',
                    'users',
                    'lastLoginDate',
                )
            );
        }
            
    }
}
