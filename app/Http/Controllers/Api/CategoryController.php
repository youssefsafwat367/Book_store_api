<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json(compact('categories'));
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
        $category = $request->validate(
            [
                'name' => 'required|min:5|max:30',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'name.required' => 'Category Name is required',
                'name.min' => 'Category Name must be at least 5 characters',
                'lname.max' => 'Category Name cannot be more than 30 characters',
                'image.image' => 'The category Image must be an image.',
                'image.mimes' => 'The category Image must be an image.',
                'image.max' => 'The category Image may not be greater than 2MB.',
            ]
        );
        $image = $category['image'];
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $category['image'] = $imageName;
        category::create($category);
        $image->move(public_path('assets/uploads/categories'), $imageName);
        return response()->json(['message' => 'The Category Is Created Successfully']);
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
        $category = Category::find($id);
        return response()->json(compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        $new_category = $request->validate(
            [
                'name' => 'required|min:5|max:30',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'name.required' => 'Category Name is required',
                'name.min' => 'Category Name must be at least 5 characters',
                'lname.max' => 'Category Name cannot be more than 30 characters',
                'image.image' => 'The category Image must be an image.',
                'image.mimes' => 'The category Image must be an image.',
                'image.max' => 'The category Image may not be greater than 2MB.',
            ]
        );
        $category_old_image = $category->image;
        File::delete(public_path('assets/uploads/categories/') . "$category_old_image");
        $image = $new_category['image'];
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('assets/uploads/categories'), $imageName);
        $new_category['image'] = $imageName;
        $category->update($new_category);
        $category->image = $imageName;
        $category->save();
        return response()->json(['message' =>  'The Category Is Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        File::delete(public_path("assets/uploads/categories/" . "$category->image"));
        $category->delete();
        return response()->json(['message' => 'The Category is Deleted Successfully']);
    }
}
