<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Company_info;
use App\Employee;
use App\All_stting;
use Session;

class TemplateController extends Controller
{

//    public function __construct()
//    {
//        if(!isset( Auth::user()->id)&&(empty(Auth::user()->id))) {
//            return redirect('/login');
//        }
//    }
//    public function __construct() {
//        $this->middleware(['auth', 'clearance'])->except('index', 'show');
//    }


    public function index(){
//        dd('hello');
//        return redirect('/login_now');
        $employe_id=(isset(session('user_info')->employee_id) && !empty(session('user_info')->employee_id))?session('user_info')->employee_id:'';
//        $employe_id='';
        if((empty($employe_id))) {
            return redirect('/login_now');
        }else {
            $employee_leave_info = Employee::employee_leave_info(['employee_id'=>session('user_info')->employee_id,'id'=>Session::get('current_fiscal_year')->fiscal_yer_id]);
            $lave_info=(!empty($employee_leave_info))?All_stting::get_json_decode_leave_info($employee_leave_info->leave_info):'';
            $company_info = Company_info::find(6); // company id = 6
            return view('template.font_content',['company_info'=>$company_info,'employee_leave_info'=>$lave_info]);
        }
    }

    public function getAmount(){

             $amount = DB::table('acc_invoices')
//            ->where("debit_id", '=', $where_id)
            ->where("is_active", '=', 1)
            ->sum('acc_invoices.net_amount');

            return (isset($amount))?number_format($amount,2,'.',''):"0.00";
    }
    public function today_cash_amount(){

             $amount = DB::table('acc_invoices')
            ->where("record_date", '=', date('Y-m-d'))
            ->where("is_active", '=', 1)
            ->sum('acc_invoices.net_amount');

            return (isset($amount))?number_format($amount,2,'.',''):"0.00";
    }
    public function countTotalSale(){
        $toal_invoice = DB::table('acc_invoices')->where('is_active','!=',0)->count();
        return (isset($toal_invoice)?$toal_invoice:0);
    }
    public function countTotalSaleWithStatus($status){
        $toal_invoice = DB::table('acc_invoices')->where('is_active','=',$status)->count();
        return (isset($toal_invoice)?$toal_invoice:0);
    }


    public function countTodaySale(){
        $today_toal_invoice = DB::table('acc_invoices')->where('is_active','!=',0)->where("record_date", '=', date('Y-m-d'))->count();
        return (isset($today_toal_invoice)?$today_toal_invoice:0);
    }
    public function countTodaySaleWithStatus($status){
        $invoice = DB::table('acc_invoices')->where('is_active','=',$status)->where("record_date", '=', date('Y-m-d'))->count();
        return (isset($invoice)?$invoice:0);
    }



    public function countTotalCustomizeRquest($status){
        $toal_invoice = DB::table('customize_order_info')->where('status','!=',$status)->count();
        return (isset($toal_invoice)?$toal_invoice:0);
    }

    public function countCustomizeRequest($status){
        $invoice = DB::table('customize_order_info')->where('status','!=',$status)->where("record_date", '=', date('Y-m-d'))->count();
        return (isset($invoice)?$invoice:0);
    }
    public function login_now()
    {
        return view('auth.login');
    }


}
