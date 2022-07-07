<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Datatables;
use App\Company_info;
use App\User;
use Mail;
use Validator;
use PDF;
use Excel;


class SalesCtrl extends Controller
{
    public function new_request(){
        $customer_info = DB::table("users")
            ->leftJoin('acc_chart_of_accounts', 'acc_chart_of_accounts.id', '=', 'users.acc_chart_of_account_id')
            ->where('users.is_active','=',1)
            ->where('users.type','=',2)
            ->orderBy('users.id',"DESC")
            ->pluck( DB::raw("concat(acc_chart_of_accounts.name, '- ', users.mobile) as starts"),"users.id");

        return view('sales.new_request',['customer_info'=>$customer_info,'product_info'=>$this->get_all_product_info()]);
    }


    public function update_request($id){
        $customer_info = DB::table("users")
            ->leftJoin('acc_chart_of_accounts', 'acc_chart_of_accounts.id', '=', 'users.acc_chart_of_account_id')
            ->where('users.is_active','=',1)
            ->where('users.type','=',2)
            ->orderBy('users.id',"DESC")
            ->pluck( DB::raw("concat(acc_chart_of_accounts.name, '- ', users.mobile) as starts"),"users.id");


        $invoice_product = DB::table('acc_invoices_details')
            ->where('acc_invoices_details.invoice_id',"=",$id)
            ->where('acc_invoices_details.is_active','=',1)
            ->orderBy('acc_invoices_details.id','ASC')
            ->select('id','product_id','vendor_id','qty','unit_price')->get();

        $invoice_info = DB::table('acc_invoices')
            ->where('acc_invoices.id',"=",$id)
            ->orderBy('acc_invoices.id','ASC')
            ->select('id','customer_id','record_date','inv_amount','discount','net_amount','note')->first();


        return view('sales.new_request',['customer_info'=>$customer_info,'product_info'=>$this->get_all_product_info(),'invoice_product'=>$invoice_product,"all_vendor_info"=>$this->get_product_vendor_info(),'invoice_info'=>$invoice_info]);
    }




    public function get_all_product_info($param=Null){
        $salesItem = DB::table('product_info')
            ->leftJoin('all_sttings as product_unit', 'product_unit.id', '=', 'product_info.product_unit')
            ->where('product_info.parent_id',"=",NULL)
            ->where('product_info.is_active',1)
            ->orderBy('product_info.sorting','ASC')
            ->orderBy('product_info.id','ASC')
            ->select('product_info.id','product_info.title','product_info.product_unit','product_info.is_show','product_info.sorting',"product_unit.title as product_unit_title");
            if(!empty($param['is_show'])){
                $salesItem ->where('product_info.is_show',1);
            }
        return $salesItem->get();
    }
    public function get_product_vendor_info($id=NULL){
        $vendor_info = DB::table('product_info')
            ->leftJoin('vendors_infos', 'vendors_infos.id', '=', 'product_info.vendor_id')
            ->leftJoin('acc_chart_of_accounts', 'acc_chart_of_accounts.id', '=', 'vendors_infos.acc_chart_of_account_id')
            ->where('product_info.is_active',1)
            ->where('product_info.is_show',1)
            ->orderBy('product_info.sorting','ASC')
            ->orderBy('product_info.id','ASC')
            ->select('product_info.id','product_info.vendor_id','product_info.unit_price',"acc_chart_of_accounts.name as vendor_name");
            if(!empty($id)){
                $vendor_info->where('product_info.parent_id',"=",$id);
            }else{
                $vendor_info->where('product_info.parent_id',"!=",NULL);
            }
        return $vendor_info->get();
    }


    //all request log box
    public function all_request_log(){
        return view('sales.all_request_log');
    }

    public function all_request_log_ajax(){
       return  $this->get_all_request_log();
    }

    // for today requst view
    public function today_all_request_log(){
        return view('sales.today.all_request_log');
    }

    public function today_all_request_log_ajax(){
       return  $this->get_all_request_log(date('Y-m-d'));
    }

