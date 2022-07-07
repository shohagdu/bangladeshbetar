{{--{"id":3,"station_id":null,"ctg_id":74,"grade_id":1,"description":"98","stability":"\u09e7\u09e6 \u09ae\u09bf\u09a8\u09bf\u099f\u09c7\u09b0 \u0989\u09b0\u09cd\u09a7\u09cd\u09ac\u09c7","amount":"2000.00","display_position":1,"mohoda_fee":null,"maximum_artist":null,"artist_vumika":null,"work_area":null,"remarks":null,"is_active":1,"created_by":1,"created_time":"2019-07-05 03:23:52","created_ip":"::1","updated_by":1,"updated_time":"2019-09-06 13:44:14","updated_ip":"::1"},--}}
<?php
//        echo "<pre>";
//    print_r($all_discription_ctg);
//    exit;
//?>
<div class="form-group">
    <label class="col-md-3 control-label">অনুষ্ঠানের বিবরন</label>
    <div class="col-md-6">
        <select required name="description" id="description" class="form-control description">
            <option value="">চিহ্নিত করুন</option>
            @if(!empty($all_discription_ctg))
                @foreach ($all_discription_ctg as $key => $value)
                    <option value="{{ $value->id }}" {{ (!empty($discription->id) && $discription->id==$value->id)
                    ?"selected":''   }}>{{ $value->title }}</option>
                @endforeach
            @endif
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-md-3 control-label">ভূমিকা</label>
    <div class="col-md-6">
        <select required name="artist_vumika" id="artist_vumika"
                class="form-control">
            <option value="">চিহ্নিত করুন</option>
            @if(!empty($artist_vumika))
                @foreach ($artist_vumika as $key => $value)
                    <option {{ (!empty($discription->rate_vumika) && $discription->rate_vumika==$key)
                    ?"selected":''   }}  value="{{ $key }}" >{{ $value }}</option>
                @endforeach
            @endif
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-md-3 control-label">কর্মক্ষেত্র</label>
    <div class="col-md-6">
        <select required name="work_area[]" multiple id="work_area_show" class=" select2" style="width:100%;"
                placeholder="চিহ্নিত করুন">
            <?php
            $artist_work_area= !empty($discription->rate_chart_work_area)?
                json_decode($discription->rate_chart_work_area,true):'';
            ?>
            @if(!empty($work_area))
                @foreach ($work_area as $key => $value)
                    <option <?php if (!empty($artist_work_area) && in_array($key,$artist_work_area)){ echo  $selected=
                        "selected";} ?> value="{{ $key }}" >{{ $value }}</option>
                @endforeach
            @endif
        </select>
    </div>
</div>

<table class="table width100per">
    <thead>
    <tr>
        <th class="width10per">শ্রেণী</th>
        <th class="width10per">অনুষ্ঠানের স্থিতি</th>
        <th class="width10per">সম্মানীর পরিমান</th>
        <th class="width6per">মহড়া ফি</th>
        <th class="width6per">জন(সবোর্চ্চ)</th>
        <th class="width10per">মন্তব্য</th>
        <th class="width6per">পজিশন</th>
        <th class="width6per">স্ট্যাটাস</th>
        <th class="width6per">#</th>
    </tr>

    </thead>

    @if(!empty($all_description_info))
        @foreach($all_description_info as $key=> $description_info )
            <tr>
                <td>
                    <input type="hidden"  id="rate_chart_id_{{ $key }}" class="form-control"
                           value="{{ $description_info->id }}" name="rate_chart_id[]"/>

                    <select required name="artist_song_grade[]" id="artist_song_grade_{{ $key }}"
                            class="form-control">
                        <option value="">চিহ্নিত করুন</option>
                        @if(!empty($artist_grade_info))
                            @foreach ($artist_grade_info as $key => $value)
                                <option value="{{ $key }}" {{ (!empty($description_info->grade_id) &&
                        $description_info->grade_id==$key)
                   ?"selected":''   }}>{{ $value }}</option>
                            @endforeach
                        @endif
                    </select>
                </td>
                <td><input type="text"  id="stability_{{ $key }}" class="form-control" placeholder="স্থিতি"
                           value="{{ $description_info->stability }}" name="stability[]"/></td>
                <td><input type="text"  id="amount_1"   value="{{ !empty($description_info->amount)
                   ?$description_info->amount:''   }}"  class="form-control onlyNumber"
                           placeholder="সম্মানীর পরিমান"  name="amount[]"/></td>
                <td> <select  id="mohoda_fee_{{ $key }}" class="form-control" name="mohoda_fee[]">
                        <option value="2" {{ (!empty($description_info->mohoda_fee) &&
                        $description_info->mohoda_fee==2)
                   ?"selected":''   }}>না</option>
                        <option value="1" {{ (!empty($description_info->mohoda_fee) &&
                        $description_info->mohoda_fee==1)
                   ?"selected":''   }}>হ্যাঁ</option>
                    </select>
                </td>
                <td><input type="text"  id="maximum_artist_{{ $key }}" class="form-control onlyNumber"
                           placeholder="জন(সবোর্চ্চ)"  value="{{ !empty($description_info->maximum_artist)
                   ?$description_info->maximum_artist:''   }}"  name="maximum_artist[]"/> </td>



                <td>
           <textarea  rows="1" id="remarks_info_{{ $key }}" class="form-control" placeholder="মন্তব্য"
                      name="remarks_info[]">{{ !empty($description_info->remarks)?$description_info->remarks:''   }}</textarea>
                </td>
                <td>
                    <input type="text"  id="display_position_{{ $key }}" class="form-control onlyNumber"
                           placeholder="পজিশন"  value="{{ !empty($description_info->display_position)
                   ?$description_info->display_position:''   }}" name="display_position[]"/>
                </td>
                <td>
                    <select  id="is_active_{{ $key }}" class="form-control" required  name="is_active[]">
                        <option value="">Select</option>
                        <option value="1" {{ (!empty($description_info->is_active) &&
                        $description_info->is_active==1)
                   ?"selected":''   }}>Active</option>
                        <option value="2" {{ (!empty($description_info->is_active) &&
                        $description_info->is_active==2)
                   ?"selected":''   }}>Inactive</option>
                    </select>
                </td>
                <td><a href="javascript:void(0);"  id="deleteRow_{{ $key }}"  class="deleteRow btn btn-warning btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i>  Drop</a></td>
            </tr>
        @endforeach
    @endif
    <tbody id="artist_chart_info_show" >
    </tbody>

    <tfoot>
    <tr>
        <td colspan="4">
            <button type="button" class="btn btn-primary btn-sm
                                        artist_expertise_info_update"><i
                        class="glyphicon glyphicon-plus"></i> Add
            </button>
        </td>
        <td colspan="5">
           <div id="form_output"></div>
        </td>

    </tr>
    </tfoot>


