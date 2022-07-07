
$("#land_data").DataTable({
    "processing": true,
    "serverSide": true,
    "dataType": 'json',
    "ajax": "all_land_info_ajax",
    "columns":[
        { "data": "land_no"},
        { "data": "location"},
        { "data": "details" },
        { "data": "khotian_no" },
        { "data": "dag_no" },
        { "data": "mouza_no" },
        { "data": "land_quantity" },
        { "data": "last_date_tax" },
        { "data": 'is_active'},
        { "data": "action", orderable:false, searchable: false}
    ],
    responsive: true
});

function addLandInfo() {
    $("#land_info_form")[0].reset();
    $("#saveBtn").show();
    $("#updateBtn").hide();
    $("#case_info").hide();
    $("#heading-title").html('Add New Land Information ');
}
function updateLandInfo(land_id) {
    $("#land_info_form")[0].reset();
    $("#saveBtn").hide();
    $("#updateBtn").show();

    $("#land_id").val(land_id);
    $("#heading-title").html('Update Land Information ');
    $.ajax({
        type: "POST",
        url: base_url + "/get_signle_land_info",
        data: {land_id:land_id},
        'dataType': 'json',
        success: function (response) {
           if(response.status=='success'){
               var data=response.data;
               $("#land_no").val(data.land_no);
               $("#station_name").val(data.station_id);
               $("#address").val(data.location);
               $("#details").val(data.details);
               $("#kotian_no").val(data.khotian_no);
               $("#dag_no").val(data.dag_no);
               $("#mouza").val(data.mouza_no);
               $("#zer_no").val(data.zer_no);
               $("#land_tax_pay_dt").val(data.last_date_tax);
               $("#land_qty").val(data.land_quantity);
               $("#is_case").val(data.is_found_case);
               if(data.is_found_case==1){
                   $("#case_info").hide();
               }else{
                   $("#case_info").show();
               }
               $("#case_details").val(data.case_details);
               $("#case_last_update").val(data.case_last_update);
               $("#case_status").val(data.case_status);
           }else{
               $("#exampleModal").toggle();
           }
        }
    });
}



$( "#product_ctg" ).change(function() {
    var product_id=$(this).val();
    $.ajax({
        type: "POST",
        url: base_url + "/get_all_product_sub_ctg",
        data: {product_id:product_id},
        'dataType': 'json',
        success: function (response) {
            if(response.status=='success'){
                var data=response.data;
                var options =  '<option value="">Select Sub Category</option>';
                $(data).each(function(index, value){
                    options += '<option value="'+value.id+'">'+value.title+'</option>';
                });
                $('#sub_ctg_id').html(options);
            }else{
                $('#sub_ctg_id').html('<option value="">Select Sub Category</option>');
            }
        }
    });
});
$( "#is_case" ).change(function() {
    var is_case_val=$(this).val();
    if(is_case_val==1){
        $("#case_info").hide();
    }else{
        $("#case_info").show();
    }
});
$( "#life_time" ).change(function() {
    var lifeTime=$(this).val();
    if(lifeTime=='N/A'){
        $("#life_time_count").val('');
        $("#life_time_count").attr('readonly',true);

    }else{
        $("#life_time_count").attr('readonly',false);
    }
});
$( "#warranty" ).change(function() {
    var warranty=$(this).val();
    if(warranty=='N/A'){
        $("#warranty_count").val('');
        $("#warranty_count").attr('readonly',true);

    }else{
        $("#warranty_count").attr('readonly',false);
    }
});

function searchAutoComplete(data) {
    if ( data.value.trim() == '') {
        $('#product_id_search').val('');
        return false;
    }
    var options = {
        minLength: 1,
        source: function (request, response) {
            $.ajax({
                url: base_url + "/searching_product_info",
                method: 'post',
                dataType: "json",
                autoFocus:true,
                data: {
                    term: request.term,
                },
                success: function (data) {
                    response(data);
                }
            });
        },
        select: function (event, ui) {
            $('#product_name_search').val(ui.item.value);
            $('#product_id_search').val(ui.item.id);

            return false;
        }
    };
    $('body').on('keydown.autocomplete', '#product_name_search', function() {
        $(this).autocomplete(options);
    });
}









