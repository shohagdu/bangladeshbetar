<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Branch_info;
use App\Land_info;
use App\Monthly_opening;
use App\All_stting;
use Datatables;
use Validator;
use App\Employee;
use App\Company_info;
use PDF;
use Session;

class LandController extends Controller
{
    public function index(){
        if(!isset( Auth::user()->id)&&(empty(Auth::user()->id))) {
            return redirect('/login');
        }else {

            $current_fiscal_year=Monthly_opening::get_current_fiscal_year(['is_active'=>1]);
            $current_payslip_month=Monthly_opening::get_current_payslip_month_info(['status'=>1]);


            $company_info = Company_info::find(6); // company id = 6
            Session::put('company_logo', $company_info->company_logo);
            Session::put('current_fiscal_year', $current_fiscal_year);
            Session::put('current_payslip_month', $current_payslip_month);
//            $data = session()->all();
            return view('template.font_content_state');
        }
    }
    public function land_info(){
        $setup_info  = All_stting::get_all_settings_info(['type'=>25]);
        $branch_info = Branch_info::branch_info_select(['is_active'=>1]);
        return view('asset.land.land_info',['branch_info'=>$branch_info, 'setup_info'=> $setup_info]);
    }
    public function mutation_record(){
        $branch_info = Branch_info::branch_info_select(['is_active'=>1]);
        return view('asset.land.mutation_record',['branch_info'=>$branch_info]);
    }public function tax_payment(){
        $branch_info = Branch_info::branch_info_select(['is_active'=>1]);
        return view('asset.land.tax_payment',['branch_info'=>$branch_info]);
    }
    public function case_info(){
        $branch_info = Branch_info::branch_info_select(['is_active'=>1]);
        return view('asset.land.case_info',['branch_info'=>$branch_info]);
    }


    public function all_land_info_ajax(){
        $get_land_info = DB::table('land_infos')
            ->where('land_infos.is_active',"=",1)
            ->orderBy('land_infos.id','DESC');
        $get_land_info->select('land_infos.*');
        return Datatables::of($get_land_info)->addColumn('action', function($land_info){
            return '<a href="'. url('details_land_info/'.$land_info->id.'/view' ).'" title="View Details" class="btn btn-xs btn-primary edit" id="'.$land_info->id.'"><i class="glyphicon glyphicon-share-alt"></i> </a>  <button type="button" data-toggle="modal" onclick="updateLandInfo('.$land_info->id.')" data-target="#exampleModal"
                      title="Update" class="btn btn-xs btn-info" id="'.$land_info->id.'"><i class="glyphicon glyphicon-edit"></i> </button> ';
        })->make(true);
    }

    public function save_land_info(request $request){
        $validation = Validator::make($request->all(), [
            'land_no' => 'required',
            'station_name'  => 'required',
            'kotian_no'  => 'required',
            'dag_no'  => 'required',
            'mouza'  => 'required',
            'zer_no'  => 'required',
        ]);
        $error_array = array();
        $success_output = '';
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }else {
            DB::beginTransaction();

            if (empty($request->land_id)) {
                $land_data = new Land_info();
            }else{
                $land_data=Land_info::find($request->land_id);
            }

            $land_data->land_no = $request->land_no;
            $land_data->station_id = $request->station_name;
            $land_data->location = $request->address;
            $land_data->details = $request->details;
            $land_data->khotian_no = $request->kotian_no;
            $land_data->dag_no = $request->dag_no;
            $land_data->mouza_no = $request->mouza;
            $land_data->zer_no = $request->zer_no;
            $land_data->last_date_tax = date('Y-m-d',strtotime($request->land_tax_pay_dt));
            $land_data->land_quantity = $request->land_qty;
            $land_data->is_found_case = $request->is_case;
            $land_data->case_details = (!empty($request->case_details)?$request->case_details:NULL);
            $land_data->case_last_update= (!empty($request->case_last_update)?$request->case_last_update:NULL);
            $land_data->case_status =(!empty($request->case_status)?$request->case_status:NULL);
            $land_data->area = $request->area;
            $land_data->created_at = date('Y-m-d H:i:s');
            $land_data->created_by = (!empty(Auth::user()->id) ? Auth::user()->id : NULL);
            $land_data->created_ip = (!empty(Employee::getIp()))?Employee::getIp():$request->ip();
            $land_data->updated_at = date('Y-m-d H:i:s');

            // echo "<pre>";
            // print_r($land_data);exit;

            $save_data= $land_data->save();

            if (empty($request->land_id) && $save_data) {
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
            'redirect_page'   => 'land_info'
        );
        echo json_encode($output);
    }
    public function details_land_info($land_id,$type){
        $land_info=Land_info::get_land_info(['id'=>$land_id]);
        $company_info = Company_info::find(6);

        if($type=='view') {
            return view('asset.land.details_land_info',['land_info'=>$land_info,'company_info' => $company_info,'type'=>$type]);
        }elseif($type=='pdf'){
            $pdf = PDF::loadView('asset.land.pdf_details_land_info',['land_info'=>$land_info,'company_info' => $company_info,'type'=>$type]);
            $file_name="Land_info-".$land_info->land_no.".pdf";
            return $pdf->download($file_name);
        }
    }
    public function get_signle_land_info(request $request){
        if(!empty($request->land_id)) {
            $land_info = Land_info::find($request->land_id);
            $lastDtTax=explode('-',$land_info->last_date_tax);
            $land_info->last_date_tax=(!empty($lastDtTax))?$lastDtTax[2]."-".$lastDtTax[1]."-".$lastDtTax[0]:'';
           return ['status'=>'success','message'=>'successfully data found','data'=>$land_info];
        }else{
            return['status'=>'error','message'=>'no data found','data'=>''];
        }
    }



}
