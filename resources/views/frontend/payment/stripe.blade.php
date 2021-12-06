@extends('frontend.main_master')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@section('title')
Payment Page
@endsection


<style>
    /**
 * The CSS shown here will not be introduced in the Quickstart guide, but shows
 * how you can use CSS to style your Element's container.
 */
    .StripeElement {
        box-sizing: border-box;
        height: 40px;
        padding: 10px 12px;
        border: 1px solid transparent;
        border-radius: 4px;
        background-color: white;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }

    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
        border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }
</style>


<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled"> 
                <li><a href="{{ url('/')}}">Home</a></li>
                <li><a href="{{ route('user.cart')}}">MyCart</a></li>
                <li><a href="{{ route('checkout') }}">Checkout</a></li>
                <li class='active'>Card Payment</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->


<div class="body-content">
    <div class="container">
        <div class="checkout-box ">
            <div class="row">

                <div class="col-md-6"  style="padding: 2rem">

                  <div class="row" style="padding: 0 2rem">
                    <div class="sidebar-widget wow fadeInUp">
                      <h3 class="section-title">Cart Items</h3>
        
                      <ul class="list-group list-group-flush" style="display:block; height: 330px; max-height: 330px; overflow:auto;" >
        
                      {{-- ------------ Side Cart ------------ --}}
                      @include('frontend.common.side_cart',$cart)

                      </ul>

        
                    </div>
                  </div>
                </div> <!--  // end col md 6 -->


                <div class="col-md-6">

                  <div class="row" style="padding: 2rem">
                    <div class="sidebar-widget wow fadeInUp">
                      <h3 class="section-title">Your Payment Amount</h3>
           
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


                  
                  <div class="row" style="padding: 0 2rem 2rem 2rem">
                    <div class="sidebar-widget wow fadeInUp">
                      <h3 class="section-title">Pay with Credit or Debit Card</h3>

                          <div class="panel">

                                <form action=" {{ route('stripe.order') }}" method="post" id="payment-form">
                                  @csrf
                                  <div class="form-row">
                                      <label for="card-element">
                                        
                                      </label>

                                      <div id="card-element">
                                          <!-- A Stripe Element will be inserted here. -->
                                      </div>
                                      <!-- Used to display form errors. -->
                                      <div id="card-errors" role="alert"></div>

                                  </div>

                              <button class="btn btn-primary pull-right" style="margin-top: 1rem">Submit Payment</button>
                              </form>


                          </div>
                          <br>

                    </div>
                  </div>

                </div><!--  // end col md 6 -->
                </form>
            </div><!-- /.row -->
        </div><!-- /.checkout-box -->





         <!-- ============================================== BRANDS CAROUSEL ============================================== -->
         <br>
         @include('frontend.body.brands')
         <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->


    </div><!-- /.container -->
</div><!-- /.body-content -->
<script src="https://js.stripe.com/v3/"></script>

<script type="text/javascript">
    // Create a Stripe client.
    var stripe = Stripe('pk_test_51JtrE7HiWaw3XEAZmhk3CDrq4EiDZhpxwxXi4RSFQHGqA26cwrSVXtFBgQr3ST8A4g9n21rDgA0c5FT1rF3aLoTN00u4Zs0wjg');
    // Create an instance of Elements.
    var elements = stripe.elements();
    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };
    // Create an instance of the card Element.
    var card = elements.create('card', { style: style });
    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');
    // Handle real-time validation errors from the card Element.
    card.on('change', function (event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });
    // Handle form submission.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        stripe.createToken(card).then(function (result) {
            if (result.error) {
                // Inform the user if there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Send the token to your server.
                stripeTokenHandler(result.token);
            }
        });
    });
    // Submit the form with the token ID.
    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);
        // Submit the form
        form.submit();
    }
</script>

@endsection