
@foreach ($cart as $key=>$val)

    <li style="width: 95%;">
        <div class="product" style="margin: 0">

            <div class="row product-micro-row">
                <div class="col col-xs-3">
                    <div class="product-image">
                        <div class="image"> 
                            <a href="#"> 
                                <img src="/{{$val['productImg']}}" alt="">
                            </a> 
                        </div>
                        <!-- /.image -->

                    </div>
                    <!-- /.product-image -->
                </div>

                <!-- /.col -->
                <div class="col col-xs-9">
                    <div class="product-info">
                        <h3 class="name" style="margin:3% 0"><a href="{{ url('product/details/'.$val['productId'].'/'.$val['productSlug'])}}">
                            {{$val['productName']}} {{$val['productSize']}}</a></h3>
                        <div> <span>Qty: {{$val['productQty']}}</span>  Total Price:
                            <span style="font-weight: bold"> ₱ {{$val['productSum']}}</span>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>

        </div>
    </li>
@endforeach