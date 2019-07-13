<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Manufactures extends Model
{
    protected $table = 'manufactures';
    protected $fillable = [
        'name_ar',
        'name_en',
        'address',
        'icon',
        'facebook',
        'twitter',
        'website',
        'contact_name',
        'lat',
        'lng',
        'mobile',
        'email',
    ];
}