    public function get_all_request_log($today=NUll){
        $getDonationBoxReceiptInfo = DB::table('acc_invoices')
            ->leftJoin('users', 'users.id', '=', 'acc_invoices.customer_id')
            ->where('acc_invoices.is_active',"!=",0)
            ->orderBy('acc_invoices.id','DESC');
        if(!empty($today)){
            $getDonationBoxReceiptInfo->where('acc_invoices.record_date',"=",$today);
        }
        $getDonationBoxReceiptInfo ->select('acc_invoices.*','users.name as customer_name','users.mobile as customer_mobile','acc_invoices.id as invoice_id',DB::raw("( CASE WHEN acc_invoices.is_active = 1 THEN ' Pending' WHEN acc_invoices.is_active = 2 THEN 'Completed' WHEN acc_invoices.is_active = 3 THEN 'Cancelled'  ELSE '' END) AS status"), DB::raw("DATE_FORMAT(acc_invoices.record_date, '%d-%m-%Y') as record_date_new") );
        return Datatables::of($getDonationBoxReceiptInfo)->addColumn('action', function($getDonationBoxReceiptInfo){
            return '<a href="'. url('single_receipt_view/'.$getDonationBoxReceiptInfo->invoice_id.'/view' ).'" title="View Details" class="btn btn-xs btn-primary edit" id="'.$getDonationBoxReceiptInfo->invoice_id.'"><i class="glyphicon glyphicon-share-alt"></i> </a> <button type="button"data-toggle="modal" title="Update" onclick="updateBtn('.$getDonationBoxReceiptInfo->id.')" data-target="#exampleModal"  class="btn btn-success btn-xs"><i class="glyphicon glyphicon-pencil"></i></button> ';
        })->make(true);
    }

    public function single_receipt_view($id,$type){
        $company_info = Company_info::find(6); // company id = 6
        $receipt_info = DB::table('acc_invoices')
            ->leftJoin('acc_invoices_details', 'acc_invoices_details.invoice_id', '=', 'acc_invoices.id')
            ->leftJoin('product_info', 'product_info.id', '=', 'acc_invoices_details.product_id')
            ->leftJoin('vendors_infos', 'vendors_infos.id', '=', 'acc_invoices_details.vendor_id')
            ->leftJoin('users as customer', 'customer.id', '=', 'acc_invoices.customer_id')
            ->leftJoin('acc_chart_of_accounts', 'acc_chart_of_accounts.id', '=', 'vendors_infos.acc_chart_of_account_id')
            ->leftJoin('all_sttings as product_unit', 'product_unit.id', '=', 'product_info.product_unit')
            ->leftJoin('users', 'users.id', '=', 'acc_invoices.received_by')
            ->where('acc_invoices_details.is_active',1)
            ->where('acc_invoices.id',$id)
            ->orderBy('acc_invoices_details.id','ASC')
            ->select('acc_invoices.inv_amount','acc_invoices.discount','acc_invoices.due_amount','acc_invoices.id','acc_invoices.record_date','acc_invoices.record_type','acc_invoices.net_amount','acc_invoices.transaction_id','acc_invoices.sales_note','acc_invoices_details.invoice_id',"product_info.title as product_title","acc_invoices_details.qty","acc_invoices_details.unit_price","acc_chart_of_accounts.name as vendor_name",DB::raw("( CASE WHEN acc_invoices.is_active = 1 THEN ' Pending' WHEN acc_invoices.is_active = 2 THEN 'Completed' WHEN acc_invoices.is_active = 3 THEN 'Cancelled'  ELSE '' END) AS status"),"customer.name as customer_name","customer.mobile as customer_mobile","customer.address as customer_address","customer.company_name as company_name","product_unit.title as product_unit_title")->get();

        if($type=='view') {
            return view('sales.single_receipt_view', ['receipt_info' => $receipt_info, 'company_info' => $company_info]);
        }elseif($type=='pdf'){

            $pdf = PDF::loadView('sales.pdf_invoice',['receipt_info' => $receipt_info, 'company_info' => $company_info]);

            $file_name="Order#".$receipt_info[0]->transaction_id.".pdf";
            return $pdf->download($file_name);
        }else{

            $file_name="Order#".$receipt_info[0]->transaction_id;
            Excel::create($file_name, function($excel) use($company_info,$receipt_info){
                $excel->sheet('New sheet', function($sheet) use($company_info,$receipt_info) {
                    $sheet->loadView('sales.excel_invoice');
                    $sheet->loadView('sales.excel_invoice', array('company_info'=>$company_info,'receipt_info' => $receipt_info));

                });
            })->export('xlsx');
        }
    }




//    todo:: this function  using for duplicate value not store

