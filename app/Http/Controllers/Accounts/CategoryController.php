<?php

namespace App\Http\Controllers\Accounts;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Category;

class CategoryController extends Controller
{
    public $model;
    private $location;

    function __construct(Category $category)
    {
        $this->middleware('auth');
        $this->model = $category;
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
        $this->authorize('view', $this->model);
        $pageTittle = "Manage category";
        $data = Category::where('type','!=','fix_assets')
            ->where('location_id', $this->location)
            ->orderBy('name', 'ASC')->paginate(12);
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Category List' => '',

        ]);

        $page_title = "Category List";
        return view('dashboard.accounts.products.category_table',compact('page_title', 'breadcrumbs','pageTittle','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', $this->model);

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Category List' => route('dashboard.accounts.category.index'),
            'Create New Category' => ''
        ]);

        $page_title = "Create New Category";
        return view('dashboard.accounts.products.add_category',compact('page_title', 'breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', $this->model);

        Category::create([
            'name' => $request->name ?? "",
            'status' => $request->status ?? "",
            'location_id' => $this->location,
        ]);

        if ($request->saveNew == 1) {
            return redirect()->route('dashboard.accounts.category.create')->with('success', trans('accounts.messages.created_category_msg'));
        } else {
            return redirect()->route('dashboard.accounts.category.index')->with('success', trans('accounts.messages.created_category_msg'));
        }
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
    public function edit(Request $request,$id)
    {
        $this->authorize('edit', $this->model);

        $pageTittle = 'Edit Category';
        $category = Category::where('location_id', $this->location)->findorFail($id);

        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Category List' => route('dashboard.accounts.category.index'),
            'Modify Category' => ''
        ]);

        $page_title = "Modify Category";
        return view('dashboard.accounts.products.edit_category',compact('page_title', 'breadcrumbs',
        'category','pageTittle'));
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
        $this->authorize('edit', $this->model);

        $category = Category::where('location_id', $this->location)->findorFail($id);
        $category->fill([
            'name' => $request->name ?? "",
            'status' => $request->status ?? ""
        ])->save();
        return redirect()->route('dashboard.accounts.category.index')->with('success', trans('accounts.messages.updated_category_msg'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', $this->model);

        $category = Category::where('location_id', $this->location)->findorFail($id);
        $category->delete();
        return redirect()->route('dashboard.accounts.category.index')->with('success', trans('accounts.messages.deleted_category_msg'));
    }
}
