<?php

namespace App\Http\Controllers\Accounts;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    protected $model = null;
    private $location;

    public function __construct(Tax $tax)
    {
        $this->middleware('auth');
        $this->model = $tax;
        $this->middleware(function ($request, $next){
            $this->location = session(SessionEnum::SESSION_LOCATION_ID);
            return $next($request);
        });
    }


    public function setting()
    {

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Income Tax' => route('dashboard.accounts.income_tax.index'),
            'Tax Setting' => ''
        ]);

        $page_title = "Tax Setting";

        return view('dashboard.accounts.Tax.tax_setting', compact('page_title', 'breadcrumbs'));
    }
    public function TaxReport()
    {
        //
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Income Tax' => route('dashboard.accounts.income_tax.index'),
            'Tax Report' => ''
        ]);

        $page_title = "Tax Report";
        return view('dashboard.accounts.Tax.tax_report',compact('page_title', 'breadcrumbs',
    ));
    }
    public function InvoiceWise()
    {
        //
         //
         $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Income Tax' => route('dashboard.accounts.income_tax.index'),
            'Invoice Wise Tax Report' => ''
        ]);

        $page_title = "Invoice Wise Tax Report";
        return view('dashboard.accounts.Tax.invoice_wise_tax_report',compact('page_title', 'breadcrumbs',));
    }

    public function index()
    {
        $this->authorize('view', $this->model);

        $breadcrumbs = collect([
            __('accounts.general.dashboard') => route('dashboard'),
            __('accounts.tax.manage_tax') => '',
        ]);
        $page_title = __('accounts.tax.manage_tax');
        $taxes = $this->model->where('location_id', $this->location)->orderBy('tax_name', 'ASC')->get();
        return view('dashboard.accounts.Tax.manage_tax', compact('page_title', 'breadcrumbs', 'taxes'));

    }

    public function create()
    {
        $this->authorize('create', $this->model);

        $breadcrumbs = collect([
            __('accounts.general.dashboard') => route('dashboard'),
            __('accounts.tax.manage_tax') => route('dashboard.accounts.tax.index'),
            __('accounts.tax.add_tax') => ''
        ]);
        $page_title = __('accounts.tax.add_tax');
        return view('dashboard.accounts.Tax.create', compact('page_title', 'breadcrumbs'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', $this->model);

        $this->model = $this->model->create($request->all());
        if ($this->model) {
            $this->model->created_by = auth()->user()->id;
            $this->model->location_id = $this->location;
            $this->model->save();

            return redirect()->route('dashboard.accounts.tax.index')->with('success', __('accounts.messages.created_tax_msg'));
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
            __('accounts.tax.manage_tax') => route('dashboard.accounts.tax.index'),
            __('accounts.tax.modify_tax') => ''
        ]);
        $page_title = __('accounts.tax.modify_tax');

        $model = $this->model->where('location_id', $this->location)->findorFail($id);

        return view('dashboard.accounts.Tax.edit', compact('page_title', 'breadcrumbs', 'model'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('edit', $this->model);

        $this->model->where('location_id', $this->location)->findorFail($id)->update($request->all());
        $this->model = $this->model->where('location_id', $this->location)->find($id);

        $this->model->updated_by = auth()->user()->id;
        $this->model->save();

        return redirect()->route('dashboard.accounts.tax.index')->with('success', __('accounts.messages.updated_tax_msg'));
    }

    public function destroy($id)
    {
        $this->authorize('delete', $this->model);

        $tax = $this->model->where('location_id', $this->location)->findorFail($id);
        $tax->delete();

        return redirect()->route('dashboard.accounts.tax.index')->with('success', trans('accounts.messages.deleted_tax_msg'));
    }

    public function ApiTaxDetails(Request $request) {
        if ($request->ajax()) {
            $tax_id = $request->taxID;
            $tax = $this->model->where('location_id', $this->location)->whereStatus(1)->find($tax_id);
            if ($tax) {
                $output = ['success' => true,
                    'msg' => '', 'data' => $tax
                ];
            } else {
                $output = ['success' => false,
                    'msg' => __("accounts.messages.something_went_wrong")
                ];
            }
        } else {
            $output = ['success' => false,
                'msg' => __("accounts.messages.invalid_request")
            ];
        }

        return $output;
    }
}