    public function get_request_info(request $request){

        $invoice_info = DB::table('acc_invoices')
            ->where('acc_invoices.id',$request->id)
            ->select("acc_invoices.id","acc_invoices.is_active","acc_invoices.note","acc_invoices.net_amount","acc_invoices.due_amount","acc_invoices.customer_id")->first();
        return json_encode($invoice_info);

    }

    public function update_invoice_status(request $request){
        if($request->status==2) {
            if ($request->payment > $request->due_amount) {
                DB::rollback();
                return redirect($request->redirect_url)->with('message', 'Opps! Payment amount is greater than due amount.');
            }
            if (empty($request->payment)) {
                DB::rollback();
                return redirect($request->redirect_url)->with('message', 'Opps! Payment amount is required.');
            }
        }

        $update_data=[
            'due_amount' => $request->due_amount-$request->payment,
            'is_paid' => (($request->due_amount-$request->payment)==0)?1:0,
            'is_active' => $request->status,
            'note' => $request->note,
            'updated_by' => (!empty(Auth::user()->id)?Auth::user()->id:NULL),
            'updated_time' => date('Y-m-d H:i:s'),
            'updated_ip' => request()->ip(),
        ];

        DB::beginTransaction();
        //   todo:: for invoice
        $invoice = DB::table('acc_invoices')
            ->where('id', $request->setting_id)
            ->update($update_data);

        // todo:transaction information update
        if($request->payment>0) {
            $transaction_info = [
                'invoice_id' => $request->setting_id,
                'amount' => $request->payment,
                'debit_id' => 1, //service_id
                'credit_id' => $request->customer_id,  // Customer Id
                'transaction_date' => date('Y-m-d'),
                'created_by' => (!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                'created_by_ip' => $request->ip(),
                'created_time' => date('Y-m-d H:i:s'),
            ];
            DB::table('acc_transaction')->insert($transaction_info);
        }
        if($invoice==1  ) {
            DB::commit();
            return redirect($request->redirect_url)->with('message', 'Successfully update Information');
        }else{
            DB::rollback();
            return redirect($request->redirect_url)->with('message', 'Failed! update Information');
        }
    }
    public function delete_inovoice_info(request $request){

        $id=$request->id;
        if(!empty($id)) {
            $invoice_info = DB::table('acc_invoices')
                ->where('acc_invoices.id', $id)
                ->select("acc_invoices.id", "acc_invoices.is_active")->first();
            if ($invoice_info->is_active != 1) {
                return json_encode(['status'=>'error','message'=>'This salse is not eligible for delete, because it is moving another operation complete.']);
            }

            $update_data = [
                'is_active' => 0,
                'updated_by' => (!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                'updated_time' => date('Y-m-d H:i:s'),
                'updated_ip' => request()->ip(),
            ];
            //   todo:: for invoice
            $invoice = DB::table('acc_invoices')
                ->where('id', $id)
                ->update($update_data);
            if ($invoice == 1) {
                return json_encode(['status'=>'success','message'=>'Successfully, delete information']);
            } else {
                return json_encode(['status'=>'error','message'=>'Failed, delete information']);
            }
        }else{
            return json_encode(['status'=>'error','message'=>'Failed, delete information']);
        }
    }
    public function cancelled_customize_order(request $request){

        $id=$request->id;
        if(!empty($id)) {
            $invoice_info = DB::table('customize_order_info')
                ->where('customize_order_info.customer_id', $id)
                ->select("customize_order_info.id as customize_id","customize_order_info.status as is_active")->first();
            if ($invoice_info->is_active != 1) {
                return json_encode(['status'=>'error','message'=>'This salse is not eligible for delete, because it is moving another operation complete.']);
            }

            $update_data = [
                'status' => 3,
                'updated_by' => (!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                'updated_time' => date('Y-m-d H:i:s'),
                'updated_ip' => request()->ip(),
            ];
            //   todo:: for invoice
            $invoice = DB::table('customize_order_info')
                ->where('id', $invoice_info->customize_id)
                ->update($update_data);
            if ($invoice == 1) {
                return json_encode(['status'=>'success','message'=>'Successfully, Cancelled information']);
            } else {
                return json_encode(['status'=>'error','message'=>'Failed, Cancelled information']);
            }
        }else{
            return json_encode(['status'=>'error','message'=>'Failed, Cancelled information']);
        }
    }


    //pending request log
    public function all_pending_request_log(){
        return view('sales.all_pending_request_log');
    }

    public function all_pending_request_log_ajax(){
       return $this->view_all_pending_request_log_ajax();
    }


     // today pending request log
    public function today_all_pending_request_log(){
        return view('sales.today.all_pending_request_log');
    }

    public function  today_all_pending_request_log_ajax(){
       return $this->view_all_pending_request_log_ajax(date('Y-m-d'));
    }

    public function view_all_pending_request_log_ajax($today=NULL){
        $getDonationBoxReceiptInfo = DB::table('acc_invoices')
            ->leftJoin('users', 'users.id', '=', 'acc_invoices.customer_id')
            ->where('acc_invoices.is_active',"=",1)
            ->orderBy('acc_invoices.id','DESC');
            if(!empty($today)){
                $getDonationBoxReceiptInfo ->where('acc_invoices.record_date',"=",date('Y-m-d'));
            }
            $getDonationBoxReceiptInfo->select('acc_invoices.*','users.name as customer_name','users.mobile as customer_mobile','acc_invoices.id as invoice_id',DB::raw("( CASE WHEN acc_invoices.is_active = 1 THEN ' Pending' WHEN acc_invoices.is_active = 2 THEN 'Completed' WHEN acc_invoices.is_active = 3 THEN 'Cancelled'  ELSE '' END) AS status"), DB::raw("DATE_FORMAT(acc_invoices.record_date, '%d-%m-%Y') as record_date_new") );
        return Datatables::of($getDonationBoxReceiptInfo)->addColumn('action', function($getDonationBoxReceiptInfo){
            return '<a href="'. url('single_receipt_view/'.$getDonationBoxReceiptInfo->invoice_id.'/view' ).'" title="View Details" class="btn btn-xs btn-primary edit" id="'.$getDonationBoxReceiptInfo->invoice_id.'"><i class="glyphicon glyphicon-share-alt"></i> </a>  <a href="'. url('update_request/'.$getDonationBoxReceiptInfo->invoice_id ).'" title="Update" class="btn btn-xs btn-info" id="'.$getDonationBoxReceiptInfo->invoice_id.'"><i class="glyphicon glyphicon-edit"></i> </a> <button type="button"data-toggle="modal" title="Collection" onclick="updateBtn('.$getDonationBoxReceiptInfo->id.')" data-target="#exampleModal"  class="btn btn-success btn-xs"><i class="glyphicon glyphicon-pencil"></i></button> <button class="btn btn-xs btn-danger"  title="Delete" onclick="deleteConfirm('.$getDonationBoxReceiptInfo->id.')"><i class="glyphicon glyphicon-trash"></i></button>';
        })->make(true);
    }

    //complete request log
    public function all_complete_request_log(){
        return view('sales.all_complete_request_log');
    }

    public function all_complete_request_log_ajax(){
        return $this->view_all_complete_request_log_ajax();
    }

    //complete request log
    public function today_all_complete_request_log(){
        return view('sales.today.all_complete_request_log');
    }
    public function today_all_complete_request_log_ajax(){
        return $this->view_all_complete_request_log_ajax(date('Y-m-d'));
    }

    public function view_all_complete_request_log_ajax($today=NULL){
        $getDonationBoxReceiptInfo = DB::table('acc_invoices')
            ->leftJoin('users', 'users.id', '=', 'acc_invoices.customer_id')
            ->where('acc_invoices.is_active',"=",2)
            ->orderBy('acc_invoices.id','DESC');
        if(!empty($today)){
            $getDonationBoxReceiptInfo ->where('acc_invoices.record_date',"=",date('Y-m-d'));
        }
        $getDonationBoxReceiptInfo ->select('acc_invoices.*','users.name as customer_name','users.mobile as customer_mobile','acc_invoices.id as invoice_id',DB::raw("( CASE WHEN acc_invoices.is_active = 1 THEN ' Pending' WHEN acc_invoices.is_active = 2 THEN 'Completed' WHEN acc_invoices.is_active = 3 THEN 'Cancelled'  ELSE '' END) AS status"), DB::raw("DATE_FORMAT(acc_invoices.record_date, '%d-%m-%Y') as record_date_new") );
        return Datatables::of($getDonationBoxReceiptInfo)->addColumn('action', function($getDonationBoxReceiptInfo){
            return '<a href="'. url('single_receipt_view/'.$getDonationBoxReceiptInfo->invoice_id.'/view' ).'" title="View Details" class="btn btn-xs btn-primary edit" id="'.$getDonationBoxReceiptInfo->invoice_id.'"><i class="glyphicon glyphicon-share-alt"></i> </a> <button type="button"data-toggle="modal" title="Collection" onclick="updateBtn('.$getDonationBoxReceiptInfo->id.')" data-target="#exampleModal"  class="btn btn-success btn-xs"><i class="glyphicon glyphicon-pencil"></i></button> ';
        })->make(true);
    }

    //cancelled request log
    public function all_cancelled_request_log(){
        return view('sales.all_cancelled_request_log');
    }

    public function all_cancelled_request_log_ajax(){
        return $this->view_all_cancelled_request_log_ajax();
    }

     //today cancelled request log
    public function today_all_cancelled_request_log(){
        return view('sales.today.all_cancelled_request_log');
    }
    public function today_all_cancelled_request_log_ajax(){
        return $this->view_all_cancelled_request_log_ajax(date('Y-m-d'));
    }

    public function view_all_cancelled_request_log_ajax($today=NULL){
        $getDonationBoxReceiptInfo = DB::table('acc_invoices')
            ->leftJoin('users', 'users.id', '=', 'acc_invoices.customer_id')
            ->where('acc_invoices.is_active',"=",3)
            ->orderBy('acc_invoices.id','DESC');
        if(!empty($today)){
            $getDonationBoxReceiptInfo ->where('acc_invoices.record_date',"=",date('Y-m-d'));
        }
        $getDonationBoxReceiptInfo->select('acc_invoices.*','users.name as customer_name','users.mobile as customer_mobile','acc_invoices.id as invoice_id',DB::raw("( CASE WHEN acc_invoices.is_active = 1 THEN ' Pending' WHEN acc_invoices.is_active = 2 THEN 'Completed' WHEN acc_invoices.is_active = 3 THEN 'Cancelled'  ELSE '' END) AS status"), DB::raw("DATE_FORMAT(acc_invoices.record_date, '%d-%m-%Y') as record_date_new") );
        return Datatables::of($getDonationBoxReceiptInfo)->addColumn('action', function($getDonationBoxReceiptInfo){
            return '<a href="'. url('single_receipt_view/'.$getDonationBoxReceiptInfo->invoice_id.'/view' ).'" title="View Details" class="btn btn-xs btn-primary edit" id="'.$getDonationBoxReceiptInfo->invoice_id.'"><i class="glyphicon glyphicon-share-alt"></i> </a> <button type="button"data-toggle="modal" title="Update" onclick="updateBtn('.$getDonationBoxReceiptInfo->id.')" data-target="#exampleModal"  class="btn btn-success btn-xs"><i class="glyphicon glyphicon-pencil"></i></button> ';
        })->make(true);
    }



    public function save_invoice_info(request $request){
        $validation = Validator::make($request->all(), [
            'customer_id' => 'required',
            'total_amount'  => 'required',
            'sales_date'  => 'required',
            'qty'  => 'required',
        ]);

        $error_array = array();
        $success_output = '';
        $last_id = '';

        if($request->total_amount =='0.00'){
            $error_array[] = 'Minimum one item is required.';
        }
        if($request->net_amount+$request->discount_amount != $request-> total_amount){
            $error_array[] = 'Total amount and net amount is mismatch.';
        }

        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }else {

            DB::beginTransaction();

            $invoice_data = [
                'record_type' => 1,
                'is_request' => 1, // 1= admin, 2=customer
                'customer_id' => $request->customer_id,
                'record_date' => date('Y-m-d', strtotime($request->sales_date)),
                'inv_amount' => $request->total_amount,
                'discount' => $request->discount_amount,
                'net_amount' => $request->net_amount,
                'due_amount' => $request->net_amount,
                'is_paid' => 0,
                'sales_note' => $request->remark,
                'transaction_id' => $this->get_order_id(),
                'created_by' => (!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                'created_time' => date('Y-m-d H:i:s'),
                'created_ip' => request()->ip(),
            ];
            //   todo:: for invoice
            if(isset($request->update_id) && !empty($request->update_id) ){
                DB::table('acc_invoices')->where('id','=',$request->update_id)->update($invoice_data);
                $last_id =$request->update_id;
            }else {
                DB::table('acc_invoices')->insert($invoice_data);
                $last_id = DB::getPdo()->lastInsertId();
            }

            $invoice_details = array();
            foreach ($request->qty as $key => $value) {
                if ($value > 0) {
                    $invoice_details[] = [
                        'invoice_id' => $last_id,
                        'product_id' => $request->product_id[$key],
                        'vendor_id' => $this->get_vendor_id_by_id($request->vendor_id[$key]),
                        'qty' => $value,
                        'unit_price' => $request->unit_price[$key],
                        'created_by' => (!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                        'created_time' => date('Y-m-d H:i:s'),
                        'created_ip' => $request->ip(),
                    ];
                }
            }
            // todo:transaction information update
            $transaction_info = [
                'invoice_id' => $last_id,
                'amount' => $request->net_amount,
                'debit_id' => $request->customer_id, // Customer Id
                'credit_id' => 1, //service_id
                'transaction_date' => date('Y-m-d', strtotime($request['sales_date'])),
                'created_by' => (!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                'created_by_ip' => $request->ip(),
                'created_time' => date('Y-m-d H:i:s'),
            ];

            if(isset($request->update_id) && !empty($request->update_id) ){
                DB::table('acc_invoices_details')->where("invoice_id",$last_id)->update(['is_active'=>0,'updated_by'=>(!empty(Auth::user()->id) ? Auth::user()->id : NULL),'updated_time'=>date('Y-m-d H:i:s'),"updated_ip"=>$request->ip()]);

                DB::table('acc_invoices_details')->insert($invoice_details);
            }else {
                DB::table('acc_invoices_details')->insert($invoice_details);
            }
            if(isset($request->update_id) && !empty($request->update_id) ){
                DB::table('acc_transaction')->where("invoice_id",$last_id)->update($transaction_info);
            }else {
                DB::table('acc_transaction')->insert($transaction_info);
            }

//            todo :: for customize order make into order
            if(isset($request->customize_order) && !empty($request->customize_order) ){
                DB::table('customize_order_info')->where(["customer_id"=>$request->customize_order,'status'=>1])->orderBy("id","DESC")->limit(1)->update(['status'=>2,'sales_invoice_id'=>$last_id,'updated_by'=>(!empty(Auth::user()->id) ? Auth::user()->id : NULL),'updated_time'=>date('Y-m-d H:i:s'),"updated_ip"=>$request->ip()]);
            }

            if(isset($request->update_id) && !empty($request->update_id) ) {
                $success_output = 'Successfully update sales information';
            }else{
                $success_output = 'Successfully Create a New Sales';
            }
            DB::commit();
        }

        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output,
            'redirect_page'   => asset('/single_receipt_view')."/".$last_id."/view"
        );
        echo json_encode($output);
    }


    public function get_order_id(){
        $count = DB::table('acc_invoices')->where('record_date',date('Y-m-d'))->count();
        $counter=$count+1;
        return date('ymd').str_pad($counter,4,"0",STR_PAD_LEFT);
    }
    
    public function get_product_info(){
        $salesItem = DB::table('product_info')
            ->leftJoin('all_sttings as product_unit', 'product_unit.id', '=', 'product_info.product_unit')
            ->where('product_info.parent_id',"=",NULL)
            ->where('product_info.is_active',1)
            ->where('product_info.is_show',1)
            ->orderBy('product_info.sorting','ASC')
            ->orderBy('product_info.id','ASC')
            ->select('product_info.*',"product_unit.title as product_unit_title")->get();
        $sales_info=[];
        foreach ($salesItem as $sales){
            $vendor_info=$this->get_product_vendor_info($sales->id);
            $product_data=[];
            foreach ($vendor_info as $vendor_data){
                $product_data[]=[
                    'vendor_name' => $vendor_data->vendor_name,
                    'vendor_id' => $vendor_data->vendor_id,
                    'unit_price' => $vendor_data->unit_price,
                ];
            }
            $sales_info[]=[
                'product_id'=>$sales->id,
                'product_name'=>$sales->title,
                'product_unit_title'=>$sales->product_unit_title,
                'vendor_unit_info'=>$product_data,
                'count_td'=>count($product_data),
            ];
        }

        if(count($sales_info)>0){
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully Data Found',
                'data' => $sales_info,
            ], 200);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'No data found',
                'data' => [],
            ], 400);
        }

    }

