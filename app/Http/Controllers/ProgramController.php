<?php

namespace App\Http\Controllers;

use App\Branch_info;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\All_stting;
use App\Employee;
use App\Employee_leave_info;
use App\Monthly_opening;
use App\Company_info;
use App\Program_schedule_info;
use PDF;
use Session;
use Datatables;
use Validator;
use Intervention\Image\ImageManagerStatic as Image;


class ProgramController extends Controller
{
    // Md Omar Faruk
    public function __construct() {
        $this->middleware('auth');
    }

    public function index(){
        if(!isset( Auth::user()->id)&&(empty(Auth::user()->id))) {
            return redirect('/login');
        }else {

            $current_fiscal_year=Monthly_opening::get_current_fiscal_year(['is_active'=>1]);
            $current_payslip_month=Monthly_opening::get_current_payslip_month_info(['status'=>1]);


            $company_info = Company_info::find(6); // company id = 6
            Session::put('company_logo', $company_info->company_logo);
            Session::put('current_fiscal_year', $current_fiscal_year);
            Session::put('current_payslip_month', $current_payslip_month);
//            $data = session()->all();
            return view('template.font_content_program',['company_info'=>$company_info,]);
        }
    }
    public function program_schedule_create(){
        $program_ctg = All_stting::get_settings_info(['type'=>6,'is_active'=>1]);
        $employee_info = Employee::get_employee_info_name(['is_active'=>1]);
        $program_info = Program_schedule_info::program_info_by_status(['status'=>1]);
        return view('program.program_schedule_create',['program_ctg'=>$program_ctg,'employee_info'=>$employee_info,'program_info'=>$program_info]);
    }


    public function program_status(){
        return ['1'=>'Schedule Create','2'=>'Program Record','3'=>'Program Play','4'=>'Program Archieve'];
    }

    public function program_record_history(){
        $program_ctg = All_stting::get_settings_info(['type'=>6,'is_active'=>1]);
        $employee_info = Employee::get_employee_info_name(['is_active'=>1]);
        $program_info = Program_schedule_info::program_info_by_status(['status'=>2]);
        return view('program.program_record_history',['program_ctg'=>$program_ctg,'employee_info'=>$employee_info,'program_info'=>$program_info]);
    }
    public function program_play_history(){
        $program_ctg = All_stting::get_settings_info(['type'=>6,'is_active'=>1]);
        $employee_info = Employee::get_employee_info_name(['is_active'=>1]);
        $program_info = Program_schedule_info::program_info_by_status(['status'=>3]);
        return view('program.program_play_history',['program_ctg'=>$program_ctg,'employee_info'=>$employee_info,'program_info'=>$program_info]);
    }
    public function program_archieve_history(){
        $program_ctg = All_stting::get_settings_info(['type'=>6,'is_active'=>1]);
        $employee_info = Employee::get_employee_info_name(['is_active'=>1]);
        $program_info = Program_schedule_info::program_info_by_status(['status'=>4]);
        return view('program.program_archieve_history',['program_ctg'=>$program_ctg,'employee_info'=>$employee_info,'program_info'=>$program_info]);
    }
    public function program_report(){
        $program_ctg = All_stting::get_settings_info(['type'=>6,'is_active'=>1]);
        $employee_info = Employee::get_employee_info_name(['is_active'=>1]);
        $program_info = Program_schedule_info::program_info_by_status(['status'=>4]);
        return view('program.program_report',['program_ctg'=>$program_ctg,'employee_info'=>$employee_info,'program_info'=>$program_info]);
    }
    public function artist_record(){
        $artist_exp_type = All_stting::get_settings_info(['type'=>6,'is_active'=>1]);
        $artist_exp_type_department = All_stting::get_settings_info(['type'=>20,'is_active'=>1]);
        $work_area = All_stting::get_settings_info(['type'=>18,'is_active'=>1]);
        $artist_grade_info = All_stting::get_artist_grade_info(['type'=>1]);
        $program_artist_info = All_stting::get_program_artist_info(['program_artist_info.is_active'=>1],100);
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);
        return view('program.artist_record',['station_info'=>$station_info,'program_artist_info'=>$program_artist_info,
            'artist_exp_type'=>$artist_exp_type,'artist_grade_info'=>$artist_grade_info,
            'artist_exp_type_department'=>$artist_exp_type_department,'work_area_info_data'=>$work_area]);
    }

    public function artist_record_add() {
        $artist_exp_type = All_stting::get_settings_info(['type'=>6,'is_active'=>1]);
        $program_ctg = All_stting::get_settings_info(['type'=>15,'is_active'=>1]);
        $artist_exp = All_stting::get_settings_info(['type'=>18,'is_active'=>1]);
        $expertise_dept = All_stting::get_settings_info(['type'=>6,'is_active'=>1]);
        $national_award_info = All_stting::get_settings_info(['type'=>21,'is_active'=>1]);
        $occupation_info = All_stting::get_settings_info(['type'=>22,'is_active'=>1]);

        $employee_info = Employee::get_employee_info_name(['is_active'=>1]);
        $program_info = Program_schedule_info::program_info_by_status(['status'=>4]);
        $nationality_info= All_stting::get_settings_info(['type'=>4,'is_active'=>1]);
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);
       // $program_artist_info = All_stting::get_program_artist_info(['program_artist_info.is_active'=>1]);
      //  dd($program_artist_info);
        $district_info=All_stting::get_district();
        $bank_info = All_stting::get_settings_info(['type'=>9,'is_active'=>1]);
        $artist_grade_info = All_stting::get_artist_grade_info(['type'=>1]);

        return view('program.artist_record_form',['program_ctg'=>$program_ctg,'employee_info'=>$employee_info,'program_info'=>$program_info,'nationality'=>$nationality_info,'station_info'=>$station_info,'all_district'=>$district_info,'artist_exp'=>$artist_exp,'artist_exp_type'=>$artist_exp_type,'expertise_dept'=>$expertise_dept,'national_award_info'=>$national_award_info,'occupation_info'=>$occupation_info,'bank_info'=>$bank_info,'artist_grade_info'=>$artist_grade_info]);
    }

    public function artist_record_update($id) {

        $artist_exp_type = All_stting::get_settings_info(['type'=>6,'is_active'=>1]);
        $program_ctg = All_stting::get_settings_info(['type'=>15,'is_active'=>1]);
        $artist_exp = All_stting::get_settings_info(['type'=>18,'is_active'=>1]);
        $expertise_dept = All_stting::get_settings_info(['type'=>6,'is_active'=>1]);
        $national_award_info = All_stting::get_settings_info(['type'=>21,'is_active'=>1]);
        $occupation_info = All_stting::get_settings_info(['type'=>22,'is_active'=>1]);

      //  $employee_info = Employee::get_employee_info_name(['is_active'=>1]);
        $program_info = Program_schedule_info::program_info_by_status(['status'=>4]);
        $nationality_info= All_stting::get_settings_info(['type'=>4,'is_active'=>1]);
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);
     //   dd($id);
     //   $program_artist_info = All_stting::get_program_artist_info(['is_active'=>1]);

        $district_info=All_stting::get_district();
        $bank_info = All_stting::get_settings_info(['type'=>9,'is_active'=>1]);

        $artist_grade_info = All_stting::get_artist_grade_info(['type'=>1]);

        $artist_info_show = DB::table('program_artist_info')
            ->where('id',$id)
            ->first();


        $expertise_data=[];
        if(!empty($artist_info_show->artist_expertise_info)){
            $expertise_info= json_decode($artist_info_show->artist_expertise_info,true);
            foreach ($expertise_info as $expertise_info_data){
                if($expertise_info_data['is_active']==1){
                    $artist_expertise_department= All_stting::get_settings_info(['parent_id'=>$expertise_info_data['expertise'],'is_active'=>1]);
                    if(!empty($artist_expertise_department)){
                        $exp_dept_data=$artist_expertise_department;
                    }else{
                        $exp_dept_data=[];
                    }
                    $exp_grade=(isset($expertise_info_data['expertise_grade']) && !empty($expertise_info_data['expertise_grade']))?$expertise_info_data['expertise_grade']:NULL;
                    $expertise_data[]=[
                        'expertise'=>$expertise_info_data['expertise'],
                        'expertise_dept'=>$expertise_info_data['expertise_dept'],
                        'expertise_grade'=>$exp_grade,
                        'all_expertise_dept_By_expertise'=>$exp_dept_data,
                    ];
                }
            }
        }

        $artist_info_show->artist_expertise_info=!empty($expertise_data)?json_encode($expertise_data):'';
        // artist rate chart
        $rate_chart_data=[];
        if(!empty($artist_info_show->artist_rate_chart_info)){
            $rate_chart_info= json_decode($artist_info_show->artist_rate_chart_info,true);
            foreach ($rate_chart_info as $rate_chart_info_data){
                //dd($rate_chart_info_data['artist_hounoriam_ctg']);
                if($rate_chart_info_data['is_active']==1){
                    $artist_rate_chart_discription= $artist_honouriam_discription= All_stting::get_settings_info
                    (['parent_id'=>$rate_chart_info_data['artist_hounoriam_ctg'],
                        'is_active'=>1]);
                    $artist_rate_chart_discription_grade= All_stting::artist_grade_description
                    (['description'=>$rate_chart_info_data['chart_description'],
                        'is_active'=>1]);

                    if(!empty($artist_rate_chart_discription)){
                        $artist_rate_chart_discription_data=$artist_rate_chart_discription;
                    }else{
                        $artist_rate_chart_discription_data=[];
                    }
                    if(!empty($artist_rate_chart_discription_grade)){
                        $artist_rate_chart_discription_grade_data=$artist_rate_chart_discription_grade;
                    }else{
                        $artist_rate_chart_discription_grade_data=[];
                    }


                    $rate_chart_data[]=[
                        'artist_hounoriam_ctg'=>$rate_chart_info_data['artist_hounoriam_ctg'],
                        'chart_description'=>$rate_chart_info_data['chart_description'],
                        'artist_grade'=>$rate_chart_info_data['artist_grade'],
                        'chart_description_data'=>$artist_rate_chart_discription_data,
                        'chart_description_grade_data'=>$artist_rate_chart_discription_grade_data,
                    ];
                }
            }
        }
        $artist_info_show->artist_rate_chart_info=!empty($rate_chart_data)?json_encode($rate_chart_data):'';

        return view('program.artist_record_update',['program_ctg'=>$program_ctg,'program_info'=>$program_info,'nationality'=>$nationality_info,'station_info'=>$station_info,'all_district'=>$district_info,'artist_exp'=>$artist_exp,'artist_exp_type'=>$artist_exp_type,'expertise_dept'=>$expertise_dept,'national_award_info'=>$national_award_info,'occupation_info'=>$occupation_info,'bank_info'=>$bank_info,'artist_info_show' => $artist_info_show,'artist_grade_info'=>$artist_grade_info]);


    }

    public function artist_record_view($id) {

        $artist_exp_type = All_stting::get_settings_info(['type'=>6,'is_active'=>1]);
        $program_ctg = All_stting::get_settings_info(['type'=>15,'is_active'=>1]);
        $artist_exp = All_stting::get_settings_info(['type'=>18,'is_active'=>1]);
        $expertise_dept = All_stting::get_settings_info(['type'=>6,'is_active'=>1]);
        $occupation_info = All_stting::get_settings_info(['type'=>22,'is_active'=>1]);
        $program_info = Program_schedule_info::program_info_by_status(['status'=>4]);
        $artist_grade_info = All_stting::get_artist_grade_info(['type'=>1]);
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);

        $artist_info_show = All_stting::get_artist_info(['program_artist_info.id'=>$id]);
        $work_area = All_stting::get_settings_info(['type'=>18,'is_active'=>1]);
        $artist_work_area_info = All_stting::get_artist_work_area_info(['program_planning_artist_infos.artist_id'=>$id]);



        $expertise_data=[];
        if(!empty($artist_info_show->artist_expertise_info)){
            $expertise_info= json_decode($artist_info_show->artist_expertise_info,true);
            foreach ($expertise_info as $expertise_info_data){
                if($expertise_info_data['is_active']==1){
                    $artist_expertise_department= All_stting::get_settings_info(['parent_id'=>$expertise_info_data['expertise'],'is_active'=>1]);
                    if(!empty($artist_expertise_department)){
                        $exp_dept_data=$artist_expertise_department;
                    }else{
                        $exp_dept_data=[];
                    }
                    $exp_grade=(isset($expertise_info_data['expertise_grade']) && !empty($expertise_info_data['expertise_grade']))?$expertise_info_data['expertise_grade']:NULL;

                    $expertise_data[]=[
                        'expertise'=>(!empty($expertise_info_data['expertise']))?$expertise_dept[$expertise_info_data['expertise']]:'',
                        'expertise_dept'=>(!empty($expertise_info_data['expertise_dept']))?
                            $exp_dept_data[$expertise_info_data['expertise_dept']]:'',
                        'expertise_grade'=>(!empty($exp_grade))?$artist_grade_info[$exp_grade]:'',
                    ];
                }
            }
        }
        $artist_info_show->artist_expertise_info=!empty($expertise_data)?json_encode($expertise_data):'';
        // artist rate chart
