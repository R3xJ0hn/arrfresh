@extends('admin.admin_master')
@section('admin')

<div class="container-full">

    <!-- Main content -->
    <section class="content">

        <!-------------------Category Table------------------->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Coupon List</h3>
                <input type="button" id="addBtn" class="btn btn-success rounded-pill pull-right" title="Add" data-toggle="modal"
                    data-target="#modal-center" value="Add">
            </div>

            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Coupon Name</th>
                                <th class="text-center">Coupon Discount</th>
                                <th class="text-center">Validity</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>

							@foreach($coupons as $item)
							<tr>
							   <td class="text-center"> {{ $item->coupon_name }}  </td>
							   <td class="text-center" width="12%"> {{ $item->coupon_discount }}% </td>
								<td class="text-center" width="25%"> 
								   {{ Carbon\Carbon::parse($item->coupon_validity)->format('D, d F Y') }}
								</td>
					   
								<td class="text-center" width="10%" >
									@if($item->coupon_validity >= Carbon\Carbon::now()->format('Y-m-d'))
									<span class="badge badge-pill badge-success"> Valid </span>
									@else
								  <span class="badge badge-pill badge-danger"> Invalid </span>
									@endif
					   
								</td>

                                <td style="width: 8rem !important">
                                    <div class="text-center">
                                        <a type="button" class="btn btn-info ti-pencil" title="Edit"
                                            data-toggle="modal" data-target="#modal-center"
                                            onclick="editBtn({{$item}})"></a>
                                        <a href="{{  route('coupon.delete',$item->id)}}"
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

							<div class="row">
								<div class="col-md-7">
									<div class="form-group">
										<h5>Coupon Name</h5>
										<div class="controls">
											<input id="modal-name" type="text" name="coupon_name" class="form-control" required>
											@error('coupon_name')
											<span id="invalidInput" class="text-danger" name="coupon_name" value="{{$message}}">{{ $message}}</span>
											@enderror
										</div>
									</div>
								</div>

								<div class="col-md-5">
									<div class="form-group">
										<h5>Discount</h5>
										<div class="input-group"> 
											<input type="number" name="coupon_discount" min="1" max="100" class="form-control" required=""> 
											<span class="input-group-addon">%</span>
										</div>
										@error('coupon_discount')
										<span id="invalidInput" class="text-danger" value="{{$message}}">{{ $message}}</span>
										@enderror
									</div>
								</div>

							</div> {{-- end row --}}

							<div class="form-group">
                                <h5>Coupon Validity Date</h5>
                                <div class="controls">
									<input type="date" name="coupon_validity" class="form-control" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                                </div>
								@error('coupon_validity')
								<span id="invalidInput" class="text-danger" value="{{$message}}">{{ $message}}</span>
								@enderror
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
            $('form').attr('action', '{{route('coupon.store')}}');
            document.getElementById("modal-name").value = ""; 
            document.getElementById("modal-title").innerHTML = "Create Coupon";
            document.getElementById("modal-submit").value = "Add New Coupon";
        };

        function editBtn(item) {
            $('form').attr('action', '{{ url('coupons/update')}}' + '/' + item.id); 
			$('input[name=coupon_name]').val(item.coupon_name);
			$('input[name=coupon_discount]').val(item.coupon_discount);
			$('input[name=coupon_validity]').val(item.coupon_validity);
            document.getElementById("modal-title").innerHTML = "Edit Coupon";
            document.getElementById("modal-submit").value = "Save Changes";
        };
    </script>

</div>
@endsection