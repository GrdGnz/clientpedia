<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Route;

class RouteController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|max:255'
            ]);

            Route::create($validatedData);

            return redirect()->back()->with('success','Successfully added new route');

        } catch(\Exception $e) {
            return redirect()->back()->with('error','Failed adding category - '.$e->getMessage());
        }
    }

    public function destroy(Request $request) 
    {
        try {   
            $routeId = $request->input('id');

            $route = Route::findOrFail($routeId);

            $route->delete();

            return redirect()->back()->with('success','Successfully deleted route.');

        } catch(\Exception $e) {
            return redirect()->back()->with('error','Failed deleting route - '. $e->getMessage());
        }
    }
}
