$(document).ready(function() {
    $('input').keyup(function() {
        $('#saveBtn').attr('disabled',false);

    });
    $('textarea').keyup(function() {
        $('#saveBtn').attr('disabled',false);
        $('#form_output_artist_info').html('');
    });

});
function AddProgramApplication() {
    $("#addProgramApp")[0].reset();
    $("#show_status").hide();
    $("#employee_id").select2('val','');
    $("#saveBtn").show();
    $("#updateBtn").hide();
    $("#heading-title").html('Add ');
}
function updateProgramApplication(id) {
    $("#addProgramApp")[0].reset();
    $("#show_status").hide();
    $("#employee_id").select2('val','');
    $("#saveBtn").hide();
    $("#updateBtn").show();
    $("#heading-title").html('Update ');
}

// $('.timepicker').timepicker({
//     timeFormat: 'h:mm p',
//     interval: 5,
//     minTime: '10',
//     maxTime: '11:00pm',
//     defaultTime: '10',
//     startTime: '10:00am',
//     dynamic: false,
//     dropdown: true,
//     scrollbar: true
// });

// function AddProgramArtist() {
//     $("#update_form").empty();
//     // $("#save_artist_info_form")[0].reset();
//     $("#show_status").hide();
//     $("#saveBtn").show();
//     $("#updateBtn").hide();
//     $("#heading-title").html('নতুন ');
//     $("#dynamicSongtr").html('');
//     $("#add_form_artist_info").empty();
//
//     $("#add_form_artist_info").load(base_url + "/artist_record_add");
//
// }

function is_recorded_check(checked){
    $("#record_complete_date").val('');
    if(checked.checked) {
        $("#record_complete_date").show();
    }
    else {
        $("#record_complete_date").hide();
    }
}

function is_broadcast_check(checked){
    $("#broadcast_complete_date").val('');
    if(checked.checked) {
        $("#broadcast_complete_date").show();
    }
    else {
        $("#broadcast_complete_date").hide();
    }
}

function checkBroadcastInfo(id,attend_date,record_date) {
    $("#record_complete_date").val('');
    $("#programid").val(id);
    $("#record_date").val(record_date);
    if(attend_date!='') {
        // $("#is_recorded").trigger('click');
        $('#is_recorded').prop('checked', true);
        $("#record_complete_date").val(record_date);
    }else{
        $('#is_recorded').prop('checked', false);
        $("#record_complete_date").val('');
    }

}

