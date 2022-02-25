<?php

namespace App\Http\Controllers\Marquee;

use App\Http\Controllers\Controller;
use App\Models\AccountHead;
use App\Models\Category;
use App\Models\Demand;
use App\Models\DemandDetail;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\Product;
use App\Models\Salary;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HRDemandController extends Controller
{
    public $model;
    public $modelDetail;
    public $product;
    public $category;
    public $designation;
    public $employee;
    public $salary;

    public function __construct(Demand $model, DemandDetail $modelDetail, Product $product, Category $category,Designation $designation,Employee $employee)
    {
        $this->model = $model;
        $this->modelDetail = $modelDetail;
        $this->product = $product;
        $this->category = $category;
        $this->designation = $designation;
        $this->employee = $employee;
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
        return view('dashboard.marquee.hr-resources-demand.manage',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $demandNo = $this->model->maxId();
        $user = auth()->user();
        $designation = $this->designation->pluck('name', 'id');
        $employee = $this->employee->get()->pluck('full_name','id');

        return view('dashboard.marquee.hr-resources-demand.create',compact('demandNo','user','designation','employee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        print_r($request->all());
//        return;
        $this->model = $this->model->create($request->all());
        $this->model->save();

        if ($request->has('hrDemand')) {
            $demand = $request->input('hrDemand', array());
            $count = $demand['employee_id'];
            if (count($count) > 0) {
                foreach ($count as $key => $value) {
                    $emp_id = $demand['employee_id'][$key];
                    if ($emp_id != '') {
                        $designation = $demand['designation_id'][$key];
                        $shift = $demand['shift'][$key];
                        $timing = $demand['timing'][$key];
                        $wages = $demand['wages'][$key];
                        $total = $demand['total'][$key];

                        DB::table('demand_hr_details')->insert([

                            'demand_id' => $this->model->id,
                            'employee_id' => $emp_id,
                            'designation_id' => $designation,
                            'shift' => $shift,
                            'timing' => $timing,
                            'wage' => $wages,
                            'total' => $total,

                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ]);
                    }

                    $employeName = $this->employee->getEmployeeName($emp_id);
                    $headcode   = AccountHead::where('employee_id',$emp_id)->value('HeadCode');

//                    print_r($headcode);
//                    return;
                    $salary = Salary::create([
                        "employee_id" => $emp_id,
                        "custom_booking_number" => $request->custom_booking_number ,
                        "total_salary" => $demand['total'][$key],
                        'payment_due' => 'paid',
                        'payment_date' => Carbon::now(),
                    ]);

//        cc
                    $salary->transactions()->save(
                        new Transaction([
                            'Vtype' => 'Salary',
                            'VDate' => Carbon::now(),
                            'COAID' => 1020101,
                            'Narration' => 'Cash in hand Credit For Employee Salary for-  '.$employeName.' Against Booking Number '.$request->custom_booking_number,
                            'Debit' => 0,
                            'Credit' => $demand['total'][$key],
                            'IsPosted' => 1,
                            'created_by' => Auth::id(),
                            'created_at' => Carbon::now(),
                            'IsAppove' => 1
                        ])
                    );

                    //account payable
                    $salary->transactions()->save(
                        new Transaction([
                            'Vtype' => 'Salary',
                            'VDate' => Carbon::now(),
                            'COAID' => $headcode,
                            'Narration' => 'Cash in hand Credit For Employee Salary for-  '.$employeName.' Against Booking Number '.$request->custom_booking_number,
                            'Debit' => $demand['total'][$key],
                            'Credit' => 0,
                            'IsPosted' => 1,
                            'created_by' => Auth::id(),
                            'created_at' => Carbon::now(),
                            'IsAppove' => 1
                        ])
                    );
//        company expense for employee salary

                    $salary->transactions()->save(
                        new Transaction([
                            'Vtype' => 'Salary',
                            'VDate' => Carbon::now(),
                            'COAID' => 403,
                            'Narration' => 'Cash in hand Credit For Employee Salary for-  '.$employeName.' Against Booking Number '.$request->custom_booking_number,
                            'Debit' => $demand['total'][$key],
                            'Credit' => 0,
                            'IsPosted' => 1,
                            'created_by' => Auth::id(),
                            'created_at' => Carbon::now(),
                            'IsAppove' => 1
                        ])
                    );
                }
            }

        }

        if ($request->has('addonResource')) {
            $addonResources = $request->input('addonResource', array());
            $count = $addonResources['name'];
            if (count($count) > 0) {
                foreach ($count as $key => $value) {
                    $item_id = $addonResources['id'][$key];
                    if ($item_id != '') {
                        $quantity = $addonResources['quantity'][$key];
                        $price = $addonResources['price'][$key];
                        $total = $addonResources['total'][$key];

                        DB::table('demand_details')->insert([

                            'demand_id' => $this->model->id,
                            'product_id' => $item_id,
                            'quantity' => $quantity,
                            'price' => $price,
                            'total' => $total,

                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ]);
                    }
                }
            }

        }


        return redirect()->route('dashboard.marquee.hr_demand.index')
            ->with('success', 'Demand Added successfully');
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
        $designation = $this->designation->pluck('name', 'id');
        $employee = $this->employee->get()->pluck('full_name','id');
        $model = $this->model->with('demandDetails', 'demandHrDetails')->whereId($id)->first();

        return view('dashboard.marquee.hr-resources-demand.edit',compact('model','designation','employee'));
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
        $this->model->find($id)->update($request->all());
        $this->model = $this->model->find($id);
        if ($request->has('hrDemand')) {

            DB::table('demand_hr_details')->where('demand_id', $id)->delete();

            $demand = $request->input('hrDemand', array());
            $count = $demand['employee_id'];
            if (count($count) > 0) {
                foreach ($count as $key => $value) {
                    $emp_id = $demand['employee_id'][$key];
                    if ($emp_id != '') {
                        $designation = $demand['designation_id'][$key];
                        $shift = $demand['shift'][$key];
                        $timing = $demand['timing'][$key];
                        $wages = $demand['wages'][$key];

                        DB::table('demand_hr_details')->insert([

                            'demand_id' => $this->model->id,
                            'employee_id' => $emp_id,
                            'designation_id' => $designation,
                            'shift' => $shift,
                            'timing' => $timing,
                            'wage' => $wages,

                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ]);
                    }
                }
            }

        }

        if ($request->has('addonResource')) {

            DB::table('demand_details')->where('demand_id', $id)->delete();

            $addonResources = $request->input('addonResource', array());
            $count = $addonResources['name'];
            if (count($count) > 0) {
                foreach ($count as $key => $value) {
                    $item_id = $addonResources['id'][$key];
                    if ($item_id != '') {
                        $quantity = $addonResources['quantity'][$key];
                        $price = $addonResources['price'][$key];
                        $total = $addonResources['total'][$key];

                        DB::table('demand_details')->insert([

                            'demand_id' => $this->model->id,
                            'product_id' => $item_id,
                            'quantity' => $quantity,
                            'price' => $price,
                            'total' => $total,

                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ]);
                    }
                }
            }

        }

        return redirect()->route('dashboard.marquee.hr_demand.index')
            ->with('success', 'Demand Added successfully');

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
        return redirect()->route('dashboard.marquee.hr_demand.index')->with('successMessage', 'Demand Removed Successfully');
    }
}
