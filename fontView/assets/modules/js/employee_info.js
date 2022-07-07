$('.onlyNumber').on('keydown', function (evt) {
    var key = evt.charCode || evt.keyCode || 0;

    return (key == 8 ||
        key == 9 ||
        key == 46 ||
        // key == 110 ||
        // key == 190 ||
        (key >= 35 && key <= 40) ||
        (key >= 48 && key <= 57) ||
        (key >= 96 && key <= 105));
});

function elementId(id_arr) {
    var id = id_arr.split("_");
    return id[id.length - 1];
}

// for active tab

$(document).ready(function () {
    $('.datepickerinfo').datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
    }).val();

    $('.datepickerLong').datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
    }).val();
    $('.datepicker').datepicker({
        dateFormat: 'dd-mm-yy',

    }).val();

    if (location.hash) {
        $("a[href='" + location.hash + "']").tab("show");
    }
    $(document.body).on("click", "a[data-toggle]", function (event) {
        location.hash = this.getAttribute("href");
    });


    var physical_disability_val = $("#physical_disability").val();
    if (typeof physical_disability_val !== "undefined") {
        if (physical_disability_val == 1) {
            $("#disability_yes_details").attr('readonly', true);
        } else {
            $("#disability_yes_details").attr('readonly', false);
        }
    }

    var isCheckedBCS = $('#checkedBcsCadre').attr('checked');
    if (isCheckedBCS == 'checked') {
        $(".show_bcs_cadre").show();
    } else {
        $(".show_bcs_cadre").hide();
    }
    var isCheckedSameAddress = $('#save_present_parmanent_address').attr('checked');
    if (isCheckedSameAddress == 'checked') {
        $(".same_present_address").attr('disabled', true);
    } else {
        $(".same_present_address").attr('disabled', false);
    }






    // $.ajax({
    //     type: "POST",
    //     url: base_url + "/get_employee_info",
    //     data: {employee_id:employee_id},
    //     'dataType': 'json',
    //     success: function (response) {
    //         if (response.status=='error') {
    //             $('#form_output_salary_assign').html(response.message);
    //         } else {
    //             all_data=response.data;
    //         }
    //     }
    // });


    // var ext = $('#application_hard_copy').val().split('.').pop().toLowerCase();
    // if($.inArray(ext, ['png']) == -1) {
    //     alert('invalid extension!');
    // }

});


$(window).on("popstate", function () {
    var anchor = location.hash || $("a[data-toggle='tab']").first().attr("href");
    $("a[href='" + anchor + "']").tab("show");
});

function addEmployee() {
    $("#employee_info_id")[0].reset();
    $("#form_output").html('');
    $("#disability_yes_details").attr('readonly', true);
    $(".same_present_address").attr('disabled', false);
    $("#saveBtn").show();
    $("#updateBtn").hide();
    $("#heading-title").html('Add new employee information ');
}

function deleteEmployeeConfirm(id) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, You will not be able to recover this record",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/delete_employee_info",
                    data: {id: id},
                    'dataType': 'json',
                    success: function (response) {
                        if (response.status == 'success') {
                            swal({
                                text: response.message,
                                icon: "success",
                            }).then(function () {
                                location.reload();
                            });

                        } else {
                            swal(response.message, {
                                icon: "warning",
                            });
                        }
                    }
                });
            }
        });
}


