<?php

namespace App\Http\Controllers\Marquee;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\Marquee\ExtraFoodItem;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ExtraFoodItemController extends Controller
{
    public $model;
    private $location;

    public function __construct(ExtraFoodItem $extra_food_items)
    {
        $this->middleware('auth');
        $this->model = $extra_food_items;
        $this->middleware(function ($request, $next){
            $this->location = session(SessionEnum::SESSION_LOCATION_ID);
            return $next($request);
        });
    }
    public function index()
    {
        $data = $this->model->where('location_id', $this->location)->get();
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'List of Extra Food Items' => '',
        ]);

        $page_title = "List of Extra Food Items";
        return view('dashboard.marquee.extra-food-item.index', compact('breadcrumbs','page_title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'List of Extra Food Items' => route('dashboard.marquee.extra_food_items.index'),
            'Create Extra Food Item' => '',
        ]);

        $page_title = "Create Extra Food Item";

        return view('dashboard.marquee.extra-food-item.create', compact('breadcrumbs','page_title'));
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
            return redirect()->route('dashboard.marquee.extra_food_items.create')
                ->with('success', 'Extra Food Item Created Successfully.');
        } else {
            return redirect()->route('dashboard.marquee.extra_food_items.index')
                ->with('success', 'Extra Food Item Created Successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = $this->model->where('location_id', $this->location)->findorFail($id);
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'List of Extra Food Item' => route('dashboard.marquee.extra_food_items.index'),
            'Edit Extra Food Item' => '',
        ]);

        $page_title = "Edit Extra Food Item";

        return view('dashboard.marquee.extra-food-item.edit', compact('breadcrumbs','page_title', 'model'));
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

        return redirect()->route('dashboard.marquee.extra_food_items.index')
            ->with('success', 'Extra Food Item Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function destroy($id)
    {
        $this->model = $this->model->where('location_id', $this->location)->findorFail($id);
        if ($this->model) {
            $this->model->delete();
            return redirect()->route('dashboard.marquee.extra_food_items.index')
                ->with('success', 'Extra Food Item Deleted successfully');
        }
    }
}
