<?php

namespace App\Http\Controllers\Accounts;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\PurchaseDetails;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Transaction;
use App\Models\AccountHead;
use App\Models\Category;
use App\Models\Product;

use App\Models\Unit;
use App\Models\Prefixes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Traits\General;
use Intervention\Image\Facades\Image;

class PurchaseController extends Controller
{
    use General;

    protected $model;
    private $supplier;
    private $transaction;
    private $categories;
    private $units;
    private $location;

    public function __construct(Purchase $purchase, Supplier $supplier,Transaction $transaction, Category $category, Unit $unit){
        $this->middleware('auth');
        $this->model = $purchase;
        $this->supplier = $supplier;
        $this->transaction = $transaction;
        $this->categories = $category;
        $this->units = $unit;
        $this->middleware(function ($request, $next){
            $this->location = session(SessionEnum::SESSION_LOCATION_ID);
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $this->authorize('view', $this->model);

        $purchases = Purchase::with('purchaseDetails','supplier')->where('location_id', $this->location);
        if ($request->has('supplier') &&  is_numeric($request->get('supplier')) ) {
            $purchases = $purchases->where('supplier_id', $request->supplier);
        }

        if ($request->has('purchase_date') &&  $request->get('purchase_date') != '') {
            $purchases = $purchases->whereDate('purchase_date',  Carbon::parse($request->purchase_date)->format('Y-m-d') );
        }

        if ($request->has('purchase_no') &&  $request->get('purchase_no') != '' ) {
            $purchases = $purchases->where('chalan_no', 'like', '%' . $request->purchase_no . '%' );
        }

        if ($request->has('booking') &&  is_numeric($request->get('booking')) ) {
            $purchases = $purchases->where('booking_id', $request->booking );
        }

        $purchases = \QueryHelper::filterByDate($request,$purchases,'purchase','purchases');

        $purchases = $purchases->orderBy('purchase_date', 'DESC')->get();

        $suppliers = $this->supplier->where('location_id', $this->location)
            ->orderBy('supplier_name', 'ASC')->pluck('supplier_name','id');
        $todayDate = Carbon::today()->toDateString();
        $bookings = DB::table('bookings')->where('location_id', $this->location)
            ->where('event_date' , '>=', $todayDate)->pluck('custom_booking_number','id');

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Purchase' => '',
        ]);
        $page_title = "Manage Purchase";

        return view('dashboard.accounts.purchase.manage_purchase',compact('page_title', 'breadcrumbs','purchases', 'suppliers', 'bookings'));
    }

