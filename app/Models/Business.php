<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Business extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = "businesses";

    protected $fillable = [
        'owner_name',
        'name',
        'phone_1',
        'phone_2',
        'mobile_1',
        'mobile_2',
        'address_1',
        'address_2',
        'logo',
        'email',
        'website',
    ];

    public function locations() {
        return $this->hasMany(BusinessLocation::class);
    }
}
