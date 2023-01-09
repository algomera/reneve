<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Business $business)
    {
        $businessId = auth()->user()->business->pluck('id')->toArray();
        $adminProvider = Business::whereId($businessId[0])->with('providers')->get()->pluck('providers')->first();
        $businessProviders = Provider::where('business_id', $businessId[0])->get();
        $providers = $adminProvider->merge($businessProviders);

        $allAdminProvider = Provider::whereBusinessId(1)->get()->pluck('id')->toArray();

        return view('business.provider.index', compact('providers', 'allAdminProvider'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('business.provider.create');
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
            'business_id' => ['required', 'numeric'],
            'type' => ['required', 'string'],
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'duration' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
        ]);

        $businessId = auth()->user()->business->pluck('id')->toArray();
        $validate['business_id'] = $businessId[0];

        Provider::create($validate);

        return redirect()->route('business.provider.index')->with('message', 'Nuovo servizio inserito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $provider = Provider::find($id);
        return view('business.provider.show', compact('provider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $provider = Provider::find($id);
        return view('business.provider.edit', compact('provider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $provider = Provider::find($id);

        $validate = $request->validate([
            'type' => ['required', 'string'],
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'duration' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
        ]);

        $provider->update($validate);

        return redirect()->route('business.provider.index')->with('message', "Servizio $provider->name modificato!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $provider = Provider::find($id);
        $provider->delete();

        return redirect()->back()->with('message', "Servizio $provider->name eliminato correttamente!");
    }
}
