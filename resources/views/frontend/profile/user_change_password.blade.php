@extends('frontend.main_master')
@section('content')

<div class="body-content">
    <div class="container" style="margin-left: 1rem">
        <div class="row" style="height: 70vh; padding-top: 2rem;">

            <div class="col-lg-3" style="padding:1rem">
                @include('frontend.common.user_sidebar');
            </div>

            <div class="col-md-7" style=" padding-left:10%;" >

                <div style=" background:#fdfcfc; padding:2rem 2rem 5rem 2rem; height:100% ">
                    <div class="card">
                        <h3 class="text-center">Change Password</h3>
                    </div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.change.password.store')}}">
                            @csrf
    
                            <div class="form-group">
                                <label class="info-title">Current Password</label>
                                <input type="password" id="current_password" name="oldpassword" class="form-control" required="">
                            </div>
    
                            <div class="form-group">
                                <label class="info-title">New Password</label>
                                <input type="password" id="password" name="password" class="form-control" required="">
                            </div>
    
                            <div class="form-group">
                                <label class="info-title">Confirm Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required="">
                            </div>
    
                            <div class="form-group">
                                <button type="submit" class="btn btn-warning pull-right">Update</button>
                            </div>
    
                        </form>
                    </div>
    
                </div>

            </div>

        </div>
    </div>
    <!-- end container-->
</div>
<!-- end body-content-->
@endsection