<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_name',
        'supplier_mobile',
        'supplier_email',
        'cnic',
        'phone',
        'contact',
        'supplier_address',
        'address2',
        'fax',
        'city',
        'state',
        'zip',
        'country',
        'previous_balance',
        
    ];

    public function purchases(){

        return $this->hasMany(Purchase::class,'supplier_id','id');
    }

}
