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
use Intervention\Image\ImageManagerStatic as Image;


class ArchiveSettingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
//        $global_where = 'to_be_used_by_user_id'.','. '!=' .','. '2';
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

    public function archive_song_type() {
        $whereData = [
            ['type', 1],
            ['is_active', '<>', 0]
        ];
        $result_info = Archive_model::get_rows('archive_archiveing_type',["*"],$whereData);
        return view('archive.setting.song_type',
        [
            'items' => $result_info,
            'page_title' => 'সংগীতের ধরন',
        ]);
    }

    public function archive_kobita_type() {
        $whereData = [
            ['type', 2],
            ['is_active', '<>', 0]
        ];

        $result_info = Archive_model::get_rows('archive_archiveing_type',["*"],$whereData);
        return view('archive.setting.kobita_type',
            [
                'items' => $result_info,
                'page_title' => 'কবিতার ধরন',
            ]);
    }

    public function archive_natok_type() {
        $whereData = [
            ['type', 3],
            ['is_active', '<>', 0]
        ];
        $result_info = Archive_model::get_rows('archive_archiveing_type',["*"],$whereData);
        return view('archive.setting.natok_type',
            [
                'items' => $result_info,
                'page_title' => 'নাটকের ধরন',
            ]);
    }

    public function archive_film_type() {
        $whereData = [
            ['type', 4],
            ['is_active', '<>', 0]
        ];
        $result_info = Archive_model::get_rows('archive_archiveing_type',["*"],$whereData);
        return view('archive.setting.film_type',
            [
                'items' => $result_info,
                'page_title' => 'ছায়াছবির ধরন',
            ]);
    }

    public function archive_band_type() {
        $whereData = [
            ['type', 5],
            ['is_active', '<>', 0]
        ];
        $result_info = Archive_model::get_rows('archive_archiveing_type',["*"],$whereData);
        return view('archive.setting.band_type',
            [
                'items' => $result_info,
                'page_title' => 'ব্যন্ডের ধরন',
            ]);
    }

    public function save_archive_type(Request $request) {

        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'type'  => 'required',
            'is_active'  => 'required'
        ]);
        $error_array = array();
        $success_output = '';
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }else {
            if (empty($request->setting_id)) {
                 DB::table('archive_archiveing_type')
                    ->insert(
                        [
                            'type' => $request->type,
                            'name' => $request->name,
                            'is_active' => $request->is_active,
                            'created_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                                ->employee_primary_id : NULL),
                            'created_time' => date('Y-m-d H:i:s'),
                            'created_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip()
                        ]
                    );
                $success_output = 'Successfully add Information';
            } else {
                DB::table('archive_archiveing_type')
                    ->where('id', $request->setting_id)
                    ->update(
                        [
                            'type' => $request->type,
                            'name' => $request->name,
                            'is_active' => $request->is_active,
                            'updated_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                                ->employee_primary_id : NULL),
                            'updated_time' => date('Y-m-d H:i:s'),
                            'updated_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip()
                        ]
                    );
                $success_output = 'Successfully update Information';
            }
        }
        $output = array(
            'error'             =>  $error_array,
            'success'           =>  $success_output,
            'redirect_page'     =>  ''
        );
        echo json_encode($output);
    }

    public function archive_type_delete(Request $request) {
        DB::table('archive_archiveing_type')
            ->where('id', $request->id)
            ->update(
                [
                    'is_active' => 0,
                    'updated_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                        ->employee_primary_id : NULL),
                    'updated_time' => date('Y-m-d H:i:s'),
                    'updated_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip()
                ]
            );
        $success_output = 'Successfully Delete Information';
        $output = array(
            'error'             =>  '',
            'success'           =>  $success_output,
            'redirect_page'     =>  ''
        );
        echo json_encode($output);
    }

    public function save_archive_category(Request $request) {
//        dd($request);
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'type'  => 'required',
            'is_active'  => 'required'
        ]);

        if(isset($request->parent_id)) {
            $validation = Validator::make($request->all(), [
                'parent_id' => 'required',
                'name' => 'required',
                'type'  => 'required',
                'is_active'  => 'required'
            ]);
        }

        $error_array = array();
        $success_output = '';
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }else {
            if (empty($request->setting_id)) {
                DB::table('archive_category')
                    ->insert(
                        [
                            'type' => $request->type,
                            'name' => $request->name,
                            'parent_id' => !empty($request->parent_id)?$request->parent_id:0,
                            'has_parent' => !empty($request->parent_id)?1:0,
                            'is_active' => $request->is_active,
                            'created_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                                ->employee_primary_id : NULL),
                            'created_time' => date('Y-m-d H:i:s'),
                            'created_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip()
                        ]
                    );
                $success_output = 'Successfully add Information';
            } else {
                DB::table('archive_category')
                    ->where('id', $request->setting_id)
                    ->update(
                        [
                            'type' => $request->type,
                            'name' => $request->name,
                            'parent_id' => !empty($request->parent_id)?$request->parent_id:0,
                            'has_parent' => !empty($request->parent_id)?1:0,
                            'is_active' => $request->is_active,
                            'updated_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                                ->employee_primary_id : NULL),
                            'updated_time' => date('Y-m-d H:i:s'),
                            'updated_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip()
                        ]
                    );
                $success_output = 'Successfully update Information';
            }
        }
        $output = array(
            'error'             =>  $error_array,
            'success'           =>  $success_output,
            'redirect_page'     =>  ''
        );
        echo json_encode($output);
    }

    public function save_archive_ministry(Request $request) {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'is_active'  => 'required'
        ]);

        if(isset($request->parent_id)) {
            $validation = Validator::make($request->all(), [
                'parent_id' => 'required',
                'name' => 'required',
                'is_active'  => 'required'
            ]);
        }

        $error_array = array();
        $success_output = '';
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }else {
            if (empty($request->setting_id)) {
                DB::table('archive_ministry')
                    ->insert(
                        [
                            'name' => $request->name,
                            'parent_id' => !empty($request->parent_id)?$request->parent_id:0,
                            'has_parent' => !empty($request->parent_id)?1:0,
                            'is_active' => $request->is_active,
                            'created_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                                ->employee_primary_id : NULL),
                            'created_time' => date('Y-m-d H:i:s'),
                            'created_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip()
                        ]
                    );
                $success_output = 'Successfully add Information';
            } else {
                DB::table('archive_ministry')
                    ->where('id', $request->setting_id)
                    ->update(
                        [
                            'name' => $request->name,
                            'parent_id' => !empty($request->parent_id)?$request->parent_id:0,
                            'has_parent' => !empty($request->parent_id)?1:0,
                            'is_active' => $request->is_active,
                            'updated_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                                ->employee_primary_id : NULL),
                            'updated_time' => date('Y-m-d H:i:s'),
                            'updated_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip()
                        ]
                    );
                $success_output = 'Successfully update Information';
            }
        }
        $output = array(
            'error'             =>  $error_array,
            'success'           =>  $success_output,
            'redirect_page'     =>  ''
        );
        echo json_encode($output);
    }

    public function archive_category_delete(Request $request) {
        DB::table('archive_category')
            ->where('id', $request->id)
            ->update(
                [
                    'is_active' => 0,
                    'updated_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                        ->employee_primary_id : NULL),
                    'updated_time' => date('Y-m-d H:i:s'),
                    'updated_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip()
                ]
            );
        $success_output = 'Successfully Delete Information';
        $output = array(
            'error'             =>  '',
            'success'           =>  $success_output,
            'redirect_page'     =>  ''
        );
        echo json_encode($output);
    }


    public function archive_natok_category() {
        $whereData = [
            ['type', 3],
            ['is_active', '<>', 0]
        ];
        $result_info = Archive_model::get_rows('archive_category',["*"],$whereData);
        return view('archive.setting.natok_category',
            [
                'items' => $result_info,
                'page_title' => 'নাটকের প্রকার',
            ]);
    }

    public function archive_program_category() {
        $whereData = [
            ['type', 4],
            ['is_active', '<>', 0]
        ];
        $result_info = Archive_model::get_rows('archive_category',["*"],$whereData);
        return view('archive.setting.program_category',
            [
                'items' => $result_info,
                'page_title' => 'অনুষ্ঠানের প্রকার',
            ]);
    }

    public function archive_vhason_category() {
        $whereData = [
            ['type', 5],
            ['is_active', '<>', 0]
        ];
        $result_info = Archive_model::get_rows('archive_category',["*"],$whereData);
        return view('archive.setting.vhason_category',
            [
                'items' => $result_info,
                'page_title' => 'ভাষণের প্রকার',
            ]);
    }

    public function archive_sakhhatkar_category() {
        $whereData = [
            ['type', 6],
            ['is_active', '<>', 0]
        ];
        $result_info = Archive_model::get_rows('archive_category',["*"],$whereData);
        return view('archive.setting.sakhhatkar_category',
            [
                'items' => $result_info,
                'page_title' => 'সাক্ষাৎকারের প্রকার',
            ]);
    }

    public function archive_song_category() {
        $whereData = [
            ['type', 1],
            ['has_parent', 0],
            ['is_active', '<>', 0]
        ];
        $result_info = Archive_model::get_rows('archive_category',["*"],$whereData);
        return view('archive.setting.song_category',
            [
                'items' => $result_info,
                'page_title' => 'সংগীতের প্রকার',
            ]);
    }


    public function archive_ministry() {
        $whereData = [
            ['has_parent', 0],
            ['is_active', '<>', 0]
        ];
        $result_info = Archive_model::get_rows('archive_ministry',["*"],$whereData);
        return view('archive.setting.ministry',
            [
                'items' => $result_info,
                'page_title' => 'মন্ত্রণালয়',
            ]);
    }

    public function archive_song_sub_category() {
        $whereData = [
            ['sub_category.type', 1],
            ['sub_category.has_parent','>', 0],
            ['sub_category.is_active', '<>', 0]
        ];
        $join_param = [
            [
                'table' => 'archive_category as category',
                'on' => [
                    'first_param' => 'category.id',
                    'operator' => '=',
                    'second_param' => 'sub_category.parent_id'
                ]
            ],
        ];
        $result_info = Archive_model::get_rows('archive_category as sub_category',["sub_category.*","category.name as song_category"],$whereData,$join_param);
        $whereData = [
            ['type', 1],
            ['has_parent','<', 1],
            ['is_active', '<>', 0]
        ];
        $songit_info = Archive_model::get_rows('archive_category',["*"],$whereData);
        return view('archive.setting.song_sub_category',
            [
                'items' => $result_info,
                'parent_items' => $songit_info,
                'page_title' => 'সংগীতের উপ প্রকার',
                'main_title' => 'সংগীতের প্রকার',
            ]);
    }

    public function archive_doptor() {
        $whereData = [
            ['sub_category.has_parent','>', 0],
            ['sub_category.is_active', '<>', 0]
        ];
        $join_param = [
            [
                'table' => 'archive_ministry as category',
                'on' => [
                    'first_param' => 'category.id',
                    'operator' => '=',
                    'second_param' => 'sub_category.parent_id'
                ]
            ],
        ];
        $result_info = Archive_model::get_rows('archive_ministry as sub_category',["sub_category.*","category.name as song_category"],$whereData,$join_param);
        $whereData = [
            ['has_parent','<', 1],
            ['is_active', '<>', 0]
        ];
        $songit_info = Archive_model::get_rows('archive_ministry',["*"],$whereData);
        return view('archive.setting.doptor',
            [
                'items' => $result_info,
                'parent_items' => $songit_info,
                'page_title' => 'মন্ত্রণালয় দপ্তর',
                'main_title' => 'মন্ত্রণালয়',
            ]);
    }


    public function archive_source() {
        $whereData = [
            ['is_active', '<>', 0]
        ];
        $result_info = Archive_model::get_rows('archive_song_source',["*"],$whereData);
        return view('archive.setting.source',
            [
                'items' => $result_info,
                'page_title' => 'আর্কাইভ সোর্স',
            ]);
    }

    public function save_archive_source(Request $request) {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'is_active'  => 'required'
        ]);
        $error_array = array();
        $success_output = '';
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }else {
            if (empty($request->setting_id)) {
                DB::table('archive_song_source')
                    ->insert(
                        [
                            'name' => $request->name,
                            'is_active' => $request->is_active,
                            'created_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                                ->employee_primary_id : NULL),
                            'created_time' => date('Y-m-d H:i:s'),
                            'created_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip()
                        ]
                    );
                $success_output = 'Successfully add Information';
            } else {
                DB::table('archive_song_source')
                    ->where('id', $request->setting_id)
                    ->update(
                        [
                            'name' => $request->name,
                            'is_active' => $request->is_active,
                            'updated_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                                ->employee_primary_id : NULL),
                            'updated_time' => date('Y-m-d H:i:s'),
                            'updated_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip()
                        ]
                    );
                $success_output = 'Successfully update Information';
            }
        }
        $output = array(
            'error'             =>  $error_array,
            'success'           =>  $success_output,
            'redirect_page'     =>  ''
        );
        echo json_encode($output);
    }

    public function archive_instument() {
        $whereData = [
            ['is_active', '<>', 0]
        ];
        $result_info = Archive_model::get_rows('archive_instument',["*"],$whereData);
        return view('archive.setting.instument',
            [
                'items' => $result_info,
                'page_title' => 'বাদ্য যন্ত্র',
            ]);
    }

    public function archive_angik() {
        $whereData = [
            ['is_active', '<>', 0]
        ];
        $result_info = Archive_model::get_rows('archive_angik',["*"],$whereData);
        return view('archive.setting.angik',
            [
                'items' => $result_info,
                'page_title' => 'আঙ্গিক',
            ]);
    }

    public function save_archive_instument(Request $request) {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'is_active'  => 'required'
        ]);
        $error_array = array();
        $success_output = '';
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }else {
            if (empty($request->setting_id)) {
                DB::table('archive_instument')
                    ->insert(
                        [
                            'name' => $request->name,
                            'is_active' => $request->is_active,
                            'created_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                                ->employee_primary_id : NULL),
                            'created_time' => date('Y-m-d H:i:s'),
                            'created_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip()
                        ]
                    );
                $success_output = 'Successfully add Information';
            } else {
                DB::table('archive_instument')
                    ->where('id', $request->setting_id)
                    ->update(
                        [
                            'name' => $request->name,
                            'is_active' => $request->is_active,
                            'updated_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                                ->employee_primary_id : NULL),
                            'updated_time' => date('Y-m-d H:i:s'),
                            'updated_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip()
                        ]
                    );
                $success_output = 'Successfully update Information';
            }
        }
        $output = array(
            'error'             =>  $error_array,
            'success'           =>  $success_output,
            'redirect_page'     =>  ''
        );
        echo json_encode($output);
    }

    public function save_archive_angik(Request $request) {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'is_active'  => 'required'
        ]);
        $error_array = array();
        $success_output = '';
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }else {
            if (empty($request->setting_id)) {
                DB::table('archive_angik')
                    ->insert(
                        [
                            'name' => $request->name,
                            'is_active' => $request->is_active,
                            'created_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                                ->employee_primary_id : NULL),
                            'created_time' => date('Y-m-d H:i:s'),
                            'created_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip()
                        ]
                    );
                $success_output = 'Successfully add Information';
            } else {
                DB::table('archive_angik')
                    ->where('id', $request->setting_id)
                    ->update(
                        [
                            'name' => $request->name,
                            'is_active' => $request->is_active,
                            'updated_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                                ->employee_primary_id : NULL),
                            'updated_time' => date('Y-m-d H:i:s'),
                            'updated_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip()
                        ]
                    );
                $success_output = 'Successfully update Information';
            }
        }
        $output = array(
            'error'             =>  $error_array,
            'success'           =>  $success_output,
            'redirect_page'     =>  ''
        );
        echo json_encode($output);
    }

    public function archive_band() {
        $whereData = [
            ['is_active', '<>', 0]
        ];
        $result_info = Archive_model::get_rows('archive_band',["*"],$whereData);
        $whereData = [
            ['is_active', '<>', 0],
            ['type', 5],
        ];
        $band_type = Archive_model::get_rows('archive_archiveing_type',["*"],$whereData);
        return view('archive.setting.band',
            [
                'items' => $result_info,
                'band_types' => $band_type,
                'page_title' => 'ব্যন্ড',
            ]);
    }

    public function archive_song_album()
    {
        $whereData = [
            ['is_active', '<>', 0],
            ['type', 1],
        ];
        $result_info = Archive_model::get_rows('archive_albam',["*"],$whereData);
        return view('archive.setting.albam',
        [
                'items' => $result_info,
                'page_title' => 'সংগীত এ্যালবাম',
        ]);
    }

    public function archive_kobita_album()
    {
        $whereData = [
            ['is_active', '<>', 0],
            ['type', 2],
        ];
        $result_info = Archive_model::get_rows('archive_albam',["*"],$whereData);
        return view('archive.setting.kobita_album',
            [
                'items' => $result_info,
                'page_title' => 'কবিতা এ্যালবাম',
            ]);
    }

    public function save_archive_album(Request $request) {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'prokashok' => 'required',
            'publish_date' => 'required',
            'is_active'  => 'required'
        ]);
        $error_array = array();
        $success_output = '';
        if ($validation->fails()) {
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }else {
            if (empty($request->setting_id)) {
                DB::table('archive_albam')
                    ->insert(
                        [
                            'name' => $request->name,
                            'prokasok' => $request->prokashok,
                            'publish_date' => date("Y-m-d",strtotime($request->publish_date)),
                            'type' => $request->type,
                            'is_active' => $request->is_active,
                            'created_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                                ->employee_primary_id : NULL),
                            'created_time' => date('Y-m-d H:i:s'),
                            'created_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip()
                        ]
                    );
                $success_output = 'Successfully add Information';
            } else {
                DB::table('archive_albam')
                    ->where('id', $request->setting_id)
                    ->update(
                        [
                            'name' => $request->name,
                            'prokasok' => $request->prokashok,
                            'publish_date' =>  date("Y-m-d",strtotime($request->publish_date)),
                            'type' => $request->type,
                            'is_active' => $request->is_active,
                            'updated_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                                ->employee_primary_id : NULL),
                            'updated_time' => date('Y-m-d H:i:s'),
                            'updated_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip()
                        ]
                    );
                $success_output = 'Successfully update Information';
            }
        }
        $output = array(
            'error'             =>  $error_array,
            'success'           =>  $success_output,
            'redirect_page'     =>  ''
        );
        echo json_encode($output);
    }

    public function archive_album_delete(Request $request) {
        DB::table('archive_albam')
            ->where('id', $request->id)
            ->update(
                [
                    'is_active' => 0,
                    'updated_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                        ->employee_primary_id : NULL),
                    'updated_time' => date('Y-m-d H:i:s'),
                    'updated_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip()
                ]
            );
        $success_output = 'Successfully Delete Information';
        $output = array(
            'error'             =>  '',
            'success'           =>  $success_output,
            'redirect_page'     =>  ''
        );
        echo json_encode($output);
    }

    public function save_archive_band(Request $request) {

        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'band_type' => 'required',
            'is_active'  => 'required'
        ]);
        $error_array = array();
        $success_output = '';
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }else {
            if (empty($request->setting_id)) {
                DB::table('archive_band')
                    ->insert(
                        [
                            'name' => $request->name,
                            'is_active' => $request->is_active,
                            'band_type' => $request->band_type,
                            'establish_year' => $request->establish_year,
                            'created_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                                ->employee_primary_id : NULL),
                            'created_time' => date('Y-m-d H:i:s'),
                            'created_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip()
                        ]
                    );
                $success_output = 'Successfully add Information';
            } else {
                DB::table('archive_band')
                    ->where('id', $request->setting_id)
                    ->update(
                        [
                            'name' => $request->name,
                            'is_active' => $request->is_active,
                            'band_type' => $request->band_type,
                            'establish_year' => $request->establish_year,
                            'updated_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                                ->employee_primary_id : NULL),
                            'updated_time' => date('Y-m-d H:i:s'),
                            'updated_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip()
                        ]
                    );
                $success_output = 'Successfully update Information';
            }
        }
        $output = array(
            'error'             =>  $error_array,
            'success'           =>  $success_output,
            'redirect_page'     =>  ''
        );
        echo json_encode($output);
    }

    public function archive_band_delete(Request $request) {
        DB::table('archive_band')
            ->where('id', $request->id)
            ->update(
                [
                    'is_active' => 0,
                    'updated_by' => (!empty(Session::get('user_info')->employee_primary_id) ? Session::get('user_info')
                        ->employee_primary_id : NULL),
                    'updated_time' => date('Y-m-d H:i:s'),
                    'updated_ip' => (!empty($this->getIp())) ? $this->getIp() : $request->ip()
                ]
            );
        $success_output = 'Successfully Delete Information';
        $output = array(
            'error'             =>  '',
            'success'           =>  $success_output,
            'redirect_page'     =>  ''
        );
        echo json_encode($output);
    }

}
