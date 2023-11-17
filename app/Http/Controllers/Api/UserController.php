<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role', 'user')->get();
        return response()->json( compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = $request->validate(
            [
                'fname' => 'required|min:5|max:20',
                'lname' => 'required|min:5|max:20',
                'name' => 'required|min:10|max:30',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'fname.required' => 'First Name is required',
                'lname.required' => 'Last Name is required',
                'name.required' => 'Full Name is required',
                'fname.min' => 'First Name must be at least 5 characters',
                'lname.min' => 'Last Name must be at least 5 characters',
                'lname.max' => 'First Name cannot be more than 20 characters',
                'name.max' => 'Last Name cannot be more than 20 characters',
                'email.required' => 'Email is required',
                'email.email' => 'Please enter a valid Email',
                'image.image' => 'The User Image must be an image.',
                'image.mimes' => 'The User Image must be an image.',
                'image.max' => 'The User Image may not be greater than 2MB.',
                'password.min' => 'Password must be at least 8 characters',
                'password.max' => 'Password cannot be more than 15 characters',
            ]
        );
        $image = $user['image'];
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $user['image'] = $imageName;
        User::create($user);
        $image->move(public_path('assets/uploads/users'), $imageName);
        return response()->json(['message' => 'The User Is Created Successfully']);
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
        $user = User::find($id);
        return response()->json( compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $user = User::find($id);
        $new_user = $request->validate(
            [
                'fname' => 'required|min:5|max:20',
                'lname' => 'required|min:5|max:20',
                'name' => 'required|min:10|max:30',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'password' => 'required',
                'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'fname.required' => 'First Name is required',
                'lname.required' => 'Last Name is required',
                'name.required' => 'Full Name is required',
                'fname.min' => 'First Name must be at least 5 characters',
                'lname.min' => 'Last Name must be at least 5 characters',
                'lname.max' => 'First Name cannot be more than 20 characters',
                'name.max' => 'Full Name cannot be more than 30 characters',
                'email.required' => 'Email is required',
                'email.email' => 'Please enter a valid Email',
                'image.mimes' => 'The User Image must be an image.',
                'image.max' => 'The User Image may not be greater than 2MB.',
                'password.min' => 'Password must be at least 8 characters',
                'password.max' => 'Password cannot be more than 15 characters',
            ]
        );

        $file = public_path('assets/uploads/users');
        $user_old_image = $user->image;
        if ($user_old_image != 'image.jpg') {

            File::delete("$file/$user_old_image");
        }
        $image = $new_user['image'];
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('assets/uploads/users'), $imageName);
        $new_user['image'] = $imageName;
        $user->update($new_user);
        $user->image = $imageName;
        $user->save();
        return response()->json(['message' => 'The User Is Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::find($id)->delete();

        return response()->json(['message' => 'The User is Deleted Successfully']);
    }
}
