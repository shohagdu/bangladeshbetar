<?php

namespace App\Http\Controllers;

use App\Branch_info;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\All_stting;
use App\Archive_model;
use App\Employee;
use App\Monthly_opening;
use App\Company_info;
use App\Program_schedule_info;
use PDF;
use Session;
use Datatables;
use Validator;
use Zipper;
use File;


class ArchiveController extends Controller
{
   // Mehedi Hasan Shamim     
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIp()
    {
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
    }

    public function index()
    {

        // index
        if (!isset(Auth::user()->id) && (empty(Auth::user()->id))) {
            return redirect('/login');
        } else {
            $current_fiscal_year = Monthly_opening::get_current_fiscal_year(['is_active' => 1]);
            $current_payslip_month = Monthly_opening::get_current_payslip_month_info(['status' => 1]);
            $company_info = Company_info::find(6); // company id = 6
            Session::put('company_logo', $company_info->company_logo);
            Session::put('current_fiscal_year', $current_fiscal_year);
            Session::put('current_payslip_month', $current_payslip_month);
            return view('template.font_content_archive', ['company_info' => $company_info,]);
        }
    }

    public function get_song_sub_type(Request $request)
    {
        if ($request->id > 0) {
            $song_category = Archive_model::get_settings("archive_category", ['parent_id' => $request->id]);
            echo json_encode($song_category);
        } else {
            echo json_encode([]);
        }
    }

    public function get_ministry_sub_type(Request $request)
    {
        if ($request->id > 0) {
            $song_category = Archive_model::get_settings("archive_ministry", ['parent_id' => $request->id]);
            echo json_encode($song_category);
        } else {
            echo json_encode([]);
        }
    }

    public function get_boardcast_frequency()
    {
        $frequency = Archive_model::get_boardcast_frequency();
        if ($frequency) {
            echo json_encode($frequency);
            die();
        }
        echo json_encode($frequency);
    }

    public function get_film_actor(Request $request)
    {
        $artist = Archive_model::get_film_actor($request->term);
        echo json_encode($artist);
    }

    public function get_film_director(Request $request)
    {
        $artist = Archive_model::get_film_director($request->term);
        echo json_encode($artist);
    }

    public function get_instument(Request $request)
    {
        $artist = Archive_model::get_instument($request->term);
        echo json_encode($artist);
    }

    public function get_artist_info(Request $request)
    {
        $data = Archive_model::get_artist_info($request->search, $request->expertise_id);
        echo json_encode($data);
        die();
        echo json_encode([]);
    }

    public function archive_song_create()
    {
        $song_type = Archive_model::get_settings("archive_archiveing_type", ["type" => 1,'is_active'=>1]);
        $band = Archive_model::get_settings("archive_band",['is_active'=>1]);
        $band_type = Archive_model::get_settings("archive_archiveing_type", ["type" => 5,'is_active'=>1]);
        $film_type = Archive_model::get_settings("archive_archiveing_type", ["type" => 4,'is_active'=>1]);
        $song_category = Archive_model::get_settings("archive_category", ['has_parent' => 0, "type" => 1,'is_active'=>1]);
        $archive_albam = Archive_model::get_settings("archive_albam", ['type' => 1,'is_active'=>1]);
        $song_source = Archive_model::get_settings("archive_song_source",['is_active'=>1]);
        $employee_info = Employee::get_employee_info_name(['is_active' => 1]);
        $program_artist_info = Employee::get_artist_select();
        $station_info = Branch_info::branch_info_select(['is_active' => 1]);

        return view(
            'archive.song_create',
            [
                'page_title' => 'সংগীত এন্ট্রি',
                'song_type' => $song_type,
                'band' => $band,
                'band_type' => $band_type,
                'film_type' => $film_type,
                'song_category' => $song_category,
                'archive_albam' => $archive_albam,
                'employee_info' => $employee_info,
                'artist_info' => $program_artist_info,
                'station_info' => $station_info,
                'song_source' => $song_source
            ]
        );
    }

    public function get_file_name()
    {

    }


    public function save_song_create(Request $request)
    {
//        dd($request);
        $param = [
            'song_category' => $request->ganer_prokar,
            'station_id' => $request->station_id
        ];
//        dd($request);
        $song_id = Archive_model::get_song_id($param);
        ini_set('max_execution_time', '0');
        $file = $request->file('odio_file');
        $destinationImagePath = 'archive/song';
        $shilpi_name = !empty($request['artist']) ? get_shilpi_name_by_ids( $request['artist']) : '';
        $file_name = $song_id.'-'.$request->ganer_first_line;
        if(!empty($shilpi_name)){
            $file_name.="-".$shilpi_name;
        }
        $upload = Archive_model::upload_file($file, $file_name, $destinationImagePath);
        if ($upload) {
            $lyrix = $request->file('lyrix_document') ? $request->file('lyrix_document') : '';
            if (!empty($lyrix)) {
                $lyrix = $request->file('lyrix_document');
                $destinationlyrixPath = 'archive/song/lyrix';
                Archive_model::upload_file($lyrix, $song_id, $destinationlyrixPath);
            }

            $data = [
                'archive_type' => 1,
                'station_id' => empty($request->station_id) ? null : $request->station_id,
                'sadin_bangla_betar' => isset($request->sadin_bangla_betar_kendro) ? 1 : 0,
                'program_planing_id' => empty($request->program_plan_id) ? null : $request->program_plan_id,
                'boardcast_frequency' => empty($request->prochar_sthan) ? null : $request->prochar_sthan,
                'created_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                    ->employee_primary_id : NULL),
                'created_at' => date('Y-m-d H:i:s'),
                'created_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip()
            ];

            $songit_info = [
                'name' => empty($request->ganer_name) ? null : $request->ganer_name,
                'song_department' => empty($request->song_department) ? null : $request->song_department,
                'category' => empty($request->ganer_prokar) ? null : $request->ganer_prokar,
                'sub_category' => empty($request->ganer_up_prokar) ? null : $request->ganer_up_prokar,
                'album_id' => empty($request->albam_name_id) ? null : [$request->albam_name_id],
                'participant' => empty($request->ongso_grohon) ? null : $request->ongso_grohon,
                'type_id' => empty($request->song_type) ? null : $request->song_type,
                'rating' => empty($request->reating) ? null : $request->reating,
                'hyperlink' => empty($request->hyperlink) ? null : $request->hyperlink,
                'stability' => empty($request->stability) ? null : $request->stability,
                'lyrics_document' => empty($lyrix) ? null : $song_id . '.' . $lyrix->getClientOriginalExtension(),
                'lyrics' => empty($request->lyrix) ? null : $request->lyrix,
                'recording_date' => empty($request->recoarding_date) ? null : date("Y-m-d", strtotime($request->recoarding_date)),
                'first_broadcast_date' => empty($request->first_bordcasting_date) ? null : date("Y-m-d", strtotime($request->first_bordcasting_date)),
                'source_id' => empty($request->source) ? null : $request->source,
                'source_id_name' => empty($request->source_id) ? null : $request->source_id,
                'first_line' => empty($request->ganer_first_line) ? null : $request->ganer_first_line,
                'file_name' => $file_name . '.' . $file->getClientOriginalExtension(),
                'file_directory' => 'archive/song',
                'id' => $song_id
            ];

            // instument section
            $instument_artist = [];
            foreach ($request['instument_artist'] as $key => $item) {
                if (!empty($request['instument'][$key]) && !empty($item)) {
                    $instument_info = DB::table("archive_instument")->where("name", $request['instument'][$key])->first();
                    if ($instument_info == null) { //new instument
                        DB::table('archive_instument')->insert(
                            [
                                'name' => $request['instument'][$key],
                                'created_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                                    ->employee_primary_id : NULL),
                                'created_time' => date('Y-m-d H:i:s'),
                                'created_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip()
                            ]
                        );
                        $instument_id = DB::getPdo()->lastInsertId();
                    } else {
                        $instument_id = $instument_info->id;
                    }
                    $instument_artist[] = [
                        'artist_id' => $item,
                        'instument_id' => $instument_id
                    ];
                }
            }

            $songit_info['instument_artist'] = empty($instument_artist) ? null : $instument_artist;
            $songit_info['film_info'] = null;
            $songit_info['band_id'] = null;

            // film information
            if ($request->song_department == 2) {
                $film_info = [];
                $film_info['film_name'] = empty($request['film_name']) ? null : $request['film_name'];
                $film_info['film_publish_year'] = empty($request['film_publish_date']) ? null : $request['film_publish_date'];
                $film_info['oblombone'] = empty($request['oblombone']) ? null : $request['oblombone'];
                $film_info['film_story'] = empty($request['kahini_songlap']) ? null : $request['kahini_songlap'];
                $film_info['film_tika'] = empty($request['film_tika']) ? null : $request['film_tika'];
                $film_info['film_type'] = empty($request['film_type']) ? [] : $request['film_type'];
                $film_info['film_actors'] = empty($request['film_actor']) ? [] : $request['film_actor'];
                $film_info['film_director'] = empty($request['film_director']) ? [] : $request['film_director'];
                $songit_info['film_info'] = empty($film_info) ? null : $film_info;
            }

            // band information
            if ($request->song_department == 3) {
                $songit_info['band_id'] = empty($request->band_name) ? null : $request->band_name;
            }

            $songit_info['artist'] = isset($request['artist']) ? $request['artist'] : null;
            $songit_info['main_artist'] = isset($request['main_artist']) ? $request['main_artist'] : null;
            $songit_info['gitikar'] = isset($request['gitikar']) ? $request['gitikar'] : null;
            $songit_info['surokar'] = isset($request['surokar']) ? $request['surokar'] : null;
            $songit_info['song_director'] = isset($request['song_director']) ? $request['song_director'] : null;
            $songit_info['song_producer'] = isset($request['song_producer']) ? $request['song_producer'] : null;
            $songit_info['recordist'] = isset($request['recordist']) ? $request['recordist'] : null;
            $songit_info['sound_editors'] = isset($request['sompadok']) ? $request['sompadok'] : null;
            $songit_info['plan_maker'] = isset($request['plan_maker']) ? $request['plan_maker'] : null;
            $songit_info['codinator'] = isset($request['codinator']) ? $request['codinator'] : null;
            $songit_info['producer'] = isset($request['producer']) ? $request['producer'] : null;
            $songit_info['assistent_producer'] = isset($request['assistent_producer']) ? $request['assistent_producer'] : null;
            $songit_info['sompadona'] = isset($request['sompadona']) ? $request['sompadona'] : null;
            $songit_info['direction'] = isset($request['direction']) ? $request['direction'] : null;

            $data['songit_info'] = json_encode($songit_info, JSON_UNESCAPED_UNICODE);

            DB::table('archive_info')->insert($data);

            $output = array(
                'error' => [],
                'success' => 'Archive Complete Successfully',
                'redirect_page' => ''
            );
        } else {
            $output = array(
                'error' => ['upload is fail'],
                'success' => '',
                'redirect_page' => ''
            );
        }

        echo json_encode($output);
    }

    public function archive_item_report(Request $request) {
        $page = '';
        $title = '';
        $archive_type = $request->archive_type;
        $station_id = $request->station_id;
        $station_info = empty($station_id[0]) ? [] : Archive_model::get_row('branch_infos',["*"],['id'=>$station_id[0]]);
        $item_info = Archive_model::archive_info($request,false);
//        dd($item_info);
        if($archive_type==1) {
            $title = 'সংগীত রিপোর্ট';
            $page='songit';
        }
        elseif($archive_type==2) {
            $title = 'গল্প/কবিতা রিপোর্ট';
            $page='kobita';;
        }
        elseif($archive_type==3) {
            $title = 'নাটকের রিপোর্ট';
            $page='natok';;
        }
        elseif($archive_type==4){
            $title = 'অনুষ্ঠানের রিপোর্ট';
            $page='program';;
        }
        elseif($archive_type==5){
            $title = 'ভাষণ রিপোর্ট';
            $page='vhason';;
        }
        elseif($archive_type==6){
            $title = 'সাক্ষাৎকার রিপোর্ট';
            $page='sakhhatkar';;
        }
        elseif($archive_type==7){
            $title = 'কথিকা রিপোর্ট';
            $page='kothika';;
        }
        elseif($archive_type==8){
            $title = 'প্রচারনা রিপোর্ট';
            $page='procharona';;
        }
        return view(
            'archive.report_view.'.$page,
            [
                'page_title' => $title,
                'archive_info' => $item_info,
                'station_info' => $station_info
            ]
        );
    }

    public function archive_item_view($id) {
        $get_info = Archive_model::get_row('archive_info',["*"],['id'=>$id]);
        $station_info = Archive_model::get_row('branch_infos',["*"],['id'=>$get_info->station_id]);

        $page = '';
        $title = '';
        if($get_info->archive_type==1) {
            $title = 'সংগীত ভিউ';
            $page='songit';
        }
        elseif($get_info->archive_type==2){
            $title = 'গল্প/কবিতা বিবরণ';
            $page='kobita';;
        }
        elseif($get_info->archive_type==3){
            $title = 'নাটকের বিবরণ';
            $page='natok';;
        }
        elseif($get_info->archive_type==4){
            $title = 'অনুষ্ঠানের বিবরণ';
            $page='program';;
        }
        elseif($get_info->archive_type==5) {
            $title = 'ভাষণের বিবরণ';
            $page='vhason';;
        }
        elseif($get_info->archive_type==6) {
            $title = 'সাক্ষাৎকার বিবরণ';
            $page='sakhhatkar';;
        }
        elseif($get_info->archive_type==7) {
            $title = 'কথিকা বিবরণ';
            $page='kothika';;
        }
        elseif($get_info->archive_type==8) {
            $title = 'প্রচারনা বিবরণ';
            $page='procharona';;
        }
//        dd($get_info);
        return view(
            'archive.item_view.'.$page,
            [
                'page_title' => $title,
                'archive_info' => $get_info,
                'station_info' => $station_info
            ]
        );
    }

