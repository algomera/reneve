<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Business;
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
        return view('admin.dashboard');
    }

    public function business() {
        $businesses = Business::all();
        return view('admin.business', ['businesses'=> $businesses]);
    }

    public function show_business() {
        dd('qui');
        $user = auth()->user();
        $subdomain = Business::whereSubdomain($this->subdomain)->first();
        return view('business.show', compact('subdomain', 'user'));
    }

}
