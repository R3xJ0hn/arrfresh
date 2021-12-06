@extends('frontend.main_master')
@section('content')

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{url('/')}}">Home</a></li>
                <li class='active'>Login</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content" style="margin-bottom: 1%">
    <div class="container">
        <div class="row">

            <div class="col-md-3 col-sm-3"></div>
            <!-- Sign-in -->
            <div class="col-md-6 col-sm-6">

                <div class="sign-in-page">
                    <div class="sign-in">
                        <h3 class="">Sign in</h3>
                        <p class="">Hello, Welcome to your account.</p>
    
                        <div class="social-sign-in outer-top-xs">
                            <a href="#" class="facebook-sign-in"><i class="fa fa-facebook"></i> Sign In with Facebook</a>
                            <a href="#" class="twitter-sign-in" style="margin-left: 4%"><i class="fa fa-twitter"></i> Sign In with Twitter</a>
                        </div>
                    </div>


                    <x-jet-validation-errors class="mb-4" style="color: red; margin-top:3%;" />

                    @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ isset($guard) ? url($guard.'/login') : route('login') }}"
                        class="register-form outer-top-xs" role="form">
                        @csrf

                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                            <input id="email" type="email" class="form-control unicase-form-control text-input"
                                name="email" :value="old('email')" required autofocus>
                        </div>

                        <div class="form-group">
                            <label class="info-title" for="exampleInputPassword1">Password <span>*</span></label>
                            <input id="password" type="password" class="form-control unicase-form-control text-input"
                                name="password">
                        </div>

                        <div class="radio outer-xs">
                            <label for="remember_me">
                                <input type="radio" id="remember_me" name="remember">Remember me!
                            </label>

                            <a href="{{ route('password.request') }}" class="forgot-password pull-right">Forgot your
                                Password?</a>
                        </div>

                        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Login</button>
                    </form>

                </div><!-- /.sigin-in-->
            </div>
            <!-- Sign-in -->
            <div class="col-md-3 col-sm-3 "></div>

        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.body-content -->




@endsection