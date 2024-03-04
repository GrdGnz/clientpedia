<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function show(User $user)
    {
        // You can access the user's data using the $user variable
        return view('dashboard', compact('user'));
    }
}
