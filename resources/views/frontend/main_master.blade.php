<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="description" content="">

<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="author" content="">
<meta name="keywords" content="MediaCenter, Template, eCommerce">
<meta name="robots" content="all">
<title>@yield('title')</title>

<!-- Bootstrap Core CSS -->
<link rel="stylesheet" href="{{asset('assets/frontend/css/bootstrap.min.css')}}">

<!-- Customizable CSS -->   
<link rel="stylesheet" href="{{asset('assets/frontend/css/main.css')}}">
<link rel="stylesheet" href="{{asset('assets/frontend/css/blue.css')}}">
<link rel="stylesheet" href="{{asset('assets/frontend/css/owl.carousel.css')}}">
<link rel="stylesheet" href="{{asset('assets/frontend/css/owl.transitions.css')}}">
<link rel="stylesheet" href="{{asset('assets/frontend/css/animate.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/frontend/css/rateit.css')}}">
<link rel="stylesheet" href="{{asset('assets/frontend/css/bootstrap-select.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/toastr.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/assets/vendor_components/sweetalert/sweetalert.css') }}">

<style> .d-none{display:none;} </style>

<!-- Icons/Glyphs -->
<link rel="stylesheet" href="{{asset('assets/frontend/css/font-awesome.css')}}">

<!-- Fonts -->
<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
</head>

<body class="cnt-home">

<!-- ============================================== HEADER ============================================== -->
@include('frontend.body.header')
<!-- ============================================== HEADER : END ============================================== -->

@yield('content')
<!-- /#top-banner-and-menu --> 

<!-- ============================================================= FOOTER ============================================================= -->
@include('frontend.body.footer')
<!-- ============================================================= FOOTER : END============================================================= --> 

  <!-- Modal -->
  <div class="modal fade" id="addToCartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right:2%;">
                <span aria-hidden="true">&times;</span>
              </button>
          <h3 class="modal-title" >Add To Cart</h3>
        </div>

        <div class="modal-body" id="modal-productBody">
    
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img id="pimage" src="" alt="product img" class="card-img">
                    </div>
                </div>

                <div class="col-md-8">

                    <div class="row">
                        <h3 style="margin:0px"><b id="pname"></b></h3>
                        <small class="text-secondary" style="color: gray" >Brand: <span id="pbrand"></span></small><br>
                        <small class="text-secondary" style="color: gray" >Category: <span id="pcategory"></span></small>
                    </div>

                    <div class="row">
                        <div class="col-md-6"  style="padding: 0px; padding-top:2.5%;" >

                            <h5><span style="font-weight: bold">Price:</span>
                                <span  style="font-weight:bold; font-size:24px; color:#ff7878;" id="pCurrentPrice"></span> 
                                <small style= "text-decoration: line-through;"  id="pLastPrice"></small>
                            </h5>

                            <h5><span style="font-weight: bold">Size:</span> <span id="psize"></span></h5>
                            <h5><span style="font-weight: bold">Stock:</span> 
                                <span id="pstock"></span> 
                                <span id="poutstock"  style="font-weight:bold; color:#ff7878;" > out of Stock</span>
                            </h5>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Select Color</label>
                                <h6 id="modalNoColorAvailable">No Color Available</h6>
                                <select class="form-control" id="pcolor" name="modalColor"> 
                                </select>

                            </div>

                            <div class="form-group" >
                                <label for="qty">Quantity</label>
                                <input type="number" class="form-control" id="qty" value="1" min="1">
                            </div>
                        </div>
                    </div>

                </div>
            </div>  {{-- end of main row --}}
            <input type="hidden" id="product_id" value="">
            <input type="hidden" id="product_size" value="">
            <input type="hidden" id="product_stock" value="">
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="closeModal" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="addToCart()" >Add to Cart</button>
        </div>
      </div>
    </div>
  </div>


