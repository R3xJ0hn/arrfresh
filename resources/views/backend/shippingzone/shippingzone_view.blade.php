@extends('admin.admin_master')
@section('admin')

<style>
    .modif-icon:hover{
        color:gray;
        font-size: 90%;
    }
</style>

<div class="container-full">

    <!-- Main content -->
    <section class="content">

        <div class="box box-default" style="min-height: 100vh;">
            <div class="box-header with-border">
                <h3 class="box-title">Shipping Zone</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs customtab" role="tablist">
                    <li class="nav-item"> <a type="button" id="nav_region" class="nav-link" onclick="tabChange(0)">Regions</a> </li>
                    <li class="nav-item"> <a type="button" id="nav_city" class="nav-link" onclick="tabChange(1)">Cities</a> </li>
                    <li class="nav-item"> <a type="button" id="nav_barangay" class="nav-link" onclick="tabChange(2)">Barangay</a> </li>
                    <input type="button" class="btn btn-success rounded-pill" title="Add" data-toggle="modal" style="position: absolute; right:5%; padding: 5px 20px"
                    data-target="#modal-center" value="Add" onclick="addBtn()">
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">

                    <div class="tab-pane active"  role="tabpanel">

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead id="thead" class="bg-dark"> </thead>
                                    <tbody id="tbody"> </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        
                    </div>

                </div>
            </div>
            <!-- /.box-body -->
        </div>
          <!-- /.box -->

        <!------------------- Modal ------------------->
        <div class="modal center-modal fade" id="modal-center" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="modal-title" class="modal-title">Action</h5>
                        <input id="closeBtn" type="button" class="close" data-dismiss="modal" value=&times;
                            style="background: transparent;">
                    </div>

                        <div id="modalBody" class="modal-body">  </div>
                        <input type="hidden" id="modal-id">

                        <div class="modal-footer modal-footer-uniform col-12">
                            <input id="modal-submit" type="button" class="btn btn-rounded btn-info float-right"
                                value="Add">
                            <input type="button" class="btn btn-rounded btn-danger float-right" data-dismiss="modal"
                                value="Close">
                        </div>

                </div>
            </div>
        </div>
        <!-- /.modal -->
    </section>
    <!-- /.content -->


