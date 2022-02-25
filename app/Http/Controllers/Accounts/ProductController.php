<?php

namespace App\Http\Controllers\Accounts;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Unit;
use App\Traits\General;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    use General;
    public $model;
    private $location;

    function __construct(Product $product)
    {
        $this->middleware('auth');
        $this->model = $product;
        $this->middleware(function ($request, $next){
            $this->location = session(SessionEnum::SESSION_LOCATION_ID);
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
        $this->authorize('view', $this->model);

        $page_title = trans('accounts.products.list');
        $data = $this->model->where('location_id', $this->location)->orderBy('product_name', 'ASC')->get();
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Products' => '',
        ]);

        $page_title = "Manage Products";
        return view('dashboard.accounts.products.index', compact('page_title', 'breadcrumbs','data', 'page_title'));
    }

    /**
     * Create new Product
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', $this->model);
        $page_title = trans('accounts.products.add_product');
        $supplier = Supplier::orderBy('supplier_name', 'ASC')->where('location_id', $this->location)->pluck('supplier_name', 'id');
        $categories = Category::whereStatus('1')->where('location_id', $this->location)->orderBy('name', 'ASC')->pluck('name', 'id');
        $units = Unit::whereStatus('1')->where('location_id', $this->location)->orderBy('unit_name', 'ASC')->pluck('unit_name', 'id');
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Products' => route('dashboard.accounts.products.index'),
            'Create New Product' => ''
        ]);

        return view('dashboard.accounts.products.create', compact('page_title', 'breadcrumbs','supplier', 'categories', 'units','page_title'));
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
        $this->authorize('create', $this->model);
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
            'location_id' => $this->location,
        ]);

        if ($request->file('image')) {
            $file = $request->file('image');
            $name = sha1('img' . $this->model->id . time()) . '.' . $file->getClientOriginalExtension();
            $image = Image::make($file);
            $image->save(public_path('uploads/products/') . $name);
            $this->model->image = 'uploads/products/' . $name;
            $this->model->save();
        }

        $suppliers = $request->supplier_id;
        if (count($suppliers) > 0) {
            for ($i = 0, $n = count($suppliers); $i < $n; $i++) {
                $supplierId = $request->supplier_id[$i];
                $supplierPrice = $request->supplier_price[$i];
                $this->model->suppliers()->attach($supplierId, ['supplier_price' => $supplierPrice]);
            }
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
        $this->authorize('edit', $this->model);

        $supplier = Supplier::orderBy('supplier_name', 'ASC')->where('location_id', $this->location)->pluck('supplier_name', 'id');
        $categories = Category::whereStatus('1')->where('location_id', $this->location)->orderBy('name', 'ASC')->pluck('name', 'id');
        $units = Unit::whereStatus('1')->where('location_id', $this->location)->orderBy('unit_name', 'ASC')->pluck('unit_name', 'id');

        $product = Product::where('location_id', $this->location)->findorFail($id);
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Manage Products' => route('dashboard.accounts.products.index'),
            'Modify Product' => ''
        ]);

        $page_title = "Modify Product";
        return view('dashboard.accounts.products.edit_product', compact('page_title', 'breadcrumbs',
            'supplier', 'categories', 'units', 'product'));

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
        $this->authorize('edit', $this->model);

        $product = $productData = $suppliers = [];

        $this->model = $this->model->where('location_id', $this->location)->findorFail($id);
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
        $this->authorize('delete', $this->model);

        $product = Product::where('location_id', $this->location)->findorFail($id);
        $product->delete();
        return redirect()->route('dashboard.accounts.products.index');
    }

    /**
     * Get Products for autocomplete
     */
    public function productAutocompleteData(Request $request)
    {
        if ($request->has("type") && $request->get('type') == 'sale' ) {
            $product = Product::whereHas('category',function ($query) use ($request) {
                    $query->whereStatus(1);
                    $query->whereType("fix_assets");
                })
                ->where('location_id', $this->location)
                ->where('product_name', 'LIKE', '%' . $request->product_name . '%')->get();
        }
        elseif ($request->has("supplier_id") && $request->get('supplier_id') > 0){
            $product = Product::whereHas('suppliers', function ($query) use ($request) {
                $query->where('supplier_id', $request->supplier_id);
            })
                ->where('location_id', $this->location)
                ->where('product_name', 'LIKE', '%' . $request->product_name . '%')
                ->orderBy('product_name', 'ASC')->get();
        }
        else {
            $product = Product::whereHas('category',function ($query) use ($request) {
                $query->whereStatus(1);
                $query->whereIn("categories.type", ["raw_materials", "fix_assets"]);
            })
            ->where('location_id', $this->location)
            ->where('product_name', 'LIKE', '%' . $request->product_name . '%')->paginate(10);
        }
        $json_product = [];
        if (!$product->isEmpty()) {
            foreach ($product as $value) {
                $json_product[] = array('label' => $value['product_name'], 'value' => $value['id']);
            }
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
                ->where('location_id', $this->location)
                ->where('id', $request->product_id)->first();
        } else {
            $products = Product::with('purchaseDetail')->where('id', $request->product_id)->first();
        }

        $saleQuantity = 0;
        $saleProducts = Product::with('invoice2Details')->where('id', $request->product_id)
            ->where('location_id', $this->location)
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

        if ($request->has("supplier_id") && $request->get('supplier_id') > 0) {
            $data2['supplier_price'] = $products->suppliers[0]->supplier_price;
        } else {
            $data2['supplier_price'] = 0;
        }

        return json_encode($data2);

    }



    public function productAddAjax(Request $request){

        $this->authorize('create', Product::class);
        $product = $productData = $suppliers = [];
        $output = ['success' => false, 'msg' => ''];
        if (Auth::user()->can('create', $this->model)) {
            $this->makeDirectory('products');

            DB::beginTransaction();
            try {
                $product = $this->model->create($request->all());
                $product->created_by = auth()->user()->id;
                $product->location_id = $this->location;
                $product->save();

                DB::commit();
                $output = ['success' => true, 'msg' => 'Product created successfully!', 'product' => $product];

            } catch (\Exception $e) {
                DB::rollback();
                $output = ['success' => false, 'msg' => $e->getMessage()];
            }
        } else {
            $output['msg'] = 'You are not allowed to perform this action.';
        }
        return $output;
    }
}
