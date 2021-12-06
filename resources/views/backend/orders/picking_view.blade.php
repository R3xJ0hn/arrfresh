@extends('admin.admin_master')
@section('admin')

	  <div class="container-full">

		<!-- Main content -->
		<section class="content">
            <input type="hidden" id="orderID" value="{{$order_id}}">

		    <div class="row">

                <div class="col-1"></div>

                <div class="col-10" style="padding:0 5%">

                    <div id="mainBox" class="box p-15 b-1 bg-food-white fadeInLeft border-info" >
                        <div class="box-body" style="height: 75vh; padding-top:5px">        
                            <div class="row">

                                <div class="col-md-2">
                                    <input type="hidden" id="input-total-qtyTopick">
                                    <span id="complete" class="text-success" style="display: none">Complete</span>
                                    <span id="total-qtyTopick" class="badge badge-pill badge-primary" style="font-size: 20px"></span>
                                </div>

                                <div class="col-md-3">
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <h3 class="box-title text-warning" style="margin: 0" id="invoice-no"></h3>
                                        </div>
                                        <div class="col-sm-12 text-center">
                                            <div class="text-center"> <small>Invoice</small></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-7">
                                    <div class="row pull-right">
                                        <div class="col-sm-6">
                                            <input type="text" id="input-pickbin" onkeyup="PickBinOnChange()"
                                                 class="form-control" placeholder="Pick Bin">
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="row">
                                                <div class="col-sm-6 text-center" style="padding: 0">
                                                    <input type="button" id="submitBtn" class="btn-sm btn-primary"
                                                            value ="Confirm"  onclick="ConfirmOrder()" disabled>
                                                </div>
                                                <div class="col-sm-6 text-center" style="padding: 0">
                                                    <input type="button" class="btn-sm btn-danger" onclick="SkipOrder()" value = "Skip">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-1">
                                            <div class="box-tools pull-right">					
                                                <ul class="box-controls">
                                                    <a href="{{ route('pending-orders')}}"> <li class="fa fa-close"></li></a>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <hr>

                            <div class="table-responsive" style=" overflow-y:auto; height:90%;">
                                <table class="table table-striped mb-0"  style="width:97%;">
                                    <tbody>

                                        <div style="width: 95%" id="table-data"></div>

                                    </tbody>

                                </table>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- /.col -->
            </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  </div>

