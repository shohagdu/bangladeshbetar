<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product_stock_info extends Model
{
    public static function stock_code_generate($station=NULL,$product_id=NULL){
        $stock_code=self::stock_code($station,$product_id);
       return date('y').str_pad($station,2,0,STR_PAD_LEFT).str_pad($stock_code,5,0,STR_PAD_LEFT);
    }

    public static function stock_code($station,$product_id)
    {
        $query =  DB::table('product_stock_infos');
        $query->where("is_active","!=",0);
        $query->where('station_id',$station);
        $query->where('product_id',$product_id);
        $query->select('product_stock_infos.id');
        if($query->count()>0){
            $stock_id=$query->count();
            return $stock_id+1;
        }else{
            return 1;
        }
    }
    public static function get_product_stock_report($receive)
    {

        $query =  DB::table('product_stock_infos');
        $query->leftJoin("branch_infos",'product_stock_infos.station_id','=','branch_infos.id');
        $query->leftJoin("product_infos",'product_infos.id','=','product_stock_infos.product_id');
        $query->leftJoin("all_sttings as product_ctg",'product_ctg.id','=','product_infos.ctg_id');
        $query->leftJoin("all_sttings as product_subctg",'product_subctg.id','=','product_infos.sub_ctg_id');

        if(!empty($receive['product_stock_infos.station_id'])) {
            $query->where('product_stock_infos.station_id', $receive['station_id']);
        }
        if(!empty($receive['product_ctg'])) {
            $query->where('product_ctg.id', $receive['product_ctg']);
        }
        if(!empty($receive['sub_ctg_id'])) {
            $query->where('product_subctg.id', $receive['sub_ctg_id']);
        }
        if(!empty($receive['product'])) {
            $query->where('product_infos.id', $receive['product']);
        }
        if(!empty($receive['stock_type'])) {
            $stock_type=($receive['stock_type']==5)?0:$receive['stock_type'];
            $query->where("product_stock_infos.is_active","=",$stock_type);
        }


        $query->orderBy("product_stock_infos.id","DESC");
        $query->select('product_stock_infos.*',"branch_infos.name as station_name" ,(DB::raw("concat(product_infos.name,'-',product_infos.product_code) as product_name")),(DB::raw("product_ctg.title as product_ctg_title")),(DB::raw("product_subctg.title as product_sub_ctg_title")),(DB::raw("date_format(product_stock_infos.purchase_date,'%d-%m-%Y') as purchase_date_show")),(DB::raw("IF(product_stock_infos.warranty_count>0,concat(product_stock_infos.warranty_count,'-',product_stock_infos.warranty_Info),product_stock_infos.warranty_Info) as warranty_info_show")),(DB::raw("IF(product_stock_infos.lifetime_count>0,concat(product_stock_infos.lifetime_count,'-',product_stock_infos.	product_life_time_info),product_stock_infos.	product_life_time_info) as life_time_info_show")),(DB::raw("IF(product_stock_infos.is_maintance>1,'Yes','No') as maintainance_info_show")));
        if($query->count()>0){
          return $query->get();
        }else{
            return false;
        }
    }


}