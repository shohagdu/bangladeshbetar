<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Monthly_opening;
use App\Company_info;
use App\Employee;
use App\All_stting;
use PDF;
use Validator;
use Datatables;
use Session;

class PayrollController extends Controller
{
    public function payroll_generate(){
        $current_payslip = Monthly_opening::get_current_payslip_months(['status'=>1]);
        return view('payroll.payroll_generate',['payslip_months'=>$current_payslip]);
    }
    public function payroll_record(request $request){

        if(!empty($request->payrole_months)){
            $payslip_info = Employee::get_employee_payslip_info(['employee_payslip_infos.payrole_setup_month'=>$request->payrole_months]);
            if(!empty($payslip_info)){
                $payslip_info=['status'=>'success','message'=>'successfully data found','data'=>$payslip_info];
            }else{
                $payslip_info=['status'=>'error','message'=>'no data found','data'=>[]];
            }
            return view('payroll.payroll_record_action',['employee_payslip_info'=>$payslip_info]);
        }else {
            $all_payslip = Monthly_opening::get_current_payslip_months('', 'all');
            return view('payroll.payroll_record', ['payslip_months' => $all_payslip]);
        }
    }
    public function search_elibile_employee_payrole_gen(request $request){
        if(!empty($request->payrole_month)){
            $get_payslip_eligible_employee = Employee::get_eligible_employee_payrole(['is_active'=>1,'payrole_months'=>$request->payrole_month]);
            if(!empty($get_payslip_eligible_employee)){
                $employee_payrole=[];
                foreach ($get_payslip_eligible_employee as $key=>$employee_info){
                    $employee_payrole[]=[
                        'payrole_generated_status'  =>  $employee_info->payrole_generated_status,
                        'employee_id'               =>  $employee_info->employee_id,
                        'emp_name'                  =>  $employee_info->emp_name,
                        'station_name'              =>  $employee_info->station_name,
                        'department_title'          =>  $employee_info->department_title,
                        'designation_title'         =>  $employee_info->designation_title,
                        'payrole_earning_info'      =>  (!empty($employee_info->payrole_earning_info))?$employee_info->payrole_earning_info:NULL,
                        'payrole_deduction_info'    =>  (!empty($employee_info->payrole_deduction_info))?$employee_info->payrole_deduction_info:NULL,
                    ];
                }

            }
            if(!empty($employee_payrole)){
                $payrole_info=['status'=>'success','message'=>'successfully data found','data'=>$employee_payrole];
            }else{
                $payrole_info=['status'=>'error','message'=>'no data found','data'=>[]];
            }
            $all_earning_info=All_stting::get_settings_info(['type'=>8,'is_active'=>1]);
            $all_deduction=All_stting::get_settings_info(['type'=>7,'is_active'=>1]);
            return view('payroll.payroll_generate_action',['eligible_employee_info'=>$payrole_info,'earning_ctg'=>$all_earning_info,'deduction_ctg'=>$all_deduction]);
        }
    }
    public function save_employee_payrole_genrate(request $request){
        $validation = Validator::make($request->all(), [
            'payrole_months' => 'required',
            'employee_id'  => 'required',
        ]);
        $error_array = array();
        $success_output = '';
        $employee_ids = [];
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }else {
            if (!empty($request->payrole_months) && !empty($request->employee_id)) {
                $employee_payrole = [];
                foreach ($request->employee_id as $key => $employee) {
                    $employee_payrole[] = [
                        'generated_method' => 1,
                        'employee_id' => $employee,
                        'payrole_setup_month' => $request->payrole_months,
                        'generated_date' => date('Y-m-d'),
                        'earning_info' => (!empty($request->payrole_earning_info[$key])) ? json_encode(json_decode($request->payrole_earning_info[$key], true)) : NULL,
                        'deduction_info' => (!empty($request->payrole_deduction_info[$key])) ? json_encode(json_decode($request->payrole_deduction_info[$key], true)) : NULL,
                        'created_by' => (!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_ip' => (!empty(Employee::getIp())) ? Employee::getIp() : $request->ip(),
                    ];
                }
                $employee_ids = array_column($employee_payrole, 'employee_id');
                DB::beginTransaction();
                DB::table('employee_payslip_infos')->insert($employee_payrole);
                DB::commit();

                $success_output = 'Successfully generate payrole';

            } else {
                $success_output = 'No employee selected';
            }
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   => $success_output ,
            'data'   => $employee_ids ,
            'redirect_page'   => ''
        );
        echo json_encode($output);
    }
    public function get_single_payslip_info(request $request){
        if(!empty($request->payslip_id)) {
            $payslip_info = Employee::get_single_payslip_info(['employee_payslip_infos.id' => $request->payslip_id]);
            $all_earning_info=All_stting::get_settings_info(['type'=>8,'is_active'=>1]);
            $all_deduction=All_stting::get_settings_info(['type'=>7,'is_active'=>1]);
            echo json_encode(['status'=>'success','message'=>'successfully data found','data'=>$payslip_info,'all_earning_ctg'=>$all_earning_info,'all_deduction_ctg'=>$all_deduction]);
        }else{
            echo json_encode(['status'=>'error','message'=>'no data found','data'=>[]]);
        }
    }

    public function pdf_payslip_download($payslip_id){
        if(!empty($payslip_id)) {
            $company_info = Company_info::find(6);
            $payslip_info = Employee::get_single_payslip_info(['employee_payslip_infos.id' => $payslip_id]);
            $payslip_info->earning_info=All_stting::get_json_decode_payslip_earning($payslip_info->earning_info);
            $payslip_info->deduction_info=All_stting::get_json_decode_payslip_deduction($payslip_info->deduction_info);
            $net_paid_total=All_stting::get_payslip_paid_amount($payslip_info->earning_info,$payslip_info->deduction_info);
            $payslip_info->in_word=All_stting::get_bd_amount_in_text($net_paid_total);

            $employee_leave_info = Employee::employee_leave_info(['employee_id'=>$payslip_info->employee_id,'id'=>Session::get('current_fiscal_year')->fiscal_yer_id]);
            $lave_info=(!empty($employee_leave_info))?All_stting::get_json_decode_leave_info($employee_leave_info->leave_info):'';
            $payslip_info->lave_info=$lave_info;
//            return view('payroll.pdf_payslip_download',['payslip_info' => $payslip_info, 'company_info' => $company_info]);
//            exit;
            $pdf = PDF::loadView('payroll.pdf_payslip_download', ['payslip_info' => $payslip_info, 'company_info' => $company_info]);
            $file_name = $payslip_info->month_title.'-'.$payslip_info->employee_id . ".pdf";
            return $pdf->download($file_name);
        }
    }

}