<script>
window.biboronId = 1;
window.biboronList = <?php echo json_encode($biboron_data); ?>

function getProgramDescription(rowId,event) {

    var ctg_id = parseInt(event.value);
    var rateChart = JSON.parse($("#rateChart").val());
    var programBiboron = [];
    window.biboronData = "<option value=''>বিবরন</option>";
    for(var i=0;i<rateChart.length;i++){
        var file = programBiboron.find(item => item.ctg_id === ctg_id );

        if(rateChart[i].ctg_id == ctg_id){
             var file = programBiboron.find(item => item.description == rateChart[i].description );
             if(!file) {
                window.biboronData+="<option value='"+rateChart[i].description+"'>"+rateChart[i].sub_ctg_title+"</option>";
                programBiboron.push(rateChart[i]);
             }
        }
    }

    console.log(programBiboron);

    document.getElementById("program_description_id"+rowId).innerHTML=window.biboronData;
}

function getGradeInfo(rowId,biboron){

    var rateChart = JSON.parse($("#rateChart").val());
    
    var grade = [];
    var gradeData = "<option value=''>শ্রেণী</option>";

    var filterCategoriesGrade = rateChart.filter(function(item){
        return parseInt(item.description)===parseInt(biboron);
    });

    console.log(biboron);
    console.log(filterCategoriesGrade);

    for(var i=0;i<filterCategoriesGrade.length;i++){
        var find = grade.find(item => item.grade_id === filterCategoriesGrade[i].grade_id);
        if(!find){
            gradeData+="<option value='"+filterCategoriesGrade[i].grade_id+"'>"+filterCategoriesGrade[i].grade_title+"</option>";
            grade.push(filterCategoriesGrade[i]);
        }
    }
    
    if(gradeData !== null ) {
        $("#grade_id"+rowId).html(gradeData);
    }
    
}

function getStabilityInfo(rowId) {
    var grade_id = $("#grade_id"+rowId).val();
    var biboron = $("#program_description_id"+rowId).val();
    var rateChart = JSON.parse($("#rateChart").val());
    var stability = [];
    var stabilityData = "<option value=''>স্থিতি</option>";

    var filterCategoriesstability = rateChart.filter(function(item){
        return item.description===biboron && item.grade_id==grade_id && item.stability !== null;
    });

    console.log(filterCategoriesstability);

    for(var i=0;i<filterCategoriesstability.length;i++){
        var find = stability.find(item => item.stability === filterCategoriesstability[i].stability);
        if(!find){
            stabilityData+="<option value='"+filterCategoriesstability[i].stability+"'>"+filterCategoriesstability[i].stability+"</option>";
            stability.push(filterCategoriesstability[i]);
        }
    }
    document.getElementById("stability"+rowId).innerHTML=stabilityData;
}

function getAmountInfo(rowId) {
    var rateChart = JSON.parse($("#rateChart").val());
    var grade_id = $("#grade_id"+rowId).val();
    var ctg_id = $("#artis_ctg_id").val();
    var biboron = $("#program_description_id"+rowId).val();
    var stability = $("#stability"+rowId).val();
    var filterCategoriesamount = rateChart.filter(function(item){
        return item.ctg_id == ctg_id && item.description===biboron && item.grade_id==grade_id && item.stability === stability;
    });
    $("#mohoda"+rowId).val(filterCategoriesamount[0].mohoda_fee);
    $("#amount"+rowId).val(filterCategoriesamount[0].amount);

}



