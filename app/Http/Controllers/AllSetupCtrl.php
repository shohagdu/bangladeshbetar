<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Acc_chart_of_account;
use App\Monthly_opening;
use Validator;


class AllSetupCtrl extends Controller
{
    /*
  |-------------------------------------------------------|
  |                Vendors information                       |
  |-------------------------------------------------------|
  */
    public function vendors_info_list()
    {
        $vendors_info = DB::table('vendors_infos')
            ->leftJoin("acc_chart_of_accounts", "acc_chart_of_accounts.id", "=", "vendors_infos.acc_chart_of_account_id")
            ->where('vendors_infos.is_active', 1)
            ->orderBy('vendors_infos.id', 'DESC')
            ->select("vendors_infos.*", "acc_chart_of_accounts.name")
            ->paginate(10);
        return view('setting.vendors_info', ['bank_data' => $vendors_info]);
    }

    public function save_vendors_info(request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return response(['status' => 'error', 'message' => $validator->errors()->first()]);
        }
        if (empty($request->setting_id)) {
            $vendor_data = new Vendors_info();
            $chart_of_acc_data = new Acc_chart_of_account();

            // chart off acc_data insert
            $chart_of_acc_data->name = $request->name;
            $chart_of_acc_data->parent_id = 4; // for donation box group  id
            $chart_of_acc_data->details = "Vendors Group";
            $chart_of_acc_data->code = $this->calculation_chart_off_acc_code('10101000', 4);
            $chart_of_acc_data->type_id = 1;
            $chart_of_acc_data->head_type = 2;
            $chart_of_acc_data->opt_type = 1;
            $chart_of_acc_data->created_time = date('Y-m-d H:i:s');

            $chart_of_acc_data->save();
            $chartOfAccId = $chart_of_acc_data->id;


            $vendor_data->acc_chart_of_account_id = $chartOfAccId;
            $vendor_data->company_name = $request->company_name;
            $vendor_data->contact_person = $request->contact_person;
            $vendor_data->mobile = $request->mobile;
            $vendor_data->email = $request->email;
            $vendor_data->address = $request->address;
            $vendor_data->created_by = (!empty(Auth::user()->id) ? Auth::user()->id : NULL);
            $vendor_data->created_at = date('Y-m-d H:i:s');
            $vendor_data->save();
            return redirect('/vendors_info')->with('message', 'Successfully add Information');
        } else {
            $vendor_data = Vendors_info::find($request->setting_id);
            $chart_of_acc_data = Acc_chart_of_account::find($request->chart_of_acc_id);

            $chart_of_acc_data->name = $request->name;
            $chart_of_acc_data->save();
            $vendor_data->company_name = $request->company_name;
            $vendor_data->contact_person = $request->contact_person;
            $vendor_data->mobile = $request->mobile;
            $vendor_data->email = $request->email;
            $vendor_data->address = $request->address;
            $vendor_data->save();
            return redirect('/vendors_info')->with('message', 'Successfully Update Information');
        }


    }

    public function delete_vendors_info($id)
    {

        $bank_data = Vendors_info::find($id);
        $bank_data->is_active = 0;
        $bank_data->save();
        return redirect('/vendors_info')->with('message', 'Successfully delete Information');
    }


    /*
  |-------------------------------------------------------|
  |                Product information                       |
  |-------------------------------------------------------|
  */
    public function product_info_list()
    {
        $product_info = DB::table('product_info')
            ->leftJoin("all_sttings", "all_sttings.id", "=", "product_info.product_unit")
            ->where('product_info.is_active', "!=", 0)
            ->where('product_info.parent_id', "=", NULL)
            ->orderBy('product_info.id', 'DESC')
            ->select("product_info.*", "all_sttings.title as unit_title")
            ->paginate(10);

        $all_unit_info = DB::table("all_sttings")
            ->where('is_active', '=', 1)
            ->where('type', '=', 1)
            ->orderBy('id', "DESC")
            ->pluck("title", "id");

        $all_vendor_info = DB::table("vendors_infos")
            ->leftJoin("acc_chart_of_accounts", "acc_chart_of_accounts.id", "=", "vendors_infos.acc_chart_of_account_id")
            ->where('vendors_infos.is_active', '=', 1)
            ->orderBy('vendors_infos.id', "DESC")
            ->pluck("acc_chart_of_accounts.name", "vendors_infos.id");
        return view('setting.product_info', ['data_list' => $product_info, 'unit_info' => $all_unit_info, 'vendor_info' => $all_vendor_info]);
    }

    public function save_product_info(request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('/product_info')->with('message', $validator->errors()->first());
        }
        if (empty($request->setting_id)) {

            $product_data = [
                'title' => $request->name,
                'product_unit' => $request->unit_id,
                'is_show' => $request->show_sales,
                'is_active' => $request->status,
                'sorting' => $request->parent_position,
                'created_by' => (!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                'created_time' => date('Y-m-d H:i:s'),
            ];
            DB::table('product_info')->insert($product_data);
            $last_id = DB::getPdo()->lastInsertId();
            $product_details = array();
            foreach ($request->vendor_name as $key => $value) {
                $product_details[] = [
                    'parent_id' => $last_id,
                    'vendor_id' => $value,
                    'unit_price' => $request->amount[$key],
                    'is_show' => $request->show_vendor_sales[$key],
                    'sorting' => $request->child_position[$key],
                    'created_by' => (!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                    'created_time' => date('Y-m-d H:i:s'),
                ];

            }

            DB::table('product_info')->insert($product_details);
            return redirect('/product_info')->with('message', 'Successfully add Information');
        } else {

            $product_data = [
                'title' => $request->name,
                'product_unit' => $request->unit_id,
                'is_show' => $request->show_sales,
                'is_active' => $request->status,
                'sorting' => $request->parent_position,
                'created_by' => (!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                'created_time' => date('Y-m-d H:i:s'),
            ];
            DB::table('product_info')->where('id', $request->setting_id)->update($product_data);
            $product_details = array();
            foreach ($request->vendor_name as $key => $value) {
                if (!empty($value)) {
                    $product_details[] = [
                        'parent_id' => $request->setting_id,
                        'vendor_id' => $value,
                        'unit_price' => $request->amount[$key],
                        'is_show' => $request->show_vendor_sales[$key],
                        'sorting' => $request->child_position[$key],
                        'created_by' => (!empty(Auth::user()->id) ? Auth::user()->id : NULL),
                        'created_time' => date('Y-m-d H:i:s'),
                    ];
                }

            }

            DB::table('product_info')->where('parent_id', $request->setting_id)->delete();

            DB::table('product_info')->insert($product_details);
            return redirect('/product_info')->with('message', 'Successfully Updated Information');
        }


    }

    public function delete_product_info(request $request)
    {
        if (!empty($request->id)) {
            DB::table('product_info')->where('id', $request->id)->update(['is_active' => 0, 'updated_time' => date('Y-m-d H:i:s'), 'updated_by' => (!empty(Auth::user()->id) ? Auth::user()->id : NULL)]);
            return json_encode(['status' => 'success', 'message' => 'Successfully, delete information']);
        } else {
            return json_encode(['status' => 'error', 'message' => 'Failed, delete information']);
        }
    }

    public function get_product_vendor_info(request $request)
    {

        $product_info = DB::table('product_info')
            ->where('product_info.is_active', 1)
            ->where('product_info.parent_id', $request->id)
            ->where('product_info.parent_id', "!=", NULL)
            ->orderBy('product_info.id', 'ASC')
            ->select("product_info.id", "product_info.parent_id", "product_info.vendor_id", "product_info.unit_price", "product_info.is_show", "product_info.sorting")->get();
        return json_encode($product_info);

    }


    public function calculation_chart_off_acc_code($parent_code, $parent_id)
    {
        $query = DB::table('acc_chart_of_accounts')
            ->select('acc_chart_of_accounts.id')
            ->where('is_active', '=', 1)
            ->where('parent_id', '=', $parent_id)
            ->get();
        return $parent_code + (count($query) + 1);
    }

    public function get_montly_open()
    {
    
        $get_fiscal_year_info = Monthly_opening::get_fiscal_year_info();
        
        $monthly_info = DB::table('monthly_openings')
            ->leftJoin("fiscal_year", "fiscal_year.id", "=", "monthly_openings.fiscal_year_id")
            ->where('monthly_openings.status', '!=', 0)
            ->orderBy('status', "ASC")
            ->orderBy('sorting', "ASC")
            ->select("monthly_openings.*","fiscal_year.title as fiscal_year_title","fiscal_year.start_date as fiscal_year_start","fiscal_year.end_date as fiscal_year_start")
            ->get();

        return view('setting.get_montly_open', ['monthly_data' => $monthly_info,'get_fiscal_year'=>$get_fiscal_year_info]);
    }

    public function save_montly_open(request $request)
    {
        if (empty($request->setting_id)) {
            $montly_entry = new Monthly_opening();
        } else {
            $montly_entry = Monthly_opening::find($request->setting_id);

        }

        $montly_entry->fiscal_year_id = $request->fiscal_year;
        $montly_entry->title = $request->title;
        $montly_entry->start_date = isset($request->start_date) ? date('Y-m-d', strtotime($request->start_date)) : NULL;
        $montly_entry->end_date = isset($request->end_date) ? date('Y-m-d', strtotime($request->end_date)) : NULL;
        $montly_entry->modify_last_date = isset($request->end_date) ? date('Y-m-d', strtotime($request->changeLastDate)) : NULL;
        $montly_entry->status = $request->status;
        $montly_entry->sorting = $request->position;
        $montly_entry->created_by = (!empty(Auth::user()->id) ? Auth::user()->id : NULL);
        $montly_entry->created_at = date('Y-m-d H:i:s');
        $montly_entry->created_ip = $request->ip();

        $montly_entry->save();
        return redirect('/get_montly_open')->with('message', 'Successfully add Information');
    }

    public function delete_inovoice_info($id)
    {
        $bank_data = Monthly_opening::find($id);
        $bank_data->status = 0;
        $bank_data->save();
        return redirect('/get_montly_open')->with('message', 'Successfully delete Information');
    }


    /*
|-------------------------------------------------------|
|           User/customer  information                  |
|-------------------------------------------------------|
*/
    public function user_customer_info_list()
    {
        $user_customer = DB::table('users')
            ->leftJoin("acc_chart_of_accounts", "acc_chart_of_accounts.id", "=", "users.acc_chart_of_account_id")
            ->where('users.is_active', 1)
            ->where('users.type', 2)
            ->orderBy('users.id', 'DESC')
            ->select("users.*", "users.name")
            ->paginate(10);
        return view('setting.customer_info', ['user_customer' => $user_customer, 'type' => 2]);
    }

    public function save_user_customer_info(request $request)
    {

        $validation = Validator::make($request->all(), [
            'employee_id' => 'required',
            'password' => 'required',
        ]);

        $error_array = array();
        $success_output = '';
        $error_handle=[];

        if ($validation->fails()) {
            foreach ($validation->messages()->getMessages() as $field_name => $messages) {
                $error_array[] = $messages;
            }
        } else {

            try {

//                $checkEmail=$this->checkingDuplicateEmail($request->email,$request->setting_id);
//                if($checkEmail){
//                    return response()->json([
//                        'status' => 'error',
//                        'message' => 'Sorry, This email already used. Please, try to another email.',
//
//                    ], 210);
//                }
//                $checkMobile=$this->checkingDuplicateMobile($request->mobile,$request->setting_id);
//                if($checkMobile){
//                    return response()->json([
//                        'status' => 'error',
//                        'message' => 'Sorry, This Mobile No already used. Please, try to another Mobile No.',
//
//                    ], 211);
//                }


                if (!empty($request->setting_id)) {
                    $user_data = User::find($request->setting_id);
                    $user_data->updated_by = (!empty(Auth::user()->id) ? Auth::user()->id : NULL);
                    $user_data->updated_at = date('Y-m-d H:i:s');
                    if (!empty($request->password)) {
                        $user_data->password = bcrypt($request->password);
                    }

                    $user_data->save();
                    $success_output='Successfully Update Information';
                }

            } catch (\PDOException $e) {
               $error_handle=[
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ];
            }

        }
        if(!empty($error_handle)) {
            return response()->json($error_handle);
        }
        $output = array(
            'error' => $error_array,
            'success' => $success_output,
        );

        return response()->json([
            'success' => 'success',
            'message' => $output,
        ]);
    }

    public function checkingDuplicateEmail($email, $userId=NULL){
        $query = DB::table('users')->where(['email'=>$email]);
        if (!empty($userId)) {
            $query->where('id','!=', $userId);
        }
        $checking_email= $query->count();
        if($checking_email>0){
            return true;
        }else{
            return false;
        }
    }
    public function checkingDuplicateMobile($mobile, $userId=NULL){
        $query = DB::table('users')->where(['mobile'=>$mobile]);
        if (!empty($userId)) {
            $query->where('id','!=', $userId);
        }
        $checking_mobile= $query->count();
        if($checking_mobile>0){
            return true;
        }else{
            return false;
        }
    }


    public function delete_user_customer_info(request $request){
        if (!empty($request->id)) {
            DB::table('users')->where('id', $request->id)->update(['is_active' => 0, 'updated_at' => date('Y-m-d H:i:s'), 'updated_by' => (!empty(Auth::user()->id) ? Auth::user()->id : NULL)]);
            return json_encode(['status' => 'success', 'message' => 'Successfully, delete information']);
        } else {
            return json_encode(['status' => 'error', 'message' => 'Failed, delete information']);
        }
    }

    /*
|-------------------------------------------------------|
|           User  information                  |
|-------------------------------------------------------|
*/
    public function user_list()
    {
        $user_info = DB::table('users')
            ->leftJoin("employees", "employees.employee_id", "=", "users.user_id")
            ->leftJoin('branch_infos', 'branch_infos.id', '=', 'employees.station_id')
            ->where('users.is_active', 1)
            ->where('users.type', 1)
            ->orderBy('users.id', 'DESC')
            ->select("users.*",'employees.emp_name as name','employees.employee_id','employees.mobile','employees.station_id','employees.reporting_person',"branch_infos.name as station_name")
            ->get();
        return view('setting.user_info', ['user_info' => $user_info, 'type' => 1]);
    }

    /*
    |-------------------------------------------------------|
    |           Leave Type  information                     |
    |-------------------------------------------------------|
    */

}
