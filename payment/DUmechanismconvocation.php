<?php 

class DUmechanismconvocation{

	private $con;

	public function __construct()
	{
		$this->con = (is_null($this->con)) ? self::connect() : $this->con;
	}

	static function connect()
	{
		/* set database credentials 
			DB_Host, DB_Username, DB_Password, DB_Name
		*/
		$con = mysqli_connect('localhost','collegedu_payment','%IRj#&B*;eah','collegedu_payment');		
		return $con;
	}
	public static function authenticate($header_params)
	{
		if($header_params->username == 'sbluserfor52convo' && $header_params->password == 'Sb@conVo#2019Du52') return true;
		else throw new SOAPFault("username and password did not match",401);
	}


	public function setStatus($params)
	{
		$dataArr = array();
		//date_default_timezone_set("Asia/Dhaka");

		for($i = 0; $i < sizeof($params); $i++){

			$invoice_id		= $params[$i]['invoice_id'];
			$appicant_id	= $params[$i]['appicant_id'];
			$transation_id	= $params[$i]['transation_id'];
			$payment_amount	= $params[$i]['payment_amount'];
			

			$sql = "UPDATE `invoice` s SET s.`payment_mode`='S',s.`transation_id`='$transation_id',s.`payment_amount`='$payment_amount',s.`payment_status`='1',s.`payment_date`=NOW() WHERE invoice_id = '$invoice_id' AND payment_status='0'";

			$tmp2 = mysqli_query($this->con,$sql);
			$afr = $this->con->affected_rows;
			
			//set status message
					$status 	= NULL;
					$fld_error = NULL;

			if($tmp2) // when query runs and return true
			{
				
				if($afr > 0){
						$status 	= 'success';
						$errorType 	= 'na';
				}
				else if($afr <= 0)
				{
					//set error message
						if(is_null($appicant_id) ) $fld_error .= 'OR aid is null';
						if(is_null($invoice_id) ) $fld_error .= 'OR pid is null';
						
						if($fld_error == NULL){
							
							$sql3 = "SELECT d.`transation_id` FROM `invoice` d WHERE d.`appicant_id`='$appicant_id' AND d.`invoice_id`='$invoice_id' AND d.`payment_status`='1';";
							
							//execute query
								$tmp3  = mysqli_query($this->con,$sql3); 

							if( $tmp3->num_rows > 0 ){
								$status 	= 'success';
								$errorType 	= 'na';
							}
							else{
								$status 	= 'error';
								$errorType 	= 'unknown error (L76)';
							}
						}
						else{
								$status 	= 'error';
								$errorType 	= $fld_error;
						}		
				}

			}
			else
			{
				$status 	= 'error';
				$errorType 	= 'sql query not executed.';
			}
				//store data on array
					$dataArr[] = array('payInfoResponse'=> 
						array(
							'status' 		=> $status, 
							'paymentID' 	=> $transation_id,
							'uniCode'		=> 'DU',
							'errorType'		=> $errorType,
							'affected_rows' => $afr)
					);
					$afr = 0;
					$status = NULL;
					$errorType = null;

		}
		// returning data to SBL rms server
		return json_encode($dataArr);
	}//end of setStatus method
	
}


$params = array('uri' => 'http://7collegedu.com/payment/DUmechanismconvocation.php'); 
$server = new SoapServer(null,$params);

$server->setClass('DUmechanismconvocation');
$server->handle();

?>

