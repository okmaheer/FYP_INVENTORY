<?php

namespace App\Http\Controllers\Marquee;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\AccountHead;
use App\Models\Customer;
use App\Models\Marquee\Booking;
use App\Models\Marquee\BookingQuotation;
use App\Models\Marquee\EventArea;
use App\Models\Marquee\Menu;
use App\Models\Marquee\TentativeBooking;
use App\Models\Marquee\TermsConditions;
use App\Models\Tax;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Models\Prefixes;

class BookingController extends Controller
{

    protected $model = null;
    protected $customer;
    protected $transaction;
    public $accountHead;
    public $eventArea;
    private $location;

    public function __construct(Booking $model, Customer $customer, Transaction $transaction, AccountHead $accountHead, EventArea $area)
    {
        $this->middleware('auth');
        $this->model = $model;
        $this->customer = $customer;
        $this->transaction = $transaction;
        $this->accountHead = $accountHead;
        $this->eventArea = $area;
        $this->middleware(function ($request, $next) {
            $this->location = session(SessionEnum::SESSION_LOCATION_ID);
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Event Bookings' => '',
        ]);

        $page_title = "List of all Bookings";
        $data = $this->model->where('location_id', $this->location)->where('is_child', "0")->with('addonBooking', 'foodItems');

        if (!$request->has('show_cancelled')) {
            $data = $data->where('status', '!=', 3);
        }

        if ($request->has('customer_name') &&  is_numeric($request->get('customer_name'))) {
            $data = $data->where('customer_option', $request->customer_name);
        }

        if ($request->has('customer_cnic') &&  is_numeric($request->get('customer_cnic'))) {
            $data = $data->where('customer_option', $request->customer_cnic);
        }

        if ($request->has('customer_no') &&  is_numeric($request->get('customer_no'))) {
            $data = $data->where('customer_option', $request->customer_no);
        }

        if ($request->has('booking_date') &&  $request->get('booking_date') != '') {
            $data = $data->whereDate('created_at',  Carbon::parse($request->booking_date)->format('Y-m-d'));
        }

        if ($request->has('event_area') &&  is_numeric($request->get('event_area'))) {
            $data = $data->where('event_area',  $request->event_area);
        }

        if ($request->has('stage_booking') &&  is_numeric($request->get('stage_booking'))) {
            if ($request->get('stage_booking') == 1) {
                $data = $data->has('stages');
            } else {
                $data = $data->doesnthave('stages');
            }
        }

        $data = \QueryHelper::filterByDate($request, $data, 'booking', 'bookings');

        $data = $data->get();

        $model = $this->model->where('location_id', $this->location)->with('customer')->where('is_child', "0")->get();
        $customer = array();
        $cnic = array();
        $mobile = array();
        foreach ($model as $key => $value) {
            $customer[$value->customer->id] = $value->customer->customer_name;
            $cnic[$value->customer->id] = $value->customer->cnic;
            $mobile[$value->customer->id] = $value->customer->customer_mobile;
        }

        return view('dashboard.marquee.bookings.index', compact('breadcrumbs', 'page_title', 'data', 'customer', 'cnic', 'mobile'));
    }

