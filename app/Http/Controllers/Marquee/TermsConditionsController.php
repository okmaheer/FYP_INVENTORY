<?php

namespace App\Http\Controllers\Marquee;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\Marquee\TermsConditions;
use Illuminate\Http\Request;

class TermsConditionsController extends Controller
{

    protected $model;
    private $location;

    public function __construct(TermsConditions $model)
    {
        $this->middleware('auth');
        $this->model = $model;
        $this->middleware(function ($request, $next){
            $this->location = session(SessionEnum::SESSION_LOCATION_ID);
            return $next($request);
        });
    }
    public function index()
    {
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Terms & Conditions' => '',
        ]);

        $page_title = "Terms & Conditions";

        $model = $this->model->where('location_id', $this->location)->first();

        return view('dashboard.marquee.terms_conditions.index', compact('breadcrumbs','page_title', 'model'));

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
        $urd = $request->input('is_urdu', 0);
        $this->model = $this->model->where('location_id', $this->location)->first();
        $this->model->fill([
            'is_urdu' => $urd,
            'event_terms' => $request->input('event_terms'),
            'stage_terms' => $request->input('stage_terms'),
        ])->save();

        return redirect()->route('dashboard.marquee.terms.index')->with('success', 'Terms and Conditions updated successfully.');
    }

    public function destroy($id)
    {
        //
    }
}