    public function get_archive_list(Request $request)
    {
        $select = [
            'archive_info.*',
            'branch_infos.name as station_name',
            'employees.emp_name',
            // DB::raw('archive_info.songit_info->>"$.name" as song_name'),
            // DB::raw('archive_info.songit_info->>"$.id" as song_id'),
            // DB::raw('archive_info.songit_info->>"$.first_line" as first_line'),
            // DB::raw('archive_info.songit_info->>"$.file_name" as file_name'),
            // DB::raw('archive_info.songit_info->>"$.file_directory" as file_directory'),
        ];

        $where = ['archive_type' => 1, 'archive_info.is_active' => 1];
        $between  = false;
        $where_date  = false;
        if(!empty($request->created_by)) {
            $where['archive_info.created_by'] = (int) $request->created_by;
        }
        if(!empty($request->status)) {
            $where['archive_info.is_approve'] =  $request->status;
        }

        if(!empty($request->from_date) && !empty($request->to_date)) {

            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '>=' ,
                    'value'     => date("Y-m-d",strtotime($request->from_date))
                ],
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '<=' ,
                    'value'     => date("Y-m-d",strtotime($request->to_date))
                ]
            ];
        }
        elseif(!empty($request->from_date)){
            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '=' ,
                    'value'     => date("Y-m-d",strtotime($request->from_date))
                ]
            ];
        }
        elseif(!empty($request->to_date)){
            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '=' ,
                    'value'     => date("Y-m-d",strtotime($request->to_date))
                ]
            ];
        }
        $join_param = [
            [
                'table' => 'branch_infos',
                'on' => [
                    'first_param' => 'branch_infos.id',
                    'operator' => '=',
                    'second_param' => 'archive_info.station_id'
                ]
            ],
            [
                'table' => 'employees',
                'on' => [
                    'first_param' => 'employees.id',
                    'operator' => '=',
                    'second_param' => 'archive_info.created_by'
                ]
            ]
        ];

        $order_by = [
            [
                'field' => 'archive_info.created_by',
                'type'  => 'desc'
            ]
        ];

     
       $archive_list = Archive_model::get_rows("archive_info", $select, $where, $join_param,false,$where_date,$between,$order_by);

        $active_playlist = Archive_model::get_row("archive_playlist", ["*"], ['status' => 1, 'is_active' => 1]);
        $employee_info = Archive_model::get_rows("employees", ["*"], ['is_active'=>1]);
       

        return view(
            'archive.archive_list',
            [
                'page_title' => 'Archive List',
                'archive_list' => $archive_list,
                'active_playlist' => $active_playlist,
                'employee_info' => $employee_info,
            ]
        );
    }

    public function get_kobita_list(Request $request)
    {

        $select = [
            'archive_info.*',
            'branch_infos.name as station_name',
            'employees.emp_name',
            // DB::raw('archive_info.kobita_info->>"$.name" as kobita_name'),
            // DB::raw('archive_info.kobita_info->>"$.id" as kobita_id'),
            // DB::raw('archive_info.kobita_info->>"$.first_line" as first_line'),
            // DB::raw('archive_info.kobita_info->>"$.file_name" as file_name'),
            // DB::raw('archive_info.kobita_info->>"$.file_directory" as file_directory'),
        ];

        $where = ['archive_type' => 2, 'archive_info.is_active' => 1];
        $between  = false;
        $where_date  = false;
        if(!empty($request->created_by)) {
            $where['archive_info.created_by'] = (int) $request->created_by;
        }
        if(!empty($request->status)) {
            $where['archive_info.is_approve'] =  $request->status;
        }

        if(!empty($request->from_date) && !empty($request->to_date)) {

            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '>=' ,
                    'value'     => date("Y-m-d",strtotime($request->from_date))
                ],
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '<=' ,
                    'value'     => date("Y-m-d",strtotime($request->to_date))
                ]
            ];
        }
        elseif(!empty($request->from_date)){
            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '=' ,
                    'value'     => date("Y-m-d",strtotime($request->from_date))
                ]
            ];
        }
        elseif(!empty($request->to_date)){
            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '=' ,
                    'value'     => date("Y-m-d",strtotime($request->to_date))
                ]
            ];
        }
        $join_param = [
            [
                'table' => 'branch_infos',
                'on' => [
                    'first_param' => 'branch_infos.id',
                    'operator' => '=',
                    'second_param' => 'archive_info.station_id'
                ]
            ],
            [
                'table' => 'employees',
                'on' => [
                    'first_param' => 'employees.id',
                    'operator' => '=',
                    'second_param' => 'archive_info.created_by'
                ]
            ]
        ];

        $order_by = [
            [
                'field' => 'archive_info.created_by',
                'type'  => 'desc'
            ]
        ];

        $archive_list = Archive_model::get_rows("archive_info", $select, $where, $join_param,false,$where_date,$between,$order_by);
        $active_playlist = Archive_model::get_row("archive_playlist", ["*"], ['status' => 1, 'is_active' => 1]);

        return view(
            'archive.kobita_list',
            [
                'page_title' => 'Kobita List',
                'archive_list' => $archive_list,
                'active_playlist' => $active_playlist
            ]
        );
    }

    public function get_natok_list(Request $request)
    {
        $select = [
            'archive_info.*',
            'branch_infos.name as station_name',
            'employees.emp_name',
            // DB::raw('archive_info.natok_info->>"$.name" as natok_name'),
            // DB::raw('archive_info.natok_info->>"$.id" as natok_id'),
            // DB::raw('archive_info.natok_info->>"$.nattokar" as nattokar_id'),
            // DB::raw('archive_info.natok_info->>"$.file_name" as file_name'),
            // DB::raw('archive_info.natok_info->>"$.file_directory" as file_directory'),
        ];

        $where = ['archive_type' => 3, 'archive_info.is_active' => 1];
        $between  = false;
        $where_date  = false;
        if(!empty($request->created_by)) {
            $where['archive_info.created_by'] = (int) $request->created_by;
        }
        if(!empty($request->status)) {
            $where['archive_info.is_approve'] =  $request->status;
        }

        if(!empty($request->from_date) && !empty($request->to_date)) {

            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '>=' ,
                    'value'     => date("Y-m-d",strtotime($request->from_date))
                ],
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '<=' ,
                    'value'     => date("Y-m-d",strtotime($request->to_date))
                ]
            ];
        }
        elseif(!empty($request->from_date)){
            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '=' ,
                    'value'     => date("Y-m-d",strtotime($request->from_date))
                ]
            ];
        }
        elseif(!empty($request->to_date)){
            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '=' ,
                    'value'     => date("Y-m-d",strtotime($request->to_date))
                ]
            ];
        }
        $join_param = [
            [
                'table' => 'branch_infos',
                'on' => [
                    'first_param' => 'branch_infos.id',
                    'operator' => '=',
                    'second_param' => 'archive_info.station_id'
                ]
            ],
            [
                'table' => 'employees',
                'on' => [
                    'first_param' => 'employees.id',
                    'operator' => '=',
                    'second_param' => 'archive_info.created_by'
                ]
            ]
        ];

        $order_by = [
            [
                'field' => 'archive_info.created_by',
                'type'  => 'desc'
            ]
        ];

        $archive_list = Archive_model::get_rows("archive_info", $select, $where, $join_param,false,$where_date,$between,$order_by);

        $active_playlist = Archive_model::get_row("archive_playlist", ["*"], ['status' => 1, 'is_active' => 1]);

        return view(
            'archive.natok_list',
            [
                'page_title' => 'Natok List',
                'archive_list' => $archive_list,
                'active_playlist' => $active_playlist
            ]
        );
    }

    public function get_program_list(Request $request)
    {
        $select = [
            'archive_info.*',
            'branch_infos.name as station_name',
            'employees.emp_name',
            // DB::raw('archive_info.program_info->>"$.name" as program_name'),
            // DB::raw('archive_info.program_info->>"$.id" as program_id'),
            // DB::raw('archive_info.program_info->>"$.file_name" as file_name'),
            // DB::raw('archive_info.program_info->>"$.file_directory" as file_directory'),
        ];

        $where = ['archive_type' => 4, 'archive_info.is_active' => 1];
        $between  = false;
        $where_date  = false;
        if(!empty($request->created_by)) {
            $where['archive_info.created_by'] = (int) $request->created_by;
        }
        if(!empty($request->status)) {
            $where['archive_info.is_approve'] =  $request->status;
        }

        if(!empty($request->from_date) && !empty($request->to_date)) {

            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '>=' ,
                    'value'     => date("Y-m-d",strtotime($request->from_date))
                ],
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '<=' ,
                    'value'     => date("Y-m-d",strtotime($request->to_date))
                ]
            ];
        }
        elseif(!empty($request->from_date)){
            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '=' ,
                    'value'     => date("Y-m-d",strtotime($request->from_date))
                ]
            ];
        }
        elseif(!empty($request->to_date)){
            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '=' ,
                    'value'     => date("Y-m-d",strtotime($request->to_date))
                ]
            ];
        }
        $join_param = [
            [
                'table' => 'branch_infos',
                'on' => [
                    'first_param' => 'branch_infos.id',
                    'operator' => '=',
                    'second_param' => 'archive_info.station_id'
                ]
            ],
            [
                'table' => 'employees',
                'on' => [
                    'first_param' => 'employees.id',
                    'operator' => '=',
                    'second_param' => 'archive_info.created_by'
                ]
            ]
        ];

        $order_by = [
            [
                'field' => 'archive_info.created_by',
                'type'  => 'desc'
            ]
        ];

        $archive_list = Archive_model::get_rows("archive_info", $select, $where, $join_param,false,$where_date,$between,$order_by);

        $active_playlist = Archive_model::get_row("archive_playlist", ["*"], ['status' => 1, 'is_active' => 1]);

        return view(
            'archive.program_list',
            [
                'page_title' => 'Program List',
                'archive_list' => $archive_list,
                'active_playlist' => $active_playlist
            ]
        );
    }


    public function get_vhason_list(Request $request)
    {
        $select = [
            'archive_info.*',
            'branch_infos.name as station_name',
            'employees.emp_name',
            // DB::raw('archive_info.vhason_info->>"$.name" as program_name'),
            // DB::raw('archive_info.vhason_info->>"$.id" as vhason_id'),
            // DB::raw('archive_info.vhason_info->>"$.file_name" as file_name'),
            // DB::raw('archive_info.vhason_info->>"$.file_directory" as file_directory'),
        ];

        $where = ['archive_type' => 5, 'archive_info.is_active' => 1];
        $between  = false;
        $where_date  = false;
        if(!empty($request->created_by)) {
            $where['archive_info.created_by'] = (int) $request->created_by;
        }
        if(!empty($request->status)) {
            $where['archive_info.is_approve'] =  $request->status;
        }

        if(!empty($request->from_date) && !empty($request->to_date)) {

            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '>=' ,
                    'value'     => date("Y-m-d",strtotime($request->from_date))
                ],
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '<=' ,
                    'value'     => date("Y-m-d",strtotime($request->to_date))
                ]
            ];
        }
        elseif(!empty($request->from_date)){
            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '=' ,
                    'value'     => date("Y-m-d",strtotime($request->from_date))
                ]
            ];
        }
        elseif(!empty($request->to_date)){
            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '=' ,
                    'value'     => date("Y-m-d",strtotime($request->to_date))
                ]
            ];
        }
        $join_param = [
            [
                'table' => 'branch_infos',
                'on' => [
                    'first_param' => 'branch_infos.id',
                    'operator' => '=',
                    'second_param' => 'archive_info.station_id'
                ]
            ],
            [
                'table' => 'employees',
                'on' => [
                    'first_param' => 'employees.id',
                    'operator' => '=',
                    'second_param' => 'archive_info.created_by'
                ]
            ]
        ];

        $order_by = [
            [
                'field' => 'archive_info.created_by',
                'type'  => 'desc'
            ]
        ];

        $archive_list = Archive_model::get_rows("archive_info", $select, $where, $join_param,false,$where_date,$between,$order_by);

        $active_playlist = Archive_model::get_row("archive_playlist", ["*"], ['status' => 1, 'is_active' => 1]);

        return view(
            'archive.vhason_list',
            [
                'page_title' => 'Vashon List',
                'archive_list' => $archive_list,
                'active_playlist' => $active_playlist
            ]
        );
    }

    public function get_sakhhatkar_list(Request $request)
    {
        $select = [
            'archive_info.*',
            'branch_infos.name as station_name',
            'employees.emp_name',
            // DB::raw('archive_info.sakhhatkar_info->>"$.name" as program_name'),
            // DB::raw('archive_info.sakhhatkar_info->>"$.id" as vhason_id'),
            // DB::raw('archive_info.sakhhatkar_info->>"$.file_name" as file_name'),
            // DB::raw('archive_info.sakhhatkar_info->>"$.file_directory" as file_directory'),
        ];

        $where = ['archive_type' => 6, 'archive_info.is_active' => 1];
        $between  = false;
        $where_date  = false;
        if(!empty($request->created_by)) {
            $where['archive_info.created_by'] = (int) $request->created_by;
        }
        if(!empty($request->status)) {
            $where['archive_info.is_approve'] =  $request->status;
        }

        if(!empty($request->from_date) && !empty($request->to_date)) {

            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '>=' ,
                    'value'     => date("Y-m-d",strtotime($request->from_date))
                ],
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '<=' ,
                    'value'     => date("Y-m-d",strtotime($request->to_date))
                ]
            ];
        }
        elseif(!empty($request->from_date)){
            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '=' ,
                    'value'     => date("Y-m-d",strtotime($request->from_date))
                ]
            ];
        }
        elseif(!empty($request->to_date)){
            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '=' ,
                    'value'     => date("Y-m-d",strtotime($request->to_date))
                ]
            ];
        }
        $join_param = [
            [
                'table' => 'branch_infos',
                'on' => [
                    'first_param' => 'branch_infos.id',
                    'operator' => '=',
                    'second_param' => 'archive_info.station_id'
                ]
            ],
            [
                'table' => 'employees',
                'on' => [
                    'first_param' => 'employees.id',
                    'operator' => '=',
                    'second_param' => 'archive_info.created_by'
                ]
            ]
        ];

        $order_by = [
            [
                'field' => 'archive_info.created_by',
                'type'  => 'desc'
            ]
        ];

        $archive_list = Archive_model::get_rows("archive_info", $select, $where, $join_param,false,$where_date,$between,$order_by);

        $active_playlist = Archive_model::get_row("archive_playlist", ["*"], ['status' => 1, 'is_active' => 1]);

        return view(
            'archive.sakhhatkar_list',
            [
                'page_title' => 'সাক্ষাৎকার লিস্ট',
                'archive_list' => $archive_list,
                'active_playlist' => $active_playlist
            ]
        );
    }


    public function get_kothika_list(Request $request)
    {
        $select = [
            'archive_info.*',
            'branch_infos.name as station_name',
            'employees.emp_name',
            // DB::raw('archive_info.kothika_info->>"$.name" as program_name'),
            // DB::raw('archive_info.kothika_info->>"$.id" as vhason_id'),
            // DB::raw('archive_info.kothika_info->>"$.file_name" as file_name'),
            // DB::raw('archive_info.kothika_info->>"$.file_directory" as file_directory'),
        ];

        $where = ['archive_type' => 7, 'archive_info.is_active' => 1];
        $between  = false;
        $where_date  = false;
        if(!empty($request->created_by)) {
            $where['archive_info.created_by'] = (int) $request->created_by;
        }
        if(!empty($request->status)) {
            $where['archive_info.is_approve'] =  $request->status;
        }

        if(!empty($request->from_date) && !empty($request->to_date)) {

            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '>=' ,
                    'value'     => date("Y-m-d",strtotime($request->from_date))
                ],
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '<=' ,
                    'value'     => date("Y-m-d",strtotime($request->to_date))
                ]
            ];
        }
        elseif(!empty($request->from_date)){
            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '=' ,
                    'value'     => date("Y-m-d",strtotime($request->from_date))
                ]
            ];
        }
        elseif(!empty($request->to_date)){
            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '=' ,
                    'value'     => date("Y-m-d",strtotime($request->to_date))
                ]
            ];
        }
        $join_param = [
            [
                'table' => 'branch_infos',
                'on' => [
                    'first_param' => 'branch_infos.id',
                    'operator' => '=',
                    'second_param' => 'archive_info.station_id'
                ]
            ],
            [
                'table' => 'employees',
                'on' => [
                    'first_param' => 'employees.id',
                    'operator' => '=',
                    'second_param' => 'archive_info.created_by'
                ]
            ]
        ];

        $order_by = [
            [
                'field' => 'archive_info.created_by',
                'type'  => 'desc'
            ]
        ];

        $archive_list = Archive_model::get_rows("archive_info", $select, $where, $join_param,false,$where_date,$between,$order_by);

        $active_playlist = Archive_model::get_row("archive_playlist", ["*"], ['status' => 1, 'is_active' => 1]);

        return view(
            'archive.kothika_list',
            [
                'page_title' => 'কথিকা লিস্ট',
                'archive_list' => $archive_list,
                'active_playlist' => $active_playlist
            ]
        );
    }

    public function get_procharona_list(Request $request)
    {
        $select = [
            'archive_info.*',
            'branch_infos.name as station_name',
            'employees.emp_name',
            // DB::raw('archive_info.procharona_info->>"$.name" as program_name'),
            // DB::raw('archive_info.procharona_info->>"$.id" as vhason_id'),
            // DB::raw('archive_info.procharona_info->>"$.file_name" as file_name'),
            // DB::raw('archive_info.procharona_info->>"$.file_directory" as file_directory'),
        ];

        $where = ['archive_type' => 8, 'archive_info.is_active' => 1];
        $between  = false;
        $where_date  = false;
        if(!empty($request->created_by)) {
            $where['archive_info.created_by'] = (int) $request->created_by;
        }
        if(!empty($request->status)) {
            $where['archive_info.is_approve'] =  $request->status;
        }

        if(!empty($request->from_date) && !empty($request->to_date)) {

            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '>=' ,
                    'value'     => date("Y-m-d",strtotime($request->from_date))
                ],
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '<=' ,
                    'value'     => date("Y-m-d",strtotime($request->to_date))
                ]
            ];
        }
        elseif(!empty($request->from_date)){
            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '=' ,
                    'value'     => date("Y-m-d",strtotime($request->from_date))
                ]
            ];
        }
        elseif(!empty($request->to_date)){
            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '=' ,
                    'value'     => date("Y-m-d",strtotime($request->to_date))
                ]
            ];
        }
        $join_param = [
            [
                'table' => 'branch_infos',
                'on' => [
                    'first_param' => 'branch_infos.id',
                    'operator' => '=',
                    'second_param' => 'archive_info.station_id'
                ]
            ],
            [
                'table' => 'employees',
                'on' => [
                    'first_param' => 'employees.id',
                    'operator' => '=',
                    'second_param' => 'archive_info.created_by'
                ]
            ]
        ];

        $order_by = [
            [
                'field' => 'archive_info.created_by',
                'type'  => 'desc'
            ]
        ];

        $archive_list = Archive_model::get_rows("archive_info", $select, $where, $join_param,false,$where_date,$between,$order_by);

        $active_playlist = Archive_model::get_row("archive_playlist", ["*"], ['status' => 1, 'is_active' => 1]);

        return view(
            'archive.procharona_list',
            [
                'page_title' => 'প্রচারণা লিস্ট',
                'archive_list' => $archive_list,
                'active_playlist' => $active_playlist
            ]
        );
    }

    public function add_to_playlist(Request $request)
    {
        $playlist_info = DB::table("archive_playlist")->where("playlist_id", $request->playlist_id)->first();
        if (!empty($playlist_info)) {
            $song_info = [];
            if (empty($playlist_info->item_info)) {
                $song_info[] = [
                    'song_id' => $request->song_id,
                    'sort' => 0
                ];
            } else {
                $song_info = json_decode($playlist_info->item_info, true);
                $song_ids = array_column($song_info, 'song_id');
                if (!in_array($request->song_id, $song_ids)) {
                    $song_info[] = [
                        'song_id' => $request->song_id,
                        'sort' => 0
                    ];
                }
            }
            DB::table('archive_playlist')->where('playlist_id', $request->playlist_id)->update(['item_info' => json_encode($song_info, true)]);
        }
        $output = array(
            'error' => [],
            'success' => 'Song added to active Successfully',
            'redirect_page' => ''
        );
        echo json_encode($output);

    }

    public function edit_playlist($id)
    {
        $employee_info = Employee::get_employee_info_name(['is_active' => 1]);
        $station_info = Branch_info::branch_info_select(['is_active' => 1]);

        $play_list = DB::table("archive_playlist")
            ->leftJoin('branch_infos', 'branch_infos.id', '=', 'archive_playlist.station_id')
            ->leftJoin('employees', 'archive_playlist.planner_id', '=', 'employees.employee_id')
            ->select('archive_playlist.*', 'branch_infos.name as station_name', 'employees.emp_name')
            ->where(['archive_playlist.is_active' => 1, 'archive_playlist.id' => $id])
            ->first();
        $sub_station_info = Archive_model::get_rows("branch_infos",["*"],['is_active' => 1,'parent_id' => $play_list->station_id]);
        $item_info = !empty($play_list->item_info) ? json_decode($play_list->item_info, true) : [];
        foreach ($item_info as $key => $item) {
            $param = ['id' => $item['song_id']];
            $song_info = Archive_model::get_row("archive_info", ["*"], $param);
            if (!empty($song_info)) {
                $item_info[$key]['details'] = $song_info;
            } else {
                unset($item_info[$key]);
            }
        }

        usort($item_info, function($a, $b) {
            return $a['sort'] <=> $b['sort'];
        });

        return view(
            'archive.edit_playlist',
            [
                'page_title' => 'View Playlist',
                'playlist' => $play_list,
                'station_info' => $station_info,
                'employee_info' => $employee_info,
                'sub_station_info' => $sub_station_info,
                'item_info' => $item_info
            ]
        );
    }

    public function play_playlist($id)
    {
        $employee_info = Employee::get_employee_info_name(['is_active' => 1]);
        $station_info = Branch_info::branch_info_select(['is_active' => 1]);

        $play_list = DB::table("archive_playlist")
            ->leftJoin('branch_infos', 'branch_infos.id', '=', 'archive_playlist.station_id')
            ->leftJoin('branch_infos as frequency', 'frequency.id', '=', 'archive_playlist.sub_station_id')
            ->leftJoin('employees', 'archive_playlist.planner_id', '=', 'employees.employee_id')
            ->select('archive_playlist.*', 'branch_infos.name as station_name','branch_infos.address', 'frequency.title as sub_station_name','frequency.fequencey', 'employees.emp_name')
            ->where(['archive_playlist.is_active' => 1, 'archive_playlist.id' => $id])
            ->first();
        $sub_station_info = Archive_model::get_rows("branch_infos",["*"],['is_active' => 1,'parent_id' => $play_list->station_id]);
        $item_info = !empty($play_list->item_info) ? json_decode($play_list->item_info, true) : [];
        foreach ($item_info as $key => $item) {
            $param = ['id' => $item['song_id']];
            $song_info = Archive_model::get_row("archive_info", ["*"], $param);
            if (!empty($song_info)) {
                $item_info[$key]['details'] = $song_info;
            } else {
                unset($item_info[$key]);
            }
        }

        usort($item_info, function($a, $b) {
            return $a['sort'] <=> $b['sort'];
        });

        return view(
            'archive.play_playlist',
            [
                'page_title' => 'Playlist Player',
                'playlist' => $play_list,
                'station_info' => $station_info,
                'employee_info' => $employee_info,
                'sub_station_info' => $sub_station_info,
                'item_info' => $item_info
            ]
        );
    }

    public function ajax_order_update(Request $request){
        $id = $_GET['id'];
        $playlist_info = Archive_model::get_row("archive_playlist",["*"],["id"=>$id]);
        $item_info = json_decode($playlist_info->item_info,true);
        $order_array = $request->order;
        foreach($item_info as $key => $array){
            $order = array_search($array['song_id'],$order_array);
            $item_info[$key]['sort'] = $order+1;
        }
        DB::table('archive_playlist')->where('id', $id)->update(['item_info' => json_encode($item_info, true)]);
        echo 'All Changes saved! refresh the page to see the changes';
        die();
    }

    public function archive_playlist_create()
    {
        $song_type = Archive_model::get_settings("archive_archiveing_type", ["type" => 1]);
        $band = Archive_model::get_settings("archive_band");
        $band_type = Archive_model::get_settings("archive_band_type");
        $film_type = Archive_model::get_settings("archive_film_type");
        $song_category = Archive_model::get_settings("archive_category", ['parent_id' => null]);
        $archive_albam = Archive_model::get_settings("archive_albam", ["type" => 1]);
        $song_source = Archive_model::get_settings("archive_song_source");
        $employee_info = Employee::get_employee_info_name(['is_active' => 1]);
        $program_artist_info = Employee::get_artist_select();
        $station_info = Branch_info::branch_info_select(['is_active' => 1]);

        return view(
            'archive.playlist_create',
            [
                'page_title' => 'প্লে লিস্ট তৈরি',
                'song_type' => $song_type,
                'band' => $band,
                'band_type' => $band_type,
                'film_type' => $film_type,
                'song_category' => $song_category,
                'archive_albam' => $archive_albam,
                'employee_info' => $employee_info,
                'artist_info' => $program_artist_info,
                'station_info' => $station_info,
                'song_source' => $song_source
            ]
        );
    }


    public function save_playlist(Request $request)
    {
        $current_user = (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
            ->employee_primary_id : NULL);
        $data = [
            'name' => empty($request->name) ? null : $request->name,
            'playlist_id' => empty($request->playlist_id) ? null : $request->playlist_id,
            'planner_id' => empty($request->planner_id) ? null : $request->planner_id,
            'station_id' => empty($request->station_id) ? null : $request->station_id,
            'sub_station_id' => empty($request->sub_station_id) ? null : $request->sub_station_id,
            'program_name' => empty($request->program_name) ? null : $request->program_name,
            'program_subject' => empty($request->program_subject) ? null : $request->program_subject,
            'boardcast_date' => empty($request->boardcast_date) ? null : date("Y-m-d",strtotime($request->boardcast_date)),
            'boardcast_time' => empty($request->boardcast_time) ? null : $request->boardcast_time,
            'status' => empty($request->status) ? 0 : $request->status,
            'created_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                ->employee_primary_id : NULL),
            'created_time' => date('Y-m-d H:i:s'),
            'created_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip()
        ];

        DB::table('archive_playlist')->insert($data);


        if ($request->status == 1) {
            $id = DB::getPdo()->lastInsertId();
            DB::table('archive_playlist')
                ->where('id', '!=', $id)
                ->where(['active_user'=>$current_user])
                ->update(['status' => 0]);
        }

        $output = array(
            'error' => [],
            'success' => 'Playlist Create Successfully',
            'redirect_page' => ''
        );


        echo json_encode($output);
    }

    public function save_playlist_update(Request $request)
    {
        $current_user = (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
            ->employee_primary_id : NULL);

        $data = [
            'name' => !empty($request->name) ? $request->name : null,
            'playlist_id' => !empty($request->playlist_id) ? $request->playlist_id : null,
            'status' => !empty($request->status) ? $request->status : null,
            'station_id' => !empty($request->station_id) ? $request->station_id : null,
            'sub_station_id' => !empty($request->sub_station_id) ? $request->sub_station_id : null,
            'program_name' => !empty($request->program_name) ? $request->program_name : null,
            'program_subject' => !empty($request->program_subject) ? $request->program_subject : null,
            'boardcast_date' => !empty($request->boardcast_date) ? date("Y-m-d",strtotime($request->boardcast_date)) : null,
            'boardcast_time' => !empty($request->boardcast_time) ? $request->boardcast_time : null,
            'planner_id' => !empty($request->planner_id) ? $request->planner_id : null,
            'updated_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                ->employee_primary_id : NULL),
            'updated_time' => date('Y-m-d H:i:s'),
            'updated_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip()
        ];

        if ($request->status == 1) {
            DB::table('archive_playlist')
                ->where([
                    ['id', '!=', $request->id],
                    ['active_user', '=', $current_user],
                ])
                ->update(['status' => 0]);
        }
        DB::table('archive_playlist')->where(['id' => $request->id])->update($data);

        $output = array(
            'error' => [],
            'success' => 'Playlist Update Successfully',
            'redirect_page' => ''
        );


        echo json_encode($output);
    }

    public function song_remove(Request $request)
    {

        $playlist = Archive_model::get_row('archive_playlist', ['*'], ['id' => $request->id]);
        $item_info = json_decode($playlist->item_info, true);
        foreach ($item_info as $key => $item) {
            if ($item['song_id'] == $request->song_id) {
                unset($item_info[$key]);
                break;
            }
        }
        $data = [
            'item_info' => empty($item_info) ? null : json_encode($item_info, true),
            'updated_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                ->employee_primary_id : NULL),
            'updated_time' => date('Y-m-d H:i:s'),
            'updated_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip()
        ];

        DB::table('archive_playlist')->where(['id' => $request->id])->update($data);

        $output = array(
            'status' => 'success',
            'message' => 'Playlist Update Successfully',
            'redirect_page' => ''
        );
        echo json_encode($output);
    }

    public function get_play_list()
    {
        $play_list = DB::table("archive_playlist")
            ->leftJoin('branch_infos', 'branch_infos.id', '=', 'archive_playlist.station_id')
            ->leftJoin('employees', 'archive_playlist.planner_id', '=', 'employees.employee_id')
            ->select('archive_playlist.*', 'branch_infos.name as station_name', 'employees.emp_name')
            ->where('archive_playlist.is_active', 1)
            ->orderBy('archive_playlist.status', 'desc')
            ->get();

        return view(
            'archive.playlist',
            [
                'page_title' => 'প্লে লিস্ট',
                'playlist' => $play_list,
                'current_user' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                    ->employee_primary_id : NULL),
            ]
        );
    }

    public function playlist_status_update(Request $request)
    {

        $status = $request->status == 0 ? 1 : 0;
        $current_user = (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
            ->employee_primary_id : NULL);
        $update = DB::table("archive_playlist")->where("id", $request->id)->update(
            [
                'status' => $status,
                'active_user' => $current_user,
                'updated_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                    ->employee_primary_id : NULL),
                'updated_time' => date('Y-m-d H:i:s'),
                'updated_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip()

            ]
        );

        if ($status == 1) {
            $update = DB::table("archive_playlist")
                ->where("id", '!=', $request->id)
                ->where('active_user', '=', $current_user)
                ->update(
                    [
                        'status' => 0,
                        'updated_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                            ->employee_primary_id : NULL),
                        'updated_time' => date('Y-m-d H:i:s'),
                        'updated_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip()

                    ]
                );
        }

        $output = array(
            'error' => [],
            'success' => 'Playlist Update Successfully',
            'redirect_page' => ''
        );
        echo json_encode($output);

    }

    public function archive_kobita_create()
    {
        $song_type = Archive_model::get_settings("archive_archiveing_type", ["type" => 2,"is_active"=>1]);
        $archive_albam = Archive_model::get_settings("archive_albam", ["type" => 2,'is_active'=>1]);
        $employee_info = Employee::get_employee_info_name(['is_active' => 1]);
        $program_artist_info = Employee::get_artist_select();
        $station_info = Branch_info::branch_info_select(['is_active' => 1]);
        return view(
            'archive.kobita_create',
            [
                'page_title' => 'কবিতা এন্ট্রি',
                'kobita_type' => $song_type,
                'archive_albam' => $archive_albam,
                'employee_info' => $employee_info,
                'artist_info' => $program_artist_info,
                'station_info' => $station_info,
            ]
        );
    }


    public function save_kobita_create(Request $request)
    {
        ini_set('max_execution_time', '0');
        $file = $request->file('odio_file');
        $destinationImagePath = 'archive/kobita';
        $params = [
            'station_id' => $request->station_id,
            'name' => $request->kobitar_name
        ];
        $kobita_id = Archive_model::get_kobita_id($params);
        $file_name = $kobita_id.'-'.$request->kobitar_name;

        if ($request->kobita_department == 1) {
            $abritikar = empty($request->abritikar) ? '' : get_shilpi_name_by_ids($request->abritikar);
            $rochoyita = empty($request->rochoyita) ? '' : get_shilpi_name_by_ids($request->rochoyita);
        } else {
            $golpo_pathok = empty($request->golpo_pathok) ? '' : get_shilpi_name_by_ids($request->golpo_pathok);
            $rochoyita = empty($request->golpo_rochoyita) ? '' : get_shilpi_name_by_ids($request->golpo_rochoyita);
        }

        if(!empty($rochoyita)){
            $file_name.="-".$rochoyita;
        }
        if(!empty($abritikar)){
            $file_name.="-".$abritikar;
        }
        if(!empty($golpo_pathok)){
            $file_name.="-".$golpo_pathok;
        }

        $upload = Archive_model::upload_file($file, $file_name, $destinationImagePath);

        if ($upload) {

            $data = [
                'archive_type' => 2,
                'station_id' => empty($request->station_id) ? null : $request->station_id,
                'sadin_bangla_betar' => isset($request->sadin_bangla_betar_kendro) ? 1 : 0,
                'program_planing_id' => empty($request->program_plan_id) ? null : $request->program_plan_id,
                'boardcast_frequency' => empty($request->prochar_sthan) ? null : $request->prochar_sthan,
                'created_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                    ->employee_primary_id : NULL),
                'created_at' => date('Y-m-d H:i:s'),
                'created_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip()
            ];

            $kobita_info = [
                'first_line' => empty($request->kobitar_first_line) ? null : $request->kobitar_first_line,
                'name' => empty($request->kobitar_name) ? null : $request->kobitar_name,
                'kobita_department' => empty($request->kobita_department) ? null : $request->kobita_department,
                'gronth_name' => empty($request->gronther_name) ? null : $request->gronther_name,
                'kobita_line' => empty($request->kobitar_line) ? null : $request->kobitar_line,
                'participant' => empty($request->ongso_grohon) ? null : $request->ongso_grohon,
                'rating' => empty($request->reating) ? null : $request->reating,
                'hyperlink' => empty($request->hyperlink) ? null : $request->hyperlink,
                'stability' => empty($request->stability) ? null : $request->stability,
                'recording_date' => empty($request->recoarding_date) ? null : date("Y-m-d", strtotime($request->recoarding_date)),
                'first_broadcast_date' => empty($request->first_broadcast_date) ? null : date("Y-m-d", strtotime($request->first_broadcast_date)),
                'file_name' => $file_name . '.' . $file->getClientOriginalExtension(),
                'album_id' => empty($request->kobitar_albam) ? null : $request->kobitar_albam,
                'type_id' => empty($request->kobitar_dhoron) ? null : $request->kobitar_dhoron,
                'id' => $kobita_id,
                'file_directory' => 'archive/kobita',
            ];

            if ($request->kobita_department == 1) {
                $kobita_info['abritikar'] = empty($request->abritikar) ? null : $request->abritikar;
                $kobita_info['rochoyita'] = empty($request->rochoyita) ? null : $request->rochoyita;
                $kobita_info['golpo_pathok'] = null;
                $kobita_info['golpo_rochoyita'] = null;
            } else {
                $kobita_info['abritikar'] =  null;
                $kobita_info['rochoyita'] = null;
                $kobita_info['golpo_pathok'] = empty($request->golpo_pathok) ? null : $request->golpo_pathok;
                $kobita_info['golpo_rochoyita'] = empty($request->golpo_rochoyita) ? null : $request->golpo_rochoyita;
            }

            if (!empty($request->archive_type)) {
                $kobita_info['bisoybostu'] = [];
                foreach ($request->archive_type as $key => $id) {
                    $archive_ids = $request->archiveid;
                    if (!isset($kobita_info['bisoybostu'][$id])) {
                        $kobita_info['bisoybostu'][$id] = [];
                    }
                    if (!empty($archive_ids[$key])) {
                        $explode = array_unique(explode(",", $archive_ids[$key]));
                        foreach ($explode as $value) {
                            if (!in_array($value, $kobita_info['bisoybostu'][$id])) {
                                $kobita_info['bisoybostu'][$id][] = $value;
                            }
                        }

                    }
                }
            } else {
                $kobita_info['bisoybostu'] = null;
            }


            $kobita_info['plan_maker'] = isset($request['plan_maker']) ? $request['plan_maker'] : null;
            $kobita_info['codinator'] = isset($request['codinator']) ? $request['codinator'] : null;
            $kobita_info['producer'] = isset($request['producer']) ? $request['producer'] : null;
            $kobita_info['assistent_producer'] = isset($request['assistent_producer']) ? $request['assistent_producer'] : null;
            $kobita_info['sompadona'] = isset($request['sompadona']) ? $request['sompadona'] : null;
            $kobita_info['direction'] = isset($request['direction']) ? $request['direction'] : null;

            $data['kobita_info'] = json_encode($kobita_info, JSON_UNESCAPED_UNICODE);

            DB::table('archive_info')->insert($data);
            $output = array(
                'error' => [],
                'success' => 'Archive Complete Successfully',
                'redirect_page' => ''
            );
        } else {
            $output = array(
                'error' => ['upload is fail'],
                'success' => '',
                'redirect_page' => ''
            );
        }

        echo json_encode($output);
    }

    public function save_natok_create(Request $request)
    {
        ini_set('max_execution_time', '0');
        $file = $request->file('odio_file');
        $destinationImagePath = 'archive/natok';
        $params = [
            'station_id' => $request->station_id,
            'category' => $request->natoker_prokar,
            'name' => $request->natoker_name
        ];
        $natok_id = Archive_model::get_natok_id($params);

        $shilpi_name = empty($request->nattokar) ? '' : get_shilpi_name_by_ids($request->nattokar);
        $file_name = $natok_id.'-'.$request->natoker_name;
        if(!empty($shilpi_name)){
            $file_name.="-".$shilpi_name;
        }

        $upload = Archive_model::upload_file($file, $file_name, $destinationImagePath);
        if ($upload) {
            $pandulipi = $request->file('pandulipi') ? $request->file('pandulipi') : '';
            if (!empty($pandulipi)) {
                $pandulipi = $request->file('pandulipi');
                $destinationlyrixPath = 'archive/natok/script';
                Archive_model::upload_file($pandulipi, $natok_id, $destinationlyrixPath);
            }

            $data = [
                'archive_type' => 3,
                'station_id' => empty($request->station_id) ? null : $request->station_id,
                'sadin_bangla_betar' => isset($request->sadin_bangla_betar_kendro) ? 1 : 0,
                'program_planing_id' => empty($request->program_plan_id) ? null : $request->program_plan_id,
                'boardcast_frequency' => empty($request->prochar_sthan) ? null : $request->prochar_sthan,
                'created_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                    ->employee_primary_id : NULL),
                'created_at' => date('Y-m-d H:i:s'),
                'created_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip()
            ];

            $natok_info = [
                'main_story' => empty($request->main_story) ? null : $request->main_story,
                'chaya_story' => empty($request->story_summary) ? null : $request->main_story,
                'story_summary' => empty($request->story_summary) ? null : $request->story_summary,
                'rochoyita' => empty($request->story_rochoyita) ? null : $request->story_rochoyita,
                'nattokar' => empty($request->nattokar) ? null : $request->nattokar,
                'rupokar' => empty($request->rupokar) ? null : $request->rupokar,
                'actors' => empty($request->actors) ? null : $request->actors,
                'plan_maker' => isset($request['plan_maker']) ? $request['plan_maker'] : null,
                'codinator' => isset($request['codinator']) ? $request['codinator'] : null,
                'producer' => isset($request['producer']) ? $request['producer'] : null,
                'assistent_producer' => isset($request['assistent_producer']) ? $request['assistent_producer'] : null,
                'sompadona' => isset($request['sompadona']) ? $request['sompadona'] : null,
                'direction' => isset($request['direction']) ? $request['direction'] : null,
                'participant' => empty($request->ongso_grohon) ? null : $request->ongso_grohon,
                'rating' => empty($request->reating) ? null : $request->reating,
                'hyperlink' => empty($request->hyperlink) ? null : $request->hyperlink,
                'stability' => empty($request->stability) ? null : $request->stability,
                'recording_date' => empty($request->recoarding_date) ? null : date("Y-m-d", strtotime($request->recoarding_date)),
                'first_broadcast_date' => empty($request->first_broadcast_date) ? null : date("Y-m-d", strtotime($request->first_broadcast_date)),
                'source_id' => empty($request->source) ? null : $request->source,
                'category' => empty($request->natoker_prokar) ? null : $request->natoker_prokar,
                'file_name' => $file_name . '.' . $file->getClientOriginalExtension(),
                'name' => empty($request->natoker_name) ? null : $request->natoker_name,
                'sound_editors' => empty($request->sompadok) ? null : $request->sompadok,
                'natok_producer' => empty($request->natok_producer) ? null : $request->natok_producer,
                'script_name' => $natok_id . '.' . $pandulipi->getClientOriginalExtension(),
                'id' => $natok_id,
                'file_directory' => 'archive/natok'
            ];


            $natok_info['bisoybostu'] = null;
            if (!empty($request->archive_type)) {
                $natok_info['bisoybostu'] = [];
                foreach ($request->archive_type as $key => $id) {
                    $archive_ids = $request->archiveid;
                    if (!isset($natok_info['bisoybostu'][$id])) {
                        $natok_info['bisoybostu'][$id] = [];
                    }
                    if (!empty($archive_ids[$key])) {
                        $explode = array_unique(explode(",", $archive_ids[$key]));
                        foreach ($explode as $value) {
                            if (!in_array($value, $natok_info['bisoybostu'][$id])) {
                                $natok_info['bisoybostu'][$id][] = $value;
                            }
                        }

                    }
                }
            }

            $natok_info['vumika'] = null;
            if (!empty($request->vumika_id)) {
                $natok_info['vumika'] = [];
                foreach ($request->vumika_id as $key => $id) {
                    $vumika_artist = $request->vumika_artist;
                    if (!empty($vumika_artist[$key]) && !empty($id)) {
                        $natok_info['vumika'][$id] = $vumika_artist[$key];
                    }
                }
            }


            $data['natok_info'] = json_encode($natok_info, JSON_UNESCAPED_UNICODE);

            DB::table('archive_info')->insert($data);


            $output = array(
                'error' => [],
                'success' => 'Archive Complete Successfully',
                'redirect_page' => ''
            );
        } else {
            $output = array(
                'error' => ['upload is fail'],
                'success' => '',
                'redirect_page' => ''
            );
        }

        echo json_encode($output);
    }

    public function save_program_create(Request $request)
    {
        ini_set('max_execution_time', '0');
        $file = $request->file('odio_file');
        $destinationImagePath = 'archive/program';
        $params = [
            'station_id' => $request->station_id,
            'category' => $request->program_prokar,
            'name' => $request->onustha_name
        ];
        $program_id = Archive_model::get_program_id($params);

        $file_name = $program_id.'-'.empty($request->onustha_name) ? '' : $request->onustha_name;

        $upload = Archive_model::upload_file($file, $file_name, $destinationImagePath);

        if ($upload) {
            $data = [
                'archive_type' => 4,
                'station_id' => empty($request->station_id) ? null : $request->station_id,
                'sadin_bangla_betar' => isset($request->sadin_bangla_betar_kendro) ? 1 : 0,
                'program_planing_id' => empty($request->program_plan_id) ? null : $request->program_plan_id,
                'boardcast_frequency' => empty($request->prochar_sthan) ? null : $request->prochar_sthan,
                'created_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                    ->employee_primary_id : NULL),
                'created_at' => date('Y-m-d H:i:s'),
                'created_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip()
            ];

            $program_info = [
                'national_day' => empty($request->jatio_dibos) ? null : $request->jatio_dibos,
                'national_sub_day' => empty($request->jatio_dibos_type) ? null : $request->jatio_dibos_type,
                'subject' => empty($request->onusthan_subject) ? null : $request->onusthan_subject,
                'gobeshona' => empty($request->gobeshona) ? null : $request->gobeshona,
                'gronthona' => empty($request->gronthona) ? null : $request->gronthona,
                'uposthapona' => empty($request->uposthapona) ? null : $request->uposthapona,
                'plan_maker' => isset($request['plan_maker']) ? $request['plan_maker'] : null,
                'codinator' => isset($request['codinator']) ? $request['codinator'] : null,
                'producer' => isset($request['producer']) ? $request['producer'] : null,
                'assistent_producer' => isset($request['assistent_producer']) ? $request['assistent_producer'] : null,
                'sompadona' => isset($request['sompadona']) ? $request['sompadona'] : null,
                'direction' => isset($request['direction']) ? $request['direction'] : null,
                'participant' => empty($request->ongso_grohon) ? null : $request->ongso_grohon,
                'rating' => empty($request->reating) ? null : $request->reating,
                'hyperlink' => empty($request->hyperlink) ? null : $request->hyperlink,
                'stability' => empty($request->stability) ? null : $request->stability,
                'recording_date' => empty($request->recoarding_date) ? null : date("Y-m-d", strtotime($request->recoarding_date)),
                'first_broadcast_date' => empty($request->first_broadcast_date) ? null : date("Y-m-d", strtotime($request->first_broadcast_date)),
                'source_id' => empty($request->source) ? null : $request->source,
                'category' => empty($request->program_prokar) ? null : $request->program_prokar,
                'name' => empty($request->onustha_name) ? null : $request->onustha_name,
                'file_name' => $file_name . '.' . $file->getClientOriginalExtension(),
                'program_id' => $program_id,
                'id' => $program_id,
                'program_vhittik' => empty($request->program_vhittik) ? null : $request->program_vhittik,
                'file_directory' => 'archive/program'
            ];


            $program_info['bisoybostu'] = null;
            if (!empty($request->archive_type)) {
                $program_info['bisoybostu'] = [];
                foreach ($request->archive_type as $key => $id) {
                    $archive_ids = $request->archiveid;
                    if (!isset($program_info['bisoybostu'][$id])) {
                        $program_info['bisoybostu'][$id] = [];
                    }
                    if (!empty($archive_ids[$key])) {
                        $explode = array_unique(explode(",", $archive_ids[$key]));
                        foreach ($explode as $value) {
                            if (!in_array($value, $program_info['bisoybostu'][$id])) {
                                $program_info['bisoybostu'][$id][] = $value;
                            }
                        }

                    }
                }
            }

//            dd($program_info);

            $program_info['vumika'] = null;
            if (!empty($request->vumika_id)) {
                $program_info['vumika'] = [];
                foreach ($request->vumika_id as $key => $id) {
                    $vumika_artist = $request->vumika_artist;
                    if (!empty($vumika_artist[$key]) && !empty($id)) {
                        $program_info['vumika'][$id] = $vumika_artist[$key];
                    }
                }
            }

//            dd($program_info);


            $data['program_info'] = json_encode($program_info, JSON_UNESCAPED_UNICODE);

            DB::table('archive_info')->insert($data);
            $output = array(
                'error' => [],
                'success' => 'Archive Complete Successfully',
                'redirect_page' => ''
            );
        } else {
            $output = array(
                'error' => ['upload is fail'],
                'success' => '',
                'redirect_page' => ''
            );
        }

        echo json_encode($output);
    }

    public function archive_natok_create()
    {
        $song_type = Archive_model::get_settings("archive_archiveing_type", ["type" => 3,'is_active'=>1]);
        $song_category = Archive_model::get_settings("archive_category", ['has_parent' => 0, 'type' => 3,'is_active'=>1]);
        $archive_albam = Archive_model::get_settings("archive_albam", ["type" => 2,'is_active'=>1]);
        $song_source = Archive_model::get_settings("archive_song_source",['is_active'=>1]);
        $employee_info = Employee::get_employee_info_name(['is_active' => 1]);
        $program_artist_info = Employee::get_artist_select();
        $station_info = Branch_info::branch_info_select(['is_active' => 1]);

        return view(
            'archive.natok_create',
            [
                'page_title' => 'নাটক এন্ট্রি',
                'song_type' => $song_type,
                'song_category' => $song_category,
                'archive_albam' => $archive_albam,
                'employee_info' => $employee_info,
                'artist_info' => $program_artist_info,
                'station_info' => $station_info,
                'song_source' => $song_source
            ]
        );
    }


    public function archive_onusthan_create()
    {
        $song_type = Archive_model::get_settings("archive_archiveing_type", ["type" => 4,'is_active'=>1]);
        $song_category = Archive_model::get_settings("archive_category", ['has_parent' => 0, 'type' => 4,'is_active'=>1]);
        $song_source = Archive_model::get_settings("archive_song_source",['is_active'=>1]);
        $employee_info = Employee::get_employee_info_name(['is_active' => 1]);
        $program_artist_info = Employee::get_artist_select();
        $station_info = Branch_info::branch_info_select(['is_active' => 1]);
        $get_fixed_program_type = DB::table('fixed_program_type')->where('parent_id', '=', NULL)->get();
        return view(
            'archive.onusthan_create',
            [
                'page_title' => 'অনুষ্ঠান এন্ট্রি',
                'song_type' => $song_type,
                'song_category' => $song_category,
                'employee_info' => $employee_info,
                'artist_info' => $program_artist_info,
                'station_info' => $station_info,
                'song_source' => $song_source,
                'fixed_program_type' => $get_fixed_program_type
            ]
        );
    }


    public function archive_vhason_create()
    {
        $song_type = Archive_model::get_settings("archive_archiveing_type", ["type" => 5,'is_active'=>1]);
        $song_category = Archive_model::get_settings("archive_category", ['has_parent' => 0, 'type' => 5,'is_active'=>1]);
        $song_source = Archive_model::get_settings("archive_song_source",['is_active'=>1]);
        $employee_info = Employee::get_employee_info_name(['is_active' => 1]);
        $program_artist_info = Employee::get_artist_select();
        $station_info = Branch_info::branch_info_select(['is_active' => 1]);
        return view(
            'archive.vhason_create',
            [
                'page_title' => 'ভাষণ এন্ট্রি',
                'kobita_type' => $song_type,
                'song_category' => $song_category,
                'employee_info' => $employee_info,
                'artist_info' => $program_artist_info,
                'station_info' => $station_info,
                'song_source' => $song_source
            ]
        );
    }


    public function archive_sakhhatkar_create()
    {

        $song_type = Archive_model::get_settings("archive_archiveing_type", ["type" => 5,'is_active'=>1]);
        $song_category = Archive_model::get_settings("archive_category", ['has_parent' => 0, 'type' => 6]);
        $employee_info = Employee::get_employee_info_name(['is_active' => 1]);
        $program_artist_info = Employee::get_artist_select();
        $station_info = Branch_info::branch_info_select(['is_active' => 1]);
        return view(
            'archive.sakhhatkar_create',
            [
                'page_title' => 'সাক্ষাৎকার এন্ট্রি',
                'kobita_type' => $song_type,
                'song_category' => $song_category,
                'employee_info' => $employee_info,
                'artist_info' => $program_artist_info,
                'station_info' => $station_info,
            ]
        );
    }

    public function archive_kothika_create()
    {
        $employee_info = Employee::get_employee_info_name(['is_active' => 1]);
        $program_artist_info = Employee::get_artist_select();
        $station_info = Branch_info::branch_info_select(['is_active' => 1]);
        $get_fixed_program_type = DB::table('fixed_program_type')->where('parent_id', '=', NULL)->get();
        return view(
            'archive.kothika_create',
            [
                'page_title' => 'কথিকা এন্ট্রি',
                'employee_info' => $employee_info,
                'artist_info' => $program_artist_info,
                'station_info' => $station_info,
                'fixed_program_type' => $get_fixed_program_type
            ]
        );
    }


    public function archive_procharona_create()
    {
        $employee_info = Employee::get_employee_info_name(['is_active' => 1]);
        $program_artist_info = Employee::get_artist_select();
        $station_info = Branch_info::branch_info_select(['is_active' => 1]);
        $get_fixed_program_type = DB::table('fixed_program_type')->where('parent_id', '=', NULL)->get();
        $vumika_info = All_stting::get_settings_info(['type' => 16, 'is_active' => 1]); // বিবরন
        $angik_info = Archive_model::get_rows("archive_angik",["*"],["is_active"=>1]); // বিবরন
        $ministry = Archive_model::get_rows("archive_ministry",["*"],["is_active"=>1,"has_parent"=>0]); // বিবরন
//        dd($angik_info);
        return view(
            'archive.procharona_create',
            [
                'page_title' => 'প্রচারণা এন্ট্রি',
                'employee_info' => $employee_info,
                'artist_info' => $program_artist_info,
                'station_info' => $station_info,
                'vumika_info' => $vumika_info,
                'angik_info' => $angik_info,
                'ministry' => $ministry,
                'fixed_program_type' => $get_fixed_program_type
            ]
        );
    }

    public function get_vumika_info()
    {
        $select = [
            'id',
            'title as text'
        ];
        $vumika_info = Archive_model::get_rows("all_sttings", $select, ['type' => 16, 'is_active' => 1]); // বিবরন
        if (!empty($vumika_info)) {
            echo json_encode($vumika_info);
        } else {
            echo json_encode([]);
        }
    }

    public function save_vhason_create(Request $request)
    {
        $file = $request->file('odio_file');
        $vhason = $request->file('vhason');
        $destinationImagePath = 'archive/vhason';

        $params = [
            'station_id' => $request->station_id,
            'category' => $request->vhasoner_prokar
        ];
        $vhason_id = Archive_model::get_vhason_id($params);

        $file_name = $vhason_id.'-'.empty($request->vhason_first_line) ? '' : $request->vhason_first_line;
        $file_name .= empty($request->podobi) ? '' : '-'.$request->podobi;

        $upload = Archive_model::upload_file($file, $file_name, $destinationImagePath);
        Archive_model::upload_file($vhason, $vhason_id, $destinationImagePath . '/script');
        if ($upload) {
            $data = [
                'archive_type' => 5,
                'station_id' => empty($request->station_id) ? null : $request->station_id,
                'sadin_bangla_betar' => isset($request->sadin_bangla_betar_kendro) ? 1 : 0,
                'program_planing_id' => empty($request->program_plan_id) ? null : $request->program_plan_id,
//                'boardcast_frequency' => empty($request->prochar_sthan) ? null : $request->prochar_sthan,
                'created_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                    ->employee_primary_id : NULL),
                'created_at' => date('Y-m-d H:i:s'),
                'created_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip()
            ];

            $vhason_info = [
                'first_line' => empty($request->vhason_first_line) ? null : $request->vhason_first_line,
                'vhason_kari' => empty($request->vhason_kari) ? null : $request->vhason_kari,
                'designation' => empty($request->podobi) ? null : $request->podobi,
                'category' => empty($request->vhasoner_prokar) ? null : $request->vhasoner_prokar,
                'work_area' => empty($request->work_area) ? null : $request->work_area,
                'stability' => empty($request->stability) ? null : $request->stability,
                'place' => empty($request->prochar_sthan) ? null : $request->prochar_sthan,
                'subject' => empty($request->subject) ? null : $request->subject,
                'prodaner_tarikh' => empty($request->prdaner_tarikh) ? null : $request->prdaner_tarikh,
                'plan_maker' => isset($request['plan_maker']) ? $request['plan_maker'] : null,
                'codinator' => isset($request['codinator']) ? $request['codinator'] : null,
                'producer' => isset($request['producer']) ? $request['producer'] : null,
                'assistent_producer' => isset($request['assistent_producer']) ? $request['assistent_producer'] : null,
                'sompadona' => isset($request['sompadona']) ? $request['sompadona'] : null,
                'direction' => isset($request['direction']) ? $request['direction'] : null,
                'file_name' => $file_name . '.' . $file->getClientOriginalExtension(),
                'script_name' => $vhason_id . '.' . $vhason->getClientOriginalExtension(),
                'id' => $vhason_id,
                'file_directory' => 'archive/vhason'
            ];

            $data['vhason_info'] = json_encode($vhason_info, JSON_UNESCAPED_UNICODE);

            DB::table('archive_info')->insert($data);


            $output = array(
                'error' => [],
                'success' => 'Archive Complete Successfully',
                'redirect_page' => ''
            );
        } else {
            $output = array(
                'error' => ['upload is fail'],
                'success' => '',
                'redirect_page' => ''
            );
        }

        echo json_encode($output);
    }

    public function save_sakhhatkar_create(Request $request)
    {
//        dd($request);
        $file = $request->file('odio_file');
        $destinationImagePath = 'archive/sakhhatkar';
        $params = [
            'station_id' => $request->station_id,
            'category' => $request->sakhhater_prokar
        ];
        $sakhhat_id = Archive_model::get_sakkhat_id($params);
        $file_name = $sakhhat_id.'-'.$request->first_line.empty($request->sakhhat_data) ? '' : '-' . $request->sakhhat_data;
        $upload = Archive_model::upload_file($file, $file_name, $destinationImagePath);
        if ($upload) {
            $data = [
                'archive_type' => 6,
                'station_id' => empty($request->station_id) ? null : $request->station_id,
                'sadin_bangla_betar' => isset($request->sadin_bangla_betar_kendro) ? 1 : 0,
                'program_planing_id' => empty($request->program_plan_id) ? null : $request->program_plan_id,
                'created_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                    ->employee_primary_id : NULL),
                'created_at' => date('Y-m-d H:i:s'),
                'created_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip()
            ];

            $sakhhatkar_info = [
                'program_name' => empty($request->program_name) ? null : $request->program_name,
                'sakhhatkar_department' => empty($request->sakhhatkar_department) ? null : $request->sakhhatkar_department,
                'sakhhat_data' => empty($request->sakhhat_data) ? null : $request->sakhhat_data,
                'category' => empty($request->sakhhater_prokar) ? null : $request->sakhhater_prokar,
                'work_area' => empty($request->work_area) ? null : $request->work_area,
                'stability' => empty($request->stability) ? null : $request->stability,
                'place' => empty($request->prochar_sthan) ? null : $request->prochar_sthan,
                'subject' => empty($request->subject) ? null : $request->subject,
                'grohoner_date' => empty($request->grohoner_date) ? null : $request->grohoner_date,
                'first_line' => empty($request->first_line)? null : $request->first_line,
                'comment' => empty($request->comment) ? null : $request->comment,
                'plan_maker' => isset($request['plan_maker']) ? $request['plan_maker'] : null,
                'codinator' => isset($request['codinator']) ? $request['codinator'] : null,
                'producer' => isset($request['producer']) ? $request['producer'] : null,
                'assistent_producer' => isset($request['assistent_producer']) ? $request['assistent_producer'] : null,
                'sompadona' => isset($request['sompadona']) ? $request['sompadona'] : null,
                'direction' => isset($request['direction']) ? $request['direction'] : null,
                'file_name' => $file_name . '.' . $file->getClientOriginalExtension(),
                'id' => $sakhhat_id,
                'file_directory' => 'archive/sakhhatkar',
                'sakhhatkar_vhittik' => null,
                'alochona_onusthan' => null,
                'sms' => null,
                'phone_in_program' => null,
                'protibedon' => null,
                'bitorko' => null,
            ];


            if (!empty($request->sakhhatkar_department)) {

                foreach($request->sakhhatkar_department as $id) {

                    if ($id == 1) {
                        if (!empty($request->sakhhatkardata) || !empty($request->sakhhatkar_grohita)) {
                            $sakhhatkar_info['sakhhatkar_vhittik'] = [
                                'sakhhatkardata' => $request->sakhhatkardata,
                                'sakhhatkar_grohita' => $request->sakhhatkar_grohita,
                            ];
                        }
                    } elseif($id == 2) {
                        if (!empty($request->ongshogrohonkari) || !empty($request->sonchalok)) {
                            $sakhhatkar_info['alochona_onusthan'] = [
                                'ongshogrohonkari' => $request->ongshogrohonkari,
                                'sonchalok' => $request->sonchalok,
                            ];
                        }
                    } elseif ($id == 3) {
                        if (!empty($request->gronthona) || !empty($request->uposthapona)) {
                            $sakhhatkar_info['sms'] = [
                                'gronthona' => $request->gronthona,
                                'uposthapona' => $request->uposthapona,
                            ];
                        }
                    } elseif ($id == 4) {
                        if (!empty($request->bishesoggo) || !empty($request->porichalona)) {
                            $sakhhatkar_info['phone_in_program'] = [
                                'bishesoggo' => $request->bishesoggo,
                                'porichalona' => $request->porichalona,
                            ];
                        }
                    } elseif ($id == 5) {
                        if (!empty($request->protibedok)) {
                            $sakhhatkar_info['protibedon'] = [
                                'protibedok' => $request->protibedok,
                            ];
                        }
                    }
                    else {
                        if (!empty($request->bitorko_porjay)) {
                            $sakhhatkar_info['bitorko'] = [
                                'bitorko_porjay' => $request->bitorko_porjay,
                                'bitorko_porichalona' => $request->bitorko_porichalona,
                                'bitorko_bicharok' => $request->bicharok,
                                'bitorko_shohojogita' => $request->bitorko_shohojogita,
                                'protisthan_info' => null
                            ];

                            if (!empty($request->protisthaner_name)) {
                                foreach ($request->protisthaner_name as $key => $value) {
                                    if (!is_array($sakhhatkar_info['bitorko']['protisthan_info'])) {
                                        $sakhhatkar_info['bitorko']['protisthan_info'] = [];
                                        $sakhhatkar_info['bitorko']['protisthan_info'][] = [
                                            'protisthan_name' => empty($value) ? null : $value,
                                            'protisthaner_thikana' => empty($request->protisthaner_thikana[$key]) ? null : $request->protisthaner_thikana[$key],
                                            'bitorko_ongshogrohonkari' => empty($request->bitorko_ongshogrohonkari[$key]) ? null : $request->bitorko_ongshogrohonkari[$key]
                                        ];
                                    } else {
                                        $sakhhatkar_info['bitorko']['protisthan_info'][] = [
                                            'protisthan_name' => empty($value) ? null : $value,
                                            'protisthaner_thikana' => empty($request->protisthaner_thikana[$key]) ? null : $request->protisthaner_thikana[$key],
                                            'bitorko_ongshogrohonkari' => empty($request->bitorko_ongshogrohonkari[$key]) ? null : $request->bitorko_ongshogrohonkari[$key]
                                        ];
                                    }
                                }
                            }


                        }
                    }

                }

            }




            $sakhhatkar_info['bisoybostu'] = null;
            if (!empty($request->archive_type)) {
                $sakhhatkar_info['bisoybostu'] = [];
                foreach ($request->archive_type as $key => $id) {
                    $archive_ids = $request->archiveid;
                    if (!isset($sakhhatkar_info['bisoybostu'][$id])) {
                        $sakhhatkar_info['bisoybostu'][$id] = [];
                    }
                    if (!empty($archive_ids[$key])) {
                        $explode = array_unique(explode(",", $archive_ids[$key]));
                        foreach ($explode as $value) {
                            if (!in_array($value, $sakhhatkar_info['bisoybostu'][$id])) {
                                $sakhhatkar_info['bisoybostu'][$id][] = $value;
                            }
                        }

                    }
                }
            }

            $sakhhatkar_info['vumika'] = null;
            if (!empty($request->vumika_id)) {
                $sakhhatkar_info['vumika'] = [];
                foreach ($request->vumika_id as $key => $id) {
                    $vumika_artist = $request->vumika_artist;
                    if (!empty($vumika_artist[$key]) && !empty($id)) {
                        $sakhhatkar_info['vumika'][$id] = $vumika_artist[$key];
                    }
                }
            }


            $data['sakhhatkar_info'] = json_encode($sakhhatkar_info, JSON_UNESCAPED_UNICODE);

            DB::table('archive_info')->insert($data);


            $output = array(
                'error' => [],
                'success' => 'Archive Complete Successfully',
                'redirect_page' => ''
            );
        } else {
            $output = array(
                'error' => ['upload is fail'],
                'success' => '',
                'redirect_page' => ''
            );
        }

        echo json_encode($output);
    }

    public function save_kothika_create(Request $request)
    {
        $file = $request->file('odio_file');
        $pandulipi = $request->file('pandulipi');
        $destinationImagePath = 'archive/kothika';
        $params = [
            'station_id' => $request->station_id,
            'name' => $request->kothika_name
        ];
        $kothika_id = Archive_model::get_kothika_id($params);
        $file_name = $kothika_id.'-'.$request->first_line.empty($request->gronthona) ? '' : '-'.get_shilpi_name_by_ids($request->gronthona);
        $upload = Archive_model::upload_file($file, $kothika_id, $destinationImagePath);
        $destinationImagePath = 'archive/kothika/script';
        Archive_model::upload_file($pandulipi, $file_name, $destinationImagePath);
        if ($upload) {
            $data = [
                'archive_type' => 7,
                'station_id' => empty($request->station_id) ? null : $request->station_id,
                'sadin_bangla_betar' => isset($request->sadin_bangla_betar_kendro) ? 1 : 0,
                'boardcast_frequency' => empty($request->prochar_sthan) ? null : $request->prochar_sthan,
                'created_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                    ->employee_primary_id : NULL),
                'created_at' => date('Y-m-d H:i:s'),
                'created_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip()
            ];

            $kothika_info = [
                'name' => empty($request->kothika_name) ? null : $request->kothika_name,
                'subject' => empty($request->subject) ? null : $request->subject,
                'national_day' => empty($request->jatio_dibos) ? null : $request->jatio_dibos,
                'national_sub_day' => empty($request->jatio_dibos_type) ? null : $request->jatio_dibos_type,
                'rating' => empty($request->reating) ? null : $request->reating,
                'category' => empty($request->sakhhater_prokar) ? null : $request->sakhhater_prokar,
                'stability' => empty($request->stability) ? null : $request->stability,
                'hyperlink' => empty($request->hyperlink) ? null : $request->hyperlink,
                'recording_date' => empty($request->recoarding_date) ? null : date("Y-m-d", strtotime($request->recoarding_date)),
                'first_broadcast_date' => empty($request->first_bordcasting_date) ? null : date("Y-m-d", strtotime($request->first_bordcasting_date)),
                'comment' => empty($request->comment) ? null : $request->comment,
                'gronthona' => empty($request->gronthona) ? null : $request->gronthona,
                'uposthapna' => empty($request->uposthapna) ? null : $request->uposthapna,
                'plan_maker' => isset($request['plan_maker']) ? $request['plan_maker'] : null,
                'codinator' => isset($request['codinator']) ? $request['codinator'] : null,
                'producer' => isset($request['producer']) ? $request['producer'] : null,
                'assistent_producer' => isset($request['assistent_producer']) ? $request['assistent_producer'] : null,
                'sompadona' => isset($request['sompadona']) ? $request['sompadona'] : null,
                'direction' => isset($request['direction']) ? $request['direction'] : null,
                'file_name' => $file_name . '.' . $file->getClientOriginalExtension(),
                'script_name' => $kothika_id . '.' . $pandulipi->getClientOriginalExtension(),
                'id' => $kothika_id,
                'file_directory' => 'archive/kothika'
            ];

            $data['kothika_info'] = json_encode($kothika_info, JSON_UNESCAPED_UNICODE);

            DB::table('archive_info')->insert($data);


            $output = array(
                'error' => [],
                'success' => 'Archive Complete Successfully',
                'redirect_page' => ''
            );
        } else {
            $output = array(
                'error' => ['upload is fail'],
                'success' => '',
                'redirect_page' => ''
            );
        }

        echo json_encode($output);
    }

    public function save_procharona_create(Request $request)
    {
        $file = $request->file('odio_file');
        $pandulipi = $request->file('pandulipi');
        $destinationImagePath = 'archive/procharona';
        $params = [
            'station_id' => $request->station_id,
            'subject' => $request->subject
        ];
        $procharona_id = Archive_model::get_procharona_id($params);
        $file_name = $procharona_id.empty($request->angik) ? '' : '-'.get_angik_name($request->angik);
        $file_name .= empty($request->prothom_line) ? '' : '-'.$request->prothom_line;
        $upload = Archive_model::upload_file($file, $file_name, $destinationImagePath);
        $destinationImagePath = 'archive/procharona/script';
        Archive_model::upload_file($pandulipi, $procharona_id, $destinationImagePath);
        if ($upload) {
            $data = [
                'archive_type' => 8,
                'station_id' => empty($request->station_id) ? null : $request->station_id,
                'sadin_bangla_betar' => isset($request->sadin_bangla_betar_kendro) ? 1 : 0,
                'program_planing_id' => empty($request->program_plan_id) ? null : $request->program_plan_id,
                'boardcast_frequency' => empty($request->prochar_sthan) ? null : $request->prochar_sthan,
                'created_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                    ->employee_primary_id : NULL),
                'created_at' => date('Y-m-d H:i:s'),
                'created_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip()
            ];

            $procharona_info = [
                'first_line' => empty($request->prothom_line) ? null : $request->prothom_line,
                'subject' => empty($request->subject) ? null : $request->subject,
                'angik' => empty($request->angik) ? null : $request->angik,
                'ministry' => empty($request->ministry) ? null : $request->ministry,
                'doptor' => empty($request->doptor) ? null : $request->doptor,
                'stability' => empty($request->stability) ? null : $request->stability,
                'hyperlink' => empty($request->hyperlink) ? null : $request->hyperlink,
                'recording_date' => empty($request->recoarding_date) ? null : date("Y-m-d", strtotime($request->recoarding_date)),
                'first_broadcast_date' => empty($request->first_bordcasting_date) ? null : date("Y-m-d", strtotime($request->first_bordcasting_date)),
                'comment' => empty($request->comment) ? null : $request->comment,
                'participant' => empty($request->ongshogrohon) ? null : $request->ongshogrohon,
                'plan_maker' => isset($request['plan_maker']) ? $request['plan_maker'] : null,
                'codinator' => isset($request['codinator']) ? $request['codinator'] : null,
                'producer' => isset($request['producer']) ? $request['producer'] : null,
                'assistent_producer' => isset($request['assistent_producer']) ? $request['assistent_producer'] : null,
                'sompadona' => isset($request['sompadona']) ? $request['sompadona'] : null,
                'direction' => isset($request['direction']) ? $request['direction'] : null,
                'file_name' => $file_name . '.' . $file->getClientOriginalExtension(),
                'script_name' => $procharona_id . '.' . $pandulipi->getClientOriginalExtension(),
                'id' => $procharona_id,
                'file_directory' => 'archive/procharona'
            ];

            $procharona_info['bisoybostu'] = null;

            if (!empty($request->archive_type)) {
                $procharona_info['bisoybostu'] = [];
                foreach ($request->archive_type as $key => $id) {
                    $archive_ids = $request->archiveid;
                    if (!isset($procharona_info['bisoybostu'][$id])) {
                        $procharona_info['bisoybostu'][$id] = [];
                    }
                    if (!empty($archive_ids[$key])) {
                        $explode = array_unique(explode(",", $archive_ids[$key]));
                        foreach ($explode as $value) {
                            if (!in_array($value, $procharona_info['bisoybostu'][$id])) {
                                $procharona_info['bisoybostu'][$id][] = $value;
                            }
                        }

                    }
                }
            }

            $procharona_info['vumika'] = null;
            if (!empty($request->vumika_id)) {
                $procharona_info['vumika'] = [];
                foreach ($request->vumika_id as $key => $id) {
                    $vumika_artist = $request->vumika_artist;
                    if (!empty($vumika_artist[$key]) && !empty($id)) {
                        $procharona_info['vumika'][$id] = $vumika_artist[$key];
                    }
                }
            }

//            dd($procharona_info);

            $data['procharona_info'] = json_encode($procharona_info, JSON_UNESCAPED_UNICODE);

            DB::table('archive_info')->insert($data);


            $output = array(
                'error' => [],
                'success' => 'Archive Complete Successfully',
                'redirect_page' => ''
            );
        } else {
            $output = array(
                'error' => ['upload is fail'],
                'success' => '',
                'redirect_page' => ''
            );
        }

        echo json_encode($output);
    }

    public function view_playlist($id)
    {

        $play_list = DB::table("archive_playlist")
            ->leftJoin('branch_infos', 'branch_infos.id', '=', 'archive_playlist.station_id')
            ->leftJoin('branch_infos as frequency', 'frequency.id', '=', 'archive_playlist.sub_station_id')
            ->leftJoin('employees', 'archive_playlist.planner_id', '=', 'employees.employee_id')
            ->select('archive_playlist.*', 'branch_infos.name as station_name','branch_infos.address', 'frequency.title as sub_station_name','frequency.fequencey', 'employees.emp_name')
            ->where(['archive_playlist.is_active' => 1, 'archive_playlist.id' => $id])
            ->first();
//        dd($play_list);
        $item_info = !empty($play_list->item_info) ? json_decode($play_list->item_info, true) : [];
        foreach ($item_info as $key => $item) {
            $param = ['id' => $item['song_id']];
            $song_info = Archive_model::get_row("archive_info", ["*"], $param);
            if (!empty($song_info)) {
                $item_info[$key]['details'] = $song_info;
            } else {
                unset($item_info[$key]);
            }
        }

        return view(
            'archive.view_playlist',
            [
                'page_title' => 'প্লে লিস্ট রিপোর্ট',
                'playlist' => $play_list,
                'item_info' => $item_info
            ]
        );
    }

    public function archive_book(Request $request)
    {
//        DB::enableQueryLog();
        $archive_list =  Archive_model::archive_info($request,true);
//        $query = DB::getQueryLog();

//        select * from `archive_info` where (`is_active` != 0 and `is_approve` = 1 and `archive_type` = 1) and (`songit_info`->'$."category"' LIKE '%4%'
//    AND JSON_CONTAINS(songit_info->'$.artist', json_array('27','28'))) limit 10

//        dd($query);
        $current_user = (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
            ->employee_primary_id : NULL);
        $page_title = ' বেতার আর্কাইভ';
        $active_playlist = Archive_model::get_row("archive_playlist", ["*"], ['status' => 1, 'is_active' => 1,'active_user'=>$current_user]);

        $station_info = Branch_info::branch_info_select(['is_active' => 1]);

        return view('archive.book',
            [
                'page_title' => $page_title,
                'archive_list' => $archive_list,
                'active_playlist' => $active_playlist,
                'station_info' => $station_info,
            ]
        );
    }

    public function archive_change_status(Request $request) {
        $data = [
            'status' => $request->status,
            'updated_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                ->employee_primary_id : NULL),
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip()
        ];
        DB::table('archive_info')->where(['id' => $request->id])->update($data);
        $output = array(
            'error' => [],
            'success' => 'Archive Item Update Successfully',
            'redirect_page' => ''
        );
        echo json_encode($output);
    }

    public function get_archive_ids(Request $request)
    {
        $select = [
            'archive_info.id'
        ];
        $where = [
            'archive_type' => $request->archive_type
        ];
        if ($request->archive_type == 1) {
            $select[] = DB::raw('archive_info.songit_info->>"$.id" as text');
        } elseif ($request->archive_type == 2) {
            $select[] = DB::raw('archive_info.kobita_info->>"$.id" as text');
        } elseif ($request->archive_type == 3) {
            $select[] = DB::raw('archive_info.natok_info->>"$.id" as text');
        } elseif ($request->archive_type == 4) {
            $select[] = DB::raw('archive_info.program_info->>"$.id" as text');
        } elseif ($request->archive_type == 5) {
            $select[] = DB::raw('archive_info.vhason_info->>"$.id" as text');
        } elseif ($request->archive_type == 6) {
            $select[] = DB::raw('archive_info.sakhhatkar_info->>"$.id" as text');
        } elseif ($request->archive_type == 7) {
            $select[] = DB::raw('archive_info.kothika_info->>"$.id" as text');
        }
        $data = Archive_model::get_rows("archive_info", $select, $where);
        if (!empty($data)) {
            echo json_encode($data);
        } else {
            echo json_encode([]);
        }

    }


    public function get_archive_type(Request $request)
    {
//        dd($request);
        $archive_type = [
            ['id' => 1, 'text' => 'সংগীত'],
            ['id' => 2, 'text' => 'কবিতা'],
            ['id' => 3, 'text' => 'নাটক'],
            ['id' => 4, 'text' => 'অনুষ্ঠান'],
            ['id' => 5, 'text' => 'ভাষণ'],
            ['id' => 6, 'text' => 'সাক্ষাৎকার'],
            ['id' => 7, 'text' => 'কথিকা'],
            ['id' => 8, 'text' => 'প্রচারণা'],
        ];
        $filter = array_filter($archive_type, function ($array) use ($request) {
            return $array['id'] != $request->archive_type;
        });

        echo json_encode($filter);

    }

    public function archive_item_approved(Request $request) {
        $data = [
            'is_approve' => 1,
            'updated_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                ->employee_primary_id : NULL),
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip()
        ];
        DB::table('archive_info')->where(['id' => $request->id])->update($data);
        $output = array(
            'error' => [],
            'success' => 'Playlist Update Successfully',
            'redirect_page' => ''
        );
        echo json_encode($output);
    }

    public function archive_item_correction(Request $request) {

        $data = [
            'is_approve' => 2,
            'correction_message' => $request->message,
            'updated_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                ->employee_primary_id : NULL),
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip()
        ];
        DB::table('archive_info')->where(['id' => $request->archive_id])->update($data);
        $output = array(
            'error' => [],
            'success' => 'Message Send Successfully',
            'redirect_page' => ''
        );
        echo json_encode($output);
    }

    public function archive_item_delete(Request $request) {

        $data = [
            'is_active' => 0,
            'updated_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                ->employee_primary_id : NULL),
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip()
        ];
        DB::table('archive_info')->where(['id' => $request->id])->update($data);
        $output = array(
            'error' => [],
            'success' => 'Item Deleted Successfully',
            'redirect_page' => ''
        );
        echo json_encode($output);
    }

    public function archive_item_download($id) {

        $item_info = Archive_model::get_row('archive_info',["*"],['id'=>$id]);
        if($item_info) {
            $archive_type = $item_info->archive_type;
            if($archive_type==1){
                $file_info = json_decode($item_info->songit_info);
            }
            elseif($archive_type==2){
                $file_info = json_decode($item_info->kobita_info);
            }
            elseif($archive_type==3){
                $file_info = json_decode($item_info->natok_info);
            }
            elseif($archive_type==4){
                $file_info = json_decode($item_info->program_info);
            }
            elseif($archive_type==5){
                $file_info = json_decode($item_info->vhason_info);
            }
            elseif($archive_type==6){
                $file_info = json_decode($item_info->sakhhatkar_info);
            }
            elseif($archive_type==7){
                $file_info = json_decode($item_info->kothika_info);
            }
            elseif($archive_type==8){
                $file_info = json_decode($item_info->procharona_info);
            }
            $path = $file_info->file_directory.'/'.$file_info->file_name;
            return response()->download($path, $file_info->file_name);
        };
    }

    public function donwloadMultipleFile($id)
    {
        $item_info = Archive_model::get_row('archive_playlist',["*"],['id'=>$id]);
        $file_info = json_decode($item_info->item_info,true);
        usort($file_info, function($a, $b) {
            return $a['sort'] <=> $b['sort'];
        });

        $files = [];
        foreach($file_info as $array){
            $file_path = get_file_path($array['song_id']);
            $strArray = explode('/',$file_path);
            $file_name = end($strArray);
            $files[$array['sort'].'-'.$file_name] = $file_path;

        }

        $zip_file_path = public_path('playlist.zip');

        if (File::exists($zip_file_path)) {
            File::delete($zip_file_path);
        }

        $zipper = Zipper::make($zip_file_path);
        $zipper->add($files)->close();
        return response()->download($zip_file_path);
    }



    //////////////////////////////////////////////// archive song review start /////////////////////////////////////
    public function archive_song_review(Request $request)
    {

        $select = [
            'archive_info.*',
            'branch_infos.name as station_name',
            'employees.emp_name',
            // DB::raw('archive_info.songit_info->>"$.name" as song_name'),
            // DB::raw('archive_info.songit_info->>"$.id" as song_id'),
            // DB::raw('archive_info.songit_info->>"$.first_line" as first_line'),
            // DB::raw('archive_info.songit_info->>"$.file_name" as file_name'),
            // DB::raw('archive_info.songit_info->>"$.file_directory" as file_directory'),
        ];

        $between = false;
        $where_date = false;

        $where = ['archive_type' => 1, 'archive_info.is_active' => 1];
        if(!empty($request->created_by)) {
            $where['archive_info.created_by'] = (int) $request->created_by;
        }
        if(!empty($request->status)) {
            $where['archive_info.is_approve'] =  $request->status;
        }

        if(!empty($request->from_date) && !empty($request->to_date)) {

            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '>=' ,
                    'value'     => date("Y-m-d",strtotime($request->from_date))
                ],
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '<=' ,
                    'value'     => date("Y-m-d",strtotime($request->to_date))
                ]
            ];
        }
        elseif(!empty($request->from_date)){
            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '=' ,
                    'value'     => date("Y-m-d",strtotime($request->from_date))
                ]
            ];
        }
        elseif(!empty($request->to_date)){
            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '=' ,
                    'value'     => date("Y-m-d",strtotime($request->to_date))
                ]
            ];
        }

        $join_param = [
            [
                'table' => 'branch_infos',
                'on' => [
                    'first_param' => 'branch_infos.id',
                    'operator' => '=',
                    'second_param' => 'archive_info.station_id'
                ]
            ],
            [
                'table' => 'employees',
                'on' => [
                    'first_param' => 'employees.id',
                    'operator' => '=',
                    'second_param' => 'archive_info.created_by'
                ]
            ]
        ];
        $order_by = [
            [
                'field' => 'archive_info.created_at',
                'type'  => 'desc'
            ]
        ];

        $archive_list = Archive_model::get_rows("archive_info", $select, $where, $join_param,false,$where_date,$between,$order_by,false,true);
        $active_playlist = Archive_model::get_row("archive_playlist", ["*"], ['status' => 1, 'is_active' => 1]);
        $employee_info = Archive_model::get_rows("employees", ["*"], ['is_active'=>1]);
        return view(
            'archive.item_review.songit',
            [
                'page_title' => 'আর্কাইভ রিভিউ',
                'archive_list' => $archive_list,
                'active_playlist' => $active_playlist,
                'employee_info' => $employee_info,
            ]
        );
    }

    public function archive_kobita_review(Request $request) {

        $select = [
            'archive_info.*',
            'branch_infos.name as station_name',
            'employees.emp_name',
            // DB::raw('archive_info.kobita_info->>"$.name" as kobita_name'),
            // DB::raw('archive_info.kobita_info->>"$.id" as kobita_id'),
            // DB::raw('archive_info.kobita_info->>"$.first_line" as first_line'),
            // DB::raw('archive_info.kobita_info->>"$.file_name" as file_name'),
            // DB::raw('archive_info.kobita_info->>"$.file_directory" as file_directory'),
        ];

        $where_date = false;

        $where = ['archive_type' => 2, 'archive_info.is_active' => 1];

        if(!empty($request->created_by)) {
            $where['archive_info.created_by'] = (int) $request->created_by;
        }
        if(!empty($request->status)) {
            $where['archive_info.is_approve'] =  $request->status;
        }

        if(!empty($request->from_date) && !empty($request->to_date)) {

            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '>=' ,
                    'value'     => date("Y-m-d",strtotime($request->from_date))
                ],
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '<=' ,
                    'value'     => date("Y-m-d",strtotime($request->to_date))
                ]
            ];
        }
        elseif(!empty($request->from_date)){
            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '=' ,
                    'value'     => date("Y-m-d",strtotime($request->from_date))
                ]
            ];
        }
        elseif(!empty($request->to_date)){
            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '=' ,
                    'value'     => date("Y-m-d",strtotime($request->to_date))
                ]
            ];
        }

        $join_param = [
            [
                'table' => 'branch_infos',
                'on' => [
                    'first_param' => 'branch_infos.id',
                    'operator' => '=',
                    'second_param' => 'archive_info.station_id'
                ]
            ],
            [
                'table' => 'employees',
                'on' => [
                    'first_param' => 'employees.id',
                    'operator' => '=',
                    'second_param' => 'archive_info.created_by'
                ]
            ]
        ];
        $order_by = [
            [
                'field' => 'archive_info.created_at',
                'type'  => 'desc'
            ]
        ];

        $archive_list = Archive_model::get_rows("archive_info", $select, $where, $join_param,false,$where_date,false,$order_by);
        $active_playlist = Archive_model::get_row("archive_playlist", ["*"], ['status' => 1, 'is_active' => 1]);
        $employee_info = Archive_model::get_rows("employees", ["*"], ['is_active'=>1]);
