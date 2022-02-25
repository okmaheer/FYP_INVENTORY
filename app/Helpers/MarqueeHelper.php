<?php

use App\Enum\SessionEnum;
use App\Models\Marquee\Menu;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
use App\Models\Marquee\Booking;
use App\Models\Demand;
use App\Models\Marquee\Stage;
use App\Models\Purchase;
use App\Models\AccountHead;
use Illuminate\Support\Carbon;

class  MarqueeHelper
{
    /**
     * @param $type
     * @return mixed
     */
    public static function getMenuTypes($type): mixed
    {
        return DB::table('marquee_menu_types')->whereType($type)->get();
    }

    /**
     * @param $type
     * @return mixed
     */
    public static function getMenuPackages($type): mixed
    {
        return DB::table('marquee_menu_packages')->whereType($type)->get();
    }

    /**
     * Pluck Booking Menus
     * @return mixed
     */
    public static function pluckMenus()
    {
        return Menu::pluck('menu_name', 'id');
    }

    /**
     * @return string[]
     */
    public static function getBookingStatuses($id=null)
    {
        $data = [
            1 => 'Processing',
            2 => 'Confirmed',
        ];

        if(!empty($id)){
            $data = $data[$id];
        }
        return $data;
    }
    public static function unitsReceipe()
    {
        return array(
            '1' => 'KG',
            '2' => 'Grams'
        );
    }
    public static function departments()
    {
        return array(
            '1' => 'Store',
            '2' => 'Kitchen',
            '3' => 'Staff'

        );
    }
    public static function demand($id=null)
    {
        $data = [
            '1' => 'Dish washer',
            '2' => 'Washer Man',
            '3' => 'Housekeeper',
            '4' => 'Tandoori',
            '5' => 'Staff Food',
            '6' => 'Booking'
        ];
        if(!empty($id)){
          $data = $data[$id];
        }

        return $data;
    }

    public static function isPartition($id=null)
    {
        $data = [
            1 => 'Yes',
            2 => 'No',
        ];
        if(!empty($id)){
          $data = $data[$id];
        }

        return $data;
    }

    public static function EventType($id=null) {
        $data = [
            1 => 'Birthday',
            2 => 'Business Meeting',
            3 => 'Conference',
            4 => 'Exhibition',
            5 => 'Mehndi',
            6 => 'Baraat',
            7 => 'Walima',
            8 => 'Mehfil-e-Naat',
            9 => 'Mehfil-e-Qawali',
            10 => 'Religious Event',
            11 => 'Other',
        ];
        if(!empty($id)){
          $data = $data[$id];
        }

        return $data;
    }

    public static function bookingGrandAmount($id, $with_addon_booking = false){
        $bookingGrandAmount = Booking::where('location_id', session(SessionEnum::SESSION_LOCATION_ID))->whereId($id);
            if ($with_addon_booking == true) {
                $bookingGrandAmount = $bookingGrandAmount->orWhere(['parent_booking_id' => $id]);
            }
            $bookingGrandAmount = $bookingGrandAmount->selectRaw('sum(grand_total) grand_amount,id')
                        ->groupBy('id')
                        ->get()->sum('grand_amount');
        $amount = $bookingGrandAmount;

        return $amount ;
    }

    public static function bookingAmountClc($bookingId){
        $amount = Transaction::whereHas('booking',function($query) use ($bookingId) {
            $query->where(['id' => $bookingId])->orWhere(['parent_booking_id'=>$bookingId]);
        })
            ->selectRaw('sum(Credit) paid_amount')
            ->first();

        return $amount->paid_amount ;
    }

    public static function stageAmountClc($bookingId, $stageId){
        $amount = Transaction::whereHas('stage',function($query) use ($stageId) {
            $query->where(['id' => $stageId]);
        })->where('COAID', 'not like', '10201%')
            ->selectRaw('sum(Credit) paid_amount')
            ->first();

        return $amount->paid_amount ;
    }

