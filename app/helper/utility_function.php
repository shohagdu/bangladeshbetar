<?php
function show_gender($type=NULL){
    if($type==1) {
        return 'Male';
    }elseif($type==2){
        return 'Female';
    }elseif($type==3){
        return 'Other';
    }else{
        return false;
    }
}
function show_employee_status($status=NULL){
    if($status==1) {
        return 'Active';
    }elseif($status==2){
        return 'Inactive';
    }elseif($status==3){
        return 'Terminated';
    }elseif($status==4){
        return 'OSD';
    }else{
        return false;
    }
}
function blood_group_show($group_id){
    if($group_id==1) {
        return 'A+(Positive)';
    }elseif($group_id==2){
        return 'A-(Negative)';
    }elseif($group_id==3){
        return 'B+(Positive)';
    }elseif($group_id==4){
        return 'B-(Negative)';
    }elseif($group_id==5){
        return 'AB+(Positive)';
    }elseif($group_id==6){
        return 'AB-(Negative)';
    }elseif($group_id==7){
        return 'O+(Positive)';
    }elseif($group_id==8){
        return 'O-(Negative)';
    }else{
        return false;
    }
}
function religion_info($id){
    if($id==1) {
        return 'Islam';
    }elseif($id==2){
        return 'Hinduism';
    }elseif($id==3){
        return 'Buddhism';
    }elseif($id==4){
        return 'Christianity';
    }else{
        return false;
    }
}

function show_day_info(){
    return array('Sat','Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri');
}
function show_day_info_bn(){
    return array('Sat'=>'শনিবার ','Sun'=>'রবিবার', 'Mon'=>'সোমবার', 'Tue'=>'মঙ্গলবার', 'Wed'=>'বুধবার', 'Thu'=>'বৃহস্পতিবার', 'Fri'=>'শুক্রবার');
}
function training_info($training_type){
    return ($training_type==1)?'Local Training':'Forign Training';
}
function marital_status($status){
    return ($status==1)?'Married':'Unmarried';
}

function get_title_info($id){
    if(!empty($id)){
      return  App\All_stting::get_settings_title_info(['id'=>$id]);
    }else{
        return '';
    }
}
function get_branch_name($id){
    if(!empty($id)){
      return  App\All_stting::get_branch_name(['id'=>$id]);
    }else{
        return '';
    }
}

function get_branch($id){
    if(!empty($id)){
      return  App\All_stting::get_branch(['id'=>$id]);
    }else{
        return '';
    }
}

function show_days_year(){
    return ['Years','Months','Days','N/A'];
}

function jsonEncodeToDecode($data=Null){
    if(!empty($data)){
        return json_decode($data,true);
    }else{
        return false;
    }
}

function artist_ctg(){
    return array(1=>'ক',2=>'খ', 3=>'গ');
}
function artist_type(){
    return array(
        1=>'নিজস্ব শিল্পী (স্টাফ আর্টিস্ট)',
        2=>'তালিকাভূক্ত শিল্পী (পারফরমিং আর্টিস্ট)',
        3=>'অনিয়মিত শিল্পী (ক্যাজুয়াল আর্টিস্ট)',
        4=>'বেতার বর্হিভূত শিল্পী(আউটসাইডার আর্টিস্ট) ',
    );
}

function torimasik_porikolpona_info(){
    return array(
        1=>'১ম: (বৈশাখ-আযাঢ়)',
        2=>'২য়: (শ্রাবন-আশ্বিন)',
        3=>'৩য়: (কার্তিক-পৌষ)',
        4=>'৪র্থ: (মাঘ-চৈত্র)',
    );
}
function fixed_onusan_suchy_info(){
    return array(
        1=>'গ্রীষ্ম কালীন',
        2=>'শীতকালীন'
    );
}

function prgram_manage(){
   return $manage = [
        6 => 'অনুষ্ঠান পরিকল্পনাকারী',
        1 => 'প্রযোজনা',
//        2 => 'সম্পাদনা',
//        3 => 'প্রযোজনা সহকারী',
        4 => 'তত্বাবধানে',
        5 => 'নির্দেশনা',
    ];
}


