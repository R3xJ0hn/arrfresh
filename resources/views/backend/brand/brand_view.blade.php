@extends('admin.admin_master')
@section('admin')

<div class="container-full">

    <!-- Main content -->
    <section class="content">
        <!-------------------Brand Table------------------->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">List of Brands</h3>
                <input type="button" id="addBtn" class="btn btn-success rounded-pill pull-right"  title="Add" data-toggle="modal"
                data-target="#modal-center" value="Add"></a>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Image</th>
                                <th class="text-center">Brand Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $item)
                            <tr>
                                <td class="text-center">
                                    <img src="{{url('upload/brand/'. $item->brand_image_path)}}" alt="Brand Image"
                                        style="width:60px; height:40px;">
                                </td>
                                <td class="text-center">{{$item->brand_name}}</td>

                                <td style="width: 8rem !important">
                                    <div class="text-center">
                                        <a type="button" class="btn btn-info ti-pencil" title="Edit"
                                            data-toggle="modal" data-target="#modal-center" 
                                            onclick="editBtn({{$item}})"
                                            ></a>
                                        <a href="{{ route('brand.delete', $item->id)}}" class="btn btn-danger ti-trash"
                                            id="delete" title="Delete"></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-------------------End Brand Table------------------->

        <!----------------------- Modal ----------------------->
        <div class="modal center-modal fade" id="modal-center" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 id="modal-title" class="modal-title">Action</h5>
                        <input type="button" class="close" data-dismiss="modal" value=&times;
                            style="background: transparent;">
                    </div>

                    <form id="form" name="form" method="POST" action="/" enctype="multipart/form-data">
                        @csrf
                        <input id="old-img" type="hidden" name="old_image">

                        <div class="modal-body">
                            <div class="d-flex justify-content-center">
                                <img style="width:300px; height:155px;" id="showImage" src="/" alt="Brand Logo">
                            </div>
                            <br>

                            <div class="form-group">
                                <h5>Brand Logo</h5>
                                <div class="controls">
                                    <input id="image" type="file" name="brand_image_path"  accept="image/*" class="form-control">
                                </div>
                                @error('brand_image_path')
                                <span class="text-danger">{{ $message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <h5>Brand Name</h5>
                                <div class="controls">
                                    <input id="modal-brand-name" type="text" name="brand_name" class="form-control" required>
                                    @error('brand_name')
                                    <span class="text-danger">{{ $message}}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer modal-footer-uniform col-12">
                            <input id="modal-submit" type="submit" class="btn btn-rounded btn-info float-right"
                                value="Confirm Action">
                            <input type="button" class="btn btn-rounded btn-danger float-right" data-dismiss="modal"
                                value="Close">
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!------------------- End Modal ------------------->

    </section>
    <!-- /.content -->

    <script>

        function editBtn(item){
            $('form').attr('action',' {{ url('brands/update_store/')}}'+'/'+ item.id);
            document.getElementById("showImage").src = '../upload/brand/' + item.brand_image_path;   
            document.getElementById("old-img").value = item.brand_image_path;  
            document.getElementById("modal-brand-name").value = item.brand_name; 
            document.getElementById("modal-title").innerHTML = "Edit Brand";
            document.getElementById("modal-submit").value = "Save Changes";
        };

        document.getElementById("addBtn").onclick = function () {
            $('form').attr('action', '{{route('brands.add.store')}}');
            document.getElementById("showImage").src = '{{url('upload/no_image.jpg')}}'; 
            document.getElementById("modal-brand-name").value = ""; 
            document.getElementById("modal-title").innerHTML = "Create New Brand";
            document.getElementById("modal-submit").value = "Add Brand";
        };


    </script>

</div>

@endsection