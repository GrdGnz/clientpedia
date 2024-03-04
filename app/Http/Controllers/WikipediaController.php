<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wikipedia; // Replace 'Wikipedia' with your actual model name

class WikipediaController extends Controller
{
    public function index()
    {
        // Retrieve Wikipedia content from the database
        $content = Wikipedia::all();

        // Pass the content to the view for display
        return view('wikipedia.index', compact('content'));
    }

    public function show($id)
    {
        // Retrieve a specific Wikipedia page by ID
        $page = Wikipedia::findOrFail($id);

        // Pass the page to the view for display
        return view('wikipedia.show', compact('page'));
    }

    public function edit($id)
    {
        // Retrieve a specific Wikipedia page by ID for editing
        $page = Wikipedia::findOrFail($id);

        // Pass the page to the edit view
        return view('wikipedia.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data here as needed

        // Update the Wikipedia page with the submitted data
        $page = Wikipedia::findOrFail($id);
        $page->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        // Redirect back to the Wikipedia page or a confirmation page
        return redirect()->route('wikipedia.show', ['id' => $page->id])
            ->with('success', 'Wikipedia page updated successfully');
    }
    
    // Add other methods as needed for creating, deleting, etc.
}