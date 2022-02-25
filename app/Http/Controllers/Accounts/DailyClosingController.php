<?php

namespace App\Http\Controllers\Accounts;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\AccountHead;
use App\Models\DailyClosing;
use App\Models\Invoice;
use App\Models\Purchase;
use App\Models\Reports;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DailyClosingController extends Controller
{
    public $invoice;
    public $purchase;
    public $transaction;
    public $accountHead;
    public $dailyClosing;
    private $location;

    public function __construct(Invoice $invoice,Purchase $purchase,Transaction $transaction,AccountHead $accountHead,DailyClosing $dailyClosing){
        $this->invoice = $invoice;
        $this->purchase = $purchase;
        $this->transaction = $transaction;
        $this->accountHead = $accountHead;
        $this->dailyClosing = $dailyClosing;
        $this->middleware(function ($request, $next){
            $this->location = session(SessionEnum::SESSION_LOCATION_ID);
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('closing', Reports::class);

        $cash_in_hand = 0;
        $todayDate = Carbon::today()->toDateString();

        $last_closing_amount = $this->dailyClosing->where('date',DB::raw(('(SELECT MAX(date) FROM daily_closings)')))->pluck('amount')->first();

        $cash_in = $this->transaction->where(['COAID' => 1020101, 'VDate' => $todayDate])
            ->where('location_id', $this->location)
            ->sum('Debit');
        $cash_out = $this->transaction->where(['COAID' => 1020101, 'VDate' => $todayDate])
            ->where('location_id', $this->location)
            ->sum('Credit');
//
        if ($last_closing_amount != null) {
            $cash_in_hand = ($last_closing_amount + $cash_in ) - $cash_out;
        } else {
            $last_closing_amount = 0;
            $cash_in_hand = $cash_in - $cash_out;
        }

        $accountsClosingData = [
            "last_day_closing" => number_format($last_closing_amount, 2, '.', ','),
            "cash_in"          => number_format($cash_in, 2, '.', ','),
            "cash_out"         => number_format($cash_out, 2, '.', ','),
            "cash_in_hand"     => number_format($cash_in_hand, 2, '.', ',')
        ];

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Day Closing' => ''
        ]);

        $page_title = "Day Closing";

        return view('dashboard.accounts.Report.closing',compact('page_title', 'breadcrumbs','accountsClosingData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('closing', Reports::class);

        $todayDate = Carbon::today()->toDateString();
        $this->dailyClosing->create([
            'last_day_closing' => str_replace(',', '', $request->last_day_closing) ,
            'cash_in' => str_replace(',', '', $request->cash_in),
            'cash_out' => str_replace(',', '', $request->cash_out),
            'date' => $todayDate,
            'amount' => str_replace(',', '', $request->cash_in_hand),
            'location_id' => $this->location,
        ]);

        return redirect()->route('closing.report');
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
        //
    }
}
