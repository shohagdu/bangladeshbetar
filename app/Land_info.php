<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Land_info extends Model
{
    public static function get_land_info($receive = null)
    {
        $query =  DB::table('land_infos');
        $query->where($receive);
        return $query->select('land_infos.*')->first();
    }

    public static function get_search_land_info($receive = null){

        // echo "<pre>";
        //                 print_r($receive);exit;

        $query =  DB::table('land_infos')
                        ->select("land_infos.*","land_infos.location as location_name", "all_sttings.title as area_name", "branch_infos.name as station_name")  
                        ->leftJoin('all_sttings', 'all_sttings.id', '=', 'land_infos.area')
                        ->leftJoin('branch_infos', 'branch_infos.id', '=', 'land_infos.station_id')
                        ->orderBy('land_infos.id','DESC'); 

                        if(!empty($receive['station_id'])) {
                            $query->where('land_infos.station_id',$receive['station_id']);
                        }
                        if(!empty($receive['area'])) {
                            $query->where('land_infos.area',$receive['area']);
                        }
                        if(!empty($receive['land_no'])) {
                            $query->where('land_infos.land_no',$receive['land_no']);
                        }
                        if(!empty($receive['dag_no'])) {
                            $query->where('land_infos.dag_no',$receive['dag_no']);
                        }
                        if(!empty($receive['khotian_no'])) {
                            $query->where('land_infos.khotian_no',$receive['khotian_no']);
                        }
                        if(!empty($receive['mouza_no'])) {
                            $query->where('land_infos.mouza_no',$receive['mouza_no']);
                        }
                        if(!empty($receive['zer_no'])) {
                            $query->where('land_infos.zer_no',$receive['zer_no']);
                        }
                        if(!empty($receive['last_date_tax'])) {
                            $query->where('land_infos.last_date_tax',$receive['last_date_tax']);
                        }
                        
        $get_land_info =  $query->get();
        return $get_land_info;

    }
}
