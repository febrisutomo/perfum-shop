<?php

namespace App\Http\Controllers\Admin;

use App\Models\Item;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $new_orders = Order::where('status', 'pending')->count();
        $all_orders = Order::all()->count();
        $count_items = Item::all()->count();
        $count_users = User::all()->count();
        return view('admin.dashboard.index', compact('all_orders', 'new_orders', 'count_items', 'count_users'));
    }
}
