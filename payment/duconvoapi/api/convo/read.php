<?php

//headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");



include_once '../../config/Database.php';
include_once '../../models/Convo.php';

	// instantiate DB and connect
	$database = new Database();
	$db = $database->connect();

	// instantiate convo  object
	$convo =  new Convo($db);

	//get raw posted data
	//$data = json_decode( file_get_contents("php://input"));

	//set variable form $_GET method
	$convo->from_date = $_GET['from_date'];
	$convo->to_date = $_GET['to_date'];
	$convo->payment_mode = $_GET['payment_mode'];

	//get data
	$result = $convo->read();

	//get row count
	$num = $result->rowCount();

	//check if any data
	if($num > 0){

		$convo_arr = array();
		$convo_arr['data'] = array();

		while( $row = $result->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			$item = array(
				'applicant_name' => $applicant_name,
				'invoice_id' => $invoice_id,
				'transation_id' => $transation_id,
				'payment_amount' => $payment_amount,
				'payment_status' => $payment_status,
				'payment_mode' => $payment_mode
			);
			
			//push to "DATA"
			array_push($convo_arr['data'],$item);
		}

		//Turn to JSON
		echo json_encode($convo_arr);

	}else{

		//no data found
		echo json_encode( array('message' => 'No data found.'));
	}

?>