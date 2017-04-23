<?php

namespace App;

class ElectricityBlank extends Blank_Base
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

    public function house() {
        //return $this->belongsTo(House::class, 'house_id');
    }
}
