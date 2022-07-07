<div>
    <input type="text" placeholder="তারিখ"  name="date[{{$day_id}}][]" class="form-control datepickerinfo">
    <button type="button" onclick="addScheduleSlot({{$day_id}},{{$row_id}});"  class="btn btn-info btn-xs" style="margin-top:5px;" ><i
                class="glyphicon
    glyphicon-plus"></i> Add</button>
    <button type="button" onclick="this.parentNode.remove()"  class="btn btn-danger btn-xs" style="margin-top:5px;" ><i
                class="glyphicon
    glyphicon-minus"></i> Remove</button>
</div>
    

<script>
$("document").ready(function(){
    $('.datepickerinfo').datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
    }).val();
});
</script>