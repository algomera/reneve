<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
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
        $perPage = 10;
        if($request->get('perPage')) {
            $perPage = $request->get('perPage');
        }

        $businessId = auth()->user()->business->pluck('id')->first();

        $orders = Order::whereBusinessId($businessId)->paginate($perPage);

        return view('business.order.index', compact('orders', 'perPage'));
    }

    public function showProduct(Request $request)
    {
        $products = Product::whereBusinessId(1)->get();

        if ($request->keyword != ''){
            $products = Product::whereBusinessId(1)->where('name','LIKE','%'.$request->keyword.'%')->get();
        };

        return response()->json([
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('business.order.create');
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
            'business_id' => ['nullable'],
            'notes' => ['nullable', 'string'],
            'status' => ['nullable', 'string'],
            'payment' => ['nullable', 'string'],
        ]);
        $validated['business_id'] = auth()->user()->business->pluck('id')->first();
        $validated['status'] = 'Inviato';

        $validateProduct = $request->validate([
            'products' => ['nullable'],
            'qta' => ['nullable'],
        ]);


        if ($validateProduct) {
            $product = array_combine($validateProduct['products'], $validateProduct['qta']);
            $order = Order::create($validated);
            foreach ($product as $key => $value) {
                $order->products()->attach($key, ['qta' => $value]);
            }
            return redirect()->route('business.order.index')->with('message', "Nuovo ordine inserito!");
        };
        return redirect()->route('business.order.index')->with('message', "L'ordine non conteneva articoli e non e stato generato!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
