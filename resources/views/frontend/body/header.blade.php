@php
  use App\Http\Controllers\Backend\Manager\PageInfoController;
	$settings= PageInfoController::GetSettingInfo();
@endphp

<header class="header-style-1"> 
  
    <!-- ============================================== TOP MENU ============================================== -->
    <div class="top-bar animate-dropdown">
      <div class="container">
        <div class="header-top-inner">
          <div class="cnt-account">
            <ul class="list-unstyled">
             
              @auth
              <li><a href="{{ route('user.wishlist')}}"><i class="icon fa fa-heart"></i>Wishlist</a></li>
              <li><a href="{{ route('user.cart')}}"><i class="icon fa fa-shopping-cart"></i>My Cart</a></li>
              <li><a href="{{route('user.profile')}}"><i class="icon fa fa-user"></i>My Account</a></li>
              @else
              <li><a href="{{route('login')}}"><i class="icon fa fa-lock"></i>Login</a></li>
              <li><a href="{{route('register')}}">Register</a></li>
              @endauth

            </ul>
          </div>
          <!-- /.cnt-account -->
          
          <div class="clearfix"></div>
        </div>
        <!-- /.header-top-inner --> 
      </div>
      <!-- /.container --> 
    </div>
    <!-- /.header-top --> 
    <!-- ============================================== TOP MENU : END ============================================== -->
    <div class="main-header">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-3 logo-holder"> 
            <!-- ============================================================= LOGO ============================================================= -->
            <div class="logo"> <a href="{{ url('/')}}"> <img src="/{{$settings->logo}}" alt="logo"> </a> </div>
            <!-- /.logo --> 
            <!-- ============================================================= LOGO : END ============================================================= --> </div>
          <!-- /.logo-holder -->
          
          <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder"> 
            <!-- /.contact-row --> 
            <!-- ============================================================= SEARCH AREA ============================================================= -->
            <div class="search-area">
                <div class="control-group">

                  <form action="{{ route('product.search') }}"  method="get">
                    <input class="search-field" onfocus="search_result_show()" onblur="search_result_hide()" id="search" name="search" placeholder="Search here..." style="width: 80%" />
                    <input  class="search-button" type="submit" type="text">
                  </form>

                </div>
              <div id="searchProducts"></div>
            </div>
            <!-- /.search-area --> 
            <!-- ============================================================= SEARCH AREA : END ============================================================= --> </div>
          <!-- /.top-search-holder -->
          
          <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row"> 
            @php
            $route = Route::current()->getName();
            @endphp
            <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
            <div class="dropdown dropdown-cart" style="cursor: pointer">
               <a  class="dropdown-toggle lnk-cart" data-toggle= "{{ ($route != 'user.cart') ? 'dropdown': '' }}">
              <div class="items-cart-inner">
                <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>

                <div class="basket-item-count"><span class="count" id="cartQty"> </span></div>
                <div class="total-price-basket"> <span class="lbl">cart -</span> 
                  <span class="total-price"> 
                    <span class="sign">₱ </span>
                   <span class="value" id="miniCartSubTotal"></span> 
                 </span>
               </div>
              
                <span class='price'> </span> 
                
              </div>
              </a>
              <ul class="dropdown-menu">
                <li>

                  {{-- // LOAD MINICART --}}
                    <div id="miniCart">  </div>
                  {{-- // END LOAD MINICART --}}

                  <!-- /.cart-item -->
                  <div class="clearfix"></div>
                  <hr>
                  <div class="clearfix cart-total">

                    <div class="pull-right"> <span class="text">Sub Total :</span>
                      <span class='price'>₱ </span>
                      <span class='price' id="miniCartSubTotal"></span>
                     </div>
                    <div class="clearfix"></div>
                    <a href="{{ route('user.cart')}}" class="btn btn-upper btn-primary btn-block m-t-20">View Cart</a> </div>
                  <!-- /.cart-total--> 
                  
                </li>
              </ul>
              <!-- /.dropdown-menu--> 
            </div>
            <!-- ============================================================= SHOPPING CART DROPDOWN: END============================================================= --> </div>
            <!-- /.top-cart-row --> 

        </div>
        <!-- /.row --> 
        
      </div>
      <!-- /.container --> 
      
    </div>
    <!-- /.main-header --> 
    
  </header>

  
<style>
  
  .search-area{
    position: relative;
  }
  
    #searchProducts {
      position: absolute;
      top: 100%;
      left: 0;
      width: 100%;
      background: #ffffff;
      z-index: 999;
      border-radius: 8px;
      margin-top: 5px;
    }
  </style>
  
  <script>
    function search_result_hide(){
      $("#searchProducts").slideUp();
    }
  
     function search_result_show(){
        $("#searchProducts").slideDown();
    }

    // var searchBar = document.getElementById("search");
    // searchBar.addEventListener("keyup", function(e){
    //   if(e.keyCode === 13){
    //     searchClick()
    //     e.preventDefault();
    //   }
    // })

    // function searchClick(){
    //   alert()
    //   "{{ route('product.search') }}"
    // }
    
  </script>