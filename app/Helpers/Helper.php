<?php
use App\Models\Setting;
class Helper{
    /**
     * manual statuses
     * @return string[]
     */
    public static function manualStatus(): array
    {
        return [
            1 => 'Active',
            0 => 'Inactive'
        ];
    }
    public static function commissionStatus(): array
    {
        return [
            1 => 'Bank',
            0 => 'Debit'
        ];
    }
    public static function paymentTypes():array
    {
        return [
            1 => 'Cash Payment',
            0 => 'Bank Transfer'
        ];
    }
    public static function rateTypes():array
    {
        return [
            1 => 'Hourly',
            2 => 'Salary'
        ];
    }
    public static function CountryTypes():array
    {
        return [
            1 => 'Afganistan',
            0 => 'Pakistan'
            // 0 => 'India'
        ];
    }
    public static function advanceTypes():array
    {
        return [
            1 => 'Payment',
            2 => 'Receive'
        ];
    }

    public static function number_format($num)
    {
        return number_format($num,2,'.',',');
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
            $res .= Helper::convert_number($Gn) .  "Million";
        }

        if ($kn) {
            $res .= (empty($res) ? "" : " ") .Helper::convert_number($kn) . " Thousand";
        }

        if ($Hn) {
            $res .= (empty($res) ? "" : " ") .Helper::convert_number($Hn) . " Hundred";
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

    public static function settings(){
        $setting = Setting::first();
        return $setting;
    }

    public static function bankAccountTypes():array
    {
        return [
            1 => 'Debit(+)',
            2 => 'Credit(-)'
        ];
    }

}
?>
