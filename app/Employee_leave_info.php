<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Employee_leave_info extends Model
{
    public static function get_leave_info($where = null)
    {
        $query = DB::table('employee_leave_infos as leave');
        $query->leftJoin('employees', 'employees.employee_id', '=', 'leave.employee_id');
        $query->leftJoin('all_sttings as leave_ctg', 'leave_ctg.id', '=', 'leave.leave_type_id');
        $query->leftJoin('all_sttings as department', 'department.id', '=', 'employees.department_id');
        $query->leftJoin('all_sttings as designation', 'designation.id', '=', 'employees.designation_id');
        $query->where("leave.status", "!=", 0);
        $query->orderBy("leave.status", "ASC");
        if (!is_null($where)) {
            foreach ($where as $k => $v) {
                $query->where($k, $v);
            }
        }
        return $query->select("designation.title as designation_title","department.title as department_title","leave_ctg.title as leave_type","employees.employee_id","employees.emp_name","leave.id", "leave.from_date", "leave.to_date", "leave.leave_reason",DB::raw("( CASE WHEN leave.status = 1 THEN ' Pending' WHEN leave.status = 2 THEN 'Recommend' WHEN leave.status = 3 THEN 'Denied' WHEN leave.status = 4 THEN 'Cancelled' WHEN leave.status = 5 THEN 'Approved'  ELSE '' END) AS status"))->get();
    }

}
