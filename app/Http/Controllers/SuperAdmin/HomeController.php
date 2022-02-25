<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Enum\CacheEnum;
use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\BusinessLocation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index() {
        if (!session()->has(SessionEnum::SESSION_LOCATION_ID)) {
            return redirect()->route('super-admin.locations');
        }

        $page_title = 'Dashboard';

        return view('dashboard.accounts.super-admin.index', compact('page_title'));
    }

    public function locationSelection() {
        if (session()->has(SessionEnum::SESSION_LOCATION_ID)) {
            return redirect()->route('super-admin.dashboard');
        }

        $locations = BusinessLocation::orderBy('name', 'ASC')->get();
        $page_title = 'Location Selection';

        return view('dashboard.accounts.super-admin.locations', compact('locations', 'page_title'));
    }

    public function changeLocation(Request $request)
    {
        $location = BusinessLocation::findorFail($request->location);
        session()->put(SessionEnum::SESSION_LOCATION_ID, $location->id);
        session()->put(SessionEnum::SESSION_BUSINESS_ID, $location->business->id);
        CacheEnum::storeLocation($location);

        return redirect()->route('super-admin.dashboard');
    }

    public function clearLocation() {
        session()->pull(SessionEnum::SESSION_LOCATION_ID);
        session()->pull(SessionEnum::SESSION_BUSINESS_ID);
        Cache::forget(CacheEnum::AUTH_LOCATION);
        return redirect()->route('super-admin.dashboard');
    }
}
