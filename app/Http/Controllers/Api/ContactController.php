<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role == 'user') {
            $branches =  Branch::all();
            $categories = Category::all();
            $carts = Cart::where('user_id', '=', auth()->user()->id)->where('status', '=', 'قيد التنفيذ')->get();
            return response()->json(['branches' => $branches, 'carts' => $carts, 'categories' => $categories]);
        } elseif (auth()->user()->role == 'admin') {
            $contacts = Contact::all();
            return response()->json(compact('contacts'));
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
        $contact = $request->validate(
            [
                'name' => 'required|min:10|max:20',
                'phone' => 'required|numeric',
                'email' => 'required|email',
                'subject' => 'required',
                'message' => 'required'
            ]
        );
        Contact::create($contact);
        return response()->json(['message' => 'We Will Contact Your Soon']);
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
        $contact = Contact::find($id);
        $contact->delete();
        return response()->json(['message'=> 'The Contact is Deleted Successfully']);
    }
}