    public function send_email() {
        $company_info = Company_info::find(6);

        $get_invoice_info = DB::table('acc_invoices')
            ->leftJoin('users as customer', 'customer.id', '=', 'acc_invoices.customer_id')
            ->where('customer.email',"!=",'')
            ->where('acc_invoices.is_send_email',"=",1)
            ->whereIn('acc_invoices.is_active',[1,2]) // 1= for create, 2 = complete
            ->orderBy('acc_invoices.id','ASC')
            ->limit(2)
            ->select('acc_invoices.id',"acc_invoices.customer_id","customer.email as customer_email")->get();

        $i=0;
        if(!empty($get_invoice_info)){
            foreach ($get_invoice_info as $email_info) {
                $email_body=$this->get_invoice_info($email_info->id);
                $customer_email=$email_info->customer_email;
                Mail::send('sales.email_invoice', ['company_info' => $company_info,'receipt_info'=>$email_body], function ($message) use ($company_info, $email_body,$customer_email) {
                    $customer_default_email=$company_info->default_email_send;
                    $sending_email=$customer_email;
                    $message->to($sending_email, 'Stationary')->cc(explode(",",$customer_default_email))->subject
                    ('Stationary');
                    $message->from('noreplay@gmail.com','Stationary');
                });

                $update_info=[
                    'is_send_email'=>2,
                    'is_email_success'=>1,
                ];
                DB::table('acc_invoices')
                    ->where('id', $email_info->id)
                    ->update($update_info);

                $i++;

            }
            if($i>=1){
                return response()->json([
                    'status' => 'success',
                    'message' => 'successfully send email',
                ], 200);
            }
        }




        // send sms for customize request

        $get_customize_order_info = DB::table('customize_order_info')
            ->leftJoin('users as customer', 'customer.id', '=', 'customize_order_info.customer_id')
            ->where('customer.email',"!=",'')
            ->where('customize_order_info.is_send_email',"=",1)
            ->whereIn('customize_order_info.status',[1,2]) // 1= for create, 2 = complete
            ->orderBy('customize_order_info.id','ASC')
            ->limit(1)
            ->select('customize_order_info.id',"customize_order_info.customer_id","customer.email as customer_email","customer.name as customer_name","customer.mobile as customer_mobile","customer.address as customer_address")->get();
        if(!empty($get_customize_order_info)){
            $j=0;
            foreach ($get_customize_order_info as $email_info) {
                $email_body="You are ordering a Customize Request . Customer Name: ".$email_info->customer_name." Address: ".$email_info->customer_address." Contact : ".$email_info->customer_mobile;
                $customer_email=$email_info->customer_email;
                Mail::send('sales.email_customize_request', ['company_info' => $company_info,'receipt_info'=>$email_body], function ($message) use ($company_info, $email_body,$customer_email) {
                    $customer_default_email=$company_info->default_email_send;
                    $sending_email=$customer_email;
                    $message->to($sending_email, 'Stationary')->cc(explode(",",$customer_default_email))->subject
                    ('Stationary');
                    $message->from('noreplay@gmail.com','Stationary');
                });

                $update_info=[
                    'is_send_email'=>2,
                    'is_email_success'=>1,
                ];
                DB::table('customize_order_info')
                    ->where('id', $email_info->id)
                    ->update($update_info);

                $j++;

            }
            if($j>=1){
                return response()->json([
                    'status' => 'success',
                    'message' => 'successfully send email Customize request',
                ], 200);
            }
        }



    }