function saveBroadcastInfo() {

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
                    url: base_url + "/save_broadcast_info",
                    data: $('#broadcast_form').serialize(),
                    'dataType': 'json',
                    success: function (data) {
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#form_output').html(error_html);
                        } else {
                            $('#broadcast_form')[0].reset();
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

$(document).ready(function (e) {

    $("#artist_info_update_form").on('submit',(function(e) {
        $("#saveBtn").attr("disabled", true);
        e.preventDefault();
        $.ajax({
            url: base_url + "/update_artist_info", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            'dataType': 'json',
            success: function(data)   // A function to be called if request succeeds
            {
                $("#saveBtn").attr("disabled", false);
                if (data.error.length > 0) {
                    var error_html = '';
                    for (var count = 0; count < data.error.length; count++) {
                        error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                    }
                    $('#form_output_artist_info').html(error_html);
                } else {
                    $('#form_output_artist_info').html('');
                    swal({
                        text: data.success,
                        icon: "success",
                    }).then(function () {
                        // location.reload();
                        window.location = base_url + '/' + data.redirect_page;
                    });
                }
            }
        });
    }));

    $("#save_artist_info_form").on('submit',(function(e) {
        $("#saveBtn").attr("disabled", true);
        e.preventDefault();
        $.ajax({
            url: base_url + "/save_artist_info", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            'dataType': 'json',
            success: function(data)   // A function to be called if request succeeds
            {
                $("#saveBtn").attr("disabled", false);
                if (data.error.length > 0) {
                    var error_html = '';
                    for (var count = 0; count < data.error.length; count++) {
                        error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                    }
                    $('#form_output_artist_info').html(error_html);
                } else {
                    $('#form_output_artist_info').html('');
                    swal({
                        text: data.success,
                        icon: "success",
                    }).then(function () {
                        // location.reload();
                        window.location = base_url + '/' + data.redirect_page;
                    });
                }
            }
        });
    }));

     $("#save_artist_attachment_form").on('submit',(function(e) {
        $("#saveBtn").attr("disabled", true);
        e.preventDefault();
        $.ajax({
            url: base_url + "/save_artist_attachment", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            'dataType': 'json',
            success: function(data)   // A function to be called if request succeeds
            {
                $("#saveBtn").attr("disabled", false);
                if (data.error.length > 0) {
                    var error_html = '';
                    for (var count = 0; count < data.error.length; count++) {
                        error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                    }
                    $('#form_output_artist_info').html(error_html);
                } else {
                    $('#form_output_artist_info').html('');
                    swal({
                        text: data.success,
                        icon: "success",
                    }).then(function () {
                        // location.reload();
                        window.location = base_url + '/' + data.redirect_page;
                    });
                }
            }
        });
    }));




});

// function saveArtistInfo() {
//     swal({
//         title: "Are you sure?",
//         text: "Once Save, You will saved this record",
//         icon: "warning",
//         buttons: true,
//         dangerMode: true,
//     })
//         .then((willDelete) => {
//             if (willDelete) {
//                 $.ajax({
//                     type: "POST",
//                     url: base_url + "/update_artist_info",
//                     data: $('#save_artist_info_form').serialize(),
//                     'dataType': 'json',
//                     success: function (data) {
//                         if (data.error.length > 0) {
//                             var error_html = '';
//                             for (var count = 0; count < data.error.length; count++) {
//                                 error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
//                             }
//                             $('#form_output').html(error_html);
//                         } else {
//                             $('#save_artist_info_form')[0].reset();
//                             $('#form_output').html('');
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

function savePresentationInfo(){
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
                    url: base_url + "/save_presentation_info",
                    data: $('#save_presentation_info_form').serialize(),
                    'dataType': 'json',
                    success: function (data) {
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#form_output').html(error_html);
                        } else {
                            $('#save_presentation_info_form')[0].reset();
                            $('#form_output').html('');
                            swal({
                                text: data.success,
                                icon: "success",
                            }).then(function () {
                                // location.reload();
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

function saveAdhokPresentationInfo(){
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
                    url: base_url + "/adhok_save_presentation_info",
                    data: $('#save_adhok_presentation_info_form').serialize(),
                    'dataType': 'json',
                    success: function (data) {
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#form_output').html(error_html);
                        } else {
                            $('#save_adhok_presentation_info_form')[0].reset();
                            $('#form_output').html('');
                            swal({
                                text: data.success,
                                icon: "success",
                            }).then(function () {
                                // location.reload();
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


function updatePresentationInfo(){
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
                    url: base_url + "/update_presentation_info_data",
                    data: $('#save_presentation_info_form').serialize(),
                    'dataType': 'json',
                    success: function (data) {
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#form_output').html(error_html);
                        } else {
                            $('#save_presentation_info_form')[0].reset();
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
function savePresentationSettingsInfo(){
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
                    url: base_url + "/save_presentation_settings_info",
                    data: $('#save_presentation_settings_info_form').serialize(),
                    'dataType': 'json',
                    success: function (data) {
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#form_output').html(error_html);
                        } else {
                            $('#save_presentation_settings_info_form')[0].reset();
                            $('#form_output').html('');
                            swal({
                                text: data.success,
                                icon: "success",
                            }).then(function () {
                                // location.reload();
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
function addScheduleSlot(day_id,row_id) {
    $.ajax({
        type: "GET",
        url: base_url + "/get_row/"+day_id+"/"+row_id,
        data: [],
        success: function(reponse) {
            $( "#row_"+day_id+"_"+row_id ).append(reponse);
        },
        dataType: 'html'
    });
}

function removeScheduleSlot(day_id,row_id) {
    $( "#row_"+day_id+"_"+row_id ).remove();
}

// function updateArtistInfo() {
//     swal({
//         title: "Are you sure?",
//         text: "Once Save, You will saved this record",
//         icon: "warning",
//         buttons: true,
//         dangerMode: true,
//     })
//         .then((willDelete) => {
//             if (willDelete) {
//                 $.ajax({
//                     type: "POST",
//                     url: base_url + "/save_artist_info",
//                     data: $('#save_artist_info_form_update').serialize(),
//                     'dataType': 'json',
//                     success: function (data) {
//                         if (data.error.length > 0) {
//                             var error_html = '';
//                             for (var count = 0; count < data.error.length; count++) {
//                                 error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
//                             }
//                             $('#form_output').html(error_html);
//                         } else {
//                             $('#save_artist_info_form')[0].reset();
//                             $('#form_output').html('');
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

function updateProgramArtist(artist_id) {
    $("#update_form").empty();
    if(artist_id != '') {
        $("#update_form_artist_info").load(base_url + "/artist_record_update/"+artist_id);
    }
    else {
        $("#update_form").empty();
    }
}

function AddArtistRateChart() {
    $("#artist_rate_chart_setup_form")[0].reset();
    $("#saveBtn").show();
    $("#updateBtn").hide();
    $("#heading-title").html('নতুন সম্মানীর চার্ট এন্টি ');
    $("#is_active").val(1);
    $("#chart_id").val('');

}


function UpdateArtistRateChart(discription_id,ctg_id) {
    $.ajax({
        type: "POST",
        url: base_url + "/get_all_product_sub_ctg",
        data: {discription_id:discription_id,ctg_id:ctg_id},
        success: function (response) {
                $(".artist_song_ctg").val(ctg_id);
                $('#artist_chart_info_update').html(response);
        }
    });
}

function saveArtistRateChart() {
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
                    url: base_url + "/save_artist_rate_chart",
                    data: $('#artist_rate_chart_setup_form').serialize(),
                    'dataType': 'json',
                    success: function (data) {
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#form_output').html(error_html);
                        } else {
                            $('#artist_rate_chart_setup_form')[0].reset();
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

function updateArtistRateChart() {
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
                    url: base_url + "/save_artist_rate_chart",
                    data: $('#artist_rate_chart_setup_form_update').serialize(),
                    'dataType': 'json',
                    success: function (data) {
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#form_output').html(error_html);
                        } else {
                            $('#artist_rate_chart_setup_form')[0].reset();
                            $('#form_output').html('');

                            swal({
                                text: data.success,
                                icon: "success",
                            }).then(function () {
                               window.location = base_url + '/' + data.redirect_page; window.location = base_url + '/' + data.redirect_page;
                            });
                        }
                    }
                });
            } else {
                swal("Cancelled Now!");
            }
        });
}



function deleteArtistRateChart(row) {
    var data = JSON.parse(row);
    swal({
        title: "Are you sure?",
        text: "Once Save, You will delete this record",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/delete_artist_rate_chart",
                    data: {id:data.id},
                    'dataType': 'json',
                    success: function (data) {
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#form_output').html(error_html);
                        } else {
                            $('#artist_rate_chart_setup_form')[0].reset();
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

function programTimeTableAdd() {
    $("#program_time_table_setup_form")[0].reset();
    $("#saveBtn").show();
    $("#updateBtn").hide();
    $("#heading-title").html('নতুন সময়সূচী এন্টি ');
    $("#is_active").val(1);
}
function saveMasterDayProgram() {
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
                    url: base_url + "/save_master_day_program_time_table",
                    data: $('#program_time_table_setup_form').serialize(),
                    'dataType': 'json',
                    success: function (data) {
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#form_output').html(error_html);
                        } else {
                            $('#save_artist_info_form')[0].reset();
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


//update by shohag artist info


$(document).on("change", ".artist_hounoriam_ctg", function (e) {
    var element_id = elementId($(this).attr('id'));
    var artist_honouriam_id=$(this).val();
    $.ajax({
        type: "POST",
        url: base_url + "/artist_honouriam_discription",
        data: {artist_honouriam_id: artist_honouriam_id},
        'dataType': 'json',
        success: function (response) {
            $('#chart_description_'+element_id).html('<option value=""> চিহ্নিত করুন</option>');
            if (response.status == 'success') {
                $.each(response.data, function (index, Obj) {
                    $('#chart_description_'+element_id).append('<option value="' + index + '">' + Obj + '</option>')
                })
            }
        }
    });
});
$(document).on("change", ".chart_description", function (e) {
    var element_id = elementId($(this).attr('id'));
    var chart_description_id=$(this).val();
    $.ajax({
        type: "POST",
        url: base_url + "/artist_honouriam_discription_grade",
        data: {chart_description: chart_description_id},
        'dataType': 'json',
        success: function (response) {
            $('#artist_grade_'+element_id).html('<option value=""> চিহ্নিত করুন</option>');
            if (response.status == 'success') {
                $.each(response.data, function (index, Obj) {
                    $('#artist_grade_'+element_id).append('<option value="' + index + '">' + Obj + '</option>')
                })
            }
        }
    });
});


$(document).on("change", ".artist_expertise", function (e) {
    var element_id = elementId($(this).attr('id'));
    var expertise_val=$(this).val();
    $.ajax({
        type: "POST",
        url: base_url + "/show_expertise_department",
        data: {expertise_val: expertise_val},
        'dataType': 'json',
        success: function (response) {
            $('#expertise_dept_'+element_id).html('<option value=""> চিহ্নিত করুন</option>');
            if (response.status == 'success') {
                $.each(response.data, function (index, Obj) {
                    $('#expertise_dept_'+element_id).append('<option value="' + index + '">' + Obj + '</option>')
                })
            }
        }
    });

});

function AddProgramSavedInfo() {
    $("#magazine_update").empty();
    $("#magazine_create").empty();
    $("#magazine_create").load(base_url + "/program_magazine_create_form",function(){
        $('.datepickerLong').datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
        });
        $('.select2').select2();
        $('.timepicker').datetimepicker({
            format: 'hh:mm a'
        });
    });
}

function loadDateData(month,station_id,fequencey,year) {
    $('.ajax-loader').show();
    $.ajax({
        type: "POST",
        url: base_url + "/load_date_data",
        data: {month: month,station_id:station_id,fequencey:fequencey,year:year},
        success: function (response) {
            if (response!= '') {
                $("#loadDateData").html(response);
                $('.select2').select2();
                $('.datepickerinfo').datepicker({
                    dateFormat: 'yy-mm-dd',
                    changeMonth: true,
                    changeYear: true,
                });
                $('.ajax-loader').hide();
            } else {
                alert(message);
                return false;
            }
        }
    });
}





function get_fequencey_wise_presentation_info(fequencey,station_id) {
    $.ajax({
        type: "POST",
        url: base_url + "/get_fequency_wise_presentation_info",
        data: {station_id:station_id,fequencey:fequencey},
        'dataType': 'json',
        success: function (response) {
            $('#presentation_id').html('<option value="">চিহ্নিত করুন</option>')
            if (response.status= 'success') {
                $.each(response.data, function (index, Obj) {
                    $('#presentation_id').append('<option value="' + index + '">' + Obj + '</option>')
                })
            } else {
                alert(message);
                return false;
            }
        }
    });
}

function searching_presentation_info() {
    $('.mydivAjaxImage').show();
    $.ajax({
        type: "POST",
        url: base_url + "/searching_adhok_presentation_info",
        data: $('#save_adhok_presentation_info_form').serialize(),
        success: function (response) {
            if (response!= '') {
                $("#loadDateData").html(response);
                $('.select2').select2();
                $('.datepickerinfo').datepicker({
                    dateFormat: 'yy-mm-dd',
                    changeMonth: true,
                    changeYear: true,
                });
            } else {
                alert(message);
                return false;
            }
            $('.mydivAjaxImage').hide();
        }
    });
}
function adhokt_add(presentation_date,station_id,sub_station_id,presentation_id) {
    $("#atttach_adhok_add").modal();
    $.ajax({
        type: "POST",
        url: base_url + "/adhok_date_wise_presentation_info",
        data: {presentation_date: presentation_date,station_id:station_id,sub_station_id:sub_station_id,presentation_id:presentation_id},
        success: function (response) {
            if (response!= '') {
                $("#show_adhok_attach_info").html(response);
                $('.select2').select2();
                $('.datepickerinfo').datepicker({
                    dateFormat: 'yy-mm-dd',
                    changeMonth: true,
                    changeYear: true,
                });
            } else {
                alert(message);
                return false;
            }
            $('.mydivAjaxImage').hide();
        }
    });
}


function updateProgramSavedInfo(id) {
    $("#magazine_update").empty();
    $("#magazine_create").empty();
    $("#magazine_update").load(base_url + "/program_magazine_update_form/"+id,function(){
        $('.datepickerLong').datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
        });
        $('.select2').select2();
        $('.timepicker').datetimepicker({
            format: 'hh:mm a'
        });
    });
}





function programMagazineCost(id) {
    $("#magazine_cost").empty();
    $("#magazine_cost").load(base_url + "/program_magazine_cost_form/"+id,function(){
        $('.datepickerLong').datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
        });
        $('.select2').select2();
        $('.timepicker').datetimepicker({
            format: 'hh:mm a'
        });
    });
}

function programMagazineView(id) {
    $("#magazine_view").empty();
    $("#magazine_view").load(base_url + "/program_magazine_cost_view/"+id,function(){
        $('.datepickerLong').datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
        });
        $('.select2').select2();
        $('.timepicker').datetimepicker({
            format: 'hh:mm a'
        });
    });
}

function is_program_type_check(checked) {
    if(checked.checked) {
        $("#fixed_program_type_div").css('display','block');
    }
    else {
        $("#fixed_program_type_div").css('display','none');
    }

    $("#fixed_program_type").val('');
}
function is_dologot_songit(checked) {
    if(checked.checked) {
        $("#dologot_information_view").css('display','block');
    }
    else {
        $("#dologot_information_view").css('display','none');
    }

    $("#dolar_name").val('');
    $("#dolar_info").val('');
}


function getAmount(i) {
    var program_style_id = $("#program_style_id"+i).val();
    var gradid = $("#grade_id"+i).val();
    var stability = $("#recording_stabilty"+i).val();
    var rateChart = JSON.parse( $("#rate_chart").val());
    var program_description_id = $("#program_description_id"+i).val();
    var amount = '';
    rateChart.forEach(function(item,index){
        if(item.ctg_id == program_style_id && item.grade_id == gradid &&
            item.description == program_description_id && item.stability == stability){
            amount = item.amount;
        }
    });
    $("#amount"+i).val(amount);
    getTotalAmount();
}

function getDescription(i) {
    var rateChart = JSON.parse( $("#rate_chart").val());
    var program_style_id = $("#program_style_id"+i).val();
    var description = [];
    rateChart.forEach(function(item,index){
        if(item.ctg_id == program_style_id) {
            if(description.indexOf(item.description)<0) {
                description.push(item.description);
            }
        }
    });

    var options = "<option value=''>বিবরন</option>";
    description.forEach(function(item,index){
        options+= "<option value='"+item+"'>"+item+"</option>";
    });
    $("#program_description_id"+i).html(options);
    $("#amount"+i).val('');
    getTotalAmount();
}

function getGradeTitle(grade_id){
    var rateChart = JSON.parse( $("#rate_chart").val());
    var gradeTitle = '';
    rateChart.forEach(function(item,index){
        if(item.grade_id == grade_id) {
            gradeTitle = item.grade_title;
        }
    });
    return gradeTitle;
}

function getGrade(i) {
    var rateChart = JSON.parse( $("#rate_chart").val());
    var program_style_id = $("#program_style_id"+i).val();
    var program_description_id = $("#program_description_id"+i).val();
    var grade = [];
    rateChart.forEach(function(item,index){
        if(item.ctg_id == program_style_id && item.description == program_description_id) {
            if(grade.indexOf(item.grade_id)<0) {
                grade.push(item.grade_id);
            }
        }
    });

    var options = "<option value=''>গ্রেড</option>";
    grade.forEach(function(item,index){
        var gradeTitle = getGradeTitle(item);
        options+= "<option value='"+item+"'>"+gradeTitle+"</option>";
    });
    $("#grade_id"+i).html(options);
    $("#amount"+i).val('');
    getTotalAmount();
}

function getStability(i) {
    var rateChart = JSON.parse( $("#rate_chart").val());
    var program_style_id = $("#program_style_id"+i).val();
    var program_description_id = $("#program_description_id"+i).val();
    var grade_id = $("#grade_id"+i).val();
    var stability = [];
    rateChart.forEach(function(item,index){
        if(item.ctg_id == program_style_id && item.description == program_description_id
            && item.grade_id == grade_id) {
            if(stability.indexOf(item.stability)<0) {
                stability.push(item.stability);
            }
        }
    });

    var options = "<option value=''>স্থিতি</option>";
    stability.forEach(function(item,index) {
        options+= "<option value='"+item+"'>"+item+"</option>";
    });
    $("#recording_stabilty"+i).html(options);
    $("#amount"+i).val('');
    getTotalAmount();

}

function getTotalAmount() {
    var totalIds = $("#totalartist").val();
    var totalAmount = 0;
    for(var i=1;i<=totalIds;i++){
        var amount = $("#amount"+i).val().trim();
        totalAmount+= amount===''?0:parseInt(amount)
        console.log(amount);
    }

    $("#totalCost").val(totalAmount);
}

function deleteProgramInfo(id,is_active) {
    swal({
        title: "Are you sure?",
        text: "Delete,If Delete, Then Its does not found",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/status_update_program_info",
                    data: {id: id,is_active:is_active},
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
                            alert(response.message);
                            return false;
                        }
                    }
                });
            } else {
                swal("Cancelled Now!");
            }
        });

}
function planningAgain(id,is_active) {
    swal({
        title: "Are you sure?",
        text: "Move to Planning, If Click, Then Its Moves to Planning",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/status_update_program_info",
                    data: {id: id,is_active:is_active},
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
                            alert(response.message);
                            return false;
                        }
                    }
                });
            } else {
                swal("Cancelled Now!");
            }
        });

}