</table>
<input type="hidden" name="chart_id" id="chart_id" value="{{ $discription->id }}">

<script>
    $('#work_area_show').select2();
    var scntartist_chart_info = $('#artist_chart_info_show');
    var b = $('#artist_chart_info_show tr').size() + 2;
    $('.artist_expertise_info_update').on('click', function () {
        $('<tr><td>\n' +
            '                                        <select required name="artist_song_grade[]" id="artist_song_grade_1"\n' +
            '                                                class="form-control">\n' +
            '                                            <option value="">চিহ্নিত করুন</option>\n' +
            '                                            @if(!empty($artist_grade_info))\n' +
            '                                                @foreach ($artist_grade_info as $key => $value)\n' +
            '                                                    <option value="{{ $key }}">{{ $value }}</option>\n' +
            '                                                @endforeach\n' +
            '                                            @endif\n' +
            '                                        </select>\n' +
            '                                    </td><td><input type="text"  id="stability_1" ' +
            'class="form-control" placeholder="স্থিতি" value="" name="stability[]"/></td> <td><input type="text" ' +
            ' id="amount_1" class="form-control onlyNumber" placeholder="সম্মানীর পরিমান"  value="" ' +
            'name="amount[]"/></td> <td> <select  id="mohoda_fee_1" class="form-control" name="mohoda_fee[]">\n' +
            '                                            <option value="2">না</option>\n' +
            '                                            <option value="1">হ্যাঁ</option>\n' +
            '                                        </select>\n' +
            '                                    </td> <td><input type="text"  id="maximum_artist_1" class="form-control onlyNumber"\n' +
            '                                                     placeholder="জন(সবোর্চ্চ)"  value="" name="maximum_artist[]"/> </td>\n' +
            '                                    <td>\n' +
            '                                        <textarea  rows="1" id="remarks_info_1" class="form-control" placeholder="মন্তব্য"\n' +
            '                                                   name="remarks_info[]"></textarea>\n' +
            '                                    </td>\n' +
            '                                    <td>\n' +
            '                                        <input type="text"  id="display_position_1" class="form-control onlyNumber"\n' +
            '                                               placeholder="পজিশন"  value="" name="display_position[]"/>\n' +
            '                                    </td>\n' +
            '                                    <td>\n' +
            '                                        <select  id="is_active-1" class="form-control" required  name="is_active[]">\n' +
            '                                            <option value="">Select</option>\n' +
            '                                            <option value="1" selected>Active</option>\n' +
            '                                            <option value="2">Inactive</option>\n' +
            '                                        </select>\n' +
            '                                    </td><td><a href="javascript:void(0);"  id="deleteRow_' + b + '"  class="deleteRow btn btn-warning btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i>  Drop</a></td></tr>').appendTo(scntartist_chart_info);

        b++;
        return false;
    });


</script>