    public function get_invoice_info($invoice_id){
       return $receipt_info = DB::table('acc_invoices')
            ->leftJoin('acc_invoices_details', 'acc_invoices_details.invoice_id', '=', 'acc_invoices.id')
            ->leftJoin('product_info', 'product_info.id', '=', 'acc_invoices_details.product_id')
            ->leftJoin('vendors_infos', 'vendors_infos.id', '=', 'acc_invoices_details.vendor_id')
            ->leftJoin('users as customer', 'customer.id', '=', 'acc_invoices.customer_id')
            ->leftJoin('acc_chart_of_accounts', 'acc_chart_of_accounts.id', '=', 'vendors_infos.acc_chart_of_account_id')
            ->leftJoin('users', 'users.id', '=', 'acc_invoices.received_by')
           ->leftJoin('all_sttings as product_unit', 'product_unit.id', '=', 'product_info.product_unit')
            ->where('acc_invoices.id',$invoice_id)
            ->orderBy('acc_invoices_details.id','ASC')
            ->select('acc_invoices.inv_amount','acc_invoices.discount','acc_invoices.due_amount','acc_invoices.id','acc_invoices.record_date','acc_invoices.record_type','acc_invoices.net_amount','acc_invoices.transaction_id','acc_invoices_details.invoice_id',"product_info.title as product_title","acc_invoices_details.qty","acc_invoices_details.unit_price","acc_chart_of_accounts.name as vendor_name",DB::raw("( CASE WHEN acc_invoices.is_active = 1 THEN ' Pending' WHEN acc_invoices.is_active = 2 THEN 'Completed' WHEN acc_invoices.is_active = 3 THEN 'Cancelled'  ELSE '' END) AS status"),"customer.name as customer_name","customer.mobile as customer_mobile","customer.address as customer_address","customer.company_name as company_name","product_unit.title as product_unit_title")->get();

    }

