@extends('admin.admin_master')
@section('admin')

<div class="container-full">

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-12">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Product List <span class="badge badge-pill badge-info"> {{
                                count($products) }} <small>items</small></span></h3>
                                <a href="{{ route('product.add')}}" class="btn btn-success rounded-pill pull-right">Add New Product</a>            
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">

                                <thead>
                                    <tr>
                                        <th class="text-center">Product</th>
                                        <th class="text-center">Stock </th>
                                        <th class="text-center">Price </th>
                                        <th class="text-center">Discount </th>
                                        <th class="text-center">Status </th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($products as $item)
                                    <tr>
                                        <td style="width: 30%"> 
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <img class="shadow rounded"
                                                     src="{{ asset($item->product_thumbnail) }}" style="width: 70px; height: 60px;">
                                                </div>
                                                <div class="col-sm-7">
                                                    <div class="row">
                                                        <h5>{{ $item->product_name }}</h5>
                                                    </div>
                                                    <div class="row">
                                                        <small>SKU: {{ $item->product_sku }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="text-center">{{ $item->product_stock }}</td>
                                        <td class="text-center"><h6>₱ {{ $item->product_selling_price }}</h6></td>

                                        <td class="text-center">
                                            @if($item->product_discount_price == NULL)
                                            <span class="badge badge-pill badge-danger">No Discount</span>
                                            @else
                                            @php
                                            $amount =  $item->product_discount_price;
                                            $discount = 100-($amount/$item->product_selling_price) * 100;
                                            @endphp
                                            <div class="d-flex justify-content-center">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <h6>₱ {{$item->product_discount_price}}</h6>
                                                    </div>   
                                                    <div class="col-sm-12">
                                                        <span class="badge badge-pill badge-warning">{{round($discount)}} % off</span>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            @if($item->product_status == 1)
                                            <a href="{{ route('product.inactive',$item->id) }}" title="Inactive Now" class="badge badge-pill badge-success">
                                                 Active  <i class="fa fa-arrow-up"></i>
                                            </a>
                                            @else
                                            <a href="{{ route('product.active',$item->id) }}" title="Active Now" class="badge badge-pill badge-danger">
                                                InActive  <i class="fa fa-arrow-down"></i>
                                           </a>
                                            @endif
                                        </td>

                                        <td class="text-center" style="width: 3rem !important">

                                            {{-- View --}}
                                            <a href="#" class="text-primary"
                                                title="Product Details Data"><i class="fa fa-eye"></i> </a> <br>
                                            {{-- Edit --}}
                                            <a href="{{ route('product.edit',[$item->id , $item->product_slug])}}" class="text-warning"
                                                title="Edit Data"><i class="fa fa-pencil"></i> </a> <br>
                                            {{-- Delete --}}
                                            <a href="{{ route('product.delete',$item->id)}}" class="text-danger"
                                                title="Delete Data" id="delete">
                                                <i class="fa fa-trash"></i></a> <br>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->

        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

@endsection