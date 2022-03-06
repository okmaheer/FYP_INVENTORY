<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    //
    public function return()
    {
        //
        return view('dashboard.accounts.Return.return');
    }
    public function StockReturnList()
    {
        //
        return view('dashboard.accounts.Return.stock_return_list');
    }
    public function SupplierReturnList()
    {
        //
        return view('dashboard.accounts.Return.supplier_return_list');
    }
    public function WastageReturnList()
    {
        //
        return view('dashboard.accounts.Return.wastage_return_list');
    }



}
