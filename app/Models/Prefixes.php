<?php

namespace App\Models;

use App\Enum\SessionEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prefixes extends Model
{
    use HasFactory;
    protected $table = 'prefix_setting';

    public function getPrefix($type){
        return $this->whereType($type)->first()->prefix . '-';
    }

    public static function generateNumber($type) {
        $getNumber = self::whereType($type)->where('location_id', session(SessionEnum::SESSION_LOCATION_ID))->first();

        if (!is_null($getNumber)) {
            $number = $getNumber->prefix . "-" . str_pad($getNumber->number,5,'0',STR_PAD_LEFT);
            return $number;
        }
        return strtoupper($type) . "-" . mt_rand(11111, 99999);
    }

    public static function updateNumber($type) {
        $getNumber = self::whereType($type)->where('location_id', session(SessionEnum::SESSION_LOCATION_ID))->first();

        if (!is_null($getNumber)) {
            self::whereType($type)->where('location_id', session(SessionEnum::SESSION_LOCATION_ID))
                ->update(["number" => ((int)$getNumber->number + 1)]);
        }
    }
}