    public function show_vendor_info_ajax(request $request){
        $vendor_info=$this->get_product_vendor_info($request->product_id);
       if(count($vendor_info)>0){
           echo json_encode($vendor_info);
       }
    }
    public function get_product_unit_price(request $request){

        $vendor_info = DB::table('product_info')
            ->where('product_info.id',"=",$request->id)
            ->orderBy('product_info.id','DESC')
            ->select('product_info.id','product_info.vendor_id','product_info.unit_price')->first();
       if($vendor_info){
           echo json_encode(['status'=>'success','messge'=>'Successfully data found','data'=>$vendor_info]);
       }else{
           echo json_encode(['status'=>'error','messge'=>'No data found','data'=>'']);
       }
    }
    public function get_vendor_id_by_id($id){
        $vendor_info = DB::table('product_info')
            ->where('product_info.id',"=",$id)
            ->select('product_info.vendor_id')->first();
       if($vendor_info){
           return $vendor_info->vendor_id;
       }else{
           return false;
       }
    }


    //todo:: customize request order
    public function customize_order_request(){
        return view('sales.customize_order_request');
    }
    public function customize_order_request_ajax(){
        return $this->view_customize_order_request_ajax();
    }


    public function today_customize_order_request(){
        return view('sales.today.customize_order_request');
    }
    public function today_customize_order_request_ajax(){
        return $this->view_customize_order_request_ajax(date('Y-m-d'));
    }

