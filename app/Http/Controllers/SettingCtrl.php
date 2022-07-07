<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\All_stting;
use App\Company_info;
use App\Branch_info;
use App\Product_info;
use App\Program_schedule_info;
use App\Employee;
use App\User;
use Validator;
use Session;
use Intervention\Image\ImageManagerStatic as Image;

class SettingCtrl extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function department_setup(){
        $setup_info = All_stting::get_all_settings_info(['type'=>1]);
        return view('setting.department_setup',['setup_info' => $setup_info]);
    }
    public function designation_setup(){
        $setup_info = All_stting::get_all_settings_info(['type'=>2]);
        return view('setting.designation_setup',['setup_info' => $setup_info]);
    }
    public function edu_degree_setup(){
        $setup_info = All_stting::get_all_settings_info(['type'=>3]);
        return view('setting.edu_degree_setup',['setup_info' => $setup_info]);
    }
    public function nationality_setup(){
        $setup_info = All_stting::get_all_settings_info(['type'=>4]);
        return view('setting.nationality_setup',['setup_info' => $setup_info]);
    }
    public function leave_type_setup(){
        $setup_info = All_stting::get_all_settings_info(['type'=>5]);
        return view('setting.leave_type_setup',['setup_info' => $setup_info]);
    }
    public function program_ctg_setup(){
        $setup_info = All_stting::get_all_settings_info(['type'=>6]);
        return view('setting.program_ctg_setup',['setup_info' => $setup_info]);
    }
    public function program_type_setup(){
        $setup_info = All_stting::get_all_settings_info(['type'=>14]);
        return view('setting.program_type_setup',['setup_info' => $setup_info]);
    }
    public function program_style_setup(){
        $setup_info = All_stting::get_all_settings_info(['type'=>15]);
        return view('setting.program_style_setup',['setup_info' => $setup_info]);
    }


    public function artist_honouriam_sub_ctg(){
        $parent_setup_info = All_stting::get_all_settings_info(['type'=>15]);
        $setup_info = All_stting::get_all_settings_info_sub_ctg(['all_sttings.type'=>19]);
        return view('setting.artist_honouriam_sub_ctg',['setup_info' => $setup_info,'parent_setup_info' => $parent_setup_info,]);
    }
    public function artist_expertise_department(){
        $parent_setup_info = All_stting::get_all_settings_info(['type'=>6]);
        $setup_info = All_stting::get_all_settings_info_sub_ctg(['all_sttings.type'=>20]);
        return view('setting.artist_expertise_department',['setup_info' => $setup_info,'parent_setup_info' => $parent_setup_info,]);
    }
    public function show_expertise_department(request $request){
        $artist_expertise_department= All_stting::get_settings_info(['parent_id'=>$request->expertise_val,'is_active'=>1]);
        if(!empty($artist_expertise_department)){
            echo json_encode(['status'=>'success','data'=>$artist_expertise_department]);
        }else{
            echo json_encode(['status'=>'error','data'=>'']);
        }
    }
    public function artist_honouriam_discription(request $request){
        $artist_honouriam_discription= All_stting::get_settings_info_exist_grade(['parent_id'=>$request->artist_honouriam_id,
            'all_sttings.is_active'=>1]);
          
        if(!empty($artist_honouriam_discription)){
            echo json_encode(['status'=>'success','data'=>$artist_honouriam_discription]);
        }else{
            echo json_encode(['status'=>'error','data'=>'']);
        }
    }
     public function artist_honouriam_discription_grade(request $request){
        $artist_honouriam_discription= All_stting::artist_grade_description(['description'=>$request->chart_description,
            'is_active'=>1]);
        if(!empty($artist_honouriam_discription)){
            echo json_encode(['status'=>'success','data'=>$artist_honouriam_discription]);
        }else{
            echo json_encode(['status'=>'error','data'=>'']);
        }
    }


    public function artist_national_awared_setup(){
        $setup_info = All_stting::get_all_settings_info(['type'=>21]);
        return view('setting.artist_national_awared_setup',['setup_info' => $setup_info]);
    }
    public function artist_work_station(){
        $setup_info = All_stting::get_all_settings_info(['type'=>18]);
        return view('setting.artist_work_station',['setup_info' => $setup_info]);
    }
    public function artist_occupation(){
        $setup_info = All_stting::get_all_settings_info(['type'=>22]);
        return view('setting.artist_occupation',['setup_info' => $setup_info]);
    }


     public function program_description_setup(){
        $setup_info = All_stting::get_all_settings_info(['type'=>16]);
        return view('setting.program_description_setup',['setup_info' => $setup_info]);
    }


    
    
    
    public function deduction_ctg_setup(){
        $setup_info = All_stting::get_all_settings_info(['type'=>7]);
        return view('setting.deduction_ctg_setup',['setup_info' => $setup_info]);
    }
    public function earning_ctg_setup(){
        $setup_info = All_stting::get_all_settings_info(['type'=>8]);
        return view('setting.earning_ctg_setup',['setup_info' => $setup_info]);
    }
    public function bank_info_setup(){
        $setup_info = All_stting::get_all_settings_info(['type'=>9]);
        return view('setting.bank_info_setup',['setup_info' => $setup_info]);
    }

    public function save_setup_type(request $request){
        $validation = Validator::make($request->all(), [
            'title' => 'required',
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
                $setting_entry = new All_stting();
                $setting_entry->type = $request->type;
            } else {
                $setting_entry = All_stting::find($request->setting_id);
            }
            DB::beginTransaction();

            $setting_entry->title = $request->title;
            $setting_entry->is_active = $request->is_active;
            $setting_entry->parent_id = (isset($request->product_ctg) && !empty($request->product_ctg))?$request->product_ctg:NULL;
            $setting_entry->display_position = (isset($request->display_position) && !empty($request->display_position))?$request->display_position:NULL;
            $setting_entry->save();
            DB::commit();
            if (empty($request->setting_id)) {
                $success_output = 'Successfully add Information';
            } else {
                $success_output = 'Successfully update Information';
            }
        }
        $output = array(
            'error'             =>  $error_array,
            'success'           =>  $success_output,
            'redirect_page'     =>  $request->redirect_page
        );
        echo json_encode($output);
    }





    public function setup_type_delete(request $request){
        $setup_info = All_stting::find($request->id);
        $setup_info->is_active=0;
        $setup_info->save();
        if (!empty($request->id)) {
            return json_encode(['status' => 'success', 'message' => 'Successfully, delete information']);
        } else {
            return json_encode(['status' => 'error', 'message' => 'Failed, delete information']);
        }
    }
    public function company_info(){
        $company_info = Company_info::find(6);
        return view('setting.company_info',['company_data'=>$company_info]);
    }
    public function company_info_update(request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('company_info')->with('message', 'Name is required');
        }

        $destinationPath = 'images/logo';
        if(!empty($request->file('image'))) {
            $image = $request->file('image');


            $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(10, 10);


            $file_name = "logo" . "." . $extension;
            $image->move($destinationPath, $file_name);

        }elseif($request->old_image !=''){
            $file_name=$request->old_image;
        }else{
            $file_name='';
        }


        $setting_entry = Company_info::find($request->setting_id);
        $setting_entry->com_name = $request->name ;
        $setting_entry->apps_name = $request->apps_name;
        $setting_entry->address = $request->address;
        $setting_entry->email = $request->email;
        $setting_entry->mobile = $request->mobile;
        $setting_entry->helpline = $request->helpline;
        $setting_entry->apps_link = $request->apps_link;
        $setting_entry->web_address = $request->web_address;
        $setting_entry->default_email_send = $request->default_email_send;
        $setting_entry->company_logo =$file_name;
        $setting_entry->com_date = date('Y-m-d H:i:s');

        $setting_entry->save();
        return redirect('company_info')->with('message', 'Successfully update company Information');

    }

