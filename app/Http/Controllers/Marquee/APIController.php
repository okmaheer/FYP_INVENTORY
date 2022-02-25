<?php

namespace App\Http\Controllers\Marquee;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\Marquee\Menu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class APIController extends Controller
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
     * Get Food Items by Menu Id
     * @param $menuId
     * @return JsonResponse
     */
    public function getFoodItemsByMenuId($menuId): JsonResponse
    {
        $model = Menu::where('location_id', $this->location)->with('menuItems')->findorFail($menuId);
        $reset = false;
        if ($model) {

            return response()->json([
                'status' => true,
                'data' => view('api.marquee.food-items-by-menu-id', compact('model', 'reset'))->render()
            ]);

        } else {

            return response()->json([
                'status' => false
            ]);

        }
    }

    public function ResetFoodMenu(Request $request) {
        if ($request->ajax()) {
            $model = (object)[];
            $reset = true;
            return response()->json([
                'status' => true,
                'data' => view('api.marquee.food-items-by-menu-id', compact('model','reset'))->render()
            ]);
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }
}
