<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        $carts = Cart::where('user_id', $user->id)->get();

        return view('cart.index', [
            'carts' => $carts
        ]);
    }

    public function store($itemId, Request $request) {
        $user = auth()->user();
        $product = Product::find($itemId);
    
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }
    
        $cart = Cart::where('user_id', $user->id)
            ->where('product_id', $itemId)
            ->first();
    
        if ($cart) {
            // Remove the product from the cart
            $cart->delete();
            return redirect()->back()->with('success', 'Item removed from cart.');
        } else {
            // Add the product to the cart
            $quantity = $request->input('quantity');
    
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $itemId,
                'qty' => $quantity
            ]);
            return redirect()->back()->with('success', 'Item added to cart.');
        }
    }
    

    public function destroy($itemId)
    {
        $user = auth()->user();
        $cart = Cart::where('user_id', $user->id)
            ->where('id', $itemId)
            ->first();

        if ($cart) {
            $cart->delete();
            return redirect()->back()->with('success', 'Item removed from cart.');
        } else {
            return redirect()->back()->with('error', 'Item not found in cart.');
        }
    }
}