//        $rate_chart_data=[];
//        if(!empty($artist_info_show->artist_rate_chart_info)){
//            $rate_chart_info= json_decode($artist_info_show->artist_rate_chart_info,true);
//            foreach ($rate_chart_info as $rate_chart_info_data){
//                if($rate_chart_info_data['is_active']==1){
//                    $artist_rate_chart_discription= $artist_honouriam_discription= All_stting::get_settings_info
//                    (['parent_id'=>$rate_chart_info_data['artist_hounoriam_ctg'],
//                        'is_active'=>1]);
//                    $artist_rate_chart_discription_grade= All_stting::artist_grade_description
//                    (['description'=>$rate_chart_info_data['chart_description'],
//                        'is_active'=>1]);
//
//                    $rate_chart_data[]=[
//                        'artist_hounoriam_ctg'=>(!empty($rate_chart_info_data['artist_hounoriam_ctg']))
//                            ?$program_ctg[$rate_chart_info_data['artist_hounoriam_ctg']]:'',
//                        'chart_description'=>(!empty($rate_chart_info_data['chart_description']))
//                            ?$artist_rate_chart_discription[$rate_chart_info_data['chart_description']]:'',
//                        'artist_grade'=>(!empty($rate_chart_info_data['artist_grade']))
//                            ?$artist_rate_chart_discription_grade[$rate_chart_info_data['artist_grade']]:'',
//                    ];
//                }
//            }
//        }
//
//        $artist_info_show->artist_rate_chart_info=!empty($rate_chart_data)?json_encode($rate_chart_data):'';
//
        return view('program.artist_record_view',['program_ctg'=>$program_ctg,'program_info'=>$program_info,'artist_exp'=>$artist_exp,'artist_exp_type'=>$artist_exp_type,'expertise_dept'=>$expertise_dept,'occupation_info'=>$occupation_info,'artist_info_show' => $artist_info_show,'artist_grade_info'=>$artist_grade_info,'station_info'=>$station_info,'artist_work_area_info'=>$artist_work_area_info,'work_area_info_data'=>$work_area]);


    }



    public function rep_artist_record(request $request){

        $artist_exp_type = All_stting::get_settings_info(['type'=>6,'is_active'=>1]);
        $artist_exp_type_department = All_stting::get_settings_info(['type'=>20,'is_active'=>1]);
        $work_area = All_stting::get_settings_info(['type'=>18,'is_active'=>1]);
        $artist_grade_info = All_stting::get_artist_grade_info(['type'=>1]);
        if(!empty($request->artist_status)) {
            $param['program_artist_info.is_active'] = $request->artist_status;
        }
        if(!empty($request->station_id)) {
            $param['program_artist_info.station_id'] = $request->station_id;
        }
        if(!empty($request->expertise)) {
            $param['expertise_id'] = $request->expertise;
        }
        if(!empty($request->expertise_dept)) {
            $param['expertise_dept'] = $request->expertise_dept;
        }
        if(!empty($request->exp_grade_id)) {
            $param['expertise_id'] = $request->exp_grade_id;
        }
        if(!empty($request->artist_info_search_data_id)) {
            $param['program_artist_info.id'] = $request->artist_info_search_data_id;
        }

        if(empty($param)){
            return '<div style="color:red;text-align:center;font-weight:bold;padding-bottom:10px; ">Minimum one searching item is required</div>';
        }
        $program_artist_info = All_stting::get_program_artist_info($param);
        return view('program.report.rep_artist_record',['program_artist_info'=>$program_artist_info,
            'artist_exp_type'=>$artist_exp_type,'artist_grade_info'=>$artist_grade_info,
            'artist_exp_type_department'=>$artist_exp_type_department,'work_area_info_data'=>$work_area]);
    }

    public function save_artist_info(request $request) {
        //dd($request);
        $validation = Validator::make($request->all(), [
            'station_id' => 'required',
            'artist_name_bn'  => 'required',
        ]);
        $error_array = array();
        $success_output = '';
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }else {
            $expertise_info=[];
          //  $artist_honouriam_info=[];
            if(!empty($request->expertise)){
                foreach ($request->expertise as $key=>$row){
                    $expertise_info[]=[
                        'expertise'  => $row,
                        'expertise_dept'  => $request->expertise_dept[$key],
                        'expertise_dept'  => $request->expertise_dept[$key],
                        'expertise_grade'  => $request->expertise_grade[$key],
                        'is_active'  => 1,
                        'created_by'=>(!empty(Session::get('user_info')->employee_primary_id)?Session::get('user_info')
                            ->employee_primary_id:NULL),
                        'created_time'=>date('Y-m-d H:i:s'),
                        'created_ip'=>(!empty(Employee::getIp()))?Employee::getIp():$request->ip()
                    ];
                }
            }
            if(empty($request->mobile_no[0])){
                $error_array[] = 'Mobile No is required';
            }
//            if(!empty($request->artist_hounoriam_ctg)){
//                foreach ($request->artist_hounoriam_ctg as $key=>$row){
//                    $artist_honouriam_info[]=[
//                        'artist_hounoriam_ctg'  => $row,
//                        'chart_description'  => $request->chart_description[$key],
//                        'artist_grade'  => $request->artist_grade[$key],
//                        'is_active'  => 1,
//                        'created_by'=>(!empty(Session::get('user_info')->employee_primary_id)?Session::get('user_info')
//                            ->employee_primary_id:NULL),
//                        'created_time'=>date('Y-m-d H:i:s'),
//                        'created_ip'=>(!empty(Employee::getIp()))?Employee::getIp():$request->ip()
//                    ];
//                }
//            }
            $destinationImagePath = 'fontView/assets/artist_image';
            if (!empty($request->file('picture'))) {
                $image = $request->file('picture');
                $image_size = ($request->file('picture')->getSize() / 1024);
                if ($image_size >= 2048) {
                    $error_array[] = 'Maximum Image size is 2 MB';
                }
                $image->getClientOriginalName();
                $extension = $image->getClientOriginalExtension();
                if (empty($request->old_image)) {
                    $file_name = time() . "." . $extension;
                } else {
                    $file_name = $request->old_image;
                }
                $image->move($destinationImagePath, $file_name);
                $image = Image::make($destinationImagePath . "/" . $file_name);
                $x = $image->width();
                $y = $image->height();
                if ($x > 300 || $y > 300) {
                    if ($x > $y) {
                        $image->resize(300, ($y / $x) * 300);
                    } else {
                        $image->resize(($x / $y) * 300, 300);
                    }
                }
                $image->save($destinationImagePath . "/" . $file_name);

            } elseif ($request->old_image != '') {
                $file_name = $request->old_image;
            } else {
                $file_name = '';
            }
            /*
            if (empty($file_name)) {
                $error_array[] = 'The Image is required';
            }
            */

            $destinationImagePathSignature = 'fontView/assets/artist_signature';
            if (!empty($request->file('signature'))) {
                $image = $request->file('signature');
                $image_size = ($request->file('signature')->getSize() / 1024);
                if ($image_size >= 2048) {
                    $error_array[] = 'Maximum Image size is 2 MB';
                }
                $image->getClientOriginalName();
                $extension = $image->getClientOriginalExtension();
                if (empty($request->old_signature)) {
                    $file_name_signature = time() . "." . $extension;
                } else {
                    $file_name_signature = $request->old_signature;
                }
                $image->move($destinationImagePathSignature, $file_name_signature);
                $image = Image::make($destinationImagePathSignature . "/" . $file_name_signature);
                $x = $image->width();
                $y = $image->height();
                if ($x > 300 || $y > 300) {
                    if ($x > $y) {
                        $image->resize(300, ($y / $x) * 300);
                    } else {
                        $image->resize(($x / $y) * 300, 300);
                    }
                }
                $image->save($destinationImagePathSignature . "/" . $file_name_signature);

            } elseif ($request->old_signature != '') {
                $file_name_signature = $request->old_signature;
            } else {
                $file_name_signature = '';
            }

            $exist_info=Program_schedule_info::exist_checking_artist_info(['station_id'=>$request->station_id,
                'name'=>$request->artist_name,'father_name'=>$request->father_name,
            'mother_name'=>$request->mother_name,'national_id'=>$request->national_id_no]);
            
           
            if(!empty($exist_info)){
                $success_output='Already Exist';
                $redirect='artist_record_view/'.$exist_info;
                $output = array(
                    'error'     =>  $error_array,
                    'success'   => $success_output ,
                    'redirect_page'   => $redirect
                );
                echo json_encode($output);
                exit;
            }
             //dd($exist_info);

            $atist_info=[
                'artist_id'=>Program_schedule_info::artist_id_generate($request->station_id),
                'picture'=>$file_name,
                'station_id'=>$request->station_id,
                'entry_date'=>date('Y-m-d'),
                'name'=>$request->artist_name,
                'name_bn'=>$request->artist_name_bn,
                'father_name'=>$request->father_name,
                'is_husband_wife'=>$request->husband_wife_type,
                'husband_wife_name'=>$request->husband_wife,
                'mother_name'=>$request->mother_name,
                'nationality'=>$request->nationality,
                'gender'=>$request->gender,
                'marital_status'=>$request->merital_status,
                // 'artist_type'=>$request->artist_ctg,
                'mobile'=>(!empty($request->mobile_no)?json_encode($request->mobile_no):''),
                'email'=>$request->email_address,
                'national_id'=>$request->national_id_no,
                // 'artist_grade'=>$request->artist_grade,
                'enlisted_date'=>(!empty($request->artist_recorded_date))?date('Y-m-d',strtotime($request->artist_recorded_date)):NULL,
                'enlisted_last_date'=>(!empty($request->last_grade_date))?date('Y-m-d',strtotime($request->last_grade_date)):NULL,
                'artist_district'=>$request->present_district,

                //   'is_ta_allowance'=>isset($request->ta_allowance)?1:NULL,
                // 'is_da_allowance'=>isset($request->da_allowance)?1:NULL,
                'address'=>$request->address_info,
                'educational_info'=>$request->educational_info,
                'is_active'=>(!empty($request->status)?$request->status:1),
                //      'song_type_grade_info'=>NULL,
                'created_by'=>(!empty(Session::get('user_info')->employee_primary_id)?Session::get('user_info')
                    ->employee_primary_id:NULL),
                'created_time'=>date('Y-m-d H:i:s'),
                'created_ip'=>(!empty(Employee::getIp()))?Employee::getIp():$request->ip(),

                'artist_short_name'=>$request->artist_short_name,
                'national_awarded'=>$request->national_awarded,
                'artist_type'=>$request->artist_ctg,
                'artist_doptor'=>$request->artist_doptor,

                'artist_occupation'=>$request->artist_occupation,
                'fb_id_link'=>$request->fb_id_link,
                'bank_name'=>$request->bank_name,
                'bank_branch_name'=>$request->bank_branch_name,
                'bank_account_no'=>$request->bank_account_no,
                'fixed_amount'=>$request->fixed_amount,
                'per_day_amount'=>$request->per_day_amount,
                'total_days'=>$request->total_days,
                'artist_expertise_info'=>(!empty($expertise_info)?json_encode($expertise_info):NULL),
             //   'artist_rate_chart_info'=>(!empty($artist_honouriam_info)?json_encode($artist_honouriam_info):NULL),
                'previous_station_id'=>(!empty($request->previous_station_id)?json_encode($request->previous_station_id):NULL),
                'staff_id'=>(!empty($request->staff_id)?$request->staff_id:NULL),

                'artist_signature'=>(!empty($file_name_signature)?$file_name_signature:NULL),
                
                'birth_certificate_id'=>$request->birth_certificate_id,
                'artist_old_id'=>$request->old_artist_no,

            ];

            if(empty($error_array)){
                DB::beginTransaction();
                if(isset($request->setting_id)) {
                    unset($atist_info['created_by'],$atist_info['created_time'],$atist_info['created_ip']);
                    DB::table('program_artist_info')
                        ->where([
                            'id' => $request->setting_id
                        ])
                        ->update($atist_info);
                         $success_output = 'Successfully update information';
                }else {
                    //echo $success_output;
                   // dd($atist_info);
                    DB::table('program_artist_info')->insert($atist_info);
                    $success_output = 'Successfully save information';
                }
                DB::commit();
               
            }

        }
        $output = array(
            'error'     =>  $error_array,
            'success'   => $success_output ,
            'redirect_page'   => 'artist_record_add'
        );
        echo json_encode($output);
    }
    public function update_artist_info(request $request) {

        $validation = Validator::make($request->all(), [
            'station_id' => 'required',
            'artist_name'  => 'required',
            'mobile_no'  => 'required',
        ]);
        $error_array = array();
        $success_output = '';
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }else {
            $expertise_info=[];
            $artist_honouriam_info=[];
            if(!empty($request->expertise)){
                foreach ($request->expertise as $key=>$row){
                    $expertise_info[]=[
                        'expertise'  => $row,
                        'expertise_dept'  => $request->expertise_dept[$key],
                        'expertise_grade'  => $request->expertise_grade[$key],
                        'is_active'  => 1,
                        'created_by'=>(!empty(Session::get('user_info')->employee_primary_id)?Session::get('user_info')
                            ->employee_primary_id:NULL),
                        'created_time'=>date('Y-m-d H:i:s'),
                        'created_ip'=>(!empty(Employee::getIp()))?Employee::getIp():$request->ip()
                    ];
                }
            }
//            if(!empty($request->artist_hounoriam_ctg)){
//                foreach ($request->artist_hounoriam_ctg as $key=>$row){
//                    $artist_honouriam_info[]=[
//                        'artist_hounoriam_ctg'  => $row,
//                        'chart_description'  => $request->chart_description[$key],
//                        'artist_grade'  => $request->artist_grade[$key],
//                        'is_active'  => 1,
//                        'created_by'=>(!empty(Session::get('user_info')->employee_primary_id)?Session::get('user_info')
//                            ->employee_primary_id:NULL),
//                        'created_time'=>date('Y-m-d H:i:s'),
//                        'created_ip'=>(!empty(Employee::getIp()))?Employee::getIp():$request->ip()
//                    ];
//                }
//            }
            $destinationImagePath = 'fontView/assets/artist_image';
            if (!empty($request->file('picture'))) {
                $image = $request->file('picture');
                $image_size = ($request->file('picture')->getSize() / 1024);
                if ($image_size >= 2048) {
                    $error_array[] = 'Maximum Image size is 2 MB';
                }
                $image->getClientOriginalName();
                $extension = $image->getClientOriginalExtension();
                if (empty($request->old_image)) {
                    $file_name = $request->setting_id . "." . $extension;
                } else {
                    $file_name = $request->old_image;
                }

                $image->move($destinationImagePath, $file_name);
                $image = Image::make($destinationImagePath . "/" . $file_name);
                $x = $image->width();
                $y = $image->height();
                if ($x > 300 || $y > 300) {
                    if ($x > $y) {
                        $image->resize(300, ($y / $x) * 300);
                    } else {
                        $image->resize(($x / $y) * 300, 300);
                    }
                }
                $image->save($destinationImagePath . "/" . $file_name);

            } elseif ($request->old_image != '') {
                $file_name = $request->old_image;
            } else {
                $file_name = '';
            }

            $destinationImagePathSignature = 'fontView/assets/artist_signature';
            if (!empty($request->file('signature'))) {
                $image = $request->file('signature');
                $image_size = ($request->file('signature')->getSize() / 1024);
                if ($image_size >= 2048) {
                    $error_array[] = 'Maximum Image size is 2 MB';
                }
                $image->getClientOriginalName();
                $extension = $image->getClientOriginalExtension();
                if (empty($request->old_signature)) {
                    $file_name_signature = time() . "." . $extension;
                } else {
                    $file_name_signature = $request->old_signature;
                }
                $image->move($destinationImagePathSignature, $file_name_signature);
                $image = Image::make($destinationImagePathSignature . "/" . $file_name_signature);
                $x = $image->width();
                $y = $image->height();
                if ($x > 300 || $y > 300) {
                    if ($x > $y) {
                        $image->resize(300, ($y / $x) * 300);
                    } else {
                        $image->resize(($x / $y) * 300, 300);
                    }
                }
                $image->save($destinationImagePathSignature . "/" . $file_name_signature);

            } elseif ($request->old_signature != '') {
                $file_name_signature = $request->old_signature;
            } else {
                $file_name_signature = '';
            }




//            dd($request);

            $atist_info=[
                'picture'=>$file_name,
                'station_id'=>$request->station_id,
                'entry_date'=>date('Y-m-d'),
                'name'=>$request->artist_name,
                'name_bn'=>$request->artist_name_bn,
                'father_name'=>$request->father_name,
                'is_husband_wife'=>$request->husband_wife_type,
                'husband_wife_name'=>$request->husband_wife,
                'mother_name'=>$request->mother_name,
                'nationality'=>$request->nationality,
                'gender'=>$request->gender,
                'marital_status'=>$request->merital_status,
                // 'artist_type'=>$request->artist_ctg,
                'mobile'=>(!empty($request->mobile_no)?json_encode($request->mobile_no):''),
                'email'=>$request->email_address,
                'national_id'=>$request->national_id_no,
                'educational_info'=>$request->educational_info,
                // 'artist_grade'=>$request->artist_grade,

                'enlisted_date'=>(!empty($request->artist_recorded_date))?date('Y-m-d',strtotime($request->artist_recorded_date)):NULL,
                'enlisted_last_date'=>(!empty($request->last_grade_date))?date('Y-m-d',strtotime($request->last_grade_date)):NULL,
                'artist_district'=>$request->present_district,

                //   'is_ta_allowance'=>isset($request->ta_allowance)?1:NULL,
                // 'is_da_allowance'=>isset($request->da_allowance)?1:NULL,
                'address'=>$request->address_info,
                'is_active'=>$request->status,
                //      'song_type_grade_info'=>NULL,
                'created_by'=>(!empty(Session::get('user_info')->employee_primary_id)?Session::get('user_info')
                    ->employee_primary_id:NULL),
                'created_time'=>date('Y-m-d H:i:s'),
                'created_ip'=>(!empty(Employee::getIp()))?Employee::getIp():$request->ip(),

                'artist_short_name'=>$request->artist_short_name,
                'national_awarded'=>$request->national_awarded,
                'artist_type'=>$request->artist_ctg,
                'artist_doptor'=>$request->artist_doptor,

                'artist_occupation'=>$request->artist_occupation,
                'fb_id_link'=>$request->fb_id_link,
                'bank_name'=>$request->bank_name,
                'bank_branch_name'=>$request->bank_branch_name,
                'bank_account_no'=>$request->bank_account_no,
                'fixed_amount'=>$request->fixed_amount,
                'per_day_amount'=>$request->per_day_amount,
                'total_days'=>$request->total_days,
                'artist_expertise_info'=>(!empty($expertise_info)?json_encode($expertise_info):NULL),
              //  'artist_rate_chart_info'=>(!empty($artist_honouriam_info)?json_encode($artist_honouriam_info):NULL),
                'previous_station_id'=>(!empty($request->previous_station_id)?json_encode($request->previous_station_id):NULL),
                'staff_id'=>(!empty($request->staff_id)?$request->staff_id:NULL),
                'artist_signature'=>(!empty($file_name_signature)?$file_name_signature:NULL),
                
                'birth_certificate_id'=>$request->birth_certificate_id,
                'artist_old_id'=>$request->old_artist_no


            ];
            //dd($atist_info);


            DB::beginTransaction();
            if(isset($request->setting_id)) {
                DB::table('program_artist_info')
                    ->where([
                        'id' => $request->setting_id
                    ])
                    ->update($atist_info);
            }

            DB::commit();
            $success_output = 'Successfully update information';

        }
        $output = array(
            'error'     =>  $error_array,
            'success'   => $success_output ,
            'redirect_page'   => 'artist_record'
        );
        echo json_encode($output);
    }
    public function save_artist_attachment(request $request) {

        $validation = Validator::make($request->all(), [
            'artist_id' => 'required',
        ]);
        $error_array = array();
        $success_output = '';
        $redirect = '';
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }else {
            $destinationImagePath = 'fontView/assets/artist_promanok';
            if (!empty($request->file('promanok_file'))) {
                $image = $request->file('promanok_file');
                $image_size = ($request->file('promanok_file')->getSize() / 1024);
                if ($image_size >= 10240) {
                    $error_array[] = 'Maximum Image size is 10 MB';
                }
                $image->getClientOriginalName();
                $extension = $image->getClientOriginalExtension();
                if (empty($request->old_image)) {
                    $file_name = $request->artist_id ."_". time()."." . $extension;
                } else {
                    $file_name = $request->old_image;
                }

                $image->move($destinationImagePath, $file_name);

            } elseif ($request->old_image != '') {
                $file_name = $request->old_image;
            } else {
                $file_name = '';
            }
            if(empty($file_name)){
                $error_array[] = 'প্রমানক ফাইল সংযুক্ত করুন';
            }
            $artist_info_show = All_stting::get_artist_info(['program_artist_info.id'=>$request->artist_id]);
            $all_promanok_file=(!empty($artist_info_show->promanok_file))?json_decode
            ($artist_info_show->promanok_file,true):NULL;

            $atist_attachment_info=[
                'id'=>(!empty($all_promanok_file))?count($all_promanok_file)+1:1,
                'file_info'=>$file_name,
                'file_tile'=>$request->promanok_file_title,
                'is_active'=>1,
                'created_by'=>(!empty(Session::get('user_info')->employee_primary_id)?Session::get('user_info')
                    ->employee_primary_id:NULL),
                'created_time'=>date('Y-m-d H:i:s'),
                'created_ip'=>(!empty(Employee::getIp()))?Employee::getIp():$request->ip(),
            ];

            $all_promanok_file[] = $atist_attachment_info;
            $artist_info=[

                    'promanok_file'=>(!empty($all_promanok_file))?json_encode($all_promanok_file,JSON_UNESCAPED_UNICODE):NULL,
                    'updated_by'=>(!empty(Session::get('user_info')->employee_primary_id)?Session::get('user_info')
                        ->employee_primary_id:NULL),
                    'updated_time'=>date('Y-m-d H:i:s'),
                    'updated_ip'=>(!empty(Employee::getIp()))?Employee::getIp():$request->ip(),
                ];
            DB::beginTransaction();
                if(empty($error_array)) {
                    DB::table('program_artist_info')
                        ->where([
                            'id' => $request->artist_id
                        ])
                        ->update($artist_info);
                    $success_output = 'Successfully update information';
                    $redirect="artist_record_attachment/".$request->artist_id;
                }
            DB::commit();

        }
        $output = array(
            'error'     =>  $error_array,
            'success'   => $success_output ,
            'redirect_page'   => $redirect
        );
        echo json_encode($output);
    }
    public function artist_record_attachment($id){
        $artist_info_show = All_stting::get_artist_info(['program_artist_info.id'=>$id]);
        $page_title=' শিল্পীর প্রমানক ফাইল';
        return view('program.artist_record_attachment',
            [
                'artist_info_show'=>$artist_info_show,
                'page_title'=>$page_title
            ]
        );
    }

    public function show_artist_grade(request $request){
        $artist_grade_info=Program_schedule_info::arist_grade_by_type($request->song_ctg_id);
        if(!empty($artist_grade_info)){
            echo json_encode(['status'=>'success','data'=>$artist_grade_info]);
        }else{
            echo json_encode(['status'=>'error','data'=>'']);
        }
    }
    public function program_magazine_create(){
        $employee_info = Employee::get_employee_info_name(['is_active'=>1]);
        $get_program_planning_info=Program_schedule_info::get_program_planning_info(['program_planning_infos.is_active'=>1]);
        $page_title=' পরিকল্পনা (Planning)';
        return view('program.program_magazine_create',
            [
                'employee_info'=>$employee_info,
                'get_program_planning_info'=>$get_program_planning_info,
                'page_title'=>$page_title
            ]
        );
    }
    public function program_proposal_khata(){
        $page_title=' পরিকল্পনা খাতা';
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);
        $all_program_name = All_stting::all_program_name();
        return view('program.report.program_planning_khata',
            [
                'page_title'=>$page_title,
                'all_program_name'=>$all_program_name,
                'station_info' => $station_info
            ]
        );
    }
    public function search_planning_info(request $request){
        if(empty($request->from_date)){
            return "From Date is required";
        }
        if(empty($request->to_date)){
            return "To Date is required";
        }
        $program_info = All_stting::get_program_info_searching($request,1);
        $employee_info = Employee::get_employee_info_name();
        $program_heading_info =Program_schedule_info::get_program_heading_info([
            'program_planning_infos.station_id'=>$request->station_id,
            'program_planning_infos.sub_station_id'=>$request->fequency_id
        ]) ;
        $program_heading_fixed_data=[
          'title'=>'অনুষ্ঠান পরিকল্পনা',
          'date_range'=>eng2bnNumber($request->from_date .' হতে '.$request->to_date),
        ];

        return view('program.report.program_planning_khata_info',
            [
                'heading_info' => $program_heading_info,
                'heading_fixed_data' => $program_heading_fixed_data,
                'program_info_data' => $program_info,
                'employee_info' => $employee_info,

            ]
        );

    }

    // proposal khata
    public function proposal_khata(){
        $page_title=' প্রস্তাব  খাতা ';
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);
        $all_program_name = All_stting::all_program_name();
        return view('program.report.proposal_khata',
            [
                'page_title'=>$page_title,
                'all_program_name'=>$all_program_name,
                'station_info' => $station_info
            ]
        );
    }
    public function proposal_khata_action(request $request){
        if(empty($request->from_date)){
            return "From Date is required";
        }
        if(empty($request->to_date)){
            return "To Date is required";
        }

        $program_info = All_stting::get_program_info_proposal_searching($request,2);
        $employee_info = Employee::get_employee_info_name();
        $program_heading_info =Program_schedule_info::get_program_heading_info([
            'program_planning_infos.station_id'=>$request->station_id,
            'program_planning_infos.sub_station_id'=>$request->fequency_id
        ]) ;
        $program_heading_fixed_data=[
            'title'=>'অনুষ্ঠান প্রস্তাব খাতা',
            'date_range'=>eng2bnNumber($request->from_date .' হতে '.$request->to_date),
        ];

        return view('program.report.proposal_khata_action',
            [
                'heading_info' => $program_heading_info,
                'heading_fixed_data' => $program_heading_fixed_data,
                'program_info' => $program_info,
                'employee_info' => $employee_info,
            ]
        );

    }

    // Contract khata
    public function contract_khata(){
        $page_title=' চুক্তিপত্র  খাতা ';
        return view('program.report.contract_khata',
            [
                'page_title'=>$page_title
            ]
        );
    }
    public function contract_khata_action(request $request){
        if(empty($request->from_date)){
            return "From Date is required";
        }
        if(empty($request->to_date)){
            return "To Date is required";
        }
        $program_info = All_stting::get_program_info_proposal_searching($request,3);
        $employee_info = Employee::get_employee_info_name();
        $page_heading = ' চুক্তিপত্র খাতা '.$request->from_date .' হতে '.$request->to_date ;
        return view('program.report.contract_khata_action',
            [
                'page_title' => $page_heading,
                'program_info' => $program_info,
                'employee_info' => $employee_info,
            ]
        );

    }


    // proposal khata presentation
    public function proposal_khata_presentation(){
        $page_title=' প্রস্তাব(Proposal) কাতা ';
        return view('program.presentation.report.proposal_khata_presentation',
            [
                'page_title'=>$page_title
            ]
        );
    }
    public function proposal_khata_presentation_action(request $request){

        if(empty($request->from_date)){
            return "From Date is required";
        }
        if(empty($request->to_date)){
            return "To Date is required";
        }
        $program_info = Program_schedule_info::get_program_presentation_info_proposal_searching($request,3);
        $employee_info = Employee::get_employee_info_name();
        $page_heading = ' প্রস্তাব খাতা '.$request->from_date .' হতে '.$request->to_date ;
        return view('program.presentation.report.proposal_khata_presentation_action',
            [
                'page_title' => $page_heading,
                'program_info' => $program_info,
                'employee_info' => $employee_info,
            ]
        );

    }

    // Recording / Performance khata
    public function recording_performance_khata(){
        $page_title='রেকর্ডিং/পারফরমেন্স  খাতা ';
        return view('program.report.recording_performance_khata',
            [
                'page_title'=>$page_title
            ]
        );
    }
    public function recording_performance_khata_action(request $request){
        if(empty($request->from_date)){
            return "From Date is required";
        }
        if(empty($request->to_date)){
            return "To Date is required";
        }
        $program_info = All_stting::get_program_info_proposal_searching($request,4);
        $employee_info = Employee::get_employee_info_name();
        $page_heading = ' রেকর্ডিং/পারফরমেন্স খাতা '.$request->from_date .' হতে '.$request->to_date ;
        return view('program.report.recording_performance_khata_action',
            [
                'page_title' => $page_heading,
                'program_info' => $program_info,
                'employee_info' => $employee_info,
            ]
        );

    }

    // Waiting Payment
    public function waiting_payment(){
        $page_title='Waiting For Payment';
        $param=[
          'from_date'=> '01-'.date('m-Y') ,
          'to_date'=> date('d-m-Y')
        ];
        $program_info = All_stting::get_program_info_proposal_searching($param,4,2);
        $employee_info = Employee::get_employee_info_name();
        return view('program.payment.waiting_payment',
            [
                'page_title'=>$page_title,
                 'program_info' => $program_info,
                'employee_info' => $employee_info,
            ]
        );
    }
    public function waiting_payment_action(request $request){
        if(empty($request->from_date)){
            return "From Date is required";
        }
        if(empty($request->to_date)){
            return "To Date is required";
        }
        $program_info = All_stting::get_program_info_proposal_searching($request,4,2);
        $employee_info = Employee::get_employee_info_name();
        $page_heading = ' Waiting For Payment '.$request->from_date .' To '.$request->to_date ;
        return view('program.payment.waiting_payment_action',
            [
                'page_title' => $page_heading,
                'program_info' => $program_info,
                'employee_info' => $employee_info,
            ]
        );

    }
    public function make_payment_action(request $request){
        if(empty($request->program_id)){
            return ['status'=>'error','message'=>'Minimum One id is required'];
        }
        $employee_id= !empty(Session::get('user_info')->employee_id)?Session::get('user_info')
            ->employee_id:NULL;
        if(empty($employee_id)){
            return ['status'=>'error','message'=>'Employee id is required'];
        }
        $i=0;
        foreach ($request->program_id as $key=> $artist_sommany_id){
            $payment_info=[
                'payment_status'=>3, // 2= pending,3=complete
                'payment_comments'=>$request->payment_comments[$key],
                'payment_complete_by'=>$employee_id,
                'payment_complete_date'=>date('Y-m-d H:i:s'),
                'payment_complete_ip'=> (!empty(Employee::getIp()))?Employee::getIp():$request->ip(),
            ];

            DB::table('program_planning_artist_infos')
                ->where([
                    'id' => $key,
                ])
                ->update($payment_info);
            $i++;
        }
        if($i>0){
            return ['status'=>'success','message'=>'Successfully, Make Payment'];
        }

    }

    // Complete Payment
    public function complete_payment(){
        $page_title='Complete For Payment';
        $param=[
            'from_date'=> '01-'.date('m-Y') ,
            'to_date'=> date('d-m-Y')
        ];
        $program_info = All_stting::get_program_info_proposal_searching($param,4,3);
        $employee_info = Employee::get_employee_info_name();
        return view('program.payment.complete_payment',
            [
                'page_title'=>$page_title,
                'program_info' => $program_info,
                'employee_info' => $employee_info
            ]
        );
    }
    public function complete_payment_action(request $request){
        if(empty($request->from_date)){
            return "From Date is required";
        }
        if(empty($request->to_date)){
            return "To Date is required";
        }
        $program_info = All_stting::get_program_info_proposal_searching($request,4,3);
        $employee_info = Employee::get_employee_info_name();
        $page_heading = ' Complete  Payment History '.$request->from_date .' To '.$request->to_date ;
        return view('program.payment.complete_payment_action',
            [
                'page_title' => $page_heading,
                'program_info' => $program_info,
                'employee_info' => $employee_info,
            ]
        );

    }




    public function program_magazine_create_form() {
        $program_ctg = All_stting::get_settings_info(['type'=>6,'is_active'=>1]);
        $program_type = All_stting::get_settings_info(['type'=>14,'is_active'=>1]); // ধরন
        $program_style = All_stting::get_settings_info(['type'=>15,'is_active'=>1]); // প্রকৃতি
        $program_description = All_stting::get_settings_info(['type'=>16,'is_active'=>1]); // বিবরন
        $atrist_info_info = Employee::get_artist_select();
        $program_info = Program_schedule_info::program_info_by_status(['status'=>1]);
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);
        $employee_info = Employee::get_employee_info_name(['is_active'=>1]);
        $get_program_planning_info=Program_schedule_info::get_program_planning_info(['program_planning_infos.is_active'=>1]);
        $get_fixed_program_type = DB::table('fixed_program_type')->where('parent_id','=',NULL)->get();
        return view('program.program_magazine_create_form',
            [
                'page_title'=>'Add Program Information',
                'program_ctg'=>$program_ctg,
                'atrist_info_info'=>$atrist_info_info,
                'program_info'=>$program_info,
                'station_info'=>$station_info,
                'program_description'=>$program_description,
                'program_style'=>$program_style,
                'program_type'=>$program_type,
                'employee_info'=>$employee_info,
                'get_program_planning_info'=>$get_program_planning_info,
                'get_fixed_program_type' => $get_fixed_program_type
            ]
        );
    }

    public function program_magazine_create_form_new() {
        $program_ctg = All_stting::get_settings_info(['type'=>15,'is_active'=>1]);
        $expertise_dept = All_stting::get_settings_info(['type'=>6,'is_active'=>1]);
        $get_rate_chart = DB::table("setup_artist_rate_chart")->
        leftJoin("all_sttings as main","main.id", "=", "setup_artist_rate_chart.ctg_id")->
        leftJoin("all_sttings as sub","sub.id", "=", "setup_artist_rate_chart.description")
            ->leftJoin("setup_artist_grade","setup_artist_grade.id","=","setup_artist_rate_chart.grade_id")
            ->where(["setup_artist_rate_chart.is_active"=>1])
            ->select("setup_artist_rate_chart.*","setup_artist_grade.title as grade_title","main.title as main_ctg_title","sub.title as sub_ctg_title")
            ->get();

        $program_type = All_stting::get_settings_info(['type'=>14,'is_active'=>1]); // ধরন
        $program_style = All_stting::get_settings_info(['type'=>15,'is_active'=>1]); // প্রকৃতি
        $program_description = All_stting::get_settings_info(['type'=>16,'is_active'=>1]); // বিবরন
        $program_description_sub = All_stting::get_settings_info(['type'=>19,'is_active'=>1]); // বিবরন
        // dd($program_description_sub);
        $work_area = All_stting::get_settings_info(['type'=>18,'is_active'=>1]);
        $artist_grade_info = All_stting::get_artist_grade_info(['type'=>1]);
        $atrist_info_info = Employee::get_artist_select();
        $program_info = Program_schedule_info::program_info_by_status(['status'=>1]);
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);
        $employee_info = Employee::get_employee_info_name(['is_active'=>1]);
        $get_program_planning_info=Program_schedule_info::get_program_planning_info(['program_planning_infos.is_active'=>1]);
        $get_fixed_program_type = DB::table('fixed_program_type')->where('parent_id','=',NULL)->get();

        return view('program.program_magazine_create_form_new',
            [
                'page_title'=>'Add Program Information',
                'program_ctg'=>$program_ctg,
                'atrist_info_info'=>$atrist_info_info,
                'program_info'=>$program_info,
                'station_info'=>$station_info,
                'program_description'=>$program_description,
                'program_description_sub'=>$program_description_sub,
                'program_style'=>$program_style,
                'program_type'=>$program_type,
                'employee_info'=>$employee_info,
                'get_program_planning_info'=>$get_program_planning_info,
                'get_fixed_program_type' => $get_fixed_program_type,
                'get_rate_chart' => $get_rate_chart,
                'work_area'=>$work_area,
                'expertise_dept' => $expertise_dept,
                'artist_grade_info' => $artist_grade_info
            ]
        );
    }
    public function program_magazine_update_form_new($id) {

        $program_ctg = All_stting::get_settings_info(['type'=>6,'is_active'=>1]);
        $get_rate_chart = DB::table("setup_artist_rate_chart")->
        join("all_sttings as main","main.id", "=", "setup_artist_rate_chart.ctg_id")->
        join("all_sttings as sub","sub.id", "=", "setup_artist_rate_chart.description")
            ->join("setup_artist_grade","setup_artist_grade.id","=","setup_artist_rate_chart.grade_id")
            ->where(["setup_artist_rate_chart.is_active"=>1])
            ->select("setup_artist_rate_chart.*","setup_artist_grade.title as grade_title","main.title as main_ctg_title","sub.title as sub_ctg_title")
            ->get();
        $program_type = All_stting::get_settings_info(['type'=>14,'is_active'=>1]); // ধরন
        $program_style = All_stting::get_settings_info(['type'=>15,'is_active'=>1]); // প্রকৃতি
        $program_description = All_stting::get_settings_info(['type'=>16,'is_active'=>1]); // বিবরন
        $program_description_sub = All_stting::get_settings_info(['type'=>19,'is_active'=>1]); // বিবরন
        $work_area = All_stting::get_settings_info(['type'=>18,'is_active'=>1]);
        $atrist_info_info = Employee::get_artist_select();
        $artist_grade_info = All_stting::get_artist_grade_info(['type'=>1]);
        $program_info = Program_schedule_info::program_info_by_status(['status'=>1]);
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);
        $employee_info = Employee::get_employee_info_name(['is_active'=>1]);

        $get_program_planning_info=DB::table("program_planning_infos")
            ->where(['program_planning_infos.id'=>$id,'program_planning_infos.is_active'=>1])
            ->first();

        $biboron_data = DB::table("program_planning_artist_infos")
            ->leftJoin("all_sttings as main","main.id", "=", "program_planning_artist_infos.artist_ctg_id")
            ->leftJoin("all_sttings as sub","sub.id", "=" , "program_planning_artist_infos.description_id")
            ->leftJoin("setup_artist_rate_chart as chart","chart.id", "=" , "program_planning_artist_infos.artist_rate_chart_id")
            ->leftJoin("program_artist_info","program_artist_info.id", "=" , "program_planning_artist_infos.artist_id")
            ->leftJoin("setup_artist_grade","setup_artist_grade.id", "=" , "program_planning_artist_infos.artist_grade")
            ->select("program_planning_artist_infos.*","main.title as main_title","sub.title as sub_title",
                "program_artist_info.name as artist_name",
                "setup_artist_grade.title as title",
                "chart.stability")
            ->where([
                'program_planning_artist_infos.planning_info_id' => $get_program_planning_info->id
            ])
            ->groupBy("program_planning_artist_infos.artist_rate_chart_id")
            ->get();


        $selected_artist = DB::table("program_planning_artist_infos")
            ->leftJoin("program_artist_info","program_planning_artist_infos.artist_id","=","program_artist_info.id")
            ->select("program_planning_artist_infos.*","program_artist_info.name")
            ->where([
                'planning_info_id' => $get_program_planning_info->id
            ])->get();


        // $artist_ids = [];
        foreach($biboron_data as $key => $value) {
            foreach($selected_artist as $artist){
                if($value->artist_rate_chart_id == $artist->artist_rate_chart_id){
                    if(!isset($biboron_data[$key]->artist_ids)){
                        $biboron_data[$key]->artist_ids = [];
                    }
                    $biboron_data[$key]->artist_ids[] = $artist->artist_id;
                }
            }
        }
        // dd($biboron_data);


        $get_fixed_program_type = DB::table('fixed_program_type')->where('parent_id','=',NULL)->get();
        $get_fixed_sub_program_type = DB::table('fixed_program_type')->where('parent_id','=',$get_program_planning_info->fixed_program_type_id)->get();
        // dd($get_fixed_sub_program_type);
        return view('program.program_magazine_update_form_new',
            [
                'page_title'=>'Add Program Information',
                'program_ctg'=>$program_ctg,
                'atrist_info_info'=>$atrist_info_info,
                'program_info'=>$program_info,
                'station_info'=>$station_info,
                'program_description'=>$program_description,
                'program_style'=>$program_style,
                'program_type'=>$program_type,
                'employee_info'=>$employee_info,
                'get_program_planning_info'=>$get_program_planning_info,
                'get_fixed_program_type' => $get_fixed_program_type,
                'get_rate_chart' => $get_rate_chart,
                'work_area'=>$work_area,
                'biboron_data' => $biboron_data,
                'fix_sub_program_type' => $get_fixed_sub_program_type,
                'selected_artist' => $selected_artist,
                'program_description_sub' => $program_description_sub,
                'artist_grade_info' => $artist_grade_info
            ]
        );

    }




    public function show_sub_fixed_program_type(request $request){
        $fixed_program_type_info=DB::table('fixed_program_type')
            ->where([
                'parent_id' => $request->fixed_type_id,
                'is_active' => 1,
            ])->pluck('name','id');
        if(!empty($fixed_program_type_info)){
            echo json_encode(['status'=>'success','data'=>$fixed_program_type_info]);
        }else{
            echo json_encode(['status'=>'error','data'=>'']);
        }
    }

    public function program_magazine_update_form($id) {
        $program_ctg = All_stting::get_settings_info(['type'=>6,'is_active'=>1]);
        $program_type = All_stting::get_settings_info(['type'=>14,'is_active'=>1]); // ধরন
        $program_style = All_stting::get_settings_info(['type'=>15,'is_active'=>1]); // প্রকৃতি
        $program_description = All_stting::get_settings_info(['type'=>16,'is_active'=>1]); // বিবরন
        $atrist_info_info = Employee::get_artist_select();
        $program_info = Program_schedule_info::program_info_by_status(['status'=>1]);
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);
        $employee_info = Employee::get_employee_info_name(['is_active'=>1]);
        $get_program_planning_info=DB::table('program_planning_infos')->where(['id'=>$id])->first();
        $get_fixed_program_type = DB::table('fixed_program_type')->get();
        $get_program_planning_info_artist=DB::table('program_planning_artist_infos')
            ->where(['planning_info_id'=>$get_program_planning_info->id,'is_active'=>1])->get();
        $selected_artist = [];
        foreach($get_program_planning_info_artist as $key => $value) {
            if(isset($selected_artist[$value->description_id])) {
                $selected_artist[$value->description_id][] = $value->artist_id;
            }
            else {
                $selected_artist[$value->description_id][] = $value->artist_id;
            }
        }
        $substation_info = DB::table('branch_infos')->where([
            'is_active' => 1,
            'parent_id' => (int) $get_program_planning_info->station_id
        ])->get();

        return view('program.program_magazine_update_form',
            [
                'program_ctg'=>$program_ctg,
                'atrist_info_info'=>$atrist_info_info,
                'program_info'=>$program_info,
                'station_info'=>$station_info,
                'program_description'=>$program_description,
                'program_style'=>$program_style,
                'program_type'=>$program_type,
                'employee_info'=>$employee_info,
                'program_plan'=>$get_program_planning_info,
                'setting_id' => $id,
                'substation_info' => $substation_info,
                'selected_artist' => $selected_artist,
                'get_fixed_program_type' => $get_fixed_program_type
            ]
        );
    }

    public function program_magazine_cost_form($id) {

        $program_ctg = All_stting::get_settings_info(['type'=>6,'is_active'=>1]);
        $program_type = All_stting::get_settings_info(['type'=>14,'is_active'=>1]); // ধরন
        $program_style = All_stting::get_settings_info(['type'=>15,'is_active'=>1]); // প্রকৃতি

        $atrist_info_info = Employee::get_artist_select();
        $program_info = Program_schedule_info::program_info_by_status(['status'=>1]);
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);
        $employee_info = Employee::get_employee_info_name(['is_active'=>1]);
        $get_program_planning_info=DB::table('program_planning_infos')->where(['id'=>$id])->first();
        $get_rate_chart = All_stting::get_artist_rate_chart();
        $artist_grade_info = All_stting::get_artist_grade_info(['type'=>1]);
        $get_program_planning_info_artist=DB::table('program_planning_artist_infos')
            ->where(['planning_info_id'=>$get_program_planning_info->id,'is_active'=>1])->get();
        $get_fixed_program_type = DB::table('fixed_program_type')->get();

        $selected_artist = [];
        foreach($get_program_planning_info_artist as $key => $value) {

            if(isset($selected_artist[$value->description_id])) {
                $selected_artist[$value->description_id]['artist_id'][] = $value->artist_id;
                $selected_artist[$value->description_id]['grade_id'][] = $value->artist_grade;
                $selected_artist[$value->description_id]['amount'][] = $value->artist_grade_amount;

                if( $value->artist_rate_chart_id>0 ) {
                    $chart_info = DB::table('setup_artist_rate_chart')
                        ->where(['id'=>$value->artist_rate_chart_id])->first();
                    $selected_artist[$value->description_id]['program_style_id'][] = $chart_info->ctg_id;
                    $selected_artist[$value->description_id]['description_id'][] = $chart_info->description;
                    $selected_artist[$value->description_id]['stability'][] = $chart_info->stability;
                }
                else {
                    $selected_artist[$value->description_id]['program_style_id'][] = null;
                    $selected_artist[$value->description_id]['description_id'][] = null;
                    $selected_artist[$value->description_id]['stability'][] = null;
                }

            }
            else {
                $selected_artist[$value->description_id] = [];
                $selected_artist[$value->description_id]['artist_id'][] = $value->artist_id;
                $selected_artist[$value->description_id]['grade_id'][] = $value->artist_grade;
                $selected_artist[$value->description_id]['amount'][] = $value->artist_grade_amount;

                if( $value->artist_rate_chart_id>0 ) {
                    $chart_info = DB::table('setup_artist_rate_chart')
                        ->where(['id'=>$value->artist_rate_chart_id])->first();
                    $selected_artist[$value->description_id]['program_style_id'][] = $chart_info->ctg_id;
                    $selected_artist[$value->description_id]['description_id'][] = $chart_info->description;
                    $selected_artist[$value->description_id]['stability'][] = $chart_info->stability;
                }
                else {
                    $selected_artist[$value->description_id]['program_style_id'][] = null;
                    $selected_artist[$value->description_id]['description_id'][] = null;
                    $selected_artist[$value->description_id]['stability'][] = null;
                }

            }
        }
        $descp=(!empty($selected_artist))?array_keys ($selected_artist):'';
        $program_description = All_stting::get_program_selected_description_info(['type'=>16,'is_active'=>1],$descp); // বিবরন
        $substation_info = DB::table('branch_infos')->where([
            'is_active' => 1,
            'parent_id' => (int) $get_program_planning_info->station_id
        ])->get();
        return view('program.program_magazine_cost_form',
            [
                'page_title'=>'Add Program Costing ',
                'program_ctg'=>$program_ctg,
                'atrist_info_info'=>$atrist_info_info,
                'program_info'=>$program_info,
                'station_info'=>$station_info,
                'program_description'=>$program_description,
                'program_style'=>$program_style,
                'program_type'=>$program_type,
                'employee_info'=>$employee_info,
                'program_plan'=>$get_program_planning_info,
                'setting_id' => $id,
                'substation_info' => $substation_info,
                'selected_artist' => $selected_artist,
                'grade_info' => $artist_grade_info,
                'get_rate_chart' => $get_rate_chart,
                'get_fixed_program_type' => $get_fixed_program_type
            ]
        );

    }

    public function save_program_magazine_cost(request $request) {

        $validation = Validator::make($request->all(), [
            'setting_id' => 'required',
        ]);

        $error_array = array();
        $success_output = '';
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        } else {

            DB::beginTransaction();
            $planing_info_id = $request->setting_id;
            if(!empty($request->program_description)) {
                foreach ($request->program_description as $description_id=> $row) {
                    if(!empty($row)) {
                        foreach($row['artist_id'] as $key => $art_id) {
                            $program_planning_artist_dtails = [
                                'artist_grade' => $row['grade_id'][$key],
                                'artist_grade_amount' => $row['amount'][$key],
                                'artist_ta_amount' => Null,
                                'artist_da_amount' => Null,
                                'is_active' => 1,
                                'updated_by' => (!empty(Session::get('user_info')->employee_primary_id)?Session::get('user_info')
                                    ->employee_primary_id:NULL),
                                'updated_time' => date('Y-m-d H:i:s'),
                                'updated_ip' => (!empty(Employee::getIp())) ? Employee::getIp() : $request->ip(),
                            ];

                            if($row['amount'][$key]>0) {

                                $rate_chart = DB::table('setup_artist_rate_chart')
                                    ->where(
                                        [
                                            'ctg_id' => $row['program_style_id'][$key],
                                            'grade_id' => $row['grade_id'][$key],
                                            'description' => $row['program_description_id'][$key],
                                            'stability' => $row['recording_stability'][$key],
                                            'is_active' => 1
                                        ]
                                    )
                                    ->first();

                                $program_planning_artist_dtails['artist_rate_chart_id'] = $rate_chart->id;
                            }

                            DB::table('program_planning_artist_infos')
                                ->where([
                                    'planning_info_id' => $planing_info_id,
                                    'description_id' => $description_id,
                                    'artist_id' => $art_id,
                                ])
                                ->update($program_planning_artist_dtails);
                        }
                    }
                }


            }
            DB::commit();
            $success_output = 'Successfully update information';

        }
        $output = array(
            'error'     =>  $error_array,
            'success'   => $success_output ,
            'redirect_page'   => ''
        );
        echo json_encode($output);
    }

    public function program_magazine_cost_view($id) {

        $employee_info = Employee::get_employee_info_name();
        $get_program_planning_info= All_stting::get_single_program_info(['program_planning_infos.id'=>$id]);
        $get_program_planning_info_artist= All_stting::get_single_program_artist_info(['program_planning_artist_infos.planning_info_id'=>$id,'program_planning_artist_infos.is_active'=>1]);

        $data_info_orgazizer=[];
        if(!empty($get_program_planning_info->program_organizer)){
            $program_organizer=json_decode($get_program_planning_info->program_organizer,true);
            foreach ($program_organizer as $key => $organizer_info){
                foreach ($organizer_info as $info_key=> $organizer) {
                    $data_info_orgazizer[$key][] = $employee_info[$organizer];
                }
            }
        }
        return view('program.program_magazine_cost_view',
            [
                'program_plan'=>$get_program_planning_info,
                'get_program_planning_info_artist'=>$get_program_planning_info_artist,
                'setting_id' => $id,
                'organizer_info' => $data_info_orgazizer,

            ]
        );

    }

    public function program_planning_approved(){
        $employee_info = Employee::get_employee_info_name(['is_active'=>1]);
        $get_program_planning_info=Program_schedule_info::get_program_planning_info(['program_planning_infos.is_active'=>2]);
        $page_title='প্রস্তাব (Proposal)';
        return view('program.program_planning_approved',['get_program_planning_info'=>$get_program_planning_info,'page_title'=>$page_title,'employee_info'=>$employee_info]);
    }
    public function program_proposal_approved() {

        $get_program_planning_info=Program_schedule_info::get_program_planning_info(['program_planning_infos.is_active'=>3]);
        $page_title='চুক্তি পত্র (Contract)';
        return view('program.program_proposal_approved',['get_program_planning_info'=>$get_program_planning_info,'page_title'=>$page_title]);
    }
    public function studio_booking_list() {

        $get_program_planning_info=Program_schedule_info::get_program_planning_info(['program_planning_infos.is_active'=>4]);
        $page_title='স্টুডিও বুকিং';

        return view('program.operation.studio_booking_list',['get_program_planning_info'=>$get_program_planning_info,'page_title'=>$page_title]);
    }
    public function gate_passed_list() {

        $get_program_planning_info_data=Program_schedule_info::get_gatepass_info(['program_planning_infos.is_active'=>4]);

        $get_program_planning_info=[];
        if(!empty($get_program_planning_info_data)) {
            foreach ($get_program_planning_info_data as $key => $info) {
                    if(!empty($info->recording_date_info)) {
                        $all_date = json_decode($info->recording_date_info, true);
                        foreach ($all_date as $child_key=>$record_date_info){
                            $date=(!empty($record_date_info['date'])?$record_date_info['date']:'');
                            if(!empty($date)) {
                                $get_program_planning_info[$date] = [
                                    'station_name' => $info->station_name,
                                    'gate_passed_date' => $date
                                ];
                            }
                        }
                    }

            }
        }
       // dd($get_program_planning_info);
        if(!empty($get_program_planning_info)) {
            usort($get_program_planning_info, function ($a1, $a2) {
                $value1 = strtotime($a1['gate_passed_date']);
                $value2 = strtotime($a2['gate_passed_date']);
                return $value2 - $value1;
            });
        }
        $page_title='গেইট পাস';
        return view('program.operation.gate_passed_list',['get_program_planning_info'=>$get_program_planning_info,'page_title'=>$page_title]);
    }

    public function program_recording_list() {

        $get_program_planning_info_data=Program_schedule_info::get_program_recording_list(['program_planning_infos.is_active'=>4,'program_planning_artist_infos.payment_status'=>1]);

        if(!empty($get_program_planning_info_data)) {
            foreach ($get_program_planning_info_data as $key => $info) {
                if(!empty($info->recording_date_info)) {
                    $all_date = json_decode($info->recording_date_info, true);
                    foreach ($all_date as $child_key=>$record_date_info){
                        if(!empty($record_date_info)) {
                            $get_program_planning_info[] = [
                                'id' => $info->id,
                                'station_name' => $info->station_name,
                                'program_identity' => $info->program_identity,
                                'program_name' => $info->program_name,
                                'program_type_title' => $info->program_type_title,
                                'artist_name' => $info->artist_name,
                                'artist_mobile' => $info->artist_mobile,
                                'address' => $info->address,
                                'record_date' => $record_date_info['date'],
                                'attend_date' => $record_date_info['attend_date'],
                                'recorded_time' => $record_date_info['time']
                            ];
                        }
                    }
                }

            }
        }
        if(!empty($get_program_planning_info)) {
            usort($get_program_planning_info, function ($a1, $a2) {
                $value1 = strtotime($a1['record_date']);
                $value2 = strtotime($a2['record_date']);
                return $value1 - $value2;
            });
        }else{
            $get_program_planning_info = [];
        }

        $page_title='রেকডিং লিস্ট';
        return view('program.program_recording_list',['get_program_planning_info'=>$get_program_planning_info,'page_title'=>$page_title]);
    }
    public function program_account_payment_pending_list() {
        $program_ctg = All_stting::get_settings_info(['type'=>6,'is_active'=>1]);
        $program_type = All_stting::get_settings_info(['type'=>14,'is_active'=>1]); // ধরন
        $program_style = All_stting::get_settings_info(['type'=>15,'is_active'=>1]); // প্রকৃতি
        $program_description = All_stting::get_settings_info(['type'=>16,'is_active'=>1]); // বিবরন
        $atrist_info_info = Employee::get_artist_select();
        $program_info = Program_schedule_info::program_info_by_status(['status'=>1]);
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);
        $employee_info = Employee::get_employee_info_name(['is_active'=>1]);
        $get_program_planning_info=Program_schedule_info::get_program_planning_info(['program_planning_infos.is_active'=>5]);
        $page_title='একাউন্টস সেকশান';
        return view('program.program_account_payment_pending_list',['program_ctg'=>$program_ctg,
            'atrist_info_info'=>$atrist_info_info,'program_info'=>$program_info,'station_info'=>$station_info,'program_description'=>$program_description,'program_style'=>$program_style,'program_type'=>$program_type,'employee_info'=>$employee_info,'get_program_planning_info'=>$get_program_planning_info,'page_title'=>$page_title]);
    }


    public function get_program_info(request $request){
        if(!empty($request->id)) {
            $program_info = Program_schedule_info::get_program_info(['program_planning_infos.id' =>
                $request->id]);
            echo json_encode(['status'=>'success','message'=>'successfully data found','data'=>$program_info]);
        }else{
            echo json_encode(['status'=>'error','message'=>'no data found','data'=>[]]);
        }
    }

    public function status_update_program_info(request $request){
     //   dd($request);
        if (!empty($request->id)) {
            $employee_id=Session::get('user_info')->employee_id;
            $employee_name=Session::get('user_info')->name;
            if(empty($employee_id)){
                return json_encode(['status' => 'error', 'message' => 'Employee Id is Required']);
            }
            $current_status=DB::table('program_planning_infos')->where('id', $request->id)->select('is_active','id')
                ->first();
         //   dd($current_status);
//            re planning
            $re_data['re_plan_by']= $employee_id;
            $re_data['re_plan_dt']= date('Y-m-d H:i:S');
            if($current_status->is_active==2 && $request->is_active==1) {
                $re_data['is_replanning']= 1;
                $data['replanning_info']= (!empty($re_data))?json_encode($re_data):NULL;
            }
            // reproposal
            if($current_status->is_active==3 && $request->is_active==2) {
                $re_data['is_replanning']= 1;
                $data['reproposal_info']= (!empty($re_data))?json_encode($re_data):NULL;
            }

            $message='Successfully Approved Information';
            $data['is_active']=(int)$request->is_active;
            $data['updated_time']= date('Y-m-d H:i:s');
            $data['updated_by']= !empty(Session::get('user_info')->employee_primary_id)?Session::get('user_info')
                ->employee_primary_id:NULL;
            if($request->is_active==2){
                $data['plan_approved_by']= $employee_id;
                $data['plan_approved_dt']= date('Y-m-d');
                $message='Successfully Approved Planning by '.$employee_name;
            }
            if($request->is_active==3){
                $data['proposal_approved_by']= $employee_id;
                $data['proposal_approved_dt']= date('Y-m-d');
                $message='Successfully  Proposal Approved by '.$employee_name;
            }
            if($request->is_active==4){
                $data['contract_approved_by']= $employee_id;
                $data['contract_approved_dt']= date('Y-m-d');
                $message='Successfully  Contract Approved by '.$employee_name;
            }
            if(!empty($data)) {
                DB::table('program_planning_infos')->where('id', $request->id)->update($data);
                return json_encode(['status' => 'success', 'message' => $message]);
            }else{
                return json_encode(['status' => 'error', 'message' => 'Failed, Approved information']);
            }
        } else {
            return json_encode(['status' => 'error', 'message' => 'Failed, Approved information']);
        }
    }
    public function status_update_presentation_info(request $request){
        if (!empty($request->month_id) && !empty($request->station_id) && !empty($request->is_active)) {
            $employee_id=Session::get('user_info')->employee_id;
            $employee_name=Session::get('user_info')->name;
            if(empty($employee_id)){
                return json_encode(['status' => 'error', 'message' => 'Employee Id is Required']);
            }
            $message='Successfully Approved Presentation Information';
            $data['is_active']=(int)$request->is_active;
            $data['updated_time']= date('Y-m-d H:i:s');
            $data['updated_by']= !empty(Session::get('user_info')->employee_primary_id)?Session::get('user_info')
                ->employee_primary_id:NULL;
            if($request->is_active==2){
                $data['plan_approved_by']= $employee_id;
                $data['plan_approved_dt']= date('Y-m-d H:i:s');
                $message='Successfully Approved Presentation Planning by '.$employee_name;
            }
            if($request->is_active==3){
                $data['proposal_approved_by']= $employee_id;
                $data['proposal_approved_dt']= date('Y-m-d H:i:s');
                $message='Successfully Presentation Proposal Approved by '.$employee_name;
            }
            if($request->is_active==4){
                $data['contract_approved_by']= $employee_id;
                $data['contract_approved_dt']= date('Y-m-d H:i:s');
                $message='Successfully  Presentation Contract Approved by '.$employee_name;
            }
            if(!empty($data)) {
                DB::table('program_presentation_infos')->where(['months'=> $request->month_id,'station_id'=>$request->station_id])->update($data);
                return json_encode(['status' => 'success', 'message' => $message]);
            }else{
                return json_encode(['status' => 'error', 'message' => 'Failed, Approved information']);
            }
        } else {
            return json_encode(['status' => 'error', 'message' => 'Failed, Approved information']);
        }
    }
    public function program_presentation_create()
    {
        $presentation_info=Program_schedule_info::get_all_presentation_info(['program_presentation_infos.is_active'=>1]);
        $employee_info = Employee::get_employee_info_name(['is_active'=>1]);
        return view('program.program_presentation_create',
            [
                'presentation_info'=>$presentation_info,
                'employee_info'=>$employee_info
            ]
        );
    }

    public function presentation_proposal_info()
    {
        $presentation_info=Program_schedule_info::get_all_presentation_info(['program_presentation_infos.is_active'=>2]);
        return view('program.presentation.presentation_proposal_info',
            [
                'presentation_info'=>$presentation_info,
            ]
        );
    }
    public function presentation_contract_info()
    {
        $presentation_info=Program_schedule_info::get_all_presentation_info(['program_presentation_infos.is_active'=>3]);
        return view('program.presentation.presentation_contract_info',
            [
                'presentation_info'=>$presentation_info,
            ]
        );
    }





    public function program_duty_officer_create(){
        $program_ctg = All_stting::get_settings_info(['type'=>6,'is_active'=>1]);
        $employee_info = Employee::get_employee_info_name(['is_active'=>1]);
        $program_info = Program_schedule_info::program_info_by_status(['status'=>1]);
        return view('program.program_duty_officer_create',['program_ctg'=>$program_ctg,'employee_info'=>$employee_info,'program_info'=>$program_info]);
    }
    public function program_log_writer_create(){
        $program_ctg = All_stting::get_settings_info(['type'=>6,'is_active'=>1]);
        $employee_info = Employee::get_employee_info_name(['is_active'=>1]);
        $program_info = Program_schedule_info::program_info_by_status(['status'=>1]);
        return view('program.program_log_writer_create',['program_ctg'=>$program_ctg,'employee_info'=>$employee_info,'program_info'=>$program_info]);
    }

    public function yearly_broadcast_program() {
        $program_info = Program_schedule_info::get_program_planning_info(['is_broadcast'=>1]);
        $fixed_program_type = DB::table('fixed_program_type')->get();
        // dd($program_info);
        return view('program.yearly_program_report',[
            'program_type'=>$fixed_program_type
        ]);
    }



    public function save_broadcast_info(request $request) {
        if(!empty($request->programid)) {
            $single_program_artist_info = All_stting::get_single_program_artist_info_by_id(['program_planning_artist_infos.id' => $request->programid]);
            if($single_program_artist_info->record_type==1){
               $date= $single_program_artist_info->live_date_log;
               $field='live_date_log';
            }elseif($single_program_artist_info->record_type==2){
                $date=$single_program_artist_info->record_date_log;
                $field='record_date_log';
            }
            if(!empty($date)){
                $de_date=json_decode($date,true);
                $key= array_search($request->record_date, array_column($de_date, 'date'));
                $de_date[$key]['attend_date']=$request->record_complete_date;
            }

            if(empty($request->programid)){
                return ['status'=>'error','message'=>'Artist Program is required'];
            }
            $employee_id= !empty(Session::get('user_info')->employee_id)?Session::get('user_info')
                ->employee_id:NULL;
            if(empty($employee_id)){
                return ['status'=>'error','message'=>'Employee id is required'];
            }
            $data = [
                $field => !empty($de_date)?json_encode($de_date):NULL,
                'recording_complete_date' => date('Y-m-d H:i:s'),
                'recording_complete_by' =>$employee_id,
            ];
            DB::table('program_planning_artist_infos')
                ->where([
                    'id'=>$request->programid,
                ])
                ->update($data);

            $output = array(
                'error'     =>  [],
                'success'   => 'Data Update Successfully' ,
                'redirect_page'   => ''
            );
            echo json_encode($output);

        }

    }

    public function recordingListToAccount(request $request) {
       // dd($request);
        if(!empty($request->id)) {
            $single_program_artist_info = All_stting::get_single_program_artist_info_by_id(['program_planning_artist_infos.id' => $request->id]);
            if($single_program_artist_info->planning_is_active!=4){
                echo  json_encode(['status'=>'error','message'=>'You are not eligible for update this information.']);
            }
            $employee_id= !empty(Session::get('user_info')->employee_id)?Session::get('user_info')
                ->employee_id:NULL;
            if(empty($employee_id)){
                echo  json_encode(['status'=>'error','message'=>'Employee id is required']);
            }
            $payment_info=[
                'payment_status'=>2, // 2= pending,3=complete
                'accounts_forwards_by'=>$employee_id,
                'accounts_forwards_dt'=>date('Y-m-d H:i:s'),
            ];

            DB::table('program_planning_artist_infos')
                ->where([
                    'id' => $request->id,
                ])
                ->update($payment_info);
            $output = array(
                'status'     =>  'success',
                'message'   => 'Data Update Successfully' ,
                'redirect_page'   => ''
            );
            echo json_encode($output);
        }


    }
    public function save_program_planning_info(request $request) {

        $validate_array =  [
            'program_name'  => 'required',
            'station_id' => 'required'
        ];

        if(isset($request->is_fixed_program)) {
            $validate_array['fixed_program_type'] = 'required';
        }

        $validation = Validator::make($request->all(),$validate_array);

        $error_array = array();
        $success_output = '';
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }else {

            $manage = [
                1=>[],
                2=>[],
                3=>[],
                4=>[],
                5=>[]
            ];

            $magazine_manage = $request->magazine_manage;

            foreach($manage as $key => $value) {
                if(isset($magazine_manage[$key])) {
                    $manage[$key] = $magazine_manage[$key];
                }
            }

            $program_planning_info = [
                'station_id' => $request->station_id,
                'program_identity' => Program_schedule_info::get_program_identity( $request->station_id) ,
                'entry_date'=>date('Y-m-d'),
                'fixed_program_type_id' => isset($request->is_fixed_program)? $request->fixed_program_type:NULL,
                'sub_fixed_program_type_id' => isset($request->sub_fixed_program_type)? $request->sub_fixed_program_type:NULL,

                'program_name'=>$request->program_name,
                'program_type'=>$request->program_type,
                'program_style'=>$request->program_style,
                'larget_viewer'=>$request->larget_viewer,
                'recorded_date'=>(!empty($request->recorded_date))?date('Y-m-d',strtotime($request->recorded_date)):NULL,
                'recorded_time'=>$request->recorded_time,
                'live_date'=>(!empty($request->live_date))?date('Y-m-d',strtotime($request->live_date)):NULL,
                'live_time'=>$request->live_time,
                'recording_date_is_plexibity'=>((isset($request->recording_date_is_plexibity) && !empty
                    ($request->recording_date_is_plexibity)) ?1:NULL),
                'recording_time_is_plexibity'=>((isset($request->recording_time_is_plexibity) && !empty
                    ($request->recording_time_is_plexibity)) ?1:NULL),
                'live_date_is_plexibity'=>((isset($request->live_date_is_plexibity) && !empty
                    ($request->live_date_is_plexibity)) ?1:NULL),
                'live_time_is_plexibity'=>((isset($request->live_time_is_plexibity) && !empty
                    ($request->live_time_is_plexibity)) ?1:NULL),


                'program_organizer' => json_encode($manage,true),
                'recording_stabilty'=>$request->recording_stabilty,
                'record_type'=>$request->record_type,
                'created_by'=>(!empty(Session::get('user_info')->employee_primary_id)?Session::get('user_info')
                    ->employee_primary_id:NULL),
                'created_time'=>date('Y-m-d H:i:s'),
                'created_ip'=>(!empty(Employee::getIp()))?Employee::getIp():$request->ip(),
            ];

            //  dd($program_planning_info);

            DB::beginTransaction();
            DB::table('program_planning_infos')->insert($program_planning_info);
            $id = DB::getPdo()->lastInsertId();
//            dd($request->program_description_id);
//            dd($request->artist_name_all);
            if(!empty($request->program_description_id)) {
                $program_planning_artist_dtails=[];
                foreach ($request->program_description_id as $key=> $row) {
                    if(!empty($request->artist_name_all[$key])) {
                        foreach($request->artist_name_all[$key] as $art_key => $art_id) {
                            $program_planning_artist_dtails[] = [
                                'planning_info_id' => $id,
                                'description_id' => $row,
                                'artist_id' => $art_id,
                                'artist_grade' => Null,
                                'artist_grade_amount' => Null,
                                'artist_ta_amount' => Null,
                                'artist_da_amount' => Null,
                                'is_active' => 1,
                                'created_by' => (!empty(Session::get('user_info')->employee_primary_id)?Session::get('user_info')
                                    ->employee_primary_id:NULL),
                                'created_time' => date('Y-m-d H:i:s'),
                                'created_ip' => (!empty(Employee::getIp())) ? Employee::getIp() : $request->ip(),
                            ];
                        }
                    }
                }
                //  dd($program_planning_artist_dtails);
                DB::table('program_planning_artist_infos')->insert($program_planning_artist_dtails);
            }


            DB::commit();
            $success_output = 'Successfully update information';

        }
        $output = array(
            'error'     =>  $error_array,
            'success'   => $success_output ,
            'redirect_page'   => 'program_magazine_create'
        );
        echo json_encode($output);

    }

    public function update_program_planning_info(request $request) {

        $validate_array =  [
            'setting_id' => 'required',
            'program_name'  => 'required',
            'station_id' => 'required'
        ];

        if(isset($request->is_fixed_program)) {
            $validate_array['fixed_program_type'] = 'required';
        }

        $validation = Validator::make($request->all(), $validate_array);
        $error_array = array();
        $success_output = '';
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }else {

            $manage = [
                1=>[],
                2=>[],
                3=>[],
                4=>[],
                5=>[]
            ];

            $magazine_manage = $request->magazine_manage;

            foreach($manage as $key => $value) {
                if(isset($magazine_manage[$key])) {
                    $manage[$key] = $magazine_manage[$key];
                }
            }

            $program_planning_info=[
                'station_id'=>$request->station_id,
                'office_id' => $request->office_id,
                'fixed_program_type_id' => isset($request->is_fixed_program)? $request->fixed_program_type:null,
                'sub_fixed_program_type_id' => isset($request->sub_fixed_program_type)? $request->sub_fixed_program_type:NULL,
                'program_name'=>$request->program_name,
                'program_type'=>$request->program_type,
                'program_style'=>$request->program_style,
                'larget_viewer'=>$request->larget_viewer,
                'recorded_date'=>(!empty($request->recorded_date))?date('Y-m-d',strtotime($request->recorded_date)):NULL,
                'recorded_time'=>$request->recorded_time,
                'live_date'=>(!empty($request->live_date))?date('Y-m-d',strtotime($request->live_date)):NULL,
                'live_time'=>$request->live_time,
                'recording_date_is_plexibity'=>((isset($request->recording_date_is_plexibity) && !empty
                    ($request->recording_date_is_plexibity)) ?1:NULL),
                'recording_time_is_plexibity'=>((isset($request->recording_time_is_plexibity) && !empty
                    ($request->recording_time_is_plexibity)) ?1:NULL),
                'live_date_is_plexibity'=>((isset($request->live_date_is_plexibity) && !empty
                    ($request->live_date_is_plexibity)) ?1:NULL),
                'live_time_is_plexibity'=>((isset($request->live_time_is_plexibity) && !empty
                    ($request->live_time_is_plexibity)) ?1:NULL),
                'program_organizer' => json_encode($manage,true),
                'recording_stabilty'=>$request->recording_stabilty,
                'record_type'=>$request->record_type,
                'updated_by'=>(!empty(Session::get('user_info')->employee_primary_id)?Session::get('user_info')
                    ->employee_primary_id:NULL),
                'updated_time'=>date('Y-m-d H:i:s'),
                'updated_ip'=>(!empty(Employee::getIp()))?Employee::getIp():$request->ip(),
            ];


            DB::beginTransaction();

            // planing info update
            DB::table('program_planning_infos')
                ->where(['id'=>$request->setting_id])
                ->update($program_planning_info);


            //////  artist info update /////
            $selected_artist_new=[];
            $existing_ids = [];
            if(!empty($request->program_description_id)) {
                foreach ($request->program_description_id as $key=> $row) {

                    if(!empty($request->artist_name_all[$key])) {
                        foreach($request->artist_name_all[$key] as $art_key => $art_id) {
                            $checking=Program_schedule_info::check_description_id_existing( $request->setting_id,
                                $request->program_description_id[$key],$art_id);
                            if($checking['status']=='existing_found') {

                                $existing_ids[] = $checking['data']->id;

                                $program_planning_artist_dtails = [
                                    'planning_info_id' => $request->setting_id,
                                    'description_id' => $row,
                                    'artist_id' => $art_id,
                                    'is_active' => 1,
                                    'updated_by' => (!empty(Session::get('user_info')->employee_primary_id)?Session::get('user_info')
                                        ->employee_primary_id:NULL),
                                    'updated_time' => date('Y-m-d H:i:s'),
                                    'updated_ip' => (!empty(Employee::getIp())) ? Employee::getIp() : $request->ip(),
                                ];

                                DB::table('program_planning_artist_infos')
                                    ->where([
                                        'planning_info_id'=>$request->setting_id,
                                        'description_id' => $row,
                                        'artist_id' => $art_id
                                    ])
                                    ->update($program_planning_artist_dtails);

                            }else{
                                $program_planning_artist_dtails_insert[] = [
                                    'planning_info_id' => $request->setting_id,
                                    'description_id' => $row,
                                    'artist_id' => $art_id,
                                    'artist_grade' => Null,
                                    'artist_grade_amount' => Null,
                                    'artist_ta_amount' => Null,
                                    'artist_da_amount' => Null,
                                    'is_active' => 1,
                                    'created_by'=>(!empty(Session::get('user_info')->employee_primary_id)?Session::get('user_info')
                                        ->employee_primary_id:NULL),
                                    'created_time'=>date('Y-m-d H:i:s'),
                                    'created_ip'=>(!empty(Employee::getIp()))?Employee::getIp():$request->ip(),

                                ];
                            }
                        }
                    }
                }

            }

            if(!empty($program_planning_artist_dtails_insert)) {

                foreach($program_planning_artist_dtails_insert as $key => $insertData) {
                    $id = DB::table('program_planning_artist_infos')->insertGetId(
                        $insertData
                    );
                    $existing_ids[] = $id;
                }

            }

            if(!empty($existing_ids)) {
                DB::table('program_planning_artist_infos')
                    ->where([
                        'planning_info_id'=>$request->setting_id
                    ])
                    ->whereNOTIn('id',$existing_ids)
                    ->update(['is_active'=>0]);
            }

            DB::commit();
            $success_output = 'Successfully Update Information';

        }
        $output = array(
            'error'     =>  $error_array,
            'success'   => $success_output ,
            'redirect_page'   => ''
        );
        echo json_encode($output);

    }

    public function get_allDays($m) {
        $month = $m<10?'0'.$m:$m;
        $year = date("Y");

        $start_date = "01-".$month."-".$year;
        $start_time = strtotime($start_date);

        $end_time = strtotime("+1 month", $start_time);

        for($i=$start_time; $i<$end_time; $i+=86400)
        {
            $list[] = date('Y-m-d', $i);
        }

        return $list;
    }

    public function load_date_data(request $request) {
        $month_id=$request->month;
        $station_id=$request->station_id;
        $fequencey=$request->fequencey;
        $year=$request->year;
        if(empty($station_id)){
            return 'Station id is required';
        }
        if(empty($month_id)){
            return 'Month id is required';
        }
        if(empty($fequencey)){
            return 'Fequencey id is required';
        }
        if(empty($year)){
            return 'Year id is required';
        }


       $exit_checking= Program_schedule_info::get_all_presentation_info(['program_presentation_infos.months'=>$month_id,'program_presentation_infos.station_id'=>$station_id,'program_presentation_infos.presentation_year'=>$year,'program_presentation_infos.sub_station_id'=>$fequencey,'program_presentation_infos.is_active'=>1]);
        if(count($exit_checking)>0){
            return 'Already exist this presentation, If you need correction please update from list';
        }
        $dates = $this->get_allDays($month_id);

        $atrist_info_info = Employee::get_artist_select();
//        $host = request()->getHttpHost();
//
//        $station_id= (!empty(Session::get('user_info')->station_id)?Session::get('user_info')
//            ->station_id:NULL);
//        $atrist_info_data  =  Employee::get_artist_select_presentation(['station_id'=>$station_id]);
//        if($host=='localhost') {
//            $atrist_info_data = json_decode($atrist_info_data, true);
//        }
//        if(!empty($atrist_info_data)){
//            $atrist_info_info=array_column($atrist_info_data,"name_bn","id");
//        }


        $station_info = Branch_info::branch_info_select(['is_active'=>1]);
        $presention_setting_info=Program_schedule_info::get_program_presentation_single_setting(['program_presentation_setting.station_id'=>$station_id,'program_presentation_setting.is_active'=>1,'program_presentation_setting.fequencey_id'=>$fequencey]);
        $setting_content=(!empty($presention_setting_info->content_info))?$presention_setting_info->content_info:NULL;
    //    echo "<pre>";
    //    print_r($dates);exit;
        return view('program.presentation.load_date_data',[
            'atrist_info_info'=>$atrist_info_info,
            'station_info'=>$station_info,
            'dates' => $dates,
            'setting_content' => $setting_content
        ]);

    }

    public function add_presentation(){
        $presentation_ctg = All_stting::get_settings_info(['type'=>15,'is_active'=>1,'id'=>91]);
        $presentation_description_ctg = All_stting::get_settings_info(['parent_id'=>91,'is_active'=>1]);
        $atrist_info_info = Employee::get_artist_select();
        $program_info = Program_schedule_info::program_info_by_status(['status'=>1]);
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);
        return view('program.presentation.add_presentation',['presentation_ctg'=>$presentation_ctg,'presentation_description_ctg'=>$presentation_description_ctg,
            'atrist_info_info'=>$atrist_info_info,'program_info'=>$program_info,'station_info'=>$station_info]);

    }
    public function presentation_setting(){
        $atrist_info_info = Employee::get_artist_select();
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);
        $presentation_setting_info= Program_schedule_info::get_program_presentation_setting([
            'program_presentation_setting.is_active' =>1
        ]);
        return view('program.presentation.setting.presentation_setting',['station_info'=>$station_info,'atrist_info_info'=>$atrist_info_info,'presentation_setting_info'=>$presentation_setting_info]);
    }
    public function add_presentation_setting(){
        $host = request()->getHttpHost();
        

        $station_id= (!empty(Session::get('user_info')->station_id)?Session::get('user_info')
        ->station_id:NULL);
        $atrist_info_data  =  Employee::get_artist_select_presentation(['station_id'=>$station_id]);
        if($host=='localhost') {
            $atrist_info_data = json_decode($atrist_info_data, true);
        }
        if(!empty($atrist_info_data)){
            $atrist_info_info=array_column($atrist_info_data,"name_bn","id");
        }
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);
        return view('program.presentation.setting.add_presentation_setting',['station_info'=>$station_info,'atrist_info_info'=>$atrist_info_info]);
    }
    public function save_presentation_settings_info(Request $request) {
       // dd($request);
        $validate_array =  [
            'station_id'  => 'required',
            'sub_station_id'  => 'required',
        ];

        $validation = Validator::make($request->all(),$validate_array);
        $error_array = [];
        $success_output = '';

        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }
        else {

            $query= Program_schedule_info::get_program_presentation_setting([
                'program_presentation_setting.station_id'=>$request->station_id,
                'program_presentation_setting.fequencey_id'=>$request->sub_station_id,
                'program_presentation_setting.is_active' =>1
            ]);
            $odivisions_info=$request->program_date;
            if(count($query)==0) {
                DB::beginTransaction();
                    $data = [
                        'station_id'=>$request->station_id,
                        'fequencey_id'=>$request->sub_station_id,
                        'is_active' => 1,
                        'content_info'=>(!empty($odivisions_info))?json_encode($odivisions_info,
                            JSON_UNESCAPED_UNICODE):NULL,
                        'created_by'=>(!empty(Session::get('user_info')->employee_primary_id)?Session::get('user_info')
                            ->employee_primary_id:NULL),
                        'created_time'=>date('Y-m-d H:i:s'),
                        'created_ip'=>(!empty(Employee::getIp()))?Employee::getIp():$request->ip(),
                    ];

                    DB::table('program_presentation_setting')
                        ->insert($data);
                DB::commit();
            }
            else {
                $error_array[] = 'Presentation setting Already Saved';
            }
        }

        $output = array(
            'error'             =>      $error_array,
            'success'           =>      'data save successfully',
            'redirect_page'     =>      'presentation_setting'
        );
        echo json_encode($output);
    }

    public function presentation_setting_info_report($id){
        $atrist_info_info = Employee::get_artist_select();
        $presentation_setting_info= Program_schedule_info::get_program_presentation_single_setting([
            'program_presentation_setting.id' =>$id
        ]);

        // echo "<pre>";
        // print_r($atrist_info_info);exit;

        return view('program.presentation.setting.presentation_setting_info_report',['atrist_info_info'=>$atrist_info_info,'presentation_setting_info'=>$presentation_setting_info]);
    }

    public function delete_presentation_setting(request $request){
        $success_output ='';
        $error_array =[];
        if(!empty($request->id)){
            $data = [
                'is_active' => 0,
                'updated_by'=>(!empty(Session::get('user_info')->employee_primary_id)?Session::get('user_info')
                    ->employee_primary_id:NULL),
                'updated_time'=>date('Y-m-d H:i:s'),
                'updated_ip'=>(!empty(Employee::getIp()))?Employee::getIp():$request->ip(),
            ];

            DB::table('program_presentation_setting')
                ->where(['id'=>$request->id])
                ->update($data);
            $success_output = 'Successfully delete presesntation setting Information';
        }else{
            $error_array[] = 'failed to delete presesntation setting';
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   => $success_output,
            'redirect_page'   => ''
        );
        echo json_encode($output);
    }
    public function delete_presentation(request $request){
        $success_output ='';
        $error_array =[];
        if(!empty($request->month_id) && !empty($request->station_id) ){
            $data = [
                'is_active' => 0,
                'updated_by'=>(!empty(Session::get('user_info')->employee_primary_id)?Session::get('user_info')
                    ->employee_primary_id:NULL),
                'updated_time'=>date('Y-m-d H:i:s'),
                'updated_ip'=>(!empty(Employee::getIp()))?Employee::getIp():$request->ip(),
            ];

            DB::table('program_presentation_infos')
                ->where(['months'=>$request->month_id])
                ->where(['station_id'=>$request->station_id])
                ->update($data);
            $success_output = 'Successfully delete presesntation  Information';
        }else{
            $error_array[] = 'failed to delete presesntation ';
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   => $success_output,
            'redirect_page'   => ''
        );
        echo json_encode($output);
    }


    public function get_row($day_id,$rowId) {

        $atrist_info_info = Employee::get_artist_select();

        return view('program.presentation.row',[
            'atrist_info_info'=>$atrist_info_info,
            'day_id' => $day_id,
            'row_id' => $rowId
        ]);
    }


    public function get_day_id($date) {

        $day_name = date('D', strtotime($date));
        $day_ids = array(
            'Sat'=>1,
            'Sun'=>2,
            'Mon'=>3,
            'Tue'=>4,
            'Wed'=>5,
            'Thu'=>6,
            'Fri'=>7
        );

        return $day_ids[$day_name];
    }

    public function save_presentation_info(Request $request) {

        $validate_array =  [
            'month_id'=>'required',
            'station_id'  => 'required',
            'sub_station_id'  => 'required',
            'year_id'  => 'required',
            'ctg_id'  => 'required',
            'description_id'  => 'required'

        ];
        $error_array = [];
        $success_output = '';
        $employee_id= !empty(Session::get('user_info')->employee_id)?Session::get('user_info')
            ->employee_id:NULL;
        if(empty($employee_id)){
            $error_array[]='Employee id is required';
        }

        $validation = Validator::make($request->all(),$validate_array);

        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }
        else {


            $query = DB::table('program_presentation_infos')
                ->where([
                    'months' =>$request->month_id,
                    'station_id'=>$request->station_id,
                    'sub_station_id'=>$request->sub_station_id,
                    'presentation_year'=>$request->year_id,
                    'is_active' =>1
                ])
                ->get();

            if(count($query)==0) {
                DB::beginTransaction();
                foreach($request->program_date as $date => $odivisions) {
                    if(!empty($odivisions)) {
                        $data = [
                            'presentation_identification_id' => Program_schedule_info::get_presentation_identity(
                                $request->station_id, $request->sub_station_id),
                            'months' => $request->month_id,
                            'station_id' => $request->station_id,
                            'sub_station_id' => $request->sub_station_id,
                            'presentation_year' => $request->year_id,
                            'presentation_ctg_id' => $request->ctg_id,
                            'presentation_description_id' => $request->description_id,
                            'presentation_created_by' => $employee_id,
                            'is_active' => 1,
                            'presentation_days' => $this->get_day_id($date),
                            'presentation_date' => $date,
                            'artist_log_info' => (!empty($odivisions)) ? json_encode($odivisions, JSON_UNESCAPED_UNICODE) : NULL,
                            'created_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                                ->employee_primary_id : NULL),
                            'created_time' => date('Y-m-d H:i:s'),
                            'created_ip' => (!empty(Employee::getIp())) ? Employee::getIp() : $request->ip(),

                        ];

                        DB::table('program_presentation_infos')->insert($data);
                        $presentation_date_id = DB::getPdo()->lastInsertId();


                        $final_artist = [];
                        $serial_no=1;
                        foreach ($odivisions as $odivision_id => $odivision_wise_artist_info) {
                            foreach ($odivision_wise_artist_info as $odivision_title => $artist_info) {
                                if (is_array($artist_info)) {
                                    foreach ((array)$artist_info as $key => $single_artist) {
                                        $atrist_info_grade  =  Employee::get_single_artist_select_presentation
                                        (['id'=>$single_artist]);
                                        $param=[
                                            'ctg_id'=>91, // hard code for presentation id
                                            'description'=> $request->description_id,
                                            'grade_id'=> $atrist_info_grade,
                                        ];

                                        $rate_chart= Program_schedule_info::get_single_rate_chart_info($param);
                                        if(!empty($rate_chart)){
                                            $rate_chart_id=$rate_chart->id;
                                            $amount=$rate_chart->amount;
                                        }else{
                                            $rate_chart_id=NULL;
                                            $amount='0.00';
                                        }
                                        $final_artist[] = [
                                            'presentation_date_id' => $presentation_date_id ,
                                            'odivision_id' => $odivision_id,
                                            'role_title' => $odivision_title,
                                            'description_id' => $request->description_id,
                                            'artist_serial_no' => date
                                                ('d',strtotime($date)).$serial_no,
                                            'artist_id' => $single_artist,
                                            'artist_rate_chart_id' => is_null($rate_chart_id)?NULL:$rate_chart_id,
                                            'artist_grade' => $atrist_info_grade,
                                            'artist_grade_amount' => $amount,
                                            'artist_ta_amount' => '0.00',
                                            'artist_da_amount' => '0.00',
                                            'is_active' => 1,
                                            'created_by' => (!empty(Session::get('user_info')->employee_primary_id)?Session::get('user_info') ->employee_primary_id:NULL),
                                            'created_time' => date('Y-m-d H:i:s'),
                                            'created_ip' => (!empty(Employee::getIp())) ? Employee::getIp() : $request->ip(),
                                        ];
                                        $serial_no++;
                                    }
                                }

                            }
                        }
                        if(!empty($final_artist)) {
                            DB::table('program_planning_artist_infos')->insert($final_artist);
                        }
                        DB::commit();
                    }
                }
                $success_output = 'Successfully Saved Presentation Information';


            }
            else {
                $error_array[] = 'Sorry!! Presentation Already Exist';
            }
        }

        $output = array(
            'error'     =>  $error_array,
            'success'   => $success_output,
            'redirect_page'   => 'program_presentation_create'
        );
        echo json_encode($output);


    }

    public function adhok_save_presentation_info(Request $request) {

        $validate_array =  [
         //   'month_id'=>'required',
            'station_id'  => 'required',
            'sub_station_id'  => 'required',
        //    'year_id'  => 'required',
      //      'ctg_id'  => 'required',
        //    'description_id'  => 'required'

        ];
        $error_array = [];
        $success_output = '';
        $employee_id= !empty(Session::get('user_info')->employee_id)?Session::get('user_info')
            ->employee_id:NULL;
        if(empty($employee_id)){
            $error_array[]='Employee id is required';
        }

        $validation = Validator::make($request->all(),$validate_array);

        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }
        else {
           // dd($request);


            $presentation_single_date_info=Program_schedule_info::get_program_presentation_single_info_first_row
            (['program_presentation_infos.presentation_date'=>$request->presentation_date,'program_presentation_infos.presentration_type'=>1]);

            if(!empty($presentation_single_date_info->id)) {
                DB::beginTransaction();
                foreach($request->program_date as $date => $odivisions) {
                    if(!empty($odivisions)) {
                        $data = [
                            'presentation_identification_id' =>'adhok-'.
                                Program_schedule_info::get_presentation_identity(
                                $request->station_id, $request->sub_station_id),
                            'months' => $presentation_single_date_info->months,
                            'station_id' => $presentation_single_date_info->station_id,
                            'sub_station_id' => $presentation_single_date_info->sub_station_id,
                            'presentation_year' => $presentation_single_date_info->presentation_year,
                            'presentation_ctg_id' => $presentation_single_date_info->presentation_ctg_id,
                            'presentation_description_id' => $presentation_single_date_info->presentation_description_id,
                            'presentation_created_by' => $employee_id,
                            'is_active' => 1,
                            'presentration_type' => 2, //1=reqular, 2= adhok
                            'presentation_days' => $this->get_day_id($presentation_single_date_info->presentation_date),
                            'presentation_date' => $presentation_single_date_info->presentation_date,
                            'artist_log_info' => (!empty($odivisions)) ? json_encode($odivisions, JSON_UNESCAPED_UNICODE) : NULL,
                            'created_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                                ->employee_primary_id : NULL),
                            'created_time' => date('Y-m-d H:i:s'),
                            'created_ip' => (!empty(Employee::getIp())) ? Employee::getIp() : $request->ip(),

                        ];

                        DB::table('program_presentation_infos')->insert($data);
                        $presentation_date_id = DB::getPdo()->lastInsertId();


                        $final_artist = [];
                        $serial_no=1;
                        foreach ($odivisions as $odivision_id => $odivision_wise_artist_info) {
                            foreach ($odivision_wise_artist_info as $odivision_title => $artist_info) {
                                if (is_array($artist_info)) {
                                    foreach ((array)$artist_info as $key => $single_artist) {
                                        $atrist_info_grade  =  Employee::get_single_artist_select_presentation
                                        (['id'=>$single_artist]);
                                        $param=[
                                            'ctg_id'=>91, // hard code for presentation id
                                            'description'=> $presentation_single_date_info->presentation_description_id,
                                            'grade_id'=> $atrist_info_grade,
                                        ];

                                        $rate_chart= Program_schedule_info::get_single_rate_chart_info($param);
                                        if(!empty($rate_chart)){
                                            $rate_chart_id=$rate_chart->id;
                                            $amount=$rate_chart->amount;
                                        }else{
                                            $rate_chart_id=NULL;
                                            $amount='0.00';
                                        }
                                        $final_artist[] = [
                                            'presentation_date_id' => $presentation_date_id ,
                                            'odivision_id' => $odivision_id,
                                            'role_title' => $odivision_title,
                                            'description_id' => $presentation_single_date_info->presentation_description_id,
                                            'artist_serial_no' => date
                                            ('d',strtotime($presentation_single_date_info->presentation_date)).$serial_no,
                                            'artist_id' => $single_artist,
                                            'type' => 2,
                                            'artist_rate_chart_id' => is_null($rate_chart_id)?NULL:$rate_chart_id,
                                            'artist_grade' => $atrist_info_grade,
                                            'artist_grade_amount' => $amount,
                                            'artist_ta_amount' => '0.00',
                                            'artist_da_amount' => '0.00',
                                            'is_active' => 1,
                                            'created_by' => (!empty(Session::get('user_info')->employee_primary_id)?Session::get('user_info') ->employee_primary_id:NULL),
                                            'created_time' => date('Y-m-d H:i:s'),
                                            'created_ip' => (!empty(Employee::getIp())) ? Employee::getIp() : $request->ip(),
                                        ];
                                        $serial_no++;
                                    }
                                }

                            }
                        }
                        if(!empty($final_artist)) {
                            DB::table('program_planning_artist_infos')->insert($final_artist);
                        }
                        DB::commit();
                    }
                }
                $success_output = 'Successfully Saved Presentation Information';


            }
            else {
                $error_array[] = 'Sorry!! Presentation Already Exist';
            }
        }

        $output = array(
            'error'     =>  $error_array,
            'success'   => $success_output,
            'redirect_page'   => 'program_adhok_presentation_create'
        );
        echo json_encode($output);


    }

    public function update_program_presentation($month,$station_id) {

        $program_ctg = All_stting::get_settings_info(['type'=>6,'is_active'=>1]);
        $atrist_info_info = Employee::get_artist_select();
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);

        $presentation_info = DB::table("program_presentation_infos")
            ->where([
                'program_presentation_infos.is_active'=>1,
                'program_presentation_infos.months'=>$month,
                'program_presentation_infos.station_id'=>$station_id,
            ])
            ->join('branch_infos', 'branch_infos.id', '=', 'program_presentation_infos.station_id')
            ->select('program_presentation_infos.*','branch_infos.name')
            ->get();

        $dates = $this->get_allDays($month);

        if(is_null($presentation_info)) {
            return redirect()->route('program_presentation_create');
        }

        $odivision_data = [];
        return view('program.presentation.update_presentation',
            [
                'month'=>$month,
                'station'=>$station_id,
                'presentation_info'=>$presentation_info,
                'program_ctg'=>$program_ctg,
                'atrist_info_info'=>$atrist_info_info,
                'station_info'=>$station_info,
                'odivision_data' =>$odivision_data,
                'dates' => $dates
            ]
        );
    }

    public function update_presentation_info_data(Request $request) {

        $validate_array =  [
            'month_id'=>'required',
            'station_id'  => 'required',
            'unit_id' => 'required'
        ];

        $validation = Validator::make($request->all(),$validate_array);

        $error_array = [];
        $success_output = '';

        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }
        else {

            $query = DB::table("program_presentation_infos")
                ->where([
                    'months'=> $request->hidden_month,
                    'station_id' =>  $request->hidden_station,
                    'presntation_unit' =>$request->hidden_unit,
                    'is_active' => 1
                ])
                ->get();

            $ids = [];
            foreach($query as $value){
                $ids[] = $value->id;
            }

            $query = DB::table("program_presentation_infos")
                ->where([
                    'months'=> $request->months,
                    'station_id' =>  $request->station_id,
                    'presntation_unit' =>$request->presntation_unit,
                    'is_active' => 1
                ])
                ->whereNotIn('id', $ids)
                ->get();


            if(count($query)>0) {
                $output = array(
                    'error'     =>  ['Presentation Schedule already inserted'],
                    'success'   => 'data save successfully',
                    'redirect_page'   => ''
                );
                echo json_encode($output);
                exit;
            }

            DB::beginTransaction();

            DB::table("program_presentation_infos")
                ->where([
                    'months'=> $request->months,
                    'station_id' =>  $request->station_id,
                    'presntation_unit' =>$request->presntation_unit,
                    'is_active' => 1
                ])
                ->update([
                    'is_active' => 0
                ]);

            foreach($request->program_date as $date => $odivisions) {

                if(!empty($request->repeat[$date])){
                    $odivisions_info = $request->program_date[$request->repeat[$date]];
                }
                else {
                    $odivisions_info = $odivisions;
                }

                $data = [
                    'months' => $request->month_id,
                    'station_id'=>$request->station_id,
                    'presntation_unit'=>$request->unit_id,
                    'is_active' => 1,
                    'presentation_days'=>$this->get_day_id($date),
                    'presentation_date'=>$date,
                    'artist_log_info'=>json_encode($odivisions_info,JSON_UNESCAPED_UNICODE),
                    'created_by'=>(!empty(Session::get('user_info')->employee_primary_id)?Session::get('user_info')
                        ->employee_primary_id:NULL),
                    'created_time'=>date('Y-m-d H:i:s'),
                    'created_ip'=>(!empty(Employee::getIp()))?Employee::getIp():$request->ip(),

                ];

                DB::table('program_presentation_infos')->insert($data);

            }

            DB::commit();

        }

        $output = array(
            'error'     =>  $error_array,
            'success'   => 'data save successfully',
            'redirect_page'   => ''
        );

        echo json_encode($output);

    }

    public function load_date_data_update($month,$station_id) {

        $atrist_info_info = Employee::get_artist_select();
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);

        $presentation_info = DB::table("program_presentation_infos")
            ->where([
                'program_presentation_infos.is_active'=>1,
                'program_presentation_infos.months'=>$month,
                'program_presentation_infos.station_id'=>$station_id,
            ])
            ->join('branch_infos', 'branch_infos.id', '=', 'program_presentation_infos.station_id')
            ->select('program_presentation_infos.*','branch_infos.name')
            ->get();

        $dates = $this->get_allDays($month);

        if(is_null($presentation_info)) {
            return redirect()->route('program_presentation_create');
        }

        $odivision_data = [];
        return view('program.presentation.load_date_data_update',
            [
                'month'=>$month,
                'station'=>$station_id,
                'presentation_info'=>$presentation_info,
                'atrist_info_info'=>$atrist_info_info,
                'station_info'=>$station_info,
                'odivision_data' =>$odivision_data,
                'dates' => $dates
            ]
        );
    }


    // archive report

    public function live_program_report() {
        $program_ctg = All_stting::get_settings_info(['type'=>6,'is_active'=>1]);
        $program_type = All_stting::get_settings_info(['type'=>14,'is_active'=>1]); // ধরন
        $program_style = All_stting::get_settings_info(['type'=>15,'is_active'=>1]); // প্রকৃতি
        $program_description = All_stting::get_settings_info(['type'=>16,'is_active'=>1]); // বিবরন
        $atrist_info_info = Employee::get_artist_select();
        $program_info = Program_schedule_info::program_info_by_status(['status'=>1]);
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);
        $employee_info = Employee::get_employee_info_name(['is_active'=>1]);
        $get_program_planning_info=Program_schedule_info::get_program_planning_info(['program_planning_infos.is_broadcast'=>1]);
        $page_title='সম্প্রচারিত প্রোগ্রাম';

        return view('program.recorded_program_report',
            [
                'program_ctg'=>$program_ctg,
                'atrist_info_info'=>$atrist_info_info,
                'program_info'=>$program_info,
                'station_info'=>$station_info,
                'program_description'=>$program_description,
                'program_style'=>$program_style,
                'program_type'=>$program_type,
                'employee_info'=>$employee_info,
                'get_program_planning_info'=>$get_program_planning_info,
                'page_title'=>$page_title
            ]
        );
    }


    public function recorded_program_report() {
        $program_ctg = All_stting::get_settings_info(['type'=>6,'is_active'=>1]);
        $program_type = All_stting::get_settings_info(['type'=>14,'is_active'=>1]); // ধরন
        $program_style = All_stting::get_settings_info(['type'=>15,'is_active'=>1]); // প্রকৃতি
        $program_description = All_stting::get_settings_info(['type'=>16,'is_active'=>1]); // বিবরন
        $atrist_info_info = Employee::get_artist_select();
        $program_info = Program_schedule_info::program_info_by_status(['status'=>1]);
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);
        $employee_info = Employee::get_employee_info_name(['is_active'=>1]);
        $get_program_planning_info=Program_schedule_info::get_program_planning_info(['program_planning_infos.is_recorded'=>1]);
        $page_title='রেকডেড প্রোগ্রাম';
        return view('program.recorded_program_report',
            [
                'program_ctg'=>$program_ctg,
                'atrist_info_info'=>$atrist_info_info,
                'program_info'=>$program_info,
                'station_info'=>$station_info,
                'program_description'=>$program_description,
                'program_style'=>$program_style,
                'program_type'=>$program_type,
                'employee_info'=>$employee_info,
                'get_program_planning_info'=>$get_program_planning_info,
                'page_title'=>$page_title
            ]
        );
    }

    public function yearly_program_report(){
        $program_ctg = All_stting::get_settings_info(['type'=>6,'is_active'=>1]);
        $program_type = All_stting::get_settings_info(['type'=>14,'is_active'=>1]); // ধরন
        $program_style = All_stting::get_settings_info(['type'=>15,'is_active'=>1]); // প্রকৃতি
        $program_description = All_stting::get_settings_info(['type'=>16,'is_active'=>1]); // বিবরন
        $atrist_info_info = Employee::get_artist_select();
        $program_info = Program_schedule_info::program_info_by_status(['status'=>1]);
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);
        $employee_info = Employee::get_employee_info_name(['is_active'=>1]);

        $query =  DB::table('program_planning_infos');
        $query->leftJoin('all_sttings as program_type_info', 'program_type_info.id', '=', 'program_planning_infos.program_type');
        $query->leftJoin('all_sttings as program_style_info', 'program_style_info.id', '=', 'program_planning_infos.program_style');
        $query->leftJoin('branch_infos', 'branch_infos.id', '=', 'program_planning_infos.station_id');
        $query->leftJoin('fixed_program_type', 'fixed_program_type.id', '=', 'program_planning_infos.fixed_program_type_id');
        $query->where(['program_planning_infos.is_broadcast'=>1]);
        $query->where('program_planning_infos.fixed_program_type_id', '>', 0);

        $get_program_planning_info =  $query->select("program_style_info.title as program_style_title","program_type_info.title as program_type_title","program_planning_infos.*","branch_infos.name as 
        station_name","fixed_program_type.name as program_type_name",(DB::raw("date_format(program_planning_infos.entry_date,'%d-%m-%Y') as entry_date")),(DB::raw("date_format(program_planning_infos.live_date,'%d-%m-%Y') as live_date")))->get();


        $page_title='উৎসবাদী ও বার্ষিকী প্রোগ্রাম';

        return view('program.yearly_program_report',
            [
                'program_ctg'=>$program_ctg,
                'atrist_info_info'=>$atrist_info_info,
                'program_info'=>$program_info,
                'station_info'=>$station_info,
                'program_description'=>$program_description,
                'program_style'=>$program_style,
                'program_type'=>$program_type,
                'employee_info'=>$employee_info,
                'get_program_planning_info'=>$get_program_planning_info,
                'page_title'=>$page_title
            ]
        );
    }


    public function presentation_info_report($month , $station , $type=1  ) {

        $presentation_info =Program_schedule_info::get_program_presentation_info_report_artist([
            'program_presentation_infos.months'=>$month,
            'program_presentation_infos.station_id'=>$station,
            'program_presentation_infos.presentration_type'=>$type
        ]) ;

        $presentation_heading_info =Program_schedule_info::get_program_presentation_heading_info([
            'program_presentation_infos.months'=>$month,
            'program_presentation_infos.station_id'=>$station,
            'program_presentation_infos.presentration_type'=>$type
        ]) ;
        $role_title_array = [];
        $all_artist_info=[];
       // dd($presentation_info);
        if(!empty($presentation_info)) {
            foreach ($presentation_info as $key => $artist_info) {
                if(!in_array($artist_info->role_title,$role_title_array)) {
                    $role_title_array[] = $artist_info->role_title;
                }
                $all_artist_info[$artist_info
                    ->odivision_id][$artist_info->presentation_days][$artist_info->presentation_date][$artist_info->role_title][] = [
                    'artist_id' => $artist_info->artist_id,
                    'name_bn' => $artist_info->name_bn

                ];
            }
        }

        $employee_info = Employee::get_employee_info_name(['is_active'=>1]);

        return view('program.presentation.presentation_report',[
            'presentation_info'=>$all_artist_info,
            'presentation_heading_info'=>$presentation_heading_info,
            'role_title_array'=>$role_title_array,
            'employee_info'=>$employee_info
        ]);
    }
    public function presentation_info_report_date($month , $station, $type=1  ) {
        $atrist_info_info = Employee::get_artist_select();
      //  dd($atrist_info_info);
        $presentation_info =Program_schedule_info::get_program_presentation_single_info([
            'program_presentation_infos.months'=>$month,
            'program_presentation_infos.station_id'=>$station,
            'program_presentation_infos.presentration_type'=>$type
        ]) ;
        $employee_info = Employee::get_employee_info_name(['is_active'=>1]);
        return view('program.presentation.presentation_info_report_date',[
            'presentation_info'=>$presentation_info,
            'atrist_info_info'=>$atrist_info_info,
            'employee_info'=>$employee_info
        ]);
    }

    public function presentation_info_report_artist($month , $station,$type=1  ) {
        $presentation_info =Program_schedule_info::get_program_presentation_info_report_artist([
            'program_presentation_infos.months'=>$month,
            'program_presentation_infos.station_id'=>$station,
            'program_presentation_infos.presentration_type'=>$type
        ]) ;



        $presentation_heading_info =Program_schedule_info::get_program_presentation_heading_info([
            'program_presentation_infos.months'=>$month,
            'program_presentation_infos.station_id'=>$station,
            'program_presentation_infos.presentration_type'=>$type
        ]) ;
        $odivision_array = [];
        $all_artist_info=[];
        if(!empty($presentation_info)) {
            foreach ($presentation_info as $key => $artist_info) {
                if(!in_array($artist_info->odivision_id,$odivision_array)) {
                    $odivision_array[] = $artist_info->odivision_id;
                }
                $all_artist_info[$artist_info->role_title][$artist_info->name_bn
                .'-'.$artist_info->artist_id][$artist_info->odivision_id][] = [
                    'presentation_date' => $artist_info->presentation_date,

                ];
            }
        }

        $employee_info = Employee::get_employee_info_name(['is_active'=>1]);
//        dd($odivision_array);
        return view('program.presentation.presentation_info_report_artist',[
            'presentation_info'=>$all_artist_info,
            'odivision' => $odivision_array,
            'presentation_heading_info'=>$presentation_heading_info,
            'employee_info'=>$employee_info,

        ]);
    }




    // studio information update

    public function studio_information_form($id){
        $studio_description = All_stting::get_settings_info(['type'=>17,'is_active'=>1]); // studio description
        $get_program_planning_info= All_stting::get_single_program_info(['program_planning_infos.id'=>$id]);
        $employee_info = Employee::get_employee_info_name(['is_active'=>1]);
        return view('program.studio_information_form',
            [
                'program_plan'=>$get_program_planning_info,
                'employee_info' => $employee_info,
                'setting_id' => $id,
                'studio_description'=> $studio_description

            ]
        );
    }

    public function studio_information_view($id){
        $studio_description = All_stting::get_settings_info(['type'=>17,'is_active'=>1]); // studio description
        $get_program_planning_info= All_stting::get_single_program_info(['program_planning_infos.id'=>$id]);
        $employee_info = Employee::get_employee_info_name(['is_active'=>1]);
        return view('program.studio_information_view',
            [
                'program_plan'=>$get_program_planning_info,
                'employee_info' => $employee_info,
                'setting_id' => $id,
                'studio_description'=> $studio_description

            ]
        );
    }
    public function gate_pass_print($data_passed_date_new){
        $get_program_planning_info_data=Program_schedule_info::get_program_recording_list(['program_planning_infos.is_active'=>4]);
      // dd($get_program_planning_info_data);
       // dd($date_passed_date);
        //$data_passed_date_new='18-11-2019';
       // dd($data_passed_date);
        $get_program_planning_info=[];
        if(!empty($get_program_planning_info_data)) {
            foreach ($get_program_planning_info_data as $key => $info) {
                if(!empty($info->recording_date_info)) {
                    $all_date = json_decode($info->recording_date_info, true);
                        foreach ($all_date as $child_key=>$record_date_info){
                         //   dd(strtotime($date_passed_date));
                          //  dd($record_date_info['date']);
                            if(!empty($record_date_info['date']) && (strtotime($record_date_info['date'])
                                ==strtotime($data_passed_date_new))) {
                                $get_program_planning_info[] = [
                                     'id' => $info->id,
                                    'station_name' => $info->station_name,
                                    'branch_address' => $info->branch_address,
                                    'program_identity' => $info->program_identity,
                                    'program_name' => $info->program_name,
                                    'program_type_title' => $info->program_type_title,
                                    'artist_name' => $info->artist_name,
                                    'artist_mobile' => $info->artist_mobile,
                                    'address' => $info->address,
                                    'record_date' => $record_date_info['date'],
                                    'recorded_time' => $record_date_info['time']
                                ];
                            }
                        }
                    }


            }
        }
      //  dd($get_program_planning_info);
//        if(!empty($get_program_planning_info)) {
//            usort($get_program_planning_info, function ($a1, $a2) {
//                $value1 = strtotime($a1['record_date']);
//                $value2 = strtotime($a2['record_date']);
//                return $value1 - $value2;
//            });
//        }
//        $get_program_planning_info= All_stting::get_single_program_info(['program_planning_infos.id'=>$id]);
//        $get_program_planning_info_artist= All_stting::get_single_program_artist_info(['program_planning_artist_infos.planning_info_id'=>$id,'program_planning_artist_infos.is_active'=>1]);
       // dd($get_program_planning_info);
        return view('program.operation.gate_pass_print',
            [
                'program_plan'=>$get_program_planning_info,
                'get_program_planning_info_artist' => $get_program_planning_info,
            ]
        );
    }






































































































    public function studio_information_update(request $request){
        $validate_array =  [
            'setting_id' => 'required',
            'manage_title_id'=>'required'
        ];

        $validation = Validator::make($request->all(), $validate_array);
        $error_array = array();
        $success_output = '';
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }else {
            $data = [

                'is_supply' =>isset($request->supply)?1:0,
                'is_archived' =>isset($request->archive)?1:0,
                'studio_id' =>(isset($request->studio_id)?$request->studio_id:''),
                'studio_infos' =>json_encode($request->magazine_manage),
                'updated_by'=>(!empty(Session::get('user_info')->employee_primary_id)?Session::get('user_info')
                    ->employee_primary_id:NULL),
                'updated_time'=>date('Y-m-d H:i:s'),
                'updated_ip'=>(!empty(Employee::getIp()))?Employee::getIp():$request->ip(),
            ];

            DB::table('program_planning_infos')
                ->where(['id'=>$request->setting_id])
                ->update($data);
            $success_output = 'Successfully Update Information';

        }
        $output = array(
            'error'     =>  $error_array,
            'success'   => $success_output ,
            'redirect_page'   => ''
        );
        echo json_encode($output);

    }

    public function get_artist_info_program_description(Request $request) {

        $artist_grade_info='';
        if(!empty($request->exp_grade_id)){
            $artist_grade_info = All_stting::get_artist_grade_info(['type'=>1]);
        }

        // station_id and is_active=1
        if(!empty($request->station_id) && (empty($request->expertise_id) && empty($request->expertise_dept) && empty
                ($request->exp_grade_id) )){
            $all_artist_info=All_stting::get_program_artist_basic_info(['program_artist_info.station_id'=>$request->station_id]);
        }else if(!empty($request->expertise_id) || !empty($request->expertise_dept) || !empty($request->exp_grade_id) ){
            $param=[
                'station_id'  =>  $request->station_id,
                'expertise_id'  =>  $request->expertise_id,
                'expertise_dept'  =>  $request->expertise_dept,
                'exp_grade_id'  =>  $request->exp_grade_id,
            ];

            $all_artist_info=All_stting::get_program_artist_basic_info_expertise($param);

        }


        if(!empty($all_artist_info)) {
            return json_encode(['status' => 'success','message'=>'successfully data found','data'=>$all_artist_info]);
        }else{
            return json_encode(['status' => 'error','message'=>'failed no data found','data'=>[]]);
        }



//        $results = DB::select( DB::raw("SELECT * FROM setup_fixed_time_point WHERE station_id=$request->station_id and is_active=1") );
//        // dd($results);
//        $day_id = $this->get_day_id($request->date);
//        $content = json_decode($results[0]->content,true);
//        $chank_list = [];
//        foreach($content as $key => $value){
//            if(in_array($day_id,$value['days'])) {
//                $chank_list[] = $value['chank'];
//            }
//        }
//        echo json_encode(['chank_list'=>$chank_list]);
    }




























    /////////// planning form data Alocated for mehedi bai //////////



    public function planning_form_data(Request $request) {
        $data = [
            'station_id' => isset($request->station_id)? $request->station_id : null,
            'hounoriam_ctg_id' => isset($request->hounoriam_ctg_id)? $request->hounoriam_ctg_id : null,
            'artist_id' => isset($request->artist_id)? $request->artist_id : null,
            'biboron_id' => isset($request->biboron_id)? $request->biboron_id : null,
            'grade_id' => isset($request->grade_id)? $request->grade_id : null,
            //  'stability' => isset($request->stability)? $request->stability : null
        ];
        $response = [
            'biboron_info' => $this->artist_biboron_data($data),
        ];
//        dd($response);
        echo json_encode($response);
    }
    public function change_description_info(Request $request) {
        $grade_info='';
        $tability_info='';
        $get_vumika_workarea='';

        if(!empty($request->grade)) {
            $stability_param = [
                'ctg_id' => isset($request->hounoriam_ctg_id) ? $request->hounoriam_ctg_id : null,
                'description' => isset($request->biboron_id) ? $request->biboron_id : null,
                'grade_id' => isset($request->grade) ? $request->grade : null,
            ];
            $tability_info=all_stting::artist_description($stability_param);
        }else{
            $grade_param= [
                'ctg_id' => isset($request->hounoriam_ctg_id)? $request->hounoriam_ctg_id : null,
                'description' => isset($request->biboron_id)? $request->biboron_id : null,
            ];
            $grade_info=all_stting::artist_grade_description($grade_param);
        }
        if(!empty($request->biboron_id)) {
            $get_vumika_workarea = All_stting::get_single_settings_info(['id' => $request->biboron_id]);
        }

        $response = [
            'grade_info' =>$grade_info ,
            'stability_info' =>$tability_info,
            'get_vumika_workarea' =>$get_vumika_workarea,
        ];
        if(!empty($response)) {
            return ['status' => 'success', 'message' => 'successfully data found', 'data' => $response];
        }else{
            return ['status' => 'error', 'message' => 'failed no data found', 'data' => []];
        }
    }
    public function get_single_artist_info(Request $request) {
        $artist_info=[];
        if(!empty($request->artist_id)) {
            $stability_param = [
                'ctg_id' => isset($request->hounoriam_ctg_id) ? $request->hounoriam_ctg_id : null,
                'description' => isset($request->biboron_id) ? $request->biboron_id : null,
                'grade_id' => isset($request->grade) ? $request->grade : null,
            ];
            $artist_info=all_stting::get_artist_info(['program_artist_info.id'=>$request->artist_id]);
        }

        if(!empty($artist_info)) {
            return ['status' => 'success', 'message' => 'successfully data found', 'data' => $artist_info];
        }else{
            return ['status' => 'error', 'message' => 'failed no data found', 'data' => []];
        }
    }



    private function artist_biboron_data ($data) {
        $ctg_id = $data['hounoriam_ctg_id'];
        if($ctg_id == null) {
            return false;
        }

        $results = DB::select("SELECT * FROM all_sttings WHERE is_active=1 and parent_id=$ctg_id");

        if(count($results)>0) {
            return $results;
        }
        else {
            return false;
        }

        // $results = DB::select("SELECT * FROM program_artist_info WHERE station_id=$station_id AND is_active = 1 AND  JSON_CONTAINS(artist_rate_chart_info->'$[*].artist_hounoriam_ctg', json_array('$ctg_id'));
        // ");
        // if(count($results) > 0) {
        //     return $results;
        // }
        // else {
        //   $results = DB::select("SELECT * FROM program_artist_info WHERE station_id=$station_id AND is_active = 1");
        //     if(count($results) > 0) {
        //     return $results;
        //     }
        // }
        // return FALSE;
    }

    private function shilpier_info($data) {
        // SELECT * FROM program_artist_info WHERE id=$artist_id;
        // all biboron data array of json
        // $results = DB::select( DB::raw("SELECT * FROM program_artist_info WHERE id = '$artist_id'") );

        // if($data['artist_id'] === NULL || $data['hounoriam_ctg_id'] === NULL) {
        //     return FALSE;
        // }

        // $results = DB::table("program_artist_info")->where("id",$data['artist_id'])->first();
        // $decode_biboron_data = json_decode($results->artist_rate_chart_info,true);
        // if($decode_biboron_data == null) { return false; }
        // $houner_ctg_id = $data['hounoriam_ctg_id'];
        // $filter = array_filter($decode_biboron_data,function($row) use($houner_ctg_id) {
        //     return $houner_ctg_id == $row['artist_hounoriam_ctg'];
        // });

        // if(count($filter)>0) {
        //     return array_values($filter);
        // }
        // return FALSE;

        $station_id = $data['station_id'];
        $ctg_id = $data['biboron_id'];
        if($ctg_id == null) {
            return false;
        }

        $results = DB::select("SELECT * FROM program_artist_info WHERE station_id=$station_id AND is_active = 1 AND  JSON_CONTAINS(artist_rate_chart_info->'$[*].chart_description', json_array('$ctg_id'));
        ");
        if(count($results) > 0) {
            return $results;
        }
        else {
            $results = DB::select("SELECT * FROM program_artist_info WHERE station_id=$station_id AND is_active = 1");
            if(count($results) > 0) {
                return $results;
            }
        }
        return FALSE;


    }

    private function grade_info($data) {
        // SELECT * FROM program_artist_info WHERE id=$artist_id;
        // all biboron data array of json and get specific grade

        if($data['artist_id'] === NULL || $data['biboron_id'] === NULL) {
            return FALSE;
        }
        // dd($data);
        $results = DB::table("program_artist_info")->where("id",$data['artist_id'])->first();
        $decode_biboron_data = json_decode($results->artist_rate_chart_info,true);
        if($decode_biboron_data == null) { return false; }
        $biboron_id = $data['biboron_id'];
        $filter = array_filter($decode_biboron_data,function($row) use($biboron_id) {
            return $biboron_id == $row['chart_description'];
        });
        if(count($filter)>0) {
            return array_values($filter);
        }
        return FALSE;
    }

    private function stability_info_data($data) {
        // SELECT * FROM `setup_artist_rate_chart` where ctg_id and description and grade_id

        if($data['hounoriam_ctg_id'] === NULL || $data['grade_id'] === NULL || $data['biboron_id'] === NULL) {
            return FALSE;
        }

        $results = DB::table("setup_artist_rate_chart")->where([
            'ctg_id' => $data['hounoriam_ctg_id'],
            'grade_id' => $data['grade_id'],
            'description' => $data['biboron_id'],
            'is_active' => 1
        ])->get();

        if(count($results)>0) {
            return $results;
        }
        return FALSE;
    }

    private function sommani_amount($data) {

        // stability
        // SELECT * FROM `setup_artist_rate_chart` where ctg_id and description and grade_id

        if($data['stability'] === NULL || $data['hounoriam_ctg_id'] === NULL || $data['grade_id'] === NULL || $data['biboron_id'] === NULL) {
            return FALSE;
        }

        $results = DB::table("setup_artist_rate_chart")->where([
            'ctg_id' => $data['hounoriam_ctg_id'],
            'grade_id' => $data['grade_id'],
            'description' => $data['biboron_id'],
            'stability' => $data['stability'],
            'is_active' => 1
        ])->first();

        if($results != null) {
            return $results;
        }
        return FALSE;
    }

    public function get_chank(Request $request) {
        // station_id and is_active=1
        $results = DB::select( DB::raw("SELECT * FROM setup_fixed_time_point WHERE station_id=$request->station_id and is_active=1") );
        // dd($results);
        $day_id = $this->get_day_id($request->date);
        $content = json_decode($results[0]->content,true);
        $chank_list = [];
        foreach($content as $key => $value){
            if(in_array($day_id,$value['days'])) {
                $chank_list[] = $value['chank'];
            }
        }
        echo json_encode(['chank_list'=>$chank_list]);
    }



    public function save_program_planning_info_create_new(request $request) {
        // echo isset($request->dologot_poribashona)? 'ok' : 'not';

        $validate_array =  [
            'program_name'  => 'required',
            'station_id' => 'required',
            'biboron_data'=>'required',
            'sub_station_id' => 'required',
            'record_type' => 'required',
            //   'recorded_time'=>'required',
            'live_time' => 'required'
        ];

        if(isset($request->is_fixed_program)) {
            $validate_array['fixed_program_type'] = 'required';
        }

        $error_array = array();

        if($request->biboron_data=='') {
            $error_array[] = "Biboron Data Not Found";
            $output = array(
                'error'     =>  $error_array,
                'success'   => '' ,
                'redirect_page'   => 'program_magazine_create_form_new'
            );
            echo json_encode($output);
            exit;
        }
        else {
            $decode = json_decode($request->biboron_data,true);

            if(empty($decode)){
                $error_array[] = "Biboron Data Not Found";
                $output = array(
                    'error'     =>  $error_array,
                    'success'   => '' ,
                    'redirect_page'   => 'program_magazine_create_form_new'
                );
                echo json_encode($output);
                exit;
            }
        }

        $validation = Validator::make($request->all(),$validate_array);


        $success_output = '';
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }else {

            $manage = [
                6=>[],
                1=>[],
                2=>[],
                3=>[],
                4=>[],
                5=>[]
            ];

            $magazine_manage = $request->magazine_manage;

            foreach($manage as $key => $value) {
                if(isset($magazine_manage[$key])) {
                    $manage[$key] = $magazine_manage[$key];
                }
            }

            $program_planning_info = [
                'station_id' => $request->station_id,
                'sub_station_id' => $request->sub_station_id,
                'program_identity' => Program_schedule_info::get_program_identity( $request->station_id) ,
                'entry_date'=>date('Y-m-d'),
                'is_fixed_program' => isset($request->is_fixed_program) ? 1: 0,
                'fixed_program_type_id' => isset($request->is_fixed_program)? $request->fixed_program_type:NULL,
                'sub_fixed_program_type_id' => !empty($request->sub_fixed_program_type)? $request->sub_fixed_program_type:NULL,
                'fixed_onusan_suchy' => $request->fixed_onusan_suchy,
                'torimasik_porikolpona' => $request->torimasik_porikolpona,
                'bangla_son' => $request->bangla_son,
                'chank_info' => $request->chank_info,
                'dologot_poribashona' => isset($request->dologot_poribashona) ? 1 : 0,
                'dolar_name' => isset($request->dolar_name) ? $request->dolar_name : null,
                'dolar_info' => isset($request->dolar_info) ? $request->dolar_info : null,
                'program_name'=>$request->program_name,
                'program_type'=>$request->program_type,
                'program_style'=>null,
                'larget_viewer'=>$request->larget_viewer,
                'onusthan_bisoy_bostu'=>$request->onusthan_bisoy_bostu,
                //'recorded_date'=>(!empty($request->racording_date)) ? json_encode($request->racording_date):NULL,
                //'recorded_time'=>$request->recorded_time,
                'live_date'=>(!empty($request->boardcasting_date)) ? json_encode($request->boardcasting_date) : NULL,
                'live_time'=>$request->live_time,
                'recording_date_is_plexibity'=>((isset($request->recording_date_is_plexibity) && !empty
                    ($request->recording_date_is_plexibity)) ?1:NULL),
                'recording_time_is_plexibity'=>((isset($request->recording_time_is_plexibity) && !empty
                    ($request->recording_time_is_plexibity)) ?1:NULL),
                'live_date_is_plexibity'=>((isset($request->live_date_is_plexibity) && !empty
                    ($request->live_date_is_plexibity)) ?1:NULL),
                'live_time_is_plexibity'=>((isset($request->live_time_is_plexibity) && !empty
                    ($request->live_time_is_plexibity)) ?1:NULL),
                'program_organizer' => json_encode($manage,true),
                'recording_stabilty'=>$request->recording_stabilty,
                'record_type'=>$request->record_type,
                'created_by'=>(!empty(Session::get('user_info')->employee_primary_id)?Session::get('user_info')
                    ->employee_primary_id:NULL),
                'created_time'=>date('Y-m-d H:i:s'),
                'created_ip'=>(!empty(Employee::getIp()))?Employee::getIp():$request->ip(),
            ];

         //    dd($program_planning_info);

            // DB::table('program_planning_infos')->insert($program_planning_info);


            $artist_infos = json_decode($request->biboron_data);
            //dd($artist_infos);

            DB::beginTransaction();
            DB::table('program_planning_infos')->insert($program_planning_info);
            $id = DB::getPdo()->lastInsertId();
            $artist_infos_details = [];
            $sl=1;
            foreach($artist_infos as $key => $row) {

                $rate_chart = DB::table("setup_artist_rate_chart")->where([
                    'ctg_id' => $row->artis_ctg_id,
                    'description' => $row->biboron,
                    'grade_id' => $row->grade_id,
                    'stability' => $row->stability,
                ])->first();
                $record_data = [];

                if(!empty($row->racording_date_add)) {
                    foreach ($row->racording_date_add as $key=> $value) {
                        $record_data[] = [
                            'date' => $value,
                            'time' => $row->recorded_time_add[$key],
                            'attend_date' => null
                        ];
                    }
                }


                $live_data = [];
                if(!empty($request->boardcasting_date)) {
                    foreach ($request->boardcasting_date as $value) {
                        $live_data[] = [
                            'date' => $value,
                            'time' => $request->live_time,
                            'attend_date' => null
                        ];
                    }
                }

                $artist_infos_details[] = [
                    'planning_info_id' => $id,
                    'description_id' => $row->biboron,
                    'artist_serial_no' =>  str_pad($sl, 2, '0', STR_PAD_LEFT),
                    'artist_id' => $row->artist_id,
                    'artist_rate_chart_id' => is_null($rate_chart)?null:$rate_chart->id,
                    'artist_grade' => $row->grade_id,
                    'artist_grade_amount' => $row->ounarisom,
                    'mohoda_amount'=> $row->mohoda_fee,
                    'work_area_id' => json_encode($row->work_area),
                    'artist_ctg_id' => $row->artis_ctg_id,
                    'artist_vumika_id' => $row->vumika,
                    'record_date_log' => (!empty($record_data) ?json_encode($record_data,true):NULL),
                    'live_date_log'  => (!empty($live_data) ?json_encode($live_data,true):NULL),
                    'artist_ta_amount' => $row->ta_amount,
                    'artist_da_amount' => $row->da_amount,
                    'is_active' => 1,
                    'total_amount' => $row->total_amount,
                    'has_mohoda_fee' => $row->has_mohoda_fee,
                    'mohoda_date_add' => empty($row->mohoda_date_add) ? NULL  : json_encode($row->mohoda_date_add),
                    'number_of_days' => $row->number_of_days,
                    'khetab_prapto' => $row->khetabPrapto,
                    'created_by' => (!empty(Session::get('user_info')->employee_primary_id)?Session::get('user_info')
                        ->employee_primary_id:NULL),
                    'created_time' => date('Y-m-d H:i:s'),
                    'created_ip' => (!empty(Employee::getIp())) ? Employee::getIp() : $request->ip(),
                ];

                $sl++;
            }

            DB::table("program_planning_artist_infos")->insert($artist_infos_details);
            DB::commit();
            $success_output = 'Successfully update information';

        }
        $output = array(
            'error'     =>  $error_array,
            'success'   => $success_output ,
            'redirect_page'   => 'program_magazine_create'
        );
        echo json_encode($output);

    }



    public function save_program_planning_info_update_new(Request $request){

        // dd($request);
        $validate_array =  [
            'program_name'  => 'required',
            'station_id' => 'required',
            'biboron_data'=>'required',
            'program_planing_id'=>'required'
        ];

        if(isset($request->is_fixed_program)) {
            $validate_array['fixed_program_type'] = 'required';
        }

        $error_array = array();

        if($request->biboron_data=='') {
            $error_array[] = "Biboron Data Not Found";
            $output = array(
                'error'     =>  $error_array,
                'success'   => '' ,
                'redirect_page'   => 'program_magazine_create_form_new'
            );
            echo json_encode($output);
            exit;
        }
        else {
            $decode = json_decode($request->biboron_data,true);
            if(empty($decode)){
                $error_array[] = "Biboron Data Not Found";
                $output = array(
                    'error'     =>  $error_array,
                    'success'   => '' ,
                    'redirect_page'   => 'program_magazine_create_form_new'
                );
                echo json_encode($output);
                exit;
            }
        }

        $validation = Validator::make($request->all(),$validate_array);

        $success_output = '';
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }else {

            $manage = [
                6=>[],
                1=>[],
                2=>[],
                3=>[],
                4=>[],
                5=>[]
            ];

            $magazine_manage = $request->magazine_manage;

            foreach($manage as $key => $value) {
                if(isset($magazine_manage[$key])) {
                    $manage[$key] = $magazine_manage[$key];
                }
            }

            $program_planning_info = [
                'station_id' => $request->station_id,
                'program_identity' => Program_schedule_info::get_program_identity( $request->station_id) ,
                'entry_date'=>date('Y-m-d'),
                'fixed_program_type_id' => isset($request->is_fixed_program)? $request->fixed_program_type:NULL,
                'sub_fixed_program_type_id' => isset($request->sub_fixed_program_type)? $request->sub_fixed_program_type:NULL,

                'program_name'=>$request->program_name,
                'program_type'=>$request->program_type,
                'program_style'=>null,
                'larget_viewer'=>$request->larget_viewer,
                'recorded_date'=>(!empty($request->recorded_date))?date('Y-m-d',strtotime($request->recorded_date)):NULL,
                'recorded_time'=>$request->recorded_time,
                'live_date'=>(!empty($request->live_date))?date('Y-m-d',strtotime($request->live_date)):NULL,
                'live_time'=>$request->live_time,
                'recording_date_is_plexibity'=>((isset($request->recording_date_is_plexibity) && !empty
                    ($request->recording_date_is_plexibity)) ?1:NULL),
                'recording_time_is_plexibity'=>((isset($request->recording_time_is_plexibity) && !empty
                    ($request->recording_time_is_plexibity)) ?1:NULL),
                'live_date_is_plexibity'=>((isset($request->live_date_is_plexibity) && !empty
                    ($request->live_date_is_plexibity)) ?1:NULL),
                'live_time_is_plexibity'=>((isset($request->live_time_is_plexibity) && !empty
                    ($request->live_time_is_plexibity)) ?1:NULL),
                'program_organizer' => json_encode($manage,true),
                'recording_stabilty'=>$request->recording_stabilty,
                'record_type'=>$request->record_type,
                'created_by'=>(!empty(Session::get('user_info')->employee_primary_id)?Session::get('user_info')
                    ->employee_primary_id:NULL),
                'created_time'=>date('Y-m-d H:i:s'),
                'created_ip'=>(!empty(Employee::getIp()))?Employee::getIp():$request->ip(),
            ];
            $artist_infos = json_decode($request->biboron_data,true);
            // dd($artist_infos);

            DB::beginTransaction();

            DB::table('program_planning_infos')
                ->where(['id'=>$request->program_planing_id])
                ->update($program_planning_info);

            $id = $request->program_planing_id;

            DB::table("program_planning_artist_infos")
                ->where(['planning_info_id'=>$id])
                ->update([
                    'is_active' => 0
                ]);

            $artist_infos_details = [];

            foreach($artist_infos as $key => $row) {

                $rate_chart = DB::table("setup_artist_rate_chart")->where([
                    'ctg_id' => $row['artist_ctg_id'],
                    'description' => $row['description_id'],
                    'grade_id' => $row['artist_grade'],
                    'stability' => $row['stability'],
                ])->first();

                // dd($rate_chart);

                foreach($row['artist_ids'] as $artist_id) {

                    $mohoda_count = !empty($row->mohoda)?count(explode(",",$row->mohoda)):0;

                    $mohoda_fee = $rate_chart->mohoda_fee>0 ? $rate_chart->mohoda_fee: 0;

                    $artist_infos_details[] = [
                        'planning_info_id' => $id,
                        'description_id' => $row['description_id'],
                        'artist_id' => $artist_id,
                        'artist_rate_chart_id' => is_null($rate_chart)?null:$rate_chart->id,
                        'mohoda_ids' => !empty($row['mohoda_ids']) ? $row['mohoda_ids'] :null,
                        'artist_grade' => $row['artist_grade'],
                        'artist_grade_amount' => $row['artist_grade_amount'],
                        'mohoda_amount'=> ($mohoda_fee*$mohoda_count),
                        'work_area_id' => json_encode(json_decode($row['work_area_id'],true)),
                        'artist_ctg_id' => $row['artist_ctg_id'],
                        'artist_vumika_id' => json_encode(json_decode($row['artist_vumika_id'],true)),
                        'artist_ta_amount' => Null,
                        'artist_da_amount' => Null,
                        'is_active' => 1,
                        'created_by' => (!empty(Session::get('user_info')->employee_primary_id)?Session::get('user_info')
                            ->employee_primary_id:NULL),
                        'created_time' => date('Y-m-d H:i:s'),
                        'created_ip' => (!empty(Employee::getIp())) ? Employee::getIp() : $request->ip(),
                    ];
                }
            }
            // dd($artist_infos_details);
            DB::table("program_planning_artist_infos")->insert($artist_infos_details);

            DB::commit();
            $success_output = 'Successfully update information';

        }
        $output = array(
            'error'     =>  $error_array,
            'success'   => $success_output ,
            'redirect_page'   => 'program_magazine_create'
        );
        echo json_encode($output);
    }


    public function get_vumika_info(Request $request) {
        $results = DB::table("all_sttings")->where("id",$request->id)->first();
        $vumika_info = DB::table("all_sttings")->where("id",$results->rate_vumika)->first();
        echo json_encode($vumika_info);
    }


    public function re_status_update_presentation_info(request $request){
        if (!empty($request->month_id) && !empty($request->station_id) && !empty($request->is_active)) {

            $employee_id=Session::get('user_info')->employee_id;
            $employee_name=Session::get('user_info')->name;
            if(empty($employee_id)){
                return json_encode(['status' => 'error', 'message' => 'Employee Id is Required']);
            }

            $presentation_current_info=Program_schedule_info::get_program_presentation_single_info_first_row(['program_presentation_infos.station_id'=>$request->station_id,'months'=>$request->month_id,'is_active'=>$request->is_active]);
            dd($request);
            if($presentation_current_info->is_active!=$request->is_active){
                return json_encode(['status' => 'error', 'message' => 'You are not eligible for update this.']);
            }
            $all_re_log_data=(!empty($presentation_current_info->re_log_info))
                ?json_decode($presentation_current_info->re_log_info):NULL;

            $data['updated_time']= date('Y-m-d H:i:s');
            $data['updated_by']= !empty(Session::get('user_info')->employee_primary_id)?Session::get('user_info')
                ->employee_primary_id:NULL;
            $log_info=[
              'is_re_status'    =>  $request->is_active,
              'employee_id'     =>  $employee_id,
              'update_date'     =>  date('Y-m-d H:i:s'),
              'update_ip'       =>  (!empty(Employee::getIp()))?Employee::getIp():$request->ip(),
            ];
            $all_re_log_data[]=$log_info;
            $data['re_log_info']=!empty($all_re_log_data)?json_encode($all_re_log_data):NULL;
            if($request->is_active==2){
                $data['is_active']= 1;
                $data['is_re_planning']= 1;
                $message='Successfully  Presentation Re Planning by '.$employee_name;
            }
            if($request->is_active==3){
                $data['is_active']= 2;
                $data['is_re_proposal']= 1;
                $message='Successfully Presentation Re Proposal  by '.$employee_name;
            }
            if(!empty($data)) {
                DB::table('program_presentation_infos')->where(['months'=> $request->month_id,'station_id'=>$request->station_id])->update($data);
                return json_encode(['status' => 'success', 'message' => $message]);
            }else{
                return json_encode(['status' => 'error', 'message' => 'Failed, Approved information']);
            }
        } else {
            return json_encode(['status' => 'error', 'message' => 'Failed, Approved information']);
        }
    }

    public function program_adhok_presentation_add(){
        $presentation_ctg = All_stting::get_settings_info(['type'=>15,'is_active'=>1,'id'=>91]);
        $presentation_description_ctg = All_stting::get_settings_info(['parent_id'=>91,'is_active'=>1]);
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);
        return view('program.adhok.program_adhok_presentation_add',['presentation_ctg'=>$presentation_ctg,'presentation_description_ctg'=>$presentation_description_ctg,
            'station_info'=>$station_info]);

    }
    public function get_fequency_wise_presentation_info(request $request){
        $all_presenation_info=Program_schedule_info::all_presentation_info(['program_presentation_infos.station_id'=>$request->station_id,'program_presentation_infos.sub_station_id'=>$request->fequencey]);
        if(!empty($all_presenation_info)){
            echo json_encode(['status'=>'success','data'=>$all_presenation_info]);
        }else{
            echo json_encode(['status'=>'error','data'=>'']);
        }
    }
    public function searching_adhok_presentation_info(request $request){


        $param=[
            'program_presentation_infos.presentration_type'=>1,
            'program_presentation_infos.station_id'=>$request->station_id,
            'program_presentation_infos.sub_station_id'=>$request->sub_station_id,
            'program_presentation_infos.presentation_date'=>date('Y-m-d',strtotime
            ($request->presentation_date))
        ];
       // dd($param);
        $presentation_data =Program_schedule_info::get_program_presentation_info_report_artist($param) ;
        $data=[];
        $role_tile_info=[];
        if(!empty($presentation_data)){
            foreach ($presentation_data as $all_data){
                if(!in_array($all_data->role_title,$role_tile_info)) {
                    $role_tile_info[] = $all_data->role_title;
                }
                $data[$all_data->presentation_date][$all_data->odivision_id][$all_data->role_title][]=[
                  'artist_info_primary_id'=>  $all_data->id,
                  'artist_id'=>  $all_data->artist_id,
                  'name_bn'=>  $all_data->name_bn,
                ];
            }
        }

        return view('program.adhok.show_adhok_presentation_info',
            [
                'presentation_info'=>$data,
                'role_tile_info'=>$role_tile_info,
            ]
        );
    }
    public function adhok_date_wise_presentation_info(request $request){
        $host = request()->getHttpHost();
        $atrist_info_data  =  Employee::get_artist_select_presentation_adhok(['station_id'=>$request->station_id]);
        if($host=='localhost') {
            $atrist_info_data = json_decode($atrist_info_data, true);
        }
        if(!empty($atrist_info_data)){
            $atrist_info_info=array_column($atrist_info_data,"name_bn","id");
        }
        $data=[
            'presentation_date'=>$request->presentation_date,
            'station_id'=>$request->station_id,
            'sub_station_id'=>$request->sub_station_id,
            'presentation_id'=>$request->presentation_id,
        ];
        $presention_setting_info=Program_schedule_info::get_program_presentation_single_setting(['program_presentation_setting.station_id'=>$request->station_id,'program_presentation_setting.is_active'=>1,'program_presentation_setting.fequencey_id'=>$request->sub_station_id]);
        $setting_content=(!empty($presention_setting_info->content_info))?$presention_setting_info->content_info:NULL;
        return view('program.adhok.attach_adhok_presentation_info',
            [
                'data'=>$data,
                'atrist_info_info'=>$atrist_info_info,
                'setting_content'=>$setting_content,
            ]
        );
    }



    public function program_adhok_presentation_create()
    {
        $presentation_info=Program_schedule_info::get_all_presentation_info(['program_presentation_infos.is_active'=>1],2);
        $employee_info = Employee::get_employee_info_name(['is_active'=>1]);
        return view('program.adhok.program_adhok_presentation_create',
            [
                'presentation_info'=>$presentation_info,
                'employee_info'=>$employee_info
            ]
        );
    }
    public function presentation_adhok_proposal_info()
    {
        $presentation_info=Program_schedule_info::get_all_presentation_info(['program_presentation_infos.is_active'=>2]);
        return view('program.adhok.presentation_proposal_info',
            [
                'presentation_info'=>$presentation_info,
            ]
        );
    }
    public function presentation_adhok_contract_info()
    {
        $presentation_info=Program_schedule_info::get_all_presentation_info(['program_presentation_infos.is_active'=>3]);
        return view('program.adhok.presentation_contract_info',
            [
                'presentation_info'=>$presentation_info,
            ]
        );
    }
    // বিকল্প
    public function program_bikolpo_presentation_record(){
        $presentation_info=Program_schedule_info::get_all_presentation_info(['program_presentation_infos.is_bikolpo'=>1,'program_presentation_infos.bikolpo_status'=>1],1);
        $employee_info = Employee::get_employee_info_name(['is_active'=>1]);
        return view('program.bikolpo.program_bikolpo_presentation_record',
            [
                'presentation_info'=>$presentation_info,
                'employee_info'=>$employee_info
            ]
        );
    }
    public function program_bikolpo_proposal_record(){
        $presentation_info=Program_schedule_info::get_all_presentation_info(['program_presentation_infos.is_bikolpo'=>1,'program_presentation_infos.bikolpo_status'=>2],1);
        $employee_info = Employee::get_employee_info_name(['is_active'=>1]);
        return view('program.bikolpo.program_bikolpo_proposal_record',
            [
                'presentation_info'=>$presentation_info,
                'employee_info'=>$employee_info
            ]
        );
    }
    public function program_bikolpo_contract_record(){
        $presentation_info=Program_schedule_info::get_all_presentation_info(['program_presentation_infos.is_bikolpo'=>1,'program_presentation_infos.bikolpo_status'=>3],1);
        $employee_info = Employee::get_employee_info_name(['is_active'=>1]);
        return view('program.bikolpo.program_bikolpo_contract_record',
            [
                'presentation_info'=>$presentation_info,
                'employee_info'=>$employee_info
            ]
        );
    }


    public function program_bikolpo_presentation_add(){
        $presentation_ctg = All_stting::get_settings_info(['type'=>15,'is_active'=>1,'id'=>91]);
        $presentation_description_ctg = All_stting::get_settings_info(['parent_id'=>91,'is_active'=>1]);
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);
        return view('program.bikolpo.program_bikolpo_presentation_add',['presentation_ctg'=>$presentation_ctg,'presentation_description_ctg'=>$presentation_description_ctg,
            'station_info'=>$station_info]);

    }
    public function searching_bikolpo_presentation_info(request $request){
        if(empty($request->presentration_date)){
            return "Presentration Date is required";
        }
        if(empty($request->station_id)){
            return "Station No is required";
        }
        if(empty($request->sub_station_id)){
            return "Fequencey is required";
        }

        $param=[
            'program_presentation_infos.presentation_date'=>date('Y-m-d',strtotime($request->presentration_date)),
            'program_presentation_infos.station_id'=>$request->station_id,
            'program_presentation_infos.sub_station_id'=>$request->sub_station_id,
        ];

        $presentation_data =Program_schedule_info::get_program_presentation_info_report_artist($param) ;
        $data=[];
        $role_tile_info=[];
        if(!empty($presentation_data)){
            foreach ($presentation_data as $all_data){
                if(!in_array($all_data->role_title,$role_tile_info)) {
                    $role_tile_info[] = $all_data->role_title;
                }
                $data[$all_data->presentation_date][$all_data->odivision_id][$all_data->role_title][]=[
                    'artist_info_primary_id'=>  $all_data->artist_info_id,
                    'artist_id'=>  $all_data->artist_id,
                    'name_bn'=>  $all_data->name_bn,
                    'is_bikolpo'=>  $all_data->is_bikolpo,
                    'bikolpo_artist_info'=>  $all_data->bikolpo_artist_info,
                ];
            }
        }
        $host = request()->getHttpHost();
        $atrist_info_data  =  Employee::get_artist_select_presentation_adhok(['station_id'=>$request->station_id]);
        if($host=='localhost') {
            $atrist_info_data = json_decode($atrist_info_data, true);
        }
        if(!empty($atrist_info_data)){
            $atrist_info_info=array_column($atrist_info_data,"name_bn","id");
        }

        return view('program.bikolpo.show_bikolpo_presentation_info',
            [
                'atrist_info_info'=>$atrist_info_info,
                'presentation_info'=>$data,
                'role_tile_info'=>$role_tile_info,
            ]
        );
    }

    public function save_bikolpo_presentation_info(request $request){
        $validate_array =  [
            'station_id'  => 'required',
            'sub_station_id'  => 'required',
            'presentration_date'  => 'required',
        ];
        $error_array = [];
        $success_output = '';
        $employee_id= !empty(Session::get('user_info')->employee_id)?Session::get('user_info')
            ->employee_id:NULL;
        if(empty($employee_id)){
            $error_array[]='Employee id is required';
        }
        $validation = Validator::make($request->all(),$validate_array);
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        } else {
            $param_main=[
              'program_presentation_infos.station_id'=>  $request->station_id,
              'program_presentation_infos.sub_station_id'=>  $request->sub_station_id,
              'program_presentation_infos.presentation_date'=> date('Y-m-d',strtotime($request->presentration_date)) ,
              'program_presentation_infos.presentration_type'=>  1,
            ];
            $presentation_single_date_info=Program_schedule_info::get_program_presentation_single_info_first_row
            ($param_main);
            if(!empty($presentation_single_date_info->id)) {
                DB::beginTransaction();
                $data = [
                    'presentation_bikolpo_id' =>'bikolpo-'.
                        Program_schedule_info::get_presentation_identity(
                            $request->station_id, $request->sub_station_id),

                    'is_bikolpo' => 1,
                    'bikolpo_created_by' => $employee_id,
                    'bikolpo_created_time' => date('Y-m-d H:i:s'),
                    'bikolpo_created_ip' => (!empty(Employee::getIp())) ? Employee::getIp() : $request->ip(),
                 ];
                DB::table('program_presentation_infos')
                ->where([
                    'id' => $presentation_single_date_info->id,
                ])->update($data);

                    if(!empty($request->bikolpo_artist_info)){
                    $serial_no=1;
                    foreach ($request->bikolpo_artist_info as $key => $present_artist_id){
                            if(!empty($present_artist_id)) {
                                $bikolpo_artist_info[] = [
                                    'artist_infos_id' => $key,
                                    'artist_id' => $present_artist_id,
                                ];
                                $atrist_info_grade =  Employee::get_single_artist_select_presentation
                                (['id'=>$present_artist_id]);
                                $param_info=[
                                    'ctg_id'=>91, // hard code for presentation id
                                    'description'=> $presentation_single_date_info->presentation_description_id,
                                    'grade_id'=> $atrist_info_grade,
                                ];

                                $rate_chart= Program_schedule_info::get_single_rate_chart_info($param_info);
                                if(!empty($rate_chart)){
                                    $rate_chart_id=$rate_chart->id;
                                    $amount=$rate_chart->amount;
                                }else{
                                    $rate_chart_id=NULL;
                                    $amount='0.00';
                                }
                                $final_artist= [
                                     'artist_serial_no' => date
                                        ('d',strtotime($presentation_single_date_info->presentation_date)).$serial_no,
                                    'artist_id' => $present_artist_id,
                                    'artist_rate_chart_id' => is_null($rate_chart_id)?NULL:$rate_chart_id,
                                    'artist_grade' => $atrist_info_grade,
                                    'artist_grade_amount' => $amount,
                                    'artist_ta_amount' => '0.00',
                                    'artist_da_amount' => '0.00',
                                    'is_active' => 1,
                                    'created_by' => (!empty(Session::get('user_info')->employee_primary_id)?Session::get('user_info') ->employee_primary_id:NULL),
                                    'created_time' => date('Y-m-d H:i:s'),
                                    'created_ip' => (!empty(Employee::getIp())) ? Employee::getIp() : $request->ip(),
                                ];
                                $bikolpo_artist_data=[
                                    'is_bikolpo'=>1,
                                    'bikolpo_artist_info'=>(!empty($final_artist))?json_encode($final_artist,JSON_UNESCAPED_UNICODE ):NULL
                                ];
                                $serial_no++;
                            }else{
                                $bikolpo_artist_data=[
                                    'is_bikolpo'=>NULL,
                                    'bikolpo_artist_info'=>NULL
                                ];
                            }
                            DB::table('program_planning_artist_infos')
                            ->where([
                                'id' => $key,
                            ])->update($bikolpo_artist_data);
                    }
                }
                $success_output = 'Successfully Saved Presentation Information';
             DB::commit();
            } else {
                $error_array[] = 'Sorry!! Presentation Entry Failed to Update';
            }
        }
        $output = array(
            'error'             =>  $error_array,
            'success'           =>  $success_output ,
            'redirect_page'     => 'program_bikolpo_presentation_record'
        );
        echo json_encode($output);
    }

    public function bikolpo_presentation_info_report($month , $station , $fequency_id, $type=1  ) {
        $presentation_info =Program_schedule_info::get_program_presentation_info_report_artist([
            'program_presentation_infos.months'=>$month,
            'program_presentation_infos.station_id'=>$station,
            'program_presentation_infos.sub_station_id'=>$fequency_id,
            'program_presentation_infos.presentration_type'=>1,
            'program_presentation_infos.is_bikolpo'=>1
        ]) ;
        $presentation_heading_info =Program_schedule_info::get_program_presentation_heading_info([
            'program_presentation_infos.months'=>$month,
            'program_presentation_infos.station_id'=>$station,
            'program_presentation_infos.sub_station_id'=>$fequency_id,
            'program_presentation_infos.presentration_type'=>1,
            'program_presentation_infos.is_bikolpo'=>1
        ]) ;
        $role_title_array = [];
        $all_artist_info=[];
        // dd($presentation_info);
        if(!empty($presentation_info)) {
            foreach ($presentation_info as $key => $artist_info) {
                if(!in_array($artist_info->role_title,$role_title_array)) {
                    $role_title_array[] = $artist_info->role_title;
                }
                $all_artist_info[$artist_info
                    ->odivision_id][$artist_info->presentation_days][$artist_info->presentation_date][$artist_info->role_title][] = [
                    'artist_id' => $artist_info->artist_id,
                    'name_bn' => $artist_info->name_bn,
                    'bikolpo_artist_info' => (!empty($artist_info->bikolpo_artist_info))?
                        $artist_info->bikolpo_artist_info:NULL

                ];
            }
        }
        $employee_info = Employee::get_employee_info_name(['is_active'=>1]);
        $program_artist_info = Employee::get_artist_select(['is_active'=>1]);
        return view('program.presentation.bikolpo_presentation_report',[
            'presentation_info'=>$all_artist_info,
            'presentation_heading_info'=>$presentation_heading_info,
            'role_title_array'=>$role_title_array,
            'employee_info'=>$employee_info,
            'program_artist_info'=>$program_artist_info,
        ]);
    }

    public function bikolpo_presentation_info_report_date($month , $station,  $fequency_id, $type=1  ) {

        $atrist_info_info = Employee::get_artist_select();
        $presentation_info =Program_schedule_info::get_program_presentation_info_report_artist([
            'program_presentation_infos.months'=>$month,
            'program_presentation_infos.station_id'=>$station,
            'program_presentation_infos.sub_station_id'=>$fequency_id,
            'program_presentation_infos.presentration_type'=>1,
            'program_presentation_infos.is_bikolpo'=>1
        ]) ;
        $role_title_array = [];
        $all_artist_info=[];
        // dd($presentation_info);
        if(!empty($presentation_info)) {
            foreach ($presentation_info as $key => $artist_info) {
                if(!in_array($artist_info->role_title,$role_title_array)) {
                    $role_title_array[] = $artist_info->role_title;
                }
                $all_artist_info[$artist_info->presentation_date][$artist_info
                    ->odivision_id][$artist_info->role_title][] = [
                    'artist_id' => $artist_info->artist_id,
                    'name_bn' => $artist_info->name_bn,
                    'bikolpo_artist_info' => (!empty($artist_info->bikolpo_artist_info))?
                        $artist_info->bikolpo_artist_info:NULL

                ];
            }
        }

        $presentation_heading_info =Program_schedule_info::get_program_presentation_heading_info([
            'program_presentation_infos.months'=>$month,
            'program_presentation_infos.station_id'=>$station,
            'program_presentation_infos.sub_station_id'=>$fequency_id,
            'program_presentation_infos.presentration_type'=>1,
            'program_presentation_infos.is_bikolpo'=>1
        ]) ;

        $employee_info = Employee::get_employee_info_name(['is_active'=>1]);
        return view('program.presentation.bikolpo_presentation_info_report_date',[
            'presentation_info'=>$all_artist_info,
            'presentation_heading_info'=>$presentation_heading_info,
            'role_title_array'=>$role_title_array,
            'atrist_info_info'=>$atrist_info_info,
            'employee_info'=>$employee_info
        ]);
    }
    public function bikolpo_presentation_info_report_artist($month , $station,$fequency_id, $type=1  ) {
        $atrist_info_info = Employee::get_artist_select();

        $presentation_info =Program_schedule_info::get_program_presentation_info_report_artist([
            'program_presentation_infos.months'=>$month,
            'program_presentation_infos.station_id'=>$station,
            'program_presentation_infos.sub_station_id'=>$fequency_id,
            'program_presentation_infos.presentration_type'=>1,
            'program_presentation_infos.is_bikolpo'=>1
        ]) ;



        $presentation_heading_info =Program_schedule_info::get_program_presentation_heading_info([
            'program_presentation_infos.months'=>$month,
            'program_presentation_infos.station_id'=>$station,
            'program_presentation_infos.sub_station_id'=>$fequency_id,
            'program_presentation_infos.presentration_type'=>1,
            'program_presentation_infos.is_bikolpo'=>1
        ]) ;
        $odivision_array = [];
        $all_artist_info=[];
        if(!empty($presentation_info)) {
            foreach ($presentation_info as $key => $artist_info) {
                if(!in_array($artist_info->odivision_id,$odivision_array)) {
                    $odivision_array[] = $artist_info->odivision_id;
                }
             //   print_r($artist_info->bikolpo_artist_info);
               $bikolpo_artist=(!empty($artist_info->bikolpo_artist_info))
                   ?json_decode( $artist_info->bikolpo_artist_info,true):NULL;
                if(!empty($bikolpo_artist)) {
                    $artist_name = !empty($bikolpo_artist['artist_id']) && !empty($atrist_info_info[$bikolpo_artist['artist_id']])
                        ? $atrist_info_info[$bikolpo_artist['artist_id']] : NULL;

                    $all_artist_info[$artist_info->role_title][$artist_name
                    . '-' . $bikolpo_artist['artist_id']][$artist_info->odivision_id][] = [
                        'presentation_date' => $artist_info->presentation_date,

                    ];
                }
            }
        }
        $employee_info = Employee::get_employee_info_name(['is_active'=>1]);
        return view('program.presentation.bikolpo_presentation_info_report_artist',[
            'presentation_info'=>$all_artist_info,
            'odivision' => $odivision_array,
            'presentation_heading_info'=>$presentation_heading_info,
            'employee_info'=>$employee_info,

        ]);
    }

    public function status_update_presentation_info_bikolpo(request $request){
        if (!empty($request->month_id) && !empty($request->station_id) && !empty($request->fequency) && !empty
            ($request->is_bikolpo)) {
            $employee_id=Session::get('user_info')->employee_id;
            $employee_name=Session::get('user_info')->name;
            if(empty($employee_id)){
                return json_encode(['status' => 'error', 'message' => 'Employee Id is Required']);
            }
            $message='Successfully Approved Presentation Information';
            $update_data['bikolpo_status']=(int)$request->is_bikolpo;
            $data['bikolpo_status']=(int)$request->is_bikolpo;
            $data['updated_time']= date('Y-m-d H:i:s');
            $data['updated_by']= $employee_id;
            if($request->is_bikolpo==2){
                $data['type']= 'Proposal';
                $data['approved_by']= $employee_id;
                $data['approved_dt']= date('Y-m-d H:i:s');
                $message='Successfully Approved Presentation Planning by '.$employee_name;
            }
            if($request->is_bikolpo==3){
                $data['type']= 'Contract';
                $data['approved_by']= $employee_id;
                $data['approved_dt']= date('Y-m-d H:i:s');
                $message='Successfully Presentation Proposal Approved by '.$employee_name;
            }
            if($request->is_bikolpo==4){
                $data['approved_by']= $employee_id;
                $data['approved_dt']= date('Y-m-d H:i:s');
                $message='Successfully  Presentation Contract Approved by '.$employee_name;
            }

            $get_existing_bikolpo_info =Program_schedule_info::get_program_presentation_single_info_first_row([
                'program_presentation_infos.months'=> $request->month_id,
                'program_presentation_infos.station_id'=> $request->station_id,
                'program_presentation_infos.sub_station_id'=>$request->fequency,
                'program_presentation_infos.presentration_type'=>1,
                'program_presentation_infos.is_bikolpo'=>1
            ]) ;
            $bikolpo_update_log=(!empty($get_existing_bikolpo_info->bikolpo_updated_log_info))?json_decode
            ($get_existing_bikolpo_info->bikolpo_updated_log_info,true):NULL;
            if(!empty($data)){
                $bikolpo_update_log[]=$data;
            }

            if(!empty($bikolpo_update_log) && !empty($update_data['bikolpo_status'])){
                $info=[
                  'bikolpo_status'  => $update_data['bikolpo_status'],
                  'bikolpo_updated_log_info'  => (!empty($bikolpo_update_log))?json_encode($bikolpo_update_log):NULL,
                  'updated_time'  => date('Y-m-d H:i:s'),
                  'updated_by'  => !empty(Session::get('user_info')->employee_primary_id)?Session::get('user_info')
                      ->employee_primary_id:NULL,

                ];
            }
            if(!empty($info)) {
                DB::table('program_presentation_infos')->where(['months'=> $request->month_id,'station_id'=>$request->station_id,'sub_station_id'=>$request->fequency,'is_bikolpo'=>1])->update
                ($info);
                return json_encode(['status' => 'success', 'message' => $message]);
            }else{
                return json_encode(['status' => 'error', 'message' => 'Failed, Approved information']);
            }
        } else {
            return json_encode(['status' => 'error', 'message' => 'Failed, Approved information']);
        }
    }
    
    public function show_all_playlist_info(request $request){
        if(!empty($request->term)) {
            $results=Program_schedule_info::searching_playlist_info($request->term);
            echo json_encode($results);
        }else{
            return false;
        }

    }
    public function searching_artist_info(request $request){
        if(!empty($request->term)) {
            $results=Employee::searching_artist_info($request->term);
            echo json_encode($results);
        }else{
            return false;
        }
    }

}
