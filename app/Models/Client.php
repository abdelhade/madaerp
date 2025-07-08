<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name', 'phone', 'phone2', 'address', 'address2', 'address3', 'city',
        'height', 'weight', 'dateofbirth', 'ref', 'diseses', 'info',
        'imgs', 'jop', 'gender', 'drugs', 'seriousdes', 'familydes', 'allergy',
        'temp', 'pressure', 'diabetes', 'brate', 'isdeleted', 'tenant', 'branch'
    ];
}
