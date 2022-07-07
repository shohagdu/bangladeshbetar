function AddLeaveApplication() {
    $("#addLeaveApp")[0].reset();
    $("#show_status").hide();
    $("#employee_id").select2('val','');
    $("#saveBtn").show();
    $("#updateBtn").hide();
    $("#heading-title").html('Add ');
    $("#tableDynamic").html('');
}
function updateLeaveApplication(id) {
    $("#addLeaveApp")[0].reset();
    $("#updateBtn").show();
    $("#saveBtn").hide();
    $("#show_status").show();
    $.ajax({
        type: "POST",
        url: base_url + "/employee_leave_info",
        data: {id: id},
        'dataType': 'json',
        success: function (response) {
            if (response.status == 'success') {
                var leave_info=response.data;
                let current_datetime = new Date(leave_info.from_date);
                let formatted_date = current_datetime.getDate() + "-" + (current_datetime.getMonth() + 1) + "-" + current_datetime.getFullYear();

                let to_date_format = new Date(leave_info.to_date);
                let to_date_format_data = to_date_format.getDate() + "-" + (to_date_format.getMonth() + 1) + "-" + to_date_format.getFullYear();



                $("#employee_id").select2('val',leave_info.employee_id);
                $("#leave_type").val(leave_info.leave_type_id);
                $("#leave_from").val(formatted_date);
                $("#leave_to").val(to_date_format_data);
                $("#leave_reason").val(leave_info.leave_reason);
                $("#status_id").val(leave_info.status);
                $("#setting_id").val(id);
            } else {
                $("#addLeaveApp")[0].reset();
            }
        }
    });
}


$('#application_hard_copy,#medical_certificate').change(function () {
    var ext = this.value.match(/\.(.+)$/)[1];
    switch (ext) {
        case 'pdf':
        case 'jpg':
        case 'jpeg':
        case 'png':
            $('#uploadButton').attr('disabled', false);
            break;
        default:
            alert('This is not an allowed file type.');
            this.value = '';
    }
});
