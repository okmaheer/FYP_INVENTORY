<?php

namespace App\Http\Controllers\Marquee;

use App\Http\Controllers\Controller;
use App\Models\Marquee\GatePass;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GatePassController extends Controller
{
    protected $model = null;

    public function __construct(GatePass $model)
    {
        $this->model = $model;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  $page_title = "Gate Pass";
        $data = $this->model->get();
//  dd($data);
         return view('dashboard.marquee.gate-pass.create.index', compact('page_title','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = "Create New Gate Pass";
        return view('dashboard.marquee.gate-pass.create.create', compact('page_title'));
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

            if ($request->has('foodItems')) {
                $foodItems = $request->input('foodItems', array());
                $foodCount = $foodItems['name'];
                if (count($foodCount) > 0) {
                    foreach ($foodCount as $key => $value) {
                        $product_id = $foodItems['id'][$key];
                        $quantity = $foodItems['quantity'][$key];
                       $packing = $foodItems['packing'][$key];
                       $description = $foodItems['description'][$key];
                        $total = $foodItems['total'][$key];
                        DB::table('gate_pass_menus')->insert([
                            'quantity' => $quantity,
                           'packing' => $packing,
                           'description' => $description,
                            'total_items' => $total,
                            'gatepass_id' => $this->model->id,
                            'booking_id' => $request->booking_id,
                            'product_id' => $product_id,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ]);
                    }
                }
            }
            if ($request->has('hardwareItems')) {
                $hardwareItems = $request->input('hardwareItems', array());
                $hardwareCount = $hardwareItems['name'];
                if (count($hardwareCount) > 0) {
                    foreach ($hardwareCount as $key => $value) {
                        $product_id = $hardwareItems['id'][$key];
                        $quantity = $hardwareItems['quantity'][$key];
                       $packing = $foodItems['packing'][$key];
                       $description = $foodItems['description'][$key];
                        $total = $hardwareItems['total'][$key];
                        DB::table('gate_pass_hardware')->insert([
                            'quantity' => $quantity,
                           'packing' => $packing,
                           'description' => $description,
                            'total_items' => $total,
                            'gatepass_id' => $this->model->id,
                            'booking_id' => $request->booking_id,
                            'product_id' => $product_id,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ]);
                    }
                }
            }
        }

        return redirect()->route('dashboard.marquee.gatepass.index');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->model->find($id)->delete();
        return redirect()->route('dashboard.marquee.gatepass.index');
    }
}
