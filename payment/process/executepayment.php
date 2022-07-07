<?php
session_start();
include('../config.php');
$paymentID=$_GET['paymentID'];
$url=curl_init('https://checkout.pay.bka.sh/v1.2.0-beta/checkout/payment/execute/'.$paymentID);
     $header=array(
		'Content-Type:application/json',
		'authorization:'.$_SESSION['token'],
		'x-app-key:hpjmrvgn7oadn4jneb9mehlv');				
		//print_r($header); 
		curl_setopt($url,CURLOPT_HTTPHEADER, $header);
		curl_setopt($url,CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
		curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);
		$resultdatax=curl_exec($url);
		curl_close($url);
		
		$jData=json_decode($resultdatax, true);
		
		if($jData['paymentID']!=null)
    		{
        		$pid=$jData['paymentID'];
        		$udate=$jData['updateTime'];
        		$trxstatus=$jData['transactionStatus'];
        		$merchantInvoiceNumber=$jData['merchantInvoiceNumber'];
        		$amount=$jData['amount'];
        
        		$trxid=$jData['trxID'];
        		
            		if($trxstatus=='Completed'){
            			$update1=mysqli_query($con,"UPDATE payment_log SET payment_update_time='$udate',trx_status='$trxstatus',trxid='$trxid',paytype='B' WHERE payment_id='$pid' AND invoiceid='$merchantInvoiceNumber'");
             	       $update2=mysqli_query($con,"UPDATE invoice SET payment_date='$udate',payment_status='1',transation_id='$trxid',payment_mode='B',payment_amount='$amount' WHERE invoice_id='$merchantInvoiceNumber'");
             	       if($update1==1 && $update2==1){
             	           echo $resultdatax;
             	       }
            		}
            	
		}
        else
        {
            $errorcode=$jData['errorCode'];
           	$datainsert=mysqli_query($con,"UPDATE payment_log SET trx_status='Failed',error_data='$errorcode' WHERE payment_id='$paymentID'"); 
           	 if($datainsert==1)
           	 {
           	      echo $resultdatax;
           	 }
        }
	
?>