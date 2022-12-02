<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class HomeController extends Controller {
    private $subdomain;

    public function __construct(Request $request)
    {
        $this->subdomain = $request->subdomain;
    }

    public function show() {
        $subdomain = Business::whereSubdomain($this->subdomain)->first();
        return view('business.show', ['subdomain' => $subdomain]);
    }

    public function index() {
        $businesses = Business::all();
        return view('business.index', ['businesses'=> $businesses]);
    }

}