//        dd($archive_list);
        return view(
            'archive.item_review.kobita',
            [
                'page_title' => 'গ্লপ/কবিতা লিস্ট',
                'archive_list' => $archive_list,
                'employee_info' => $employee_info,
                'active_playlist' => $active_playlist
            ]
        );


    }


    public function archive_natok_review(Request $request) {

        $select = [
            'archive_info.*',
            'branch_infos.name as station_name',
            'employees.emp_name',
            // DB::raw('archive_info.natok_info->>"$.name" as natok_name'),
            // DB::raw('archive_info.natok_info->>"$.id" as natok_id'),
            // DB::raw('archive_info.natok_info->>"$.nattokar" as nattokar_id'),
            // DB::raw('archive_info.natok_info->>"$.file_name" as file_name'),
            // DB::raw('archive_info.natok_info->>"$.file_directory" as file_directory'),
        ];

        $where = ['archive_type' => 3, 'archive_info.is_active' => 1];
        $between  = false;
        $where_date  = false;
        if(!empty($request->created_by)) {
            $where['archive_info.created_by'] = (int) $request->created_by;
        }
        if(!empty($request->status)) {
            $where['archive_info.is_approve'] =  $request->status;
        }

        if(!empty($request->from_date) && !empty($request->to_date)) {

            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '>=' ,
                    'value'     => date("Y-m-d",strtotime($request->from_date))
                ],
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '<=' ,
                    'value'     => date("Y-m-d",strtotime($request->to_date))
                ]
            ];
        }
        elseif(!empty($request->from_date)){
            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '=' ,
                    'value'     => date("Y-m-d",strtotime($request->from_date))
                ]
            ];
        }
        elseif(!empty($request->to_date)){
            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '=' ,
                    'value'     => date("Y-m-d",strtotime($request->to_date))
                ]
            ];
        }
        $join_param = [
            [
                'table' => 'branch_infos',
                'on' => [
                    'first_param' => 'branch_infos.id',
                    'operator' => '=',
                    'second_param' => 'archive_info.station_id'
                ]
            ],
            [
                'table' => 'employees',
                'on' => [
                    'first_param' => 'employees.id',
                    'operator' => '=',
                    'second_param' => 'archive_info.created_by'
                ]
            ]
        ];

        $order_by = [
            [
                'field' => 'archive_info.created_by',
                'type'  => 'desc'
            ]
        ];

        $archive_list = Archive_model::get_rows("archive_info", $select, $where, $join_param,false,$where_date,$between,$order_by);

        $active_playlist = Archive_model::get_row("archive_playlist", ["*"], ['status' => 1, 'is_active' => 1]);
        $employee_info = Archive_model::get_rows("employees", ["*"], ['is_active'=>1]);
