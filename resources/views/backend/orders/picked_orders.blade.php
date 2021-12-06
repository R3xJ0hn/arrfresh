@extends('admin.admin_master')
@section('admin')

@php
use Carbon\Carbon;
@endphp

    <div class="container-full">
		<!-- Main content -->
		<section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Picked Orders</h4>
                    <div class="box-controls pull-right">
                        <a href="{{route('begin-qc')}}">
                            @if($invoice )
                                <h4 class="text-warning">Begin To QC Orders</h4>
                            @endif
                        </a>

                    </div>
                </div>
                <!-- /.box-header -->

                <div class="box-body no-padding">

                    <div class="table-responsive" style=" overflow-y:auto; height:60vh;">
                        <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th class="text-center">Invoice</th>
                            <th class="text-center">Pick Bin</th>
                            <th class="text-center">Place On</th>
                            <th class="text-center">Picked On</th>
                            <th class="text-center">Unit</th>
                            <th class="text-center">Amount</th>
                            <th class="text-center" style="width: 5%;"> Action</th>
                        </tr>
                            @foreach($invoice as $item)
                                <tr>
                                    <td class="text-center">
                                            #{{ $item['invoice_no'] }}
                                    </td>

                                    <td class="text-center">
                                            #{{ $item['pick_bin'] }}
                                    </td>
                                    
                                    <td class="text-center">
                                        <span class="text-muted">
                                        <i class="fa fa-clock-o"></i> {{ $item['place_date'] }}
                                        </span>
                                        <div>
                                            <small> {{Carbon::create($item['place_date'])->diffForHumans()}}</small>
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <span class="text-muted">
                                            {{Carbon::create($item['picked_date'])->diffForHumans()}}
                                        </span>
                                        <div>
                                            <small>{{ $item['picked_date'] }}</small>
                                        </div>
                                    </td>
                                    <td class="text-center">{{ $item['product_units'] }}</td>
                                    <td class="text-center"> ₱ {{ $item['amount'] }}</td>
        
                                    <td class="text-center" >
                                        <a href="{{route('order.view',$item['id'])}}" class="badge badge-pill badge-info" title="View">
                                            <i class="fa fa-eye"> View</i> 
                                        </a>
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