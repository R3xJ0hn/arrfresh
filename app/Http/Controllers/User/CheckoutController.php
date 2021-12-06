<?php

namespace App\Http\Controllers\User;
use Darryldecode\Cart\Facades\CartFacade;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Controller;
use App\Models\ShippingZoneCity;
use App\Models\ShippingZoneBrgy;
use App\Models\ShippingDetails;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

class CheckoutController extends Controller
{
    
    public function GetCities($region_id){
    	$zone = ShippingZoneCity::where('region_id',$region_id)->orderBy('city_name','ASC')->get();
    	return json_encode($zone);
    } // end method 


     public function GetBrgy($city_id){
        $zone = ShippingZoneBrgy::where('city_id',$city_id)->orderBy('brgy_name','ASC')->get();
    	return json_encode($zone);
    } // end method 


    public function CheckoutStore(Request $request){
        $userId = auth()->user()->id;  
        $exists = ShippingDetails::where('user_id',$userId)->first();
        $cart =   CartController::ViewCart()['cart'];

        if (!$exists){
            ShippingDetails::insert([
                'user_id' => $userId,
                'user_name' => $request->user_name,
                'user_email' => $request->user_email,
                'user_phone' => $request->user_phone,
                'zip_code' => $request->zip_code,
                'region_id' => (int)$request->region_select,
                'city_id' =>  (int)$request->city_select,
                'brgy_id' =>  (int)$request->brgy_select,
                'street' => $request->street,
                'house' => $request->house,
                'notes' => $request->notes,
                'payment_method' => $request->payment_method,
                'created_at' => Carbon::now(),   
                'updated_at' => Carbon::now(),   
            ]);

        }else{
            
            ShippingDetails::findOrFail($exists->id)->update([
                'user_id' => $userId,
                'user_name' => $request->user_name,
                'user_email' => $request->user_email,
                'user_phone' => $request->user_phone,
                'zip_code' => $request->zip_code,
                'region_id' => (int)$request->region_select,
                'city_id' =>  (int)$request->city_select,
                'brgy_id' =>  (int)$request->brgy_select,
                'street' => $request->street,
                'house' => $request->house,
                'notes' => $request->notes,
                'payment_method' => $request->payment_method,
                'updated_at' => Carbon::now(),   
            ]);
            
        }

    	if ($request->payment_method == 'stripe') {
    	 	return view('frontend.payment.stripe', compact('cart'));
    	}else{
            return redirect()->route('cod.order');
        }

    }// end mehtod. 
}
