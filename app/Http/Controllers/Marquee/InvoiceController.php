<?php

namespace App\Http\Controllers\Marquee;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Marquee\Booking;
use App\Models\Marquee\BookingQuotation;
use App\Models\Marquee\StageQuotation;
use App\Models\Marquee\Menu;
use App\Models\Marquee\TermsConditions;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{

    protected $model = null;
    protected $customer;

    public function __construct(Booking $model, Customer $customer)
    {
        $this->model = $model;
        $this->customer = $customer;
        $this->middleware('auth');
    }

    public function invoiceId($id)
    {
        $name = DB::table('bookings')->where('id', $id)->pluck('national_id_card');
        $booked_customer = DB::table('bookings')->where('id', $id)->pluck('customer_option');
        $customer = Customer::where('id',$booked_customer)->first();

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Event Bookings' => route('dashboard.marquee.booking.index'),
            'Event Booking Invoice' => ''
        ]);
        $page_title = "Booking Invoice";

        $model = Booking::with('foodItems', 'addOnFeatures', 'stageDecorations', 'seatPlannings','transactions', 'processingBY', 'confirmedBY','extraFoodItems')->whereId($id)->first();
        $terms = TermsConditions::find(1);
        return view('dashboard.marquee.bookings.booking-invoice', compact('page_title', 'breadcrumbs', 'terms', 'model', 'customer','name'));
    }
    public function invoiceCnic(Request $request)
    {
        if($request->has('booking_number') && $request->get('booking_number') != ""){
            $data = Booking::where('custom_booking_number',$request->booking_number)->first();
        }
        if($request->has('cnic') && $request->get('cnic') != ""){
            $data = Customer::with('bookings')->where('customer_name',$request->cnic)->first();
        }

        if(!empty($data)){

            $bookingId = $data->id;
            $booked_customer = DB::table('bookings')->where('id', $bookingId)->pluck('customer_option');
            $customer = Customer::where('id',$booked_customer)->first();
            $page_title = "Edit Booking";

            $model = Booking::with('foodItems', 'addOnFeatures', 'stageDecorations', 'seatPlannings')->whereId($bookingId)->first();

            return view('dashboard.accounts.sale.invoice', compact('page_title', 'model', 'customer'));
        }
        else{
            return redirect()->route('dashboard.marquee.booking.index')->with('error', trans('accounts.marquee.Error'));
        }


    }

    public function QuotationBooking($id) {
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Booking Quotations' => route('dashboard.marquee.quotation.booking.index'),
            'Booking Quotation' => ''
        ]);

        $model = BookingQuotation::with('foodItems', 'addOnFeatures', 'seatPlannings', 'processingBY', 'confirmedBY' ,'extraFoodItems')->findorFail($id);
        $page_title = "Booking Quotation " . $model->customer_name . " (" . $model->quot_number . ")";
        return view('dashboard.marquee.quotations.invoice.booking', compact('page_title', 'breadcrumbs', 'model'));
    }

    public function QuotationStage($id) {
        $page_title = "Stage Booking Quotation";
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Stage Booking Quotations' => route('dashboard.marquee.quotation.stage.index'),
            'Stage Booking Quotation' => ''
        ]);

        $model = StageQuotation::with('stageDecorations', 'processingBY', 'confirmedBY')->whereId($id)->first();
        return view('dashboard.marquee.quotations.invoice.stage', compact('page_title', 'breadcrumbs', 'model'));
    }
}
