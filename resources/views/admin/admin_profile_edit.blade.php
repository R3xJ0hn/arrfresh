@extends('admin.admin_master')
@section('admin')

<div class="container-full">

    <section class="content">

        <!-- Basic Forms -->
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Edit Profile</h4>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
                <div class="row">
                    <div class="col">

                        <form method="POST" action="{{ route('admin.profile.store')}}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">

                                <div class="col">
                                    <div class="col-md">
                                        <div class="form-group">
                                            <h5>Email<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="email" name="email" class="form-control" required=""
                                                    value="{{$editData->email}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md">
                                        <div class="form-group">
                                            <h5>Name<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="name" class="form-control" required=""
                                                    value="{{$editData->name}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Image -->
                                <div class="col">
                                    <!-- Image -->
                                    <div class="col">
                                        <h5>Profile Image<span class="text-danger">*</span></h5>
                                        <div class="d-flex justify-content-center">
                                            <img id="showImage"
                                                src="{{ (!empty($editData->profile_photo_path))? 
                                                url('upload/admin_images/'.$editData->profile_photo_path):url('upload/no_image.jpg') }}"
                                                alt="User Avatar"
                                                style="width: 100px; height: 100px; padding-bottom:5px;">
                                        </div>
                                    </div>

                                    <!-- Image Path -->
                                    <div class="col">
                                        <div class="form-group">
                                            <div class="controls">
                                                <input id="image" type="file" name="profile_photo_path"
                                                    class="form-control" required="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- row -->

                            <div style="float: left; padding-left:2%;">
                                <h5 class="ti-lock">
                                    <a href="{{route('admin.change.password')}}"><u> Change Password</u></a>
                                </h5>
                            </div>

                            <input type="submit" class="btn btn-rounded btn-info pull-right" style="margin-right:5%;" value="Update">

                            <a href="{{route('admin.profile')}}" class="btn btn-rounded btn-danger" role="button"
                                style="float:right; margin-right:1%;"> Cancel
                            </a>

                        </form>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
</div>

@endsection