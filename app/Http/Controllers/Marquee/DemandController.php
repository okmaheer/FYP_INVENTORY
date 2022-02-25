<?php

namespace App\Http\Controllers\Marquee;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Demand;
use App\Models\DemandDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DemandController extends Controller
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
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = $this->model->get();
    //   dd($data);

       return view('dashboard.marquee.demand.create_demand.manage',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = $this->category->with('products')->whereType('raw_materials')->first();
        return view('dashboard.marquee.demand.create_demand.create', compact('category'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->model = $this->model->create($request->all());
        $this->model->save();


        if ($request->has('demand')) {
            $demand = $request->input('demand', array());
            $count = $demand['name'];
            if (count($count) > 0) {
                foreach ($count as $key => $value) {
                    $item_id = $demand['id'][$key];
                    if ($item_id != '') {
                        $quantity = $demand['quantity'][$key];

                        DB::table('demand_details')->insert([

                            'demand_id' => $this->model->id,
                            'product_id' => $item_id,
                            'quantity' => $quantity,

                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ]);
                    }
                }
            }

        }

        return redirect()->route('dashboard.marquee.demand.index')
        ->with('success', 'Demand Added successfully');
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
//        $category = \MarqueeHelper::getDemandProducts(14,1);
        $demand = Demand::with(['demandDetails',function($query) {
            $query->where('product_id',14);
        }])->where('id',1)->first();
//        echo "<pre>";
//        print_r($demand);
//        return;
//        $model = $this->model->with('demandDetails.product.category')->whereId($id)->first();
        $category = Category::with('products')->whereType('raw_materials')->first();

        return view('dashboard.marquee.demand.create_demand.edit', compact('model','category'));
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
        $this->model->find($id)->delete();
        return redirect()->route('dashboard.marquee.demand.index')
        ->with('success', 'Demand Deleted successfully');
    }

    public function DemandInvoice($id)
    {

        $page_title = "Demand Invoice";

        $model = $this->model->with('demandDetails')->whereId($id)->first();

      return view('dashboard.marquee.demand.create_demand.invoice',compact('model','page_title'));
    }

    public function createWithoutBooking()
    {
        $category = $this->category->with('products')->whereType('raw_materials')->first();
        return view('dashboard.marquee.demand.create_demand.create-without-booking', compact('category'));
    }

}