//        dd($archive_list);
        return view(
            'archive.item_review.natok',
            [
                'page_title' => 'নাটক রিভিউ লিস্ট',
                'archive_list' => $archive_list,
                'employee_info' => $employee_info,
                'active_playlist' => $active_playlist
            ]
        );


    }



    public function archive_program_review(Request $request) {

        $select = [
            'archive_info.*',
            'branch_infos.name as station_name',
            'employees.emp_name',
            // DB::raw('archive_info.program_info->>"$.name" as program_name'),
            // DB::raw('archive_info.program_info->>"$.id" as program_id'),
            // DB::raw('archive_info.program_info->>"$.file_name" as file_name'),
            // DB::raw('archive_info.program_info->>"$.file_directory" as file_directory'),
        ];

        $where = ['archive_type' => 4, 'archive_info.is_active' => 1];
        $between  = false;
        $where_date  = false;
        if(!empty($request->created_by)) {
            $where['archive_info.created_by'] = (int) $request->created_by;
        }
        if(!empty($request->status)) {
            $where['archive_info.is_approve'] =  $request->status;
        }

        if(!empty($request->from_date) && !empty($request->to_date)) {

            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '>=' ,
                    'value'     => date("Y-m-d",strtotime($request->from_date))
                ],
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '<=' ,
                    'value'     => date("Y-m-d",strtotime($request->to_date))
                ]
            ];
        }
        elseif(!empty($request->from_date)){
            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '=' ,
                    'value'     => date("Y-m-d",strtotime($request->from_date))
                ]
            ];
        }
        elseif(!empty($request->to_date)){
            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '=' ,
                    'value'     => date("Y-m-d",strtotime($request->to_date))
                ]
            ];
        }
        $join_param = [
            [
                'table' => 'branch_infos',
                'on' => [
                    'first_param' => 'branch_infos.id',
                    'operator' => '=',
                    'second_param' => 'archive_info.station_id'
                ]
            ],
            [
                'table' => 'employees',
                'on' => [
                    'first_param' => 'employees.id',
                    'operator' => '=',
                    'second_param' => 'archive_info.created_by'
                ]
            ]
        ];

        $order_by = [
            [
                'field' => 'archive_info.created_by',
                'type'  => 'desc'
            ]
        ];

        $archive_list = Archive_model::get_rows("archive_info", $select, $where, $join_param,false,$where_date,$between,$order_by);

        $active_playlist = Archive_model::get_row("archive_playlist", ["*"], ['status' => 1, 'is_active' => 1]);

        $employee_info = Archive_model::get_rows("employees", ["*"], ['is_active'=>1]);