function get_odivision($id) {
    if(!empty($id)) {
        return  App\All_stting::get_odivision(['id'=>$id]);
    } else {
        return '';
    }
}

function get_artist_rate_chart_details($ctg) {
    // return $ctg;
    if(!empty($ctg)) {
        return  App\All_stting::get_all_honouriam_sub_ctg($ctg);
    } else {
        return [];
    }
}
function get_artist_rate_chart_info($sub_ctg) {
    // return $ctg;
    if(!empty($sub_ctg)) {
        return  App\All_stting::get_artist_rate_chart_details($sub_ctg);
    } else {
        return [];
    }
}


function get_schedule($station,$sub_station,$live_date,$live_time){
    return  App\All_stting::get_schedule($station,$sub_station,$live_date,$live_time);
}

function eng2bnNumber ($number){
    $search_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0",'am','pm', "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December", ":", ",");
    $replace_array = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০",'(পূর্বাহ্ণ)','(অপরাহ্ণ)', "জানুয়ারী", "ফেব্রুয়ারী", "মার্চ", "এপ্রিল", "মে", "জুন", "জুলাই", "আগষ্ট", "সেপ্টেম্বার", "অক্টোবার", "নভেম্বার", "ডিসেম্বার", ":", ",");
    $en_number = str_replace($search_array, $replace_array, $number);
    return $en_number;
}

function month_name_info(){
   return $month = [
        '1' => "জানুয়ারি",
        '2' => "ফেব্রুয়ারি",
        '3' => "মার্চ",
        '4' => "এপ্রিল",
        '5' => "মে",
        '6' => "জুন",
        '7' => "জুলাই",
        '8' => "আগস্ট",
        '9' => "সেপ্টেম্বর",
        '10' => "অক্টোবর",
        '11' => "নভেম্বর",
        '12' => "ডিসেম্বর",
    ];
}

function odivision_info_data(){
    return $all_odivision=[
        1=>'১ম পালা',
        2=>'২য় পালা',
        3=>'৩য় পালা',
        4=>'৪র্থ পালা',
    ];
}
function role_info_data(){
    return [
        'duty_officer'=>'ডিউটি অফিসার',
        'announcer'=>'ঘোষক',
        'log_writer'=>'লগ রাইটার',
        'officer_assistent'=>'অফিস সহায়ক',
        'officer_incharge'=>'অফিসার ইনসার্স',
    ];
}

function program_presentation_type(){
    return [
      //  রেগুলার
        1=>'',
        2=>'এডহক',
        3=>'বিকল্প'
    ];
}

function get_name_by_id($table,$where) {
    return App\Archive_model::get_row($table,["*"],$where);
}

function per_page_dropdown(){
    return [
        10,20,30,50
    ];
}

function program_vittik_name($ids) {
    $array = [
        1 => 'শিশু',
        2 => 'কিশোর',
        3 => 'যুবক-যুবতি',
        4 => 'নারী',
        5 => 'পুরুষ',
        6 => 'প্রবীণ',
    ];
//    dd('test');
    return $array[$ids];
}

function get_shilpi_name_by_ids($ids) {
    $where_in = ['field'=>'id','value'=>$ids];
    $artists =  App\Archive_model::get_rows("program_artist_info",["*"],false,false,$where_in);
    $names = [];
    foreach($artists as $row) {
        $names[] = $row->name_bn;
    }
    return implode(', ',$names);
}

function get_employee_name_by_ids($ids) {
    $where_in = ['field'=>'employee_id','value'=>$ids];
    $artists =  App\Archive_model::get_rows("employees",["*"],false,false,$where_in);
    $names = [];
    foreach($artists as $row) {
        $names[] = $row->emp_name;
    }
    echo implode(', ',$names);
}

function get_name_by_ids($table,$ids) {
    $where_in = ['field'=>'id','value'=>$ids];
    $artists =  App\Archive_model::get_rows($table,["*"],false,false,$where_in);
    $names = [];
    foreach($artists as $row) {
        $names[] = $row->name;
    }
    echo implode(', ',$names);
}

function get_participant($id){
    $name = '';
    if($id==1) {
        $name = 'একক';
    }
    elseif($id==2){
        $name = 'ডুয়েট';
    }
    elseif($id==3) {
        $name = 'দলিয়';
    }
    echo $name;
}

