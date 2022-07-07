function search_stock_in_info() {

    $.ajax({
        type: "POST",
        url: base_url + "/search_product_stock_in_report",
        data: $('#product_stock_in_form').serialize(),
        // 'dataType': 'json',
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
function search_stock_out_info() {

    $.ajax({
        type: "POST",
        url: base_url + "/search_product_stock_out_report",
        data: $('#product_stock_out_form').serialize(),
        // 'dataType': 'json',
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

function getSubCategoryInfo(category_id, selected = '') {
    $.ajax({
        type: "GET",
        url: base_url + "/getSubCategoryInfo",
        data: {parent_id: category_id},
        'dataType': 'json',
        success: function (response) {

            $("#sub_ctg_id").html('');
            var options = "<option value=''> Select</option>";
            response.forEach(function(item , index){
                options += "<option value='"+item.id+"'>"+item.title +"</option>";
            });
            $("#sub_ctg_id").html(options);

            $("#sub_ctg_id").val(selected);
            
            // if($("#onurup_ids")) {
            //     $("#onurup_ids").html(options);
            // }

        }
    });
}

