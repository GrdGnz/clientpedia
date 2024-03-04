<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Source;

class SourceController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|max:255'
            ]);

            Source::create($validatedData);

            return redirect()->back()->with('success','Successfully added new source');

        } catch(\Exception $e) {
            return redirect()->back()->with('error','Failed adding source - '.$e->getMessage());
        }
    }

    public function destroy(Request $request) 
    {
        try {   
            $sourceId = $request->input('id');

            $source = Source::findOrFail($sourceId);

            $source->delete();

            return redirect()->back()->with('success','Successfully deleted source.');

        } catch(\Exception $e) {
            return redirect()->back()->with('error','Failed deleting source - '. $e->getMessage());
        }
    }
}