function get_archive_type_name($archive_type){
    $name = '';
    if($archive_type==1){
        $name = 'সংগীত';
    }
    elseif($archive_type==2){
        $name = 'গল্প/কবিতা';
    }
    elseif($archive_type==3){
        $name = 'নাটক';
    }
    elseif($archive_type==4){
        $name = 'কম্পজিট অনুষ্ঠান';
    }
    elseif($archive_type==5){
        $name = 'ভাষণ';
    }
    elseif($archive_type==6){
        $name = 'সাক্ষাৎকার';
    }
    elseif($archive_type==7){
        $name = 'কথিকা';
    }
    elseif($archive_type==8){
        $name = 'প্রচারনা';
    }
    echo $name;
}

function get_vumika_name($id) {
    $artists =  App\Archive_model::get_row("all_sttings",["*"],['id'=>$id]);
    if($artists){
        return $artists->title;
    }
    else {
        return '';
    }
}

//function get_file_name($ids){
////    dd($ids);
//    return '';
//}

function get_request_url($key,$index=false)
{
    $temp_request = $_REQUEST;
    if(isset($_REQUEST[$key])) {
        if(count(array_unique($_REQUEST[$key]))==1) {
            unset($temp_request[$key]);
            unset($temp_request['search_string']);
        }
        else {
            if ($index >= 0) {
                unset($temp_request[$key][$index]);
            } else {
                unset($temp_request[$key]);
            }
        }
    }

    if(isset($temp_request['search']))
    {
        unset($temp_request['search']);
    }
    $string = http_build_query($temp_request);
    return Request::url().'?'.$string;
}

function get_songit_key_name($key) {
    $songit = [
        '1' => 'first_line',
        '2' => 'name',
        '3' => 'category',
        '4' => 'artist',
        '5' => 'gitikar',
        '6' => 'surokar',
        '7' => 'film_name',
        '8' => 'album_id',
        '9' => 'band_id',
        '10' => 'rating'
    ];
    return $songit[$key];
}

function get_program_key_name($key) {
    $songit = [
        '1' => 'name',
        '2' => 'category',
        '3' => 'rating',
        '4' => 'stability',
        '5' => 'gobeshona',
        '6' => 'gronthona',
        '7' => 'uposthapona'
    ];
    return $songit[$key];
}



function program_search_item() {
    $array = [
        1 => 'অনুষ্ঠানের নাম',
        2 => 'অনুষ্ঠানের প্রকার',
        3 => 'রেটিং',
        4 => 'স্থিতিি',
        5 => 'গবেষণা',
        6 => 'গ্রন্থনা',
        7 => 'উপ্সথাপনা'
    ];
    return $array;
}

function get_program_key_text($key) {
    $array = program_search_item();
    return $array[$key];
}



function get_songit_extra_column()
{
        return [
            'station_id' => 'কেন্দ্র',
            'created_by' => 'সংরক্ষনকারী',
            'created_at' => 'সংরক্ষণ টাইম',
            'name' => 'সংগীতের নাম',
            'sub_category' => 'গানের উপ প্রকার',
            'rating' => 'রেটিং',
            'album_id' => 'এ্যালবাম',
            'film_director' => 'ছায়াছবির পরিচালক',
            'film_actors' => 'অভিনিত শিল্পী',
            'film_name' => 'ছবির নাম',
            'band_id' => 'ব্যন্ডের নাম',
        ];
}

function get_kobita_extra_column()
{
        return [
            'station_id' => 'কেন্দ্র',
            'created_by' => 'সংরক্ষনকারী',
            'created_at' => 'সংরক্ষণ টাইম',
            'name' => 'কবিতার নাম',
            'rating' => 'রেটিং',
            'type_id' => 'কবিতার ধরন',
        ];
}

function get_natok_extra_column()
{
        return [
            'station_id' => 'কেন্দ্র',
            'created_by' => 'সংরক্ষনকারী',
            'created_at' => 'সংরক্ষণ টাইম',
            'category' => 'নাটকের প্রকার',
            'rochoyita' => 'গল্প রচয়িতা',
            'rating' => 'রেটিং',
        ];
}