function saveProgramSavedInfoNew() {
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
                    url: base_url + "/save_program_planning_info_update_new",
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

function dropRow(index) {
    window.biboronList.splice(index,1);
    render();
}

function render(){
    $("#biboron_list").empty();
    var tblBody = document.getElementById("biboron_list");
    
    var program_style = JSON.parse($("#program_description").val());
    var program_description = JSON.parse($("#program_description_sub").val());
    var grade_info = JSON.parse($("#artist_grade_info").val());
    var program_vumika = JSON.parse($("#program_vumika").val());
    var artist_info = JSON.parse($("#artist_info").val());
    var work_area = JSON.parse($("#workArea").val());
    // return;
    // cells creation
    for (var j = 0; j < window.biboronList.length; j++) {
        var tr = document.createElement("tr");
        for (var prop in window.biboronList[j]) {
            var cell = document.createElement("td");

            if(prop==="action"){
                var actionButton = document.createElement("button");
                actionButton.setAttribute("class", "btn btn-danger btn-sm");
                actionButton.setAttribute("onClick", "dropRow("+j+")");
                actionButton.setAttribute("type", "button");

                var actionButtonText = document.createTextNode("Drop");
                actionButton.appendChild(actionButtonText);

                var cellText = actionButton;
            }
            else {
                if(prop==='artist_ctg_id'){
                  var itemText =  program_style[window.biboronList[j][prop]]
                }
                else if(prop === 'description_id') {
                    var itemText =  program_description[window.biboronList[j][prop]]
                    
                }
                else if(prop === 'artist_grade') {
                    var itemText =  grade_info[window.biboronList[j][prop]]
                }
                else if(prop === 'artist_vumika_id'){
                    var selected_vumika = !Array.isArray(window.biboronList[j][prop])? 
                    JSON.parse(window.biboronList[j][prop]):
                    window.biboronList[j][prop];
                    var itemText = '';
                    if(Array.isArray(selected_vumika)) {
                        for(var i=0;i<selected_vumika.length;i++) {
                            itemText+= program_vumika[selected_vumika[i]]+" / ";
                        }
                    }
                }
                else if(prop === 'artist_ids'){
                    var selected_artist = window.biboronList[j][prop];
                    var itemText = '';
                    if(Array.isArray(selected_artist)) {
                        for(var i=0;i<selected_artist.length;i++) {
                            itemText+= artist_info[selected_artist[i]]+" / ";
                        }
                    }
                }

                else if(prop === 'work_area_id'){
                    
                    var selected_workarea = !Array.isArray(window.biboronList[j][prop])? 
                    JSON.parse(window.biboronList[j][prop]):
                    window.biboronList[j][prop];
                    var itemText = '';

                    if(Array.isArray(selected_workarea)) {
                        for(var i=0;i<selected_workarea.length;i++) {
                            itemText+= work_area[selected_workarea[i]]+" / ";
                        }
                    }
                }

                else if(prop === 'mohoda_ids'){
                    // console.log(JSON.parse(window.biboronList[j][prop]));
                    // return;
                    var mohoda_ids = !Array.isArray(window.biboronList[j][prop])
                    ? 
                    ''
                    // JSON.parse(window.biboronList[j][prop])
                    :
                    window.biboronList[j][prop];
                    var itemText = '';

                    if(Array.isArray(mohoda_ids)) {
                        for(var i=0;i<mohoda_ids.length;i++) {
                            itemText+= mohoda_ids[i]+" / ";
                        }
                    }
                }
                else {
                  var itemText = window.biboronList[j][prop]
                }
                var cellText = document.createTextNode(
                    
                    itemText
                );
            }

            cell.appendChild(cellText);
            tr.appendChild(cell);
        }

        //row added to end of table body
        tblBody.appendChild(tr);
    }
    $("#biboron_data").val(JSON.stringify(window.biboronList));
}

function addBiboron() {
    
    var biboron_data = $("#biboron_data").val();
    window.biboronList = JSON.parse(biboron_data);
    
    var modifyData = [];
    for(var i=0;i<window.biboronList.length;i++){
        var row = {
            artist_ctg_id: window.biboronList[i]['artist_ctg_id'],
            description_id: window.biboronList[i]['description_id'],
            artist_grade: window.biboronList[i]['artist_grade'],
            stability: window.biboronList[i]['stability'],
            artist_grade_amount: window.biboronList[i]['artist_grade_amount'],
            mohoda_ids: window.biboronList[i]['mohoda_ids'],
            artist_vumika_id: window.biboronList[i]['artist_vumika_id'],
            artist_ids: window.biboronList[i]['artist_ids'],
            work_area_id: window.biboronList[i]['work_area_id'],
            action:""
        };

        modifyData.push(row);
    }
    window.biboronList = modifyData;
    console.log(window.biboronList);
    return;
    var artist_ctg_id = $("#artis_ctg_id").val();
    var grade_id = $("#grade_id1").val();
    var stability = $("#stability1").val();
    var description_id = $("#program_description_id1").val();
    if(artist_ctg_id==''){
        alert('শিল্পী সম্মানীর ক্যাটাগরি নির্বাচন করুন');
        return;
    }
    else if(description_id==''){
        alert('বিবরন নির্বাচন করুন');
        return;
    }
    else if(grade_id==''){
        alert('শ্রেণী নির্বাচন করুন');
        return;
    }
    else if(stability==''){
        alert('স্থিতি নির্বাচন করুন');
        return;
    }
    var row = {
        artist_ctg_id: $("#artis_ctg_id").val(),
        description_id: $("#program_description_id1").val(),
        artist_grade: $("#grade_id1").val(),
        stability: $("#stability1").val(),
        artist_grade_amount: $("#amount1").val(),
        mohoda_ids: $("#mohoda1").val(),
        artist_vumika_id: $("#program_descriptionid1").val(),
        artist_ids: $("#artist1").val(),
        work_area_id: $("#workarea1").val(),
        action:""
    };
    window.biboronList.push(row);
    render(); // render table row
    // modalClose();

}

function openModal() {
    document.getElementById("myForm").reset();
    $("#program_descriptionid1").select2("val", "");
    $("#artist1").select2("val", "");
    $("#workarea1").select2("val", "");
}

function modalClose() {
var el = document.getElementById('closeBtn');
    if (el.onclick) {
    el.onclick();
    } else if (el.click) {
    el.click();
    }
}
</script>




<?php $__env->startSection('title_area'); ?>
    :: Add New Program ::
<?php $__env->stopSection(); ?>
<?php $__env->startSection('show_message'); ?>
    <?php if(Session::has('message')): ?>
        <div class="alert alert-success alert-dismissible" id="alert_hide_after" role="alert"
             style="margin-bottom:10px; ">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php echo e(Session::get('message')); ?>

        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main_content_area'); ?>
    <article class="col-sm-12 col-md-12 col-lg-12">
        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2><?php echo e($page_title); ?></h2>

                <a  href="<?php echo e(url('program_magazine_create')); ?>"     class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i
                            class="glyphicon glyphicon-list"></i>
                    Program List
                </a>

            </header>
            <div>

            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                
                    <!-- Modal content-->
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">অনুষ্ঠানের বিবরন</h4>
                    </div>
                    <div class="modal-body">

                        <form action="" id="myForm">
                            <div class="form-group">
                                <label for="email">শিল্পী সম্মানীর ক্যাটাগরি:</label>
                                <select id="artis_ctg_id" onchange="getProgramDescription(1,this)" placeholder="শিল্পী সম্মানীর ক্যাটাগরি" required id="program_style"
                                        class="form-control" name="program_style">
                                    <option value="">চিহ্নিত করুন</option>
                                    <?php if(!empty($program_style)): ?>
                                        <?php $__currentLoopData = $program_style; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pwd">বিবরন</label>
                                <select name="program_description[]" onchange="getGradeInfo(1,this.value)"  class="form-control" id="program_description_id1">
                                    <option value="">বিবরন</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pwd">শ্রেণী</label>
                                <select name="grade[]" onchange="getStabilityInfo(1);" class="form-control" id="grade_id1">
                                    <option value="">শ্রেণী</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pwd">স্থিতি</label>
                                <select name="stability[]" onchange="getAmountInfo(1);" class="form-control" id="stability1">
                                    <option value="">স্থিতি</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pwd">টাকার পরিমান</label>
                                <input type="text" onChange="getTotalAmount()" name="amount[]" id="amount1" placeholder="টাকার পরিমান" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="pwd">মহড়া ফি</label>
                                <input type="text" name="mohoda_name[]" id="mohoda1"  placeholder="মহড়া ফি" class="form-control">  
                            </div>
                            <div class="form-group">
                                <label for="pwd">অনুষ্টানের ভুমিকা</label>
                                <select placeholder="অনুষ্টানের ভুমিকা" id="program_descriptionid1"
                                    name="program_descriptionid[]"
                                    class="select2" multiple>
                                <?php foreach($program_description as $key => $value){?>
                                    <option value="<?php echo $key ?>"><?php echo $value ?></option>
                                <?php } ?>
                                
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="pwd">শিল্পীর নাম</label>
                                <select placeholder="শিল্পীর নাম"  name="artist[]" id="artist1" class="select2" multiple
                                required style="width:100%; !important">
                                    <?php foreach($atrist_info_info as $key => $value ) { ?>
                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="pwd">কর্মক্ষেত্র</label>
                                <select placeholder="কর্মক্ষেত্র"  name="workarea[]" id="workarea1" class="select2" multiple>
                                    <?php foreach($work_area as $key => $value){ ?>
                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            
                        

                    </div>
                    <div class="modal-footer">
                        <button type="button" onClick="addBiboron()" class="btn btn-primary">যোগ করুন</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">বাতিল করুন</button>
                    </div>
                    </div>
                    </form>
                </div>
            </div>

               
                <div class="widget-body no-padding">
                    <div class="col-sm-12">

                        <?php echo Form::open(['url' => '', 'method' => 'post','id' => 'save_program_planning_form',
                'class'=>'form-horizontal']); ?>

                        <div class="modal-body">
                            <div class="col-sm-12" style="margin-top:10px;">
                                <textarea style="visibility:hidden" id="rateChart"><?php echo json_encode($get_rate_chart); ?></textarea>
                                <textarea style="visibility:hidden" id="workArea"><?php echo json_encode($work_area); ?></textarea>
                                
                                <textarea style="visibility:hidden" id="program_vumika"><?php echo json_encode($program_description); ?></textarea>
                                <textarea style="visibility:hidden" id="program_description"><?php echo json_encode($program_style); ?></textarea>
                                <textarea style="visibility:hidden" id="artist_info"><?php echo json_encode($atrist_info_info); ?></textarea>
                                <textarea style="visibility:hidden" name="biboron_data" id="biboron_data"><?php echo json_encode($biboron_data); ?></textarea>
                                <textarea style="visibility:hidden" id="program_description_sub"><?php echo json_encode($program_description_sub); ?></textarea>
                                <textarea style="visibility:hidden" id="artist_grade_info"><?php echo json_encode($artist_grade_info); ?></textarea>
                                <input type="hidden" name="program_planing_id" value="<?php echo $get_program_planning_info->id; ?>"/>
                                <div class="form-group">
                                    <label class="col-md-2 control-label"> কেন্দ্র <span
                                                class="mandatory_field">*</span>
                                    </label>
                                    <div class="col-md-4">
                                        <select id="station_id" onchange="getSubStation(this.value)" class="form-control" name="station_id">
                                            <option value="">চিহ্নিত করুন</option>
                                            <?php if(!empty($station_info)): ?>
                                                <?php $__currentLoopData = $station_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php echo e($key===$get_program_planning_info->station_id?'selected':''); ?> value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">

                                    <label class="col-md-2 control-label">অনুষ্ঠানের  নাম <span
                                                class="mandatory_field">*</span></label>
                                    <div class="col-md-4">
                                        <input type="text" id="program_name" value="<?php echo e($get_program_planning_info->program_name); ?>" class="form-control" required name="program_name"
                                               placeholder="অনুষ্ঠানের  নাম">
                                    </div>

                                    <label class="col-md-2 control-label">অনুষ্ঠানের ধরন <span
                                                class="mandatory_field">*</span> </label>
                                    <div class="col-md-4">
                                        <select id="program_type" class="form-control" name="program_type">
                                            <option value="">চিহ্নিত করুন</option>
                                            <?php if(!empty($program_type)): ?>
                                                <?php $__currentLoopData = $program_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php echo e($key===$get_program_planning_info->program_type?'selected':''); ?> value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-md-2 control-label"></label>
                                    <div class="col-md-2">
                                        <input type="checkbox" <?php echo e($get_program_planning_info->fixed_program_type_id >0 ? 'checked':''); ?> onclick="is_program_type_check(this)" id="is_fixed_program"
                                               name="is_fixed_program"/> উৎসব ও বার্ষিকী অনুষ্ঠান
                                    </div>
                                    <div style="display:<?php echo e($get_program_planning_info->fixed_program_type_id >0 ? 'block':'none'); ?>" id="fixed_program_type_div">
                                        <label class="col-md-2 control-label">বার্ষিকী অনুষ্ঠানের ধরন</label>
                                        <div class="col-md-3">
                                            <select id="fixed_program_type" class="form-control" name="fixed_program_type">
                                                <option value="">বার্ষিকী অনুষ্ঠানের ধরন</option>
                                                <?php $__currentLoopData = $get_fixed_program_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php echo e($value->id===$get_program_planning_info->fixed_program_type_id?'selected':''); ?> value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select id="sub_fixed_program_type" class="form-control" name="sub_fixed_program_type">
                                                <option value="">সাব-বার্ষিকী অনুষ্ঠানের ধরন</option>
                                                <?php foreach($fix_sub_program_type as $value) { ?>
                                                    <option <?php echo e($value->id===$get_program_planning_info->sub_fixed_program_type_id?'selected':''); ?> value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">রেকর্ডিং তারিখ <span
                                                class="mandatory_field">*</span> <span
                                                class="mandatory_field">*</span></label>
                                    <div class="col-md-2">
                                        <input type="text" value="<?php echo e($get_program_planning_info->recorded_date); ?>" class="form-control datepickerLong" placeholder="রেকডিং তারিখ"
                                               name="recorded_date"/>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" <?php echo e($get_program_planning_info->recording_date_is_plexibity >0? 'checked':''); ?> onclick="" id="recording_date_is_plexibity"
                                               name="recording_date_is_plexibity"/> প্রয়োজন মত
                                    </div>

                                    <label class="col-md-2 control-label">রেকর্ডিং সময় <span
                                                class="mandatory_field">*</span> <span
                                                class="mandatory_field">*</span></label>
                                    <div class="col-md-2">
                                        <input type="text" id="recorded_time" value="<?php echo e($get_program_planning_info->recorded_time); ?>" class="form-control timepicker" required
                                               name="recorded_time"
                                               placeholder="রেকডিং সময়">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" <?php echo e($get_program_planning_info->recording_time_is_plexibity >0 ? 'checked':''); ?> onclick="" id="recording_time_is_plexibity"
                                               name="recording_time_is_plexibity"/> প্রয়োজন মত
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">প্রচার তারিখ <span
                                                class="mandatory_field">*</span></label>
                                    <div class="col-md-2">
                                        <input type="text" value="<?php echo e($get_program_planning_info->live_date); ?>"  class="form-control datepickerLong" placeholder="প্রচার তারিখ"
                                               name="live_date"/>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" <?php echo e($get_program_planning_info->live_date_is_plexibity >0 ? 'checked':''); ?> onclick="" id="live_date_is_plexibity"
                                               name="live_date_is_plexibity"/> প্রয়োজন মত
                                    </div>
                                    <label class="col-md-2 control-label">প্রচার সময় <span
                                                class="mandatory_field">*</span></label>
                                    <div class="col-md-2">
                                        <input type="text" value="<?php echo e($get_program_planning_info->live_time); ?>" id="live_time" class="form-control timepicker" required
                                               name="live_time"
                                               placeholder="প্রচার সময়">

                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" <?php echo e($get_program_planning_info->live_time_is_plexibity >0 ? 'checked':''); ?> onclick="" id="live_time_is_plexibity"
                                               name="live_time_is_plexibity"/> প্রয়োজন মত
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label"> স্থিতি <span
                                                class="mandatory_field">*</span></label>
                                    <div class="col-md-4">
                                        <input type="text" value="<?php echo e($get_program_planning_info->recording_stabilty); ?>" id="recording_stabilty" class="form-control" placeholder="স্থিতি"
                                               name="recording_stabilty"/>
                                    </div>
                                    <label class="col-md-2 control-label">টাইপ</label>
                                    <div class="col-md-4">
                                        <select required name="record_type" class="form-control" id="record_type">
                                            <option value="">চিহ্নিত করুন</option>
                                            <option <?php echo e($get_program_planning_info->record_type==1 ? 'checked':''); ?> value="1">সজীব</option>
                                            <option <?php echo e($get_program_planning_info->record_type==2 ?'checked':''); ?> value="2">রেকর্ড</option>
                                        </select>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">উদ্দেশ্য/বিষয় <span
                                                class="mandatory_field">*</span></label>
                                    <div class="col-md-10">
                    <textarea class="form-control" placeholder="উদ্দেশ্য/বিষয়"
                              name="larget_viewer"><?php echo e($get_program_planning_info->larget_viewer); ?></textarea>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="9">অনুষ্ঠানের বিবরন</th>
                                                <th>
                                                    <!-- <button style="float:right;" type="button" onClick="openModal()" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i> বিবরন যোগ করুন</button> -->
                                                </th>
                                            </tr>
                                            <tr>
                                                <td>শিল্পী সম্মানীর ক্যাটাগরি</td>
                                                <td>বিবরন</td>
                                                <td>শ্রেণী</td>
                                                <td>স্থিতি</td>
                                                <td>টাকার পরিমান</td>
                                                <td>মহড়া ফি</td>
                                                <td>অনুষ্টানের ভুমিকা</td>
                                                <td>শিল্পীর নাম</td>
                                                <td>কর্মক্ষেত্র</td>
                                                <td></td>
                                            </tr>
                                        </thead>
                                        <tbody id="biboron_list">
                                            <?php foreach($biboron_data as $bkey => $value){ ?>
                                                <td><?php  echo $value->main_title; ?></td>
                                                <td><?php  echo $value->sub_title; ?></td>
                                                <td><?php  echo $value->title; ?></td>
                                                <td><?php  echo $value->stability; ?></td>
                                                <td><?php  echo $value->artist_grade_amount; ?></td>
                                                <td>
                                                    <?php 
                                                        $mohoda_ids =  json_decode($value->mohoda_ids,true); 
                                                        if(!empty($mohoda_ids)){
                                                            echo implode($mohoda_ids,',');
                                                        }
                                                    ?>
                                                 </td>
                                                <td>
                                                    <?php  
                                                        $vumika_ids = json_decode($value->artist_vumika_id,true);
                                                        $artist_names = [];
                                                        foreach($program_description as $key => $name) {
                                                            if(is_array($vumika_ids) && in_array($key,$vumika_ids)) {
                                                                $artist_names[] = $name;
                                                            }
                                                        } 
                                                        echo implode($artist_names,',');
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        foreach($selected_artist as $artist) {
                                                            echo $artist->name."<br/>";
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php  
                                                        $work_area_ids = json_decode($value->work_area_id,true);
                                                        $work_area_name = [];
                                                        foreach($work_area as $key => $name) {
                                                            if(is_array($work_area_ids) && in_array($key,$work_area_ids)) {
                                                                $work_area_name[] = $name;
                                                            }
                                                        } 
                                                        echo implode($work_area_name,',');
                                                    ?>
                                                </td>
                                                <td><button onClick="dropRow(<?php echo $bkey ?>)" type="button" class="btn btn-danger btn-sm">
                                                    Drop
                                                </button></td>
                                            <?php  } ?>
                                        </tbody>
                                        
                                    </table>
                                    <table class="table table-bordered">
                                        <?php
                                            $program_manager = json_decode($get_program_planning_info->program_organizer,true);
                                            
                                            $manage=[
                                                6=>'অনুষ্ঠান পরিকল্পনাকারী',
                                                1=>'প্রযোজনা',
                                                2=>'সম্পাদনা',
                                                3=>'প্রযোজনা সহকারী',
                                                4=>'তত্বাবধানে',
                                                5=>'নির্দেশনা',
                                            ];
                                            foreach ($manage as $key=> $value){
                                            ?>
                                            <tr>
                                                <td colspan="3">
                                                    <input type="text" placeholder="বিবরন" value="<?php echo e($value); ?>"
                                                        id="manage_title_<?php echo e($key); ?>" name="manage_title[]" class="form-control">
                                                    <input type="hidden" placeholder="বিবরন" value="<?php echo e($key); ?>"
                                                        id="manage_title_id_<?php echo e($key); ?>" name="manage_title_id[]"
                                                        class="form-control">
                                                </td>
                                                <td colspan="3">
                                                    <select  id="magazine_manage_<?php echo e($key); ?>" placeholder="শিল্পীর নাম"  class="select2"
                                                            multiple required
                                                            name="magazine_manage[<?php echo e($key); ?>][]" style="width:100%; !important">

                                                        <?php if(!empty($employee_info)): ?>
                                                            <?php $__currentLoopData = $employee_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ekey=> $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option <?php echo e(isset($program_manager[$key]) &&  is_array($program_manager) && in_array($ekey,$program_manager[$key]) ? 'selected' : ''); ?> value="<?php echo e($ekey); ?>"><?php echo e($value); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </td>
                                                <td colspan="2"><button type="button" id="delete_manage_<?php echo e($key); ?>"
                                                            class="btn
                            btn-warning btn-sm deleteRow"><i class="glyphicon glyphicon-remove"></i> </button></td>
                                            </tr>
                                            <?php

                                            }
                                            ?>
                                    </table>
                                </div>




                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class=" col-sm-7 text-left">
                                <span class="text-left" id="form_output"></span>
                            </div>
                            <div class=" col-sm-5">
                                <button type="button" onclick="saveProgramSavedInfoNew()" id="saveBtn" class="btn btn-success"><i
                                            class="glyphicon glyphicon-save"></i>Save
                                </button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                            class="glyphicon glyphicon-remove"></i> Close
                                </button>
                            </div>
                        </div>
                        <?php echo Form::close(); ?>





                    </div>
                </div>
            </div>
        </div>
    </article>
    <!-- Modal -->


    <script>
        var scntDivSong = $('#show_all_program_desciption');
        var a = $('#show_all_program_desciption tr').size() + 1;
        var a_index=1;
        $('#add_description').on('click', function () {
            $('<tr><td><select\n' +
                '                                id="program_description_id_'+ a +'" ' +
                'name="program_description_id['+ a_index +']"\n' +
                '                                class="form-control">\n' +
                '                            <option value="">বিবরন</option>\n' +
                '                            <?php if(!empty($program_description)): ?>{\n' +
                '                                <?php $__currentLoopData = $program_description; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $description): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>{\n' +
                '                                        <option value="<?php echo e($key); ?>"><?php echo e($description); ?></option>\n' +
                '                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>\n' +
                '                            <?php endif; ?>\n' +
                '                        </select></td><td> <select id="artist_name_all_'+ a +'"   ' +
                'name="artist_name_all['+ a_index +'][]"\n' +
                '                                class="select2" multiple required style="width:100%; !important">\n' +
                '                            <?php if(!empty($atrist_info_info)): ?>\n' +
                '                                <?php $__currentLoopData = $atrist_info_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>\n' +
                '                                    <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>\n' +
                '                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>\n' +
                '                            <?php endif; ?>\n' +
                '                        </select></td><td><a href="javascript:void(0);"  id="deleteRow_' + a + '"  class="deleteRow btn btn-warning btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i> </a></td></tr>').appendTo(scntDivSong);
            $("#artist_name_all_"+a).select2();
            a++;
            a_index++;
            return false;
        });
    </script>



<?php $__env->stopSection(); ?>





<?php echo $__env->make("master_program", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>