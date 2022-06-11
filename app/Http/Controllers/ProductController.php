<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function single(Item $item)
    {
        if (!$item->is_active) {
            return abort(404);
        }
        $data['product'] = $item->load('category', 'brand');
        $data['relateds'] = Item::with('category', 'brand')->inRandomOrder()->limit(8)->get();
        return view('product-single', $data);
    }

    public function all(Request $request)
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        $brands = Brand::where('is_active', true)->orderBy('name')->get();
        $products = Item::with('category', 'brand')->latest()
            ->filter(['search' => $request->query('search'), 'category' => $request->query('category'), 'brand' => $request->query('brand')])
            ->paginate(12)->appends(request()->query());
        return view('product-all', compact('products', 'categories', 'brands'));
    }

    public function search(Request $request)
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        $brands = Brand::where('is_active', true)->orderBy('name')->get();
        $products = Item::with('category', 'brand')->latest()
            ->filter(['search' => $request->query('search'), 'category' => $request->query('category'), 'brand' => $request->query('brand')])
            ->paginate(12)->appends(request()->query());
        return view('product-search', compact('products', 'categories', 'brands'));
    }
}
