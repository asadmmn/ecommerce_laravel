<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\Cart;
    use App\Models\Order;
    
    
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $orders=Order::all();
        // return
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (auth()->check()) {
            $user = auth()->user();        
            $cartItems = $user->cartProducts; // Retrieve cart items for the authenticated user
    
            if ($cartItems->isEmpty()) {
                return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
            }
    
            // Calculate total amount based on cart items
            $totalAmount = $cartItems->sum(function ($item) {
                return $item->pivot->quantity * $item->pivot->price;
            });
    
            // Create a new order
            $order = $user->orders();
    //dd( $request->buyer_name);
            // Add each cart item to the order as order items
            foreach ($cartItems as $cartItem) {
                $order->create([
                    'b_name'=> $request->buyer_name,
                    'shipping'=>$request->shipping_address,
                    // 'total_amount' =>"n",
                'status' => 'pending',
                    'product_id' => $cartItem->id,
                    'product_name' => $cartItem->product_name,
                    'quantity' => $cartItem->pivot->quantity,
                    'price' => $cartItem->pivot->price,
                ]);
            }
    
            // Clear the user's cart
            $user->cartProducts()->detach();
            
            return redirect()->route('cart.index')->with('success', 'Order placed successfully!');
        } else {
            return redirect()->route('login');
        }
    }
    
    
    
    /**
     * Display the specified resource.
     */
    public function show(Checkout $checkout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Checkout $checkout)
    {
        //
    }
}