function approvedProgramInfo(id,is_active) {
    swal({
        title: "Are you sure?",
        text: "Planning Approved,If Approved, Then Its Move to Proposal",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/status_update_program_info",
                    data: {id: id,is_active:is_active},
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
                            alert(response.message);
                            return false;
                        }
                    }
                });
            } else {
                swal("Cancelled Now!");
            }
        });

}

function approvedProposalInfo(id,is_active) {
    swal({
        title: "Are you sure?",
        text: "Proposal Approved,If Approved Then Its Move to Contact",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/status_update_program_info",
                    data: {id: id,is_active:is_active},
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
                            alert(response.message);
                            return false;
                        }
                    }
                });
            } else {
                swal("Cancelled Now!");
            }
        });

}
function RecordingListToWaitingAccount(id,is_active) {
    swal({
        title: "Are you sure?",
        text: "Proposal Approved,If Approved Then Its Move to Contact",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/recordingListToAccount",
                    data: {id: id,is_active:is_active},
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
                            return false;
                        }
                    }
                });
            } else {
                swal("Cancelled Now!");
            }
        });

}
function approvedPresentationInfo(month_id,station_id,is_active,type=1) {
    swal({
        title: "Are you sure?",
        text: "Planning Approved,If Approved, Then Its Move to Proposal",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/status_update_presentation_info",
                    data: {month_id: month_id,station_id: station_id,is_active:is_active,type:type},
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
                            alert(response.message);
                            return false;
                        }
                    }
                });
            } else {
                swal("Cancelled Now!");
            }
        });

}

