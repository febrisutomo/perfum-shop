<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Cart::with('item.brand', 'item.category')->where('user_id', Auth::user()->id)->get()->sum('subtotal'));
        $data['carts'] = Cart::with('item.brand', 'item.category')
            ->where('user_id', Auth::user()->id)->get()->sortBy('item.name');
        // dd($carts);
        return view('cart', $data);
    }


    public function update(Cart $cart, $type)
    {
        if ($type == "decrement") {
            $cart->decrement('qty', 1);
        } else {
            $cart->increment('qty', 1);
        }

        return to_route('cart.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required',
            'qty' => 'required'
        ]);

        $validated['user_id'] = Auth::user()->id;

        if (Auth::user()->carts != null && (Auth::user()->carts->where('item_id', $request->item_id)->count() > 0)) {
            $userCart =  Cart::where('user_id', Auth::user()->id)->Where('item_id', $request->item_id);
            $oldQty = $userCart->first()->qty;
            $userCart->update([
                'qty' => $oldQty + $request->qty,
            ]);
        } else {
            Cart::create($validated);
        }

        return to_route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        // dd($cart);
        $cart->delete();

        return to_route('cart.index');
    }

    public function checkout()
    {
        if (Auth::user()->carts->count() < 1) {
            return to_route('cart.index');
        }
        $data['carts'] = Cart::with('item.brand', 'item.category')
            ->where('user_id', Auth::user()->id)->get();
        return view('checkout', $data);
    }
}
