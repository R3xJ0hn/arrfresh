@extends('frontend.main_master')
@section('content')

<div class="body-content">
    <div class="container" style="margin: 1%">
        <div class="row">
            <div class="col-md-4 bg-primary">

                <br>
                <div class="row">

                    <div class="col-md-5">
                        <img class="card-img-top" style="border-radius: 50%"
                        id="showImage" src="{{ (!empty($user->profile_photo_path))? 
                        url('upload/user_images/'.$user->profile_photo_path):url('upload/no_image.jpg') }}"
                        alt="User Avatar" height="100%" width="100%">
                    </div>

                    <div class="col-md-5" >
                        <h3 class="text-left">{{Auth::user()->name}}</h3>
                        <h6>Name</h6>
                    </div>

                </div>
                <br>

                <div class="list-group">
                    <div class="card-body" style="background: #fff">
                        <div class="border border-dark" style="padding: 0.4%;"> 
                            <a href="{{ url('/')}}" class="list-group-item list-group-item-action">Home</a>
                            <a href="{{ route('user.profile')}}" class="list-group-item list-group-item-action">Profile</a>
                            <a href="{{ route('user.change.password')}}" class="list-group-item list-group-item-action active">
                                Change Password
                            </a>
                            <a href="{{ route('user.logout')}}" class="list-group-item list-group-item-action">Logout</a>
                        </div>
                    </div>
                </div>

            </div>
            <!-- end col-md-2-->
            <div class="col-md-1"></div>

            <div class="col-md-6">

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
            <!-- end col-md-6-->

        </div>
        <!-- end row-->
    </div>
    <!-- end container-->
</div>
<!-- end body-content-->

@endsection