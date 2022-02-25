<?php

namespace App\Http\Controllers\Accounts;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\BusinessLocation;
use App\Models\Prefixes;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class BusinessLocationController extends Controller
{
    private $location;

    function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next){
            $this->location = session(SessionEnum::SESSION_LOCATION_ID);
            return $next($request);
        });
    }

    public function locationSettings() {
        $this->authorize('softwareSettings',  Setting::class);
        $model = BusinessLocation::findorFail($this->location);
        $prefixes = Prefixes::where('location_id', $this->location)->get();

        $page_title = "Software Settings";
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Settings' => '',
        ]);

        return view('dashboard.accounts.business-location.edit', compact('page_title', 'breadcrumbs', 'model', 'prefixes'));
    }
    public function updateLocationSettings(Request $request) {
        $output = ['success' => false, 'msg' => __("accounts.messages.something_went_wrong")];

        if (Auth::user()->can('softwareSettings',  Setting::class)) {
            if ($request->ajax()) {

                $location = BusinessLocation::findorFail($this->location);
                if ($location) {
                    $old_logo = $location->logo;
                    $location->update($request->all());
                    $location = BusinessLocation::findorFail($this->location);

                    if ($request->file('logo')) {
                        if (file_exists($old_logo)) {
                            unlink($old_logo);
                        }

                        $file = $request->file('logo');
                        $name = $location->id . '.png';
                        $image = Image::make($file);
                        $image->save(public_path('uploads/business_locations/') . $name);
                        $location->logo = 'uploads/business_locations/' . $name;
                        $location->save();
                    }

                    $output = ['success' => true,
                        'msg' => __("accounts.messages.setting_general_updated"),
                        'data' => $location
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
        } else {
            $output['msg'] = 'You are not allowed to perform this action.';
        }
        return $output;
    }
}
