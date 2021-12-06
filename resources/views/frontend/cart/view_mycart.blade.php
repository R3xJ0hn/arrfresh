@extends('frontend.main_master')
@section('content')

@section('title')
MyCart
@endsection


<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="/">Home</a></li>
				<li class='active'>MyCart</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container"  style="width: 90%;">

		<div class="row ">


			@if($isCartEmpty)
				<div class="shopping-cart">
					<H1>There are no items on your Cart</H1>
					<br>
					<a href="/"> <button class="btn btn-info">Continue Shopping</button></a>
				</div>
			@else

			<div class="shopping-cart">
				<div class="shopping-cart-table ">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th class="cart-romove item">Remove</th>
									<th class="cart-description item">Image</th>
									<th class="cart-product-name item">Product Name</th>
									<th class="cart-edit item">Color</th>
									<th class="cart-qty item">Quantity</th>
									<th class="cart-sub-total item">Price</th>
									<th class="cart-total last-item">Total</th>
								</tr>
							</thead><!-- /thead -->
							<tbody id="cartPage">

							</tbody>
						</table>
					</div>
				</div>


			<div class="col-md-8 col-sm-12 estimate-ship-tax">

			</div>

			<div class="col-md-4 col-sm-12 cart-shopping-total">
				<table class="table">
					<thead>


						<tr>
							<th style="padding: 3%">

								<div id="coupon-calArea" style="display: none">
									<div class="row" style="margin:1% 0%">
										<div class="col-sm-6 text-left">
											Subtotal
										</div>
										<div class="col-sm-6  cart-sub-total">
											₱ <span class="cart-sub-total" id="cal-subTotal"></span>
										</div>
									</div>

									<div class="row" style="margin:1% 0%">
										<div class="col-sm-4 text-left">
											Coupon
										</div>
										<div class="col-sm-8">
											<span><i class="fa fa-ticket"></i></span>
											<span class=" cart-sub-total" id="cal-couponName"></span>
											<button type="submit" onclick="couponRemove()" style="position: absolute; right:-5%; padding:2px; height:18px; width:18px;">
												<i class="fa fa-times " style="font-size: 12px; position: absolute; top:1px; left:2px;"></i>
											</button>
										</div>
									</div>

									<div class="row" style="margin:1% 0%">
										<div class="col-sm-6 text-left">
											Discount Amount
										</div>
										<div class="col-sm-6  cart-sub-total">
											<span class="cart-sub-total">₱ <span id="cal-discount"></span></span>
										</div>
									</div>
								</div>

								<div class="row" style="margin:1% 0%;">
									<div class="col-sm-6 text-left cart-grand-total" style=" font-size:18px;">
										Grand Total
									</div>
									<div class="col-sm-6  cart-sub-total">
										<span class="cart-grand-total"  style=" font-size:18px;"> ₱ <span id="cal-gTotal"></span></span>
									</div>
								</div>

								@if(!(Session::has('coupon')))
								<div class="row" id="cal-cInput">
									<div class="col-sm-9" style="padding-right:0; height: 4rem">
										<div class="form-group">
											<input type="text" class="form-control unicase-form-control text-input"
												placeholder="Your Coupon.." id="coupon_name" style="height: 4rem">
										</div>
									</div>

									<div class="col-sm-3" style="padding: 0">
										<div class="clearfix pull-left">
											<button type="submit" class="btn-upper btn btn-primary"
											onclick="applyCoupon()" style="height: 3.9rem">APPLY</button>
										</div>
									</div>

									<div class="col-sm-12 " style="padding-top:0">
										<small class="pull-left" id="cal-cValidity">Enter your coupon code if you have one..</small>
									</div>
								</div>
								@endif
							</th>
						</tr>

					</thead><!-- /thead -->
					<tbody>
						<tr>
							<td>
								<div class="cart-checkout-btn pull-right">
								<a href="{{ route('checkout') }}" type="submit" class="btn btn-primary checkout-btn">PROCCED TO CHEKOUT</a>
								</div>
							</td>
						</tr>
					</tbody><!-- /tbody -->
				</table><!-- /table -->
			</div><!-- /.cart-shopping-total -->

				
			@endif

			


		</div><!-- /.row -->
		
	</div><!-- /.sigin-in-->



<br>
 @include('frontend.body.brands')
</div>


@endsection
