<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, $id)
    {

        $quantity = $request->validate(
            [
                "quantity" => "required"
            ]
        );
        $product = Product::find($id);
        $quantity = $quantity['quantity'];
        // $cart_products = CartProduct::where('product_id', $product->id)->get();
        $carts_of_user = Cart::where('user_id', '=', auth()->user()->id)->where('status', 'قيد التنفيذ')->get();
        foreach ($carts_of_user as $cart_of_user) {
            $cart_product = $cart_of_user->cart_products->first();
            if ($cart_product->product_id == $product->id) {
                $cart_product->quantity += $quantity;
                $carts_of_user->total = $cart_product->price * $cart_product->quantity;

                Cart::where('id', $cart_of_user->id)->update(['total' => $carts_of_user->total]);
                CartProduct::where('cart_id', $cart_of_user->id)->update(['quantity' => $cart_product->quantity]);

                return response()->json(['message' => 'success', 'The Product is Added To Cart']);
            }
        }
        $cart =  Cart::create(
            [
                'user_id' => auth()->user()->id,
                'total' => $product->price_after_discount * $quantity
            ]
        );
        CartProduct::create(
            [

                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->price_after_discount,
            ]
        );
        return response()->json(['message' => 'The Product is Added To Cart']);
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
    public function edit()
    {
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
    public function destroy(string $cart_id)
    {
        $cart = Cart::where('id', '=', $cart_id)->get();
        Cart::find($cart[0]->id)->delete();
        return response()->json(['message' => 'The Product is deleted from Cart']);
    }
}
