<?php

namespace App\Http\Controllers\Marquee;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\AccountHead;
use App\Models\Customer;
use App\Models\Marquee\Booking;
use App\Models\Prefixes;
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

class ChildBookingController extends Controller
{
    protected $model = null;
    protected $customer;
    protected $transaction;
    public $accountHead;
    private $location;

    public function __construct(Booking $model, Customer $customer, Transaction $transaction, AccountHead $accountHead)
    {
        $this->middleware('auth');
        $this->model = $model;
        $this->customer = $customer;
        $this->transaction = $transaction;
        $this->accountHead = $accountHead;
        $this->middleware(function ($request, $next) {
            $this->location = session(SessionEnum::SESSION_LOCATION_ID);
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $page_title = "List of Addon Bookings";
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Addon Bookings' => '',
        ]);

        $data = $this->model->where('location_id', $this->location)->where('is_child', "1");

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
        $data = \QueryHelper::filterByDate($request, $data, 'booking', 'bookings');

        $data = $data->get();

        $model = $this->model->where('location_id', $this->location)->with('customer')->where('is_child', '1')->get();
        $customer = array();
        $cnic = array();
        $mobile = array();
        foreach ($model as $key => $value) {
            $customer[$value->customer->id] = $value->customer->customer_name;
            $cnic[$value->customer->id] = $value->customer->cnic;
            $mobile[$value->customer->id] = $value->customer->customer_mobile;
        }

        return view('dashboard.marquee.child-bookings.index', compact('page_title', 'breadcrumbs', 'data', 'customer', 'cnic', 'mobile'));
    }

    public function create(Request $request)
    {
        if ($request->has('id')) {
            $bookingId = $request->id;
            $parent_booking = $this->model->where('location_id', $this->location)->findorFail($bookingId);
            if (empty($parent_booking->addonBooking)) {

                $breadcrumbs = collect([
                    'Dashboard' => route('dashboard'),
                    'Addon Bookings' => route('dashboard.marquee.add-on-invoice.index'),
                    'New Addon Booking' => ''
                ]);

                $page_title = "Create New Addon Booking";

                $bookingId = $request->id;
                $page_title = "New Addon Booking";
                $customer = $this->customer->where('location_id', $this->location)->get()
                    ->sortBy('name_cnic')->pluck('name_cnic', 'id');

                $taxes = Tax::where('location_id', $this->location)->whereStatus(1)->orderBy('tax_name', 'ASC')->pluck('tax_name', 'id');

                return view('dashboard.marquee.child-bookings.create', compact('page_title', 'breadcrumbs', 'parent_booking', 'customer', 'taxes'));
            } else {
                return redirect()->route('dashboard.marquee.booking.index')->with('error', 'Addon Booking against Event Booking ' . $parent_booking->custom_booking_number . ' already exists.&nbsp;<a href="' . route('dashboard.marquee.add-on-invoice.edit', $parent_booking->addonBooking->id) . '" class="btn btn-info btn-xs">Edit Addon Booking</a>');
            }
        } else {
            return redirect()->route('dashboard.marquee.booking.index')->with('error', 'Invalid request passed.');
        }
    }