// branch setup
    public function branch_setup()
    {
         $branch_info = Branch_info::get_all_branch_info();
        return view('setting.branch_setup', ['branch_info' => $branch_info]);
    }
    public function get_branch_info(request $request)
    {
        $branch_info = Branch_info::find($request->id);
        $branch_info->sub_station_info = Branch_info::get_all_sub_station_info(['parent_id'=>$request->id]);
        return json_encode(['status'=>'success','data'=>$branch_info]);
    }

    public function save_branch_setup(request $request)
    {

        if (empty($request->setting_id)) {
            $Branch_entry = new Branch_info();
        } else {
            $Branch_entry = Branch_info::find($request->setting_id);
        }

        $Branch_entry->name = $request->branch_name;
        $Branch_entry->mobile = $request->mobile;
        $Branch_entry->email = $request->email;
        $Branch_entry->address = $request->address;
        $Branch_entry->is_active = $request->status;
        $Branch_entry->sorting = $request->position;
        $Branch_entry->created_by = (!empty(Auth::user()->id) ? Auth::user()->id : NULL);
        $Branch_entry->created_at = date('Y-m-d H:i:s');
        $Branch_entry->created_ip = $request->ip();

        $Branch_entry->save();

        if (empty($request->setting_id)) {
            $BranchID = $Branch_entry->id;
        } else {
            $BranchID = $request->setting_id;
        }


        $sub_station = array();
        $i = 1;

        if (!empty($request->type)) {
            foreach ($request->type as $key => $value) {
                if (!empty($value)) {
                    if(isset($request->id[$key])){
                        $sub_station_update = [
                            'parent_id' => $BranchID,
                            'type' => $value,
                            'fequencey' => $request->fequencey[$key],
                            'title' => $request->name[$key],
                            'sorting' => $i,
                            'updated_by' => (!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                            'updated_at' => date('Y-m-d H:i:s'),
                            'updated_ip' => $request->ip(),
                        ];
                        DB::table('branch_infos')->where(['id'=>$request->id[$key]])->update($sub_station_update);

                    }else {
                        $sub_station[] = [
                            'parent_id' => $BranchID,
                            'type' => $value,
                            'fequencey' => $request->fequencey[$key],
                            'title' => $request->name[$key],
                            'sorting' => $i,
                            'created_by' => (!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                            'created_at' => date('Y-m-d H:i:s'),
                            'created_ip' => $request->ip(),
                        ];

                    }
                    $i++;
                }

            }
            if(!empty($request->id)){
                DB::table('branch_infos')->whereNotIn('id', $request->id)->where('parent_id',$BranchID)->update(['is_active'=>0,
                    'updated_by' => (!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'updated_ip' => $request->ip()
                ]);
            }
        }
        if(empty($request->id)){
            DB::table('branch_infos')->where('parent_id',$BranchID)->update(['is_active'=>0,
                'updated_by' => (!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_ip' => $request->ip()
            ]);
        }

        if(!empty($sub_station)) {
            DB::table('branch_infos')->insert($sub_station);
        }
        if (empty($request->setting_id)) {
            return redirect('/branch_setup')->with('message', 'Successfully add Information');
        } else {
            return redirect('/branch_setup')->with('message', 'Successfully update Information');
        }
    }

    public function delete_branch_setup($id)
    {
        $bank_data = Monthly_opening::find($id);
        $bank_data->status = 0;
        $bank_data->save();
        return redirect('/get_montly_open')->with('message', 'Successfully delete Information');
    }

    public function product_unit_setup(){
        $setup_info = All_stting::get_all_settings_info(['type'=>10]);
        return view('setting.product_unit_setup',['setup_info' => $setup_info]);
    }
    public function product_category(){
        $setup_info = All_stting::get_all_settings_info(['type'=>11]);
        return view('setting.product_category',['setup_info' => $setup_info]);
    }
    public function product_sub_category(){
        $setup_info = All_stting::get_all_settings_info_sub_ctg(['all_sttings.type'=>12]);
        $product_ctg = All_stting::get_all_settings_info(['type'=>11]);
        return view('setting.product_sub_category',['setup_info' => $setup_info,'product_ctg'=>$product_ctg]);
    }
    public function product_info(){
        $product_info = All_stting::get_all_settings_info(['type'=>11]);
        $all_unit_info = All_stting::get_all_settings_info(['type'=>10]);
        $all_product_info = All_stting::get_all_product_info();
        return view('setting.product_info',['all_product_ctg_info' => $product_info,'all_unit_info'=>$all_unit_info,'all_product_info'=>$all_product_info]);
    }
    public function getSubCategoryInfo(request $request) {
        $sub_category_info = DB::table('all_sttings')->where([
            'is_active' => 1,
            'parent_id' => (int) $request->parent_id
        ])->get();
        echo json_encode($sub_category_info);
    }

    public function show_upazila_by_district(request $request){
        $upazila_info=All_stting::get_upazilas(['district_id'=>$request->district_id]);
        if(!empty($upazila_info)){
            echo json_encode(['status'=>'success','data'=>$upazila_info]);
        }else{
            echo json_encode(['status'=>'error','data'=>'']);
        }
    }

    public function get_all_artist_ho_sub_ctg(request $request){
        if(!empty($request->product_id)) {
            $sub_ctg = All_stting::get_all_settings_info(['type' => 12, 'parent_id' => $request->product_id]);
            echo json_encode( ['status'=>'success','message'=>'successfully data found','data'=>$sub_ctg]);
        }else{
            echo json_encode( ['status'=>'error','message'=>'no data found','data'=>'']);
        }
    }

    public function save_product_info(request $request){
        $validation = Validator::make($request->all(), [
            'product_code' => 'required',
            'product_ctg'  => 'required',
            'sub_ctg_id'  => 'required',
            'product_name'  => 'required',
            'product_unit'  => 'required',
            'is_active'  => 'required',
        ]);
        $error_array = array();
        $success_output = '';
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }else {
            DB::beginTransaction();
            if (empty($request->setting_id)) {
                $product_data = new Product_info();
                $product_data->created_at = date('Y-m-d H:i:s');
                $product_data->created_by = (!empty(Auth::user()->id) ? Auth::user()->id : NULL);
                $product_data->created_ip = (!empty(Employee::getIp()))?Employee::getIp():$request->ip();
                $product_data->updated_at = date('Y-m-d H:i:s');
            }else{
                $product_data=Product_info::find($request->setting_id);
                $product_data->updated_at = date('Y-m-d H:i:s');
                $product_data->updated_by = (!empty(Auth::user()->id) ? Auth::user()->id : NULL);
                $product_data->updated_ip = (!empty(Employee::getIp()))?Employee::getIp():$request->ip();

            }

            $product_data->product_code = $request->product_code;
            $product_data->ctg_id = $request->product_ctg;
            $product_data->sub_ctg_id = $request->sub_ctg_id;
            $product_data->name = $request->product_name;
            $product_data->unit_id = $request->product_unit;
            $product_data->is_active = $request->is_active;


            $save_data= $product_data->save();

            if (empty($request->setting_id) && $save_data) {
                $success_output = 'Successfully Add land Information';
            }else if($save_data){
                $success_output = 'Successfully Update Information';
            }else{
                $success_output = '';
            }

            DB::commit();
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output,
            'redirect_page'   => 'product_info'
        );
        echo json_encode($output);
    }

    public function get_signle_product_info(request $request){
        if(!empty($request->product_id)) {
            $product_data= Product_info::find($request->product_id);
            $product_data->sub_ctg_info = All_stting::get_all_settings_info(['type' => 12, 'parent_id' => $product_data->ctg_id]);
            return ['status'=>'success','message'=>'successfully data found','data'=>$product_data];
        }else{
            return['status'=>'error','message'=>'no data found','data'=>''];
        }
    }
     public function searching_product_info(request $request){
        if(!empty($request->term)) {
            $results=Product_info::searching_product_info($request->term);
            echo json_encode($results);
        }else{
            return false;
        }

    }

    public function user_access_control(){
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);
        return view('setting.user_access_control',['station_info'=>$station_info]);
    }

    public function search_employee_user_access_search(request $request){
        if (empty($request->station_id)){
            return ['status'=>'error','message'=>'Station Name is required','data'=>''];
        }else {
            $param=[
                'station_id'=>$request->station_id,
                'employee_id_search'=>$request->employee_id_search
            ];

            $data=Employee::get_search_employee_info($param);
            return view('setting.user_access_control_action',['data'=>$data]);

        }
    }
    public function create_access_control($user_primary_id) {
        if (!empty($user_primary_id)) {
            $user_data = User::find($user_primary_id);
            $role_info=Employee::get_all_role_info(['user_role_info.is_active'=>1]);
            if(!empty($role_info)){
                $data=[];
                foreach ($role_info as $role){
                    $data[$role->type][]=$role;
                }

            }
            return view('setting.user_access_control_show',['data'=>$user_data,'role_info'=>$data]);
        }

    }


    // program
    public function artist_rate_chart(){
        $artist_song_ctg = All_stting::get_settings_info(['type'=>15,'is_active'=>1]);
        $artist_grade_info = All_stting::get_artist_grade_info(['type'=>1]);
        $get_rate_chart = All_stting::get_artist_rate_chart_info_new();
     //   dd($get_rate_chart);
        $work_area = All_stting::get_settings_info(['type'=>18,'is_active'=>1]);
        $artist_vumika = All_stting::get_settings_info(['type'=>16,'is_active'=>1]); // বিবরন
        return view('setting.program.artist_rate_chart',['get_rate_chart' => $get_rate_chart,
            'artist_song_ctg'=>$artist_song_ctg,'artist_grade_info'=>$artist_grade_info,'work_area'=>$work_area,'artist_vumika'=>$artist_vumika]);
    }
    public function get_all_product_sub_ctg(request $request){
        echo "<pre>";
        print_r($request);
        if(!empty($request->discription_id)) {
            $artist_grade_info = All_stting::get_artist_grade_info(['type'=>1]);
            $work_area = All_stting::get_settings_info(['type'=>18,'is_active'=>1]);
            $artist_vumika = All_stting::get_settings_info(['type'=>16,'is_active'=>1]); // বিবরন
            $all_description_info= All_stting::get_all_rate_chart_info_discription(['description' => $request->discription_id]);
            $all_discription_ctg = All_stting::get_all_settings_info(['type' => 19, 'parent_id' => $request->ctg_id, 'is_active' =>1]);
            $get_discription_info = All_stting::get_single_settings_info([ 'id' => $request->discription_id]);
           return view('setting.program.artist_rate_chart_update',['all_description_info' => $all_description_info,'work_area'=>$work_area,'artist_vumika'=>$artist_vumika,'artist_grade_info'=>$artist_grade_info,'all_discription_ctg'=>$all_discription_ctg,'discription'=>$get_discription_info]);
        }else{
            echo json_encode( ['status'=>'error','message'=>'no data found','data'=>'']);
        }
    }
    public function get_description_info(request $request){
        if(!empty($request->ctg_id)) {
            $sub_ctg = All_stting::get_all_settings_info(['type' => 19, 'parent_id' => $request->ctg_id, 'is_active' =>1]);
            echo json_encode( ['status'=>'success','message'=>'successfully data found','data'=>$sub_ctg]);
        }else{
            echo json_encode( ['status'=>'error','message'=>'no data found','data'=>'']);
        }
    }

    public function save_artist_rate_chart(request $request) {
        $validation = Validator::make($request->all(), [
            'artist_song_ctg' => 'required',
            'description'  => 'required',
            'artist_vumika'  => 'required',
            'work_area'  => 'required',
        ]);
       // dd($request);
        $error_array = array();
        $success_output = '';
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }else {
            DB::beginTransaction();
            if (empty($request->chart_id)) {
            $rate_chart=[];
            if(!empty($request->artist_song_grade)){
                foreach ($request->artist_song_grade as $key => $song_grade){
                    if(!empty($song_grade)){
                        $rate_chart[]=[
                            'ctg_id'=>$request->artist_song_ctg,
                            'description'=>$request->description,
                            'grade_id'=>$song_grade,
                            'amount'=>$request->amount[$key],
                            'stability'=>$request->stability[$key],
                            'mohoda_fee'=>$request->mohoda_fee[$key],
                            'maximum_artist'=>$request->maximum_artist[$key],
                            'remarks'=>$request->remarks_info[$key],
                            'display_position'=>$request->display_position[$key],
                            'is_active'=>$request->is_active[$key],
                            'created_time'=>date('Y-m-d H:i:s'),
                            'created_by'=>(!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                            'created_ip'=>(!empty(Employee::getIp()))?Employee::getIp():$request->ip(),
                        ];
                    }
                }
            }
//            dd($rate_chart);
            DB::table('setup_artist_rate_chart')->insert($rate_chart);
                $setting_update=[
                    'rate_vumika'=>((!empty($request->artist_vumika))?$request->artist_vumika:''),
                    'rate_chart_work_area'=>((!empty($request->work_area))?json_encode($request->work_area):''),
                ];
                DB::table('all_sttings')->where('id',$request->description)->update($setting_update);



            }else{
               // dd($request);
                $rate_chart_addd=[];
                $updated_chart_id=[];
                if(!empty($request->artist_song_grade)){
                    foreach ($request->artist_song_grade as $key => $song_grade){
                        if(!empty($request->rate_chart_id[$key])){
                            $update_rate_chart=[
                                'ctg_id'=>$request->artist_song_ctg,
                                'description'=>$request->description,
                                'grade_id'=>$song_grade,
                                'amount'=>$request->amount[$key],
                                'stability'=>$request->stability[$key],
                                'mohoda_fee'=>$request->mohoda_fee[$key],
                                'maximum_artist'=>$request->maximum_artist[$key],
                                'remarks'=>$request->remarks_info[$key],
                                'display_position'=>$request->display_position[$key],
                                'is_active'=>$request->is_active[$key],
                                'created_time'=>date('Y-m-d H:i:s'),
                                'created_by'=>(!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                                'created_ip'=>(!empty(Employee::getIp()))?Employee::getIp():$request->ip(),
                            ];
                            DB::table('setup_artist_rate_chart')->where(['description'=>$request->chart_id])->where(['id'=>$request->rate_chart_id[$key]])->update($update_rate_chart);
                            $updated_chart_id[]=[
                              'ids'=>  $request->rate_chart_id[$key]
                            ];

                        }else{
                            // new data
                            $rate_chart_addd[]=[
                                'ctg_id'=>$request->artist_song_ctg,
                                'description'=>$request->description,
                                'grade_id'=>$song_grade,
                                'amount'=>$request->amount[$key],
                                'stability'=>$request->stability[$key],
                                'mohoda_fee'=>$request->mohoda_fee[$key],
                                'maximum_artist'=>$request->maximum_artist[$key],
                                'remarks'=>$request->remarks_info[$key],
                                'display_position'=>$request->display_position[$key],
                                'is_active'=>$request->is_active[$key],
                                'created_time'=>date('Y-m-d H:i:s'),
                                'created_by'=>(!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                                'created_ip'=>(!empty(Employee::getIp()))?Employee::getIp():$request->ip(),
                            ];
                        }
                    }
                }

                if(!empty($updated_chart_id)){
                    $udpate_ids=array_column($updated_chart_id,'ids');
                    $delete_rate_chart=[
                        'is_active'=> 0,
                        'created_time'=>date('Y-m-d H:i:s'),
                        'created_by'=>(!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                        'created_ip'=>(!empty(Employee::getIp()))?Employee::getIp():$request->ip(),
                    ];
                    DB::table('setup_artist_rate_chart')->whereNotIn('id',$udpate_ids)->where(['description'=>$request->chart_id])->update($delete_rate_chart);
                }
                if(!empty($rate_chart_addd)){
                    DB::table('setup_artist_rate_chart')->insert($rate_chart_addd);
                }
                $setting_update=[
                    'rate_vumika'=>((!empty($request->artist_vumika))?$request->artist_vumika:''),
                    'rate_chart_work_area'=>((!empty($request->work_area))?json_encode($request->work_area):''),
                ];
                DB::table('all_sttings')->where('id',$request->description)->update($setting_update);

            }



            if (empty($request->chart_id)) {
                $success_output = 'Successfully Add Information';
            }else {
                $success_output = 'Successfully Update Information';
            }

            DB::commit();
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output,
            'redirect_page'   =>'artist_rate_chart'
        );
        echo json_encode($output);
    }

    public function delete_artist_rate_chart(request $request) {
        $rate_chart=[
            'is_active'=>0,
            'updated_time'=>date('Y-m-d H:i:s'),
            'updated_by'=>(!empty(Auth::user()->id) ? Auth::user()->id : NULL),
            'updated_ip'=>(!empty(Employee::getIp()))?Employee::getIp():$request->ip(),
        ];

        DB::table('setup_artist_rate_chart')->where(['id'=>$request->id])->update($rate_chart);
        
        $output = array(
            'error'     =>  [],
            'success'   =>  'Successfully Delete Information',
            'redirect_page'   =>'artist_rate_chart'
        );
        echo json_encode($output);
    }


    public function getSubStation(request $request) {
        $substation_info = DB::table('branch_infos')->where([
            'is_active' => 1,
            'parent_id' => (int) $request->parent_id
        ])->get();
        echo json_encode($substation_info);
    }

    public function getArtistGrade(request $request) {
        $grade_info = DB::table('setup_artist_grade')->where([
            'type' => (int) $request->type_id
        ])->get();
        echo json_encode($grade_info);
    }

    // program schedule setting

    public function master_day_program_time_table() {
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);
        $day_name = All_stting::get_day_name();
        $get_odivision_info = All_stting::get_odivision_info();
        $schedule_info = DB::table('setup_fixed_time_point')
            ->leftJoin('branch_infos','branch_infos.id','=','setup_fixed_time_point.station_id')
            ->leftJoin('setup_days','setup_days.id','=','setup_fixed_time_point.day_id')
            ->where('setup_fixed_time_point.is_active',1)
            ->orderBy('setup_fixed_time_point.id','DESC')
            ->select('setup_fixed_time_point.*','branch_infos.name','setup_days.title_bn')->get();

        return view('setting.program.master_day_program_time_table',
            [
                'station_info'=>$station_info,
                'day_name'=>$day_name,
                'get_odivision_info'=>$get_odivision_info,
                'schedule_info'=>$schedule_info
            ]);
    }
    
    public function master_day_program_time_table_create(){
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);
        $day_name = All_stting::get_day_name();
        $get_odivision_info = All_stting::get_odivision_info();
        $schedule_info = DB::table('setup_fixed_time_point')
            ->leftJoin('branch_infos','branch_infos.id','=','setup_fixed_time_point.station_id')
            ->leftJoin('setup_days','setup_days.id','=','setup_fixed_time_point.day_id')
            ->where('setup_fixed_time_point.is_active',1)
            ->select('setup_fixed_time_point.*','branch_infos.name','setup_days.title_bn')->get();
        return view('setting.program.master_day_program_time_table_create',
            [
                'station_info'=>$station_info,
                'day_name'=>$day_name,
                'get_odivision_info'=>$get_odivision_info,
                'schedule_info'=>$schedule_info
            ]);
    }
    

    public function master_day_program_time_table_update($id) {

        $schedule_info = DB::table('setup_fixed_time_point')
            ->leftJoin('branch_infos','branch_infos.id','=','setup_fixed_time_point.station_id')
            ->where(['setup_fixed_time_point.is_active'=>1,'setup_fixed_time_point.id'=>$id])
            ->select('setup_fixed_time_point.*','branch_infos.name')->first();
        // dd($schedule_info);
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);

        $sub_station_info = Branch_info::get_all_sub_station_info(['parent_id' =>$schedule_info->station_id]);
        
        $day_name = All_stting::get_day_name();
        $get_odivision_info = All_stting::get_odivision_info();
        $employee_info = Employee::get_employee_info_name();
        
        return view('setting.program.master_day_program_time_table_update',
            [
                'station_info'=>$station_info,
                'day_name'=>$day_name,
                'get_odivision_info'=>$get_odivision_info,
                'schedule_info'=>$schedule_info,
                'sub_station_info' => $sub_station_info,
                'employee_info'=>$employee_info
            ]);
    }

    public function master_day_program_time_table_view($id) {

        $schedule_info = DB::table('setup_fixed_time_point')
            ->leftJoin('branch_infos','branch_infos.id','=','setup_fixed_time_point.station_id')
            ->where(['setup_fixed_time_point.is_active'=>1,'setup_fixed_time_point.id'=>$id])
            ->select('setup_fixed_time_point.*','branch_infos.name')->first();
        // dd($schedule_info);
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);

        $sub_station_info = Branch_info::get_all_sub_station_info(['parent_id' =>$schedule_info->station_id]);
        
        $day_name = All_stting::get_day_name();
        $get_odivision_info = All_stting::get_odivision_info();
        $employee_info = Employee::get_employee_info_name();
        
        // dd($employee_info);
        return view('setting.program.master_day_program_time_table_view',
            [
                'station_info'=>$station_info,
                'day_name'=>$day_name,
                'get_odivision_info'=>$get_odivision_info,
                'schedule_info'=>$schedule_info,
                'sub_station_info' => $sub_station_info,
                'employee_info' => $employee_info,
            ]);
    }

    // program schedule delete

    public function delete_master_day_program_time_table(request $request) {

        $schedule_info = DB::table('setup_fixed_time_point')->where([
            'id' => $request->id
        ])
            ->get()
            ->first();

        // dependency check
        $boardcast_info = DB::table('schedule_information')->where([
            'day_id' => $schedule_info->day_id,
            'station_id' => $schedule_info->station_id
        ])
        ->where('is_active','!=',0)
            ->get()
            ->first();

        if(is_null($boardcast_info)) 
        {
            $data=[
                'is_active'=>0,
                'updated_by'=>(!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                'updated_time'=>date('Y-m-d H:i:s'),
                'updated_ip'=>(!empty(Employee::getIp()))?Employee::getIp():$request->ip()
            ];
            DB::table('setup_fixed_time_point')->where(['id'=>$request->id])->update($data);
            $output = array(
                'status'     =>  'success',
                'message'   =>  'Data Deleted Successfully',
                'redirect_page'   =>''
            );
        }
        else {
            $output = array(
                'status'     =>  'error',
                'message'   =>  'Sorry Dependency has found',
                'redirect_page'   =>''
            );
            
        }

        echo json_encode($output);
        
    }

    // program schedule save
    public function save_master_day_program_time_table(request $request) {
        if(!is_null($request->schedule_id)) {
            $validation = Validator::make($request->all(), [
                'station_id'  => 'required',
                'sub_station_id'  => 'required',
                'schedule'  => 'required',
                'schedule_id'  => 'required',
            ]
            );
        }
        else {
            $validation = Validator::make($request->all(), [
                'station_id'  => 'required',
                'sub_station_id'  => 'required',
                'schedule'  => 'required',
            ]
            );
        }

        $error_array = array();
        $success_output = '';

        if ($validation->fails()) {
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }

            $output = array(
                'error'     =>  $error_array,
                'success'   =>  $success_output,
                'redirect_page'   =>''
            );
            echo json_encode($output);
            exit;
        }
        $schedule = json_decode($request->schedule,true);
        // dd(count($schedule));
        // foreach($schedule as $key => $value) {
        //     foreach($value as $vkey => $val) {
        //         if($val['time']=='' && $val['title']=='' && $val['display_position']=='') {
        //             unset($schedule[$key][$vkey]);
        //         }
        //     }
        // }

        if(!is_null($request->schedule_id)) {

            $data=[
                // 'day_id'=>$request->day_name,
                'station_id'=>$request->station_id,
                'sub_station_id'  => $request->sub_station_id,
                'onurup' => !empty($request->onurup_ids) ? json_encode($request->onurup_ids,JSON_UNESCAPED_UNICODE) : null,
                'fixed_onustan_suchy'=>!empty($request->fixed_onustan_suchy) ? $request->fixed_onustan_suchy : null,
                'torimasik_porikolpona'=>!empty($request->torimasik_porikolpona) ? $request->torimasik_porikolpona : null,
                'bangla_son'=>!empty($request->bangla_son) ? $request->bangla_son : null,
                'type'=>1,
                'is_active'=>1,
                'content'=>  json_encode($schedule,JSON_UNESCAPED_UNICODE),
                'updated_by'=>(!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                'updated_time'=>date('Y-m-d H:i:s'),
                'updated_ip'=>(!empty(Employee::getIp()))?Employee::getIp():$request->ip()
            ];
            DB::table('setup_fixed_time_point')->where(['id'=>$request->schedule_id])->update($data);
            $success_output = 'Data Updated Successfully';
        }
        else {
            $data=[
                // 'day_id'=>$request->day_name,
                'station_id'=>$request->station_id,
                'sub_station_id'  => $request->sub_station_id,
                'onurup' => !empty($request->onurup_ids) ? json_encode($request->onurup_ids) : null,
                'fixed_onustan_suchy'=>!empty($request->fixed_onustan_suchy) ? $request->fixed_onustan_suchy : null,
                'torimasik_porikolpona'=>!empty($request->torimasik_porikolpona) ? $request->torimasik_porikolpona : null,
                'bangla_son'=>!empty($request->bangla_son) ? $request->bangla_son : null,
                'type'=>1,
                'is_active'=>1,
                'content'=>  json_encode($schedule,JSON_UNESCAPED_UNICODE ),
                'created_by'=>(!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                'created_time'=>date('Y-m-d H:i:s'),
                'created_ip'=>(!empty(Employee::getIp()))?Employee::getIp():$request->ip()
            ];
            DB::table('setup_fixed_time_point')->insert($data);
            $success_output = 'Data Added Successfully';
        }


        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output,
            'redirect_page'   =>'master_day_program_time_table'
        );
        echo json_encode($output);
    }


    // day schedule report
    public function master_day_schedule_report($id) {

        $schedule_info = DB::table('setup_fixed_time_point')->where([
            'id' => $id
        ])
            ->get()
            ->first();

        $sub_station = All_stting::get_branch(['id'=>$schedule_info->sub_station_id]);

        $day_info = DB::table('setup_days')->where('id',$schedule_info->day_id)->get()->first();

        $station_info = DB::table('branch_infos')->where('id',$schedule_info->station_id)->get()->first();


        $schedule = json_decode($schedule_info->content);

        return view('setting.program.scheduleReport',
            [
                'station'=>$station_info,
                'sub_station' => $sub_station,
                'schedule'=>json_decode($schedule_info->content),
                'day' => $day_info
            ]);



    }

    // program broadcast schedule setting
    public function master_date_program_time_table() {
        $broadcast_info=Program_schedule_info::get_program_schedule_info(['schedule_information.is_active'=>1]);
        return view('setting.program.master_date_program_time_table',
            [
                'broadcast_info'=>$broadcast_info
            ]);
    }
     public function approved_master_date_program_time_table() {
         $broadcast_info=Program_schedule_info::get_program_schedule_info(['schedule_information.is_active'=>2]);
         $employee_info = Employee::get_employee_info_name();
        return view('setting.program.approved_master_date_program_time_table',
            [
                'broadcast_info'=>$broadcast_info,
                'employee_info'=>$employee_info,
            ]);
    }
    public function view_quesheet_info($id) {
        $plan_info= Program_schedule_info::get_program_schedule_info_single([
            'schedule_information.id'=>$id,
        ]);
        $presentation_info= Program_schedule_info::get_program_presentation_single_day_form_artist_info([
            'program_presentation_infos.presentation_date'=>(!empty($plan_info->date)?$plan_info->date:NULL),
        ]);
       $artist_record=employee:: get_artist_select();
        if(!empty($presentation_info)){
            $data=[];
            $role_info=[];
            foreach ($presentation_info as $key => $artist_info){
                if(!in_array($artist_info->role_title,$role_info)) {
                    $role_info[] = $artist_info->role_title;
                }
                $data[$artist_info->odivision_id][$artist_info->role_title][]=[
                    'artist_info_id'  =>((!empty($artist_info->id))?$artist_info->id:''),
                    'artist_id'  =>((!empty($artist_info->artist_id))?$artist_info->artist_id:''),
                    'name'=>((!empty($artist_info->artist_id))?$artist_record[$artist_info->artist_id]:''),
                    'is_present'  =>((!empty($artist_info->is_present))?$artist_info->is_present:''),
                    'presentation_comments'  =>((!empty($artist_info->presentation_comments))?$artist_info->presentation_comments:''),
                ];

            }
        }
        if(empty($plan_info)) {
            die("<h1 style='color:red';>Report not found your desired date</h1>");
        }

        return view('report.program.view_queuesheet_info',
            [
                'plan_info'=>$plan_info,
                'role_data_info'=>$role_info,
                'presentation_info'=>$data
            ]);
    }
    public function odivision_program_queue_sheet_update($id) {
        $plan_info= Program_schedule_info::get_program_schedule_info_single([
            'schedule_information.id'=>$id,
        ]);
        $presentation_info= Program_schedule_info::get_program_presentation_single_day_form_artist_info([
            'program_presentation_infos.presentation_date'=>(!empty($plan_info->date)?$plan_info->date:NULL),
        ]);

        $artist_record=employee:: get_artist_select();
        if(!empty($presentation_info)){
            $data=[];
            foreach ($presentation_info as $key => $artist_info){
                $data[$artist_info->role_title][$artist_info->odivision_id][]=[
                    'artist_info_id'  =>((!empty($artist_info->id))?$artist_info->id:''),
                    'artist_id'  =>((!empty($artist_info->artist_id))?$artist_info->artist_id:''),
                    'name'=>((!empty($artist_info->artist_id))?$artist_record[$artist_info->artist_id]:''),
                    'is_present'  =>((!empty($artist_info->is_present))?$artist_info->is_present:''),
                    'presentation_comments'  =>((!empty($artist_info->presentation_comments))?$artist_info->presentation_comments:''),
                    'log_type'  =>((!empty($artist_info->log_type))?$artist_info->log_type:''),
                    'log_book_no'  =>((!empty($artist_info->log_book_no))?$artist_info->log_book_no:''),
                ];
            }
        }
        if(empty($plan_info)) {
            die("<h1 style='color:red';>Report not found your desired date</h1>");
        }
        return view('report.program.duty_room.odivision_program_queue_sheet_update',
            [
                'plan_info'=>$plan_info,
                'presentation_info'=>$data
            ]);
    }

    public function odivision_program_queue_sheet_view($id) {
        $plan_info= Program_schedule_info::get_program_schedule_info_single([
            'schedule_information.id'=>$id,
        ]);
        $presentation_info= Program_schedule_info::get_program_presentation_single_day_form_artist_info([
            'program_presentation_infos.presentation_date'=>(!empty($plan_info->date)?$plan_info->date:NULL),
        ]);

        $artist_record=employee:: get_artist_select();
        if(!empty($presentation_info)){
            $data=[];
            $role_info=[];
            foreach ($presentation_info as $key => $artist_info){
                if(!in_array($artist_info->role_title,$role_info)) {
                    $role_info[] = $artist_info->role_title;
                }
                $data[$artist_info->odivision_id][$artist_info->role_title][]=[
                    'artist_info_id'  =>((!empty($artist_info->id))?$artist_info->id:''),
                    'artist_id'  =>((!empty($artist_info->artist_id))?$artist_info->artist_id:''),
                    'name'=>((!empty($artist_info->artist_id))?$artist_record[$artist_info->artist_id]:''),
                    'is_present'  =>((!empty($artist_info->is_present))?$artist_info->is_present:''),
                    'presentation_comments'  =>((!empty($artist_info->presentation_comments))?$artist_info->presentation_comments:''),
                    'log_type'  =>((!empty($artist_info->log_type))?$artist_info->log_type:''),
                    'log_book_no'  =>((!empty($artist_info->log_book_no))?$artist_info->log_book_no:''),
                ];
            }
        }

        if(empty($plan_info)) {
            die("<h1 style='color:red';>Report not found your desired date</h1>");
        }
        return view('report.program.duty_room.odivision_program_queue_sheet_view',
            [
                'plan_info'=>$plan_info,
                'role_data_info'=>$role_info,
                'presentation_info'=>$data
            ]);
    }
    public function odivision_program_queue_sheet() {
        $broadcast_info=Program_schedule_info::get_program_schedule_info(['schedule_information.is_active'=>2]);
        $employee_info = Employee::get_employee_info_name();
        return view('report.program.duty_room.odivision_program_queue_sheet',
            [
                'broadcast_info'=>$broadcast_info,
                'employee_info'=>$employee_info,
            ]);
    }

    public function save_protram_bicuti_info(request $request){
       if(!empty($request->bicuti_id)) {
           $broadcast_info = Program_schedule_info::get_program_schedule_info_single(['schedule_information.id' => $request->bicuti_id]);
           $content_info= !empty($broadcast_info->content)?json_decode($broadcast_info->content):'';
           $key= array_search($request->bicuti_time, array_column($content_info, 'time'));
           $employee_id= !empty(Session::get('user_info')->employee_id)?Session::get('user_info')
               ->employee_id:NULL;
           $bicutiy_data=[
             'bicuti_reason'=>  $request->bicuti_reason,
             'bicuti_time_start'=>  $request->bicuti_time_start,
             'bicuti_time_end'=>  $request->bicuti_time_end,
             'bicuti_stability'=>  $request->bicuti_stability,
             'bicuti_comments'=>  $request->bicuti_comments,
             'is_email_send'=>  1,
             'email_send_time'=>  NULL,
             'created_by'=>  $employee_id,
             'created_time'=>  date('Y-m-d H:i:s'),
             'created_ip'=>  (!empty(Employee::getIp()))?Employee::getIp():$request->ip()
           ];

           $content_info[$key]->bicuti_reason=$bicutiy_data;
           $data=[
               'content'=>!empty($content_info)?json_encode($content_info,JSON_UNESCAPED_UNICODE ):NULL,
               'updated_by'=>(!empty(Auth::user()->id) ? Auth::user()->id : NULL),
               'updated_time'=>date('Y-m-d H:i:s'),
               'updated_ip'=>(!empty(Employee::getIp()))?Employee::getIp():$request->ip()
           ];
           DB::table('schedule_information')->where(['id'=>$broadcast_info->id])->update($data);
           $output = array(
               'status'     =>  'success',
               'message'   =>  'Successfully update information.',
               'redirect_page'   =>''
           );
           echo json_encode($output);
           exit;
           //$de_date[$key]['attend_date']=$request->record_complete_date;
       }
    }

    public function update_odivision_info_info(request $request){

        if(!empty($request->schedule_id)) {
            $broadcast_info = Program_schedule_info::get_program_schedule_info_single(['schedule_information.id' => $request->schedule_id]);
            $content_info= !empty($broadcast_info->content)?json_decode($broadcast_info->content):'';

            $employee_id= !empty(Session::get('user_info')->employee_id)?Session::get('user_info')
                ->employee_id:NULL;
            foreach ($request->time as $key=> $time_info){
                $content_info[$key]->odivision_record_type=$request->odivision_record_type[$key];
                $content_info[$key]->truti_info=$request->truti_info[$key];
                $content_info[$key]->comments=$request->comments[$key];
                $content_info[$key]->updated_by=$employee_id;
                $content_info[$key]->updated_time=date('Y-m-d H:i:s');
                $content_info[$key]->updated_ip=(!empty(Employee::getIp()))?Employee::getIp():$request->ip();
            }
            $data=[
                'content'=>!empty($content_info)?json_encode($content_info,JSON_UNESCAPED_UNICODE ):NULL,
                'updated_by'=>(!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                'updated_time'=>date('Y-m-d H:i:s'),
                'updated_ip'=>(!empty(Employee::getIp()))?Employee::getIp():$request->ip()
            ];
            DB::table('schedule_information')->where(['id'=>$request->schedule_id])->update($data);
            $output = array(
                'status'     =>  'success',
                'message'   =>  'Successfully update information',
                'redirect_page'   =>''
            );
            echo json_encode($output);
            exit;

            //$de_date[$key]['attend_date']=$request->record_complete_date;
        }
    }
    public function update_odivision_presentation_info_info(request $request){
            if(!empty($request->presentation_date)) {
                foreach ($request->artist_id as $key=>$artist){
                    if(!empty($request->presentation_artist_comments[$artist]) ||  !empty($request->presentation_artist_present[$artist]) ){
                        $param=[
                            'program_planning_artist_infos.artist_id'=>$artist,
                            'program_planning_artist_infos.odivision_id'=> !empty($request->odivison_id[$artist])
                                ?$request->odivison_id[$artist]:NULL,
                            'program_planning_artist_infos.role_title'=>!empty($request->artist_role[$artist])
                                ?$request->artist_role[$artist]:NULL,
                        ];
                        $artist_info_primaryid=Program_schedule_info::get_artist_info_primary_id($param,$request->presentation_date);

                        $artist_comments=[
//                          'id'=>$artist_info_primaryid,
//                          'artist_id'=>$artist,
//                          'artist_role'=>!empty($request->artist_role[$artist])
//                              ?$request->artist_role[$artist]:NULL,
//                            'odivison_id'=>!empty($request->odivison_id[$artist])
//                                ?$request->odivison_id[$artist]:NULL,
                            'log_type'=>!empty($request->log_type[$artist])?$request->log_type[$artist]:NULL,
                            'log_book_no'=>!empty($request->log_book_no[$artist])?$request->log_book_no[$artist]:NULL,
                            'is_present'=>!empty($request->presentation_artist_present[$artist])?1:NULL,
                            'presentation_comments'=>$request->presentation_artist_comments[$artist],

                        ];
                        DB::table('program_planning_artist_infos')->where(['id'=>$artist_info_primaryid])->update($artist_comments);

                    }
                }
                $output = array(
                    'status'     =>  'success',
                    'message'   =>  'Successfully update information',
                    'redirect_page'   =>''
                );
                echo json_encode($output);
                exit;

                //$de_date[$key]['attend_date']=$request->record_complete_date;
            }
        }


    // program broadcast schedule setting create

    public function master_date_program_time_table_create() {
        $station_info = Branch_info::branch_info_select(['is_active'=>1,'parent_id'=>null]);
        $day_name = All_stting::get_day_name();
        $get_odivision_info = All_stting::get_odivision_info();
        $schedule_info = DB::table('setup_fixed_time_point')
            ->leftJoin('branch_infos','branch_infos.id','=','setup_fixed_time_point.station_id')
            ->leftJoin('setup_days','setup_days.id','=','setup_fixed_time_point.day_id')
            ->select('setup_fixed_time_point.*','branch_infos.name','setup_days.title_bn')->get();
        return view('setting.program.master_date_program_time_table_create',
            [
                'station_info'=>$station_info,
                'day_name'=>$day_name,
                'get_odivision_info'=>$get_odivision_info,
                'schedule_info'=>$schedule_info
            ]);
    }

    public function master_date_program_time_table_update($id) {

        $station_info = Branch_info::branch_info_select(['is_active'=>1]);
        $update_schedule = DB::table('schedule_information')->where('id',$id)->get()->first();
        
        $substation_info = DB::table('branch_infos')->where([
            'is_active' => 1,
            'parent_id' => (int) $update_schedule->station_id
        ])->get();
        
        $nameOfDay = date('l', strtotime($update_schedule->date));
        $dayname_info = DB::table('setup_days')->where('title_en',$nameOfDay)->get()->first();
        
        $schedule_info = DB::table('setup_fixed_time_point')->where([
            'is_active' => 1,
            'day_id' => $dayname_info->id,
            'station_id' => $update_schedule->station_id
        ])
            ->get()
            ->first();

        if($schedule_info==null) {

            die("<h1 style='color:red';>Schedule not found your desired date</h1>");
        }

        $schedule = json_decode($schedule_info->content);
        $update_schedule_decode = json_decode($update_schedule->content,true);
        

        foreach($schedule as $pk => $odivision)
        {
            foreach($odivision as $ck => $value) {
                
                $value->is_overwrite = false;
                $value->overwrite_details = '';
                if(isset($update_schedule_decode[$pk][$ck])) {
                    if($update_schedule_decode[$pk][$ck]['is_overwrite'] == 1) {
                        $value->is_overwrite = true;
                        $value->overwrite_details = $update_schedule_decode[$pk][$ck]['overwrite_details'];
                    }
                }
            }
        }

        $get_odivision_info = All_stting::get_odivision_info();


        return view('setting.program.master_date_program_time_table_update',
            [
                'station_info'          =>$station_info,
                'day_name'              =>$dayname_info->title_bn,
                'get_odivision_info'    =>$get_odivision_info,
                'schedule_info'    =>$schedule_info,
                'schedule'         => $schedule,
                'update_schedule'  => $update_schedule,
                'sub_station_info' => $substation_info
            ]);
    }

    // broadcast schedule save
    public function save_master_date_program_time_table(request $request) {
        dd($request);
        if(!isset($request->schedule_id)) {
            $validation = Validator::make($request->all(), [
                'station_id' => 'required',
                'sub_station_id' => 'required',
                'date'  => 'required',
                'schedule'  => 'required'
            ]);
        }
        else {
            $validation = Validator::make($request->all(), [
                'station_id' => 'required',
                'sub_station_id' => 'required',
                'date'  => 'required',
                'schedule'  => 'required',
                'schedule_id'  => 'required',
            ]);
        }
        
        $error_array = array();

        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }
        
        $success_output = '';
        $nameOfDay = date('l', strtotime($request->date));
        $dayname_id = DB::table('setup_days')->where('title_en',$nameOfDay)->get()->first()->id;

        if(isset($request->schedule_id)) { // update

            $data=[
                'day_id'=>$dayname_id,
                'station_id'=>$request->station_id,
                'sub_station_id'=>$request->sub_station_id,
                'date'=> date("Y-m-d",strtotime($request->date)),
                'is_active'=>1,
                'type'=>1,
                'content'=>  $request->schedule,
                'updated_by'=>(!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                'updated_time'=>date('Y-m-d H:i:s'),
                'updated_ip'=>(!empty(Employee::getIp()))?Employee::getIp():$request->ip()
            ];
            DB::table('schedule_information')->where(['id'=>$request->schedule_id])->update($data);
            $success_output = 'Data Updated Successfully';
        }
        else { // create
            $data=[
                'day_id'=>$dayname_id,
                'station_id'=>$request->station_id,
                'sub_station_id'=>$request->sub_station_id,
                'date'=> date("Y-m-d",strtotime($request->date)),
                'is_active'=>1,
                'type'=>1,
                'content'=>  $request->schedule,
                'created_by'=>(!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                'created_time'=>date('Y-m-d H:i:s'),
                'created_ip'=>(!empty(Employee::getIp()))?Employee::getIp():$request->ip()
            ];
            DB::table('schedule_information')->insert($data);
            $success_output = 'Data Added Successfully';
        }


        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output,
            'redirect_page'   =>''
        );
        echo json_encode($output);
    }

    // broadcast schedule load
    public function master_date_schedule_load($station,$sub_station_id,$date) {
        $nameOfDay = date('l', strtotime($date));
        $dayname_info = DB::table('setup_days')->where('title_en',$nameOfDay)->get()->first();
        // dd($dayname_info->id);
        // $schedule_info = DB::table('setup_fixed_time_point')->where([
        //     'is_active' => 1,
        //     'day_id' => $dayname_info->id,
        //     'station_id' => $station,
        //     'sub_station_id' => $sub_station_id
        // ])
        //     ->get()
        //     ->first();
        
        $schedule_info = DB::select("select  * from setup_fixed_time_point where station_id='$station' and sub_station_id='$sub_station_id' and is_active = 1 and  ( 
            JSON_CONTAINS(content->'$[*].days[*]', JSON_ARRAY('8')) 
            or
            JSON_CONTAINS(content->'$[*].days[*]', JSON_ARRAY('$dayname_info->id')) 
        )");

        
        // echo "schedule query is generated";exit;

        if($schedule_info==null) {

            die("<h1 style='color:red';>Schedule not found your desired date</h1>");
        }
        
        $schedule_get = json_decode($schedule_info[0]->content,true);
      
        $schedule = [];
        foreach($schedule_get as $key => $row) {
            if( !empty($row['days']) && is_array($row['days']) and ( in_array(8,$row['days']) or in_array($dayname_info->id,$row['days']) ) ) {
                $schedule[] = $row;
            }
        }
        // dd($schedule);
        foreach($schedule as $pk => $odivision)
        {
            $schedule[$pk]['is_overwrite'] = false;
            $schedule[$pk]['overwrite_details'] = '';
            $schedule[$pk]['playlist_id'] = '';
        }

        $get_odivision_info = All_stting::get_odivision_info();
        $employee_info = Employee::get_employee_info_name();
        //  dd($schedule_get);
        return view('setting.program.schedule',
            [
                'get_odivision_info'=>$get_odivision_info,
                'schedule'=>$schedule,
                'employee_info'=>$employee_info,
                'day_name' => $dayname_info->title_bn,
                
            ]);



    }



    public function delete_master_date_program_time_table(request $request) {

            $data=[
                'is_active'=>0,
                'updated_by'=>(!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                'updated_time'=>date('Y-m-d H:i:s'),
                'updated_ip'=>(!empty(Employee::getIp()))?Employee::getIp():$request->ip()
            ];
            DB::table('schedule_information')->where(['id'=>$request->id])->update($data);
            $output = array(
                'status'     =>  'success',
                'message'   =>  'Data Deleted Successfully',
                'redirect_page'   =>''
            );
        

        echo json_encode($output);
        
    }
    public function approved_master_date_program_time_table_info(request $request) {
        $employee_id= !empty(Session::get('user_info')->employee_id)?Session::get('user_info')
            ->employee_id:NULL;
        if(empty($request->id) &&  empty($employee_id) ){
            $output = array(
                'status'     =>  'error',
                'message'   =>  'Your are not eligible for approved',
                'redirect_page'   =>''
            );
        }else {
            $data = [
                'is_active' => 2,
                'approved_by' => $employee_id,
                'approved_date' => date('Y-m-d H:i:s'),
                'updated_by' => (!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                'updated_time' => date('Y-m-d H:i:s'),
                'updated_ip' => (!empty(Employee::getIp())) ? Employee::getIp() : $request->ip()
            ];
            DB::table('schedule_information')->where(['id' => $request->id])->update($data);
            $output = array(
                'status' => 'success',
                'message' => 'Successfully approved this Queue sheet.',
                'redirect_page' => ''
            );
        }
        echo json_encode($output);

    }
    public function event_yearly_program(){
            $get_fixed_program_type = DB::table('fixed_program_type')->where('parent_id','=',NULL)->orderBy("id","DESC")
                ->get();
            return view('setting.program.event_yearly_program',['get_fixed_program_type' => $get_fixed_program_type]);

    }
     public function save_save_event_yearly_program(request $request){
         $validation = Validator::make($request->all(), [
             'category' => 'required',
             'is_active'  => 'required',
         ]);
         $error_array = array();
         $success_output = '';
         if ($validation->fails()){
             foreach($validation->messages()->getMessages() as $field_name => $messages){
                 $error_array[] = $messages;
             }
         }else {
             $event_child_info=[];
             if(empty($request->event_id)){
                 $head_info=[
                    'name'                      =>$request->category,
                    'is_active'                 =>$request->is_active,
                    'display_position'          => $request->main_display_position,
                    'created_by'                =>(!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                    'created_time'              =>date('Y-m-d H:i:s'),
                    'created_ip'                =>(!empty(Employee::getIp()))?Employee::getIp():$request->ip()

                 ];
                 DB::beginTransaction();
                 DB::table('fixed_program_type')->insert($head_info);
                 $main_id=DB::getPdo()->lastInsertId();
                 if(!empty($request->event_name)){
                     foreach ($request->event_name as $key=>$row){
                         $event_child_info[]=[
                             'parent_id'            => $main_id,
                             'name'                 => $row,
                             'description'          => $request->description[$key],
                             'event_date'           =>(!empty($request->eng_event_date[$key]))?
                                 date('y-m-d',strtotime($request->eng_event_date[$key])):'',
                             'comments'             => $request->remarks_info[$key],
                             'display_position'     => $request->display_position[$key],
                             'created_by'           =>(!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                             'created_time'         =>date('Y-m-d H:i:s'),
                             'created_ip'           =>(!empty(Employee::getIp()))?Employee::getIp():$request->ip()
                         ];
                     }
                 }

                 DB::table('fixed_program_type')->insert($event_child_info);

                 DB::commit();
                 $success_output = 'Successfully add new information';
             }else{
                 //dd($request);
                 //update
                 $head_info=[
                     'name'                      =>$request->category,
                     'is_active'                 =>$request->is_active,
                     'display_position'          => $request->main_display_position,
                     'updated_by'                =>(!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                     'updated_time'              =>date('Y-m-d H:i:s'),
                     'created_ip'                =>(!empty(Employee::getIp()))?Employee::getIp():$request->ip()

                 ];
               //  dd($head_info);
                 DB::beginTransaction();
                 DB::table('fixed_program_type')->where('id',$request->event_id)->update($head_info);
                 if(!empty($request->event_name)){
                     foreach ($request->event_name as $key=>$row){
                        if(!empty($request->ids[$key])) {
                            $old_event_child_info = [
                                'parent_id'                 => $request->event_id,
                                'name'                      => $row,
                                'description'               => $request->description[$key],
                                'event_date'                => (!empty($request->eng_event_date[$key])) ?
                                    date('y-m-d', strtotime($request->eng_event_date[$key])) : '',
                                'comments'                  => $request->remarks_info[$key],
                                'display_position'          => $request->display_position[$key],
                                'updated_by'                =>(!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                                'updated_time'              =>date('Y-m-d H:i:s'),
                                'created_ip'                =>(!empty(Employee::getIp()))?Employee::getIp():$request->ip()
                            ];
                            DB::table('fixed_program_type')->where('id',$request->ids[$key])->update($old_event_child_info);
                            $delete_id[]=[
                              'id'=>  $request->ids[$key]
                            ];
                        }else{
                            $new_event_child_info[] = [
                                'parent_id'             => $request->event_id,
                                'name'                  => $row,
                                'description'            => $request->description[$key],
                                'event_date'            => (!empty($request->eng_event_date[$key])) ?
                                    date('y-m-d', strtotime($request->eng_event_date[$key])) : '',
                                'comments'              => $request->remarks_info[$key],
                                'display_position'      => $request->display_position[$key],
                                'created_by'            => (!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                                'created_time'          => date('Y-m-d H:i:s'),
                                'created_ip'            => (!empty(Employee::getIp())) ? Employee::getIp() : $request->ip()
                            ];
                        }
                     }
                 }
                 if(!empty($delete_id)){
                     $delete_event_child_info= [
                         'is_active'                 => 0,
                         'updated_by'                =>(!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                         'updated_time'              =>date('Y-m-d H:i:s'),
                         'created_ip'                =>(!empty(Employee::getIp()))?Employee::getIp():$request->ip()
                     ];
                     $ids=array_column($delete_id,'id');
                     DB::table('fixed_program_type')->whereNotIn('id',$ids)->where
                     (['parent_id'=>$request->event_id])->update($delete_event_child_info);
                 }

                if(!empty($new_event_child_info)){
                    DB::table('fixed_program_type')->insert($new_event_child_info);
                }
                 DB::commit();
                 $success_output = 'Successfully update information';
             }
         }

         $output = array(
             'error'     =>  $error_array,
             'success'   => $success_output ,
             'redirect_page'   => 'event_yearly_program'
         );
         echo json_encode($output);

    }
    public function get_all_sub_fixed_program_type(request $request){
        $fixed_program_type_info=DB::table('fixed_program_type')
            ->where([
                'parent_id' => $request->fixed_type_id,
                'is_active' => 1,
            ])->select('*',(DB::raw("date_format(event_date,'%d-%m-%Y') as event_date")))->get();
        if(!empty($fixed_program_type_info)){
            echo json_encode(['status'=>'success','data'=>$fixed_program_type_info]);
        }else{
            echo json_encode(['status'=>'error','data'=>'']);
        }
    }

    public function performance_info() {
        $performance_info=Program_schedule_info::get_all_performance_info(['performance_info.is_active'=>1]);
        return view('program.performance.performance_info',
            [
                'performance_info'=>$performance_info,
            ]);
    }
    public function performance_info_add() {
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);
        return view('program.performance.performance_info_add',
            [
                'station_info'=>$station_info,
            ]);
    }
    public function searching_performance_info(request $request){
        if(empty($request->performance_data)){
            return 'Preformance Date is required';
        }
        if(empty($request->station_id)){
            return 'Station ID is required';
        } if(empty($request->sub_station_id)){
            return 'Fequencey ID is required';
        }
        // presentation info. performance update start
            $param=[
                'program_presentation_infos.presentation_date'=> date('Y-m-d',strtotime($request->performance_data)),
                'program_presentation_infos.station_id'=>$request->station_id,
                'program_presentation_infos.sub_station_id'=>$request->sub_station_id,
            ];
            $presentation_data =Program_schedule_info::get_program_presentation_performance($param) ;
        // presentation info. performance update end

        // live program info. performance update start
            $performance_date=$request->performance_data;
           // $performance_date='20-10-2019';
            $param=[
                'program_planning_infos.entry_date'=> date('Y-m-d',strtotime($performance_date)),
                'program_planning_infos.station_id'=>$request->station_id,
                'program_planning_infos.sub_station_id'=>$request->sub_station_id,
                'program_planning_infos.record_type'=>1,
            ];

            $live_program_info_data =Program_schedule_info::get_program_performance_artist_info($param) ;

            $param=[
                'program_planning_infos.entry_date'=> date('Y-m-d',strtotime($performance_date)),
                'program_planning_infos.station_id'=>$request->station_id,
                'program_planning_infos.sub_station_id'=>$request->sub_station_id,
                'program_planning_infos.record_type'=>2,
            ];

            $record_program_info_data =Program_schedule_info::get_program_performance_artist_info($param) ;

        // live program info. performance update end



        return view('program.performance.searching_performance_info',
            [
                'presentation_info'=>$presentation_data,
                'live_program_info_data'=>$live_program_info_data,
                'record_program_info_data'=>$record_program_info_data,
            ]
        );
    }
     public function view_performance_info($performance_data, $station_id,$fequency_id){
        if(empty($performance_data)){
            return 'Preformance Date is required';
        }
        if(empty($station_id)){
            return 'Station ID is required';
        } if(empty($fequency_id)){
            return 'Fequencey ID is required';
        }
        $param=[
            'program_presentation_infos.presentation_date'      =>  date('Y-m-d',strtotime($performance_data)),
            'program_presentation_infos.station_id'             =>  $station_id,
            'program_presentation_infos.sub_station_id'         =>  $fequency_id,
        ];
        $performance_info =Program_schedule_info::get_program_presentation_performance($param) ;
         $heading_performance_info= Program_schedule_info::get_performance_info
         (['performance_date'=>date('Y-m-d',strtotime($performance_data)),'performance_info.station_id'=>$station_id,'performance_info.fequencey_id'=>$fequency_id]);
        return view('program.performance.view_performance_info',
            [
                'performance_info'=>$performance_info,
                'heading_performance_info'=>$heading_performance_info,
            ]
        );
    }


    public function save_performance_info(request $request){
        $validation = Validator::make($request->all(), [
            'station_id' => 'required',
            'sub_station_id'  => 'required',
            'performance_data'  => 'required'
        ]);
        $error_array = array();
        $success_output = '';
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }else {
            $employee_id= !empty(Session::get('user_info')->employee_id)?Session::get('user_info')
                ->employee_id:NULL;
            DB::beginTransaction();
               $main_performance_info= Program_schedule_info::get_performance_info
            (['performance_date'=>date('Y-m-d',strtotime
               ($request->performance_data)),'performance_info.station_id'=>$request->station_id,
                   'performance_info.fequencey_id'=>$request->sub_station_id,'performance_info.is_active'=>1]);
               if(empty($main_performance_info)){
                   $data=[
                        'performance_date'      =>  date('Y-m-d',strtotime
                        ($request->performance_data)),
                        'station_id'            =>  $request->station_id,
                        'fequencey_id'          =>  $request->sub_station_id,
                        'is_active'             =>  1,
                        'month_id'              =>  date('m',strtotime($request->performance_data)),
                        'year'                  =>  date('Y',strtotime($request->performance_data)),
                        'created_time'          =>  date('Y-m-d H:i:s'),
                        'created_by'            =>  $employee_id,
                        'created_ip'            =>  (!empty(Employee::getIp()))?Employee::getIp():$request->ip(),
                   ];
                   DB::table('performance_info')->insert($data);
                   $success_output = 'Successfully add performance Information';
               }else{
                   $data=[
                       'performance_date'      =>  date('Y-m-d',strtotime
                   ($request->performance_data)),
                       'station_id'            =>  $request->station_id,
                       'fequencey_id'          =>  $request->sub_station_id,
                       'is_active'             =>  1,
                       'month_id'              =>  date('m',strtotime($request->performance_data)),
                       'year'                  =>  date('Y',strtotime($request->performance_data)),
                       'updated_time'          =>  date('Y-m-d H:i:s'),
                       'updated_by'            =>  $employee_id,
                       'updated_ip'            =>  (!empty(Employee::getIp()))?Employee::getIp():$request->ip(),
                   ];
                   DB::table('performance_info')->where(['id'=>$main_performance_info->id])
                       ->update($data);
                   $success_output = 'Successfully update performance Information';
               }
                if(!empty($request->artist_infos_primary_id)){
                    foreach($request->artist_infos_primary_id as $key=>$artist_info_id){
                        $all_info=[
                            'performance_odvision_info' =>  $request->performance_odvision_info[$key],
                            'performance_ctg'           => $request->performance_ctg[$key],
                            'performance_comments'      =>  $request->performance_comments[$key],
                            'performance_updated_by'    =>  $employee_id,
                            'performance_updated_time'  =>  date('Y-m-d H:i:s'),
                            'performance_updated_ip'    =>  (!empty(Employee::getIp()))?Employee::getIp():$request->ip()
                        ];
                        DB::table('program_planning_artist_infos')->where(['id'=>$artist_info_id])
                            ->update($all_info);

                    }

                }else{
                    $success_output = 'Failed to  add performance Information';
                }
            DB::commit();

        }
        $output = array(
            'error'             =>  $error_array,
            'success'           =>  $success_output,
            'redirect_page'     =>  'performance_info'
        );
        echo json_encode($output);
    }
    public function save_user_access_info(request $request){
//        dd($request);
        $validation = Validator::make($request->all(), [
            'access'  => 'required',
            'user_id'  => 'required',

        ]);
        $error_array = array();
        $success_output = '';
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }else {
            $employee_id= !empty(Session::get('user_info')->employee_id)?Session::get('user_info')
                ->employee_id:NULL;
     //      $access_data= json_decode($request->access,true);
//           dd($request->access);
            $access_ids = [];
            foreach($request->access as $modules=> $access_info){
                foreach ($access_info as $main_menu=> $main_manu_info) {
                    foreach ($main_manu_info as $sub_menu=>$sub_menu_info) {
                        $array_values_data=array_keys($sub_menu_info);
                        $ids = array_values(array_unique($sub_menu_info));
                        $access_ids[] = $ids;
                        $info[$modules][$main_menu][$sub_menu]=[
                            'id'=>$ids,
                            'access_info'=>$array_values_data

                        ];
                    }
                }

            }

            DB::beginTransaction();
            $user_info = DB::table('users')->where(['id'=>$request->user_id])->first();
            foreach($access_ids as $array) {
                $data=[
                    'employee_id'=>$user_info->user_id,
                    'access_id'=>$array[0],
                    'is_active'=>1,
                    'created_by'=>$employee_id,
                    'created_time'=>date('Y-m-d H:i:s'),
                    'created_ip'=>(!empty(Employee::getIp()))?Employee::getIp():$request->ip(),
                ];

                DB::table('user_access_info')->insert($data);
            }
            $success_output='Successfully update user access';
            DB::commit();

        }
        $output = array(
            'error'             =>  $error_array,
            'success'           =>  $success_output,
            'redirect_page'     =>  'user_access_control'
        );
        echo json_encode($output);
    }
    public function get_employee_by_station_wise(request  $request){
       if(empty($request->station_id)){
           echo json_encode(['status'=>'error','data'=>'']);exit;
       }
        $param=[
            'station_id'=>$request->station_id,
        ];

        $data=Employee::get_employee_info_name($param);
        if(!empty($data)){
            echo json_encode(['status'=>'success','data'=>$data]);
        }else{
            echo json_encode(['status'=>'error','data'=>'']);
        }
    }


}
