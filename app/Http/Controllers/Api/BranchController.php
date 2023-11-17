<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Cart;
use App\Models\Category;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $branches =  Branch::all();
        if (auth()->user() != NULL) {
            if (auth()->user()->role == "user") {
                $carts = Cart::where('user_id', '=', auth()->user()->id)->where('status', '=', 'قيد التنفيذ')->get();
                return response()->json(['branches' => $branches, 'carts' => $carts, 'categories' => $categories]);
            }
        } else {
            return response()->json(compact('branches'));
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function index_admin()
    {
        $branches =  Branch::all();
        if (auth()->user() != NULL) {
            if (auth()->user()->role == "admin") {
                return response()->json(compact('branches'));
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $branch = $request->validate(
            [
                'short_address' => 'required:',
                'full_address' => 'required',
                'city' => 'required',
                'phone' => 'required|numeric',
            ]

        );
        Branch::create($branch);
        return response()->json(['message' => 'The branch Is Created Successfully']);
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
        $branch = Branch::find($id);
        return response()->json(compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $branch = Branch::find($id);
        $new_branch = $request->validate(
            [
                'short_address' => 'required:',
                'full_address' => 'required',
                'city' => 'required',
                'phone' => 'required|numeric',
            ]
        );
        $branch->update($new_branch);
        return response()->json(['message' =>  'The Branch Is Updated Successfully']);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $branch = Branch::find($id);
        $branch->delete();
        return response()->json(['message' => 'The Branch is Deleted Successfully']);
    }
}
