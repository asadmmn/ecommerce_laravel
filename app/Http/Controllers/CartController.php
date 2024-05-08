<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\product;
use App\Models\User;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     
     public function index(Request $request)
{
    if (auth()->check()) {
        $user = auth()->user();        
        $cartProducts = $user->cartProducts; // Retrieve cart products for the authenticated user
        return view('cart.cart', compact('cartProducts'));
    } else {
        return redirect()->route('login');
    }
}



    public function create()
    {
        // No action defined for create
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $productId = $request->input('product_id');
    //dd($request->all());
        Cart::create([
            'user_id' => $request->user()->id,
            'product_id' => $productId,
            'quantity' => $request->quantity,
            'price' => $request->product_price, // Include the price from the request
        ]);
    
        //return redirect()->back()->with('success', 'Product added to cart!');
        return redirect()->route('cart.index')->with('success', 'Product added to your cart successfully.');
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
