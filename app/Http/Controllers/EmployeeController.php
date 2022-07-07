<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Acc_chart_of_account;
use App\Employee;
use App\Company_info;
use App\Branch_info;
use App\All_stting;
use App\Employess_general_info;
use App\User;
use App\Monthly_opening;
use Datatables;
use Mail;
use Validator;
use PDF;
use Excel;
use Session;
use Intervention\Image\ImageManagerStatic as Image;
use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use \Milon\Barcode\DNS1D;

class EmployeeController extends Controller
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
            return view('template.font_content_hr',['company_info'=>$company_info,]);
        }
    }

    public function employee_info(){
        $branch_info = Branch_info::branch_info_select(['is_active'=>1]);
        $district_info=All_stting::get_district();
        $catre_ctg=All_stting::get_settings_info(['type'=>13,'is_active'=>1]);
        $nationality_info= All_stting::get_settings_info(['type'=>4,'is_active'=>1]);

        return view('employee.employee_info',['branch_info'=>$branch_info,'all_district'=>$district_info,'catre_ctg'=>$catre_ctg,'nationality'=>$nationality_info]);
    }


    public function save_employee_education(request $request){
        $error_array=[];
        $success_output='';
        if(empty($request->degree_name[0])){
            $error_array[] = 'Degree name is required';
        }if(empty($request->major_subject[0])){
            $error_array[] = 'Major subject is required';
        }else {
            $education_details = array();
            $i = 1;
            if (!empty($request->degree_name)) {
                foreach ($request->degree_name as $key => $value) {
                    if (!empty($value)) {
                        $education_details[] = [
                            'degree_name' => $value,
                            'major_subject' => $request->major_subject[$key],
                            'institution' => $request->board_subject[$key],
                            'passing_year' => $request->passing_year[$key],
                            'result' => $request->result_year[$key],
                            'cgpa' => $request->gpa[$key],
                            'sorting' => $i,
                            'created_by' => (!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                            'created_time' => date('Y-m-d H:i:s'),
                        ];
                        $i++;
                    }

                }
            }

            DB::beginTransaction();
            $education_info = [
                'employee_id' => $request->employee_id,
                'education_info' => (!empty($education_details)) ? json_encode($education_details,JSON_UNESCAPED_UNICODE) : NULL,
                'created_by' => (!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                'created_at' => date('Y-m-d H:i:s'),
            ];

            DB::table('employess_general_infos')->where('employee_id', $request->employee_id)->update($education_info);
            DB::commit();
            $success_output='Successfully update information';
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   => $success_output ,
            'redirect_page'   => ''
        );
        echo json_encode($output);
    }

    public function save_employee_training_info(request $request){
        $error_array=[];
        $success_output='';
        if(empty($request->training_type[0])){
            $error_array[] = 'Training Type is required';
        }if(empty($request->training_title[0])){
            $error_array[] = 'Training title is required';
        }else {
            $training_details = array();
            $i = 1;
            if (!empty($request->training_type)) {
                foreach ($request->training_type as $key => $value) {
                    if (!empty($value)) {
                        $training_details[] = [
                            'training_type' => $value,
                            'training_title' => $request->training_title[$key],
                            'institute_name' => $request->institute_name[$key],
                            'from_date' => $request->from_date[$key],
                            'to_date' => $request->to_date[$key],
                            'sorting' => $i,
                            'created_by' => (!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                            'created_time' => date('Y-m-d H:i:s'),
                        ];
                        $i++;
                    }
                }
            }
            DB::beginTransaction();
            if(!empty($training_details)) {
                $training_info = [
                    'employee_id' => $request->employee_id,
                    'training_info' => (!empty($training_details)) ? json_encode($training_details,JSON_UNESCAPED_UNICODE) : NULL,
                    'created_by' => (!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                    'created_at' => date('Y-m-d H:i:s'),
                ];

                DB::table('employess_general_infos')->where('employee_id', $request->employee_id)->update($training_info);
                DB::commit();
                $success_output = 'Successfully update information';
            }else{
                $success_output = 'Failed to update information';
            }
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   => $success_output ,
            'redirect_page'   => ''
        );
        echo json_encode($output);
    }

    public function save_employee_spouse_child_info(request $request){
        $validation = Validator::make($request->all(), [
            'spouse_name' => 'required',
            'spouse_mobile'  => 'required',
            'spouse_home_district'  => 'required',
        ]);
        $error_array = array();
        $success_output = '';
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }else {
            $spouse_info=[
              'spouse_name'=>$request->spouse_name,
              'spouse_occupation'=>$request->spouse_occupation,
              'spouse_mobile'=>$request->spouse_mobile,
              'spouse_designation'=>$request->spouse_designation,
              'spouse_home_district'=>$request->spouse_home_district,
              'spouse_organization'=>$request->spouse_organization,
              'spouse_address'=>$request->spouse_address,
            ];
            $child_details = array();
            $i = 1;
            if (!empty($request->childName)) {
                foreach ($request->childName as $key => $value) {
                    if (!empty($value)) {
                        $child_details[] = [
                            'childName' => $value,
                            'childSex' => $request->childSex[$key],
                            'child_birth_date' => $request->child_birth_date[$key],
                            'sorting' => $i,
                            'created_by' => (!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                            'created_time' => date('Y-m-d H:i:s'),
                        ];
                        $i++;
                    }
                }
            }


            DB::beginTransaction();
                $spouse_child_info = [
                    'employee_id' => $request->employee_id,
                    'spouse_info' => (!empty($spouse_info)) ? json_encode($spouse_info,JSON_UNESCAPED_UNICODE) : NULL,
                    'children_info' => (!empty($child_details)) ? json_encode($child_details,JSON_UNESCAPED_UNICODE) : NULL,
                    'created_by' => (!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                    'created_at' => date('Y-m-d H:i:s'),
                ];

                DB::table('employess_general_infos')->where('employee_id', $request->employee_id)->update($spouse_child_info);
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

    public function save_employee_expertise_info(request $request){
      //  dd($request);
        $validation = Validator::make($request->all(), [
            'employee_id' => 'required',
        ]);
        $error_array = array();
        $success_output = '';
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }else {
            $expertise_details = array();
            $i = 1;
            if (!empty($request->title)) {
                foreach ($request->title as $key => $value) {
                    if (!empty($value)) {
                        $expertise_details[] = [
                            'title' => $value,
                            'description' => $request->description[$key],
                            'sorting' => $i,
                            'created_by' => (!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                            'created_time' => date('Y-m-d H:i:s'),
                            'created_ip'=>(!empty($this->getIp()))?$this->getIp():$request->ip()
                        ];
                        $i++;
                    }
                }
            }


            DB::beginTransaction();
                $employee_expertise_info = [
                    'expertise_info' => (!empty($expertise_details)) ? json_encode($expertise_details,JSON_UNESCAPED_UNICODE) : NULL
                ];
                DB::table('employess_general_infos')->where('employee_id', $request->employee_id)->update($employee_expertise_info);
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

    public function save_employee_award_info(request $request){
      //  dd($request);
        $validation = Validator::make($request->all(), [
            'employee_id' => 'required',
        ]);
        $error_array = array();
        $success_output = '';
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }else {
            $details = array();
            $i = 1;
            if (!empty($request->title)) {
                foreach ($request->title as $key => $value) {
                    if (!empty($value)) {
                        $details[] = [
                            'title' => $value,
                            'description' => $request->description[$key],
                            'sorting' => $i,
                            'created_by' => (!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                            'created_time' => date('Y-m-d H:i:s'),
                            'created_ip'=>(!empty($this->getIp()))?$this->getIp():$request->ip()
                        ];
                        $i++;
                    }
                }
            }

            if(empty($details)){
                $error_array[] = "Minimum One Award Information is required";
            }

            DB::beginTransaction();
                 $details_info = [
                    'award_info' => (!empty($details)) ? json_encode($details,JSON_UNESCAPED_UNICODE) : NULL
                ];
                DB::table('employess_general_infos')->where('employee_id', $request->employee_id)->update($details_info);
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

    public function save_employee_travel_info(request $request){

        $validation = Validator::make($request->all(), [
            'type' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'purpose' => 'required',
            'employee_id' => 'required',
        ]);
        $error_array = array();
        $success_output = '';
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }else {
            $details = array();
            $employee_general_info = Employee::get_employee_general_setting_info(['employee_id'=>$request->employee_id]);
            $travel_info = (!empty($employee_general_info->travel_info)) ? json_decode
            ($employee_general_info->travel_info, true) : NULL;
            //dd($travel_info);
            if(empty($travel_info)) {
                $id=1;
            }else{
                $id=count($travel_info)+1;
            }
            $travel_info_add=   [
                'id' => $id,
                'type' => $request->type,
                'from_date' => $request->from_date,
                'to_date' => $request->to_date,
                'go_no' => (!empty($request->go_no) ? $request->go_no : ''),
                'country' => (!empty($request->country) ? $request->country : ''),
                'purpose' => $request->purpose,
                'is_active' => 1,
                'created_by' => (!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                'created_time' => date('Y-m-d H:i:s'),
                'created_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip()
            ];

            if(empty($travel_info)) {
                $details[] = $travel_info_add;
            }else{
                $travel_info[]=$travel_info_add;
                $details=$travel_info;
            }
            DB::beginTransaction();
                $details_info = [
                    'travel_info' => (!empty($details)) ? json_encode($details,JSON_UNESCAPED_UNICODE) : NULL
                ];
                DB::table('employess_general_infos')->where('employee_id', $request->employee_id)->update($details_info);
            DB::commit();
            $success_output = 'Successfully add information';
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   => $success_output ,
            'redirect_page'   => ''
        );
        echo json_encode($output);
    }

    public function delete_travel_info(request $request){
        if (!empty($request->id)) {
            $employee_general_info = Employee::get_employee_general_setting_info(['employee_id'=>$request->employee_id]);
            $travel_info = (!empty($employee_general_info->travel_info)) ? json_decode
            ($employee_general_info->travel_info, true) : NULL;
            if(!empty($travel_info)) {
                foreach ($travel_info as $key => $travel) {
                    if ($travel['id'] == $request->id) {
                        $travel_info[$key]['is_active'] = 0;
                        $travel_info[$key]['updated_by'] = (!empty(Auth::user()->id) ? Auth::user()->id : NULL);
                        $travel_info[$key]['updated_time'] = date('Y-m-d H:i:s');
                        $travel_info[$key]['updated_ip'] = (!empty($this->getIp())) ? $this->getIp() : $request->ip();
                    }
                }
            }

                if(!empty($travel_info)) {
                    $details_info = [
                        'travel_info' => (!empty($travel_info)) ? json_encode($travel_info, JSON_UNESCAPED_UNICODE) : NULL
                    ];
                    DB::beginTransaction();
                        DB::table('employess_general_infos')->where('employee_id', $request->employee_id)->update($details_info);
                    DB::commit();
                    return json_encode(['status' => 'success', 'message' => 'Successfully, delete information']);
                }else{
                    return json_encode(['status' => 'error', 'message' => 'Failed, delete information']);
                }

        } else {
            return json_encode(['status' => 'error', 'message' => 'Failed, delete information']);
        }
    }



    public function save_employee_promotion(request $request){
        $error_array=[];
        $success_output='';
        if(empty($request->promotion_designation[0])){
            $error_array[] = 'Promotion designation is required';
        }if(empty($request->increment_date[0])){
            $error_array[] = 'Increment date is required';
        }else {
            $promotion_details = array();
            $i = 1;
            if (!empty($request->promotion_designation)) {
                foreach ($request->promotion_designation as $key => $value) {
                    if (!empty($value)) {
                        $promotion_details[] = [
                            'promotion_designation' => $value,
                            'increment_date' => $request->increment_date[$key],
                            'go_date' => $request->go_date[$key],
                            'nature_increment' => $request->nature_increment[$key],
                            'pay_scale' => $request->pay_scale[$key],
                            'sorting' => $i,
                            'created_by' => (!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                            'created_time' => date('Y-m-d H:i:s'),
                        ];
                        $i++;
                    }
                }
            }
            DB::beginTransaction();


            if(!empty($promotion_details)) {
                $promotion_info_data = [
                    'employee_id' => $request->employee_id,
                    'promotion_info' =>(string) (!empty($promotion_details)) ? json_encode($promotion_details,
                        JSON_UNESCAPED_UNICODE) : NULL,
                    'created_by' => (!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                    'created_at' => date('Y-m-d H:i:s'),
                ];
                DB::table('employess_general_infos')->where('employee_id', $request->employee_id)->update($promotion_info_data);
                DB::commit();
                $success_output = 'Successfully update information';
            }else{
                $success_output = 'Failed to update information';
            }
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   => $success_output ,
            'redirect_page'   => ''
        );
        echo json_encode($output);
    }

    public function save_employee_job_hisotry(request $request){
        $error_array=[];
        $success_output='';
        if(empty($request->organigation[0])){
            $error_array[] = 'Organization Name is required';
        }if(empty($request->post[0])){
            $error_array[] = 'Post is required';
        }else {
            $job_history_details = array();
            $i = 1;
            if (!empty($request->organigation)) {
                foreach ($request->organigation as $key => $value) {
                    if (!empty($value)) {
                        $job_history_details[] = [
                            'organigation' => $value,
                            'post' => $request->post[$key],
                            'office_address' => $request->office_address[$key],
                            'department' => $request->department[$key],
                            'job_from_date' => $request->job_from_date[$key],
                            'job_to_date' => $request->job_to_date[$key],
                            'job_payscale' => $request->job_payscale[$key],
                            'sorting' => $i,
                            'created_by' => (!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                            'created_time' => date('Y-m-d H:i:s'),
                        ];
                        $i++;
                    }
                }
            }
            DB::beginTransaction();
            if(!empty($job_history_details)) {
                $job_history_data = [
                    'employee_id' => $request->employee_id,
                    'job_history' =>(string) (!empty($job_history_details)) ? json_encode($job_history_details,
                        JSON_UNESCAPED_UNICODE) : NULL,
                    'created_by' => (!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                    'created_at' => date('Y-m-d H:i:s'),
                ];
                DB::table('employess_general_infos')->where('employee_id', $request->employee_id)->update($job_history_data);
                DB::commit();
                $success_output = 'Successfully update information';
            }else{
                $success_output = 'Failed to update information';
            }
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   => $success_output ,
            'redirect_page'   => ''
        );
        echo json_encode($output);
    }

    public function save_employee_emergency_contact(request $request){

        $validation = Validator::make($request->all(), [
            'emergencey_contact_person' => 'required',
            'emergency_contact_mobile'  => 'required',
        ]);
        $error_array = array();
        $success_output = '';
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }else {
            $emergency_contact_info=[
                'emergencey_contact_person'=>$request->emergencey_contact_person,
                'relation_contact_person'=>$request->relation_contact_person,
                'emergency_contact_mobile'=>$request->emergency_contact_mobile,
                'emergency_contact_email'=>$request->emergency_contact_email,
                'emergency_contact_address'=>$request->emergency_contact_address,
            ];



            DB::beginTransaction();
            $emergency_contact = [
                'employee_id' => $request->employee_id,
                'emergency_contact' => (!empty($emergency_contact_info)) ? json_encode($emergency_contact_info,
                    JSON_UNESCAPED_UNICODE) : NULL,
                'created_by' => (!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                'created_at' => date('Y-m-d H:i:s'),
            ];

            DB::table('employess_general_infos')->where('employee_id', $request->employee_id)->update($emergency_contact);
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
    public function save_employee_exit_feedback(request $request){

        $validation = Validator::make($request->all(), [
            'reason_of_resignation' => 'required',
            'resignation_date'  => 'required',
        ]);
        $error_array = array();
        $success_output = '';
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }else {
            $exit_feedback=[
                'reason_of_resignation'=>$request->reason_of_resignation,
                'resignation_date'=>$request->resignation_date,
                'new_work_place'=>$request->new_work_place,
                'new_work_place_address'=>$request->new_work_place_address,
                'comments_employee'=>$request->comments_employee,
                'comments_authority'=>$request->comments_authority,
            ];



            DB::beginTransaction();
            $exit_feedback_info = [
                'employee_id' => $request->employee_id,
                'exit_feedback' => (!empty($exit_feedback)) ? json_encode($exit_feedback,
                    JSON_UNESCAPED_UNICODE) : NULL,
                'created_by' => (!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                'created_at' => date('Y-m-d H:i:s'),
            ];

            DB::table('employess_general_infos')->where('employee_id', $request->employee_id)->update($exit_feedback_info);
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

     public function save_employee_disciplinary_action(request $request){
        $validation = Validator::make($request->all(), [
            'employee_action' => 'required',
            'punishment_date'  => 'required',
        ]);
        $error_array = array();
        $success_output = '';
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }else {
            $disciplinary_action=[
                'employee_action'=>$request->employee_action,
                'punishment_date'=>$request->punishment_date,
                'punishment'=>$request->punishment,
                'remarks'=>$request->remarks,
            ];



            DB::beginTransaction();
            $disciplinary_action_info = [
                'employee_id' => $request->employee_id,
                'disciplinary_action' => (!empty($disciplinary_action)) ? json_encode($disciplinary_action,
                    JSON_UNESCAPED_UNICODE) : NULL,
                'created_by' => (!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                'created_at' => date('Y-m-d H:i:s'),
            ];

            DB::table('employess_general_infos')->where('employee_id', $request->employee_id)->update($disciplinary_action_info);
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

    public function save_employee_bank_info(request $request){
        $validation = Validator::make($request->all(), [
            'basic_salary' => 'required',
            'bank_name'  => 'required',
            'account_no'  => 'required',
        ]);
        $error_array = array();
        $success_output = '';
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }else {
            $bank_info=[
                'employee_id'=>$request->employee_id,
                'basic_salary'=>$request->basic_salary,
                'pay_scal'=>$request->pay_scale,
                'bank_Id'=>$request->bank_name,
                'account_no'=>$request->account_no,
                'pf_inital_balance'=>$request->pf_inital_pf_balance,
                'pf_deduction_per'=>$request->pf_deduction_per,
            ];
            DB::beginTransaction();
            $check_salary_info = Employee::check_salary_info_add(['employee_id'=>$request->employee_id]);
            if($check_salary_info>0) {
                DB::table('employee_salary_infos')->where('employee_id', $request->employee_id)->update($bank_info);
            }else{
                DB::table('employee_salary_infos')->insert($bank_info);
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
    public function save_employee_ict_credentials(request $request){

        $validation = Validator::make($request->all(), [
            'ict_mobile' => 'required',
        ]);
        $error_array = array();
        $success_output = '';
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }else {

            //image upload
            $destinationImagePath = 'images/employee_image';
            $destinationSignaturePath = 'images/employee_signature';
            if(!empty($request->file('picture'))) {
                $image = $request->file('picture');
                $image->getClientOriginalName();
//                $extension = $image->getClientOriginalExtension();



                $file_name = "image_" .$request->employee_id. ".png";
                $image->move($destinationImagePath, $file_name);
                $image = Image::make($destinationImagePath."/".$file_name);
                $image->resize(300, 300);
                $image->save($destinationImagePath."/".$file_name);

            }elseif($request->old_image !=''){
                $file_name=$request->old_image;
            }else{
                $file_name='';
            }
            // signature upload
            if(!empty($request->file('signature'))) {
                $signature = $request->file('signature');
                $signature->getClientOriginalName();
//                $extensionSig = $signature->getClientOriginalExtension();



                $signature_name = "signature_" .$request->employee_id. ".png";
                $signature->move($destinationSignaturePath, $signature_name);
                $signature = Image::make($destinationSignaturePath."/".$signature_name);
                $signature->resize(60, 100);
                $signature->save($destinationSignaturePath."/".$signature_name);

            }elseif($request->old_signature !=''){
                $signature_name=$request->old_signature;
            }else{
                $signature_name='';
            }


            $ict_crediential_info=[
                'office_mobile'=>$request->ict_mobile,
                'office_email'=>$request->ict_email,
                'office_extention'=>$request->ict_extenstion,
                'image'=>$file_name,
                'signature'=>$signature_name,

            ];
            DB::beginTransaction();
            DB::table('employees')->where('employee_id', $request->employee_id)->update($ict_crediential_info);

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

    public function save_employee_employement_info(request $request){
        $validation = Validator::make($request->all(), [
            'department' => 'required',
            'designation'  => 'required'
        ]);
        $error_array = array();
        $success_output = '';
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }else {

            if(!empty($request->day)){
                $time_table=[];
                foreach ($request->day as $key=>$value){
                    $time_table[]=[
                      'checked'=>(!empty($request->day_checked[$key])?1:''),
                      'day'=>$value,
                      'start_time'=>date('H:i:s',strtotime($request->start_time[$key])),
                      'end_time'=>date('H:i:s',strtotime($request->end_time[$key])),
                    ];
                }
            }
            if(!empty($request->leave_type)){
                $leave_info=[];
                foreach ($request->leave_type as $key=>$value){
                    $leave_info[]=[
                      'checked'=>(!empty($request->leave_type_checked[$value])?1:''),
                      'type_id'=>$request->leave_type[$key],
                      'limit'=>$request->leave_limit[$key],
                      'consume'=>$request->consume[$key],
                      'remaining'=>$request->remaining[$key],
                    ];
                }
                $fiscal_year=session()->all();
                $leave_assign_info=[
                    'employee_id'=>$request->employee_id,
                    'fiscal_year'=>Session::get('current_fiscal_year')->fiscal_yer_id,
                    'leave_info'=>(!empty($leave_info)?json_encode($leave_info,
                        JSON_UNESCAPED_UNICODE):NULL),
                    'created_by'=>(!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                    'created_at'=>date('Y-m-d H:i:s'),
                    'created_ip'=>(!empty($this->getIp()))?$this->getIp():$request->ip()
                ];
                // leave assign update
               Employee::employee_leave_assign($leave_assign_info);
            }


            $employeement_info=[
                'department_id'=>$request->department,
                'designation_id'=>$request->designation,
                'join_date'=>((!empty($request->join_date))?date('Y-m-d',strtotime($request->join_date)):NULL),
                'lpr_date'=>((!empty($request->lpr_date))?date('Y-m-d',strtotime($request->lpr_date)):NULL),
                'reporting_person'=>$request->reporting_person,
                'prl_date'=>((!empty($request->prl_date))?date('Y-m-d',strtotime($request->prl_date)):NULL),
                'is_roster_duty'=>(!empty($request->is_roster_duty)?1:NULL),
                'time_table'=>(!empty($time_table)?json_encode($time_table,
                    JSON_UNESCAPED_UNICODE):NULL),
                'leave_balance'=>(!empty($leave_info)?json_encode($leave_info,
                    JSON_UNESCAPED_UNICODE):NULL),
            ];
            DB::beginTransaction();
            DB::table('employees')->where('employee_id', $request->employee_id)->update($employeement_info);
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

    public function save_salary_assign(request $request){

        $validation = Validator::make($request->all(), [
            'employee_id' => 'required',
            'emp_basic_salary'  => 'required',
        ]);
        $error_array = array();
        $success_output = '';
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }else {
            if(!empty($request->earning_ctg)){
                $earning_info=[];
                foreach ($request->earning_ctg as $key=>$value){
                    $earning_info[]=[
                        'earning_ctg'=>$value,
                        'earning_ctg_per'=>$request->earning_ctg_per[$key],
                        'earning_ctg_amount'=>number_format($request->earning_ctg_amount[$key],2,'.',''),
                    ];
                }
            }
            if(!empty($request->deduction_ctg)){
                $deduction_info=[];
                foreach ($request->deduction_ctg as $key=>$value){
                    $deduction_info[]=[
                        'deduction_ctg'=>$value,
                        'deduction_ctg_per'=>$request->deduction_ctg_per[$key],
                        'deduction_ctg_amount'=> number_format($request->deduction_ctg_amount[$key],2,'.',''),
                    ];
                }
            }

            $salary_assign_info=[
                'payrole_earning_info'=>(!empty($earning_info)?json_encode($earning_info,
                    JSON_UNESCAPED_UNICODE):NULL),
                'payrole_deduction_info'=>(!empty($deduction_info)?json_encode($deduction_info,
                    JSON_UNESCAPED_UNICODE):NULL),
                'update_by'=>(!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                'update_at'=>date('Y-m-d H:i:s'),
                'update_ip'=>(!empty($this->getIp()))?$this->getIp():$request->ip(),
            ];
            if(!empty($request->is_salary_assign) && ($request->is_salary_assign=='add')) {
                $salary_assign_info['is_salary_assign'] = 1;
            }
            DB::beginTransaction();
            DB::table('employee_salary_infos')->where('employee_id', $request->employee_id)->update($salary_assign_info);
            DB::commit();
            $success_output = 'Successfully update information';

        }
        $output = array(
            'error'         =>  $error_array,
            'success'       => $success_output ,
            'redirect_page' => 'employee_salary_assign'
        );
        echo json_encode($output);
    }






    public function save_employee_info(request $request){
        $validation = Validator::make($request->all(), [
            'emp_name' => 'required',
            'emp_short_name'  => 'required',
            'mobile_no'  => 'required',
            'station_id'  => 'required',
        ]);
        $error_array = array();
        $success_output = '';
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }else {
            DB::beginTransaction();
            if (empty($request->employee_primary_id)) {
                $chart_of_acc_data = new Acc_chart_of_account();
                $employee_info = new Employee();

                // chart off acc_data insert
                $chart_of_acc_data->name = NULL;
                $chart_of_acc_data->parent_id = 114; // retains Earning
                $chart_of_acc_data->details = "Employee Group";
                $chart_of_acc_data->code = $this->calculation_chart_off_acc_code('10103000', 114);
                $chart_of_acc_data->type_id = 1;
                $chart_of_acc_data->head_type = 2;
                $chart_of_acc_data->opt_type = 1;
                $chart_of_acc_data->created_time = date('Y-m-d H:i:s');

                $chart_of_acc_data->save();
                $chartOfAccId = $chart_of_acc_data->id;
                $employee_info->chart_of_acc_no = $chartOfAccId;
                $employee_info->employee_id = $this->generate_employee_id($request->station_id);

                // salary information inital entry
                $salary_assign_info=[
                    'employee_id'=>$employee_info->employee_id
                ];
                DB::table('employee_salary_infos')->insert($salary_assign_info);

                // general information inital entry
                $employess_general_info=[
                    'employee_id'=>$employee_info->employee_id
                ];
                DB::table('employess_general_infos')->insert($employess_general_info);

                // create new user info
                $user_data = new User();
                $user_data->user_id = $employee_info->employee_id;
                $user_data->type = 1;
                $user_data->password = bcrypt($employee_info->employee_id);
                $user_data->created_by = (!empty(Auth::user()->id) ? Auth::user()->id : NULL);
                $user_data->created_at = date('Y-m-d H:i:s');
                $user_data->save();

            }else{
                $employee_info=Employee::find($request->employee_primary_id);
            }

            $employee_info->emp_name = $request->emp_name;
            $employee_info->emp_grade = $request->employee_grade;
            $employee_info->emp_name_bn = $request->emp_name_bn;
            $employee_info->emp_short_name = $request->emp_short_name;
            $employee_info->father_name = $request->father_name;
            $employee_info->mother_name = $request->mother_name;
            $employee_info->mobile = $request->mobile_no;
            $employee_info->email = $request->email_address;

            $employee_info->is_bcs_cadre =(isset($request->is_bcs_cadre)&& !empty($request->is_bcs_cadre)) ?1:NULL;
            $employee_info->govt_id = !empty($request->govt_id)?$request->govt_id:NULL;
            $employee_info->cadre_ctg = !empty($request->cadre_ctg)?$request->cadre_ctg:NULL;
            $employee_info->cadre_batch = !empty($request->catre_batch)?$request->catre_batch:NULL;
            $employee_info->cadre_date = !empty($request->cadre_date)?date('Y-m-d',strtotime($request->cadre_date)):NULL;
            $employee_info->cadre_go_date = !empty($request->confirmation_go_date)?date('Y-m-d',strtotime($request->confirmation_go_date)):NULL;


            $employee_info->gender = $request->gender;
            $employee_info->birth_date = date("Y-m-d",strtotime($request->date_of_birth));
            $employee_info->religion = $request->religion;
            $employee_info->marital_status = $request->merital_status;
            $employee_info->blood_group = $request->blood_group;
            $employee_info->physical_disability = $request->physical_disability;
            $employee_info->disability_details = $request->disability_yes_details;
            $employee_info->nationality = $request->nationality;
            $employee_info->national_id = $request->national_id_no;
            $employee_info->birth_certificate_no = $request->birth_certificate;
            $employee_info->driving_license_no = $request->driving_license;
            $employee_info->passport_no = $request->passport_no;
            $employee_info->station_id = $request->station_id;
            $employee_info->is_same_present_parmaent_add = (isset($request->save_present_parmanent_address)&& !empty($request->save_present_parmanent_address)) ?1:NULL ;

            $present_address_info=[
                'district'=>!empty($request->present_district)?$request->present_district:NULL,
                'upazila'=>!empty($request->present_police_station)?$request->present_police_station:NULL,
                'post_office'=>!empty($request->present_post_office)?$request->present_post_office:NULL,
                'vill_road'=>!empty($request->present_village_house_road)?$request->present_village_house_road:NULL,
            ];
            $employee_info->present_address =  !empty($present_address_info)?json_encode($present_address_info,
                JSON_UNESCAPED_UNICODE):NULL;

            $parmament_address_info=[
                'district'=>!empty($request->parmanent_district)?$request->parmanent_district:NULL,
                'upazila'=>!empty($request->parmanent_police_station)?$request->parmanent_police_station:NULL,
                'post_office'=>!empty($request->parmanent_post_office)?$request->parmanent_post_office:NULL,
                'vill_road'=>!empty($request->parmanent_village_house_road)?$request->parmanent_village_house_road:NULL,
            ];
            $employee_info->parmanent_address = (!empty($parmament_address_info) && $employee_info->is_same_present_parmaent_add=='') ?json_encode($parmament_address_info,
                JSON_UNESCAPED_UNICODE):NULL;


            $employee_info->created_by = (!empty(Auth::user()->id) ? Auth::user()->id : NULL);
            $employee_info->created_at = date('Y-m-d H:i:s');
            $employee_info->updated_at  = date('Y-m-d H:i:s');
            $employee_info->created_ip = (!empty($this->getIp()))?$this->getIp():$request->ip();
            $save_data= $employee_info->save();





             if($save_data) {
                 $success_output = 'Successfully update information';
             }
            DB::commit();
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output,
            'redirect_page'   => 'employee_info'
        );
        echo json_encode($output);
    }

    public function calculation_chart_off_acc_code($parent_code, $parent_id)
    {
        $query = DB::table('acc_chart_of_accounts')
            ->select('acc_chart_of_accounts.id')
            ->where('is_active', '=', 1)
            ->where('parent_id', '=', $parent_id)
            ->get();
        return $parent_code + (count($query) + 1);
    }
    public function delete_employee_info(request $request){
        if (!empty($request->id)) {
            DB::table('employees')->where('id', $request->id)->update(['is_active' => 0, 'updated_at' => date('Y-m-d H:i:s'), 'updated_by' => (!empty(Auth::user()->id) ? Auth::user()->id : NULL)]);
            return json_encode(['status' => 'success', 'message' => 'Successfully, delete information']);
        } else {
            return json_encode(['status' => 'error', 'message' => 'Failed, delete information']);
        }
    }
    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
    }

    public function all_employee_info_ajax(){
        $get_employee_info = DB::table('employees')
            ->leftJoin('all_sttings as department', 'department.id', '=', 'employees.department_id')
            ->leftJoin('all_sttings as designation', 'designation.id', '=', 'employees.designation_id')
            ->leftJoin('branch_infos', 'branch_infos.id', '=', 'employees.station_id')
            ->where('employees.is_active',"=",1)
            ->orderBy('employees.id','DESC');
        $get_employee_info->select('employees.employee_id','employees.emp_name','employees.mobile','employees.email','employees.id', (DB::raw("CASE WHEN employees.is_active = 1 THEN 'Active' WHEN employees.is_active = 2 THEN 'Inactive' WHEN employees.is_active = 3 THEN 'Terminated' WHEN employees.is_active = 4 THEN 'OSD' ELSE '' END  as is_active")),"department.title as department_title","designation.title as designation_title","branch_infos.name as station_name");
        return Datatables::of($get_employee_info)->addColumn('action', function($get_employee_info){
            return '<a href="'. url('details_employee_info/'.md5($get_employee_info->id).'/'.$get_employee_info->id.'/view' ).'" title="View Details" class="btn btn-xs btn-primary edit" id="'.$get_employee_info->id.'"><i class="glyphicon glyphicon-share-alt"></i> </a>  <a href="'. url('update_employee_info/'.md5($get_employee_info->id).'/'.$get_employee_info->id) .'" title="Update" class="btn btn-xs btn-info" id="'.$get_employee_info->id.'"><i class="glyphicon glyphicon-edit"></i> </a> <button class="btn btn-xs btn-danger"  title="Delete" onclick="deleteEmployeeConfirm('.$get_employee_info->id.')"><i class="glyphicon glyphicon-trash"></i></button>';
        })->make(true);
    }

    public function update_employee_info($md5id,$id){
        $employe_info = Employee::find($id);
         if(!empty($employe_info->present_address)) {
             $emp_present_upazilas = json_decode($employe_info->present_address,true);
             if(!empty($emp_present_upazilas['district'])) {
                 $upazila_info = All_stting::get_upazilas(['district_id' => $emp_present_upazilas['district']]);
             }
         }
         if(!empty($employe_info->parmanent_address)) {
             $emp_parmanet_upazilas = json_decode($employe_info->parmanent_address,true);
             if(!empty($emp_parmanet_upazilas['district'])) {
                 $parmanent_upazila_info = All_stting::get_upazilas(['district_id' => $emp_parmanet_upazilas['district']]);
             }
         }
        $degree_info= All_stting::get_settings_info(['type'=>3,'is_active'=>1]);
        $nationality_info= All_stting::get_settings_info(['type'=>4,'is_active'=>1]);
        $department_info=All_stting::get_settings_info(['type'=>1,'is_active'=>1]);
        $designation_info=All_stting::get_settings_info(['type'=>2,'is_active'=>1]);
        $branch_info = Branch_info::branch_info_select(['is_active'=>1]);
        $reporting_person = Employee::get_employee_info_select();

        $employee_general_info = Employee::get_employee_general_setting_info(['employee_id'=>$employe_info->employee_id]);

        $employee_salary_info = Employee::get_employee_salary_info(['employee_id'=>$employe_info->employee_id]);

        $program_info=All_stting::get_settings_info(['type'=>6,'is_active'=>1]);
        $district_info=All_stting::get_district();
        $catre_ctg=All_stting::get_settings_info(['type'=>13,'is_active'=>1]);
        $bank_info=All_stting::get_settings_info(['type'=>9,'is_active'=>1]);
        $leave_ctg= All_stting::get_leave_type_setting(['type'=>5,'is_active'=>1]);
        $get_leave_assign_info= Employee::get_leave_assign_info(['employee_id'=>$employe_info->employee_id,'fiscal_year'=> Session::get('current_fiscal_year')->fiscal_yer_id]);

        return view('employee.update_employee_info',['employe_info'=>$employe_info,'degree_info'=>$degree_info,'nationality'=>$nationality_info,'branch_info'=>$branch_info,'department_info'=>$department_info,'designation_info'=>$designation_info,'reporting_person'=>$reporting_person,'program_info'=>$program_info,'all_district'=>$district_info,'catre_ctg'=>$catre_ctg,'present_upazilas'=>(!empty($upazila_info)?$upazila_info:NULL),'parmanent_upazilas'=>(!empty($parmanent_upazila_info)?$parmanent_upazila_info:NULL),'employee_general_info'=>$employee_general_info,'bank_data_info'=>$bank_info,'employee_salary_info'=>$employee_salary_info,'leave_ctg'=>$leave_ctg,'leave_assign_info'=>$get_leave_assign_info]);
    }

    public function get_settings($type){
        $settings = DB::table("all_sttings")
            ->where('all_sttings.is_active','=',1)
            ->where('all_sttings.type','=',$type)
            ->orderBy('all_sttings.id',"DESC")
            ->pluck( 'all_sttings.title as title',"all_sttings.id");
        return $settings;
    }

    public function details_employee_info($md5id,$id,$type){

        $company_info = Company_info::find(6); // company id = 6
        $single_employe_info = Employee::find($id);
        $employee_general_info = Employee::get_employee_general_setting_info(['employee_id'=>$single_employe_info->employee_id]);
        $employee_salary_data = Employee::get_employee_salary_info(['employee_id'=>$single_employe_info->employee_id]);
        $employee_leave_info = Employee::employee_leave_info(['employee_id'=>$single_employe_info->employee_id,'id'=>Session::get('current_fiscal_year')->fiscal_yer_id]);
        $lave_info=(!empty($employee_leave_info))?All_stting::get_json_decode_leave_info($employee_leave_info->leave_info):'';
        if($type=='view') {
            return view('employee.details_employee_info', ['employee_info' => $single_employe_info, 'company_info' => $company_info,'employee_general_info'=>$employee_general_info,'employee_salary_data'=>$employee_salary_data,'employee_leave_info'=>$lave_info]);
        }elseif($type=='pdf'){
            $pdf = PDF::loadView('employee.pdf_details_employee_info',['employee_info' => $single_employe_info, 'company_info' => $company_info,'employee_general_info'=>$employee_general_info,'employee_salary_data'=>$employee_salary_data,'employee_leave_info'=>$lave_info]);
            $file_name=$single_employe_info->employee_id.".pdf";
            return $pdf->download($file_name);
        }
    }

    public function employee_salary_assign(){

        return view('employee.employee_salary_assign');
    }



    public function employee_salary_assign_ajax(){
        $get_employee_info = DB::table('employees')
            ->leftJoin('all_sttings as department', 'department.id', '=', 'employees.department_id')
            ->leftJoin('all_sttings as designation', 'designation.id', '=', 'employees.designation_id')
            ->leftJoin('branch_infos', 'branch_infos.id', '=', 'employees.station_id')
            ->leftJoin('employee_salary_infos as salary_info', 'salary_info.employee_id', '=', 'employees.employee_id')
            ->where('employees.is_active',"=",1)
            ->orderBy('employees.id','DESC');
        $get_employee_info->select('employees.employee_id as employee_id','employees.emp_name','employees.mobile','employees.email','employees.id', (DB::raw("CASE WHEN employees.is_active = 1 THEN 'Active' WHEN employees.is_active = 2 THEN 'Inactive' WHEN employees.is_active = 3 THEN 'Terminated' WHEN employees.is_active = 4 THEN 'OSD' ELSE '' END  as is_active")),"department.title as department_title","designation.title as designation_title","branch_infos.name as station_name","salary_info.is_salary_assign as salary_assign_status",(DB::raw("date_format(employees.created_at,'%d-%m-%Y') as created_time")));
        return Datatables::of($get_employee_info)

            ->addColumn('action', function($employee_info){
                $actionBtn='';
                $actionBtn .= '<a href="'. url('details_employee_info/'.md5($employee_info->id).'/'.$employee_info->id.'/view' ).'" data-user_id="'.$employee_info->id.'" title="Details Employee" target="_blank" class="btn btn-xs btn-primary viewUser"><i class="glyphicon glyphicon-share-alt"></i></a> ';

                if($employee_info->salary_assign_status==''){
                    $actionBtn .= '<button class="btn btn-xs btn-info" data-toggle="modal" data-target="#salaryAssignModal"  title="Salary Assign" onclick="salaryAssign('.$employee_info->employee_id.')"><i class="glyphicon glyphicon-plus"></i> Assign</button>';
                }else{
                    $actionBtn .= '<button class="btn btn-xs btn-success" data-toggle="modal" data-target="#salaryAssignModal"  title="Salary Assign Update" onclick="salaryAssignUpdate('.$employee_info->employee_id.')"><i class="glyphicon glyphicon-pencil"></i> Update</button>';
                }
                if(Auth::user()->can('Delete User')){
                    $actionBtn .= '<a href="javascript:void(0);" data-user_id="'.encrypt($employee_info->id).'" class="btn btn-sm btn-danger deleteUser"><i class="fa fa-trash"></i></a>';
                }
                return $actionBtn;

        }
        )

       ->make(true);
    }

    public function generate_employee_id($station)
    {
        $query = DB::table('employees')
            ->select('employees.id')
//            ->where('is_active', '!=', 0)
            ->where( DB::raw("year(created_at)=date('Y')"))
            ->count();
        return date('Ym').str_pad($station,2,"0",STR_PAD_LEFT).str_pad($query + 1,4,"0",STR_PAD_LEFT);
    }

    public function get_employee_info(request $request){
        if(!empty($request->employee_id)) {
            $employee_info = Employee::get_single_employee_info(['employees.employee_id' => $request->employee_id]);
            $all_default_earning_info=All_stting::get_settings_info(['type'=>8,'is_active'=>1,'is_default'=>1]);
            $all_default_deduction=All_stting::get_settings_info(['type'=>7,'is_active'=>1,'is_default'=>1]);
            $all_default_not_earning_info=All_stting::get_settings_info(['type'=>8,'is_active'=>1,'is_default'=>NULL]);
            $all_default_not_deduction=All_stting::get_settings_info(['type'=>7,'is_active'=>1,'is_default'=>NULL]);
            $all_earning_info=All_stting::get_settings_info(['type'=>8,'is_active'=>1]);
            $all_deduction=All_stting::get_settings_info(['type'=>7,'is_active'=>1]);
            echo json_encode(['status'=>'success','message'=>'successfully data found','data'=>$employee_info,'default_earning'=>$all_default_earning_info,'default_deduction'=>$all_default_deduction,'default_not_earning'=>$all_default_not_earning_info,'default_not_deduction'=>$all_default_not_deduction,'all_earning_ctg'=>$all_earning_info,'all_deduction_ctg'=>$all_deduction,]);
        }else{
            echo json_encode(['status'=>'error','message'=>'no data found','data'=>[]]);
        }
    }
    public function get_all_data(request $request){
        if(!empty($request->searching_type)&&$request->searching_type=='not_default_earning_ctg'){
            $all_default_not_earning_info=All_stting::get_settings_info(['type'=>8,'is_active'=>1,'is_default'=>NULL]);
            echo json_encode(['status'=>'success','message'=>'successfully data found','data'=>['default_not_earning'=>$all_default_not_earning_info]]);
        }else if(!empty($request->searching_type)&&$request->searching_type=='not_default_deduction_ctg'){
            $all_default_not_deduction=All_stting::get_settings_info(['type'=>7,'is_active'=>1,'is_default'=>NULL]);
            echo json_encode(['status'=>'success','message'=>'successfully data found','data'=>['default_not_deduction'=>$all_default_not_deduction]]);
        }


    }


    public function my_profile()
    {
        $type='view';
        $company_info = Company_info::find(6); // company id = 6
        $id=(isset(session('user_info')->employee_primary_id) && !empty(session('user_info')->employee_primary_id))?session('user_info')->employee_primary_id:'';
        $single_employe_info = Employee::find($id);
        $employee_general_info = Employee::get_employee_general_setting_info(['employee_id'=>$single_employe_info->employee_id]);
        $employee_salary_data = Employee::get_employee_salary_info(['employee_id'=>$single_employe_info->employee_id]);
        $employee_leave_info = Employee::employee_leave_info(['employee_id'=>$single_employe_info->employee_id,'id'=>Session::get('current_fiscal_year')->fiscal_yer_id]);
        $lave_info=(!empty($employee_leave_info))?All_stting::get_json_decode_leave_info($employee_leave_info->leave_info):'';
        if($type=='view') {
            return view('employee.my_profile', ['employee_info' => $single_employe_info, 'company_info' => $company_info,'employee_general_info'=>$employee_general_info,'employee_salary_data'=>$employee_salary_data,'employee_leave_info'=>$lave_info]);
        }elseif($type=='pdf'){
            $pdf = PDF::loadView('employee.pdf_details_employee_info',['employee_info' => $single_employe_info, 'company_info' => $company_info,'employee_general_info'=>$employee_general_info,'employee_salary_data'=>$employee_salary_data,'employee_leave_info'=>$lave_info]);
            $file_name=$single_employe_info->employee_id.".pdf";
            return $pdf->download($file_name);
        }
    }

    public function searching_employee_info(request $request){
        if(!empty($request->term)) {
            $results=Employee::searching_employee_info($request->term);
            echo json_encode($results);
        }else{
            return false;
        }
    }
    public function print_id_card($employee_id){
        $employee_info=Employee::get_single_employee_info(['employees.employee_id'=>$employee_id]);
        $d = new DNS1D();
        $d->setStorPath(__DIR__."/cache/");
        $bar_code = $d->getBarcodeHTML($employee_id, "EAN13");
        return view('employee.update_info.print_id_card',['employee_info'=>$employee_info,'bar_code_employee_id'=>$bar_code]);
    }






}
