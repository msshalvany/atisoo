<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class device extends Model
{
    use HasFactory;

    protected $fillable = [
        'name1',
        'name2',
        'name3',
        'iprom',
        'flash',
        'ipromPrice',
        'flashPrice',
        'flashSize',
        'ic',
        'imags',
        'path',
        'lable',
        'chanel',
        'ipromName',
        'password',
        'description',
        'id2',
    ];
}
