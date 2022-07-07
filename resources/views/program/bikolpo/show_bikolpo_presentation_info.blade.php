<?php
$odivision_data = odivision_info_data();
$role_info_data = role_info_data();
?>
<table style="width:100%;">
    <?php
    if(!empty($presentation_info)){
    foreach ($presentation_info as $date=>$all_info){
    ?>
    <tr>
        <td>
            <table class="table-style" style="width: 100%;">
                <?php
                if(!empty($all_info)){
                foreach ($all_info as $odivison=>$all_role_wise_artist){
                ?>
                <tr style="background-color: #d0d0d0;">
                    <th>{{  (!empty($odivison))?$odivision_data[$odivison]:'' }}</th>
                </tr>
                <?php
                foreach ($all_role_wise_artist as $key=>$artist_info){
                ?>
                <tr>
                    <th><?php echo $role_info_data[$key] ?> </th>
                    <td>
                        <table  class="table-style" style="width: 100%;">
                            <?php
                                $i=1;
                            foreach ($artist_info as $single_artist_info){
                             ?>
                            <tr>

                                <td class="width30per">
                                    <?php echo $single_artist_info['name_bn'] ?>
                                        <input type="hidden" value="<?php echo $single_artist_info['artist_info_primary_id'] ?>"
                                               name="bikolpo_artist_info_primary_id[]">
                                </td>
                                <td>
                                    <?php
                                        $is_bikolpo_exit=!empty($single_artist_info['bikolpo_artist_info'])?json_decode
                                        ($single_artist_info['bikolpo_artist_info']):NULL;
                                    ?>
                                    <select class="width50per"
                                            name="bikolpo_artist_info[{{$single_artist_info['artist_info_primary_id']}}]" >
                                        <option value="">চিহ্নিত করুন</option>
                                        @if(!empty($atrist_info_info))
                                            @foreach($atrist_info_info as $artist_id=>$artist_name)
                                                <option value="{{ $artist_id }}" {{ ((!empty
                                                ($is_bikolpo_exit->artist_id) &&
                                                ($is_bikolpo_exit->artist_id==$artist_id) )?"selected":'') }}>{{
                                                    $artist_name
                                                    }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </td>
                            </tr>
                            <?php } ?>
                        </table>
                    </td>
                </tr>
                <?php } ?>

                <?php }} ?>

            </table>
        </td>
    </tr>
    <?php } } ?>
    <tr>
        <!--
        <td><button type="button" id="updateBikolpoInfoBtn" class="btn btn-primary btn-sm" onclick="updateBikolpoInfo()
">Update Now</button>
        </td>
        -->
    </tr>
</table>
<br/>
<br/>
<style>
    .table-style td{
        border:1px solid #d0d0d0;
        padding:1px;
    }
    .table-style th{
        border:1px solid #d0d0d0;
        padding:1px;
    }

</style>
