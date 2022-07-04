<?php

namespace App\Http\Controllers\Dashboard;
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
        $pageTittle = "Manage category";
        $data = Category::orderBy('name', 'ASC')->paginate(12);
       
        $page_title = "Category List";
        return view('dashboard.products.category_table',compact('page_title','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    

        $page_title = "Create New Category";
        return view('dashboard.products.add_category',compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Category::create([
            'name' => $request->name,
            'status' => $request->status
            
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
        

        $pageTittle = 'Edit Category';
        $category = Category::findorFail($id);
        $page_title = "Modify Category";
        return view('dashboard.products.edit_category',compact('page_title','category'));
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
       

        $category = Category::findorFail($id);
        $category->fill([
            'name' => $request->name,
            'status' => $request->status
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

        $category = Category::findorFail($id);
        $category->delete();
        return redirect()->route('dashboard.accounts.category.index')->with('success', trans('accounts.messages.deleted_category_msg'));
    }
}