    public function view_customize_order_request_ajax($today=NULL){
        $getDonationBoxReceiptInfo = DB::table('customize_order_info')
            ->leftJoin('users', 'users.id', '=', 'customize_order_info.customer_id')
            ->where('customize_order_info.status',"!=",4)
            ->orderBy('customize_order_info.id','DESC');
        if(!empty($today)){
            $getDonationBoxReceiptInfo->where('customize_order_info.record_date',"=",$today);
        };
        $getDonationBoxReceiptInfo->select('customize_order_info.customer_id as customer_id','users.name as customer_name','users.mobile as customer_mobile','customize_order_info.status as activity',DB::raw("( CASE WHEN customize_order_info.status = 1 THEN ' Pending' WHEN customize_order_info.status = 2 THEN 'Completed' WHEN customize_order_info.status = 3 THEN 'Cancelled'  ELSE '' END) AS status"),DB::raw("DATE_FORMAT(customize_order_info.record_date, '%d-%m-%Y') as record_date") );
        return Datatables::of($getDonationBoxReceiptInfo)->addColumn('action', function($getDonationBoxReceiptInfo){
            if($getDonationBoxReceiptInfo->activity==1) {
                return ' <a href="' . url('new_request/' . $getDonationBoxReceiptInfo->customer_id) . '" title="Make Invoice" class="btn btn-xs btn-info" id="' . $getDonationBoxReceiptInfo->customer_id . '"><i class="glyphicon glyphicon-plus"></i> Create </a> <button class="btn btn-xs btn-danger"  title="Delete" onclick="deleteConfirm('.$getDonationBoxReceiptInfo->customer_id.')"><i class="glyphicon glyphicon- remove"></i> Canclled</button>';
            }
        })->make(true);
    }

    public function get_customer_info(Request $request){
        if(!empty($request->id)) {
            $customer_info = User::find($request->id);
            if ($customer_info) {
                return json_encode(['status'=>'success','message'=>'successfully data found','data'=>$customer_info]);
            }
        }else{
            return json_encode(['status'=>'error','message'=>'No data found','data'=>'']);
        }
    }




}
