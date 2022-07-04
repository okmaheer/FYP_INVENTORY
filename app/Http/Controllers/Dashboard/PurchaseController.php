<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use App\Traits\General;
use Intervention\Image\Facades\Image;

class PurchaseController extends Controller
{
    use General;

    protected $model;
    private $supplier;
    private $categories;
    private $units;

    public function __construct(Purchase $purchase, Supplier $supplier, Category $category, Unit $unit)
    {
        $this->middleware('auth');
        $this->model = $purchase;
        $this->supplier = $supplier;
        $this->categories = $category;
        $this->units = $unit;
    }

    public function index(Request $request)
    {


        $purchases = Purchase::with('purchaseDetails', 'supplier');
        // $purchases = \QueryHelper::filterByDate($request,$purchases,'purchase','purchases');
        $purchases = $purchases->orderBy('purchase_date', 'DESC')->get();

        $page_title = "Manage Purchase";

        return view('dashboard.purchase.manage_purchase', compact('page_title', 'purchases'));
    }

    public function create()
    {

        $supplier = $this->supplier->orderBy('supplier_name', 'ASC')->pluck('supplier_name', 'id');

        $page_title = "Create New Purchase";

        return view('dashboard.purchase.add_purchase', compact('page_title', 'supplier'));
    }

    public function store(Request $request)
    {

        $this->makeDirectory('purchase_attachment');

        $purchase = $this->model->create($request->all());
        if ($purchase) {
            $purchase->status = 1;
            $purchase->save();
        }
        if ($request->file('attachment')) {
            $file = $request->file('attachment');
            if (strtolower($file->getClientOriginalExtension()) == 'pdf') {
                $name = sha1('pdf' . $this->model->id . time()) . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/purchase_attachment/', $name);
            } else {
                $name = sha1('img' . $this->model->id . time()) . '.' . $file->getClientOriginalExtension();
                $image = Image::make($file);
                $image->save(public_path('uploads/purchase_attachment/') . $name);
            }
            $purchase->attachment = 'uploads/purchase_attachment/' . $name;
            $purchase->save();
        }



        if ($request->has('purchaseItem')) {
            $purchaseItems = $request->input('purchaseItem', array());
            $count = $purchaseItems['name'];
            if (count($purchaseItems) > 0) {
                foreach ($count as $key => $value) {
                    $product_id = $purchaseItems['id'][$key];
                    if ($product_id != '') {
                        $quantity = $purchaseItems['qty'][$key];
                        $price = $purchaseItems['rate'][$key];
                        $taxPercentage = $purchaseItems['tax'][$key];
                        $taxAmount = $purchaseItems['tax_amount'][$key];
                        $total = $purchaseItems['total'][$key];
                        $purchase->purchaseDetails()->save(
                            new purchaseDetail([
                                'purchase_id' => $purchase->id,
                                'product_id' => $product_id,
                                'quantity' => $quantity,
                                'rate' => $price,
                                'tax_amount' => $taxAmount,
                                'tax_p' => $taxPercentage,
                                'total_amount' => $total,
                                'status' => 1,
                            ])
                        );
                    }
                }
            }
        }


        return redirect()->route('dashboard.accounts.purchase.index')->with('success', trans('accounts.messages.created_purchase_msg'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {


        $page_title = __('accounts.purchase.modify_purchase');

        $supplier = $this->supplier
            ->orderBy('supplier_name', 'ASC')->pluck('supplier_name', 'id');
        $model = $this->model->with('purchaseDetails.product')
            ->findorFail($id);


        return view('dashboard.purchase.edit', compact('page_title', 'supplier', 'model'));
    }

    public function update(Request $request, $id)
    {

        $this->model = $this->model->findorFail($id);
        $oldAttachment = $this->model->attachment;
        $this->model->update($request->all());
        $purchase = $this->model->findorFail($id);
        if ($purchase) {
            $purchase->save();

            if ($request->has('purchaseItem')) {
                $purchaseItems = $request->input('purchaseItem', array());
                $count = $purchaseItems['name'];
                if (count($purchaseItems) > 0) {
                    foreach ($count as $key => $value) {
                        $product_id = $purchaseItems['id'][$key];
                        if ($product_id != '') {
                            $quantity = $purchaseItems['qty'][$key];
                            $price = $purchaseItems['rate'][$key];
                            $taxPercentage = $purchaseItems['tax'][$key];
                            $taxAmount = str_replace(',', '', $purchaseItems['tax_amount'][$key]);
                            $total = str_replace(',', '', $purchaseItems['total'][$key]);
                            $purchase->purchaseDetails()
                                ->where(['purchase_id' => $purchase->id, 'product_id' => $product_id])
                                ->update([
                                    'quantity' => $quantity,
                                    'rate' => $price,
                                    'tax_amount' => $taxAmount,
                                    'tax_p' => $taxPercentage,
                                    'total_amount' => $total,
                                ]);
                        }
                    }
                }
            }


            return redirect()->route('dashboard.accounts.purchase.index')->with('success', trans('accounts.messages.updated_purchase_msg'));
        }
    }

    public function destroy($id)
    {

        $purchase = $this->model->findorFail($id);
        $purchase->purchaseDetails()->delete();
        $purchase->delete();

        return redirect()->route('dashboard.accounts.purchase.index')->with('success', trans('accounts.messages.deleted_purchase_msg'));
    }

    // public function ViewInvoice($id)
    // {
    //     $this->authorize('viewInvoice', $this->model);

    //     $breadcrumbs = collect([
    //         'Dashboard' => route('dashboard'),
    //         'Manage Purchase' => route('dashboard.accounts.purchase.index'),
    //         'Purchase Invoice' => ''
    //     ]);

    //     $page_title = "Purchase Invoice";

    //     $purchase = $this->model->with('purchaseDetails.product')
    //         ->findorFail($id);
    //     $supplier = $this->supplier->findorFail($purchase->supplier_id);
    //     return view('dashboard.accounts.purchase.invoice',compact('page_title', 'breadcrumbs', 'supplier','purchase'));
    // }

    public function PurchaseReport(Request $request)
    {
       

        $filterData = $data = [];
        $report = $this->model->whereHas('supplier');

        // $report = \QueryHelper::filterByDate($request, $report, 'purchase', 'purchases');
        $report = $report->get();

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Purchase Report' => route('purchase.report'),
        ]);

        $page_title = "Purchase Report";

        return view('dashboard.reports.purchase_report', compact(
            'page_title',
            'breadcrumbs',
            'report'
        ));
    }

    public function PurchaseReportCategoryWise(Request $request)
    {
      

        $report =
            $this->model->with('purchaseDetails.product.category');

        // $report = \QueryHelper::filterByDate($request, $report, 'purchase', 'purchases');
        $report = $report->paginate(15);
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Purchase Report (Category Wise)' => route('purchase_report.category_wise'),
        ]);

        $page_title = "Category Wise Purchase Report";



        return view('dashboard.reports.purchase_report_category_wise', compact(
            'page_title',
            'breadcrumbs',
            'report'
        ));
    }
}
