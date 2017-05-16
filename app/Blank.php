<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class Blank extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'volume',
        'tariff',
        'date'
    ];

}