function get_program_extra_column()
{
        return [
            'station_id' => 'কেন্দ্র',
            'created_by' => 'সংরক্ষনকারী',
            'created_at' => 'সংরক্ষণ টাইম',
            'rating' => 'রেটিং',
        ];
}

function get_vhason_extra_column()
{
        return [
            'station_id' => 'কেন্দ্র',
            'created_by' => 'সংরক্ষনকারী',
            'created_at' => 'সংরক্ষণ টাইম',
            'subject' => 'বিষয়',
        ];
}

function get_program_column_title($value)
{
    $columns = get_program_extra_column();
    return $columns[$value];
}

function get_vhason_column_title($value)
{
    $columns = get_vhason_extra_column();
    return $columns[$value];
}

function get_natok_column_title($value)
{
    $columns = get_natok_extra_column();
    return $columns[$value];
}

function get_kobita_column_title($value)
{
    $columns = get_kobita_extra_column();
    return $columns[$value];
}

function get_songit_column_title($value){
    $columns = get_songit_extra_column();
    return $columns[$value];
}

function get_songit_item_key() {
    return  [
        1, 2, 3, 4, 5, 6, 7, 8, 9, 10
    ];
}
function get_program_item_key() {
    return  [
        1, 2, 3, 4, 5, 6, 7
    ];
}

function get_vhason_item_key() {
    return  [
        1, 2, 3, 4,5
    ];
}

function get_kobita_item_key() {
   return  [
        1, 2, 3, 4, 5, 6, 7, 8
    ];
}

function get_natok_item_key() {
   return  [
        1, 2, 3, 4, 5, 6, 7, 8
    ];
}

function get_kobita_key_name($key) {
    $songit = [
        '1' => 'name',
        '2' => 'type_id',
        '3' => 'first_line',
        '4' => 'rating',
        '5' => 'stability',
        '6' => 'album_id',
        '7' => 'abritikar',
        '8' => 'rochoyita'
    ];
    return $songit[$key];
}

function kobita_search_item() {
    $array = [
        1 => 'কবিতার নাম',
        2 => 'কবিতার ধরন',
        3 => 'কবিতার প্রথম লাইন',
        4 => 'রেটিং',
        5 => 'স্থিতি',
        6 => 'কবিতার এ্যালবাম',
        7 => 'আবৃতিকার',
        8 => 'রচয়িতা'
    ];
    return $array;
}

function get_kobita_key_text($key) {
    $array = [
        1 => 'কবিতার নাম',
        2 => 'কবিতার ধরন',
        3 => 'কবিতার প্রথম লাইন',
        4 => 'রেটিং',
        5 => 'স্থিতি',
        6 => 'কবিতার এ্যালবাম',
        7 => 'আবৃতিকার',
        8 => 'রচয়িতা'
    ];
    return $array[$key];
}

function get_songit_key_text($key) {
    $songit = [
        '1' => 'গানের প্রথম লাইনঃ',
        '2' => 'গানের নামঃ',
        '3' => 'গানের প্রকারঃ',
        '4' => 'গানের শিল্পীঃ',
        '5' => 'গানের গীতিকারঃ',
        '6' => 'গানের সুরকারঃ',
        '7' => 'গানের ছায়াছবির নামঃ',
        '8' => 'গানের এ্যালবামঃ',
        '9' => 'গানের ব্যন্ডঃ',
        '10' => 'গানের রেটিংঃ',
    ];
    return $songit[$key];
}

function get_tab_active_class($key) {
     $request = $_REQUEST;
     if(!empty($request['archive_type'])) {
         $type = $request['archive_type'];
         if($type==$key){
             return 'active';
         }
     }
     else {
         return '';
     }
}

function natok_search_item() {
    $array = [
        1 => 'নাটকের নাম',
        2 => 'নাটকের প্রকার',
        3 => 'নাটকের রেটিং',
        4 => 'নাটকের স্থিতি',
        5 => 'নাট্য শিল্পী',
        6 => 'নাট্যকার',
        7 => 'নাট্যরুপকার',
        8 => 'গল্প রচনায়'
    ];
    return $array;
}

function get_natok_key_text($key) {
    $array = natok_search_item();
    return $array[$key];
}