function salaryAssign(employee_id) {
    $("#employee_salary_assign_form")[0].reset();
    $("#form_output_salary_assign").html('');
    $("#saveBtn").show();
    $("#updateBtn").hide();
    $("#heading-title-salary-assign").html('Add Employee Salary Assign ');
    $.ajax({
        type: "POST",
        url: base_url + "/get_employee_info",
        data: {employee_id: employee_id},
        'dataType': 'json',
        success: function (response) {
            if (response.status == 'error') {
                $('#form_output_salary_assign').html(response.message);
            } else {
                var data = response.data;
                $("#station_name").html(data.station_name);
                $("#employee_id_show").html(data.employee_id);
                $("#employee_id").val(data.employee_id);
                $("#employee_name").html(data.emp_name);
                $("#mobile").html(data.mobile);
                $("#department").html(data.department_title);
                $("#designaion").html(data.designation_title);
                $("#emp_basic_salary").val(data.basic_salary);
                $("#emp_pay_scal").val(data.pay_scal);
                $("#is_salary_assign").val('add');


                var default_earning = response.default_earning;
                var default_deduction = response.default_deduction;
                var not_default_earning = response.default_not_earning;

                var table = '<table class="mainTable table table-bordered" style="width:100%;"><tr><th colspan="3">Earning Category Information</th></tr><tr><th style="width: 200px">Category</th><th>Percentage(%)</th><th>Amount</th><th>Action</th></tr>';
                $.each(default_earning, function (key, value) {

                    table += ('<tr>');
                    table += ('<th><input type="hidden" value="' + key + '" id="earning_ctg_' + key + '"   class="form-control"  value="0"  name="earning_ctg[]"/>' + value + '</th>');
                    if (key != 16) {
                        table += ('<td><input type="text" id="earning_ctg_per_' + key + '"   class="form-control earning_ctg_percentage onlyNumber" placeholder="Percentages(%)" value="0"  name="earning_ctg_per[]"/></td>');
                    } else {
                        table += ('<td>- <input type="hidden" id="earning_ctg_per_' + key + '"   class="form-control" placeholder="Percentages(%)" value="0"  name="earning_ctg_per[]"/></td>');
                    }
                    table += ('<td><input type="text" id="earning_ctg_amount_' + key + '"   class="form-control ctg_earning_amnt onlyNumber" placeholder="Amount"  value="0.00" name="earning_ctg_amount[]"/></td>');
                    table += ('<th></th></tr>');

                });
                table += '<tbody id="addEarningTr"></tbody>';
                table += ('<tr><td><button type="button" id="add_earning" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-plus"></i>Add </button> </td><th class="text-right">Total Earning Amount</th><td><input type="text" id="net_total_amount_earning"   class="form-control onlyNumber" value="0.00" placeholder="Total Earning Amount"  name="net_total_amount_earning"/></td><td></td></tr>');
                table += '</table>';
                $('#show_earning_ctg').html(table);
                $("#earning_ctg_amount_16").val(data.basic_salary);

                // Earning calculation  end
                // todo Deduction calculation  start

                var table_deduction = '<table class="mainTable table table-bordered" style="width:100%;"><tr><th colspan="3">Deduction Category Information</th></tr><tr><th>Category</th><th>Percentage(%)</th><th>Amount</th><td>Action</td></tr>';
                $.each(default_deduction, function (key, value) {
                    table_deduction += ('<tr>');
                    table_deduction += ('<th><input type="hidden" value="' + key + '" id="deduction_ctg_' + key + '"   class="form-control"  value="0"  name="deduction_ctg[]"/>' + value + '</th>');
                    table_deduction += ('<td><input type="text" id="deduction_ctg_per_' + key + '"   class="form-control deduction_ctg_percentage onlyNumber" placeholder="Percentages(%)" value="0"  name="deduction_ctg_per[]"/></td>');

                    table_deduction += ('<td><input type="text"  id="deduction_ctg_amount_' + key + '"   class="form-control ctg_deduction_amnt onlyNumber" placeholder="Amount"  value="0.00" name="deduction_ctg_amount[]"/></td>');
                    table_deduction += ('<td></td></tr>');

                });
                table_deduction += '<tbody id="addDeductionTr"></tbody>';
                table_deduction += ('<tr><td><button type="button" id="add_deduction" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-plus"></i>Add </button> </td><th class="text-right">Total Deduction Amount</th><td><input type="text" id="net_total_amount_deduction"   class="form-control onlyNumber" value="0.00" placeholder="Total deduction Amount"  name="net_total_amount_deduction"/></td><td></td></tr>');
                table_deduction += '</table>';
                $('#show_deduction_ctg').html(table_deduction);


                $('#form_output_salary_assign').html('');

            }
        }
    });
}




