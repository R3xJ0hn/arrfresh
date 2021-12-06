<?php

namespace App\Http\Controllers\Backend\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderItems; 
use App\Models\ShippingDetails;

use Auth;
use Carbon\Carbon;
use PDF; 
 
class OrderController extends Controller
{

    public static function ViewInvoice($order_id){
        $order = Order::where('id',$order_id)->first();
        $orderItems = OrderItems::with('product')->where('order_id',$order_id)->get();
        $userId = $order->user_id;
        $shippingDetails = ShippingDetails::where('user_id',$userId)->first();
        $user_address = $shippingDetails->house . ' ' . $shippingDetails->street;
        $paid_date = "";

        if( $order->payment_method== "Cash On Deliver"){
            $paid_date = "pending";
        }else{
            $paid_date = $order->place_date;
        }

        $cart =[];
    
        foreach($orderItems as $item)
        {
            $cart[] = [
                'rowId' => $item->cart_id, 
                'productName' =>  $item->product->product_name,
                'productSKU' =>  $item->product->product_sku,
                'productLocation' =>  $item->product->product_location,
                'productPrice' => $item->product->product_selling_price, 
                'productSum' =>  $item->sum, 
                'productQty' =>  $item->qty, 
                'productId' => $item->product->id,
                'productImg' =>  $item->product->product_thumbnail,
                'productColor'=> $item->color,
                'productSize'=> $item->product->product_size, 
                'productSlug' => $item->product->product_slug, 
                'productStock' => $item->product->product_stock, 
            ];
        }

        return array(
            'id' =>$order_id,
            'company_name' => env('APP_NAME'),
            'company_email' => env('MAIL_USERNAME'),
            'company_phone' => '09876543212',
            'company_url' => env('APP_URL'),
            'user_name' =>  $shippingDetails->user_name,
            'user_email' => $shippingDetails->user_email,
            'user_phone' => $shippingDetails->user_phone,
            'user_address' => $user_address,
            'user_zipcode' => $shippingDetails->zip_code,

            'place_date'  => $order->place_date,
            'paid_date'  => $paid_date,
            'tracking_no' => $order->tracking_number,
            'shipped_date' => $order->shipped_date,
            'total_units' =>$order->product_units,
            'status' => $order->status,
            'payment_method' => $order->payment_method,
            'transaction_id' => $order->transaction_id,
            'invoice_no' => $order->invoice_no,
            'sub_total' =>$order->sub_total,
            'amount' => $order->amount,
            'cart' => $cart,
        );
    }

    private function GetOrders($status){
        $invoice = Order::where('status',$status)->orderBy('created_at')->get();
        $data=[];
        foreach($invoice as $item){
            $username = User::where('id',$item->user_id)->first()->name;
            $placeDate =Carbon::create($item->place_date);

            $data[]= [
                'id' =>$item->id,
                'invoice_no' => $item->invoice_no,
                'pick_bin'  => $item->pick_bin,
                'user_name' => $username,
                'place_date' =>$placeDate->format('M d Y h:i:s A'),
                'picked_date' => $item->picked_date,
                'delivered_date' => $item->shipped_date,
                'product_units' => $item->product_units,
                'amount' => $item->amount,
                'payment_method' => $item->payment_method,
            ];
        }
        return $data;
    }

	public static function GetAllOrders(){
        $invoice = Order::where('status','!=','delivered')->orderBy('created_at')->get();
        $data=[];
        foreach($invoice as $item){
            $username = User::where('id',$item->user_id)->first()->name;

            $data[]= [
                'id' =>$item->id,
                'invoice_no' => $item->invoice_no,
                'user_name' => $username,
                'place_date' => $item->place_date,
                'delivered_date' => $item->shipped_date,
                'status' => $item->status,
                'product_units' => $item->product_units,
                'amount' => $item->amount,
                'payment_method' => $item->payment_method,
            ];
        }
        return $data;
	} // end mehtod 

    
    Private Function GenerateDataToSendBack($order){
        //This Data Use To Display on the Picker, and QC personels
        //that send back to the AJAX Request
        if($order){
            $orderItems = OrderItems::with('product')->where('order_id',$order->id)->get();

            $cart =[];
            foreach($orderItems as $item)
            {
                $cart[] = [
                    'productName' =>  $item->product->product_name,
                    'productSKU' =>  $item->product->product_sku,
                    'productLocation' =>  $item->product->product_location,
                    'productQty' =>  $item->qty, 
                    'productImg' =>  $item->product->product_thumbnail,
                    'productColor'=> $item->color,
                    'productSize'=> $item->product->product_size, 
                    'productStock' => $item->product->product_stock, 
                ];
            }
    
            return array(
                'order_id'=>$order->id,
                'total_units' =>$order->product_units,
                'invoice_no' => $order->invoice_no,
                'status' =>$order->status,
                'pick_bin'  =>$order->pick_bin,
                'cart' => $cart,
            );
        }

    }

    // View Order details In New Page
	public function OrderViewDetails($order_id){
        $orders = $this->ViewInvoice($order_id);
    	return view('backend.orders.order_view',compact('orders'));
	} // end method 

