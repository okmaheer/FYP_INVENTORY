<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;

    protected $fillable =
    [

            'protocol',
            'smtp_host',
            'smtp_port',
            'smtp_user',
            'smtp_pass',
            'mailtype',
            'isinvoice',
            'isservice',
            'isquotation',
            'type',

    ];

}
