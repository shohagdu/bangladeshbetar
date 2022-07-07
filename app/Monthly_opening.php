<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Monthly_opening extends Model
{
    public static function get_fiscal_year_info($where = null)
    {
        $query =  DB::table('fiscal_year');
        $query->where("is_active","=",1);
        if(!is_null($where )) {
            foreach($where as $k => $v){
                $query->where($k, $v);
            }
        }
        return $query->pluck(DB::raw("concat(title,' (', DATE_FORMAT(start_date, '%d-%m-%Y'), ' To ',  DATE_FORMAT(end_date, '%d-%m-%Y'),')') as fiscal_year_title"),"id");
    }

    public static function get_current_payslip_months($where = null,$all=null)
    {
        $query =  DB::table('monthly_openings');
        if(!empty($all)){
            $query->where("status","!=",0);
        }
        if(!is_null($where ) && !empty($where)) {
            foreach($where as $k => $v){
                $query->where($k, $v);
            }
        }
        return $query->pluck(DB::raw("concat(title,' (', DATE_FORMAT(start_date, '%d-%m-%Y'), ' To ',  DATE_FORMAT(end_date, '%d-%m-%Y'),')') as payslip_title"),"id");
    }

    public static function get_current_fiscal_year($where = null)
    {
        if(!is_null($where ) && !empty($where)) {
            $query =  DB::table('fiscal_year');
            $query->where($where);
            return  $query->select("title","fiscal_year.id as fiscal_yer_id","start_date","end_date")->first();
        }else{
            return false;
        }

    }

    public static function get_current_payslip_month_info($where = null)
    {
        $query =  DB::table('monthly_openings');
        if(!is_null($where ) && !empty($where)) {
            foreach($where as $k => $v){
                $query->where($k, $v);
            }
        }
        return $query->select("title", "start_date","end_date","id")->first();
    }

}
