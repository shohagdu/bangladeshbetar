<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Archive_model extends Model
{

    public static function get_settings($table, $where = null)
    {
        $query = DB::table($table);
        if (!is_null($where)) {
            foreach ($where as $k => $v) {
                $query->where($k, $v);
            }
        }
        return $query->get();
    }

    public static function get_boardcast_frequency()
    {
        $query = DB::table("archive_info")
            ->select("boardcast_frequency as value")
            ->where("boardcast_frequency", "!=", NULL)
            ->groupBy("boardcast_frequency")
            ->get();
        return $query;
    }

    public static function get_song_id($receive)
    {
        $station = DB::table('branch_infos')
            ->select('abbreviation')
            ->where(['id' => $receive['station_id']])
            ->first();
        $total_song = DB::table('archive_info')->where(['archive_type' => 1, 'is_active' => 1])->count();
        $id = str_pad(($total_song + 1), 4, '0', STR_PAD_LEFT);
        $category = DB::table('archive_category')->select('code')->where(['id' => $receive['song_category']])->first();
        return $station->abbreviation . '-' . $category->code . '-' . date('dmy') . '-' . $id;
    }

    public static function get_kobita_id($receive)
    {
        $station = DB::table('branch_infos')
            ->select('abbreviation')
            ->where(['id' => $receive['station_id']])
            ->first();
        $total_song = DB::table('archive_info')->where(['archive_type' => 2, 'is_active' => 1])->count();
        $id = str_pad(($total_song + 1), 4, '0', STR_PAD_LEFT);
        return $station->abbreviation . '-' . 'PO' . '-' . date('dmy') . '-' . $id;
    }

    public static function get_natok_id($receive)
    {
        $station = DB::table('branch_infos')
            ->select('abbreviation')
            ->where(['id' => $receive['station_id']])
            ->first();
        $total_song = DB::table('archive_info')->where(['archive_type' => 3, 'is_active' => 1])->count();
        $id = str_pad(($total_song + 1), 4, '0', STR_PAD_LEFT);
        $category = DB::table('archive_category')->select('code')->where(['id' => $receive['category']])->first();
        return $station->abbreviation . '-' . 'DR' . '-' . $receive['name'] . '-' . date('dmy') . '-' . $id;
    }

    public static function get_program_id($receive)
    {
        $station = DB::table('branch_infos')
            ->select('abbreviation')
            ->where(['id' => $receive['station_id']])
            ->first();
        $total_song = DB::table('archive_info')->where(['archive_type' => 4, 'is_active' => 1])->count();
        $id = str_pad(($total_song + 1), 4, '0', STR_PAD_LEFT);
        $category = DB::table('archive_category')->select('code')->where(['id' => $receive['category']])->first();
        return $station->abbreviation . '-' . 'MA' . '-' . $receive['name'] . '-' . date('dmy') . '-' . $id;
    }

    public static function get_vhason_id($receive)
    {
        $station = DB::table('branch_infos')
            ->select('abbreviation')
            ->where(['id' => $receive['station_id']])
            ->first();
        $total_song = DB::table('archive_info')->where(['archive_type' => 5, 'is_active' => 1])->count();
        $id = str_pad(($total_song + 1), 4, '0', STR_PAD_LEFT);
        $category = DB::table('archive_category')->select('code')->where(['id' => $receive['category']])->first();
        return $station->abbreviation . '-' . 'SP' . '-' . date('dmy') . '-' . $id;
    }

    public static function get_sakkhat_id($receive)
    {
        $station = DB::table('branch_infos')
            ->select('abbreviation')
            ->where(['id' => $receive['station_id']])
            ->first();
        $total_song = DB::table('archive_info')->where(['archive_type' => 6, 'is_active' => 1])->count();
        $id = str_pad(($total_song + 1), 4, '0', STR_PAD_LEFT);
        $category = DB::table('archive_category')->select('code')->where(['id' => $receive['category']])->first();
        return $station->abbreviation . '-' . 'IN' . '-' . date('dmy') . '-' . $id;
    }

    public static function get_kothika_id($receive)
    {
        $station = DB::table('branch_infos')
            ->select('abbreviation')
            ->where(['id' => $receive['station_id']])
            ->first();
        $total_song = DB::table('archive_info')->where(['archive_type' => 7, 'is_active' => 1])->count();
        $id = str_pad(($total_song + 1), 4, '0', STR_PAD_LEFT);
        return $station->abbreviation . '-' . 'SC' . '-' . date('dmy') . '-' . $id;
    }

    public static function get_procharona_id($receive)
    {
        $station = DB::table('branch_infos')
            ->select('abbreviation')
            ->where(['id' => $receive['station_id']])
            ->first();
        $total_song = DB::table('archive_info')->where(['archive_type' => 8, 'is_active' => 1])->count();
        $id = str_pad(($total_song + 1), 4, '0', STR_PAD_LEFT);
        return $station->abbreviation . '-' .'AN' . '-' . date('dmy') . '-' . $id;
    }


    public static function get_row($table, $select = ["*"], $where = [], $join_param = [])
    {
        $query = DB::table($table)->select($select);
        if (!empty($where)) {
            $query->where($where);
        }
        $data = $query->first();
        if (empty($data)) {
            return false;
        } else {
            return $data;
        }
    }

    public static function get_rows($table, $select = ["*"], $where = [], $join_param = [], $where_in = [], $where_date = false, $between = false, $order_by = false,$like=false,$pagination=false)
    {
        $query = DB::table($table)->select($select);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($order_by)) {
            foreach ($order_by as $item) {
                $query->orderBy($item['field'], $item['type']);
            }
        }
        if (!empty($between)) {
            foreach ($between as $item) {
                $query->whereBetween($item['field'], [$item['from'], $item['to']]);
            }
        }

        if (!empty($like)) {
            foreach ($like as $item) {
                if($item['type'] == 'left') {
                    $item_value = "%{$item['value']}";
                }
                else if($item['type'] == 'right') {
                    $item_value = "{$item['value']}%";
                }
                else {
                    $item_value = "%{$item['value']}%";
                }

                $query->where($item['field'], 'LIKE', $item_value);
            }
        }

        if (!empty($where_date)) {
            foreach ($where_date as $item) {
                $query->whereDate($item['field'], $item['operator'], $item['value']);
            }
        }

        if (!empty($where_in)) {
            $query->whereIn($where_in['field'], $where_in['value']);
        }
        if (!empty($join_param)) {
            foreach ($join_param as $item) {
                if (isset($item['type']) && $item['type'] == 'left') {
                    $query->leftJoin($item['table'], function ($join) use ($item) {
                        $on = $item['on'];
                        $join->on($on['first_param'], $on['operator'], $on['second_param']);
                        if (!empty($item['where'])) {
                            $where = $item['where'];
                            foreach ($where as $where_item) {
                                $join->where($where_item['field'], $where_item['operator'], $where_item['value']);
                            }
                        }
                    });
                } else if (isset($item['type']) && $item['type'] == 'right') {
                    $query->rightJoin($item['table'], function ($join) use ($item) {
                        $on = $item['on'];
                        $join->on($on['first_param'], $on['operator'], $on['second_param']);
                        if (!empty($item['where'])) {
                            $where = $item['where'];
                            foreach ($where as $where_item) {
                                $join->where($where_item['field'], $where_item['operator'], $where_item['value']);
                            }
                        }
                    });
                } else {
                    $query->join($item['table'], function ($join) use ($item) {
                        $on = $item['on'];
                        $join->on($on['first_param'], $on['operator'], $on['second_param']);
                        if (!empty($item['where'])) {
                            $where = $item['where'];
                            foreach ($where as $where_item) {
                                $join->where($where_item['field'], $where_item['operator'], $where_item['value']);
                            }
                        }
                    });
                }
            }
        }

        if($pagination) {
            $per_page =  Archive_model::per_page();
            $data = $query->paginate($per_page);
            if (empty($data)) {
                return false;
            } else {
                return $data;
            }
        }
        else {
            $data = $query->get();
            if (empty($data)) {
                return false;
            } else {
                return $data;
            }
        }


    }

    public static function upload_file($file, $name, $src)
    {
        $file_name = $name . '.' . $file->getClientOriginalExtension();
        return $file->move($src, $file_name);
    }

    public static function get_song_file_name($request)
    {
//        $file_name = $name . '.' . $file->getClientOriginalExtension();
//        return $file->move($src, $file_name);

    }



    public static function get_instument()
    {
        $query = DB::table("archive_instument")
            ->select("name as value")
            // ->where("instument" , "!=", NULL)
            // ->groupBy("instument")
            ->get();
        return $query;
    }


    public static function get_film_actor($text)
    {
        $queries = DB::table('archive_artist')
            ->where('name', 'LIKE', '%' . $text . '%')
            // ->orWhere('employee_id', 'LIKE', '%' . $text . '%')
            ->take(10)->get();
        return $queries;
    }

    public static function get_film_director($text)
    {
        $queries = DB::table('archive_director')
            ->where('name', 'LIKE', '%' . $text . '%')
            // ->orWhere('employee_id', 'LIKE', '%' . $text . '%')
            ->take(10)->get();
        return $queries;
    }

    public function get_archive_type()
    {
        $archive_type = [
            1 => 'সংগীত',
            2 => 'কবিতা',
            3 => 'নাটক',
            4 => 'বিশেষ অনুষ্ঠান',
            5 => 'ভাষণ',
            6 => 'সাক্ষাৎকার',
            7 => 'কথিকা',
            8 => 'প্রচারনা',
        ];

        return $archive_type;
    }

    public static function get_artist_info($search, $expertise_id)
    {
        // $query = DB::select("SELECT program_artist_info.id,program_artist_info.name_bn,program_artist_info.name,program_artist_info.name_bn,national_awarded,JSON_EXTRACT(artist_expertise_info,'$[*].expertise') as expertise_id,JSON_EXTRACT(artist_expertise_info,'$[*].expertise_grade') AS expertise_info
        //  FROM program_artist_info WHERE (name like '%kama%' or name_bn like '%কামাল%') and  is_active=1 and station_id=2 
        // AND  (  JSON_CONTAINS(artist_expertise_info->'$[*].expertise', json_array('20')) ) ORDER BY program_artist_info.name_bn ASC");
        // return $query;
        $query = DB::select("SELECT CONCAT(program_artist_info.name_bn, ' - ',program_artist_info.mobile) AS text, program_artist_info.id
         FROM program_artist_info WHERE (name like '%$search%' or name_bn like '%$search%') AND  is_active=1 
        AND  (  JSON_CONTAINS(artist_expertise_info->'$[*].expertise', json_array('20')) ) ORDER BY program_artist_info.name_bn ASC");
        return $query;
    }

//    public static function get_archive_ids($search,$expertise_id) {
//        // $query = DB::select("SELECT program_artist_info.id,program_artist_info.name_bn,program_artist_info.name,program_artist_info.name_bn,national_awarded,JSON_EXTRACT(artist_expertise_info,'$[*].expertise') as expertise_id,JSON_EXTRACT(artist_expertise_info,'$[*].expertise_grade') AS expertise_info
//        //  FROM program_artist_info WHERE (name like '%kama%' or name_bn like '%কামাল%') and  is_active=1 and station_id=2
//        // AND  (  JSON_CONTAINS(artist_expertise_info->'$[*].expertise', json_array('20')) ) ORDER BY program_artist_info.name_bn ASC");
//        // return $query;
//        $query = DB::select("SELECT CONCAT(program_artist_info.name_bn, ' - ',program_artist_info.mobile) AS text, archive_info.id
//         FROM archive_info WHERE (name like '%$search%' or name_bn like '%$search%') AND  is_active=1
//        AND  (  JSON_CONTAINS(artist_expertise_info->'$[*].expertise', json_array('20')) ) ORDER BY program_artist_info.name_bn ASC");
//        return $query;
//    }

    // DB::select("SELECT program_artist_info.id,program_artist_info.name_bn,program_artist_info.name,program_artist_info.name_bn,national_awarded,JSON_EXTRACT(artist_expertise_info,'$[*].expertise') as expertise_id,JSON_EXTRACT(artist_expertise_info,'$[*].expertise_grade') AS expertise_info FROM program_artist_info WHERE is_active=1 and station_id=2 
    //       AND  (  JSON_CONTAINS(artist_expertise_info->'$[*].expertise', json_array('$expertise_id')) ) ORDER BY program_artist_info.name_bn ASC" );


    public static function get_artist_ids($artist=[]) {
        $query = DB::table('program_artist_info')->select([DB::raw('group_concat(QUOTE(id)) as ids')]);
        if(!empty($artist)) {
            foreach($artist as $artist_name) {
                $query->orWhere("name_bn", "like", "%$artist_name%");
            }
        }
        $result =  $query->first();
        if(!empty($result)) {
            dd();
           return $result->ids;
        }
        else {
            return '';
        }
    }

    public static function get_album_ids($artist=[],$type=1) {
        $query = DB::table('archive_albam')->select([DB::raw('group_concat(id) as ids')])->where("type","=",$type);
        if(!empty($artist)) {
            foreach($artist as $artist_name) {
                $query->orWhere("name", "like", "%$artist_name%");
            }
        }
        $result =  $query->first();

        if(!empty($result)) {
            return $result->ids;
        }
        else {
            return '';
        }
    }


    public static function get_songit_info($request,$pagination = false) {
        $query = DB::table('archive_info');
        // global where
        $query->where(function($param) use ($request) {
            $param->where('is_active', '!=', 0)
            ->where('is_approve','=',1)
                ->where('archive_type','=',1);

            if(!empty($request->station_id)) {
                $station_array = $request['station_id'];
                $trimmedArray = array_filter($station_array,function($value){
                    return !empty($value);
                });
                if(!empty($trimmedArray)) {
                    $param->whereIn('station_id',$trimmedArray);
                }
            }
        });

        // import data
        if(!empty($request->search_string) && !empty($request->item_type)) {
            $item_key_name = get_songit_key_name($request->item_type);
            if(empty($request[$item_key_name])) {
                $request->request->add([$item_key_name => []]);
            }
            $get_exist_data = $request->$item_key_name;
            $get_exist_data[] = $request->search_string;
            $request->request->add([$item_key_name => $get_exist_data]);
        }

        if(!empty($request->item_type)) { // item search

            $query->where(function ($param) use ($request) {
                // global or where
                $item_type_ids = get_songit_item_key();
                foreach($item_type_ids as $item_key) {
                    $item_key_name = get_songit_key_name($item_key);

                    if($item_key_name=='name' || $item_key_name=='first_line' || $item_key_name=='rating') { // name and first line
                        if (!empty($request->$item_key_name)) {
                            foreach ($request->$item_key_name as $item) {
                                $param->where("songit_info->{$item_key_name}", 'LIKE', "%$item%");
                            }
                        }
                    }

                    if($item_key_name=='category') { // name and first line
                        if (!empty($request->$item_key_name)) {
                            foreach ($request->$item_key_name as $item) {
                                $category_ids = Archive_model::get_rows("archive_category",["id"],['type'=>1],[],[],[],[],false,[['field'=>'name','value'=>$item,'type'=>'both']]);
                                foreach($category_ids as $ctg_id){
                                    $param->where("songit_info->{$item_key_name}", 'LIKE', "%$ctg_id->id%");
                                }
                            }
                        }
                    }

                    if($item_key_name=='band_id') { // name and first line
                        if (!empty($request->$item_key_name)) {
                            foreach ($request->$item_key_name as $item) {
                                $band_ids = Archive_model::get_rows("archive_band",["id"],[],[],[],[],[],false,[['field'=>'name','value'=>$item,'type'=>'both']]);
                                foreach($band_ids as $bnd_id){
                                    $param->where("songit_info->{$item_key_name}", 'LIKE', "%$bnd_id->id%");
                                }
                            }
                        }
                    }

                    if($item_key_name == 'artist') {
                        if(!empty($request->artist)) {
                            $ids =  Archive_model::get_artist_ids($request->artist);
                            if(!empty($ids)) {
//                                $param->where(DB::raw("JSON_CONTAINS(songit_info->'$.artist', \"[$ids]\")"),true);
                                 $param->where(DB::raw("JSON_CONTAINS(songit_info->'$.artist', json_array($ids))"));
                                // $param->orWhere(DB::raw("JSON_CONTAINS(file_list.content->'$.$column', '[\"$string\"]')"),true);
//                                select * from `archive_info` where (`is_active` !=0  and `is_approve` = 1 and `archive_type` = 1) and (JSON_CONTAINS(songit_info->'$.artist', '["27","48"]' ))
                            }
                        }
                    }

                    if($item_key_name == 'gitikar') {
                        if(!empty($request->gitikar)) {
                            $ids =  Archive_model::get_artist_ids($request->gitikar);
                            if(!empty($ids)) {
                                $param->where(DB::raw("JSON_CONTAINS(songit_info->'$.gitikar', json_array($ids))"));
                            }
                        }
                    }

                    if($item_key_name == 'surokar') {
                        if(!empty($request->surokar)) {
                            $ids =  Archive_model::get_artist_ids($request->surokar);
                            if(!empty($ids)) {
                                $param->where(DB::raw("JSON_CONTAINS(songit_info->'$.surokar', json_array($ids))"));
                            }
                        }
                    }

                    if($item_key_name == 'album_id') {
                        if(!empty($request->album_id)) {
                            $ids =  Archive_model::get_album_ids($request->album_id);
                            if(!empty($ids)) {
                                $param->where(DB::raw("JSON_CONTAINS(songit_info->'$.album_id', json_array($ids))"));
                            }
                        }
                    }

                    if($item_key_name=='film_name') { // name and first line
                        if (!empty($request->$item_key_name)) {
                            foreach ($request->$item_key_name as $item) {
                                $param->where("songit_info->film_info->film_name", 'LIKE', "%$item%");
                            }
                        }
                    }


                }
            });
        }
        else { // global search

            if(!empty($request->search_string)) {

                $query->where(function ($param) use ($request) {
                    $search_string = $request->search_string;
                    // global or where
                    $item_type_ids = get_songit_item_key();
                    foreach($item_type_ids as $item_key) {
                        $item_key_name = get_songit_key_name($item_key);
                        if($item_key_name=='name' || $item_key_name=='first_line' || $item_key_name=='rating') { // name and first line
                            $param->orWhere("songit_info->{$item_key_name}", 'LIKE', "%$search_string%");
                        }
                        if($item_key_name=='category') { // name and first line
                            $category_ids = Archive_model::get_rows("archive_category",["id"],['type'=>1],[],[],[],[],false,[['field'=>'name','value'=>$search_string,'type'=>'both']]);
                            if(!empty($category_ids)) {
                                foreach ($category_ids as $ctg_id) {
                                    $param->orWhere("songit_info->{$item_key_name}", 'LIKE', "%$ctg_id->id%");
                                }
                            }
                        }

                        if($item_key_name=='band_id') { // name and first line
                            $band_ids = Archive_model::get_rows("archive_band",["id"],[],[],[],[],[],false,[['field'=>'name','value'=>$search_string,'type'=>'both']]);
                            if(!empty($band_ids)) {
                                foreach ($band_ids as $bnd_id) {
                                    $param->orWhere("songit_info->{$item_key_name}", 'LIKE', "%$bnd_id->id%");
                                }
                            }

                        }

                        if($item_key_name == 'artist') {
                            $ids =  Archive_model::get_artist_ids([$search_string]);
                            if(!empty($ids)) {
                                $param->orWhere(DB::raw("JSON_CONTAINS(songit_info->'$.artist', json_array($ids))"));
                            }
                        }

                        if($item_key_name == 'gitikar') {
                            $ids =  Archive_model::get_artist_ids([$search_string]);
                            if(!empty($ids)) {
                                $param->orWhere(DB::raw("JSON_CONTAINS(songit_info->'$.gitikar', json_array($ids))"));
                            }
                        }

                        if($item_key_name == 'surokar') {
                            $ids =  Archive_model::get_artist_ids([$search_string]);
                            if(!empty($ids)) {
                                $param->orWhere(DB::raw("JSON_CONTAINS(songit_info->'$.surokar', json_array($ids))"));
                            }
                        }

                        if($item_key_name == 'album_id') {
                            $ids =  Archive_model::get_album_ids([$search_string]);
                            if(!empty($ids)) {
                                $param->orWhere(DB::raw("JSON_CONTAINS(songit_info->'$.album_id', json_array($ids))"));
                            }
                        }

                        if($item_key_name=='film_name') { // name and first line
                            $param->orWhere("songit_info->film_info->film_name", 'LIKE', "%$search_string%");
                        }
                    }
                });

            }
        }

        if($pagination) {
            $per_page = !empty($request->per_page) ? $request->per_page : Archive_model::per_page();
//            dd($query->toSql());
            return $query->paginate($per_page);
        }
        else {
           return $query->get();
        }


    }

    public static function get_natok_info($request,$pagination = false) {
        $query = DB::table('archive_info');
        // global where
        $query->where(function($param) use ($request) {
            $param->where('is_active', '!=', 0)
            ->where('is_approve','=',1)
                ->where('archive_type','=',3);

            if(!empty($request->station_id)) {
                $station_array = $request['station_id'];
                $trimmedArray = array_filter($station_array,function($value){
                    return !empty($value);
                });
                if(!empty($trimmedArray)) {
                    $param->whereIn('station_id',$trimmedArray);
                }
            }
        });

        // import data
        if(!empty($request->search_string) && !empty($request->item_type)) {
            $item_key_name = get_natok_key_name($request->item_type);
            if(empty($request[$item_key_name])) {
                $request->request->add([$item_key_name => []]);
            }
            $get_exist_data = $request->$item_key_name;
            $get_exist_data[] = $request->search_string;
            $request->request->add([$item_key_name => $get_exist_data]);
        }

        if(!empty($request->item_type)) { // item search

            $query->where(function ($param) use ($request) {
                // global or where
                $item_type_ids = get_natok_item_key();
                foreach($item_type_ids as $item_key) {
                    $item_key_name = get_natok_key_name($item_key);

                    if($item_key_name=='name' || $item_key_name=='stability' || $item_key_name=='rating') { // name and first line
                        if (!empty($request->$item_key_name)) {
                            foreach ($request->$item_key_name as $item) {
                                $param->orWhere("natok_info->{$item_key_name}", 'LIKE', "%$item%");
                            }
                        }
                    }

                    if($item_key_name=='category') { // name and first line
                        if (!empty($request->$item_key_name)) {
                            foreach ($request->$item_key_name as $item) {
                                $category_ids = Archive_model::get_rows("archive_category",["id"],['type'=>3],[],[],[],[],false,[['field'=>'name','value'=>$item,'type'=>'both']]);
                                foreach($category_ids as $ctg_id){
                                    $param->orWhere("natok_info->{$item_key_name}", 'LIKE', "%$ctg_id->id%");
                                }
                            }
                        }
                    }

                    if($item_key_name == 'actors') {
                        if(!empty($request->actors)) {
                            $ids =  Archive_model::get_artist_ids($request->actors);
                            if(!empty($ids)) {
                                $param->orWhere(DB::raw("JSON_CONTAINS(natok_info->'$.actors', json_array($ids))"));
                            }
                        }
                    }

                    if($item_key_name == 'nattokar') {
                        if(!empty($request->nattokar)) {
                            $ids =  Archive_model::get_artist_ids($request->nattokar);
                            if(!empty($ids)) {
                                $param->orWhere(DB::raw("JSON_CONTAINS(natok_info->'$.nattokar', json_array($ids))"));
                            }
                        }
                    }

                    if($item_key_name == 'rupokar') {
                        if(!empty($request->rupokar)) {
                            $ids =  Archive_model::get_artist_ids($request->rupokar);
                            if(!empty($ids)) {
                                $param->orWhere(DB::raw("JSON_CONTAINS(natok_info->'$.rupokar', json_array($ids))"));
                            }
                        }
                    }

                    if($item_key_name == 'rochoyita') {
                        if(!empty($request->rochoyita)) {
                            $ids =  Archive_model::get_artist_ids($request->rochoyita);
                            if(!empty($ids)) {
                                $param->orWhere(DB::raw("JSON_CONTAINS(natok_info->'$.rochoyita', json_array($ids))"));
                            }
                        }
                    }


                }
            });
        }
        else { // global search

            if(!empty($request->search_string)) {

                $query->where(function ($param) use ($request) {
                    $search_string = $request->search_string;
                    // global or where
                    $item_type_ids = get_natok_item_key();
                    foreach($item_type_ids as $item_key) {
                        $item_key_name = get_natok_key_name($item_key);

                        if($item_key_name=='name' || $item_key_name=='stability' || $item_key_name=='rating') { // name and first line
                            $param->orWhere("natok_info->{$item_key_name}", 'LIKE', "%$search_string%");
                        }

                        if($item_key_name=='category') { // name and first line
                            $category_ids = Archive_model::get_rows("archive_category",["id"],['type'=>3],[],[],[],[],false,[['field'=>'name','value'=>$search_string,'type'=>'both']]);
                            if(!empty($category_ids)) {
                                foreach ($category_ids as $ctg_id) {
                                    $param->orWhere("natok_info->{$item_key_name}", 'LIKE', "%$ctg_id->id%");
                                }
                            }
                        }

                        if($item_key_name == 'actors') {
                                $ids =  Archive_model::get_artist_ids([$search_string]);
                                if(!empty($ids)) {
                                    $param->orWhere(DB::raw("JSON_CONTAINS(natok_info->'$.actors', json_array($ids))"));
                                }

                        }

                        if($item_key_name == 'nattokar') {
                                $ids =  Archive_model::get_artist_ids([$search_string]);
                                if(!empty($ids)) {
                                    $param->orWhere(DB::raw("JSON_CONTAINS(natok_info->'$.nattokar', json_array($ids))"));
                                }

                        }

                        if($item_key_name == 'rupokar') {
                                $ids =  Archive_model::get_artist_ids([$search_string]);
                                if(!empty($ids)) {
                                    $param->orWhere(DB::raw("JSON_CONTAINS(natok_info->'$.rupokar', json_array($ids))"));
                                }

                        }

                        if($item_key_name == 'rochoyita') {
                                $ids =  Archive_model::get_artist_ids([$search_string]);
                                if(!empty($ids)) {
                                    $param->orWhere(DB::raw("JSON_CONTAINS(natok_info->'$.rochoyita', json_array($ids))"));
                                }

                        }


                    }
                });

            }
        }

        if($pagination) {
            $per_page = !empty($request->per_page) ? $request->per_page : Archive_model::per_page();
            return $query->paginate($per_page);
        }
        else {
           return $query->get();
        }


    }

    public static function get_program_info($request,$pagination = false) {
        $query = DB::table('archive_info');
        // global where
        $query->where(function($param) use ($request) {
            $param->where('is_active', '!=', 0)
            ->where('is_approve','=',1)
                ->where('archive_type','=',4);

            if(!empty($request->station_id)) {
                $station_array = $request['station_id'];
                $trimmedArray = array_filter($station_array,function($value){
                    return !empty($value);
                });
                if(!empty($trimmedArray)) {
                    $param->whereIn('station_id',$trimmedArray);
                }
            }
        });

        // import data
        if(!empty($request->search_string) && !empty($request->item_type)) {
            $item_key_name = get_program_key_name($request->item_type);
            if(empty($request[$item_key_name])) {
                $request->request->add([$item_key_name => []]);
            }
            $get_exist_data = $request->$item_key_name;
            $get_exist_data[] = $request->search_string;
            $request->request->add([$item_key_name => $get_exist_data]);
        }

        if(!empty($request->item_type)) { // item search

            $query->where(function ($param) use ($request) {
                // global or where
                $item_type_ids = get_program_item_key();
                foreach($item_type_ids as $item_key) {
                    $item_key_name = get_program_key_name($item_key);

                    if($item_key_name=='name' || $item_key_name=='stability' || $item_key_name=='rating') { // name and first line
                        if (!empty($request->$item_key_name)) {
                            foreach ($request->$item_key_name as $item) {
                                $param->orWhere("program_info->{$item_key_name}", 'LIKE', "%$item%");
                            }
                        }
                    }

                    if($item_key_name=='category') { // name and first line
                        if (!empty($request->$item_key_name)) {
                            foreach ($request->$item_key_name as $item) {
                                $category_ids = Archive_model::get_rows("archive_category",["id"],['type'=>4],[],[],[],[],false,[['field'=>'name','value'=>$item,'type'=>'both']]);
                                foreach($category_ids as $ctg_id){
                                    $param->orWhere("program_info->{$item_key_name}", 'LIKE', "%$ctg_id->id%");
                                }
                            }
                        }
                    }

                    if($item_key_name == 'gobeshona') {
                        if(!empty($request->gobeshona)) {
                            $ids =  Archive_model::get_artist_ids($request->gobeshona);
                            if(!empty($ids)) {
                                $param->orWhere(DB::raw("JSON_CONTAINS(program_info->'$.gobeshona', json_array($ids))"));
                            }
                        }
                    }

                    if($item_key_name == 'gronthona') {
                        if(!empty($request->gronthona)) {
                            $ids =  Archive_model::get_artist_ids($request->gronthona);
                            if(!empty($ids)) {
                                $param->orWhere(DB::raw("JSON_CONTAINS(program_info->'$.gronthona', json_array($ids))"));
                            }
                        }
                    }

                    if($item_key_name == 'uposthapona') {
                        if(!empty($request->uposthapona)) {
                            $ids =  Archive_model::get_artist_ids($request->uposthapona);
                            if(!empty($ids)) {
                                $param->orWhere(DB::raw("JSON_CONTAINS(program_info->'$.uposthapona', json_array($ids))"));
                            }
                        }
                    }


                }
            });
        }
        else { // global search

            if(!empty($request->search_string)) {

                $query->where(function ($param) use ($request) {
                    $search_string = $request->search_string;
                    // global or where
                    $item_type_ids = get_program_item_key();
                    foreach($item_type_ids as $item_key) {
                        $item_key_name = get_program_key_name($item_key);

                        if($item_key_name=='name' || $item_key_name=='stability' || $item_key_name=='rating') { // name and first line
                            $param->orWhere("program_info->{$item_key_name}", 'LIKE', "%$search_string%");
                        }

                        if($item_key_name=='category') { // name and first line
                            $category_ids = Archive_model::get_rows("archive_category",["id"],['type'=>4],[],[],[],[],false,[['field'=>'name','value'=>$search_string,'type'=>'both']]);
                            if(!empty($category_ids)) {
                                foreach ($category_ids as $ctg_id) {
                                    $param->orWhere("program_info->{$item_key_name}", 'LIKE', "%$ctg_id->id%");
                                }
                            }
                        }

                        if($item_key_name == 'gobeshona') {
                            $ids =  Archive_model::get_artist_ids([$search_string]);
                            if(!empty($ids)) {
                                $param->orWhere(DB::raw("JSON_CONTAINS(program_info->'$.gobeshona', json_array($ids))"));
                            }
                        }

                        if($item_key_name == 'gronthona') {
                            $ids =  Archive_model::get_artist_ids([$search_string]);
                            if(!empty($ids)) {
                                $param->orWhere(DB::raw("JSON_CONTAINS(program_info->'$.gronthona', json_array($ids))"));
                            }
                        }

                        if($item_key_name == 'uposthapona') {
                            $ids =  Archive_model::get_artist_ids([$search_string]);
                            if(!empty($ids)) {
                                $param->orWhere(DB::raw("JSON_CONTAINS(program_info->'$.uposthapona', json_array($ids))"));
                            }
                        }



                    }
                });

            }
        }

        if($pagination) {
            $per_page = !empty($request->per_page) ? $request->per_page : Archive_model::per_page();
            return $query->paginate($per_page);
        }
        else {
           return $query->get();
        }


    }

    public static function get_vhason_info($request,$pagination = false) {
        $query = DB::table('archive_info');
        // global where
        $query->where(function($param) use ($request) {
            $param->where('is_active', '!=', 0)
            ->where('is_approve','=',1)
                ->where('archive_type','=',5);

            if(!empty($request->station_id)) {
                $station_array = $request['station_id'];
                $trimmedArray = array_filter($station_array,function($value){
                    return !empty($value);
                });
                if(!empty($trimmedArray)) {
                    $param->whereIn('station_id',$trimmedArray);
                }
            }
        });

        // import data
        if(!empty($request->search_string) && !empty($request->item_type)) {
            $item_key_name = get_vhason_key_name($request->item_type);
            if(empty($request[$item_key_name])) {
                $request->request->add([$item_key_name => []]);
            }
            $get_exist_data = $request->$item_key_name;
            $get_exist_data[] = $request->search_string;
            $request->request->add([$item_key_name => $get_exist_data]);
        }

        if(!empty($request->item_type)) { // item search

            $query->where(function ($param) use ($request) {
                // global or where
                $item_type_ids = get_vhason_item_key();
                foreach($item_type_ids as $item_key) {
                    $item_key_name = get_vhason_key_name($item_key);

                    if( $item_key_name=='vhason_kari' || $item_key_name=='subject' || $item_key_name=='first_line' || $item_key_name=='stability' || $item_key_name=='rating') { // name and first line
                        if (!empty($request->$item_key_name)) {
                            foreach ($request->$item_key_name as $item) {
                                $param->orWhere("vhason_info->{$item_key_name}", 'LIKE', "%$item%");
                            }
                        }
                    }

                    if($item_key_name=='category') { // name and first line
                        if (!empty($request->$item_key_name)) {
                            foreach ($request->$item_key_name as $item) {
                                $category_ids = Archive_model::get_rows("archive_category",["id"],['type'=>5],[],[],[],[],false,[['field'=>'name','value'=>$item,'type'=>'both']]);
                                foreach($category_ids as $ctg_id){
                                    $param->orWhere("vhason_info->{$item_key_name}", 'LIKE', "%$ctg_id->id%");
                                }
                            }
                        }
                    }

                }
            });
        }
        else { // global search

            if(!empty($request->search_string)) {

                $query->where(function ($param) use ($request) {
                    $search_string = $request->search_string;
                    // global or where
                    $item_type_ids = get_program_item_key();
                    foreach($item_type_ids as $item_key) {
                        $item_key_name = get_program_key_name($item_key);

                        if( $item_key_name=='vhason_kari' || $item_key_name=='subject' || $item_key_name=='first_line' || $item_key_name=='stability' || $item_key_name=='rating') { // name and first line
                            $param->orWhere("vhason_info->{$item_key_name}", 'LIKE', "%$search_string%");
                        }

                        if($item_key_name=='category') { // name and first line
                            $category_ids = Archive_model::get_rows("archive_category",["id"],['type'=>4],[],[],[],[],false,[['field'=>'name','value'=>$search_string,'type'=>'both']]);
                            if(!empty($category_ids)) {
                                foreach ($category_ids as $ctg_id) {
                                    $param->orWhere("vhason_info->{$item_key_name}", 'LIKE', "%$ctg_id->id%");
                                }
                            }
                        }

                    }
                });

            }
        }

        if($pagination) {
            $per_page = !empty($request->per_page) ? $request->per_page : Archive_model::per_page();
            return $query->paginate($per_page);
        }
        else {
           return $query->get();
        }


    }

    public static function get_sakhhatkar_info($request,$pagination = false) {
        $query = DB::table('archive_info');
        // global where
        $query->where(function($param) use ($request) {
            $param->where('is_active', '!=', 0)
            ->where('is_approve','=',1)
                ->where('archive_type','=',6);

            if(!empty($request->station_id)) {
                $station_array = $request['station_id'];
                $trimmedArray = array_filter($station_array,function($value){
                    return !empty($value);
                });
                if(!empty($trimmedArray)) {
                    $param->whereIn('station_id',$trimmedArray);
                }
            }
        });

        // import data
        if(!empty($request->search_string) && !empty($request->item_type)) {
            $item_key_name = get_sakhhatkar_key_name($request->item_type);
            if(empty($request[$item_key_name])) {
                $request->request->add([$item_key_name => []]);
            }
            $get_exist_data = $request->$item_key_name;
            $get_exist_data[] = $request->search_string;
            $request->request->add([$item_key_name => $get_exist_data]);
        }

        if(!empty($request->item_type)) { // item search

            $query->where(function ($param) use ($request) {
                // global or where
                $item_type_ids = get_sakhhatkar_item_key();
                foreach($item_type_ids as $item_key) {
                    $item_key_name = get_sakhhatkar_key_name($item_key);

                    if( $item_key_name=='program_name' || $item_key_name=='first_line' || $item_key_name=='sakhhat_data' || $item_key_name=='rating') { // name and first line
                        if (!empty($request->$item_key_name)) {
                            foreach ($request->$item_key_name as $item) {
                                $param->orWhere("sakhhatkar_info->{$item_key_name}", 'LIKE', "%$item%");
                            }
                        }
                    }

                    if($item_key_name=='category') { // name and first line
                        if (!empty($request->$item_key_name)) {
                            foreach ($request->$item_key_name as $item) {
                                $category_ids = Archive_model::get_rows("archive_category",["id"],['type'=>6],[],[],[],[],false,[['field'=>'name','value'=>$item,'type'=>'both']]);
                                foreach($category_ids as $ctg_id){
                                    $param->orWhere("sakhhatkar_info->{$item_key_name}", 'LIKE', "%$ctg_id->id%");
                                }
                            }
                        }
                    }

                }
            });
        }
        else { // global search

            if(!empty($request->search_string)) {

                $query->where(function ($param) use ($request) {
                    $search_string = $request->search_string;
                    // global or where
                    $item_type_ids = get_sakhhatkar_item_key();
                    foreach($item_type_ids as $item_key) {
                        $item_key_name = get_sakhhatkar_key_name($item_key);

                        if( $item_key_name=='program_name' || $item_key_name=='first_line' || $item_key_name=='sakhhat_data' || $item_key_name=='rating') { // name and first line
                            $param->orWhere("sakhhatkar_info->{$item_key_name}", 'LIKE', "%$search_string%");
                        }

                        if($item_key_name=='category') { // name and first line
                            $category_ids = Archive_model::get_rows("archive_category",["id"],['type'=>6],[],[],[],[],false,[['field'=>'name','value'=>$search_string,'type'=>'both']]);
                            if(!empty($category_ids)) {
                                foreach ($category_ids as $ctg_id) {
                                    $param->orWhere("sakhhatkar_info->{$item_key_name}", 'LIKE', "%$ctg_id->id%");
                                }
                            }
                        }

                    }
                });

            }
        }

        if($pagination) {
            $per_page = !empty($request->per_page) ? $request->per_page : Archive_model::per_page();
            return $query->paginate($per_page);
        }
        else {
           return $query->get();
        }


    }

    public static function get_kothika_info($request,$pagination = false) {
        $query = DB::table('archive_info');
        // global where
        $query->where(function($param) use ($request) {
            $param->where('is_active', '!=', 0)
            ->where('is_approve','=',1)
                ->where('archive_type','=',7);

            if(!empty($request->station_id)) {
                $station_array = $request['station_id'];
                $trimmedArray = array_filter($station_array,function($value){
                    return !empty($value);
                });
                if(!empty($trimmedArray)) {
                    $param->whereIn('station_id',$trimmedArray);
                }
            }
        });

        // import data
        if(!empty($request->search_string) && !empty($request->item_type)) {
            $item_key_name = get_kothika_key_name($request->item_type);
            if(empty($request[$item_key_name])) {
                $request->request->add([$item_key_name => []]);
            }
            $get_exist_data = $request->$item_key_name;
            $get_exist_data[] = $request->search_string;
            $request->request->add([$item_key_name => $get_exist_data]);
        }

        if(!empty($request->item_type)) { // item search

            $query->where(function ($param) use ($request) {
                // global or where
                $item_type_ids = get_kothika_item_key();
                foreach($item_type_ids as $item_key) {
                    $item_key_name = get_kothika_key_name($item_key);

                    if( $item_key_name=='name' || $item_key_name=='subject' || $item_key_name=='stability' || $item_key_name=='rating') { // name and first line
                        if (!empty($request->$item_key_name)) {
                            foreach ($request->$item_key_name as $item) {
                                $param->orWhere("kothika_info->{$item_key_name}", 'LIKE', "%$item%");
                            }
                        }
                    }


                    if($item_key_name == 'gronthona') {
                        if(!empty($request->gronthona)) {
                            $ids =  Archive_model::get_artist_ids($request->gronthona);
                            if(!empty($ids)) {
                                $param->orWhere(DB::raw("JSON_CONTAINS(kothika_info->'$.gronthona', json_array($ids))"));
                            }
                        }
                    }

                    if($item_key_name == 'uposthapona') {
                        if(!empty($request->uposthapona)) {
                            $ids =  Archive_model::get_artist_ids($request->uposthapona);
                            if(!empty($ids)) {
                                $param->orWhere(DB::raw("JSON_CONTAINS(kothika_info->'$.uposthapona', json_array($ids))"));
                            }
                        }
                    }

                }
            });
        }
        else { // global search

            if(!empty($request->search_string)) {

                $query->where(function ($param) use ($request) {
                    $search_string = $request->search_string;
                    // global or where
                    $item_type_ids = get_kothika_item_key();
                    foreach($item_type_ids as $item_key) {
                        $item_key_name = get_kothika_key_name($item_key);

                        if( $item_key_name=='name' || $item_key_name=='subject' || $item_key_name=='stability' || $item_key_name=='rating') { // name and first line
                            $param->orWhere("kothika_info->{$item_key_name}", 'LIKE', "%$search_string%");
                        }

                        if($item_key_name == 'gronthona') {
                            $ids =  Archive_model::get_artist_ids([$search_string]);
                            if(!empty($ids)) {
                                $param->orWhere(DB::raw("JSON_CONTAINS(kothika_info->'$.gronthona', json_array($ids))"));
                            }
                        }

                        if($item_key_name == 'uposthapona') {
                            $ids =  Archive_model::get_artist_ids([$search_string]);
                            if(!empty($ids)) {
                                $param->orWhere(DB::raw("JSON_CONTAINS(kothika_info->'$.uposthapona', json_array($ids))"));
                            }
                        }

                    }
                });

            }
        }

        if($pagination) {
            $per_page = !empty($request->per_page) ? $request->per_page : Archive_model::per_page();
            return $query->paginate($per_page);
        }
        else {
           return $query->get();
        }


    }

    public static function get_kobita_info($request,$pagination = false) {
        $query = DB::table('archive_info');
        // global where
        $query->where(function($param) use ($request) {
            $param->where('is_active', '!=', 0)
            ->where('is_approve','=',1)
                ->where('archive_type','=',2);

            if(!empty($request->station_id)) {
                $station_array = $request['station_id'];
                $trimmedArray = array_filter($station_array,function($value){
                    return !empty($value);
                });
                if(!empty($trimmedArray)) {
                    $param->whereIn('station_id',$trimmedArray);
                }
            }
        });

        // import data
        if(!empty($request->search_string) && !empty($request->item_type)) {
            $item_key_name = get_kobita_key_name($request->item_type);
            if(empty($request[$item_key_name])) {
                $request->request->add([$item_key_name => []]);
            }
            $get_exist_data = $request->$item_key_name;
            $get_exist_data[] = $request->search_string;
            $request->request->add([$item_key_name => $get_exist_data]);
        }

        if(!empty($request->item_type)) { // item search

            $query->where(function ($param) use ($request) {
                // global or where
                $item_type_ids = get_kobita_item_key();
                foreach($item_type_ids as $item_key) {
                    $item_key_name = get_kobita_key_name($item_key);

                    if($item_key_name=='stability' || $item_key_name=='name' || $item_key_name=='first_line' || $item_key_name=='rating') { // name and first line
                        if (!empty($request->$item_key_name)) {
                            foreach ($request->$item_key_name as $item) {
                                $param->orWhere("kobita_info->{$item_key_name}", 'LIKE', "%$item%");
                            }
                        }
                    }

                    if($item_key_name=='type_id') { // name and first line
                        if (!empty($request->$item_key_name)) {
                            foreach ($request->$item_key_name as $item) {
                                $category_ids = Archive_model::get_rows("archive_archiveing_type",["id"],['type'=>2],[],[],[],[],false,[['field'=>'name','value'=>$item,'type'=>'both']]);
                                foreach($category_ids as $ctg_id){
                                    $param->orWhere("kobita_info->{$item_key_name}", 'LIKE', "%$ctg_id->id%");
                                }
                            }
                        }
                    }
                    if($item_key_name == 'abritikar') {
                        if(!empty($request->abritikar)) {
                            $ids =  Archive_model::get_artist_ids($request->abritikar);
                            if(!empty($ids)) {
                                $param->orWhere(DB::raw("JSON_CONTAINS(kobita_info->'$.abritikar', json_array($ids))"));
                            }
                        }
                    }

                    if($item_key_name == 'rochoyita') {
                        if(!empty($request->rochoyita)) {
                            $ids =  Archive_model::get_artist_ids($request->rochoyita);
                            if(!empty($ids)) {
                                $param->orWhere(DB::raw("JSON_CONTAINS(kobita_info->'$.rochoyita', json_array($ids))"));
                            }
                        }
                    }

                    if($item_key_name == 'album_id') {
                        if(!empty($request->album_id)) {
                            $ids =  Archive_model::get_album_ids($request->album_id,2);
                            if(!empty($ids)) {
                                $param->orWhere(DB::raw("JSON_CONTAINS(kobita_info->'$.album_id', json_array($ids))"));
                            }
                        }
                    }

                }
            });
        }
        else { // global search

            if(!empty($request->search_string)) {

                $query->where(function ($param) use ($request) {
                    $search_string = $request->search_string;
                    // global or where
                    $item_type_ids = get_kobita_item_key();
                    foreach($item_type_ids as $item_key) {
                        $item_key_name = get_kobita_key_name($item_key);
                        if($item_key_name=='stability' || $item_key_name=='name' || $item_key_name=='first_line' || $item_key_name=='rating') { // name and first line
                            $param->orWhere("kobita_info->{$item_key_name}", 'LIKE', "%$search_string%");
                        }
                        if($item_key_name=='type_id') { // name and first line
                            $category_ids = Archive_model::get_rows("archive_archiveing_type",["id"],['type'=>2],[],[],[],[],false,[['field'=>'name','value'=>$search_string,'type'=>'both']]);
                            if(!empty($category_ids)) {
                                foreach ($category_ids as $ctg_id) {
                                    $param->orWhere("kobita_info->{$item_key_name}", 'LIKE', "%$ctg_id->id%");
                                }
                            }
                        }

                        if($item_key_name == 'abritikar') {
                            $ids =  Archive_model::get_artist_ids([$search_string]);
                            if(!empty($ids)) {
                                $param->orWhere(DB::raw("JSON_CONTAINS(kobita_info->'$.abritikar', json_array($ids))"));
                            }
                        }

                        if($item_key_name == 'rochoyita') {
                            $ids =  Archive_model::get_artist_ids([$search_string]);
                            if(!empty($ids)) {
                                $param->orWhere(DB::raw("JSON_CONTAINS(kobita_info->'$.rochoyita', json_array($ids))"));
                            }
                        }

                        if($item_key_name == 'album_id') {
                            $ids =  Archive_model::get_album_ids([$search_string],2);
                            if(!empty($ids)) {
                                $param->orWhere(DB::raw("JSON_CONTAINS(kobita_info->'$.album_id', json_array($ids))"));
                            }
                        }
                    }
                });

            }
        }

        if($pagination) {
            $per_page = !empty($request->per_page) ? $request->per_page : Archive_model::per_page();
            return $query->paginate($per_page);
        }
        else {
           return $query->get();
        }


    }

    public static function per_page() {
        return 10;
    }

    public static function archive_info($request,$pagination = false)
    {

        if($request->archive_type==1) {
           $result =  Archive_model::get_songit_info($request,$pagination);
        }
        elseif($request->archive_type==2) {
           $result =  Archive_model::get_kobita_info($request,$pagination);
        }
        elseif($request->archive_type==3) {
           $result =  Archive_model::get_natok_info($request,$pagination);
        }
        elseif($request->archive_type==4) {
           $result =  Archive_model::get_program_info($request,$pagination);
        }
        elseif($request->archive_type==5) {
           $result =  Archive_model::get_vhason_info($request,$pagination);
        }
        elseif($request->archive_type==6) {
           $result =  Archive_model::get_sakhhatkar_info($request,$pagination);
        }
        elseif($request->archive_type==7) {
           $result =  Archive_model::get_kothika_info($request,$pagination);
        }
        else {
            $result =   Archive_model::get_songit_info($request,$pagination);
        }

        return $result;

        $query = DB::table('archive_info');
//        $archive_type = !empty($request->archive_type) ? $request->archive_type : 1;
        $archive_type = 1;

        // global where
        $query->where(function($param) use ($request,$archive_type) {
            $param->where('is_active', '!=', 0)
//            ->where('is_approve','=',1)
            ->where('archive_type','=',$archive_type);
            if(!empty($request->station_id)) {
                $param->where('station_id', '=', $request->station_id);
            }
        });

        if ($archive_type == 1) {
            if (!empty($request->search_string)) {
                $query->where(function ($param) use ($request) {
                    $search_string = $request->search_string;
                    // global or where
                    $param->orWhere('songit_info->name', 'like', '%' . $search_string . '%')
                        ->orWhere('songit_info->first_line', 'like', '%' . $search_string . '%');
//                    $artist = DB::table("program_artist_info")->select([DB::raw('group_concat(id) as ids')])->where("name_bn", "like", '%' . $search_string . '%')->first();
//
//                    if (!empty($artist)) {
//                        $param->orWhere(DB::raw("JSON_CONTAINS(songit_info->'$.song_producer', json_array($artist->ids))"));
//                        $param->orWhere(DB::raw("JSON_CONTAINS(songit_info->'$.artist', json_array($artist->ids))"));
//                        $param->orWhere(DB::raw("JSON_CONTAINS(songit_info->'$.gitikar', json_array($artist->ids))"));
//                        $param->orWhere(DB::raw("JSON_CONTAINS(songit_info->'$.surokar', json_array($artist->ids))"));
//                        $param->orWhere(DB::raw("JSON_CONTAINS(songit_info->'$.recordist', json_array($artist->ids))"));
//                        $param->orWhere(DB::raw("JSON_CONTAINS(songit_info->'$.sompadona', json_array($artist->ids))"));
//                        $param->orWhere(DB::raw("JSON_CONTAINS(songit_info->'$.main_artist', json_array($artist->ids))"));
//                        $param->orWhere(DB::raw("JSON_CONTAINS(songit_info->'$.song_director', json_array($artist->ids))"));
//                        $param->orWhere(DB::raw("JSON_CONTAINS(songit_info->'$.sound_editors', json_array($artist->ids))"));
//                    }
//
//                    $employees = DB::table("employees")->select([DB::raw('group_concat(employee_id) as ids')])->where("emp_name", "like", '%' . $search_string . '%')->first();
//                    if (!empty($employees)) {
//                        $param->orWhere(DB::raw("JSON_CONTAINS(songit_info->'$.producer', json_array($employees->ids))"));
//                        $param->orWhere(DB::raw("JSON_CONTAINS(songit_info->'$.codinator', json_array($employees->ids))"));
//                        $param->orWhere(DB::raw("JSON_CONTAINS(songit_info->'$.direction', json_array($employees->ids))"));
//                        $param->orWhere(DB::raw("JSON_CONTAINS(songit_info->'$.sompadona', json_array($employees->ids))"));
//                        $param->orWhere(DB::raw("JSON_CONTAINS(songit_info->'$.plan_maker', json_array($employees->ids))"));
//                        $param->orWhere(DB::raw("JSON_CONTAINS(songit_info->'$.assistent_producer', json_array($employees->ids))"));
//                    }
//
//                    $types = DB::table("archive_archiveing_type")->select([DB::raw('group_concat(id) as ids')])
//                        ->where([ ["name", "like", '%' . $search_string . '%'] , ['type','=',1] ])->first();
//
//                    if (!empty($types)) {
//                        $param->orWhere(DB::raw("JSON_CONTAINS(songit_info->'$.type_id', json_array($types->ids))"));
//                    }
//
//
//                    $categories = DB::table("archive_archiveing_type")->select([DB::raw('group_concat(id) as ids')])
//                        ->where([ ["name", "like", '%' . $search_string . '%'] , ['type','=',1] ])->first();
//
//                    if (!empty($types)) {
//                        $param->orWhere(DB::raw("JSON_CONTAINS(songit_info->'$.type_id', json_array($types->ids))"));
//                    }


                });
            }
        }

        return $query->get();
    }


    public static function get_user_access_role($emp_id,$module='') {
        //    SELECT access.access_id,parent_role.title as module_title ,parent_role.level as module_level ,access.employee_id,
//    role.* FROM user_access_info as access inner join user_role_info as role on role.id=access.access_id and
//    access.employee_id=202001370059 and access.is_active=1 inner join user_role_info as parent_role
//    on parent_role.id=role.parent_id group by access.access_id order by parent_role.display_position asc
        $data = [
            'emp_id' => $emp_id,
            'module' => $module,
        ];
        $query = DB::table("user_access_info as access")
            ->select('access.access_id','access.employee_id', 'parent_role.title as module_title','parent_role.level as module_level', 'role.*')
            ->join('user_role_info as role', function ($join) use ($data) {
                $join->on('role.id', '=', 'access.access_id')
                    ->where('access.employee_id', '=', $data['emp_id'])
                    ->where('access.is_active', '=', 1);
            })
            ->join('user_role_info as parent_role', function ($join) use($data) {
                $join->on('parent_role.id', '=', 'role.parent_id')
                        ->where('parent_role.type_name','=',$data['module']);
            })
            ->groupBy('access.access_id')
            ->orderBy('parent_role.display_position','role.display_position')
            ->get();
        return $query;
    }


}
