@extends('admin.admin_master')
@section('admin')

<div class="container-full">

  <section class="content">

    <!-- Basic Forms -->
    <div class="box">
      <div class="box-header with-border">
        <h4 class="box-title">Site Setting Page </h4>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="row">
          <div class="col">
            <form method="post" action="{{ route('update.sitesetting') }}" enctype="multipart/form-data">
              @csrf

              <input type="hidden" name="id" value="{{ $setting->id }}">
              <div class="row">
           
				<div class="col-md-6">

					<div class="form-group">
						<div  style="text-align:center; width:100%">
							<img id="logoImg" src="{{asset($setting->logo)}}" style="width: 130px; height: 39px;" alt="logo">
						</div>
					</div>

					<div class="form-group">
					  <h5>Site Logo <span class="text-danger"> </span></h5>
					  <div class="controls">
						<input type="hidden" name="old_logo" value="{{$setting->logo}}">
						<input id="logo" type="file" name="logo" accept="image/*"  class="form-control" onchange="ChangeLogo()">
					  </div>
					</div>

					<div class="form-group">
						<h5>Company Name <span class="text-danger">*</span></h5>
						<div class="controls">
						  <input type="text" name="company_name" class="form-control"
							value="{{ $setting->company_name }}">
						</div>
					  </div>
  
					  <div class="form-group">
						<h5>Company Address <span class="text-danger">*</span></h5>
						<div class="controls">
						  <input type="text" name="company_address" class="form-control"
							value="{{ $setting->company_address }}">
						</div>
					  </div>

					  
					<div class="form-group">
						<h5>Email <span class="text-danger">*</span></h5>
						<div class="controls">
						  <input type="email" name="email" class="form-control" value="{{ $setting->email }}">
						</div>
					  </div>
  
					  <div class="form-group">
						<h5>Facebook <span class="text-danger">*</span></h5>
						<div class="controls">
						  <input type="text" name="facebook" class="form-control" value="{{ $setting->facebook }}">
						</div>
					  </div>
  
					  <div class="form-group">
					  <h5>Phone One <span class="text-danger">*</span></h5>
					  <div class="controls">
						  <input type="text" name="phone_one" class="form-control" value="{{ $setting->phone_one }}">
					  </div>
					  </div>
  
					  <div class="form-group">
					  <h5>Phone Two <span class="text-danger">*</span></h5>
					  <div class="controls">
						  <input type="text" name="phone_two" class="form-control" value="{{ $setting->phone_two }}">
					  </div>
					  </div>

				</div> <!-- end cold md 6 -->

				<div class="col-md-6">

					{{-- BANNER ONE --}}
					<div class="form-group">
						<div  style="text-align:center; width:100%">
							<img id="bannerImg-1" src="{{asset($setting->banner1)}}" style="width: 130px; height: 39px;" alt="logo">
						</div>
					</div>

					<div class="form-group">
					  <h5>Banner1<span class="text-danger"> </span></h5>
					  <div class="controls">
						<input type="hidden" name="old_banner1" value="{{$setting->banner1}}">
						<input id="bannerInput-1" type="file" name="banner1" accept="image/*"  class="form-control" onchange="ChangeBanner(1)">
					  </div>
					</div>
					<br>

					{{-- BANNER TWO --}}
					<div class="form-group">
						<div  style="text-align:center; width:100%">
							<img id="bannerImg-2" src="{{asset($setting->banner2)}}" style="width: 130px; height: 39px;" alt="logo">
						</div>
					</div>

					<div class="form-group">
					  <h5>Banner2 <span class="text-danger"> </span></h5>
					  <div class="controls">
						 	<input type="hidden" name="old_banner2" value="{{$setting->banner2}}">
							<input id="bannerInput-2" type="file" name="banner2" accept="image/*"  class="form-control" onchange="ChangeBanner(2)">
					  </div>
					</div>
					<br>

					{{-- BANNER THREE --}}
					<div class="form-group">
						<div  style="text-align:center; width:100%">
							<img id="bannerImg-3" src="{{asset($setting->banner3)}}" style="width: 130px; height: 39px;" alt="logo">
						</div>
					</div>

					<div class="form-group">
						<h5>Banner3 <span class="text-danger"> </span></h5>
						<div class="controls">
							<input type="hidden" name="old_banner3" value="{{$setting->banner3}}">
							<input id="bannerInput-3" type="file" name="banner3" accept="image/*"  class="form-control" onchange="ChangeBanner(3)">
						</div>
					</div>

					  
					<div class="text-xs-right">
						<input type="submit" class="btn btn-rounded btn-primary mb-5 pull-right" value="Update">
					</div>

				</div> <!-- end cold md 6 -->


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

<script>	
	function ChangeLogo(){
		var file = $('#logo')[0];
		if(file){
			var reader = new FileReader();
			reader.onload = function(e){ $('#logoImg').attr('src',e.target.result).width(139).height(30); };
			reader.readAsDataURL(file.files[0]);
		}
	}

	function ChangeBanner(id){
		var file = $('#bannerInput-'+id)[0];
		if(file){
			var reader = new FileReader();
			reader.onload = function(e){ $('#bannerImg-'+id).attr('src',e.target.result).width(150).height(39); };
			reader.readAsDataURL(file.files[0]);
		}
	}

</script>

@endsection