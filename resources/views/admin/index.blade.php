@extends('admin.admin_master')
@section('admin')

@php
use Carbon\Carbon;
@endphp

<div class="container-full">

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xl-3 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">							
                        <div class="icon bg-primary-light rounded w-60 h-60">
                            <i class="text-primary mr-0 font-size-24 mdi mdi-account-multiple"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">New Customers</p>
                            <h3 class="text-white mb-0 font-weight-500">3400 <small class="text-success"><i class="fa fa-caret-up"></i> +2.5%</small></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">							
                        <div class="icon bg-warning-light rounded w-60 h-60">
                            <i class="text-warning mr-0 font-size-24 mdi mdi-car"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">Sold Items</p>
                            <h3 class="text-white mb-0 font-weight-500">3400 <small class="text-success"><i class="fa fa-caret-up"></i> +2.5%</small></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">							
                        <div class="icon bg-info-light rounded w-60 h-60">
                            <i class="text-info mr-0 font-size-24 mdi mdi-sale"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">Sales Lost</p>
                            <h3 class="text-white mb-0 font-weight-500">₱1,250 <small class="text-danger"><i class="fa fa-caret-down"></i> -0.5%</small></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">							
                        <div class="icon bg-danger-light rounded w-60 h-60">
                            <i class="text-danger mr-0 font-size-24 mdi mdi-phone-incoming"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">Orders</p>
                            <h3 class="text-white mb-0 font-weight-500">1,460 <small class="text-danger"><i class="fa fa-caret-up"></i> -1.5%</small></h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title align-items-start flex-column">
                           On Process Invoices
                        </h4>
                    </div>
                    <div class="box-body">

                        <div class="table-responsive" style=" overflow-y:auto; height:60vh;">
                            <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th class="text-center">Invoice</th>
                                <th class="text-center">User</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Unit</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Payment</th>
                                <th class="text-center" style="width: 5%;"> Action</th>
                            </tr>
                                @foreach($invoice as $item)
                                    <tr>
                                        <td class="text-center">
                                                #{{ $item['invoice_no'] }}
                                        </td>
                                        
                                        <td class="text-center">{{ $item['user_name']}}</td>
                                        <td class="text-center">
                                            <span class="text-muted">
                                            <i class="fa fa-clock-o"></i> {{ $item['place_date'] }}
                                            </span>
                                            <div>
                                                <small> {{Carbon::create($item['place_date'])->diffForHumans()}}</small>
                                            </div>
                                        </td>
                                        <td class="text-center">{{ $item['status'] }}</td>

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
                </div>  
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>

  
  @endsection