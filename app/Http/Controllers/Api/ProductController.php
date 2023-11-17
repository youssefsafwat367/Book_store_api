<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        return response()->json(compact('products', 'categories'));
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
        $product = $request->validate(
            [
                'name' => 'required',
                'status' => 'required',
                'description' => 'required',
                'author' => 'required',
                'category' => 'required',
                'bestseller' => 'required',
                'stock' => 'required|numeric',
                'code' => 'required|numeric',
                'price' => 'required|numeric',
                'discount' => 'required|numeric',
                'number_of_pages' => 'required|numeric',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]
        );
        $image = $product['image'];
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $product['image'] = $imageName;
        $category =  $product['category'];
        $category_id = Category::where('name', "=", "$category")->first()->id;
        product::create(
            [
                'name' =>  $product['name'],
                'status' => $product['status'],
                'description' => $product['description'],
                'author' => $product['author'],
                'category_id' => $category_id,
                'bestseller' => $product['bestseller'],
                'stock' => $product['stock'],
                'price' => $product['price'],
                'code' => $product['code'],
                'discount' => $product['discount'],
                'number_of_pages' => $product['number_of_pages'],
                'price_after_discount' => $product['price'] - (($product['discount'] / 100) * $product['price']),
                'image' => $imageName,
            ]
        );
        $image->move(public_path('assets/uploads/products'), $imageName);
        return response()->json(['message' =>  'The Product Is Created Successfully']);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        $branches = Branch::all();
        $categories = Category::all();
        $related_products = Product::where('category_id', '=', "$product->category_id")->take(10)->get();
        if (auth()->user() != NULL) {
            $carts = Cart::where('user_id', '=', auth()->user()->id)->where('status', '=', 'قيد التنفيذ')->get();
            return response()->json(['product' => $product, 'branches' => $branches, 'related_products' => $related_products, 'carts' => $carts, 'categories' => $categories]);
        } else {
            return response()->json(['product' => $product, 'branches' => $branches, 'related_products' => $related_products, 'categories' => $categories]);
        }
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return response()->json(compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        $new_product = $request->validate(
            [
                'name' => 'required',
                'status' => 'required',
                'description' => 'required',
                'author' => 'required',
                'bestseller' => 'required',
                'stock' => 'required|numeric',
                'code' => 'required|numeric',
                'price' => 'required|numeric',
                'discount' => 'required|numeric',
                'number_of_pages' => 'required|numeric',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                'category' => 'required',
            ]
        );
        $file = public_path('assets/uploads/products');
        $product_old_image = $product->image;
        if ($product_old_image != 'image.jpg') {
            File::delete("$file/$product_old_image");
        }
        $image = $new_product['image'];
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('assets/uploads/products'), $imageName);
        $new_product['image'] = $imageName;
        $category =  $product['category'];
        $category_id = Category::where('name', "=", "$category->name")->first()->id;
        array_pop($new_product);
        $new_product['category_id'] = $category_id;
        $new_product['price_after_discount'] = $product['price'] - (($product['discount'] / 100) * $product['price']);
        $product->update($new_product);
        return response()->json(['message' => 'The Product Is Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        File::delete(public_path("assets/uploads/products/" . "$product->image"));
        $product->delete();
        return response()->json(['message' =>  'The Product is Deleted Successfully']);
    }
}
