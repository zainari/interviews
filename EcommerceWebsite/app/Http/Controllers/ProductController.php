<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use App\Models\ProductSizeStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; 

class ProductController extends Controller
{
    // ===========================
    // ✅ ADMIN: LIST PRODUCTS
    // ===========================
    public function index()
    {
        $products = Product::with(['category', 'attributes'])->orderBy('id', 'desc')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    // ===========================
    // ✅ ADMIN: CREATE PAGE
    // ===========================
    public function create()
    {
        $categories = Category::all();
        $attributes = Attribute::with('values')->get(); 
        return view('admin.products.form', compact('categories', 'attributes'));
    }

    // ===========================
    // ✅ ADMIN: STORE PRODUCT
    // ===========================
    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'sku'            => 'required|string|max:255|unique:products,sku',
            'category_id'    => 'required|exists:categories,id',
            'price'          => 'required|numeric|min:0',
            'stock'          => 'nullable|integer', // Total stock
            'color_group_id' => 'nullable|string|max:255',
            'image_url'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'size_stock'     => 'nullable|array', // Size-wise stock array
        ]);

        // 1. Main Image Upload
        $imagePath = null;
        if ($request->hasFile('image_url')) {
            $imagePath = $request->file('image_url')->store('products', 'public');
        }

        // 2. Create Product with Slug
        $product = Product::create([
            'name'           => $request->name,
            'slug'           => Str::slug($request->name . '-' . $request->sku),
            'sku'            => $request->sku,
            'category_id'    => $request->category_id,
            'brand'          => $request->brand,
            'color_group_id' => $request->color_group_id,
            'price'          => $request->price,
            'stock'          => $request->stock ?? 0,
            'description'    => $request->description,
            'is_active'      => $request->is_active ?? 1,
            'available_from' => $request->available_from,
            'available_to'   => $request->available_to,
            'image_url'      => $imagePath,
        ]);

        // 3. Save Size-wise Stock (Inventory per Variant)
        if ($request->filled('size_stock')) {
            foreach ($request->size_stock as $sizeName => $qty) {
                if ($qty !== null) {
                    ProductSizeStock::create([
                        'product_id' => $product->id,
                        'size'       => $sizeName,
                        'stock'      => $qty
                    ]);
                }
            }
        }

        // 4. Gallery Upload
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $path = $file->store('products/gallery', 'public');
                ProductImage::create(['product_id' => $product->id, 'image_path' => $path]);
            }
        }

        // 5. Attributes (Colors/Sizes)
        if ($request->filled('attributes')) {
            foreach ($request->input('attributes') as $attributeId => $valueIds) {
                foreach ((array) $valueIds as $valueId) {
                    $attrVal = AttributeValue::find($valueId);
                    if ($attrVal) {
                        ProductAttribute::create([
                            'product_id'   => $product->id,
                            'attribute_id' => $attributeId,
                            'value'        => $attrVal->value,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('products.index')->with('success', 'Product and Size-Stock created!');
    }

    // ===========================
    // ✅ ADMIN: EDIT PAGE
    // ===========================
    public function edit(Product $product)
    {
        $categories = Category::all();
        $attributes = Attribute::with('values')->get();
        $product->load('images');

        $selectedAttributes = collect($product->attributes)
            ->groupBy('pivot.attribute_id')
            ->map(fn($group) => $group->pluck('pivot.value')->toArray());

        return view('admin.products.edit', compact('product', 'categories', 'attributes', 'selectedAttributes'));
    }

    // ===========================
    // ✅ ADMIN: UPDATE PRODUCT
    // ===========================
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'sku'            => 'required|string|max:255|unique:products,sku,' . $product->id,
            'category_id'    => 'required|exists:categories,id',
            'price'          => 'required|numeric|min:0',
            'size_stock'     => 'nullable|array',
        ]);
    
        // Sab data nikaalo siwaye files aur arrays ke
        $data = $request->except(['image_url', 'gallery', 'attributes', 'size_stock']);
    
        // Slug update
        $data['slug'] = Str::slug($request->name . '-' . $request->sku);
        $data['color_group_id'] = $request->color_group_id;
        $data['is_active'] = $request->input('is_active', 0);
    
        // Main Image
        if ($request->hasFile('image_url')) {
            if ($product->image_url) { Storage::disk('public')->delete($product->image_url); }
            $data['image_url'] = $request->file('image_url')->store('products', 'public');
        }
    
        $product->update($data);
    
        // --- LOGIC: Size-wise Stock Update ---
        if ($request->has('size_stock')) {
            // Purana stock delete karke naya dalo (Cleanest way)
            ProductSizeStock::where('product_id', $product->id)->delete();
            
            foreach ($request->size_stock as $sizeName => $qty) {
                if ($qty !== null) {
                    ProductSizeStock::create([
                        'product_id' => $product->id,
                        'size'       => $sizeName,
                        'stock'      => (int)$qty
                    ]);
                }
            }
        }
    
        // Gallery
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $path = $file->store('products/gallery', 'public');
                ProductImage::create(['product_id' => $product->id, 'image_path' => $path]);
            }
        }
    
        // Attributes
        if ($request->filled('attributes')) {
            ProductAttribute::where('product_id', $product->id)->delete();
            foreach ($request->input('attributes') as $attributeId => $valueIds) {
                foreach ((array) $valueIds as $valueId) {
                    $attrVal = AttributeValue::find($valueId);
                    if ($attrVal) {
                        ProductAttribute::create([
                            'product_id'   => $product->id,
                            'attribute_id' => $attributeId,
                            'value'        => $attrVal->value,
                        ]);
                    }
                }
            }
        }
    
        return redirect()->route('products.index')->with('success', 'Product Updated Successfully!');
    }

    // ===========================
    // ✅ ADMIN: DELETE IMAGE
    // ===========================
    public function deleteImage($id)
    {
        $image = ProductImage::findOrFail($id);
        if (Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }
        $image->delete();
        return back()->with('success', 'Gallery image removed!');
    }

    // ===========================
    // ✅ ADMIN: DELETE PRODUCT
    // ===========================
    public function destroy(Product $product)
    {
        // 1. Delete Main Image
        if ($product->image_url) { Storage::disk('public')->delete($product->image_url); }
        
        // 2. Delete Gallery Images from folder
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }
        
        // 3. Database cascade takes care of the rest (images/attributes)
        $product->delete();
        
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }


    // ===========================
    // 🛒 FRONTEND: PRODUCT DETAIL
    // ===========================
    public function shopingcart($slug)
    {
        // Find by slug (Zilbil Style) or fail
        $product = Product::with(['images', 'attributes'])->where('slug', $slug)->firstOrFail();
    
        $variants = collect(); 
        if ($product->color_group_id) {
            $variants = Product::where('color_group_id', $product->color_group_id)
                               ->where('is_active', 1)
                               ->with('attributes')
                               ->get();
        }
    
        $relatedProducts = Product::where('id', '!=', $product->id)
                                  ->where('is_active', 1)
                                  ->take(6)
                                  ->get();
    
        return view('page.shopingcart', compact('product', 'variants', 'relatedProducts'));
    }
}