//        dd($archive_list);
        return view(
            'archive.item_review.program',
            [
                'page_title' => 'কম্পোজিট অনুষ্ঠান রিভিউ লিস্ট',
                'archive_list' => $archive_list,
                'employee_info' => $employee_info,
                'active_playlist' => $active_playlist
            ]
        );


    }


    public function archive_vhason_review(Request $request) {

        $select = [
            'archive_info.*',
            'branch_infos.name as station_name',
            'employees.emp_name',
            // DB::raw('archive_info.vhason_info->>"$.name" as program_name'),
            // DB::raw('archive_info.vhason_info->>"$.id" as vhason_id'),
            // DB::raw('archive_info.vhason_info->>"$.file_name" as file_name'),
            // DB::raw('archive_info.vhason_info->>"$.file_directory" as file_directory'),
        ];

        $where = ['archive_type' => 5, 'archive_info.is_active' => 1];
        $between  = false;
        $where_date  = false;
        if(!empty($request->created_by)) {
            $where['archive_info.created_by'] = (int) $request->created_by;
        }
        if(!empty($request->status)) {
            $where['archive_info.is_approve'] =  $request->status;
        }

        if(!empty($request->from_date) && !empty($request->to_date)) {

            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '>=' ,
                    'value'     => date("Y-m-d",strtotime($request->from_date))
                ],
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '<=' ,
                    'value'     => date("Y-m-d",strtotime($request->to_date))
                ]
            ];
        }
        elseif(!empty($request->from_date)){
            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '=' ,
                    'value'     => date("Y-m-d",strtotime($request->from_date))
                ]
            ];
        }
        elseif(!empty($request->to_date)){
            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '=' ,
                    'value'     => date("Y-m-d",strtotime($request->to_date))
                ]
            ];
        }
        $join_param = [
            [
                'table' => 'branch_infos',
                'on' => [
                    'first_param' => 'branch_infos.id',
                    'operator' => '=',
                    'second_param' => 'archive_info.station_id'
                ]
            ],
            [
                'table' => 'employees',
                'on' => [
                    'first_param' => 'employees.id',
                    'operator' => '=',
                    'second_param' => 'archive_info.created_by'
                ]
            ]
        ];

        $order_by = [
            [
                'field' => 'archive_info.created_by',
                'type'  => 'desc'
            ]
        ];

        $archive_list = Archive_model::get_rows("archive_info", $select, $where, $join_param,false,$where_date,$between,$order_by);

        $active_playlist = Archive_model::get_row("archive_playlist", ["*"], ['status' => 1, 'is_active' => 1]);

        $employee_info = Archive_model::get_rows("employees", ["*"], ['is_active'=>1]);
