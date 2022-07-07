<?php

//headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization, X-Requested-With');


include_once '../../config/Database.php';
include_once '../../models/Convo.php';

	// instantiate DB and connect
	$database = new Database();
	$db = $database->connect();

	// instantiate convo  object
	$convo =  new Convo($db);

	$hold_stat = array();
	//$hold_stat['data'] = array();

	//get raw posted data
	$data = json_decode( file_get_contents("php://input"),true);

	for($i = 0; $i < sizeof($data); $i++)
	{
			$convo->invoice_id = $data[$i]['invoice_id'];
			$convo->transation_id = $data[$i]['transation_id'];
			$convo->payment_amount = $data[$i]['payment_amount'];
			$convo->payment_date = $data[$i]['payment_date'];
			$convo->payment_mode = $data[$i]['payment_mode'];

		//update table data
		if($convo->update()){

			$item = array(
				'invoice_id' => $convo->invoice_id,
				'transation_id' => $convo->transation_id,
				'stat_code' => 'Y',
				'message' => 'Success.'
			);

			//push to "DATA"
			$hold_stat[] = $item;
		}else{
			$item = array(
				'invoice_id' => $convo->invoice_id,
				'transation_id' => $convo->transation_id,
				'stat_code' => 'N',
				'message' => 'Error: Not Updated.'
			);
			//push to "DATA"
			$hold_stat[] = $item;
		}

	}//end of for loop

	echo json_encode($hold_stat);
?>