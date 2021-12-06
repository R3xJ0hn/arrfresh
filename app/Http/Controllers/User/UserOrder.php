<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Backend\Manager\OrderController;
use App\Models\Order;
use App\Models\OrderItems;

use Carbon\Carbon; 
use PDF;
use Auth;

class UserOrder extends Controller
{

    public function UserOrders(){
    	$orders = Order::where('user_id',Auth::id())->get();

        $status = '';
        $invoice =[];

        foreach($orders as $order){
            $status = ($order->status == 'Picked' || $order->status == 'Qc') ? 'Processing' : $order->status;
            $invoice[$order->invoice_no] = [
                'invoice_no'=>  $order->invoice_no,
                'place_date'=> $order->place_date,
                'product_units'=> $order->product_units,
                'payment_method'=> $order->payment_method,
                'amount'=> $order->amount,
                'status'=> $status,
                'id'=> $order->id];
        }

    	return view('frontend.profile.order_view',compact('invoice'));
    } // end mehtod 

    public function OrderDetails($order_id){
        $data = OrderController::ViewInvoice($order_id);
        return view('frontend.profile.order_details',compact('data'));
    } // end mehtod 

    public function InvoiceDownload($order_id){
        $data = OrderController::ViewInvoice($order_id);
    	// return view('frontend.profile.order_invoice',compact('data'));
		$pdf = PDF::loadView('frontend.profile.order_invoice',compact('data'))->setPaper('a4')->setOptions([
				'tempDir' => public_path(),
				'chroot' => public_path(),
		]);
		return $pdf->download('invoice.pdf');
    } 


    // public function ReturnOrder(Request $request,$order_id){

    //     Order::findOrFail($order_id)->update([
    //         'return_date' => Carbon::now()->format('d F Y'),
    //         'return_reason' => $request->return_reason,
    //         'return_order' => 1,
    //     ]);

    //   $notification = array(
    //         'message' => 'Return Request Send Successfully',
    //         'alert-type' => 'success'
    //     );

    //     return redirect()->route('my.orders')->with($notification);

    // } // end method 

    // public function ReturnOrderList(){

    //     $orders = Order::where('user_id',Auth::id())->where('return_reason','!=',NULL)->orderBy('id','DESC')->get();
    //     return view('frontend.user.order.return_order_view',compact('orders'));

    // } // end method 

    // public function CancelOrders(){

    //     $orders = Order::where('user_id',Auth::id())->where('status','cancel')->orderBy('id','DESC')->get();
    //     return view('frontend.user.order.cancel_order_view',compact('orders'));

    // } // end method 



    ///////////// Order Traking ///////

    // public function OrderTraking(Request $request){

    //     $invoice = $request->code;

    //     $track = Order::where('invoice_no',$invoice)->first();

    //     if ($track) {
            
    //         // echo "<pre>";
    //         // print_r($track);

    //     return view('frontend.traking.track_order',compact('track'));

    //     }else{

    //         $notification = array(
    //         'message' => 'Invoice Code Is Invalid',
    //         'alert-type' => 'error'
    //     );

    //     return redirect()->back()->with($notification);

    //     }

    // } // end mehtod 



}
