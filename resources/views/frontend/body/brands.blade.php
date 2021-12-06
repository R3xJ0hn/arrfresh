@php
    use App\Http\Controllers\Backend\Manager\BrandController;
	  $brands = BrandController::GetAllBrands();
@endphp

<div id="brands-carousel" class="logo-slider wow fadeInUp">
    <div class="logo-slider-inner">
      <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">

        @foreach ($brands as $brand)
          <div class="item"> <a href="#" class="image"> 
            <img src="{{asset('upload/brand/'.$brand->brand_image_path)}}" alt=""> </a>
          </div>
        @endforeach
        
        



      </div>
      <!-- /.owl-carousel #logo-slider --> 
    </div>
    <!-- /.logo-slider-inner --> 
    
  </div>