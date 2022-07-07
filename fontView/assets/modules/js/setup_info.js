// intital setup form templeate js---start
function print_fun(){
    window.print();

}
function print_fun_landscape(){
    var css = '@page { size: landscape; }',
        head = document.head || document.getElementsByTagName('head')[0],
        style = document.createElement('style');

    style.type = 'text/css';
    style.media = 'print';

    if (style.styleSheet){
        style.styleSheet.cssText = css;
    } else {
        style.appendChild(document.createTextNode(css));
    }

    head.appendChild(style);
    window.print();

}

$(document).ready(function() {
    $('.timepicker').datetimepicker({
        format: 'hh:mm a'
    });
    // DO NOT REMOVE : GLOBAL FUNCTIONS!
    pageSetUp();
    $(".js-status-update a").click(function() {
        var selText = $(this).text();
        var $this = $(this);
        $this.parents('.btn-group').find('.dropdown-toggle').html(selText + ' <span class="caret"></span>');
        $this.parents('.dropdown-menu').find('li').removeClass('active');
        $this.parent().addClass('active');
    });

    /*
    * TODO: add a way to add more todo's to list
    */

    // initialize sortable
    $(function() {
        $("#sortable1, #sortable2").sortable({
            handle : '.handle',
            connectWith : ".todo",
            update : countTasks
        }).disableSelection();
    });

    // check and uncheck
    $('.todo .checkbox > input[type="checkbox"]').click(function() {
        var $this = $(this).parent().parent().parent();

        if ($(this).prop('checked')) {
            $this.addClass("complete");

            // remove this if you want to undo a check list once checked
            //$(this).attr("disabled", true);
            $(this).parent().hide();

            // once clicked - add class, copy to memory then remove and add to sortable3
            $this.slideUp(500, function() {
                $this.clone().prependTo("#sortable3").effect("highlight", {}, 800);
                $this.remove();
                countTasks();
            });
        } else {
            // insert undo code here...
        }

    })
    // count tasks
    function countTasks() {

        $('.todo-group-title').each(function() {
            var $this = $(this);
            $this.find(".num-of-tasks").text($this.next().find("li").size());
        });

    }

    var data = [], totalPoints = 200, $UpdatingChartColors = $("#updating-chart").css('color');
    function getRandomData() {
        if (data.length > 0)
            data = data.slice(1);

        // do a random walk
        while (data.length < totalPoints) {
            var prev = data.length > 0 ? data[data.length - 1] : 50;
            var y = prev + Math.random() * 10 - 5;
            if (y < 0)
                y = 0;
            if (y > 100)
                y = 100;
            data.push(y);
        }

        // zip the generated y values with the x values
        var res = [];
        for (var i = 0; i < data.length; ++i)
            res.push([i, data[i]])
        return res;
    }

    // setup control widget
    var updateInterval = 1500;
    $("#updating-chart").val(updateInterval).change(function() {

        var v = $(this).val();
        if (v && !isNaN(+v)) {
            updateInterval = +v;
            $(this).val("" + updateInterval);
        }

    });

    // setup plot
    var options = {
        yaxis : {
            min : 0,
            max : 100
        },
        xaxis : {
            min : 0,
            max : 100
        },
        colors : [$UpdatingChartColors],
        series : {
            lines : {
                lineWidth : 1,
                fill : true,
                fillColor : {
                    colors : [{
                        opacity : 0.4
                    }, {
                        opacity : 0
                    }]
                },
                steps : false

            }
        }
    };

    // var plot = $.plot($("#updating-chart"), [getRandomData()], options);

    /* live switch */
    $('input[type="checkbox"]#start_interval').click(function() {
        if ($(this).prop('checked')) {
            $on = true;
            updateInterval = 1500;
            update();
        } else {
            clearInterval(updateInterval);
            $on = false;
        }
    });

    function update() {
        if ($on == true) {
            plot.setData([getRandomData()]);
            plot.draw();
            setTimeout(update, updateInterval);

        } else {
            clearInterval(updateInterval)
        }

    }

    var $on = false;

    /* hide default buttons */
    $('.fc-header-right, .fc-header-center').hide();

    // calendar prev
    $('#calendar-buttons #btn-prev').click(function() {
        $('.fc-button-prev').click();
        return false;
    });

    // calendar next
    $('#calendar-buttons #btn-next').click(function() {
        $('.fc-button-next').click();
        return false;
    });

    // calendar today
    $('#calendar-buttons #btn-today').click(function() {
        $('.fc-button-today').click();
        return false;
    });

    // calendar month
    $('#mt').click(function() {
        $('#calendar').fullCalendar('changeView', 'month');
    });

    // calendar agenda week
    $('#ag').click(function() {
        $('#calendar').fullCalendar('changeView', 'agendaWeek');
    });

    // calendar agenda day
    $('#td').click(function() {
        $('#calendar').fullCalendar('changeView', 'agendaDay');
    });

    /*
     * CHAT
     */

    $.filter_input = $('#filter-chat-list');
    $.chat_users_container = $('#chat-container > .chat-list-body')
    $.chat_users = $('#chat-users')
    $.chat_list_btn = $('#chat-container > .chat-list-open-close');
    $.chat_body = $('#chat-body');

    /*
    * LIST FILTER (CHAT)
    */

    // custom css expression for a case-insensitive contains()
    jQuery.expr[':'].Contains = function(a, i, m) {
        return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
    };

    function listFilter(list) {// header is any element, list is an unordered list
        // create and add the filter form to the header

        $.filter_input.change(function() {
            var filter = $(this).val();
            if (filter) {
                // this finds all links in a list that contain the input,
                // and hide the ones not containing the input while showing the ones that do
                $.chat_users.find("a:not(:Contains(" + filter + "))").parent().slideUp();
                $.chat_users.find("a:Contains(" + filter + ")").parent().slideDown();
            } else {
                $.chat_users.find("li").slideDown();
            }
            return false;
        }).keyup(function() {
            // fire the above change event after every letter
            $(this).change();

        });

    }
   // $('#dt_basic').DataTable();
    $('#dt_basic').DataTable( {
        "pageLength": 30,
        "lengthMenu": [[30, 50, 70, 100, -1], [30, 50, 70, 100, "All"]]
    });

    // var table = $('#example').DataTable( {
    //     responsive: true,
    //     paging: false
    // } );

   $('#dt_archive').DataTable({
        "searching": false,
        "bLengthChange":false,
        responsive: true,
        fixedHeader: true
    });
    // new $.fn.dataTable.FixedHeader( archive_table );

    $("#alert_hide_after").delay(5000).slideUp(300);

    // all checked with one click
    $('#checked_all').change(function() {
        var checkboxes = $(this).closest('form').find(':checkbox');
        checkboxes.prop('checked', $(this).is(':checked'));
    });

});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});



