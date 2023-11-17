<?php

namespace App\View\Components;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavSidebar extends Component
{

    /**
     * Create a new component instance.
     */
    public function __construct(public $categories)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav-sidebar' , ['categories'=>$this->categories]);
    }
}
