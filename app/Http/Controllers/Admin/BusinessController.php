<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\Provider;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class BusinessController extends Controller
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

        $businesses = Business::select([
            'id',
            'business',
            'type_business',
            'email_business',
            'telephone_business',
            'mobile_phone_business',
            'created_at',
            'deleted_at',
        ])->withTrashed()->paginate($perPage);
        return view('admin.business.index', compact('businesses', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Provider $provider)
    {
        $id = auth()->user()->id;
        $providers = Provider::where('business_id', $id)->get();
        return view('admin.business.create', compact('providers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateUser = $request->validate([
            'role' => ['required'],
            'name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'telephone' => ['nullable', 'string', 'regex:/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/'],
            'mobile_phone' => ['nullable', 'string', 'regex:/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/'],
        ]);

        $validateBusiness = $request->validate([
            'business' => ['required', 'string'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,svg'],
            'p_iva_business' => ['required', 'numeric', 'regex:/^[0-9]{11}$/'],
            'address_business' => ['required', 'string'],
            'telephone_business' => ['nullable', 'string', 'regex:/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/'],
            'mobile_phone_business' => ['nullable', 'string', 'regex:/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/'],
            'email_business' => ['required', 'string', 'email'],
            'pec_business' => ['nullable', 'string', 'email', 'unique:businesses'],
            'type_business' => ['required', 'string'],
            'start_contract' => ['required', 'string'],
            'end_contract' => ['required', 'string'],
            'discount' => ['nullable', 'numeric'],
            'subdomain' => ['string'],
        ]);

        $validateProvider = $request->validate([
            'providers' => ['nullable'],
        ]);


        $subdomain = str_replace(' ', '_', $validateBusiness['business']);
        $validateBusiness['subdomain'] = $subdomain;

        $business = Business::create($validateBusiness);
        if ($validateProvider) {
            $business->providers()->attach($validateProvider['providers']);
        }

        if (array_key_exists('logo', $validateBusiness)) {
            $file_path = Storage::disk('public')->put('business-'. $business->id . '/' . 'Logo', $validateBusiness['logo']);
            $validateBusiness['logo'] = $file_path;
            $business->update($validateBusiness);
        }

        $user = User::create([
            'role' => $validateUser['role'],
            'name' => $validateUser['name'],
            'last_name' => $validateUser['last_name'],
            'email' => $validateUser['email'],
            'password' => Hash::make($validateUser['password']),
            'telephone' => $validateUser['telephone'],
            'mobile_phone' => $validateUser['mobile_phone'],
        ]);

        $user->business()->attach($business);

        return redirect()->route('business.index')->with('message', "Nuova azienda $business->name appartenente a $user->name inserita!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Business $business)
    {
        $owner = $business->user()->wherePivot('business_id', $business->id)->whereRole('business')->first();
        $providers = $business->providers;
        $collaborators = $business->user()->wherePivot('business_id', $business->id)->whereRole('collaborator')->get();
        $business['start_contract'] = date('d-m-Y', strtotime($business['start_contract']));
        $business['end_contract'] = date('d-m-Y', strtotime($business['end_contract']));
        return view('admin.business.show', compact('business', 'collaborators', 'owner', 'providers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Business $business)
    {
        $id = auth()->user()->id;
        $providers = Provider::where('business_id', $id)->get();
        $user = $business->user()->whereRole('business')->first();

        return view('admin.business.edit', compact('business', 'user', 'providers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Business $business)
    {
        $user = $business->user()->whereRole('business')->first();

        $validateUser = $request->validate([
            'role' => ['required'],
            'name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'telephone' => ['nullable', 'string', 'regex:/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/'],
            'mobile_phone' => ['nullable', 'string', 'regex:/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/'],
            'email' => ['required', 'string', 'email', 'unique:users,email,'.$user->id],
        ]);

        $validateBusiness = $request->validate([
            'business' => ['required', 'string'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,svg'],
            'p_iva_business' => ['required', 'numeric', 'regex:/^[0-9]{11}$/'],
            'address_business' => ['required', 'string'],
            'telephone_business' => ['nullable', 'string', 'regex:/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/'],
            'mobile_phone_business' => ['nullable', 'string', 'regex:/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/'],
            'email_business' => ['required', 'string', 'email'],
            'pec_business' => ['nullable', 'string', 'email', 'unique:businesses,pec_business,'.$business->id],
            'type_business' => ['nullable', 'string'],
            'start_contract' => ['required', 'string'],
            'end_contract' => ['required', 'string'],
            'discount' => ['nullable', 'numeric'],
            'subdomain' => ['string'],
        ]);

        $validateProvider = $request->validate([
            'providers' => ['nullable'],
        ]);

        if ($request->hasFile('logo')) {
            if ($business->logo) {
                Storage::disk('public')->delete($business->logo);
            }
            $logo = Storage::disk('public')->put('business-'. $business->id . '/' . 'Logo', $request->logo);
            $validateBusiness['logo'] = $logo;
        }

        $subdomain = str_replace(' ', '_', $validateBusiness['business']);
        $validateBusiness['subdomain'] = $subdomain;

        $business->update($validateBusiness);

        if ($validateProvider) {
            $business->providers()->sync($validateProvider['providers']);
        }

        $user->update($validateUser);

        return redirect()->route('business.index')->with('message', "$business->business modificato!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $business = Business::withTrashed()->find($id);

        if ($request->hard) {
            $business->forceDelete();
            Storage::disk('public')->deleteDirectory('business-'.$id);
        } else {
            $business->delete();
        }
        return redirect()->route('business.index')->with('message', $request->hard ? "L'azienda è stata eliminata definitivamente!" : "L'azienda è stata eliminata!");
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        Business::withTrashed()->find($id)->restore();
        return redirect()->route('business.index')->with('message', "azienda ripristinata!");
    }
}