    public function store(Request $request): RedirectResponse
    {
        $this->model = $this->model->create($request->all());
        if ($this->model) {

            $this->model->processing_by = auth()->user()->id;
            $this->model->processing_at = Carbon::now();
            $this->model->location_id = $this->location;
            $this->model->save();

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
                                'total' => $total,
                                // 'net_total' => $net_total,
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
            if ($request->has('addOnFeatures')) {
                $input = $request->input('addOnFeatures', array());
                $count = $input['name'];
                if (count($count) > 0) {
                    foreach ($count as $key => $value) {
                        $menu_id = $input['id'][$key];
                        if ($menu_id != '') {
                            $quantity = $input['quantity'][$key];
                            // $discount = $input['discount'][$key];
                            $hourly = $input['hourly'][$key];
                            $price = $input['price'][$key];
                            // $net_total = $input['net_total'][$key];
                            $total = $input['total'][$key];
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
            //Customer Debit Against Net Amount
            $transaction = $this->transaction->create([
                'VNo'            => $voucherNumber,
                'Vtype'          => 'CR-AB',
                'VDate'          => $this->model->processing_at,
                'COAID'          => $headcode,
                'Narration'      => $customerName . " Debit Against Addon Booking No. " . $this->model->id . " Event Booking Ref# " . $this->model->parentBooking->custom_booking_number,
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
                //Customer Credit Against Paid Amount
                $transaction = $this->transaction->create([
                    'VNo'            => $voucherNumber,
                    'Vtype'          => 'CR-AB',
                    'VDate'          => $this->model->processing_at,
                    'COAID'          => $headcode,
                    'Narration'      => $customerName . " Credit Against Addon Booking No. " . $this->model->id . " Event Booking Ref# " . $this->model->parentBooking->custom_booking_number,
                    'Debit'          => 0,
                    'Credit'         => $request->total_paid_amount,
                    'IsPosted'       => 1,
                    'is_opening'     => 1,
                    'created_by'     => auth()->user()->id,
                    'IsAppove'       => 1,
                    'booking_id' => $this->model->id,
                    'location_id' => $this->location,
                ]);
                //cash in hand Debit Against Paid Amount
                $this->transaction->create([
                    'VNo'            => $voucherNumber,
                    'Vtype'          => 'CR-AB',
                    'VDate'          => $this->model->processing_at,
                    'COAID'          => '1020101',
                    'Narration'      => 'Cash in Hand For Debited For ' . $customerName . " Against Addon Booking No. " . $this->model->id . " Event Booking Ref# " . $this->model->parentBooking->custom_booking_number,
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
            return redirect()->route('marquee.booking.sheet.function', $this->model->parentBooking->id);
        } else {
            return redirect()->route('dashboard.marquee.booking.index')->with('success', 'Addon Booking Against Event Booking ' . $this->model->parentBooking->custom_booking_number . ' Created Successfully');
        }
    }

    public function show(Request $request, $id)
    {
        $page_title = "List of all Bookings";
        $data = $this->model->where('location_id', $this->location_id)->where('is_child', "1")->where('event_area', $id);

        if ($request->has('customer_id') &&  $request->get('customer_id') != '') {
            $data = $data->where('customer_option', $request->customer_id);
        }
        if ($request->has('event_date') &&  $request->get('event_date') != '') {
            $data = $data->where('event_date', $request->event_date);
        }

        $data = $data->paginate(20);

        $model = $this->model->where('location_id', $this->location_id)->with('customer')->get();
        $customer = array();
        $cnic = array();
        $mobile = array();
        foreach ($model as $key => $value) {
            $customer[$value->customer->id] = $value->customer->customer_name;
            $cnic[$value->customer->id] = $value->customer->cnic;
            $mobile[$value->customer->id] = $value->customer->customer_mobile;
        }

        return view('dashboard.marquee.child-bookings.index', compact('page_title', 'data', 'customer', 'cnic', 'mobile'));
    }

    public function edit($id)
    {
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Addon Bookings' => route('dashboard.marquee.add-on-invoice.index'),
            'Edit Addon Booking' => ''
        ]);

        $page_title = "Edit Addon Booking";
        $customer = $this->customer->where('location_id', $this->location)->get()
            ->sortBy('name_cnic')->pluck('name_cnic', 'id');
        $model = $this->model->where('location_id', $this->location)->with('foodItems', 'addOnFeatures', 'stageDecorations','extraFoodItems','seatPlannings')->findorFail($id);

        $bookingId = $model->parent_booking_id;
        $taxes = Tax::where('location_id', $this->location)->whereStatus(1)->orderBy('tax_name', 'ASC')->pluck('tax_name', 'id');

        return view('dashboard.marquee.child-bookings.edit', compact('page_title', 'breadcrumbs', 'model', 'customer', 'bookingId', 'taxes'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->model->where('location_id', $this->location)->findorFail($id)->update($request->all());
        $this->model = $this->model->where('location_id', $this->location)->find($id);

        if ($request->has('status') && $request->get('status') == 'confirmed') {
            $this->model->confirmed_by = auth()->user()->id;
            $this->model->confirmed_at = Carbon::now();
            $this->model->status = $request->input('status', null);
            $this->model->save();
        }

        DB::table('booking_food_items')->where('booking_id', $id)->delete();
        DB::table('booking_add_on_features')->where('booking_id', $id)->delete();
        DB::table('booking_seat_plannings')->where('booking_id', $id)->delete();
        DB::table('booking_extra_food_items')->where('booking_id', $id)->delete();
        DB::table('transactions')->where('booking_id', $id)->where('Vtype', 'CR-AB')->delete();

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
                            'total' => $total,
                            // 'net_total' => $net_total,
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
                        $price = $input['price'][$key];
                        $quantity = $input['quantity'][$key];
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

        //Customer Debit Against Net Amount
        $transaction = $this->transaction->create([
            'VNo'            => $voucherNumber,
            'Vtype'          => 'CR-AB',
            'VDate'          => $this->model->processing_at,
            'COAID'          => $headcode,
            'Narration'      => $customerName . " Debit Against Addon Booking No. " . $this->model->id . " Event Booking Ref# " . $this->model->parentBooking->custom_booking_number,
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
            //Customer Credit Against Paid Amount
            $transaction = $this->transaction->create([
                'VNo'            => $voucherNumber,
                'Vtype'          => 'CR-AB',
                'VDate'          => $this->model->processing_at,
                'COAID'          => $headcode,
                'Narration'      => $customerName . " Credit Against Addon Booking No. " . $this->model->id . " Event Booking Ref# " . $this->model->parentBooking->custom_booking_number,
                'Debit'          => 0,
                'Credit'         => $request->total_paid_amount,
                'IsPosted'       => 1,
                'is_opening'     => 1,
                'created_by'     => auth()->user()->id,
                'IsAppove'       => 1,
                'booking_id' => $this->model->id,
                'location_id' => $this->location,
            ]);
            //cash in hand Debit Against Paid Amount
            $this->transaction->create([
                'VNo'            => $voucherNumber,
                'Vtype'          => 'CR-AB',
                'VDate'          => $this->model->processing_at,
                'COAID'          => '1020101',
                'Narration'      => 'Cash in Hand For Debited For ' . $customerName . " Against Addon Booking No. " . $this->model->id . " Event Booking Ref# " . $this->model->parentBooking->custom_booking_number,
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

        if ($request->doPrint == 1) {
            return redirect()->route('marquee.booking.sheet.function', $this->model->parentBooking->id);
        } else {
            return redirect()->route('dashboard.marquee.add-on-invoice.index')->with('success', 'Addon Booking Updated Successfully');
        }
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->model->where('location_id', $this->location)->findorFail($id)->delete();
        return redirect()->route('dashboard.marquee.add-on-invoice.index')->with('success', 'Addon Booking Removed Successfully');
    }

    public function bookingInvoice()
    {
        return view('dashboard.marquee.bookings.invoice');
    }
}