<!-- JavaScripts placed at the end of the document so the pages load faster --> 
<script src="{{asset('assets/frontend/js/jquery-1.11.1.min.js')}}"></script> 
<script src="{{asset('assets/frontend/js/bootstrap.min.js')}}"></script> 
<script src="{{asset('assets/frontend/js/bootstrap-hover-dropdown.min.js')}}"></script> 
<script src="{{asset('assets/frontend/js/owl.carousel.min.js')}}"></script> 
<script src="{{asset('assets/frontend/js/echo.min.js')}}"></script> 
<script src="{{asset('assets/frontend/js/jquery.easing-1.3.min.js')}}"></script> 
<script src="{{asset('assets/frontend/js/bootstrap-slider.min.js')}}"></script> 
<script src="{{asset('assets/frontend/js/jquery.rateit.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('assets/frontend/js/lightbox.min.js')}}"></script> 
<script src="{{asset('assets/frontend/js/bootstrap-select.min.js')}}"></script> 
<script src="{{asset('assets/frontend/js/wow.min.js')}}"></script> 
<script src="{{asset('assets/frontend/js/scripts.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/backend/js/pages/toastr.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/assets/vendor_components/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{mix('js/app.js')}}"></script> 

<script type="text/javascript">
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });

    function fireToast(data){
        // Start Message 
        const Toast = swal.mixin({
        toast: true,
        position: 'top-end',
        icon: 'success',
        showConfirmButton: false,
        timer: 3000
        })

        if ($.isEmptyObject(data.error)) {

            if($.isEmptyObject(data.info)) {
                Toast.fire({
                icon: 'success',
                title: data.success
                });
                
            }else{
                Toast.fire({
                icon: 'info',
                title: data.info
                });
            }
            
        }else{
            Toast.fire({
                icon: 'error',
                title: data.error
            })
        } // End Message 
    }// end method
    
    function productView(id){
        $('#modal-productBody').addClass('d-none');
        $('#qty').val(1);
        $.ajax({
            type: 'GET',
            url: '/product/view/'+id,
            dataType:'json',
            
            success:function(data){
                console.log(data)
                $('#pname').text(data.product_name);
                $('#pcategory').text(data.product_category);
                $('#pbrand').text(data.product_brand);
                $('#psize').text(data.product_size);
                $('#pimage').attr('src','/'+data.product_thumbnail).width(150).height(164);
                $('#modal-productBody').removeClass('d-none');
                $('#qty').attr('max',data.product_stock);
                $('#product_id').val(data.product_id);
                $('#product_stock').val(data.product_stock);
                $('#product_size').val(data.product_size);
               
                // Product Price 
                if (data.product_discount_price == 0) {
                    $('#pCurrentPrice').text('₱ '+data.product_selling_price);
                    $('#pLastPrice').text('');
                }else{
                    $('#pCurrentPrice').text('₱ '+data.product_discount_price);
                    $('#pLastPrice').text('₱ '+data.product_selling_price);
                } // end prodcut price 

                //Product Stock Status
                if(data.product_stock == 0){
                    $('#poutstock').show(); 
                    $('#pstock').hide(); 
                    $('#qty').attr('disabled','disabled');
                    $('#qty').val('');
                }else{
                    $('#poutstock').hide(); 
                    $('#pstock').show(); 
                    $('#pstock').text(data.product_stock); 
                    $('#qty').removeAttr('disabled');
                }

                // Color
                $('select[name="modalColor"]').empty();        
                $.each(data.product_colors,function(key,value){
                    $('select[name="modalColor"]').append('<option value=" '+value+' ">'+value+' </option>');
                    if(data.product_colors== ""){
                        $('#modalNoColorAvailable').removeClass('d-none');
                        $('select[name="modalColor"]').addClass('d-none');
                    }else{
                        $('#modalNoColorAvailable').addClass('d-none');
                        $('select[name="modalColor"]').removeClass('d-none');
                    }

                }) // end color

            }// end success

        }); //end Ajax
    } // end Preview Function

        @if (Session:: has('message'))
        var type = "{{Session::get('alert-type','info')}}"
        switch (type) {
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;
            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;
            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;
            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
            case 'order_succeeded':
                var msg = { success: 'Successfully placed order. '}
                fireToast(msg);
                break;
            case 'order_failed':
                alert('Card Declined');
                var msg = { error:'Transaction Failed'}
                fireToast(msg);
            break;
        }
        @endif

</script>

