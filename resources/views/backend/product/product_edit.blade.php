@extends('admin.admin_master')
@section('admin')

<div class="container-full">


    <!-- Main content -->
    <section class="content">
        <!-- Basic Forms -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><a href="{{ route('product.manage')}}">
                    <i class="fa fa-arrow-left text-warning" ></i></a>    Edit Product</h3>
            </div>

            <div class="box-body">
                <form id="frm" method="POST" action="{{ route('product.update')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $products->id}}">
                    <input type="hidden" name="old_mainThumb" value="{{ $products->product_thumbnail }}">


                    {{-- ----------         Product Images         ---------- --}}
                    <div class ="row">
                       
                        {{-- Main Thumbnail --}}
                        <div class="col-lg-4" >

                            <div class="d-flex justify-content-center">
                                <img id="showThumbImg" alt="Product Thumbnail"  class="rounded border border-dark card-img" 
                                     src="{{ asset($products->product_thumbnail) }}" style="width:247px; height:270px" >
                            </div>

                            {{-- Button Modifier --}}
                            <div class="card-img-overlay">
                                {{--Edit Buttons --}}
                                <a type="button" class="position-absolute p-2 bg-info text-warning ti-pencil shadow-sm rounded-circle" title="Edit"  style="top:10px; right:25px;" data-toggle="modal" data-target="#modal-center" onclick="editMainThumb()" ></a>
                            </div>

                            <h6 class="d-flex justify-content-center">Main Thumbnail</h6>
                            @error('product_thambnail') 
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Multiple Images --}}
                        <div class="col-lg-8" > 
                           <div class="row"><h3>Product Images</h3></div> <br>
                            <div class="row" id="addedImg">

                                {{-- // Load All The Images --}}
                                @php
                                $imgId = 0;
                                @endphp
                                @foreach($multiImgs as $img)
                                @php
                                $imgId++;
                                @endphp
                                <div class="col-md-3 col-sm-6" id="addedImg{{$img->id}}" style="padding: 5px; width:auto;">
                                    <div class="card border border-info" style="border-radius: 0; width: 130px;" >
                                        <img id="multi-img-{{$imgId}}" src="{{ asset($img->photo_name) }}" class="card-img" style=" width: 100px; height: 109px;">
                                        <div class="card-img-overlay">
                                            <a type="button" title="Edit" class="position-absolute p-2 bg-info text-white" style="top:10px; right:1px;"
                                            data-toggle="modal" data-target="#modal-center" onclick="editMultiImg('{{ asset($img->photo_name) }}', '{{$imgId}}')"><i class="fa fa-pencil"></i></a>
                                            <a type="button" onclick="removeNewAddedImg({{$img->id}})" class="position-absolute p-2 bg-danger text-white " style="top:60px; right:2px"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                                <input type="hidden" id="imgLoadedCnt" value="{{$imgId}}">
                                
                                @if($imgId < 4)
                                <div class="col-md-3 col-sm-6" style="padding: 5px; width:auto;" id="addBtn">
                                    <div class="card border " style="border-radius: 0; width: 128px; height: 109px;" >
                                        <style> 
                                            .add-img{ position: absolute;  right:50%; top:50%; transform:translate(50%,-50%); font-size:3rem; } 
                                            .add-img:hover{font-size:2.5rem;}
                                        </style>
                                        <a type="button" title="Edit" data-toggle="modal" data-target="#modal-center" onclick="addMultiImgBtn({{$imgId}})">
                                            <i class="fa fa-plus-circle text-info add-img"> </i>
                                        </a>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                    </div> <br>
                    {{-- ----------       End Product Images       ---------- --}}

                    {{-- ----------   Product Brand And Category   ---------- --}}
                    <div class="row">

                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <h5>Brand</h5>
                                <select name="brand_id" class="form-control" required>
                                    <option value="" selected="" disabled="">Select Brand</option>
    
                                    @foreach ($brands as $brand)
                                    <option value="{{$brand->id}}" {{$brand->id == $products->brand_id ? 'selected' : ''}}>
                                        {{$brand->brand_name}}
                                    </option>
                                    @endforeach
    
                                </select>
                                @error('brand_id')
                                <span id="invalidInput" class="text-danger">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <h5>Category</h5>
                                <select name="category_id" class="form-control" required>
                                    <option value="" selected="" disabled="">Select Category</option>
    
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}" {{$category->id == $products->category_id ? 'selected' : ''}}>
                                        {{$category->category_name}}
                                    </option>
                                    @endforeach
    
                                </select>
                                @error('category_id')
                                <span id="invalidInput" class="text-danger">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <h5>Sub category</h5>
                                <select name="subcategory_id" class="form-control" required>
                                    <option value="-1" selected="" disabled="">Select sub-category</option>
    
                                    @foreach ($subcategory as $sub)\
                                    <option value="{{$sub->id}}" {{$sub->id == $products->subcategory_id ? 'selected' : ''}}>
                                        {{$sub->subcategory_name}}
                                    </option>
                                    @endforeach
    
                                </select>
                                @error('subcategory_id')
                                <span id="invalidInput" class="text-danger">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    {{-- ---------- End Product Brand And Category ---------- --}}
                  
                    <br>

                    {{-- ----------Product Details---------- --}}
                    <div class="row">

                        {{-- Product Details --}}
                        <div class="col-lg-7 col-sm-12">

                            <div class="form-group">
                                <h5>Stock Keeping Unit (SKU)</h5>
                                <div class="controls">
                                    <input type="text" name="product_sku" class="form-control" required value="{{ $products->product_sku}}">
                                </div>
                                @error('product_sku')
                                <span id="invalidInput" class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <h5>Product Name</h5>
                                <div class="controls">
                                    <input type="text" name="product_name" class="form-control" required value="{{ $products->product_name}}">
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
                                            <input type="number" name="product_stock" class="form-control" value="{{ $products->product_total_stock}}">
                                        </div>
                                        @error('product_stock')
                                        <span id="invalidInput" class="text-danger">{{ $message}}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <h5> Location</h5>
                                        <div class="controls">
                                            <input type="text" name="product_location" class="form-control" value="{{ $products->product_location}}">
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

                                                <option value="Regular"  {{$products->product_size == 'Regular' ? 'selected' : ''}} >Regular</option>
                                                <option value="Extra Small" {{$products->product_size == 'Extra Small' ? 'selected' : ''}} >Extra Small</option>
                                                <option value="Small"  {{$products->product_size == 'Small' ? 'selected' : ''}} >Small</option>
                                                <option value="Medium"  {{$products->product_size == 'Medium' ? 'selected' : ''}} >Medium</option>
                                                <option value="Large"  {{$products->product_size == 'Large' ? 'selected' : ''}} >Large</option>
                                                <option value="Extra Large" {{$products->product_size == 'Extra Large' ? 'selected' : ''}} >Extra Large</option>
                                                
                                                <option value="o"  
                                                @if ($products->product_size != 'Regular' &
                                                     $products->product_size != 'Extra Small'&
                                                     $products->product_size != 'Small' &
                                                     $products->product_size != 'Medium' &
                                                     $products->product_size != 'Large' &
                                                     $products->product_size != 'Extra Large')
                                                    selected
                                                @endif >Other</option>
                                            </select>

                                            <input type="hidden" class="form-control" name="product_size" value="{{ $products->product_size}}" >
                                            @error('product_size')
                                            <span id="invalidInput" class="text-danger">{{ $message}}</span>
                                            @enderror

                                    </div>

                                    <div class="form-group">
                                        <h5 id="sizeOptionLabel">Weight | Qty</h5>
                                        <div class="controls">
                                            @php
                                            $setVal = ($products->product_size != 'Regular' &
                                                $products->product_size != 'Extra Small'&
                                                $products->product_size != 'Small' &
                                                $products->product_size != 'Medium' &
                                                $products->product_size != 'Large' &
                                                $products->product_size != 'Extra Large')?  $products->product_size : '' ;
                                            @endphp
                                        <input type="text" name="product_size_text" class="form-control" 
                                        {{$setVal == '' ? 'disabled' : 'value='.$setVal.''}}  >
                                        </div>
                                    </div>
                                </div>
                                {{-- End Product Size --}}

                            </div>

                            <div class="form-group">
                                <h5>Expriry Date</h5>
                                <div class="controls">
                                    <input type="date" name="product_expiry_date" class="form-control" value="{{ $products->product_expiry_date}}">
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
                                            <input type="text" name="product_colors" class="form-control" data-role="tagsinput"
                                             placeholder="add tags" value="{{ $products->product_colors}}"/>
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
                                            <input type="text" name="product_tags" class="form-control" data-role="tagsinput"
                                             placeholder="add tags" value="{{ $products->product_tags}}"/>
                                        </div>
                                        @error('product_tags')
                                        <span id="invalidInput" class="text-danger">{{ $message}}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                        </div>
                        {{-- End Product Details --}}

                        {{-- Product Prices Tags and Status --}}
                        <div class="col-lg-5 col-sm-12">

                            <div class="form-group">
								<h5>Selling Price</h5>
								<div class="input-group"> 
                                    <span class="input-group-addon">₱</span>
									<input type="number" name="product_selling_price" onchange="updateNull()"
                                        min="1" class="form-control" required value="{{ $products->product_selling_price}}"> 
                                </div>
                                @error('product_selling_price')
                                <span id="invalidInput" class="text-danger">{{ $message}}</span>
                                @enderror
							</div>

                            <div class="form-group">
								<h5>Discounted New Price</h5>
								<div class="input-group" > 
                                    <span class="input-group-addon">₱</span>
									<input type="number" name="product_discount_price" class="form-control"  min="0"  
                                          value="{{ $products->product_discount_price}}" oninput="updatePercentage()" onchange="updateNull()">
                                    <span style="margin: 0 1rem; font-size:14px; margin-top: 0.5rem;">
                                        <b class="text-warning" id="Percentage">
                                            {{number_format(100-(($products->product_discount_price/$products->product_selling_price)*100),1)}} 
                                           %
                                        </b> off
                                    </span>
                                </div>

                                @error('product_discount_price')
                                <span id="invalidInput" class="text-danger">{{ $message}}</span>
                                @enderror
							</div>

                            <div class="form-group">
                                <h5>Special Offers</h5>
                                <div style="padding-left: 2rem;">

                                    <div class="controls">
                                        <input type="checkbox" id="checkbox_1" name="product_status_new" value="1"
                                        {{$products->product_status_new == 1 ? 'checked': ''}}>
                                        <label for="checkbox_1">New</label>
                                    </div>

                                    <div class="controls">
                                        <input type="checkbox" id="checkbox_2" name="product_status_hotdeals" value="1"
                                        {{$products->product_status_hotdeals == 1 ? 'checked': ''}}>
                                        <label for="checkbox_2">Hot deals</label>
                                    </div>

                                    <div class="controls">
                                        <input type="checkbox" id="checkbox_3" name="product_status_featured" value="1"
                                        {{$products->product_status_featured == 1 ? 'checked': ''}}>
                                        <label for="checkbox_3">Featured</label>
                                    </div>

                                    <div class="controls">
                                        <input type="checkbox" id="checkbox_4" name="product_status_specialdeals" value="1"
                                        {{$products->product_status_specialdeals == 1 ? 'checked': ''}}>
                                        <label for="checkbox_4">Special Deals</label>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <h5>Short Descriptions</h5>
                                <div class="controls">
                                    <textarea name="product_short_description" class="form-control" required 
                                        placeholder="Product Details" style="height: 12rem">{{ $products->product_short_description}}</textarea>
                                </div>
                                @error('product_description')
                                <span id="invalidInput" class="text-danger">{{ $message}}</span>
                                @enderror
                            </div>

                        </div>
                        {{-- End Product Prices Tags and Status --}}

                    </div>
                    {{-- ----------End Product Price and Details---------- --}}

                    {{-- ----------Long Decription And Offers---------- --}}
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <h5>Long Descriptions</h5>
                                <div class="controls">
                                    <textarea id="editor1" name="product_long_description" rows="10" cols="90" required="">
                                        {{ $products->product_long_description}}
                                    </textarea>  
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ----------Long Decription And Offers---------- --}}

                    <div class="text-xs-right">
                        <input type="submit" class="btn btn-rounded btn-success pull-right" value="Update Product" >
                    </div>

                      {{-- ----------Modal---------- --}}
                    <div class="modal center-modal fade" id="modal-center" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 id="modal-title" class="modal-title">Action</h5>
                                    <input type="button" class="close" data-dismiss="modal" value=&times; style="background: transparent;" onclick="closeModal()">
                                </div>

                                    <div class="modal-body">
                                        {{-- Preview Image --}}
                                        <div class="d-flex justify-content-center">
                                            <img id="modal-img" alt="Product Thumbnail"  class="rounded border border-dark card-img">
                                        </div>
                                        <br>
                                        {{-- Input  --}}
                                        <div class="form-group">
                                            <div class="controls" id="modalInputs">
                                                
                                                <input id="modal-input-val" name="product_thumbnail" type="file" accept="image/*" class="form-control d-none" onchange="modalInputChange(this, 0)" >
                                             
                                                @php
                                                $imgInputId = 0;
                                                @endphp
                                                @foreach($multiImgs as $img)
                                                @php
                                                $imgInputId++;
                                                @endphp
                                                    <input id="modal-input-{{$imgInputId}}" name="multi_img[{{$img->id}}]" type="file" accept="image/*" class="form-control d-none" onchange="modalInputChange(this,{{$imgInputId}})" >
                                                @endforeach

                                            </div>
                                            @error('product_thumbnail')
                                            <span class="text-danger">{{ $message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="modal-footer modal-footer-uniform col-12">
                                        <input id="modal-submit" type="button" class="btn btn-rounded btn-success float-right" data-dismiss="modal"
                                        value="Save Changes" onclick="saveModal()">
                                        <input type="button" class="btn btn-rounded btn-danger float-right" data-dismiss="modal"
                                            value="Close" onclick=" closeModal()">
                                    </div>
                            </div>
                        </div>
                    </div>
                      {{-- ----------End Modal---------- --}}

                </form>
            </div>
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>



<script>

    function updateNull(){
        if( $('input[name=product_discount_price]').val() == ''){
            $('input[name=product_discount_price]').val(0);
        }
        if( $('input[name=product_selling_price]').val() == '' || $('input[name=product_selling_price]').val() == 0){
            $('input[name=product_selling_price]').val(1);
        }
        updatePercentage();
     }

    function updatePercentage(){
        var sellingPrice = parseInt($('input[name=product_selling_price]').val());
        var discountedPrice = parseInt($('input[name=product_discount_price]').val());
        var Percentage = 0;

        if(discountedPrice > sellingPrice){
            discountedPrice = sellingPrice;
            $('input[name=product_discount_price]').val(sellingPrice);
        }

        if(discountedPrice < 0){
            discountedPrice = 0;
            $('input[name=product_discount_price]').val(0);
        }

        if(sellingPrice < 0 || sellingPrice == null){
            sellingPrice = 1;
            $('input[name=product_selling_price]').val(1);
        }

        Percentage = 100-((discountedPrice/sellingPrice) *100);
        $('#Percentage').text( Percentage.toFixed() +'%')
    }

    $(document).ready(function () {
        $('select[name="product_size_select"]').on('change', function () {
            var sizeVal = $(this).val();
            if (sizeVal == 'o') {
                $('input[name="product_size_text"]').prop('disabled',false);
                $('input[name="product_size_text"]').focus();
                $('input[name="product_size_text"]').val('{{$setVal}}');
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

</script>



<script type="text/javascript">

    var newAddedInputId = 0;
    var focused_InputId = 0;
    var maxIdCreated = 0;
    var imgCnt = 0;
    var mode = 0;

    $(window).on("load",function(){
        imgCnt =  $('#imgLoadedCnt').val();
    });

    function addMultiImgBtn(){
        mode = 0;
        document.getElementById("modal-title").innerHTML = "Add New Product Image";
        $('#modal-img').attr('src','{{url('upload/no_image.jpg')}}').width(160).height(175);
        HideInputs();
        //Create new Image Input
        newAddedInputId--;
        var inputBlock = `<input id="new-input${newAddedInputId}" name="new_multiImg[${newAddedInputId}]" type="file" 
            accept="image/*" class="form-control" onchange="modalInputChange(this,${newAddedInputId})" >`
        $('#modalInputs').append(inputBlock);
    }

    function modalInputChange(input,id){
        focused_InputId = id;
        if(input.files &&  input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){$('#modal-img').attr('src',e.target.result).width(160).height(175)};
            reader.readAsDataURL(input.files[0]);
        }
    }

    function editMultiImg(imgPath, inputId){
        mode = 1;
        document.getElementById("modal-title").innerHTML = "Product Image";
        HideInputs();
        if(inputId > 0){
            $('#modal-img').attr('src',imgPath).width(160).height(175);
            $('#modal-input-'+ inputId).removeClass("d-none");
            $('#modal-input-'+ inputId).val('');
        }

        if(inputId < 0){
            var reader = new FileReader();
            reader.onload = function(e){ $('#modal-img').attr('src',e.target.result).width(160).height(175)}
            reader.readAsDataURL($('#new-input'+ inputId)[0].files[0]);
            $('#new-input'+ inputId).show();
        }
    }

    function removeNewAddedImg(id){

        if(id<0){
            $('#addBtn').remove();
            $('#addedImg'+id).remove();
            $('#new-input'+id).remove();   
            imgCnt--;
            if(imgCnt < 4){ 
                $('#addedImg').append(addBtnHTMLBlock(focused_InputId)); 
            }
        }

        //Remove existing image
        if(id>0){
            const Toast = swal.mixin({
                toast: true,
                position: 'top-end',
                icon: 'info',
                showConfirmButton: false,
                timer: 3000
            })

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
                        $.ajax({
                            type: 'GET',
                            url: '/products/multiimg/delete/'+id,
                            dataType:'json',
                            success:function(data){
                                $('#addBtn').remove();

                                Toast.fire({
                                    type: 'info',
                                    title: data.info
                                });

                                $('#addedImg'+id).remove();
                                $('#modal-input-'+id).remove();  
                                imgCnt--;
                                
                                if(imgCnt < 4){ 
                                    $('#addedImg').append(addBtnHTMLBlock(focused_InputId)); 
                                }
                            }
                        }); // end Ajax
                    }
                })
        }//end remove existing image

    }

    function saveModal(){
        if(focused_InputId == 0){ // Main
            var reader = new FileReader();
            reader.onload = function(e){ $('#showThumbImg').attr('src',e.target.result).width(247).height(270)};
            reader.readAsDataURL($('#modal-input-val')[0].files[0]);   
        }else{

            if(focused_InputId > 0){ //Update Existed Image
                reader.onload = function(e){  $('#multi-img-'+focused_InputId).attr('src',e.target.result).width(100).height(109)};
                reader.readAsDataURL($('#multi-img-'+focused_InputId).files[0]);
            }

            if(focused_InputId < 0){ // Create and Update new Image

                if( mode == 0){
                    imgCnt++;
                    $('#addBtn').remove();
                    var createdNewImgBlock = ""
                    createdNewImgBlock = `
                    <div class="col-md-3 col-sm-6" id="addedImg${focused_InputId}"  style="padding: 5px;  width:auto;">
                        <div class="card border border-white" style="border-radius: 0; width: 130px;" >
                            <img id="new_img${focused_InputId}" class="card-img" style=" width: 100px; height: 109px;">
                            <div class="card-img-overlay">
                                <a type="button" title="Edit" class="position-absolute p-2 bg-info text-white" style="top:10px; right:1px;"
                                data-toggle="modal" data-target="#modal-center" onclick="editMultiImg(null,${focused_InputId})"><i class="fa fa-pencil"></i></a>
                                <a type="button" title="Delete" onclick="removeNewAddedImg(${focused_InputId})" class="position-absolute p-2 bg-danger text-white "style="top:60px; right:2px"><i class="fa fa-trash"></i></a>
                            </div>
                        </div>
                    </div>`

                    if(imgCnt != 4){  createdNewImgBlock += addBtnHTMLBlock(focused_InputId); }
                    $('#addedImg').append(createdNewImgBlock);
                }

                var file = $('#new-input'+ focused_InputId)[0];
                if(file){
                    var reader = new FileReader();
                    reader.onload = function(e){ $('#new_img'+ focused_InputId).attr('src',e.target.result).width(100).height(109); };
                    reader.readAsDataURL(file.files[0]);
                }
            }
        }
        HideInputs();
    }

    function addBtnHTMLBlock(id) {
        var newId = parseInt(id) -1;
        var row =`
            <div class="col-md-3 col-sm-6" style="padding: 5px;  width:auto;" id="addBtn">
                <div class="card border " style="border-radius: 0; width: 128px; height: 109px; margin:0;" >
                    <style> 
                        .add-img{ position: absolute;  right:50%; top:50%; transform:translate(50%,-50%); font-size:3rem; } 
                        .add-img:hover{font-size:2.5rem;}
                    </style>
                    <a type="button" title="Edit" data-toggle="modal" data-target="#modal-center" onclick="addMultiImgBtn(${newId})">
                        <i class="fa fa-plus-circle text-info add-img"> </i>
                    </a>
                </div>
            </div>`
        return row;
    }

    function editMainThumb(){
        document.getElementById("modal-title").innerHTML = "Edit Main Thumbnails";
        $('#modal-img').attr('src','{{ asset($products->product_thumbnail) }}').width(160).height(175);
        HideInputs();
        $('#modal-input-val').removeClass("d-none");
    }

    function closeModal(){
        $('#modal-input-val').val('');
        HideInputs();
    }

    function HideInputs(){
        $('#modal-input-val').addClass("d-none");
        for(let i=0; i < 50; i++){
            $('#modal-input-'+ i).addClass("d-none");
            
            if( $('#new-input'+ (0-i)).val()==''){
                $('#new-input'+ (0-i)).remove();
                newAddedInputId++;
            }else{
                $('#new-input'+ (0-i)).hide();
            }
        }
    }

</script>



@endsection