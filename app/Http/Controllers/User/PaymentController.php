<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Backend\Manager\CouponController;
use App\Http\Controllers\Frontend\CartController;
use Darryldecode\Cart\Facades\CartFacade;
use App\Mail\OrderMail;
use App\Models\ShippingDetails;
use App\Models\Order;
use App\Models\OrderItems;
use Carbon\Carbon; 
use Auth;

class PaymentController extends Controller
{
    private $paid_date ="";
    private $hash = 3672625;


    public function Stripe(){
        
        \Stripe\Stripe::setApiKey(env('STRIPE_KEY'));
        $this->paid_date = Carbon::now()->format('M d, Y h:m A');
        $userId = $this->hash * (int)(auth()->user()->id);
        $total_amount = CouponController::GetCouponCalculation()['total_amount'];
        $error_msg = "";

        $coupon = array();
        $coupon_slug = "";
        $coupon_discount = 0;

        if (Session::has('coupon')) {
            $coupon = Session::get('coupon');
            $couponSlug =  $coupon['coupon_name'].'/'. $coupon['coupon_discount'].'/'. $coupon['coupon_validity'];
            $coupon_discount = (int)$coupon['coupon_discount'];
        }

        try {
            $token = $_POST['stripeToken'];
            $charge = \Stripe\Charge::create([
            'amount' => $total_amount,
            'currency' => 'usd',
            'description' => 'Grocery Payment',
            'source' => $token,
            'metadata' => ['user'=> $userId, 'invoice_no' => mt_rand(100000000000,999999999999),'coupon_used' => $coupon_slug, 'coupon_discount' => $coupon_discount ],
            ]);

            if($charge->status=='succeeded'){
                $method ='Stripe';

                $this->SaveOrder($charge,$method);

                $notification = array(
                    'message' => 'Your Order Place Successfully',
                    'order_message' => 'Your Order Place Successfully',
                    'alert-type' => 'order_succeeded',
                );
        
                return redirect()->route('user.orders')->with($notification);

            }else{
                
                $notification = array(
                    'message' => 'Your card was declined',
                    'order_message' => 'Transaction failed',
                    'alert-type' => 'order_failed',
                   );
                return redirect()->to('/')->with($notification);
            }

        } catch(\Stripe\Exception\CardException $e) {
            $error_msg = array($e->getError()->message . '\n');

        } catch (\Stripe\Exception\RateLimitException $e) {
            // Too many requests made to the API too quickly
            $error_msg = array($e->getError()->message . '\n');

        } catch (\Stripe\Exception\InvalidRequestException $e) {
            // Invalid parameters were supplied to Stripe's API
            $error_msg = array($e->getError()->message . '\n');

        } catch (\Stripe\Exception\AuthenticationException $e) {
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
            $error_msg = array($e->getError()->message . '\n');

        } catch (\Stripe\Exception\ApiConnectionException $e) {
            // Network communication with Stripe failed
            $error_msg = array($e->getError()->message . '\n');

        } catch (\Stripe\Exception\ApiErrorException $e) {
            // Display a very generic error to the user, and maybe send
            // yourself an email
            $error_msg = array($e->getError()->message . '\n');

        } catch (Exception $e) {
            // Something else happened, completely unrelated to Stripe
            $error_msg = array($e->getError()->message . '\n');
        }

        $notification = array(
            'message' => 'Your card was declined',
            'order_message' => $error_msg,
            'alert-type' => 'order_failed',
           );
        return redirect()->to('/')->with($notification);
    }

    public function CashOnDelivery(){
        $userId = $this->hash * (int)(auth()->user()->id);
        $total_amount = CouponController::GetCouponCalculation()['total_amount'];
        $method = "Cash On Deliver";

        
        $coupon = array();
        $coupon_slug = "";
        $coupon_discount = 0;

        if (Session::has('coupon')) {
            $coupon = Session::get('coupon');
            $couponSlug =  $coupon['coupon_name'].'/'. $coupon['coupon_discount'].'/'. $coupon['coupon_validity'];
            $coupon_discount = (int)$coupon['coupon_discount'];
        }

        $metadata = array(
            'user'=> $userId, 
            'invoice_no' => mt_rand(100000000000,999999999999),
            'coupon_used' => $coupon_slug,
            'coupon_discount' => $coupon_discount 
        );

        $array = array(
                'id' => 'cod'.uniqid(),
                'payment_method' => 'cod',
                'balance_transaction' => '',
                'amount' => $total_amount,
                'metadata' => (object)$metadata,
        );

        $charge =(object)$array;


        $this->SaveOrder($charge,$method);

        $notification = array(
            'message' => 'Your Order Place Successfully',
            'order_message' => 'Your Order Place Successfully',
            'alert-type' => 'order_succeeded',
        );

        return redirect()->route('user.orders')->with($notification);
    }

    private function SaveOrder($charge,$method){
        $userId = (int)$charge->metadata->user/$this->hash;
        $cartTotal = CartFacade::session($userId)->getTotal();
        $cart_unit = CartFacade::session($userId)->getTotalQuantity();
        $shipping_id = ShippingDetails::where('user_id',$userId)->first()->id;

        $order_id = Order::insertGetId([
            'user_id' => (string)$userId,
            'shipping_id'=> $shipping_id,
            'payment_method' => $method,
            'payment_type' => $charge->payment_method,
            'transaction_id' => $charge->id,
            'balance_transaction' => $charge->balance_transaction,
            'coupon_used' => $charge->metadata->coupon_used,
            'product_units' => $cart_unit,
            'sub_total' => $cartTotal,
            'amount' =>  $charge->amount,
            'invoice_no' => $charge->metadata->invoice_no,
            'place_date'  => Carbon::now()->format('M d, Y h:m A'),
            'paid_date'  => $this->paid_date,
            'status' => 'pending',
            'created_at' => Carbon::now(),	 
            ]);

        $carts = CartFacade::session($userId)->getContent();
        foreach ($carts as $cart) {
            OrderItems::insert([
                'order_id' => $order_id, 
                'product_id' => $cart->attributes->id,
                'cart_id' => $cart->id,
                'color' => $cart->attributes->color,
                'qty' => $cart->quantity,
                'sum' => $cart->price,
                'created_at' => Carbon::now(),
            ]);
        }

        //Start Send Email 
        $invoice = Order::findOrFail($order_id);
        $cart =   CartController::ViewCart()['cart'];
        $info = ShippingDetails::findOrFail($invoice->shipping_id);
            $data = [
                'invoice_no' => $invoice->invoice_no,
                'sub_total' => $invoice->sub_total,
                'total_amount' => $invoice->amount,
                'discount' =>  $charge->metadata->coupon_discount,
                'name' => $info->user_name,
                'email' => $info->user_email,
                'date' => $invoice->created_at,
                'payment_method' => $invoice->payment_method,
                'transaction_id' => $invoice->transaction_id,
            ];

            Mail::to($info->user_email)->send(new OrderMail($data,$cart ));

        // End Send Email 

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        CartFacade::session($userId)->clear();

    }
}
