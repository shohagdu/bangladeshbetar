<textarea style="visibility:hidden;" id="schedule" name="schedule">@php echo json_encode($schedule,true) @endphp</textarea>
<h3>বারঃ {{$day_name}}</h3>


    <table class="table-bordered table">

        <thead>

                <!-- <tr>
                    <th colspan="6">
                    </th>
                </tr> -->

                <!-- <tr>
                <td>সময়</td>
                <td>অনুষ্ঠানের টাইটেল</td>
                <td>মন্তব্য</td>
                <td>রেকর্ড করা আছে</td>
                <td>ওভার রাইড</td>
                <td>#</td> -->
                </tr>

                <tr>
                    <td>সময়</td>
                    <td>স্থিতি</td>
                    <td>চাংক</td>
                    <td>অনুষ্ঠানের বিবরন</td>
                    <td>মন্তব্য</td>
                    <td>ক্রমিক</td>
                    <td>রেকর্ড</td>
                    <td>ওভার রাইড</td>
                    <td>প্রযোজনা</td>
                    <td>তত্বাবধানে</td>
                    <td>#</td>
                </tr>

        </thead>
        
        <tbody>
                @php 
                $i=0;
                @endphp
                @foreach($schedule as  $parentKey => $value)
                    <tr id="schedule_{{$i}}">
                        <td>
                            <input type='text' readonly autocomplete='off' value='<?php echo $value['time'] ?>'  placeholder='সময়' class='form-control'>
                        </td>
                        <td>
                            <input type='text' readonly autocomplete='off' value='<?php echo $value['stability'] ?>'  placeholder='সময়' class='form-control'>
                        </td>
                        <td>
                            <input type='text' readonly autocomplete='off' value='<?php echo $value['chank'] ?>'  placeholder='সময়' class='form-control'>
                        </td>
                        <td>
                            <input type='text' readonly  value="<?php echo $value['biboron'] ?>" id="title_{{$i}}"  placeholder='অনুষ্ঠানের টাইটেল' class='form-control'>
                            <input type="text"  placeholder='অনুষ্ঠানের ওভাররাইড টাইটেল' class='form-control' onkeyUp="modifySchedule( {{$i}}, this.value)" style="display:none" name="overwrite_details" id="overwrite_details_{{$i}}"/>
                        </td>
                        <td>
                            <input type='text' readonly autocomplete='off' value='<?php echo $value['comment'] ?>'  placeholder='সময়' class='form-control'>
                        </td>
                        <td>
                            <input type='text' readonly autocomplete='off' value='<?php echo $value['sorting'] ?>'  placeholder='সময়' class='form-control'>
                        </td>
                        <td>
                            <input type='text' readonly autocomplete='off' value='<?php echo $value['is_recorded'] ?>'  placeholder='সময়' class='form-control'>
                        </td>
                        <td>
                            <input type='checkbox'  onclick="showOverwriteDetails({{$i}}, this );"/>
                        </td>
                        <td>
                            <select class='form-control'>
                                <option value=''>চিহ্নিত করুন</option>
                                @if(!empty($employee_info))
                                    @foreach($employee_info as $key=> $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </td>
                        <td>
                            <select class='form-control'>
                                <option value=''>চিহ্নিত করুন</option>
                                @if(!empty($employee_info))
                                    @foreach($employee_info as $key=> $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </td>
                        
                        <td>
                            <button type='button' onclick="removeSchedule({{$i}})" class='btn btn-warning btn-flat btn-sm'><i class='glyphicon glyphicon-remove'></i> Drop</button>
                        </td>
                    </tr>
                @php 
                $i++;
                @endphp
                @endforeach
        </tbody>

        <tfoot>
                <tr>
                    <td colspan="9">
                    </td>
                </tr>
        </tfoot>

    </table>


    <div class="form-group">
        <label class="col-md-2 control-label"></label>
        <div class="col-md-4">
        <button style="margin-bottom:10px;margin-left:300px;" type="submit" id="saveBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Save</button>
        </div>
    </div>