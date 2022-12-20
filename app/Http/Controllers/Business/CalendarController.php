<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $events = [];

        $bs_id = auth()->user()->business->first()->id;
        $reservations = Reservation::where('business_id', $bs_id)->with(['user', 'business', 'cabin', 'provider'])->get();

        foreach ($reservations as $reservation) {
            $events[] = [
                'title' => $reservation->user->name,
                'cabin' => $reservation->cabin->name,
                'provider' => $reservation->provider->name . ' ' .'('. $reservation->provider->duration .') Min.',
                'start' => $reservation->start_time,
                'end' => $reservation->finish_time,
            ];
        }

        $business = auth()->user()->business->first();
        $patients = $business->user()->whereRole('patient')->get();
        $cabins = $business->cabin;
        $providers = $business->providers;

        return view('business.reservation.calendar', compact('events', 'patients', 'cabins', 'providers'));
    }
}