<!-- //User Cart/ -->
<script type="text/javascript">

    //Add To Cart Product 
    function addToCart(){
        $('#closeModal').click();
            var product_name = $('#pname').text();
            var id = $('#product_id').val();
            var color = $('#pcolor option:selected').text();
            var quantity = $('#qty').val();
            var size = $('#product_size').val();

            $.ajax({
                type: "POST",
                dataType: 'json',
                data:{
                    color:color, size:size, quantity:quantity, product_name:product_name,
                },
                url: "/cart/data/store/"+id,
                success:function(data){
                    cart();
                    couponCalculation();
                    fireToast(data);
                }
            });
    }//End Add To Cart Product 
     
    //Remove To Cart
    function RemoveToCart(rowId){
        $.ajax({
            type: 'GET',
            url: '/cart/minicart-remove/'+rowId,
            dataType:'json',
            success:function(data){
                couponCalculation()
                cart();
                fireToast(data);
                if(data.isCartEmpty){
                location.reload();
                }
             }
        });

    }//End Minicart Remove To Cart

    //Load Items From Cart
    function cart(){
      $.ajax({
          type: 'GET',
          url: '/cart/getcart/',
          dataType:'json',
          success:function(response){

              $('#cartQty').text(response.cartQty);
              var miniCart = ""
              var cartPage =""

              $.each(response.cart, function(key,value){
                    miniCart += `<div class="cart-item product-summary"  style="margin:5% 0%;">
                        <div class="row">
                            <div class="col-xs-4">
                            <div class="image"> <a href="detail.html"><img src="/${value.productImg}" alt=""></a> </div>
                            </div>
                            <div class="col-xs-7">
                            <h3 class="name"><a href="{{ url('product/details/${value.productId}/${value.productSlug}')}}">${value.productName} ${value.productSize}</a></h3>
                            <div class="price"> ₱ ${value.productPrice} <small style="color:#FF7878; font-weight:normal;"> x ${value.productQty} </small> </div>
                            </div>
                            <div class="col-xs-1 action"> 
                            <button type="submit" id="${value.rowId}" onclick="RemoveToCart(this.id)"><i class="fa fa-trash"></i></button> </div>
                        </div>
                    </div>`

                    cartPage +=   `<tr>
                        <td class="romove-item">
                            <button type="submit" id="${value.rowId}" onclick="RemoveToCart(this.id)"><i class="fa fa-trash-o"></i></button>
                        </td>
                        <td class="cart-image">
                            <a class="entry-thumbnail" href="{{ url('product/details/${value.productId}/${value.productSlug}')}}">
                                <img src="/${value.productImg}" alt="" style="width:82px; height:90px;">
                            </a>
                        </td>
                        <td class="cart-product-name-info">
                            <h4 class='cart-product-description'>
                                <a href="{{ url('product/details/${value.productId}/${value.productSlug}')}}">${value.productName}</a>
                                </h4>
                            <!-- 
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="rating rateit-small"></div>
                                </div> 
                                <div class="col-sm-8">
                                    <div class="reviews">
                                        (06 Reviews)
                                    </div>
                                </div>
                            </div>-->
                            <div class="cart-product-info">
                            <span class="product-color">Size:<span>${value.productSize}</span></span>
                            </div>
                        </td>

					    <td class="cart-product-edit">
                            ${value.productColor == null ?  'none' : value.productColor }
                        </td>

                        <td class="cart-product-quantity">
                            <div class="cart-quantity">
                                <div class="quant-input">
                                    <div class="arrows">
                                        <div class="arrow plus gradient" onclick="cartIncrement('${value.rowId}','${value.productStock}')">
                                            <span class="ir"><i class="icon fa fa-sort-asc"></i></span>
                                        </div>
                                        <div class="arrow minus gradient" onclick="cartDecrement('${value.rowId}','${value.productStock}')">
                                            <span class="ir"><i class="icon fa fa-sort-desc"></i></span>
                                        </div>
                                    </div>
                                    <input type="text" id="itemQty${value.rowId}" value="${value.productQty}"  onchange="cartChangeQty('${value.rowId}','${value.productStock}')">
                            </div>
                            </div>
                        </td>

					    <td class="cart-product-sub-total"><span class="cart-sub-total-price">₱ ${value.productPrice} </span></td>
					    <td class="cart-product-grand-total"><span class="cart-grand-total-price">₱ ${value.productSum}</span></td>
				    </tr>` 

                });

              $('#miniCart').html(miniCart);
              $('#cartPage').html(cartPage);
          }
      })
    }//End Load Items From Cart

    var enableManualInput = true;

    //Cart Increment 
    function cartIncrement(rowId, cartItemStock){
        var qty = $('#itemQty'+rowId).val();
        var me =$(this);
        enableManualInput = false;

        if( me.data('requestRunning')){ return }
            me.data('requestRunning', true);

        $.ajax({
            type:'GET',
            url: "/cart/cart-increment/",
            dataType:'json',
            data:{ row:rowId },
            success:function(data){
                $('#itemQty'+rowId).val(data.qty)
                couponCalculation();
                cart(); 
                if($.isEmptyObject(data.original)) {
                }else{
                    fireToast(data.original);
                }
            },
            complete: function(){
                me.data('requestRunning', false);
                enableManualInput = true;
            }
        });
    }

    //Cart Decrement 
    function cartDecrement(rowId, cartItemStock){
        var qty = $('#itemQty'+rowId).val();
        var me =$(this);
        enableManualInput = false;


        if( me.data('requestRunning')){ return }
            me.data('requestRunning', true);

        $.ajax({
            type:'GET',
            url: "/cart/cart-decrement/",
            dataType:'json',
            data:{ row:rowId },
            success:function(data){
                $('#itemQty'+rowId).val(data.qty)
                couponCalculation();
                cart();
                if($.isEmptyObject(data.original)) {
                }else{
                    fireToast(data.original);
                }
            },
            complete: function(){
                me.data('requestRunning', false);
                enableManualInput = true;

            }
        });
    }

    //CartChange 
    function cartChangeQty(rowId, cartItemStock){
        var qty = $('#itemQty'+rowId).val();
  
        if(enableManualInput){
            $.ajax({
                type:'GET',
                url: "/cart/cart-update/",
                dataType:'json',
                data:{ row:rowId,qty:qty, },
                success:function(data){
                    $('#itemQty'+rowId).val(data.qty)
                    couponCalculation();
                    cart();
                    if($.isEmptyObject(data.original)) {
                    }else{
                        fireToast(data.original);
                    }
                }
            });
        }

    }//End CartChange 

