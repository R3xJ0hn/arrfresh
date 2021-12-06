@extends('frontend.main_master')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@section('title')
My Checkout
@endsection


<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ url('/')}}">Home</a></li>
				<li><a href="{{ route('user.cart')}}">MyCart</a></li>
                <li class='active'>Checkout</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">

		<form class="register-form" action="{{ route('checkout.payment') }}"method="POST">
			@csrf

			<div class="row">

				<div class="col-md-8">
					<div class="panel panel-default">
						<div style="padding: 1rem">
							<div class="panel-body">
								<h4 ><b>Shipping Address</b></h4>
								<hr style="padding-bottom: 1rem" >	
								<div class="row">

									<div class="col-md-6">
										
										<div class="form-group">
											<label class="info-title" for="name">
												<b>Name</b> <span>*</span>
											</label>
											<input type="text" name="user_name"
												class="form-control unicase-form-control text-input"
												id="name" placeholder="Full Name"
												value="{{ $userInfo['user_name'] }}" required=""> 
										</div> <!-- // end form group  -->
			
										
										<div class="form-group">
											<label class="info-title" for="user_email">
												<b>Email </b><span>*</span>
											</label>
											<input type="email" name="user_email"
												class="form-control unicase-form-control text-input"
												id="exampleInputEmail1" placeholder="Email"
												value="{{ $userInfo['user_email'] }}" required="">
										</div> <!-- // end form group  -->
			
			
										<div class="form-group">
											<label class="info-title" for="user_phone">
												<b>Phone</b> <span>*</span>
											</label>
											<input type="number" name="user_phone"
												class="form-control unicase-form-control text-input"
												id="phone" placeholder="Phone"
												value="{{ $userInfo['user_phone'] }}" required="">
										</div> <!-- // end form group  -->
			
			
										<div class="form-group">
											<label class="info-title" for="zipCode">
												<b>Zip Code</b><span>*</span>
											</label>
											<input type="text" name="zip_code"
												class="form-control unicase-form-control text-input"
												id="zipCode" placeholder="Post Code" 
												value="{{ $userInfo['zip_code'] }}" required="">
										</div> <!-- // end form group  -->
			
			
										
									</div>
									
									<div class="col-md-6">
										
										<div class="form-group">
											<label class="info-title" for="region-select">
												<b>Region</b> <span>*</span>
											</label>

											<div class="controls">
												<select name="region_select" class="form-control" required="">
													<option value="" selected="" disabled="">--Select Region--</option>
													@foreach($regions as $item)
													<option value="{{ $item->id }}" {{ $item->id == $userInfo['region_id'] ? 'selected':'' }}>
														{{ $item->region_name }}
													</option>
													@endforeach
												</select>
												@error('region-select')
												<span class="text-danger">{{ $message }}</span>
												@enderror
											</div>
										</div> <!-- // end form group -->


										<div class="form-group">
											<label class="info-title" for="region-select">
												<b>City</b> <span>*</span>
											</label>


											<div class="controls">
												<select name="city_select" class="form-control" required="">
													<option value="" selected="" disabled="">--Select City--</option>
												</select>
												@error('city-select')
												<span class="text-danger">{{ $message }}</span>
												@enderror
												<input type="hidden" name="saved-city" value="{{$userInfo['city_id']}}">
											</div>
										</div> <!-- // end form group -->


										<div class="form-group">

											<label class="info-title" for="brgy-select">
												<b>Barangay</b> <span>*</span>
											</label>
											<div class="controls">
												<select name="brgy_select" class="form-control" required="">
													<option value="" selected="" disabled="">--Select Barangay--
													</option>
												</select>
												@error('brgy-select')
												<span class="text-danger">{{ $message }}</span>
												@enderror
												<input type="hidden" name="saved-brgy" value="{{$userInfo['brgy_id']}}">
											</div>
										</div> <!-- // end form group -->


										<div class="form-group">
											<label class="info-title" for="street">
												<b>Street</b> <span>*</span>
											</label>
											<input type="text" name="street"
												class="form-control unicase-form-control text-input"
												id="name" placeholder="Street"
												value="{{ $userInfo['street'] }}" required="">
										</div> <!-- // end form group  -->


										<div class="form-group">
											<label class="info-title" for="house">
												<b>House # /Blk/Phase</b> <span>*</span>
											</label>
											<input type="text" name="house"
												class="form-control unicase-form-control text-input"
												id="name" placeholder="House"
												value="{{$userInfo['house'] }}" required="">
										</div> <!-- // end form group  -->


										<div class="form-group">
											<label class="info-title" for="exampleInputEmail1">Notes
												<span>*</span></label>
											<textarea class="form-control" cols="30" 
												rows="5" placeholder="Notes" style="resize: vertical"
												name="notes">{{$userInfo['notes'] }}</textarea>
										</div> <!-- // end form group  -->

									</div>
			
								</div>
							</div>
						</div>


					</div>
				</div>
				
				<div class="col-md-4">

					<div class="row" style="padding: 0 2rem">
						<div class="sidebar-widget wow fadeInUp">
							<h3 class="section-title">Cart Items</h3>

							<ul class="list-group list-group-flush" style="display:block; max-height: 200px; overflow:auto;" >

								{{-- ------------ Side Cart ------------ --}}
								@include('frontend.common.side_cart',$cart)

							</ul>

							<hr>
							
							@if(Session::has('coupon'))
								
							<div class="row" style="margin:1% 0%">
								<div class="col-sm-6 text-left">
									Subtotal
								</div>
								<div class="col-sm-6  cart-sub-total">
									<div class="pull-right">
										₱ <span class="cart-sub-total" id="cal-subTotal"></span>
									</div>
								</div>
							</div>


							<div class="row" style="margin:1% 0%">
								<div class="col-sm-4 text-left">
									Coupon
								</div>
								<div class="col-sm-8">
								<div class="pull-right">
									<span><i class="fa fa-ticket"></i></span>
									<span class=" cart-sub-total" id="cal-couponName"></span> 
								</div>
								</div>
							</div>

							<div class="row" style="margin:1% 0%">
								<div class="col-sm-6 text-left">
									Discount Amount
								</div>
								<div class="col-sm-6  cart-sub-total">
									<span class="cart-sub-total pull-right">₱ <span id="cal-discount"></span></span>
								</div>
							</div>

							<hr>
								
							@endif


							<div class="row" style="margin:1% 0%;">
								<div class="col-sm-6 text-left cart-grand-total" style=" font-size:18px;">
									Grand Total
								</div>
								<div class="col-sm-6  cart-sub-total">
									<span class="cart-grand-total pull-right"  style=" font-size:18px;"> ₱ <span id="cal-gTotal"></span></span>
								</div>
							</div>


						</div>
					</div>
					
					<div class="row" style="padding: 2rem">
						<div class="sidebar-widget wow fadeInUp">
							<h3 class="section-title">Payment Method</h3>

							<div class="row">
								<div class="col-md-6 text-center">
									<label for="">Stripe</label>
									<input type="radio" name="payment_method" value="stripe" checked>
									<img src="{{ asset('assets/frontend/images/payments/4.png') }}">
								</div> <!-- end col md 4 -->

								<div class="col-md-6 text-center">
									<label for="">Cash</label>
									<input type="radio" name="payment_method" value="cash">
									<img src="{{ asset('assets/frontend/images/payments/6.png') }}">
								</div> <!-- end col md 4 -->
								<br>
							<hr>
							<button type="submit" class="btn-upper btn btn-primary pull-right" style="margin-right: 1rem"> Proceed</button>

							</div> <!-- // end row  -->

						</div>
					</div>

				</div>

			</div>
		</form>

        <!-- === ===== BRANDS CAROUSEL ==== ======== -->
        <!-- ===== == BRANDS CAROUSEL : END === === -->
		
    </div><!-- /.container -->
</div><!-- /.body-content -->

@endsection