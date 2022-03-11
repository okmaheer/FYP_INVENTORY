<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use App\Traits\General;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    use General;
    public $model;
    

    function __construct(Product $product)
    {
        $this->middleware('auth');
        $this->model = $product;
        $this->middleware(function ($request, $next){
           
            return $next($request);
        });
    }

    /**
     * List of all Products
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function index()
    {
    
        $page_title = trans('accounts.products.list');
        $data = $this->model->orderBy('product_name', 'ASC')->get();


        $page_title = "Manage Products";
        return view('dashboard.products.index', compact('page_title','data', 'page_title'));
    }

    /**
     * Create new Product
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function create()
    {
       
        $page_title = trans('accounts.products.add_product');
        $categories = Category::orderBy('name', 'ASC')->pluck('name', 'id');
        $units = Unit::orderBy('unit_name', 'ASC')->pluck('unit_name', 'id');
        return view('dashboard.products.create', compact('page_title', 'categories', 'units','page_title'));
    }

    /**
     * Create Using CSV
     * @return Application|Factory|View
     */
    public function csv()
    {

        return view('dashboard.accounts.products.add_product_csv');
    }

    /**
     * Store Product
     * @param Request $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function store(Request $request): RedirectResponse
    {
       
        $this->makeDirectory('products');

        $this->model = $this->model->create([
            'barcode' => $request->barcode,
            'product_name' => $request->product_name,
            'serial_no' => $request->serial_no,
            'model' => $request->model,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'unit' => $request->unit_id,
            'description' => $request->description,
           
        ]);

        if ($request->file('image')) {
            $file = $request->file('image');
            $name = sha1('img' . $this->model->id . time()) . '.' . $file->getClientOriginalExtension();
            $image = Image::make($file);
            $image->save(public_path('uploads/products/') . $name);
            $this->model->image = 'uploads/products/' . $name;
            $this->model->save();
        }

   

        if ($request->saveNew) {
            return redirect()->route('dashboard.accounts.products.create')->with('success', trans('accounts.messages.created_product_msg'));
        } else {
            return redirect()->route('dashboard.accounts.products.index')->with('success', trans('accounts.messages.created_product_msg'));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $categories = Category::orderBy('name', 'ASC')->pluck('name', 'id');
        $units = Unit::orderBy('unit_name', 'ASC')->pluck('unit_name', 'id');
         
        // $this->authorize('create', Supplier::class);
        $product = Product::findorFail($id);
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Products' => route('dashboard.accounts.products.index'),
            'Modify Product' => ''
        ]);

        $page_title = "Modify Product";
        return view('dashboard.products.edit_product', compact('page_title', 'breadcrumbs','categories', 'units', 'product'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
       
        $product = $productData = $suppliers = [];

        $this->model = $this->model->findorFail($id);
        $this->model->fill([
            'barcode' => $request->barcode,
            'product_name' => $request->product_name,
            'serial_no' => $request->serial_no,
            'model' => $request->model,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'unit' => $request->unit,
            'description' => $request->description
        ])->save();

        if ($request->file('image')) {
            $file = $request->file('image');
            $name = sha1('img' . $this->model->id . time()) . '.' . $file->getClientOriginalExtension();
            $image = Image::make($file);
            $image->save(public_path('uploads/products/') . $name);
            $this->model->image = 'uploads/products/' . $name;
            $this->model->save();
        }

        // $suppliers = $request->supplier_id;

        // DB::table('supplier_products')->where('product_id',$id)->delete();

        // for ($i = 0, $n = count($suppliers); $i < $n; $i++) {
        //     $supplierId = $request->supplier_id[$i];
        //     $supplierPrice = $request->supplier_price[$i];
        //     $this->model->suppliers()->attach($supplierId, ['supplier_price' => $supplierPrice]);
        // }

        return redirect()->route('dashboard.accounts.products.index')->with('success', trans('accounts.messages.updated_product_msg'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {

        $product = Product::findorFail($id);
        $product->delete();
        return redirect()->route('dashboard.accounts.products.index')->with('success', trans('accounts.messages.deleted_product_msg'));
    }

    /**
     * Get Products for autocomplete
     */
    public function productAutocompleteData(Request $request)
    {
        if ($request->has("type") && $request->get('type') == 'sale' ) {
            $product = Product::whereHas('category',function ($query) use ($request) {
                $query->whereStatus(1);
            })
                
                ->where('product_name', 'LIKE', '%' . $request->product_name . '%')
                ->orderBy('product_name', 'ASC')->get();
        }
        elseif ($request->has("supplier_id") && $request->get('supplier_id') > 0){
            $product = Product::whereHas('suppliers', function ($query) use ($request) {
                $query->where('supplier_id', $request->supplier_id);
            })
                
                ->where('product_name', 'LIKE', '%' . $request->product_name . '%')
                ->orderBy('product_name', 'ASC')->get();
        }
        else {
            $product = Product::where('product_name', 'LIKE', '%' . $request->product_name . '%')
                
                ->orderBy('product_name', 'ASC')->get();
        }
        $json_product = [];
        if (!$product->isEmpty()) {
            foreach ($product as $value) {
                $json_product[] = array('label' => $value['product_name'], 'value' => $value['id']);
            }
        } else {
            $json_product[] = 'No Product Found';
        }

        return $json_product;

    }

    public function retrieveProductData(Request $request)
    {
        /*
         * get data from pivot table
         */
        if ($request->has("supplier_id") && $request->get('supplier_id') > 0) {
            $products = Product::with(['purchaseDetail', 'suppliers' => function ($query) use ($request) {
                $query->where("supplier_id", $request->supplier_id);
            }])
                
                ->where('id', $request->product_id)->first();
        } else {
            $products = Product::with('purchaseDetail')->where('id', $request->product_id)->first();
        }

        $saleQuantity = 0;
        $saleProducts = Product::with('invoice2Details')->where('id', $request->product_id)
            
            ->first();
        foreach ($saleProducts->invoice2Details as $qty) {
            $saleQuantity += $qty->quantity;
        }


        $purchaseQuantity = 0;
        foreach ($products->purchaseDetail as $qty) {
            $purchaseQuantity += $qty->quantity;
        }


        $data2 = array(
            'total_product' => $purchaseQuantity - $saleQuantity,
            // 'supplier_price' => $products->suppliers[0]->supplier_price,
            'supplier_price' => $products->price,
            'price' => $products->price,
            'supplier_id' => 0
        );


        return json_encode($data2);

    }



    
}
