<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provider;

class ProviderDuration extends Controller
{
    public function duration() {
        $providers = Provider::all();

        return $providers;
    }
}
