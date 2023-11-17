<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $highest_products = DB::select('SELECT COUNT(*) as highest_products , order_products.product_id , products.*   FROM order_products join products on products.id= order_products.product_id GROUP BY product_id ORDER BY COUNT(*) DESC LIMIT 5');
        $sliders =  Slider::where('status', '=', 'appear')->get();
        $products = Product::where('status', '=', 'appear')->get();
        $new_products = Product::where('status', '=', 'appear')->orderBy('created_at')->take(10)->get();
        $categories = Category::all();
        $branches =  Branch::all();
        if (auth()->user() != NULL) {
            $carts = Cart::where('user_id', '=', auth()->user()->id)->where('status', '=', 'قيد التنفيذ')->get();
            return response()->json(['sliders' => $sliders, 'products' => $products, 'categories' => $categories, 'new_products' => $new_products, 'branches' => $branches, 'carts' => $carts, 'highest_products' => $highest_products]);
        } else {
            return response()->json(['sliders' => $sliders, 'products' => $products, 'categories' => $categories, 'new_products' => $new_products, 'branches' => $branches,  'highest_products' => $highest_products]);
        }
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
        //
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
