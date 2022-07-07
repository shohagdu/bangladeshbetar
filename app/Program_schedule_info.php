<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\All_stting;

class Program_schedule_info extends Model
{
    public static function program_info_by_status($where = null)
    {
        $query =  DB::table('program_schedule_infos as program');
        if(!is_null($where )) {
            foreach($where as $k => $v){
                $query->where($k, $v);
            }
        }
        return $query->select("program.title","program.id","program.schedule_date_time","program.remarks","program.record_file","program.status","program.program_ctg","program.internal_artist","program.external_artist",DB::raw("( CASE WHEN program.status = 1 THEN ' Scheduled' WHEN program.status = 2 THEN 'Recording' WHEN program.status = 3 THEN 'Play' WHEN program.status = 4 THEN 'Archieved'   ELSE '' END) AS status_show"))->get();
    }
    public static function arist_grade_by_type($where = null)
    {
        $query =  DB::table('setup_artist_rate_chart');
        $query->leftJoin('setup_artist_grade', 'setup_artist_grade.id', '=', 'setup_artist_rate_chart.grade_id');
        $query->where('setup_artist_rate_chart.ctg_id', $where);
        $query->where('setup_artist_rate_chart.is_active', 1);
        return $query->pluck( DB::raw("concat(setup_artist_grade.title, ' গ্রেড (', setup_artist_rate_chart.amount,')') as title")
            ,"setup_artist_rate_chart.id");
    }
    public static function get_program_planning_info($where = null)
    {
        $query =  DB::table('program_planning_infos');
        $query->leftJoin('all_sttings as program_type_info', 'program_type_info.id', '=', 'program_planning_infos.program_type');
        $query->leftJoin('all_sttings as program_style_info', 'program_style_info.id', '=', 'program_planning_infos.program_style');
        $query->leftJoin('branch_infos', 'branch_infos.id', '=', 'program_planning_infos.station_id');
        $query->where($where);
        $query->orderBy("program_planning_infos.id","DESC");
        $data=$query->select("program_style_info.title as program_style_title","program_type_info.title as program_type_title","program_planning_infos.*","branch_infos.name as 
        station_name",(DB::raw("date_format(program_planning_infos.entry_date,'%d-%m-%Y') as entry_date")))->get();
        foreach ($data as $key => $data_infos){
            $data[$key]->get_all_artist_info=All_stting::get_single__artist_info_by_program(['program_planning_artist_infos.planning_info_id'=>$data_infos->id,'program_planning_artist_infos.is_active'=>1]);
        }
        return $data;
    }
    public static function get_program_info($where = null)
    {
        $query =  DB::table('program_planning_infos');
        $query->leftJoin('all_sttings as program_type_info', 'program_type_info.id', '=', 'program_planning_infos.program_type');
        $query->leftJoin('all_sttings as program_style_info', 'program_style_info.id', '=', 'program_planning_infos.program_style');
        $query->leftJoin('branch_infos', 'branch_infos.id', '=', 'program_planning_infos.station_id');
        if(!empty($where)) {
            $query->where($where);
        }
        return $query->select("program_style_info.title as program_style_title","program_type_info.title as program_type_title","program_planning_infos.*","branch_infos.name as 
        station_name",(DB::raw("date_format(program_planning_infos.entry_date,'%d-%m-%Y') as entry_date")),(DB::raw("date_format(program_planning_infos.live_date,'%d-%m-%Y') as live_date")))->first();
    }
    public static function get_program_artist_group_info($where = null)
    {
        $query =  DB::table('program_planning_artist_infos');
        $query->leftJoin('all_sttings as program_description', 'program_description.id', '=', 'program_planning_artist_infos.description_id');
        $query->where($where);
        $query->groupBy('description_id');
        return $query->select("program_planning_artist_infos.planning_info_id","program_description.title as 
        description_title","program_planning_artist_infos.description_id",DB::raw('group_concat(program_planning_artist_infos.artist_id) as artist_info'),DB::raw('group_concat(program_planning_artist_infos.id) as artist_infos_primary_id'))->get();
    }

    public  static function check_description_id_existing($planning_info_id,$descrition_id,$artist_id) 
    {
        $exist_checking=DB::table('program_planning_artist_infos')
            ->where(['planning_info_id'=>$planning_info_id,'description_id'=>$descrition_id,'artist_id'=>$artist_id,'is_active'=>1])
            ->first();
        if(empty($exist_checking)){
            return ['status'=>'no_existing_found','message'=>'No Exist this description id','data'=>[]];
        }
        else {
            return ['status'=>'existing_found','message'=>'Exist this description id','data'=>$exist_checking]; 
        }

    }
    public  static function get_program_identity($station_id){

        $branch_info=DB::table('branch_infos')
            ->where(['id'=>$station_id])->first();
        $exist_checking=DB::table('program_planning_infos')
            ->where(['station_id'=>$station_id,'is_active'=>1])->whereDate(DB::raw("MONTH(entry_date)"),date('m'))
            ->count();
        if($exist_checking>=1){
            $program_id=$exist_checking+1;
        }else{
            $program_id=1;
        }
       return  $branch_info->abbreviation."PL".date('Ym'). str_pad($program_id, 4, "0", STR_PAD_LEFT);
    }
    public  static function get_presentation_identity($station_id,$feqeuncey_id){
        $branch_info=DB::table('branch_infos')

            ->where(['id'=>$station_id])->first();
        $fequency_info=DB::table('branch_infos')
            ->where(['id'=>$feqeuncey_id])->first();

        $exist_checking=DB::table('program_presentation_infos')
            ->where(['station_id'=>$station_id,'is_active'=>1])->where(DB::raw("MONTH(created_time)"),date('m'))->count();

        if($exist_checking>=1){
            $program_id=$exist_checking+1;
        }else{
            $program_id=1;
        }
        return  $branch_info->abbreviation."PR".date('ym'). str_pad($program_id, 2, "0", STR_PAD_LEFT);
    }
    public static function get_program_recording_list($where = null)
    {
        $query =  DB::table('program_planning_artist_infos');
        $query->leftJoin('program_planning_infos', 'program_planning_infos.id', '=', 'program_planning_artist_infos.planning_info_id');
        $query->leftJoin('program_artist_info', 'program_artist_info.id', '=', 'program_planning_artist_infos.artist_id');
        $query->leftJoin('all_sttings as program_type_info', 'program_type_info.id', '=', 'program_planning_infos.program_type');
        $query->leftJoin('all_sttings as program_style_info', 'program_style_info.id', '=', 'program_planning_infos.program_style');
        $query->leftJoin('branch_infos', 'branch_infos.id', '=', 'program_planning_infos.station_id');
        $query->where($where);
        $query->orderBy("program_planning_artist_infos.id","DESC");
        $data=$query->select("program_planning_artist_infos.*","program_style_info.title as 
      program_style_title","program_type_info.title as program_type_title","program_planning_infos.program_name","program_planning_infos.program_identity","program_planning_infos.recording_stabilty","program_planning_infos.record_type","program_planning_infos.is_recorded","program_planning_infos.record_complete_date","program_planning_infos.is_broadcast","program_planning_infos.brodcast_complete_date","branch_infos.name as 
        station_name","branch_infos.address as branch_address",(DB::raw("date_format(program_planning_infos.entry_date,'%d-%m-%Y') as entry_date")),"program_artist_info.name_bn as artist_name","program_artist_info.mobile as artist_mobile","program_artist_info.address as address")->get();
        foreach ($data as $key => $data_infos){
            if($data_infos->record_type==1) {
                $data[$key]->recording_date_info = $data_infos->live_date_log;
            }elseif($data_infos->record_type==2){
                $data[$key]->recording_date_info = $data_infos->record_date_log;
            }
        }
        return $data;
    }
    public static function get_gatepass_info($where = null)
    {
        //return $where;
        $query =  DB::table('program_planning_artist_infos');
        $query->leftJoin('program_planning_infos', 'program_planning_infos.id', '=', 'program_planning_artist_infos.planning_info_id');
        $query->leftJoin('branch_infos', 'branch_infos.id', '=', 'program_planning_infos.station_id');
        $query->where($where);
       // $query->groupBy('program_planning_infos.station_id');
      //  $query->groupBy('program_planning_infos.entry_date');
        $query->orderBy("program_planning_infos.id","DESC");
        $data=$query->select("program_planning_infos.station_id","record_type","live_date_log","record_date_log","branch_infos.name as 
        station_name",(DB::raw("date_format(program_planning_infos.entry_date,'%d-%m-%Y') as entry_date")))->get();
        foreach ($data as $key => $data_infos){
            if($data_infos->record_type==1) {
                $data[$key]->recording_date_info = $data_infos->live_date_log;
            }elseif($data_infos->record_type==2){
                $data[$key]->recording_date_info = $data_infos->record_date_log;
            }
        }
        return $data;
    }

    public static function get_program_schedule_info($where = null)
    {
     return   $plan_info = DB::table('schedule_information')
            ->leftJoin("branch_infos","branch_infos.id","=","schedule_information.station_id")
            ->leftJoin("branch_infos as fequencey_info","fequencey_info.id","=","schedule_information.sub_station_id")
            ->leftJoin('setup_days','setup_days.id','=','schedule_information.day_id')
            ->where($where )
            ->orderBy("schedule_information.date","DESC")
            ->select("schedule_information.id","schedule_information.content","schedule_information.type","schedule_information.date","schedule_information.station_id","schedule_information.sub_station_id","schedule_information.day_id","schedule_information.approved_by","schedule_information.approved_date",'setup_days.title_bn',"branch_infos.name as 
            station_name",DB::raw('CONCAT(fequencey_info.fequencey, " (", fequencey_info.title,")") AS fequencey_data'))
            ->get();
    }
    public static function get_program_schedule_info_single($where = null)
    {
        return   $plan_info = DB::table('schedule_information')
            ->leftJoin("branch_infos","branch_infos.id","=","schedule_information.station_id")
            ->leftJoin("branch_infos as fequencey_info","fequencey_info.id","=","schedule_information.sub_station_id")
            ->leftJoin('setup_days','setup_days.id','=','schedule_information.day_id')
            ->where($where )
            ->select("schedule_information.id","schedule_information.content","schedule_information.type","schedule_information.date","schedule_information.station_id","schedule_information.sub_station_id","schedule_information.day_id","schedule_information.approved_by","schedule_information.approved_date",'setup_days.title_bn',"branch_infos.name as 
            station_name",'branch_infos.address',DB::raw('CONCAT(fequencey_info.fequencey, " (", fequencey_info.title,")") AS fequencey_data'))
            ->first();
    }

    public static function get_program_presentation_setting($where = null)
    {
        return    $query = DB::table('program_presentation_setting')
            ->where($where)
            ->leftJoin("branch_infos","branch_infos.id","=","program_presentation_setting.station_id")
            ->leftJoin("branch_infos as fequencey_info","fequencey_info.id","=","program_presentation_setting.fequencey_id")
            ->select("program_presentation_setting.*","branch_infos.name as 
            station_name",DB::raw('CONCAT(fequencey_info.fequencey, " (", fequencey_info.title,")") AS fequencey_data'))
            ->get();
    }
    public static function get_program_presentation_single_setting($where = null)
    {
        return    $query = DB::table('program_presentation_setting')
            ->where($where)
            ->leftJoin("branch_infos","branch_infos.id","=","program_presentation_setting.station_id")
            ->leftJoin("branch_infos as fequencey_info","fequencey_info.id","=","program_presentation_setting.fequencey_id")
            ->select("program_presentation_setting.*","branch_infos.name as 
            station_name",DB::raw('CONCAT(fequencey_info.fequencey, " (", fequencey_info.title,")") AS fequencey_data'))
            ->first();
    }
    public static function get_all_presentation_info($where = null,$type=1)
    {
        return    $presentation_info = DB::table("program_presentation_infos")
            ->where($where)
            ->where('program_presentation_infos.presentration_type','=',$type)
            ->where('program_presentation_infos.sub_station_id','!=',NULL)
            ->where('program_presentation_infos.is_active','!=',0)
            ->leftJoin('branch_infos', 'branch_infos.id', '=', 'program_presentation_infos.station_id')
            ->leftJoin("branch_infos as fequencey_info","fequencey_info.id","=","program_presentation_infos.sub_station_id")
            ->leftJoin("employees","employees.employee_id","=","program_presentation_infos.presentation_created_by")
            ->orderBy('program_presentation_infos.station_id',"ASC" )
            ->orderBy('program_presentation_infos.months',"ASC" )
            ->groupBy('program_presentation_infos.months')
            ->groupBy('program_presentation_infos.station_id')
            ->select('program_presentation_infos.presentation_bikolpo_id','program_presentation_infos.is_re_proposal','program_presentation_infos.is_re_planning','program_presentation_infos.id','program_presentation_infos.is_active','program_presentation_infos.presentation_identification_id','program_presentation_infos.months','program_presentation_infos.station_id','program_presentation_infos.sub_station_id','program_presentation_infos.presentation_created_by','program_presentation_infos.created_time','program_presentation_infos.updated_time','branch_infos.name',DB::raw('CONCAT(fequencey_info.fequencey, " (", fequencey_info.title,")") AS fequencey_data'),"employees.emp_name as created_by_title")
            ->get();
    }
    public static function get_program_presentation_single_info($where = null)
    {
        return    $presentation_info = DB::table("program_presentation_infos")
            ->where($where)
            ->where('program_presentation_infos.is_active','!=','0')
            ->where('program_presentation_infos.sub_station_id','!=',NULL)
            ->leftJoin('branch_infos', 'branch_infos.id', '=', 'program_presentation_infos.station_id')
            ->leftJoin("branch_infos as fequencey_info","fequencey_info.id","=","program_presentation_infos.sub_station_id")
            ->orderBy('program_presentation_infos.station_id',"ASC" )
            ->orderBy('program_presentation_infos.months',"ASC" )
            ->select('program_presentation_infos.*','branch_infos.name','branch_infos.address',DB::raw('CONCAT(fequencey_info.fequencey, " (", fequencey_info.title,")") AS fequencey_data'))
            ->get();
    }
    public static function get_program_presentation_single_info_first_row($where = null)
    {
        return    $presentation_info = DB::table("program_presentation_infos")
            ->where($where)
            ->where('program_presentation_infos.is_active','!=','0')
            ->where('program_presentation_infos.sub_station_id','!=',NULL)
            ->orderBy('program_presentation_infos.id',"ASC" )
            ->limit(1)
            ->select('program_presentation_infos.*')
            ->first();
    }
    public static function get_single_rate_chart_info($where = null)
    {
       return $rate_chart = DB::table("setup_artist_rate_chart")->where($where)->orderBy("id","DESC")->limit(1)
           ->select('id','amount','stability','mohoda_fee')->first();
    }
    public static function get_program_presentation_info_report_artist($where = null)
    {
        return    $presentation_info =
            DB::table("program_presentation_infos")
             ->rightJoin("program_planning_artist_infos as presentation_artist_info","presentation_artist_info.presentation_date_id","=","program_presentation_infos.id")
//                ->Join('program_planning_artist_infos as presentation_artist_info', function ($join) {
//                    $join->on('presentation_artist_info.presentation_date_id', '=', 'program_presentation_infos.id')
//                   ->orOn('presentation_artist_info.is_active','=',1);
//                })
              //  ->where('presentation_artist_info.is_active','=',1)
                ->leftJoin('program_artist_info', 'program_artist_info.id', '=', 'presentation_artist_info.artist_id')
                ->where($where)
                ->leftJoin('branch_infos', 'branch_infos.id', '=', 'program_presentation_infos.station_id')
                ->leftJoin("branch_infos as fequencey_info","fequencey_info.id","=","program_presentation_infos.sub_station_id")
                ->orderBy('program_presentation_infos.presentation_date',"ASC")
                ->orderBy('presentation_artist_info.odivision_id',"ASC")
                ->groupBy('presentation_artist_info.artist_id', 'program_presentation_infos.presentation_date')
                ->select('program_presentation_infos.id','program_presentation_infos.presentation_days','program_presentation_infos.presentation_date','program_presentation_infos.presentation_days','program_presentation_infos.presentation_year','program_presentation_infos.months','branch_infos.name','branch_infos.address',DB::raw('CONCAT(fequencey_info.fequencey, " (", fequencey_info.title,")") AS fequencey_data'),"presentation_artist_info.id as  artist_info_id","presentation_artist_info.artist_id","presentation_artist_info.is_bikolpo","presentation_artist_info.bikolpo_artist_info","presentation_artist_info.odivision_id","presentation_artist_info.role_title","program_artist_info.name_bn")
                ->get();
    }

    public static function get_program_presentation_heading_info($where = null)
    {

        return    $presentation_info =
         DB::table("program_presentation_infos")
        ->where($where)
        ->leftJoin('branch_infos', 'branch_infos.id', '=', 'program_presentation_infos.station_id')
        ->leftJoin("branch_infos as fequencey_info","fequencey_info.id","=","program_presentation_infos.sub_station_id")

        ->orderBy('program_presentation_infos.id',"ASC" )
        ->limit(1)
        ->select('program_presentation_infos.is_active','program_presentation_infos.station_id','program_presentation_infos.presentation_created_by','program_presentation_infos.presentation_year','program_presentation_infos.months','branch_infos.name','branch_infos.address',DB::raw('CONCAT(fequencey_info.fequencey, " (", fequencey_info.title,")") AS fequencey_data'))
        ->first();
    }

    public static function get_program_presentation_info_proposal_searching($receive = null,$status=null,  $payment_status=null)
    {
        $query =
            DB::table("program_presentation_infos");
                $query->rightJoin("program_planning_artist_infos as presentation_artist_info","presentation_artist_info.presentation_date_id","=","program_presentation_infos.id");
                $query->leftJoin('branch_infos', 'branch_infos.id', '=', 'program_presentation_infos.station_id');
                $query->leftJoin("branch_infos as fequencey_info","fequencey_info.id","=","program_presentation_infos.sub_station_id");
        $query->leftJoin('program_artist_info', 'program_artist_info.id', '=', 'presentation_artist_info.artist_id');
        $query->leftJoin('all_sttings as bank_name_info', 'bank_name_info.id', '=', 'program_artist_info.bank_name');
        $query->leftJoin('setup_artist_grade', 'setup_artist_grade.id', '=', 'presentation_artist_info.artist_grade');
        $query->leftJoin('setup_artist_rate_chart', 'setup_artist_rate_chart.id', '=', 'presentation_artist_info.artist_rate_chart_id');
        if (!empty($receive['presentration_type'])) {
            if($receive['presentration_type']=='regular'){
                $query->where('program_presentation_infos.presentration_type','=',1);
            }elseif($receive['presentration_type']=='adhok'){
                $query->where('program_presentation_infos.presentration_type','=',2);
            }
        }
        if (!empty($receive['station_id'])) {
            $query->where('program_presentation_infos.station_id','=',$receive['station_id']);
        }
        if (!empty($receive['fequency_id'])) {
            $query->where('program_presentation_infos.sub_station_id','=',$receive['fequency_id']);
        }

        if($status==4){
//            contract complete
            if (!empty($receive['from_date']) && (!empty($receive['to_date']))) {
                $query->whereDate('program_presentation_infos.contract_approved_dt', '>=', date('Y-m-d', strtotime($receive['from_date'])));
                $query->whereDate('program_presentation_infos.record_complete_date', '<=', date('Y-m-d', strtotime($receive['to_date'])));

            }
        }elseif($status==3) {
            // proposal complete
            if (!empty($receive['from_date']) && (!empty($receive['to_date']))) {
                $query->whereDate('program_presentation_infos.proposal_approved_dt', '>=', date('Y-m-d', strtotime($receive['from_date'])));
                $query->whereDate('program_presentation_infos.proposal_approved_dt', '<=', date('Y-m-d', strtotime($receive['to_date'])));
            }
        }else {
            if (!empty($receive['from_date']) && (!empty($receive['to_date']))) {
                $query->whereDate('program_presentation_infos.plan_approved_dt', '>=', date('Y-m-d', strtotime($receive['from_date'])));
                $query->whereDate('program_presentation_infos.plan_approved_dt', '<=', date('Y-m-d', strtotime($receive['to_date'])));
            }
        }
        if(!empty($status)){
            $query->where('program_presentation_infos.is_active','>=',$status);
        }
        $query->orderBy("program_presentation_infos.presentation_date","ASC");
        $data= $query->select("program_presentation_infos.id as presentation_primary_id","program_presentation_infos.presentation_identification_id","branch_infos.name as 
        station_name",(DB::raw("date_format(program_presentation_infos.presentation_date,'%d-%m-%Y') as presentation_date")),"program_presentation_infos.plan_approved_dt","program_presentation_infos.proposal_approved_by","program_presentation_infos.proposal_approved_by","program_presentation_infos.proposal_approved_dt","program_presentation_infos.contract_approved_by","program_presentation_infos.contract_approved_dt","program_artist_info.name_bn as artist_name","program_artist_info.address","program_artist_info.mobile as artist_mobile","program_artist_info.bank_branch_name","program_artist_info.bank_account_no","bank_name_info.title as bank_name_title","setup_artist_grade.title as grade_title","setup_artist_rate_chart.stability as stability_title","presentation_artist_info.*")->get();

        return $data;

    }

    public  static function get_artist_info_primary_id($receive,$presentation_date)
    {
        $exist_checking=DB::table('program_planning_artist_infos')
             ->Join("program_presentation_infos","program_planning_artist_infos.presentation_date_id","=","program_presentation_infos.id")
            ->where("program_presentation_infos.presentation_date",'=',$presentation_date)
            ->where($receive)
            ->select("program_planning_artist_infos.id")
            ->first();
        if(!empty($exist_checking)){
            return $exist_checking->id;
        }
        else {
           return false;
        }

    }

    public static function get_program_presentation_single_day_form_artist_info($where = null)
    {
        return    $presentation_info = DB::table("program_planning_artist_infos")
            ->Join("program_presentation_infos","program_planning_artist_infos.presentation_date_id","=","program_presentation_infos.id")
            ->where($where)
            ->where('program_presentation_infos.is_active','=','1')
            ->where('program_presentation_infos.sub_station_id','!=',NULL)
            ->orderBy('program_planning_artist_infos.id',"ASC" )
            ->select('program_presentation_infos.presentation_date',"program_planning_artist_infos.id","program_planning_artist_infos.role_title","program_planning_artist_infos.odivision_id","program_planning_artist_infos.artist_id","program_planning_artist_infos.is_present","program_planning_artist_infos.presentation_comments","program_planning_artist_infos.log_type","program_planning_artist_infos.log_book_no")
            ->get();
    }

    public static function all_presentation_info($where = null)
    {

        return    $presentation_info =
            DB::table("program_presentation_infos")
                ->where($where)
                ->where("program_presentation_infos.is_active","!=",0)
                ->orderBy('program_presentation_infos.id',"ASC" )
                ->groupBy('program_presentation_infos.months')
                ->groupBy('program_presentation_infos.station_id')
                ->groupBy('program_presentation_infos.sub_station_id')
                ->pluck('presentation_identification_id','id');
    }

    public static function get_all_performance_info($where = null)
    {
        return    $presentation_info =
            DB::table("performance_info")
                ->where($where)
                ->leftJoin('branch_infos', 'branch_infos.id', '=', 'performance_info.station_id')
                ->leftJoin("branch_infos as fequencey_info","fequencey_info.id","=","performance_info.fequencey_id")
                ->leftJoin("employees","employees.employee_id","=","performance_info.created_by")
                ->orderBy('performance_info.performance_date',"DESC")
                ->orderBy('performance_info.station_id',"ASC")
                ->orderBy('performance_info.fequencey_id',"ASC")
                ->select('performance_info.id','performance_info.performance_date','performance_info.station_id','performance_info.fequencey_id','performance_info.month_id','performance_info.year','branch_infos.name','branch_infos.address',DB::raw('CONCAT(fequencey_info.fequencey, " (", fequencey_info.title,")") AS fequencey_data'),"employees.emp_name as performance_created_by","performance_info.created_time")
                ->get();
    }
    public static function get_program_presentation_performance($where = null)
    {
        return    $presentation_info =
            DB::table("program_presentation_infos")
                ->rightJoin("program_planning_artist_infos as presentation_artist_info","presentation_artist_info.presentation_date_id","=","program_presentation_infos.id")
                ->leftJoin('program_artist_info', 'program_artist_info.id', '=', 'presentation_artist_info.artist_id')
                ->where($where)
                ->orderBy('program_presentation_infos.presentation_date',"ASC")
                ->orderBy('presentation_artist_info.odivision_id',"ASC")
                ->groupBy('presentation_artist_info.artist_id', 'program_presentation_infos.presentation_date')
                ->select('presentation_artist_info.id','program_presentation_infos.presentation_identification_id','program_presentation_infos.presentation_date',"presentation_artist_info.artist_id","presentation_artist_info.odivision_id","presentation_artist_info.role_title","program_artist_info.name_bn","program_artist_info.mobile","program_artist_info.picture","presentation_artist_info.type as presentation_type",'presentation_artist_info.performance_odvision_info','presentation_artist_info.performance_ctg','presentation_artist_info.performance_comments','presentation_artist_info.performance_updated_by')
                ->get();
    }
    //shohag mobile ime number
    //imei1: 867778047611234
    //imei2:867778047611226
    // mehedi
    //867345040528516
    public static function get_performance_info($where = null)
    {
        return    $presentation_info =
            DB::table("performance_info")
                ->where($where)
                ->leftJoin('branch_infos', 'branch_infos.id', '=', 'performance_info.station_id')
                ->leftJoin("branch_infos as fequencey_info","fequencey_info.id","=","performance_info.fequencey_id")
                ->leftJoin("employees","employees.employee_id","=","performance_info.created_by")
                ->orderBy('performance_info.id',"DESC")
                ->select('performance_info.*','branch_infos.name','branch_infos.address',DB::raw('CONCAT(fequencey_info.fequencey, " (", fequencey_info.title,")") AS fequencey_data'),"employees.emp_name as performance_created_by")
                ->first();
    }


    public static function get_program_performance_artist_info($where = null)
    {
        $query =DB::table('program_planning_artist_infos');
        $query->leftJoin('program_planning_infos', 'program_planning_infos.id', '=', 'program_planning_artist_infos.planning_info_id');
        $query->leftJoin('program_artist_info', 'program_artist_info.id', '=', 'program_planning_artist_infos.artist_id');
        $query->where($where);
        $query->select("program_planning_artist_infos.id","program_planning_infos.program_identity","program_planning_infos.program_name","program_planning_infos.id as plan_main_id","program_artist_info.picture","program_artist_info.name_bn","program_artist_info.mobile","program_planning_infos.record_type",'program_planning_artist_infos.performance_ctg','program_planning_artist_infos.performance_comments','program_planning_artist_infos.performance_updated_by',"program_planning_artist_infos.type as presentation_type");
        $data = $query->get();
        if($data){
            return $data;
        }else{
            return false;
        }
    }

    public static function get_program_heading_info($where = null)
    {

        return    $presentation_info =
            DB::table("program_planning_infos")
                ->where($where)
                ->leftJoin('branch_infos', 'branch_infos.id', '=', 'program_planning_infos.station_id')
                ->leftJoin("branch_infos as fequencey_info","fequencey_info.id","=","program_planning_infos.sub_station_id")
                ->orderBy('program_planning_infos.id',"ASC" )
                ->limit(1)
                ->select('program_planning_infos.is_active','program_planning_infos.station_id','program_planning_infos.created_by',   'branch_infos.name','branch_infos.address',DB::raw('CONCAT(fequencey_info.fequencey, " (", fequencey_info.title,")") AS fequencey_data'))
                ->first();
    }
    public static function get_heading_info_station_fequency($where = null)
    {

        return    $presentation_info =
            DB::table("branch_infos as fequencey_info")
                ->leftJoin('branch_infos', 'branch_infos.id', '=', 'fequencey_info.parent_id')
                ->where($where)
                ->limit(1)
                ->select('branch_infos.name','branch_infos.address',DB::raw('CONCAT(fequencey_info.fequencey, " (", fequencey_info.title,")") AS fequencey_data'))
                ->first();
    }
    public static function artist_id_generate($station)
    {
        $branch_info=DB::table('branch_infos')
            ->where(['id'=>$station])->first();

        $query = DB::table('program_artist_info')
            ->select('program_artist_info.id')
            ->where( DB::raw("year(created_time)=date('Y')"))
            ->where(['station_id'=>$station])
            ->count();
        return $branch_info->abbreviation.date('ym').str_pad($query + 1,4,"0",STR_PAD_LEFT);
    }
    public static function exist_checking_artist_info($param)
    {
        $query = DB::table('program_artist_info')
            ->select('program_artist_info.id')
            ->where($param)
            ->select('id')->first();
       if(!empty($query->id)){
           return $query->id;
       }else{
           return false;
       }
    }
    
    public static function searching_playlist_info($receive=NULL){
        if(!empty($receive)) {
            $results = [];
            $queries = DB::table('archive_playlist')
                ->where('playlist_id', 'LIKE', '%' . $receive . '%')
                ->orWhere('name', 'LIKE', '%' . $receive . '%')
                ->take(10)->get();
            foreach ($queries as $query) {
                $results[] = ['id' => $query->playlist_id, 'value' => $query->playlist_id . " (" . $query->name . ")"];
            }
            return $results;
        }else{
            return false;
        }
    }

}
