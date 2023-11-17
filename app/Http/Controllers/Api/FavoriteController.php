<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches =  Branch::all();
        $favorites =  Favorite::Paginate();
        $categories = Category::all();
        if (auth()->user() != NULL) {
            $carts = Cart::where('user_id', '=', auth()->user()->id)->where('status', '=', 'قيد التنفيذ')->get();
            return response()->json(['branches' => $branches, 'favorites' => $favorites, 'carts' => $carts, 'categories' => $categories],200);
        } else {
            return response()->json(['branches' => $branches, 'favorites' => $favorites, 'categories' => $categories], 200);
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
    public function store($id)
    {
        $product = Product::find($id);
        $branches =  Branch::all();

        $favorite= Favorite::create(
            [
                'product_id' => $product->id,
                'user_id' => auth()->user()->id
            ]
        );
        return response()->json(compact('favorite'));
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
        Favorite::find($id)->delete();
        return response()->json(['message' => 'this product is deleted from favorite']);
    }
}
