@php
   use App\Http\Controllers\Backend\Manager\ProductController;
   $hot_deal_products =ProductController::HotDealsData();
@endphp

<div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
    <h3 class="section-title">Hot Deals</h3>
    <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">

        @foreach($hot_deal_products as $product)
        <div class="item">
            <div class="products">
                <div class="hot-deal-wrapper">
                    <div class="image"> <img src="{{ asset($product->product_thumbnail) }}" alt="">
                    </div>

                    @php
                    $discountPer =
                    number_format(100-(($product->product_discount_price/$product->product_selling_price)
                    * 100));
                    @endphp

                    @if ($product->product_discount_price == 0)
                    <div class="tag hot"><span>hot</span></div>
                    @else
                    <div class="sale-offer-tag"><span>{{$discountPer}}%<br>
                            off</span></div>
                    @endif

                    <div class="timing-wrapper">
                        <div class="box-wrapper">
                            <div class="date box"> <span class="key">120</span> <span
                                    class="value">DAYS</span> </div>
                        </div>
                        <div class="box-wrapper">
                            <div class="hour box"> <span class="key">20</span> <span
                                    class="value">HRS</span> </div>
                        </div>
                        <div class="box-wrapper">
                            <div class="minutes box"> <span class="key">36</span> <span
                                    class="value">MINS</span> </div>
                        </div>

                        <div class="box-wrapper hidden-md">
                            <div class="seconds box"> <span class="key">60</span> <span
                                    class="value">SEC</span> </div>
                        </div>
                    </div>
                </div>
                <!-- /.hot-deal-wrapper -->

                <div class="product-info text-left m-t-20">
                    <h3 class="name">
                        <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug)}}">
                            {{ $product->product_name }} {{ strtolower($product->product_size) }} </a>
                    </h3>
                    <div class="rating rateit-small"></div>

                    @if ($product->product_discount_price == 0)
                    <div class="product-price"> <span class="price"> ₱
                            {{number_format($product->product_selling_price)}} </span>
                    </div>
                    @else

                    <div class="product-price">
                        <span class="price"> ₱ {{number_format($product->product_discount_price)}}
                        </span>
                        <span class="price-before-discount"> ₱
                            {{number_format($product->product_selling_price)}}</span>
                        <span> -{{$discountPer}}%</span>
                    </div>
                    @endif
                    <!-- /.product-price -->

                </div>
                <!-- /.product-info -->

                <div class="cart clearfix animate-effect">
                    <div class="action">
                        <div class="add-cart-button btn-group">
                            <button class="btn btn-primary icon" data-toggle="modal"
                                data-target="#addToCartModal" id="addtocart-{{$product->id}}"
                                onclick="productView({{$product->id}})" type="button"> <i
                                    class="fa fa-shopping-cart"></i> </button>
                            <button class="btn btn-primary cart-btn" data-toggle="modal"
                                data-target="#addToCartModal" id="addtocart-{{$product->id}}"
                                onclick="productView({{$product->id}})" type="button">Add to
                                cart</button>
                        </div>
                    </div>
                    <!-- /.action -->
                </div>
                <!-- /.cart -->
            </div>
        </div>
        @endforeach
        <!-- // end hot deals foreach -->
    </div>
    <!-- /.sidebar-widget -->
</div>