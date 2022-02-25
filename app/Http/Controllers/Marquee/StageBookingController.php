<?php

namespace App\Http\Controllers\Marquee;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\AccountHead;
use App\Models\Customer;
use App\Models\Marquee\Booking;
use App\Models\Marquee\Stage;
use App\Models\Marquee\TermsConditions;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Prefixes;

class StageBookingController extends Controller
{
    protected $model = null;
    protected $customer;
    protected $transaction;
    public $accountHead;
    private $location;

    public function __construct(Stage $model, Customer $customer,Transaction $transaction,AccountHead $accountHead)
    {
        $this->middleware('auth');
        $this->model = $model;
        $this->customer = $customer;
        $this->transaction = $transaction;
        $this->accountHead = $accountHead;
        $this->middleware(function ($request, $next){
            $this->location = session(SessionEnum::SESSION_LOCATION_ID);
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $page_title = "List of All Stages";
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Stage & Decor Bookings' => '',
        ]);

        $data = $this->model->where('location_id', $this->location)->with('booking', 'customer');

        if ($request->has('customer_name') &&  is_numeric($request->get('customer_name')) ) {
            $data = $data->where('customer_id', $request->customer_name);
        }

        if ($request->has('customer_cnic') &&  is_numeric($request->get('customer_cnic')) ) {
            $data = $data->where('customer_id', $request->customer_cnic);
        }

        if ($request->has('customer_no') &&  is_numeric($request->get('customer_no')) ) {
            $data = $data->where('customer_id', $request->customer_no);
        }

        if ($request->has('booking_date') &&  $request->get('booking_date') != '') {
            $data = $data->whereDate('created_at',  Carbon::parse($request->booking_date)->format('Y-m-d') );
        }

        $data = \QueryHelper::filterByDate($request,$data,'stage','stages');
        $data = $data->get();

        $model = $this->model->where('location_id', $this->location)->with('customer')->get();

        $customer = array();
        $cnic = array();
        $mobile = array();
        foreach ($model as $key => $value) {

        $customer[$value->customer->id]= $value->customer->customer_name;
        $cnic[$value->customer->id]= $value->customer->cnic;
        $mobile[$value->customer->id]= $value->customer->customer_mobile;
        }

        return view('dashboard.marquee.stage-bookings.index', compact('page_title', 'breadcrumbs', 'data','customer','cnic','mobile'));
    }

