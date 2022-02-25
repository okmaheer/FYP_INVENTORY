<?php

namespace App\Http\Controllers\Marquee;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\Marquee\BookingQuotation;
use App\Models\Marquee\Booking;
use App\Models\Marquee\EventArea;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Prefixes;

class BookingQuotationController extends Controller
{
    protected $model = null;
    protected $bookings;
    protected $eventArea;
    private $location;

    public function __construct(BookingQuotation $model, Booking $bookings, EventArea $area)
    {
        $this->middleware('auth');
        $this->model = $model;
        $this->bookings = $bookings;
        $this->eventArea = $area;
        $this->middleware(function ($request, $next){
            $this->location = session(SessionEnum::SESSION_LOCATION_ID);
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $page_title = "List of Booking Quotations";
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Booking Quotations' => '',
        ]);

        $data = $this->model::with('seatPlannings')->where('location_id', $this->location);

        if ($request->has('customer_id') &&  $request->get('customer_id') != '') {
            $data = $data->where('id', $request->customer_id);
        }
        if ($request->has('q_id') &&  $request->get('q_id') != '') {
            $data = $data->where('id', $request->q_id);
        }

         $data = $data->get();

        $customer = $this->model->pluck('customer_name','id');
        $mobile = $this->model->pluck('phone_number','id');

        return view('dashboard.marquee.quotations.bookings.index', compact('page_title', 'breadcrumbs', 'data','customer','mobile'));
    }

