<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use DataTables;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Order::with('business')->select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('amount', function($data) {
                    $total = $data->total;
                    $totalFormat = '€ ' . number_format($total, 2 , ',', '.');
                    return $totalFormat;
                })->addColumn('action', function($data){
                    $btn =
                    '<a href="'.route('admin.order.show', $data).'" title="view" id="show-'.$data.'" class="grow flex justify-center px-2 h-[30px] hover:bg-[#27272A] items-center rounded-md bg-[#1EC981] group">
                        <img src="'. asset('images/eyeglasses.svg') .'" alt="" class="scale-[1.2]">
                    </a>';
                    return $btn;
                })->editColumn('created_at', function($data){
                    return $data->created_at->format('Y-m-d / H:i');
                })->rawColumns(['action', 'amount'])->make(true);
        }

        return view('admin.order.index');
    }

    public function show(Request $request, Order $order)
    {
        $products = $order->products()->withTrashed()->get();
        return view('admin.order.show', compact('products', 'order'));
    }


}
