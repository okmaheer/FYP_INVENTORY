<?php

namespace App\Http\Controllers\Marquee;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Marquee\Menu;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MenuController extends Controller
{

    protected $model = null;
    private $location;

    public function __construct(Menu $model)
    {
        $this->middleware('auth');
        $this->model = $model;
        $this->middleware(function ($request, $next){
            $this->location = session(SessionEnum::SESSION_LOCATION_ID);
            return $next($request);
        });
    }

    public function index()
    {
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'All Menus' => '',
        ]);
        $page_title = 'All Menus';

        $data = $this->model->where('location_id', $this->location)->get();

        return view('dashboard.marquee.menu.index', compact('data', 'page_title', 'breadcrumbs'));
    }

    public function create()
    {
        $categories = Category::where('location_id', $this->location)->with('products')->whereType('menu')->get();
        $page_title = 'Create New Menu';
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'All Menus' => route('dashboard.marquee.menu.index'),
            'Create New Menu' => ''
        ]);

        return view('dashboard.marquee.menu.create', compact('page_title', 'breadcrumbs', 'categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        /*$request->validate([
            'menu_no' => 'required|unique:menu,menu_no',
            'menu_name' => 'required|unique:menu,menu_name'
        ]);*/

        $this->model = $this->model->create($request->all());
        if ($this->model) {
            $this->model->created_by = auth()->user()->id;
            $this->model->updated_by = auth()->user()->id;
            $this->model->location_id =  $this->location;
            $this->model->save();

            if ($request->has('products')) {
                //$this->model->products()->sync($request->get('products', array()));
                $products = $request->input('products', array());
                $count = $products['name'];
                if (count($count) > 0) {
                    foreach ($count as $key => $value) {
                        $product_id = $products['id'][$key];
                        if ($product_id != '') {
                            $quantity = $products['quantity'][$key];
                            $price = $products['price'][$key];
                            $total  = $products['total_amount'][$key];

                            DB::table('menu_products')->insert([
                                'product_id' => $product_id,
                                'menu_id' => $this->model->id,
                                'quantity' => $quantity,
                                'price' => $price,
                                'total' => $total,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now()
                            ]);
                        }
                    }
                }
            }
        }
        if ($request->saveNew == 1) {
            return redirect()->route('dashboard.marquee.menu.create')->with('success', 'Menu Created Successfully');
        } else {
            return redirect()->route('dashboard.marquee.menu.index')->with('success', 'Menu Created Successfully');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit(int $id)
    {
        //$products = Category::with('products')->whereType('menu')->get();
        $model = $this->model->where('location_id', $this->location)->with('menuItems')->findorFail($id);
        $page_title = 'Edit Menu';
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'All Menus' => route('dashboard.marquee.menu.index'),
            'Edit Menu' => ''
        ]);
        return view('dashboard.marquee.menu.edit', compact('page_title', 'breadcrumbs','model'));
    }

    public function update(Request $request, int $id)
    {

        $this->model->where('location_id', $this->location)->findorFail($id)->update($request->all());
        if ($this->model) {

            $this->model = $this->model->where('location_id', $this->location)->find($id);
            $this->model->updated_by = auth()->user()->id;
            $this->model->save();

            DB::table('menu_products')->where('menu_id', $this->model->id)->delete();

            if ($this->model) {

                if ($request->has('products')) {
                    //$this->model->products()->sync($request->get('products', array()));
                    $products = $request->input('products', array());
                    $count = $products['name'];
                    if (count($count) > 0) {
                        foreach ($count as $key => $value) {
                            $product_id = $products['id'][$key];
                            if ($product_id != '') {
                                $quantity = $products['quantity'][$key];
                                $price = $products['price'][$key];
                                $total  = $products['total_amount'][$key];

                                DB::table('menu_products')->insert([
                                    'product_id' => $product_id,
                                    'menu_id' => $id,
                                    'quantity' => $quantity,
                                    'price' => $price,
                                    'total' => $total,
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now()
                                ]);
                            }
                        }
                    }
                }
            }
        }
        return redirect()->route('dashboard.marquee.menu.index')->with('success', 'Menu Updated Successfully');
    }

    public function destroy($id): RedirectResponse
    {
        $this->model->where('location_id', $this->location)->findorFail($id);
        if ($this->model) {
            DB::table('menu_products')->where('menu_id', $this->model->id)->delete();
            $this->model->delete();
        }
        return redirect()->route('dashboard.marquee.menu.index')->with('success', 'Menu Removed Successfully');
    }
}
