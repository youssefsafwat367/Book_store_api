<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Cart;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::all();
        $categories = Category::all();
        if (auth()->user() != NULL) {

            $carts = Cart::where('user_id', '=', auth()->user()->id)->where('status', '=', 'قيد التنفيذ')->get();
            return response()->json(['branches' => $branches, 'carts' => $carts, 'categories' => $categories]) ;
        } else {
            return response()->json(['branches' => $branches, 'categories' => $categories]);
        }
    }
    public function account_details()
    {
        $branches = Branch::all();
        if (auth()->user() != NULL) {
            $carts = Cart::where('user_id', '=', auth()->user()->id)->where('status', '=', 'قيد التنفيذ')->get();
            return response()->json(['branches' => $branches, 'carts' => $carts]);
        } else {
            return response()->json(['branches' => $branches]);
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
        $user = User::find($id);
        $update_user  = $request->validate(
            [
                'fname' => 'required',
                'lname' => 'required',
                'name' => 'required',
                'email' => 'required|unique:users,email,' . $user->id,
            ]
        );
        $user->update($update_user);
        $user->save();
        return response()->json(['success' =>'the User is successfully updated']);
    }
    public function update_password(Request $request, string $id)
    {
        $user = User::find($id);
        $update_user  = $request->validate(
            [
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]
        );
        $user->update($update_user);
        $user->save();
        return response()->json(['message'=>'the User Password is successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
