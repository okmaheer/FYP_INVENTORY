<?php

namespace App\Http\Controllers;

use App\Enum\SessionEnum;
use App\Models\Customer;
use App\Models\Marquee\AddOnFeature;
use App\Models\Marquee\Booking;
use App\Models\Marquee\ExtraFoodItem;
use App\Models\Marquee\Stage;
use App\Models\Marquee\Menu;
use App\Models\Marquee\SeatPlanning;
use App\Models\Marquee\StageDecoration;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AutocompleteController extends Controller
{

    private $location;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next){
            $this->location = session(SessionEnum::SESSION_LOCATION_ID);
            return $next($request);
        });
    }
    /**
     * @param Request $request
     * @return array
     */
    public function seatingPlannings(Request $request): array
    {
        $data = SeatPlanning::where('location_id', $this->location)->where('name', 'LIKE', '%' . $request->get('d') . '%')->get();
        $json = [];
        if (count($data) > 0) {
            foreach ($data as $d) {
                $json[] = array('label' => $d->name, 'value' => $d->id, 'extra' => [
                    'price' => $d->price
                ]);
            }
        }
        return $json;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function addOnFeatures(Request $request): array
    {
        $data = AddOnFeature::where('location_id', $this->location)->where('name', 'LIKE', '%' . $request->get('d') . '%')->get();
        $json = [];
        if (count($data) > 0) {
            foreach ($data as $d) {
                $json[] = array('label' => $d->name, 'value' => $d->id, 'extra' => [
                    'price' => $d->price
                ]);
            }
        }
        return $json;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getExtraFoodItems(Request $request): array
    {
        $data = ExtraFoodItem::where('name', 'LIKE', '%' . $request->get('d') . '%')->get();
        $json = [];
        if (count($data) > 0) {
            foreach ($data as $d) {
                $json[] = array('label' => $d->name, 'value' => $d->id, 'extra' => [
                    'price' => $d->price
                ]);
            }
        }
        return $json;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function stageDecorations(Request $request): array
    {
        $data = StageDecoration::where('location_id', $this->location)->where('name', 'LIKE', '%' . $request->get('d') . '%')->get();
        $json = [];
        if (count($data) > 0) {
            foreach ($data as $d) {
                $json[] = array('label' => $d->name, 'value' => $d->id, 'extra' => [
                    'price' => $d->price
                ]);
            }
        }
        return $json;
    }

    /**
     * Get Menu based on Category
     * @param Request $request
     * @return array
     */
    public function getMenus(Request $request): array
    {
        $data = Product::join('categories', 'categories.id', 'products.category_id')
            ->where('products.location_id', $this->location)
            ->leftJoin('units', 'units.id', 'products.unit')
            ->where('products.product_name', 'LIKE', '%' . $request->get('d') . '%')
            ->where('categories.type', 'menu')
            ->select('products.id as value',
            'products.product_name as label',
            'products.price as price',
            'units.unit_name as unit')
            ->distinct('label')
            ->get();

        $json = [];
        if (count($data) > 0) {
            foreach ($data as $d) {
                if (!in_array($d->label, $json)) {
                    $json[] = array('label' => $d->label, 'value' => $d->value, 'extra' => [
                        'price' => $d->price,
                        'unit' => $d->unit
                    ]);
                }
            }
        }
        return $json;
    }

    public function getBooking(Request $request)
    {
        $output = [];

        $stage = true;
        $data = Booking::where('location_id', $this->location)->whereCustomBookingNumber($request->get('d'))
            ->first();
        if ($data) {
            if (is_null($data->stage)) {
                $stage = false;
            }

            $output = [
                'id' => $data->id,
                'phone_number' => $data->customer->customer_mobile,
                'sec_contact_no' => $data->customer->phone,
                'national_id_card' => $data->customer->cnic,
                'address' => $data->customer->customer_address,
                'event_date' => \AccountHelper::date_format( $data->event_date ),
                'event_time' => $data->event_time,
                'booking_detail' => $data->booking_detail,
                'customer_option' => $data->customer_option,
                'customer' => $data->customer->customer_name,
                'start_time' => $data->start_time,
                'end_time' => $data->end_time,
                'stage' => $stage,
            ];
        }
        return $output;

//        $customerName = $data->customer->customer_name;
//        $eventTime = \MarqueeHelper::eventTime($data->event_time);
//        if (is_null($data->stage)) {
//            $stage = false;
//        }
//        return ['data' => $data,'customer' => $customerName,'eventTime' => $eventTime, 'stage' => $stage];
    }

    public function hardwareItems(Request $request): array
    {
        $data = Product::join('categories', 'categories.id', 'products.category_id')
            ->where('products.location_id', $this->location)
            ->where('products.product_name', 'LIKE', '%' . $request->get('d') . '%')
            ->where('categories.type', 'hardware')
            ->select('products.id as value', 'products.product_name as label', 'products.price as price')
            ->distinct('label')
            ->get();

        $json = [];
        if (count($data) > 0) {
            foreach ($data as $d) {
                if (!in_array($d->label, $json)) {
                    $json[] = array('label' => $d->label, 'value' => $d->value, 'extra' => [
                        'price' => $d->price
                    ]);
                }
            }
        }
        return $json;
    }

    public function getRawMaterials(Request $request)
    {
        $data = Product::join('categories', 'categories.id', 'products.category_id')
            ->where('products.location_id', $this->location)
            ->leftJoin('units', 'units.id', 'products.unit')
            ->where('products.product_name', 'LIKE', '%' . $request->get('d') . '%')
            ->whereIn('categories.type', ['raw_materials', 'fix_assets'])
            ->select('products.id as value',
            'products.product_name as label',
            'products.price as price',
            'units.unit_name as unitname',
            'units.id as unit')
            ->distinct('label')
            ->get();

        $json = [];
        if (count($data) > 0) {
            foreach ($data as $d) {
                if (!in_array($d->label, $json)) {
                    $json[] = array('label' => $d->label, 'value' => $d->value, 'extra' => [
                        'price' => $d->price,
                        'unit' => $d->unit,
                    ]);
                }
            }
        }
        return $json;
    }

    public function getDemandItems(Request $request): array
    {
        $data = Product::join('categories', 'categories.id', 'products.category_id')
            ->where('products.location_id', $this->location)
            ->where('products.product_name', 'LIKE', '%' . $request->get('d') . '%')
            ->where('categories.type', 'raw_materials')
            ->select('products.id as value', 'products.product_name as label', 'products.price as price')
            ->distinct('label')
            ->get();

        $json = [];
        if (count($data) > 0) {
            foreach ($data as $d) {
                if (!in_array($d->label, $json)) {
                    $json[] = array('label' => $d->label, 'value' => $d->value, 'extra' => [
                        'price' => $d->price
                    ]);
                }
            }
        }
        return $json;
    }
    public function getCustomer(Request $request)
    {
        $data = Customer::where('location_id', $this->location)->findorFail($request->d);
        return $data;
    }

    public function GetCustomerOfBooking(Request $request) {
        if ($request->ajax()) {
            if ($request->event_type == 1) {    //call for events
                $customers = DB::table('bookings AS b')
                    ->where('b.location_id', $this->location)
                    ->leftJoin('customers as c','c.id','=','b.customer_option')
                    ->selectRaw('c.customer_name, c.id')
                    ->get();
            } else {    //call for stages
                $customers = DB::table('stages AS s')
                    ->where('s.location_id', $this->location)
                    ->leftJoin('customers as c','c.id','=','s.customer_id')
                    ->selectRaw('c.customer_name, c.id')
                    ->where('s.category', 'WOB')
                    ->get();
            }
            $html = "";
            $html .= "<option value='0'>All Customers</option>";

            foreach($customers as $data){
                $html .="<option value='$data->id'>$data->customer_name</option>";
            }
            echo $html;
        }
    }
}
