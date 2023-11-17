<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::all();
        if (auth()->user() != NULL) {
            $carts = Cart::where('user_id', '=', auth()->user()->id)->where('status', '=', 'قيد التنفيذ')->get();
            $orders = Order::where('user_id', '=', auth()->user()->id)->get();
            return response()->json(['branches' => $branches, 'carts' => $carts, 'orders' => $orders]);
        } else {
            return response()->json(['branches' => $branches]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, $total)
    {
        $order_details = $request->validate(
            [
                'government' => 'required',
                'address' => 'required',
                'phone' => 'required|numeric',
                'notes' => 'required',
            ]
        );
        $products = Product::all();
        $carts = Cart::where('user_id', '=', auth()->user()->id)->where('status', 'قيد التنفيذ')->get();
        foreach ($carts as $cart) {
            foreach ($products as $product) {
                // dd($cart->cart_products[0]) ;
                if ($cart->cart_products[0]->product_id == $product->id) {
                    if ($cart->cart_products[0]->quantity > $product->stock) {
                        return response()->json(['message' => "The available quantity for  product : $product->name is  $product->stock now"]);
                    }
                }
            }
        }
        $products = Product::all();
        $carts = Cart::where('user_id', '=', auth()->user()->id)->where('status', 'قيد التنفيذ')->get();
        foreach ($carts as $cart) {
            foreach ($products as $product) {
                if ($cart->cart_products[0]->product_id == $product->id) {
                    Product::where('id', $product->id)->update(['stock' => ($product->stock - $cart->cart_products[0]->quantity)]);
                }
            }
            Cart::where('id', '=', $cart->id)->update(['status' => 'تم استلام الطلب']);
        }
        $order = Order::create(
            [
                'user_id' => auth()->user()->id,
                'total' => $total,
                'notes' => $order_details['notes'],
                'government' => $order_details['government'],
                'phone' => $order_details['phone'],
                'address' => $order_details['address']
            ]
        );
        foreach ($carts as $cart) {
            foreach ($products as $product) {
                if ($cart->cart_products[0]->product_id == $product->id) {
                    OrderProduct::create(['product_id' => $product->id, 'order_id' => $order->id, 'quantity' => $cart->cart_products[0]->quantity, 'price' => $cart->cart_products[0]->price]);
                }
            }
        }
        return response()->json(['message' => 'The order is Confirmed']);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }
    public function checkout($total)
    {
        $branches = Branch::all();
        if (auth()->user() != NULL) {
            $carts = Cart::where('user_id', '=', auth()->user()->id)->where('status', '=', 'قيد التنفيذ')->get();
            $orders = Order::where('user_id', '=', auth()->user()->id)->get();
            return response()->json( ['branches' => $branches, 'carts' => $carts, 'orders' => $orders, 'total' => $total]);
        } else {
            return response()->json(['branches' => $branches, ['total' => $total]]);
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
    public function admin_orders()
    {
        $orders = OrderProduct::all();
        return response()->json( ['orders' => $orders]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function order_details(string $id)
    {
        $branches = Branch::all();
        $order = Order::find($id);
        $order_products = OrderProduct::where('order_id', $order->id)->get();
        if (auth()->user() != NULL) {
            $carts = Cart::where('user_id', '=', auth()->user()->id)->where('status', '=', 'قيد التنفيذ')->get();
            return response()->json(['order' => $order, 'branches' => $branches, 'carts' => $carts, 'order_products' => $order_products]);
        } else {
            return response()->json(['branches' => $branches]);
        }
    }
    public function confirm($id)
    {
        $order = Order::find($id)->update(['status' => 'تم تاكيد الطلب']);
        return response()->json(['message' =>  "Order Is Confirmed successfully"]);
    }
    public function received($id)
    {
        $order = Order::find($id)->update(['status' => 'تم الاستلام']);
        return response()->json(['message' => "Order Is Received successfully"]);
    }
}
