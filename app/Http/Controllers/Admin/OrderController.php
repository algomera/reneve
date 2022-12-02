<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Order $order)
    {
        // $perPage = 10;
        // if($request->get('perPage')) {
        //     $perPage = $request->get('perPage');
        // }
        $orders = Order::all();
        // if ($perPage == 'Tutti') {
        // } else {
        //     $orders = Order::paginate($perPage);
        // }

        return view('admin.order.index', compact('orders'));
    }

    public function show(Request $request, Order $order)
    {
        $products = $order->products;

        // $qta = $order->products();
        // dd($qta);

        return view('admin.order.show', compact('products', 'order'));
    }


}
