<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Cabin;
use Illuminate\Http\Request;

class CabinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $businessId = auth()->user()->business->pluck('id')->first();
        $cabins = Cabin::whereBusinessId($businessId)->get();

        return view('business.cabin.index', compact('cabins'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => ['required', 'string'],
            'business_id' => ['nullable'],
        ]);

        $businessId = auth()->user()->business->pluck('id')->toArray();
        $validate['business_id'] = $businessId[0];

        Cabin::create($validate);

        return redirect()->back()->with('message', 'Nuova cabina inserita!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cabin  $cabin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cabin = Cabin::find($id);
        $cabin->delete();

        return redirect()->back()->with('message', "Cabina $cabin->name eliminata correttamente!");
    }
}
