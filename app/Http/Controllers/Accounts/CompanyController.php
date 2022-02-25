<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Traits\General;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

use App\Models\Company;

class CompanyController extends Controller
{
    public $model;
    use General;

    public function __construct(Company $company){
        $this->middleware('auth');
        $this->model = $company;
    }

    public function index()
    {
        $this->authorize('view', $this->model);

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            __('accounts.company.manage_company') => '',
        ]);

        $page_title = __('accounts.company.manage_company');

        $companies = $this->model::all();
        return view('dashboard.accounts.company.manage_company',compact('page_title', 'breadcrumbs', 'companies'));
    }


    public function create()
    {
        abort(404);

        $this->authorize('create', $this->model);

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            __('accounts.company.manage_company') => route('dashboard.accounts.companies.index'),
            __('accounts.company.new_company') => ''
        ]);

        $page_title = __('accounts.company.new_company');

        $companyID = \AccountHelper::generator(5);
        return view('dashboard.accounts.company.add_company',compact('page_title', 'breadcrumbs', 'companyID'));
    }

    public function store(Request $request)
    {
        abort(404);

        $this->authorize('create', $this->model);

        $this->makeDirectory('companies');

        $this->model = $this->model->create([
            'company_name' => $request->company_name,
            'gstn' => $request->gstn,
            'email' => $request->email,
            'website' => $request->website,
            'mobile' => $request->mobile,
            'phone' => $request->phone,
            'address' => $request->address,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
            'status' => 1
        ]);

        if ($request->file('logo')) {
            $file = $request->file('logo');
            $name = sha1('img' . $this->model->id . time()) . '.' . $file->getClientOriginalExtension();
            $image = Image::make($file);
            $image->save(public_path('uploads/companies/') . $name);
            $this->model->logo = 'uploads/companies/' . $name;
            $this->model->save();
        }

        return redirect()->route('dashboard.accounts.companies.index')->with('success', trans('accounts.messages.created_company_msg'));

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
            __('accounts.company.manage_company') => route('dashboard.accounts.companies.index'),
            __('accounts.company.modify_company') => ''
        ]);

        $page_title = __('accounts.company.modify_company');

        $company = $this->model->where('id',$id)->first();
        return view('dashboard.accounts.company.edit_company',compact('page_title', 'breadcrumbs', 'company'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('edit', $this->model);

        $this->model = $this->model->findorfail($id);
        $old_logo = $this->model->logo;

        $this->model->fill([
            'company_name' => $request->company_name,
            'gstn' => $request->gstn,
            'email' => $request->email,
            'website' => $request->website,
            'mobile' => $request->mobile,
            'phone' => $request->phone,
            'address' => $request->address,
            'updated_by' => auth()->user()->id,
            'status' => 1
        ])->save();

        if ($request->file('logo')) {
            if (file_exists($old_logo)) {
                unlink ($old_logo);
            }
            $file = $request->file('logo');
            $name = sha1('img' . $this->model->id . time()) . '.' . $file->getClientOriginalExtension();
            $image = Image::make($file);
            $image->save(public_path('uploads/companies/') . $name);
            $this->model->logo = 'uploads/companies/' . $name;
            $this->model->save();
        }

        return redirect()->route('dashboard.accounts.companies.index')->with('success', trans('accounts.messages.updated_company_msg'));
    }

    public function destroy($id)
    {
        abort(404);
        $this->authorize('delete', $this->model);

        $company = $this->model->findorfail($id);
        $company->delete();
        return redirect()->route('dashboard.accounts.companies.index')->with('success', trans('accounts.messages.deleted_company_msg'));
    }
}
