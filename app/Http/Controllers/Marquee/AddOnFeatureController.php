<?php

namespace App\Http\Controllers\Marquee;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\Marquee\AddOnFeature;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AddOnFeatureController extends Controller
{
    public $model;
    private $location;

    public function __construct(AddOnFeature $addon)
    {
        $this->middleware('auth');
        $this->model = $addon;
        $this->middleware(function ($request, $next){
            $this->location = session(SessionEnum::SESSION_LOCATION_ID);
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        $data = $this->model->where('location_id', $this->location)->get();
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'List of Addon Features' => '',
        ]);

        $page_title = "List of all Bookings";
        return view('dashboard.marquee.add-on-features.index', compact('breadcrumbs','page_title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'List of Addon Features' => route('dashboard.marquee.add-on-features.index'),
            'Create Addon Feature' => '',
        ]);

        $page_title = "Create Addon Feature";

        return view('dashboard.marquee.add-on-features.create', compact('breadcrumbs','page_title'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $this->model = $this->model->create($request->all());
        if ($this->model) {
            $this->model->location_id = $this->location;
            $this->model->save();
        }
        if ($request->saveNew == 1) {
            return redirect()->route('dashboard.marquee.add-on-features.create')
                ->with('success', 'Addon Feature Created Successfully.');
        } else {
            return redirect()->route('dashboard.marquee.add-on-features.index')
                ->with('success', 'Addon Feature Created Successfully.');
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return Application|Factory|View
     */
    public function edit(Request $request, $id)
    {
        $model = $this->model->where('location_id', $this->location)->findorFail($id);
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'List of Addon Features' => route('dashboard.marquee.add-on-features.index'),
            'Edit Addon Feature' => '',
        ]);

        $page_title = "Edit Addon Feature";

        return view('dashboard.marquee.add-on-features.edit', compact('breadcrumbs','page_title', 'model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $this->model->where('location_id', $this->location)->findorFail($id)->update($request->all());
        $this->model = $this->model->where('location_id', $this->location)->find($id);

        return redirect()->route('dashboard.marquee.add-on-features.index')
            ->with('success', 'Addon Feature Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function destroy(int $id)
    {
        $this->model = $this->model->where('location_id', $this->location)->findorFail($id);
        if ($this->model) {
            $this->model->delete();
            return redirect()->route('dashboard.marquee.add-on-features.index')
                ->with('success', 'Addon Feature Deleted successfully');
        }
    }


}
