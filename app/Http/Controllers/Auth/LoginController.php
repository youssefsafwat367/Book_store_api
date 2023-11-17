<?php

namespace App\Http\Controllers\Auth;

use App\Models\Branch;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm()
    {
        $categories = Category::all() ;
        $branches = Branch::all();

        return view('auth.login' ,  ['categories' =>$categories , 'branches'=>$branches]) ;
    }
    public function login(Request $request)
    {
        $user = $request->validate(
            [
                'email'=> 'required' ,
                'password'=> 'required' ,
            ]
        ) ;
        if (Auth::attempt($user)) {
            $request->session()->regenerate();
            if(auth()->user()->role == 'admin'){
                return redirect()->route('admin.home') ;
            }else{
                return redirect()->route('homePage' ) ;
            }
        }
        else{
            return back()->withErrors([
                'email' => 'The Email or Password Is Incorrect',
            ]);
        }
    }
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }
}

