<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ShippingZoneRegion;


class ShippingZoneCity extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function Region($regionId){
        $region = ShippingZoneRegion::where('id',$regionId)->first();
        return $region->region_name;
    }
}
