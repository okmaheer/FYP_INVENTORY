<?php

namespace App\Http\Controllers\Marquee;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\AccountHead;
use App\Models\Customer;
use App\Models\Marquee\Booking;
use App\Models\Marquee\Stage;
use Carbon\Carbon;
use App\Models\Supplier;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Prefixes;

class BookingPaymentController extends Controller
{
    public $supplier;
    public $customer;
    public $accountHead;
    public $transaction;
    public $booking;
    public $stage;
    private $location;

    public function __construct(Supplier $supplier,Customer $customer,AccountHead $accountHead,Transaction $transaction,Booking $booking, Stage $stage){
        $this->middleware('auth');
        $this->supplier = $supplier;
        $this->customer = $customer;
        $this->accountHead = $accountHead;
        $this->transaction = $transaction;
        $this->booking = $booking;
        $this->stage = $stage;
        $this->middleware(function ($request, $next){
            $this->location = session(SessionEnum::SESSION_LOCATION_ID);
            return $next($request);
        });
    }

    public function index()
    {
        //
    }

    public function create(Request $request)
    {
        $booking = null;
        $stage = null;
        $page_title = "Booking Payment Voucher";
        $vocherNo = Prefixes::generateNumber('CR-B');

        if ($request->has('bookingid')) {
            $page_title = "Booking Payment Voucher";
            $breadcrumbs = collect([
                'Dashboard' => route('dashboard'),
                'Event Bookings' => route('dashboard.marquee.booking.index'),
                'Booking Payment Voucher' => ''
            ]);

            $booking = $this->booking->where('location_id', $this->location)->findorFail($request->get('bookingid'));
            $vocherNo = Prefixes::generateNumber('CR-B');
        }
        if ($request->has('stageid')) {
            $page_title = "Stage Payment Voucher";
            $breadcrumbs = collect([
                'Dashboard' => route('dashboard'),
                'Stage & Decor Bookings' => route('dashboard.marquee.stage.booking.index'),
                'Stage Booking Payment Voucher' => ''
            ]);

            $stage = $this->stage->where('location_id', $this->location)->findorFail($request->get('stageid'));
            $vocherNo = Prefixes::generateNumber('CR-S');
        }

        /*$bookings = $this->booking->where('event_date', '>=', Carbon::today()->toDateString())->where('is_child', '0')
                                    ->leftJoin('customers', 'customers.id', 'bookings.customer_option')
                                    ->select(DB::raw("CONCAT(bookings.custom_booking_number,' [',customers.customer_mobile, ']') AS name"),'bookings.id')
                                    ->pluck('name', 'id');

        $stages = $this->stage->where('event_date', '>=', Carbon::today()->toDateString())->where('category', 'WOB')
                                    ->leftJoin('customers', 'customers.id', 'stages.customer_id')
                                    ->select(DB::raw("CONCAT(stages.custom_stage_number,' [',customers.customer_mobile, ']') AS name"),'stages.id')
                                    ->pluck('name', 'id');*/

        return view('dashboard.marquee.payment.create',compact('page_title', 'breadcrumbs', 'vocherNo','booking','stage'));
    }

