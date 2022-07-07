<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\All_stting;
use App\Employee;
use App\Employee_leave_info;
use App\Company_info;
use PDF;

class LeaveController extends Controller
{
    public function employee_leave_app(){
        $leave_type = All_stting::get_settings_info(['type'=>5,'is_active'=>1]);
        $employee_info = Employee::get_employee_info_select();
        $employee_leave_info = Employee_leave_info::get_leave_info();
        $leave_status = $this->leave_status();
        return view('leave.employee_leave_app',['leave_type'=>$leave_type,'employee_info'=>$employee_info,'employee_leave_info'=>$employee_leave_info,'leave_status'=>$leave_status]);
    }

    public function employee_leave_info(request $request)
    {
        $leave_info = Employee_leave_info::find($request->id);
        if(!empty($request->id)) {
            return json_encode(['status' => 'success', 'data' => $leave_info]);
        }else{
            return json_encode(['status' => 'error', 'data' => '']);
        }
    }
    public function leave_status(){
        return ['1'=>'Pending','2'=>'Recommend','3'=>'Denied','4'=>'Cancelled','5'=>'Approved'];
    }

    public function view_leave_application($id,$type){

        $company_info = Company_info::find(6); // company id = 6
        $leave_info = Employee_leave_info::get_leave_info(['leave.id'=>$id]);
        $leave_type = All_stting::get_settings_info(['type'=>5,'is_active'=>1]);
        if($type=='view') {
            return view('leave.view_leave_application', ['leave_info_data' => $leave_info[0], 'company_info' => $company_info,'leave_type'=>$leave_type]);
        }elseif($type=='pdf'){
            $pdf = PDF::loadView('leave.pdf_leave_application',['leave_info_data' => $leave_info[0], 'company_info' => $company_info,'leave_type'=>$leave_type]);
            $file_name="Leave-Application-".$leave_info[0]->employee_id."-".$leave_info[0]->id.".pdf";
            return $pdf->download($file_name);
        }
    }
    public function my_leave_request(){

        $leave_type = All_stting::get_settings_info(['type'=>5,'is_active'=>1]);
        $employee_leave_info = Employee_leave_info::get_leave_info();
        $leave_status = $this->leave_status();
        return view('self_care.my_leave_request',['leave_type'=>$leave_type,'employee_leave_info'=>$employee_leave_info,'leave_status'=>$leave_status]);
    }
}
