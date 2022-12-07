<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class WarehouseController extends Controller
{

    private function getProductButtons(Product $product) {
        $id = $product->id;

        $buttonShow =
            '<a href="'.route('warehouse.show', $id).'" title="view" id="show-'.$id.'" class="grow flex justify-center items-center py-1 border-[2px] border-green-500/80 rounded-md hover:bg-green-500/80 group">
                <i class="fa-regular fa-eye text-green-500 group-hover:text-white"></i>
            </a>';

        $buttonEdit =
            '<a href="'.route('warehouse.edit', $id).'" title="update" id="edit-'.$id.'" class="grow flex justify-center items-center py-1 border-[2px] border-yellow-500/80 rounded-md hover:bg-yellow-500/80 group">
                <i class="fa-solid fa-pen-to-square text-yellow-500 group-hover:text-white"></i>
            </a>';

        $buttonDelete =
            '<button type="button" href="'.route('warehouse.destroy', $id).'" title="delete" class="ajax grow flex justify-center items-center py-1 border-[2px] rounded-md border-red-500/80 hover:bg-red-500/80 group">
                <i class="fa-solid fa-trash text-red-500 group-hover:text-white"></i>
            </button>';

        return $buttonShow.$buttonEdit.$buttonDelete;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    return
                    '<div class="flex shrink gap-1">
                        '.$this->getProductButtons($data).'
                    </div>';
                })->editColumn('price_visible', function($data){
                    return $data->price_visible == 1 ? 'Si' : 'No';
                })->editColumn('discount', function($data){
                    return $data->discount . '%';
                })->rawColumns(['action'])->make(true);
        }

        return view('admin.warehouse.index');
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
