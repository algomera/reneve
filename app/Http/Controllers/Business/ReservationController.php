<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function create() {
        $business = auth()->user()->business->first();
        $patients = $business->user()->whereRole('patient')->get();
        $cabins = $business->cabin;
        $providers = $business->providers;

        return view('business.reservation.create', compact('patients', 'cabins', 'providers'));
    }

    public function store(Request $request) {

        $validated = $request->validate([
            'user_id' => ['required'],
            'business_id' => ['nullable'],
            'cabin_id' => ['required'],
            'provider_id' => ['required'],
            'start_time' => ['required'],
            'finish_time' => ['required'],
            'note' => ['nullable']
        ]);
        $business = auth()->user()->business->first()->id;

        $validated['business_id'] = $business;

        Reservation::create($validated);

        return redirect()->route('business.calendar')->with('message', "Prenotazione inserita!");
    }
}
