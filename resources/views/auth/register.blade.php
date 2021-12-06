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
            <!-- create a new account -->
            <div class="col-md-6 col-sm-6 create-new-account">
                <div class="sign-in-page">
                    <h3 class="checkout-subtitle">Create a new account</h3>
                    <p class="text title-tag-line">Create your new account.</p>

                    <form method="POST" action="{{ route('register') }}" class="register-form outer-top-xs" role="form">
                        @csrf

                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail2">Email Address <span>*</span></label>
                            <input id="email" name="email" type="email"
                                class="form-control unicase-form-control text-input" required autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <span>{{ $message}}</span>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1">Name <span>*</span></label>
                            <input id="name" name="name" type="text"
                                class="form-control unicase-form-control text-input">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <span>{{ $message}}</span>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1">Phone Number <span>*</span></label>
                            <input id="phone" name="phone" type="text"
                                class="form-control unicase-form-control text-input">
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <span>{{ $message}}</span>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1">Password <span>*</span></label>
                            <input id="password" type="password" name="password"
                                class="form-control unicase-form-control text-input">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <span>{{ $message}}</span>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1">Confirm Password <span>*</span></label>
                            <input id="password_confirmation" type="password" name="password_confirmation"
                                class="form-control unicase-form-control text-input">
                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <span>{{ $message}}</span>
                            </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Sign Up</button>
                    </form>
                </div>
            </div>
            <!-- create a new account -->
            <div class="col-md-3 col-sm-3 "></div>

        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.body-content -->




@endsection