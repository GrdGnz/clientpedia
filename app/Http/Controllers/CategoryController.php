<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|max:255'
            ]);

            Category::create($validatedData);

            return redirect()->back()->with('success','Successfully added new category');

        } catch(\Exception $e) {
            return redirect()->back()->with('error','Failed adding category - '.$e->getMessage());
        }
    }

    public function destroy(Request $request) 
    {
        try {   
            $categoryId = $request->input('id');

            $category = Category::findOrFail($categoryId);

            $category->delete();

            return redirect()->back()->with('success','Successfully deleted category.');

        } catch(\Exception $e) {
            return redirect()->back()->with('error','Failed deleting category - '. $e->getMessage());
        }
    }
}
