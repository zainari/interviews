<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.categories.index', compact('category'));
    }
    
    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ], [
            'name.unique' => 'This category name already exists.',
        ]);

        $category = Category::create($validatedData);

        return $category
            ? redirect()->route('categories.index')->with('success', ' Category created successfully!')
            : back()->with('error', 'Failed to create category.')->withInput();
    }

    public function update(Request $request, $id)
    {
     $validatedData = $request->validate([
         'name' => 'required|string|max:255',
     ]);
     $category = Category::findOrFail($id);
     $category->update($validatedData);
     if($category){
         return redirect()->route('categories.index')->with('success', 'Category updated successfully.');   
    }else{
        return back()->with('error', 'Failed to update category.')->withInput();
    }
    }

    public function destroy($id)
    {
     $category = Category::findOrFail($id);
     $category->delete();
     if($category){
         return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }else{
        return back()->with('error', 'Failed to delete category.');
    }
    }
}
