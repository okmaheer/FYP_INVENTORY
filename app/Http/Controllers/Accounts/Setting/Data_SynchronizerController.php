<?php

namespace App\Http\Controllers\Accounts\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Data_SynchronizerController extends Controller
{
    //
    public function update_now()
    {
        //
        return view('dashboard.accounts.Settings.update_now');
    }
    public function restore()
    {
        //
        return view('dashboard.accounts.Settings.Data_Synchronizer.restore');
    }
    public function import()
    {
        //
        return view('dashboard.accounts.Settings.Data_Synchronizer.import');
    }
    public function back_up()
    {
        //
        return view('dashboard.accounts.Settings.Data_Synchronizer.back_up');

    }
}