function get_natok_key_name($key) {
    $songit = [
        '1' => 'name',
        '2' => 'category',
        '3' => 'rating',
        '4' => 'stability',
        '5' => 'actors',
        '6' => 'nattokar',
        '7' => 'rupokar',
        '8' => 'rochoyita'
    ];
    return $songit[$key];
}





function vhason_search_item() {
    $array = [
        1 => 'ভাষণের প্রথম লাইন',
        2 => 'প্রদানকারীর নাম',
        3 => 'ভাষণের প্রকার',
        4 => 'স্থিতি',
        5 => 'বিষয়',
    ];
    return $array;
}

function get_vhason_key_name($key) {
    $songit = [
        '1' => 'first_line',
        '2' => 'vhason_kari',
        '3' => 'category',
        '4' => 'stability',
        '5' => 'subject',
    ];
    return $songit[$key];
}

function get_vhason_key_text($key) {
    $array = vhason_search_item();
    return $array[$key];
}

function kothika_search_item() {
    $array = [
        1 => 'কথিকার নাম',
        2 => 'কথিকার বিষয়',
        3 => 'জাতীয় দিবস',
        4 => 'রেটিং',
        5 => 'স্থিতি',
        6 => 'গ্রন্থনা',
        7 => 'উপস্থাপনা',
        8 => 'প্রকার',
    ];
    return $array;
}

function get_kothika_extra_column()
{
    return [
        'station_id' => 'কেন্দ্র',
        'created_by' => 'সংরক্ষনকারী',
        'created_at' => 'সংরক্ষণ টাইম',
        'rating' => 'রেটিং',
    ];
}

function get_sakhhatkar_extra_column()
{
    return [
        'station_id' => 'কেন্দ্র',
        'created_by' => 'সংরক্ষনকারী',
        'created_at' => 'সংরক্ষণ টাইম',
    ];
}

function get_sakhhatkar_column_title($key)
{
    $array =  get_sakhhatkar_extra_column();
    return $array[$key];
}

function get_kothika_column_title($key)
{
    $array = get_kothika_extra_column();
    return $array[$key];
}

function get_kothika_key_text($key) {
    $array = kothika_search_item();
    return $array[$key];
}

function get_kothika_item_key() {
    return  [
        1, 2, 3, 4, 5, 6, 7, 8
    ];
}

function get_kothika_key_name($key) {
    $array = [
        1 => 'name',
        2 => 'subject',
        3 => 'national_day',
        4 => 'rating',
        5 => 'stability',
        6 => 'gronthona',
        7 => 'uposthapna',
        8 => 'category',
    ];
    return $array[$key];
}

function procharona_search_item() {
    $array = [
        1 => 'প্রথম লাইন',
        2 => 'প্রচারনার বিষয়',
        3 => 'আঙ্গিক',
        4 => 'মন্ত্রণালয়',
        5 => 'দপ্তর',
        6 => 'স্থিতি',
        7 => 'অংশগ্রহণকারী শিল্পী',
    ];
    return $array;
}

function sakhhatkar_search_item() {
    $array = [
        1 => 'প্রথম লাইন',
        2 => 'অনুষ্ঠানের নাম',
        3 => 'সাক্ষাৎদাতার নাম',
        4 => 'সাক্ষাৎকারের প্রকার',
    ];
    return $array;
}

function get_sakhhatkar_key_text($key){
    $array = sakhhatkar_search_item();
    return $array[$key];
}

function get_sakhhatkar_item_key(){
    return [1,2,3,4];
}

function get_sakhhatkar_key_name($key) {
    $songit = [
        '1' => 'first_line',
        '2' => 'program_name',
        '3' => 'sakhhat_data',
        '4' => 'category',
    ];
    return $songit[$key];
}

function get_source_name($id) {
    if(empty($id)) { return ''; }
    $artists =  App\Archive_model::get_row("archive_song_source",["*"],['id'=>$id]);
    if($artists){
        return $artists->name;
    }
    else {
        return '';
    }
}

