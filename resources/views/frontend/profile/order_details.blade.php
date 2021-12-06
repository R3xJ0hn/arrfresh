@extends('frontend.main_master')
@section('content')
<style>
    .table-order-info{ width: 100%}
    .table-order-info td:nth-child(2){
        text-align: left;
            padding: 0.5rem 1rem ;
        }
</style>

<div class="body-content" style="margin-bottom: 1rem">
    <div class="container" style="margin: 1%">
        <div class="row" >

            <div class="col-lg-3"  >
                @include('frontend.common.user_sidebar');
            </div>

            <div class="col-lg-9"  >

                <div class="row">

                    <div class="col-md-6" style="padding: 1rem;">
                        <div class="col" style="background:#fdfcfc;">
                            <h5 style="padding: 2rem; padding-bottom:0;">
                            <a href="{{route('user.orders')}}"> <li class="fa fa-arrow-left"></li> Back to My Orders</a>
                            </h5>
                            <hr>
                            <div style="padding: 0.5rem; padding-top:0; ">

                                <div style="background:#f3f3f3; padding: 1.5rem;">

                                    <h4 style="margin:0; ">
                                        Order Details
                                     </h4>
                                     <hr>
                                     <table class="table-order-info">
     
                                         <tr>
                                             <td><strong>Place on: </strong> </td>
                                             <td>{{$data['place_date']}}</td>
                                         </tr>
     
                                         <tr>
                                             <td><strong>Paid on: </strong> </td>
                                             <td>{{$data['paid_date']}}</td>
                                         </tr>
     
                                         <tr>
                                             <td><strong>Units: </strong> </td>
                                             <td>{{$data['total_units']}}</td>
                                         </tr>
     
                                         <tr>
                                             <td><strong>Status: </strong> </td>
                                             <td>{{$data['status']}}</td>
                                     
                                         </tr>
     
                                         <tr>
                                             <td><strong>Payment Method: </strong> </td>
                                             <td>{{$data['payment_method']}}</td>
                                         </tr>
     
                                         <tr>
                                             <td><strong>Transaction #: </strong> </td>
                                             <td>{{$data['transaction_id']}}</td>
                                         </tr>
     
                                         <tr>
                                             <td><strong>Invoice #: </strong> </td>
                                             <td>{{$data['invoice_no']}}</td>
                                         </tr>
     
                                         <tr>
                                             <td><strong>SubTotal: </strong> </td>
                                             <td>₱ {{$data['sub_total']}}</td>
                                         </tr>
     
                                         @php
                                             $dicount = round((float)$data['sub_total']-(float)$data['amount']);
                                         @endphp
                                         
                                         @if ( $dicount > 0)
                                         <tr>
                                             <td><strong>Discout: </strong> </td>
                                             <td>- ₱ {{$dicount}}</td>
                                         </tr>
                                         @endif
     
     
                                         <tr>
                                             <td><strong>Amount Paid: </strong> </td>
                                             <td>₱ {{$data['amount']}}</td>
                                         </tr>
     
                                     </table>
                                </div>



                              
                            </div>


                        </div>
                    </div>

                    <div class="col-md-6" style="padding: 1rem;">
                        <div class="col" style="background:#fdfcfc; ">
                            <h4 style="padding: 2rem; padding-bottom:0;">Cart Items</h4>
                            <hr>
                            <div style="padding:1rem; padding-top:0">
                                <ul class="list-group list-group-flush" style="display:block; height: 330px; max-height: 330px; overflow:auto; " >

                                    {{-- ------------ Side Cart ------------ --}}
                                    @php
                                        $cart = $data['cart'];
                                    @endphp
                                    @include('frontend.common.side_cart', $cart)
    
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            
        </div>
    </div>
    <!-- end container-->
</div>
<!-- end body-content-->

@endsection