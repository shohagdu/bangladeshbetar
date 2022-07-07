<?php
session_start();
include('../config.php');
$amount=$_GET['amount'];
$invoice=$_GET['invoice'];
date_default_timezone_set("Asia/Dhaka");

	   $createpaybody=array(
	       'amount'=>$amount,
		   'currency'=>'BDT',
		   'intent'=>'sale',
		   'merchantAssociationInfo'=>'RF10'.$invoice,
		   'merchantInvoiceNumber'=>$invoice
		   );	
		
		$url=curl_init('https://checkout.pay.bka.sh/v1.2.0-beta/checkout/payment/create');
		
		$createpaybodyx=json_encode($createpaybody);
		$header=array(
		        'Content-Type:application/json',
				'authorization:'.$_SESSION['token'],
				'x-app-key:hpjmrvgn7oadn4jneb9mehlv');				
				curl_setopt($url,CURLOPT_HTTPHEADER, $header);
				curl_setopt($url,CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
				curl_setopt($url,CURLOPT_POSTFIELDS, $createpaybodyx);
				curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);
				$resultdata=curl_exec($url);
				curl_close($url);
				
				$jData = json_decode($resultdata, true);
				
				
			  if($jData['paymentID']!=null){
				    $pid=$jData['paymentID'];
				    $dtime=$jData['createTime'];
				    $trxstatus=$jData['transactionStatus'];
				    
				    $insertionSuccess=mysqli_query($con,"INSERT INTO payment_log(invoiceid,amount,payment_id,timedate,trx_status,trxid,error_data,payment_update_time,paytype)VALUES('$invoice','$amount','$pid','$dtime','$trxstatus','0','0','0','0')");
				    
					if($insertionSuccess==1){
						echo $resultdata;
					}else{
					
						$insertion_error = new \stdClass();
						$insertion_error->paymentID = NULL;
						$insertion_error->merchantInvoiceNumber = "Unexpected Error! Please Try again. If the problem persists start a new registration.";
						$insertion_error_JSON = json_encode($insertion_error);
						echo $insertion_error_JSON;
					}
				    
				}

?>