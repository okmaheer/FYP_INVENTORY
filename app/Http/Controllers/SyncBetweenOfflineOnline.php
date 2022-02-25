<?php

namespace App\Http\Controllers;

use App\Models\InternetStatus;
use Illuminate\Http\Request;

class SyncBetweenOfflineOnline extends Controller
{
    /**
     * call
     * @param Request $request
     */
    public function call(Request $request)
    {
        $model = new InternetStatus();
        $model->name = $request->get('status');
        $model->is_synced = false;
        $model->save();
    }
}
