<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Branch_info;
use App\All_stting;
use App\Employee;
use App\Program_schedule_info;
use App\Land_info;
use PDF;

class ReportCtrl extends Controller
{
    // all report section
    public function employee_designation_report(){

        $station_info = Branch_info::branch_info_select(['is_active'=>1]);
        $designation_info = All_stting::get_settings_info(['type'=>2]);
        return view('report.hr.employee_designation_report',['station_info'=>$station_info,'designation_info'=>$designation_info]);
    }
    public function search_employee_designation_report(request $request){
        if (empty($request->station_id)){
            return ['status'=>'error','message'=>'Station Name is required','data'=>''];
        }else {
            $param=[
                'station_id'=>$request->station_id,
                'employee_designation'=>$request->employee_designation,
                'employee_id_search'=>$request->employee_id_search
            ];

            $data=Employee::get_search_employee_info($param);
            return view('report.hr.employee_designation_report_action',['data'=>$data]);

        }
    }
    public function employee_department_report(){
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);
        $department = All_stting::get_settings_info(['type'=>1]);
        return view('report.hr.employee_department_report',['station_info'=>$station_info,'department_info'=>$department]);
    }
    public function search_employee_department_report(request $request){
        if (empty($request->station_id)){
            return ['status'=>'error','message'=>'Station Name is required','data'=>''];
        }else {
            $param=[
                'station_id'=>$request->station_id,
                'employee_department'=>$request->employee_department,
                'employee_id_search'=>$request->employee_id_search
            ];

            $data=Employee::get_search_employee_info($param);
            return view('report.hr.employee_department_report_action',['data'=>$data]);

        }
    }
    public function employee_education_report(){
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);
        $degree = All_stting::get_settings_info(['type'=>3]);
        return view('report.hr.employee_education_report',['station_info'=>$station_info,'degree_info'=>$degree]);
    }
    public function search_employee_education_report(request $request){
        if (empty($request->station_id)){
            return ['status'=>'error','message'=>'Station Name is required','data'=>''];
        }else {
            $param=[
                'station_id'=>$request->station_id,
                'employee_edu_degree_id'=>$request->employee_edu_degree_id,
                'employee_id_search'=>$request->employee_id_search
            ];
            $degree = All_stting::get_settings_info(['type'=>3]);
            $data=Employee::get_search_employee_info($param);
            return view('report.hr.employee_education_report_action',['data'=>$data,'degree'=>$degree]);

        }
    }
	
	// program report
    public function program_plan_report() {
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);
        $day_name = All_stting::get_day_name();
        $get_odivision_info = All_stting::get_odivision_info();



        
        
        $schedule_info = DB::table('setup_fixed_time_point')
        ->leftJoin('branch_infos','branch_infos.id','=','setup_fixed_time_point.station_id')
        ->leftJoin('setup_days','setup_days.id','=','setup_fixed_time_point.day_id')
        ->select('setup_fixed_time_point.*','branch_infos.name','setup_days.title_bn')->get();
       return view('report.program.program_plan',
       [
           'station_info'=>$station_info,
           'day_name'=>$day_name,
           'get_odivision_info'=>$get_odivision_info,
           'schedule_info'=>$schedule_info 
       ]);
    }

    public function artist_rate_chart_report() {
        $artist_song_ctg = All_stting::get_settings_info(['type'=>6,'is_active'=>1]);
        
        $artist_grade_info = All_stting::get_artist_grade_info(['type'=>1]);
       
        // $get_rate_chart = All_stting::get_artist_rate_chart();
        $program_ctg = DB::table('all_sttings')
        ->where("all_sttings.is_active",1) 
        ->where("all_sttings.display_position",">=",0) 
        ->where("all_sttings.type",15)
        ->orderBy("all_sttings.display_position","ASC")
        ->select("all_sttings.*")
        ->get();


        return view('report.program.artist_rate_chart',
        ['get_rate_chart' => [],
        'artist_song_ctg'=>$artist_song_ctg,
        'artist_grade_info'=>$artist_grade_info,
        'program_ctg' => $program_ctg
        ]);
    }
    public function event_yearly_program_report() {
        $event_report = All_stting::event_yearly_program_report(['main_event.is_active'=>1]);
        return view('report.program.event_yearly_program_report',
            [
                'event_report' => $event_report
            ]);
    }

    public function program_plan_report_load($station, $sub_station_id, $date) {
        $nameOfDay = date('l', strtotime($date));
        $dayname_info = DB::table('setup_days')->where('title_en',$nameOfDay)->get()->first();

        
        $atrist_info_info = Employee::get_artist_select();

        $presentation_info = DB::table("program_presentation_infos")
        ->where([
            'is_active'=>1,
            'station_id'=>$station,
            'presentation_date'=> date('Y-m-d',strtotime($date)),
            ])
        ->first();


        $schedule_info = DB::table('setup_fixed_time_point')
            ->leftJoin('branch_infos','branch_infos.id','=','setup_fixed_time_point.station_id')
            // ->leftJoin('setup_days','setup_days.id','=','setup_fixed_time_point.day_id')
            ->select('setup_fixed_time_point.*','branch_infos.name')
            ->where(
                [
                'setup_fixed_time_point.station_id'=>$station,
                'setup_fixed_time_point.sub_station_id'=> $sub_station_id
                ])
            ->get();

        // dd($schedule_info);

        $plan_info= Program_schedule_info::get_program_schedule_info([
            'schedule_information.station_id'=>$station,
            'schedule_information.sub_station_id'=>$sub_station_id,
            'schedule_information.date'=> date("Y-m-d",strtotime($date)),
        ]);
        if(count($plan_info)==0) 
        {

            die("<h1 style='color:red';>Report not found your desired date</h1>");
        }

        $get_odivision_info = All_stting::get_odivision_info();

        return view('report.program.program_plan_report',
            [
                'get_odivision_info'=>$get_odivision_info,
                'plan_info'=>$plan_info,
                'day_name' => $dayname_info->title_bn,
                'date' => date("Y-m-d",strtotime($date)),
                'presentation_info' => $presentation_info,
                'artist_info' => $atrist_info_info
            ]);
    }

    // land report
    public function search_land_information_report(request $request){
        if (empty($request->station_id)){
            return ['status'=>'error','message'=>'Station Name is required','data'=>''];
        }else {
            $param=[
                'station_id'   =>$request->station_id,
                'area'         =>$request->area,
                'land_no'      =>$request->land_no,
                'dag_no'       =>$request->dag_no,
                'khotian_no'   =>$request->khotian_no,
                'mouza_no'     =>$request->mouza_no,
                'zer_no'       =>$request->zer_no,
                'last_date_tax'=> date('Y-m-d', strtotime($request->last_date_tax)),
            ];

            $data=Land_info::get_search_land_info($param);

            return view('report.land_information_report_action',['data'=>$data]);

        }
    }





}
