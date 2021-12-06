@extends('admin.admin_master')
@section('admin')


<!-- Content Wrapper. Contains page content -->

<div class="container-full">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
        <div class="row">


            <div class="col-md-6 col-12">

                <div class="box box-solid" style="height: 90vh;">
                    <div class="box-header with-border">
                        <h4 class="box-title">Order Details</h4>
                        <span style="margin: 1rem">
                        <a href="{{ route('dl.invoice',$orders['id'])}}">
                           <li class="fa fa-download"></li> Download
                        </a>
                        </span>

                        <div class="text-center pull-right" style="height: 20px;">
                            <h4 style="margin:0;">
                                <span class="text-info">{{$orders['status']}}</span>
                            </h4>
                            <small style="font-size: 8px">Status</small>
                        </div> 

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table style="width: 100%">

                                <tbody>

                                    
                                    <tr>
                                        <td><h4>Shipping Book</h4></td>
                                        
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold; width:40%;"> Name: </td>
                                        <td>{{$orders['user_name']}}</td>
                                    </tr>

                                    <tr>
                                        <td style="font-weight:bold; width:40%;"> Email: </td>
                                        <td>{{$orders['user_email']}}</td>
                                    </tr>

                                    <tr>
                                        <td style="font-weight:bold; width:40%;"> Phone: </td>
                                        <td>{{$orders['user_phone']}}</td>
                                    </tr>

                                    <tr>
                                        <td style="font-weight:bold; width:40%;"> Adress: </td>
                                        <td>{{$orders['user_address']}}</td>
                                    </tr>

                                    <tr>
                                        <td style="font-weight:bold; width:40%;"> Zip Code: </td>
                                        <td>{{$orders['user_zipcode']}}</td>
                                    </tr>

                                    <tr>
                                        <td style="width: 50%">
                                            <hr>
                                        </td>
                                        <td style="width: 50%">
                                            <hr>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <h4>Decriptions</h4>
                                        </td>
                                    </tr>



                                    
                                    <tr>
                                        <td style="font-weight:bold; width:40%;"> Invoice #: </td>
                                        <td>{{$orders['invoice_no']}}</td>
                                    </tr>

                                    <tr>
                                        <td style="font-weight:bold; width:40%;"> Payment Method: </td>
                                        <td>{{$orders['payment_method']}}</td>
                                    </tr>
                                    
                                    <tr>
                                        <td style="font-weight:bold; width:40%;"> Transaction #: </td>
                                        <td>{{$orders['transaction_id']}}</td>
                                    </tr>


                                    <tr>
                                        <td style="font-weight:bold; width:40%;"> Place On: </td>
                                        <td>{{$orders['place_date']}}</td>
                                    </tr>

                                    <tr>
                                        <td style="font-weight:bold; width:40%;"> Paid On: </td>
                                        <td>{{$orders['paid_date']}}</td>
                                    </tr>

                                    <tr>
                                        <td style="font-weight:bold; width:40%;"> Unit: </td>
                                        <td>{{$orders['total_units']}}</td>
                                    </tr>


                                    <tr>
                                        <td style="font-weight:bold; width:40%;"> SubTotal: </td>
                                        <td>₱ {{$orders['sub_total']}}</td>

                                    </tr>

                                    <tr>
                                        @php
                                        $discount = (float)$orders['sub_total'] - (float)$orders['amount']
                                        @endphp

                                        @if ($discount > 0)
                                            <td style="font-weight:bold; width:40%;"> Discount: </td>
                                            <td>-{{$discount}}</td>
                                        @endif

                                    </tr>

                                    <tr>
                                        <td style="font-weight:bold; width:40%;"> Amount Paid: </td>
                                        <td>₱ {{$orders['amount']}}</td>
                                    </tr>



                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>

            </div> <!--  // cod md -6 -->


            <div class="col-md-6 col-12">


                <div class="box" style="height: 90vh;">
                    <div class="box-header with-border">
                        <h4 class="box-title">Cart Items</h4>
                    </div>

                    <div class="box-body ">
                            
    
                            <div class="table-responsive" style=" overflow-y:auto; height:75%;">
                                <table class="table table-striped mb-0" style="width: 100%">
                                    <tbody>

                                        @foreach ($orders['cart'] as $item)
                                        <tr>
                                            <td style="width:30%" class="text-center">
                                                <img src="/{{$item['productImg']}}" alt="img" style="width: 50%">
                                            </td>

                                            <td style="width:70%">
                                                <h6>{{$item['productName']}} {{$item['productSize']}}</h6>
                                                <p style="margin: 0">SKU:{{$item['productSKU']}}</p>
                                                <p>Qty:{{$item['productQty']}} <span> Stock:{{$item['productStock']}} </span></p>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>

                                </table>
                            </div>
                    </div>
                </div>


            </div> <!--  // cod md -6 -->


        </div>
        <!-- /. end row -->
    </section>
    <!-- /.content -->

</div>

@endsection