function salaryAssignUpdate(employee_id) {
    $("#employee_salary_assign_form")[0].reset();
    $("#form_output_salary_assign").html('');
    $("#saveBtn").hide();
    $("#updateBtn").show();
    $("#heading-title-salary-assign").html('Update Employee Salary Assign ');
    $.ajax({
        type: "POST",
        url: base_url + "/get_employee_info",
        data: {employee_id: employee_id},
        'dataType': 'json',
        success: function (response) {
            if (response.status == 'error') {
                $('#form_output_salary_assign').html(response.message);
            } else {
                var data = response.data;
                $("#station_name").html(data.station_name);
                $("#employee_id_show").html(data.employee_id);
                $("#employee_id").val(data.employee_id);
                $("#employee_name").html(data.emp_name);
                $("#mobile").html(data.mobile);
                $("#department").html(data.department_title);
                $("#designaion").html(data.designation_title);
                $("#emp_basic_salary").val(data.basic_salary);
                $("#emp_pay_scal").val(data.pay_scal);
                $("#is_salary_assign").val('update');

                var default_earning = response.default_earning;
                var all_earning_ctg = response.all_earning_ctg;

                var default_deduction = response.default_deduction;
                var all_deduction_ctg = response.all_deduction_ctg;

                // var not_default_earning=response.default_not_earning;
                var earning_info = JSON.parse(data.payrole_earning_info);
                var deduction_info = JSON.parse(data.payrole_deduction_info);

                if (earning_info.length > 0) {
                    var row_total_earning = 0;
                    var table = '<table class="mainTable table table-bordered" style="width:100%;"><tr><th colspan="3">Earning Category Information</th></tr><tr><th>Category</th><th>Percentage(%)</th><th>Amount</th><th>Action</th></tr>';
                    $.each(earning_info, function (key, value) {
                        table += ('<tr>');
                        table += ('<th>' + all_earning_ctg[value.earning_ctg] + '<input type="hidden" value="' + value.earning_ctg + '" id="earning_ctg_' + value.earning_ctg + '"   class="form-control"  value="0"  name="earning_ctg[]"/></th>');
                        if (value.earning_ctg != 16) {
                            table += ('<td><input type="text" id="earning_ctg_per_' + value.earning_ctg + '"   class="form-control earning_ctg_percentage onlyNumber" placeholder="Percentages(%)" value="' + value.earning_ctg_per + '"  name="earning_ctg_per[]"/></td>');
                        } else {
                            table += ('<td>- <input type="hidden" id="earning_ctg_per_' + key + '"   class="form-control" placeholder="Percentages(%)" value="' + value.earning_ctg_per + '"  name="earning_ctg_per[]"/></td>');
                        }
                        table += ('<td><input type="text" id="earning_ctg_amount_' + key + '"   class="form-control ctg_earning_amnt onlyNumber" placeholder="Amount"  value="' + value.earning_ctg_amount + '" name="earning_ctg_amount[]"/></td>');
                        table += ('<td><a href="javascript:void(0);"  id="deleteRow_' + value.earning_ctg_per + '"  class="deleteRow btn btn-warning btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i> </a></td></tr>');
                        row_total_earning += parseFloat(value.earning_ctg_amount);

                    });
                    table += '<tbody id="addEarningTr"></tbody>';
                    table += ('<tr><td><button type="button" id="add_earning" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-plus"></i>Add </button> </td><th class="text-right">Total Earning Amount</th><td><input type="text" id="net_total_amount_earning"   class="form-control onlyNumber" value="' + (row_total_earning).toFixed(2) + '"  placeholder="Total Earning Amount"  name="net_total_amount_earning"/></td></td><td></tr>');
                    table += '</table>';
                    $('#show_earning_ctg').html(table);
                    $("#earning_ctg_amount_16").val(data.basic_salary);
                }

                // Earning calculation  end
                // todo Deduction calculation  start
                if (deduction_info.length > 0) {
                    var row_total_deduction = 0;
                    var table_deduction = '<table class="mainTable table table-bordered" style="width:100%;"><tr><th colspan="3">Deduction Category Information</th></tr><tr><th>Category</th><th>Percentage(%)</th><th>Amount</th><th>Action</th></tr>';
                    $.each(deduction_info, function (key, value) {
                        table_deduction += ('<tr>');
                        table_deduction += ('<th><input type="hidden" value="' + value.deduction_ctg + '" id="deduction_ctg_' + value.deduction_ctg + '"   class="form-control"  value="0"  name="deduction_ctg[]"/>' + all_deduction_ctg[value.deduction_ctg] + '</th>');
                        table_deduction += ('<td><input type="text" id="deduction_ctg_per_' + value.deduction_ctg + '"   class="form-control deduction_ctg_percentage onlyNumber" placeholder="Percentages(%)" value="' + value.deduction_ctg_per + '"   name="deduction_ctg_per[]"/></td>');

                        table_deduction += ('<td><input type="text"  id="deduction_ctg_amount_' + value.deduction_ctg + '"   class="form-control ctg_deduction_amnt onlyNumber" placeholder="Amount"  value="' + value.deduction_ctg_amount + '" name="deduction_ctg_amount[]"/></td>');
                        table_deduction += ('<td><a href="javascript:void(0);"  id="deleteRow_' + value.deduction_ctg + '"  class="deleteRow btn btn-warning btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i> </a></td></tr>');
                        row_total_deduction += parseFloat(value.deduction_ctg_amount);
                    });
                    table_deduction += '<tbody id="addDeductionTr"></tbody>';

                    table_deduction += ('<tr><td><button type="button" id="add_deduction" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-plus"></i>Add </button> </td><th class="text-right">Total Deduction Amount</th><td><input type="text" id="net_total_amount_deduction"   class="form-control onlyNumber" value="' + (row_total_deduction).toFixed(2) + '" placeholder="Total deduction Amount"  name="net_total_amount_deduction"/></td><td></td></tr>');
                    table_deduction += '</table>';
                    $('#show_deduction_ctg').html(table_deduction);


                    $('#form_output_salary_assign').html('');

                }
            }
        }
    });
}


