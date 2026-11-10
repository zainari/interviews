<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Seed 15 fake Wasaaz products with sizes, colors, stock and images.
     */
    public function run(): void
    {
        $sizeAttr = Attribute::firstOrCreate(['name' => 'Size']);
        $colorAttr = Attribute::firstOrCreate(['name' => 'Color']);

        $bottoms = Category::firstOrCreate(['name' => 'Bottoms']);

        $apparelSizes = ['S', 'M', 'L', 'XL'];
        $oneSize = ['One Size'];

        $products = [
            ['name' => 'Signature Wasaaz Hoodie', 'price' => 4900, 'category' => 'Hoodie', 'image' => 'products/seed-01.jpg', 'color' => 'Black', 'sizes' => $apparelSizes],
            ['name' => 'Calligraphy Drop Hoodie', 'price' => 5400, 'category' => 'Hoodie', 'image' => 'products/seed-02.jpg', 'color' => 'Maroon', 'sizes' => $apparelSizes],
            ['name' => 'Heritage Zip-Up Hoodie', 'price' => 5900, 'category' => 'Classic Hoodie', 'image' => 'products/seed-03.jpg', 'color' => 'Charcoal', 'sizes' => $apparelSizes],
            ['name' => 'Script Logo Tee', 'price' => 1900, 'category' => "Men's t-shirt designs", 'image' => 'products/seed-04.jpg', 'color' => 'White', 'sizes' => $apparelSizes],
            ['name' => 'Urdu Calligraphy Tee', 'price' => 2100, 'category' => "Men's t-shirt designs", 'image' => 'products/seed-14.jpg', 'color' => 'Black', 'sizes' => $apparelSizes],
            ['name' => 'Classic Polo Shirt', 'price' => 2600, 'category' => 'MEN POLO', 'image' => 'products/seed-10.jpg', 'color' => 'Navy', 'sizes' => $apparelSizes],
            ['name' => 'Heritage Chino Pants', 'price' => 3400, 'category' => 'Bottoms', 'image' => 'products/seed-05.jpg', 'color' => 'Beige', 'sizes' => ['30', '32', '34', '36']],
            ['name' => 'Wasaaz Chrono Watch', 'price' => 12900, 'category' => 'Watch', 'image' => 'products/seed-06.jpg', 'color' => 'Silver', 'sizes' => $oneSize],
            ['name' => 'Maroon Heritage Watch', 'price' => 15500, 'category' => 'Watch', 'image' => 'products/seed-07.jpg', 'color' => 'Maroon', 'sizes' => $oneSize],
            ['name' => 'Eclipse Smartwatch', 'price' => 9900, 'category' => 'Smartwatch', 'image' => 'products/seed-08.jpg', 'color' => 'Black', 'sizes' => $oneSize],
            ['name' => 'Classic Leather Watch', 'price' => 18400, 'category' => 'Watch', 'image' => 'products/seed-09.jpg', 'color' => 'Brown', 'sizes' => $oneSize],
            ['name' => 'Retro Court Sneakers', 'price' => 8900, 'category' => "Jousen Men's Fashion Sneakers Classic Retro Shoes", 'image' => 'products/seed-15.jpg', 'color' => 'White', 'sizes' => ['40', '41', '42', '43', '44']],
            ['name' => 'Street Snapback Cap', 'price' => 1500, 'category' => 'Hats', 'image' => 'products/seed-12.png', 'color' => 'Black', 'sizes' => $oneSize],
            ['name' => 'Embroidered Bucket Hat', 'price' => 1700, 'category' => 'Women Hats', 'image' => 'products/seed-13.png', 'color' => 'Cream', 'sizes' => $oneSize],
            ['name' => 'Statement Crewneck Sweatshirt', 'price' => 3900, 'category' => 'Hoodie', 'image' => 'products/seed-11.jpg', 'color' => 'Olive', 'sizes' => $apparelSizes],
        ];

        foreach ($products as $i => $data) {
            $categoryId = $data['category'] === 'Bottoms'
                ? $bottoms->id
                : Category::where('name', $data['category'])->value('id');

            $sku = 'WAS-' . str_pad(2000 + $i, 5, '0', STR_PAD_LEFT);
            $stockTotal = count($data['sizes']) * 12;

            $product = Product::firstOrCreate(
                ['sku' => $sku],
                [
                    'name' => $data['name'],
                    'slug' => Str::slug($data['name']) . '-' . strtolower($sku),
                    'description' => $data['name'] . ' — a premium piece from the Wasaaz collection, crafted with quality materials and signature detailing. Designed for everyday wear with a modern streetwear edge.',
                    'price' => $data['price'],
                    'stock' => $stockTotal,
                    'image_url' => $data['image'],
                    'category_id' => $categoryId,
                    'is_active' => true,
                    'brand' => 'Wasaaz',
                    'size' => implode(',', $data['sizes']),
                ]
            );

            if (!$product->wasRecentlyCreated) {
                continue;
            }

            // Attach size attribute values + size stock rows
            foreach ($data['sizes'] as $size) {
                $product->attributes()->attach($sizeAttr->id, ['value' => $size]);
                $product->sizeStocks()->firstOrCreate(
                    ['size' => $size],
                    ['stock' => 12]
                );
            }

            // Attach color attribute value
            $product->attributes()->attach($colorAttr->id, ['value' => $data['color']]);

            // Gallery image (reuse main image so the thumbnail strip has content)
            $product->images()->firstOrCreate(['image_path' => $data['image']]);
        }
    }
}
