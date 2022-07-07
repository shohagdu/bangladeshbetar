<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//
//Route::get('/', function () {
//    return view('welcome');
//});

Route::group(['middleware' => 'user_login_check'], function () {
Auth::routes();
Route::get('/login_now','TemplateController@login_now');
Route::get('/','TemplateController@index');
Route::get('/home', 'TemplateController@index');
Route::get('/human_resource', 'EmployeeController@index');
Route::get('/program', 'ProgramController@index');
Route::get('/store', 'InventoryController@index');
Route::get('/state', 'LandController@index');

Route::get('/employee_info','EmployeeController@employee_info');
Route::post('/save_employee_info','EmployeeController@save_employee_info');
Route::post('/delete_employee_info','EmployeeController@delete_employee_info');
Route::get('/all_employee_info_ajax','EmployeeController@all_employee_info_ajax')->name('all_employee_info_ajax');
Route::get('/employee_salary_assign_ajax','EmployeeController@employee_salary_assign_ajax')->name('employee_salary_assign_ajax');
Route::get('/update_employee_info/{md5id}/{id}','EmployeeController@update_employee_info');
Route::get('/details_employee_info/{md5id}/{id}/{type}','EmployeeController@details_employee_info');

// report Human Resource
Route::get('/employee_designation_report','ReportCtrl@employee_designation_report');
Route::post('/search_employee_designation_report','ReportCtrl@search_employee_designation_report');
Route::get('/employee_department_report','ReportCtrl@employee_department_report');
Route::post('/search_employee_department_report','ReportCtrl@search_employee_department_report');
Route::get('/employee_education_report','ReportCtrl@employee_education_report');
Route::post('/search_employee_education_report','ReportCtrl@search_employee_education_report');




Route::post('/save_employee_education','EmployeeController@save_employee_education');
Route::post('/save_employee_training_info','EmployeeController@save_employee_training_info');
Route::post('/save_employee_spouse_child_info','EmployeeController@save_employee_spouse_child_info');
Route::post('/save_employee_promotion','EmployeeController@save_employee_promotion');
Route::post('/save_employee_job_hisotry','EmployeeController@save_employee_job_hisotry');
Route::post('/save_employee_emergency_contact','EmployeeController@save_employee_emergency_contact');
Route::post('/save_employee_exit_feedback','EmployeeController@save_employee_exit_feedback');
Route::post('/save_employee_disciplinary_action','EmployeeController@save_employee_disciplinary_action');
Route::post('/save_employee_employement_info','EmployeeController@save_employee_employement_info');
Route::post('/save_employee_bank_info','EmployeeController@save_employee_bank_info');
Route::post('/save_employee_ict_credentials','EmployeeController@save_employee_ict_credentials');

Route::post('/get_employee_info','EmployeeController@get_employee_info');
Route::get('/print_id_card/{id}','EmployeeController@print_id_card');



Route::get('/employee_salary_assign','EmployeeController@employee_salary_assign');
Route::post('/save_salary_assign','EmployeeController@save_salary_assign');
Route::post('/get_all_data','EmployeeController@get_all_data');


Route::get('/payroll_generate','PayrollController@payroll_generate');
Route::post('/search_elibile_employee_payrole_gen','PayrollController@search_elibile_employee_payrole_gen');
Route::post('/save_employee_payrole_genrate','PayrollController@save_employee_payrole_genrate');
Route::post('/get_single_payslip_info','PayrollController@get_single_payslip_info');
Route::get('/payroll_record','PayrollController@payroll_record');
Route::get('/pdf_payslip_download/{payslip_id}','PayrollController@pdf_payslip_download');


Route::get('/leave_type_setup','SettingCtrl@leave_type_setup');
Route::get('/department_setup','SettingCtrl@department_setup');
Route::get('/designation_setup','SettingCtrl@designation_setup');
Route::get('/nationality_setup','SettingCtrl@nationality_setup');
Route::get('/edu_degree_setup','SettingCtrl@edu_degree_setup');
Route::get('/program_ctg_setup','SettingCtrl@program_ctg_setup');
Route::get('/artist_expertise_department','SettingCtrl@artist_expertise_department');
Route::get('/artist_national_awared_setup','SettingCtrl@artist_national_awared_setup');
Route::get('/artist_work_station','SettingCtrl@artist_work_station');
Route::get('/artist_occupation','SettingCtrl@artist_occupation');
Route::get('/deduction_ctg_setup','SettingCtrl@deduction_ctg_setup');
Route::get('/earning_ctg_setup','SettingCtrl@earning_ctg_setup');
Route::get('/bank_info_setup','SettingCtrl@bank_info_setup');
Route::get('/product_unit','SettingCtrl@product_unit_setup');
Route::get('/product_category','SettingCtrl@product_category');
Route::get('/product_sub_category','SettingCtrl@product_sub_category');
Route::post('/show_upazila_by_district','SettingCtrl@show_upazila_by_district');
Route::get('/program_type_setup','SettingCtrl@program_type_setup');
Route::get('/program_style_setup','SettingCtrl@program_style_setup');
Route::get('/artist_honouriam_sub_ctg','SettingCtrl@artist_honouriam_sub_ctg');
Route::get('/program_description_setup','SettingCtrl@program_description_setup');

Route::get('/artist_rate_chart','SettingCtrl@artist_rate_chart');
Route::post('/save_artist_rate_chart','SettingCtrl@save_artist_rate_chart');
Route::post('/delete_artist_rate_chart','SettingCtrl@delete_artist_rate_chart');
Route::get('/artist_rate_chart_report','ReportCtrl@artist_rate_chart_report');
Route::get('/event_yearly_program_report','ReportCtrl@event_yearly_program_report');



Route::get('/master_day_program_time_table','SettingCtrl@master_day_program_time_table');
Route::post('/save_master_day_program_time_table','SettingCtrl@save_master_day_program_time_table');
Route::post('/delete_master_day_program_time_table','SettingCtrl@delete_master_day_program_time_table');
Route::get('/master_date_program_time_table','SettingCtrl@master_date_program_time_table');
Route::get('/approved_master_date_program_time_table','SettingCtrl@approved_master_date_program_time_table');

// added by mehedi 20/09/2019
Route::get('/master_day_program_time_table_create','SettingCtrl@master_day_program_time_table_create');
Route::get('/master_day_program_time_table_update/{id}','SettingCtrl@master_day_program_time_table_update');
Route::get('/master_day_program_time_table_view/{id}','SettingCtrl@master_day_program_time_table_view');


Route::get('/master_date_schedule_load/{station}/{sub_station_id}/{date}','SettingCtrl@master_date_schedule_load');
Route::get('/master_date_program_time_table_create','SettingCtrl@master_date_program_time_table_create');
Route::get('/master_date_program_time_table_update/{id}','SettingCtrl@master_date_program_time_table_update');
Route::post('/save_master_date_program_time_table','SettingCtrl@save_master_date_program_time_table');
Route::get('/master_day_schedule_report/{id}','SettingCtrl@master_day_schedule_report');
Route::get('/program_plan_report','ReportCtrl@program_plan_report');
Route::get('/program_plan_report_load/{station}/{sub_station_id}/{date}','ReportCtrl@program_plan_report_load');
Route::get('/getSubStation','SettingCtrl@getSubStation');
Route::get('/getArtistGrade','SettingCtrl@getArtistGrade');
Route::post('/delete_master_date_program_time_table','SettingCtrl@delete_master_date_program_time_table');



//product setup
Route::get('/product_info','SettingCtrl@product_info');
Route::post('/get_all_product_sub_ctg','SettingCtrl@get_all_product_sub_ctg');
Route::post('/save_product_info','SettingCtrl@save_product_info');
Route::post('/get_signle_product_info','SettingCtrl@get_signle_product_info');
Route::get('/getSubCategoryInfo','SettingCtrl@getSubCategoryInfo');
//Route::post('/searching_product_info','SettingCtrl@searching_product_info');
Route::post("searching_product_info",array('as'=>'autocomplete','uses'=> 'SettingCtrl@searching_product_info'));
Route::post("searching_employee_info",array('as'=>'autocomplete','uses'=> 'EmployeeController@searching_employee_info'));

Route::post('/save_setup_type','SettingCtrl@save_setup_type');
Route::post('/setup_type_delete','SettingCtrl@setup_type_delete');

Route::post('/save_sub_setup_type','SettingCtrl@save_sub_setup_type');




//todo:: Branch Setup
Route::get('/branch_setup','SettingCtrl@branch_setup');
Route::post('/save_branch_setup','SettingCtrl@save_branch_setup');
Route::post('/get_branch_info','SettingCtrl@get_branch_info');
Route::get('/delete_montly_open/{id}','AllSetupCtrl@delete_montly_open');

// company information
Route::get('/company_info','SettingCtrl@company_info');

Route::post('/company_info_update','SettingCtrl@company_info_update');

// user access information
Route::get('/user_access_control','SettingCtrl@user_access_control');

//Route::get('/staff_info/delete_staff_info/{id}','StaffCtrl@delete_staff_info');

//todo:: montly opening setup
Route::get('/get_montly_open','AllSetupCtrl@get_montly_open');
Route::post('/save_montly_open','AllSetupCtrl@save_montly_open');
Route::get('/delete_montly_open/{id}','AllSetupCtrl@delete_montly_open');


//customr & user setup
Route::get('/user_customer','AllSetupCtrl@user_customer_info_list');
Route::post('/save_user_customer_info','AllSetupCtrl@save_user_customer_info');
Route::post('/delete_user_customer_info','AllSetupCtrl@delete_user_customer_info');

//todo:: for send email
Route::get('/send_email','SalesCtrl@send_email');


//user setup
Route::get('/user_list','AllSetupCtrl@user_list');

// leave modules
Route::get('/employee_leave_app','LeaveController@employee_leave_app');
Route::post('/employee_leave_info','LeaveController@employee_leave_info');
Route::get('/view_leave_application/{id}/{type}','LeaveController@view_leave_application');

// for loan modules
Route::get('/employee_loan_app','LoanController@employee_loan_app');

// for attendance
Route::get('/employee_manual_app','AttendanceController@employee_manual_app');
Route::get('/attendance_record','AttendanceController@attendance_record');
Route::post('/search_employee_attendance_recrod','AttendanceController@search_employee_attendance_recrod');

Route::get('/attendance_entry','AttendanceController@attendance_entry');
Route::get('/holidays_record','AttendanceController@holidays_record');
Route::post('/save_holiday_info','AttendanceController@save_holiday_info');
Route::post('/get_single_holiday_info','AttendanceController@get_single_holiday_info');
Route::post('/search_employee_attendance_info','AttendanceController@search_employee_attendance_info');
Route::post('/saved_employee_attendance_info','AttendanceController@saved_employee_attendance_info');


// Program modules
Route::get('/program_schedule_create','ProgramController@program_schedule_create');
Route::get('/program_record_history','ProgramController@program_record_history');
Route::get('/program_play_history','ProgramController@program_play_history');
Route::get('/program_archieve_history','ProgramController@program_archieve_history');
Route::get('/program_report','ProgramController@program_report');
Route::get('/yearly_broadcast_program','ProgramController@yearly_broadcast_program');
Route::get('/artist_record','ProgramController@artist_record');
Route::get('/artist_record_add','ProgramController@artist_record_add');
Route::get('/artist_record_update/{id}','ProgramController@artist_record_update');
Route::get('/program_recording_list','ProgramController@program_recording_list');
Route::get('/program_account_payment_pending_list','ProgramController@program_account_payment_pending_list');

Route::post('/save_artist_info','ProgramController@save_artist_info');
Route::post('/update_artist_info','ProgramController@update_artist_info');
Route::post('/show_artist_grade','ProgramController@show_artist_grade');
Route::post('/save_program_planning_info','ProgramController@save_program_planning_info');
Route::post('/update_program_planning_info','ProgramController@update_program_planning_info');
Route::post('/status_update_program_info','ProgramController@status_update_program_info');
Route::get('/program_planning_approved','ProgramController@program_planning_approved');
Route::get('/program_proposal_approved','ProgramController@program_proposal_approved');
Route::post('/save_broadcast_info','ProgramController@save_broadcast_info');
Route::post('/get_program_info','ProgramController@get_program_info');

Route::post('/save_presentation_info','ProgramController@save_presentation_info');
Route::post('/update_presentation_info_data','ProgramController@update_presentation_info_data');


Route::get('/get_row/{day_id}/{rowid}','ProgramController@get_row');

Route::get('/update_program_presentation/{month}/{station_id}','ProgramController@update_program_presentation');


Route::post('/load_date_data','ProgramController@load_date_data');
Route::get('/load_date_data_update/{month_id}/{station}','ProgramController@load_date_data_update');

Route::get('/presentation_info_report/{month_id}/{station}/{type}','ProgramController@presentation_info_report');



// archive report
Route::get('/live_program_report','ProgramController@live_program_report');
Route::get('/recorded_program_report','ProgramController@recorded_program_report');
Route::get('/yearly_program_report','ProgramController@yearly_program_report');

//magazine
Route::get('/program_magazine_create','ProgramController@program_magazine_create');
Route::get('/program_magazine_create_form','ProgramController@program_magazine_create_form');
Route::get('/program_magazine_create_form_new','ProgramController@program_magazine_create_form_new');
Route::get('/program_magazine_update_form/{id}','ProgramController@program_magazine_update_form');
Route::get('/program_presentation_create','ProgramController@program_presentation_create');
Route::get('/program_duty_officer_create','ProgramController@program_duty_officer_create');
Route::get('/program_log_writer_create','ProgramController@program_log_writer_create');

Route::get('/program_magazine_cost_form/{id}','ProgramController@program_magazine_cost_form');
Route::get('/program_magazine_cost_view/{id}','ProgramController@program_magazine_cost_view');
Route::post('/save_program_magazine_cost','ProgramController@save_program_magazine_cost');


// studio information
Route::get('/studio_information_form/{id}','ProgramController@studio_information_form');
Route::post('/studio_information_update','ProgramController@studio_information_update');

// archive report
Route::get('/live_program_report','ProgramController@live_program_report');
Route::get('/recorded_program_report','ProgramController@recorded_program_report');
Route::get('/yearly_program_report','ProgramController@yearly_program_report');

//todo:: Report
Route::post('/rep_artist_record','ProgramController@rep_artist_record');


//todo:: Land Information
Route::get('/land_info','LandController@land_info');
Route::post('/save_land_info','LandController@save_land_info');
Route::get('/all_land_info_ajax','LandController@all_land_info_ajax')->name('all_land_info_ajax');
Route::get('/details_land_info/{id}/{type}','LandController@details_land_info');
Route::post('/get_signle_land_info','LandController@get_signle_land_info');
Route::get('/mutation_record','LandController@mutation_record');
Route::get('/tax_payment','LandController@tax_payment');
Route::get('/case_info','LandController@case_info');

Route::get('/immovable_property','StateController@immovable_property');
Route::get('/building_record','StateController@building_record');
Route::get('/maintance_building','StateController@maintance_building');


//report
Route::get('/report_land_info','StateController@report_land_info');
Route::get('/report_building','StateController@report_building');
Route::get('/report_maintance_building','StateController@report_maintance_building');

Route::get('/state_area_setup','StateController@state_area_setup');

Route::post('/search_land_information_report','ReportCtrl@search_land_information_report');

//Route::get('/delete_land_info/{id}','LandController@delete_land_info');


//todo:: Product Stock Information
Route::get('/product_stock_info','InventoryController@product_stock_info');
Route::post('/save_product_stock','InventoryController@save_product_stock');
Route::post('/get_signle_product_stock_info','InventoryController@get_signle_product_stock_info');
Route::get('/all_product_stock_info_ajax','InventoryController@all_product_stock_info_ajax')->name('all_product_stock_info_ajax');
Route::post('/product_stock_out','InventoryController@product_stock_out');
Route::get('/details_stocks_info/{id}/{type}','InventoryController@details_stocks_info');

Route::get('/product_stock_in_report','InventoryController@product_stock_in_report');
Route::post('/search_product_stock_in_report','InventoryController@search_product_stock_in_report');


Route::get('/product_stock_out_report','InventoryController@product_stock_out_report');
Route::post('/search_product_stock_out_report','InventoryController@search_product_stock_out_report');


Route::get('/my_profile','EmployeeController@my_profile');
Route::get('/my_leave_request','LeaveController@my_leave_request');
Route::get('/my_loan_request','LoanController@my_loan_request');
Route::get('/my_atteendance_record','AttendanceController@my_atteendance_record');
Route::get('/add_presentation','ProgramController@add_presentation');
Route::post('/show_sub_fixed_program_type','ProgramController@show_sub_fixed_program_type');

Route::post('/show_expertise_department','SettingCtrl@show_expertise_department');
Route::post('/artist_honouriam_discription','SettingCtrl@artist_honouriam_discription');
Route::post('/artist_honouriam_discription_grade','SettingCtrl@artist_honouriam_discription_grade');
Route::post('/get_description_info','SettingCtrl@get_description_info');

Route::get('/program_magazine_create_form_new','ProgramController@program_magazine_create_form_new');
Route::get('/program_magazine_update_form_new/{id}','ProgramController@program_magazine_update_form_new');
Route::post('/save_program_planning_info_update_new','ProgramController@save_program_planning_info_update_new');
Route::post('/save_program_planning_info_create_new','ProgramController@save_program_planning_info_create_new');

Route::get('/event_yearly_program','SettingCtrl@event_yearly_program');
Route::post('/save_save_event_yearly_program','SettingCtrl@save_save_event_yearly_program');
Route::post('/get_all_sub_fixed_program_type','SettingCtrl@get_all_sub_fixed_program_type');

// 20.09.2019
    Route::post('/save_employee_expertise_info','EmployeeController@save_employee_expertise_info');
    Route::post('/save_employee_award_info','EmployeeController@save_employee_award_info');
    Route::post('/save_employee_travel_info','EmployeeController@save_employee_travel_info');
    Route::post('/delete_travel_info','EmployeeController@delete_travel_info');

//    27.09.2019
    Route::get('/artist_record_view/{id}','ProgramController@artist_record_view');
    Route::post('/planning_form_data','ProgramController@planning_form_data');
    Route::post('/get_chank','ProgramController@get_chank');



    Route::get('/studio_booking_list','ProgramController@studio_booking_list');
    Route::get('/studio_information_view/{id}','ProgramController@studio_information_view');

    Route::get('/gate_passed_list','ProgramController@gate_passed_list');
    Route::get('/gate_pass_print/{id}','ProgramController@gate_pass_print');

    //search planning
    Route::get('/program_proposal_khata','ProgramController@program_proposal_khata');
    Route::post('/search_planning_info','ProgramController@search_planning_info');

    //    Proposal Khata
    Route::get('/proposal_khata','ProgramController@proposal_khata');
    Route::post('/proposal_khata_action','ProgramController@proposal_khata_action');

    //    contract Khata
    Route::get('/contract_khata','ProgramController@contract_khata');
    Route::post('/contract_khata_action','ProgramController@contract_khata_action');

    //    Recording / Performance khata
    Route::get('/recording_performance_khata','ProgramController@recording_performance_khata');
    Route::post('/recording_performance_khata_action','ProgramController@recording_performance_khata_action');

     //    Waiting Payment
    Route::get('/waiting_payment','ProgramController@waiting_payment');
    Route::post('/waiting_payment_action','ProgramController@waiting_payment_action');
    Route::post('/make_payment_action','ProgramController@make_payment_action');

    //    Complete Payment
    Route::get('/complete_payment','ProgramController@complete_payment');
    Route::post('/complete_payment_action','ProgramController@complete_payment_action');

    Route::post('/get_vumika_info','ProgramController@get_vumika_info');

    Route::post('/get_artist_info_program_description','ProgramController@get_artist_info_program_description');
    Route::post('/change_description_info','ProgramController@change_description_info');
    Route::post('/get_single_artist_info','ProgramController@get_single_artist_info');
    //program_odivision
    Route::post('/get_single_artist_info','ProgramController@get_single_artist_info');

    Route::get('/view_quesheet_info/{id}','SettingCtrl@view_quesheet_info');
    Route::post('/approved_master_date_program_time_table_info','SettingCtrl@approved_master_date_program_time_table_info');


    Route::get('/odivision_program_queue_sheet/','SettingCtrl@odivision_program_queue_sheet');
    Route::get('/odivision_program_queue_sheet_update/{id}','SettingCtrl@odivision_program_queue_sheet_update');
    Route::post('/save_protram_bicuti_info','SettingCtrl@save_protram_bicuti_info');
    Route::post('/update_odivision_info_info','SettingCtrl@update_odivision_info_info');
    Route::get('/presentation_setting','ProgramController@presentation_setting');
    Route::get('/add_presentation_setting','ProgramController@add_presentation_setting');
    Route::post('/save_presentation_settings_info','ProgramController@save_presentation_settings_info');
    Route::get('/presentation_setting_info_report/{id}','ProgramController@presentation_setting_info_report');
    Route::post('/delete_presentation_setting','ProgramController@delete_presentation_setting');
    Route::post('/delete_presentation','ProgramController@delete_presentation');
    Route::post('/status_update_presentation_info','ProgramController@status_update_presentation_info');
    Route::get('/presentation_proposal_info','ProgramController@presentation_proposal_info');
    Route::get('/presentation_contract_info','ProgramController@presentation_contract_info');
    
    // 30.10.2019
    Route::get('/presentation_info_report_date/{month_id}/{station}/{type}','ProgramController@presentation_info_report_date');
    Route::get('/presentation_info_report_artist/{month_id}/{station}/{type}','ProgramController@presentation_info_report_artist');
    Route::post('/re_status_update_presentation_info','ProgramController@re_status_update_presentation_info');
    Route::get('/proposal_khata_presentation/{type}','ProgramController@proposal_khata_presentation');
    Route::post('/proposal_khata_presentation_action','ProgramController@proposal_khata_presentation_action');

    Route::get('/program_adhok_presentation_create','ProgramController@program_adhok_presentation_create');
    Route::get('/presentation_adhok_proposal_info','ProgramController@presentation_adhok_proposal_info');
    Route::get('/presentation_adhok_contract_info','ProgramController@presentation_adhok_contract_info');
    Route::get('/program_adhok_presentation_add','ProgramController@program_adhok_presentation_add');
    Route::post('/get_fequency_wise_presentation_info','ProgramController@get_fequency_wise_presentation_info');
    Route::post('/searching_adhok_presentation_info','ProgramController@searching_adhok_presentation_info');
    Route::post('/adhok_date_wise_presentation_info','ProgramController@adhok_date_wise_presentation_info');
    Route::post('/adhok_save_presentation_info','ProgramController@adhok_save_presentation_info');
    
    //9.11.2019
    Route::post('/update_odivision_presentation_info_info','SettingCtrl@update_odivision_presentation_info_info');
    Route::get('/odivision_program_queue_sheet_view_data/{id}','SettingCtrl@odivision_program_queue_sheet_view');

    //14.11.2019
    Route::get('/performance_info','SettingCtrl@performance_info');
    Route::get('/performance_info_add','SettingCtrl@performance_info_add');
    Route::post('/searching_performance_info','SettingCtrl@searching_performance_info');
    Route::post('/save_performance_info','SettingCtrl@save_performance_info');
    Route::get('/view_performance_info/{performance_date}/{station_id}/{fequencey_id}/','SettingCtrl@view_performance_info');
    
    // 28.11.2019
    Route::get('/program_bikolpo_presentation_record','ProgramController@program_bikolpo_presentation_record');
    Route::get('/program_bikolpo_proposal_record','ProgramController@program_bikolpo_proposal_record');
    Route::get('/program_bikolpo_contract_record','ProgramController@program_bikolpo_contract_record');

    Route::get('/program_bikolpo_presentation_add','ProgramController@program_bikolpo_presentation_add');
    Route::post('/searching_bikolpo_presentation_info','ProgramController@searching_bikolpo_presentation_info');
    Route::post('/save_bikolpo_presentation_info','ProgramController@save_bikolpo_presentation_info');
    Route::get('/bikolpo_presentation_info_report/{month_id}/{station}/{fequency}/{type}','ProgramController@bikolpo_presentation_info_report');
    Route::get('/bikolpo_presentation_info_report_date/{month_id}/{station}/{fequency}/{type}','ProgramController@bikolpo_presentation_info_report_date');
    Route::get('/bikolpo_presentation_info_report_artist/{month_id}/{station}/{fequency}/{type}','ProgramController@bikolpo_presentation_info_report_artist');
    Route::post('/status_update_presentation_info_bikolpo','ProgramController@status_update_presentation_info_bikolpo');

   //7.12.2019
    Route::post('/save_user_access_info','SettingCtrl@save_user_access_info');
    Route::post('/search_employee_user_access_search','SettingCtrl@search_employee_user_access_search');
    Route::get('/create_access_control/{user_primary_id}','SettingCtrl@create_access_control');
    Route::get('/artist_record_attachment/{id}','ProgramController@artist_record_attachment');

    Route::post("show_all_playlist_info",array('as'=>'autocomplete','uses'=> 'ProgramController@show_all_playlist_info'));
    Route::post("searching_artist_info",array('as'=>'autocomplete','uses'=> 'ProgramController@searching_artist_info'));

//    19.01.2020
    Route::post("recordingListToAccount",array('as'=>'autocomplete','uses'=> 'ProgramController@recordingListToAccount'));

    /////////////// /////////////////////////
    ////////////  Archive Management //////////
    //////////////////////////////////////////


    Route::get('/betar_archive','ArchiveController@index');
    Route::get('/archive_song_create','ArchiveController@archive_song_create');
    Route::get('/archive_film_song_create','ArchiveController@archive_film_song_create');
    Route::get('/archive_band_song_create','ArchiveController@archive_band_song_create');
    Route::post('/save_song_create','ArchiveController@save_song_create');
    Route::post('/get_song_sub_type','ArchiveController@get_song_sub_type');
    Route::post('/get_boardcast_frequency','ArchiveController@get_boardcast_frequency');
    Route::post('/get_film_actor','ArchiveController@get_film_actor');
    Route::post('/get_film_director','ArchiveController@get_film_director');
    Route::post('/get_instument','ArchiveController@get_instument');
    Route::get('/get_artist_info','ArchiveController@get_artist_info');
    Route::get('/archive_kobita_create','ArchiveController@archive_kobita_create');
    Route::get('/archive_natok_create','ArchiveController@archive_natok_create');
    Route::get('/archive_onusthan_create','ArchiveController@archive_onusthan_create');

    Route::get('/archive_vhason_create','ArchiveController@archive_vhason_create');
    Route::get('/archive_sakhhatkar_create','ArchiveController@archive_sakhhatkar_create');
    Route::get('/archive_kothika_create','ArchiveController@archive_kothika_create');
    Route::get('/archive_procharona_create','ArchiveController@archive_procharona_create');

    Route::post('/save_kobita_create','ArchiveController@save_kobita_create');
    Route::post('/save_natok_create','ArchiveController@save_natok_create');
    Route::post('/save_program_create','ArchiveController@save_program_create');
    Route::post('/save_vhason_create','ArchiveController@save_vhason_create');
    Route::post('/save_sakhhatkar_create','ArchiveController@save_sakhhatkar_create');
    Route::post('/save_kothika_create','ArchiveController@save_kothika_create');
    Route::post('/save_procharona_create','ArchiveController@save_procharona_create');






    // report list
    Route::get('/get_archive_list','ArchiveController@get_archive_list');
    Route::get('/get_kobita_list','ArchiveController@get_kobita_list');
    Route::get('/get_natok_list','ArchiveController@get_natok_list');
    Route::get('/get_program_list','ArchiveController@get_program_list');
    Route::get('/archive_book','ArchiveController@archive_book');
    Route::get('/get_archive_ids','ArchiveController@get_archive_ids');
    Route::get('/get_vumika_info','ArchiveController@get_vumika_info');
    Route::get('/get_archive_type','ArchiveController@get_archive_type');


    Route::get('/get_vhason_list','ArchiveController@get_vhason_list');
    Route::get('/get_sakhhatkar_list','ArchiveController@get_sakhhatkar_list');
    Route::get('/get_kothika_list','ArchiveController@get_kothika_list');
    Route::get('/get_procharona_list','ArchiveController@get_procharona_list');
    Route::post('/archive_item_approved','ArchiveController@archive_item_approved');
    Route::post('/archive_item_correction','ArchiveController@archive_item_correction');
    Route::post('/archive_item_delete','ArchiveController@archive_item_delete');
    Route::get('/archive_item_download/{id}','ArchiveController@archive_item_download');
    Route::get('/donwloadMultipleFile/{id}','ArchiveController@donwloadMultipleFile');
    Route::get('/archive_item_view/{id}','ArchiveController@archive_item_view');


    // play list routes
    Route::get('/archive_playlist_create','ArchiveController@archive_playlist_create');
    Route::post('/save_playlist','ArchiveController@save_playlist');
    Route::post('/save_playlist_update','ArchiveController@save_playlist_update');
    Route::post('/song_remove','ArchiveController@song_remove');
    Route::get('/get_play_list','ArchiveController@get_play_list');
    Route::post('/add_to_playlist','ArchiveController@add_to_playlist');
    Route::get('/edit_playlist/{id}','ArchiveController@edit_playlist');
    Route::get('/play_playlist/{id}','ArchiveController@play_playlist');
    Route::get('/view_playlist/{id}','ArchiveController@view_playlist');
    Route::post('/playlist_status_update','ArchiveController@playlist_status_update');
    Route::post('/archive_change_status','ArchiveController@archive_change_status');
    Route::post('/ajax_order_update','ArchiveController@ajax_order_update');
    Route::post('/get_ministry_sub_type','ArchiveController@get_ministry_sub_type');


    // archive song review
    Route::get('/archive_song_review','ArchiveController@archive_song_review');
    Route::get('/archive_kobita_review','ArchiveController@archive_kobita_review');
    Route::get('/archive_natok_review','ArchiveController@archive_natok_review');
    Route::get('/archive_program_review','ArchiveController@archive_program_review');
    Route::get('/archive_vhason_review','ArchiveController@archive_vhason_review');
    Route::get('/archive_sakhhatkar_review','ArchiveController@archive_sakhhatkar_review');
    Route::get('/archive_kothika_review','ArchiveController@archive_kothika_review');
    Route::get('/archive_procharona_review','ArchiveController@archive_procharona_review');
    Route::get('/dataMigrate','ArchiveController@dataMigrate');

    // setting function
    Route::get('/archive_song_type','ArchiveSettingController@archive_song_type');
    Route::get('/archive_kobita_type','ArchiveSettingController@archive_kobita_type');
    Route::get('/archive_natok_type','ArchiveSettingController@archive_natok_type');
    Route::get('/archive_film_type','ArchiveSettingController@archive_film_type');
    Route::get('/archive_band_type','ArchiveSettingController@archive_band_type');
    Route::get('/archive_band','ArchiveSettingController@archive_band');
    Route::post('/save_archive_band','ArchiveSettingController@save_archive_band');
    Route::post('/save_archive_angik','ArchiveSettingController@save_archive_angik');
    Route::post('/save_archive_ministry','ArchiveSettingController@save_archive_ministry');
    Route::get('/archive_angik','ArchiveSettingController@archive_angik');
    Route::get('/archive_ministry','ArchiveSettingController@archive_ministry');
    Route::get('/archive_doptor','ArchiveSettingController@archive_doptor');


    // archive item report
    Route::get('/archive_item_report','ArchiveController@archive_item_report');


    Route::get('/archive_natok_category','ArchiveSettingController@archive_natok_category');
    Route::get('/archive_program_category','ArchiveSettingController@archive_program_category');
    Route::get('/archive_vhason_category','ArchiveSettingController@archive_vhason_category');
    Route::get('/archive_sakhhatkar_category','ArchiveSettingController@archive_sakhhatkar_category');
    Route::get('/archive_song_category','ArchiveSettingController@archive_song_category');
    Route::get('/archive_song_sub_category','ArchiveSettingController@archive_song_sub_category');
    Route::get('/archive_source','ArchiveSettingController@archive_source');
    Route::get('/archive_instument','ArchiveSettingController@archive_instument');
    Route::get('/archive_song_album','ArchiveSettingController@archive_song_album');
    Route::get('/archive_kobita_album','ArchiveSettingController@archive_kobita_album');






    Route::post('/save_archive_instument','ArchiveSettingController@save_archive_instument');

    Route::post('/save_archive_album','ArchiveSettingController@save_archive_album');
    Route::post('/archive_album_delete','ArchiveSettingController@archive_album_delete');

    Route::post('/save_archive_source','ArchiveSettingController@save_archive_source');
    Route::post('/save_archive_category','ArchiveSettingController@save_archive_category');
    Route::post('/archive_category_delete','ArchiveSettingController@archive_category_delete');
    Route::post('/save_archive_type','ArchiveSettingController@save_archive_type');
    Route::post('/archive_type_delete','ArchiveSettingController@archive_type_delete');
    Route::post('/archive_band_delete','ArchiveSettingController@archive_band_delete');



});
