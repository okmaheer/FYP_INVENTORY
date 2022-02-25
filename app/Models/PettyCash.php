<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PettyCash extends Model
{
    use HasFactory;
    protected $table = "pettycashs";

    protected $fillable = [
            'pettycash_name',
            'pettycash_mobile',
            'pettycash_email',
            'cnic',
            'phone',
            'contact',
            'pettycash_address',
            'address2',
            'fax',
            'city',
            'state',
            'zip',
            'country',
            'previous_balance',

    ];



    public function accountHead(){
        return $this->hasOne(AccountHead::class,'pettycash_id','id');
    }

    public function headName()
    {
        return 'PettyCash-'.$this->id.'-'.$this->pettycash_name;
    }
    public function getPettycashName($id){
        return $this->find($id)->pettycash_name;
    }

    public static function modulePermissions($middleware = false, $route = null): array
    {

        if ($middleware) {

            switch ($route) {
                case 'ledger':
                    return array('pettycash_ledger');
                    break;
                default:
                    return array();
            }

        }

        return array(
            'pettycash_ledger',
        );
    }
}
