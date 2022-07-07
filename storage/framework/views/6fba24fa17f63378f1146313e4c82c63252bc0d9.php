<aside id="left-panel">
<?php
$segment1 = Request::segment(1);
$segment2 = Request::segment(2);
$combine_segment = $segment1 . "/" . $segment2;
?>


<!-- User info -->
    <div class="login-info">
        <span> <!-- User image size is adjusted inside CSS, it should stay as it -->
            <a href="javascript:void(0);" id="show-shortcut">
                <i class="glyphicon glyphicon-user fa-lg"></i>
                <span style="padding-left:5px;">
                     <?php echo e((isset(session('user_info')->name) && !empty(session('user_info')->name))?session('user_info')->name:''); ?>

                </span>
            </a>
        </span>
    </div>
    <nav>
        <ul>
            <li class="active">
                <a href="<?php  echo asset('/program');?>" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i>
                    <span class="menu-item-parent">ডেসবোর্ড</span></a>
            </li>
            <?php
            $session_data = Session::get('user_info');
            if (isset($session_data->type) && $session_data->type != 2) {
                $roles = get_user_access_role('program');
                if (!empty($roles)) {

                    foreach ($roles as $item) {
                        if (is_array($item) && !empty($item)) {
                            foreach ($item as $key => $sub_menu) {

                                $level_info = explode('|', $key);
                                $level_name = $level_info[0];
                                $level_icon = $level_info[1];
                                echo "<li>";
                                echo "<a href='#'><i class='$level_icon'></i> <span class='menu-item-parent'>$level_name</span></a>";

                                if (is_array($sub_menu) && !empty($sub_menu)) {
                                    echo "<ul>";
                                    foreach ($sub_menu as $list_item) {
                                        foreach ($list_item as $link) {
                                            $active = in_array($segment1, [$link['link']]) ? 'active' : '';
                                            echo "<li class='$active'>";
                                            echo "<a href='{$link['link']}'>{$link['title']}</a>";
                                            echo "</li>";
                                        }
                                    }
                                    echo "</ul>";
                                }

                                echo "</li>";

                            }

                        }
                    }

                }
            }
            else {

            ?>


            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">শিল্পীর </span></a>
                <ul>
                    <li <?php if (in_array($segment1, ['artist_record'])) {
                        echo 'class="active"';
                    } ?> >
                        <a href="<?php  echo asset('/artist_record');?>">শিল্পীর তথ্য</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-folder-open"></i> <span class="menu-item-parent"> অনুষ্ঠান
                       </span></a>
                <ul>
                    <li <?php if (in_array($segment1, ['program_magazine_create'])) {
                        echo 'class="active"';
                    } ?> >
                        <a href="<?php  echo asset('/program_magazine_create');?>"> পরিকল্পনা (Planning)</a>
                    </li>
                    <li <?php if (in_array($segment1, ['program_planning_approved'])) {
                        echo 'class="active"';
                    } ?> >
                        <a href="<?php  echo asset('/program_planning_approved');?>">প্রস্তাব(Proposal)</a>
                    </li>
                    <li <?php if (in_array($segment1, ['program_proposal_approved'])) {
                        echo 'class="active"';
                    } ?> >
                        <a href="<?php  echo asset('/program_proposal_approved');?>">চুক্তি পত্র(Contract)</a>
                    </li>
                    <li <?php if (in_array($segment1, ['studio_booking_list'])) {
                        echo 'class="active"';
                    } ?> >
                        <a href="<?php  echo asset('/studio_booking_list');?>">স্টুডিও বুকিং</a>
                    </li>
                    <li <?php if (in_array($segment1, ['gate_passed_list'])) {
                        echo 'class="active"';
                    } ?> >
                        <a href="<?php  echo asset('/gate_passed_list');?>">গেইট পাস</a>
                    </li>


                    <li <?php if (in_array($segment1, ['program_recording_list'])) {
                        echo 'class="active"';
                    } ?> >
                        <a href="<?php  echo asset('/program_recording_list');?>">রেকডিং লিস্ট</a>
                    </li>

                <!--<li <?php if (in_array($segment1, ['program_account_payment_pending_list'])) {
                    echo
                    'class="active"';
                }
                ?> >
                        <a href="<?php  echo asset('/program_account_payment_pending_list');?>"><span
                                    class="menu-item-parent" >রিপোর্ট </span></a>
                    </li>-->


                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-folder-open"></i> <span
                            class="menu-item-parent">উপস্থাপনা</span></a>
                <ul>

                    <li <?php if (in_array($segment1, ['program_presentation_create'])) {
                        echo 'class="active"';
                    } ?> >
                        <a href="<?php  echo asset('/program_presentation_create');?>">পরিকল্পনা (Planning)</a>
                    </li>
                    <li <?php if (in_array($segment1, ['presentation_proposal_info'])) {
                        echo 'class="active"';
                    } ?> >
                        <a href="<?php  echo asset('/presentation_proposal_info');?>">প্রস্তাব(Proposal)</a>
                    </li>
                    <li <?php if (in_array($segment1, ['presentation_contract_info'])) {
                        echo 'class="active"';
                    } ?> >
                        <a href="<?php  echo asset('/presentation_contract_info');?>">চুক্তি পত্র(Contract)</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">কিউসিট  </span></a>
                <ul>

                    <li <?php if (in_array($segment1, ['master_date_program_time_table'])) {
                        echo 'class="active"';
                    } ?> >
                        <a href="<?php  echo asset('/master_date_program_time_table');?>">নতুন কিউসিট</a>
                    </li>
                    <li <?php if (in_array($segment1, ['approved_master_date_program_time_table'])) {
                        echo 'class="active"';
                    } ?> >
                        <a href="<?php  echo asset('/approved_master_date_program_time_table');?>">অনুমোদিত কিউসিট</a>
                    </li>

                    <li <?php if (in_array($segment1, ['program_plan_report'])) {
                        echo 'class="active"';
                    } ?> >
                        <a href="<?php  echo asset('/program_plan_report');?>">কিউসিট খুজুন </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">অধিবেশন  </span></a>
                <ul>

                    <li <?php if (in_array($segment1, ['odivision_program_queue_sheet'])) {
                        echo 'class="active"';
                    } ?> >
                        <a href="<?php  echo asset('/odivision_program_queue_sheet');?>">অধিবেশনসিট</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-folder-open"></i> <span class="menu-item-parent">এডহক
                        উপস্থাপনা
                    </span></a>
                <ul>

                    <li <?php if (in_array($segment1, ['program_adhok_presentation_create'])) {
                        echo 'class="active"';
                    } ?> >
                        <a href="<?php  echo asset('/program_adhok_presentation_create');?>">পরিকল্পনা (Planning)</a>
                    </li>
                    <li <?php if (in_array($segment1, ['presentation_adhok_proposal_info'])) {
                        echo 'class="active"';
                    } ?> >
                        <a href="<?php  echo asset('/presentation_adhok_proposal_info');?>">প্রস্তাব(Proposal)</a>
                    </li>
                    <li <?php if (in_array($segment1, ['presentation_adhok_contract_info'])) {
                        echo 'class="active"';
                    } ?> >
                        <a href="<?php  echo asset('/presentation_adhok_contract_info');?>">চুক্তি পত্র(Contract)</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-folder-open"></i> <span class="menu-item-parent">বিকল্প
                        উপস্থাপনা
                    </span></a>
                <ul>

                    <li <?php if (in_array($segment1, ['program_bikolpo_presentation_record'])) {
                        echo 'class="active"';
                    } ?> >
                        <a href="<?php  echo asset('/program_bikolpo_presentation_record');?>">পরিকল্পনা (Planning)</a>
                    </li>
                    <li <?php if (in_array($segment1, ['program_bikolpo_proposal_record'])) {
                        echo 'class="active"';
                    } ?> >
                        <a href="<?php  echo asset('/program_bikolpo_proposal_record');?>">প্রস্তাব(Proposal)</a>
                    </li>
                    <li <?php if (in_array($segment1, ['program_bikolpo_contract_record'])) {
                        echo 'class="active"';
                    } ?> >
                        <a href="<?php  echo asset('/program_bikolpo_contract_record');?>">চুক্তি পত্র(Contract)</a>
                    </li>
                </ul>
            </li>


            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-user"></i> <span
                            class="menu-item-parent">পারফরমেন্স  </span></a>
                <ul>

                    <li <?php if (in_array($segment1, ['performance_info'])) {
                        echo 'class="active"';
                    } ?> >
                        <a href="<?php  echo asset('/performance_info');?>">পারফরমেন্স এন্টি</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-folder-open"></i> <span
                            class="menu-item-parent">একাউন্টস সেকশান</span></a>
                <ul>

                    <li <?php if (in_array($segment1, ['waiting_payment'])) {
                        echo 'class="active"';
                    }
                        ?> >
                        <a href="<?php  echo asset('/waiting_payment');?>"><span
                                    class="menu-item-parent">Waiting For Payment</span></a>
                    </li>
                    <li <?php if (in_array($segment1, ['complete_payment'])) {
                        echo 'class="active"';
                    }
                        ?> >
                        <a href="<?php  echo asset('/complete_payment');?>"><span
                                    class="menu-item-parent">Complete Payment</span></a>
                    </li>


                </ul>
            </li>


            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-user"></i> <span
                            class="menu-item-parent">রিপোর্ট সমুহ </span></a>
                <ul>
                <!--<li <?php if (in_array($segment1, ['rep_artist_record'])) {
                    echo 'class="active"';
                } ?> >
                        <a href="<?php  echo asset('/rep_artist_record');?>">শিল্পীর তথ্য</a>
                    </li>-->

                    <li <?php if (in_array($segment1, ['artist_rate_chart_report'])) {
                        echo 'class="active"';
                    } ?> >
                        <a href="<?php  echo asset('/artist_rate_chart_report');?>">শিল্পীর সম্মানীর চার্ট</a>
                    </li>
                    <li <?php if (in_array($segment1, ['event_yearly_program_report'])) {
                        echo 'class="active"';
                    } ?> >
                        <a href="<?php  echo asset('/event_yearly_program_report');?>">উৎসবাদী ও বার্ষিকীর তালিকা</a>
                    </li>


                <!-- <li <?php if (in_array($segment1, ['live_program_report'])) {
                    echo 'class="active"';
                } ?> >
                        <a href="<?php  echo asset('/live_program_report');?>">সম্প্রচারিত প্রোগ্রাম</a>
                    </li>
                    <li <?php if (in_array($segment1, ['recorded_program_report'])) {
                    echo 'class="active"';
                } ?> >
                        <a href="<?php  echo asset('/recorded_program_report');?>">সংরক্ষিত প্রোগ্রাম</a>
                    </li>
                    <li <?php if (in_array($segment1, ['yearly_program_report'])) {
                    echo 'class="active"';
                } ?> >
                        <a href="<?php  echo asset('/yearly_program_report');?>">উৎসব ও বার্ষিকী প্রোগ্রাম</a>
                    </li>-->
                </ul>
            </li>


            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-cog"></i> <span
                            class="menu-item-parent" <?php if (in_array($segment1, ['program_ctg_setup'])) {
                        echo 'class="active"';
                    } ?>>সেটিংস</span></a>
                <ul>

                    <li <?php if (in_array($segment1, ['master_day_program_time_table'])) {
                        echo 'class="active"';
                    } ?> >
                        <a href="<?php  echo asset('/master_day_program_time_table');?>">নিদিষ্ট অনুষ্ঠান সময়সূচী</a>
                    </li>
                    <li <?php if (in_array($segment1, ['presentation_setting'])) {
                        echo 'class="active"';
                    } ?> >
                        <a href="<?php  echo asset('/presentation_setting');?>">উপস্থাপনা সেটিংস</a>
                    </li>

                    <li <?php if (in_array($segment1, ['program_ctg_setup'])) {
                        echo 'class="active"';
                    } ?> >
                        <a href="<?php  echo asset('/program_ctg_setup');?>">শিল্পীর দক্ষতা</a>
                    </li>
                    <li <?php if (in_array($segment1, ['artist_expertise_department'])) {
                        echo 'class="active"';
                    } ?> >
                        <a href="<?php  echo asset('/artist_expertise_department');?>">শিল্পীর দক্ষতার বিভাগ</a>
                    </li>

                    <li <?php if (in_array($segment1, ['program_type_setup'])) {
                        echo 'class="active"';
                    } ?> >
                        <a href="<?php  echo asset('/program_type_setup');?>">অনুষ্ঠানের ধরন</a>
                    </li>
                    <li <?php if (in_array($segment1, ['program_description_setup'])) {
                        echo 'class="active"';
                    } ?> >
                        <a href="<?php  echo asset('/program_description_setup');?>">অনুষ্ঠানে ভুমিকা</a>
                    </li>
                    <li <?php if (in_array($segment1, ['artist_national_awared_setup'])) {
                        echo 'class="active"';
                    } ?> >
                        <a href="<?php  echo asset('/artist_national_awared_setup');?>">জাতীয় পুরষ্কার</a>
                    </li>
                    <li <?php if (in_array($segment1, ['artist_work_station'])) {
                        echo 'class="active"';
                    } ?> >
                        <a href="<?php  echo asset('/artist_work_station');?>">শিল্পীর কর্মক্ষেত্র</a>
                    </li>
                    <li <?php if (in_array($segment1, ['artist_occupation'])) {
                        echo 'class="active"';
                    } ?> >
                        <a href="<?php  echo asset('/artist_occupation');?>">শিল্পীর পেশা</a>
                    </li>

                    <li <?php if (in_array($segment1, ['event_yearly_program'])) {
                        echo 'class="active"';
                    } ?> >
                        <a href="<?php  echo asset('/event_yearly_program');?>">উৎসবাদী ও বার্ষিকী অনুষ্ঠান তৈরি</a>
                    </li>
                    <li <?php if (in_array($segment1, ['artist_rate_chart'])) {
                        echo 'class="active"';
                    } ?> >
                        <a href="<?php  echo asset('/artist_rate_chart');?>">শিল্পীর সম্মানীর চার্ট তৈরি</a>
                    </li>
                </ul>
            </li>

            <?php } ?>

        </ul>
    </nav>
    <span class="minifyme" data-action="minifyMenu">
				<i class="fa fa-arrow-circle-left hit"></i>
			</span>

</aside>

