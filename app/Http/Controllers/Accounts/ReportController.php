<?php

namespace App\Http\Controllers\Accounts;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\AccountHead;
use App\Models\DailyClosing;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Reports;
use App\Models\Supplier;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public $invoice;
    public $purchase;
    public $transaction;
    public $accountHead;
    public $dailyClosing;
    public $product;
    protected $reportModel;
    private $location;

    public function __construct(Reports $report, Invoice $invoice, Purchase $purchase, Transaction $transaction, AccountHead $accountHead, DailyClosing $dailyClosing,Product $product)
    {
        $this->middleware('auth');
        $this->invoice = $invoice;
        $this->purchase = $purchase;
        $this->transaction = $transaction;
        $this->accountHead = $accountHead;
        $this->dailyClosing = $dailyClosing;
        $this->product = $product;
        $this->reportModel = $report;
        $this->middleware(function ($request, $next){
            $this->location = session(SessionEnum::SESSION_LOCATION_ID);
            return $next($request);
        });
    }

    public function ClosingReport()
    {
        $this->authorize('closingReport', $this->reportModel);

        $page_title = "Closing Report";
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Closing Report' => route('closing.report'),
        ]);
        $dailyClosing = $this->dailyClosing->where('location_id', $this->location)->get();
        return view('dashboard.accounts.Report.closing_report', compact('dailyClosing','page_title', 'breadcrumbs'));
    }

    public function TodayReport()
    {
        $this->authorize('todayReport', $this->reportModel);

        $todaySaleReport = $this->invoice->where('location_id', $this->location)->with('customer')->get();
        $todayPurchaseReport = $this->purchase->where('location_id', $this->location)->with('supplier')->get();

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            "Today's Report" => route('today.report'),
        ]);

        $page_title = "Today's Report";
        return view('dashboard.accounts.Report.today_report', compact('page_title', 'breadcrumbs','todaySaleReport', 'todayPurchaseReport'));
    }

    public function TodayCustomerReceipt()
    {
        $this->authorize('todayCustomerReceipts', $this->reportModel);

        $rpt = $this->transaction->whereHas('accountHead.customer')
            ->where('location_id', $this->location)
            ->get();
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Today Customer Reciept' => route('today.customer.receipt'),
        ]);

        $page_title = "Today's Customer Receipt";

        return view('dashboard.accounts.Report.today_customer_receipt', compact('page_title', 'breadcrumbs','rpt'));
    }

    public function SalesReport()
    {
        $this->authorize('salesReport', $this->reportModel);

        $invoice = $this->invoice->where('location_id', $this->location)->whereHas('customer')->where('date', Carbon::today()->toDateString())->get();

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Sales Report' => route('sales.report'),

        ]);

        $page_title = "Sales Report";

        return view('dashboard.accounts.Report.sales_report', compact(
            'page_title', 'breadcrumbs',
            'invoice'));
    }

    public function UserWiseSalesReport(Request $request)
    {
        $this->authorize('salesReportUserWise', $this->reportModel);

        $report = $this->invoice
            ->whereHas('createdBy')
            ->where('location_id', $this->location)
            ->select(DB::raw('SUM(invoices.grand_total_price) as grand_total_price,COUNT(invoices.id) as count_invoices, invoices.date date, invoices.customer_id customer_id,invoices.user_id as user_id'))
            ->groupBy('user_id', 'invoices.customer_id', 'invoices.date');

        $report = \QueryHelper::filterByDate($request,$report,'invoices','invoices');
        $report = $report->get();

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'User Wise Sales Report' => route('user_wise.sales_report'),

        ]);

        $page_title = "User Wise Sales Report";
        return view('dashboard.accounts.Report.user_wise_sales_report', compact('page_title', 'breadcrumbs',
        'report'));
    }

    public function DueReport(Request $request)
    {
        $this->authorize('customerDueReport', $this->reportModel);

        $report = Customer::where('location_id', $this->location);

        if ($request->has('customer_id') && is_numeric($request->get('customer_id'))) {
            $report = $report->where('id', $request->customer_id);
        }
//        $report = \QueryHelper::filterByDate($request,$report,'invoices','invoices');

//        $report = $report->groupBy('customer_id')->get();
        $report = $report->get();

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Customer Due Report' => '',
        ]);

        $page_title = "Customer Due Report";

        $customer = Customer::orderBy('customer_name', 'ASC')->where('location_id', $this->location)->pluck('customer_name', 'id');
        return view('dashboard.accounts.Report.due_report', compact('page_title', 'breadcrumbs','report','customer'));
    }

    public function SupplierDueReport (Request $request) {
        $this->authorize('supplierDueReport', $this->reportModel);

        $report = Supplier::where('location_id', $this->location);

        if ($request->has('supplier_id') && is_numeric($request->get('supplier_id'))) {
            $report = $report->where('id', $request->supplier_id);
        }
        $report = $report->get();

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Supplier Due Report' => '',
        ]);

        $page_title = "Supplier Due Report";

        $supplier = Supplier::orderBy('supplier_name', 'ASC')->where('location_id', $this->location)->pluck('supplier_name', 'id');
        return view('dashboard.accounts.Report.supplier_due_report', compact('page_title', 'breadcrumbs','report','supplier'));
    }

    public function ShippingCostReport(Request $request)
    {
        $this->authorize('shippingCostReport', $this->reportModel);

        $report = $this->invoice->where('location_id', $this->location);

        $report = \QueryHelper::filterByDate($request,$report,'invoices','invoices');
        $report = $report->paginate(15);

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Shipping Cost' => route('shipping.cost_report'),

        ]);

        $page_title = "Shipping Cost Report";
        return view('dashboard.accounts.Report.shipping_cost_report', compact('page_title', 'breadcrumbs','report'));
    }

    public function PurchaseReport(Request $request)
    {
        $this->authorize('purchaseReport', $this->reportModel);

        $filterData = $data = [];
        $report = $this->purchase->where('location_id', $this->location)->whereHas('supplier');

        $report = \QueryHelper::filterByDate($request,$report,'purchase','purchases');
        $report = $report->get();

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Purchase Report' => route('purchase.report'),
        ]);

        $page_title = "Purchase Report";

        return view('dashboard.accounts.Report.purchase_report', compact(
            'page_title', 'breadcrumbs','report'));
    }

    public function PurchaseReportCategoryWise(Request $request)
    {
        $this->authorize('purchaseReportCategoryWise', $this->reportModel);

        $report =
            $this->purchase->where('location_id', $this->location)->with('purchaseDetails.product.category');

        $report = \QueryHelper::filterByDate($request,$report,'purchase','purchases');
        $report = $report->paginate(15);
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Purchase Report (Category Wise)' => route('purchase_report.category_wise'),
        ]);

        $page_title = "Category Wise Purchase Report";



        return view('dashboard.accounts.Report.purchase_report_category_wise', compact(
            'page_title', 'breadcrumbs','report'));
    }

    public function ProductWiseSale(Request $request)
    {
        $this->authorize('salesReportProductWise', $this->reportModel);

        $product = $this->product->where('location_id', $this->location)
            ->orderBy('product_name', 'ASC')->pluck('product_name','id');

        $report =
            $this->invoice->where('location_id', $this->location)
                ->whereHas('invoiceDetails.product');
        /**
         *Need to fix product wise filter , i just miss that filter for now
         *
         */
        $report = \QueryHelper::filterByDate($request,$report,'invoices','invoices');
        $report = $report->paginate(15);

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Sale Report (Product Wise)' => route('product.wise'),
        ]);

        $page_title = "Product Wise Sales Report";

        return view('dashboard.accounts.Report.sales_report_product_wise', compact('page_title', 'breadcrumbs','report','product'));
    }

    public function SalesReportCategoryWise(Request $request)
    {
        $this->authorize('salesReportCategoryWise', $this->reportModel);

        $product = $this->product->where('location_id', $this->location)
            ->orderBy('product_name', 'ASC')->pluck('product_name','id');

        $report =
            $this->invoice->where('location_id', $this->location)
                ->whereHas('invoiceDetails.product.category');

        $report = \QueryHelper::filterByDate($request,$report,'invoices','invoices');
        $report = $report->paginate(15);

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Sales Report (Category Wise)' => route('sales_report.category_wise'),
        ]);

        $page_title = "Category Wise Sales Report";

        return view('dashboard.accounts.Report.sales_report_category_wise', compact('page_title', 'breadcrumbs','report','product'));
    }

    public function SalesReturn(Request $request)
    {
        $this->authorize('salesReturnReport', $this->reportModel);

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Sales Return' => route('sales.return'),
        ]);

        $page_title = "Sales Return";
        return view('dashboard.accounts.Report.sales_return',compact('page_title', 'breadcrumbs'));
    }

    public function SupplierReturn(Request $request)
    {
        $this->authorize('salesReturnReport', $this->reportModel);

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Supplier Return Report' => '',
        ]);
        $page_title = "Supplier Return Report";
        return view('dashboard.accounts.Report.supplier_return',compact('page_title', 'breadcrumbs'));
    }

    public function TaxReport(Request $request)
    {
        $this->authorize('taxReport', $this->reportModel);

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Tax Report' => route('tax.report'),
        ]);
        $page_title = "Tax Report";
        return view('dashboard.accounts.Report.tax_report', compact('page_title', 'breadcrumbs'));
    }

    public function ProfitReportSalesWise(Request $request)
    {
        $this->authorize('profitReportSalesWise', $this->reportModel);

        $report = DB::table('invoices')
            ->where('invoices.location_id', $this->location)
            ->join('invoice_details','invoice_details.invoice_id','=','invoices.id')
            ->selectRaw('invoices.date,invoices.id,CAST(sum(grand_total_price) AS DECIMAL(16,2)) as total_sale')
            ->selectRaw("CAST(SUM(invoice_details.quantity * invoice_details.supplier_rate) AS DECIMAL(16,2)) as total_supplier_rate")
            ->selectRaw("CAST(SUM(invoices.grand_total_price) - SUM(invoice_details.quantity * invoice_details.supplier_rate) AS DECIMAL(16,2)) AS total_profit")
            ->groupBy('invoices.date', 'invoices.id');
        $report = \QueryHelper::filterByDate($request,$report,'invoices','invoices');
        $report = $report->paginate(15);


        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Profit Report (Sales Wise)' => route('profit_report.sales_wise'),
        ]);

        $page_title = "Sales Wise Profit Report";
        return view('dashboard.accounts.Report.profit_report_sales_wise',compact(
            'page_title', 'breadcrumbs', 'report'));
    }


}