/*-------------------------Earning information appended-----------------------------------*/
var te = parseFloat($('#addEarningTr').size()) + 1;
$(document).on("click", "#add_earning", function (e) {
    $('<tr><td><select name="earning_ctg[]" id="earning_ctg_' + te + '" class="form-control"></select></td><td><input type="text" id="earning_ctg_per_' + te + '" name="earning_ctg_per[]" placeholder="Percentages(%)" value="0" class="earning_ctg_percentage onlyNumber form-control"> </td><td><input type="text" name="earning_ctg_amount[]" value="0.00"  id="earning_ctg_amount_' + te + '" placeholder="Amount" class="form-control ctg_earning_amnt" id="earning_ctg_amount_' + te + '"></td><td><a href="javascript:void(0);"  id="deleteRow_' + te + '"  class="deleteRow btn btn-warning btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i> </a></td></tr>').appendTo($('#addEarningTr'));
    var abs_earning = te;
    $("#earning_ctg_" + te).html("<option value=''>Select</option>");
    $.ajax({
        type: "POST",
        url: base_url + "/get_all_data",
        data: {searching_type: 'not_default_earning_ctg'},
        'dataType': 'json',
        success: function (response) {
            if (response.status == 'error') {
                $("#earning_ctg_" + te).html("<option value=''>Select</option>");
            } else {
                var earning_info = "<option value=''>Select</option>";
                $.each(response.data.default_not_earning, function (key, value) {
                    earning_info += ('<option value="' + key + '">');
                    earning_info += value;
                    earning_info += ('</option>');
                });
                $("#earning_ctg_" + abs_earning).html(earning_info);

            }
        }
    });

    te++;

    return false;
});

/*-------------------------Earning information appended end-----------------------------------*/

/*-------------------------deduction information appended start-----------------------------------*/
var deduct_id = parseFloat($('#addDeductionTr').size()) + 1;
$(document).on("click", "#add_deduction", function (e) {
    $('<tr><td><select name="deduction_ctg[]" id="deduction_ctg_' + deduct_id + '" class="form-control"></select></td><td><input type="text" id="deduction_ctg_per_' + deduct_id + '" name="deduction_ctg_per[]" placeholder="Percentages(%)" value="0" class="deduction_ctg_percentage onlyNumber form-control"> </td><td><input type="text" name="deduction_ctg_amount[]" value="0.00"   placeholder="Amount" class="form-control ctg_deduction_amnt" id="deduction_ctg_amount_' + deduct_id + '"></td><td><a href="javascript:void(0);"  id="deleteRow_' + deduct_id + '"  class="deleteRow btn btn-warning btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i> </a></td></tr>').appendTo($('#addDeductionTr'));
    var abs_deduct = deduct_id;
    $("#earning_ctg_" + abs_deduct).html("<option value=''>Select</option>");
    $.ajax({
        type: "POST",
        url: base_url + "/get_all_data",
        data: {searching_type: 'not_default_deduction_ctg'},
        'dataType': 'json',
        success: function (response) {
            if (response.status == 'error') {
                $("#earning_ctg_" + abs_deduct).html("<option value=''>Select</option>");
            } else {
                var deduct_info = "<option value=''>Select</option>";
                $.each(response.data.default_not_deduction, function (key, value) {
                    deduct_info += ('<option value="' + key + '">');
                    deduct_info += value;
                    deduct_info += ('</option>');
                });
                $("#deduction_ctg_" + abs_deduct).html(deduct_info);

            }
        }
    });

    deduct_id++;

    return false;
});


/*-------------------------deduction information appended end-----------------------------------*/

$(document).on("keyup", ".ctg_earning_amnt", function (e) {
    row_total_earning = 0;
    if ($(this).val() != '') {
        $(".ctg_earning_amnt").each(function () {
            row_total_earning += Number(parseFloat($(this).val()));
        });
        $("#net_total_amount_earning").val((Math.ceil(row_total_earning)).toFixed(2));
    }
});

$(document).on("keyup", ".earning_ctg_percentage", function (e) {
    var element_id = elementId($(this).attr('id'));
    var perc_amount = parseFloat($(this).val());
    if (isNaN(perc_amount)) {
        perc_amount = 0;
        $("#earning_ctg_per_" + element_id).val(0);
    }
    var emp_basic_salary = parseFloat($("#emp_basic_salary").val());
    var amount = (perc_amount / 100) * emp_basic_salary;
    $("#earning_ctg_amount_" + element_id).val(amount.toFixed(2));

});


$(document).on("keyup", ".ctg_deduction_amnt", function (e) {
    row_total_deduction = 0;
    if ($(this).val() != '') {
        $(".ctg_deduction_amnt").each(function () {
            row_total_deduction += Number(parseFloat($(this).val()));
        });
        $("#net_total_amount_deduction").val((Math.ceil(row_total_deduction)).toFixed(2));
    }
});

$(document).on("keyup", ".deduction_ctg_percentage", function (e) {
    var element_id = elementId($(this).attr('id'));
    var perc_amount = parseFloat($(this).val());
    if (isNaN(perc_amount)) {
        perc_amount = 0;
        $("#deduction_ctg_per_" + element_id).val(0);
    }
    var emp_basic_salary = parseFloat($("#emp_basic_salary").val());
    var amount = (perc_amount / 100) * emp_basic_salary;
    $("#deduction_ctg_amount_" + element_id).val(amount.toFixed(2));

});


