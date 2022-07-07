$("#payrole_months_generate").change(function(){
    var payrole_month=$(this).val();
    $.ajax({
        type: "POST",
        url: base_url + "/search_elibile_employee_payrole_gen",
        data: {payrole_month:payrole_month},
        success: function (response) {
            $("#show_eligible_employee_payrole").html(response);
            $("#payslip_month").val(payrole_month);
        }
    });
});

function savePayslipGenerate() {
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
                    url: base_url + "/save_employee_payrole_genrate",
                    data: $('#employee_payrole_generate_form').serialize(),
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


$("#show_payslip_record").change(function(){
    $.ajax({
        type: "GET",
        url: base_url + "/payroll_record",
        data: $('#employee_payslip_record').serialize(),
        success: function (response) {
            $("#show_eligible_employee_payrole").html(response);
        }
    });
});


function payslipView(payslip_id) {
    $("#heading-title-salary-assign").html('View Employee Payslip Information ');
    $.ajax({
        type: "POST",
        url: base_url + "/get_single_payslip_info",
        data: {payslip_id: payslip_id},
        'dataType': 'json',
        success: function (response) {
            if (response.status == 'error') {
                $('#form_output_salary_assign').html(response.message);
            } else {
                var data = response.data;
                $("#station_name").html(data.station_name);
                $("#employee_id_show").html(data.employee_id);
                $("#employee_id").html(data.employee_id);
                $("#employee_name").html(data.emp_name);
                $("#mobile").html(data.mobile);
                $("#department").html(data.department_title);
                $("#designaion").html(data.designation_title);
                $("#emp_basic_salary").val(data.basic_salary);
                $("#emp_pay_scal").val(data.pay_scal);
                $("#is_salary_assign").val('update');


                var all_earning_ctg = response.all_earning_ctg;
                var all_deduction_ctg = response.all_deduction_ctg;

                // var not_default_earning=response.default_not_earning;
                var earning_info = JSON.parse(data.earning_info);
                var deduction_info = JSON.parse(data.deduction_info);

                if (earning_info.length > 0) {
                    var row_total_earning = 0;
                    var table = '<table class="mainTable table table-bordered" style="width:100%;"><tr><th colspan="3">Earning Category Information</th></tr><tr><tr><th class="width50per" >Category</th><th class="width25per" >Percentage(%)</th><th class="width25per">Amount</th></tr>';
                    $.each(earning_info, function (key, value) {
                        table += ('<tr>');
                        table += ('<th>' + all_earning_ctg[value.earning_ctg] + '<input type="hidden" value="' + value.earning_ctg + '" id="earning_ctg_' + value.earning_ctg + '"   class="form-control"  value="0"  name="earning_ctg[]"/></th>');
                        if (value.earning_ctg != 16) {
                            table += ('<td>'+ value.earning_ctg_per + '</td>');
                        } else {
                            table += ('<td>- <input type="hidden" id="earning_ctg_per_' + key + '"   class="form-control" placeholder="Percentages(%)" value="' + value.earning_ctg_per + '"  name="earning_ctg_per[]"/></td>');
                        }
                        table += ('<td>' + value.earning_ctg_amount + '</td>');
                        table += ('</tr>');
                        row_total_earning += parseFloat(value.earning_ctg_amount);

                    });
                    table += '<tbody id="addEarningTr"></tbody>';
                    table += ('<tr><th colspan="2" class="text-right">Total Earning Amount</th><td>' + (row_total_earning).toFixed(2) + '</td></tr>');
                    table += '</table>';
                    $("#total_earning").html((row_total_earning).toFixed(2));
                    $('#show_earning_ctg').html(table);
                }

                // Earning calculation  end
                // todo Deduction calculation  start
                if (deduction_info.length > 0) {
                    var row_total_deduction = 0;
                    var table_deduction = '<table class="mainTable table table-bordered" style="width:100%;"><tr><th colspan="3">Deduction Category Information</th></tr><tr><th class="width50per" >Category</th><th class="width25per" >Percentage(%)</th><th class="width25per">Amount</th></tr>';
                    $.each(deduction_info, function (key, value) {
                        table_deduction += ('<tr>');
                        table_deduction += ('<th>' + all_deduction_ctg[value.deduction_ctg] + '</th>');
                        table_deduction += ('<td>' + value.deduction_ctg_per + '</td>');

                        table_deduction += ('<td>' + value.deduction_ctg_amount + '</td>');
                        table_deduction += ('</tr>');
                        row_total_deduction += parseFloat(value.deduction_ctg_amount);
                    });
                    table_deduction += '<tbody id="addDeductionTr"></tbody>';

                    table_deduction += ('<tr><th colspan="2" class="text-right">Total Deduction Amount</th><td>' + (row_total_deduction).toFixed(2) + '</td></tr>');
                    table_deduction += '</table>';
                    $('#show_deduction_ctg').html(table_deduction);
                    $("#total_deduction").html((row_total_deduction).toFixed(2));
                    var net_paid=parseFloat(row_total_earning)-parseFloat(row_total_deduction);
                    $("#net_paid").html((net_paid).toFixed(2));
                     var pdf=base_url + '/pdf_payslip_download/'+data.payslip_id;
                    $("#pdf_url").html('<a href="'+pdf+'" type="button" class="btn btn-warning"><i class="glyphicon glyphicon-download"></i> Download PDF</a>');



                }
            }
        }
    });
}
