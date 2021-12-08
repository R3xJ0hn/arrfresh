@extends('frontend.main_master')
@section('content')
@section('title')
Product Search Page
@endsection

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="/">Home</a></li>
            </ul>
        </div>
        <!-- /.breadcrumb-inner -->
    </div>
    <!-- /.container -->
</div>
<!-- /.breadcrumb -->

<style>
    [slider] {
        width: 100%;
        position: relative;
        height: 5px;
        margin: 45px 0;
    }

    [slider]>div {
        position: absolute;
        left: 13px;
        right: 15px;
        height: 5px;
    }

    [slider]>div>[inverse-left] {
        position: absolute;
        left: 0;
        height: 5px;
        border-radius: 10px;
        background-color: #CCC;
        margin: 0 7px;
    }

    [slider]>div>[inverse-right] {
        position: absolute;
        right: 0;
        height: 5px;
        border-radius: 10px;
        background-color: #CCC;
        margin: 0 7px;
    }

    [slider]>div>[range] {
        position: absolute;
        left: 0;
        height: 5px;
        border-radius: 14px;
        background-color: #2158d0;
    }

    [slider]>div>[thumb] {
        position: absolute;
        top: -7px;
        z-index: 2;
        height: 20px;
        width: 20px;
        text-align: left;
        margin-left: -11px;
        cursor: pointer;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.4);
        background-color: #FFF;
        border-radius: 50%;
        outline: none;
    }

    [slider]>input[type=range] {
        position: absolute;
        pointer-events: none;
        -webkit-appearance: none;
        z-index: 3;
        height: 14px;
        top: -2px;
        width: 100%;
        opacity: 0;
    }

    div[slider]>input[type=range]:focus::-webkit-slider-runnable-track {
        background: transparent;
        border: transparent;
    }

    div[slider]>input[type=range]:focus {
        outline: none;
    }

    div[slider]>input[type=range]::-webkit-slider-thumb {
        pointer-events: all;
        width: 28px;
        height: 28px;
        border-radius: 0px;
        border: 0 none;
        -webkit-appearance: none;
    }

    div[slider]>input[type=range]::-ms-fill-lower {
        background: transparent;
        border: 0 none;
    }

    div[slider]>input[type=range]::-ms-fill-upper {
        background: transparent;
        border: 0 none;
    }

    div[slider]>input[type=range]::-ms-tooltip {
        display: none;
    }

    [slider]>div>[sign] {
        opacity: 0;
        position: absolute;
        margin-left: -11px;
        top: -39px;
        z-index: 3;
        background-color: #2158d0;
        color: #fff;
        width: 28px;
        height: 28px;
        border-radius: 28px;
        -webkit-border-radius: 28px;
        align-items: center;
        -webkit-justify-content: center;
        justify-content: center;
        text-align: center;
    }

    [slider]>div>[sign]:after {
        position: absolute;
        content: '';
        left: 0;
        border-radius: 16px;
        top: 19px;
        border-left: 14px solid transparent;
        border-right: 14px solid transparent;
        border-top-width: 16px;
        border-top-style: solid;
        border-top-color: #2158d0;
    }
</style>

