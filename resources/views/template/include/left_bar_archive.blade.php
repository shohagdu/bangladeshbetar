<aside id="left-panel">
<?php
$segment1 =  Request::segment(1);
$segment2 =  Request::segment(2);
$combine_segment=$segment1."/".$segment2
?>


<!-- User info -->
    <div class="login-info">
        <span> <!-- User image size is adjusted inside CSS, it should stay as it -->
            <a href="javascript:void(0);" id="show-shortcut" >
                <i class="glyphicon glyphicon-user fa-lg"></i>
                <span style="padding-left:5px;">
                     {{ (isset(session('user_info')->name) && !empty(session('user_info')->name))?session('user_info')->name:'' }}
                </span>
            </a>
        </span>
    </div>
    <nav>
        <ul>
            <li class="active">
                <a href="<?php  echo asset('/betar_archive');?>" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">ডেসবোর্ড</span></a>
            </li>


            
            <li>
                <a href="#"><i class="fa fa-archive"></i> <span class="menu-item-parent">আর্কাইভ এন্ট্রি</span></a>
                <ul>
                    <li <?php if(in_array($segment1,['archive_song_create'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/archive_song_create');?>">সংগীত</a>
                    </li>
                    <li <?php if(in_array($segment1,['archive_kobita_create'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/archive_kobita_create');?>">গল্প/কবিতা</a>
                    </li>
                    <li <?php if(in_array($segment1,['archive_natok_create'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/archive_natok_create');?>">নাটক</a>
                    </li>
                    <li <?php if(in_array($segment1,['archive_onusthan_create'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/archive_onusthan_create');?>">কম্পোজিট অনুষ্ঠান</a>
                    </li>
                    <li <?php if(in_array($segment1,['archive_vhason_create'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/archive_vhason_create');?>">ভাষণ</a>
                    </li>
                    <li <?php if(in_array($segment1,['archive_sakhhatkar_create'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/archive_sakhhatkar_create');?>">সাক্ষাৎকার</a>
                    </li>
                    <li <?php if(in_array($segment1,['archive_kothika_create'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/archive_kothika_create');?>">কথিকা</a>
                    </li>
                    <li <?php if(in_array($segment1,['archive_procharona_create'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/archive_procharona_create');?>">প্রচারণা</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-archive"></i> <span class="menu-item-parent">আর্কাইভ এন্ট্রি লিস্ট</span></a>
                <ul>
                    <li <?php if(in_array($segment1,['get_archive_list'])){ echo 'class="active"';} ?>>
                        <a href="<?php  echo asset('/get_archive_list');?>">সংগীত</a>
                    </li>
                    <li <?php if(in_array($segment1,['get_kobita_list'])){ echo 'class="active"';} ?>>
                        <a href="<?php  echo asset('/get_kobita_list');?>">গল্প/কবিতা</a>
                    </li>
                    <li <?php if(in_array($segment1,['get_natok_list'])){ echo 'class="active"';} ?>>
                        <a href="<?php  echo asset('/get_natok_list');?>">নাটক</a>
                    </li>
                    <li <?php if(in_array($segment1,['get_program_list'])){ echo 'class="active"';} ?>>
                        <a href="<?php  echo asset('/get_program_list');?>">কম্পোজিট অনুষ্ঠান</a>
                    </li>
                    <li <?php if(in_array($segment1,['get_vhason_list'])){ echo 'class="active"';} ?>>
                        <a href="<?php  echo asset('/get_vhason_list');?>">ভাষণ</a>
                    </li>
                    <li <?php if(in_array($segment1,['get_sakhhatkar_list'])){ echo 'class="active"';} ?>>
                        <a href="<?php  echo asset('/get_sakhhatkar_list');?>"> সাক্ষাৎকার </a>
                    </li>
                    <li <?php if(in_array($segment1,['get_kothika_list'])){ echo 'class="active"';} ?>>
                        <a href="<?php  echo asset('/get_kothika_list');?>">কথিকা</a>
                    </li>
                    <li <?php if(in_array($segment1,['get_procharona_list'])){ echo 'class="active"';} ?>>
                        <a href="<?php  echo asset('/get_procharona_list');?>">প্রচারণা</a>
                    </li>
                </ul>
            </li>


            <li>
                <a href="#"><i class="fa fa-archive"></i> <span class="menu-item-parent">আর্কাইভ রিভিউ</span></a>
                <ul>
                    <li <?php if(in_array($segment1,['archive_song_review'])){ echo 'class="active"';} ?>>
                        <a href="<?php  echo asset('/archive_song_review');?>">সংগীত</a>
                    </li>
                    <li <?php if(in_array($segment1,['archive_kobita_review'])){ echo 'class="active"';} ?>>
                        <a href="<?php  echo asset('/archive_kobita_review');?>">গল্প/কবিতা</a>
                    </li>
                    <li <?php if(in_array($segment1,['archive_natok_review'])){ echo 'class="active"';} ?>>
                        <a href="<?php  echo asset('/archive_natok_review');?>">নাটক</a>
                    </li>
                    <li <?php if(in_array($segment1,['archive_program_review'])){ echo 'class="active"';} ?>>
                        <a href="<?php  echo asset('/archive_program_review');?>">কম্পোজিট অনুষ্ঠান</a>
                    </li>
                    <li <?php if(in_array($segment1,['archive_vhason_review'])){ echo 'class="active"';} ?>>
                        <a href="<?php  echo asset('/archive_vhason_review');?>">ভাষণ</a>
                    </li>
                    <li <?php if(in_array($segment1,['archive_sakhhatkar_review'])){ echo 'class="active"';} ?>>
                        <a href="<?php  echo asset('/archive_sakhhatkar_review');?>">সাক্ষাৎকার</a>
                    </li>
                    <li <?php if(in_array($segment1,['archive_kothika_review'])){ echo 'class="active"';} ?>>
                        <a href="<?php  echo asset('/archive_kothika_review');?>">কথিকা</a>
                    </li>
                    <li <?php if(in_array($segment1,['archive_procharona_review'])){ echo 'class="active"';} ?>>
                        <a href="<?php  echo asset('/archive_procharona_review');?>">প্রচারণা</a>
                    </li>
                </ul>
            </li>
            <li  <?php if(in_array($segment1,['archive_book'])){ echo 'class="active"';} ?> >
                <a href="<?php  echo asset('/archive_book');?>" title="আর্কাইভ"><i class="fa fa-lg fa-fw fa-book"></i> <span class="menu-item-parent">আর্কাইভ</span></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-archive"></i> <span class="menu-item-parent">প্লে লিস্ট</span></a>
                <ul>
                    <li <?php if(in_array($segment1,['archive_playlist_create'])){ echo 'class="active"';} ?>>
                        <a href="<?php  echo asset('/archive_playlist_create');?>">নতুন প্লে লিস্ট</a>
                    </li>
                    <li <?php if(in_array($segment1,['get_play_list'])){ echo 'class="active"';} ?>>
                        <a href="<?php  echo asset('/get_play_list');?>">প্লে লিস্ট</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-cogs"></i> <span class="menu-item-parent">সেটিংস</span></a>
                <ul>
                    <li>
                        <a href="#"><i class="fa fa-cog"></i> <span class="menu-item-parent">টাইপ সমুহ</span></a>
                        <ul>
                            <li <?php if(in_array($segment1,['archive_song_type'])){ echo 'class="active"';} ?> >
                                <a href="<?php  echo asset('/archive_song_type');?>">সংগীত</a>
                            </li>
                            <li <?php if(in_array($segment1,['archive_kobita_type'])){ echo 'class="active"';} ?> >
                                <a href="<?php  echo asset('/archive_kobita_type');?>">কবিতা</a>
                            </li>
                            <li <?php if(in_array($segment1,['archive_natok_type'])){ echo 'class="active"';} ?> >
                                <a href="<?php  echo asset('/archive_natok_type');?>">নাটক</a>
                            </li>
                            <li <?php if(in_array($segment1,['archive_film_type'])){ echo 'class="active"';} ?> >
                                <a href="<?php  echo asset('/archive_film_type');?>">ছায়াছবি</a>
                            </li>
                            <li <?php if(in_array($segment1,['archive_band_type'])){ echo 'class="active"';} ?> >
                                <a href="<?php  echo asset('/archive_band_type');?>">ব্যন্ড</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-cog"></i> <span class="menu-item-parent">প্রকার সমুহ</span></a>
                        <ul>
                            <li <?php if(in_array($segment1,['archive_natok_category'])){ echo 'class="active"';} ?> >
                                <a href="<?php  echo asset('/archive_natok_category');?>">নাটকের প্রকার</a>
                            </li>
                            <li <?php if(in_array($segment1,['archive_program_category'])){ echo 'class="active"';} ?> >
                                <a href="<?php  echo asset('/archive_program_category');?>">অনুষ্ঠানের প্রকার</a>
                            </li>
                            <li <?php if(in_array($segment1,['archive_vhason_category'])){ echo 'class="active"';} ?> >
                                <a href="<?php  echo asset('/archive_vhason_category');?>">ভাষণ প্রকার</a>
                            </li>
                            <li <?php if(in_array($segment1,['archive_sakhhatkar_category'])){ echo 'class="active"';} ?> >
                                <a href="<?php  echo asset('/archive_sakhhatkar_category');?>">সাক্ষাৎকার প্রকার</a>
                            </li>

                            <li <?php if(in_array($segment1,['archive_song_category'])){ echo 'class="active"';} ?> >
                                <a href="<?php  echo asset('/archive_song_category');?>">সংগীতের প্রকার</a>
                            </li>

                            <li <?php if(in_array($segment1,['archive_song_sub_category'])){ echo 'class="active"';} ?> >
                                <a href="<?php  echo asset('/archive_song_sub_category');?>">সংগীতের উপ প্রকার</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-cog"></i> <span class="menu-item-parent">এ্যালবাম</span></a>
                        <ul>
                            <li <?php if(in_array($segment1,['archive_song_album'])){ echo 'class="active"';} ?>>
                                <a href="<?php  echo asset('/archive_song_album');?>">সংগীত অ্যালবাম</a>
                            </li>
                            <li <?php if(in_array($segment1,['archive_kobita_album'])){ echo 'class="active"';} ?>>
                                <a href="<?php  echo asset('/archive_kobita_album');?>">কবিতার এ্যালবাম</a>
                            </li>
                        </ul>
                    </li>
                    <li <?php if(in_array($segment1,['archive_source'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/archive_source');?>">আর্কাইভ সোর্স</a>
                    </li>
                    <li <?php if(in_array($segment1,['archive_instument'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/archive_instument');?>">বাদ্য যন্ত্র</a>
                    </li>
                    <li <?php if(in_array($segment1,['archive_band'])){ echo 'class="active"';} ?>>
                        <a href="<?php  echo asset('/archive_band');?>">ব্যন্ড</a>
                    </li>
                    <li <?php if(in_array($segment1,['archive_angik'])){ echo 'class="active"';} ?>>
                        <a href="<?php  echo asset('/archive_angik');?>">আঙ্গিক</a>
                    </li>
                    <li <?php if(in_array($segment1,['archive_ministry'])){ echo 'class="active"';} ?>>
                        <a href="<?php  echo asset('/archive_ministry');?>">মন্ত্রণালয়</a>
                    </li>
                    <li <?php if(in_array($segment1,['archive_doptor'])){ echo 'class="active"';} ?>>
                        <a href="<?php  echo asset('/archive_doptor');?>">মন্ত্রণালয় দপ্তর</a>
                    </li>

                </ul>
            </li>

        </ul>
    </nav>
    <span class="minifyme" data-action="minifyMenu">
				<i class="fa fa-arrow-circle-left hit"></i>
			</span>

</aside>

