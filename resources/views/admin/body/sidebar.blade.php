@php
    $prefix = Request::route()->getPrefix();
    $route =Route::current()->getName();
@endphp

<aside class="main-sidebar">
  <!-- sidebar-->
  <section class="sidebar">

      <div class="user-profile">
          <div class="ulogo">
              <a href="{{url('/admin/dashboard')}}">
                  <!-- logo for regular state and mobile devices -->
                  <div class="d-flex align-items-center justify-content-center">
                      <img src="../images/logo-dark.png" alt="">
                      <h3><b>Grocery</b> Admin</h3>
                  </div>
              </a>
          </div>
      </div>

      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree">

          <li class="{{ ($route == 'dashboard')? 'active':'' }}">
              <a href="{{ url('/admin/dashboard')}}">
                  <i data-feather="pie-chart"></i>
                  <span>Dashboard</span>
              </a>
          </li>

          <li class="{{ ($route == 'brands')? 'active':'' }}">
              <a href="{{ route('brands')}}">
                  <i data-feather="tag"></i>
                  <span>Brands</span>
              </a>
          </li>

          <li class="treeview {{ ($route == 'categories')? 'active':'' }}">
            <a href="#">
                <i data-feather="grid"></i> 
                <span>Categories</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ ($route == 'categories')? 'active':'' }}">
                    <a href="{{ route('categories')}}"><i class="ti-more"></i>Main Categories</a>
                </li>
                <li class="{{ ($route == 'sub.categories')? 'active':'' }}">
                    <a href="{{ route('sub.categories')}}"><i class="ti-more"></i>Sub Categories</a>
                </li>
            </ul>
        </li>

        <li class="{{ ($prefix == '/products')? 'active':'' }}">
            <a href="{{ route('product.manage')}}">
                <i data-feather="package"></i>
                <span>Products</span>
            </a>
        </li>

        <li class="{{ ($route == 'manage-coupon')? 'active':'' }}">
            <a href="{{ route('manage-coupon')}}">
                <i class="fa fa-ticket" style="height:20px; font-size:24px; color:{{ ($route == 'manage-coupon')? 'white':'' }};"></i>
                <span>Coupon</span>
            </a>
        </li>

        <li class="{{ ($prefix == '/zone')? 'active':'' }}">
            <a href="{{ route('manage-shippingzone')}}">
                <i class="mdi mdi-map-marker-radius" style="height:20px; font-size:24px; color:{{ ($prefix == '/zone')? 'white':'' }};"></i>
                <span>Shipping Zone</span>
            </a>
        </li>

        <li class="treeview {{ ($prefix == '/orders')? 'active':'' }}">
            <a href="#">
                <i class="mdi mdi-truck-delivery" style="height:20px; font-size:24px; color:{{ ($prefix == '/shipping')? 'white':'' }};"></i>
                <span>Orders</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ ($route == 'pending-orders')? 'active':'' }}">
                    <a href="{{ route('pending-orders')}}"><i class="ti-more"></i>Pending Orders</a>
                </li>

                <li class="{{ ($route == 'picked-orders')? 'active':'' }}">
                    <a href="{{ route('picked-orders')}}"><i class="ti-more"></i>Picked Orders</a>
                </li>

                <li class="{{ ($route == 'ship-orders')? 'active':'' }}">
                    <a href="{{ route('ship-orders')}}"><i class="ti-more"></i>Ship Orders</a>
                </li>

                <li class="{{ ($route == 'delivered-parcel')? 'active':'' }}">
                    <a href="{{ route('delivered-parcel')}}"><i class="ti-more"></i>Delivered Parcels</a>
                </li>
            </ul>
        </li>

        <li class="treeview {{ ($prefix == '/settings')? 'active':'' }}">
            <a href="#">
                <i data-feather="layout"></i> 
                <span>Page Settings</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ ($route == 'categories')? 'active':'' }}">
                    <a href="{{ route('pageInfos')}}"><i class="ti-more"></i>Page Informations</a>
                </li>
                <li class="{{ ($route == 'sliders')? 'active':'' }}">
                    <a href="{{ route('sliders')}}"><i class="ti-more"></i>Sliders</a>
                </li>
            </ul>
        </li>








      </ul>
  </section>
</aside>