<?php

namespace App\Http\Controllers\Dashboard;

use App\Enum\RoleEnum;
use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller

{

    private $location;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->location = session(SessionEnum::SESSION_LOCATION_ID);
            return $next($request);
        });
        $this->middleware('auth');
    }
    public function index()
    {
        $page_title = 'Dashboard';
        $breadcrumbs = collect([
            'Dashboard' => '',
        ]);
        return view('dashboard.index', compact('breadcrumbs','page_title'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }


}
