<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Faker\Provider\tr_TR\Company;

class QrCodeCore extends Model
{
    protected $table = 'qrcode';
    //<?php
    protected $fillable = [
        'id',
        'codes',
        'created_at',
        'sent',
        'used'     
    ];
}