function saveProgramSavedInfo() {
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
                    url: base_url + "/save_program_planning_info",
                    data: $('#save_program_planning_form').serialize(),
                    'dataType': 'json',
                    success: function (data) {
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#form_output').html(error_html);
                        } else {
                            $('#save_program_planning_form')[0].reset();
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

function updateProgramSavedInfoSubmit() {
    swal({
        title: "Are you sure?",
        text: "Once Save, You will Update this record",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/update_program_planning_info",
                    data: $('#update_program_planning_form').serialize(),
                    'dataType': 'json',
                    success: function (data) {
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#form_output').html(error_html);
                        } else {
                            $('#update_program_planning_form')[0].reset();
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

function updateStudioSavedInfoSubmit() {
    swal({
        title: "Are you sure?",
        text: "Once Save, You will Update this record",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/studio_information_update",
                    data: $('#update_program_planning_form').serialize(),
                    'dataType': 'json',
                    success: function (data) {
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#form_output').html(error_html);
                        } else {
                            $('#update_program_planning_form')[0].reset();
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

function updateProgramCostSavedInfoSubmit() {
    swal({
        title: "Are you sure?",
        text: "Once Save, You will Update this cost chart",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/save_program_magazine_cost",
                    data: $('#update_program_planning_cost').serialize(),
                    'dataType': 'json',
                    success: function (data) {
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#form_output').html(error_html);
                        } else {
                            $('#update_program_planning_cost')[0].reset();
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


/// added by mehedi


////////**

//// program schedule setup /////

////////////

function addRow() {  // add schedule row
    var station=$("#station_id").val();
    if(station==''){
        alert('কেন্দ্র/ইউনিটের নাম চিহ্নিত করুন');
        return false;
    }
    schedule = $("#schedule").val() == '' ? [] : JSON.parse($("#schedule").val());
    schedule.push({
        "days": null,
        "time": "",
        "week": "",
        "chank": "",
        "biboron": "",
        "description": "",
        "stability":"",
        "comment": "",
        "projejeno": "",
        "tottabodane": "",
        "sorting":"",
        "is_recorded": false
    });

    $("#schedule").val(JSON.stringify(schedule));
    var index = schedule.length - 1;
    var row = makeRow(index);
    var targetDiv = $("#dynamicJobHistorytr");
    $(row).appendTo(targetDiv);
    addTimepicker();
    $("#days" + index).select2();
    $("#week" + index).select2();
    generateProjejenoTottabodaneStation(index,station);
}
function generateProjejenoTottabodaneStation(index,station){

    if(station==''){
        alert('Please Select Station');
        return false;
    }
    $.ajax({
        type: "POST",
        url: base_url + "/get_employee_by_station_wise",
        data: {station_id: station},
        'dataType': 'json',
        success: function (response) {
            $('#projejeno'+index).html('<option value="">চিহ্নিত করুন </option>');
            $('#tottabodane'+index).html('<option value="">চিহ্নিত করুন </option>');
            if (response.status == 'success') {
                $.each(response.data, function (indexed, Obj) {
                    $('#projejeno'+index).append('<option value="' + indexed + '">' + Obj + '</option>')
                    $('#tottabodane'+index).append('<option value="' + indexed + '">' + Obj + '</option>')
                })
            }
        }
    });
}

function addTimepicker() {
    $('.timepicker').datetimepicker({
        format: 'hh:mm a'
    });
}

function makeRow(index) {
    var rowId = index;
    var row = `
        <tr id="${rowId}">
            <td>
                <select style='width:100px;' placeholder="বার" id='days${rowId}' multiple  onchange='addData(${rowId})' class='select2'>
                    <option value="8">প্রতিদিন</option>
                    <option value="1">শনিবার</option>
                    <option value="2">রবিবার</option>
                    <option value="3">সোমবার</option>
                    <option value="4">মঙ্গলবার</option>
                    <option value="5">বুধবার</option>
                    <option value="6">বৃহস্পতিবার</option>
                    <option value="7">শুক্রবার</option>
                    
                </select>
            </td>
           <td>
                <select style='width:120px;' placeholder="চিহ্নিত করুন" id='week${rowId}' multiple  onchange='addData(${rowId})' class='select2'>
                   
                    <option value="7" selected >প্রতি সপ্তাহ </option>
                    <option value="1">১ম</option>
                    <option value="2">২য়</option>
                    <option value="3">৩য়</option>
                    <option value="4">৪র্থ</option>
                    <option value="5">৫ম</option>
                    <option value="6">শেষ</option>
                    
                </select>
            </td>
            
            <td>
                <input type='text' autocomplete='off' id='time${rowId}' value='' onblur='addData(${rowId})'  placeholder='সময়' class='form-control  timepicker'>
            </td>
             
            
            <td>
                <input type='text' id='program_chunk${rowId}' autocomplete='off' value='' onkeyup='addData(${rowId})' placeholder='অনুষ্ঠানের নাম' class='form-control'>
            </td>
            <td>
                <input type='text' id='title${rowId}' autocomplete='off' value='' onkeyup='addData(${rowId})' placeholder='অনুষ্ঠানের বিবরন' class='form-control'>
            </td>
            <td>
                <textarea id='description${rowId}' autocomplete='off' onkeyup='addData(${rowId})' placeholder='বিষয়বস্তু' class='form-control'></textarea>
            </td>
            
            <td>
                <input type='text' autocomplete='off' id='stability${rowId}' value='' onkeyup='addData(${rowId})'  placeholder='স্থিতি' class='form-control'/>
            </td>
            <td>
                <input type='text' id='comment${rowId}' autocomplete='off' value='' onkeyup='addData(${rowId})'  placeholder='মন্তব্য' class='form-control'>
            </td>
              <td>
                <input type='checkbox' id='recoarded${rowId}' onclick='addData(${rowId})'>
            </td>
            <td>
                <select  id='projejeno${rowId}'   onchange='addData(${rowId})' class='form-control'>
                   <option value=''>চিহ্নিত করুন</option>
                </select>
            </td>
            <td>
                <select  id='tottabodane${rowId}'   onchange='addData(${rowId})' class='form-control'>
                   <option value=''>চিহ্নিত করুন</option>
                </select>
            </td>
            
            <td>
                <input type='text' id='sorting${rowId}' autocomplete='off' value='' onkeyup='addData(${rowId})'  placeholder='ক্রমিক' class='form-control'>
            </td>
          
            
            <td>
                <button type='button' class='btn btn-warning btn-flat btn-sm' onclick='removeRow(${rowId})'><i class='glyphicon glyphicon-remove'></i></button>
            </td>
            
        </tr>
        
        `;

    return row;
}

function removeRow(index) {
    schedule = JSON.parse($("#schedule").val());
    schedule.splice(index, 1);
    $("#" + index).remove();
    $("#schedule").val(JSON.stringify(schedule));
}

function addData(index) {
    schedule = JSON.parse($("#schedule").val());
    schedule[index].days = $("#days" + index).val();
    schedule[index].week = $("#week" + index).val();
    schedule[index].time = $("#time" + index).val();
    schedule[index].stability = $("#stability" + index).val();
    schedule[index].chank = $("#program_chunk" + index).val();
    schedule[index].biboron = $("#title" + index).val();
    schedule[index].description = $("#description" + index).val();
    schedule[index].comment = $("#comment" + index).val();
    schedule[index].projejeno = $("#projejeno" + index).val();
    schedule[index].tottabodane = $("#tottabodane" + index).val();
    schedule[index].sorting = $("#sorting" + index).val();
    schedule[index].is_recorded = $("#recoarded" + index).is(":checked") ? true : false;
    $("#schedule").val(JSON.stringify(schedule));
}

function entryWindow() {
    $("#saveBtn").show();
    $("#updateBtn").hide();
    $("#schedule_id").val('');
    $("#station_id").val('');
    $("#sub_station_id").val('');
    $("#day_name").val('');
    $("#heading-title").html('নতুন অনুষ্ঠান সূচি এন্টি ');
    odivision = JSON.parse($("#odivision").val());
    dynamicOdivision =  JSON.parse($("#dynamic_odivision_array").val());
    for (var key in odivision) {
        var targetDiv = $("#dynamicJobHistorytr_"+key);
        targetDiv.empty();
        var row = makeRow(key,0);
        $(row).appendTo(targetDiv);
        addTimepicker();
    }
    $("#schedule").val('');
}

function updateWindow(schedule_id , content , station_id, sub_station_id, day_id) {

    $("#saveBtn").hide();
    $("#updateBtn").show();
    $("#schedule_id").val(schedule_id);
    $("#station_id").val(station_id);
    $("#day_name").val(day_id);
    $("#heading-title").html('সময়সূচী আপডেট');
    getSubStation(station_id,sub_station_id); // sub station

    schedule = JSON.parse(content);
    odivision = JSON.parse($("#odivision").val());
    dynamicOdivision = schedule;

    for (var parentKey in odivision) {

        var targetDiv = $("#dynamicJobHistorytr_"+parentKey);
        targetDiv.empty();
        if( schedule.hasOwnProperty(parentKey) ) { // old odivision

            for (var chieldKey in schedule[parentKey]) {

                var rowId = parentKey+'-'+chieldKey;
                var row = makeRow(parentKey,chieldKey,schedule[parentKey][chieldKey]);
                $(row).appendTo(targetDiv);

                if(schedule[parentKey][chieldKey].is_recorded==true) {
                    document.getElementById("recoarded"+rowId).checked = true;
                }
                addTimepicker();
            }
        }
        else { // new odivision
            addRow(parentKey)
        }
    }

    $("#schedule").val(JSON.stringify(dynamicOdivision));

}

function deletedaySchedule(id) {


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
                    url: base_url + "/delete_master_day_program_time_table",
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


function deletedateSchedule(id) {


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
                    url: base_url + "/delete_master_date_program_time_table",
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


$(document).ready(function (e) {
    $("#program_time_table_setup_form").on('submit',(function(e) {
        e.preventDefault();
        $.ajax({
            url: base_url + "/save_master_day_program_time_table", // Url to which the request is send
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
                    $('#form_output').html(error_html);
                } else {
                    $('#form_output').html('');
                    swal({
                        text: data.success,
                        icon: "success",
                    }).then(function () {
                        window.location=base_url + '/' + data.redirect_page;
                    });
                }
            }
        });
    }));


    $("#program_date_setup_form").on('submit',(function(e) {
        e.preventDefault();
        $.ajax({
            url: base_url + "/save_master_date_program_time_table", // Url to which the request is send
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
    }));

});

/////////// broadcast schedule /////////////

function showOverwriteDetails($parentKey, checkbox) {
    $titleId = "title_" + $parentKey;
    $detailsId = "overwrite_details_" + $parentKey;
    schedule_data = JSON.parse($("#schedule").val());
    // console.log($parentKey);
    // return;
    schedule_data[$parentKey]['overwrite_details'] = '';
    if (checkbox.checked) {
        $("#" + $titleId).css('display', 'none');
        $("#" + $detailsId).css('display', 'block');
        $("#" + $detailsId).val('');
        schedule_data[$parentKey]['is_overwrite'] = true;
        $("#" + $detailsId).attr('required', 'required');
        $("#onusan_name_"+$parentKey).attr("readonly", false);
         $("#time_"+$parentKey).attr("readonly", false);
       
    }
    else {
        $("#" + $detailsId).val('');
        $("#" + $titleId).css('display', 'block');
        $("#" + $detailsId).css('display', 'none');
        schedule_data[$parentKey]['is_overwrite'] = false;
        $("#" + $detailsId).removeAttr('required');
        $("#onusan_name_"+$parentKey).attr("readonly", true);
        $("#time_"+$parentKey).attr("readonly", true);

    }
    console.log($parentKey);
    $("#schedule").val(JSON.stringify(schedule_data));
}

function pushPlaylist($parentKey) {
    $titleId = "title_" + $parentKey;
    $detailsId = "overwrite_details_" + $parentKey;
    schedule_data = JSON.parse($("#schedule").val());
    // console.log($parentKey);
    // return;
    schedule_data[$parentKey]['overwrite_details'] = '';
    if (checkbox.checked) {
        $("#" + $titleId).css('display', 'none');
        $("#" + $detailsId).css('display', 'block');
        $("#" + $detailsId).val('');
        schedule_data[$parentKey]['is_overwrite'] = true;
        $("#" + $detailsId).attr('required', 'required');
        $("#onusan_name_"+$parentKey).attr("readonly", false);
        $("#time_"+$parentKey).attr("readonly", false);

    }
    else {
        $("#" + $detailsId).val('');
        $("#" + $titleId).css('display', 'block');
        $("#" + $detailsId).css('display', 'none');
        schedule_data[$parentKey]['is_overwrite'] = false;
        $("#" + $detailsId).removeAttr('required');
        $("#onusan_name_"+$parentKey).attr("readonly", true);
        $("#time_"+$parentKey).attr("readonly", true);

    }
    console.log($parentKey);
    $("#schedule").val(JSON.stringify(schedule_data));
}

function modifySchedule($parentKey, $title) {
    schedule_data = JSON.parse($("#schedule").val());
    $detailsId = "overwrite_details_" + $parentKey;
    schedule_data[$parentKey]['is_overwrite'] = true;
    schedule_data[$parentKey]['overwrite_details'] = $title;
    $("#schedule").val(JSON.stringify(schedule_data));
}

function removeSchedule($parentKey) {
    schedule_data = JSON.parse($("#schedule").val());
    $schedule_id = "schedule_" + $parentKey;
    schedule_data.splice($parentKey, 1);
    $("#schedule").val(JSON.stringify(schedule_data));
    $("#" + $schedule_id).remove();
}


function getSubStation(station_id, selected = '') {
    $.ajax({
        type: "GET",
        url: base_url + "/getSubStation",
        data: {parent_id: station_id},
        'dataType': 'json',
        success: function (response) {

            $("#sub_station_id").html('');
            var options = "<option value=''>চিহ্নিত করুন</option>";
            response.forEach(function(item , index){
                options += "<option value='"+item.id+"'>"+item.title +" ("+item.fequencey+")</option>";
            });
            $("#sub_station_id").html(options);

            $("#sub_station_id").val(selected);
            
            if($("#onurup_ids")) {
                $("#onurup_ids").html(options);
            }

        }
    });
}



function getArtistGrade(type, selected = '') {
    $.ajax({
        type: "GET",
        url: base_url + "/getArtistGrade",
        data: {type_id: type},
        'dataType': 'json',
        success: function (response) {

            $("#artist_grade").html('');
            var options = "<option value=''>চিহ্নিত করুন</option>";
            response.forEach(function(item , index){
                options += "<option value='"+item.id+"'>"+item.title +"</option>";
            });
            $("#artist_grade").html(options);

            $("#artist_grade").val(selected);

        }
    });
}

function loadSchedule(station_id,sub_station_id,date) {
    if(station_id != '' && sub_station_id !='' && date != '' ) {
        $("#loadSchedule").load(base_url + "/master_date_schedule_load/"+station_id+"/"+sub_station_id+"/"+date);
    }
    else {
        $("#loadSchedule").empty();
    }
}

function loadScheduleReport(id) {
    $("#showScheduleReport").load(base_url + "/master_day_schedule_report/"+id);
}

function loadProgramPlan(station_id,sub_station_id,date) {
    $("#programPlan").load(base_url + "/program_plan_report_load/"+station_id+"/"+sub_station_id+"/"+date);
}



$(document).on("change", "#fixed_program_type", function (e) {
    var fixed_type_id=$(this).val();
    $.ajax({
        type: "POST",
        url: base_url + "/show_sub_fixed_program_type",
        data: {fixed_type_id: fixed_type_id},
        'dataType': 'json',
        success: function (response) {
            $('#sub_fixed_program_type').html('<option value="">সাব-বার্ষিকী অনুষ্ঠানের ধরন</option>');
            if (response.status == 'success') {
                $.each(response.data, function (index, Obj) {
                    $('#sub_fixed_program_type').append('<option value="' + index + '">' + Obj + '</option>')
                })
            }
        }
    });

});

$( ".artist_song_ctg" ).change(function() {
    var ctg_id=$(this).val();
    $.ajax({
        type: "POST",
        url: base_url + "/get_description_info",
        data: {ctg_id:ctg_id},
        'dataType': 'json',
        success: function (response) {
            if(response.status=='success'){
                var data=response.data;
                $('.description').html('');
                var options =  '<option value="">চিহ্নিত করুন</option>';
                $(data).each(function(index, value){
                    options += '<option value="'+value.id+'">'+value.title+'</option>';
                });
                $('.description').html(options);
            }else{
                $('.description').html('<option value="">চিহ্নিত করুন</option>');
            }
        }
    });
});

$( "#artist_ctg" ).change(function() {
    var artist_ctg_id=$(this).val();
    if(artist_ctg_id==1){
        $("#staff_artist").show();
    }else{
        $("#staff_artist").hide();
    }
});



function addEventYearlyProgram() {
    $("#event_yearly_program_setup_form")[0].reset();
    $("#saveBtn").show();
    $("#updateBtn").hide();
    $("#heading-title").html('নতুন  উৎসবাদী ও বার্ষিকীর তালিকা এন্টি ');
    $("#is_active").val(1);
    $("#event_id").val('');
    $('#artist_chart_info_add').html('');

}
function saveEventYearlyProgram() {
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
                    url: base_url + "/save_save_event_yearly_program",
                    data: $('#event_yearly_program_setup_form').serialize(),
                    'dataType': 'json',
                    success: function (data) {
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#form_output').html(error_html);
                        } else {
                            $('#event_yearly_program_setup_form')[0].reset();
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

function updateEventYearlyProgram(row) {
    console.log(row);
    var data = JSON.parse(row);
    $("#event_yearly_program_setup_form")[0].reset();
    $("#updateBtn").show();
    $("#saveBtn").hide();
    $("#heading-title").html('উৎসবাদী ও বার্ষিকীর তালিকা তথ্য পরিবর্তন ');
    $("#is_active").val(1);
    $("#event_id").val(data.id);
    $("#category").val(data.name);
    $("#main_display_position").val(data.display_position);
    $("#is_active").val(data.is_active);

    $.ajax({
        type: "POST",
        url: base_url + "/get_all_sub_fixed_program_type",
        data: {fixed_type_id: data.id},
        'dataType': 'json',
        success: function (response) {
            if (response.status == 'success') {
                $('#artist_chart_info_add').html('');
                $('#new_data').html('');
                var scntartist_chart_info_add = $('#artist_chart_info_add');
                var b = 1;
                $.each(response.data, function (index, Obj) {
                    if(Obj.name!=null) { var name = Obj.name;  }else{  var name ='';    }
                    
                    console.log(Obj.display_position);
                    if(Obj.description==null) {  var description =''  }else{  var description = Obj.description;;    }
                    console.log(description);
                    if(Obj.event_date!=null){ var event_date=Obj.event_date; }else{ var event_date=''; }
                    if(Obj.comments!=null){ var comments=Obj.comments; }else{ var comments=''; }
                    if(Obj.display_position!=null){ var display_position=Obj.display_position; }else{ var display_position=''; }
                    $('<tr><td><input type="hidden" name="ids[]" value="'+ Obj.id +'"> <input type="text"' +
                        ' placeholder="বিবরন"' +
                        ' value="'+name +'" class="form-control"' +
                        ' required' +
                        ' name="event_name[]"' +
                        ' id="event_name_' +  Obj.id + '"></td><td><input type="text" value="'+description+'"  id="description"' +
                        ' class="form-control" ' +
                        'placeholder="বাংলা তারিখ" name="description[]"/></td>  <td><input type="text"' +
                        ' value="'+ event_date +'"  id="eng_event_date_' +Obj.id +
                        '" class="form-control" placeholder="ইংরেজী তারিখ"  value="" name="eng_event_date[]"/></td>' +
                        ' <td> <textarea  rows="1" id="remarks_info_' + b + '" class="form-control"' +
                        ' placeholder="মন্তব্য" name="remarks_info[]">'+ comments +'</textarea>  </td>  <td>  <input' +
                    ' type="text"  id="display_position_'+ Obj.id +'" class="form-control onlyNumber"' +
                        '  placeholder="পজিশন"' +
                        '  value="'+display_position+'" name="display_position[]"/></td><td><a href="javascript:void(0);"' +
                        '  id="deleteRow_' + Obj.id + '"  class="deleteRow btn btn-warning btn-flat btn-sm"><i' +
                        ' class="glyphicon glyphicon-remove"></i>  Drop</a></td></tr>').appendTo(scntartist_chart_info_add);

                    $('#eng_event_date_'+Obj.id).datepicker({
                        dateFormat: 'dd-mm-yy',
                        changeMonth: true,
                        changeYear: true,
                    });
                    b++;
                //    return false;
                })
            }
        }
    });

}

function searchPlanningInfo() {
    $.ajax({
        type: "POST",
        url: base_url + "/search_planning_info",
        data: $('#searchPlanningInfoFrom').serialize(),
        success: function (data) {
            if (data!='') {
                $('#form_output').html(data);
            }
        }
    });
}
function searchProposalInfo() {
    $.ajax({
        type: "POST",
        url: base_url + "/proposal_khata_action",
        data: $('#searchProposalInfoFrom').serialize(),
        success: function (data) {
            if (data!='') {
                $('#form_output').html(data);
            }
        }
    });
}
function searchContractInfo() {
    $.ajax({
        type: "POST",
        url: base_url + "/contract_khata_action",
        data: $('#searchContractInfoFrom').serialize(),
        success: function (data) {
            if (data!='') {
                $('#form_output').html(data);
            }
        }
    });
}

function searchRecordingPerformanceInfo() {
    $.ajax({
        type: "POST",
        url: base_url + "/recording_performance_khata_action",
        data: $('#searchRecordingPerformanceInfoFrom').serialize(),
        success: function (data) {
            if (data!='') {
                $('#form_output').html(data);
            }
        }
    });
}
function searchPendingPaymentInfo() {
    $.ajax({
        type: "POST",
        url: base_url + "/waiting_payment_action",
        data: $('#searchPendingPaymentInfoForm').serialize(),
        success: function (data) {
            if (data!='') {
                $('#form_output').html(data);
            }
        }
    });
}
function makePaymentProgram() {
    $.ajax({
        type: "POST",
        url: base_url + "/make_payment_action",
        data: $('#makePaymentProgramForm').serialize(),
        'dataType': 'json',
        success: function (data) {
            if(data.status=='error'){
                $('#form_output_make_payment').html(data.message);
            }else{
                $('#makePaymentProgramForm')[0].reset();
                $('#form_output_make_payment').html('');
                swal({
                    text: data.message,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }

        }
    });
}

function searchCompletePaymentInfo() {
    $.ajax({
        type: "POST",
        url: base_url + "/complete_payment_action",
        data: $('#searchCompletePaymentInfoForm').serialize(),
        success: function (data) {
            if (data!='') {
                $('#form_output').html(data);
            }
        }
    });
}

function artist_exp_show_fun(checked) {
    if(checked.checked) {
        $("#experience_info_show").css('display','block');
    }
    else {
        $("#experience_info_show").css('display','none');
    }
    $("#expertise_1").val('');
    $("#expertise_dept_1").val('');
    $("#artist_grade").val('');
}
function programScheduleApproved(id) {

    swal({
        title: "Are you sure?",
        text: "Once Approved, You will not be able to recover this record",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/approved_master_date_program_time_table_info",
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

function back(){
    parent.history.back();
    return false;
}
function odivision_bicuti_info(time,id,station,fequencey,date,bicuti_info=null){
    $('#save_protram_bicuti_info_form')[0].reset();
    $("#bicuti_id").val(id);
    $("#bicuti_time").val(time);
    $("#bicuti_station").val(station);
    $("#bicuti_fequencey").val(fequencey);
    $("#bicuti_date").val(date);
    if(bicuti_info==null) {
        $("#bicuti_reason").val('');
        $("#bicuti_time_start").val('');
        $("#bicuti_time_end").val('');
        $("#bicuti_stability").val('');
        $("#bicuti_comments").val('');
        $("#show_btn_title").html('Save');
    }else{
        var bicuti_info=JSON.parse(bicuti_info);
        $("#bicuti_reason").val(bicuti_info.bicuti_reason);
        $("#bicuti_time_start").val(bicuti_info.bicuti_time_start);
        $("#bicuti_time_end").val(bicuti_info.bicuti_time_end);
        $("#bicuti_stability").val(bicuti_info.bicuti_stability);
        $("#bicuti_comments").val(bicuti_info.bicuti_comments);
        $("#show_btn_title").html('Update');
    }
    $("#odivision_info_add").modal();
}

function save_bicuti_info() {
        $.ajax({
            type: "POST",
            url: base_url + "/save_protram_bicuti_info",
            data: $('#save_protram_bicuti_info_form').serialize(),
            'dataType': 'json',
            success: function (data) {
                if (data.status=='error') {
                    $('#form_output').html(data.message);
                } else {
                    $('#save_protram_bicuti_info_form')[0].reset();
                    $('#form_output').html('');
                   // $('#odivision_info_add').modal(toggle);
                    $('#odivision_info_add').modal('hide');
                    swal({
                        text: data.message,
                        icon: "success",
                    }).then(function () {
                        location.reload();
                    });
                }
            }
        });

}

function update_odivision_info_form() {
    $.ajax({
        type: "POST",
        url: base_url + "/update_odivision_info_info",
        data: $('#update_odivision_info_form').serialize(),
        'dataType': 'json',
        success: function (data) {
            if (data.status=='error') {
                $('#form_output').html(data.message);
            } else {
                $('#update_odivision_info_form')[0].reset();
                $('#form_output').html('');
               // $('#odivision_info_add').modal(toggle);
                $('#odivision_info_add').modal('hide');
                swal({
                    text: data.message,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });
}

function update_odivision_info_presentaion_form() {
    $.ajax({
        type: "POST",
        url: base_url + "/update_odivision_presentation_info_info",
        data: $('#update_odivision_presentation_info_form').serialize(),
        'dataType': 'json',
        success: function (data) {
            if (data.status=='error') {
                $('#form_output').html(data.message);
            } else {
                $('#update_odivision_info_form')[0].reset();
                $('#form_output').html('');
               // $('#odivision_info_add').modal(toggle);
                $('#odivision_info_add').modal('hide');
                swal({
                    text: data.message,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });
}



$('#bicuti_time_start,#bicuti_time_end').on('blur',function() {
    var start_time = $('#bicuti_time_start').val();
    var end_time = $('#bicuti_time_end').val();
    var today = moment().format('YYYY-M-D');
    var diff = ( new Date("1970-01-01 " + end_time) - new Date("1970-01-01 " + start_time) ) / 1000 / 60 ;
    if(diff>0) {
        $('#bicuti_stability').val(diff + ' মিনিট');
    }else{
        $('#bicuti_stability').val(' ');
    }
});


function deletePresentationSetting(id) {
    swal({
        title: "Are you sure?",
        text: "Once Save, You will delete this record",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/delete_presentation_setting",
                    data: {id:id},
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

function deletePresentationInfo(month_id,station_id,type) {
    swal({
        title: "Are you sure?",
        text: "Once Save, You will delete this record",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/delete_presentation",
                    data: {month_id:month_id,station_id:station_id,type:type},
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

function planningAgainPresntation(month_id,station_id,is_active,type=1) {
    swal({
        title: "Are you sure?",
        text: "Move to Planning, If Click, Then Its Moves to Planning",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/re_status_update_presentation_info",
                    data: {station_id: station_id,month_id: month_id,is_active:is_active,type:type},
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
                            alert(response.message);
                            return false;
                        }
                    }
                });
            } else {
                swal("Cancelled Now!");
            }
        });

}

function searchProposalInfoPresentation() {
    $.ajax({
        type: "POST",
        url: base_url + "/proposal_khata_presentation_action",
        data: $('#searchProposalInfoFrom').serialize(),
        success: function (data) {
            if (data!='') {
                $('#form_output').html(data);
            }
        }
    });
}


// performance

function searching_performance_info() {
    $('.mydivAjaxImage').show();
    $.ajax({
        type: "POST",
        url: base_url + "/searching_performance_info",
        data: $('#save_performance_info_form').serialize(),
        success: function (response) {
            if (response!= '') {
                $("#loadDateData").html(response);
                $('.select2').select2();
                $('.datepickerinfo').datepicker({
                    dateFormat: 'yy-mm-dd',
                    changeMonth: true,
                    changeYear: true,
                });
            } else {
                alert(message);
                return false;
            }
            $('.mydivAjaxImage').hide();
        }
    });
}

function saveperformanceInfoPresentation() {
    $("#presentation_performance_btn").attr("disabled", true);
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
                    url: base_url + "/save_performance_info",
                    data: $('#save_performance_info_form').serialize(),
                    'dataType': 'json',
                    success: function (data) {
                        $("#presentation_performance_btn").attr("disabled", false);
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#form_output').html(error_html);
                        } else {
                            $('#save_performance_info_form')[0].reset();
                            $('#form_output').html('');
                            swal({
                                text: data.success,
                                icon: "success",
                            }).then(function () {
                               // location.reload();
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

// biklolpo informatin

function searching_presentation_info_bikolpo(serial_no) {
    $('.mydivAjaxImage').show();
    $.ajax({
        type: "POST",
        url: base_url + "/searching_bikolpo_presentation_info",
        data: $('#searching_bikolpo_presentation_info_form').serialize(),
        success: function (response) {
            if (response!= '') {
                $("#loadDateData_"+serial_no).html(response);
             //   $('.select2').select2();
                $('.datepickerinfo').datepicker({
                    dateFormat: 'yy-mm-dd',
                    changeMonth: true,
                    changeYear: true,
                });
            } else {
                alert(message);
                return false;
            }
            $('.mydivAjaxImage').hide();
        }
    });
}
function updateBikolpoInfo() {
    $("#updateBikolpoInfoBtn").attr("disabled", true);
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
                    url: base_url + "/save_bikolpo_presentation_info",
                    data: $('#searching_bikolpo_presentation_info_form').serialize(),
                    'dataType': 'json',
                    success: function (data) {
                        $("#presentation_performance_btn").attr("disabled", false);
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#form_output').html(error_html);
                        } else {
                            $('#searching_bikolpo_presentation_info_form')[0].reset();
                            $('#form_output').html('');
                            swal({
                                text: data.success,
                                icon: "success",
                            }).then(function () {
                                // location.reload();
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

function approvedPresentationInfoBikolpo(month_id,station_id,fequency,is_active,type=1) {
    swal({
        title: "Are you sure?",
        text: "Planning Approved,If Approved, Then Its Move to Proposal",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/status_update_presentation_info_bikolpo",
                    data: {month_id: month_id,station_id: station_id,fequency: fequency,is_bikolpo:is_active,type:type},
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
                            alert(response.message);
                            return false;
                        }
                    }
                });
            } else {
                swal("Cancelled Now!");
            }
        });

}

function autocompletePlaylistInfo(id) {
    var data=("#playlist_info_"+id);
    if ( data.trim() == '') {
        $("#playlist_info_"+id).val('');
        return false;
    }
    var options = {
        minLength: 1,
        source: function (request, response) {
            $.ajax({
                url: base_url + "/show_all_playlist_info",
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
             
                $("#playlist_info_"+id).val(ui.item.value);
                $("#playlist_info_id_"+id).val(ui.item.id);
            }else{
                $("#playlist_info_"+id).val('');
                $("#playlist_info_id_"+id).val('');
            }
            return false;
        }
    };
    $('body').on('keydown.autocomplete', "#playlist_info_"+id, function() {
        $(this).autocomplete(options);
    });
}

function searching_artist_info() {
    $('.mydivAjaxImage').show();
    $.ajax({
        type: "POST",
        url: base_url + "/rep_artist_record",
        data: $('#show_artist_info_form').serialize(),
        success: function (response) {
            $('.mydivAjaxImage').hide();
            if (response!= '') {
                $("#show_artist_info").html(response);
            } else {
                alert(message);
                return false;
            }
        }
    });
}

function autocompleteArtistInfo(data) {
    if ( data.value.trim() == '') {
        $('#artist_info_search').val('');
        return false;
    }
    var options = {
        minLength: 1,
        source: function (request, response) {
            $.ajax({
                url: base_url + "/searching_artist_info",
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
            console.log(ui.item);
            if(ui.item.value !='') {
                $('#artist_info_search_data').val(ui.item.value);
                $('#artist_info_search_data_id').val(ui.item.id);
            }else{
                $('#artist_info_search_data').val('');
                $('#artist_info_search_data_id').val('');
            }
            return false;
        }
    };
    $('body').on('keydown.autocomplete', '#artist_info_search_data', function() {
        $(this).autocomplete(options);
    });
}