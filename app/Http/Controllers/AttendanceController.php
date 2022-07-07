<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\All_stting;
use App\Branch_info;
use App\Employee;
use Validator;

class AttendanceController extends Controller
{
    public function employee_manual_app(){
        return view('attendance.manual_attendance');
    }

    public function attendance_record(){
        $department_info = All_stting::get_settings_info(['type' => 1, 'is_active' => 1]);
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);
        return view('attendance.attendance_record',['department_info' => $department_info,'station_info'=>$station_info]);
    }
    public function search_employee_attendance_recrod(request $request){
        if (empty($request->station_id)){
            return ['status'=>'error','message'=>'Station Name is required','data'=>''];exit;
        }elseif (empty($request->department_id)){
            return ['status'=>'error','message'=>'Department Name is required','data'=>''];exit;
        }elseif (empty($request->attendance_date)){
            return ['status'=>'error','message'=>'Attendance date is required','data'=>''];exit;
        }else {
            $param=[
                'station_id'=>$request->station_id,
                'department_id'=>$request->department_id,
                'attendance_date'=>$request->attendance_date
            ];
            $data=Employee::search_employee_attendance_record($param);
            return view('attendance.search_employee_attendance_recrod',['data'=>$data,'searching_info'=>json_encode($param)]);

        }
    }
    public function attendance_entry(){
        $department_info = All_stting::get_settings_info(['type' => 1, 'is_active' => 1]);
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);
        return view('attendance.attendance_entry',['department_info' => $department_info,'station_info'=>$station_info]);
    }
    public function search_employee_attendance_info(request $request){
        if (empty($request->station_id)){
            return ['status'=>'error','message'=>'Station Name is required','data'=>''];exit;
        }elseif (empty($request->department_id)){
            return ['status'=>'error','message'=>'Department Name is required','data'=>''];exit;
        }elseif (empty($request->attendance_date)){
            return ['status'=>'error','message'=>'Attendance date is required','data'=>''];exit;
        }else {
            $param=[
                'station_id'=>$request->station_id,
                'department_id'=>$request->department_id,
                'attendance_date'=>$request->attendance_date
            ];
            $data=Employee::search_employee_attendance_info($param);
            return view('attendance.attendance_entry_action',['data'=>$data,'searching_info'=>json_encode($param)]);

        }
    }
    public function saved_employee_attendance_info(request $request){
        $searching_param=json_decode($request->searching_param,true);

        if (empty($searching_param['station_id'])){
            return ['status'=>'error','message'=>'Station Name is required','data'=>''];exit;
        }elseif (empty($searching_param['department_id'])){
            return ['status'=>'error','message'=>'Department Name is required','data'=>''];exit;
        }elseif (empty($searching_param['attendance_date'])){
            return ['status'=>'error','message'=>'Attendance date is required','data'=>''];exit;
        }else {
            $remove_attendance_info = array_diff_key ( $request->attendance_id,$request->employee_id);
            if(!empty($request->employee_id)) {
                foreach ($request->employee_id as $key => $employee_id) {
                    if (!empty($request->attendance_id[$employee_id])) {
                        $old_attendance_info = [
                            'employee_id' => $employee_id,
                            'attendance_date' => date('Y-m-d', strtotime($searching_param['attendance_date'])),
                            'start_time' => $request->in_time[$employee_id],
                            'end_time' => $request->end_time[$employee_id],
                            'is_late' => 0,
                            'is_early_departure' => 0,
                            'is_late_approved' => 0,
                            'is_early_departure_approved' => 0,
                            'updated_by' => (!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                            'updated_at' => date('Y-m-d H:i:s'),
                            'updated_ip' => (!empty(Employee::getIp())) ? Employee::getIp() : $request->ip(),
                        ];
                        DB::table('employee_attendance_info')->where('id', $request->attendance_id[$employee_id])->update($old_attendance_info);

                    } else {
                        $new_attendance_info[] = [
                            'employee_id' => $employee_id,
                            'attendance_date' => date('Y-m-d', strtotime($searching_param['attendance_date'])),
                            'start_time' => $request->in_time[$employee_id],
                            'end_time' => $request->end_time[$employee_id],
                            'is_late' => 0,
                            'is_early_departure' => 0,
                            'is_late_approved' => 0,
                            'is_early_departure_approved' => 0,
                            'created_by' => (!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                            'created_at' => date('Y-m-d H:i:s'),
                            'created_ip' => (!empty(Employee::getIp())) ? Employee::getIp() : $request->ip(),
                        ];
                    }

                }
                DB::beginTransaction();
                if (!empty($remove_attendance_info)) {
                    DB::table('employee_attendance_info')->whereIn('id',$remove_attendance_info)->update([
                        'is_active'=>2,
                        'updated_by' => (!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'updated_ip' => (!empty(Employee::getIp())) ? Employee::getIp() : $request->ip(),
                    ]);
                }

                if(!empty($new_attendance_info)) {
                    DB::table('employee_attendance_info')->insert($new_attendance_info);
                }
                DB::commit();

                $success_output='Successfully Update Attendance Information';
            }
            $output = array(
                'status' => 'success',
                'message' => $success_output,
                'redirect_page' => 'attendance_record'
            );
            echo json_encode($output);
        }
    }



    public function my_atteendance_record(){
        return view('self_care.my_atteendance_record');
    }

    public function holidays_record(){
        $department_info = All_stting::get_settings_info(['type' => 1, 'is_active' => 1]);
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);
        $holiday_info = Employee::get_holiday_info(['is_active'=>1]);
        return view('attendance.holidays_record', ['department_info' => $department_info,'station_info'=>$station_info,'holiday_info'=>$holiday_info]);
    }

    public function save_holiday_info(request $request){
        $validation = Validator::make($request->all(), [
            'holiday_title' => 'required|max:255',
            'holiday_form_date' => 'required',
            'holiday_to_date' => 'required',
            'station_id' => 'required',
        ]);
        $error_array = array();
        $success_output = '';
        if ($validation->fails()) {
            foreach ($validation->messages()->getMessages() as $field_name => $messages) {
                $error_array[] = $messages;
            }
        } else {
            if (empty($request->setting_id)) {
                $holiday_info=[
                  'station_id'              =>      $request->station_id,
                  'title'                   =>      $request->holiday_title,
                  'from_date'               =>      (!empty($request->holiday_form_date))?date('Y-m-d',strtotime($request->holiday_form_date)):NULL,
                  'to_date'                 =>      (!empty($request->holiday_to_date))?date('Y-m-d',strtotime($request->holiday_to_date)):NULL,
                   'start_time'             =>      (!empty($request->attendance_in_time))?date('H:i:s',strtotime($request->attendance_in_time)):NULL,
                   'end_time'               =>      (!empty($request->attendance_out_time))?date('H:i:s',strtotime($request->attendance_out_time)):NULL,
                    'overwrite_type'        =>      $request->overwrite_type,
                    'department_id'         =>      (!empty($request->department)?json_encode($request->department):NULL),
                    'created_by'            =>      (!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                    'created_at'            =>      date('Y-m-d H:i:s'),
                    'created_ip'            =>      (!empty(Employee::getIp()))?Employee::getIp():$request->ip(),
                ];
                DB::beginTransaction();
                DB::table('emplooyee_overwrite_off_on_days')->insert($holiday_info);
                DB::commit();
                $success_output='Successfully Saved Holiday Information';
            }else{
                $holiday_info=[
                    'station_id'              =>      $request->station_id,
                    'title'                   =>      $request->holiday_title,
                    'from_date'               =>      (!empty($request->holiday_form_date))?date('Y-m-d',strtotime($request->holiday_form_date)):NULL,
                    'to_date'                 =>      (!empty($request->holiday_to_date))?date('Y-m-d',strtotime($request->holiday_to_date)):NULL,
                    'start_time'             =>      (!empty($request->attendance_in_time))?date('H:i:s',strtotime($request->attendance_in_time)):NULL,
                    'end_time'               =>      (!empty($request->attendance_out_time))?date('H:i:s',strtotime($request->attendance_out_time)):NULL,
                    'overwrite_type'        =>      $request->overwrite_type,
                    'department_id'         =>      (!empty($request->department)?json_encode($request->department):NULL),
                    'updated_by'            =>      (!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                    'updated_at'            =>      date('Y-m-d H:i:s'),
                    'updated_ip'            =>      (!empty(Employee::getIp()))?Employee::getIp():$request->ip(),
                ];
                DB::beginTransaction();
                DB::table('emplooyee_overwrite_off_on_days')->where('id',$request->setting_id)->update($holiday_info);
                DB::commit();
                $success_output='Successfully Update Holiday Information';
            }

        }
        $output = array(
            'error' => $error_array,
            'success' => $success_output,
            'redirect_page' => 'holidays_record'
        );
        echo json_encode($output);

    }
    public function get_single_holiday_info(request $request){
        if(!empty($request->id)){
            $holiday_info=Employee::get_single_holiday_info(['id'=>$request->id]);
            return $holiday_info;
        }
    }
}
