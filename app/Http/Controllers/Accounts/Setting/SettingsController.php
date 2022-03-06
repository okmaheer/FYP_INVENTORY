<?php

namespace App\Http\Controllers\Accounts\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Traits\General;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SettingsController extends Controller
{
    use General;
    protected $model;
    public function __construct(Setting $model){
        $this->model = $model;
    }
    public function index(){
        $settings = $this->model->first();
        return view('dashboard.accounts.Settings.software_settings.settings',compact('settings'));
    }
    public function store(Request $request){


        $this->makeDirectory('settings');
        $this->model->find($request->id)->update($request->all());
        $this->model = $this->model->find($request->id);
//        $this->model = $this->model->create($request->all());

        if ($request->file('logo')) {
            $file = $request->file('logo');
            $name = sha1('img' . $this->model->id . time()) . '.' . $file->getClientOriginalExtension();
            $image = Image::make($file);
            $image->save(public_path('uploads/settings/') . $name);
            $this->model->logo = 'uploads/settings/' . $name;
            $this->model->save();
        }

        return redirect()->route('dashboard.accounts.settings.index')
            ->with('success', 'Setting is Updated Successfully.');
    }
    public function SmsSetting()
    {
        //
        return view('dashboard.accounts.Settings.SMS.sms_setting');
    }
    public function ManageCompany()
    {
        //
        return view('dashboard.accounts.Settings.software_settings.manage_company');
    }
    public function language()
    {
        //
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


}
