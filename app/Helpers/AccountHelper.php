<?php

use App\Enum\CacheEnum;
use App\Enum\SessionEnum;
use App\Models\AccountHead;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\EmployeeLoan;
use App\Models\HardwareSetting;
use App\Models\Setting;
use App\Models\Company;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AccountHelper{
    /**
     * manual statuses
     * @return string[]
     */
    public static function manualStatus($id=null)
    {
        $data = [
            1 => 'Active',
            0 => 'Inactive'
        ];
        if (!empty($id)){
            $data = $data[$id];
        }
        return $data;
    }

    public static function loanStatus($id=null)
    {
        $data = [
            1 => 'Pending',
            2 => 'Approved',
            3 => 'Rejected',
        ];
        if (!empty($id)){
            $data = $data[$id];
        }
        return $data;
    }

    public static function loanReturnTypes($id=null)
    {
        $data = [
            1 => 'Complete One Time',
            2 => 'Deduction from Salary'
        ];
        if (!empty($id)){
            $data = $data[$id];
        }
        return $data;
    }

    public static function FixPercentTypes($id=null)
    {
        $data = [
            1 => 'Fixed',
            2 => 'Percentage'
        ];

        if (!empty($id)){
            $data = $data[$id];
        }
        return $data;
    }

    public static function commissionStatus(): array
    {
        return [
            1 => 'Bank',
            0 => 'Debit'
        ];
    }
    public static function paymentTypes($id=null)
    {
        $data = [
            1 => 'Cash Payment',
            2 => 'Bank Transfer'
        ];

        if (!empty($id)){
            $data = $data[$id];
        }
        return $data;
    }
    public static function rateTypes($id=null)
    {
        $data = [
            1 => 'Daily Wage',
            2 => 'Salary'
        ];

        if (!empty($id)){
            $data = $data[$id];
        }
        return $data;
    }
    public static function CountryTypes($id=null)
    {
        $ret_data;

        $list = config('countrylist-eng');

        if (!empty($id)) {
            foreach($list as $country_code => $country) {
                if ($id == $country['id']) {
                    $ret_data = $country['name'];
                    break;
                }
            }
        } else {
            foreach($list as $country_code => $country) {
                $ret_data[$country['id']] = $country['name'];
            }
        }
        return $ret_data;
    }
    public static function Booking():array
    {
        return [
            1 => 'Marquee',
            2 => 'Out Door',
            3 => 'Open Area'
        ];
    }
    public static function partitionRequire():array
    {
        return [
            1 => 'Yes',
            2 => 'No',

        ];
    }
    public static function colourScheme():array
    {
        return [
            1 => 'Red',
            2 => 'Yellow',
            3 => 'Blue',
            4 => 'Green',

        ];
    }
    public static function menuType():array
    {
        return [
            1 => 'Single Dish',
            2 => 'Custom Menu',
            3 => 'Barat Menu',
            4 => 'Rasm e Hina'
        ];
    }
    public static function stageType():array
    {
        return [
            1 => 'Normal',
            2 => 'Average',
            3 => 'Best'
        ];
    }
    public static function Size():array
    {
        return [
            1 => '20x30',
            2 => '8x38',
            3 => '12x16',
            4 => '13x15'
        ];
    }
    public static function advanceTypes():array
    {
        return [
            1 => 'Payment',
            2 => 'Receive'
        ];
    }

    public static function number_format($num, $decimals = 2)
    {
        return number_format($num, $decimals,'.',',');
    }

    public static function generator($lenth)
    {
        $number=array("A","B","C","D","E","F","G","H","I","J","K","L","N","M","O","P","Q","R","S","U","V","T","W","X","Y","Z","1","2","3","4","5","6","7","8","9","0");

        for($i=0; $i<$lenth; $i++)
        {
            $rand_value=rand(0,34);
            $rand_number=$number["$rand_value"];

            if(empty($con))
            {
                $con=$rand_number;
            }
            else
            {
                $con="$con"."$rand_number";}
        }
        return $con;
    }

    public static function convert_number($number) {
        if($number < 0){
            $number = -($number);
        }
        if (($number < 0) || ($number > 9999999999999)) {
            throw new Exception("Number is out of range");
        }

        $Gn = floor($number / 1000000);
        /* Millions (giga) */
        $number -= $Gn * 1000000;
        $kn = floor($number / 1000);
        /* Thousands (kilo) */
        $number -= $kn * 1000;
        $Hn = floor($number / 100);
        /* Hundreds (hecto) */
        $number -= $Hn * 100;
        $Dn = floor($number / 10);
        /* Tens (deca) */
        $n = $number % 10;
        /* Ones */

        $res = "";

        if ($Gn) {
            $res .= AccountHelper::convert_number($Gn) .  "Million";
        }

        if ($kn) {
            $res .= (empty($res) ? "" : " ") .AccountHelper::convert_number($kn) . " Thousand";
        }

        if ($Hn) {
            $res .= (empty($res) ? "" : " ") .AccountHelper::convert_number($Hn) . " Hundred";
        }

        $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", "Nineteen");
        $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety");

        if ($Dn || $n) {
            if (!empty($res)) {
                $res .= " and ";
            }

            if ($Dn < 2) {
                $res .= $ones[$Dn * 10 + $n];
            } else {
                $res .= $tens[$Dn];

                if ($n) {
                    $res .= "-" . $ones[$n];
                }
            }
        }

        if (empty($res)) {
            $res = "zero";
        }

        return $res;
    }

    public static function eventArea($id=null)
    {
        $data = [
            1 => 'Indoor',
            2 => 'Outdoor',
//            3 => 'Qasray Niaz',
        ];
        if (!empty($id)){
            $data = $data[$id];
        }
        return $data;
    }
    public static function settings(){
        return Setting::where('location_id', session(SessionEnum::SESSION_LOCATION_ID))->first();
    }

    public static function hardwareSettings(){
        return HardwareSetting::where('location_id', session(SessionEnum::SESSION_LOCATION_ID))->first();
    }

    public static function bankAccountTypes():array
    {
        return [
            1 => 'Debit(+)',
            2 => 'Credit(-)'
        ];
    }

    public static function ledgerBalanceType($balance)
    {
        $balance = ($balance > 0 ) ? "DR ". AccountHelper::number_format($balance)  : "CR ".AccountHelper::number_format(($balance * -1));
        return $balance;
    }

    public static function eventAreaCode($id=null)
    {
        $data = [
            1 => 'ID',
            2 => 'OD',
            3 => 'QN',
        ];
        if (!empty($id)){
            $data = $data[$id];
        }
        return $data;
    }

    public static function getHeadName($id){

        $accountHead = \App\Models\AccountHead::where('HeadCode',$id)->first();
        return $accountHead->HeadName;

    }

    public static function getVoucherUrl($type,$id){

        $routes = [
            "DV" => route('dashboard.accounts.debit.voucher.edit',$id),
            "CV" => route('dashboard.accounts.credit.voucher.edit',$id),
            "JV" => route('dashboard.accounts.journal.voucher.edit',$id),
            "Contra" => route('dashboard.accounts.contra.voucher.edit',$id)
        ];
        if (!empty($type)) {
            return   $routes[$type];
        }

    }

    public static function getAccountHeadVouchers(){
        $accountHeads = \App\Models\AccountHead::where('IsActive',1)->where('IsTransaction',1)->pluck('HeadName','HeadCode');
        return $accountHeads;
    }

    public static function CurrentCompany() {
        $comp = Company::first();
        return $comp;
    }

    public static function date_format($date) {
        if (is_string($date)) {
            $mDate =  DateTime::createFromFormat('Y-m-d', $date);
        } else {
            $mDate = $date;
        }
        return date_format($mDate, Cache::get(CacheEnum::AUTH_LOCATION)->date_format);
    }

    public static function getRouteForVoucher($type,$vno){
        if($type == 'Purchase')
            return route('dashboard.accounts.purchase.invoice',$vno);
        if($type == 'INV')
            return route('dashboard.accounts.sale.invoice',$vno);
        if($type == 'PM' || $type == 'CR' || $type == 'CR-B' || $type == 'CR-S' || $type == 'DV' || $type == 'CV' || $type == 'Contra' || $type == 'JV' || $type == 'SV' || $type == 'AD' || $type='Expense')
            return route('common.payment.receipt',['VNo'=>$vno]);
    }

    public static function customerDue($customer_id, $start_date = null, $end_date = null) {
        $headCode = AccountHead::where('customer_id',$customer_id)->first()->HeadCode;
        $data = Transaction::where('location_id', session(SessionEnum::SESSION_LOCATION_ID))
            ->where('COAID', $headCode)->selectRaw('sum(Debit) as cust_debit, sum(Credit) as cust_credit');
        if (!is_null($start_date)) {
            $data = $data->where('VDate', '>=', Carbon::parse($start_date)->format('Y-m-d'));
        }
        if (!is_null($end_date)) {
            $data = $data->where('VDate', '<=', Carbon::parse($end_date)->format('Y-m-d'));
        }
        $data = $data->first();
        return ($data->cust_debit - $data->cust_credit);
    }

    public static function customerReceived($customer_id, $start_date = null, $end_date = null) {
        $headCode = AccountHead::where('customer_id',$customer_id)->first()->HeadCode;
        $data = Transaction::where('location_id', session(SessionEnum::SESSION_LOCATION_ID))
            ->where('COAID', $headCode)->selectRaw('sum(Credit) as cust_credit');
        if (!is_null($start_date)) {
            $data = $data->where('VDate', '>=', Carbon::parse($start_date)->format('Y-m-d'));
        }
        if (!is_null($end_date)) {
            $data = $data->where('VDate', '<=', Carbon::parse($end_date)->format('Y-m-d'));
        }
        $data = $data->first();
        return ($data->cust_credit);
    }

    public static function supplierDue($supplier_id, $start_date = null, $end_date = null) {
        $headCode = AccountHead::where('supplier_id',$supplier_id)->first()->HeadCode;
        $data = Transaction::where('location_id', session(SessionEnum::SESSION_LOCATION_ID))
            ->where('COAID', $headCode)->selectRaw('sum(Debit) as supp_debit, sum(Credit) as supp_credit');
        if (!is_null($start_date)) {
            $data = $data->where('VDate', '>=', Carbon::parse($start_date)->format('Y-m-d'));
        }
        if (!is_null($end_date)) {
            $data = $data->where('VDate', '<=', Carbon::parse($end_date)->format('Y-m-d'));
        }
        $data = $data->first();
        return ($data->supp_credit - $data->supp_debit);
    }

    public static function supplierPaid($supplier_id, $start_date = null, $end_date = null) {
        $headCode = AccountHead::where('supplier_id',$supplier_id)->first()->HeadCode;
        $data = Transaction::where('location_id', session(SessionEnum::SESSION_LOCATION_ID))
            ->where('COAID', $headCode)->selectRaw('sum(Debit) as supp_debit');
        if (!is_null($start_date)) {
            $data = $data->where('VDate', '>=', Carbon::parse($start_date)->format('Y-m-d'));
        }
        if (!is_null($end_date)) {
            $data = $data->where('VDate', '<=', Carbon::parse($end_date)->format('Y-m-d'));
        }
        $data = $data->first();
        return ($data->supp_debit);
    }

    public static function employeeLoanRecords($employee_id, $month = null, $year = null) {
        $output = ['hasLoan' => false, 'deductAmount' => 0, 'loanReceived' => 0];
        $employee = Employee::where('location_id', session(SessionEnum::SESSION_LOCATION_ID))->find($employee_id);

        if ($employee) {
            $loanRecord = EmployeeLoan::where('location_id', session(SessionEnum::SESSION_LOCATION_ID))
                ->where('employee_id', $employee->id)->whereIn('status', [4])->first();
            if (!empty($loanRecord)) {
                $deductAmount = $loanRecord->deduct_amount;

                if ($loanRecord->loan_type === 1) { //one time payment

                } else {
                    $loanRemain = self::employeeLoanRemainAmount($employee->id, $month, $year);
                    if ($loanRemain['remaining'] > 0) {
                        $output['hasLoan'] = true;
                        $output['deductAmount'] = $deductAmount;
                        $output['loanRemain'] = $loanRemain['remaining'];
                        if ($loanRemain['monthRemain'] > 0) {
                            $output['monthRemain'] = $loanRemain['monthRemain'];
                        } else {
                            $output['monthRemain'] = $loanRecord->dedcut_amount;
                        }
                    }
                }
            }
        }

        return $output;
    }

    public static function employeeLoanRemainAmount($employee_id, $month = null, $year = null) {
        $output = ['remaining' => 0, 'monthRemain' => 0];

        $headCode = AccountHead::where('employee_id',$employee_id)->first()->HeadCode;

        $dataDebit = Transaction::where('COAID', $headCode)->where('VType', 'Loan')->where('location_id', session(SessionEnum::SESSION_LOCATION_ID));
        $dataDebit = $dataDebit->selectRaw('sum(Debit) as loan_debit');
        $dataDebit = $dataDebit->first();

        $dataCredit = Transaction::where('COAID', $headCode)->where('VType', 'Loan')->where('location_id', session(SessionEnum::SESSION_LOCATION_ID));
        $dataCredit = $dataCredit->selectRaw('sum(Credit) as loan_credit');
        $dataCredit = $dataCredit->first();

        $monthCredit = Transaction::where('COAID', $headCode)->where('VType', 'Loan')->where('location_id', session(SessionEnum::SESSION_LOCATION_ID));
        if (!empty($month)) {
            $monthCredit = $monthCredit->whereYear('created_at', $year)->whereMonth('created_at', $month);
        }
        $monthCredit = $monthCredit->selectRaw('sum(Credit) as month_credit');
        $monthCredit = $monthCredit->first();

        if (!empty($dataDebit->loan_debit)) {
            if ($monthCredit->month_credit > 0) {
                $output = ['remaining' => ($dataDebit->loan_debit - $dataCredit->loan_credit), 'monthRemain' => $monthCredit->month_credit];
            } else {
                $loanRecord = EmployeeLoan::where('location_id', session(SessionEnum::SESSION_LOCATION_ID))
                    ->where('employee_id', $employee_id)->whereIn('status', [4])->first();
                $output = ['remaining' => ($dataDebit->loan_debit - $dataCredit->loan_credit), 'monthRemain' => $loanRecord->deduct_amount];
            }
        }
        return $output;
    }

    public static function getAttendanceHours($employee_id, $date) {
        $presentHours = 0;

        $attendanceRecords = Attendance::where('location_id', session(SessionEnum::SESSION_LOCATION_ID))
            ->where('employee_id', $employee_id)->whereDate('clock_in', $date)->whereNotNull('clock_out')->get();
        if ($attendanceRecords) {
            foreach ($attendanceRecords as $attendance) {
                $clockIn = Carbon::parse($attendance->clock_in);
                $clockOut = Carbon::parse($attendance->clock_out);
                $presentHours += $clockIn->diffInHours($clockOut);
            }
        }
        return $presentHours;
    }

    public static function getProductStock($productID) {
        $data = DB::table('stock_view as s')
            ->where('s.product_id', $productID)
            ->join('products as p','p.id','=','s.product_id')
            ->where('p.location_id', session(SessionEnum::SESSION_LOCATION_ID))
            ->selectRaw('p.product_name as product_name, SUM(s.qty) as stock, SUM(s.qty * s.rate) as stock_value')
            ->groupBy('p.product_name')
            ->first();

        return (empty($data->stock) ? 0 : $data->stock);
    }

    public static function generalHeadsDropDown($headsCollection) {
        $arrHeads = [];
        foreach($headsCollection as $accountHead) {
            if (!in_array($accountHead->PHeadName, $arrHeads)) {
                $arrHeads[$accountHead->PHeadName] = [];
            }
        }

        foreach($headsCollection as $accountHead) {
            if (!in_array($accountHead->HeadName, $arrHeads[$accountHead->PHeadName])) {
                $arrHeads[$accountHead->PHeadName][$accountHead->HeadCode] = $accountHead->HeadName;
            }
        }

        return $arrHeads;
    }

    public static function randomColor() {
        $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
        return '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
    }
}
?>