// intital setup form templeate js---end


function AddSetupInfo() {
    $("#type_setup_form")[0].reset();
    $("#title").val('');
    $("#setting_id").val('');
    $("#is_active").val(1);
    $("#saveBtn").show();
    $("#updateBtn").hide();
    $("#heading-title").html('Add ');
    $("#form_output").html('');
}
function UpdateSetupInfo(id,title,is_active,parent_id='') {
    $("#type_setup_form")[0].reset();
    $("#title").val(title);
    $("#setting_id").val(id);
    $("#is_active").val(is_active);
    $("#parent_id").val(parent_id);
    $("#saveBtn").hide();
    $("#updateBtn").show();
    $("#heading-title").html('Update ');
    $("#form_output").html('');

}
function UpdateSubCtgSetupInfo(id,title,is_active,parent_id,display_position='') {
    $("#type_setup_form")[0].reset();
    $("#title").val(title);
    $("#setting_id").val(id);
    $("#product_ctg").val(parent_id);
    $("#is_active").val(is_active);
    if(display_position!=''){
        $("#display_position").val(display_position);
    }
    $("#saveBtn").hide();
    $("#updateBtn").show();
    $("#heading-title").html('Update ');
    $("#form_output").html('');

}
function default_setup() {
    swal({
        text: "You can't update, Because it's default setup",
        icon: "warning",
    });
}
function saveSetupInfo() {
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
                url: base_url + "/save_setup_type",
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
                            window.location =  base_url +'/'+ data.redirect_page;
                        });
                    }
                }
            });
        }
    });
}
function deleteSetupConfirm(id,redirect_page) {
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
                url: base_url + "/setup_type_delete",
                data: {id: id,redirect_page:redirect_page},
                'dataType': 'json',
                success: function (response) {
                    if (response.status == 'success') {
                        swal({
                            text: response.message,
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

// stock information