	//-------------------- PENDING ORDER ----------------------//
	public function PendingOrders(){
        $invoice = $this->GetOrders('pending'); 
		return view('backend.orders.pending_orders',compact('invoice'));
	} 

    //-------------------- PICK ORDERS ----------------------//
    public function BeginToPickOrder($orderID){
        if($orderID != '0'){//Manually Select which order To Pick
            $order_id = $orderID;
            return view('backend.orders.picking_view',compact('order_id'));
        }else{//Automatically Select First Order
            $order = Order::where('status','pending')->orderBy('created_at')->first();
            if($order){
                $order_id =$order->id;
                return view('backend.orders.picking_view',compact('order_id'));
            }else{
                return redirect()->route('pending-orders');
            }
        }
    }

    public function GetToPickOrder($id){
        $order = Order::where('id', $id)->where('status','pending')->first();
        return $this->GenerateDataToSendBack($order);
    }// end method 

    public function SkipToPickOrder($id){
        $lastOrder = Order::orderBy('id','DESC')->first()->id;

        if($id == $lastOrder){
            return response()->json([
                'redirect' => '/orders/pending',
                'info' => 'You already skip all the orders.',
            ]);
        }else{
            return $this->GetNextOrderToPick($id);;
        }

    }// end method 

    public function ConfirmedPick(Request $request,$id){

        $exist = Order::where('pick_bin',$request->pickbin)->where('status','picked')->first();

        if(!$exist){
            Order::findOrFail($id)->update([
                'status' => 'Picked',
                'pick_bin' => $request->pickbin,
                'picked_date' =>  Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            $data = $this->GetNextOrderToPick($id);

            if($data){
                return response()->json([
                    'success' => 'Successfully Picked Order',
                    'data' =>$data,
                ]);
            }else{
                return response()->json([
                    'redirect' => '/orders/pending',
                    'info' => 'No order placed ',
                ]);
            }

        }else{
            return response()->json([
                'error' => 'Pick Bin is already been used.'
            ]);
        }
    }

    private function GetNextOrderToPick($order_id)
    { 
        $nextOrder = Order::where('status','pending')->where('id','>',$order_id)->min('id');
        $order = Order::where('id', $nextOrder)->first();
        return $this->GenerateDataToSendBack($order);
    }

	//-------------------- PICKED ORDER ----------------------//
	public function PickedOrders(){
        $invoice = $this->GetOrders('Picked'); 
		return view('backend.orders.picked_orders',compact('invoice'));
	} 

    //-------------------- QC ORDER ----------------------//

    public function BeginToQCOrders()
    {
        if($this->GetOrders('Picked')){
            return view('backend.orders.qcorders_view');
        }else{
            return redirect()->route('picked-orders');
        }
	}

    public function GetOrderToQC($pick_bin){
        $order = Order::where('pick_bin', $pick_bin)->where('status','Picked')->first();

        if(!$order){
            return response()->json([
                'error' => 'Orders Not Found',
            ]);
        }

        return $this->GenerateDataToSendBack($order);
	} 

    public function QCConfirmed($id)
    {
        Order::findOrFail($id)->update([
            'status' => 'QC',
            'pick_bin' => '',
            'tracking_number' => mt_rand(100000000000,999999999999),
            'shipped_date' =>  Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $invoice = $this->ViewInvoice($id);
        $pdf = PDF::loadView('mail.waybill', compact('invoice'))->setPaper('a6')->setOptions([
                'tempDir' => public_path(),
                'chroot' => public_path(),
        ]);
        return $pdf->download('awb.pdf');
    }


    public function VerifyToQCOrders()
    {
        $order = Order::where('status','Picked')->first();
        if(!$order){
            return response()->json([
                'redirect' => '/orders/ship',
                'info' => 'No Available Orders to Qc',
            ]);
        }
    }


 //-------------------- SHIPPED ORDER ----------------------//
    public function ShipOrders(){
        $orders = $this->GetOrders('Qc'); 
		return view('backend.orders.ship_orders',compact('orders'));
	} // end mehtod 

    public function ShipConfirm($order_id){
        
        Order::findOrFail($order_id)->update([
            'status' => 'Delivered',
            'shipped_date' =>  Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $orders = $this->GetOrders('ready'); 
        $notif = array(
            'success' => 'Added Order Sucessfully',
        );

        return redirect()->back()->with($notif);
	} // end mehtod 

    public function DeliveredParcel(){
        $parcels = $this->GetOrders('Delivered'); 
		return view('backend.orders.delivered_parcel',compact('parcels'));
    }

    public function InvoiceDownload($order_id){
        $data = $this->ViewInvoice($order_id);
    	// return view('frontend.profile.order_invoice',compact('data'));
		$pdf = PDF::loadView('frontend.profile.order_invoice',compact('data'))->setPaper('a4')->setOptions([
				'tempDir' => public_path(),
				'chroot' => public_path(),
		]);
		return $pdf->download('invoice.pdf');
    } 
}
 