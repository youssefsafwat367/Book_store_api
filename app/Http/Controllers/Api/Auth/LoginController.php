<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $user = $request->validate(
            [
                'email' => 'required',
                'password' => 'required',
            ]
        );
        $user = User::where('email', $request->email)->first();
        if (!$user) return response()->json(['message' => 'Invalid email address']);
        $password = Hash::check($request->password, $user->password);
        if (!$password) return response()->json(['message' => 'Email or Password  is incorrect']);
        $token = $user->createToken('user_token');
        return response()->json(['token' => $token->plainTextToken, 'user' => $user]);
    }
    public function logout($id)
    {
        $user = User::find($id)->first();
        $user->tokens()->delete();
        return response()->json(['message' => 'the user has been logged out']);
    }
    public function register(Request $request)
    {
        $user = $request->validate(
            [
                'fname' => 'required',
                'lname' => 'required',
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
            ]
        );
        $new_user  = User::create($user);
        $token = $new_user->createToken('user_token');
        return response()->json(['token' => $token->plainTextToken, 'user' => $user]);
    }
}
