<?php

namespace App\Http\Controllers\Accounts\Setting;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\HardwareSetting;
use App\Models\Setting;
use App\Models\Prefixes;
use App\Traits\General;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Rats\Zkteco\Lib\ZKTeco;

class SettingsController extends Controller
{
    use General;
    protected $model;
    protected $prefixes;
    private $location;

    public function __construct(Setting $model, Prefixes $prefix){
        $this->middleware('auth');
        $this->model = $model;
        $this->prefixes = $prefix;
        $this->middleware(function ($request, $next){
            $this->location = session(SessionEnum::SESSION_LOCATION_ID);
            return $next($request);
        });
    }

    public function index(){
        abort(404);
        $this->authorize('softwareSettings',  $this->model);

        $page_title = "Settings";
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Settings' => '',
        ]);

        $general = $this->model->where('location_id', $this->location)->first();
        $prefixes = $this->prefixes->where('location_id', $this->location)->get();

        return view('dashboard.accounts.Settings.software_settings.settings',compact('page_title', 'breadcrumbs', 'general', 'prefixes'));
    }

    public function store(Request $request){

        /* $this->model = $this->model->findorfail($request->id);
        $old_logo = $this->model->logo;

        $this->makeDirectory('settings');
        $this->model->find($request->id)->update($request->all());
        $this->model = $this->model->find($request->id);
        // $this->model = $this->model->create($request->all());

        if ($request->file('logo')) {
            if (file_exists($old_logo)) {
                unlink ($old_logo);
            }

            $file = $request->file('logo');
            $name = sha1('img' . $this->model->id . time()) . '.' . $file->getClientOriginalExtension();
            $image = Image::make($file);
            $image->save(public_path('uploads/settings/') . $name);
            $this->model->logo = 'uploads/settings/' . $name;
            $this->model->save();
        }

        return redirect()->route('dashboard.accounts.settings.index')
            ->with('success', 'Setting is Updated Successfully.'); */
    }

    public function SmsSetting()
    {
        return view('dashboard.accounts.Settings.SMS.sms_setting');
    }

    public function ManageCompany()
    {
        return view('dashboard.accounts.Settings.software_settings.manage_company');
    }

    public function language()
    {
        return view('dashboard.accounts.Settings.software_settings.language');

    }

    public function currency()
    {
        //
        return view('dashboard.accounts.Settings.software_settings.currency');
    }
    public function settings()
    {
        //
        return view('dashboard.accounts.Settings.software_settings.settings');
    }
    public function PrintSetting()
    {
        //
        return view('dashboard.accounts.Settings.software_settings.print_setting');
    }
    public function MailSetting()
    {
        //
        return view('dashboard.accounts.Settings.software_settings.mail_setting');
    }

    public function AppSetting()
    {
        //
        return view('dashboard.accounts.Settings.software_settings.app_setting');
    }

    public function SaveGeneral(Request $request) {
        abort(404);
        $output = ['success' => false, 'msg' => __("accounts.messages.something_went_wrong")];

        if (Auth::user()->can('softwareSettings',  $this->model)) {
            if ($request->ajax()) {
                $this->makeDirectory('settings');

                $this->model = $this->model->where('location_id', $this->location)->first();
                if ($this->model) {
                    $old_logo = $this->model->logo;
                    $this->model->update($request->all());
                    $this->model = $this->model->where('location_id', $this->location)->first();

                    if ($request->file('logo')) {
                        if (file_exists($old_logo)) {
                            unlink($old_logo);
                        }

                        $file = $request->file('logo');
                        $name = sha1('img' . $this->model->id . time()) . '.' . $file->getClientOriginalExtension();
                        $image = Image::make($file);
                        $image->save(public_path('uploads/settings/') . $name);
                        $this->model->logo = 'uploads/settings/' . $name;
                        $this->model->save();
                    }

                    $output = ['success' => true,
                        'msg' => __("accounts.messages.setting_general_updated"),
                        'data' => $this->model
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

    public function SavePrefixes(Request $request) {
        abort(404);
        $output = ['success' => false, 'msg' => __("accounts.messages.something_went_wrong")];

        if (Auth::user()->can('softwareSettings',  $this->model)) {
            if ($request->ajax()) {
                $get_prefixes = $request->input('prefix', array());
                $count = $get_prefixes['id'];
                foreach ($count as $key => $value) {
                    $id = $get_prefixes['id'][$key];
                    $prefix = $get_prefixes['value'][$key];
                    $this->prefixes->where('location_id', $this->location)
                        ->where('id', $id)->update(['prefix' => $prefix, 'updated_by' => auth()->user()->id]);
                }
                $output = ['success' => true,
                    'msg' => __("accounts.messages.setting_prefix_updated")
                ];
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

    public function getHardwareSetting() {

        $this->authorize('hardwareSettings',  $this->model);

        $page_title = "Hardware Settings";
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Hardware Settings' => '',
        ]);

        $model = HardwareSetting::where('location_id', $this->location)->first();

        return view('dashboard.accounts.Settings.hardware_setting.index', compact('page_title', 'breadcrumbs', 'model'));

    }

    public function updateHardwareSetting(Request $request) {
        $output = ['success' => false, 'msg' => ''];

        if (Auth::user()->can('hardwareSettings',  $this->model)) {
            if ($request->ajax()) {
                $hardwareSetting = HardwareSetting::where('location_id', $this->location)->first();
                $hardwareSetting->update($request->all());
                if ($hardwareSetting) {
                    $hardwareSetting->updated_by = auth()->user()->id;
                    $hardwareSetting->save();
                    $output = ['success' => true,
                        'msg' => __("accounts.messages.setting_hardware_updated")
                    ];
                } else {
                    $output['msg'] = __("accounts.messages.something_went_wrong");
                }
            } else {
                $output['msg'] = __("accounts.messages.invalid_request");
            }
        } else {
            $output['msg'] = 'You are not allowed to perform this action.';
        }
        return $output;
    }

    public function testAttendanceMachine($ip, $port) {

    }
}
