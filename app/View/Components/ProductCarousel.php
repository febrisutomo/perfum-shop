<?php

namespace App\View\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class ProductCarousel extends Component
{
    public $products;
    public $name;
    public $var;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($products, $name)
    {
        $this->products = $products;
        $this->name = $name;
        $this->var = Str::camel($name);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.product-carousel');
    }
}
