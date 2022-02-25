<?php

namespace App\Http\Controllers\Marquee;

use App\Http\Controllers\Controller;
use App\Models\Marquee\StageQuotation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Prefixes;

class StageQuotationController extends Controller
{
    protected $model = null;

    public function __construct(StageQuotation $model)
    {
        $this->model = $model;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $page_title = "List of Stage Quotations";
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Stage Booking Quotations' => '',
        ]);

        $data = $this->model::with('stageDecorations');

        if ($request->has('customer_id') &&  $request->get('customer_id') != '') {
            $data = $data->where('id', $request->customer_id);
        }
        if ($request->has('q_id') &&  $request->get('q_id') != '') {
            $data = $data->where('id', $request->q_id);
        }

        $data = $data->get();

        $customer = $this->model::with('stageDecorations')->pluck('customer_name','id');

        $mobile = $this->model::with('stageDecorations')->pluck('phone_number','id');

        return view('dashboard.marquee.quotations.stage-booking.index', compact('page_title', 'breadcrumbs', 'data','customer','mobile'));
    }

    public function create()
    {
        $page_title = "New Stage Booking Quotation";
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Stage Booking Quotations' => route('dashboard.marquee.quotation.stage.index'),
            'New Stage Booking Quotation' => ''
        ]);

        $quot_no = Prefixes::generateNumber('QS'); /* 'QS-'.str_pad($this->model->maxId(),5,'0',STR_PAD_LEFT); */
        return view('dashboard.marquee.quotations.stage-booking.create',compact('page_title', 'breadcrumbs', 'quot_no'));
    }

    public function store(Request $request)
    {
      

        $this->model = $this->model->create($request->all());
        if ($this->model) {
            Prefixes::updateNumber('QS');

            $this->model->processing_by = auth()->user()->id;
            $this->model->save();

            if ($request->has('stageDecorations')) {
                $input = $request->input('stageDecorations', array());
                $count = $input['name'];
                if (count($count) > 0) {
                    foreach ($count as $key => $value) {
                        $stage_decoration_id = $input['id'][$key];
                        if ($stage_decoration_id != '') {
                            $quantity = $input['quantity'][$key];
                            $discount = $input['discount'][$key];
                            $price = $input['price'][$key];
                            $net_total = $input['net_total'][$key];
                            $total = $input['total'][$key];
                            DB::table('quotation_booking_stage_decorations')->insert([
                                'stage_quotation_id' => $this->model->id,
                                'stage_decoration_id' => $stage_decoration_id,
                                'quantity' => $quantity,
                                'discount' => $discount,
                                'price' => $price,
                                'net_total' => $net_total,
                                'total' => $total,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now()
                            ]);
                        }
                    }
                }
            }
        }

        if ($request->doPrint == 1) {
            return redirect()->route('view.quotation.stage',$this->model->id)->with('page_title', 'Stage Booking Quotation');
        } else {
            return redirect()->route('dashboard.marquee.quotation.stage.index')->with('success', 'Stage Quotation Created Successfully');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $page_title = "Edit Stage Booking Quotation";
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Stage Booking Quotations' => route('dashboard.marquee.quotation.stage.index'),
            'Edit Stage Booking Quotation' => ''
        ]);

        $model = $this->model->with('stageDecorations')->whereId($id)->first();
        return view('dashboard.marquee.quotations.stage-booking.edit', compact('page_title', 'breadcrumbs', 'model'));
    }

    public function update(Request $request, $id)
    {
        $this->model->find($id)->update($request->all());
        $this->model = $this->model->find($id);

        if ($this->model) {

            DB::table('quotation_booking_stage_decorations')->whereStageQuotationId($id)->delete();

            if ($request->has('stageDecorations')) {
                $input = $request->input('stageDecorations', array());
                $count = $input['name'];
                if (count($count) > 0) {
                    foreach ($count as $key => $value) {
                        $stage_decoration_id = $input['id'][$key];
                        if ($stage_decoration_id != '') {
                            $quantity = $input['quantity'][$key];
                            $discount = $input['discount'][$key];
                            $price = $input['price'][$key];
                            $net_total = $input['net_total'][$key];
                            $total = $input['total'][$key];
                            DB::table('quotation_booking_stage_decorations')->insert([
                                'stage_quotation_id' => $this->model->id,
                                'stage_decoration_id' => $stage_decoration_id,
                                'quantity' => $quantity,
                                'discount' => $discount,
                                'price' => $price,
                                'net_total' => $net_total,
                                'total' => $total,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now()
                            ]);
                        }
                    }
                }
            }
        }

        if ($request->doPrint == 1) {
            return redirect()->route('view.quotation.stage',$this->model->id)->with('page_title', 'Stage Booking Quotation');
        } else {
            return redirect()->route('dashboard.marquee.quotation.stage.index')->with('success', 'Stage Quotation Updated Successfully');
        }

    }

    public function destroy($id)
    {
        $this->model->find($id)->delete();
        return redirect()->route('dashboard.marquee.quotation.stage.index')->with('success', 'Stage Quotation Removed Successfully');
    }

    public function stagequotationreport(Request $request){
        $page_title = "Stage Quotation Report";
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Stage Booking Quotations' => route('dashboard.marquee.quotation.stage.index'),
            'Stage Booking Quotations Report' => ''
        ]);

        $data = $this->model::with('stageDecorations')->paginate(20);


       if ($request->has('customer_id') &&  $request->get('customer_id') != '') {

        $data = $data->where('id', $request->customer_id);

    }
    if ($request->has('q_id') &&  $request->get('q_id') != '') {

        $data = $data->where('id', $request->q_id);

    }

        $customer = $this->model::with('stageDecorations')->pluck('customer_name','id');
        // dd($customer);
        $mobile = $this->model::with('stageDecorations')->pluck('phone_number','id');

        return view('dashboard.marquee.quotations.stage-booking.report', compact('page_title', 'breadcrumbs', 'data','mobile','customer'));
    }
}
