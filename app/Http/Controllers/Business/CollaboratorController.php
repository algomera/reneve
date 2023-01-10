<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CollaboratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $business = auth()->user()->business->first();
        $collaborators = $business->user()->whereRole('collaborator')->get();

        return view('business.collaborator.index', compact('collaborators'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('business.collaborator.create');
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
            'role' => ['required'],
            'name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'date_of_birth' => ['nullable', 'string'],
            'sex' => ['nullable', 'boolean'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'mobile_phone' => ['required', 'string', 'regex:/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/'],
            'telephone' => ['nullable', 'string', 'regex:/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'address' => ['nullable', 'string'],
            'civic' => ['nullable', 'numeric'],
            'city' => ['nullable', 'string'],
            'province' => ['nullable', 'string'],
            'cap' => ['nullable', 'numeric'],
        ]);

        $comb = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array();
        $combLen = strlen($comb) - 1;
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $combLen);
            $pass[] = $comb[$n];
        }
        $validated['password'] = implode($pass);

        $collaborator = User::create($validated);

        $business = auth()->user()->business->first();

        $collaborator->business()->attach($business);

        return redirect()->route('business.collaborator.index')->with('message', "Collaboratore $collaborator->name $collaborator->last_name registrato!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('business.collaborator.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('business.collaborator.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $validated = $request->validate([
            'name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'date_of_birth' => ['nullable', 'string'],
            'sex' => ['nullable', 'boolean'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'mobile_phone' => ['required', 'string', 'regex:/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/'],
            'telephone' => ['nullable', 'string', 'regex:/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'address' => ['nullable', 'string'],
            'civic' => ['nullable', 'numeric'],
            'city' => ['nullable', 'string'],
            'province' => ['nullable', 'string'],
            'cap' => ['nullable', 'numeric'],
        ]);

        $user->update($validated);

        return redirect()->route('business.collaborator.index')->with('message', "Collaboratore $user->name $user->last_name aggiornato!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $collaborator = User::find($id);
        $collaborator->delete();

        return redirect()->back()->with('message', "Collaboratore $collaborator->last_name $collaborator->name eliminato!");
    }
}
