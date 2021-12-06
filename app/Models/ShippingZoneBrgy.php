<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ShippingZoneRegion;
use App\Models\ShippingZoneCity;



class ShippingZoneBrgy extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function Region($regionId){
        $region = ShippingZoneRegion::where('id',$regionId)->first();
        return $region->region_name;
    }

    public function City($cityId){
        $city = ShippingZoneCity::where('id',$cityId)->first();
        return $city->city_name;
    }
}