    public function create()
    {
        $page_title = "New Booking Quotation";
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Booking Quotations' => route('dashboard.marquee.quotation.booking.index'),
            'New Booking Quotation' => ''
        ]);

        $quot_no = Prefixes::generateNumber('QB'); /* 'QB-'.str_pad($this->model->maxId(),5,'0',STR_PAD_LEFT);; */
        $event_areas = $this->eventArea->where('location_id', $this->location)->orderBy('name', 'ASC')->pluck('name', 'id');
        return view('dashboard.marquee.quotations.bookings.create', compact('page_title','breadcrumbs', 'quot_no', 'event_areas'));
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
                //'venue' => 'required',
            ]);
        }
        $this->model = $this->model->create($request->all());
        if ($this->model) {
            Prefixes::updateNumber('QB');

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
                            DB::table('quotation_booking_food_items')->insert([
                                'quantity' => $quantity,
                                // 'discount' => $discount,
                                 'price' => $price,
                                // 'net_total' => $net_total,
                                 'total' => $total,
                                'details' => $details,
                                'booking_quotation_id' => $this->model->id,
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
                            DB::table('quotation_booking_add_on_features')->insert([
                                'quantity' => $quantity,
                                 'hourly'   => $hourly,
                                // 'discount' => $discount,
                                 'price' => $price,
                                // 'net_total' => $net_total,
                                 'total' => $total,
                                'details' => $details,
                                'booking_quotation_id' => $this->model->id,
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
//                dd($count);
                if (count($count) > 0) {
                    foreach ($count as $key => $value) {
                        $item_id = $input['id'][$key];
                        if ($item_id != '') {
                            $quantity = $input['quantity'][$key];
                             $price = $input['price'][$key];
                             $total = $input['total'][$key];
                            $details = $input['details'][$key];
                            DB::table('quotation_booking_extra_food_items')->insert([
                                'quantity' => $quantity,
                                 'price' => $price,
                                 'total' => $total,
                                'details' => $details,
                                'booking_quotation_id' => $this->model->id,
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
                            DB::table('quotation_booking_seat_plannings')->insert([
                                'quantity' => $quantity,
                                // 'discount' => $discount,
                                // 'price' => $price,
                                // 'net_total' => $net_total,
                                // 'total' => $total,
                                'details' => $details,
                                'booking_quotation_id' => $this->model->id,
                                'seat_planning_id' => $seat_planning_id,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now()
                            ]);
                        }
                    }
                }
            }

        }
        if ($request->doPrint == 1) {
            return redirect()->route('view.quotation.booking',$this->model->id);
        } else {
            return redirect()->route('dashboard.marquee.quotation.booking.index')->with('success', 'Event Quotation Created Successfully');;
        }
    }

    public function show(Request $request, $id)
    {
        $page_title = "List of Booking Quotations";

        $data = $this->model->where('location_id', $this->location)->with('seatPlannings')->where('event_area',$id)->paginate(20);

        $customer = $this->model->where('location_id', $this->location)->pluck('customer_name','id');
        $mobile = $this->model->where('location_id', $this->location)->pluck('phone_number','id');

        return view('dashboard.marquee.quotations.bookings.index', compact('page_title', 'data','customer','mobile'));
    }

    public function edit($id)
    {
        $page_title = "Edit Booking Quotation";
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Booking Quotations' => route('dashboard.marquee.quotation.booking.index'),
            'Edit Booking Quotation' => ''
        ]);

        $model = $this->model->with('foodItems', 'addOnFeatures', 'seatPlannings' ,'extraFoodItems')
            ->where('location_id', $this->location)->findorFail($id);
        $event_areas = $this->eventArea->where('location_id', $this->location)
            ->orderBy('name', 'ASC')->pluck('name', 'id');
        $quot_no = $model->quot_number;
        return view('dashboard.marquee.quotations.bookings.edit', compact('page_title', 'breadcrumbs', 'model','quot_no', 'event_areas'));
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
                //'venue' => 'required',
            ]);
        }

        $this->model->where('location_id', $this->location)->findorFail($id)->update($request->all());
        $this->model = $this->model->where('location_id', $this->location)->find($id);

        if ($request->has('status') && $request->get('status') == 'confirmed') {
            $this->model->confirmed_by = auth()->user()->id;
            $this->model->confirmed_at = Carbon::now();
            $this->model->status = $request->input('status', null);
            $this->model->save();
        }

        DB::table('quotation_booking_food_items')->where('booking_quotation_id', $this->model->id)->delete();
        DB::table('quotation_booking_add_on_features')->where('booking_quotation_id', $this->model->id)->delete();
        DB::table('quotation_booking_seat_plannings')->where('booking_quotation_id', $this->model->id)->delete();
        DB::table('quotation_booking_extra_food_items')->where('booking_quotation_id', $this->model->id)->delete();

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
                        DB::table('quotation_booking_food_items')->insert([
                            'quantity' => $quantity,
                            // 'discount' => $discount,
                             'price' => $price,
                            // 'net_total' => $net_total,
                             'total' => $total,
                            'details' => $details,
                            'booking_quotation_id' => $this->model->id,
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
                        DB::table('quotation_booking_add_on_features')->insert([
                            'quantity' => $quantity,
                             'hourly' => $hourly,
                            // 'discount' => $discount,
                             'price' => $price,
                            // 'net_total' => $net_total,
                             'total' => $total,
                            'details' => $details,
                            'booking_quotation_id' => $this->model->id,
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
//                dd($count);
            if (count($count) > 0) {
                foreach ($count as $key => $value) {
                    $item_id = $input['id'][$key];
                    if ($item_id != '') {
                        $quantity = $input['quantity'][$key];
                        $price = $input['price'][$key];
                        $total = $input['total'][$key];
                        $details = $input['details'][$key];
                        DB::table('quotation_booking_extra_food_items')->insert([
                            'quantity' => $quantity,
                            'price' => $price,
                            'total' => $total,
                            'details' => $details,
                            'booking_quotation_id' => $this->model->id,
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
                        DB::table('quotation_booking_seat_plannings')->insert([
                            'quantity' => $quantity,
                            // 'discount' => $discount,
                            // 'price' => $price,
                            // 'net_total' => $net_total,
                            // 'total' => $total,
                            'details' => $details,
                            'booking_quotation_id' => $this->model->id,
                            'seat_planning_id' => $seat_planning_id,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ]);
                    }
                }
            }
        }

        if ($request->doPrint == 1) {
            return redirect()->route('view.quotation.booking',$this->model->id);
        } else {
            return redirect()->route('dashboard.marquee.quotation.booking.index')->with('success', 'Event Quotation Updated Successfully');
        }
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->model = $this->model->where('location_id', $this->location)->findorFail($id);
        if ($this->model) {
            DB::table('quotation_booking_food_items')->where('booking_quotation_id', $this->model->id)->delete();
            DB::table('quotation_booking_add_on_features')->where('booking_quotation_id', $this->model->id)->delete();
            DB::table('quotation_booking_seat_plannings')->where('booking_quotation_id', $this->model->id)->delete();
            DB::table('quotation_booking_extra_food_items')->where('booking_quotation_id', $this->model->id)->delete();
            $this->model->delete();
        }
        return redirect()->route('dashboard.marquee.quotation.booking.index')->with('success', 'Event Quotation Removed Successfully');
    }

    public function bookingquotationreport(Request $request){
       $title = "Booking Quotation Report";
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Booking Quotations' => route('dashboard.marquee.quotation.booking.index'),
            'Booking Quotations Report' => ''
        ]);

       $data = $this->model->where('location_id', $this->location)->with('seatPlannings')->paginate(20);


       if ($request->has('customer_id') &&  $request->get('customer_id') != '') {

           $data = $data->where('id', $request->customer_id);

       }
       if ($request->has('q_id') &&  $request->get('q_id') != '') {

           $data = $data->where('id', $request->q_id);

       }



       $customer = $this->model->where('location_id', $this->location)->pluck('customer_name','id');
       $mobile = $this->model->where('location_id', $this->location)->pluck('phone_number','id');

        return view('dashboard.marquee.quotations.bookings.report',compact('title', 'breadcrumbs', 'customer','mobile','data'));
    }
}
