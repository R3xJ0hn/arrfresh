@extends('admin.admin_master')
@section('admin')

<div class="container-full">

    <section class="content">

        <!-- Basic Forms -->
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Change Password</h4>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
                <div class="row">
                    <div class="col">

                        <form method="POST" action="{{ route('admin.update.change.password')}}">
                            @csrf

                            <div class="row">
                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <h5>Current Password<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="password" id="current_password" name="oldpassword"
                                                        class="form-control" required="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <h5>New Password<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="password" id="password" name="password"
                                                        class="form-control" required="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <h5>Confirm Password<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="password" id="password_confirmation"
                                                        name="password_confirmation" class="form-control" required="">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!--end end row -->

                            <button type="submit" class="btn btn-rounded btn-info pull-right" style="margin-right:5%;">
                                <i class="ti-save-alt"></i> Save
                            </button>

                            <a href="{{route('admin.profile.edit')}}" class="btn btn-rounded btn-danger" role="button"
                                style="float:right; margin-right:1%;">
                                <i class="ti-trash"></i> Cancel
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