function saveEmployeeSalaryAssign() {
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
                    url: base_url + "/save_salary_assign",
                    data: $('#employee_salary_assign_form').serialize(),
                    'dataType': 'json',
                    success: function (data) {
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#form_output').html(error_html);
                        } else {
                            $('#employee_salary_assign_form')[0].reset();
                            $('#form_output_assign').html('');

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


function saveEmployeeInfo() {
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
                    url: base_url + "/save_employee_info",
                    data: $('#employee_info_id').serialize(),
                    'dataType': 'json',
                    success: function (data) {
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#form_output').html(error_html);
                        } else {
                            $('#employee_info_id')[0].reset();
                            $('#form_output').html('');

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


function updateEmployeeInfo() {
    swal({
        title: "Are you sure?",
        text: "Once Update, You will saved this record",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/save_employee_info",
                    data: $('#employee_info_update_form').serialize(),
                    'dataType': 'json',
                    success: function (data) {
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#form_output').html(error_html);
                        } else {
                            $('#form_output').html('');

                            swal({
                                text: data.success,
                                icon: "success",
                            }).then(function () {
                                location.reload();
                            });
                        }
                    }
                });
            } else {
                swal("Cancelled Now!");
            }
        });
}


function updateEducationInfo() {
    swal({
        title: "Are you sure?",
        text: "Once Update, You will saved this record",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/save_employee_education",
                    data: $('#employee_education_form').serialize(),
                    'dataType': 'json',
                    success: function (data) {
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#form_output_education').html(error_html);
                        } else {
                            $('#form_output_education').html('');

                            swal({
                                text: data.success,
                                icon: "success",
                            }).then(function () {
                                location.reload();
                            });
                        }
                    }
                });
            } else {
                swal("Cancelled Now!");
            }
        });
}

function updateTrainingInfo() {
    swal({
        title: "Are you sure?",
        text: "Once Update, You will saved this record",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/save_employee_training_info",
                    data: $('#employee_training_form').serialize(),
                    'dataType': 'json',
                    success: function (data) {
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#form_output_education').html(error_html);
                        } else {
                            $('#form_output_education').html('');

                            swal({
                                text: data.success,
                                icon: "success",
                            }).then(function () {
                                location.reload();
                            });
                        }
                    }
                });
            } else {
                swal("Cancelled Now!");
            }
        });
}

function updateSpouseChildInfo() {
    swal({
        title: "Are you sure?",
        text: "Once Update, You will saved this record",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/save_employee_spouse_child_info",
                    data: $('#employee_spouse_child_form').serialize(),
                    'dataType': 'json',
                    success: function (data) {
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#form_output_spouse_child').html(error_html);
                        } else {
                            $('#form_output_spouse_child').html('');

                            swal({
                                text: data.success,
                                icon: "success",
                            }).then(function () {
                                location.reload();
                            });
                        }
                    }
                });
            } else {
                swal("Cancelled Now!");
            }
        });
}
function updateExpertiseInfo() {
    swal({
        title: "Are you sure?",
        text: "Once Update, You will saved this record",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/save_employee_expertise_info",
                    data: $('#employee_expertise_info_form').serialize(),
                    'dataType': 'json',
                    success: function (data) {
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#form_output_expertise').html(error_html);
                        } else {
                            $('#form_output_expertise').html('');

                            swal({
                                text: data.success,
                                icon: "success",
                            }).then(function () {
                                location.reload();
                            });
                        }
                    }
                });
            } else {
                swal("Cancelled Now!");
            }
        });
}
function updateAwardInfo() {
    swal({
        title: "Are you sure?",
        text: "Once Update, You will saved this record",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/save_employee_award_info",
                    data: $('#employee_award_form').serialize(),
                    'dataType': 'json',
                    success: function (data) {
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#form_output_award').html(error_html);
                        } else {
                            $('#form_output_award').html('');

                            swal({
                                text: data.success,
                                icon: "success",
                            }).then(function () {
                                location.reload();
                            });
                        }
                    }
                });
            } else {
                swal("Cancelled Now!");
            }
        });
}

function deleteEmployeeTravel(id,employee_id) {
   // alert(id);
    swal({
        title: "Are you sure?",
        text: "Once deleted, You will not be able to recover this record",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/delete_travel_info",
                    data: {id: id,employee_id:employee_id},
                    'dataType': 'json',
                    success: function (response) {
                        if (response.status == 'success') {
                            swal({
                                text: response.message,
                                icon: "success",
                            }).then(function () {
                                location.reload();
                            });

                        } else {
                            swal(response.message, {
                                icon: "warning",
                            });
                        }
                    }
                });
            }
        });
}

