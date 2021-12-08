@php
$categories = App\Models\Category::orderBy('category_name','ASC')->get();
@endphp

<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
    <nav class="yamm megamenu-horizontal">
        <ul class="nav">

            @foreach ($categories as $category)
            <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle"
                    data-toggle="dropdown">{{$category->category_name}}</a>

                @php $cnt = 0; @endphp
                @foreach ($subcategories as $subcategory)
                @if ( $subcategory->category_id == $category->id)
                @php $cnt++; @endphp
                @endif
                @endforeach

                @if ($cnt > 0)
                <ul class="dropdown-menu menu "
                    style="left: 21vw; top:0; background:rgb(248, 248, 248)">
                    <li class="yamm-content">
                        <div class="row">

                            <div class="col-sm-12 col-md-12">
                                <ul class="links list-unstyled">

                                    @foreach ($subcategories as $subcategory)
                                    @if ( $subcategory->category_id == $category->id)
                                    <li><a href="#">{{ $subcategory->subcategory_name}}</a></li>
                                    @endif
                                    @endforeach

                                </ul>
                            </div>

                        </div>
                        <!-- /.row -->
                    </li>
                    <!-- /.yamm-content -->
                </ul>
                <!-- /.dropdown-menu -->
                @endif
            </li>
            <!-- /.menu-item -->
            @endforeach

        </ul>
        <!-- /.nav -->
    </nav>
    <!-- /.megamenu-horizontal -->
</div>