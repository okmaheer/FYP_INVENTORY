<?php

namespace App\Http\Controllers\Marquee;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Marquee\StageDecoration;
use App\Models\Product;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StageDecorationController extends Controller
{
    public $model;
    private $location;

    public function __construct(StageDecoration $stageDecoration)
    {
        $this->middleware('auth');
        $this->model = $stageDecoration;
        $this->middleware(function ($request, $next){
            $this->location = session(SessionEnum::SESSION_LOCATION_ID);
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     * @throws AuthorizationException
     */
    public function index()
    {
        $data = $this->model->where('location_id', $this->location)->get();
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'List of Stage Decorations' => '',
        ]);

        $page_title = "List of Stage Decorations";
        return view('dashboard.marquee.stage-decorations.index', compact('breadcrumbs','page_title', 'data'));
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
            'List of Stage Decorations' => route('dashboard.marquee.stage-decorations.index'),
            'Create Stage Decorations' => '',
        ]);

        $page_title = "Create Stage Decorations";

        return view('dashboard.marquee.stage-decorations.create', compact('breadcrumbs','page_title'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $product = Product::create([
            'product_name' => $request->name,
            'category_id' => Category::where('type', 'raw_materials')->first()->id,
            'price' => $request->price,
            'location_id' => $this->location,
        ]);

        $this->model = $this->model->create($request->all());
        if ($this->model) {
            $this->model->location_id = $this->location;
            $this->model->product_id = $product->id;
            $this->model->save();

        }

        if ($request->saveNew == 1) {
            return redirect()->route('dashboard.marquee.stage-decorations.create')
                ->with('success', 'Stage Decoration Created Successfully.');
        } else {
            return redirect()->route('dashboard.marquee.stage-decorations.index')
                ->with('success', 'Stage Decoration is Created Successfully.');
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
            'List of Stage Decorations' => route('dashboard.marquee.stage-decorations.index'),
            'Edit Stage Decorations' => '',
        ]);

        $page_title = "Edit Stage Decorations";

        return view('dashboard.marquee.stage-decorations.edit', compact('breadcrumbs','page_title', 'model'));
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
        Product::find($this->model->product_id)->update(['product_name' => $request->name, 'price' => $request->price]);

        return redirect()->route('dashboard.marquee.stage-decorations.index')
            ->with('success', 'Stage Decoration updated successfully');
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
            return view('dashboard.marquee.stage-decorations.index')
                ->with('success', 'Stage Decoration Deleted successfully');
        }
    }


}