function addProuctInfo() {
    $("#product_info_form")[0].reset();
    $("#saveBtn").show();
    $("#updateBtn").hide();
    $("#heading-title").html('Add New Product Information ');
}

function UpdateProductInfo(product_id) {
    $("#product_info_form")[0].reset();
    $("#saveBtn").hide();
    $("#updateBtn").show();
    $("#heading-title").html('Update Product Information ');
    $.ajax({
        type: "POST",
        url: base_url + "/get_signle_product_info",
        data: {product_id:product_id},
        'dataType': 'json',
        success: function (response) {
            if(response.status=='success'){
                var data=response.data;
                $("#product_code").val(data.product_code);
                $("#product_ctg").val(data.ctg_id);
                $("#product_name").val(data.name);
                $("#product_unit").val(data.unit_id);
                $("#is_active").val(data.is_active);
                $("#setting_id").val(data.id);
                if(data.sub_ctg_info!=''){
                    var sub_ctg_data=data.sub_ctg_info;
                    var options =  '<option value="">Select Sub Category</option>';
                    $(sub_ctg_data).each(function(index, value){
                        options += '<option value="'+value.id+'">'+value.title+'</option>';
                    });
                    $('#sub_ctg_id').html(options);
                    $("#sub_ctg_id").val(data.sub_ctg_id);
                }else{
                    $('#sub_ctg_id').html('<option value="">Select Sub Category</option>');
                }
            }else{
                $("#exampleModal").toggle();
            }
        }
    });
}






function saveLandInfo() {
    swal({
        title: "Are you sure?",
        text: "Once Save, You will saved this record",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "POST",
                url: base_url + "/save_land_info",
                data: $('#land_info_form').serialize(),
                'dataType': 'json',
                success: function (data) {
                    if (data.error.length > 0) {
                        var error_html = '';
                        for (var count = 0; count < data.error.length; count++) {
                            error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                        }
                        $('#error_land_info').html(error_html);
                    } else {
                        $('#land_info_form')[0].reset();
                        $('#error_land_info').html('');

                        swal({
                            text: data.success,
                            icon: "success",
                        }).then(function () {
                            window.location = base_url + '/' + data.redirect_page;
                        });
                    }
                }
            });
        } else {
            swal("Cancelled Now!");
        }
    });
}

function saveProductInfo() {
    swal({
        title: "Are you sure?",
        text: "Once Save, You will saved this record",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "POST",
                url: base_url + "/save_product_info",
                data: $('#product_info_form').serialize(),
                'dataType': 'json',
                success: function (data) {
                    if (data.error.length > 0) {
                        var error_html = '';
                        for (var count = 0; count < data.error.length; count++) {
                            error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                        }
                        $('#error_product_info').html(error_html);
                    } else {
                        $('#product_info_form')[0].reset();
                        $('#error_product_info').html('');

                        swal({
                            text: data.success,
                            icon: "success",
                        }).then(function () {
                            window.location = base_url + '/' + data.redirect_page;
                        });
                    }
                }
            });
        } else {
            swal("Cancelled Now!");
        }
    });
}
function saveProductStock() {
    swal({
        title: "Are you sure?",
        text: "Once Save, You will saved this record",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "POST",
                url: base_url + "/save_product_stock",
                data: $('#stock_info_form').serialize(),
                'dataType': 'json',
                success: function (data) {
                    if (data.error.length > 0) {
                        var error_html = '';
                        for (var count = 0; count < data.error.length; count++) {
                            error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                        }
                        $('#error_product_stock_info').html(error_html);
                    } else {
                        $('#stock_info_form')[0].reset();
                        $('#error_product_stock_info').html('');

                        swal({
                            text: data.success,
                            icon: "success",
                        }).then(function () {
                            window.location = base_url + '/' + data.redirect_page;
                        });
                    }
                }
            });
        } else {
            swal("Cancelled Now!");
        }
    });
}

