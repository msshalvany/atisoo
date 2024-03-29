<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class info extends Model
{
    use HasFactory;
    protected $fillable = [
        'indexKey',
        'searchFlashKey',
        'searchUpdateKey',
        'byFlahYouKey', 
        'byUpdateYouKey', 
        'resetDeviceKey', 
        'resetCamKey', 
        'deviceKey', 
        'logo',
        'ruls',
        'ibaladam',
    ];
}