    public function create()
    {
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Event Bookings' => route('dashboard.marquee.booking.index'),
            'New Event Booking' => ''
        ]);

        $page_title = "Create New Booking";
        $customer = $this->customer->where('location_id', $this->location)->get()
            ->sortBy('name_cnic')->pluck('name_cnic', 'id');
        $booking_no = str_pad($this->model->maxId(), 5, '0', STR_PAD_LEFT);
        $bookingDate = Carbon::now();
        $event_areas = $this->eventArea->where('location_id', $this->location)
            ->orderBy('name', 'ASC')->pluck('name', 'id');
        $taxes = Tax::whereStatus(1)->where('location_id', $this->location)
            ->orderBy('tax_name', 'ASC')->pluck('tax_name', 'id');

        return view('dashboard.marquee.bookings.create', compact('breadcrumbs', 'page_title', 'customer', 'booking_no', 'bookingDate', 'event_areas', 'taxes'));
    }

    public function store(Request $request)
    {
        if ($request->event_area == 2) { //outdoor
            $request->validate([
                'delivery_date' => 'required|date|before_or_equal:event_date',
                'delivery_time' => 'required|date_format:H:i',
                'delivery_address' => 'required',
                'delivery_charges' => 'required|min:0'
            ]);
        } else {
            $request->validate([
                'no_person' => 'required|min:1',
                'rate_per_head' => 'required|min:1',
                'venue' => 'required',
            ]);
        }

        $this->model = $this->model->create($request->all());
        if ($this->model) {

            $this->model->processing_by = auth()->user()->id;
            $this->model->processing_at = Carbon::now();
            $this->model->custom_booking_number = \AccountHelper::eventAreaCode($request->event_area) . '-' . str_pad($this->model->id, 5, '0', STR_PAD_LEFT);
            $this->model->location_id = $this->location;
            $this->model->save();

            if ($request->has('quot_number')) {
                $quot_no = $request->input('quot_number');
                BookingQuotation::where('quot_number', $quot_no)->update(['status' => '1']);
            }

            if ($request->has('foodItems')) {
                $foodItems = $request->input('foodItems', array());
                $count = $foodItems['name'];
                if (count($count) > 0) {
                    foreach ($count as $key => $value) {
                        $item_id = $foodItems['id'][$key];
                        if ($item_id != '') {
                            $quantity = $foodItems['quantity'][$key];
                            // $discount = $foodItems['discount'][$key];
                            $price = $foodItems['price'][$key];
                            // $net_total = $foodItems['net_total'][$key];
                            $total = $foodItems['total'][$key];
                            $details = $foodItems['details'][$key];
                            DB::table('booking_food_items')->insert([
                                'quantity' => $quantity,
                                // 'discount' => $discount,
                                'price' => $price,
                                // 'net_total' => $net_total,
                                'total' => $total,
                                'details' => $details,
                                'booking_id' => $this->model->id,
                                'product_id' => $item_id,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now()
                            ]);
                        }
                    }
                }
            }

            if ($request->has('addOnFeatures')) {
                $input = $request->input('addOnFeatures', array());
                $count = $input['name'];
                if (count($count) > 0) {
                    foreach ($count as $key => $value) {
                        $menu_id = $input['id'][$key];
                        if ($menu_id != '') {
                            $quantity = $input['quantity'][$key];
                            $hourly = $input['hourly'][$key];
                            // $discount = $input['discount'][$key];
                            $price = $input['price'][$key];
                            // $net_total = $input['net_total'][$key];
                            $total = $input['total'][$key];
                            $details = $input['details'][$key];
                            DB::table('booking_add_on_features')->insert([
                                'quantity' => $quantity,
                                'hourly'   => $hourly,
                                // 'discount' => $discount,
                                'price' => $price,
                                // 'net_total' => $net_total,
                                'total' => $total,
                                'details' => $details,
                                'booking_id' => $this->model->id,
                                'add_on_feature_id' => $menu_id,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now()
                            ]);
                        }
                    }
                }
            }
            if ($request->has('extraFoodItems')) {
                $input = $request->input('extraFoodItems', array());
                $count = $input['name'];
                if (count($count) > 0) {
                    foreach ($count as $key => $value) {
                        $item_id = $input['id'][$key];
                        if ($item_id != '') {
                            $quantity = $input['quantity'][$key];
                            $price = $input['price'][$key];
                            $total = $input['total'][$key];
                            $details = $input['details'][$key];
                            DB::table('booking_extra_food_items')->insert([
                                'price' => $price,
                                'quantity' => $quantity,
                                'total' => $total,
                                'details' => $details,
                                'booking_id' => $this->model->id,
                                'extra_food_item_id' => $item_id,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now()
                            ]);
                        }
                    }
                }
            }

            if ($request->has('seatPlannings')) {
                $input = $request->input('seatPlannings', array());
                $count = $input['name'];
                if (count($count) > 0) {
                    foreach ($count as $key => $value) {
                        $seat_planning_id = $input['id'][$key];
                        if ($seat_planning_id != '') {
                            $quantity = $input['quantity'][$key];
                            // $discount = $input['discount'][$key];
                            // $price = $input['price'][$key];
                            // $net_total = $input['net_total'][$key];
                            // $total = $input['total'][$key];
                            $details = $input['details'][$key];
                            DB::table('booking_seat_plannings')->insert([
                                'quantity' => $quantity,
                                // 'discount' => $discount,
                                // 'price' => $price,
                                // 'net_total' => $net_total,
                                // 'total' => $total,
                                'details' => $details,
                                'booking_id' => $this->model->id,
                                'seat_planning_id' => $seat_planning_id,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now()
                            ]);
                        }
                    }
                }
            }

            $headcode   = $this->accountHead->where('customer_id', $request->customer_option)->value('HeadCode');
            $customerName = $this->customer->getCustomerName($request->customer_option);

            $voucherNumber = Prefixes::generateNumber('CR-B');

            //Customer Debit against Net Amount
            $transaction = $this->transaction->create([
                'VNo'            => $voucherNumber,
                'Vtype'          => 'CR-B',
                'VDate'          => $this->model->processing_at,
                'COAID'          => $headcode,
                'Narration'      => $customerName . " Debit Against Booking No. " . $this->model->id . " Ref# " . $this->model->custom_booking_number,
                'Debit'          => $request->net_total,
                'Credit'         => 0,
                'IsPosted'       => 1,
                'is_opening'     => 1,
                'created_by'     => auth()->user()->id,
                'IsAppove'       => 1,
                'booking_id' => $this->model->id,
                'location_id' => $this->location,
            ]);

            if ($request->has('total_paid_amount') && $request->get('total_paid_amount') > 0) {
                //Customer Paid Amount Credit
                $transaction = $this->transaction->create([
                    'VNo'            => $voucherNumber,
                    'Vtype'          => 'CR-B',
                    'VDate'          => $this->model->processing_at,
                    'COAID'          => $headcode,
                    'Narration'      => $customerName . " Credit Against Booking No. " . $this->model->id . " Ref# " . $this->model->custom_booking_number,
                    'Debit'          => 0,
                    'Credit'         => $request->total_paid_amount,
                    'IsPosted'       => 1,
                    'is_opening'     => 1,
                    'created_by'     => auth()->user()->id,
                    'IsAppove'       => 1,
                    'booking_id' => $this->model->id,
                    'location_id' => $this->location,
                ]);

                //cash in hand Paid Amount Debit
                $this->transaction->create([
                    'VNo'            => $voucherNumber,
                    'Vtype'          => 'CR-B',
                    'VDate'          => $this->model->processing_at,
                    'COAID'          => '1020101',
                    'Narration'      => 'Cash in Hand For Debited For ' . $customerName . " Against Booking No. " . $this->model->id . " Ref# " . $this->model->custom_booking_number,
                    'Debit'          => $request->total_paid_amount,
                    'Credit'         => 0,
                    'IsPosted'       => 1,
                    'is_opening'     => 1,
                    'created_by'     => auth()->user()->id,
                    'IsAppove'       => 1,
                    'booking_id' => $this->model->id,
                    'location_id' => $this->location,
                ]);
            }
            Prefixes::updateNumber('CR-B');
        }

        if ($request->doPrint == 1) {
            return redirect()->route('marquee.booking.sheet.function', $this->model->id)->with('page_title', 'Function Sheet');
        } else {
            return redirect()->route('dashboard.marquee.booking.index')->with('success', "Event Booking Created Successfully.");
        }
    }

    public function show(Request $request, $id)
    {
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Event Bookings' => route('dashboard.marquee.booking.index'),
            \AccountHelper::eventArea($id) . ' Bookings' => ''
        ]);
        $page_title = "List of all Bookings";
        $data = $this->model->where('location_id', $this->location)->where('is_child', "0")->where('event_area', $id);

        if ($request->has('customer_id') &&  $request->get('customer_id') != '') {
            $data = $data->where('customer_option', $request->customer_id);
        }
        if ($request->has('event_date') &&  $request->get('event_date') != '') {
            $data = $data->where('event_date', $request->event_date);
        }

        $data = $data->paginate(20);

        $model = $this->model->where('location_id', $this->location)->with('customer')->get();
        $customer = array();
        $cnic = array();
        $mobile = array();
        foreach ($model as $key => $value) {
            $customer[$value->customer->id] = $value->customer->customer_name;
            $cnic[$value->customer->id] = $value->customer->cnic;
            $mobile[$value->customer->id] = $value->customer->customer_mobile;
        }

        /* $page_title = "List of all Bookings";
        $data = Booking::where('is_child',"0")->where('event_area',$id)->paginate(20);
        $customer = $this->customer->pluck('cnic', 'id'); */
        return view('dashboard.marquee.bookings.index', compact('breadcrumbs', 'page_title', 'data', 'customer', 'cnic', 'mobile'));
    }

    public function edit($id)
    {
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Event Bookings' => route('dashboard.marquee.booking.index'),
            'Modify Event Booking' => ''
        ]);

        $page_title = "Edit Booking";
        $customer = $this->customer->where('location_id', $this->location)->get()
            ->sortBy('name_cnic')->pluck('name_cnic', 'id');
        $model = $this->model->where('location_id', $this->location)
            ->with('foodItems', 'addOnFeatures', 'stageDecorations', 'seatPlannings', 'extraFoodItems')->findorFail($id);
        $booking_no = str_pad($model->id, 5, '0', STR_PAD_LEFT);
        $bookingDate = $model->created_at;
        $event_areas = $this->eventArea->where('location_id', $this->location)
            ->orderBy('name', 'ASC')->pluck('name', 'id');
        $taxes = Tax::whereStatus(1)->where('location_id', $this->location)
            ->orderBy('tax_name', 'ASC')->pluck('tax_name', 'id');

        return view('dashboard.marquee.bookings.edit', compact('breadcrumbs', 'page_title', 'model', 'customer', 'booking_no', 'bookingDate', 'event_areas', 'taxes'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        if ($request->event_area == 2) { //outdoor
            $request->validate([
                'delivery_date' => 'required|date|before_or_equal:event_date',
                'delivery_time' => 'required|date_format:H:i',
                'delivery_address' => 'required',
                'delivery_charges' => 'required|min:0'
            ]);
        } else {
            $request->validate([
                'no_person' => 'required|min:1',
                'rate_per_head' => 'required|min:1',
                'venue' => 'required',
            ]);
        }

        $this->model->where('location_id', $this->location)->findorFail($id)->update($request->all());
        $this->model = $this->model->where('location_id', $this->location)->find($id);

        if ($request->has('status') && $request->get('status') == 2) { //Confirmed
            $this->model->confirmed_by = auth()->user()->id;
            $this->model->confirmed_at = Carbon::now();
            $this->model->status = $request->input('status', null);
            $this->model->save();
        }

        DB::table('booking_food_items')->where('booking_id', $this->model->id)->delete();
        DB::table('booking_add_on_features')->where('booking_id', $this->model->id)->delete();
        DB::table('booking_seat_plannings')->where('booking_id', $this->model->id)->delete();
        DB::table('booking_extra_food_items')->where('booking_id', $this->model->id)->delete();
        DB::table('transactions')->where('booking_id', $this->model->id)->where('Vtype', 'CR-B')->delete();

        if ($request->has('foodItems')) {
            $foodItems = $request->input('foodItems', array());
            $count = $foodItems['name'];
            if (count($count) > 0) {
                foreach ($count as $key => $value) {
                    $item_id = $foodItems['id'][$key];
                    if ($item_id != '') {
                        $quantity = $foodItems['quantity'][$key];
                        // $discount = $foodItems['discount'][$key];
                        $price = $foodItems['price'][$key];
                        // $net_total = $foodItems['net_total'][$key];
                        $total = $foodItems['total'][$key];
                        $details = $foodItems['details'][$key];
                        DB::table('booking_food_items')->insert([
                            'quantity' => $quantity,
                            // 'discount' => $discount,
                            'price' => $price,
                            // 'net_total' => $net_total,
                            'total' => $total,
                            'details' => $details,
                            'booking_id' => $this->model->id,
                            'product_id' => $item_id,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ]);
                    }
                }
            }
        }
        if ($request->has('extraFoodItems')) {
            $input = $request->input('extraFoodItems', array());
            $count = $input['name'];
            if (count($count) > 0) {
                foreach ($count as $key => $value) {
                    $item_id = $input['id'][$key];
                    if ($item_id != '') {
                        $quantity = $input['quantity'][$key];
                        $price = $input['price'][$key];
                        $total = $input['total'][$key];
                        $details = $input['details'][$key];
                        DB::table('booking_extra_food_items')->insert([
                            'quantity' => $quantity,
                            'price' => $price,
                            'total' => $total,
                            'details' => $details,
                            'booking_id' => $this->model->id,
                            'extra_food_item_id' => $item_id,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ]);
                    }
                }
            }
        }
        if ($request->has('addOnFeatures')) {
            $input = $request->input('addOnFeatures', array());
            $count = $input['name'];
            if (count($count) > 0) {
                foreach ($count as $key => $value) {
                    $menu_id = $input['id'][$key];
                    if ($menu_id != '') {
                        $quantity = $input['quantity'][$key];
                        // $discount = $input['discount'][$key];
                        $price = $input['price'][$key];
                        // $net_total = $input['net_total'][$key];
                        $total = $input['total'][$key];
                        $hourly = $input['hourly'][$key];
                        $details = $input['details'][$key];
                        DB::table('booking_add_on_features')->insert([
                            'quantity' => $quantity,
                            'hourly' => $hourly,
                            // 'discount' => $discount,
                            'price' => $price,
                            // 'net_total' => $net_total,
                            'total' => $total,
                            'details' => $details,
                            'booking_id' => $this->model->id,
                            'add_on_feature_id' => $menu_id,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ]);
                    }
                }
            }
        }

        if ($request->has('seatPlannings')) {
            $input = $request->input('seatPlannings', array());
            $count = $input['name'];
            if (count($count) > 0) {
                foreach ($count as $key => $value) {
                    $seat_planning_id = $input['id'][$key];
                    if ($seat_planning_id != '') {
                        $quantity = $input['quantity'][$key];
                        // $discount = $input['discount'][$key];
                        // $price = $input['price'][$key];
                        // $net_total = $input['net_total'][$key];
                        // $total = $input['total'][$key];
                        $details = $input['details'][$key];
                        DB::table('booking_seat_plannings')->insert([
                            'quantity' => $quantity,
                            // 'discount' => $discount,
                            // 'price' => $price,
                            // 'net_total' => $net_total,
                            // 'total' => $total,
                            'details' => $details,
                            'booking_id' => $this->model->id,
                            'seat_planning_id' => $seat_planning_id,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ]);
                    }
                }
            }
        }

        $headcode   = $this->accountHead->where('customer_id', $request->customer_option)->value('HeadCode');
        $customerName = $this->customer->getCustomerName($request->customer_option);

        $voucherNumber = Prefixes::generateNumber('CR-B');

        //Customer Debit against Net Amount
        $transaction = $this->transaction->create([
            'VNo'            => $voucherNumber,
            'Vtype'          => 'CR-B',
            'VDate'          => $this->model->processing_at,
            'COAID'          => $headcode,
            'Narration'      => $customerName . " Debit Against Booking No. " . $this->model->id . " Ref# " . $this->model->custom_booking_number,
            'Debit'          => $request->net_total,
            'Credit'         => 0,
            'IsPosted'       => 1,
            'is_opening'     => 1,
            'created_by'     => auth()->user()->id,
            'IsAppove'       => 1,
            'booking_id' => $this->model->id,
            'location_id' => $this->location,
        ]);

        if ($request->has('total_paid_amount') && $request->get('total_paid_amount') > 0) {
            //Customer Paid Amount Credit
            $transaction = $this->transaction->create([
                'VNo'            => $voucherNumber,
                'Vtype'          => 'CR-B',
                'VDate'          => $this->model->processing_at,
                'COAID'          => $headcode,
                'Narration'      => $customerName . " Credit Against Booking No. " . $this->model->id . " Ref# " . $this->model->custom_booking_number,
                'Debit'          => 0,
                'Credit'         => $request->total_paid_amount,
                'IsPosted'       => 1,
                'is_opening'     => 1,
                'created_by'     => auth()->user()->id,
                'IsAppove'       => 1,
                'booking_id' => $this->model->id,
                'location_id' => $this->location,
            ]);
            //cash in hand Paid Amount Debit
            $this->transaction->create([
                'VNo'            => $voucherNumber,
                'Vtype'          => 'CR-B',
                'VDate'          => $this->model->processing_at,
                'COAID'          => '1020101',
                'Narration'      => 'Cash in Hand For Debited For ' . $customerName . " Against Booking No. " . $this->model->id . " Ref# " . $this->model->custom_booking_number,
                'Debit'          => $request->total_paid_amount,
                'Credit'         => 0,
                'IsPosted'       => 1,
                'is_opening'     => 1,
                'created_by'     => auth()->user()->id,
                'IsAppove'       => 1,
                'booking_id' => $this->model->id,
                'location_id' => $this->location,
            ]);
        }
        Prefixes::updateNumber('CR-B');

        $this->UpdateAddonInvoiceTax($this->model->id);

        if ($request->doPrint == 1) {
            return redirect()->route('marquee.booking.sheet.function', $this->model->id)->with('page_title', 'Function Sheet');
        } else {
            return redirect()->route('dashboard.marquee.booking.index')->with('success', 'Event Booking Updated Successfully');
        }
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->model->where('location_id', $this->location)->findorFail($id);
        if ($this->model) {
            DB::table('booking_food_items')->where('booking_id', $this->model->id)->delete();
            DB::table('booking_add_on_features')->where('booking_id', $this->model->id)->delete();
            DB::table('booking_seat_plannings')->where('booking_id', $this->model->id)->delete();
            DB::table('booking_extra_food_items')->where('booking_id', $this->model->id)->delete();
            DB::table('transactions')->where('booking_id', $this->model->id)->where('Vtype', 'CR-B')->delete();
            $this->model->delete();
        }
        return redirect()->route('dashboard.marquee.booking.index')->with('success', 'Event Booking Removed Successfully');
    }

    public function addToBooking($quotId)
    {
        $page_title = "Create New Booking";
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Event Bookings' => route('dashboard.marquee.booking.index'),
            'New Event Booking' => ''
        ]);

        $find_Booking = $this->model->where('location_id', $this->location)->where('quot_id', $quotId)->first();
        if ($find_Booking) {
            return redirect()->route('dashboard.marquee.quotation.booking.index')->with('error', 'A booking against this quotation is already made. <a href="' . route('invoice.id.search', $find_Booking->id) . '" class="btn btn-info btn-xs" target="_blank">View Booking</a>');
        } else {

            $customer = $this->customer->where('location_id', $this->location)->get()
                ->sortBy('name_cnic')->pluck('name_cnic', 'id');
            $booking_no = str_pad($this->model->maxId(), 5, '0', STR_PAD_LEFT);
            $bookingDate = Carbon::now();
            $model = BookingQuotation::with('foodItems', 'addOnFeatures', 'seatPlannings')
                ->where('location_id', $this->location)->findorFail($quotId);
            $event_areas = $this->eventArea->where('location_id', $this->location)
                ->orderBy('name', 'ASC')->pluck('name', 'id');
            $taxes = Tax::whereStatus(1)->where('location_id', $this->location)
                ->orderBy('tax_name', 'ASC')->pluck('tax_name', 'id');
            return view('dashboard.marquee.bookings.clone-booking', compact('breadcrumbs', 'page_title', 'model', 'customer', 'booking_no', 'bookingDate', 'event_areas', 'taxes'));
        }
    }

    public function bookingreport(Request $request)
    {

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Event Bookings' =>  route('dashboard.marquee.booking.index'),
            'Event Booking Details' => ''
        ]);

        $page_title = "Booking Details";
        $data = $this->model->where('location_id', $this->location)->where('is_child', "0")->where('status', '!=', 3);
        if ($request->has('customer_id') &&  $request->get('customer_id') != '') {
            $data = $data->where('customer_option', $request->customer_id);
        }
        if ($request->has('event_date') &&  $request->get('event_date') != '') {
            $data = $data->where('event_date', Carbon::parse($request->event_date)->format('Y-m-d'));
        }
        $data = $data->orderBy('event_date', 'ASC')->get();

        $model = $this->model->where('location_id', $this->location)->with('customer')->get();

        $customer = array();
        $cnic = array();
        $mobile = array();
        foreach ($model as $key => $value) {
            $customer[$value->customer->id] = $value->customer->customer_name;
            $cnic[$value->customer->id] = $value->customer->cnic;
            $mobile[$value->customer->id] = $value->customer->customer_mobile;
        }


        return view('dashboard.marquee.bookings.reports.booking-report', compact('breadcrumbs', 'page_title', 'data', 'customer', 'mobile', 'cnic'));
    }

    public function BookedReport()
    {

        $page_title = "All Booked Events Report";

        $report = $this->model->where('location_id', $this->location)->where('is_child', 0);
        return view('dashboard.marquee.bookings.reports.booked-report', compact('page_title'));
    }

    public function ViewKitchenSheet($bookingID)
    {
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Event Bookings' => route('dashboard.marquee.booking.index'),
            'Kitchen Sheet' => ''
        ]);


        $model = $this->model->where('location_id', $this->location)
            ->with('foodItems', 'addOnFeatures', 'stageDecorations', 'seatPlannings', 'processingBY', 'confirmedBY')
            ->findorFail($bookingID);
        $terms = TermsConditions::where('location_id', $this->location)->first();

        $page_title = "Kitchen Sheet - " . $model->customer->customer_name . '_' . $model->custom_booking_number;

        return view('dashboard.marquee.bookings.sheet-kitchen', compact('page_title', 'breadcrumbs', 'terms', 'model'));
    }

    public function ViewFunctionSheet($bookingID)
    {
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Event Bookings' => route('dashboard.marquee.booking.index'),
            'Function Sheet' => ''
        ]);

        $model = $this->model->where('location_id', $this->location)
            ->with('foodItems', 'addOnFeatures', 'stageDecorations', 'seatPlannings', 'processingBY', 'confirmedBY', 'extraFoodItems')
            ->findorFail($bookingID);
        $terms = TermsConditions::where('location_id', $this->location)->first();

        $addonModel = $this->model->where('location_id', $this->location)
            ->with('foodItems', 'addOnFeatures', 'stageDecorations', 'seatPlannings', 'processingBY', 'confirmedBY')
            ->where('parent_booking_id', $bookingID)->first();

        $page_title = "Function Sheet - " . $model->customer->customer_name . '_' . $model->custom_booking_number;

        return view('dashboard.marquee.bookings.sheet-function', compact('page_title', 'breadcrumbs', 'terms', 'model', 'addonModel'));
    }

    public function ViewCustomerSheet($bookingID)
    {
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Event Bookings' => route('dashboard.marquee.booking.index'),
            'Customer Sheet' => ''
        ]);

        $model = $this->model->where('location_id', $this->location)
            ->with('foodItems', 'addOnFeatures', 'stageDecorations', 'seatPlannings', 'processingBY', 'confirmedBY')
            ->findorFail($bookingID);
        $terms = TermsConditions::where('location_id', $this->location)->first();

        $addonModel = $this->model->where('location_id', $this->location)
            ->with('foodItems', 'addOnFeatures', 'stageDecorations', 'seatPlannings', 'processingBY', 'confirmedBY')
            ->where('parent_booking_id', $bookingID)->first();

        $page_title = "Customer Sheet - " . $model->customer->customer_name . '_' . $model->custom_booking_number;

        return view('dashboard.marquee.bookings.sheet-customer', compact('page_title', 'breadcrumbs', 'terms', 'model', 'addonModel'));
    }

    public function ViewFinalInvoice($bookingID)
    {
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Event Bookings' => route('dashboard.marquee.booking.index'),
            'Event Booking Invoice' => ''
        ]);
        $page_title = "Event Booking Invoice";

        $model = $this->model->where('location_id', $this->location)
            ->with('stages')->findorFail($bookingID);

        return view('dashboard.marquee.bookings.invoice', compact('breadcrumbs', 'page_title', 'model'));
    }

    public function ViewCalendar(Request $request)
    {
        if ($request->ajax()) {
            $bookings = $this->model->where('location_id', $this->location)
                ->where('event_date', '>=', Carbon::now()->toDateString())
                ->where('is_child', '0')
                ->where('status', '!=', 3)
                ->get();

            $tentativeBookings = TentativeBooking::where('location_id', $this->location)
                ->whereDate('created_at', '>=', Carbon::today()->subDays(2)->toDateString())
                ->whereDate('created_at', '<=', Carbon::today()->toDateString())
                ->get();

            return view('dashboard.marquee.bookings.calendar', compact('bookings', 'tentativeBookings'));
        }
    }

    public function CancelEvent(Request $request)
    {
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Event Bookings' => route('dashboard.marquee.booking.index'),
            'Cancel Event Booking' => ''
        ]);

        $page_title = "Cancel Event Booking";

        if ($request->has('bookingID')) {
            $bookingID = $request->bookingID;
            $booking = $this->model->where('location_id', $this->location)->findOrFail($bookingID);

            return view('dashboard.marquee.bookings.cancel_event', compact('page_title', 'breadcrumbs', 'booking'));
        }
    }

    public function CancelEventSave(Request $request)
    {
        if ($request->has('booking_id')) {
            $bookingID = $request->booking_id;
            $this->model->where('location_id', $this->location)->findorFail($bookingID)->update($request->all());
            $this->model = $this->model->where('location_id', $this->location)->find($bookingID);
            if ($this->model) {
                $this->model->canceled_by = auth()->user()->id;
                $this->model->status = 3;
                $this->model->save();

                $headcode = $this->accountHead->where('customer_id', $request->customer_id)->value('HeadCode');
                $customerName = $this->customer->getCustomerName($request->customer_id);

                if ($request->cancel_type == 1) { //Non Refundable
                    //Credit Customer Account with All Remaining Amount
                    $transaction = $this->transaction->create([
                        'VNo' => Prefixes::generateNumber('CR-B'),
                        'Vtype' => 'CR',
                        'VDate' => Carbon::now(),
                        'COAID' => $headcode,
                        'Narration' => $request->canceled_remarks,
                        'Debit' => 0,
                        'Credit' => $request->remaining,
                        'IsPosted' => 1,
                        'is_opening' => 1,
                        'created_by' => auth()->user()->id,
                        'IsAppove' => 1,
                        'booking_id' => $this->model->id,
                        'location_id' => $this->location,
                    ]);
                    Prefixes::updateNumber('CR-B');
                } elseif ($request->cancel_type == 2) { //Refundable
                    $voucherNumber = Prefixes::generateNumber('CR-B');
                    //Credit CIH Account with Refund Amount
                    $debit_amount = $request->refund_amount;
                    $transaction = $this->transaction->create([
                        'VNo' => $voucherNumber,
                        'Vtype' => 'CR',
                        'VDate' => Carbon::now(),
                        'COAID' => '1020101',
                        'Narration' => 'Cash In Hand Credit For ' . $customerName . " Against Event Cancellation. Booking No. " . $this->model->id . " Ref# " . $this->model->custom_booking_number,
                        'Debit' => 0,
                        'Credit' => $request->refund_amount,
                        'IsPosted' => 1,
                        'is_opening' => 1,
                        'created_by' => auth()->user()->id,
                        'IsAppove' => 1,
                        'booking_id' => $this->model->id,
                        'location_id' => $this->location,
                    ]);

                    //Debit Customer Account with Refund Amount
                    $debit_amount = $request->refund_amount;
                    $transaction = $this->transaction->create([
                        'VNo' => $voucherNumber,
                        'Vtype' => 'CR',
                        'VDate' => Carbon::now(),
                        'COAID' => $headcode,
                        'Narration' => $request->canceled_remarks,
                        'Debit' => $request->refund_amount,
                        'Credit' => 0,
                        'IsPosted' => 1,
                        'is_opening' => 1,
                        'created_by' => auth()->user()->id,
                        'IsAppove' => 1,
                        'booking_id' => $this->model->id,
                        'location_id' => $this->location,
                    ]);

                    //Credit Customer Account with Remaining Amount
                    $transaction = $this->transaction->create([
                        'VNo' => $voucherNumber,
                        'Vtype' => 'CR',
                        'VDate' => Carbon::now(),
                        'COAID' => $headcode,
                        'Narration' => $customerName . " Adjustment Against Event Cancellation. Booking No. " . $this->model->id . " Ref# " . $this->model->custom_booking_number,
                        'Debit' => 0,
                        'Credit' => ($request->remaining + $request->refund_amount),
                        'IsPosted' => 1,
                        'is_opening' => 1,
                        'created_by' => auth()->user()->id,
                        'IsAppove' => 1,
                        'booking_id' => $this->model->id,
                        'location_id' => $this->location,
                    ]);
                    Prefixes::updateNumber('CR-B');
                } else {
                    return redirect()->back()->with(['error' => 'Invalid cancel type selected.']);
                }

                if ($request->doPrint == 1) {
                } else {
                    return redirect()->route('dashboard.marquee.booking.index')->with('success', 'Event Booking Canceled Successfully');
                }
            } else {
                return redirect()->back()->with(['error' => 'Unable to cancel selected event']);
            }
        } else {
            return redirect()->back()->with(['error' => 'Unable to cancel selected event.']);
        }
    }

    private function UpdateAddonInvoiceTax($parent_booking_id)
    {
        $main_booking = $this->model->where('location_id', $this->location)->findorFail($parent_booking_id);
        $addon_booking = $this->model->where('location_id', $this->location)->where('parent_booking_id', $parent_booking_id)->first();
        if ($addon_booking) {
            $grand_total = $addon_booking->grand_total;
            $rate_per_person = $addon_booking->rate_per_head;

            if ($main_booking->tax()->exists()) {
                $tax_id = $main_booking->tax_id;
                $tax_type = $main_booking->tax->tax_type;
                $tax_value = $main_booking->tax->tax_value;

                //Add Tax to Addon Invoice
                if ($tax_type == 2) { //percentage
                    $total_tax = (($grand_total * $tax_value) / 100);
                } else {
                    $total_tax = $tax_value;
                }
                $net_total = ($grand_total + $total_tax);
            } else { //tax not applied in main event
                $total_tax = null;
                $tax_id = null;
                $net_total = $grand_total;
            }
            //Minus Discount
            $misc_disc_type = $addon_booking->misc_discount_type;
            if (!empty($misc_disc_type)) {
                $misc_discount_total = $addon_booking->misc_discount_total;

                if ($misc_disc_type === 1) { //Fixed
                    $misc_discount_value = $misc_discount_total;
                } elseif ($misc_disc_type === 2) { //Percentage
                    $misc_discount_value = (($net_total * $misc_discount_total) / 100);
                } elseif ($misc_disc_type === 3) { //No of Person
                    $misc_discount_value = ($misc_discount_total * $rate_per_person);
                }

                $net_total -= $misc_discount_value;
            } else {
                $misc_discount_value = null;
            }

            $addon_booking->tax_id = $tax_id;
            $addon_booking->total_tax = $total_tax;
            $addon_booking->misc_discount_value = $misc_discount_value;
            $addon_booking->net_total = $net_total;
            $addon_booking->total_dues_amount = ($net_total - $addon_booking->total_paid_amount);
            $addon_booking->save();


            $addon_booking = $this->model->where('parent_booking_id', $parent_booking_id)->first();

            //Addon Booking Transactions
            DB::table('transactions')->where('location_id', $this->location)->where('booking_id', $addon_booking->id)->where('Vtype', 'CR-AB')->delete();
            $headcode = $this->accountHead->where('customer_id', $addon_booking->customer_option)->value('HeadCode');
            $customerName = $this->customer->getCustomerName($addon_booking->customer_option);

            $voucherNumber = Prefixes::generateNumber('CR-B');

            //Customer Debit Against Net Amount
            $transaction = $this->transaction->create([
                'VNo'            => $voucherNumber,
                'Vtype'          => 'CR-AB',
                'VDate'          => $addon_booking->created_at,
                'COAID'          => $headcode,
                'Narration'      => $customerName . " Debit Against Addon Booking No. " . $addon_booking->id . " Event Booking Ref# " . $addon_booking->parentBooking->custom_booking_number,
                'Debit'          => $net_total,
                'Credit'         => 0,
                'IsPosted'       => 1,
                'is_opening'     => 1,
                'created_by'     => auth()->user()->id,
                'IsAppove'       => 1,
                'booking_id' => $addon_booking->id,
                'location_id' => $this->location,
            ]);

            if ($addon_booking->total_paid_amount > 0) {
                //Customer Credit Against Paid Amount
                $transaction = $this->transaction->create([
                    'VNo'            => $voucherNumber,
                    'Vtype'          => 'CR-AB',
                    'VDate'          => $addon_booking->created_at,
                    'COAID'          => $headcode,
                    'Narration'      => $customerName . " Credit Against Addon Booking No. " . $addon_booking->id . " Event Booking Ref# " . $addon_booking->parentBooking->custom_booking_number,
                    'Debit'          => 0,
                    'Credit'         => $addon_booking->total_paid_amount,
                    'IsPosted'       => 1,
                    'is_opening'     => 1,
                    'created_by'     => auth()->user()->id,
                    'IsAppove'       => 1,
                    'booking_id' => $addon_booking->id,
                    'location_id' => $this->location,
                ]);
                //cash in hand Debit Against Paid Amount
                $this->transaction->create([
                    'VNo'            => $voucherNumber,
                    'Vtype'          => 'CR-AB',
                    'VDate'          => $addon_booking->created_at,
                    'COAID'          => '1020101',
                    'Narration'      => 'Cash in Hand For Debited For ' . $customerName . " Against Addon Booking No. " . $addon_booking->id . " Event Booking Ref# " . $addon_booking->parentBooking->custom_booking_number,
                    'Debit'          => $addon_booking->total_paid_amount,
                    'Credit'         => 0,
                    'IsPosted'       => 1,
                    'is_opening'     => 1,
                    'created_by'     => auth()->user()->id,
                    'IsAppove'       => 1,
                    'booking_id' => $addon_booking->id,
                    'location_id' => $this->location,
                ]);
            }

            Prefixes::updateNumber('CR-B');
        }
    }
}
