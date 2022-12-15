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
                    '<a href="'.route('admin.order.show', $data).'" title="view" id="show-'.$data.'" class="flex justify-center items-center py-1 border-[2px] border-green-500/80 rounded-md hover:bg-green-500/80 group">
                        <i class="fa-regular fa-eye text-green-500 group-hover:text-white"></i>
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
