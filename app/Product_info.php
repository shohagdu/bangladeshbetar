<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Product_info extends Model
{

    public static function searching_product_info($receive=NULL){
        if(!empty($receive)) {
            $results = [];
            $queries = DB::table('product_infos')
                ->where('name', 'LIKE', '%' . $receive . '%')
                ->orWhere('product_code', 'LIKE', '%' . $receive . '%')
                ->take(10)->get();
            foreach ($queries as $query) {
                $results[] = ['id' => $query->id, 'value' => $query->name . " (" . $query->product_code . ")"];
            }
            return $results;
        }else{
            return false;
        }
    }
    public static function single_product_info($receive=NULL){
        if(!empty($receive)) {
            $query = DB::table('product_infos');
            $query->where('id', '=' ,$receive );
             $product_info=$query->select('product_infos.name as product_name','product_infos.product_code')->first();
            return $product_info->product_name."(".$product_info->product_code.")";

        }else{
            return false;
        }
    }





}