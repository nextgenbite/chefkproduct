<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class JsonDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $response = Http::get('https://fakestoreapi.com/products/categories');
        $data = $response->json();

        foreach ($data as $item) {
            // Perform any necessary data manipulation or transformations
            // before seeding it into the database

            // Example: Assuming you have a "users" table
            // and each item in the JSON represents a user
            DB::table('categories')->insert([
                'title' => $item,
                'status' => true,
                // Add other columns as needed
            ]);
        }
        $response = Http::get('https://fakestoreapi.com/products');
        $data = $response->json();

        foreach ($data as $item) {
            // Perform any necessary data manipulation or transformations
            // before seeding it into the database

            // Create a new image
            $imageUrl = $item['image'];
            $imageData = file_get_contents($imageUrl);

            // Generate a random file name for the image
            $imageFileName = $item['title'] . '.jpg';

            // Store the image file in the public directory
            $imagePath = 'images/product/' . $imageFileName;
            $publicPath = public_path($imagePath);
            File::put($publicPath, $imageData);

            // Example: Assuming you have a "products" table
            // and each item in the JSON represents a product
            DB::table('products')->insert([
                'category_id' => Category::inRandomOrder()->first()->id,
                'brand_id' => 1,
                'title' => $item['title'],
                'description' => $item['description'],
                'price' => $item['price'],
                'stock' => 20,
                'discount' => 20,
                'thumbnail' => $imagePath,
                'status' => true,
                // Add other columns as needed
            ]);
        }

    }
}
