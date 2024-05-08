<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $products = Product::all();
    $categories = Category::all();
    return view('dashboard', compact('products','categories'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
{
    $categories = Category::all();
    //dd($categories);
    return view('products.addproduct', compact('categories'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'productName' => ['required', 'string'],
            'productDescription' => ['required', 'string'],
            'productImage' => ['required', 'image', 'max:2048'], // Ensure the uploaded image is not larger than 2MB
            'productPrice' => ['required', 'numeric', 'min:0.01'], // Add specific rules for product price
            'categoryId' => ['required', 'exists:categories,id'], // Validate that category ID exists in the 'categories' table
        ]);
    
        try {
            // Store the image in the 'public/products' directory
            $imageName = time().'.'.$request->file('productImage')->extension(); // Generate a unique filename
    
            $request->file('productImage')->move(public_path('images'), $imageName);
    
            // Create a new product
            $user = auth()->user();
            $product = Product::create([
                'user_id' => $user->id,
                'product_name' => $request->productName,
                'product_description' => $request->productDescription,
                'product_image' => $imageName, // Store only the image file name in the database
                'product_price' => $request->productPrice,
                'category_id' => $request->categoryId,
            ]);
    
            return redirect()->route('sdashboard')->with('success', 'Product created successfully.');
        } catch (\Exception $e) {
            // Handle any potential exceptions here
            return redirect()->route('sdashboard')->with('error', 'An error occurred while creating the product.');
        }
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
