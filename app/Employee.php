<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Employee extends Model
{
    public static function get_employee_info_select($where = null)
    {
        $query =  DB::table('employees');
        $query->where("is_active","=",1);
        if(!is_null($where )) {
            foreach($where as $k => $v){
                $query->where($k, $v);
            }
        }
        return $query->pluck(DB::raw("concat(emp_name, '-', employee_id) as employee_name"),"employee_id");
    }
    public static function get_employee_info_name($where = null)
    {
        $query =  DB::table('employees');
        $query->where("is_active","=",1);
        if(!is_null($where )) {
            foreach($where as $k => $v){
                $query->where($k, $v);
            }
        }
        return $query->pluck("emp_name as employee_name","employee_id");
    }

    public static function get_employee_general_setting_info($where = null)
    {
        $query =  DB::table('employess_general_infos');
        $query->where("employess_general_infos.is_active","=",1);
        $query->where($where);
        return $query->select('employess_general_infos.*')->first();
    }
    public static function get_employee_salary_info($where = null)
    {
        $query =  DB::table('employee_salary_infos');
        $query->where("employee_salary_infos.is_active","=",1);
        $query->where($where);
        return $query->select('employee_salary_infos.*')->first();
    }
    public static function employee_leave_info($where = null)
    {
        $query =  DB::table('employee_payrole_leave_assign');
        $query->where($where);
        return $query->select('employee_payrole_leave_assign.leave_info','employee_payrole_leave_assign.fiscal_year')->first();
    }

    public static function check_salary_info_add($where = null)
    {
        $query =  DB::table('employee_salary_infos');
        $query->where("employee_salary_infos.is_active","=",1);
        $query->where($where);
        return $query->count('id');
    }
    public static function get_single_employee_info($where = null)
    {
        $get_employee_info = DB::table('employees')
            ->leftJoin('all_sttings as department', 'department.id', '=', 'employees.department_id')
            ->leftJoin('all_sttings as designation', 'designation.id', '=', 'employees.designation_id')
            ->leftJoin('branch_infos', 'branch_infos.id', '=', 'employees.station_id')
            ->leftJoin('employee_salary_infos as salary_info', 'salary_info.employee_id', '=', 'employees.employee_id')
            ->where($where)
            ->orderBy('employees.id','DESC');
       return  $get_employee_info->select('employees.employee_id as employee_id','employees.image','employees.signature','employees.emp_name','employees.mobile','employees.email','employees.id', (DB::raw("CASE WHEN employees.is_active = 1 THEN 'Active' WHEN employees.is_active = 2 THEN 'Inactive' WHEN employees.is_active = 3 THEN 'Terminated' WHEN employees.is_active = 4 THEN 'OSD' ELSE '' END  as is_active")),"department.title as department_title","designation.title as designation_title","branch_infos.name as station_name","salary_info.is_salary_assign as salary_assign_status",(DB::raw("date_format(employees.created_at,'%d-%m-%Y') as created_time")),"salary_info.basic_salary","salary_info.pf_deduction_per","salary_info.pay_scal","salary_info.payrole_earning_info","salary_info.payrole_deduction_info")->first();
    }

    public static function get_eligible_employee_payrole($receive = null)
    {

        $get_employee_info = DB::table('employees')
            ->leftJoin('all_sttings as department', 'department.id', '=', 'employees.department_id')
            ->leftJoin('all_sttings as designation', 'designation.id', '=', 'employees.designation_id')
            ->leftJoin('branch_infos', 'branch_infos.id', '=', 'employees.station_id')
            ->leftJoin('employee_salary_infos as salary_info', 'salary_info.employee_id', '=', 'employees.employee_id')
            ->leftJoin('employee_payslip_infos as payrole', function ($join) use ($receive) {
                $join->on('payrole.employee_id', '=', 'employees.employee_id');
                $join->where('payrole.payrole_setup_month', '=', $receive['payrole_months']);
            })
            ->where('employees.is_active',$receive['is_active'])
            ->orderBy('employees.id','DESC');
       return  $get_employee_info->select('employees.employee_id as employee_id','employees.emp_name','employees.mobile','employees.email','employees.id', (DB::raw("CASE WHEN employees.is_active = 1 THEN 'Active' WHEN employees.is_active = 2 THEN 'Inactive' WHEN employees.is_active = 3 THEN 'Terminated' WHEN employees.is_active = 4 THEN 'OSD' ELSE '' END  as is_active")),"department.title as department_title","designation.title as designation_title","branch_infos.name as station_name","salary_info.is_salary_assign as salary_assign_status",(DB::raw("date_format(employees.created_at,'%d-%m-%Y') as created_time")),"salary_info.basic_salary","salary_info.pf_deduction_per","salary_info.pay_scal","salary_info.payrole_earning_info","salary_info.payrole_deduction_info","payrole.generated_date",(DB::raw("IF(payrole.id>0,'AlreadyGenerated','NotGenerated') as payrole_generated_status")))->get();
    }
    public static function getIp(){
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
    public static function get_employee_payslip_info($where = null)
    {
        $get_employee_info = DB::table('employee_payslip_infos')
            ->leftJoin('employees', 'employees.employee_id', '=', 'employee_payslip_infos.employee_id')
            ->leftJoin('all_sttings as department', 'department.id', '=', 'employees.department_id')
            ->leftJoin('all_sttings as designation', 'designation.id', '=', 'employees.designation_id')
            ->leftJoin('branch_infos', 'branch_infos.id', '=', 'employees.station_id')
            ->where($where)
            ->where('employee_payslip_infos.is_active','=',1)
            ->orderBy('employees.id','DESC');
        return  $get_employee_info->select('employees.employee_id as employee_id','employees.emp_name','employees.mobile','employees.email','employees.id', (DB::raw("CASE WHEN employees.is_active = 1 THEN 'Active' WHEN employees.is_active = 2 THEN 'Inactive' WHEN employees.is_active = 3 THEN 'Terminated' WHEN employees.is_active = 4 THEN 'OSD' ELSE '' END  as is_active")),"department.title as department_title","designation.title as designation_title","branch_infos.name as station_name",(DB::raw("date_format(employee_payslip_infos.generated_date,'%d-%m-%Y') as generated_date")),"employee_payslip_infos.earning_info","employee_payslip_infos.deduction_info","employee_payslip_infos.id as payslip_id")->get();
    }
     public static function get_single_payslip_info($where = null)
    {
        $get_employee_info = DB::table('employee_payslip_infos')
            ->leftJoin('employees', 'employees.employee_id', '=', 'employee_payslip_infos.employee_id')
            ->leftJoin('all_sttings as department', 'department.id', '=', 'employees.department_id')
            ->leftJoin('all_sttings as designation', 'designation.id', '=', 'employees.designation_id')
            ->leftJoin('branch_infos', 'branch_infos.id', '=', 'employees.station_id')
            ->leftJoin('monthly_openings', 'monthly_openings.id', '=', 'employee_payslip_infos.payrole_setup_month')
            ->where($where)
            ->where('employee_payslip_infos.is_active','=',1)
            ->orderBy('employees.id','DESC');
        return  $get_employee_info->select('employees.employee_id as employee_id','employees.emp_name','employees.mobile','employees.email', (DB::raw("CASE WHEN employees.is_active = 1 THEN 'Active' WHEN employees.is_active = 2 THEN 'Inactive' WHEN employees.is_active = 3 THEN 'Terminated' WHEN employees.is_active = 4 THEN 'OSD' ELSE '' END  as is_active")),"department.title as department_title","designation.title as designation_title","branch_infos.name as station_name",(DB::raw("date_format(employee_payslip_infos.generated_date,'%d-%m-%Y') as generated_date")),"employee_payslip_infos.earning_info","employee_payslip_infos.deduction_info","employee_payslip_infos.id as payslip_id","monthly_openings.title as month_title")->first();
    }

    public static function employee_leave_assign($leave_data){
        $employee_id        =   $leave_data['employee_id'];
        $fiscal_year        =   $leave_data['fiscal_year'];

        $query =  DB::table('employee_payrole_leave_assign');
        $query->where(['employee_id'=>$employee_id,'fiscal_year'=>$fiscal_year]);
        $assign_data = $query->select('id')->first();
        if(empty($assign_data)){
            DB::table('employee_payrole_leave_assign')->insert($leave_data);
        }else{
            $leave_data['updated_at']=$leave_data['created_at'];
            $leave_data['updated_by']=$leave_data['created_by'];
            $leave_data['updated_ip']=$leave_data['created_ip'];
            unset($leave_data['created_at'],$leave_data['created_by'],$leave_data['created_ip']);
            DB::table('employee_payrole_leave_assign')->where('id', $assign_data->id)->update($leave_data);
        }
        return true;
    }
    public static function get_leave_assign_info($receive){
        $query =  DB::table('employee_payrole_leave_assign');
        $query->where($receive);
        $assign_data = $query->select('leave_info')->first();
        if(!empty($assign_data)){
           return $assign_data->leave_info;
        }else{
            return false;
        }

    }

    public static function get_search_employee_info($receive = null)
    {
        $get_employee_info = DB::table('employees');
            $get_employee_info->leftJoin('all_sttings as department', 'department.id', '=', 'employees.department_id');
            $get_employee_info->leftJoin('users', 'users.user_id', '=', 'employees.employee_id');

            $get_employee_info->leftJoin('all_sttings as designation', 'designation.id', '=', 'employees.designation_id');
            $get_employee_info->leftJoin('branch_infos', 'branch_infos.id', '=', 'employees.station_id');
            $get_employee_info->leftJoin('employee_salary_infos as salary_info', 'salary_info.employee_id', '=', 'employees.employee_id');
            $get_employee_info->leftJoin('employess_general_infos as general_info', 'general_info.employee_id', '=', 'employees.employee_id');
            if(!empty($receive['station_id'])) {
                $get_employee_info->where('employees.station_id',$receive['station_id']);
            }
            if(!empty($receive['employee_designation'])) {
                $get_employee_info->where('employees.designation_id',$receive['employee_designation']);
            }
            if(!empty($receive['employee_department'])) {
                $get_employee_info->where('employees.department_id',$receive['employee_department']);
            }
            if(!empty($receive['employee_id_search'])) {
                $get_employee_info->where('employees.employee_id',$receive['employee_id_search']);
            }
            if(!empty($receive['employee_edu_degree_id'])) {
                $degree=$receive['employee_edu_degree_id'];
//                $get_employee_info->whereRaw('JSON_CONTAINS(education_info->"$.degree_name", $degree)');
//                $get_employee_info->whereRaw("JSON_CONTAINS(education_info->'$[*].degree_name', $degree)");
            }

            $get_employee_info->orderBy('employees.id','DESC');
                return  $get_employee_info->select('employees.employee_id as employee_id','employees.emp_name','employees.mobile','employees.email','employees.id', (DB::raw("CASE WHEN employees.is_active = 1 THEN 'Active' WHEN employees.is_active = 2 THEN 'Inactive' WHEN employees.is_active = 3 THEN 'Terminated' WHEN employees.is_active = 4 THEN 'OSD' ELSE '' END  as is_active")),"department.title as department_title","designation.title as designation_title","branch_infos.name as station_name","salary_info.is_salary_assign as salary_assign_status",(DB::raw("date_format(employees.created_at,'%d-%m-%Y') as created_time")),"salary_info.basic_salary","salary_info.pf_deduction_per","salary_info.pay_scal","general_info.education_info","users.id as user_primary_id")->get();
    }
    public static function searching_employee_info($receive=NULL){
        if(!empty($receive)) {
            $results = [];
            $queries = DB::table('employees')
                ->where('emp_name', 'LIKE', '%' . $receive . '%')
                ->orWhere('employee_id', 'LIKE', '%' . $receive . '%')
                ->take(10)->get();
            foreach ($queries as $query) {
                $results[] = ['id' => $query->employee_id, 'value' => $query->emp_name . " (" . $query->employee_id . ")"];
            }
            return $results;
        }else{
            return false;
        }
    }


    public static function get_holiday_info($receive = null)
    {

        $overwrite_day_info = DB::table('emplooyee_overwrite_off_on_days as overwrite')
            ->leftJoin('branch_infos', 'branch_infos.id', '=', 'overwrite.station_id')
            ->where($receive)
            ->orderBy('overwrite.id','DESC');
          $overwrite_day_info->select("overwrite.id","overwrite.title","overwrite.station_id","overwrite.department_id","overwrite.overwrite_type","branch_infos.name as station_name",(DB::raw("date_format(overwrite.from_date,'%d-%m-%Y') as from_date")),(DB::raw("date_format(overwrite.to_date,'%d-%m-%Y') as to_date")),(DB::raw("TIME_FORMAT(overwrite.start_time,'%H:%i %p') as start_time")),(DB::raw("TIME_FORMAT(overwrite.end_time,'%h:%m %p') as end_time")));
          if($overwrite_day_info->count()>0){
              return $overwrite_day_info->get();
          }else{
              return false;
          }
    }
    public static function get_single_holiday_info($receive = null)
    {

        $overwrite_day_info = DB::table('emplooyee_overwrite_off_on_days as overwrite')
            ->where($receive)
            ->orderBy('overwrite.id','DESC');
          $overwrite_day_info->select("overwrite.id","overwrite.title","overwrite.station_id","overwrite.department_id","overwrite.overwrite_type",(DB::raw("date_format(overwrite.from_date,'%d-%m-%Y') as from_date")),(DB::raw("date_format(overwrite.to_date,'%d-%m-%Y') as to_date")),(DB::raw("TIME_FORMAT(overwrite.start_time,'%H:%i %p') as start_time")),(DB::raw("TIME_FORMAT(overwrite.end_time,'%h:%m %p') as end_time")));
          if($overwrite_day_info->count()>0){
              return json_encode(['status'=>'success','message'=>'data found','data'=>$overwrite_day_info->first()]);
          }else{
              return json_encode(['status'=>'error','message'=>'no data found','data'=>[]]);
          }
    }
    public static function search_employee_attendance_info($receive = null)
    {
        $get_employee_info = DB::table('employees');
        $get_employee_info->leftJoin('all_sttings as department', 'department.id', '=', 'employees.department_id');
        $get_employee_info->leftJoin('all_sttings as designation', 'designation.id', '=', 'employees.designation_id');
        $get_employee_info->leftJoin('branch_infos', 'branch_infos.id', '=', 'employees.station_id');
        if(!empty($receive['station_id'])) {
            $get_employee_info->where('employees.station_id',$receive['station_id']);
        }
        if(!empty($receive['department_id'])) {
            $get_employee_info->where('employees.department_id',$receive['department_id']);
        }
        if(!empty($receive['employee_id_search'])) {
            $get_employee_info->where('employees.employee_id',$receive['employee_id_search']);
        }
        $get_employee_info->where('employees.is_active',1);
        $get_employee_info->leftJoin('employee_attendance_info as attendance_info', function ($join) use ($receive) {
            $join->on('attendance_info.employee_id', '=', 'employees.employee_id');
            $join->where('attendance_info.attendance_date', '=', date('Y-m-d',strtotime($receive['attendance_date'])));
            $join->where('attendance_info.is_active', '=',1);
        });

        $get_employee_info->orderBy('employees.id','DESC');
        return  $get_employee_info->select('employees.employee_id as employee_id','employees.emp_name','employees.mobile','employees.email', "department.title as department_title","designation.title as designation_title","branch_infos.name as station_name","attendance_info.id as attendance_id","attendance_info.start_time","attendance_info.end_time")->get();
    }

    public static function search_employee_attendance_record($receive = null)
    {
        $get_employee_info = DB::table('employee_attendance_info as attendance_info');
        $get_employee_info->leftJoin('employees', 'employees.employee_id', '=', 'attendance_info.employee_id');
        $get_employee_info->leftJoin('all_sttings as department', 'department.id', '=', 'employees.department_id');
        $get_employee_info->leftJoin('all_sttings as designation', 'designation.id', '=', 'employees.designation_id');
        $get_employee_info->leftJoin('branch_infos', 'branch_infos.id', '=', 'employees.station_id');
        if(!empty($receive['station_id'])) {
            $get_employee_info->where('employees.station_id',$receive['station_id']);
        }
        if(!empty($receive['department_id'])) {
            $get_employee_info->where('employees.department_id',$receive['department_id']);
        }
        if(!empty($receive['employee_id_search'])) {
            $get_employee_info->where('employees.employee_id',$receive['employee_id_search']);
        }
        $get_employee_info->where('attendance_info.attendance_date', '=', date('Y-m-d',strtotime($receive['attendance_date'])));
        $get_employee_info->where('attendance_info.is_active', '=',1);

        $get_employee_info->orderBy('employees.id','DESC');
        return  $get_employee_info->select('employees.employee_id as employee_id','employees.emp_name','employees.mobile','employees.email', "department.title as department_title","designation.title as designation_title","branch_infos.name as station_name","attendance_info.id as attendance_id","attendance_info.start_time","attendance_info.end_time")->get();
    }
    public static function get_artist_select($where = null)
    {
        $query =  DB::table('program_artist_info');
     //   $query->where("is_active","=",1);
        $query->whereIn("is_active",[1,2,3]);
        if(!is_null($where )) {
            if( !empty($where['station_id'])  &&  $where['station_id']==1){
                unset($where['station_id']);
                $query->where($where);
            }else{
                $query->where($where);
            }
        }
        return $query->pluck((DB::raw("CASE WHEN name_bn IS NOT NULL THEN name_bn ELSE name END  as name_bn")),"id");
    }
    public static function get_artist_select_presentation($where = null,$expertise_id=null)
    {
        $host = request()->getHttpHost();
        if($host=='localhost') {
            $query = DB::table('program_artist_info');
            $query->where("is_active", "=", 1);
            if(!empty($where['station_id']) && $where['station_id']==1){
                unset($where['station_id']);
                $query->where($where);
            }else{
                $query->where($where);
            }
            $query->whereNotNull('name_bn');
            return $query->select("name_bn", "id")->get();
        }else{
            return $results = DB::select("SELECT program_artist_info.id,program_artist_info.name_bn,program_artist_info.name,program_artist_info.name_bn,national_awarded,JSON_EXTRACT(artist_expertise_info,'$[*].expertise') as expertise_id,JSON_EXTRACT(artist_expertise_info,'$[*].expertise_grade') AS expertise_info FROM program_artist_info WHERE is_active=1 and station_id=2 
          AND  (  JSON_CONTAINS(artist_expertise_info->'$[*].expertise', json_array('192')) ) ORDER BY program_artist_info.name_bn ASC" );
        }
    }
    public static function get_artist_select_presentation_adhok($where = null,$expertise_id=null)
    {
        $host = request()->getHttpHost();
        if($host=='localhost') {
            $query = DB::table('program_artist_info');
            $query->where("is_active", "=", 1);
            if(!empty($where['station_id']) && $where['station_id']==1){
                unset($where['station_id']);
                $query->where($where);
            }else{
                $query->where($where);
            }
            $query->whereNotNull('name_bn');
            return $query->select("name_bn", "id")->get();
        }else{
            return $results = DB::select("SELECT program_artist_info.id,program_artist_info.name_bn,program_artist_info.name,program_artist_info.name_bn,national_awarded,JSON_EXTRACT(artist_expertise_info,'$[*].expertise') as expertise_id,JSON_EXTRACT(artist_expertise_info,'$[*].expertise_grade') AS expertise_info FROM program_artist_info WHERE is_active=1 and station_id=2 
          AND  (  JSON_CONTAINS(artist_expertise_info->'$[*].expertise', json_array('192')) ) ORDER BY program_artist_info.name_bn ASC" );
        }
    }
    public static function get_single_artist_select_presentation($where = null)
    {
            $query = DB::table('program_artist_info');
            $query->where($where);
            $expertist_info=$query->select("artist_expertise_info")->first();
            $all_expertist_info=$expertist_info->artist_expertise_info;
            if(!empty($all_expertist_info)) {
                $data = json_decode($all_expertist_info, true);
                //return $data;
                if(!empty($data)) {
                    $key = array_search('192', array_column($data, 'expertise'));
                 //return $data[$key]['expertise_grade'];
                    if (!empty($data[$key]['expertise_grade'])){
                        return $data[$key]['expertise_grade'];
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }else{
                return false;
            }

    }
    public static function get_all_role_info($where = null)
    {
        $query = DB::table('user_role_info');
        $query->where($where);
    //    $query->leftJoin('user_role_info as main_menu_info', 'main_menu_info.parent_id', '=', 'user_role_info.id');
       // $query->leftJoin('user_role_info as sub_menu_info', 'sub_menu_info.parent_id', '=', 'main_menu_info.id');
        //$query->orderBy("user_role_info.display_position","ASC");
     //   $query->groupBy("user_role_info.type","main_menu_info.type");
        $expertist_info=$query->select("*")
            ->get();
        if(!empty($expertist_info)) {
            return $data = $expertist_info;
        }else{
            return false;
        }

    }
    public static function searching_artist_info($receive=NULL){
        if(!empty($receive)) {
            $results = [];
            $queries = DB::table('program_artist_info')
                ->whereIn('is_active', ['1','2'])
                ->where('name_bn', 'LIKE', '%' . $receive . '%')
                ->orWhere('name', 'LIKE', '%' . $receive . '%')
                ->orWhere('artist_id', 'LIKE', '%' . $receive . '%')
                ->take(10)->get();
            foreach ($queries as $query) {
                $results[] = ['id' => $query->id, 'value' => $query->name_bn . " (" . $query->artist_id . ")"];
            }
            return $results;
        }else{
            return false;
        }
    }



}
