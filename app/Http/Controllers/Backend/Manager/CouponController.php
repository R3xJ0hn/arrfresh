<?php

namespace App\Http\Controllers\Backend\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Darryldecode\Cart\Facades\CartFacade;
use App\Models\Coupon;
use Carbon\Carbon;

class CouponController extends Controller
{
   
    public function CouponView(){
    	$coupons = Coupon::orderBy('id','DESC')->get();
    	return view('backend.coupon.view_coupon',compact('coupons'));
    } // end method 

    public function CouponStore(Request $request){

    	$request->validate([
    		'coupon_name' => 'required',
    		'coupon_discount' => 'required',
    		'coupon_validity' => 'required',
    	]);

	    Coupon::insert([
		'coupon_name' => strtoupper($request->coupon_name),
		'coupon_discount' => $request->coupon_discount, 
		'coupon_validity' => $request->coupon_validity,
		'created_at' => Carbon::now(),

    	]);

	    $notification = array(
			'message' => 'Coupon Inserted Successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);

    } // end method 

    public function CouponUpdate(Request $request, $id){

      Coupon::findOrFail($id)->update([
		'coupon_name' => strtoupper($request->coupon_name),
		'coupon_discount' => $request->coupon_discount, 
		'coupon_validity' => $request->coupon_validity,
		'created_at' => Carbon::now(),
    	]);

	    $notification = array(
			'message' => 'Coupon Updated Successfully',
			'alert-type' => 'info'
		);

		return redirect()->route('manage-coupon')->with($notification);
    } // end mehtod 

    public function CouponDelete($id){
    	Coupon::findOrFail($id)->delete();
    	$notification = array(
			'message' => 'Coupon Deleted Successfully',
			'alert-type' => 'info'
		);
		return redirect()->back()->with($notification);
    } // end method 

    public function CouponApply(Request $request){

        $coupon = Coupon::where('coupon_name',$request->coupon_name)->where('coupon_validity','>=',Carbon::now()->format('Y-m-d'))->first();
        if ($coupon) {

			$userId = auth()->user()->id; 
			$cartTotal = CartFacade::session($userId)->getTotal();

            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'coupon_validity' => $coupon->coupon_validity,
            ]);
 
            return response()->json(array(
                'validity' => true,
                'success' => 'Coupon Applied Successfully'
            ));
            
        }else{
            return response()->json(['error' => 'Invalid Coupon']);
        }
    } // end method 

    public static function GetCouponCalculation(){
        $userId = auth()->user()->id; 
		$cartTotal = CartFacade::session($userId)->getTotal();

        if (Session::has('coupon')) {
            $couponDiscount = session()->get('coupon')['coupon_discount'];
            $discount_amount = round($cartTotal * ((float)$couponDiscount/100));

            return array(
                'hasCoupon' => true,
                'subtotal' => $cartTotal,
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' =>  $discount_amount, 
                'total_amount' => round($cartTotal - $discount_amount)
            );

        }else{
            return array('total_amount' => $cartTotal, 'hasCoupon' => false );
        }
    }

    public function CouponCalculation(){ 
        return response()->json($this->GetCouponCalculation());
    } // end method 

    public function CouponRemove(){
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Remove Successfully']);
    } // end method 
}
