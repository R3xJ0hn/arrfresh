@extends('frontend.main_master')
@section('content')

<style>
    .order-table tr td{  padding: 10px !important;}
    .table-responsive{ height:50vh; overflow-y: scroll; padding: 0 1rem; margin-bottom: 1rem;}
    .user-thead{position: sticky; top:0; background:#157ed2; color:#fdfcfc; z-index: 999;}
    th{ text-align: center}
    td{text-align: center;}
</style>

<div class="body-content">
    <div class="container" style="margin-left: 1rem">
        <div class="row" style="height: 70vh; padding-top: 2rem;">

            <div class="col-lg-3" style="padding:1rem">
                @include('frontend.common.user_sidebar');
            </div>

            
            <div class="col-md-9 pull-right" style="padding: 1rem">

                <div  style="background:#fdfcfc; padding:1rem" >
                    <h3 class="sub-header" style="padding-left: 1rem">My Orders</h3>
                    <div class="table-responsive">
                        
                        <table class="table table-striped" >
                          <thead class="user-thead">
                            <tr>
                              <th class="text-center">Invoice</th>
                              <th>Date</th>
                              <th>Unit</th>
                              <th>Amount</th>
                              <th>Status</th>
                              <th>Payment</th>
                              <th>Action</th>
                            </tr>
                          </thead>
    
                          <tbody class="order-table">
    
                            @foreach ($invoice as $order)
                            
                                <tr >
                                    <td>{{$order['invoice_no']}}</td>
                                    <td>{{$order['place_date']}}</td>
                                    <td>{{$order['product_units']}}</td>
                                    <td> ₱ {{$order['amount']}}</td>
                                    <td>
                                        <span class="badge badge-pill" style="background: #418db9">{{$order['status']}}</span>
                                        </td>
                                    <td>{{$order['payment_method']}}</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-sm-4" style="padding: 0">
                                                <a href="{{route('user.orders.details',['order_id'=>$order['id']])}}" class="text-warning"> <i class="fa fa-eye"> View</i></a>
                                            </div>
    
                                            <div class="col-sm-8" style="padding: 0 1rem">
                                                <a href="{{route('user.pdf.invoice',['order_id'=>$order['id']])}}" class="text-secondary"> <i class="fa fa-download"> Invoice</i></a>
                                            </div>
                                        </div>
                                    </td>
      
                                </tr>
                                
                            @endforeach
    
                          </tbody>
                        </table>
                    </div>
                </div>

            </div>

   
        </div>
    </div>
    <!-- end container-->
</div>
<!-- end body-content-->
@endsection