<script>
    var length = 0;
    var isConfirmationSending = false
    
    $(document).ready(function() {
        var id = $('#orderID').val();
        GetData(id); 
    });

    function GetData(orderId){
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: '/orders/pick/get/'+orderId,
            success:function(data){
            DisplayData(data);
            }
        });

    }

    function ConfirmOrder(){
        var pick_bin = $('#input-pickbin').val();
        var id =  $('#orderID').val();

        if(isConfirmationSending){ return }
        isConfirmationSending = true;

        $.ajax({
            type: "GET",
            dataType: 'json',
            url: '/orders/pick/confirm/'+id,
            data:{order_id:id, pickbin:pick_bin},
            success:function(data){ 
                fireToast(data);
                if(data.redirect){
                    window.location.href = data.redirect;
                }

                if(data.success){
                    //Reset
                    $('#submitBtn').attr('disabled',true);
                    $('#complete').hide();
                    $('#mainBox').removeClass('border-success');
                    $('#mainBox').addClass('border-info');
                    $('#total-qtyTopick').show();
                    $('#input-pickbin').val('');
                    DisplayData(data.data);
                }
            },
            complete: function(){
                isConfirmationSending = false; 
            }
        });
    }

    function SkipOrder(){
        var pick_bin = $('#input-pickbin').val();
        var id =  $('#orderID').val();

        if(isConfirmationSending){ return }
        isConfirmationSending = true;

        $.ajax({
            type: "GET",
            dataType: 'json',
            url: '/orders/pick/skip/'+id,
            success:function(data){
                if(data.redirect){
                    fireToast(data);
                    window.location.href = data.redirect;
                }
                DisplayData(data);
            },
            complete: function(){
                isConfirmationSending = false; 
            }
        });
    }


    function DisplayData(invoice){
        $('#input-total-qtyTopick').val(invoice.total_units);
        $('#total-qtyTopick').text(invoice.total_units);
        $('#invoice-no').text('#'+invoice.invoice_no);

        $('#orderID').val(invoice.order_id);
        $('#invoice-status').val(invoice.status);

        var data = invoice.cart;
        var items ="";
        var cnt = 0;
        $.each(data, function (key, value) {
            cnt++;
            items+=`
                <tr>
                    <td style="width:30% " class="text-center">
                        <img src="/${value.productImg}" alt="img" style="width: 60%;">
                    </td>

                    <td style="width:65%; position:relative;">
                        
                        <div style="position: absolute; top:1rem; width:100%">

                            <div class="row" style="top:0">
                            <div class="col-md-9">
                                <h6>${value.productName} ${value.productSize}</h6>
                            </div>
                            <div class="col-md-3">
                                <span class="badge badge-pill badge-warning pull-right" style="display:none;" id="qty_cnt-${cnt}" ><span style="font-size: 14px"></span></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-8" style="padding-top: 0; padding-bottom: 0">
                                <p style="margin: 0">SKU:${value.productSKU}</p>
                            </div>
                            <div class="col-sm-4" style="padding-top: 0; padding-bottom: 0">
                                <p style="margin: 0">Qty: <span>${value.productQty}</span></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-8" style="padding-top: 0; padding-bottom: 0">
                                <p>Location: <span>${value.productLocation}</span></p>
                            </div>
                            <div class="col-sm-4" style="padding-top: 0; padding-bottom: 0">
                                <p>Color: <span>${value.productColor}</span></p>
                            </div>
                        </div>
                        <input type="hidden" id="cnt-store-${cnt}">
                        <input type="hidden" id="itemQty-${cnt}" value="${value.productQty}">
                        <input type="hidden" id="skuItem-${cnt}" value="${value.productSKU}">

                        <span>
                                <input type="text" id= "inputSkuItem-${cnt}" class="form-control" placeholder="SKU" onchange="VerifySku('${cnt}')">
                        </span>
                        </div>
                        
                        
                    </td>
                </tr>`

        });
        length = cnt;
        $('#table-data').html(items);
        $('#inputSkuItem-1').focus();
    }

    function VerifySku(item){
        var total_qtyToPick = $('#input-total-qtyTopick').val();
        var sku = $('#skuItem-'+item).val();
        var input_sku = $('#inputSkuItem-'+item).val();
        var cntStore =  $('#cnt-store-'+item).val();
        var itemQty = $('#itemQty-'+item).val();

        if(input_sku == sku){
            cntStore++;
            total_qtyToPick--;
            $('#qty_cnt-'+item).show();
            $('#qty_cnt-'+item).text(cntStore);
            $('#cnt-store-'+item).val(cntStore);
            $('#inputSkuItem-'+item).val('');
            $('#total-qtyTopick').text(total_qtyToPick);
            $('#input-total-qtyTopick').val(total_qtyToPick);

            if(cntStore == itemQty){
                $('#inputSkuItem-'+item).hide(); 
                $('#inputSkuItem-'+item).val('confirmed') 
                $('#qty_cnt-'+item).removeClass('badge-warning');
                $('#qty_cnt-'+item).addClass('badge-success');
                FocusToNext(item);
                VerifyOrders();
            }
        }else{
            $('#inputSkuItem-'+item).val('');
            $('#inputSkuItem-'+item).addClass('border-danger');
        }
    }

    function FocusToNext(tabIndex){
        var index = parseInt(tabIndex);
        var next = index+1;
        //if we are on the last tabindex, go back to the beginning
        if(index>=length){
            next =1;
        }
        for(var i=0; i<=length; i++){//loop through each element
            if(i==next){
                if($('#inputSkuItem-'+i).val() != "confirmed" ){
                    $('#inputSkuItem-'+(next)).focus();
                    break;
                }else{ //if the input is confirmed go to next input
                    next++;
                    $('#inputSkuItem-'+(next)).focus();
                    break;
                }
            }
        }
    }
    
    function PickBinOnChange(){
        VerifyOrders();
    }

    function VerifyOrders(){
        //enable the confirm button
        var confirm = false;
        for(var i=0; i<=length; i++){//loop through each element
            confirm = ($('#inputSkuItem-'+i).val() == "confirmed" )? true : false;
        }

        if(confirm){
            if($('#input-pickbin').val()!= ""){
                $('#submitBtn').attr('disabled',false);
                $('#submitBtn').focus();
                $('#complete').show();
                $('#mainBox').removeClass('border-info');
                $('#mainBox').addClass('border-success');
                $('#total-qtyTopick').hide();
            }else{
                $('#submitBtn').attr('disabled',true);
                $('#complete').hide();
            }
        }else{
            $('#submitBtn').attr('disabled',true);
            $('#complete').hide();
        }
    }

    function fireToast(data){
        // Start Message 
        const Toast = swal.mixin({
        toast: true,
        position: 'top-end',
        icon: 'success',
        showConfirmButton: false,
        timer: 3000
        })

        if ($.isEmptyObject(data.error)) {

            if($.isEmptyObject(data.info)) {
                Toast.fire({
                icon: 'success',
                title: data.success
                });
                
            }else{
                Toast.fire({
                icon: 'info',
                title: data.info
                });
            }
            
        }else{
            Toast.fire({
                icon: 'error',
                title: data.error
            })
        } // End Message 
    }// end method

</script>

@endsection