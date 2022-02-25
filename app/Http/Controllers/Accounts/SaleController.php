<?php

namespace App\Http\Controllers\Accounts;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\AccountHead;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Invoice2Detail;
use App\Models\InvoiceDetail;
use App\Models\Product;
use App\Models\PurchaseDetails;
use App\Models\Tax;
use App\Models\Transaction;
use Carbon\Carbon;
use Cassandra\Custom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Prefixes;

class SaleController extends Controller
{
    public $customer;
    public $model;
    public $transaction;
    private $location;

    public function __construct(Customer $customer,Invoice $invoice,Transaction $transaction){
        $this->middleware('auth');
        $this->customer = $customer;
        $this->model = $invoice;
        $this->transaction = $transaction;
        $this->middleware(function ($request, $next){
            $this->location = session(SessionEnum::SESSION_LOCATION_ID);
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $this->authorize('view', $this->model);

        $breadcrumbs = collect([
            __('accounts.general.dashboard') => route('dashboard'),
            __('accounts.sale.manage_sale') => '',
        ]);

        $page_title = __('accounts.sale.manage_sale');

        $invoice = $this->model->with('invoiceDetails','customer')->where('location_id', $this->location);
        $invoice = \QueryHelper::filterByDate($request,$invoice,'invoices','invoices');
        $invoice = $invoice->orderBy('date', 'DESC')->get();

        return view('dashboard.accounts.sale.manage_sale',compact('page_title', 'breadcrumbs','invoice'));
    }

    public function create()
    {
        $this->authorize('create', $this->model);

        $breadcrumbs = collect([
            __('accounts.general.dashboard') => route('dashboard'),
            __('accounts.sale.manage_sale') => route('dashboard.accounts.sale.index'),
            __('accounts.sale.new_sale') => ''
        ]);

        $page_title = __('accounts.sale.new_sale');

        $invoiceNumber = Prefixes::generateNumber('INV');
        $customer = $this->customer->where('location_id', $this->location)->orderBy('customer_name', 'ASC')->pluck('customer_name','id');
        $tax = Tax::where('location_id', $this->location)->orderBy('tax_name', 'ASC')->pluck('tax_name', 'id');
        $paymentTypes = [1 => 'Cash Payment'];
        $paymentAccounts = AccountHead::whereHas('pettycash', function($query) {
            if (auth()->user()->id > 1) {
                $query->where('id', auth()->user()->id);
            }
        })->orWhere('HeadCode', 'like', 102010 . '%')
            ->where('HeadCode', '!=', 1020102)
            ->pluck('HeadName','HeadCode');
        return view('dashboard.accounts.sale.sale_form',compact('page_title', 'breadcrumbs','customer','invoiceNumber', 'tax','paymentTypes','paymentAccounts'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', $this->model);

        $invoice = $this->model->create($request->all());
        if ($invoice) {
            $invoice->status = 1;
            $invoice->created_by = auth()->user()->id;
            $invoice->location_id = $this->location;
            $invoice->save();

            Prefixes::updateNumber('INV');

            $invPrice = 0;

            if ($request->has('invoiceItem')) {
                $invoiceItems = $request->input('invoiceItem', array());
                $count = $invoiceItems['name'];
                if (count($invoiceItems) > 0) {
                    foreach ($count as $key => $value) {
                        $productId = $invoiceItems['id'][$key];
                        $description = $invoiceItems['desc'][$key];
                        $quantity = $invoiceItems['qty'][$key];
                        $supplier_rate = $invoiceItems['supplier_rate'][$key];
                        $rate = $invoiceItems['rate'][$key];
                        $discountAmount = $invoiceItems['discount_amount'][$key];
                        $discountPercentage = $invoiceItems['discount'][$key];
                        $taxPercentage = $invoiceItems['tax'][$key];
                        $taxAmount = $invoiceItems['tax_amount'][$key];
                        $total = str_replace(',', '', $invoiceItems['total'][$key]);

                        $data = \QueryHelper::po_wise_stock($quantity, $productId);
                        foreach ($data as $d) {
                            $temp = $d->rate * $d->split_quantity;
                            $invPrice += $temp;

                            $invoice->invoice2Details()->save(
                                new Invoice2Detail([
                                    'product_id' => $d->product_id,
                                    'quantity' => $d->split_quantity,
                                    'po_id' => $d->id,
                                    'po_rate' => $d->rate,
                                    'rate' => $rate,
                                    'location_id' => $this->location,
                                ])
                            );
                        }
                        $invoice->invoiceDetails()->save(
                            new InvoiceDetail([
                                'product_id' => $productId,
                                'description' => $description,
                                'quantity' => $quantity,
                                'supplier_rate' => $supplier_rate,
                                'rate' => $rate,
                                'discount' => $discountAmount,
                                'discount_per' => $discountPercentage,
                                'tax_p' => $taxPercentage,
                                'tax_amount' => $taxAmount,
                                'total_price' => $total,
                                'status' => 1,
                                'location_id' => $this->location,
                            ])
                        );
                    }
                }
            }

            $headCode = AccountHead::where('customer_id', $request->customer_id)->value('HeadCode');
            $customerName = $this->customer->getCustomerName($request->customer_id);

            $paymentAccountHeadCode = $request->payment_account;
            $paymentAccountHeadName = AccountHead::where('HeadCode', $paymentAccountHeadCode)->value('HeadName');

            $totalAmount = str_replace(',', '', $request->net_total);
            $paidAmount = str_replace(',', '', $request->paid_amount);
            //Product Sale Head debit for net total
            $invoice->transactions()->save(
                new Transaction([
                    'Vtype'      => 'INV',
                    'VDate'      => $request->date,
                    'COAID'      => 303,
                    'Narration'  => 'Product Sale Debit For Invoice # ' . $invoice->invoice_no,
                    'Debit'      => $totalAmount,
                    'Credit'     => 0,
                    'IsPosted'   => 1,
                    'created_by' => auth()->user()->id,
                    'IsAppove'   => 1,
                    'location_id' => $this->location,
                ])
            );
            //Inventory credit with fifo Price
            $invoice->transactions()->save(
                new Transaction([
                    'Vtype'      => 'INV',
                    'VDate'      => $request->date,
                    'COAID'      => 10107,
                    'Narration'  => 'Inventory Credit For Invoice # ' . $invoice->invoice_no,
                    'Debit'      => 0,
                    'Credit'     => $invPrice,//purchase price asbe
                    'IsPosted'   => 1,
                    'created_by' => auth()->user()->id,
                    'IsAppove'   => 1,
                    'location_id' => $this->location,
                ])
            );
            //Customer debit for net total
            $invoice->transactions()->save(
                new Transaction([
                    'Vtype'      => 'INV',
                    'VDate'      => $request->date,
                    'COAID'      => $headCode,
                    'Narration'  => 'Customer ' . $customerName . ' Debit For Invoice # ' . $invoice->invoice_no,
                    'Debit'      => $totalAmount, // - (!empty($request->previous) ? $request->previous : 0),
                    'Credit'     => 0,
                    'IsPosted'   => 1,
                    'created_by' => auth()->user()->id,
                    'IsAppove'   => 1,
                    'location_id' => $this->location,
                ])
            );

            if ($request->has('paid_amount') && $request->get('paid_amount') > 0) {
                //Customer credit for paid amount
                $invoice->transactions()->save(
                    new Transaction([
                        'Vtype'      => 'INV',
                        'VDate'      => $request->date,
                        'COAID'      => $headCode,
                        'Narration'  => 'Customer ' . $customerName . ' Credit for Paid Amount of Invoice # ' . $invoice->invoice_no,
                        'Debit'      => 0,
                        'Credit'     => $paidAmount,
                        'IsPosted'   => 1,
                        'created_by' => auth()->user()->id,
                        'IsAppove'   => 1,
                        'location_id' => $this->location,
                    ])
                );

                // Cash in Hand debit for paid amount
                //we will undo when bank module is ready
                $invoice->transactions()->save(
                    new Transaction([
                        'Vtype'      => 'INV',
                        'VDate'      => $request->date,
                        'COAID'      => $paymentAccountHeadCode,
                        'Narration'  => $paymentAccountHeadName . ' Debit for Customer ' . $customerName . ' Receiving Against Invoice # ' . $invoice->invoice_no,
                        'Debit'      => $paidAmount,
                        'Credit'     => 0,
                        'IsPosted'   => 1,
                        'created_by' => auth()->user()->id,
                        'IsAppove'   => 1,
                        'location_id' => $this->location,
                    ])
                );
            }
        }

        if ($request->doPrint == 1) {
            return redirect()->route('dashboard.accounts.sale.invoice', $invoice->id)->with('page_title', 'Sales Invoice');
        } else {
            return redirect()->route('dashboard.accounts.sale.index')->with('success', trans('accounts.messages.created_sale_msg'));
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
            __('accounts.general.dashboard') => route('dashboard'),
            __('accounts.sale.manage_sale') => route('dashboard.accounts.sale.index'),
            __('accounts.sale.modify_sale') => ''
        ]);

        $page_title = __('accounts.sale.modify_sale');

        $tax = Tax::where('location_id', $this->location)->orderBy('tax_name', 'ASC')->pluck('tax_name', 'id');
        $customer = $this->customer->where('location_id', $this->location)->orderBy('customer_name', 'ASC')->pluck('customer_name','id');
        $model = $this->model->with('invoiceDetails.product')->where('location_id', $this->location)->findorFail($id);
        $paymentTypes = [1 => 'Cash Payment'];
        $paymentAccounts = AccountHead::whereHas('pettycash', function($query) {
            if (auth()->user()->id > 1) {
                $query->where('id', auth()->user()->id);
            }
        })->orWhere('HeadCode', 'like', 102010 . '%')
            ->where('HeadCode', '!=', 1020102)
            ->pluck('HeadName','HeadCode');

        return view('dashboard.accounts.sale.edit_sale_form',compact('page_title', 'breadcrumbs','customer','model', 'tax','paymentTypes','paymentAccounts'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('edit', $this->model);

        $this->model->where('location_id', $this->location)->findorFail($id)->update($request->all());
        $invoice = $this->model->where('location_id', $this->location)->find($id);

        if ($invoice) {
            $invoice->updated_by = auth()->user()->id;
            $invoice->save();

            $this->transaction->where('VNo',$id)->where('Vtype','INV')
                ->where('location_id', $this->location)->delete();
            $invoice->invoiceDetails()->delete();
            $invoice->invoice2Details()->delete();

            $invPrice = 0;

            if ($request->has('invoiceItem')) {
                $invoiceItems = $request->input('invoiceItem', array());
                $count = $invoiceItems['name'];
                if (count($invoiceItems) > 0) {
                    foreach ($count as $key => $value) {
                        $productId = $invoiceItems['id'][$key];
                        $description = $invoiceItems['desc'][$key];
                        $quantity = $invoiceItems['qty'][$key];
                        $supplier_rate = $invoiceItems['supplier_rate'][$key];
                        $rate = $invoiceItems['rate'][$key];
                        $discountAmount = $invoiceItems['discount_amount'][$key];
                        $discountPercentage = $invoiceItems['discount'][$key];
                        $taxPercentage = $invoiceItems['tax'][$key];
                        $taxAmount = $invoiceItems['tax_amount'][$key];
                        $total = str_replace(',', '', $invoiceItems['total'][$key]);

                        $data = \QueryHelper::po_wise_stock($quantity, $productId);
                        foreach ($data as $d) {
                            $temp = $d->rate * $d->split_quantity;
                            $invPrice += $temp;

                            $invoice->invoice2Details()->save(
                                new Invoice2Detail([
                                    'product_id' => $d->product_id,
                                    'quantity' => $d->split_quantity,
                                    'po_id' => $d->id,
                                    'po_rate' => $d->rate,
                                    'rate' => $rate,
                                    'location_id' => $this->location,
                                ])
                            );
                        }
                        $invoice->invoiceDetails()->save(
                            new InvoiceDetail([
                                'product_id' => $productId,
                                'description' => $description,
                                'quantity' => $quantity,
                                'supplier_rate' => $supplier_rate,
                                'rate' => $rate,
                                'discount' => $discountAmount,
                                'discount_per' => $discountPercentage,
                                'tax_p' => $taxPercentage,
                                'tax_amount' => $taxAmount,
                                'total_price' => $total,
                                'status' => 1,
                                'location_id' => $this->location,
                            ])
                        );
                    }
                }
            }

            $headCode = AccountHead::where('customer_id', $request->customer_id)->value('HeadCode');
            $customerName = $this->customer->getCustomerName($request->customer_id);

            $paymentAccountHeadCode = $request->payment_account;
            $paymentAccountHeadName = AccountHead::where('HeadCode', $paymentAccountHeadCode)->value('HeadName');

            $totalAmount = str_replace(',', '', $request->net_total);
            $paidAmount = str_replace(',', '', $request->paid_amount);
            //Product Sale Head debit for net total
            $invoice->transactions()->save(
                new Transaction([
                    'Vtype'      => 'INV',
                    'VDate'      => $request->date,
                    'COAID'      => 303,
                    'Narration'  => 'Product Sale Debit For Invoice # ' . $invoice->invoice_no,
                    'Debit'      => $totalAmount,
                    'Credit'     => 0,
                    'IsPosted'   => 1,
                    'created_by' => auth()->user()->id,
                    'updated_by' => auth()->user()->id,
                    'IsAppove'   => 1,
                    'location_id' => $this->location,
                ])
            );
            //Inventory credit with fifo Price
            $invoice->transactions()->save(
                new Transaction([
                    'Vtype'      => 'INV',
                    'VDate'      => $request->date,
                    'COAID'      => 10107,
                    'Narration'  => 'Inventory Credit For Invoice # ' . $invoice->invoice_no,
                    'Debit'      => 0,
                    'Credit'     => $invPrice,//purchase price asbe
                    'IsPosted'   => 1,
                    'created_by' => auth()->user()->id,
                    'updated_by' => auth()->user()->id,
                    'IsAppove'   => 1,
                    'location_id' => $this->location,
                ])
            );
            //Customer debit for net total
            $invoice->transactions()->save(
                new Transaction([
                    'Vtype'      => 'INV',
                    'VDate'      => $request->date,
                    'COAID'      => $headCode,
                    'Narration'  => 'Customer ' . $customerName . ' Debit For Invoice # ' . $invoice->invoice_no,
                    'Debit'      => $totalAmount, // - (!empty($request->previous) ? $request->previous : 0),
                    'Credit'     => 0,
                    'IsPosted'   => 1,
                    'created_by' => auth()->user()->id,
                    'updated_by' => auth()->user()->id,
                    'IsAppove'   => 1,
                    'location_id' => $this->location,
                ])
            );

            if ($request->has('paid_amount') && $request->get('paid_amount') > 0) {
                //Customer credit for paid amount
                $invoice->transactions()->save(
                    new Transaction([
                        'Vtype'      => 'INV',
                        'VDate'      => $request->date,
                        'COAID'      => $headCode,
                        'Narration'  => 'Customer ' . $customerName . ' Credit for Paid Amount of Invoice # ' . $invoice->invoice_no,
                        'Debit'      => 0,
                        'Credit'     => $paidAmount,
                        'IsPosted'   => 1,
                        'created_by' => auth()->user()->id,
                        'updated_by' => auth()->user()->id,
                        'IsAppove'   => 1,
                        'location_id' => $this->location,
                    ])
                );

                // Cash in Hand debit for paid amount
                //we will undo when bank module is ready
                $invoice->transactions()->save(
                    new Transaction([
                        'Vtype'      => 'INV',
                        'VDate'      => $request->date,
                        'COAID'      => $paymentAccountHeadCode,
                        'Narration'  => $paymentAccountHeadName . ' Debit for Customer ' . $customerName . ' Receiving Against Invoice # ' . $invoice->invoice_no,
                        'Debit'      => $paidAmount,
                        'Credit'     => 0,
                        'IsPosted'   => 1,
                        'created_by' => auth()->user()->id,
                        'updated_by' => auth()->user()->id,
                        'IsAppove'   => 1,
                        'location_id' => $this->location,
                    ])
                );
            }

        }

        if ($request->doPrint == 1) {
            return redirect()->route('dashboard.accounts.sale.invoice',$invoice->id)->with('page_title', 'Sales Invoice');
        } else {
            return redirect()->route('dashboard.accounts.sale.index')->with('success', trans('accounts.messages.updated_sale_msg'));
        }
    }

    public function destroy($id)
    {
        $this->authorize('delete', $this->model);

        $invoice = $this->model->where('location_id', $this->location)->findorFail($id);
        $invoice->invoiceDetails()->delete();
        $invoice->invoice2Details()->delete();
        $this->transaction->where('VNo',$id)->where('Vtype','INV')
            ->where('location_id', $this->location)->delete();
        $invoice->delete();

        return redirect()->route('dashboard.accounts.sale.index')->with('success', trans('accounts.messages.deleted_sale_msg'));
    }

    public function SaleInvoice($id)
    {
        $this->authorize('viewInvoice', $this->model);

        $breadcrumbs = collect([
            __('accounts.general.dashboard') => route('dashboard'),
            __('accounts.sale.manage_sale') => route('dashboard.accounts.sale.index'),
            __('accounts.sale.sale_invoice') => ''
        ]);

        $page_title = __('accounts.sale.sale_invoice');

        $invoice = $this->model->where('location_id', $this->location)->with('invoiceDetails.product')->findorFail($id);
        $customer = $this->customer->findorFail($invoice->customer_id);
        return view('dashboard.accounts.sale.invoice',compact('page_title','breadcrumbs','customer','invoice'));

    }
}