    public static function bookingTotalNetAmount($id, $with_addon_booking = false) {
        $netAmount = Booking::where('location_id', session(SessionEnum::SESSION_LOCATION_ID))->whereId($id);
        if ($with_addon_booking == true) {
            $netAmount = $netAmount->orWhere(['parent_booking_id' => $id]);
        }
        $netAmount = $netAmount->selectRaw('sum(net_total) net_amount,custom_booking_number')
                    ->groupBy('custom_booking_number')
                    ->get()->sum('net_amount');

        $stageNetAmount = Stage::where('booking_id',$id)
            ->selectRaw('sum(net_total) net_amount')
            ->get()->sum('net_amount');
        $stageNetAmount = ($stageNetAmount > 0) ? $stageNetAmount : 0;
        $amount = $netAmount +  $stageNetAmount;
        return $amount ;
    }

    public static function stageTotalNetAmount($bookingID, $stageID){
        if (is_null($bookingID)) {
            $netAmount = (object) [];
            $netAmount->net_amount = 0;
        } else {
            $netAmount = Booking::where('location_id', session(SessionEnum::SESSION_LOCATION_ID))->whereId($bookingID)
                ->selectRaw('sum(net_total) net_amount,custom_booking_number')
                ->groupBy('custom_booking_number')
                ->first();
        }
        //return $netAmount;

        $stageNetAmount = Stage::where('location_id', session(SessionEnum::SESSION_LOCATION_ID))->where('id',$stageID)
            ->selectRaw('sum(net_total) net_amount')
            ->first();
        $stageNetAmount = ($stageNetAmount->net_amount > 0) ? $stageNetAmount->net_amount : 0;
        $amount = $netAmount->net_amount +  $stageNetAmount;

        return $amount ;
    }

    public static function bookingTransactions($bookingId){
        $booking = Booking::where('location_id', session(SessionEnum::SESSION_LOCATION_ID))->find($bookingId);
        $headcode = AccountHead::where('customer_id',$booking->customer_option)->value('HeadCode');

        $amount = Transaction::whereHas('booking',function($query) use ($bookingId) {
            $query->where(['id' => $bookingId])->orWhere(['parent_booking_id'=>$bookingId]);
        })->where('COAID', $headcode)->get();

        return $amount ;
    }

    public static function stageTransactions($stageId){
        $amount = Transaction::whereHas('stage',function($query) use ($stageId) {
            $query->where(['id' => $stageId]);
        })->where('COAID', 'not like', '10201%')
            ->get();

        return $amount ;
    }

    public static function getDemandProducts($productId,$demandId){
        $demand = Demand::with(['demandDetails',function($query) use ($productId){
            $query->where('product_id',$productId);
        }])->where('id',$demandId)->first();
        return $demand;
    }

    public static function getTotalPurchaseCurrentMonth(){
        $data = Purchase::where('location_id', session(SessionEnum::SESSION_LOCATION_ID))->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->selectRaw('sum(net_total_amount) as total_amount')
            ->first();
        return $data->total_amount;
    }
    public static function getUpcomingEvents(){
        $data = Booking::where('location_id', session(SessionEnum::SESSION_LOCATION_ID))->where('event_date', '>', Carbon::now())
                        ->where('status', '!=', 3)
                        ->get();
        return $data;
    }

    public static function getTotalVendors(){
        $data = Booking::where('location_id', session(SessionEnum::SESSION_LOCATION_ID))->where('event_date', '>', Carbon::now())->get();
        return $data;
    }
    public static function eventTime($id=null){
        $data = [
            '1' => 'Lunch',
            '2' => 'Dinner'
        ];
        if(!empty($id)){
            $data = $data[$id];
        }

        return $data;
    }

    public static function eventDiscount($id=null){
        $data = [
            1 => 'Fixed',
            2 => 'Percentage',
            3 => 'No. of Persons'
        ];
        if(!empty($id)){
            $data = $data[$id];
        }

        return $data;
    }

    public static function EventCancelType($id=null){
        $data = [
            1 => 'Non Refundable',
            2 => 'Refundable'
        ];
        if(!empty($id)){
            $data = $data[$id];
        }

        return $data;
    }

    public static function EventRefundType($id=null){
        $data = [
            1 => 'Fixed',
            2 => 'Percentage'
        ];
        if(!empty($id)){
            $data = $data[$id];
        }

        return $data;
    }
}