    public function create(Request $request)
    {
        $page_title = "New Stage Booking";
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Stage & Decor Bookings' => route('dashboard.marquee.stage.booking.index'),
            'New Stage & Decor Booking' => ''
        ]);

        $customer = $this->customer->where('location_id', $this->location)->get()->sortBy('name_cnic')->pluck('name_cnic','id');
        if ($request->has('id')) {
            $booking = Booking::where('location_id', $this->location)->findorFail($request->get('id'));
        } else {
            $booking = null;
        }
        $stage_booking_no = str_pad($this->model->maxId(),5,'0',STR_PAD_LEFT);
        return view('dashboard.marquee.stage-bookings.create-all', compact('page_title', 'breadcrumbs', 'customer','booking','stage_booking_no'));
    }

    public function  createWithoutBooking()
    {
        $page_title = "Create New Booking";
        $customer = $this->customer->where('location_id', $this->location)->get()->sortBy('name_cnic')->pluck('name_cnic','id');
        return view('dashboard.marquee.stage-bookings.create-without-booking', compact('page_title','customer'));
    }

    public function store(Request $request)
    {
        $this->model = $this->model->create($request->all());
        if ($this->model) {
            if ($request->category == 'WB') {
                $this->model->custom_stage_number = "WB-" . str_pad($this->model->id,5,'0',STR_PAD_LEFT);
            } else {
                $this->model->custom_stage_number = "WOB-" . str_pad($this->model->id,5,'0',STR_PAD_LEFT);
            }
            $this->model->processing_by = auth()->user()->id;
            $this->model->location_id = $this->location;
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
                            DB::table('booking_stage_decorations')->insert([
                                'booking_id' => $request->booking_id,
                                'quantity' => $quantity,
                                'discount' => $discount,
                                'price' => $price,
                                'net_total' => $net_total,
                                'total' => $total,
                                'customer_id' => $request->customer_id,
                                'stage_id' => $this->model->id,
                                'stage_decoration_id' => $stage_decoration_id,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now()
                            ]);
                        }
                    }
                }
            }
        }
        //Customer Debit Against Net Amount
        $headcode   = $this->accountHead->where('customer_id',$request->customer_id)->value('HeadCode');
        $customerName = $this->customer->getCustomerName($request->customer_id);

        if($request->booking_id > 0){
            $voucherNumber = Prefixes::generateNumber('CR-B');
            $transaction = $this->transaction->create([
                'VNo'            => $voucherNumber,
                'Vtype'          => 'CR-S',
                'VDate'          => Carbon::now(),
                'COAID'          => $headcode,
                'Narration'      => $customerName . " Debit Against Stage Booking No. " . $this->model->id . " Event Booking Ref# " . $request->custom_booking_number ,
                'Debit'          => $request->net_total,
                'Credit'         => 0,
                'IsPosted'       => 1,
                'is_opening'     => 1,
                'created_by'       => auth()->user()->id,
                'IsAppove'       => 1,
                'booking_id' => $this->model->booking->id,
                'location_id' => $this->location,
            ]);

            if($request->has('total_paid_amount') && $request->get('total_paid_amount') > 0 ){
                //Customer Credit Against Paid Amount
                $transaction = $this->transaction->create([
                    'VNo'            => $voucherNumber,
                    'Vtype'          => 'CR-S',
                    'VDate'          => Carbon::now(),
                    'COAID'          => $headcode,
                    'Narration'      => $customerName." Credit Against Stage Booking No. " . $this->model->id . " Event Booking Ref# " . $request->custom_booking_number ,
                    'Debit'          => 0,
                    'Credit'         => $request->total_paid_amount,
                    'IsPosted'       => 1,
                    'is_opening'     => 1,
                    'created_by'       => auth()->user()->id,
                    'IsAppove'       => 1,
                    'booking_id' => $this->model->booking->id,
                    'location_id' => $this->location,
                ]);

                //cash in hand Debit Against Paid Amount
                $this->transaction->create([
                    'VNo'            => $voucherNumber,
                    'Vtype'          => 'CR-S',
                    'VDate'          => Carbon::now(),
                    'COAID'          => '1020101',
                    'Narration'      => 'Cash in Hand For Debited For ' . $customerName. " Against Stage Booking No. " . $this->model->id . " Event Booking Ref# " . $request->custom_booking_number ,
                    'Debit'          => $request->total_paid_amount,
                    'Credit'         => 0,
                    'IsPosted'       => 1,
                    'is_opening'     => 1,
                    'created_by'       => auth()->user()->id,
                    'IsAppove'       => 1,
                    'booking_id' => $this->model->booking->id,
                    'location_id' => $this->location,
                ]);
            }
            Prefixes::updateNumber('CR-B');

        } else { //Vouchers Without Booking ID
            $voucherNumber = Prefixes::generateNumber('CR-S');
            //Customer Debit Against Net Amount
            $transaction = $this->transaction->create([
                'VNo'            => Prefixes::generateNumber('CR-S'),
                'Vtype'          => 'CR-S',
                'VDate'          => Carbon::now(),
                'COAID'          => $headcode,
                'Narration'      => $customerName . " Debit Against Stage Booking No. " . $this->model->id . " Ref# " . $request->custom_stage_number ,
                'Debit'          => $request->net_total,
                'Credit'         => 0,
                'IsPosted'       => 1,
                'is_opening'     => 1,
                'created_by'       => auth()->user()->id,
                'IsAppove'       => 1,
                'stage_id' => $this->model->id,
                'location_id' => $this->location,
            ]);

            if($request->has('total_paid_amount') && $request->get('total_paid_amount') > 0 ){
                //Customer Credit Against Paid Amount
                $transaction = $this->transaction->create([
                    'VNo'            => $voucherNumber,
                    'Vtype'          => 'CR-S',
                    'VDate'          => Carbon::now(),
                    'COAID'          => $headcode,
                    'Narration'      => $customerName . " Credit Against Stage Booking No. " . $this->model->id . " Ref# " . $request->custom_stage_number,
                    'Debit'          => 0,
                    'Credit'         => $request->total_paid_amount,
                    'IsPosted'       => 1,
                    'is_opening'     => 1,
                    'created_by'       => auth()->user()->id,
                    'IsAppove'       => 1,
                    'stage_id' => $this->model->id,
                    'location_id' => $this->location,
                ]);

                //cash in hand Debit Against Paid Amount
                $this->transaction->create([
                    'VNo'            => $voucherNumber,
                    'Vtype'          => 'CR-S',
                    'VDate'          => Carbon::now(),
                    'COAID'          => '1020101',
                    'Narration'      => 'Cash in Hand For Debited For ' . $customerName. " Against Stage Booking No. " . $this->model->id . " Ref# " . $request->custom_stage_number,
                    'Debit'          => $request->total_paid_amount,
                    'Credit'         => 0,
                    'IsPosted'       => 1,
                    'is_opening'     => 1,
                    'created_by'       => auth()->user()->id,
                    'IsAppove'       => 1,
                    'stage_id' => $this->model->id,
                    'location_id' => $this->location,
                ]);
            }
            Prefixes::updateNumber('CR-S');
        }
        if ($request->doPrint == 1) {
            return redirect()->route('stage.invoice',$this->model->id)->with('page_title', 'Stage Booking Invoice');
        } else {
            return redirect()->route('dashboard.marquee.stage.booking.index')->with('success', 'Stage Booking Created Successfully');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $page_title = "Edit Stage Booking";
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Stage & Decor Bookings' => route('dashboard.marquee.stage.booking.index'),
            'Edit Stage & Decor Booking' => ''
        ]);

        $customer = $this->customer->where('location_id', $this->location)->get()->sortBy('name_cnic')->pluck('name_cnic','id');
        $model = $this->model->where('location_id', $this->location)->with('stageDecorations', 'customer')->findorFail($id);
        if ($model->booking_id >0) {
            $booking = Booking::find($model->booking_id);
        } else {
            $booking = null;
        }
        $stage_booking_no = $model->custom_stage_number;
        return view('dashboard.marquee.stage-bookings.edit', compact('page_title', 'breadcrumbs', 'model', 'customer', 'booking','stage_booking_no'));
    }

    public function update(Request $request, $id)
    {
        $this->model->where('location_id', $this->location)->findorFail($id)->update($request->all());
        $this->model = $this->model->where('location_id', $this->location)->find($id);

        if ($this->model) {
            DB::table('booking_stage_decorations')->where('stage_id', $id)->delete();

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
                            DB::table('booking_stage_decorations')->insert([
                                'quantity' => $quantity,
                                'discount' => $discount,
                                'price' => $price,
                                'net_total' => $net_total,
                                'total' => $total,
                                'booking_id' => $request->booking_id,
                                'customer_id' => $request->customer_id,
                                'stage_id' => $this->model->id,
                                'stage_decoration_id' => $stage_decoration_id,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now()
                            ]);
                        }
                    }
                }
            }

            $headcode   = $this->accountHead->where('customer_id',$request->customer_id)->value('HeadCode');
            $customerName = $this->customer->getCustomerName($request->customer_id);

            if($request->booking_id > 0) {
                DB::table('transactions')->where('booking_id', $this->model->booking->id)->where('Vtype', 'CR-S')->delete();
                $voucherNumber = Prefixes::generateNumber('CR-B');
                //Customer Debit Against Net Amount
                $transaction = $this->transaction->create([
                    'VNo'            => $voucherNumber,
                    'Vtype'          => 'CR-S',
                    'VDate'          => Carbon::now(),
                    'COAID'          => $headcode,
                    'Narration'      => $customerName . " Debit Against Stage Booking No. " . $this->model->id . " Event Booking Ref# " . $request->custom_booking_number ,
                    'Debit'          => $request->net_total,
                    'Credit'         => 0,
                    'IsPosted'       => 1,
                    'is_opening'     => 1,
                    'created_by'       => auth()->user()->id,
                    'IsAppove'       => 1,
                    'booking_id' => $this->model->booking->id,
                    'location_id' => $this->location,
                ]);

                if($request->has('total_paid_amount') && $request->get('total_paid_amount') > 0 ){
                    //Customer Credit Against Paid Amount
                    $transaction = $this->transaction->create([
                        'VNo'            => $voucherNumber,
                        'Vtype'          => 'CR-S',
                        'VDate'          => Carbon::now(),
                        'COAID'          => $headcode,
                        'Narration'      => $customerName . " Credit Against Stage Booking No. " . $this->model->id . " Event Booking Ref# " . $request->custom_booking_number ,
                        'Debit'          => 0,
                        'Credit'         => $request->total_paid_amount,
                        'IsPosted'       => 1,
                        'is_opening'     => 1,
                        'created_by'       => auth()->user()->id,
                        'IsAppove'       => 1,
                        'booking_id' => $this->model->booking->id,
                        'location_id' => $this->location,
                    ]);

                    //cash in hand Debit Against Paid Amount
                    $this->transaction->create([
                        'VNo'            => $voucherNumber,
                        'Vtype'          => 'CR-S',
                        'VDate'          => Carbon::now(),
                        'COAID'          => '1020101',
                        'Narration'      => 'Cash in Hand For Debited For ' . $customerName . " Against Stage Booking No. " . $this->model->id . " Event Booking Ref# " . $request->custom_booking_number ,
                        'Debit'          => $request->total_paid_amount,
                        'Credit'         => 0,
                        'IsPosted'       => 1,
                        'is_opening'     => 1,
                        'created_by'       => auth()->user()->id,
                        'IsAppove'       => 1,
                        'booking_id' => $this->model->booking->id,
                        'location_id' => $this->location,
                    ]);
                }
                Prefixes::updateNumber('CR-B');

            } else { //Vouchers Without Booking ID
                DB::table('transactions')->where('stage_id', $id)->where('Vtype', 'CR-S')->delete();
                $voucherNumber = Prefixes::generateNumber('CR-S');
                //Customer Debit Against Net Amount
                $transaction = $this->transaction->create([
                    'VNo'            => $voucherNumber,
                    'Vtype'          => 'CR-S',
                    'VDate'          => Carbon::now(),
                    'COAID'          => $headcode,
                    'Narration'      => $customerName." Debit Against Stage Booking No. ". $this->model->id . " Ref# ".$request->custom_stage_number,
                    'Debit'          => $request->net_total,
                    'Credit'         => 0,
                    'IsPosted'       => 1,
                    'is_opening'     => 1,
                    'created_by'       => auth()->user()->id,
                    'IsAppove'       => 1,
                    'stage_id' => $this->model->id,
                    'location_id' => $this->location,
                ]);

                if($request->has('total_paid_amount') && $request->get('total_paid_amount') > 0 ){
                    //Customer Credit Against Paid Amount
                    $transaction = $this->transaction->create([
                        'VNo'            => $voucherNumber,
                        'Vtype'          => 'CR-S',
                        'VDate'          => Carbon::now(),
                        'COAID'          => $headcode,
                        'Narration'      => $customerName." Credit Against Stage Booking No. ". $this->model->id . " Ref# ".$request->custom_stage_number,
                        'Debit'          => 0,
                        'Credit'         => $request->total_paid_amount,
                        'IsPosted'       => 1,
                        'is_opening'     => 1,
                        'created_by'       => auth()->user()->id,
                        'IsAppove'       => 1,
                        'stage_id' => $this->model->id,
                        'location_id' => $this->location,
                    ]);

                    //cash in hand Debit Against Paid Amount
                    $this->transaction->create([
                        'VNo'            => $voucherNumber, /*\AccountHelper::generator(5),*/
                        'Vtype'          => 'CR-S',
                        'VDate'          => Carbon::now(),
                        'COAID'          => '1020101',
                        'Narration'      => 'Cash in Hand For Debited For '.$customerName. " Against Stage Booking No. ".$this->model->id . " Ref# ".$request->custom_stage_number,
                        'Debit'          => $request->total_paid_amount,
                        'Credit'         => 0,
                        'IsPosted'       => 1,
                        'is_opening'     => 1,
                        'created_by'       => auth()->user()->id,
                        'IsAppove'       => 1,
                        'stage_id' => $this->model->id,
                        'location_id' => $this->location,
                    ]);
                }
                Prefixes::updateNumber('CR-S');
            }
        }

        if ($request->doPrint == 1) {
            return redirect()->route('stage.invoice',$this->model->id)->with('page_title', 'Stage Booking Invoice');
        } else {
            return redirect()->route('dashboard.marquee.stage.booking.index')->with('success', 'Stage Booking Updated Successfully');
        }

    }

    public function destroy($id)
    {
        $this->model = $this->model->where('location_id', $this->location)->findorFail($id);
        if ($this->model) {
            DB::table('booking_stage_decorations')->where('stage_id', $this->model)->delete();
            $this->model->delete();
        }
        return redirect()->route('dashboard.marquee.stage.booking.index')->with('success', 'Stage Booking Removed Successfully');
    }

    public function stageBookingInvoice($id)
    {
        $page_title = "Stage Invoice";
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Stage & Decor Bookings' => route('dashboard.marquee.stage.booking.index'),
            'Stage & Decor Invoice' => ''
        ]);

        $model = $this->model->where('location_id', $this->location)->with('stageDecorations', 'processingBY')->findorFail($id);
        $customer = $this->customer->where('location_id', $this->location)->get()->sortBy('name_cnic')->pluck('name_cnic','id');
        if ($model->booking_id >0) {
            $booking = Booking::where('location_id', $this->location)->findorFail($model->booking_id);
        } else {
            $booking = null;
        }
        $terms = TermsConditions::where('location_id', $this->location)->first();
        return view('dashboard.marquee.stage-bookings.invoice',compact('model', 'terms', 'breadcrumbs', 'page_title','customer','booking'));
    }

    public function stageBookingWob($id)
    {
        $page_title = "Edit Stage Booking";
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Stage & Decor Bookings' => route('dashboard.marquee.stage.booking.index'),
            'Edit Stage & Decor Booking' => ''
        ]);

        $customer = $this->customer->where('location_id', $this->location)->get()->sortBy('name_cnic')->pluck('name_cnic','id');
        $model = $this->model->where('location_id', $this->location)->with('stageDecorations','customer')->findorFail($id);

        return view('dashboard.marquee.stage-bookings.edit_without_booking',compact('model', 'breadcrumbs', 'page_title','customer'));
    }

    public function stagereport(Request $request)
    {
        $page_title = "Stages Reports";
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Stage & Decor Bookings' => route('dashboard.marquee.stage.booking.index'),
            'Stage & Decor Report' => ''
        ]);

        $data = $this->model->where('location_id', $this->location)->with('customer');

        if ($request->has('customer_id') &&  $request->get('customer_id') != '') {
            $data = $data->where('customer_id',$request->customer_id);
        }

        if ($request->has('event_date') &&  $request->get('event_date') != '') {
            $data = $data->where('event_date', Carbon::parse($request->event_date)->format('Y-m-d'));
        }

        $data = $data->get();

        $model = $this->model->where('location_id', $this->location)->with('customer')->get();

        $customer = array();
        $cnic = array();
        $mobile = array();
        foreach ($model as $key => $value) {
            $customer[$value->customer->id]= $value->customer->customer_name;
            $cnic[$value->customer->id]= $value->customer->cnic;
            $mobile[$value->customer->id]= $value->customer->customer_mobile;
        }

        return view('dashboard.marquee.stage-bookings.stage-report', compact('page_title', 'breadcrumbs', 'data','customer','cnic','mobile'));
    }

}
