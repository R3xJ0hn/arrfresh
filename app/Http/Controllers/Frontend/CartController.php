<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ShippingZoneRegion;
use App\Models\ShippingDetails;

use Cart;
use Auth;


class CartController extends Controller
{

    private function CalcQty($cart, $reqQty){
        if(empty($cart)){
            return (int)$reqQty;
        }else{
            return ((int)$cart->quantity) + (int)$reqQty;
        }
    }

    private function ValidateQuantity($qty,$available) {
        if($qty < 1 ){
            return array('error' => 'Quantity should be more than 1');
        }
                
        if($qty < 1 or $qty > $available){
            return array('error' => 'The product has '.$available.' unit available only.');
        }
        return null;
    }

    public function AddToCart(Request $request, $productId){
        if (Auth::check()){
            $product = Product::find($productId); 
            $userID = auth()->user()->id; 
            $rowId = 345678910 + $productId + $userID; 
            $cart = Cart::session($userID)->get($rowId);
            $productStock= $product->product_available_stock;
            $qty = $this->CalcQty($cart, $request->quantity);

            if(!empty($this->ValidateQuantity($qty, $productStock))){
                return response()->json($this->ValidateQuantity($qty, $productStock));
            }

            if ($product->product_discount_price == 0){

                // UPDATE PRODUCT QUANTITY
                Product::findOrFail($product->id)->update([
                    'product_available_stock' =>  $productStock -(int)$request->quantity,
                 ]);
    
                Cart::session($userID)->add(array(
                    'id' => $rowId,
                    'name' =>  $request->product_name, 
                    'price' => (float) $product->product_selling_price,
                    'quantity' => (int)$request->quantity,
                    'attributes' =>  [
                                'id'   => $product->id,
                                'image' => $product->product_thumbnail,
                                'color' => $request->color,
                                'size' => $request->size,
                                'slug' => $product->product_slug,
                            ],
                ));
    
                return response()->json(['success' =>  'Successfully Added to Your Cart.']);
    
            }else{

                // UPDATE PRODUCT QUANTITY
                Product::findOrFail($product->id)->update([
                    'product_available_stock' =>  $productStock -(int)$request->quantity,
                    ]);
                
                Cart::session($userID)->add(array(
                    'id' => $rowId,
                    'name' =>  $request->product_name, 
                    'price' => (float)$product->product_discount_price,
                    'quantity' => (int)$request->quantity,
                    'attributes' =>  [
                                'id'   => $product->id,
                                'image' => $product->product_thumbnail,
                                'color' => $request->color,
                                'size' => $request->size,
                                'slug' => $product->product_slug,
                            ],
                ));
    
                return response()->json(['success' =>  'Successfully Added to Your Cart.']);
            }

        }else{
            return response()->json(['error' => 'You must to Login First.']);
        }
    } //end method

    public function RemoveToCart($rowId){
        $userId = auth()->user()->id; 

        $cart = Cart::session($userId)->get($rowId);
        $product = Product::find($cart->attributes['id']); 
        
        Cart::session($userId)->remove($rowId);
        $isCartEmpty = Cart::session($userId)->isEmpty();

        // UPDATE PRODUCT QUANTITY
        Product::findOrFail($product->id)->update([
            'product_available_stock' =>  (int)$product->product_available_stock + (int)($cart->quantity),
        ]);

        return response()->json(['success' => 'Product Remove from Cart', 'isCartEmpty' =>   $isCartEmpty ]);
    } // end mehtod 

    public static function ViewCart(){
        $userId = auth()->user()->id; 
        $items = Cart::session($userId)->getContent();
        $cartQty = Cart::session($userId)->getTotalQuantity();
        $cartTotal = Cart::session($userId)->getTotal();
        $cart =[];

        foreach($items as $item)
        {
            $product = Product::find($item->attributes->id); 
            $cart[] = [
                'rowId' => $item->id, 
                'productName' =>  $item->name, 
                'productPrice' =>  $item->price,
                'productSum' =>  $item->getPriceSum(), 
                'productQty' =>  $item->quantity, 
                'productId' => $item->attributes->id,
                'productImg' => $item->attributes->image,
                'productColor'=> $item->attributes->color,
                'productSize'=> $item->attributes->size,
                'productSlug' => $item->attributes->slug,
                'productStock' => $product->product_stock,
            ];
        }

        $newData = json_decode(json_encode($cart),true);
        usort($newData, function($a,$b){
            return $a['productName'] <=> $b['productName'];
        });

        return array(
            'cartQty' => $cartQty,
            'cartTotal' =>  $cartTotal,
            'cart' => $newData,
        );
    } // end mehtod 

