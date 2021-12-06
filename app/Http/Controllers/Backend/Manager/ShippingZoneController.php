<?php

namespace App\Http\Controllers\Backend\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShippingZoneRegion;
use App\Models\ShippingZoneCity;
use App\Models\ShippingZoneBrgy;
use Carbon\Carbon;

class ShippingZoneController extends Controller
{
    
    public function ViewAreas(){
    	return view('backend.shippingzone.shippingzone_view');
    }//end method

    public function RegionView(){
       $regions = ShippingZoneRegion::orderBy('region_name','ASC')->get();
        return response()->json(['regions' => $regions]);
    }//end method

    public function RegionStore(Request $request){
        $request->validate([
            'region_name'=> 'required',
        ]);

        $region_name = ucfirst($request->region_name);
        $exists = ShippingZoneRegion::where('region_name',$region_name)->first();

        if(!$exists){

            ShippingZoneRegion::insert([
                'region_name' => $region_name,
                'created_at' => Carbon::now(),
            ]);
            
            return response()->json(['success' =>  'New Region has Added']);
        }else{
            return response()->json(['info' => 'This region is already exist.']);
        }

    }//end method

    public function RegionUpdate(Request $request,$id){
        $request->validate([
            'region_name'=> 'required',
        ]);

        $region_name = ucfirst($request->region_name);
        $exists = ShippingZoneRegion::where('region_name',$region_name)->first();

        if(!$exists){

            ShippingZoneRegion::findOrFail($id)->update([
                'region_name' => $region_name,
                'updated_at' => Carbon::now(),
            ]);
            
            return response()->json(['success' =>  'Region Updated']);
        }else{
            return response()->json(['error' => 'Region'.$region_name.' is already exist.']);
        }
    }//end method

    public function RegionDelete($id){
        ShippingZoneRegion::findOrFail($id)->delete();
        ShippingZoneCity::where('region_id',$id)->delete();
        ShippingZoneBrgy::where('region_id',$id)->delete();
        return response()->json(['info' =>  'Region has been deleted']);
    }//end method

    private function GetCities($listofCities){
        $data = [];

        foreach($listofCities as $city){
            $data[] =[
                'region_name' => $city->Region($city->region_id),
                'region_id' => $city->region_id,
                'city_id' => $city->id,
                'city_name' => $city->city_name,
            ];
        }

        $newData = json_decode(json_encode($data),true);
        usort($newData, function($a,$b){
            return $a['region_name'] <=> $b['region_name'];
        });

         return array('cities' => $newData);
    }//end method

    public function GetRegionCity($regionId){
        $cities = ShippingZoneCity::where('region_id', $regionId)->get();
        return response()->json($this->GetCities($cities));
    }//end method

    public function CityView(){
        $cities = ShippingZoneCity::orderBy('region_id','ASC')->get();
        return response()->json($this->GetCities($cities));
    }//end method
    
    public function CityStore(Request $request){
        $request->validate([
            'region_id'=> 'required',
            'city_name'=> 'required',
        ]);

        $city_name = ucfirst($request->city_name);
        $exists = ShippingZoneCity::where('city_name',$city_name)->where('region_id',$request->region_id)->first();

        if(!$exists){

            ShippingZoneCity::insert([
                'region_id' => $request->region_id,
                'city_name' => $city_name,
                'created_at' => Carbon::now(),
            ]);
            
            return response()->json(['success' =>  'New City has been Added']);
        }else{
            return response()->json(['info' => 'This city is already exist.']);
        }

    }//end method

    public function CityUpdate(Request $request, $id){
        $request->validate([
            'region_id'=> 'required',
            'city_name'=> 'required',
        ]);

        $city_name = ucfirst($request->city_name);
        $exists = ShippingZoneCity::where('city_name',$city_name)->where('region_id',$request->region_id)->first();

        if(!$exists){

            ShippingZoneCity::findOrFail($id)->update([
                'region_id' => $request->region_id,
                'city_name' => $city_name,
                'updated_at' => Carbon::now(),
            ]);

            return response()->json(['success' =>  'New City has Added']);
        }else{
            return response()->json(['info' =>  $city_name.' is already exist.']);
        }

    }//end method

    public function CityDelete($id){
        ShippingZoneCity::findOrFail($id)->delete();
        ShippingZoneBrgy::where('city_id',$id)->delete();
        return response()->json(['info' =>  'City has been deleted']);
    }//end method

    public function BrgyView(){
        $brgyList = ShippingZoneBrgy::orderBy('region_id','ASC')->get();
        $data = [];

        foreach($brgyList as $brgy){
            $data[] =[
                'region_name' => $brgy->Region($brgy->region_id),
                'region_id' => $brgy->region_id,
                'city_name' => $brgy->City($brgy->city_id),
                'city_id' =>$brgy->city_id,
                'brgy_id' => $brgy->id,
                'brgy_name' => $brgy->brgy_name,
            ];
        }

        $newData = json_decode(json_encode($data),true);
        usort($newData, function($a,$b){
            return $a['region_name'] <=> $b['region_name'];
        });

        return response()->json(array('brgy' => $newData, '"tae" : "tae"'));
    }//end method

    public function BrgyStore(Request $request){
        $request->validate([
            'region_id'=> 'required',
            'city_id'=> 'required',
            'brgy_name'=> 'required',
        ]);

        $brgy_name = ucfirst($request->brgy_name);
        $exists = ShippingZoneBrgy::where('brgy_name',$brgy_name)->where('region_id',$request->region_id)->where('city_id',$request->city_id)->first();

        if(!$exists){

            ShippingZoneBrgy::insert([
                'region_id' => $request->region_id,
                'city_id' => $request->city_id,
                'brgy_name' => $brgy_name,
                'created_at' => Carbon::now(),
            ]);
            
            return response()->json(['success' =>  'New Barangay has been Added']);
        }else{
            return response()->json(['info' => 'This barangay is already exist.']);
        }

    }//end method


    public function BrgyUpdate(Request $request, $id){
        $request->validate([
            'region_id'=> 'required',
            'city_id'=> 'required',
            'brgy_name'=> 'required',
        ]);

        $brgy_name = ucfirst($request->brgy_name);
        $exists = ShippingZoneBrgy::where('brgy_name',$brgy_name)->where('region_id',$request->region_id)->where('city_id',$request->city_id)->first();

        if(!$exists){
            
            ShippingZoneBrgy::findOrFail($id)->update([
                'region_id' => $request->region_id,
                'city_id' => $request->city_id,
                'brgy_name' => $brgy_name,
                'updated_at' => Carbon::now(),
            ]);
            
            return response()->json(['success' =>  'New Barangay has been Added']);
        }else{
            return response()->json(['info' => 'This barangay is already exist.']);
        }

    }//end method

    public function BrgyDelete($id){
        ShippingZoneBrgy::findOrFail($id)->delete();
        return response()->json(['info' =>  'Barangay has been deleted']);
    }//end method


}