    public function create()
    {
        $this->authorize('create', $this->model);

        $supplier = $this->supplier->where('location_id', $this->location)
            ->orderBy('supplier_name', 'ASC')->pluck('supplier_name','id');
        $invoiceNumber = Prefixes::generateNumber('Purchase');
        $todayDate = Carbon::today()->toDateString();

        $bookings = DB::table('bookings')->where('location_id', $this->location)
            ->where('event_date' , '>=', $todayDate)->pluck('custom_booking_number','id');

        $categories = $this->categories->where('location_id', $this->location)->whereStatus('1')
            ->orderBy('name', 'ASC')->pluck('name', 'id');
        $units = $this->units->whereStatus('1')->where('location_id', $this->location)
            ->orderBy('unit_name', 'ASC')->pluck('unit_name', 'id');

        $paymentTypes = [1 => 'Cash Payment'];
        $paymentAccounts = AccountHead::whereHas('pettycash', function($query) {
            if (auth()->user()->id > 1) {
                $query->where('id', auth()->user()->id);
            }
        })->orWhere('HeadCode', 'like', 102010 . '%')
            ->where('HeadCode', '!=', 1020102)
            ->pluck('HeadName','HeadCode');

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Purchase' => route('dashboard.accounts.purchase.index'),
            'Create New Purchase' => ''
        ]);

        $page_title = "Create New Purchase";

        return view('dashboard.accounts.purchase.add_purchase',compact('page_title', 'breadcrumbs','supplier','invoiceNumber','bookings','categories','units','paymentTypes','paymentAccounts'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', $this->model);

        $this->makeDirectory('purchase_attachment');

        $purchase = $this->model->create($request->all());
        if ($purchase) {
            $purchase->created_by = auth()->user()->id;
            $purchase->location_id = $this->location;
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
        Prefixes::updateNumber('Purchase');
        $paidAmount = $request->paid_amount;
        $netTotal = str_replace(',', '', $request->net_total_amount);

        $headCode = AccountHead::where('supplier_id',$request->supplier_id)->value('HeadCode');
        $supplierName = $this->supplier->getSupplierName($request->supplier_id);

        $paymentAccountHeadCode = $request->payment_account;
        $paymentAccountHeadName = AccountHead::where('HeadCode', $paymentAccountHeadCode)->value('HeadName');

        // Supplier Credit against total amount
        $purchase->transactions()->save(
            new Transaction([
                'Vtype'          => 'Purchase',
                'VDate'          => $request->purchase_date,
                'COAID'          => $headCode,
                'Narration'      => 'Supplier '. $supplierName . ' Credit Against Purchase # ' . $purchase->chalan_no,
                'Debit'          => 0,
                'Credit'         => $netTotal,
                'IsPosted'       => 1,
                'created_by'     => auth()->user()->id,
                'updated_by'     => auth()->user()->id,
                'IsAppove'       => 1,
                'location_id'    => $this->location,
            ])
        );
        //Product Purchase Debit of total amount
        $purchase->transactions()->save(
            new Transaction([
                'Vtype'          => 'Purchase',
                'VDate'          => $request->purchase_date,
                'COAID'          => 402,
                'Narration'      => 'Product Purchase Debit For Purchase # ' .$purchase->chalan_no,
                'Debit'          => $netTotal,
                'Credit'         => 0,
                'IsPosted'       => 1,
                'created_by'     => auth()->user()->id,
                'updated_by'     => auth()->user()->id,
                'IsAppove'       => 1,
                'location_id'    => $this->location,
            ])
        );
        // Inventory Debit
        $purchase->transactions()->save(
            new Transaction([
                'Vtype'          => 'Purchase',
                'VDate'          => $request->purchase_date,
                'COAID'          => 10107,
                'Narration'      => 'Inventory Debit For Purchase # ' .$purchase->chalan_no,
                'Debit'          => $netTotal,
                'Credit'         => 0,
                'IsPosted'       => 1,
                'created_by'     => auth()->user()->id,
                'updated_by'     => auth()->user()->id,
                'IsAppove'       => 1,
                'location_id'    => $this->location,
            ])
        );

        if(!empty($paidAmount)){
            // Cash In Hand Credit against paid amount
            $purchase->transactions()->save(
                new Transaction([
                    'Vtype'          => 'Purchase',
                    'VDate'          => $request->purchase_date,
                    'COAID'          => $paymentAccountHeadCode,
                    'Narration'      => $paymentAccountHeadName . ' Credit For Supplier '.$supplierName . ' Payment Against Purchase # ' . $purchase->chalan_no,
                    'Debit'          => 0,
                    'Credit'         => $paidAmount,
                    'IsPosted'       => 1,
                    'created_by'     => auth()->user()->id,
                    'updated_by'     => auth()->user()->id,
                    'IsAppove'       => 1,
                    'location_id'    => $this->location,
                ])
            );
             // Supplier Debit against Paid Amount
            $purchase->transactions()->save(
                new Transaction([
                    'Vtype'          => 'Purchase',
                    'VDate'          => $request->purchase_date,
                    'COAID'          => $headCode,
                    'Narration'      => 'Supplier '.$supplierName . ' Debit Against Paid Amount for Purchase # ' . $purchase->chalan_no,
                    'Debit'          => $paidAmount,
                    'Credit'         => 0,
                    'IsPosted'       => 1,
                    'created_by'     => auth()->user()->id,
                    'updated_by'     => auth()->user()->id,
                    'IsAppove'       => 1,
                    'location_id'    => $this->location,
                ])
            );
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
                            new purchaseDetails([
                                'purchase_id' => $purchase->id,
                                'product_id' => $product_id,
                                'quantity' => $quantity,
                                'rate' => $price,
                                'tax_amount' => $taxAmount,
                                'tax_p' => $taxPercentage,
                                'total_amount' => $total,
                                'status' => 1,
                                'location_id' => $this->location,
                            ])
                        );
                    }
                }
            }
        }

        if ($request->doPrint == 1) {
            return redirect()->route('dashboard.accounts.purchase.invoice',$purchase->id)->with('page_title', 'Purchase Invoice');
        } else {
            return redirect()->route('dashboard.accounts.purchase.index')->with('success', trans('accounts.messages.created_purchase_msg'));
        }

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $this->authorize('edit', $this->model);

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Purchase' => route('dashboard.accounts.purchase.index'),
            __('accounts.purchase.modify_purchase') => ''
        ]);

        $page_title = __('accounts.purchase.modify_purchase');

        $supplier = $this->supplier->where('location_id', $this->location)
            ->orderBy('supplier_name', 'ASC')->pluck('supplier_name','id');
        $model = $this->model->with('purchaseDetails.product')
            ->where('location_id', $this->location)->findorFail($id);
        $todayDate = Carbon::today()->toDateString();
        $bookings = DB::table('bookings')->where('location_id', $this->location)
            ->where('event_date' , '>=', $todayDate)->pluck('custom_booking_number','id');

        $paymentTypes = [1 => 'Cash Payment'];
        $paymentAccounts = AccountHead::whereHas('pettycash', function($query) {
            if (auth()->user()->id > 1) {
                $query->where('id', auth()->user()->id);
            }
        })->orWhere('HeadCode', 'like', 102010 . '%')
            ->where('HeadCode', '!=', 1020102)
            ->pluck('HeadName','HeadCode');

        return view('dashboard.accounts.purchase.edit_purchase',compact('page_title', 'breadcrumbs','supplier','model', 'bookings','paymentTypes','paymentAccounts'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('edit', $this->model);

        $this->model = $this->model->where('location_id', $this->location)->findorFail($id);
        $oldAttachment = $this->model->attachment;
        $this->model->update($request->all());
        $purchase = $this->model->where('location_id', $this->location)->findorFail($id);
        if ($purchase) {
            $purchase->updated_by = auth()->user()->id;
            $purchase->save();

            if ($request->file('attachment')) {
                if (file_exists($oldAttachment)) {
                    unlink($oldAttachment);
                }
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

            $this->transaction->where('VNo',$id)->where('Vtype','Purchase')
                ->where('location_id', $this->location)->delete();

            $paidAmount = $request->paid_amount;
            $netTotal = str_replace(',', '', $request->net_total_amount);

            $headCode = AccountHead::where('supplier_id',$request->supplier_id)->value('HeadCode');
            $supplierName = $this->supplier->getSupplierName($request->supplier_id);

            $paymentAccountHeadCode = $request->payment_account;
            $paymentAccountHeadName = AccountHead::where('HeadCode', $paymentAccountHeadCode)->value('HeadName');

            // Supplier Credit against total amount
            $purchase->transactions()->save(
                new Transaction([
                    'Vtype'          => 'Purchase',
                    'VDate'          => $request->purchase_date,
                    'COAID'          => $headCode,
                    'Narration'      => 'Supplier '. $supplierName . ' Credit Against Purchase # ' . $purchase->chalan_no,
                    'Debit'          => 0,
                    'Credit'         => $netTotal,
                    'IsPosted'       => 1,
                    'created_by'     => auth()->user()->id,
                    'updated_by'     => auth()->user()->id,
                    'IsAppove'       => 1,
                    'location_id'    => $this->location,
                ])
            );
            //Product Purchase Debit of total amount
            $purchase->transactions()->save(
                new Transaction([
                    'Vtype'          => 'Purchase',
                    'VDate'          => $request->purchase_date,
                    'COAID'          => 402,
                    'Narration'      => 'Product Purchase Debit For Purchase # ' .$purchase->chalan_no,
                    'Debit'          => $netTotal,
                    'Credit'         => 0,
                    'IsPosted'       => 1,
                    'created_by'     => auth()->user()->id,
                    'updated_by'     => auth()->user()->id,
                    'IsAppove'       => 1,
                    'location_id'    => $this->location,
                ])
            );
            // Inventory Debit
            $purchase->transactions()->save(
                new Transaction([
                    'Vtype'          => 'Purchase',
                    'VDate'          => $request->purchase_date,
                    'COAID'          => 10107,
                    'Narration'      => 'Inventory Debit For Purchase # ' .$purchase->chalan_no,
                    'Debit'          => $netTotal,
                    'Credit'         => 0,
                    'IsPosted'       => 1,
                    'created_by'     => auth()->user()->id,
                    'updated_by'     => auth()->user()->id,
                    'IsAppove'       => 1,
                    'location_id'    => $this->location,
                ])
            );

            if(!empty($paidAmount)){
                // Cash In Hand Credit against paid amount
                $purchase->transactions()->save(
                    new Transaction([
                        'Vtype'          => 'Purchase',
                        'VDate'          => $request->purchase_date,
                        'COAID'          => $paymentAccountHeadCode,
                        'Narration'      => $paymentAccountHeadName . ' Credit For Supplier '.$supplierName . ' Payment Against Purchase # ' . $purchase->chalan_no,
                        'Debit'          => 0,
                        'Credit'         => $paidAmount,
                        'IsPosted'       => 1,
                        'created_by'     => auth()->user()->id,
                        'updated_by'     => auth()->user()->id,
                        'IsAppove'       => 1,
                        'location_id'    => $this->location,
                    ])
                );
                // Supplier Debit against Paid Amount
                $purchase->transactions()->save(
                    new Transaction([
                        'Vtype'          => 'Purchase',
                        'VDate'          => $request->purchase_date,
                        'COAID'          => $headCode,
                        'Narration'      => 'Supplier '.$supplierName . ' Debit Against Paid Amount for Purchase # ' . $purchase->chalan_no,
                        'Debit'          => $paidAmount,
                        'Credit'         => 0,
                        'IsPosted'       => 1,
                        'created_by'     => auth()->user()->id,
                        'updated_by'     => auth()->user()->id,
                        'IsAppove'       => 1,
                        'location_id'    => $this->location,
                    ])
                );
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
                            $taxAmount = str_replace(',', '', $purchaseItems['tax_amount'][$key]);
                            $total = str_replace(',', '', $purchaseItems['total'][$key]);
                            $purchase->purchaseDetails()
                                ->where(['purchase_id' => $purchase->id, 'product_id' => $product_id, 'location_id' => $this->location])
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

            if ($request->doPrint == 1) {
                return redirect()->route('dashboard.accounts.purchase.invoice', $purchase->id)->with('page_title', 'Purchase Invoice');
            } else {
                return redirect()->route('dashboard.accounts.purchase.index')->with('success', trans('accounts.messages.updated_purchase_msg'));
            }
        }
    }

    public function destroy($id)
    {
        $this->authorize('delete', $this->model);

        $purchase = $this->model->where('location_id', $this->location)->findorFail($id);
        if (file_exists($purchase->attachment)) {
            unlink($purchase->attachment);
        }
        $purchase->purchaseDetails()->delete();
        $this->transaction->where('VNo',$id)->where('Vtype','Purchase')->where('location_id', $this->location)->delete();
        $purchase->delete();

        return redirect()->route('dashboard.accounts.purchase.index')->with('success', trans('accounts.messages.deleted_purchase_msg'));
    }

    public function ViewInvoice($id)
    {
        $this->authorize('viewInvoice', $this->model);

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Purchase' => route('dashboard.accounts.purchase.index'),
            'Purchase Invoice' => ''
        ]);

        $page_title = "Purchase Invoice";

        $purchase = $this->model->with('purchaseDetails.product')
            ->where('location_id', $this->location)->findorFail($id);
        $supplier = $this->supplier->where('location_id', $this->location)->findorFail($purchase->supplier_id);
        return view('dashboard.accounts.purchase.invoice',compact('page_title', 'breadcrumbs', 'supplier','purchase'));
    }
}