//        dd($archive_list);
        return view(
            'archive.item_review.vhason',
            [
                'page_title' => 'ভাষণ লিস্ট',
                'archive_list' => $archive_list,
                'employee_info' => $employee_info,
                'active_playlist' => $active_playlist
            ]
        );


    }


    public function archive_sakhhatkar_review(Request $request) {

        $select = [
            'archive_info.*',
            'branch_infos.name as station_name',
            'employees.emp_name',
            // DB::raw('archive_info.sakhhatkar_info->>"$.name" as program_name'),
            // DB::raw('archive_info.sakhhatkar_info->>"$.id" as vhason_id'),
            // DB::raw('archive_info.sakhhatkar_info->>"$.file_name" as file_name'),
            // DB::raw('archive_info.sakhhatkar_info->>"$.file_directory" as file_directory'),
        ];

        $where = ['archive_type' => 6, 'archive_info.is_active' => 1];
        $between  = false;
        $where_date  = false;
        if(!empty($request->created_by)) {
            $where['archive_info.created_by'] = (int) $request->created_by;
        }
        if(!empty($request->status)) {
            $where['archive_info.is_approve'] =  $request->status;
        }

        if(!empty($request->from_date) && !empty($request->to_date)) {

            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '>=' ,
                    'value'     => date("Y-m-d",strtotime($request->from_date))
                ],
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '<=' ,
                    'value'     => date("Y-m-d",strtotime($request->to_date))
                ]
            ];
        }
        elseif(!empty($request->from_date)){
            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '=' ,
                    'value'     => date("Y-m-d",strtotime($request->from_date))
                ]
            ];
        }
        elseif(!empty($request->to_date)){
            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '=' ,
                    'value'     => date("Y-m-d",strtotime($request->to_date))
                ]
            ];
        }
        $join_param = [
            [
                'table' => 'branch_infos',
                'on' => [
                    'first_param' => 'branch_infos.id',
                    'operator' => '=',
                    'second_param' => 'archive_info.station_id'
                ]
            ],
            [
                'table' => 'employees',
                'on' => [
                    'first_param' => 'employees.id',
                    'operator' => '=',
                    'second_param' => 'archive_info.created_by'
                ]
            ]
        ];

        $order_by = [
            [
                'field' => 'archive_info.created_by',
                'type'  => 'desc'
            ]
        ];

        $archive_list = Archive_model::get_rows("archive_info", $select, $where, $join_param,false,$where_date,$between,$order_by);

        $active_playlist = Archive_model::get_row("archive_playlist", ["*"], ['status' => 1, 'is_active' => 1]);

        $employee_info = Archive_model::get_rows("employees", ["*"], ['is_active'=>1]);
        return view(
            'archive.item_review.sakhhatkar',
            [
                'page_title' => 'সাক্ষাৎকার লিস্ট',
                'archive_list' => $archive_list,
                'employee_info' => $employee_info,
                'active_playlist' => $active_playlist
            ]
        );


    }


    public function archive_kothika_review(Request $request) {

        $select = [
            'archive_info.*',
            'branch_infos.name as station_name',
            'employees.emp_name',
            // DB::raw('archive_info.kothika_info->>"$.name" as program_name'),
            // DB::raw('archive_info.kothika_info->>"$.id" as vhason_id'),
            // DB::raw('archive_info.kothika_info->>"$.file_name" as file_name'),
            // DB::raw('archive_info.kothika_info->>"$.file_directory" as file_directory'),
        ];

        $where = ['archive_type' => 7, 'archive_info.is_active' => 1];
        $between  = false;
        $where_date  = false;
        if(!empty($request->created_by)) {
            $where['archive_info.created_by'] = (int) $request->created_by;
        }
        if(!empty($request->status)) {
            $where['archive_info.is_approve'] =  $request->status;
        }

        if(!empty($request->from_date) && !empty($request->to_date)) {

            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '>=' ,
                    'value'     => date("Y-m-d",strtotime($request->from_date))
                ],
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '<=' ,
                    'value'     => date("Y-m-d",strtotime($request->to_date))
                ]
            ];
        }
        elseif(!empty($request->from_date)){
            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '=' ,
                    'value'     => date("Y-m-d",strtotime($request->from_date))
                ]
            ];
        }
        elseif(!empty($request->to_date)){
            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '=' ,
                    'value'     => date("Y-m-d",strtotime($request->to_date))
                ]
            ];
        }
        $join_param = [
            [
                'table' => 'branch_infos',
                'on' => [
                    'first_param' => 'branch_infos.id',
                    'operator' => '=',
                    'second_param' => 'archive_info.station_id'
                ]
            ],
            [
                'table' => 'employees',
                'on' => [
                    'first_param' => 'employees.id',
                    'operator' => '=',
                    'second_param' => 'archive_info.created_by'
                ]
            ]
        ];

        $order_by = [
            [
                'field' => 'archive_info.created_by',
                'type'  => 'desc'
            ]
        ];

        $archive_list = Archive_model::get_rows("archive_info", $select, $where, $join_param,false,$where_date,$between,$order_by);

        $active_playlist = Archive_model::get_row("archive_playlist", ["*"], ['status' => 1, 'is_active' => 1]);

        $employee_info = Archive_model::get_rows("employees", ["*"], ['is_active'=>1]);
