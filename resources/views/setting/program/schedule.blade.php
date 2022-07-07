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
                <td>#</td> 
                </tr>-->

                <tr>
                    <td>সময়</td>
                    
                    <td>অনুষ্ঠানের নাম</td>
                    <td>অনুষ্ঠানের বিবরন</td>
                    <td>অনুষ্ঠানের বিষয়বস্তু</td>
                    <td>প্লে লিষ্ট আই ডি</td>
                    <td>রেকর্ড</td>
                    <td>স্থিতি</td>
                    <td>মন্তব্য</td>
                    <td>প্রযোজনা</td>
                    <td>তত্বাবধানে</td>
                    <td>ক্রমিক</td>
                    
                    <td>ওভার রাইড</td>
                    
                    <td>#</td>
                </tr>

        </thead>
        
        <tbody>
                @php 
                $i=0;
            //    echo "<pre>";
            //    print_r($schedule);
                @endphp
                @foreach($schedule as  $parentKey => $value)
                    <tr id="schedule_{{$i}}">
                        <td>
                            <input type='text' readonly autocomplete='off' value='<?php echo $value['time'] ?>' id="time_{{ $i }}"   placeholder='সময়' class='form-control'>
                        </td>
                         <td>
                            <input type='text' readonly autocomplete='off' value='<?php echo $value['chank'] ?>' id="onusan_name_{{ $i }}"  placeholder='অনুষ্ঠানের নাম' class='form-control'>
                        </td>
                        <td>
                            <input type='text' readonly  value="<?php echo $value['biboron'] ?>" id="title_{{$i}}"  placeholder='অনুষ্ঠানের টাইটেল' class='form-control'>
                            <input type="text"  placeholder='অনুষ্ঠানের ওভাররাইড টাইটেল' class='form-control' onkeyUp="modifySchedule( {{$i}}, this.value)" style="display:none" name="overwrite_details" id="overwrite_details_{{$i}}"/>
                        </td>
                        <td>
                            <input type="text" value="<?php if(!empty($value['description'])){ echo $value['description'] ;}else{ echo ""; } ?>" placeholder="অনুষ্ঠানের বিষয়বস্তু" class="form-control">
                            </td>
                        <td>
                            <input type="text" onchange="pushPlaylist({{ $i }},this.value)"   id="playlist_info_{{ $i }}" onkeyup="autocompletePlaylistInfo('{{ $i }}')" placeholder="প্লে লিষ্ট আইডি নং" class="form-control"
                            >
                             <input type="hidden"  id="playlist_info_id_{{ $i }}" placeholder="প্লে লিষ্ট আইডি নং" class="form-control">
                            </td>
                        <td>
                            <input type="checkbox" {{ (!empty( $value['is_recorded']) &&  $value['is_recorded']==1)?"checked":"" }} >
                        </td>
                        <td>
                            <input type='text'  autocomplete='off' value='<?php echo $value['stability'] ?>'  placeholder='স্থিতি' class='form-control'>
                        </td>
                       
                        
                        <td>
                            <input type='text'  autocomplete='off' value='<?php echo $value['comment'] ?>'  placeholder='মন্তব্য' class='form-control'>
                        </td>
                        <td>
                            <select class='form-control'>
                                <option value=''>চিহ্নিত করুন</option>
                                @if(!empty($employee_info))
                                    @foreach($employee_info as $key=> $value_p)
                                        <option value="{{ $key }}">{{ $value_p }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </td>
                        <td>
                            <select class='form-control'>
                                <option value=''>চিহ্নিত করুন</option>
                                @if(!empty($employee_info))
                                    @foreach($employee_info as $key=> $value_t)
                                        <option value="{{ $key }}">{{ $value_t }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </td>
                        <td>
                            <input type='text'  autocomplete='off' value='<?php echo $value['sorting'] ?>'  placeholder='সময়' class='form-control'>
                        </td>
                        
                        <td>
                            <input type='checkbox'  onclick="showOverwriteDetails({{$i}}, this );"/>
                        </td>
                        
                        
                        <td>
                            <button type='button' onclick="removeSchedule({{$i}})" class='btn btn-warning btn-flat btn-sm'><i class='glyphicon glyphicon-remove'></i> </button>
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