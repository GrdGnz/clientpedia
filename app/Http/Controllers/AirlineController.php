<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Airlines;

class AirlineController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'code' => 'required|max:255',
                'name' => 'required|max:255'
            ]);

            Airlines::create($validatedData);

            return redirect()->back()->with('success','Successfully added new airline');

        } catch(\Exception $e) {
            return redirect()->back()->with('error','Failed adding airline - '.$e->getMessage());
        }
    }

    public function update(Request $request) 
    {
        try {   
            $validatedData = $request->validate([
                'code' => 'required|max:255',
                'name' => 'required|max:255'
            ]);

            $airlineId = $request->input('id');

            $airline = Airlines::findOrFail($airlineId);

            $airline->update($validatedData);

            return redirect()->back()->with('success','Successfully updated airline.');

        } catch(\Exception $e) {
            return redirect()->back()->with('error','Failed updating airline - '. $e->getMessage());
        }
    }

    public function destroy(Request $request) 
    {
        try {   
            $airlineId = $request->input('id');

            $airline = Airlines::findOrFail($airlineId);

            $airline->delete();

            return redirect()->back()->with('success','Successfully deleted airline.');

        } catch(\Exception $e) {
            return redirect()->back()->with('error','Failed deleting airline - '. $e->getMessage());
        }
    }
}
