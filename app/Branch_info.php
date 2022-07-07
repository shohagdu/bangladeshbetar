<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Session;

class Branch_info extends Model
{
    public static function get_all_branch_info($where = null)
    {
        $query =  DB::table('branch_infos');
        $query->where("is_active","!=",0);
        $query->where("parent_id","=",NULL);
        if(!is_null($where )) {
            foreach($where as $k => $v){
                $query->where($k, $v);
            }
        }
        return $query->select("name","id","is_active","mobile","email","sorting","address")->get();
    }
    public static function get_all_sub_station_info($where = null)
    {
        $query =  DB::table('branch_infos');
        $query->where("is_active","=",1);
        $query->where("parent_id","!=",NULL);
        if(!is_null($where )) {
            foreach($where as $k => $v){
                $query->where($k, $v);
            }
        }
        return $query->select("type","fequencey","title","start_time","end_time","id")->get();
    }

    public static function branch_info_select($where = null)
    {
        $station_id= (!empty(Session::get('user_info')->station_id)?Session::get('user_info')
            ->station_id:NULL);
        $query =  DB::table('branch_infos');
        if(!is_null($where )) {
            foreach($where as $k => $v){
                $query->where($k, $v);
            }
        }
        if(!empty($station_id) && $station_id==1){

        }elseif(!empty($station_id) && $station_id!=1){
            $query->where("id","=",$station_id);
        }
        $query->where("parent_id","=",NULL);
        return $query->pluck("name","id");
    }
}
