function autocompletebrodcastPlace(data) {
        
    var options = {
        minLength: 1,
        source: function (request, response) {
            $.ajax({
                url: base_url + "/get_boardcast_frequency",
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
                $('#prochar_sthan').val(ui.item.value);
            }else{
                $('#prochar_sthan').val('');
            }
            return false;
        }
    };
    $('body').on('keydown.autocomplete', '#prochar_sthan', function() {
        $(this).autocomplete(options);
    });
}

function autocompletefilmActor(data) {
        
    var options = {
        minLength: 1,
        source: function (request, response) {
            $.ajax({
                url: base_url + "/get_film_actor",
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
            if(ui.item.name !='') {
                $('#film_actor').val(ui.item.name);
            }else{
                $('#film_actor').val('');
            }
            return false;
        }
    };
    $('body').on('keydown.autocomplete', '#film_actor', function() {
        $(this).autocomplete(options);
    });
}


function autocompletefilmDirector(data) {
        
    var options = {
        minLength: 1,
        source: function (request, response) {
            $.ajax({
                url: base_url + "/get_film_director",
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
            if(ui.item.name !='') {
                $('#film_director').val(ui.item.name);
            }else{
                $('#film_director').val('');
            }
            return false;
        }
    };
    $('body').on('keydown.autocomplete', '#film_director', function() {
        $(this).autocomplete(options);
    });
}

//////// audio player start ///////

player = document.getElementById("player");

var currentSong  = '';

function audioAction(songName,id) {
    $(".playbtn").html("<i class='fa fa-play'></i>");
    if(currentSong != songName) {
        player.src=songName;
        player.load(); // load song
        player.play(); // start new song
        $("#btn"+id).html("<i class='fa fa-pause'></i>");
    }
    else {
        if (player.paused) {
            player.play(); // play again
            $("#btn"+id).html("<i class='fa fa-pause'></i>");
        }
        else {
            player.pause(); // pause
            $("#btn"+id).html("<i class='fa fa-play'></i>");
        }
    }
    currentSong = songName;
}

function loadAudio(event) {
    var files = event.target.files;
    player.src=URL.createObjectURL(files[0]);
    player.load(); // load song
    $("#play_button").show();
}
var audioFile = document.getElementById("audioFile");
if(audioFile) {
    audioFile.addEventListener("change", loadAudio, false);
}

function playsong() {
    if (player.paused) {
        player.currentTime=0;
        player.play(); // replay
        $("#play_button").html("<i class='fa fa-pause'></i>");
    }
    else {
        player.pause(); // pause
        $("#play_button").html("<i class='fa fa-play'></i>");
    }
}

/////////// audio player end ///////////////

$(document).on("change", "#jatio_dibos", function (e) {
    var fixed_type_id=$(this).val();
    $.ajax({
        type: "POST",
        url: base_url + "/show_sub_fixed_program_type",
        data: {fixed_type_id: fixed_type_id},
        'dataType': 'json',
        success: function (response) {
            $('#jatio_dibos_type').html('<option value="">বাছাই করুণ</option>');
            if (response.status == 'success') {
                $.each(response.data, function (index, Obj) {
                    $('#jatio_dibos_type').append('<option value="' + index + '">' + Obj + '</option>')
                })
            }
        }
    });

});


function autocompleteInstument(data) {
    var options = {
        minLength: 1,
        source: function (request, response) {
            $.ajax({
                url: base_url + "/get_instument",
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
            console.log(ui);
            if(ui.item.name !='') {
                $('#instument').val(ui.item.label);
            }else{
                $('#instument').val('');
            }
            return false;
        }
    };

    $('body').on('keydown.autocomplete', '#instument', function() {
        $(this).autocomplete(options);
    });
}




function add_film_artist_row(){
    var artist_id = $("#film_actor").val();
    var tr = `
        <tr>
            <td>
                <input type="text" readonly placeholder="অভিনয় শিল্পী" name="film_actor[]" value="${artist_id}" class="form-control"/>
            </td>
            <td>
                <button type="button" onClick="this.parentNode.parentNode.remove()" class="btn btn-danger btn-sm"><i class="fa fa-minus"></i></button>
            </td>
        </tr>
    `;

    $("#film_artist_row").prepend(tr);
    $("#film_actor").val('');
}

function add_film_director_row(){
    var artist_id = $("#film_director").val();
    var tr = `
        <tr>
            <td>
                <input type="text" readonly placeholder="চলচিত্র পরিচালক" name="film_director[]" value="${artist_id}" class="form-control"/>
            </td>
            <td>
                <button type="button" onClick="this.parentNode.parentNode.remove()" class="btn btn-danger btn-sm"><i class="fa fa-minus"></i></button>
            </td>
        </tr>
    `;

    $("#film_director_row").prepend(tr);
    $("#film_director").val('');
}

function reinitialize_archiveids(id){
    archiveids_initialize(id);
}

function archiveids_initialize(id=0) {
    $(".select2-archiveids").select2({
        ajax: {
            url: base_url + "/get_archive_ids",
            // url: "http://medilifeshl.com/bangladeshbetar/get_artist_info",
            dataType: 'json',
            data: function (params) {
                // var searchid = this[0].attributes['search_type'].nodeValue;
                var searchid = id;
                var query = {
                    search: params.term,
                    archive_type: searchid
                }

                // Query parameters will be ?search=[term]&type=public
                return query;
            },
            processResults: function (data) {
                console.log(data);
                // Transforms the top-level key of the response object from 'items' to 'results'
                return {
                    results: data
                };
            }
        }

    });
    $(".select2-archiveids").val('').trigger('change');
}

function archive_type_initialize() {
    $(".select2-archive_type").select2({

        ajax: {
            url: base_url + "/get_archive_type",
            dataType: 'json',
            data: function (params) {
                var searchid = this[0].attributes['searchid'].nodeValue;
                var query = {
                    search: params.term,
                    archive_type: searchid
                }

                // Query parameters will be ?search=[term]&type=public
                return query;
            },
            processResults: function (data) {
                console.log(data);
                // Transforms the top-level key of the response object from 'items' to 'results'
                return {
                    results: data
                };
            }
        }

    });
}

// function changeSakhhatkarDepartment(id) {
//     if(id==1){
//         $("#sakhhatkar_vhittik").show();
//         $("#alochona_onusthan,#sms,#phone_in_program,#protibedon,#bitorko_table").hide();
//     }
//     else if(id==2){
//         $("#alochona_onusthan").show();
//         $("#sakhhatkar_vhittik,#sms,#phone_in_program,#protibedon,#bitorko_table").hide();
//     }
//     else if(id==3){
//         $("#sms").show();
//         $("#sakhhatkar_vhittik,#alochona_onusthan,#phone_in_program,#protibedon,#bitorko_table").hide();
//     }
//     else if(id==4){
//         $("#phone_in_program").show();
//         $("#sakhhatkar_vhittik,#alochona_onusthan,#sms,#protibedon,#bitorko_table").hide();
//     }
//     else if(id==5){
//         $("#protibedon").show();
//         $("#sakhhatkar_vhittik,#alochona_onusthan,#sms,#phone_in_program,#bitorko_table").hide();
//     }
//     else {
//         $("#bitorko_table").show();
//         $("#sakhhatkar_vhittik,#alochona_onusthan,#sms,#phone_in_program,#protibedon").hide();
//     }
// }

sakhhatkar_bivag = [];
function sakhhatkarDepartmentCheck(checkbox) {
    if(checkbox.checked){
        sakhhatkar_bivag.push(checkbox.value);
    }
    else {
        var index = sakhhatkar_bivag.indexOf(checkbox.value);
        if (index > -1) {
            sakhhatkar_bivag.splice(index, 1);
        }
    }


    $("#sakhhatkar_vhittik,#alochona_onusthan,#sms,#phone_in_program,#protibedon,#bitorko_table").hide();

    for(var i=0;i<sakhhatkar_bivag.length;i++){
        if(sakhhatkar_bivag[i]==1){
            $("#sakhhatkar_vhittik").show();
        }
        else if(sakhhatkar_bivag[i]==2){
            $("#alochona_onusthan").show();
        }
        else if(sakhhatkar_bivag[i]==3){
            $("#sms").show();
        }
        else if(sakhhatkar_bivag[i]==4){
            $("#phone_in_program").show();
        }
        else if(sakhhatkar_bivag[i]==5){
            $("#protibedon").show();
        }
        else {
            $("#bitorko_table").show();
        }
    }

}

$(document).ready(function (e) {

    /*
    * সাখহাtতকার
    * */

    $("#sakhhatkar_vhittik,#alochona_onusthan,#sms,#phone_in_program,#protibedon,#bitorko_table").hide();



    $('.datepickerLong').datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
    }).val();

    $(".select2-ajax").select2({

        ajax: {
            url: base_url + "/get_artist_info",
            // url: "http://medilifeshl.com/bangladeshbetar/get_artist_info",
            dataType: 'json',
            data: function (params) {
                var searchid = this[0].attributes['searchid'].nodeValue;
                var query = {
                    search: params.term,
                    expertise_id: searchid
                }

                // Query parameters will be ?search=[term]&type=public
                return query;
            },
            processResults: function (data) {
                console.log(data);
                // Transforms the top-level key of the response object from 'items' to 'results'
                return {
                    results: data
                };
            }
        }

    });


    archiveids_initialize();
    archive_type_initialize();


    $(".select2-ajax-vumika").select2({

        ajax: {
            url: base_url + "/get_vumika_info",
            // url: "http://medilifeshl.com/bangladeshbetar/get_artist_info",
            dataType: 'json',
            data: function (params) {
                var searchid = this[0].attributes['searchid'].nodeValue;
                var query = {
                    search: params.term,
                    archive_type: searchid
                }

                // Query parameters will be ?search=[term]&type=public
                return query;
            },
            processResults: function (data) {
                console.log(data);
                // Transforms the top-level key of the response object from 'items' to 'results'
                return {
                    results: data
                };
            }
        }

    });


    $(".film_section,.band_section").css("display","none");

    $("#song_category").change(function(){
        var category = $(this).val();
        if(category==1){
            $(".film_section,.band_section").css("display","none");
        }
        else if(category==2){
            $(".film_section").css("display","block");
            $(".band_section").css("display","none");
        }
        else {
            $(".film_section").css("display","none");
            $(".band_section").css("display","block");
        }
    });

    $("#kobita_department").change(function(){
        var category = $(this).val();
        if(category==1){
            $("#golpo_section").hide();
            $("#kobita_section").show();
        }
        else if(category==2){
            $("#golpo_section").show();
            $("#kobita_section").hide();
        }
    });
    $("#golpo_section").hide();



   

    $("#song_create_form").on('submit',(function(e) {
        e.preventDefault();
        $('.ajax-loader').show();
        $('#saveing_text').html('Saveing--');
        $(":submit").attr("disabled", true);
        $.ajax({
            url: base_url + "/save_song_create", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            'dataType': 'json',
            success: function(data)   // A function to be called if request succeeds
            {
                $('#saveing_text').html('Save');
                $(":submit").removeAttr("disabled");
                $('.ajax-loader').hide();
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

    $("#kobita_create_form").on('submit',(function(e) {
        e.preventDefault();
        $('.ajax-loader').show();
        $('#saveing_text').html('Saveing--');
        $(":submit").attr("disabled", true);
        $.ajax({
            url: base_url + "/save_kobita_create", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            'dataType': 'json',
            success: function(data)   // A function to be called if request succeeds
            {
                $('#saveing_text').html('Save');
                $(":submit").removeAttr("disabled");
                $('.ajax-loader').hide();
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


    $("#natok_create_form").on('submit',(function(e) {
        e.preventDefault();
        $('.ajax-loader').show();
        $('#saveing_text').html('Saveing--');
        $(":submit").attr("disabled", true);
        $.ajax({
            url: base_url + "/save_natok_create", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            'dataType': 'json',
            success: function(data)   // A function to be called if request succeeds
            {
                $('#saveing_text').html('Save');
                $(":submit").removeAttr("disabled");
                $('.ajax-loader').hide();
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

    $("#program_create_form").on('submit',(function(e) {
        e.preventDefault();
        $('.ajax-loader').show();
        $('#saveing_text').html('Saveing--');
        $(":submit").attr("disabled", true);
        $.ajax({
            url: base_url + "/save_program_create", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            'dataType': 'json',
            success: function(data)   // A function to be called if request succeeds
            {
                $('#saveing_text').html('Save');
                $(":submit").removeAttr("disabled");
                $('.ajax-loader').hide();
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

    $("#vhason_create_form").on('submit',(function(e) {
        e.preventDefault();
        $('.ajax-loader').show();
        $('#saveing_text').html('Saveing--');
        $(":submit").attr("disabled", true);
        $.ajax({
            url: base_url + "/save_vhason_create", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            'dataType': 'json',
            success: function(data)   // A function to be called if request succeeds
            {
                $('#saveing_text').html('Save');
                $(":submit").removeAttr("disabled");
                $('.ajax-loader').hide();
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

    $("#sakhhatkar_create_form").on('submit',(function(e) {
        e.preventDefault();
        $('.ajax-loader').show();
        $('#saveing_text').html('Saveing--');
        $(":submit").attr("disabled", true);
        $.ajax({
            url: base_url + "/save_sakhhatkar_create", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            'dataType': 'json',
            success: function(data)   // A function to be called if request succeeds
            {
                $('#saveing_text').html('Save');
                $(":submit").removeAttr("disabled");
                $('.ajax-loader').hide();
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

    $("#kothika_create_form").on('submit',(function(e) {
        e.preventDefault();
        $('.ajax-loader').show();
        $('#saveing_text').html('Saveing--');
        $(":submit").attr("disabled", true);
        $.ajax({
            url: base_url + "/save_kothika_create", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            'dataType': 'json',
            success: function(data)   // A function to be called if request succeeds
            {
                $('#saveing_text').html('Save');
                $(":submit").removeAttr("disabled");
                $('.ajax-loader').hide();
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
    $("#procharona_create_form").on('submit',(function(e) {
        e.preventDefault();
        $('.ajax-loader').show();
        $('#saveing_text').html('Saveing--');
        $(":submit").attr("disabled", true);
        $.ajax({
            url: base_url + "/save_procharona_create", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            'dataType': 'json',
            success: function(data)   // A function to be called if request succeeds
            {
                $('#saveing_text').html('Save');
                $(":submit").removeAttr("disabled");
                $('.ajax-loader').hide();
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
    // playlist create form
    $("#playlist_create_form").on('submit',(function(e) {
        e.preventDefault();
        $.ajax({
            url: base_url + "/save_playlist", // Url to which the request is send
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
    // playlist create form
    $("#playlist_update_form").on('submit',(function(e) {
        e.preventDefault();
        $.ajax({
            url: base_url + "/save_playlist_update", // Url to which the request is send
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


    // playlist create form
    $("#archive_item_correction").on('submit',(function(e) {
        e.preventDefault();
        $.ajax({
            url: base_url + "/archive_item_correction", // Url to which the request is send
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

// playlist_update_form

function song_remove_from_playlist(song_id,playlist_id) {
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
                    url: base_url + "/song_remove",
                    data: {id: playlist_id,song_id:song_id},
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


function addToPlaylist(song_id) {
    var playlistName = $("#playlist_name").val();
    swal({
        title: "Are you sure added to playlist ?",
        text: "Your active playlist , "+playlistName,
        icon: "warning",
        buttons: true,
        dangerMode: false,
    })
    .then((willDelete) => {
            if (willDelete) {
                var playlist_id = $("#playlist_id").val();
                $.ajax({
                    url: base_url + "/add_to_playlist", // Url to which the request is send
                    type: "POST",             // Type of request to be send, called as method
                    data: {song_id:song_id,playlist_id:playlist_id}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                    'dataType': 'json',
                    success: function(data)   // A function to be called if request succeeds
                    {
                        swal({
                            text: 'song successfully added to active playlist',
                            icon: "success",
                        }).then(function () {
                            // location.reload();
                        });
                    }
                });
            } else {
                swal("Cancelled Now!");
            }
    });
}

function changeStatus(id,status){
    var title = status==0?'are you sure inactive the item ?':'are you sure active the item ?';
    swal({
        title: title,
        text: '',
        icon: "warning",
        buttons: true,
        dangerMode: false,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: base_url + "/archive_change_status", // Url to which the request is send
                type: "POST",             // Type of request to be send, called as method
                data: {id:id,status:status}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                'dataType': 'json',
                success: function(data)   // A function to be called if request succeeds
                {
                    swal({
                        text: 'Archive item status change successfully',
                        icon: "success",
                    }).then(function () {
                        location.reload();
                    });
                }
            });
        } else {
            swal("Cancelled Now!");
        }
    });
}

function playListStatus(id,status) {
    var statusText = status==0?"active":"Inactive";
    swal({
        title: "Are you sure "+statusText+"?",
        // text: "Your active playlist",
        icon: "warning",
        buttons: true,
        dangerMode: false,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: base_url + "/playlist_status_update", // Url to which the request is send
                    type: "POST",             // Type of request to be send, called as method
                    data: {id:id,status:status}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                    'dataType': 'json',
                    success: function(data)   // A function to be called if request succeeds
                    {
                        swal({
                            text: 'playlist status update successfully',
                            icon: "success",
                        }).then(function () {
                            location.reload();
                        });
                    }
                });
            } else {
                swal("Cancelled Now!");
            }
        });
}


function archive_item_approved(id) {
    swal({
        title: "Are you sure Approved?",
        // text: "Your active playlist",
        icon: "warning",
        buttons: true,
        dangerMode: false,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: base_url + "/archive_item_approved", // Url to which the request is send
                    type: "POST",             // Type of request to be send, called as method
                    data: {id:id}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                    'dataType': 'json',
                    success: function(data)   // A function to be called if request succeeds
                    {
                        swal({
                            text: 'Item Archived successfully',
                            icon: "success",
                        }).then(function () {
                            location.reload();
                        });
                    }
                });
            } else {
                swal("Cancelled Now!");
            }
        });
}

function archive_item_delete(id) {
    swal({
        title: "Are you sure want to delete ?",
        // text: "Your active playlist",
        icon: "warning",
        buttons: true,
        dangerMode: false,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: base_url + "/archive_item_delete", // Url to which the request is send
                    type: "POST",             // Type of request to be send, called as method
                    data: {id:id}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                    'dataType': 'json',
                    success: function(data)   // A function to be called if request succeeds
                    {
                        swal({
                            text: 'Item Deleted successfully',
                            icon: "success",
                        }).then(function () {
                            location.reload();
                        });
                    }
                });
            } else {
                swal("Cancelled Now!");
            }
        });
}

function correction_message_modal(id){
    $("#archive_id").val(id);
}

function get_artist_name(id){
    var artist_data = JSON.parse($("#artist_json_data").val());
    if(artist_data.hasOwnProperty(id)){
        return artist_data[id];
    }
    
    return '';
}

function jontroshilpi_add() {
    var artist_id = $("#sound_artist").val();
    var hyperlink = $("#instument").val();
    var artist_name = get_artist_name(artist_id);
    $("#sound_artist").val('').trigger('change');
    var tr = `
        <tr>
            <td>
                <input type="hidden" readonly placeholder="যন্ত্রশিল্পীর নাম" name="instument_artist[]" value="${artist_id}" class="form-control"/>
           
                <input type="text" readonly class="form-control" value="${artist_name}"/>
            </td>
            <td>
                <input type="text" readonly placeholder="বাদ্যযন্ত্রের নাম" name="instument[]" value="${hyperlink}" class="form-control"/>
            </td>
            <td>
                <button type="button" onClick="this.parentNode.parentNode.remove()" class="btn btn-danger btn-sm"><i class="fa fa-minus"></i></button>
            </td>
        </tr>
    `;

    $("#sound_artist_info").prepend(tr);
    $("#instument").val('');
    $("#sound_artist").val('');

}

function reinitialize_vumika() {

    $(".select2-ajax-vumika").select2({

        ajax: {
            url: base_url + "/get_vumika_info",
            // url: "http://medilifeshl.com/bangladeshbetar/get_artist_info",
            dataType: 'json',
            data: function (params) {
                var searchid = this[0].attributes['searchid'].nodeValue;
                var query = {
                    search: params.term,
                    archive_type: searchid
                }

                // Query parameters will be ?search=[term]&type=public
                return query;
            },
            processResults: function (data) {
                console.log(data);
                // Transforms the top-level key of the response object from 'items' to 'results'
                return {
                    results: data
                };
            }
        }

    });
}

function reinitialize_artist(){
    $(".select2-ajax").select2({

        ajax: {
            url: base_url + "/get_artist_info",
            // url: "http://medilifeshl.com/bangladeshbetar/get_artist_info",
            dataType: 'json',
            data: function (params) {
                var searchid = this[0].attributes['searchid'].nodeValue;
                var query = {
                    search: params.term,
                    expertise_id: searchid
                }

                // Query parameters will be ?search=[term]&type=public
                return query;
            },
            processResults: function (data) {
                console.log(data);
                // Transforms the top-level key of the response object from 'items' to 'results'
                return {
                    results: data
                };
            }
        }

    });
}

vumika_id = 0;
function vumikashilpi_add() {
    vumika_id++;
    var tr = `
        <tr>
            <td>
                <select id="vumika_id" placeholder="ভুমিকা বাছাই করুণ" searchid="469" class="select2-ajax-vumika" name="vumika_id[${vumika_id}]" style="width:100%; !important">

                </select>
            </td>
            <td>
                <select id="vumika_artist" placeholder="অংশগ্রহণে" searchid="469" class="select2-ajax" multiple name="vumika_artist[${vumika_id}][]" style="width:100%; !important">

                </select>
            </td>
            <td>
                <button type="button" onClick="this.parentNode.parentNode.remove()" class="btn btn-danger btn-sm"><i class="fa fa-minus"></i></button>
            </td>
        </tr>
    `;

    $("#vumika_artist_info").append(tr);

    reinitialize_vumika();
    reinitialize_artist();

}


bisoybostu_id = 0;
function bisoybostu_add() {
    bisoybostu_id++;

    var type_id =  $("#archive_type_id_0").val();
    var archive_ids =  $("#archive_type_artist_id0").val();
    var string = archive_ids.join();

    var selected_type = $('#archive_type_id_0').select2('data');
    var selected_ids = $('#archive_type_artist_id0').select2('data');
    var selected_id_text = [];
    for(var i=0; i<selected_ids.length;i++) {
        selected_id_text.push(selected_ids[i].text);
    }
    var ids_join = selected_id_text.join();

    var tr = `
        <tr>
            <td>
                <input type="text" readonly class="form-control" value="${selected_type[0].text}"/>
                <input type="hidden" name="archive_type[]" value="${type_id}"/>
            </td>
            <td>
                <input type="text" readonly class="form-control" value="${ids_join}"/>
                <input type="hidden" name="archiveid[]" value="${string}"/>
            </td>
            <td>
                <button type="button" onClick="this.parentNode.parentNode.remove()" class="btn btn-danger btn-sm"><i class="fa fa-minus"></i></button>
            </td>
        </tr>
    `;

    $("#bisoybostu_section").append(tr);
    $("#archive_type_id_0").val('').trigger('change');
    $("#archive_type_artist_id0").val('').trigger('change');
}


bitorko_id = 0;
function bitorko_add() {
    bitorko_id++;

    var tr = `
        <tr>
            <td colspan="2">
                <input type="text" class="form-control" style="width:100% !important;" placeholder="প্রতিষ্ঠানের নাম" name="protisthaner_name[${bitorko_id}]"></input>
            </td>
            <td colspan="2">
                <textarea style="width:100% !important;" placeholder="প্রতিষ্ঠানের ঠিকানা" name="protisthaner_thikana[${bitorko_id}]"></textarea>
            </td>
            <td colspan="2">
                <select  searchid="459" class="select2-ajax"
                        multiple name="bitorko_ongshogrohonkari[${bitorko_id}][]"
                        style="width:100%; !important">

                </select>
                <button onClick="this.parentNode.parentNode.remove()" type="button" class="btn btn-danger btn-sm" style="float:right;"><i class="fa fa-minus"></i></button>
            </td>
        </tr>
    `;

    $('#bitorko_table > tbody > tr').eq(2).after(tr);
    initialize_shilpi_multiselect();
}

function initialize_shilpi_multiselect() {
    $(".select2-ajax").select2({

        ajax: {
            url: base_url + "/get_artist_info",
            dataType: 'json',
            data: function (params) {
                var searchid = this[0].attributes['searchid'].nodeValue;
                var query = {
                    search: params.term,
                    expertise_id: searchid
                }

                // Query parameters will be ?search=[term]&type=public
                return query;
            },
            processResults: function (data) {
                console.log(data);
                // Transforms the top-level key of the response object from 'items' to 'results'
                return {
                    results: data
                };
            }
        }

    });
}

function get_song_sub_type(id) {
    $.ajax({
        url: base_url + "/get_song_sub_type", // Url to which the request is send
        type: "POST",             // Type of request to be send, called as method
        data: {id:id}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        dataType: 'json',
        success: function(data)   // A function to be called if request succeeds
        {
            var options = "<option value=''>বাছাই করুন</option>";
            if(data.length>0) {
                for(var i=0; i<data.length;i++){
                    options+=`<option value='${data[i]['id']}'>${data[i]['name']}</option>`;
                }
            }

            $("#ganer_up_prokar").html(options);
            // console.log(data);
        }
    });
}


function get_ministry_sub_type(id) {
    $.ajax({
        url: base_url + "/get_ministry_sub_type", // Url to which the request is send
        type: "POST",             // Type of request to be send, called as method
        data: {id:id}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        dataType: 'json',
        success: function(data)   // A function to be called if request succeeds
        {
            var options = "<option value=''>বাছাই করুন</option>";
            if(data.length>0) {
                for(var i=0; i<data.length;i++){
                    options+=`<option value='${data[i]['id']}'>${data[i]['name']}</option>`;
                }
            }

            $("#doptor").html(options);
            // console.log(data);
        }
    });
}


function show_correction_message(msg) {
    $("#show_correction_msg").text(msg);
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


function ArchiveAddSetupInfo() {
    $("#type_setup_form")[0].reset();
    $("#title").val('');
    $("#setting_id").val('');
    $("#is_active").val(1);
    $("#saveBtn").show();
    $("#updateBtn").hide();
    $("#heading-title").html('Add ');
    $("#form_output").html('');
}

function UpdateBandInfo(id,name,type,year,is_active) {
    $("#type_setup_form")[0].reset();
    $("#title").val(name);
    $("#setting_id").val(id);
    $("#is_active").val(is_active);
    $("#band_type").val(type);
    $("#establish_year").val(year);
    $("#saveBtn").hide();
    $("#updateBtn").show();
    $("#heading-title").html('Update ');
    $("#form_output").html('');
}

function UpdateAlbumInfo(id,name,prokasok,date,is_active) {
    $("#type_setup_form")[0].reset();
    $("#title").val(name);
    $("#setting_id").val(id);
    $("#is_active").val(is_active);
    $("#prokashok").val(prokasok);
    $("#publish_date").val(date);
    $("#saveBtn").hide();
    $("#updateBtn").show();
    $("#heading-title").html('Update ');
    $("#form_output").html('');
}

function ArchiveAlbumDelete(id) {
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
                    url: base_url + "/archive_album_delete",
                    data: {id: id},
                    'dataType': 'json',
                    success: function (response) {
                        if (response.error == '') {
                            swal({
                                text: response.success,
                                icon: "success",
                            }).then(function() {
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

function ArchivesaveSetupInfo(action) {
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
                    url: base_url + "/"+action,
                    data: $('#type_setup_form').serialize(),
                    'dataType': 'json',
                    success: function (data) {

                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#form_output').html(error_html);
                        } else {
                            $('#type_setup_form')[0].reset();
                            $('#exampleModal').modal('toggle');
                            $('#form_output').html('');

                            swal({
                                text: data.success,
                                icon: "success",
                            }).then(function () {
                                if(data.redirect_page==''){
                                    location.reload();
                                }
                                else {
                                    window.location = base_url + '/' + data.redirect_page;
                                }
                            });
                        }
                    }
                });
            }
        });
}

function ArchiveTypeDelete(id) {
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
                    url: base_url + "/archive_type_delete",
                    data: {id: id},
                    'dataType': 'json',
                    success: function (response) {
                        if (response.error == '') {
                            swal({
                                text: response.success,
                                icon: "success",
                            }).then(function() {
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

function ArchiveBandDelete(id) {
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
                    url: base_url + "/archive_band_delete",
                    data: {id: id},
                    'dataType': 'json',
                    success: function (response) {
                        if (response.error == '') {
                            swal({
                                text: response.success,
                                icon: "success",
                            }).then(function() {
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

function ArchiveCategoryDelete(id) {
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
                    url: base_url + "/archive_category_delete",
                    data: {id: id},
                    'dataType': 'json',
                    success: function (response) {
                        if (response.error == '') {
                            swal({
                                text: response.success,
                                icon: "success",
                            }).then(function() {
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

// var fixmeTop = $('.fixme').offset().top;
// $(window).scroll(function() {
//     var currentScroll = $(window).scrollTop();
//     if (currentScroll >= fixmeTop) {
//         $('.fixme').css({
//             position: 'fixed',
//             top: '0',
//             left: 'auto',
//         });
//     } else {
//         $('.fixme').css({
//             position: 'static'
//         });
//     }
// });

$("document").ready(function(){
    $("tbody.sortable").sortable({
        update: function () {
            var order = $(this).sortable("serialize");
            var playlist_id = $("#playlist_id").val();
            var url = base_url + "/ajax_order_update?id="+playlist_id;
            $.post(url , order, function (theResponse) {
                // console.log(theResponse);
                var message = '<div class="alert alert-success  alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"></button><strong>Heads up!</strong>' + theResponse + '</div>';
                $("#response").html(message);
                $("#response").slideDown('slow');
                setTimeout(function(){ $("#response").slideUp('slow'); }, 4000);

                // slideout();
            });
        }
    });
});