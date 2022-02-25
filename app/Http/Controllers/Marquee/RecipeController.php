<?php

namespace App\Http\Controllers\Marquee;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Marquee\RecipeDetail;
use App\Models\Marquee\Recipe;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class RecipeController extends Controller
{
    protected $model;
    protected $modelDetail;
    private $location;

    public function __construct(Recipe $model,RecipeDetail $modelDetail)
    {
        $this->middleware('auth');
        $this->model = $model;
        $this->modelDetail = $modelDetail;
        $this->middleware(function ($request, $next){
            $this->location = session(SessionEnum::SESSION_LOCATION_ID);
            return $next($request);
        });
    }
    /**
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Recipes' => '',
        ]);

        $page_title = "Recipes";

        $data = $this->model->where('location_id', $this->location)->get();

        return view('dashboard.marquee.recipe.index', compact('page_title', 'breadcrumbs', 'data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = "Create New Recipe";
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Recipes' => route('dashboard.marquee.recipe.index'),
            'Create New Recipe' => ''
        ]);

        $units = Unit::where('location_id', $this->location)->whereStatus('1')->pluck('unit_name', 'id');
        return view('dashboard.marquee.recipe.create', compact('page_title', 'breadcrumbs', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->model = $this->model->create($request->all());
        if ($this->model) {
            $this->model->location_id = $this->location;
            if ($request->has('ingredient')) {
                $ingredient = $request->input('ingredient', array());
                $count = $ingredient['name'];
                if (count($count) > 0) {
                    foreach ($count as $key => $value) {
                        $item_id = $ingredient['id'][$key];
                        if ($item_id != '') {
                            //$wastage = $ingredient['wastage'][$key];
                            $final_quantity = $ingredient['final_quantity'][$key];
                            $unit = $ingredient['unit'][$key];
                            $price = $ingredient['price'][$key];
                            $total_amount = $ingredient['total_amount'][$key];

                            $this->model->recipeDetails()->save(
                                new RecipeDetail([
                                    //'wastage' => $wastage,
                                    'wastage' => null,
                                    'final_quantity' => $final_quantity,
                                    'unit' => $unit,
                                    'price' => $price,
                                    'total_amount' => $total_amount,
                                    'product_id' => $item_id
                                ])
                            );

                        }
                    }
                }
            }

        }

        if ($request->saveNew == 1) {
            return redirect()->route('dashboard.marquee.recipe.create')->with('success', 'Recipe created successfully');
        } else {
            return redirect()->route('dashboard.marquee.recipe.index')->with('success', 'Recipe created successfully');
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
        $page_title = "Edit Recipe";
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Recipes' => route('dashboard.marquee.recipe.index'),
            'Edit Recipe' => ''
        ]);
        $units = Unit::where('location_id', $this->location)->whereStatus('1')->pluck('unit_name', 'id');
        $model =  $this->model->where('location_id', $this->location)->with('recipeDetails')->findorFail($id);

        return view('dashboard.marquee.recipe.edit',compact('model', 'page_title', 'breadcrumbs', 'units'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->model->where('location_id', $this->location)->findorFail($id)->update($request->all());
        $this->model = $this->model->where('location_id', $this->location)->find($id);
        $this->model->save();

        $this->modelDetail->where('recipe_id',$this->model->id)->delete();

        if ($this->model) {
            if ($request->has('ingredient')) {
                $ingredient = $request->input('ingredient', array());
                // dd($ingredient);
                $count = $ingredient['name'];
                if (count($count) > 0) {
                    foreach ($count as $key => $value) {
                        $item_id = $ingredient['id'][$key];
                        if ($item_id != '') {
                            //$wastage = $ingredient['wastage'][$key];
                            $final_quantity = $ingredient['final_quantity'][$key];
                            $unit = $ingredient['unit'][$key];
                            $price = $ingredient['price'][$key];
                            $total_amount = $ingredient['total_amount'][$key];

                            $this->model->recipeDetails()->save(
                                new RecipeDetail([
                                    'wastage' => null,
                                    'final_quantity' => $final_quantity,
                                    'unit' => $unit,
                                    'price' => $price,
                                    'total_amount' => $total_amount,
                                    'product_id' => $item_id
                                ])
                            );

                        }
                    }
                }
            }
        }

        return redirect()->route('dashboard.marquee.recipe.index')
        ->with('success', 'Recipe update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $this->model->where('location_id', $this->location)->findorFail($id);
        if ($this->model) {
            $this->modelDetail->where('recipe_id',$this->model->id)->delete();
            $this->model->delete();
        }
        return redirect()->route('dashboard.marquee.recipe.index')
        ->with('success', 'Recipe Deleted successfully');

    }
    public function RecipeInvoice($id)
    {
        $page_title = "Recipe Print";
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Recipes' => route('dashboard.marquee.recipe.index'),
            'Recipe Print' => ''
        ]);
        $model =  $this->model->where('location_id', $this->location)->with('recipeDetails')->findorFail($id);

        return view('dashboard.marquee.recipe.invoice',compact('model', 'page_title'));
    }

}
