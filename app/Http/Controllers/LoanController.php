<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\All_stting;

class LoanController extends Controller
{
    public function employee_loan_app(){

        return view('loan.employee_loan_app');
    }
    public function my_loan_request(){

        return view('self_care.my_loan_request');
    }
}
