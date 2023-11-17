<?php

namespace App\View\Components;

use App\Models\Cart;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CartSidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $carts)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if (auth()->user() != NULL) {
            $carts = Cart::where('user_id', '=', auth()->user()->id)->where('status', '=', 'قيد التنفيذ')->get();
            return view('components.cart-sidebar' , compact('carts'));
            }
    }
}