function AddTravelInfo() {
    $("#employee_travel_form")[0].reset();
    $("#title").val('');
    $("#setting_id").val('');
    $("#is_active").val(1);
    $("#saveBtnTravel").show();
    $("#updateBtnTravel").hide();
    $("#heading-title").html('Add ');
    $("#form_output").html('');
}
function AddDepartmentalActionInfo() {
    $("#departmental_action_info_form")[0].reset();
    $("#title").val('');
    $("#setting_id").val('');
    $("#is_active").val(1);
    $("#saveBtnDepartmentalAction").show();
    $("#updateBtnDepartmentalAction").hide();
    $("#heading-title-departmatnal-action").html('Add ');
    $("#form_output_departmanatl_action_info").html('');
}
$("#type").change(function () {
    var type = $(this).val();
    if (type == 1) {
        $("#foreign_travel").hide();
    } else {
        $("#foreign_travel").show();
    }
});
$("#punishment_type").change(function () {
    var type = $(this).val();
    if (type == 1) {
        $("#dondo_paptho_info").hide();
    } else {
        $("#dondo_paptho_info").show();
    }
});
function saveTravelInfo() {
    swal({
        title: "Are you sure?",
        text: "Once Update, You will saved this record",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/save_employee_travel_info",
                    data: $('#employee_travel_form').serialize(),
                    'dataType': 'json',
                    success: function (data) {
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#form_output_award').html(error_html);
                        } else {
                            $('#form_output_award').html('');

                            swal({
                                text: data.success,
                                icon: "success",
                            }).then(function () {
                                location.reload();
                            });
                        }
                    }
                });
            } else {
                swal("Cancelled Now!");
            }
        });
}

function updatePromotionInfo() {
    swal({
        title: "Are you sure?",
        text: "Once Update, You will saved this record",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/save_employee_promotion",
                    data: $('#employee_promotion_form').serialize(),
                    'dataType': 'json',
                    success: function (data) {
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#form_output_promotion').html(error_html);
                        } else {
                            $('#form_output_promotion').html('');

                            swal({
                                text: data.success,
                                icon: "success",
                            }).then(function () {
                                location.reload();
                            });
                        }
                    }
                });
            } else {
                swal("Cancelled Now!");
            }
        });
}

function updateJobHistoryInfo() {
    swal({
        title: "Are you sure?",
        text: "Once Update, You will saved this record",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/save_employee_job_hisotry",
                    data: $('#employee_job_hisotry_form').serialize(),
                    'dataType': 'json',
                    success: function (data) {
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#form_output_job_history').html(error_html);
                        } else {
                            $('#form_output_job_history').html('');

                            swal({
                                text: data.success,
                                icon: "success",
                            }).then(function () {
                                location.reload();
                            });
                        }
                    }
                });
            } else {
                swal("Cancelled Now!");
            }
        });
}


function updateEmergencyContactInfo() {
    swal({
        title: "Are you sure?",
        text: "Once Update, You will saved this record",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/save_employee_emergency_contact",
                    data: $('#employee_emergency_contact_form').serialize(),
                    'dataType': 'json',
                    success: function (data) {
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#form_output_job_history').html(error_html);
                        } else {
                            $('#form_output_job_history').html('');

                            swal({
                                text: data.success,
                                icon: "success",
                            }).then(function () {
                                location.reload();
                            });
                        }
                    }
                });
            } else {
                swal("Cancelled Now!");
            }
        });
}

function updateExitFeedbackInfo() {
    swal({
        title: "Are you sure?",
        text: "Once Update, You will saved this record",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/save_employee_exit_feedback",
                    data: $('#employee_exit_feedback_form').serialize(),
                    'dataType': 'json',
                    success: function (data) {
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#form_output_exit_feedback').html(error_html);
                        } else {
                            $('#form_output_exit_feedback').html('');

                            swal({
                                text: data.success,
                                icon: "success",
                            }).then(function () {
                                location.reload();
                            });
                        }
                    }
                });
            } else {
                swal("Cancelled Now!");
            }
        });
}

function updateEmployementInfo() {
    swal({
        title: "Are you sure?",
        text: "Once Update, You will saved this record",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/save_employee_employement_info",
                    data: $('#employee_employement_form').serialize(),
                    'dataType': 'json',
                    success: function (data) {
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#form_output_employeement').html(error_html);
                        } else {
                            $('#form_output_employeement').html('');

                            swal({
                                text: data.success,
                                icon: "success",
                            }).then(function () {
                                location.reload();
                            });
                        }
                    }
                });
            } else {
                swal("Cancelled Now!");
            }
        });
}

