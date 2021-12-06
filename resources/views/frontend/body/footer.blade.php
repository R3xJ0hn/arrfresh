@php
  use App\Http\Controllers\Backend\Manager\PageInfoController;
	$settings= PageInfoController::GetSettingInfo();
@endphp

<footer id="footer" class="footer color-bg">
    <div class="footer-bottom">
      <div class="container">
        <div class="row">

          <h4  style="color: whitesmoke">Contact Us</h4>

          <ul  style="">
            <li class="col-lg-4 col-sm-12">
              <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-map-marker fa-stack-1x fa-inverse"></i> </span> </div>
              <div class="media-body" style="color: whitesmoke; margin-top: 0.7rem" >
                <p>{{ $settings->company_address}}</p>
              </div>
            </li>
            <li class="col-lg-4 col-sm-12">
              <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-mobile fa-stack-1x fa-inverse"></i> </span> </div>
              <div class="media-body" style="color: whitesmoke" >
                <p>{{$settings->phone_one}} <br>
                  {{$settings->phone_two}}
                </p>
              </div>
            </li>
            <li class="col-lg-4 col-sm-12">
              <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-envelope fa-stack-1x fa-inverse"></i> </span> </div>
              <div class="media-body" style="color: whitesmoke; margin-top: 0.7rem" >
                <span>{{$settings->email}}</span> 
              </div>
            </li>
          </ul>

        </div>
        <!-- /.col -->

      </div>
    </div>
    <div class="copyright-bar">
      <div class="container">
        <div class="col-xs-12 col-sm-6 no-padding social">
          <ul class="link">
            <li class="fb pull-left"><a target="_blank" rel="nofollow" href="//{{$settings->facebook}}" title="Facebook"></a></li>
          </ul>
        </div>
        
        <div class="col-xs-12 col-sm-6 no-padding">
          <div class="clearfix payment-methods">
            <ul>
              <li><img src="{{asset('assets/frontend/images/payments/3.png')}}" alt=""></li>
              <li><img src="{{asset('assets/frontend/images/payments/4.png')}}" alt=""></li>
              <li><img src="{{asset('assets/frontend/images/payments/6.png')}}" alt=""></li>
            </ul>
          </div>
          <!-- /.payment-methods --> 
        </div>
      </div>
    </div>
  </footer>