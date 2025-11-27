<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'attributes'])->paginate(10);
        // dd($products);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $attributes = Attribute::with('values')->get(); 
        
        return view('admin.products.form', compact('categories', 'attributes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'sku'          => 'required|string|max:255|unique:products,sku',
            'category_id'  => 'required|exists:categories,id',
            'price'        => 'required|numeric|min:0',
            'stock'        => 'nullable|integer|min:0',
            'brand'        => 'nullable|string|max:255',
            'description'  => 'nullable|string',
            'available_from' => 'nullable|date',
            'available_to'   => 'nullable|date|after_or_equal:available_from',
            'is_active'    => 'nullable|boolean',
            'image_url'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        $imagePath = null;
        if ($request->hasFile('image_url')) {
            $imagePath = $request->file('image_url')->store('products', 'public');
        }
        
        $product = Product::create([
            'name'           => $request->name,
            'sku'            => $request->sku,
            'category_id'    => $request->category_id,
            'brand'          => $request->brand,
            'price'          => $request->price,
            'stock'          => $request->stock ?? 0,
            'description'    => $request->description,
            'is_active'      => $request->is_active ?? 1,
            'available_from' => $request->available_from,
            'available_to'   => $request->available_to,
            'image_url'      => $imagePath,
        ]);


        if ($request->filled('attributes')) {
            $allValueIds = collect($request->input('attributes'))->flatten()->filter()->unique();
            $values = \App\Models\AttributeValue::whereIn('id', $allValueIds)->get()->keyBy('id');
        
            foreach ($request->input('attributes') as $attributeId => $valueIds) {
                foreach ((array) $valueIds as $valueId) {
                    if ($values->has($valueId)) {
                        \App\Models\ProductAttribute::create([
                            'product_id'   => $product->id,
                            'attribute_id' => $attributeId,
                            'value'        => $values[$valueId]->value,
                        ]);
                    }
                }
            }
        }
        

        return redirect()->route('products.index')->with('success', ' Product created successfully with attributes!');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $attributes = Attribute::with('values')->get();
        // dd($attributes);
        $selectedAttributes = $product->attributes
        ->groupBy('pivot.attribute_id')
        ->map(fn($group) => $group->pluck('pivot.value')->toArray());

        return view('admin.products.edit', compact('product', 'categories', 'attributes', 'selectedAttributes'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'sku'            => 'required|string|max:255|unique:products,sku,' . $product->id,
            'category_id'    => 'required|exists:categories,id',
            'price'          => 'required|numeric|min:0',
            'stock'          => 'nullable|integer|min:0',
            'brand'          => 'nullable|string|max:255',
            'description'    => 'nullable|string',
            'available_from' => 'nullable|date',
            'available_to'   => 'nullable|date|after_or_equal:available_from',
            'is_active'      => 'nullable|boolean',
            'image_url'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        if ($request->hasFile('image_url')) {
            if ($product->image_url && Storage::disk('public')->exists($product->image_url)) {
                Storage::disk('public')->delete($product->image_url);
            }
            $validated['image_url'] = $request->file('image_url')->store('products', 'public');
        } else {
            $validated['image_url'] = $product->image_url;
        }
    
        $request->merge([
            'is_active' => $request->input('is_active', 0),
        ]);
        
    
        $product->update($validated);
    
        if ($request->filled('attributes')) {
            // Remove old attributes first
            ProductAttribute::where('product_id', $product->id)->delete();
        
            $allValueIds = collect($request->input('attributes'))->flatten()->filter()->unique();
            $values = \App\Models\AttributeValue::whereIn('id', $allValueIds)->get()->keyBy('id');
        
            foreach ($request->input('attributes') as $attributeId => $valueIds) {
                foreach ((array) $valueIds as $valueId) {
                    if ($values->has($valueId)) {
                        ProductAttribute::create([
                            'product_id'   => $product->id,
                            'attribute_id' => $attributeId,
                            'value'        => $values[$valueId]->value,
                        ]);
                    }
                }
            }
        }
        
    
        return redirect()->route('products.index')->with('success', 'Product updated successfully with attributes!');
    
    }
    

    public function destroy(Product $product)
    {
        if ($product->image_url && Storage::disk('public')->exists($product->image_url)) {
            Storage::disk('public')->delete($product->image_url);
        }

        ProductAttribute::where('product_id', $product->id)->delete();

        $product->delete();

        return redirect()->route('products.index')->with('success', ' Product deleted successfully!');
    }
}