function updateBankSalaryInfo() {
    swal({
        title: "Are you sure?",
        text: "Once Update, You will saved this record",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/save_employee_bank_info",
                    data: $('#employee_bank_form').serialize(),
                    'dataType': 'json',
                    success: function (data) {
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#form_output_bank_info').html(error_html);
                        } else {
                            $('#form_output_bank_info').html('');

                            swal({
                                text: data.success,
                                icon: "success",
                            }).then(function () {
                                location.reload();
                            });
                        }
                    }
                });
            } else {
                swal("Cancelled Now!");
            }
        });
}
$(document).ready(function (e) {
    $("#employee_ict_credentials_form").on('submit',(function(e) {
        e.preventDefault();
        $.ajax({
            url: base_url + "/save_employee_ict_credentials", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            'dataType': 'json',
            success: function(data)   // A function to be called if request succeeds
            {

                if (data.error.length > 0) {
                    var error_html = '';
                    for (var count = 0; count < data.error.length; count++) {
                        error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                    }
                    $('#form_output_bank_info').html(error_html);
                } else {
                    $('#form_output_bank_info').html('');
                    swal({
                        text: data.success,
                        icon: "success",
                    }).then(function () {
                        location.reload();
                    });
                }
            }
        });
    }));
});


// function updateIctCredentialInfo() {
//     swal({
//         title: "Are you sure?",
//         text: "Once Update, You will saved this record",
//         icon: "warning",
//         buttons: true,
//         dangerMode: true,
//     })
//         .then((willDelete) => {
//             if (willDelete) {
//                 $.ajax({
//                     type: "POST",
//                     url: base_url + "/save_employee_ict_credentials",
//                     data: $('#employee_ict_credentials_form').serialize(),
//                     'dataType': 'json',
//                     success: function (data) {
//                         if (data.error.length > 0) {
//                             var error_html = '';
//                             for (var count = 0; count < data.error.length; count++) {
//                                 error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
//                             }
//                             $('#form_output_bank_info').html(error_html);
//                         } else {
//                             $('#form_output_bank_info').html('');
//
//                             swal({
//                                 text: data.success,
//                                 icon: "success",
//                             }).then(function () {
//                                 location.reload();
//                             });
//                         }
//                     }
//                 });
//             } else {
//                 swal("Cancelled Now!");
//             }
//         });
// }

$("#employee_data").DataTable({
    "processing": true,
    "serverSide": true,
    "dataType": 'json',
    "ajax": "all_employee_info_ajax",
    "columns": [
        {"data": "employee_id"},
        {"data": "emp_name"},
        {"data": "station_name"},
        {"data": "mobile"},
        {"data": "department_title"},
        {"data": "designation_title"},
        {"data": 'is_active'},
        {"data": "action", orderable: false, searchable: false}
    ],
    responsive: true
});

$("#employee_salary_assign").DataTable({
    "processing": true,
    "serverSide": true,
    "dataType": 'json',
    "ajax": "employee_salary_assign_ajax",
    "columns": [
        {"data": "employee_id"},
        {"data": "emp_name"},
        {"data": "station_name"},
        {"data": "mobile"},
        {"data": "department_title"},
        {"data": "designation_title"},
        {"data": 'created_time'},
        {"data": "action", orderable: false, searchable: false}
    ],
    responsive: true
});


$(document).on("click", ".deleteRow", function (e) {
    var target = e.target;
    $(target).closest('tr').remove();
});


function AddManualApplication() {
    $("#addManualApp")[0].reset();
    $("#saveBtn").show();
    $("#updateBtn").hide();
    $("#heading-title").html('Add Manual Application ');
    $("#tableDynamic").html('');
}

function AddLoanApplication() {
    $("#addLoanApp")[0].reset();
    $("#saveBtn").show();
    $("#updateBtn").hide();
    $("#heading-title").html('Add Loan Application ');
    $("#tableDynamic").html('');
}

$("#physical_disability").change(function () {
    var physical_disability_val = $(this).val();
    if (physical_disability_val == 1) {
        $("#disability_yes_details").attr('readonly', true);
    } else {
        $("#disability_yes_details").attr('readonly', false);
        $("#disability_yes_details").focus();
    }
});

$("#present_district").change(function () {
    var district_id = $(this).val();
    $.ajax({
        type: "POST",
        url: base_url + "/show_upazila_by_district",
        data: {district_id: district_id},
        'dataType': 'json',
        success: function (response) {
            $('#present_police_station').html('<option value="">Select Police Station</option>');
            if (response.status == 'success') {
                $.each(response.data, function (index, Obj) {
                    $('#present_police_station').append('<option value="' + index + '">' + Obj + '</option>')
                })
            }
        }
    });

});

$("#parmanent_district").change(function () {
    var district_id = $(this).val();
    $.ajax({
        type: "POST",
        url: base_url + "/show_upazila_by_district",
        data: {district_id: district_id},
        'dataType': 'json',
        success: function (response) {
            $('#parmanent_police_station').html('<option value="">Select Police Station</option>');
            if (response.status == 'success') {
                $.each(response.data, function (index, Obj) {
                    $('#parmanent_police_station').append('<option value="' + index + '">' + Obj + '</option>')
                })
            }
        }
    });

});


$("#checkedBcsCadre").change(function () {
    if ($(this).prop('checked')) {
        $(".show_bcs_cadre").show();
    } else {
        $(".show_bcs_cadre").hide();
    }
});