//        dd($archive_list);
        return view(
            'archive.item_review.kothika',
            [
                'page_title' => 'কথিকা লিস্ট',
                'archive_list' => $archive_list,
                'employee_info' => $employee_info,
                'active_playlist' => $active_playlist
            ]
        );


    }


    public function archive_procharona_review(Request $request) {

        $select = [
            'archive_info.*',
            'branch_infos.name as station_name',
            'employees.emp_name',
            // DB::raw('archive_info.procharona_info->>"$.name" as program_name'),
            // DB::raw('archive_info.procharona_info->>"$.id" as vhason_id'),
            // DB::raw('archive_info.procharona_info->>"$.file_name" as file_name'),
            // DB::raw('archive_info.procharona_info->>"$.file_directory" as file_directory'),
        ];

        $where = ['archive_type' => 8, 'archive_info.is_active' => 1];
        $between  = false;
        $where_date  = false;
        if(!empty($request->created_by)) {
            $where['archive_info.created_by'] = (int) $request->created_by;
        }
        if(!empty($request->status)) {
            $where['archive_info.is_approve'] =  $request->status;
        }

        if(!empty($request->from_date) && !empty($request->to_date)) {

            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '>=' ,
                    'value'     => date("Y-m-d",strtotime($request->from_date))
                ],
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '<=' ,
                    'value'     => date("Y-m-d",strtotime($request->to_date))
                ]
            ];
        }
        elseif(!empty($request->from_date)){
            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '=' ,
                    'value'     => date("Y-m-d",strtotime($request->from_date))
                ]
            ];
        }
        elseif(!empty($request->to_date)){
            $where_date = [
                [
                    'field'=>'archive_info.created_at',
                    'operator' => '=' ,
                    'value'     => date("Y-m-d",strtotime($request->to_date))
                ]
            ];
        }
        $join_param = [
            [
                'table' => 'branch_infos',
                'on' => [
                    'first_param' => 'branch_infos.id',
                    'operator' => '=',
                    'second_param' => 'archive_info.station_id'
                ]
            ],
            [
                'table' => 'employees',
                'on' => [
                    'first_param' => 'employees.id',
                    'operator' => '=',
                    'second_param' => 'archive_info.created_by'
                ]
            ]
        ];

        $order_by = [
            [
                'field' => 'archive_info.created_by',
                'type'  => 'desc'
            ]
        ];

        $archive_list = Archive_model::get_rows("archive_info", $select, $where, $join_param,false,$where_date,$between,$order_by);

        $active_playlist = Archive_model::get_row("archive_playlist", ["*"], ['status' => 1, 'is_active' => 1]);

        $employee_info = Archive_model::get_rows("employees", ["*"], ['is_active'=>1]);
