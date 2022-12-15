<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Business;
use App\Providers\RouteServiceProvider;
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

    public function show_business() {
        $user = auth()->user();
        $subdomain = Business::whereSubdomain($this->subdomain)->first();
        return view('business.show', compact('subdomain', 'user'));
    }

}
