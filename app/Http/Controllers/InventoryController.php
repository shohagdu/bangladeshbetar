<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Branch_info;
use App\Product_stock_info;
use App\Monthly_opening;
use App\Product_info;
use App\All_stting;
use App\Company_info;
use App\Employee;
use Datatables;
use Validator;
use PDF;
use Session;

class InventoryController extends Controller
{
    // Sirajul Islam
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
            return view('template.font_content_store',['company_info'=>$company_info,]);
        }
    }
    public function product_stock_info(){
        $branch_info = Branch_info::branch_info_select(['is_active'=>1]);
        return view('inventory.product_stock_info',['branch_info'=>$branch_info]);
    }
     public function product_stock_in_report(){
         $station_info = Branch_info::branch_info_select(['is_active'=>1]);
         $product_ctg = All_stting::get_all_settings_info(['type'=>11]);
         $product_info = All_stting::get_all_product_info();
        return view('inventory.report.product_stock_in_report',['station_info'=>$station_info,'product_ctg'=>$product_ctg,'product_info'=>$product_info]);
    }
    public function search_product_stock_in_report(request $request){
     if (empty($request->station_id)){
         return ['status'=>'error','message'=>'Station Name is required','data'=>''];
     }else {
         $param=[
             'station_id'=>$request->station_id,
             'product_ctg'=>$request->product_ctg,
             'sub_ctg_id'=>$request->sub_ctg_id,
             'product'=>$request->product,
             'stock_type'=>1, // 1= in , 0 = out
         ];
         $data=Product_stock_info::get_product_stock_report($param);
        return $stock_data=view('inventory.report.product_stock_in_report_action',['stock_report'=>$data]);

     }
    }

     public function product_stock_out_report(){
         $station_info = Branch_info::branch_info_select(['is_active'=>1]);
         $product_ctg = All_stting::get_all_settings_info(['type'=>11]);
         $product_info = All_stting::get_all_product_info();
         return view('inventory.report.product_stock_out_report',['station_info'=>$station_info,'product_ctg'=>$product_ctg,'product_info'=>$product_info]);
    }

    public function search_product_stock_out_report(request $request){
        if (empty($request->station_id)){
            return ['status'=>'error','message'=>'Station Name is required','data'=>''];
        }else {
            $param=[
                'station_id'=>$request->station_id,
                'product_ctg'=>$request->product_ctg,
                'sub_ctg_id'=>$request->sub_ctg_id,
                'product'=>$request->product,
                'stock_type'=>5, // 1= in , 5 = out
            ];

            $data=Product_stock_info::get_product_stock_report($param);
            return $stock_data=view('inventory.report.product_stock_out_report_action',['stock_report'=>$data]);

        }
    }



    public function save_product_stock(request $request){
        $validation = Validator::make($request->all(), [
            'reference' => 'required',
            'station_name'  => 'required',
            'product'  => 'required',
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
                $product_stock_data = new Product_stock_info();
                $product_stock_data->stock_code = Product_stock_info::stock_code_generate($request->station_name,$request->product);
                $product_stock_data->created_at = date('Y-m-d H:i:s');
                $product_stock_data->created_by = (!empty(Auth::user()->id) ? Auth::user()->id : NULL);
                $product_stock_data->created_ip = (!empty(Employee::getIp()))?Employee::getIp():$request->ip();
                $product_stock_data->updated_at = date('Y-m-d H:i:s');
            }else{
                $product_stock_data=Product_stock_info::find($request->setting_id);
                $product_stock_data->updated_at = date('Y-m-d H:i:s');
                $product_stock_data->updated_by = (!empty(Auth::user()->id) ? Auth::user()->id : NULL);
                $product_stock_data->updated_ip = (!empty(Employee::getIp()))?Employee::getIp():$request->ip();

            }

            $product_stock_data->product_reference	 = $request->reference;
            $product_stock_data->station_id = $request->station_name;
            $product_stock_data->product_id = $request->product;
            $product_stock_data->room_no = $request->room_no;

            $product_stock_data->purchase_date = date('Y-m-d',strtotime($request->purchase_date));
            $product_stock_data->warranty_count = (!empty($request->warranty) && $request->warranty!='N/A' )?$request->warranty_count:NULL;
            $product_stock_data->warranty_Info = (!empty($request->warranty))?$request->warranty:NULL;
            $product_stock_data->lifetime_count = (!empty($request->life_time) && $request->life_time!='N/A' )?$request->life_time_count:NULL;
            $product_stock_data->product_life_time_info = (!empty($request->life_time)  )?$request->life_time:NULL ;
            $product_stock_data->is_maintance = $request->is_maintenance;
            $product_stock_data->maintance_details = $request->maintenance_details;
            $product_stock_data->product_user_info = $request->product_user;
            $save_data= $product_stock_data->save();

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
            'redirect_page'   => 'product_stock_info'
        );
        echo json_encode($output);
    }
    public function all_product_stock_info_ajax(){
        $get_land_info = DB::table('product_stock_infos')
            ->leftJoin("branch_infos",'product_stock_infos.station_id','=','branch_infos.id')
            ->leftJoin("product_infos",'product_infos.id','=','product_stock_infos.product_id')
            ->where('product_stock_infos.is_active',"=",1)
            ->orderBy('product_stock_infos.id','DESC');
        $get_land_info->select('product_stock_infos.*',"branch_infos.name as station_name" ,(DB::raw("concat(product_infos.name,'-',product_infos.product_code) as product_name")),(DB::raw("date_format(product_stock_infos.purchase_date,'%d-%m-%Y') as purchase_date_show")),(DB::raw("IF(product_stock_infos.warranty_count>0,concat(product_stock_infos.warranty_count,'-',product_stock_infos.warranty_Info),product_stock_infos.warranty_Info) as warranty_info_show")),(DB::raw("IF(product_stock_infos.lifetime_count>0,concat(product_stock_infos.lifetime_count,'-',product_stock_infos.	product_life_time_info),product_stock_infos.	product_life_time_info) as life_time_info_show")),(DB::raw("IF(product_stock_infos.is_maintance>1,'Yes','No') as maintainance_info_show")));
        return Datatables::of($get_land_info)->addColumn('action', function($stock_info){
            return '<a href="'. url('details_stocks_info/'.$stock_info->id.'/view' ).'" title="View Details" class="btn btn-xs btn-primary edit" id="'.$stock_info->id.'"><i class="glyphicon glyphicon-share-alt"></i> </a>  <button type="button" data-toggle="modal" onclick="updateProuctStockInfo('.$stock_info->id.')" data-target="#exampleModal"
                      title="Update" class="btn btn-xs btn-info" id="'.$stock_info->id.'"><i class="glyphicon glyphicon-edit"></i> </button> <button type="button" data-toggle="modal" onclick="StockOutConfirm('.$stock_info->id.')" data-target="#stockOutModal"
                      title="Stock Out" class="btn btn-xs btn-danger" id="'.$stock_info->id.'"><i class="glyphicon glyphicon-remove"></i> </button>';
        })->make(true);
    }
    public function get_signle_product_stock_info(request $request){
        if(!empty($request->stock_id)) {
            $product_data= Product_stock_info::find($request->stock_id);
            $product_data->purchase_date=(!empty($product_data->purchase_date)?date('d-m-Y',strtotime($product_data->purchase_date)):NULL);
            $product_data->product_info=(!empty($product_data->product_id)?Product_info::single_product_info($product_data->product_id):NULL);
            return ['status'=>'success','message'=>'successfully data found','data'=>$product_data];
        }else{
            return['status'=>'error','message'=>'no data found','data'=>''];
        }
    }

    public function product_stock_out(request $request){

        $validation = Validator::make($request->all(), [
            'stock_out_reason' => 'required',
            'setting_id'  => 'required',
        ]);
        $error_array = array();
        $success_output = '';
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }else {
            DB::beginTransaction();

            $product_stock_data=Product_stock_info::find($request->setting_id);
            $product_stock_data->stock_out_reason	    =   $request->stock_out_reason;
            $product_stock_data->is_active              =   0;

            $product_stock_data->updated_at             =   date('Y-m-d H:i:s');
        $product_stock_data->updated_by                 =   (!empty(Auth::user()->id) ? Auth::user()->id : NULL);
            $product_stock_data->updated_ip             =   (!empty(Employee::getIp()))?Employee::getIp():$request->ip();


            $product_stock_data->save();
            $success_output = 'Successfully Stock Out this Product Information. [ '.$request->product_name_stock_out.']';
            DB::commit();
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output,
            'redirect_page'   => 'product_stock_info'
        );
        echo json_encode($output);
    }
    public function details_stocks_info($id=NULL,$type=Null){
        if(!empty($id)) {
            $product_data= Product_stock_info::find($id);
            $product_data->purchase_date=(!empty($product_data->purchase_date)?date('d-m-Y',strtotime($product_data->purchase_date)):NULL);
            $product_data->product_info=(!empty($product_data->product_id)?Product_info::single_product_info($product_data->product_id):NULL);
            $stock_info=json_encode(['status'=>'success','message'=>'successfully data found','data'=>$product_data]);

            $company_info = Company_info::find(6);

            if($type=='view') {
                return view('inventory.view_details_stock_info',['stock_info'=>$stock_info,'company_info' => $company_info,'type'=>$type]);
            }elseif($type=='pdf'){
                $pdf = PDF::loadView('inventory.pdf_view_details_stock_info',['stock_info'=>$stock_info,'company_info' => $company_info,'type'=>$type]);
                $file_name="stock_info-".$product_data->stock_code.".pdf";
                return $pdf->download($file_name);
            }
        }else{
            return['status'=>'error','message'=>'no data found','data'=>''];
        }
    }

}