</script>
<!-- //End Add To Cart/ -->

<!-- //Wishlist -->
<script type="text/javascript">

    // Add Wishlist 
    function addToWishList(product_id){
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "wishlist/add/"+product_id,
            success:function(data){
                fireToast(data);
            }
        })
    } 
    // End Add Wishlist

    // Remove Wishlist
    function removeToWishlist(id){
        $.ajax({
            type: 'GET',
            url: 'wishlist/remove/'+id,
            dataType:'json',
            success:function(data){
                wishlist();
                fireToast(data);
            }
        });

    }
    // End Remove Wishlist

    // Load Wishlist
    function wishlist(){
        $.ajax({
            type: 'GET',
            url: 'wishlist/get',
            dataType:'json',
            success:function(response){
                var rows = ""
                $.each(response, function(key,value){
                    rows += `
					<tr>
						<td class="col-md-2">
							<img src="/${value.product.product_thumbnail} " alt="img" style="width:92px; height: 100px" >
						</td>

						<td class="col-md-7">
							<h4 style="font-weight: bold"  class="product-name">
								<a href="/product/details/${value.product.id}/${value.product.product_slug})}}">
									${value.product.product_name}
								</a>
							</h4>
							
							<div class="price">
								${value.product.product_discount_price == 0 ? 
									`₱ ${value.product.product_selling_price}` : 
									`₱ ${value.product.product_discount_price}`
								}

								<span>
								${value.product.product_discount_price == 0 ? `` : 
									`₱ ${value.product.product_selling_price}`
								}

								</span>
								
							</div>
						</td>
						
						<td class="col-md-2">

							<button class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal" 
							data-target="#addToCartModal" id="addtocart-${value.product.id}" onclick="productView(${value.product.id})"> Add to Cart </button>
						</td>
						<td class="col-md-1 close-btn">
							<button type="submit" class="" id="wishItemRemove-${value.product.id}" onclick="removeToWishlist(${value.id})"><i class="fa fa-times"></i></button>
						</td>
					</tr> `
        		});
                
                $('#load-wishlist').html(rows);
            }
        });
    }
    // End Load Wishlist

    wishlist();
    cart();
