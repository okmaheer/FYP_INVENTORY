<?php

namespace App\Http\Controllers\Marquee;

use App\Http\Controllers\Controller;
use App\Models\Demand;
use App\Models\Marquee\Booking;
use Illuminate\Http\Request;

class FoodDemandController extends Controller
{
    public function __construct(Demand $model)
    {
        $this->model = $model;
    }
    public function create()
    {
        $user = auth()->user();
        $demand_no = str_pad($this->model->maxId(),1,'0',STR_PAD_LEFT);
        return view('dashboard.marquee.food-demand.create', compact('demand_no' , 'user'));
    }

    public function index()
    {
        return view('dashboard.marquee.food-demand.manage');
    }
   public function fooddemandreport(){
    $page_title = "Demand Food Report";

    return view('dashboard.marquee.food-demand.food_demand-report',compact('page_title'));
   }
}
