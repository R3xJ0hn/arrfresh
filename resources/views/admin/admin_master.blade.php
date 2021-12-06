<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/backend/images/favicon.ico') }}">

    <title>Grocey Admin - Dashboard</title>

    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{ asset('assets/backend/css/vendors_css.css') }}">

    <!-- Style-->
    <link rel="stylesheet" href="{{ asset('assets/backend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/skin_color.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/toastr.css') }}">


    <!-- Tags Input CDN -->
    <script src="{{asset('js/jquery.min.js')}}"></script>

</head>

<body class="hold-transition dark-skin sidebar-mini theme-primary fixed">
{{-- <body class="light-skin sidebar-mini theme-primary fixed sidebar-mini-expand-feature"> --}}

    <div class="wrapper">

        @include('admin.body.header')

        <!-- Left side column. contains the logo and sidebar -->
        @include('admin.body.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            @yield('admin')

        </div>
        <!-- /.content-wrapper -->
        @include('admin.body.footer')

        <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>

    </div>
    <!-- ./wrapper -->

    <!-- Vendor JS -->
    <script src=" {{ asset('assets/backend/js/vendors.min.js') }}"></script>
    <script src=" {{ asset('assets/assets/icons/feather-icons/feather.min.js') }}"></script>
    <script src=" {{ asset('assets/assets/vendor_components/easypiechart/dist/jquery.easypiechart.js') }}"></script>
    <script src=" {{ asset('assets/assets/vendor_components/apexcharts-bundle/irregular-data-series.js') }}"></script>
    <script src=" {{ asset('assets/assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js') }}"></script>

    <script src=" {{ asset('assets/assets/vendor_plugins/bootstrap-slider/bootstrap-slider.js') }}"></script>
    <script src=" {{ asset('assets/assets/vendor_components/OwlCarousel2/dist/owl.carousel.js') }}"></script>
    <script src=" {{ asset('assets/assets/vendor_components/flexslider/jquery.flexslider.js') }}"></script>
    <script src=" {{ asset('assets/assets/vendor_components/datatable/datatables.min.js')}}"></script>

    <script src=" {{ asset('assets/assets/vendor_components/ckeditor/ckeditor.js') }}"></script>
    <script src=" {{ asset('assets/assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js') }}"></script>
    <script src=" {{ asset('assets/backend/js/pages/editor.js') }}"></script>


    <!-- Includes Sweet Alert -->
    <script src="{{mix('js/app.js')}}"></script> 

    <!-- Sunny Admin App -->
    <script src=" {{ asset('assets/backend/js/template.js')}}"></script>
    <script src=" {{ asset('assets/backend/js/pages/dashboard.js') }}"></script>
    <script src=" {{ asset('assets/backend/js/pages/data-table.js')}}"></script>
    <script src=" {{ asset('assets/backend/js/pages/slider.js') }}"></script>
    <script src=" {{ asset('assets/backend/js/pages/advanced-form-element.js') }}"></script>
    <script src=" {{ asset('assets/backend/js/pages/toastr.js') }}"></script>

    <script>
        @if (Session:: has('message'))
        var type = "{{Session::get('alert-type','info')}}"
        switch (type) {
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;
            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;
            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;
            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
        @endif
    </script>

    
<script>
    $.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')  }
    });
</script>

    <script type="text/javascript">

        $(document).ready(function () {
            $('#image').change(function (e) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });

        $(function () {
            $(document).on('click', '#delete', function (e) {
                e.preventDefault();
                var link = $(this).attr("href");

                swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link;
                        swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            });
        });

        $(document).ready(function () {
            $('select[name="category_id"]').on('change', function () {
                var category_id = $(this).val();
                if (category_id) {
                    $.ajax({
                        url: "{{ url('/subcategory/data/')}}/" + category_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            var d = $('select[name="subcategory_id"]').empty();
                            if (data == '') {
                                $('select[name="subcategory_id"]').append('<option value="-1">No Sub Category Available</option>');
                            }
                            $.each(data, function (key, value) {
                                $('select[name="subcategory_id"]').append('<option value="' + value.id + '">' + value.subcategory_name + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });

    </script>



</body>

</html>