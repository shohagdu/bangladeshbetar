<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class All_stting extends Model
{
    public static function get_settings_info($where = null)
    {
        $query =  DB::table('all_sttings');
        if(!is_null($where )) {
            foreach($where as $k => $v){
                $query->where($k, $v);
            }
        }
        return $query->orderBy('display_position')->orderBy('title')->pluck("title","id");
    }
    public static function get_program_selected_description_info($where = null,$descp)
    {
        $query =  DB::table('all_sttings');
        if(!is_null($where )) {
            foreach($where as $k => $v){
                $query->where($k, $v);
            }
        }
        if(!empty($descp)){
            $query->whereIn('id', $descp);
        }

        return $query->orderBy('display_position')->orderBy('title')->pluck("title","id");
    }
    public static function get_artist_grade_info($where = null)
    {
        $query =  DB::table('setup_artist_grade');
        $query->orderBy("postition","ASC");
        if(!is_null($where )) {
            foreach($where as $k => $v){
                $query->where($k, $v);
            }
        }
        return $query->pluck("title","id");
    }
    public static function artist_grade_description($where = null)
    {
        $query =  DB::table('setup_artist_rate_chart');
        $query->leftJoin('setup_artist_grade', 'setup_artist_grade.id', '=', 'setup_artist_rate_chart.grade_id');
        $query->orderBy("setup_artist_rate_chart.display_position","ASC");
        $query->groupBy("setup_artist_rate_chart.grade_id");
        if(!is_null($where )) {
            foreach($where as $k => $v){
                $query->where($k, $v);
            }
        }
        return $query->pluck("setup_artist_grade.title","setup_artist_rate_chart.grade_id");
    }
    public static function get_artist_rate_chart_info_new($where = null)
    {
        $query =  DB::table('setup_artist_rate_chart');
        $query->leftJoin('all_sttings as artist_song_ctg', 'artist_song_ctg.id', '=', 'setup_artist_rate_chart.ctg_id');
        $query->leftJoin('all_sttings as sub_honouriam_id', 'sub_honouriam_id.id', '=', 'setup_artist_rate_chart.description');
        $query->where("setup_artist_rate_chart.is_active","!=",0);
        $query->orderBy("artist_song_ctg.display_position","ASC");

        $query->orderBy("artist_song_ctg.display_position","ASC");
        $query->orderBy("sub_honouriam_id.display_position","ASC");
        $query->groupBy("setup_artist_rate_chart.description");


        if(!is_null($where )) {
            foreach($where as $k => $v){
                $query->where($k, $v);
            }
        }
        return $query->select("artist_song_ctg.id as ctg_id","artist_song_ctg.title as artist_song_ctg_title","sub_honouriam_id.title as description","sub_honouriam_id.id as description_id")->get();
    }
    public static function get_day_name($where = null)
    {
        $query =  DB::table('setup_days');
        $query->orderBy("position","ASC");
        if(!is_null($where )) {
            foreach($where as $k => $v){
                $query->where($k, $v);
            }
        }
        return $query->pluck("title_bn","id");
    }
    public static function get_odivision_info($where = null)
    {
        $query =  DB::table('setup_odivision');
        $query->orderBy("position","ASC");
        if(!is_null($where )) {
            foreach($where as $k => $v){
                $query->where($k, $v);
            }
        }
        return $query->select("title","schedule_time","id")->get();
    }



    public static function get_settings_title_info($where = null)
    {
        $query =  DB::table('all_sttings');
        $query->where($where);
        $query=$query->select("title")->first();
        if(!empty($query)){
            return $query->title;
        }else{
            return false;
        }
    }
    public static function get_single_settings_info($where = null)
    {
        $query =  DB::table('all_sttings');
        $query->where($where);
        $query=$query->select("*")->first();
        if(!empty($query)){
            return $query;
        }else{
            return false;
        }
    }

    public static function get_branch_name($where = null)
    {
        $query =  DB::table('branch_infos');
        $query->where($where);
        $query=$query->select("name")->first();
        if(!empty($query)){
            return $query->name;
        }else{
            return false;
        }
    }

    public static function get_branch($where = null)
    {
        $query =  DB::table('branch_infos');
        $query->where($where);
        $query=$query->select("*")->first();
        if(!empty($query)){
            return $query;
        }else{
            return false;
        }
    }

    public static function get_setting_title($where = null)
    {
        if(!is_null($where ) && !empty($where)) {
            $query =  DB::table('all_sttings');
            $query->whereIn("id",$where);
            return  $query->orderBy('title')->pluck("title","id");
        }else{
            return false;
        }

    }
    public static function get_leave_type_setting($where = null)
    {
        $query =  DB::table('all_sttings');
        if(!is_null($where )) {
            foreach($where as $k => $v){
                $query->where($k, $v);
            }
        }
        return $query->select("title","id","leave_balance","has_leave_limit")->get();
    }



    public static function get_json_decode_payslip_earning($earning_info=null)
    {
        if(!empty($earning_info)) {
            $earning = json_decode($earning_info, true);
            $earning_ctg = array_column($earning, "earning_ctg");
            $all_ctg_info_data = self::get_setting_title($earning_ctg);
            if (!empty($all_ctg_info_data)) {
                $earning_info = [];
                foreach ($earning as $row) {
                    $earning_info[] = [
                        'earning_ctg' => $row['earning_ctg'],
                        'earning_ctg_per' => $row['earning_ctg_per'],
                        'earning_ctg_title' => $all_ctg_info_data[$row['earning_ctg']],
                        'earning_ctg_amount' => $row['earning_ctg_amount'],
                    ];
                }
            } else {
                $earning_info = [];
            }
            return json_encode($earning_info);
        }else{
            return false;
        }

    }
    public static function get_json_decode_leave_info($leave_info=null)
    {

        if(!empty($leave_info)) {
            $leave = json_decode($leave_info, true);
            $ctg = array_column($leave, "type_id");
            $all_ctg_info_data = self::get_setting_title($ctg);
            if (!empty($all_ctg_info_data)) {
                $leave_info = [];
                foreach ($leave as $row) {
                    $leave_info[] = [
                        'checked' => $row['checked'],
                        'type_id_title' => $all_ctg_info_data[$row['type_id']],
                        'limit' => $row['limit'],
                        'consume' => $row['consume'],
                        'remaining' => $row['remaining'],
                    ];
                }
            } else {
                $leave_info = [];
            }
            return json_encode($leave_info);
        }else{
            return false;
        }

    }

    public static function get_json_decode_payslip_deduction($deduction_info=null)
    {
        if(!empty($deduction_info)) {
            $deduction = json_decode($deduction_info, true);
            $deduction_ctg = array_column($deduction, "deduction_ctg");
            $all_ctg_info_data = self::get_setting_title($deduction_ctg);
            if (!empty($all_ctg_info_data)) {
                $deduction_info = [];
                foreach ($deduction as $row) {
                    $deduction_info[] = [
                        'deduction_ctg' => $row['deduction_ctg'],
                        'deduction_ctg_per' => $row['deduction_ctg_per'],
                        'deduction_ctg_title' => $all_ctg_info_data[$row['deduction_ctg']],
                        'deduction_ctg_amount' => $row['deduction_ctg_amount'],
                    ];
                }
            } else {
                $deduction_info = [];
            }
            return json_encode($deduction_info);
        }else{
            return false;
        }

    }
    public static function get_payslip_paid_amount($earning_info=null,$deduction_info=null)
    {

        if(!empty($earning_info)) {
            $earning = json_decode($earning_info, true);
            $earning_ctg = array_sum(array_column($earning, "earning_ctg_amount"));
        }else{
            $earning_ctg='0.00';
        }


        if(!empty($deduction_info)) {
            $deduction = json_decode($deduction_info, true);
            $deduction_amount = array_sum(array_column($deduction, "deduction_ctg_amount"));
        }else{
            $deduction_amount ='0.00';
        }
        return number_format($earning_ctg - $deduction_amount,2,'.','');

    }





    public static function get_all_settings_info($where = null)
    {
        $query =  DB::table('all_sttings');
        $query->where("is_active","!=",0);
        $query->orderBy("title","ASC");
        $query->orderBy("display_position","ASC");
        if(!is_null($where )) {
            foreach($where as $k => $v){
                $query->where($k, $v);
            }
        }
        return $query->select("title","id","is_active","is_default","display_position")->get();
    }
    public static function get_all_rate_chart_info_discription($where = null)
    {
        $query =  DB::table('setup_artist_rate_chart');
        $query->where("is_active","=",1);
        $query->orderBy("display_position","ASC");
        if(!is_null($where )) {
            foreach($where as $k => $v){
                $query->where($k, $v);
            }
        }
        return $query->select("setup_artist_rate_chart.*")->get();
    }

    public static function get_artist_rate_chart($where = null)
    {
        $query =  DB::table('setup_artist_rate_chart');
        $query->leftJoin('all_sttings as artist_song_ctg', 'artist_song_ctg.id', '=', 'setup_artist_rate_chart.ctg_id');
        $query->leftJoin('all_sttings as sub_honouriam_id', 'sub_honouriam_id.id', '=', 'setup_artist_rate_chart.description');
        $query->leftJoin('setup_artist_grade', 'setup_artist_grade.id', '=', 'setup_artist_rate_chart.grade_id');
        $query->where("setup_artist_rate_chart.is_active","!=",0);
        $query->orderBy("artist_song_ctg.display_position","ASC");

        $query->orderBy("artist_song_ctg.display_position","ASC");
        $query->orderBy("setup_artist_rate_chart.display_position","ASC");
//        $query->orderBy("sub_honouriam_id.id","ASC");


        if(!is_null($where )) {
            foreach($where as $k => $v){
                $query->where($k, $v);
            }
        }
        return $query->select("setup_artist_rate_chart.*","artist_song_ctg.title as artist_song_ctg_title","setup_artist_grade.title as grade_title","sub_honouriam_id.title as description","sub_honouriam_id.id as description_id")->get();
    }

    public static function get_artist_rate_chart_details($sub_ctg)
    {
        $query =  DB::table('setup_artist_rate_chart');
        $query->leftJoin('setup_artist_grade', 'setup_artist_grade.id', '=', 'setup_artist_rate_chart.grade_id');
        $query->where("setup_artist_rate_chart.description","=",$sub_ctg);
        $query->where("setup_artist_rate_chart.is_active","=",1);
        $query->orderBy('setup_artist_rate_chart.display_position',"ASC");
        return $query->select("setup_artist_rate_chart.*","setup_artist_grade.title as grade_title")
            ->get();
    }

    public static function get_all_honouriam_sub_ctg($ctg){
        $query =  DB::table('all_sttings as  honouriam_sub_ctg');
        $query->where("honouriam_sub_ctg.parent_id","=",$ctg);
        $query->where("honouriam_sub_ctg.is_active","=",1);
        $query->orderBy('honouriam_sub_ctg.display_position',"ASC");
        return $query->select("honouriam_sub_ctg.*")
            ->get();
    }
    public static function get_all_settings_info_sub_ctg($where = null)
    {
        $query =  DB::table('all_sttings');
        $query->where("all_sttings.is_active","!=",0);
        $query->leftJoin('all_sttings as product_ctg', 'product_ctg.id', '=', 'all_sttings.parent_id');
        $query->orderBy("product_ctg.display_position","ASC");
        $query->orderBy("all_sttings.display_position","ASC");
        if(!is_null($where )) {
            foreach($where as $k => $v){
                $query->where($k, $v);
            }
        }
        return $query->select("all_sttings.title","all_sttings.id","all_sttings.is_active","all_sttings.parent_id","all_sttings.is_default","product_ctg.title as product_ctg_title","all_sttings.display_position")->get();
    }

    public static function get_all_product_info($where = null)
    {
        $query =  DB::table('product_infos');
        $query->where("product_infos.is_active","!=",0);
        $query->leftJoin('all_sttings as product_ctg', 'product_ctg.id', '=', 'product_infos.ctg_id');
        $query->leftJoin('all_sttings as product_sub_ctg', 'product_sub_ctg.id', '=', 'product_infos.sub_ctg_id');
        $query->leftJoin('all_sttings as unit_info', 'unit_info.id', '=', 'product_infos.unit_id');
        $query->orderBy("product_infos.title","ASC");
        if(!is_null($where )) {
            foreach($where as $k => $v){
                $query->where($k, $v);
            }
        }
        return $query->select("product_infos.id","product_infos.name","product_infos.ctg_id","product_infos.sub_ctg_id","product_infos.unit_id","product_infos.product_code","product_infos.is_active","product_ctg.title as product_ctg_title","product_sub_ctg.title as product_sub_ctg_title","unit_info.title as unit_title")->get();
    }



    public static function get_district($where = null)
    {
        $query =  DB::table('districts');
        if(!is_null($where )) {
            foreach($where as $k => $v){
                $query->where($k, $v);
            }
        }
        return $query->orderBy('name')->pluck("name","id");
    }
    public static function get_upazilas($where = null)
    {
        $query =  DB::table('upazilas');
        if(!is_null($where )) {
            foreach($where as $k => $v){
                $query->where($k, $v);
            }
        }
        return $query->orderBy('name')->pluck("name","id");
    }

    public static function decode_address($address){
        return json_decode($address,true);
    }
    public static function get_bd_amount_in_text($amount) {

        $output_string = '';

        $tokens = explode('.', $amount);
        $current_amount = $tokens[0];
        $fraction = '';
        if (count($tokens) > 1) {
            $fraction = (double) ('0.' . $tokens[1]);
            $fraction = $fraction * 100;
            $fraction = round($fraction, 0);
            $fraction = (int) $fraction;
            $fraction = self::translate_to_words($fraction) . ' Poisa';
            $fraction = ' Taka & ' . $fraction;
        }

        $crore = 0;
        if ($current_amount >= pow(10, 7)) {
            $crore = (int) floor($current_amount / pow(10, 7));
            $output_string .= self::translate_to_words($crore) . ' crore ';
            $current_amount = $current_amount - $crore * pow(10, 7);
        }

        $lakh = 0;
        if ($current_amount >= pow(10, 5)) {
            $lakh = (int) floor($current_amount / pow(10, 5));
            $output_string .= self::translate_to_words($lakh) . ' lac ';
            $current_amount = $current_amount - $lakh * pow(10, 5);
        }

        $current_amount = (int) $current_amount;
        $output_string .= self::translate_to_words($current_amount);

        $output_string = $output_string . ' taka only';
        $output_string = ucwords($output_string);
        return $output_string;
    }

    public static function translate_to_words($number) {
        $max_size = pow(10, 18);
        if (!$number)
            return "zero";
        if (is_int($number) && $number < abs($max_size)) {
            $prefix = '';
            $suffix = '';
            switch ($number) {
                // setup up some rules for converting digits to words
                case $number < 0:
                    $prefix = "negative";
                    $suffix = self::translate_to_words(-1 * $number);
                    $string = $prefix . " " . $suffix;
                    break;
                case 1:
                    $string = "one";
                    break;
                case 2:
                    $string = "two";
                    break;
                case 3:
                    $string = "three";
                    break;
                case 4:
                    $string = "four";
                    break;
                case 5:
                    $string = "five";
                    break;
                case 6:
                    $string = "six";
                    break;
                case 7:
                    $string = "seven";
                    break;
                case 8:
                    $string = "eight";
                    break;
                case 9:
                    $string = "nine";
                    break;
                case 10:
                    $string = "ten";
                    break;
                case 11:
                    $string = "eleven";
                    break;
                case 12:
                    $string = "twelve";
                    break;
                case 13:
                    $string = "thirteen";
                    break;
                // fourteen handled later
                case 15:
                    $string = "fifteen";
                    break;
                case $number < 20:
                    $string = self::translate_to_words($number % 10);
                    // eighteen only has one "t"
                    if ($number == 18) {
                        $suffix = "een";
                    } else {
                        $suffix = "teen";
                    }
                    $string .= $suffix;
                    break;
                case 20:
                    $string = "twenty";
                    break;
                case 30:
                    $string = "thirty";
                    break;
                case 40:
                    $string = "forty";
                    break;
                case 50:
                    $string = "fifty";
                    break;
                case 60:
                    $string = "sixty";
                    break;
                case 70:
                    $string = "seventy";
                    break;
                case 80:
                    $string = "eighty";
                    break;
                case 90:
                    $string = "ninety";
                    break;
                case $number < 100:
                    $prefix = self::translate_to_words($number - $number % 10);
                    $suffix = self::translate_to_words($number % 10);
                    //$string = $prefix . "-" . $suffix;
                    $string = $prefix . " " . $suffix;
                    break;
                // handles all number 100 to 999
                case $number < pow(10, 3):
                    // floor return a float not an integer
                    $prefix = self::translate_to_words(intval(floor($number / pow(10, 2)))) . " hundred";
                    if ($number % pow(10, 2))
                        $suffix = " and " . self::translate_to_words($number % pow(10, 2));
                    $string = $prefix . $suffix;
                    break;
                case $number < pow(10, 6):
                    // floor return a float not an integer
                    $prefix = self::translate_to_words(intval(floor($number / pow(10, 3)))) . " thousand";
                    if ($number % pow(10, 3))
                        $suffix = self::translate_to_words($number % pow(10, 3));
                    $string = $prefix . " " . $suffix;
                    break;
            }
        } else {
            echo "ERROR with - $number Number must be an integer between -" . number_format($max_size, 0, ".", ",") . " and " . number_format($max_size, 0, ".", ",") . " exclussive.";
        }
        return $string;
    }



    // todo:: program info



    public static function get_odivision($where = null)
    {
        $query =  DB::table('setup_odivision');
        $query->where($where);
        $query=$query->select("*")->first();
        if(!empty($query)){
            return $query;
        }else{
            return false;
        }
    }

    public static function get_schedule($station,$sub_station,$live_date,$live_time){
        $query =  DB::table('program_planning_infos');
        $query->where('station_id',$station);
        $query->where('sub_station_id',$sub_station);
        $query->where('live_date',$live_date);
        $query->where('live_time',$live_time);
        $query=$query->select("*")->first();
        if(!empty($query)){
            return $query;
        }else{
            return false;
        }
    }public static function event_yearly_program_report($where=NULL){
    $query =  DB::table('fixed_program_type as main_event');
    // $query->leftJoin('fixed_program_type as child_event', 'main_event.id', '=', 'child_event.parent_id');
    $query->where($where);
    $query->where('main_event.parent_id','=',NULL);
    $query->orderBy("main_event.display_position",'ASC');
    $query=$query->select("id","name","description","event_date","comments","display_position")->get();
    if(!empty($query)){
        foreach ($query as $key=>$row) {
            $query[$key]->all_data=self::get_event_info($row->id);
        }
        return $query;
    }else{
        return false;
    }
}
    public static function get_event_info($data){
        $query =  DB::table('fixed_program_type');
        $query->where(['fixed_program_type.parent_id'=>$data,'is_active'=>1]);
        $query->where('fixed_program_type.parent_id','!=',NULL);
        $query->orderBy("fixed_program_type.display_position",'ASC');
        $query=$query->select("id","name","description","event_date","comments","display_position")->get();
        if(!empty($query)){
            return $query;
        }else{
            return false;
        }
    }

    public static function get_settings_info_exist_grade($where = null)
    {
        $query =  DB::table('all_sttings');
        if(!is_null($where )) {
            foreach($where as $k => $v){
                $query->where($k, $v);
            }
        }
        $query->leftJoin('setup_artist_rate_chart', 'setup_artist_rate_chart.description', '=', 'all_sttings.id');
        $query->where("setup_artist_rate_chart.grade_id", '<=','7');
        return $query->orderBy('all_sttings.display_position')->orderBy('all_sttings.title')->pluck("all_sttings.title","all_sttings.id");
    }
    public static function get_artist_info($where = null){
        return  DB::table('program_artist_info')
            ->leftJoin("program_planning_artist_infos","program_planning_artist_infos.artist_id","=","program_artist_info.id")
            ->leftJoin("branch_infos","branch_infos.id","=","program_artist_info.station_id")
            ->leftJoin("all_sttings as nationality","nationality.id","=","program_artist_info.nationality")
            ->leftJoin("districts","districts.id","=","program_artist_info.artist_district")
            ->leftJoin("all_sttings as bank_name","bank_name.id","=","program_artist_info.bank_name")
            ->leftJoin("all_sttings as national_awarded","national_awarded.id","=","program_artist_info.national_awarded")
            ->where($where)
            ->select("program_artist_info.*","branch_infos.name as station_name","nationality.title as nationality_title","districts.name as district_title","bank_name.title as bank_name_title","national_awarded.title as national_awarded_title",DB::raw("(GROUP_CONCAT(program_planning_artist_infos.work_area_id SEPARATOR ',')) as work_area_id"))
            ->first();
    }
    public static function get_program_artist_info($where = null,$limit=NULL)
    {
        $query= DB::table('program_artist_info')
            ->leftJoin("program_planning_artist_infos","program_planning_artist_infos.artist_id","=","program_artist_info.id")
            ->leftJoin("branch_infos","branch_infos.id","=","program_artist_info.station_id")
            ->leftJoin("all_sttings as nationality","nationality.id","=","program_artist_info.nationality")
            ->leftJoin("districts","districts.id","=","program_artist_info.artist_district")
            ->leftJoin("all_sttings as bank_name","bank_name.id","=","program_artist_info.bank_name")
            ->leftJoin("all_sttings as national_awarded","national_awarded.id","=","program_artist_info.national_awarded")
            ->where("program_artist_info.is_active","!=",0);
            if(!empty($where['expertise_id'])){
                $query->whereRaw("JSON_CONTAINS(artist_expertise_info->'$[*].expertise', json_array('{$where['expertise_id']}'))");
                unset($where['expertise_id']);
            }
            if(!empty($where['expertise_dept'])){
                $query->whereRaw("JSON_CONTAINS(artist_expertise_info->'$[*].expertise_dept', json_array('{$where['expertise_dept']}'))");
                unset($where['expertise_dept']);
            }
            if(!empty($where['exp_grade_id'])){
                $query->whereRaw("JSON_CONTAINS(artist_expertise_info->'$[*].expertise_grade', json_array('{$where['exp_grade_id']}'))");
                unset($where['exp_grade_id']);
            }
            if(!empty($limit)){
                $query->limit($limit);
            }
            $query->orderBy("program_artist_info.id","DESC")
            ->groupBy("program_artist_info.id");
            if(!empty($where)){
                $query->where($where); 
            }
            $result=$query->select("program_artist_info.gender","program_artist_info.artist_id","program_artist_info.artist_old_id","program_artist_info.name","program_artist_info.name_bn","program_artist_info.father_name","program_artist_info.mother_name","program_artist_info.staff_id","program_artist_info.mobile","program_artist_info.email","program_artist_info.address","program_artist_info.artist_expertise_info","program_artist_info.picture","program_artist_info.id","program_artist_info.is_active as is_active","branch_infos.name as 
            station_name","nationality.title as nationality_title","districts.name as district_title","bank_name.title as bank_name_title","national_awarded.title as national_awarded_title",DB::raw("(GROUP_CONCAT(program_planning_artist_infos.work_area_id SEPARATOR ',')) as work_area_id"))
            ->get();
            if(!empty($result)){
                return $result;
            }else{
                return false;
            }
    }
    public static function get_program_info_searching($receive = null,$status=null)
    {
        $query =  DB::table('program_planning_infos');
        $query->leftJoin("branch_infos","branch_infos.id","=","program_planning_infos.station_id");
        $query->leftJoin("all_sttings as program_type_info","program_type_info.id","=","program_planning_infos.program_type");
        $query->leftJoin("fixed_program_type","fixed_program_type.id","=","program_planning_infos.fixed_program_type_id");
        $query->leftJoin("fixed_program_type as sub_fixed_program_type","sub_fixed_program_type.id","=","program_planning_infos.sub_fixed_program_type_id");
        if(!empty($receive['station_id'])){
            $query->where("program_planning_infos.station_id","=",$receive['station_id']);
        }
        if(!empty($receive['fequency_id'])){
            $query->where("program_planning_infos.sub_station_id","=",$receive['fequency_id']);
        }
        if(!empty($receive['program_name'])){
            $query->where("program_planning_infos.program_name","=",$receive['program_name']);
        }


        if(!empty($receive['from_date']) &&  (!empty($receive['to_date']))) {
            $query ->whereDate('entry_date','>=', date('Y-m-d',strtotime($receive['from_date'])));
            $query ->whereDate('entry_date','<=', date('Y-m-d',strtotime($receive['to_date'])));
        }
        if(!empty($status)){
            $query->where('program_planning_infos.is_active','>=',$status);
        }
        $query->orderby("program_planning_infos.id","DESC");
        $data= $query->select("program_type_info.title as program_type_title","program_planning_infos.*","branch_infos.name as 
        station_name",(DB::raw("date_format(program_planning_infos.entry_date,'%d-%m-%Y') as entry_date")),(DB::raw("date_format(program_planning_infos.live_date,'%d-%m-%Y') as live_date")),"fixed_program_type.name as fixed_program_name","sub_fixed_program_type.name as fixed_sub_program_title")->get();
        foreach ($data as $key=>$data_infos){
            $data[$key]->get_all_artist_info=self::get_single_program_artist_info(['program_planning_artist_infos.planning_info_id'=>$data_infos->id,'program_planning_artist_infos.is_active'=>1]);
        }
        return $data;
    }

    public static function get_single_program_info($where = null)
    {
        return  DB::table('program_planning_infos')
            ->leftJoin("branch_infos","branch_infos.id","=","program_planning_infos.station_id")
            ->leftJoin("branch_infos as fequencey_info","fequencey_info.id","=","program_planning_infos.sub_station_id")
            ->leftJoin("all_sttings as program_type_info","program_type_info.id","=","program_planning_infos.program_type")
            ->leftJoin("fixed_program_type","fixed_program_type.id","=","program_planning_infos.fixed_program_type_id")
            ->leftJoin("fixed_program_type as sub_fixed_program_type","sub_fixed_program_type.id","=","program_planning_infos.sub_fixed_program_type_id")
//            ->leftJoin("all_sttings as program_type_info","program_type.id","=","program_planning_infos.program_type")
//            ->leftJoin("all_sttings as national_awarded","national_awarded.id","=","program_artist_info.national_awarded")
            ->where($where)
            ->where("program_planning_infos.is_active","!=",0)
            ->orderBy("program_planning_infos.id","DESC")
            ->select("program_planning_infos.*","branch_infos.name as  station_name","branch_infos.address as  station_address","program_type_info.title as program_type_title","fixed_program_type.name as fixed_program_name","sub_fixed_program_type.name as fixed_sub_program_title",DB::raw('CONCAT(fequencey_info.fequencey, " (", fequencey_info.title,")") AS fequencey_data'))
            ->first();
    }
    public static function get_single_program_artist_info($where = null)
    {
        $query =DB::table('program_planning_artist_infos');
        $query->leftJoin('all_sttings as rate_chart_ctg_info', 'rate_chart_ctg_info.id', '=', 'program_planning_artist_infos.artist_ctg_id');
        $query->leftJoin('all_sttings as description_info', 'description_info.id', '=', 'program_planning_artist_infos.description_id');
        $query->leftJoin('all_sttings as artist_vumika_info', 'artist_vumika_info.id', '=', 'program_planning_artist_infos.artist_vumika_id');
        $query->leftJoin('program_artist_info', 'program_artist_info.id', '=', 'program_planning_artist_infos.artist_id');
        $query->leftJoin('setup_artist_grade', 'setup_artist_grade.id', '=', 'program_planning_artist_infos.artist_grade');
        $query->leftJoin('setup_artist_rate_chart', 'setup_artist_rate_chart.id', '=', 'program_planning_artist_infos.artist_rate_chart_id');
        $query->where($where);
        $query->select("program_planning_artist_infos.*","rate_chart_ctg_info.title as rate_chart_main_ctg","description_info.title as rate_chart_description_title","program_artist_info.name_bn as artist_name","program_artist_info.mobile as artist_mobile","setup_artist_grade.title as grade_title","setup_artist_rate_chart.stability as stability_title","artist_vumika_info.title as artist_vumika_title");
        $data = $query->get();
        if(count($data)>0){
            return $data;
        }else{
            return false;
        }
    }
    public static function get_single__artist_info_by_program($where = null)
    {
        $query =DB::table('program_planning_artist_infos');
        $query->leftJoin('program_artist_info', 'program_artist_info.id', '=', 'program_planning_artist_infos.artist_id');
        $query->where($where);
        $query->select("program_artist_info.name_bn as artist_name","program_artist_info.mobile as artist_mobile");
        $data = $query->get();
        if(count($data)>0){
            return $data;
        }else{
            return false;
        }
    }
    public static function get_program_info_proposal_searching($receive = null,$status=null,$payment_status=null)
    {

        $query =  DB::table('program_planning_infos');
        $query->leftJoin("branch_infos","branch_infos.id","=","program_planning_infos.station_id");
        $query->leftJoin("all_sttings as program_type_info","program_type_info.id","=","program_planning_infos.program_type");
        $query->leftJoin("fixed_program_type","fixed_program_type.id","=","program_planning_infos.fixed_program_type_id");
        $query->leftJoin("fixed_program_type as sub_fixed_program_type","sub_fixed_program_type.id","=","program_planning_infos.sub_fixed_program_type_id");

        $query->leftJoin("program_planning_artist_infos","program_planning_artist_infos.planning_info_id","=","program_planning_infos.id");
        $query->leftJoin('all_sttings as rate_chart_ctg_info', 'rate_chart_ctg_info.id', '=', 'program_planning_artist_infos.artist_ctg_id');
        $query->leftJoin('all_sttings as description_info', 'description_info.id', '=', 'program_planning_artist_infos.description_id');
        $query->leftJoin('all_sttings as artist_vumika_info', 'artist_vumika_info.id', '=', 'program_planning_artist_infos.artist_vumika_id');

        $query->leftJoin('program_artist_info', 'program_artist_info.id', '=', 'program_planning_artist_infos.artist_id');
        $query->leftJoin('all_sttings as bank_name_info', 'bank_name_info.id', '=', 'program_artist_info.bank_name');
        $query->leftJoin('setup_artist_grade', 'setup_artist_grade.id', '=', 'program_planning_artist_infos.artist_grade');
        $query->leftJoin('setup_artist_rate_chart', 'setup_artist_rate_chart.id', '=', 'program_planning_artist_infos.artist_rate_chart_id');
        if($status==4){
            if (!empty($receive['from_date']) && (!empty($receive['to_date']))) {
                if($payment_status==2) {
                    $query->whereDate('program_planning_artist_infos.accounts_forwards_dt', '>=', date('Y-m-d', strtotime($receive['from_date'])));
                    $query->whereDate('program_planning_artist_infos.accounts_forwards_dt', '<=', date('Y-m-d', strtotime($receive['to_date'])));
                }elseif($payment_status==3){
                    $query->whereDate('program_planning_artist_infos.payment_complete_date', '>=', date('Y-m-d', strtotime($receive['from_date'])));
                    $query->whereDate('program_planning_artist_infos.payment_complete_date', '<=', date('Y-m-d', strtotime($receive['to_date'])));
                }
                $query->where('program_planning_artist_infos.payment_status','=',$payment_status);
            }
        }elseif($status==2) {
            if (!empty($receive['from_date']) && (!empty($receive['to_date']))) {
                $query->whereDate('program_planning_infos.proposal_approved_dt', '>=', date('Y-m-d', strtotime($receive['from_date'])));
                $query->whereDate('program_planning_infos.proposal_approved_dt', '<=', date('Y-m-d', strtotime($receive['to_date'])));
            }
        }else {
            if (!empty($receive['from_date']) && (!empty($receive['to_date']))) {
                $query->whereDate('program_planning_infos.proposal_approved_dt', '>=', date('Y-m-d', strtotime($receive['from_date'])));
                $query->whereDate('program_planning_infos.proposal_approved_dt', '<=', date('Y-m-d', strtotime($receive['to_date'])));
            }
        }
        if(!empty($receive['station_id'])){
            $query->where("program_planning_infos.station_id","=",$receive['station_id']);
        }
        if(!empty($receive['fequency_id'])){
            $query->where("program_planning_infos.sub_station_id","=",$receive['fequency_id']);
        }
        if(!empty($receive['program_name'])){
            $query->where("program_planning_infos.program_name","=",$receive['program_name']);
        }
        if(!empty($status)){
            $query->where('program_planning_infos.is_active','>=',$status);
        }
        $query->orderBy("program_planning_infos.id","ASC");
        $data= $query->select("program_type_info.title as program_type_title","program_planning_infos.program_identity","program_planning_infos.program_name","program_planning_infos.recording_stabilty","program_planning_infos.recorded_date","program_planning_infos.recorded_time","program_planning_infos.live_date","program_planning_infos.live_time","branch_infos.name as 
        station_name",(DB::raw("date_format(program_planning_infos.entry_date,'%d-%m-%Y') as entry_date")),"program_planning_infos.plan_approved_dt","program_planning_infos.proposal_approved_by","program_planning_infos.proposal_approved_by","program_planning_infos.proposal_approved_dt","program_planning_infos.contract_approved_by","program_planning_infos.contract_approved_dt","fixed_program_type.name as fixed_program_name","sub_fixed_program_type.name as fixed_sub_program_title","rate_chart_ctg_info.title as rate_chart_main_ctg","description_info.title as rate_chart_description_title","program_artist_info.name_bn as artist_name","program_artist_info.address","program_artist_info.mobile as artist_mobile","program_artist_info.bank_branch_name","program_artist_info.bank_account_no","bank_name_info.title as bank_name_title","setup_artist_grade.title as grade_title","setup_artist_rate_chart.stability as stability_title","artist_vumika_info.title as artist_vumika_title","program_planning_artist_infos.*")->get();

        return $data;
    }
    public static function get_program_artist_basic_info($where = null)
    {
        return  DB::table('program_artist_info')
            ->leftJoin("all_sttings as national_awarded","national_awarded.id","=","program_artist_info.national_awarded")
            ->where("program_artist_info.is_active","!=",0)
            ->orderBy("program_artist_info.name_bn","ASC")
            ->where($where)
            ->select("program_artist_info.id","program_artist_info.station_id","program_artist_info.name","program_artist_info.name_bn","program_artist_info.artist_expertise_info","program_artist_info.national_awarded","national_awarded.title as national_awarded_title")
            ->get();
    }
    public static function artist_description($where = null)
    {
        //  return $where;
        $query =  DB::table('setup_artist_rate_chart');
        $query->where("setup_artist_rate_chart.is_active",1);
        $query->orderBy("setup_artist_rate_chart.display_position","ASC");
        if(!is_null($where )) {
            foreach($where as $k => $v){
                $query->where($k, $v);
            }
        }
        return $query->select("setup_artist_rate_chart.id","setup_artist_rate_chart.amount","setup_artist_rate_chart.mohoda_fee","setup_artist_rate_chart.stability","setup_artist_rate_chart.grade_id")->get();
    }

    public static function get_single_program_artist_info_by_id($where = null)
    {
        $query =DB::table('program_planning_artist_infos');
        $query->leftJoin('all_sttings as rate_chart_ctg_info', 'rate_chart_ctg_info.id', '=', 'program_planning_artist_infos.artist_ctg_id');
        $query->leftJoin('program_planning_infos', 'program_planning_infos.id', '=', 'program_planning_artist_infos.planning_info_id');
        $query->leftJoin('all_sttings as description_info', 'description_info.id', '=', 'program_planning_artist_infos.description_id');
        $query->leftJoin('all_sttings as artist_vumika_info', 'artist_vumika_info.id', '=', 'program_planning_artist_infos.artist_vumika_id');
        $query->leftJoin('program_artist_info', 'program_artist_info.id', '=', 'program_planning_artist_infos.artist_id');
        $query->leftJoin('setup_artist_grade', 'setup_artist_grade.id', '=', 'program_planning_artist_infos.artist_grade');
        $query->leftJoin('setup_artist_rate_chart', 'setup_artist_rate_chart.id', '=', 'program_planning_artist_infos.artist_rate_chart_id','program_planning_infos.is_active as planning_is_active');
        $query->where($where);
        $query->select("program_planning_artist_infos.*","rate_chart_ctg_info.title as rate_chart_main_ctg","description_info.title as rate_chart_description_title","program_artist_info.name_bn as artist_name","program_artist_info.mobile as artist_mobile","setup_artist_grade.title as grade_title","setup_artist_rate_chart.stability as stability_title","artist_vumika_info.title as artist_vumika_title","program_planning_infos.record_type","program_planning_infos.is_active as planning_is_active");
        $data = $query->first();
        if($data){
            return $data;
        }else{
            return false;
        }
    }

    public static function get_program_artist_basic_info_expertise($receive = null)
    {
        $query = DB::table('program_artist_info')
            ->select('program_artist_info.id','program_artist_info.station_id','program_artist_info.name','program_artist_info.name_bn',
                'national_awarded')
            ->where(['station_id'=> $receive['station_id'],'is_active'=>1]);
        if(!empty($receive['expertise_id'])){
            $query->whereRaw("JSON_CONTAINS(artist_expertise_info->'$[*].expertise', json_array('{$receive['expertise_id']}'))");
        }
        if(!empty($receive['expertise_dept'])){
            $query->whereRaw("JSON_CONTAINS(artist_expertise_info->'$[*].expertise_dept', json_array('{$receive['expertise_dept']}'))");
        }
        if(!empty($receive['exp_grade_id'])){
            $query->whereRaw("JSON_CONTAINS(artist_expertise_info->'$[*].expertise_grade', json_array('{$receive['exp_grade_id']}'))");
        }

        $result =  $query->get();
        return $result;
    }

    public static function all_program_name($where = null)
    {
        $query =DB::table('program_planning_infos');
        $query->Join('program_planning_artist_infos', 'program_planning_infos.id', '=',
         'program_planning_artist_infos.planning_info_id');
        $query->where('program_planning_infos.is_active','!=',0);
        $data=$query->orderBy('program_planning_infos.program_name')->groupBy('program_planning_infos.program_name')
            ->pluck("program_planning_infos.program_name","program_planning_infos.id");
        if($data){
            return $data;
        }else{
            return false;
        }
    }
    public static function get_artist_work_area_info($where = null)
    {
        $query= DB::table('program_planning_artist_infos')
            ->where("program_planning_artist_infos.is_active","!=",0)
            ->where("program_planning_artist_infos.work_area_id","!=",NULL)
            ->orderBy("program_planning_artist_infos.id","DESC")
            ->groupBy("program_planning_artist_infos.artist_id");
        if(!empty($where)){
            $query->where($where);
        }
        $result=$query->select(DB::raw("(GROUP_CONCAT(program_planning_artist_infos.work_area_id SEPARATOR ',')) as work_area_id"))
            ->get();
        if(!empty($result)){
            return $result;
        }else{
            return false;
        }
    }


}
