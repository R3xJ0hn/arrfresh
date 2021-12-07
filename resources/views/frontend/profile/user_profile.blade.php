@extends('frontend.main_master')
@section('content')

<div class="body-content">
    <div class="container" style="margin-left: 1rem">
        <div class="row" style="height: 70vh; padding-top: 2rem;">

            <div class="col-lg-3" style="padding:1rem">
                @include('frontend.common.user_sidebar');
            </div>

            <div class="col-md-8" style=" padding-left:10%;">
                <div class="card" style="background: #fdfcfc; padding: 1% 4%;">
                    <h3 class="text-center"><span class="text-danger">
                        </span><strong>{{ Auth::user()->name }}</strong> Update Your Profile </h3>

                    <div class="card-body">

                        <form method="post" action="{{ route('user.profile.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Name <span> </span></label>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Email <span> </span></label>
                                <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                            </div>


                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Phone <span> </span></label>
                                <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
                            </div>


                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label class="info-title" for="exampleInputEmail1">User Image <span> </span></label>
                                        <input type="file" name="profile_photo_path" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3" style="padding:3% 5%">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-warning ">Update</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>

            </div> <!-- // end col md 6 -->
        </div>

    </div>
</div>
<!-- end container-->
</div>
<!-- end body-content-->
@endsection