<script>
   $('#modal-submit').on('click',submitBtn);

        var tabIndex = 0;
        var regionOptions = "";
        var submitMode = 0;

    function tabChange(tab){
        var thead = ""; 
        var modalFields ="";
        tabIndex = tab;

        switch(tab){
            case 0: 
                $('#tbody').html('');
                document.getElementById("modal-title").innerHTML = "Add New Region";
                $('#nav_region').addClass('active');
                $('#nav_city').removeClass('active');
                $('#nav_barangay').removeClass('active');
                thead =`                    
                    <tr>
                        <th scope="col" class="text-center text-white">Regions</th>
                        <th scope="col" class="text-center text-white" width="13%">Action</th>
                    </tr>`
                modalFields =`
                    <div class="form-group">
                        <h5>Region Name</h5>
                        <div class="controls">
                            <input id="region-name" type="text" name="region_name" class="form-control" value="">
                            @error('region_name')
                            <span id="invalidInput" class="text-danger" name="coupon_name" value="{{$message}}">{{ $message}}</span>
                            @enderror
                        </div>
                    </div>`
                loadRegions();
            break;

            case 1:
                $('#tbody').html('');
                document.getElementById("modal-title").innerHTML = "Add New City";
                $('#nav_region').removeClass('active');
                $('#nav_city').addClass('active');
                $('#nav_barangay').removeClass('active');
                thead =`                    
                    <tr>
                        <th scope="col" class="text-center text-white">Region</th>
                        <th scope="col" class="text-center text-white">City</th>
                        <th scope="col" class="text-center text-white" width="13%">Action</th>
                    </tr>`
                modalFields =`
                    <div class="form-group">
                        <h5>Region</h5>
                            <div class="row">
                                <div class="controls col-lg-8 col-sm-8" style="float:left;">
                                    <select id="regions-select" class="form-control" required>
                                        <option value="-1" selected="" disabled="">Select Region</option>
                                        ${regionOptions}
                                    </select>
                                    @error('region_id')
                                    <span id ="invalidInput" class="text-danger">{{ $message}}</span>
                                    @enderror
                                </div>
                            </div>
                    </div>
                    <div class="form-group">
                        <h5>City Name</h5>
                        <div class="controls">
                            <input id="city-name" type="text" name="region_name" class="form-control" value="">
                            @error('city_name')
                            <span id="invalidInput" class="text-danger" name="coupon_name" value="{{$message}}">{{ $message}}</span>
                            @enderror
                        </div>
                    </div>` 
                loadCities();
            break;

            case 2:
                $('#tbody').html('');
                document.getElementById("modal-title").innerHTML = "Add New Barangay";
                $('#nav_region').removeClass('active');
                $('#nav_city').removeClass('active');
                $('#nav_barangay').addClass('active');
                thead =`                    
                    <tr>
                        <th scope="col" class="text-center text-white">Region</th>
                        <th scope="col" class="text-center text-white">City</th>
                        <th scope="col" class="text-center text-white">Barangay</th>
                        <th scope="col" class="text-center text-white" width="13%">Action</th>
                    </tr>`
                modalFields =`
                    <div class ="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5>Region</h5>
                                <select id="regions-select" class="form-control" required onChange="updateCityOptions(this.value)">
                                    <option value="-1" selected="" disabled="">Select Region</option>
                                    ${regionOptions}
                                </select>
                                @error('region_id')
                                <span id ="invalidInput" class="text-danger">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5>City</h5>
                                <select id="city-select" class="form-control" required>
                                    <option value="-1" selected="" disabled="">Select City</option>
                                </select>
                                @error('city_id')
                                <span id ="invalidInput" class="text-danger">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <h5>Barangay Name</h5>
                        <div class="controls">
                            <input id="brgy-name" type="text" name="brgy_name" class="form-control" value="">
                            @error('brgy_name')
                            <span id="invalidInput" class="text-danger" name="coupon_name" value="{{$message}}">{{ $message}}</span>
                            @enderror
                        </div>
                    </div>` 
                loadBrgy();
            break;

            default:
                index = 0;
        }

        $('#thead').html(thead);
        $('#modalBody').html(modalFields);
    }// end method
        
    function loadRegions(){
        $.ajax({
            type: 'GET',
            url: '/zone/regions',
            dataType:'json',
            success:function(data){
                var tbody = "";
                regionOptions = "";

                $.each(data.regions, function(key,value){
                    tbody +=`                                            
                    <tr>
                        <td class="text-center"> ${value.region_name}</td>
                        <td> 
                            <div class="row" style="width:90%;">
                                <div class="col-sm-6">
                                    <a type="button" class="text-info" style="font-size: 24px; margin:0 5%;" data-toggle="modal" 
                                        data-target="#modal-center" onClick="editRegion(${value.id},'${value.region_name}')">
                                        <i class="ti-pencil modif-icon"></i>
                                    </a>
                                </div>
                                <div class="col-sm-6">
                                    <a type="button" class="text-danger" style="font-size: 24px; margin:0 5%;" 
                                        onClick="deleteRegion(${value.id})">
                                        <i class="mdi mdi-close-circle-outline modif-icon"></i>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>`

                    
                    regionOptions +=`
                    <option value="${value.id}">
                        ${value.region_name}</option>`
                });

                $('#tbody').html(tbody);
            }
        });
    }// end method

    function loadCities(){
        $.ajax({
            type: 'GET',
            url: '/zone/regions/cities',
            dataType:'json',
            success:function(data){
                var tbody ="";
                $.each(data.cities, function(key,value){
                    tbody +=`                                            
                    <tr>
                        <td class="text-center"> ${value.region_name}</td>
                        <td class="text-center"> ${value.city_name}</td>
                        <td class="text-center"> 
                            <div class="row" style="width:90%;">
                                <div class="col-sm-6">
                                    <a type="button" class="text-info" style="font-size: 24px; margin:0 5%;" data-toggle="modal" 
                                        data-target="#modal-center" onClick="editCity(${value.city_id},${value.region_id},'${value.city_name}')">
                                        <i class="ti-pencil modif-icon"></i>
                                    </a>
                                </div>
                                <div class="col-sm-6">
                                    <a type="button" class="text-danger" style="font-size: 24px; margin:0 5%;" 
                                        onClick="deleteCity(${value.city_id})">
                                        <i class="mdi mdi-close-circle-outline modif-icon"></i>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>`
                });
                $('#tbody').html(tbody);
            }
        });
    }// end method

    function loadBrgy(){
        $.ajax({
            type: 'GET',
            url: '/zone/regions/cities/brgy',
            dataType:'json',
            success:function(data){
                var tbody ="";
                $.each(data.brgy, function(key,value){
                    tbody +=`                                            
                    <tr>
                        <td class="text-center"> ${value.region_name}</td>
                        <td class="text-center"> ${value.city_name}</td>
                        <td class="text-center"> ${value.brgy_name}</td>
                        <td class="text-center"> 
                            <div class="row" style="width:90%;">
                                <div class="col-sm-6">
                                    <a type="button" class="text-info" style="font-size: 24px; margin:0 5%;" data-toggle="modal" 
                                        data-target="#modal-center" onClick="editBrgy(${value.brgy_id},${value.region_id},${value.city_id},'${value.brgy_name}')">
                                        <i class="ti-pencil modif-icon"></i>
                                    </a>
                                </div>
                                <div class="col-sm-6">
                                    <a type="button" class="text-danger" style="font-size: 24px; margin:0 5%;" 
                                        onClick="deleteBrgy(${value.brgy_id})">
                                        <i class="mdi mdi-close-circle-outline modif-icon"></i>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>`
                });
                $('#tbody').html(tbody);
            }
        });
    }// end method

    function editRegion(id,name){
        submitMode = 1;
        $('#modal-id').val(id);
        $('#region-name').val(name);
    }// end method

    function editCity(id,regionId,name){
        submitMode = 1;
        $('#modal-id').val(id); 
        $('#regions-select').val(regionId);
        $('#city-name').val(name);
    }// end method

    function editBrgy(id,regionId,cityId,name){
        submitMode = 1;
        updateCityOptions(regionId);
        $('#modal-id').val(id);  
        $('#regions-select').val(regionId);
        $('#city-select').val(cityId);
        $('#brgy-name').val(name);
    }// end method

    function deleteRegion(id){
        var url = "/zone/regions/remove/"+id;
        deleteArea(url);
    }// end method

    function deleteCity(id){
        var url = "/zone/regions/cities/remove/"+id;
        deleteArea(url);
    }// end method


    function deleteBrgy(id){
        var url = "/zone/regions/cities/brgy/remove/"+id;
        deleteArea(url);
    }// end method

    function submitBtn(e){
        var submitData;
        var  submitUrl ="";
        var me =$(this);
        e.preventDefault();

        if( me.data('requestRunning')){
            return;
        }

        me.data('requestRunning', true);

        if(submitMode == 0){
            switch(tabIndex){
                case 0:
                    submitData = jQuery.parseJSON('{ "region_name" : "'+ $('#region-name').val() +'"}')
                    submitUrl = "/zone/regions/store"
                break;
                case 1:
                    submitData = jQuery.parseJSON('{ "region_id" : "'+ $('#regions-select').val() +'",  "city_name" : "'+ $('#city-name').val() +'"}')
                    submitUrl = "/zone/regions/cities/store"
                break;
                case 2:
                    submitData = jQuery.parseJSON('{ "region_id" : "'+ $('#regions-select').val() +'",  "city_id" : "'+ $('#city-select').val() +'", "brgy_name" : "'+ $('#brgy-name').val() +'"}')
                    submitUrl = "/zone/regions/cities/brgy/store"
                break; 
            }
        }

        if(submitMode == 1){
            switch(tabIndex){
                case 0:
                    submitData = jQuery.parseJSON('{ "region_name" : "'+ $('#region-name').val() +'"}')
                    submitUrl = "/zone/regions/update/"+ $('#modal-id').val();
                break;
                case 1:
                    submitData = jQuery.parseJSON('{ "region_id" : "'+ $('#regions-select').val() +'",  "city_name" : "'+ $('#city-name').val() +'"}')
                    submitUrl = "/zone/regions/cities/update/"+ $('#modal-id').val();
                break;
                case 2:
                    submitData = jQuery.parseJSON('{ "region_id" : "'+ $('#regions-select').val() +'",  "city_id" : "'+ $('#city-select').val() +'", "brgy_name" : "'+ $('#brgy-name').val() +'"}')
                    submitUrl = "/zone/regions/cities/brgy/update/"+ $('#modal-id').val();
                break; 
            }
        }

        $.ajax({
            type: 'POST',
            url: submitUrl,
            dataType:'json',
            data: submitData,
            success:function(data){
                fireToast(data);
                $('#closeBtn').click();
                updateTables();
            },
            complete: function(){
                me.data('requestRunning', false);
            }
        });
    }

    function deleteArea(url){
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
                        url: url,
                        dataType:'json',
                        success:function(data){
                            fireToast(data);
                            updateTables();
                        }
                    });//end ajax
                }//endif
            }); 
    }// end method

    function updateTables(){
        if(tabIndex == 0){
            $('#region-name').val('');
            loadRegions();
        }
        if(tabIndex == 1){
            $('#regions-select').val('');
            $('#city-name').val('');
            loadCities();
        }
        if(tabIndex == 2){
            $('#regions-select').val('');
            $('#city-select').val('');
            $('#brgy-name').val('');
            loadBrgy();
        }
    }// end method
    
    function updateCityOptions(regionId){
        var cityOptions ="";
        $.ajax({
            type: 'GET',
            url: '/zone/regions/cities/get/'+regionId,
            dataType:'json',
            success:function(data){
                var foo = 'selected'
                var cnt = 0;
                $.each(data.cities, function(key,value){
                    cityOptions +=`
                    <option value="${value.city_id}" ${foo}>
                        ${value.city_name}</option>
                    `
                    foo ='';
                    cnt++;
                });
                if(cnt == 0){
                    $('#city-select').val(-1);
                    
                }

                $('#city-select').empty();
                $('#city-select').append(cityOptions);
            }
        });
    }// end method

    function addBtn(){
        submitMode = 0;

    }// end method

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

    tabChange(0);
    loadRegions();
</script>

</div>
@endsection