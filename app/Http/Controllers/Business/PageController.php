<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Business;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PageController extends Controller
{
    private $subdomain;

    public function __construct(Request $request)
    {
        $this->subdomain = $request->subdomain;
    }

    public function dashboard() {
        $businesses = Business::all();
        return view('business.dashboard', ['businesses'=> $businesses]);
    }

    public function show() {
        $user = auth()->user();
        $subdomain = Business::whereSubdomain($this->subdomain)->first();
        return view('business.show', compact('subdomain', 'user'));
    }

}