//        dd($archive_list);
        return view(
            'archive.item_review.procharona',
            [
                'page_title' => 'প্রচারনা লিস্ট',
                'archive_list' => $archive_list,
                'employee_info' => $employee_info,
                'active_playlist' => $active_playlist
            ]
        );


    }


    public function dataMigrate(Request $request)
    {
        dd(Session::get('user_info'));
        dd('all complete');
        $archive_list = DB::table("temp_archieve_info")
            ->offset(151)
            ->limit(200)
            ->get();
        $data = [];
        DB::beginTransaction();
        foreach($archive_list as $key => $item) {
            $audio_info = explode("সিডি",$item->audio_info);
            $source_id = isset($audio_info[0]) ? $audio_info[0] : null;
            $source_name = isset($audio_info[1]) ? "সিডি".$audio_info[1] : null;
            $album_exist = DB::table("archive_albam")->where(['is_active'=>1,'type'=>1,'name'=>$source_name])->first();
            if(empty($album_exist)) {
                $album_insert = [
                    'type' =>1,
                    'name' =>$source_name,
                    'created_time' => date('Y-m-d H:i:s'),
                    'created_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                        ->employee_primary_id : NULL),
                    'created_ip' =>(!empty($this->getIp())) ? $this->getIp() : $request->ip(),
                ];
                DB::table("archive_albam")->insert($album_insert);
                $album_id = DB::getPdo()->lastInsertId();
            }
            else {
                $album_id = $album_exist->id;
            }

            $songit_info = [
                'name' => null,
                'song_department' => 1,
                'category' => 2,
                'sub_category' => null,
                'album_id' => $album_id,
                'participant' => null,
                'type_id' => null,
                'rating' => null,
                'hyperlink' => null,
                'stability' => $item->stability,
                'lyrics_document' => null,
                'lyrics' => null,
                'recording_date' => null,
                'first_broadcast_date' => null,
                'source_id' => $source_id,
                'source_id_name' => $source_name,
                'first_line' => $item->song_first_line,
                'file_name' => $source_id,
                'file_directory' => 'archive/song',
                'id' => null,
                'instument_artist' => null,
                'film_info' => null,
                'band_id' => null,
            ];

            // artist expertise 20
//         $artist = DB::select("SELECT CONCAT(program_artist_info.name_bn, ' - ',program_artist_info.mobile) AS text, program_artist_info.id,program_artist_info.artist_expertise_info
//         FROM program_artist_info WHERE (name_bn like '%$item->artist_name_bn%' or name like '%$item->artist_name_bn%') and
//         is_active=1
//        AND  (  JSON_CONTAINS(artist_expertise_info->'$[*].expertise', json_array('20')) ) ORDER BY program_artist_info.name_bn ASC limit 1");

            $artist = DB::select("SELECT CONCAT(program_artist_info.name_bn, ' - ',program_artist_info.mobile) AS text, program_artist_info.id,program_artist_info.artist_expertise_info
         FROM program_artist_info WHERE (name_bn like '%$item->artist_name_bn%' OR name like '%$item->artist_name_bn%') AND  is_active=1 ORDER BY program_artist_info.name_bn ASC limit 1");

            $gitikar = DB::select("SELECT CONCAT(program_artist_info.name_bn, ' - ',program_artist_info.mobile) AS text, program_artist_info.id,program_artist_info.artist_expertise_info
         FROM program_artist_info WHERE (name_bn like '%$item->gitikgar_surokar%' or name like '%$item->gitikgar_surokar%') AND  is_active=1 ORDER BY program_artist_info.name_bn ASC limit 1");

            if(empty($artist)) {
                $artist_insert = [
                    'station_id' => $item->station_id,
                    'entry_date' => date("Y-m-d"),
                    'name' => $item->artist_name_bn,
                    'name_bn' => $item->artist_name_bn,
                    'artist_doptor' => 1,
                    'created_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                        ->employee_primary_id : NULL),
                    'created_time' => date('Y-m-d H:i:s'),
                    'created_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip(),
                    'artist_expertise_info' => '[{"expertise":"20","expertise_dept":"171","expertise_grade":"2","is_active":1,"created_by":1,"created_time":"2019-09-24 06:19:51","created_ip":"202.191.122.123"}]',
                ];

                DB::table("program_artist_info")->insert($artist_insert);

                $artist_id = DB::getPdo()->lastInsertId();
            }
            else {
                $artist_id = $artist[0]->id;
                $expertise_info = json_decode($artist[0]->artist_expertise_info,true);
                $expertise_array = array_column($expertise_info,'expertise');
                if(!in_array(20, $expertise_array)) {
                    $expertise_info[] = [
                        "expertise" => 20,
                        "expertise_dept" => 171,
                        "expertise_grade" => 2,
                        "is_active" => 1,
                        "created_by" => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                            ->employee_primary_id : NULL),
                        "created_time" => date('Y-m-d H:i:s'),
                        "created_ip" => (!empty($this->getIp())) ? $this->getIp() : $request->ip(),
                    ];

                    DB::table("program_artist_info")
                        ->where('id',$artist_id)
                        ->update(['artist_expertise_info'=>json_encode($expertise_info)]);

                }
            }

            if(empty($gitikar)) {
                $artist_insert = [
                    'station_id' => $item->station_id,
                    'entry_date' => date("Y-m-d"),
                    'name' => $item->gitikgar_surokar,
                    'name_bn' => $item->gitikgar_surokar,
                    'artist_doptor' => 1,
                    'created_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                        ->employee_primary_id : NULL),
                    'created_time' => date('Y-m-d H:i:s'),
                    'created_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip(),
                    'artist_expertise_info' => '[{"expertise":"460","expertise_dept":null,"expertise_grade":"2","is_active":1,"created_by":1,"created_time":"2019-09-24 06:19:51","created_ip":"202.191.122.123"},{"expertise":"459","expertise_dept":null,"expertise_grade":"2","is_active":1,"created_by":1,"created_time":"2019-09-24 06:19:51","created_ip":"202.191.122.123"}]',
                ];

                DB::table("program_artist_info")->insert($artist_insert);
                $gitikar_id = DB::getPdo()->lastInsertId();
            }
            else {
                $gitikar_id = $gitikar[0]->id;
                if(!empty($gitikar[0]->artist_expertise_info)) {
                $expertise_info = json_decode($gitikar[0]->artist_expertise_info,true);
                $expertise_array = array_column($expertise_info,'expertise');
                if(!in_array(460, $expertise_array)) {
                    $expertise_info[] = [
                        "expertise" => 460,
                        "expertise_dept" => null,
                        "expertise_grade" => 2,
                        "is_active" => 1,
                        "created_by" => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                            ->employee_primary_id : NULL),
                        "created_time" => date('Y-m-d H:i:s'),
                        "created_ip" => (!empty($this->getIp())) ? $this->getIp() : $request->ip(),
                    ];

                }
                if(!in_array(459, $expertise_array)) {
                    $expertise_info[] = [
                        "expertise" => 459,
                        "expertise_dept" => null,
                        "expertise_grade" => 2,
                        "is_active" => 1,
                        "created_by" => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                            ->employee_primary_id : NULL),
                        "created_time" => date('Y-m-d H:i:s'),
                        "created_ip" => (!empty($this->getIp())) ? $this->getIp() : $request->ip(),
                    ];

                }

                DB::table("program_artist_info")
                    ->where('id',$gitikar_id)
                    ->update(['artist_expertise_info'=>json_encode($expertise_info)]);
                }
                else {
                    DB::table("program_artist_info")
                        ->where('id',$gitikar_id)
                        ->update(['artist_expertise_info'=>'[{"expertise":"460","expertise_dept":null,"expertise_grade":"2","is_active":1,"created_by":1,"created_time":"2019-09-24 06:19:51","created_ip":"202.191.122.123"},{"expertise":"459","expertise_dept":null,"expertise_grade":"2","is_active":1,"created_by":1,"created_time":"2019-09-24 06:19:51","created_ip":"202.191.122.123"}]']);
                }

            }

            // gitikar expertise 460
            // surokar expertise 330

//          [{"expertise":"20","expertise_dept":"211","expertise_grade":"2","is_active":1,"created_by":1,"created_time":"2019-09-24 06:19:51","created_ip":"202.191.122.123"}]

            $songit_info['artist'] = [$artist_id];
            $songit_info['main_artist'] = [$artist_id];
            $songit_info['gitikar'] = [$gitikar_id];
            $songit_info['surokar'] = [$gitikar_id];
            $songit_info['song_director'] = null;
            $songit_info['song_producer'] = null;
            $songit_info['recordist'] = null;
            $songit_info['sound_editors'] = null;
            $songit_info['plan_maker'] = null;
            $songit_info['codinator'] = null;
            $songit_info['producer'] = null;
            $songit_info['assistent_producer'] = null;
            $songit_info['sompadona'] = null;
            $songit_info['direction'] = null;

            $data[] =  [
                'archive_type' => 1,
                'station_id' => $item->station_id,
                'sadin_bangla_betar' => 0,
                'created_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                    ->employee_primary_id : NULL),
                'created_at' => date('Y-m-d H:i:s'),
                'created_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip(),
                'songit_info' => json_encode($songit_info, JSON_UNESCAPED_UNICODE),
            ];

        }

        DB::table("archive_info")->insert($data);

        DB::commit();

        dd('data migrate successfully');

    }


}
