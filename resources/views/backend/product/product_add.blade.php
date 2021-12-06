@extends('admin.admin_master')
@section('admin')

<div class="container-full">


    <!-- Main content -->
    <section class="content">

        <!-- Basic Forms -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><a href="{{ route('product.manage')}}">
                    <i class="fa fa-arrow-left text-warning" ></i></a>Add Product</h3>
            </div>

            <div class="box-body">
                <form method="POST" action="{{ route('product.store')}}" enctype="multipart/form-data">
                    @csrf
                    {{-- ----------Product Image and Category---------- --}}
                    <div class="row">

                        {{-- Product Image --}}
                        <div class="col-lg-7 col-sm-12">
                            <h4>Product Images</h4>
                            <div class="box-body">


                                {{-- Main Thumbnail --}}
                                <div class="row">
                                    {{-- Image --}}
                                    <div class="col-lg-4 col-sm-12">
                                        <div class="d-flex justify-content-center">
                                            <img id="mainThumbImg" src="" alt="Product Thumbnail">
                                        </div>
                                    </div>
                                    {{-- FilePath --}}
                                    <div class="col-lg-8 col-sm-12" style="padding-top: 1rem;">
                                        <div class="form-group">
                                            <h5>Main Thumbnail</h5>
                                            <div class="controls">
                                                <input type="file" name="product_thumbnail" accept="image/*" class="form-control" onchange="mainThumbUrl(this)" required>
                                            </div>
                                            @error('product_thambnail') 
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                {{-- Multi Images --}}
                                <div class="row">
                                    {{-- Image --}}
                                    <div class="col-lg-4 col-sm-12">
                                        <div id="prev_box" style="width:126px; height:106px; background:#1e2536;">
                                            <div id="prev_img"></div>
                                        </div>
                                    </div>
                                    
                                    {{-- FilePath --}}
                                    <div class="col-lg-8 col-sm-12" style="padding-top: 1rem;">
                                        <div class="form-group">
                                            <h5>Multi Images</h5>
                                            <div class="controls">
                                                <input type="file" name="product_multi_img[]" accept="image/*" class="form-control" multiple="" id="multiImg">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- Barnd & Categories --}}
                        <div class="col-lg-5 col-sm-12">

                            <div class="form-group">
                                <h5>Brand</h5>
                                <select name="brand_id" class="form-control" required>
                                    <option value="" selected="" disabled="">Select Brand</option>

                                    @foreach ($brands as $brand)
                                    <option value="{{$brand->id}}">
                                        {{$brand->brand_name}}
                                    </option>
                                    @endforeach

                                </select>
                                @error('brand_id')
                                <span id="invalidInput" class="text-danger">{{ $message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <h5>Category</h5>
                                <select name="category_id" class="form-control" required>
                                    <option value="" selected="" disabled="">Select Category</option>

                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}">
                                        {{$category->category_name}}
                                    </option>
                                    @endforeach

                                </select>
                                @error('category_id')
                                <span id="invalidInput" class="text-danger">{{ $message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <h5>Sub category</h5>
                                <select name="subcategory_id" class="form-control" required>
                                    <option value="" selected="" disabled="">Select sub-category</option>

                                </select>
                                @error('subcategory_id')
                                <span id="invalidInput" class="text-danger">{{ $message}}</span>
                                @enderror
                            </div>

                        </div>
                        {{-- End Categories --}}

                    </div>
                    {{-- ----------End Product Image and Category---------- --}}

                    <br>

                    {{-- ----------Product Pice and Details---------- --}}
                    <div class="row">

                        {{-- Product Details --}}
                        <div class="col-lg-7 col-sm-12">

                            <div class="form-group">
                                <h5>Stock Keeping Unit (SKU)</h5>
                                <div class="controls">
                                    <input type="text" name="product_sku" class="form-control" required>
                                </div>
                                @error('product_sku')
                                <span id="invalidInput" class="text-danger">{{ $message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <h5>Product Name</h5>
                                <div class="controls">
                                    <input type="text" name="product_name" class="form-control" required>
                                </div>
                                @error('product_name')
                                <span id="invalidInput" class="text-danger">{{ $message}}</span>
                                @enderror
                            </div>

                            <div class="row">
                                {{-- Product Stock and Location--}}
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <h5>Stock</h5>
                                        <div class="controls">
                                            <input type="number" name="product_stock" class="form-control">
                                        </div>
                                        @error('product_stock')
                                        <span id="invalidInput" class="text-danger">{{ $message}}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <h5>Product Location</h5>
                                        <div class="controls">
                                            <input type="text" name="product_location" class="form-control">
                                        </div>
                                        @error('product_location')
                                        <span id="invalidInput" class="text-danger">{{ $message}}</span>
                                        @enderror
                                    </div>

                                </div>

                                {{-- Product Size --}}
                                <div class=" col-md-6 col-sm-6">

                                    <div class="form-group">
                                        <h5>Product Size</h5>
                                            <select name="product_size_select" class="form-control" required>
                                                <option value="Regular" selected="">Regular</option>
                                                <option value="Extra Small">Extra Small</option>
                                                <option value="Small">Small</option>
                                                <option value="Medium">Medium</option>
                                                <option value="Large">Large</option>
                                                <option value="Extra Large">Extra Large</option>
                                                <option value="o">Other</option>
                                            </select>
                                            <input type="hidden" class="form-control" name="product_size" value="Regular" >
        
                                        @error('product_size')
                                        <span id="invalidInput" class="text-danger">{{ $message}}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <h5>Weight | Qty</h5>
                                        <div class="controls">
                                            <input type="text" name="product_size_text" class="form-control" disabled="">
                                        </div>
                                    </div>

                                </div>
                                {{-- End Product Size --}}

                            </div>

                            <div class="form-group">
                                <h5>Expriry Date</h5>
                                <div class="controls">
                                    <input type="date" name="product_expiry_date" class="form-control">
                                </div>
                                @error('product_expiry_date')
                                <span id="invalidInput" class="text-danger">{{ $message}}</span>
                                @enderror
                            </div>

                            {{-- Product Tags and Colors --}}
                            <div class="row">

                                <div class=" col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <h5>Product Colors</h5>
                                        <div class="controls">
                                            <input type="text" name="product_colors" class="form-control"
                                                data-role="tagsinput" placeholder="add tags" />
                                        </div>
                                        @error('product_tags')
                                        <span id="invalidInput" class="text-danger">{{ $message}}</span>
                                        @enderror
                                    </div>

                                </div>
                                
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <h5>Product Tags</h5>
                                        <div class="controls">
                                            <input type="text" name="product_tags" class="form-control" value="food"
                                                data-role="tagsinput" placeholder="add tags" />
                                        </div>
                                        @error('product_tags')
                                        <span id="invalidInput" class="text-danger">{{ $message}}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                        </div>
                        {{-- End Product Details --}}


                        {{-- Product Prices and Status --}}
                        <div class="col-lg-5 col-sm-12">

                            <div class="form-group">
                                <h5>Selling Price</h5>
                                <div class="controls">
                                    <input type="number" name="product_selling_price" class="form-control" required>
                                </div>
                                @error('product_selling_price')
                                <span id="invalidInput" class="text-danger">{{ $message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <h5>Discounted New Price</h5>
                                <div class="controls">
                                    <input type="number" name="product_discount_price" class="form-control">
                                </div>
                                @error('product_discount_price')
                                <span id="invalidInput" class="text-danger">{{ $message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <h5>Special Offers</h5>
                                <div style="padding-left: 2rem;">

                                    <div class="controls">
                                        <input type="checkbox" id="checkbox_1" name="product_status_new" value="1">
                                        <label for="checkbox_1">New</label>
                                    </div>

                                    <div class="controls">
                                        <input type="checkbox" id="checkbox_2" name="product_status_hotdeals" value="1">
                                        <label for="checkbox_2">Hot deals</label>
                                    </div>

                                    <div class="controls">
                                        <input type="checkbox" id="checkbox_3" name="product_status_featured" value="1">
                                        <label for="checkbox_3">Featured</label>
                                    </div>

                                    <div class="controls">
                                        <input type="checkbox" id="checkbox_4" name="product_status_specialdeals" value="1">
                                        <label for="checkbox_4">Special Deals</label>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <h5>Short Descriptions</h5>
                                <div class="controls">
                                    <textarea name="product_short_description" class="form-control"
                                        placeholder="Product Details" style="height: 12rem"></textarea>
                                </div>
                                @error('product_description')
                                <span id="invalidInput" class="text-danger">{{ $message}}</span>
                                @enderror
                            </div>

                        </div>
                        {{-- End Product Prices and Status --}}

                    </div>
                    {{-- ----------End Product Price and Details---------- --}}



                    {{-- ----------Long Decription And Offers---------- --}}
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <h5>Long Descriptions</h5>
                                <div class="controls">
                                    <textarea id="editor1" name="product_long_description" rows="10" cols="90" required="">
                                  
                                    </textarea>  
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-xs-right">
                        <input type="submit" class="btn btn-rounded btn-success pull-right" value="Add Product" >
                    </div>

                </form>
            </div>
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>

<script type="text/javascript">
 $('#mainThumbImg').attr('src','{{url('upload/no_image.jpg')}}').width(90).height(75);

 var img = $('<img/>').addClass('thumb').attr('src', '{{url('upload/no_image.jpg')}}').width(120).height(100); //create image element
     img.attr('id','multi_no_img');
 $('#prev_box').append(img)

    function mainThumbUrl(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#mainThumbImg').attr('src',e.target.result).width(90).height(75);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>


<script>
    $(document).ready(function () {
        $('select[name="product_size_select"]').on('change', function () {
            var sizeVal = $(this).val();
            if (sizeVal == 'o') {
                $('input[name="product_size_text"]').prop('disabled',false);
                $('input[name="product_size_text"]').focus();
            }else{
                $('input[name="product_size_text"]').prop('disabled',true);
                $('input[name="product_size_text"]').val('');
                $('input[name="product_size"]').val($('select[name="product_size_select"]').val());
            }
        });
    });

    $(document).ready(function () {
        $('input[name="product_size_text"]').on('input',function () {
            $('input[name="product_size"]').val($('input[name="product_size_text"]').val());
        });
    });

    $(document).ready(function(){
     $('#multiImg').on('change', function(){
        if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
        {
            var data = $(this)[0].files; //this file data
            $('#prev_img').remove();
            $('#multi_no_img').remove();
            $('#prev_box').append('<div id="prev_img"></div>');

            if(parseInt(data.length)>4){
                window.alert("You can only upload a maximun of 4 images only");
                $('#multiImg').val('<div id="prev_img"></div>');
            }else{
                $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); 
                    fRead.onload = (function(file){ 
                    return function(e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result); 
                        img.attr('style','margin:1px').width(60).height(50);
                        $('#prev_img').append(img); 
                    };
                    })(file);
                    fRead.readAsDataURL(file); 
                }
                });
            }
        }else{
            alert("Your browser doesn't support File API!"); 
        }
     });
    });
     
    </script>

@endsection