function get_file_path($id) {
/*    '<?php  echo $song_info->file_directory . '/' . $song_info->file_name; ?>'*/
    $archive_info =  App\Archive_model::get_row("archive_info",["*"],['id'=>$id]);
   $archive_type = $archive_info->archive_type;
   if($archive_type==1) {
       $item_info = json_decode($archive_info->songit_info);
   }
   elseif($archive_type==2){
       $item_info = json_decode($archive_info->kobita_info);
   }
   elseif($archive_type==3){
       $item_info = json_decode($archive_info->natok_info);
   }
   elseif($archive_type==4){
       $item_info = json_decode($archive_info->program_info);
   }
   elseif($archive_type==5){
       $item_info = json_decode($archive_info->vhason_info);
   }
   elseif($archive_type==6){
       $item_info = json_decode($archive_info->sakhhatkar_info);
   }
   elseif($archive_type==7){
       $item_info = json_decode($archive_info->kothika_info);
   }
   elseif($archive_type==8){
       $item_info = json_decode($archive_info->procharona_info);
   }
   return   $item_info->file_directory . '/' . $item_info->file_name;
}

function get_file_name($id) {
    /*    '<?php  echo $song_info->file_directory . '/' . $song_info->file_name; ?>'*/
    $archive_info =  App\Archive_model::get_row("archive_info",["*"],['id'=>$id]);
    $archive_type = $archive_info->archive_type;
    if($archive_type==1) {
        $item_info = json_decode($archive_info->songit_info);
    }
    elseif($archive_type==2){
        $item_info = json_decode($archive_info->kobita_info);
    }
    elseif($archive_type==3){
        $item_info = json_decode($archive_info->natok_info);
    }
    elseif($archive_type==4){
        $item_info = json_decode($archive_info->program_info);
    }
    elseif($archive_type==5){
        $item_info = json_decode($archive_info->vhason_info);
    }
    elseif($archive_type==6){
        $item_info = json_decode($archive_info->sakhhatkar_info);
    }
    elseif($archive_type==7){
        $item_info = json_decode($archive_info->kothika_info);
    }
    elseif($archive_type==8){
        $item_info = json_decode($archive_info->procharona_info);
    }
    return  $item_info->file_name;
}

function get_bitorko_projay_name($id){
    $name = '';
    if($id==1){
        $name = 'স্কুল';
    }
    elseif($id==2){
        $name = 'স্কুল';
    }
    elseif($id==3){
        $name = 'বিশ্ববিদ্যালয়';
    }

    return $name;
}

function get_angik_name($id) {
    if(empty($id)) { return ''; }
    $artists =  App\Archive_model::get_row("archive_angik",["*"],['id'=>$id]);
    if($artists){
        return $artists->name;
    }
    else {
        return '';
    }
}

function get_sakhhatkar_department_name($array) {
    $department = [
        1 => 'সাক্ষাতকারভিত্তিক',
        2 => 'আলোচনা অনুষ্ঠান',
        3 => 'চিঠিপত্র/ এসএমএস/ইমেইল',
        4 => 'ফোন-ইন প্রোগ্রাম',
        5 => 'সরেজমিন প্রতিবেদন',
        6 => 'বির্তক',
    ];
    $names = '';

    if(is_array($array)) {
        foreach($array as $id) {
            $names.=$department[$id].',';
        }
    }


    return $names;
}


function get_user_access_role($module='') {
//    $employee_id = Session::get('user_info')->employee_id;
    $employee_id = Session::get('user_info')->employee_id;
//    $employee_id = 202001370059;
//    202001370059;
    $archive_info =  App\Archive_model::get_user_access_role($employee_id,$module);
//    dd($archive_info);
    $links = [];
    if(!empty($archive_info)){

        foreach($archive_info as $key => $item) {
            if(isset($links[$item->parent_id][$item->module_title.'|'.$item->module_level]['sub_menu'])) {
                $links[$item->parent_id][$item->module_title.'|'.$item->module_level]['sub_menu'][] =
                    ['title' => $item->title,'link' => $item->link];
            }
            else {
                $links[$item->parent_id][$item->module_title.'|'.$item->module_level]['sub_menu'] = [];
                $links[$item->parent_id][$item->module_title.'|'.$item->module_level]['sub_menu'][] =
                    ['title' => $item->title,'link' => $item->link];
            }
        }
    }
    return $links;

}
