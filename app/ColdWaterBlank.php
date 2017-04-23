<?php

namespace App;

class ColdWaterBlank extends Blank_Base
{
    public $timestamps = false;

    protected $fillable = [
        'norm',
        'total_volume_of_MKD',
        'tariff_with_NDS',
        'volume_of_services',
        'charged',
        'recalculation',
        'total_charged',
        'date'
    ];

}
