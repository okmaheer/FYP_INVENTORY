<?php

namespace App\Http\Controllers\Accounts;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\DemandDetail;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetails;
use App\Models\Reports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public $invoiceDetail;
    public $purchaseDetails;
    public $product;
    protected $reportModel;
    private $location;

    public function __construct(Reports $report, InvoiceDetail $invoiceDetail, PurchaseDetails $purchaseDetails,Product $product)
    {
        $this->middleware('auth');
        $this->invoiceDetail = $invoiceDetail;
        $this->purchaseDetails = $purchaseDetails;
        $this->product = $product;
        $this->reportModel = $report;
        $this->middleware(function ($request, $next){
            $this->location = session(SessionEnum::SESSION_LOCATION_ID);
            return $next($request);
        });
    }
    public function fifoStock(){
        $this->authorize('stockReport', $this->reportModel);
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Stock Report' => '',

        ]);

        $page_title = "Stock Report";
        $products = $this->product->get();

        return view('dashboard.accounts.Stock.fifo_stock_report',compact('page_title', 'breadcrumbs','products'));
    }
    public function stock()
    {
        $this->authorize('stockReport', $this->reportModel);

        $data = DB::table('stock_view as s')
            ->join('products as p','p.id','=','s.product_id')
            ->where('p.location_id', $this->location)
            ->selectRaw('p.product_name as product_name, SUM(s.qty) as stock, SUM(s.qty * s.rate) as stock_value')
            ->groupBy('p.product_name')
            ->get();

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Stock Report' => '',
        ]);

        $page_title = "Stock Report";

        return view('dashboard.accounts.Stock.stock_report',compact('page_title', 'breadcrumbs','data'));
    }

    public function fixAssetsStock()
    {
        $this->authorize('fixAssetReport', $this->reportModel);

        $products = $this->product->whereHas('category', function($query) {
              $query->whereType('fix_assets');
        })
            ->where('location_id', $this->location)->get();

        $data = array();
        $sl =1;
        foreach($products as $record ){
            $stockout = $this->purchaseDetails
                ->selectRaw('sum(quantity) as totalPurchaseQnty,Avg(price) as purchaseprice')
                ->where('product_id',$record->id)
                ->first();

            $stockin = $this->invoiceDetail
                ->selectRaw('sum(quantity) as totalSalesQnty')
                ->where('product_id',$record->id)
                ->first();

            $sprice = (!empty($record->price)?$record->price:0);
            $pprice = (!empty($stockout->purchaseprice)?sprintf('%0.2f',$stockout->purchaseprice):0);
//            $stock =  (!empty($stockout->totalPurchaseQnty)?$stockout->totalPurchaseQnty:0)-(!empty($stockin->totalSalesQnty)?$stockin->totalSalesQnty:0);
            $data[] = array(
                'sl'            =>   $sl,
                'product_name'  =>  $record->product_name,
                'product_model' =>  $record->product_model,
                'sales_price'   =>  sprintf('%0.2f',$sprice),
                'purchase_p'    =>  $pprice,
                'totalPurchaseQnty'=>$stockout->totalPurchaseQnty,
                'totalSalesQnty'=>  $stockin->totalSalesQnty,
//                'stock_quantity' => sprintf('%0.2f',$stock),
                'total_sale_price'=> ($stockout->totalPurchaseQnty-$stockin->totalSalesQnty)*$sprice,
                'purchase_total' =>  ($stockout->totalPurchaseQnty-$stockin->totalSalesQnty)*$pprice,
            );
            $sl++;
        }
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Fix Assets Stock Report' => '',

        ]);

        $page_title = "Fix Assets Stock Report";


        return view('dashboard.accounts.Stock.fix_assets_stock_report',compact('page_title', 'breadcrumbs','data'));
    }





    public function stock_quantity(Request $request)
    {

        $title = "Purchase Stock Report";

        $products = $this->product->where('location_id', $this->location)->get();
        $data = array();
        $sl =1;
        foreach($products as $record ){
            $stockout = $this->purchaseDetails
                ->selectRaw('sum(quantity) as totalPurchaseQnty,Avg(rate) as purchaseprice')
                ->where('product_id',$record->id)
                ->where('location_id', $this->location)
                ->first();

            $stockin = DemandDetail::
                selectRaw('sum(quantity) as totalDemandQnty')
                ->where('product_id',$record->id)
                ->first();

            $sprice = (!empty($record->price)?$record->price:0);
            $pprice = (!empty($stockout->purchaseprice)?sprintf('%0.2f',$stockout->purchaseprice):0);
            $stock =  (!empty($stockout->totalPurchaseQnty)?$stockout->totalPurchaseQnty:0)-(!empty($stockin->totalDemandQnty)?$stockin->totalDemandQnty:0);
            $data1[] = array(
                'sl'            =>   $sl,
                'product_name'  =>  $record->product_name,
                'purchase_p'    =>  $pprice,
                'totalPurchaseQnty'=>$stockout->totalPurchaseQnty,
                'totalDemandQnty'=>  $stockin->totalDemandQnty,
                'stock_quantity' => sprintf('%0.2f',$stock)
            );
            $sl++;
        }

        $data=$data1;
        if ($request->has('product_id') &&  $request->get('product_id') != '') {

            $name = DB::table('products')->where('id',$request->product_id)->pluck('product_name');
            $namep = $name[0];

            $data2 = array();
            $data2 = $data1;


            for ($i=0; $i <count($data2) ; $i++) {


                if($data2[$i]['product_name'] == $namep)

                $data3[] = $data2[$i];

            }
            $data=$data3;


        }
        $model = Product::with('purchaseDetail')->get();



        $product = array();

          foreach ($model as $key => $value) {

          $product[$value->id]= $value->product_name;
             }
        return view('dashboard.accounts.Stock.purchase_stock_quantity',compact('data','product','title'));

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
            }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    }
}