<div class="body-content outer-top-xs">
    <div class='container'>
        <div class='row'>
            <div class='col-md-3 sidebar'>

                <!-- ===== == CATEGORY NAVIGATION ======= ==== -->
                @include('frontend.common.side_category_menu')
                <!-- = ==== CATEGORY NAVIGATION : END === ===== -->

                <form action="{{ route('advance.search')}}" method="get">

                    <div class="sidebar-module-container">
                        <div class="sidebar-filter">
                            <!-- ============================================== SIDEBAR CATEGORY ============================================== -->
                            <div class="sidebar-widget wow fadeInUp">
                                <h3 class="section-title">shop by</h3>
                                <div class="widget-header">
                                    <h4 class="widget-title">Category</h4>
                                </div>
                                <div class="sidebar-widget-body">
                                    <div class="accordion">

                                        @foreach($categories as $category)
                                        <div class="accordion-group">
                                            <div class="accordion-heading">
                                                <a href="#collapse{{ $category->id }}" data-toggle="collapse"
                                                    class="accordion-toggle collapsed">
                                                    {{ $category->category_name}}
                                                </a>
                                            </div>
                                            <!-- /.accordion-heading -->
                                            <div class="accordion-body collapse" id="collapse{{ $category->id }}"
                                                style="height: 0px;">
                                                <div class="accordion-inner">

                                                    @php
                                                    $subcategories =
                                                    App\Models\SubCategory::where('category_id',$category->id)->orderBy('subcategory_name','ASC')->get();
                                                    @endphp

                                                    @foreach($subcategories as $subcategory)

                                                    <div style="margin-left: 2rem">
                                                        <input type="radio" name="subcategory"
                                                            id="subcat{{$subcategory->id}}" value="{{$subcategory->id}}">
                                                        <label for="subcat{{$subcategory->id}}"
                                                            style="font-weight: normal;"> {{
                                                            $subcategory->subcategory_name }}</label>
                                                    </div>
                                                    @endforeach

                                                </div>
                                                <!-- /.accordion-inner -->
                                            </div>
                                            <!-- /.accordion-body -->
                                        </div>
                                        <!-- /.accordion-group -->
                                        @endforeach
                                    </div>
                                    <!-- /.accordion -->
                                </div>
                                <!-- /.sidebar-widget-body -->
                            </div>
                            <!-- /.sidebar-widget -->
                            <!-- ============================================== SIDEBAR CATEGORY : END ============================================== -->

                            <!-- ============================================== PRICE SILDER============================================== -->
                            <div class="sidebar-widget wow fadeInUp">
                                <hr>
                                <div class="widget-header">
                                    <h4 class="widget-title">Price Range</h4>
                                </div>
                                <div class="sidebar-widget-body m-t-10">

                                    <div class="row">
                                        <div class="col-sm-2" style="margin: 1rem; margin-top:0">
                                            <label for="range-min" style="width: 4rem">Min</label>
                                            <input type="number" id="range-min" style="width: 7rem" 
                                                name="range_min" value="0">
                                        </div>
                                        <div class="col-sm-2" style="margin: 1rem; margin-top:0">
                                            <label for="range-max" style="width: 4rem; margin-left:20px">Max</label>
                                            <input type="number" id="range-max" style="width: 7rem; margin-left:20px;"
                                                name="range_max" value="0">
                                        </div>
                                    </div>

                                    <!-- /.price-range-holder -->
                                    <input type="submit"  class="lnk btn btn-primary " style="margin-left:12rem; margin-top:1rem;" value="Show Now">
                
                                </div>
                                <!-- /.sidebar-widget-body -->
                            </div>
                            <!-- /.sidebar-widget -->
                            <!-- ============================================== PRICE SILDER : END ============================================== -->
                </form>

            </div>
            <!-- /.sidebar-filter -->
        </div>
        <!-- /.sidebar-module-container -->
    </div>
    <!-- /.sidebar -->
    <div class='col-md-9'>

        <h4 style="margin:0 2rem">
            {{ count($products) }} Items Found
        </h4>

        <div class="clearfix filters-container m-t-10">
            <div class="row">
                <div class="col col-sm-6 col-md-2">
                    <div class="filter-tabs">
                        <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                            <li class="active"> <a data-toggle="tab" href="#grid-container"><i
                                        class="icon fa fa-th-large"></i>Grid</a> </li>
                            <li><a data-toggle="tab" href="#list-container"><i class="icon fa fa-th-list"></i>List</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.filter-tabs -->
                </div>
                <!-- /.col -->
                <div class="col col-sm-12 col-md-6">
                    <div class="col col-sm-3 col-md-6 no-padding">
                        <div class="lbl-cnt"> <span class="lbl">Sort by</span>
                            <div class="fld inline">
                                <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                    <button data-toggle="dropdown" type="button" class="btn dropdown-toggle">
                                        Position <span class="caret"></span> </button>
                                    <ul role="menu" class="dropdown-menu">
                                        <li role="presentation"><a href="#">position</a></li>
                                        <li role="presentation"><a href="#">Price:Lowest first</a></li>
                                        <li role="presentation"><a href="#">Price:HIghest first</a></li>
                                        <li role="presentation"><a href="#">Product Name:A to Z</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /.fld -->
                        </div>
                        <!-- /.lbl-cnt -->
                    </div>
                    <!-- /.col -->
                    <div class="col col-sm-3 col-md-6 no-padding">
                        <div class="lbl-cnt"> <span class="lbl">Show</span>
                            <div class="fld inline">
                                <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                    <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> 1
                                        <span class="caret"></span> </button>
                                    <ul role="menu" class="dropdown-menu">
                                        <li role="presentation"><a href="#">1</a></li>
                                        <li role="presentation"><a href="#">2</a></li>
                                        <li role="presentation"><a href="#">3</a></li>
                                        <li role="presentation"><a href="#">4</a></li>
                                        <li role="presentation"><a href="#">5</a></li>
                                        <li role="presentation"><a href="#">6</a></li>
                                        <li role="presentation"><a href="#">7</a></li>
                                        <li role="presentation"><a href="#">8</a></li>
                                        <li role="presentation"><a href="#">9</a></li>
                                        <li role="presentation"><a href="#">10</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /.fld -->
                        </div>
                        <!-- /.lbl-cnt -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.col -->
                <div class="col col-sm-6 col-md-4 text-right">

                    <!-- /.pagination-container -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>


        <!--    //////////////////// START Product Grid View  ////////////// -->

        <div class="search-result-container ">
            <div id="myTabContent" class="tab-content category-list">
                <div class="tab-pane active " id="grid-container">
                    <div class="category-product">
                        <div class="row">

                            @foreach($products as $product)
                            <div class="col-sm-6 col-md-4 wow fadeInUp">
                                <div class="products">
                                    <div class="product">
                                        <div class="product-image">
                                            <div class="image"> <a
                                                    href="{{ url('product/details/'.$product->id.'/'.$product->product_slug ) }}"><img
                                                        src="{{ asset($product->product_thumbnail) }}" alt=""></a>
                                            </div>
                                            <!-- /.image -->

                                            @php
                                            $discountPer =
                                            number_format(100-(($product->product_discount_price/$product->product_selling_price)
                                            * 100));
                                            @endphp

                                        </div>
                                        <!-- /.product-image -->

                                        <div class="product-info text-left">
                                            <h3 class="name"><a
                                                    href="{{ url('product/details/'.$product->id.'/'.$product->product_slug ) }}">
                                                    {{ $product->product_name }}

                                                </a></h3>
                                            <div class="rating rateit-small"></div>
                                            <div class="description"></div>


                                            @if ($product->discount_price == NULL)
                                            <div class="product-price"> <span class="price"> ₱{{
                                                    $product->product_selling_price }} </span> </div>

                                            @else

                                            <div class="product-price"> <span class="price"> ₱{{
                                                    $product->discount_price }} </span> <span
                                                    class="price-before-discount"> ₱{{ $product->product_selling_price
                                                    }}</span> </div>
                                            @endif


                                        </div>
                                        <!-- /.product-info -->
                                        <div class="cart clearfix animate-effect">
                                            <div class="action">
                                                <ul class="list-unstyled">
                                                    <li class="add-cart-button btn-group">
                                                        <button class="btn btn-primary icon" data-toggle="dropdown"
                                                            type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                                        <button class="btn btn-primary cart-btn" type="button">Add to
                                                            cart</button>
                                                    </li>
                                                    <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html"
                                                            title="Wishlist"> <i class="icon fa fa-heart"></i> </a>
                                                    </li>
                                                    <li class="lnk"> <a class="add-to-cart" href="detail.html"
                                                            title="Compare"> <i class="fa fa-signal"></i> </a>
                                                    </li>
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
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.category-product -->

                </div>
                <!-- /.tab-pane -->

                <!--            //////////////////// END Product Grid View  ////////////// -->

                <!--            //////////////////// Product List View Start ////////////// -->
                <div class="tab-pane " id="list-container">
                    <div class="category-product">
                        @foreach($products as $product)
                        <div class="category-product-inner wow fadeInUp">
                            <div class="products">
                                <div class="product-list product">
                                    <div class="row product-list-row">
                                        <div class="col col-sm-4 col-lg-4">
                                            <div class="product-image">
                                                <div class="image"> <img src="{{ asset($product->product_thumbnail) }}"
                                                        alt="">
                                                </div>
                                            </div>
                                            <!-- /.product-image -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col col-sm-8 col-lg-8">
                                            <div class="product-info">
                                                <h3 class="name"><a
                                                        href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                                                        {{ $product->product_name_en }}</a></h3>

                                                <div class="rating rateit-small"></div>


                                                @if ($product->discount_price == NULL)
                                                <div class="product-price"> <span class="price"> ₱{{
                                                        $product->product_selling_price }} </span> </div>
                                                @else
                                                <div class="product-price"> <span class="price"> ₱{{
                                                        $product->discount_price }} </span> <span
                                                        class="price-before-discount"> ₱{{
                                                        $product->product_selling_price }}</span> </div>
                                                @endif

                                                <!-- /.product-price -->
                                                <div class="description m-t-10">
                                                    {{ $product->short_descp_en }}</div>
                                                <div class="cart clearfix animate-effect">
                                                    <div class="action">
                                                        <ul class="list-unstyled">
                                                            <li class="add-cart-button btn-group">
                                                                <button class="btn btn-primary icon"
                                                                    data-toggle="dropdown" type="button"> <i
                                                                        class="fa fa-shopping-cart"></i>
                                                                </button>
                                                                <button class="btn btn-primary cart-btn"
                                                                    type="button">Add to cart</button>
                                                            </li>
                                                            <li class="lnk wishlist"> <a class="add-to-cart"
                                                                    href="detail.html" title="Wishlist"> <i
                                                                        class="icon fa fa-heart"></i> </a> </li>
                                                            <li class="lnk"> <a class="add-to-cart" href="detail.html"
                                                                    title="Compare"> <i class="fa fa-signal"></i> </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- /.action -->
                                                </div>
                                                <!-- /.cart -->

                                            </div>
                                            <!-- /.product-info -->
                                        </div>
                                        <!-- /.col -->
                                    </div>

                                    @php
                                    $discountPer =
                                    number_format(100-(($product->product_discount_price/$product->product_selling_price)
                                    * 100));
                                    @endphp

                                </div>
                                <!-- /.product-list -->
                            </div>
                            <!-- /.products -->
                        </div>
                        <!-- /.category-product-inner -->
                        @endforeach

                        <!--            //////////////////// Product List View END ////////////// -->
                    </div>
                    <!-- /.category-product -->
                </div>
                <!-- /.tab-pane #list-container -->
            </div>
            <!-- /.tab-content -->
            <div class="clearfix filters-container">
                <div class="text-right">
                    <div class="pagination-container">
                        <ul class="list-inline list-unstyled">

                        </ul>
                        <!-- /.list-inline -->
                    </div>
                    <!-- /.pagination-container -->
                </div>
                <!-- /.text-right -->

            </div>
            <!-- /.filters-container -->

        </div>
        <!-- /.search-result-container -->

    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
<!-- ============================================== BRANDS CAROUSEL ============================================== -->
@include('frontend.body.brands')
<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
</div>
<!-- /.container -->

</div>
<!-- /.body-content -->
@endsection