    public function Cart(){
        return response()->json($this->ViewCart());
    } // end mehtod 

    public function MyCart(){
        if (Auth::check()){
            $userId = auth()->user()->id;
            $isCartEmpty = Cart::session($userId)->isEmpty();
            return view('frontend.cart.view_mycart', compact('isCartEmpty'));
        }else{
            return redirect()->to('/');
        }
    } // end mehtod 


    private function UpdateCartQty($rowId, $qty){
        $userId = auth()->user()->id; 
        $item = Cart::session($userId)->get($rowId);

        $productStock = Product::find($item->attributes->id)->product_stock;
        $available = ($productStock-(int)($item->quantity));

        if(!empty($this->ValidateQuantity($qty, $productStock))){
            return response()->json($this->ValidateQuantity($qty, $productStock));
        }

         Cart::session($userId)->update($rowId, array(
            'quantity' => array(
                'relative' => false,
                'value' => $qty
            ),
        ));

        return array( 'qty' =>  $qty );
    } // end mehtod 


    public function IncrementCartQty(Request $request){
        $userId = auth()->user()->id; 
        $cart = Cart::session($userId)->get($request->row);
        $qty = (int)($cart->quantity) + 1;
        return response()->json($this->UpdateCartQty($request->row,$qty));
    }

    public function DecrementCartQty(Request $request){
        $userId = auth()->user()->id; 
        $cart = Cart::session($userId)->get($request->row);
        $qty = (int)($cart->quantity) - 1;
        return response()->json($this->UpdateCartQty($request->row,$qty));
    }

    public function ChangeCartQty(Request $request){
        return response()->json($this->UpdateCartQty($request->row,$request->qty));
    }



// Checkout Method 
public function CreateCheckout(){

    if (Auth::check()) {
        $userId = auth()->user()->id; 
        $items = Cart::session($userId)->getContent();

        if (Cart::getTotal() > 0) {
            $userDetails = ShippingDetails::where('user_id',$userId)->first();
            $regions = ShippingZoneRegion::orderBy('region_name','ASC')->get();
            $cart = new Collection;
            $cart = $this->ViewCart()['cart'];
            $userInfo = array();

            if($userDetails){
                $userInfo['user_name'] =  $userDetails->user_name;
                $userInfo['user_email'] =  $userDetails->user_email;
                $userInfo['user_phone'] =  $userDetails->user_phone;
                $userInfo['zip_code'] =  $userDetails->zip_code;
                $userInfo['region_id'] =  $userDetails->region_id;
                $userInfo['city_id'] =  $userDetails->city_id;
                $userInfo['brgy_id'] =  $userDetails->brgy_id;
                $userInfo['notes'] =  $userDetails->notes;
                $userInfo['street'] =  $userDetails->street;
                $userInfo['house'] =  $userDetails->house;
                $userInfo['payment_method'] =  $userDetails->payment_method;

                return view('frontend.checkout.checkout_view', compact('cart','regions','userInfo'));

            }else{

                $userInfo['user_name'] = Auth::user()->name;
                $userInfo['user_email'] = Auth::user()->email;
                $userInfo['user_phone'] = Auth::user()->phone; 
                $userInfo['zip_code'] = "";
                $userInfo['region_id'] = "";
                $userInfo['city_id'] = "";
                $userInfo['brgy_id'] = "";
                $userInfo['notes'] = "";
                $userInfo['street'] = "";
                $userInfo['house'] = "";
                $userInfo['payment_method'] = "";

                return view('frontend.checkout.checkout_view', compact('cart','regions','userInfo'));
            }
                
        }else{

            $notification = array(
            'message' => 'You must to shop at least one product.',
            'alert-type' => 'info'
            );
            return redirect()->to('/')->with($notification);
        }
        
    }else{
        return redirect()->to('/');
    }

} // end method 

}