$("#save_present_parmanent_address").change(function () {
    if ($(this).prop('checked')) {
        $(".same_present_address").attr('disabled', true);
    } else {
        $(".same_present_address").attr('disabled', false);
    }
});


function autocompleteEmployeeInfo(data) {
    if ( data.value.trim() == '') {
        $('#employee_id_search').val('');
        return false;
    }
    var options = {
        minLength: 1,
        source: function (request, response) {
            $.ajax({
                url: base_url + "/searching_employee_info",
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
            if(ui.item.value !='') {
                $('#employee_name_search').val(ui.item.value);
                $('#employee_id_search').val(ui.item.id);
            }else{
                $('#employee_name_search').val('');
                $('#employee_id_search').val('');
            }
            return false;
        }
    };
    $('body').on('keydown.autocomplete', '#employee_name_search', function() {
        $(this).autocomplete(options);
    });
}


// report
function employee_designation_search() {
    $.ajax({
        type: "POST",
        url: base_url + "/search_employee_designation_report",
        data: $('#employee_report_form').serialize(),
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
function employee_department_search() {
    $.ajax({
        type: "POST",
        url: base_url + "/search_employee_department_report",
        data: $('#employee_report_form').serialize(),
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

function employee_edu_degree_search() {
    $.ajax({
        type: "POST",
        url: base_url + "/search_employee_education_report",
        data: $('#employee_report_form').serialize(),
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
function employee_user_access_search() {
    $.ajax({
        type: "POST",
        url: base_url + "/search_employee_user_access_search",
        data: $('#employee_report_form').serialize(),
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

function addHolidayInfo() {
    $("#holiday_record_form")[0].reset();
    $("#form_output").html('');
    $("#submitBtnTitle").html('Save');
    $("#heading-title").html('Add new holiday information ');
    $('#checked_dept').removeAttr('checked');
    $('input[type=checkbox]').each(function()
    {
        $(this).prop('checked', false);
    });
}
function updateHolidayInfo(id) {
    $("#holiday_record_form")[0].reset();
    $("#form_output").html('');
    $("#submitBtnTitle").html('Update');
    $("#heading-title").html('Update holiday information ');
    $.ajax({
        type: "POST",
        url: base_url + "/get_single_holiday_info",
        data: {id: id},
        'dataType': 'json',
        success: function (response) {
            if (response.status == 'success') {
                $("#setting_id").val(id);
                var data=response.data;
                $("#holiday_title").val(data.title);
                $("#station_id").val(data.station_id);
                $("#holiday_form_date").val(data.from_date);
                $("#holiday_to_date").val(data.to_date);
                $("#attendance_in_time").val(data.start_time);
                $("#attendance_out_time").val(data.end_time);
                $("#overwrite_type").val(data.overwrite_type);
                $('#checked_dept').removeAttr('checked');
                var dept = JSON.parse(data.department_id);
                $.each(dept, function(index, element) {
                    $('.checkbox_val_'+element).attr('checked', true);
                });

            } else {
                alert(response.message);
                return false;
            }
        }
    });
}


function saveHolidayInfo() {
    swal({
        title: "Are you sure?",
        text: "Once Update, You will saved this record",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "POST",
                url: base_url + "/save_holiday_info",
                data: $('#holiday_record_form').serialize(),
                'dataType': 'json',
                success: function (data) {
                    if (data.error.length > 0) {
                        var error_html = '';
                        for (var count = 0; count < data.error.length; count++) {
                            error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                        }
                        $('#form_output_bank_info').html(error_html);
                    } else {
                        $('#form_output_bank_info').html('');

                        swal({
                            text: data.success,
                            icon: "success",
                        }).then(function () {
                            location.reload();
                        });
                    }
                }
            });
        } else {
            swal("Cancelled Now!");
        }
    });
}


function employee_attendance_info_search() {
    $.ajax({
        type: "POST",
        url: base_url + "/search_employee_attendance_info",
        data: $('#employee_attendance_form').serialize(),
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
function saved_employee_attendance_info() {
    $.ajax({
        type: "POST",
        url: base_url + "/saved_employee_attendance_info",
        data: $('#employee_attendance_data_form').serialize(),
        'dataType': 'json',
        success: function (response) {
            if (response.status=='error') {
                var error='<div class="alert alert-danger">' + response.message + '</div>'
                $('#error_data').html(error);
                $('#show_attendance_info').html('');
            } else {
                    $('#error_data').html('');
                swal({
                    text: response.message,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });

            }
        }
    });
}

// record searching

function employee_attendance_record_search() {
    $.ajax({
        type: "POST",
        url: base_url + "/search_employee_attendance_recrod",
        data: $('#employee_attendance_form').serialize(),
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

function createUserAccess() {
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
                    url: base_url + "/save_user_access_info",
                    data: $('#user_access_info_form').serialize(),
                    'dataType': 'json',
                    success: function (data) {
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#form_output').html(error_html);
                        } else {
                            $('#user_access_info_form')[0].reset();
                            $('#form_output').html('');

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