</script>  

<!-- //Coupon -->
<script type="text/javascript">

    function applyCoupon(){
        var coupon_name = $('#coupon_name').val();
        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {coupon_name:coupon_name},
            url: "{{ url('coupons/coupon-apply') }}",
            success:function(data){
                couponCalculation();
                if (data.validity == true) {
                $('#couponField').hide();
                $('#cal-cValidity').html(`Enter your coupon code if you have one..`)
                $('#cal-cInput').hide();
                }else{
                $('#cal-cValidity').html(`<span class="text-danger">Invalid Coupon </span>`)
                }
                fireToast(data);
            }
        })
    }  

    function couponCalculation(){
        $.ajax({
            type:'GET',
            url: "{{ url('coupons/coupon-calculation') }}",
            dataType: 'json',
            success:function(data){
                if(data.hasCoupon){
                    $('#coupon-calArea').show();
                    $('#cal-subTotal').html(`${data.subtotal}`)
                    $('#cal-couponName').html(`${data.coupon_name}`)
                    $('#cal-discount').html(`${data.discount_amount}`)
                    $('#cal-gTotal').html(`${data.total_amount}`);
                    $('#input-gTotal').val(data.total_amount)
                    $('span[id="miniCartSubTotal"]').text(data.total_amount);
                }else{
                    $('#coupon-calArea').hide();
                    $('#cal-gTotal').html(`${data.total_amount}`)
                    $('#input-gTotal').val(data.total_amount)
                    $('span[id="miniCartSubTotal"]').text(data.total_amount);
                }
            }
        });
    }
        
    function couponRemove(){
        $.ajax({
            type:'GET',
            url: "{{ url('coupons/coupon-remove') }}",
            dataType: 'json',
            success:function(data){
                couponCalculation();
                $('#cal-cInput').show();
                $('#coupon_name').val('');
                fireToast(data);
            }
        });

    }

 couponCalculation();

</script>

 {{-- //Shipping Zone --}}
<script type="text/javascript">

    $(document).ready(function() {

        $('select[name="region_select"]').on('change', function() {
            var region_id = $(this).val();
            var brgy =  $('select[name="brgy-select"]').empty();
            getCities(region_id)
        });

        
        $('select[name="city_select"]').on('change', function() {
            var city_id = $(this).val();
            getBrgy(city_id);
        });

        if($('input[name="saved-city"]').val()){
            getCities( $('select[name="region_select"]').val());
        }
    });

    function getCities(region_id){
        $.ajax({
            url: "/checkout/get-cities/" + region_id,
            type: "GET",
            dataType: "json",
            success: function (data) {
                var brgy =  $('select[name="brgy-select"]').empty();
                var city =  $('select[name="city_select"]').empty();
                var saved_city = $('input[name="saved-city"]').val();

                $.each(data, function (key, value) {

                    if( value.id == saved_city){
                        $('select[name="city_select"]').append('<option selected value="' + value.id + '">' + value.city_name + '</option>');
                    }else{
                        $('select[name="city_select"]').append('<option value="' + value.id + '">' + value.city_name + '</option>');
                    }

                });

                getBrgy( $('select[name="city_select"]').val());

            },
        });
    }

    function getBrgy(city_id){
        $.ajax({
            url: "/checkout/get-brgy/" + city_id,
            type: "GET",
            dataType: "json",
            success: function (data) {
               var d = $('select[name="brgy_select"]').empty();
                var saved_brgy = $('input[name="saved-brgy"]').val();


                $.each(data, function (key, value) {

                    if( value.id == saved_brgy){
                        $('select[name="brgy_select"]').append('<option selected value="' + value.id + '">' + value.brgy_name + '</option>');
                    }else{
                        $('select[name="brgy_select"]').append('<option value="' + value.id + '">' + value.brgy_name + '</option>');
                    }
                });
            },
        });
    }






    
    
</script>

</div><!-- /.body-content -->

</body>
</html>