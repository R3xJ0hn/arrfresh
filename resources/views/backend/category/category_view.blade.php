@extends('admin.admin_master')
@section('admin')

<div class="container-full">

    <!-- Main content -->
    <section class="content">

        <!-------------------Category Table------------------->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">List of Categories</h3>
                <input type="button" id="addBtn" class="btn btn-success rounded-pill pull-right" title="Add" data-toggle="modal"
                    data-target="#modal-center" value="Add"></a>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Categories</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category as $item)
                            <tr>
                                <td class="text-center">{{$item->category_name}}</td>
                                <td style="width: 8rem !important">
                                    <div class="text-center">
                                        <a type="button" class="btn btn-info ti-pencil" title="Edit"
                                            data-toggle="modal" data-target="#modal-center"
                                            onclick="editBtn({{$item}})"></a>
                                        <a href="{{ route('category.delete', $item->id)}}"
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
                                <h5>Category Name</h5>
                                <div class="controls">
                                    <input id="modal-cat-name" type="text" name="category_name" class="form-control" required>
                                    @error('category_name')
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
        <!-- /.modal -->


    </section>
    <!-- /.content -->

    <script>
        document.getElementById("addBtn").onclick = function () {
            $('form').attr('action', '{{route('category.add.store')}}');
            document.getElementById("modal-cat-name").value = ""; 
            document.getElementById("modal-title").innerHTML = "Create New Category";
            document.getElementById("modal-submit").value = "Create New Category";
        };

        function editBtn(item) {
            $('form').attr('action', '{{ url('categories/update_store/')}}' + '/' + item.id);
            document.getElementById("modal-cat-name").value = item.category_name; 
            document.getElementById("modal-title").innerHTML = "Edit Category";
            document.getElementById("modal-submit").value = "Save Changes";
        };

    </script>

</div>




@endsection