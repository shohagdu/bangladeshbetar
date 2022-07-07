<?php
    $odivision_data=odivision_info_data();
    $role_info_data=role_info_data();
?>
<table class="table-bordered table">
    <?php
        if(!empty($presentation_info)){
            foreach ($presentation_info as $date=>$all_info){
    ?>
    <tr>
        <td><?php echo e($date); ?></td>
        <td>
            <table class="table-bordered table">
                <tr>
                    <th>পালা</th>
                    <?php
                    if(!empty($role_tile_info)){
                        foreach ($role_tile_info as $role_title){
                            if(!empty($role_title)){
                                echo "<th>".$role_info_data[$role_title]."</th>";
                            }
                        }
                    }
                    ?>
                </tr>
                <?php
                    if(!empty($all_info)){
                        foreach ($all_info as $odivison=>$all_role_wise_artist){
                ?>

                <tr>
                    <td><?php echo e((!empty($odivison))?$odivision_data[$odivison]:''); ?></td>
                    <?php

                        foreach ($all_role_wise_artist as $key=>$artist_info){
                    ?>
                    <td><?php
                            $name_bn=array_column($artist_info,'name_bn');
                            echo implode(", ",$name_bn);
                        ?></td>
                    <?php } ?>
                </tr>
                <?php }} ?>

            </table>
        </td>
        <td style="width:100px;">
            <button type="button" onclick="adhokt_add('<?php echo e($date); ?>',$('#station_id').val(),$('#sub_station_id').val(),$('#presentation_id').val())" class="btn
            btn-primary
            btn-sm">এডহক
                সংযুক্তি</button>
        </td>
    </tr>
    <?php } } ?>
</table>

<div class="container">
    <div class="modal fade" id="atttach_adhok_add" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="padding:10px 20px;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4><span class="glyphicon glyphicon-lock"></span> এডহক উপস্থাপনা তথ্য সমুহ</h4>
                </div>
                <div id="show_adhok_attach_info"></div>
            </div>

        </div>
    </div>
</div>
