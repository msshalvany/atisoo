<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class byed extends Model
{
    use HasFactory;

    protected $fillable = [
        'userId',
        'flash',
        'deviceId',
        'iprom',
        'updateFile_id',
        'package_id',
    ];
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
