@extends('frontend.main_master')

@section('content')

<div class="body-content outer-top-xs" id="top-banner-and-menu">
    <div class="container">
        <div class="row">
            <!-- ============================================== SIDEBAR ============================================== -->
            <div class="col-xs-12 col-sm-12 col-md-3 sidebar">

                <!-- ================================== TOP NAVIGATION ================================== -->
                <div class="side-menu animate-dropdown outer-bottom-xs">
                    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
                    <nav class="yamm megamenu-horizontal">
                        <ul class="nav">

                            @foreach ($categories as $category)
                                <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle"
                                    data-toggle="dropdown">{{$category->category_name}}</a>

                                    @php $cnt = 0; @endphp
                                    @foreach ($subcategories as $subcategory)
                                        @if ( $subcategory->category_id == $category->id)
                                        @php  $cnt++;  @endphp
                                        @endif
                                    @endforeach

                                    @if ($cnt > 0)
                                    <ul class="dropdown-menu menu " style="left: 21vw; top:0; background:rgb(248, 248, 248)">
                                        <li class="yamm-content">
                                            <div class="row">

                                                <div class="col-sm-12 col-md-12">
                                                    <ul class="links list-unstyled">

                                                        @foreach ($subcategories as $subcategory)
                                                        @if ( $subcategory->category_id == $category->id)
                                                        <li><a href="#">{{ $subcategory->subcategory_name}}</a></li>
                                                        @endif
                                                        @endforeach

                                                    </ul>
                                                </div>

                                            </div>
                                            <!-- /.row -->
                                        </li>
                                        <!-- /.yamm-content -->
                                    </ul>
                                        <!-- /.dropdown-menu --> 
                                    @endif
                                </li>
                                <!-- /.menu-item -->
                            @endforeach

                        </ul>
                        <!-- /.nav -->
                    </nav>
                    <!-- /.megamenu-horizontal -->
                </div>
                <!-- /.side-menu -->
                <!-- ================================== TOP NAVIGATION : END ================================== -->

                <!-- ============================================== HOT DEALS ============================================== -->
                <div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
                    <h3 class="section-title">hot deals</h3>
                    <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">
                
                        @foreach($hot_deal_products as $product)
                        <div class="item">
                            <div class="products">
                                <div class="hot-deal-wrapper">
                                    <div class="image"> <img src="{{ asset($product->product_thumbnail) }}" alt=""> </div>
                
                                    @php
                                    $discountPer = number_format(100-(($product->product_discount_price/$product->product_selling_price) * 100));
                                    @endphp
                
                                    @if ($product->product_discount_price == 0)
                                    <div class="tag hot"><span>hot</span></div>
                                    @else
                                    <div class="sale-offer-tag"><span>{{$discountPer}}%<br>
                                            off</span></div>
                                    @endif
                
                                    <div class="timing-wrapper">
                                        <div class="box-wrapper">
                                            <div class="date box"> <span class="key">120</span> <span class="value">DAYS</span> </div>
                                        </div>
                                        <div class="box-wrapper">
                                            <div class="hour box"> <span class="key">20</span> <span class="value">HRS</span> </div>
                                        </div>
                                        <div class="box-wrapper">
                                            <div class="minutes box"> <span class="key">36</span> <span class="value">MINS</span> </div>
                                        </div>
                
                                        <div class="box-wrapper hidden-md">
                                            <div class="seconds box"> <span class="key">60</span> <span class="value">SEC</span> </div>
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
                                    <div class="product-price"> <span class="price"> ₱ {{number_format($product->product_selling_price)}} </span>
                                    </div>
                                    @else

                                    <div class="product-price"> 
                                        <span class="price"> ₱ {{number_format($product->product_discount_price)}} </span>
                                        <span class="price-before-discount"> ₱ {{number_format($product->product_selling_price)}}</span>
                                        <span> -{{$discountPer}}%</span>
                                    </div>
                                    @endif
                                    <!-- /.product-price -->
                
                                </div>
                                <!-- /.product-info -->
                
                                <div class="cart clearfix animate-effect">
                                    <div class="action">
                                        <div class="add-cart-button btn-group">
                                            <button class="btn btn-primary icon" data-toggle="modal" data-target="#addToCartModal"
                                            id="addtocart-{{$product->id}}" onclick="productView({{$product->id}})" type="button"> <i
                                                    class="fa fa-shopping-cart"></i> </button>
                                            <button class="btn btn-primary cart-btn" data-toggle="modal" data-target="#addToCartModal"
                                            id="addtocart-{{$product->id}}" onclick="productView({{$product->id}})"
                                            type="button">Add to cart</button>
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
                <!-- ============================================== HOT DEALS: END ============================================== -->

                <!-- ============================================== SPECIAL OFFER ============================================== -->
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
                                                                <img src="{{ asset($product->product_thumbnail) }}" alt=""> </a> </div>
                                                        <!-- /.image -->
                
                                                    </div>
                                                    <!-- /.product-image -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col col-xs-7">
                                                    <div class="product-info">
                                                        <h3 class="name">
                                                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug ) }}">
                                                                {{$product->product_name }} {{ strtolower($product->product_size) }} </a>
                                                        </h3>

                                                        <div class="rating rateit-small"></div>
                                                        <div class="product-price"> 
                                                            @if ($product->product_discount_price <= 0)
                                                            <span  class="price">₱ {{ number_format($product->product_discount_price,2) }}</span>
                                                            @else
                                                            <span class="price-strike"> ₱ {{ number_format( ($product->product_selling_price),2) }}</span>
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
                <!-- ============================================== SPECIAL OFFER : END ============================================== -->
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
                                    <div class="product">
                                        <div class="product-micro">
                                            <div class="row product-micro-row">
                                                <div class="col col-xs-5">
                                                    <div class="product-image">
                                                        <div class="image"> <a href="#"> <img
                                                                    src="{{asset('assets/frontend/images/products/p28.jpg')}}"
                                                                    alt=""> </a> </div>
                                                        <!-- /.image -->

                                                    </div>
                                                    <!-- /.product-image -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col col-xs-7">
                                                    <div class="product-info">
                                                        <h3 class="name"><a href="#">Floral Print Shirt</a></h3>
                                                        <div class="rating rateit-small"></div>
                                                        <div class="product-price"> <span class="price"> $450.99 </span>
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
                                    <div class="product">
                                        <div class="product-micro">
                                            <div class="row product-micro-row">
                                                <div class="col col-xs-5">
                                                    <div class="product-image">
                                                        <div class="image"> <a href="#"> <img
                                                                    src="{{asset('assets/frontend/images/products/p15.jpg')}}"
                                                                    alt=""> </a> </div>
                                                        <!-- /.image -->

                                                    </div>
                                                    <!-- /.product-image -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col col-xs-7">
                                                    <div class="product-info">
                                                        <h3 class="name"><a href="#">Floral Print Shirt</a></h3>
                                                        <div class="rating rateit-small"></div>
                                                        <div class="product-price"> <span class="price"> $450.99 </span>
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
                                    <div class="product">
                                        <div class="product-micro">
                                            <div class="row product-micro-row">
                                                <div class="col col-xs-5">
                                                    <div class="product-image">
                                                        <div class="image"> <a href="#"> <img
                                                                    src="{{asset('assets/frontend/images/products/p26.jpg')}}"
                                                                    alt="image"> </a> </div>
                                                        <!-- /.image -->

                                                    </div>
                                                    <!-- /.product-image -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col col-xs-7">
                                                    <div class="product-info">
                                                        <h3 class="name"><a href="#">Floral Print Shirt</a></h3>
                                                        <div class="rating rateit-small"></div>
                                                        <div class="product-price"> <span class="price"> $450.99 </span>
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
                            <div class="item">
                                <div class="products special-product">
                                    <div class="product">
                                        <div class="product-micro">
                                            <div class="row product-micro-row">
                                                <div class="col col-xs-5">
                                                    <div class="product-image">
                                                        <div class="image"> <a href="#"> <img
                                                                    src="{{asset('assets/frontend/images/products/p18.jpg')}}"
                                                                    alt=""> </a> </div>
                                                        <!-- /.image -->

                                                    </div>
                                                    <!-- /.product-image -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col col-xs-7">
                                                    <div class="product-info">
                                                        <h3 class="name"><a href="#">Floral Print Shirt</a></h3>
                                                        <div class="rating rateit-small"></div>
                                                        <div class="product-price"> <span class="price"> $450.99 </span>
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
                                    <div class="product">
                                        <div class="product-micro">
                                            <div class="row product-micro-row">
                                                <div class="col col-xs-5">
                                                    <div class="product-image">
                                                        <div class="image"> <a href="#"> <img
                                                                    src="{{asset('assets/frontend/images/products/p17.jpg')}}"
                                                                    alt=""> </a> </div>
                                                        <!-- /.image -->

                                                    </div>
                                                    <!-- /.product-image -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col col-xs-7">
                                                    <div class="product-info">
                                                        <h3 class="name"><a href="#">Floral Print Shirt</a></h3>
                                                        <div class="rating rateit-small"></div>
                                                        <div class="product-price"> <span class="price"> $450.99 </span>
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
                                    <div class="product">
                                        <div class="product-micro">
                                            <div class="row product-micro-row">
                                                <div class="col col-xs-5">
                                                    <div class="product-image">
                                                        <div class="image"> <a href="#"> <img
                                                                    src="{{asset('assets/frontend/images/products/p16.jpg')}}"
                                                                    alt=""> </a> </div>
                                                        <!-- /.image -->

                                                    </div>
                                                    <!-- /.product-image -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col col-xs-7">
                                                    <div class="product-info">
                                                        <h3 class="name"><a href="#">Floral Print Shirt</a></h3>
                                                        <div class="rating rateit-small"></div>
                                                        <div class="product-price"> <span class="price"> $450.99 </span>
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
                            <div class="item">
                                <div class="products special-product">
                                    <div class="product">
                                        <div class="product-micro">
                                            <div class="row product-micro-row">
                                                <div class="col col-xs-5">
                                                    <div class="product-image">
                                                        <div class="image"> <a href="#"> <img
                                                                    src="{{asset('assets/frontend/images/products/p15.jpg')}}"
                                                                    alt="images">
                                                                <div class="zoom-overlay"></div>
                                                            </a> </div>
                                                        <!-- /.image -->

                                                    </div>
                                                    <!-- /.product-image -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col col-xs-7">
                                                    <div class="product-info">
                                                        <h3 class="name"><a href="#">Floral Print Shirt</a></h3>
                                                        <div class="rating rateit-small"></div>
                                                        <div class="product-price"> <span class="price"> $450.99 </span>
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
                                    <div class="product">
                                        <div class="product-micro">
                                            <div class="row product-micro-row">
                                                <div class="col col-xs-5">
                                                    <div class="product-image">
                                                        <div class="image"> <a href="#"> <img
                                                                    src="{{asset('assets/frontend/images/products/p14.jpg')}}"
                                                                    alt="">
                                                                <div class="zoom-overlay"></div>
                                                            </a> </div>
                                                        <!-- /.image -->

                                                    </div>
                                                    <!-- /.product-image -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col col-xs-7">
                                                    <div class="product-info">
                                                        <h3 class="name"><a href="#">Floral Print Shirt</a></h3>
                                                        <div class="rating rateit-small"></div>
                                                        <div class="product-price"> <span class="price"> $450.99 </span>
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
                                    <div class="product">
                                        <div class="product-micro">
                                            <div class="row product-micro-row">
                                                <div class="col col-xs-5">
                                                    <div class="product-image">
                                                        <div class="image"> <a href="#"> <img
                                                                    src="{{asset('assets/frontend/images/products/p13.jpg')}}"
                                                                    alt="image"> </a> </div>
                                                        <!-- /.image -->

                                                    </div>
                                                    <!-- /.product-image -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col col-xs-7">
                                                    <div class="product-info">
                                                        <h3 class="name"><a href="#">Floral Print Shirt</a></h3>
                                                        <div class="rating rateit-small"></div>
                                                        <div class="product-price"> <span class="price"> $450.99 </span>
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
                        <div class="item"  style="background-image: url({{ asset($slide->slider_img)}});">
                        <div class="container-fluid">
                            <div class="caption bg-color vertical-center text-left">
                                <div class="big-text fadeInDown-1 "> <span class="highlight">{{$slide->title}}</span>  </div>
                                <div class="excerpt fadeInDown-2 hidden-xs"> <span style="color: rgb(255, 255, 255)">{{$slide->description}}</span> </div>
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

                <!-- ============================================== SCROLL TABS ============================================== -->
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
                                                        <div class="image"> <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug)}}"><img
                                                                    src="{{asset($product->product_thumbnail)}}"
                                                                    alt=""></a> </div>
                                                        <!-- /.image -->
            
                                                        <div class="tag   
                                                        {{$tag == 'new' ?  'new' : ''}}
                                                        {{$tag == 'hot' ?  'hot' : ''}}
                                                        {{$tag == 'sale' ? 'sale' : ''}} ">
                                                    <span>{{$tag}}</span></div>
            
                                                    </div>
                                                    <!-- /.product-image -->
                                                    
            
                                                    <div class="product-info text-left">
                                                        <h3 class="name"><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug)}}">
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
                                                            <span class="price"> ₱  {{number_format($product->product_selling_price,2)}} </span>
                                                            @else
                                                            <span class="price"> ₱  {{number_format($discount,2)}} </span>
                                                            <span class="price-before-discount"> ₱ {{number_format($product->product_selling_price,2)}} </span>
                                                            <span> -{{number_format(100-($discount/$product->product_selling_price) * 100)}}%</span>
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
                                                                        id="addtocart-{{$product->id}}" onclick="productView({{$product->id}})"
                                                                        class="btn btn-primary icon" type="button" title="Add Cart"> 
                                                                        <i class="fa fa-shopping-cart"></i> </button>
                                                                </li>

                                                                <li>
                                                                    <button id="addtocart-{{$product->id}}" onclick="addToWishList({{$product->id}})"
                                                                    class="btn btn-primary icon" type="button" title="Wishlist"> 
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
                                                        <div class="image"> <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug)}}"><img
                                                                    src="{{asset($product->product_thumbnail)}}"
                                                                    alt=""></a> </div>
                                                        <!-- /.image -->
            
                                                        <div class="tag   
                                                        {{$tag == 'new' ?  'new' : ''}}
                                                        {{$tag == 'hot' ?  'hot' : ''}}
                                                        {{$tag == 'sale' ? 'sale' : ''}} ">
                                                    <span>{{$tag}}</span></div>
            
                                                    </div>
                                                    <!-- /.product-image -->
                                                    
            
                                                    <div class="product-info text-left">
                                                        <h3 class="name"><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug)}}">
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
                                                            <span class="price"> ₱  {{number_format($product->product_selling_price,2)}} </span>
                                                            @else
                                                            <span class="price"> ₱  {{number_format($discount,2)}} </span>
                                                            <span class="price-before-discount"> ₱ {{number_format($product->product_selling_price,2)}} </span>
                                                            <span> -{{number_format(100-($discount/$product->product_selling_price) * 100)}}%</span>
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
                                                                        id="addtocart-{{$product->id}}" onclick="productView({{$product->id}})"
                                                                        class="btn btn-primary icon" type="button" title="Add Cart"> 
                                                                        <i class="fa fa-shopping-cart"></i> </button>
                                                                </li>

                                                                <li>
                                                                    <button id="addtocart-{{$product->id}}" onclick="addToWishList({{$product->id}})"
                                                                    class="btn btn-primary icon" type="button" title="Wishlist"> 
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
                <!-- ============================================== SCROLL TABS : END ============================================== -->
                <!-- ============================================== WIDE PRODUCTS ============================================== -->
                <div class="wide-banners wow fadeInUp outer-bottom-xs">
                    <div class="row">
                        <div class="col-md-7 col-sm-7">
                            <div class="wide-banner cnt-strip">
                                <div class="image"> <img class="img-responsive"
                                        src="{{asset('assets/frontend/images/banners/home-banner1.jpg')}}" alt="">
                                </div>
                            </div>
                            <!-- /.wide-banner -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-5 col-sm-5">
                            <div class="wide-banner cnt-strip">
                                <div class="image"> <img class="img-responsive"
                                        src="{{asset('assets/frontend/images/banners/home-banner2.jpg')}}" alt="">
                                </div>
                            </div>
                            <!-- /.wide-banner -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.wide-banners -->
                <!-- ============================================== WIDE PRODUCTS : END ============================================== -->
              
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
                                        <div class="image"> <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug)}}"><img
                                                    src="{{asset($product->product_thumbnail)}}"
                                                    alt=""></a> </div>
                                        <!-- /.image -->

                                        <div class="tag   
                                        {{$tag == 'new' ?  'new' : ''}}
                                        {{$tag == 'hot' ?  'hot' : ''}}
                                        {{$tag == 'sale' ? 'sale' : ''}} ">
                                    <span>{{$tag}}</span></div>

                                    </div>
                                    <!-- /.product-image -->
                                    

                                    <div class="product-info text-left">
                                        <h3 class="name"><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug)}}">
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
                                            <span class="price"> ₱  {{number_format($product->product_selling_price,2)}} </span>
                                            @else
                                            <span class="price"> ₱  {{number_format($discount,2)}} </span>
                                            <span class="price-before-discount"> ₱ {{number_format($product->product_selling_price,2)}} </span>
                                            <span> -{{number_format(100-($discount/$product->product_selling_price) * 100)}}%</span>
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
                                                        id="addtocart-{{$product->id}}" onclick="productView({{$product->id}})"
                                                        class="btn btn-primary icon" type="button" title="Add Cart"> 
                                                        <i class="fa fa-shopping-cart"></i> </button>
                                                </li>

                                                <li>
                                                    <button id="addtocart-{{$product->id}}" onclick="addToWishList({{$product->id}})"
                                                    class="btn btn-primary icon" type="button" title="Wishlist"> 
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
                                <div class="image"> <img class="img-responsive"
                                        src="{{asset('assets/frontend/images/banners/home-banner.jpg')}}" alt=""> </div>
                                <div class="strip strip-text">
                                    <div class="strip-inner">
                                        <h2 class="text-right">New Mens Fashion<br>
                                            <span class="shopping-needs">Save up to 40% off</span>
                                        </h2>
                                    </div>
                                </div>
                                <div class="new-label">
                                    <div class="text">NEW</div>
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
                <!-- ============================================== BEST SELLER ============================================== -->

                <div class="best-deal wow fadeInUp outer-bottom-xs">
                    <h3 class="section-title">Best seller</h3>
                    <div class="sidebar-widget-body outer-top-xs">
                        <div class="owl-carousel best-seller custom-carousel owl-theme outer-top-xs">
                            <div class="item">
                                <div class="products best-product">
                                    <div class="product">
                                        <div class="product-micro">
                                            <div class="row product-micro-row">
                                                <div class="col col-xs-5">
                                                    <div class="product-image">
                                                        <div class="image"> <a href="#"> <img
                                                                    src="{{asset('assets/frontend/images/products/p20.jpg')}}"
                                                                    alt=""> </a> </div>
                                                        <!-- /.image -->

                                                    </div>
                                                    <!-- /.product-image -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col2 col-xs-7">
                                                    <div class="product-info">
                                                        <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                                                        <div class="rating rateit-small"></div>
                                                        <div class="product-price"> <span class="price"> $450.99 </span>
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
                                    <div class="product">
                                        <div class="product-micro">
                                            <div class="row product-micro-row">
                                                <div class="col col-xs-5">
                                                    <div class="product-image">
                                                        <div class="image"> <a href="#"> <img
                                                                    src="{{asset('assets/frontend/images/products/p21.jpg')}}"
                                                                    alt=""> </a> </div>
                                                        <!-- /.image -->

                                                    </div>
                                                    <!-- /.product-image -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col2 col-xs-7">
                                                    <div class="product-info">
                                                        <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                                                        <div class="rating rateit-small"></div>
                                                        <div class="product-price"> <span class="price"> $450.99 </span>
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
                            <div class="item">
                                <div class="products best-product">
                                    <div class="product">
                                        <div class="product-micro">
                                            <div class="row product-micro-row">
                                                <div class="col col-xs-5">
                                                    <div class="product-image">
                                                        <div class="image"> <a href="#"> <img
                                                                    src="{{asset('assets/frontend/images/products/p22.jpg')}}"
                                                                    alt=""> </a> </div>
                                                        <!-- /.image -->

                                                    </div>
                                                    <!-- /.product-image -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col2 col-xs-7">
                                                    <div class="product-info">
                                                        <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                                                        <div class="rating rateit-small"></div>
                                                        <div class="product-price"> <span class="price"> $450.99 </span>
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
                                    <div class="product">
                                        <div class="product-micro">
                                            <div class="row product-micro-row">
                                                <div class="col col-xs-5">
                                                    <div class="product-image">
                                                        <div class="image"> <a href="#"> <img
                                                                    src="{{asset('assets/frontend/images/products/p23.jpg')}}"
                                                                    alt=""> </a> </div>
                                                        <!-- /.image -->

                                                    </div>
                                                    <!-- /.product-image -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col2 col-xs-7">
                                                    <div class="product-info">
                                                        <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                                                        <div class="rating rateit-small"></div>
                                                        <div class="product-price"> <span class="price"> $450.99 </span>
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
                            <div class="item">
                                <div class="products best-product">
                                    <div class="product">
                                        <div class="product-micro">
                                            <div class="row product-micro-row">
                                                <div class="col col-xs-5">
                                                    <div class="product-image">
                                                        <div class="image"> <a href="#"> <img
                                                                    src="{{asset('assets/frontend/images/products/p24.jpg')}}"
                                                                    alt=""> </a> </div>
                                                        <!-- /.image -->

                                                    </div>
                                                    <!-- /.product-image -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col2 col-xs-7">
                                                    <div class="product-info">
                                                        <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                                                        <div class="rating rateit-small"></div>
                                                        <div class="product-price"> <span class="price"> $450.99 </span>
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
                                    <div class="product">
                                        <div class="product-micro">
                                            <div class="row product-micro-row">
                                                <div class="col col-xs-5">
                                                    <div class="product-image">
                                                        <div class="image"> <a href="#"> <img
                                                                    src="{{asset('assets/frontend/images/products/p25.jpg')}}"
                                                                    alt=""> </a> </div>
                                                        <!-- /.image -->

                                                    </div>
                                                    <!-- /.product-image -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col2 col-xs-7">
                                                    <div class="product-info">
                                                        <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                                                        <div class="rating rateit-small"></div>
                                                        <div class="product-price"> <span class="price"> $450.99 </span>
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
                            <div class="item">
                                <div class="products best-product">
                                    <div class="product">
                                        <div class="product-micro">
                                            <div class="row product-micro-row">
                                                <div class="col col-xs-5">
                                                    <div class="product-image">
                                                        <div class="image"> <a href="#"> <img
                                                                    src="{{asset('assets/frontend/images/products/p26.jpg')}}"
                                                                    alt=""> </a> </div>
                                                        <!-- /.image -->

                                                    </div>
                                                    <!-- /.product-image -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col2 col-xs-7">
                                                    <div class="product-info">
                                                        <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                                                        <div class="rating rateit-small"></div>
                                                        <div class="product-price"> <span class="price"> $450.99 </span>
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
                                    <div class="product">
                                        <div class="product-micro">
                                            <div class="row product-micro-row">
                                                <div class="col col-xs-5">
                                                    <div class="product-image">
                                                        <div class="image"> <a href="#"> <img
                                                                    src="{{asset('assets/frontend/images/products/p27.jpg')}}"
                                                                    alt=""> </a> </div>
                                                        <!-- /.image -->

                                                    </div>
                                                    <!-- /.product-image -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col2 col-xs-7">
                                                    <div class="product-info">
                                                        <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                                                        <div class="rating rateit-small"></div>
                                                        <div class="product-price"> <span class="price"> $450.99 </span>
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
                        </div>
                    </div>
                    <!-- /.sidebar-widget-body -->
                </div>
                <!-- /.sidebar-widget -->
                <!-- ============================================== BEST SELLER : END ============================================== -->

                <!-- ============================================== BLOG SLIDER ============================================== -->
                <section class="section latest-blog outer-bottom-vs wow fadeInUp">
                    <h3 class="section-title">latest form blog</h3>
                    <div class="blog-slider-container outer-top-xs">
                        <div class="owl-carousel blog-slider custom-carousel">
                            <div class="item">
                                <div class="blog-post">
                                    <div class="blog-post-image">
                                        <div class="image"> <a href="blog.html"><img
                                                    src="{{asset('assets/frontend/images/blog-post/post1.jpg')}}"
                                                    alt=""></a> </div>
                                    </div>
                                    <!-- /.blog-post-image -->

                                    <div class="blog-post-info text-left">
                                        <h3 class="name"><a href="#">Voluptatem accusantium doloremque laudantium</a>
                                        </h3>
                                        <span class="info">By Jone Doe &nbsp;|&nbsp; 21 March 2016 </span>
                                        <p class="text">Sed quia non numquam eius modi tempora incidunt ut labore et
                                            dolore magnam aliquam quaerat voluptatem.</p>
                                        <a href="#" class="lnk btn btn-primary">Read more</a>
                                    </div>
                                    <!-- /.blog-post-info -->

                                </div>
                                <!-- /.blog-post -->
                            </div>
                            <!-- /.item -->

                            <div class="item">
                                <div class="blog-post">
                                    <div class="blog-post-image">
                                        <div class="image"> <a href="blog.html"><img
                                                    src="{{asset('assets/frontend/images/blog-post/post2.jpg')}}"
                                                    alt=""></a> </div>
                                    </div>
                                    <!-- /.blog-post-image -->

                                    <div class="blog-post-info text-left">
                                        <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas nulla pariatur</a>
                                        </h3>
                                        <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
                                        <p class="text">Sed quia non numquam eius modi tempora incidunt ut labore et
                                            dolore magnam aliquam quaerat voluptatem.</p>
                                        <a href="#" class="lnk btn btn-primary">Read more</a>
                                    </div>
                                    <!-- /.blog-post-info -->

                                </div>
                                <!-- /.blog-post -->
                            </div>
                            <!-- /.item -->

                            <!-- /.item -->

                            <div class="item">
                                <div class="blog-post">
                                    <div class="blog-post-image">
                                        <div class="image"> <a href="blog.html"><img
                                                    src="{{asset('assets/frontend/images/blog-post/post1.jpg')}}"
                                                    alt=""></a> </div>
                                    </div>
                                    <!-- /.blog-post-image -->

                                    <div class="blog-post-info text-left">
                                        <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas nulla pariatur</a>
                                        </h3>
                                        <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
                                        <p class="text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                                            accusantium</p>
                                        <a href="#" class="lnk btn btn-primary">Read more</a>
                                    </div>
                                    <!-- /.blog-post-info -->

                                </div>
                                <!-- /.blog-post -->
                            </div>
                            <!-- /.item -->

                            <div class="item">
                                <div class="blog-post">
                                    <div class="blog-post-image">
                                        <div class="image"> <a href="blog.html"><img
                                                    src="{{asset('assets/frontend/images/blog-post/post2.jpg')}}"
                                                    alt=""></a> </div>
                                    </div>
                                    <!-- /.blog-post-image -->

                                    <div class="blog-post-info text-left">
                                        <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas nulla pariatur</a>
                                        </h3>
                                        <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
                                        <p class="text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                                            accusantium</p>
                                        <a href="#" class="lnk btn btn-primary">Read more</a>
                                    </div>
                                    <!-- /.blog-post-info -->

                                </div>
                                <!-- /.blog-post -->
                            </div>
                            <!-- /.item -->

                            <div class="item">
                                <div class="blog-post">
                                    <div class="blog-post-image">
                                        <div class="image"> <a href="blog.html"><img
                                                    src="{{asset('assets/frontend/images/blog-post/post1.jpg')}}"
                                                    alt=""></a> </div>
                                    </div>
                                    <!-- /.blog-post-image -->

                                    <div class="blog-post-info text-left">
                                        <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas nulla pariatur</a>
                                        </h3>
                                        <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
                                        <p class="text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                                            accusantium</p>
                                        <a href="#" class="lnk btn btn-primary">Read more</a>
                                    </div>
                                    <!-- /.blog-post-info -->

                                </div>
                                <!-- /.blog-post -->
                            </div>
                            <!-- /.item -->

                        </div>
                        <!-- /.owl-carousel -->
                    </div>
                    <!-- /.blog-slider-container -->
                </section>
                <!-- /.section -->
                <!-- ============================================== BLOG SLIDER : END ============================================== -->

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
                                        <div class="image"> <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug)}}"><img
                                                    src="{{asset($product->product_thumbnail)}}"
                                                    alt=""></a> </div>
                                        <!-- /.image -->

                                        <div class="tag   
                                        {{$tag == 'new' ?  'new' : ''}}
                                        {{$tag == 'hot' ?  'hot' : ''}}
                                        {{$tag == 'sale' ? 'sale' : ''}} ">
                                    <span>{{$tag}}</span></div>

                                    </div>
                                    <!-- /.product-image -->
                                    

                                    <div class="product-info text-left">
                                        <h3 class="name"><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug)}}">
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
                                            <span class="price"> ₱  {{number_format($product->product_selling_price,2)}} </span>
                                            @else
                                            <span class="price"> ₱  {{number_format($discount,2)}} </span>
                                            <span class="price-before-discount"> ₱ {{number_format($product->product_selling_price,2)}} </span>
                                            <span> -{{number_format(100-($discount/$product->product_selling_price) * 100)}}%</span>
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
                                                        id="addtocart-{{$product->id}}" onclick="productView({{$product->id}})"
                                                        class="btn btn-primary icon" type="button" title="Add Cart"> 
                                                        <i class="fa fa-shopping-cart"></i> </button>
                                                </li>

                                                <li>
                                                    <button id="addtocart-{{$product->id}}" onclick="addToWishList({{$product->id}})"
                                                    class="btn btn-primary icon" type="button" title="Wishlist"> 
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