@extends('admin.admin_master')
@section('admin')

<div class="container-full">

    <!-- Main content -->
    <section class="content">
        <!-------------------Brand Table------------------->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Slider List</h3>
                <input type="button" id="addBtn" class="btn btn-success rounded-pill pull-right" title="Add" data-toggle="modal"
                data-target="#modal-center" value="Add"></a>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Image</th>
                                <th class="text-center">Slide Title</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($sliders as $item)
                            <tr>
                                <td class="text-center">
                                    <img src="{{ asset($item->slider_img) }}" alt="Brand Image"
                                         style="width:60px; height:40px;">
                                </td>

                                <td class="text-center">{{$item->title}}</td>
                                <td class="text-center">{{$item->description}}</td>


                                
                                <td class="text-center" style="width: 8rem !important">
                                    @if($item->status == 1)
                                    <a href="{{ route('slider.inactive',$item->id) }}" title="Inactive Now" class="badge badge-pill badge-success">
                                         Active  <i class="fa fa-arrow-up"></i>
                                    </a>
                                    @else
                                    <a href="{{ route('slider.active',$item->id) }}" title="Active Now" class="badge badge-pill badge-danger">
                                        InActive  <i class="fa fa-arrow-down"></i>
                                   </a>
                                    @endif
                                </td>

                                <td style="width: 8rem !important">
                                    <div class="text-center">
                                        <a type="button" class="btn btn-info ti-pencil" title="Edit"
                                            data-toggle="modal" data-target="#modal-center" 
                                            onclick="editBtn({{$item}})" ></a>
                                        <a href="{{ route('slider.delete', $item->id)}}" class="btn btn-danger ti-trash"
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
                                <img style="width:300px; height:155px;" id="showImage" src="/" alt="Slide">
                            </div>
                            <br>

                            <div class="form-group">
                                <h5>Slide Image</h5>
                                <div class="controls">
                                    <input id="image" type="file" name="slider_img"  accept="image/*" class="form-control">
                                </div>
                                @error('slider_img')
                                <span class="text-danger">{{ $message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <h5>Slide Title</h5>
                                <div class="controls">
                                    <input id="modal-slide-title" type="text" name="slide_title" class="form-control">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <h5>Slide Description</h5>
                                <div class="controls">
                                    <input id="modal-slide-desc" type="text" name="slide_description" class="form-control" >
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
            $('form').attr('action',' {{ url('sliders/update_store/')}}'+'/'+ item.id);
            document.getElementById("showImage").src = '/' + item.slider_img;   
            document.getElementById("old-img").value = item.slider_img;
            document.getElementById("modal-slide-title").value = item.title; 
            document.getElementById("modal-slide-desc").value = item.description; 
            document.getElementById("modal-title").innerHTML = "Edit Slide";
            document.getElementById("modal-submit").value = "Save Changes";
        };

        document.getElementById("addBtn").onclick = function () {
            $('form').attr('action', '{{route('slider.add.store')}}');
            document.getElementById("showImage").src = '{{url('upload/no_image.jpg')}}'; 
            document.getElementById("modal-slide-title").value = ""; 
            document.getElementById("modal-slide-desc").value = ""; 
            document.getElementById("modal-title").innerHTML = "Create Slide";
            document.getElementById("modal-submit").value = "Add Slide";
        };


    </script>

</div>

@endsection