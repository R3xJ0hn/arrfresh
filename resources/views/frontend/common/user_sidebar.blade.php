<style>
    .item a{
        text-decoration: none;
        color: #575757;
        font-size: 14px;
        line-height: 18px;
    }   

    .sidebar{
        background: #ffffff;  
        padding: 0;
    }

    .sidebar-top{
        background:  #006cb4;
        width: 100%; 
        margin:0;
        padding: 3rem 1rem;
    }

    .user-name{
        padding: 0;
        margin: 0;
    }

    .text-left{
        margin: 0; 
        margin-top: 1rem;
        color: #fdfcfc;
    }

    .email{
        color: #fdd922;
    }

    .active-nav {
        background: #fdd922;
    }

    .active-nav a:hover{
        background: #fdd922;
    }

    .item{
        margin:1rem 0rem;
        padding-left: 1rem;
    }

</style>

@php
    $prefix = Request::route()->getPrefix();
    $route =Route::current()->getName();
@endphp


<div class="sidebar sidebar-main"> 

    <div class="row sidebar-top">

        <div class="col-md-5" >
            <img class="card-img-top border" style="border-radius: 50%"
            id="showImage" src="{{ (!empty($user->profile_photo_path))? 
            url('upload/user_images/'.$user->profile_photo_path):url('upload/no_image.jpg') }}"
            alt="User Avatar" height="90%" width="90%">
        </div>

        <div class="col-md-7 user-name"  >
            <h3 class="text-left">{{Auth::user()->name}}</h3>
            <small class="email">{{Auth::user()->email}}</small>
        </div>
    </div>

    <div class="row" style="padding: 1.5rem; padding-top: 0.5rem;">
        <div class="col content sidebar">
                <ul class="nav nav-sidebar">

                    <li class="nav item {{ ($route == 'user.profile')? 'active-nav':'' }}"> 
                        <a href="{{ route('user.profile')}}">My Account</a> 
                    </li>
                    <li class="nav item {{ ($route == 'user.orders')? 'active-nav':'' }}"> 
                        <a href="{{ route('user.orders')}}">My Orders</a> 
                    </li> 
                    <li class="nav item {{ ($route == 'user.change.password')? 'active-nav':'' }}"> 
                        <a href="{{ route('user.change.password')}}">Change Password</a>
                    </li>
                    <li class="nav item {{ ($route == 'user.logout')? 'active-nav':'' }}"> 
                        <a href="{{ route('user.logout')}}">Logout</a>
                    </li> 

                </ul>
        </div>
    </div>
</div>