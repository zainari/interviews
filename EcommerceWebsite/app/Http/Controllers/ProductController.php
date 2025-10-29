<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.form', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
            'is_active' => 'boolean',
            'available_from' => 'nullable|date',
            'available_to' => 'nullable|date|after_or_equal:available_from',
            'sku' => 'required|string|unique:products,sku',
            'brand' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image_url')) {
            $validated['image_url'] = $request->file('image_url')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }
    
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'sku' => 'required|string|max:255|unique:products,sku,' . $product->id,
            'description' => 'nullable|string',
            'stock' => 'nullable|integer|min:0',
            'brand' => 'nullable|string|max:255',
            'available_from' => 'nullable|date',
            'available_to' => 'nullable|date|after:available_from',
            'image' => 'nullable|image|max:2048',
        ]);
    
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image_url'] = $path;
        }

        $validated['is_active'] = $request->boolean('is_active', false);


        $product->update($validated);
    
        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }
    



    public function destroy(Product $product)
    {
        // ✅ Delete image if exists
        if ($product->image_url && Storage::disk('public')->exists($product->image_url)) {
            Storage::disk('public')->delete($product->image_url);
        }
    
        // ✅ Delete product record
        $product->delete();
    
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
