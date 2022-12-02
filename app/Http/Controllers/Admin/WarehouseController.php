<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WarehouseController extends Controller
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
        if ($perPage == 'Tutti') {
            $products = Product::all();
        } else {
            $products = Product::paginate($perPage);
        }

        return view('admin.warehouse.index', compact('products', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.warehouse.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::id();
        $validated = $request->validate([
            'business_id' => ['numeric'],
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'ref' => ['required', 'string'],
            'content' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'type' => ['required', 'string'],
            'treatment' => ['required', 'string'],
            'product_line' => ['required', 'string'],
            'qta' => ['nullable', 'numeric'],
            'put_of_print' => ['nullable', 'boolean'],
            'discount' => ['nullable', 'string'],
            'price_visible' => ['nullable', 'boolean']
        ]);
        $validated['business_id'] = $user;

        Product::create($validated);
        return redirect()->route('warehouse.index')->with('message', "Nuovo Prodotto $validated[name] inserito!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        return view('admin.warehouse.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);

        return view('admin.warehouse.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $validated = $request->validate([
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'ref' => ['required', 'string'],
            'content' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'type' => ['required', 'string'],
            'treatment' => ['required', 'string'],
            'product_line' => ['required', 'string'],
            'qta' => ['nullable', 'numeric'],
            'put_of_print' => ['nullable', 'boolean'],
            'discount' => ['nullable', 'string'],
            'price_visible' => ['nullable', 'boolean']
        ]);

        $product->update($validated);
        return redirect()->route('warehouse.index')->with('message', "$validated[name] modificato con successo!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->back()->with('message', "Prodotto $product->name eliminato!");
    }
}