    public function store(Request $request)
    {
        $headcode   = $this->accountHead->where('customer_id',$request->customer_id)->value('HeadCode');
        $customerName = $this->customer->getCustomerName($request->customer_id);

        if ($request->type == 'booking') {
            $this->booking = $this->booking->where('location_id', $this->location)->findorFail($request->booking_id);

            if (empty($request->remarks)) {
                $remarks = $customerName." Credit Against Booking No. ".$this->booking->id. " Ref# ".$this->booking->custom_booking_number;
            } else {
                $remarks = $request->remarks;
            }
            $voucherNumber = Prefixes::generateNumber('CR-B');
            //Customer Credit Against Paid Amount
            $transaction = $this->transaction->create([
                'VNo'            => $voucherNumber,
                'Vtype'          => 'CR',
                'VDate'          => $request->date,
                'COAID'          => $headcode,
                'Narration'      => $remarks,
                'Debit'          => 0,
                'Credit'         => $request->amount,
                'IsPosted'       => 1,
                'is_opening'     => 1,
                'created_by'     => auth()->user()->id,
                'IsAppove'       => 1,
                'booking_id'     => $request->booking_id,
                'location_id'    => $this->location,
            ]);
//            Prefixes::updateNumber('CR-B');

            //cash in hand Debit Against Paid Amount
            $this->transaction->create([
                'VNo'            => $voucherNumber,
                'Vtype'          => 'CR',
                'VDate'          => $request->date,
                'COAID'          => '1020101',
                'Narration'      => 'Cash in Hand For Debited For '.$customerName. " Against Booking No. " . $this->booking->id . " Ref# ". $this->booking->custom_booking_number ,
                'Debit'          => $request->amount,
                'Credit'         => 0,
                'IsPosted'       => 1,
                'is_opening'     => 1,
                'created_by'     => auth()->user()->id,
                'IsAppove'       => 1,
                'booking_id'     => $request->booking_id,
                'location_id'    => $this->location,
            ]);

            Prefixes::updateNumber('CR-B');

            //Discount
            if ($request->has('discount') && $request->get('discount') > 0 ) {
                $discountVoucher = \AccountHelper::generator(5);
                //Discount to Customer Ledger
                $this->transaction->create([
                    'VNo'            => $discountVoucher,
                    'Vtype'          => 'Discount',
                    'VDate'          => $request->date,
                    'COAID'          => $headcode,
                    'Narration'      => 'Discount For ' . $customerName . " Against Booking No. " . $this->booking->id . " Ref# ". $this->booking->custom_booking_number ,
                    'Debit'          => 0,
                    'Credit'         => $request->discount,
                    'IsPosted'       => 1,
                    'is_opening'     => 1,
                    'created_by'     => auth()->user()->id,
                    'IsAppove'       => 1,
                    'booking_id'     => $request->booking_id,
                    'location_id'    => $this->location,
                ]);

                //Discount to Cash in Hand
                $this->transaction->create([
                    'VNo'            => $discountVoucher,
                    'Vtype'          => 'Discount',
                    'VDate'          => $request->date,
                    'COAID'          => '1020101',
                    'Narration'      => 'Cash in Hand Discount For ' . $customerName. " Against Booking No. " . $this->booking->id . " Ref# " . $this->booking->custom_booking_number ,
                    'Debit'          => 0,
                    'Credit'         => $request->discount,
                    'IsPosted'       => 1,
                    'is_opening'     => 1,
                    'created_by'     => auth()->user()->id,
                    'IsAppove'       => 1,
                    'booking_id'     => $request->booking_id,
                    'location_id'    => $this->location,
                ]);
            }
        }
        if ($request->type == 'stage') {
            $this->stage = $this->stage->where('location_id', $this->location)->findorFail($request->stage_id);
            if (empty($request->remarks)) {
                $remarks = $customerName." Credit Against Stage Booking No. ".$this->stage->id. " Ref# ".$this->stage->custom_stage_number;
            } else {
                $remarks = $request->remarks;
            }

            $voucherNumber = Prefixes::generateNumber('CR-S');
            //Customer Credit Against Paid Amount
            $transaction = $this->transaction->create([
                'VNo'            => $voucherNumber,
                'Vtype'          => 'CR',
                'VDate'          => $request->date,
                'COAID'          => $headcode,
                'Narration'      => $remarks,
                'Debit'          => 0,
                'Credit'         => $request->amount,
                'IsPosted'       => 1,
                'is_opening'     => 1,
                'created_by'     => auth()->user()->id,
                'IsAppove'       => 1,
                'stage_id'       => $request->stage_id,
                'location_id'    => $this->location,
            ]);

            //cash in hand Debit Against Paid Amount
            $this->transaction->create([
                'VNo'            => $voucherNumber,
                'Vtype'          => 'CR',
                'VDate'          => $request->date,
                'COAID'          => '1020101',
                'Narration'      => 'Cash in Hand For Debited For '.$customerName. " Against Stage Booking No. ".$this->stage->id . " Ref# ".$this->stage->custom_stage_number ,
                'Debit'          => $request->amount,
                'Credit'         => 0,
                'IsPosted'       => 1,
                'is_opening'     => 1,
                'created_by'     => auth()->user()->id,
                'IsAppove'       => 1,
                'stage_id'       => $request->stage_id,
                'location_id'    => $this->location,
            ]);
            Prefixes::updateNumber('CR-S');

        }

        if ($request->type == 'booking') {
            if ($request->doPrint == 1) {
                return redirect()->route('common.payment.receipt', ['VNo' => $transaction->VNo, 'type' => 'Booking']);
            } else {
                return redirect()->route('dashboard.marquee.booking.index')->with('success', trans('accounts.marquee.booking'));
            }
        } elseif ($request->type == 'stage') {
            if ($request->doPrint == 1) {
                return redirect()->route('common.payment.receipt', ['VNo' => $transaction->VNo, 'type' => 'Stage']);
            } else {
                return redirect()->route('dashboard.marquee.stage.booking.index')->with('success', trans('accounts.marquee.booking'));
            }
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function AdvancePayReport(Request $request) {
        $page_title = "Bookings Advance Payment Report";

        $records = (object)[];

        if ($request->has('event_type') && is_numeric($request->get('event_type'))) {
            $event_type = $request->get('event_type');
            $customer_no = $request->get('customer');

            if ($customer_no == 0 || is_null($customer_no)) {
                if ($event_type == 1) {
                    $records = $this->booking->where('location_id', $this->location)->where('event_date', '>=', Carbon::now()->toDateString())
                                ->where('is_child','0');
                } else {
                    $records = $this->stage->where('location_id', $this->location)->whereCategory('WOB')
                                ->where('event_date', '>=', Carbon::now()->toDateString());
                }
            } else {
                if ($event_type == 1) {
                    $records = $this->booking->where('location_id', $this->location)->where('event_date', '>=', Carbon::now()->toDateString())
                                ->where('customer_option', $customer_no)
                                ->where('is_child','0');
                } else {
                    $records = $this->stage->where('location_id', $this->location)->whereCategory('WOB')
                                ->where('event_date', '>=', Carbon::now()->toDateString())
                                ->where('customer_id', $customer_no);
                }
            }

            $records = $records->get();
        }

        return view('dashboard.marquee.reports.booking-advance-payment-report',compact('page_title', 'records'));
    }
}
