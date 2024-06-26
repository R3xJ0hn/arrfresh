@extends('frontend.main_master')
@section('content')

@php
use App\Http\Controllers\Backend\Manager\PageInfoController;
$settings= PageInfoController::GetSettingInfo();
@endphp

<div class="body-content outer-top-xs" id="top-banner-and-menu">
    <div class="container">
        <div class="row">
            <!-- ============================================== SIDEBAR ============================================== -->
            <div class="col-xs-12 col-sm-12 col-md-3 sidebar">

                <!-- ===== == CATEGORY NAVIGATION ======= ==== -->
                @include('frontend.common.side_category_menu')
                <!-- = ==== CATEGORY NAVIGATION : END === ===== -->

                <!-- ===== == HOT DEALS ======= ==== -->
                @include('frontend.common.hot_deals')
                <!-- ===== == HOT DEALS: END ======= ==== -->

                <!-- ============================================== PRODUCT TAGS ============================================== -->
                <div class="sidebar-widget product-tag wow fadeInUp">
                    <h3 class="section-title">Product tags</h3>
                    <div class="sidebar-widget-body outer-top-xs">
                        <div class="tag-list"> <a class="item" title="Phone" href="category.html">Phone</a> <a
                                class="item active" title="Vest" href="category.html">Vest</a> <a class="item"
                                title="Smartphone" href="category.html">Smartphone</a> <a class="item" title="Furniture"
                                href="category.html">Furniture</a> <a class="item" title="T-shirt"
                                href="category.html">T-shirt</a> <a class="item" title="Sweatpants"
                                href="category.html">Sweatpants</a> <a class="item" title="Sneaker"
                                href="category.html">Sneaker</a> <a class="item" title="Toys"
                                href="category.html">Toys</a> <a class="item" title="Rose" href="category.html">Rose</a>
                        </div>
                        <!-- /.tag-list -->
                    </div>
                    <!-- /.sidebar-widget-body -->
                </div>
                <!-- /.sidebar-widget -->
                <!-- ============================================== PRODUCT TAGS : END ============================================== -->

                <!-- ============================================== SPECIAL DEALS ============================================== -->
                <div class="sidebar-widget outer-bottom-small wow fadeInUp">
                    <h3 class="section-title">Special Deals</h3>
                    <div class="sidebar-widget-body outer-top-xs">
                        <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">

                            <div class="item">
                                <div class="products special-product">

                                    @foreach($special_deals as $product)
                                    <div class="product">
                                        <div class="product-micro">
                                            <div class="row product-micro-row">
                                                <div class="col col-xs-5">
                                                    <div class="product-image">
                                                        <div class="image"> <a
                                                                href="{{ url('product/details/'.$product->id.'/'.$product->product_slug ) }}">
                                                                <img src="{{ asset($product->product_thumbnail) }}"
                                                                    alt=""> </a> </div>
                                                        <!-- /.image -->

                                                    </div>
                                                    <!-- /.product-image -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col col-xs-7">
                                                    <div class="product-info">
                                                        <h3 class="name">
                                                            <a
                                                                href="{{ url('product/details/'.$product->id.'/'.$product->product_slug ) }}">
                                                                {{$product->product_name }} {{
                                                                strtolower($product->product_size) }} </a>
                                                        </h3>

                                                        <div class="rating rateit-small"></div>
                                                        <div class="product-price">
                                                            @if ($product->product_discount_price <= 0) <span
                                                                class="price">₱ {{
                                                                number_format($product->product_discount_price,2)
                                                                }}</span>
                                                                @else
                                                                <span class="price-strike"> ₱ {{ number_format(
                                                                    ($product->product_selling_price),2) }}</span>
                                                                @endif
                                                        </div>
                                                        <!-- /.product-price -->

                                                    </div>
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.product-micro-row -->
                                        </div>
                                        <!-- /.product-micro -->

                                    </div>
                                    @endforeach
                                    <!-- // end special offer foreach -->

                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.sidebar-widget-body -->
                </div>
                <!-- /.sidebar-widget -->
                <!-- ============================================== SPECIAL DEALS : END ============================================== -->

            </div>
            <!-- /.sidemenu-holder -->
            <!-- ============================================== SIDEBAR : END ============================================== -->

            <!-- ============================================== CONTENT ============================================== -->
            <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">

                <!-- ========================================== SECTION – HERO ========================================= -->
                <div id="hero">
                    <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">

                        @foreach ($sliders as $slide)
                        <div class="item" style="background-image: url({{ asset($slide->slider_img)}});">
                            <div class="container-fluid">
                                <div class="caption bg-color vertical-center text-left">
                                    <div class="big-text fadeInDown-1 "> <span
                                            class="highlight">{{$slide->title}}</span> </div>
                                    <div class="excerpt fadeInDown-2 hidden-xs"> <span
                                            style="color: rgb(255, 255, 255)">{{$slide->description}}</span> </div>
                                </div>
                                <!-- /.caption -->
                            </div>
                            <!-- /.container-fluid -->
                        </div>
                        <!-- /.item -->
                        @endforeach

                    </div>
                    <!-- /.owl-carousel -->
                </div>
                <!-- ========================================= SECTION – HERO : END ========================================= -->

                <!-- ============================================== RANDOM PRODUCTS ============================================== -->
                <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
                    <div class="more-info-tab clearfix ">
                        <h3 class="new-product-title pull-left">{{$skip_category->category_name}}</h3>
                    </div>
                    <div class="tab-content outer-top-xs">

                        <div class="tab-pane active" id="all">
                            <div class="product-slider">
                                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">

                                    @foreach ($skip_category_products as $product)
                                    @php
                                    $tag ='new'
                                    @endphp

                                    <div class="item item-carousel">
                                        <div class="products">
                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image"> <a
                                                            href="{{ url('product/details/'.$product->id.'/'.$product->product_slug)}}"><img
                                                                src="{{asset($product->product_thumbnail)}}" alt=""></a>
                                                    </div>
                                                    <!-- /.image -->

                                                    <div class="tag   
                                                        {{$tag == 'new' ?  'new' : ''}}
                                                        {{$tag == 'hot' ?  'hot' : ''}}
                                                        {{$tag == 'sale' ? 'sale' : ''}} ">
                                                        <span>{{$tag}}</span>
                                                    </div>

                                                </div>
                                                <!-- /.product-image -->


                                                <div class="product-info text-left">
                                                    <h3 class="name"><a
                                                            href="{{ url('product/details/'.$product->id.'/'.$product->product_slug)}}">
                                                            {{$product->product_name}}
                                                            {{ strtolower($product->product_size) }}
                                                        </a>
                                                    </h3>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="description"></div>

                                                    <div class="product-price">
                                                        @php
                                                        $discount = $product->product_discount_price;
                                                        @endphp

                                                        @if ($discount == 0)
                                                        <span class="price"> ₱
                                                            {{number_format($product->product_selling_price,2)}} </span>
                                                        @else
                                                        <span class="price"> ₱ {{number_format($discount,2)}} </span>
                                                        <span class="price-before-discount"> ₱
                                                            {{number_format($product->product_selling_price,2)}} </span>
                                                        <span>
                                                            -{{number_format(100-($discount/$product->product_selling_price)
                                                            * 100)}}%</span>
                                                        @endif

                                                    </div>
                                                    <!-- /.product-price -->

                                                </div>
                                                <!-- /.product-info -->
                                                <div class="cart clearfix animate-effect">
                                                    <div class="action">
                                                        <ul class="list-unstyled">

                                                            <li class="add-cart-button btn-group">
                                                                <button data-toggle="modal"
                                                                    data-target="#addToCartModal"
                                                                    id="addtocart-{{$product->id}}"
                                                                    onclick="productView({{$product->id}})"
                                                                    class="btn btn-primary icon" type="button"
                                                                    title="Add Cart">
                                                                    <i class="fa fa-shopping-cart"></i> </button>
                                                            </li>

                                                            <li>
                                                                <button id="addtocart-{{$product->id}}"
                                                                    onclick="addToWishList({{$product->id}})"
                                                                    class="btn btn-primary icon" type="button"
                                                                    title="Wishlist">
                                                                    <i class="icon fa fa-heart"></i> </button>
                                                            </li>

                                                            <li class="lnk"> <a data-toggle="tooltip"
                                                                    class="add-to-cart" href="detail.html"
                                                                    title="Compare"> <i class="fa fa-signal"
                                                                        aria-hidden="true"></i> </a> </li>
                                                        </ul>
                                                    </div>
                                                    <!-- /.action -->
                                                </div>
                                                <!-- /.cart -->
                                            </div>
                                            <!-- /.product -->

                                        </div>
                                        <!-- /.products -->
                                    </div>
                                    <!-- /.item -->

                                    @endforeach

                                    @if ($skip_category_products->isEmpty())
                                    <h5 class="text-info">No Product Found</h5>
                                    @endif

                                </div>
                                <!-- /.home-owl-carousel -->
                            </div>
                            <!-- /.product-slider -->
                        </div>
                        <!-- /.tab-pane -->

                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- ============================================== RANDOM PRODUCTS : END ============================================== -->
                
                <!-- ============================================== BEST SELLER ============================================== -->
                <div class="best-deal wow fadeInUp outer-bottom-xs">
                    <h3 class="section-title">Best seller</h3>
                    <div class="sidebar-widget-body outer-top-xs">
                        <div class="owl-carousel best-seller custom-carousel owl-theme outer-top-xs">


                            @foreach ($best_seller as $product)
                            <div class="item">
                                <div class="products best-product">
                                    <div class="product">
                                        <div class="product-micro">
                                            <div class="row product-micro-row">
                                                <div class="col col-xs-5">

                                                    <div class="product-image">
                                                        <div class="image"> <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug)}}"> <img
                                                                    src="{{asset($product->product_thumbnail)}}"
                                                                    alt=""> </a> </div>
                                                        <!-- /.image -->

                                                    </div>
                                                    <!-- /.product-image -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col2 col-xs-7">
                                                    <div class="product-info">
                                                        <h3 class="name"><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug)}}">
                                                            {{$product->product_name}}
                                                            {{ strtolower($product->product_size) }}
                                                        </a>
                                                        </h3>
                                                        <div class="rating rateit-small"></div>


                                                        <div class="product-price">
                                                            @php
                                                            $discount = $product->product_discount_price;
                                                            @endphp
        
                                                            @if ($discount == 0)
                                                            <span class="price"> ₱
                                                                {{number_format($product->product_selling_price,2)}} </span>
                                                            @else
                                                            <span class="price"> ₱ {{number_format($discount,2)}} </span>
                                                            <span class="price-before-discount"> ₱
                                                                {{number_format($product->product_selling_price,2)}} </span>
                                                            <span>
                                                                -{{number_format(100-($discount/$product->product_selling_price)
                                                                * 100)}}%</span>
                                                            @endif
        
                                                        </div>

                                                        <!-- /.product-price -->

                                                    </div>
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.product-micro-row -->
                                        </div>
                                        <!-- /.product-micro -->

                                    </div>


                                </div>
                            </div>
                            @endforeach

                            @if ($best_seller->isEmpty())
                            <h5 class="text-info">No Product Found</h5>
                            @endif
                        </div>
                    </div>
                    <!-- /.sidebar-widget-body -->
                </div>
                <!-- /.sidebar-widget -->
                <!-- ============================================== BEST SELLER : END ============================================== -->

                <!-- ============================================== Banner1 ============================================== -->
                <div class="wide-banners wow fadeInUp outer-bottom-xs">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="wide-banner cnt-strip">

                                <div class="image">
                                    <img class="img-responsive" src="{{asset($settings->banner1)}}" alt="">
                                </div>
                                <!-- /.new-label -->
                            </div>
                            <!-- /.wide-banner -->
                        </div>
                        <!-- /.col -->

                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.wide-banners -->
                <!-- ============================================== Banner1 : END ============================================== -->
                
                <!-- ============================================== NEW PRODUCTS ============================================== -->
                <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
                    <div class="more-info-tab clearfix ">
                        <h3 class="new-product-title pull-left">New Products</h3>
                    </div>
                    <div class="tab-content outer-top-xs">

                        <div class="tab-pane active" id="all">
                            <div class="product-slider">
                                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">

                                    @foreach ($new_products as $product)
                                    @php
                                    $tag ='new'
                                    @endphp

                                    <div class="item item-carousel">
                                        <div class="products">
                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image"> <a
                                                            href="{{ url('product/details/'.$product->id.'/'.$product->product_slug)}}"><img
                                                                src="{{asset($product->product_thumbnail)}}" alt=""></a>
                                                    </div>
                                                    <!-- /.image -->

                                                    <div class="tag   
                                                        {{$tag == 'new' ?  'new' : ''}}
                                                        {{$tag == 'hot' ?  'hot' : ''}}
                                                        {{$tag == 'sale' ? 'sale' : ''}} ">
                                                        <span>{{$tag}}</span>
                                                    </div>

                                                </div>
                                                <!-- /.product-image -->


                                                <div class="product-info text-left">
                                                    <h3 class="name"><a
                                                            href="{{ url('product/details/'.$product->id.'/'.$product->product_slug)}}">
                                                            {{$product->product_name}}
                                                            {{ strtolower($product->product_size) }}
                                                        </a>
                                                    </h3>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="description"></div>

                                                    <div class="product-price">
                                                        @php
                                                        $discount = $product->product_discount_price;
                                                        @endphp

                                                        @if ($discount == 0)
                                                        <span class="price"> ₱
                                                            {{number_format($product->product_selling_price,2)}} </span>
                                                        @else
                                                        <span class="price"> ₱ {{number_format($discount,2)}} </span>
                                                        <span class="price-before-discount"> ₱
                                                            {{number_format($product->product_selling_price,2)}} </span>
                                                        <span>
                                                            -{{number_format(100-($discount/$product->product_selling_price)
                                                            * 100)}}%</span>
                                                        @endif

                                                    </div>
                                                    <!-- /.product-price -->

                                                </div>
                                                <!-- /.product-info -->
                                                <div class="cart clearfix animate-effect">
                                                    <div class="action">
                                                        <ul class="list-unstyled">

                                                            <li class="add-cart-button btn-group">
                                                                <button data-toggle="modal"
                                                                    data-target="#addToCartModal"
                                                                    id="addtocart-{{$product->id}}"
                                                                    onclick="productView({{$product->id}})"
                                                                    class="btn btn-primary icon" type="button"
                                                                    title="Add Cart">
                                                                    <i class="fa fa-shopping-cart"></i> </button>
                                                            </li>

                                                            <li>
                                                                <button id="addtocart-{{$product->id}}"
                                                                    onclick="addToWishList({{$product->id}})"
                                                                    class="btn btn-primary icon" type="button"
                                                                    title="Wishlist">
                                                                    <i class="icon fa fa-heart"></i> </button>
                                                            </li>

                                                            <li class="lnk"> <a data-toggle="tooltip"
                                                                    class="add-to-cart" href="detail.html"
                                                                    title="Compare"> <i class="fa fa-signal"
                                                                        aria-hidden="true"></i> </a> </li>
                                                        </ul>
                                                    </div>
                                                    <!-- /.action -->
                                                </div>
                                                <!-- /.cart -->
                                            </div>
                                            <!-- /.product -->

                                        </div>
                                        <!-- /.products -->
                                    </div>
                                    <!-- /.item -->

                                    @endforeach

                                    @if ($new_products->isEmpty())
                                    <h5 class="text-info">No Product Found</h5>
                                    @endif

                                </div>
                                <!-- /.home-owl-carousel -->
                            </div>
                            <!-- /.product-slider -->
                        </div>
                        <!-- /.tab-pane -->

                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- ============================================== NEW PRODUCTS : END ============================================== -->

                <!-- ============================================== FEATURED PRODUCTS ============================================== -->
                <section class="section featured-product wow fadeInUp">
                    <h3 class="section-title">Featured products</h3>
                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">


                        @foreach ($featured_products as $product)
                        @php
                        $tag ='sale'
                        @endphp

                        <div class="item item-carousel">
                            <div class="products">
                                <div class="product">
                                    <div class="product-image">
                                        <div class="image"> <a
                                                href="{{ url('product/details/'.$product->id.'/'.$product->product_slug)}}"><img
                                                    src="{{asset($product->product_thumbnail)}}" alt=""></a> </div>
                                        <!-- /.image -->

                                        <div class="tag   
                                        {{$tag == 'new' ?  'new' : ''}}
                                        {{$tag == 'hot' ?  'hot' : ''}}
                                        {{$tag == 'sale' ? 'sale' : ''}} ">
                                            <span>{{$tag}}</span>
                                        </div>

                                    </div>
                                    <!-- /.product-image -->


                                    <div class="product-info text-left">
                                        <h3 class="name"><a
                                                href="{{ url('product/details/'.$product->id.'/'.$product->product_slug)}}">
                                                {{$product->product_name}}
                                                {{ strtolower($product->product_size) }}
                                            </a>
                                        </h3>
                                        <div class="rating rateit-small"></div>
                                        <div class="description"></div>

                                        <div class="product-price">
                                            @php
                                            $discount = $product->product_discount_price;
                                            @endphp

                                            @if ($discount == 0)
                                            <span class="price"> ₱ {{number_format($product->product_selling_price,2)}}
                                            </span>
                                            @else
                                            <span class="price"> ₱ {{number_format($discount,2)}} </span>
                                            <span class="price-before-discount"> ₱
                                                {{number_format($product->product_selling_price,2)}} </span>
                                            <span> -{{number_format(100-($discount/$product->product_selling_price) *
                                                100)}}%</span>
                                            @endif

                                        </div>
                                        <!-- /.product-price -->

                                    </div>
                                    <!-- /.product-info -->
                                    <div class="cart clearfix animate-effect">
                                        <div class="action">
                                            <ul class="list-unstyled">

                                                <li class="add-cart-button btn-group">
                                                    <button data-toggle="modal" data-target="#addToCartModal"
                                                        id="addtocart-{{$product->id}}"
                                                        onclick="productView({{$product->id}})"
                                                        class="btn btn-primary icon" type="button" title="Add Cart">
                                                        <i class="fa fa-shopping-cart"></i> </button>
                                                </li>

                                                <li>
                                                    <button id="addtocart-{{$product->id}}"
                                                        onclick="addToWishList({{$product->id}})"
                                                        class="btn btn-primary icon" type="button" title="Wishlist">
                                                        <i class="icon fa fa-heart"></i> </button>
                                                </li>

                                                <li class="lnk"> <a data-toggle="tooltip" class="add-to-cart"
                                                        href="detail.html" title="Compare"> <i class="fa fa-signal"
                                                            aria-hidden="true"></i> </a> </li>
                                            </ul>
                                        </div>
                                        <!-- /.action -->
                                    </div>
                                    <!-- /.cart -->
                                </div>
                                <!-- /.product -->

                            </div>
                            <!-- /.products -->
                        </div>
                        <!-- /.item -->

                        @endforeach

                        @if ($featured_products->isEmpty())
                        <h5 class="text-info">No Product Found</h5>
                        @endif

                    </div>
                    <!-- /.home-owl-carousel -->
                </section>
                <!-- /.section -->
                <!-- ============================================== FEATURED PRODUCTS : END ============================================== -->

                <!-- ============================================== WIDE PRODUCTS ============================================== -->
                <div class="wide-banners wow fadeInUp outer-bottom-xs">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="wide-banner cnt-strip">

                                <div class="image">
                                    <img class="img-responsive" src="{{asset($settings->banner2)}}" alt="">
                                </div>
                                <!-- /.new-label -->
                            </div>
                            <!-- /.wide-banner -->
                        </div>
                        <!-- /.col -->

                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.wide-banners -->
                <!-- ============================================== WIDE PRODUCTS : END ============================================== -->

                <!-- ============================================== NEW ARRIVALS PRODUCTS ============================================== -->
                <section class="section wow fadeInUp new-arriavls">
                    <h3 class="section-title">New Arrivals</h3>
                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">

                        @foreach ($new_arrival_products as $product)
                        @php
                        $tag ='new'
                        @endphp

                        <div class="item item-carousel">
                            <div class="products">
                                <div class="product">
                                    <div class="product-image">
                                        <div class="image"> <a
                                                href="{{ url('product/details/'.$product->id.'/'.$product->product_slug)}}"><img
                                                    src="{{asset($product->product_thumbnail)}}" alt=""></a> </div>
                                        <!-- /.image -->

                                        <div class="tag   
                                        {{$tag == 'new' ?  'new' : ''}}
                                        {{$tag == 'hot' ?  'hot' : ''}}
                                        {{$tag == 'sale' ? 'sale' : ''}} ">
                                            <span>{{$tag}}</span>
                                        </div>

                                    </div>
                                    <!-- /.product-image -->


                                    <div class="product-info text-left">
                                        <h3 class="name"><a
                                                href="{{ url('product/details/'.$product->id.'/'.$product->product_slug)}}">
                                                {{$product->product_name}}
                                                {{ strtolower($product->product_size) }}
                                            </a>
                                        </h3>
                                        <div class="rating rateit-small"></div>
                                        <div class="description"></div>

                                        <div class="product-price">
                                            @php
                                            $discount = $product->product_discount_price;
                                            @endphp

                                            @if ($discount == 0)
                                            <span class="price"> ₱ {{number_format($product->product_selling_price,2)}}
                                            </span>
                                            @else
                                            <span class="price"> ₱ {{number_format($discount,2)}} </span>
                                            <span class="price-before-discount"> ₱
                                                {{number_format($product->product_selling_price,2)}} </span>
                                            <span> -{{number_format(100-($discount/$product->product_selling_price) *
                                                100)}}%</span>
                                            @endif

                                        </div>
                                        <!-- /.product-price -->

                                    </div>
                                    <!-- /.product-info -->
                                    <div class="cart clearfix animate-effect">
                                        <div class="action">
                                            <ul class="list-unstyled">

                                                <li class="add-cart-button btn-group">
                                                    <button data-toggle="modal" data-target="#addToCartModal"
                                                        id="addtocart-{{$product->id}}"
                                                        onclick="productView({{$product->id}})"
                                                        class="btn btn-primary icon" type="button" title="Add Cart">
                                                        <i class="fa fa-shopping-cart"></i> </button>
                                                </li>

                                                <li>
                                                    <button id="addtocart-{{$product->id}}"
                                                        onclick="addToWishList({{$product->id}})"
                                                        class="btn btn-primary icon" type="button" title="Wishlist">
                                                        <i class="icon fa fa-heart"></i> </button>
                                                </li>

                                                <li class="lnk"> <a data-toggle="tooltip" class="add-to-cart"
                                                        href="detail.html" title="Compare"> <i class="fa fa-signal"
                                                            aria-hidden="true"></i> </a> </li>
                                            </ul>
                                        </div>
                                        <!-- /.action -->
                                    </div>
                                    <!-- /.cart -->
                                </div>
                                <!-- /.product -->

                            </div>
                            <!-- /.products -->
                        </div>
                        <!-- /.item -->

                        @endforeach

                        @if ($new_arrival_products->isEmpty())
                        <h5 class="text-info">No Product Found</h5>
                        @endif
                    </div>
                    <!-- /.home-owl-carousel -->
                </section>
                <!-- /.section -->
                <!-- ============================================== NEW ARRIVALS PRODUCTS : END ============================================== -->

            </div>
            <!-- /.homebanner-holder -->
            <!-- ============================================== CONTENT : END ============================================== -->
        </div>
        <!-- /.row -->

        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        @include('frontend.body.brands')
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->

    </div>
    <!-- /.container -->
</div>
@endsection