@extends('admin.admin_master')
@section('admin')

<div class="container-full">

    <!-- Main content -->
    <section class="content">

        <!-------------------Category Table------------------->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">List of Sub Categories</h3>
                <input type="button" id="addBtn" class="btn btn-success rounded-pill pull-right" title="Add" data-toggle="modal"
                    data-target="#modal-center" value="Add"></a>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Category</th>
                                <th class="text-center">Sub Categories</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subCategory as $item)
                            <tr>
                                <td class="text-center" style="width: 12rem">{{$item['category']['category_name']}}</td>
                                <td class="text-center">{{$item->subcategory_name}}</td>
                                <td style="width: 8rem !important">
                                    <div class="text-center">
                                        <a type="button" class="btn btn-info ti-pencil" title="Edit"
                                            data-toggle="modal" data-target="#modal-center"
                                            onclick="editBtn({{$item}})"></a>
                                        <a href="{{ route('sub.category.delete', $item->id)}}"
                                            class="btn btn-danger ti-trash" id="delete" title="Delete"></a>
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
        <!-- /.box -->
        <!-------------------End Category Table------------------->

        <!------------------- Modal ------------------->
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

                        <div class="modal-body">

                            <div class="form-group">
                                <h5>Category</h5>
                                    <div class="row">
                                        <div class="controls col-lg-8 col-sm-8" style="float:left;">
                                            <select id="modal-subcat-catid" name="category_id" class="form-control" required>
                                                <option value="" selected="" disabled="">Select Category</option>

                                                    @foreach ($categories as $category)
                                                        <option value="{{$category->id}}">
                                                            {{$category->category_name}}
                                                        </option>
                                                    @endforeach

                                            </select>
                                            @error('category_id')
                                            <span id ="invalidInput" class="text-danger">{{ $message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                            </div>

                            <div class="form-group">
                                <h5>Sub Category Name</h5>
                                <div class="controls">
                                    <input id="modal-subcat-name" type="text" name="subcategory_name" class="form-control" required>
                                    @error('subcategory_name')
                                    <span id="invalidInput" class="text-danger" value="{{$message}}">{{ $message}}</span>
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
        <!-- /.modal -->


    </section>
    <!-- /.content -->

    <script>
        document.getElementById("addBtn").onclick = function () {
            $('form').attr('action', '{{route('sub.category.add.store')}}');
            document.getElementById("modal-subcat-name").value = ""; 
            document.getElementById("modal-title").innerHTML = "Create New Sub Category";
            document.getElementById("modal-submit").value = "Create New Sub Category";
        };

        function editBtn(item) {
            $('form').attr('action', '{{ url('categories/sub/update_store/')}}' + '/' + item.id);
            document.getElementById("modal-subcat-name").value = item.subcategory_name; 
            document.getElementById("modal-subcat-catid").value = item.category_id; 
            document.getElementById("modal-title").innerHTML = "Edit Sub Category";
            document.getElementById("modal-submit").value = "Save Changes";
        };
    </script>

</div>
@endsection