<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->status);
        $orders = Order::with('items')
            ->where('user_id', Auth::user()->id)
            ->filter(['status' => $request->query('status')])->latest()->paginate(5)->appends(request()->query());
        return view('order', compact('orders'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'shipping.name' => 'required',
            'shipping.phone' => 'required',
            'shipping.address' => 'required',
            'courier' => 'required',
            'payment' => 'required',
        ]);

        // dd($validated);

        // dd(Auth::user()->carts);
        $validated['user_id'] = Auth::user()->id;
        $order = Order::create($validated);

        foreach (Auth::user()->carts as $cart) {
            $order->items()->attach($cart->item->id, [
                'price' => $cart->item->price,
                'qty' => $cart->qty
            ]);
        }

        Auth::user()->carts->each(function ($cart) {
            $cart->delete();
        });

        return to_route('order.index')->with('success', 'Silahkan lakukan pembayaran!');
    }

    public function update(Request $request, Order $order)
    {
        if (($request->status == "completed" && $order->status =="shipped") || ($order->status == "pending" && $request->status == "cancelled")) {
            $order->update([
                'status' => $request->status
            ]);
            if ($request->status == "completed") {
                $message = "diselesaikan";
            }
            else{
                $message = "dibatalkan";
            }
        }
      
        return redirect('order?status='.$request->status)->with('success', 'Pesanan berhasil '.$message."!");

    }
}
