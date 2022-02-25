<?php

namespace App\Http\Controllers\Marquee;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Marquee\ReceiveDemandController;
use App\Models\Category;
use App\Models\Demand;
use App\Models\DemandDetail;
use App\Models\Marquee\Recipe;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DemandBookingController extends Controller
{
    public $model;
    public $modelDetail;
    public $product;
    public $category;

    public function __construct(Demand $model, DemandDetail $modelDetail, Product $product, Category $category)
    {
        $this->model = $model;
        $this->modelDetail = $modelDetail;
        $this->product = $product;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $bookingId = $request->id;
        $recipe = DB::table('booking_food_items as bfi')
            ->join('recipes as r', 'r.recipe_product_id', '=', 'bfi.product_id')
            ->selectRaw('r.recipe_product_id,bfi.quantity')
            ->where(['booking_id' => $bookingId])
            ->get();

        //create demand head
        $this->model = $this->model->create([
            'booking_id' => $bookingId,
            'type' => 'booking'
        ]);

        foreach ($recipe as $recipe) {

            $recipeDetails = DB::table('booking_food_items as bfi')
                ->join('recipes as r', 'r.recipe_product_id', '=', DB::raw($recipe->recipe_product_id))
                ->join('recipe_details as rd', 'rd.recipe_id', '=', 'r.id')
                ->selectRaw('distinct rd.*')
                ->where(['booking_id' => $bookingId])
                ->get();

            //create demand detail
            foreach ($recipeDetails as $key => $demand) {
                $quantity = $demand->final_quantity * $recipe->quantity;
                $price = $demand->price;
                $item_id = $demand->product_id;

                $this->model->demandDetails()->save(
                    new DemandDetail(
                        ['product_id' => $item_id,
                            'quantity' => $quantity,
                            'price' => $price])
                );

            }
        }

        return redirect()->route('dashboard.marquee.booking.index')->with('success', 'Demand Created Successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
