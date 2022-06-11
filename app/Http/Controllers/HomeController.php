<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class HomeController extends Controller
{
 
    public function index()
    {
        // Item::onlyTrashed()->restore();
        $data = [
            'new_arrival' => Item::with('category', 'brand')->latest()->active()->limit(10)->get(),
            'best_seller' => Item::with('category', 'brand')->inRandomOrder()->active()->limit(10)->get(),
        ];
        return view('home', $data);
    }
}