// stock information
function addProuctStockInfo() {
    $("#stock_info_form")[0].reset();
    $("#SaveUpdateBtn").html('Save');
    $("#maintenance_details").hide();
    $("#heading-title").html('Add New Stock Information ');
    $('#error_product_stock_info').html('');
}
$( "#is_maintenance" ).change(function() {
    var maintenance=$(this).val();
    if(maintenance==1){
        $("#maintenance_details").hide();
    }else{
        $("#maintenance_details").show();
    }
});
function updateProuctStockInfo(stock_id) {
    $("#stock_info_form")[0].reset();
    $("#SaveUpdateBtn").html('Update');
    $("#maintenance_details").hide();
    $("#heading-title").html('Update Stock Information ');
    $('#error_product_stock_info').html('');
    $.ajax({
        type: "POST",
        url: base_url + "/get_signle_product_stock_info",
        data: {stock_id:stock_id},
        'dataType': 'json',
        success: function (response) {

            if(response.status=='success'){
                var data=response.data;
                $("#reference").val(data.product_reference);
                $("#station_name").val(data.station_id);
                $("#product_id_search").val(data.product_id);
                $("#product_name_search").val(data.product_info);
                $("#room_no").val(data.room_no);
                $("#purchase_date").val(data.purchase_date);

                $("#warranty_count").val(data.warranty_count);
                $("#warranty").val(data.warranty_Info);

                $("#life_time_count").val(data.lifetime_count);
                $("#life_time").val(data.product_life_time_info);
                $("#is_maintenance").val(data.is_maintance);
                $("#maintenance_details_data").val(data.maintance_details);
                $("#product_user").val(data.product_user_info);
                $("#setting_id").val(data.id);

                var maintenance=data.is_maintance;
                if(maintenance==1){
                    $("#maintenance_details").hide();
                }else{
                    $("#maintenance_details").show();
                }

            }else{
                $("#exampleModal").toggle();
            }
        }
    });
}
function StockOutConfirm(stock_id) {
    $("#stock_out_info")[0].reset();
    $("#stockOutBtn").html('Update');

    $("#heading-title-stock-out").html('Stock Out Information ');
    $('#error_product_stock_out').html('');
    $('#setting_stock_id').val(stock_id);
    $.ajax({
        type: "POST",
        url: base_url + "/get_signle_product_stock_info",
        data: {stock_id:stock_id},
        'dataType': 'json',
        success: function (response) {

            if(response.status=='success'){
                var data=response.data;

                $("#stock_code").val(data.stock_code);
                $("#reference_stock_out").val(data.product_reference);
                $("#station_name_stock_out").val(data.station_id);
                $("#product_name_stock_out").val(data.product_info);
                $("#purchase_date_stock_out").val(data.purchase_date);
                $("#product_user_stock_out").val(data.product_user_info);
                $("#stock_out_reason").val('');

            }else{
                $("#stockOutModal").toggle();
            }
        }
    });

}
function ProductStockOut() {
    swal({
        title: "Are you sure?",
        text: "Once Save, You will saved this record",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/product_stock_out",
                    data: $('#stock_out_info').serialize(),
                    'dataType': 'json',
                    success: function (data) {
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#error_product_stock_out').html(error_html);
                        } else {
                            $('#stock_out_info')[0].reset();
                            $('#error_product_stock_out').html('');

                            swal({
                                text: data.success,
                                icon: "success",
                            }).then(function () {
                                window.location = base_url + '/' + data.redirect_page;
                            });
                        }
                    }
                });
            } else {
                swal("Cancelled Now!");
            }
        });
}

$("#product_stock_data").DataTable({
    "processing": true,
    "serverSide": true,
    "dataType": 'json',
    "ajax": "all_product_stock_info_ajax",
    "columns":[
        { "data": "stock_code"},
        { "data": "station_name"},
        { "data": "product_name" },
        { "data": "product_reference" },
        { "data": "room_no" },
        { "data": "purchase_date_show" },
        { "data": "warranty_info_show" },
        { "data": "life_time_info_show" },
        { "data": 'maintainance_info_show'},
        { "data": "action", orderable:false, searchable: false}
    ],
    responsive: true
});


// land report

function land_information_search() {
    $.ajax({
        type: "POST",
        url: base_url + "/search_land_information_report",
        data: $('#land_info_report_form').serialize(),
        success: function (response) {
            if (response.status=='error') {
                var error='<div class="alert alert-danger">' + response.message + '</div>'
                $('#error_data').html(error);
                $('#show_report_info').html('');
            } else {
                $('#error_data').html('');
                $('#show_report_info').html(response);

            }
        }
    });
}


