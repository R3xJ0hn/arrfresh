@extends('frontend.main_master')
@section('content')

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{url('/')}}">Home</a></li>
                <li class='active'>Reset Password</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <!-- Sign-in -->
    <div class="d-flex justify-content-center">
        <h4 class="">Reset Password</h4>


        <form method="POST" action="{{ route('password.update') }}" class="register-form outer-top-xs" role="form">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <input type="hidden" name="email" value="{{ $request->email}}" id="email">

            {{-- <div class="form-group">
                <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                <input id="email" type="email" class="form-control unicase-form-control text-input" name="email"
                    :value="old('email')" required autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <span>{{ $message}}</span>
                </span>
                @enderror
            </div> --}}

            <div class="form-group">
                <label class="info-title" for="exampleInputEmail1">New Password <span>*</span></label>
                <input id="password" type="password" name="password"
                    class="form-control unicase-form-control text-input">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <span>{{ $message}}</span>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label class="info-title" for="exampleInputEmail1">Confirm New Password<span>*</span></label>
                <input id="password_confirmation" type="password" name="password_confirmation"
                    class="form-control unicase-form-control text-input">
                @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <span>{{ $message}}</span>
                </span>
                @enderror
            </div>
            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Reset Password</button>
        </form>
    </div>
    <!-- Sign-in -->


</div><!-- /.body-content -->



@endsection