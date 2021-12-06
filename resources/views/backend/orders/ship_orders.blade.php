@extends('admin.admin_master')
@section('admin')


  <!-- Content Wrapper. Contains page content -->

	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<!-- Main content -->
		<section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Ship Orders</h4>
                </div>
                <!-- /.box-header -->

                <div class="box-body no-padding">

                    <div class="table-responsive" style=" overflow-y:auto; height:60vh;">
                        <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th class="text-center">Ship</th>
                            <th class="text-center">Invoice</th>
                            <th class="text-center">User</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Unit</th>
                            <th class="text-center">Amount</th>
                            <th class="text-center">Paymet</th>
                            <th class="text-center" style="width: 5%;"> Action</th>
                        </tr>
                            @php
                                $cnt=0; 
                            @endphp
                            @foreach($orders as $item)
                            @php
                            $cnt++;

                            @endphp
                                <tr id="trId-{{$cnt}}">
                                    <td class="text-center">
                                        <a href="{{route('ship-confirm',[$item['id']])}}" class="btn btn-success" style="padding:7px;"> Confirm</a>
                                    </td>
                                    <td class="text-center">
                                            #{{ $item['invoice_no'] }}
                                    </td>

                                    <td class="text-center">{{ $item['user_name']}}</td>
                                    <td class="text-center"><span class="text-muted">
                                        <i class="fa fa-clock-o"></i> {{ $item['place_date'] }}
                                        </span>
                                    </td>
                                    <td class="text-center">{{ $item['product_units'] }}</td>
                                    <td class="text-center"> ₱ {{ $item['amount'] }}</td>
                                    <td class="text-center">{{ $item['payment_method'] }} </td>
        
                                    <td class="text-center" >
                                        <a href="{{ route('order.view',$item['id']) }}" class="badge badge-pill badge-info" title="View">
                                            <i class="fa fa-eye"> View</i> </a>
                                    </td>
                                </tr>
                                
                            @endforeach

                        </tbody></table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  </div>
@endsection