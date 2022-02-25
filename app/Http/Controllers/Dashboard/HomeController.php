<?php

namespace App\Http\Controllers\Dashboard;

use App\Enum\RoleEnum;
use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Marquee\Booking;
use App\Models\Marquee\TentativeBooking;
use App\Models\Supplier;
use App\Models\Transaction;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Models\Marquee\BookingQuotation;
use App\Models\DailyClosing;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller

{

    private $location;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->location = session(SessionEnum::SESSION_LOCATION_ID);
            return $next($request);
        });
        $this->middleware('auth');
    }
    public function index()
    {
        $page_title = 'Dashboard';
        $breadcrumbs = collect([
            'Dashboard' => '',
        ]);
        $userRole = auth()->user()->roles[0]->name;
        if ($userRole == 'booking_manager') {
            $due_total = 0;
            ///confirmBooking
            $confirmBooking = Booking::where('status', 2)->where('location_id', $this->location)->count();
            ///non confirmBooking
            $nonConfirmBooking = Booking::where('status', 1)->where('location_id', $this->location)->count();
            ///tentative booking
            $tentativeBookings = TentativeBooking::where('location_id', $this->location)
                ->whereDate('created_at', '>=', Carbon::today()->subDays(2)->toDateString())
                ->whereDate('created_at', '<=', Carbon::today()->toDateString())
                ->count();
            ///total quotations
            $bookingQuotations = BookingQuotation::where('location_id', $this->location)->count();
            /// total due ammount
            $data = DB::table('transactions as t')
                ->join('account_heads as h', 'h.HeadCode', '=', 't.COAID')
                ->join('customers as c', 'c.id', '=', 'h.customer_id')
                ->selectRaw('IFNULL(SUM(t.Debit) - SUM(t.Credit),0) as balance')
                ->where('t.location_id', $this->location)
                ->first();
            $due_total = $data->balance;

            $topEvents = $this->getTop5Events();

            return view('dashboard.booking-manager-index', compact('breadcrumbs', 'page_title', 'topEvents', 'due_total', 'bookingQuotations', 'tentativeBookings', 'nonConfirmBooking', 'confirmBooking'));
        }
        if ($userRole == 'accountant') {
            $due_total = 0;
            $supplierDue = 0;
            ///confirmBooking
            $confirmBooking = Booking::where('status', 2)->where('location_id', $this->location)->count();

            ///total quotations
            $bookingQuotations = BookingQuotation::where('location_id', $this->location)->count();

            /// total due ammount
            $data = DB::table('transactions as t')
                ->join('account_heads as h', 'h.HeadCode', '=', 't.COAID')
                ->join('customers as c', 'c.id', '=', 'h.customer_id')
                ->selectRaw('IFNULL(SUM(t.Debit) - SUM(t.Credit),0) as balance')
                ->where('t.location_id', $this->location)
                ->first();
            $due_total = $data->balance;

            //  cash in hand
            $cih = DB::table('transactions as t')
                ->selectRaw('IFNULL(SUM(t.Debit) - SUM(t.Credit),0) as balance')
                ->where('t.COAID', 1020101)
                ->where('t.location_id', $this->location)
                ->first();


            ////expense
            $date_start = Carbon::now()->startOfMonth()->toDateString();
            $date_end = Carbon::now()->endOfMonth()->toDateString();
            $expense = DB::table('transactions as t')
                ->selectRaw('IFNULL(SUM(t.Debit),0) as balance')
                ->join('account_heads as h', 'h.HeadCode', '=', 't.COAID')
                ->where('h.HeadType', 'E')
                ->whereDate('t.VDate', '>=', $date_start)
                ->whereDate('t.VDate', '<=', $date_end)
                ->where('t.location_id', $this->location)
                ->first();

            ///// supplier dues

            $dues = Supplier::where('location_id', $this->location)->get();
            foreach ($dues as $d) {
                $supplierDue += (\AccountHelper::supplierDue($d->id));
            }
            // dd($supplierDue);


            $todayClosing = $this->getTodayClosingAmount();


            return view('dashboard.accountant-index', compact('breadcrumbs', 'expense', 'supplierDue', 'cih', 'todayClosing', 'page_title', 'due_total', 'bookingQuotations', 'confirmBooking'));
        }
        if ($userRole == 'admin') {
            $due_total = 0;
            $supplierDue = 0;
            ///confirmBooking
            $confirmBooking = Booking::where('status', 2)->where('location_id', $this->location)->count();
            ///non confirmBooking
            $nonConfirmBooking = Booking::where('status', 1)->where('location_id', $this->location)->count();
            ///total quotations
             ///tentative booking
             $tentativeBookings = TentativeBooking::where('location_id', $this->location)
             ->whereDate('created_at', '>=', Carbon::today()->subDays(2)->toDateString())
             ->whereDate('created_at', '<=', Carbon::today()->toDateString())
             ->count();
            $bookingQuotations = BookingQuotation::where('location_id', $this->location)->count();
            /// total due amount
            $data = DB::table('transactions as t')
                ->join('account_heads as h', 'h.HeadCode', '=', 't.COAID')
                ->join('customers as c', 'c.id', '=', 'h.customer_id')
                ->selectRaw('IFNULL(SUM(t.Debit) - SUM(t.Credit),0) as balance')
                ->where('t.location_id', $this->location)
                ->first();
            $due_total = $data->balance;

            //  cash in hand
            $cih = DB::table('transactions as t')
                ->selectRaw('IFNULL(SUM(t.Debit) - SUM(t.Credit),0) as balance')
                ->where('t.COAID', 1020101)
                ->where('t.location_id', $this->location)
                ->first();


            ////expense
            $date_start = Carbon::now()->startOfMonth()->toDateString();
            $date_end = Carbon::now()->endOfMonth()->toDateString();
            $expense = DB::table('transactions as t')
                ->selectRaw('IFNULL(SUM(t.Debit),0) as balance')
                ->join('account_heads as h', 'h.HeadCode', '=', 't.COAID')
                ->where('h.HeadType', 'E')
                ->whereDate('t.VDate', '>=', $date_start)
                ->whereDate('t.VDate', '<=', $date_end)
                ->where('t.location_id', $this->location)
                ->first();

            ///// supplier dues

            $dues = Supplier::where('location_id', $this->location)->get();
            foreach ($dues as $d) {
                $supplierDue += (\AccountHelper::supplierDue($d->id));
            }
            // dd($supplierDue);


            $todayClosing = $this->getTodayClosingAmount();
            $topEvents = $this->getTop5Events();

            return view('dashboard.index', compact('breadcrumbs', 'expense','nonConfirmBooking' ,'topEvents','tentativeBookings','supplierDue', 'cih', 'todayClosing', 'page_title', 'due_total', 'bookingQuotations', 'confirmBooking'));
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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

    private function getTop5Events()
    {
        $date_start = Carbon::now()->startOfMonth()->toDateString();
        $date_end = Carbon::now()->endOfMonth()->toDateString();

        $bookings = Booking::whereDate('event_date', '>=', $date_start)
            ->whereDate('event_date', '<=', $date_end)
            ->where('location_id', $this->location)
            ->orderBy('no_person', 'DESC')
            ->paginate(5);
        return $bookings;
    }

    private function getTodayClosingAmount()
    {
        $todayDate = Carbon::today()->toDateString();
        $cash_in = Transaction::where(['COAID' => 1020101, 'VDate' => $todayDate])
            ->where('location_id', $this->location)
            ->sum('Debit');
        $cash_out = Transaction::where(['COAID' => 1020101, 'VDate' => $todayDate])
            ->where('location_id', $this->location)
            ->sum('Credit');

        $cash_in_hand = collect([
            'in' => \AccountHelper::number_format($cash_in),
            'in_words' =>  \AccountHelper::convert_number($cash_in),
            'out' => \AccountHelper::number_format($cash_out),
            'out_words' => \AccountHelper::convert_number($cash_out),
            'balance' => \AccountHelper::number_format($cash_in - $cash_out, 0),
            'balance_words' => \AccountHelper::convert_number($cash_in - $cash_out),
            'chart_data' => json_encode([(int)$cash_in, (int)$cash_out, (int)($cash_in - $cash_out)])
        ]);
        return $cash_in_hand;
    }
}
